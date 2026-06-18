<?php

namespace App\Jobs;

use App\Enum\B24\BaseCategoryStage;
use App\Enum\B24\Category;
use App\Enum\B24\Estate;
use App\Enum\B24\EstateType as B24EstateType;
use App\Enum\B24\Room;
use App\Enum\ContractType;
use App\Enum\EstateMarketType;
use App\Enum\EstateStatus;
use App\Enum\EstateType;
use App\Gateways\PrimaryMarketService;
use App\Models\Estate as EstateModel;
use App\Traits\GeneratesEstateCode;
use Bitrix24\SDK\Core\Exceptions\BaseException;
use Bitrix24\SDK\Services\ServiceBuilderFactory;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class FetchEstates implements ShouldQueue
{
    use Queueable;
    use GeneratesEstateCode;

    public $timeout = 300;

    /**
     * Create a new job instance.
     */
    public function __construct(protected ?array $ids, protected ?int $offset = null)
    {
        //
    }

    /**
     * Execute the job.
     * @throws BaseException
     */
    public function handle(): void
    {
        $apiBase = config('bitrix24.api_base');
        $b24Service = ServiceBuilderFactory::createServiceBuilderFromWebhook($apiBase);
        $order = [];
        $filter = ['CATEGORY_ID' => Category::BASE->value];
        $select = [];
        $offset = 0;

        foreach (Estate::cases() as $case) {
            $select[] = $case->value;
        }

        if ($this->ids) {
            $filter['@ID'] = $this->ids;
        }

        if ($this->offset) {
            $offset = $this->offset;
        }

        $deals = $b24Service->getCRMScope()->deal()->list(
            $order,
            $filter,
            $select,
            $offset
        )->getCoreResponse()
            ->getResponseData()
            ->getResult();
        $data = [];
        $codes = [];
        $types = array_column(B24EstateType::cases(), 'value');

        if (empty($deals)) {
            return;
        }

        foreach ($deals as $deal) {
            $type = $deal[Estate::TYPE->value] ? $deal[Estate::TYPE->value][0] : null;

            if (!in_array($type, $types)) {
                continue;
            }

            $dealId = $deal[Estate::ID->value];
            $codes[$dealId] = $deal[Estate::ID_CODE->value];
            $marketType = $deal[Estate::STAGE->value] === BaseCategoryStage::WON
                ? EstateMarketType::SECONDARY->value
                : EstateMarketType::PRIMARY->value;
            $data[] = [
                'estate_type_id' => EstateType::APARTMENT->value,
                'market_type' => $marketType,
                'b24_project_id' => $deal[Estate::PROJECT->value],
                'b24_product_id' => $dealId,
                'apartment_code' => $deal[Estate::CODE->value] ? $deal[Estate::CODE->value][0] : null,
                'is_company_project' => true,
                'area_total' => $deal[Estate::AREA->value],
                'price_amd' => $deal[Estate::PRICE->value],
                'room_count' => $deal[Estate::ROOM->value] ? Room::tryFrom($deal[Estate::ROOM->value][0])?->title() : null,
                'contract_type_id' => ContractType::SALE->value,
                'estate_status_id' => EstateStatus::SOLD->value,
                'floor' => $deal[Estate::FLOOR->value],
                'b24_stage_id' => $deal[Estate::STAGE->value],
            ];
        }

        EstateModel::query()->upsert($data, ['b24_product_id']);
        $crmProductIds = array_column($data, 'b24_product_id');
        /** @var EstateModel[] $estates */
        $estates = EstateModel::query()
            ->withoutGlobalScopes()
            ->whereIn('b24_product_id', $crmProductIds)
            ->cursor();
        /** @var PrimaryMarketService $pmServiceGateway */
        $pmServiceGateway = App::make(PrimaryMarketService::class);

        foreach ($estates as $estate) {
            if (!$estate->code) {
                $estate->code = $this->generateEstateCode($estate);
                $estate->save();
            }

            if (!$codes[$estate->getAttribute('b24_product_id')]) {
                $b24Service->getCRMScope()->deal()->update($estate->b24_product_id, [
                    Estate::ID_CODE->value => $estate->code,
                ]);
            }

            if (!$estate->primary_market_product_id) {
                try {
                    $id = $pmServiceGateway->create($estate);

                    if ($id) {
                        $estate->setAttribute('primary_market_product_id', $id);
                        $estate->saveQuietly();
                    }
                } catch (Exception $exp) {
                    Log::error($exp->getMessage());
                }
            } else {
                try {
                    $pmServiceGateway->update($estate);
                } catch (Exception $exp) {
                    Log::error($exp->getMessage());
                }
            }
        }
    }
}
