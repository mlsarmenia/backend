<?php

namespace App\Gateways;

use App\Enum\B24\BaseCategoryStage;
use App\Models\Estate;
use Exception;
use Illuminate\Support\Facades\Http;

class PrimaryMarketService
{
    private ?string $apiUrl = null;
    private ?array $configs;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->configs = config('primary_market_service');
        $this->setApiUrl();
    }

    /**
     * @throws Exception
     */
    private function setApiUrl(): void
    {
        if (!$this->configs['api_url']) {
            throw new Exception('API URL not configured', 500);
        }

        $this->apiUrl = $this->configs['api_url'];
    }

    /**
     * @throws Exception
     */
    public function create(Estate $estate)
    {
        $payload = $this->makePayload($estate);
        $response = Http::post($this->apiUrl . '/api/plans', $payload);

        if (!$response->ok()) {
            throw new Exception($response->json('message') ?? '', $response->status());
        }

        return $response->json('id');
    }

    /**
     * @throws Exception
     */
    public function update(Estate $estate): void
    {
        $payload = $this->makePayload($estate);
        $response = Http::post($this->apiUrl . '/api/plans', $payload);

        if (!$response->ok()) {
            throw new Exception($response->json('message') ?? '', $response->status());
        }
    }

    /**
     * @throws Exception
     */
    public function updateStatus(Estate $estate, bool $sold): void
    {
        $payload = [
            'apartmentCode' => $estate->apartment_code,
            'sold' => $sold,
        ];
        $response = Http::post($this->apiUrl . '/api/plans/status', $payload);

        if (!$response->noContent()) {
            throw new Exception($response->json('message') ?? '', $response->status());
        }
    }

    private function makePayload(Estate $estate): array
    {
        $sold = !($estate->b24_stage_id === BaseCategoryStage::NEW->value);
        $product = [
            'id' => $estate->id,
            'b24_project_id' => $estate->b24_project_id,
            'b24_product_id' => $estate->b24_product_id,
            'sold' => $sold,
            'apartment_code' => $estate->apartment_code,
            'area' => $estate->area_total,
            'price' => $estate->price_amd,
            'rooms' => $estate->room_count,
            'floor' => $estate->floor,
            'code' => $estate->code,
        ];

        return [
            'product' => $product,
        ];
    }
}
