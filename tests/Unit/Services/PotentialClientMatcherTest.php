<?php

namespace Tests\Unit\Services;

use App\Models\Estate;
use App\Services\PotentialClientMatcher;
use Tests\TestCase;

class PotentialClientMatcherTest extends TestCase
{
    public function test_matcher_uses_normalized_amd_budget_and_eligible_statuses(): void
    {
        $estate = new Estate;
        $estate->forceFill([
            'price_amd' => 40_000_000,
        ]);

        $query = (new PotentialClientMatcher)->forEstate($estate);
        $sql = $query->toSql();
        $bindings = $query->getBindings();

        $this->assertStringContainsString('contact_status_id', $sql);
        $this->assertStringContainsString('price_from_amd', $sql);
        $this->assertStringContainsString('price_to_amd', $sql);
        $this->assertSame(1, $bindings[2]);
        $this->assertSame(3, $bindings[3]);
        $this->assertSame(40_000_000, $bindings[4]);
        $this->assertSame(40_000_000, $bindings[5]);
    }

    public function test_matcher_keeps_existing_non_price_criteria(): void
    {
        $estate = new Estate;
        $estate->forceFill([
            'estate_type_id' => 1,
            'contract_type_id' => 2,
            'area_total' => 75,
            'location_province_id' => 3,
            'location_city_id' => 4,
            'location_community_id' => 5,
            'room_count' => 3,
            'repairing_type_id' => 6,
            'building_project_type_id' => 7,
            'building_type_id' => 8,
        ]);

        $sql = (new PotentialClientMatcher)->forEstate($estate)->toSql();

        foreach ([
            'estate_type_id',
            'estate_contract_type_id',
            'area_from',
            'area_to',
            'location_province_id',
            'location_city_id',
            'client_community',
            'room_count_from',
            'room_count_to',
            'client_repairing_type',
            'client_building_project_type',
            'client_building_type',
        ] as $criterion) {
            $this->assertStringContainsString($criterion, $sql);
        }
    }
}
