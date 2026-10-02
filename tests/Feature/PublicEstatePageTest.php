<?php

namespace Tests\Feature;

use App\Enum\EstateMarketType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PublicEstatePageTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite.database', ':memory:');
        DB::purge('sqlite');
        DB::reconnect('sqlite');

        Schema::create('estate', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('market_type');
            $table->integer('estate_status_id')->nullable();
            $table->boolean('is_published')->nullable();
            $table->integer('estate_type_id')->nullable();
            $table->integer('contract_type_id')->nullable();
            $table->integer('location_province_id')->nullable();
            $table->integer('location_community_id')->nullable();
            $table->integer('location_street_id')->nullable();
            $table->integer('ceiling_height_type_id')->nullable();
            $table->integer('building_structure_type_id')->nullable();
            $table->integer('service_amount_currency_id')->nullable();
            $table->integer('room_count')->nullable();
            $table->integer('room_count_modified')->nullable();
            $table->integer('floor')->nullable();
            $table->integer('building_floor_count')->nullable();
            $table->float('area_total')->nullable();
            $table->float('price_amd')->nullable();
            $table->float('service_amount')->nullable();
            $table->decimal('refund_percentage', 5, 2)->nullable();
            $table->boolean('new_construction')->nullable();
            $table->boolean('persistent_water')->nullable();
            $table->boolean('internet')->nullable();
            $table->boolean('conditioner')->nullable();
            $table->boolean('is_separate_building')->nullable();
            $table->string('code')->nullable();
            $table->string('address_building')->nullable();
            $table->string('address_apartment')->nullable();
            $table->text('public_text_arm')->nullable();
            $table->string('meta_title_arm')->nullable();
            $table->text('meta_description_arm')->nullable();
        });

        Schema::create('estate_document', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('estate_id');
            $table->string('path');
            $table->string('path_thumb')->nullable();
            $table->string('comment_arm')->nullable();
            $table->boolean('is_public')->nullable();
            $table->integer('position')->nullable();
        });

        Schema::create('c_estate_type', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name_arm')->nullable();
        });

        Schema::create('c_building_structure_type', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name_arm')->nullable();
        });

        Schema::create('c_currency', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name_arm')->nullable();
        });
    }

    public function test_published_estate_has_a_guest_accessible_page_with_only_public_information(): void
    {
        DB::table('c_estate_type')->insert([
            'id' => 1,
            'name_arm' => 'Բնակարան',
        ]);

        DB::table('c_building_structure_type')->insert([
            'id' => 1,
            'name_arm' => 'Երկաթբետոնե',
        ]);

        DB::table('c_currency')->insert([
            'id' => 1,
            'name_arm' => 'AMD',
        ]);

        DB::table('estate')->insert([
            'id' => 301,
            'market_type' => EstateMarketType::SECONDARY->value,
            'estate_status_id' => 1,
            'is_published' => true,
            'estate_type_id' => 1,
            'building_structure_type_id' => 1,
            'service_amount' => 15_000,
            'service_amount_currency_id' => 1,
            'new_construction' => true,
            'internet' => true,
            'conditioner' => false,
            'code' => '013-295',
            'address_building' => '39/7',
            'address_apartment' => '12',
            'public_text_arm' => 'Հրապարակային նկարագրություն',
            'meta_title_arm' => 'Հրապարակված գույք',
            'price_amd' => 65_000_000,
            'refund_percentage' => 8,
        ]);

        DB::table('estate_document')->insert([
            [
                'id' => 1,
                'estate_id' => 301,
                'path' => 'public-photo.jpg',
                'is_public' => true,
                'position' => 1,
            ],
            [
                'id' => 2,
                'estate_id' => 301,
                'path' => 'private-photo.jpg',
                'is_public' => false,
                'position' => 2,
            ],
        ]);

        $response = $this->get('/estates/301');

        $response
            ->assertOk()
            ->assertSee('Հրապարակված գույք')
            ->assertSee('Հրապարակային նկարագրություն')
            ->assertSee('public-photo.jpg')
            ->assertSee('Շենքի տվյալներ')
            ->assertSee('Շենքի կառուցվածք')
            ->assertSee('Երկաթբետոնե')
            ->assertSee('Սպասարկման վճար')
            ->assertSee('15 000 AMD')
            ->assertSee('Կոմունալ հարմարություններ')
            ->assertSee('Նորակառույց')
            ->assertSee('Ինտերնետ')
            ->assertDontSee('private-photo.jpg')
            ->assertDontSee('Օդորակիչ')
            ->assertDontSee('Մշտական ջուր')
            ->assertDontSee('Արտաքին պատեր')
            ->assertDontSee('39/7')
            ->assertDontSee('Վերադարձ')
            ->assertDontSee('Գործակալ');
    }

    public function test_empty_building_and_amenity_sections_are_not_rendered(): void
    {
        DB::table('estate')->insert([
            'id' => 303,
            'market_type' => EstateMarketType::SECONDARY->value,
            'estate_status_id' => 1,
            'is_published' => true,
            'estate_type_id' => 1,
        ]);

        $this->get('/estates/303')
            ->assertOk()
            ->assertDontSee('Շենքի տվյալներ')
            ->assertDontSee('Կոմունալ հարմարություններ');
    }

    public function test_unpublished_estate_is_not_publicly_available(): void
    {
        DB::table('estate')->insert([
            'id' => 302,
            'market_type' => EstateMarketType::SECONDARY->value,
            'estate_status_id' => 3,
            'is_published' => false,
        ]);

        $this->get('/estates/302')->assertNotFound();
    }
}
