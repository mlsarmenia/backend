<?php

namespace App\Jobs;

use App\Models\B24InfoSource;
use Bitrix24\SDK\Services\ServiceBuilderFactory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class FetchInfoSources implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $apiBase = config('bitrix24.api_base');
        $b24Service = ServiceBuilderFactory::createServiceBuilderFromWebhook($apiBase);
        $sources = $b24Service->getCRMScope()->core->call('crm.status.list', [
            'filter' => [
                'ENTITY_ID' => 'SOURCE',
            ]
        ])->getResponseData()->getResult();
        $data = array_map(function ($item) {
            return [
                'id' => $item['ID'],
                'slug' => $item['STATUS_ID'],
                'name' => $item['NAME'],
            ];
        }, $sources);
        B24InfoSource::query()->upsert($data, 'slug');
    }
}
