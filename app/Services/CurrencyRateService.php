<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CurrencyRateService
{
    private const string CACHE_KEY = 'currency_rates';

    public function getRates(): array
    {
        $rates = Cache::get(self::CACHE_KEY);

        if ($rates !== null) {
            return $rates;
        }

        $rows = DB::table('currency_rates')->get();

        if ($rows->isEmpty()) {
            Log::warning('Currency rates not found. Run currency:fetch-rates to populate.');
            return [];
        }

        $rates = $rows->pluck('rate', 'iso')->map(fn ($r) => (float) $r)->all();
        Cache::forever(self::CACHE_KEY, $rates);

        return $rates;
    }

    public function getRate(string $iso): ?float
    {
        return $this->getRates()[$iso] ?? null;
    }

    public function fetchAndCache(): void
    {
        $client = new \SoapClient('https://api.cba.am/exchangerates.asmx?WSDL');
        $result = $client->ExchangeRatesByDate(['date' => now()->toDateString()]);

        $rates = [];
        foreach ($result->ExchangeRatesByDateResult->Rates->ExchangeRate as $rate) {
            if (in_array($rate->ISO, ['USD', 'RUB'])) {
                $rates[$rate->ISO] = (float) $rate->Rate / (float) $rate->Amount;
            }
        }

        $now = now();
        foreach ($rates as $iso => $rate) {
            DB::table('currency_rates')->upsert(
                ['iso' => $iso, 'rate' => $rate, 'fetched_at' => $now],
                ['iso'],
                ['rate', 'fetched_at']
            );
        }

        Cache::forever(self::CACHE_KEY, $rates);
    }
}
