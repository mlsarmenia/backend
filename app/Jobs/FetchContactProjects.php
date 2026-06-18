<?php

namespace App\Jobs;

use App\Enum\B24\Contact;
use App\Models\B24ContactProject;
use Bitrix24\SDK\Services\ServiceBuilderFactory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class FetchContactProjects implements ShouldQueue
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
        $fields = $b24Service->getCRMScope()->contact()->fields()->getCoreResponse()->getResponseData()->getResult();
        $projects = $fields[Contact::PROJECT->value]['items'] ?? null;
        $data = array_map(function ($item) {
            return [
                'id' => $item['ID'],
                'name' => $item['VALUE'],
            ];
        }, $projects);
        B24ContactProject::query()->upsert($data, 'id');
    }
}
