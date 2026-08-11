<?php

namespace Tests\Unit\Admin;

use Tests\TestCase;

class AdvancedEstateRangeFiltersTest extends TestCase
{
    public function test_advanced_filters_switch_between_presets_and_two_input_ranges(): void
    {
        $filters = file_get_contents(app_path('Traits/Controllers/HasEstateFilters.php'));
        $toggle = file_get_contents(resource_path(
            'views/vendor/backpack/crud/filters/extended_range_toggle.blade.php'
        ));
        $range = file_get_contents(resource_path('views/vendor/backpack/crud/filters/range.blade.php'));

        foreach ([
            'extended_price' => ['price_range', 'price'],
            'extended_area' => ['area_range', 'area'],
            'extended_price_sqm' => ['price_sqm', 'extended_price_sqm_range'],
        ] as $name => [$basicFilter, $rangeFilter]) {
            $this->assertMatchesRegularExpression(
                "/'type'\\s*=>\\s*'extended_range_toggle',\\s*'name'\\s*=>\\s*'{$name}'/",
                $filters,
            );
            $this->assertStringContainsString("'basic_filter' => '{$basicFilter}'", $filters);
            $this->assertStringContainsString("'range_filter' => '{$rangeFilter}'", $filters);
        }

        $this->assertStringContainsString('URI(window.location.href)', $toggle);
        $this->assertStringContainsString('url.removeQuery(basicFilter)', $toggle);
        $this->assertStringContainsString('url.removeQuery(rangeFilter)', $toggle);
        $this->assertStringContainsString('window.location.assign', $toggle);
        $this->assertSame(2, substr_count($range, 'class="form-control range-input'));
        $this->assertStringContainsString('pull-right from', $range);
        $this->assertStringContainsString('pull-right to', $range);
    }

    public function test_price_per_square_meter_range_includes_both_boundaries(): void
    {
        $filters = file_get_contents(app_path('Traits/Controllers/HasEstateFilters.php'));

        $this->assertSame(3, substr_count($filters, "price_amd/area_total >= ?"));
        $this->assertSame(3, substr_count($filters, "price_amd / estate.area_total <= ?"));
        $this->assertStringNotContainsString("price_amd/area_total > ?", $filters);
        $this->assertStringNotContainsString("price_amd / estate.area_total < ?", $filters);
    }
}
