<?php

namespace Tests\Unit\Models;

use App\Models\CCurrency;
use App\Models\Client;
use App\Services\CurrencyRateService;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ClientBudgetNormalizationTest extends TestCase
{
    public function test_null_currency_budgets_fall_back_to_amd(): void
    {
        $client = new Client([
            'price_from' => 5_000_000,
            'price_to' => 10_000_000,
        ]);

        $client->normalizeBudgetToAmd($this->rateService([]));

        $this->assertSame(5_000_000.0, $client->price_from_amd);
        $this->assertSame(10_000_000.0, $client->price_to_amd);
    }

    public function test_foreign_currency_budgets_are_converted_to_amd(): void
    {
        $currency = new CCurrency(['name_eng' => 'US Dollar']);
        $currency->id = 2;

        $client = new Client([
            'currency_id' => 2,
            'price_from' => 100_000,
            'price_to' => 150_000,
        ]);
        $client->setRelation('currency', $currency);

        $client->normalizeBudgetToAmd($this->rateService(['USD' => 390.5]));

        $this->assertSame(39_050_000.0, $client->price_from_amd);
        $this->assertSame(58_575_000.0, $client->price_to_amd);
    }

    public function test_missing_exchange_rate_rejects_the_budget(): void
    {
        $currency = new CCurrency(['name_eng' => 'Russian Ruble']);
        $currency->id = 3;

        $client = new Client([
            'currency_id' => 3,
            'price_from' => 1_000_000,
            'price_to' => 2_000_000,
        ]);
        $client->setRelation('currency', $currency);

        try {
            $client->normalizeBudgetToAmd($this->rateService([]));
            $this->fail('A missing exchange rate should reject the budget.');
        } catch (ValidationException $exception) {
            $this->assertArrayHasKey('currency_id', $exception->errors());
        }
    }

    public function test_currency_names_resolve_to_supported_iso_codes(): void
    {
        $amd = new CCurrency(['name_eng' => 'Armenian Dram']);
        $amd->id = 1;

        $usd = new CCurrency(['name_arm' => 'ԱՄՆ դոլար']);
        $rub = new CCurrency(['name_ru' => 'Российский рубль']);
        $unsupported = new CCurrency(['name_eng' => 'Euro']);

        $this->assertSame('AMD', $amd->iso_code);
        $this->assertSame('USD', $usd->iso_code);
        $this->assertSame('RUB', $rub->iso_code);
        $this->assertNull($unsupported->iso_code);
    }

    private function rateService(array $rates): CurrencyRateService
    {
        return new class($rates) extends CurrencyRateService
        {
            public function __construct(private readonly array $rates) {}

            public function getRate(string $iso): ?float
            {
                return $this->rates[$iso] ?? null;
            }
        };
    }
}
