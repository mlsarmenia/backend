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
            $table->integer('room_count')->nullable();
            $table->integer('room_count_modified')->nullable();
            $table->integer('floor')->nullable();
            $table->integer('building_floor_count')->nullable();
            $table->float('area_total')->nullable();
            $table->float('price_amd')->nullable();
            $table->decimal('refund_percentage', 5, 2)->nullable();
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
    }

    public function test_published_estate_has_a_guest_accessible_page_with_only_public_information(): void
    {
        DB::table('estate')->insert([
            'id' => 301,
            'market_type' => EstateMarketType::SECONDARY->value,
            'estate_status_id' => 1,
            'is_published' => true,
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
            ->assertDontSee('private-photo.jpg')
            ->assertDontSee('39/7')
            ->assertDontSee('Վերադարձ')
            ->assertDontSee('Գործակալ');
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
