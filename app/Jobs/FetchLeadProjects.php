<?php

namespace App\Jobs;

use App\Enum\B24\Lead;
use App\Models\B24LeadProject;
use Bitrix24\SDK\Services\ServiceBuilderFactory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class FetchLeadProjects implements ShouldQueue
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
        $fields = $b24Service->getCRMScope()->lead()->fields()->getCoreResponse()->getResponseData()->getResult();
        $projects = $fields[Lead::PROJECT->value]['items'] ?? null;
        $data = array_map(function ($item) {
            return [
                'id' => $item['ID'],
                'name' => $item['VALUE'],
            ];
        }, $projects);
        B24LeadProject::query()->upsert($data, 'id');
    }
}
