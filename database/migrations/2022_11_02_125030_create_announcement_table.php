<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('location_country_id')->nullable()->index('FK_ANNOUNCEMENT_C_LOCATION_COUNTRY');
            $table->integer('location_province_id')->nullable()->index('FK_ANNOUNCEMENT_C_LOCATION_PROVINCE');
            $table->integer('location_city_id')->nullable()->index('FK_ANNOUNCEMENT_C_LOCATION_CITY');
            $table->integer('location_community_id')->nullable()->index('FK_ANNOUNCEMENT_C_LOCATION_COMMUNITY');
            $table->integer('location_street_id')->nullable()->index('FK_ANNOUNCEMENT_C_LOCATION_STREET');
            $table->integer('estate_type_id')->nullable()->index('FK_ANNOUNCEMENT_C_ESTATE_TYPE');
            $table->float('area_total', 24, 1)->nullable();
            $table->float('old_price', 24, 0)->nullable();
            $table->float('price', 24, 0)->nullable();
            $table->integer('currency_id')->nullable()->index('FK_ANNOUNCEMENT_C_CURRENCY');
            $table->integer('seller_id')->nullable()->index('FK_ANNOUNCEMENT_C_CONTACT');
            $table->float('area_residential', 24, 1)->nullable();
            $table->integer('registered_right_id')->nullable()->index('FK_ANNOUNCEMENT_C_REGISTERED_RIGHTS');
            $table->integer('repairing_type_id')->nullable()->index('FK_ANNOUNCEMENT_BUILDING_C_REMONT_TYPE');
            $table->integer('room_count')->nullable();
            $table->integer('building_type_id')->nullable()->index('FK_ANNOUNCEMENT_BUILDING_C_BUILDING_TYPE');
            $table->integer('building_project_type_id')->nullable();
            $table->boolean('conditioner')->nullable();
            $table->integer('room_count_modified')->nullable();
            $table->integer('exterior_design_type_id')->nullable()->index('FK_ANNOUNCEMENT_HOUSE_C_EXTERIOR_DESIGN_TYPE');
            $table->integer('elevator_type_id')->nullable()->index('FK_ANNOUNCEMENT_BUILDING_C_ELEVATOR_TYPE');
            $table->integer('year_id')->nullable()->index('FK_ANNOUNCEMENT_BUILDING_C_YEAR');
            $table->integer('heating_system_type_id')->nullable()->index('FK_ANNOUNCEMENT_BUILDING_C_HEATING_SYSTEM_TYPE');
            $table->integer('parking_type_id')->nullable()->index('FK_ANNOUNCEMENT_BUILDING_C_PARKING_TYPE');
            $table->integer('service_fee_type_id')->nullable()->index('FK_ANNOUNCEMENT_BUILDING_C_SERVICE_FEE_TYPE');
            $table->float('service_amount', 24, 0)->nullable();
            $table->integer('service_amount_currency_id')->nullable();
            $table->boolean('furniture')->nullable();
            $table->boolean('kitchen_furniture')->nullable();
            $table->boolean('gas_heater')->nullable();
            $table->boolean('persistent_water')->nullable();
            $table->boolean('natural_gas')->nullable();
            $table->boolean('gas_possibility')->nullable();
            $table->boolean('internet')->nullable();
            $table->boolean('satellite_tv')->nullable();
            $table->boolean('cable_tv')->nullable();
            $table->boolean('sunny')->nullable();
            $table->boolean('exclusive_design')->nullable();
            $table->boolean('expanding_possible')->nullable();
            $table->boolean('open_balcony')->nullable();
            $table->boolean('oriel')->nullable();
            $table->boolean('new_wiring')->nullable();
            $table->boolean('new_water_tubes')->nullable();
            $table->boolean('heating_ground')->nullable();
            $table->boolean('plastic_windows')->nullable();
            $table->boolean('parquet')->nullable();
            $table->boolean('laminat')->nullable();
            $table->boolean('equipped')->nullable();
            $table->integer('roof_type_id')->nullable()->index('FK_ANNOUNCEMENT_HOUSE_C_ROOF_TYPE');
            $table->integer('floor_count_id')->nullable();
            $table->integer('house_building_type_id')->nullable()->index('FK_ANNOUNCEMENT_HOUSE_C_HOUSE_BUILDING_TYPE');
            $table->boolean('roof_repaired')->nullable();
            $table->integer('roof_material_type_id')->nullable()->index('FK_ANNOUNCEMENT_HOUSE_C_ROOF_MATERIAL_TYPE');
            $table->integer('fence_type_id')->nullable()->index('FK_ANNOUNCEMENT_LAND_C_FENCE_TYPE');
            $table->integer('communication_type_id')->nullable()->index('FK_ANNOUNCEMENT_HOUSE_C_COMMUNICATION');
            $table->integer('front_with_street_id')->nullable()->index('FK_ANNOUNCEMENT_LAND_C_FRONT_WITH_STREET');
            $table->integer('road_way_type_id')->nullable()->index('FK_ANNOUNCEMENT_LAND_C_ROAD_WAY_TYPE');
            $table->integer('commercial_purpose_type_id')->nullable();
            $table->integer('communication_id')->nullable()->index('FK_ANNOUNCEMENT_LAND_C_COMMUNICATION');
            $table->integer('land_structure_type_id')->nullable()->index('FK_ANNOUNCEMENT_LAND_C_LAND_STRUCTURE_TYPE');
            $table->integer('land_type_id')->nullable()->index('FK_ANNOUNCEMENT_LAND_C_LAND_TYPE');
            $table->integer('land_use_type_id')->nullable();
            $table->float('front_length', 24, 1)->nullable();
            $table->integer('version')->nullable();
            $table->string('address_building', 40)->nullable();
            $table->string('address_apartment', 40)->nullable();
            $table->integer('contract_type_id')->nullable();
            $table->integer('entrance_door_type_id')->nullable();
            $table->integer('entrance_door_position_id')->nullable();
            $table->integer('windows_view_id')->nullable();
            $table->integer('building_floor_count')->nullable();
            $table->integer('house_floors_type_id')->nullable();
            $table->boolean('roof_drainage')->nullable();
            $table->boolean('new_doors')->nullable();
            $table->boolean('new_windows')->nullable();
            $table->boolean('new_bathroom')->nullable();
            $table->boolean('new_floor')->nullable();
            $table->boolean('new_roof')->nullable();
            $table->boolean('can_be_used_as_commercial')->nullable();
            $table->boolean('is_published')->nullable();
            $table->integer('estate_status_id')->nullable();
            $table->date('status_changed_on')->nullable();
            $table->integer('status_id_before_archive')->nullable();
            $table->integer('buyer_id')->nullable();
            $table->integer('agent_id')->nullable();
            $table->float('selling_price_init', 24, 0)->nullable();
            $table->float('selling_price_final', 24, 0)->nullable();
            $table->integer('selling_price_final_currency_id')->nullable();
            $table->integer('selling_price_init_currency_id')->nullable();
            $table->dateTime('created_on')->nullable();
            $table->boolean('new_construction')->nullable();
            $table->integer('floor')->nullable();
            $table->mediumText('comment_arm')->nullable();
            $table->mediumText('comment_eng')->nullable();
            $table->mediumText('comment_ru')->nullable();
            $table->mediumText('comment_ar')->nullable();
            $table->integer('last_modified_by')->nullable();
            $table->mediumText('additional_info_arm')->nullable();
            $table->mediumText('additional_info_eng')->nullable();
            $table->mediumText('additional_info_ru')->nullable();
            $table->mediumText('additional_info_ar')->nullable();
            $table->mediumText('name_arm')->nullable();
            $table->mediumText('name_eng')->nullable();
            $table->mediumText('name_ru')->nullable();
            $table->mediumText('name_ar')->nullable();
            $table->mediumText('selling_comment_arm')->nullable();
            $table->mediumText('selling_comment_eng')->nullable();
            $table->mediumText('selling_comment_ru')->nullable();
            $table->mediumText('selling_comment_ar')->nullable();
            $table->dateTime('last_modified_on')->nullable();
            $table->integer('created_by')->nullable();
            $table->boolean('garage')->nullable();
            $table->boolean('cellar')->nullable();
            $table->boolean('land')->nullable();
            $table->boolean('niche')->nullable();
            $table->boolean('pantry')->nullable();
            $table->boolean('jacuzzi')->nullable();
            $table->boolean('possible_extension')->nullable();
            $table->boolean('separate_room')->nullable();
            $table->boolean('exchange')->nullable();
            $table->boolean('has_intercom')->nullable();
            $table->boolean('uninhabited')->nullable();
            $table->boolean('balcony')->nullable();
            $table->boolean('tv')->nullable();
            $table->boolean('computer')->nullable();
            $table->boolean('refrigirator')->nullable();
            $table->boolean('hot_water')->nullable();
            $table->boolean('washer')->nullable();
            $table->boolean('dish_washer')->nullable();
            $table->integer('property_agent_id')->nullable();
            $table->string('code', 45)->nullable();
            $table->dateTime('appointment_date_start')->nullable();
            $table->dateTime('appointment_date_end')->nullable();
            $table->string('appointment_comment_arm', 1000)->nullable();
            $table->string('appointment_comment_eng', 1000)->nullable();
            $table->string('appointment_comment_ru', 1000)->nullable();
            $table->string('appointment_comment_ar', 1000)->nullable();
            $table->integer('ceiling_height_type_id')->nullable();
            $table->integer('building_structure_type_id')->nullable();
            $table->integer('building_floor_type_id')->nullable();
            $table->integer('vitrage_type_id')->nullable();
            $table->integer('separate_entrance_type_id')->nullable();
            $table->string('intercom', 45)->nullable();
            $table->integer('filled_by')->nullable();
            $table->dateTime('filled_on')->nullable();
            $table->integer('verified_by')->nullable();
            $table->dateTime('verified_on')->nullable();
            $table->integer('entrance_type_id')->nullable();
            $table->boolean('has_neighbour')->nullable();
            $table->boolean('is_advertised')->nullable();
            $table->integer('info_source_id')->nullable();
            $table->float('price_usd', 24, 0)->nullable();
            $table->date('archive_till_date')->nullable();
            $table->mediumText('archive_comment_arm')->nullable();
            $table->mediumText('archive_comment_eng')->nullable();
            $table->mediumText('archive_comment_ru')->nullable();
            $table->mediumText('archive_comment_ar')->nullable();
            $table->mediumText('public_text_arm')->nullable();
            $table->mediumText('public_text_eng')->nullable();
            $table->mediumText('public_text_rus')->nullable();
            $table->double('estate_latitude')->nullable();
            $table->double('estate_longitude')->nullable();
            $table->boolean('is_urgent')->nullable();
            $table->date('urgent_start_date')->nullable();
            $table->boolean('is_exchangeable')->nullable();
            $table->boolean('is_first_floor')->nullable();
            $table->boolean('is_last_floor')->nullable();
            $table->string('main_image_file_name', 245)->nullable();
            $table->string('main_image_file_path', 245)->nullable();
            $table->string('main_image_file_path_thumb', 245)->nullable();
            $table->boolean('is_mansard_floor')->nullable();
            $table->boolean('is_duplex')->nullable();
            $table->boolean('is_basement')->nullable();
            $table->integer('visits_count')->nullable();
            $table->boolean('is_from_public')->nullable();
            $table->boolean('is_hot_offer')->nullable();
            $table->date('hot_offer_start_date')->nullable();
            $table->boolean('is_on_main_page')->nullable();
            $table->date('on_main_page_start_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcement');
    }
}
