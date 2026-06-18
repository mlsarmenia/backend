<?php

namespace App\Jobs;

use App\Enum\B24\Estate;
use App\Models\B24Project;
use Bitrix24\SDK\Core\Exceptions\BaseException;
use Bitrix24\SDK\Services\ServiceBuilderFactory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class FetchProjects implements ShouldQueue
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
     * @throws BaseException
     */
    public function handle(): void
    {
        $apiBase = config('bitrix24.api_base');
        $b24Service = ServiceBuilderFactory::createServiceBuilderFromWebhook($apiBase);
        $fields = $b24Service->getCRMScope()->deal()->fields()->getCoreResponse()->getResponseData()->getResult();
        $projects = $fields[Estate::PROJECT->value]['items'] ?? null;
        $data = array_map(function ($item) {
            return [
                'id' => $item['ID'],
                'name' => $item['VALUE'],
            ];
        }, $projects);
        B24Project::query()->upsert($data, 'id');
    }
}
