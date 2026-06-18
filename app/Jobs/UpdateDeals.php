<?php

namespace App\Jobs;

use App\Enum\B24\Category;
use App\Enum\B24\Estate;
use App\Enum\B24\EstateType;
use App\Events\DealProcessed;
use App\Factory\ColumnProcessorFactory;
use Bitrix24\SDK\Services\ServiceBuilderFactory;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UpdateDeals implements ShouldQueue
{
    use Queueable;

    public $timeout = 2000;

    /**
     * Create a new job instance.
     */
    public function __construct(protected string $filepath)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $file = Storage::disk('S3Public')->url($this->filepath);
        $length = 10000;
        $delimiter = ';';
        $dealsToUpdate = [];
        $dealsToAdd = [];

        if (($handle = fopen($file, 'r')) !== false)
        {
            $rawHeader = fgetcsv($handle, $length, $delimiter);
            $header = array_map(function ($item) {
                return preg_replace('/[\x{200B}-\x{200D}\x{FEFF}"]/u', '', $item);
            }, $rawHeader);
            $factory = new ColumnProcessorFactory();

            while (($row = fgetcsv($handle, $length, $delimiter)) !== false)
            {
                $arr = array_combine($header, $row);
                $data = [];

                foreach (Estate::cases() as $case) {
                    $name = $case->title();

                    if ($name && $arr[$name]) {
                        $processor = $factory->getProcessor($case->name);

                        if ($processor) {
                            $data[$case->value] = $processor->make($arr[$name]);
                        }
                    }
                }

                if ($arr['ID']) {
                    $id = (int) $arr['ID'];
                    $dealsToUpdate[$id] = ['fields' => $data];
                } else {
                    $dealsToAdd[] = [
                        ...$data,
                        'CATEGORY_ID' => Category::BASE->value,
                        Estate::TYPE->value => EstateType::APARTMENT->value
                    ];
                }
            }

            fclose($handle);
            Storage::disk('S3Public')->delete($this->filepath);
        }

        $total = count($dealsToUpdate) + count($dealsToAdd);

        if ($total) {
            $apiBase = config('bitrix24.api_base');
            $b24Service = ServiceBuilderFactory::createServiceBuilderFromWebhook($apiBase);
            $processed = 0;
            $chunksToUpdate = array_chunk($dealsToUpdate, 10, true);

            foreach ($chunksToUpdate as $chunk) {
                try {
                    $responses = $b24Service->getCRMScope()->deal()->batch->update($chunk);

                    foreach ($responses as $response) {
                        if (!$response->isSuccess()) {
                            Log::error(print_r($response->getResponseData()->getResult(), true));
                        }
                    }
                } catch (Exception $e) {
                    Log::error($e->getMessage());
                }

                $processed += count($chunk);
                DealProcessed::dispatch($processed, $total);
                sleep(3);
            }

            foreach ($dealsToAdd as $data) {
                try {
                    $b24Service->getCRMScope()->deal()->add($data);
                    DealProcessed::dispatch(++$processed, $total);
                } catch (Exception $e) {
                    Log::error($e->getMessage());
                }
            }
        }
    }
}
