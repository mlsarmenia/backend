<?php

namespace Tests\Unit\Traits;

use App\Models\CLocationStreet;
use App\Traits\Controllers\AddEstateFetchMethods;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class EstateStreetFetchTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite.database', ':memory:');
        DB::purge('sqlite');
        DB::reconnect('sqlite');

        Schema::create('c_location_city', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('parent_id')->nullable();
            $table->string('name_arm')->nullable();
        });

        Schema::create('c_location_street', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('parent_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('community_id')->nullable();
            $table->boolean('parent_is_community')->nullable();
        });

        DB::table('c_location_city')->insert([
            'id' => 42,
            'parent_id' => 2,
            'name_arm' => 'City',
        ]);

        DB::table('c_location_street')->insert([
            ['id' => 1, 'city_id' => 42, 'community_id' => null, 'parent_is_community' => false],
            ['id' => 2, 'city_id' => null, 'community_id' => 7, 'parent_is_community' => true],
        ]);
    }

    public function test_city_lookup_works_when_hidden_community_is_not_submitted(): void
    {
        $this->assertSame([1], $this->fetchStreetIds('location_city', 42));
    }

    public function test_community_lookup_works_when_hidden_city_is_not_submitted(): void
    {
        $this->assertSame([2], $this->fetchStreetIds('location_community', 7));
    }

    private function fetchStreetIds(string $field, int $id): array
    {
        $this->app->instance('request', Request::create('/', 'POST', [
            'form' => [['name' => $field, 'value' => (string) $id]],
        ]));

        $fetcher = new class
        {
            use AddEstateFetchMethods;

            public function fetch(array $options): array
            {
                return $options['query'](CLocationStreet::query())
                    ->orderBy('id')
                    ->pluck('id')
                    ->all();
            }
        };

        return $fetcher->fetchLocationStreet();
    }
}
