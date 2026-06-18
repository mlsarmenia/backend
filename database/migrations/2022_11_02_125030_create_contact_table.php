<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->boolean('is_deleted')->nullable();
            $table->dateTime('last_modified_on')->nullable();
            $table->integer('version')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('organization')->nullable();
            $table->integer('contact_type_id')->nullable()->index('contact_type_id');
            $table->char('phone_mobile_1', 40)->nullable();
            $table->char('phone_mobile_2', 40)->nullable();
            $table->char('phone_office', 40)->nullable();
            $table->char('phone_home', 40)->nullable();
            $table->char('fax', 40)->nullable();
            $table->mediumText('comment_arm')->nullable();
            $table->mediumText('comment_eng')->nullable();
            $table->mediumText('comment_ru')->nullable();
            $table->mediumText('comment_ar')->nullable();
            $table->integer('last_modified_by')->nullable();
            $table->string('name_arm', 500)->nullable();
            $table->string('name_eng', 500)->nullable();
            $table->string('name_ru', 500)->nullable();
            $table->string('name_ar', 500)->nullable();
            $table->string('last_name_arm', 500)->nullable();
            $table->string('last_name_eng', 500)->nullable();
            $table->string('last_name_ru', 500)->nullable();
            $table->string('last_name_ar', 500)->nullable();
            $table->boolean('is_seller')->nullable();
            $table->boolean('is_buyer')->nullable()->index('IS_BUYER_index');
            $table->boolean('is_rent_owner')->nullable();
            $table->boolean('is_renter')->nullable()->index('IS_RENTER_index');
            $table->boolean('is_inner_agent')->nullable();
            $table->dateTime('created_on')->nullable();
            $table->integer('created_by')->nullable();
            $table->boolean('is_from_public')->nullable();
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
            $table->integer('contact_status_id')->nullable()->index('contact_status_id');
            $table->boolean('is_urgent')->nullable();
            $table->char('web_site', 60)->nullable();
            $table->char('phone_mobile_3', 40)->nullable();
            $table->char('phone_mobile_4', 40)->nullable();
            $table->char('viber', 40)->nullable();
            $table->char('whatsapp', 40)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact');
    }
}
