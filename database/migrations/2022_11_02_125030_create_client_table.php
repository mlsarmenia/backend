<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('contact_id')->nullable()->index('contact_id');
            $table->integer('version')->nullable();
            $table->integer('estate_type_id')->nullable();
            $table->integer('estate_contract_type_id')->nullable();
            $table->integer('location_province_id')->nullable();
            $table->integer('location_city_id')->nullable();
            $table->integer('location_community_id')->nullable();
            $table->integer('location_street_id')->nullable();
            $table->integer('currency_id')->nullable();
            $table->float('price_from', 30, 3)->nullable();
            $table->float('price_from_usd', 24, 0)->nullable();
            $table->float('price_to', 30, 3)->nullable();
            $table->float('price_to_usd', 24, 0)->nullable();
            $table->float('area_from', 30, 3)->nullable();
            $table->float('area_to', 30, 3)->nullable();
            $table->integer('room_count_from')->nullable();
            $table->integer('room_count_to')->nullable();
            $table->integer('building_type_id')->nullable();
            $table->integer('repairing_type_id')->nullable();
            $table->boolean('new_construction')->nullable();
            $table->integer('broker_id')->nullable();
            $table->integer('info_source_id')->nullable();
            $table->string('location_building', 145)->nullable();
            $table->integer('contact_status_id')->nullable();
            $table->dateTime('status_changed_on')->nullable();
            $table->boolean('is_urgent')->nullable();
            $table->dateTime('archive_till_date')->nullable();
            $table->string('archive_comment', 450)->nullable();
            $table->boolean('is_from_public')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client');
    }
}
