<?php

namespace Tests\Unit\Models;

use App\Models\CLocationStreet;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CLocationStreetTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite.database', ':memory:');
        DB::purge('sqlite');
        DB::reconnect('sqlite');

        Schema::create('c_location_street', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('parent_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('community_id')->nullable();
            $table->boolean('parent_is_community')->nullable();
            $table->string('name_arm')->nullable();
            $table->string('name_eng')->nullable();
        });
    }

    public function test_city_scope_returns_modern_and_legacy_streets(): void
    {
        DB::table('c_location_street')->insert([
            [
                'id' => 1,
                'city_id' => 42,
                'community_id' => null,
                'parent_id' => null,
                'parent_is_community' => false,
                'name_arm' => 'Modern city street',
            ],
            [
                'id' => 2,
                'city_id' => null,
                'community_id' => null,
                'parent_id' => 42,
                'parent_is_community' => false,
                'name_arm' => 'Legacy city street',
            ],
            [
                'id' => 3,
                'city_id' => 99,
                'community_id' => null,
                'parent_id' => 42,
                'parent_is_community' => false,
                'name_arm' => 'Street reassigned to another city',
            ],
            [
                'id' => 4,
                'city_id' => null,
                'parent_id' => 42,
                'community_id' => 7,
                'parent_is_community' => true,
                'name_arm' => 'Community street',
            ],
        ]);

        $streetIds = CLocationStreet::query()
            ->forCity(42)
            ->orderBy('id')
            ->pluck('id')
            ->all();

        $this->assertSame([1, 2], $streetIds);
    }
}
