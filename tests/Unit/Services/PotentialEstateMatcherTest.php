<?php

namespace Tests\Unit\Services;

use App\Models\CBuildingProjectType;
use App\Models\CBuildingType;
use App\Models\Client;
use App\Models\CLocationCommunity;
use App\Models\CRepairingType;
use App\Services\PotentialEstateMatcher;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class PotentialEstateMatcherTest extends TestCase
{
    public function test_matcher_uses_normalized_amd_budget_and_client_contract_column(): void
    {
        $client = $this->clientWithEmptyRelations([
            'estate_contract_type_id' => 1,
            'price_from' => 30_000_000,
            'price_to' => 40_000_000,
            'price_from_amd' => 30_000_000,
            'price_to_amd' => 40_000_000,
        ]);

        $query = (new PotentialEstateMatcher)->forClient($client);
        $sql = $query->toSql();
        $bindings = $query->getBindings();

        $this->assertStringContainsString('contract_type_id', $sql);
        $this->assertStringContainsString('price_amd', $sql);
        $this->assertContains(30_000_000.0, $bindings);
        $this->assertContains(40_000_000.0, $bindings);
        $this->assertNotContains(11_100_000_000, $bindings);
        $this->assertNotContains(16_000_000_000, $bindings);
    }

    public function test_matcher_keeps_existing_criteria_and_allows_legacy_null_city(): void
    {
        $client = $this->clientWithEmptyRelations([
            'estate_type_id' => 1,
            'estate_contract_type_id' => 1,
            'area_from' => 50,
            'area_to' => 70,
            'location_province_id' => 1,
            'location_city_id' => 1,
            'room_count_from' => 2,
            'room_count_to' => 2,
        ]);

        $client->setRelation('communities', new Collection([
            (new CLocationCommunity)->forceFill(['id' => 8]),
        ]));
        $client->setRelation('client_repairing_types', new Collection([
            (new CRepairingType)->forceFill(['id' => 1]),
        ]));
        $client->setRelation('client_building_project__types', new Collection([
            (new CBuildingProjectType)->forceFill(['id' => 13]),
        ]));
        $client->setRelation('client_building_types', new Collection([
            (new CBuildingType)->forceFill(['id' => 3]),
        ]));

        $query = (new PotentialEstateMatcher)->forClient($client);
        $sql = $query->toSql();
        $bindings = $query->getBindings();

        foreach ([
            'estate_status_id',
            'estate_type_id',
            'contract_type_id',
            'area_total',
            'location_province_id',
            'location_city_id',
            'location_community_id',
            'room_count',
            'repairing_type_id',
            'building_project_type_id',
            'building_type_id',
        ] as $criterion) {
            $this->assertStringContainsString($criterion, $sql);
        }

        $this->assertStringContainsString('location_city_id` is null', $sql);
        $this->assertContains(8, $bindings);
        $this->assertContains(13, $bindings);
    }

    private function clientWithEmptyRelations(array $attributes): Client
    {
        $client = (new Client)->forceFill($attributes);

        foreach ([
            'communities',
            'client_repairing_types',
            'client_building_project__types',
            'client_building_types',
        ] as $relation) {
            $client->setRelation($relation, new Collection);
        }

        return $client;
    }
}
