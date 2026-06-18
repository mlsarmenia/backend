<?php

namespace App\Console\Commands;

use App\Services\CurrencyRateService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Throwable;

class FetchCurrencyRates extends Command
{
    protected $signature = 'currency:fetch-rates';
    protected $description = 'Fetch and cache AMD exchange rates from cba.am';

    public function handle(CurrencyRateService $service): int
    {
        try {
            $service->fetchAndCache();
            $this->info('Currency rates fetched and cached successfully.');
            return self::SUCCESS;
        } catch (Throwable $e) {
            Log::error('Failed to fetch currency rates from cba.am: ' . $e->getMessage());
            $this->error('Failed to fetch currency rates: ' . $e->getMessage());
            return self::FAILURE;
        }
    }
}
