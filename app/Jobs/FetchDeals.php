<?php

namespace App\Jobs;

use App\Enum\B24\Category;
use App\Enum\B24\Deal;
use App\Enum\B24\DealCategoryStage;
use App\Enum\ContactType;
use App\Enum\EstateMarketType;
use App\Gateways\PrimaryMarketService;
use App\Models\Contact;
use App\Models\Estate;
use Bitrix24\SDK\Core\Exceptions\BaseException;
use Bitrix24\SDK\Services\ServiceBuilderFactory;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\App;

class FetchDeals implements ShouldQueue
{
    use Queueable;

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
     * @throws Exception
     */
    public function handle(): void
    {
        $apiBase = config('bitrix24.api_base');
        $b24Service = ServiceBuilderFactory::createServiceBuilderFromWebhook($apiBase);
        $order = [];
        $filter = ['CATEGORY_ID' => Category::DEAL->value];
        $select = [];
        $offset = 0;

        foreach (Deal::cases() as $case) {
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

        if (empty($deals)) {
            return;
        }

        /** @var PrimaryMarketService $pmServiceGateway */
        $pmServiceGateway = App::make(PrimaryMarketService::class);

        foreach ($deals as $deal) {
            $code = $deal[Deal::CODE->value][0] ?? null;

            if (!$code) {
                continue;
            }

            $contact = null;
            $b24Contact = null;
            $contactId = $deal[Deal::CONTACT->value];
            $stage = $deal[Deal::STAGE->value];

            if ($contactId) {
                $b24Contact = $b24Service->getCRMScope()->contact()->get($contactId)
                    ->getCoreResponse()
                    ->getResponseData()
                    ->getResult();
            }

            if ($b24Contact) {
                $contact = $this->findOrCreateContact($b24Contact);
            }

            $estate = Estate::query()
                ->withoutGlobalScopes()
                ->where('b24_product_id', $code)
                ->first();

            if (!$estate) {
                continue;
            }

            if ($stage === DealCategoryStage::WON->value) {
                $estate->setAttribute('market_type', EstateMarketType::SECONDARY);

                if ($contact) {
                    $estate->setAttribute('seller_id', $contact->id);
                    $contact->setAttribute('contact_type_id', ContactType::SELLER->value);
                    $contact->setAttribute('is_seller', true);
                    $contact->setAttribute('is_buyer', false);
                    $contact->saveQuietly();
                }

                $estate->saveQuietly();
                try {
                    $pmServiceGateway->updateStatus($estate, sold: true);
                } catch (Exception $e) {}
            } else {
                $estate->setAttribute('market_type', EstateMarketType::PRIMARY);
                $estate->saveQuietly();
                try {
                    $pmServiceGateway->updateStatus($estate, sold: false);
                } catch (Exception $e) {}

                if ($contact) {
                    $contact->setAttribute('contact_type_id', ContactType::BUYER->value);
                    $contact->setAttribute('is_seller', false);
                    $contact->setAttribute('is_buyer', true);
                    $contact->saveQuietly();
                }
            }
        }
    }

    private function findOrCreateContact(array $b24Contact)
    {
        $contact = Contact::query()->where('b24_contact_id', $b24Contact['ID'])->first();

        if (!$contact) {
            $contact = Contact::query()->create([
                'email' => $b24Contact['EMAIL'][0]['VALUE'] ?? null,
                'contact_type_id' => ContactType::BUYER->value,
                'phone_mobile_1' => $b24Contact['PHONE'][0]['VALUE'] ?? null,
                'name_arm' => $b24Contact['NAME'],
                'last_name_arm' => $b24Contact['LAST_NAME'],
                'is_buyer' => true,
                'b24_contact_id' => $b24Contact['ID'],
            ]);
        }

        return $contact;
    }
}
