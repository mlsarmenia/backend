<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAnnouncementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('announcement', function (Blueprint $table) {
            $table->foreign(['CURRENCY_ID'], 'FK_ANNOUNCEMENT_C_CURRENCY')->references(['ID'])->on('c_currency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['COMMUNICATION_ID'], 'FK_ANNOUNCEMENT_LAND_C_COMMUNICATION')->references(['ID'])->on('c_communication_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['EXTERIOR_DESIGN_TYPE_ID'], 'FK_ANNOUNCEMENT_HOUSE_C_EXTERIOR_DESIGN_TYPE')->references(['ID'])->on('c_exterior_design_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['ELEVATOR_TYPE_ID'], 'FK_ANNOUNCEMENT_BUILDING_C_ELEVATOR_TYPE')->references(['ID'])->on('c_elevator_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['LOCATION_CITY_ID'], 'FK_ANNOUNCEMENT_C_LOCATION_CITY')->references(['ID'])->on('c_location_city')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['FRONT_WITH_STREET_ID'], 'FK_ANNOUNCEMENT_LAND_C_FRONT_WITH_STREET')->references(['ID'])->on('c_front_with_street')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['PARKING_TYPE_ID'], 'FK_ANNOUNCEMENT_BUILDING_C_PARKING_TYPE')->references(['ID'])->on('c_parking_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['FRONT_WITH_STREET_ID'], 'FK_ANNOUNCEMENT_HOUSE_C_FRONT_WITH_STREET')->references(['ID'])->on('c_front_with_street')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['LOCATION_COUNTRY_ID'], 'FK_ANNOUNCEMENT_C_LOCATION_COUNTRY')->references(['ID'])->on('c_location_country')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['LAND_TYPE_ID'], 'FK_ANNOUNCEMENT_LAND_C_LAND_TYPE')->references(['ID'])->on('c_land_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['SERVICE_FEE_TYPE_ID'], 'FK_ANNOUNCEMENT_BUILDING_C_SERVICE_FEE_TYPE')->references(['ID'])->on('c_service_fee_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['ROAD_WAY_TYPE_ID'], 'FK_ANNOUNCEMENT_HOUSE_C_ROAD_WAY_TYPE')->references(['ID'])->on('c_road_way_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['LOCATION_STREET_ID'], 'FK_ANNOUNCEMENT_C_LOCATION_STREET')->references(['ID'])->on('c_location_street')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['SELLER_ID'], 'FK_ANNOUNCEMENT_C_CONTACT')->references(['ID'])->on('contact')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['ROOF_TYPE_ID'], 'FK_ANNOUNCEMENT_HOUSE_C_ROOF_TYPE')->references(['ID'])->on('c_roof_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['COMMUNICATION_TYPE_ID'], 'FK_ANNOUNCEMENT_HOUSE_C_COMMUNICATION')->references(['ID'])->on('c_communication_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['BUILDING_TYPE_ID'], 'FK_ANNOUNCEMENT_BUILDING_C_BUILDING_TYPE')->references(['ID'])->on('c_building_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['ESTATE_TYPE_ID'], 'FK_ANNOUNCEMENT_C_ESTATE_TYPE')->references(['ID'])->on('c_estate_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['FENCE_TYPE_ID'], 'FK_ANNOUNCEMENT_LAND_C_FENCE_TYPE')->references(['ID'])->on('c_fence_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['HEATING_SYSTEM_TYPE_ID'], 'FK_ANNOUNCEMENT_BUILDING_C_HEATING_SYSTEM_TYPE')->references(['ID'])->on('c_heating_system_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['FENCE_TYPE_ID'], 'FK_ANNOUNCEMENT_HOUSE_C_FENCE_TYPE')->references(['ID'])->on('c_fence_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['LOCATION_COMMUNITY_ID'], 'FK_ANNOUNCEMENT_C_LOCATION_COMMUNITY')->references(['ID'])->on('c_location_community')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['LAND_STRUCTURE_TYPE_ID'], 'FK_ANNOUNCEMENT_LAND_C_LAND_STRUCTURE_TYPE')->references(['ID'])->on('c_land_structure_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['REPAIRING_TYPE_ID'], 'FK_ANNOUNCEMENT_BUILDING_C_REMONT_TYPE')->references(['ID'])->on('c_repairing_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['HOUSE_BUILDING_TYPE_ID'], 'FK_ANNOUNCEMENT_HOUSE_C_HOUSE_BUILDING_TYPE')->references(['ID'])->on('c_house_building_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['LOCATION_PROVINCE_ID'], 'FK_ANNOUNCEMENT_C_LOCATION_PROVINCE')->references(['ID'])->on('c_location_province')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['ROAD_WAY_TYPE_ID'], 'FK_ANNOUNCEMENT_LAND_C_ROAD_WAY_TYPE')->references(['ID'])->on('c_road_way_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['YEAR_ID'], 'FK_ANNOUNCEMENT_BUILDING_C_YEAR')->references(['ID'])->on('c_year')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['ROOF_MATERIAL_TYPE_ID'], 'FK_ANNOUNCEMENT_HOUSE_C_ROOF_MATERIAL_TYPE')->references(['ID'])->on('c_roof_material_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['REGISTERED_RIGHT_ID'], 'FK_ANNOUNCEMENT_C_REGISTERED_RIGHTS')->references(['ID'])->on('c_registered_right')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('announcement', function (Blueprint $table) {
            $table->dropForeign('FK_ANNOUNCEMENT_C_CURRENCY');
            $table->dropForeign('FK_ANNOUNCEMENT_LAND_C_COMMUNICATION');
            $table->dropForeign('FK_ANNOUNCEMENT_HOUSE_C_EXTERIOR_DESIGN_TYPE');
            $table->dropForeign('FK_ANNOUNCEMENT_BUILDING_C_ELEVATOR_TYPE');
            $table->dropForeign('FK_ANNOUNCEMENT_C_LOCATION_CITY');
            $table->dropForeign('FK_ANNOUNCEMENT_LAND_C_FRONT_WITH_STREET');
            $table->dropForeign('FK_ANNOUNCEMENT_BUILDING_C_PARKING_TYPE');
            $table->dropForeign('FK_ANNOUNCEMENT_HOUSE_C_FRONT_WITH_STREET');
            $table->dropForeign('FK_ANNOUNCEMENT_C_LOCATION_COUNTRY');
            $table->dropForeign('FK_ANNOUNCEMENT_LAND_C_LAND_TYPE');
            $table->dropForeign('FK_ANNOUNCEMENT_BUILDING_C_SERVICE_FEE_TYPE');
            $table->dropForeign('FK_ANNOUNCEMENT_HOUSE_C_ROAD_WAY_TYPE');
            $table->dropForeign('FK_ANNOUNCEMENT_C_LOCATION_STREET');
            $table->dropForeign('FK_ANNOUNCEMENT_C_CONTACT');
            $table->dropForeign('FK_ANNOUNCEMENT_HOUSE_C_ROOF_TYPE');
            $table->dropForeign('FK_ANNOUNCEMENT_HOUSE_C_COMMUNICATION');
            $table->dropForeign('FK_ANNOUNCEMENT_BUILDING_C_BUILDING_TYPE');
            $table->dropForeign('FK_ANNOUNCEMENT_C_ESTATE_TYPE');
            $table->dropForeign('FK_ANNOUNCEMENT_LAND_C_FENCE_TYPE');
            $table->dropForeign('FK_ANNOUNCEMENT_BUILDING_C_HEATING_SYSTEM_TYPE');
            $table->dropForeign('FK_ANNOUNCEMENT_HOUSE_C_FENCE_TYPE');
            $table->dropForeign('FK_ANNOUNCEMENT_C_LOCATION_COMMUNITY');
            $table->dropForeign('FK_ANNOUNCEMENT_LAND_C_LAND_STRUCTURE_TYPE');
            $table->dropForeign('FK_ANNOUNCEMENT_BUILDING_C_REMONT_TYPE');
            $table->dropForeign('FK_ANNOUNCEMENT_HOUSE_C_HOUSE_BUILDING_TYPE');
            $table->dropForeign('FK_ANNOUNCEMENT_C_LOCATION_PROVINCE');
            $table->dropForeign('FK_ANNOUNCEMENT_LAND_C_ROAD_WAY_TYPE');
            $table->dropForeign('FK_ANNOUNCEMENT_BUILDING_C_YEAR');
            $table->dropForeign('FK_ANNOUNCEMENT_HOUSE_C_ROOF_MATERIAL_TYPE');
            $table->dropForeign('FK_ANNOUNCEMENT_C_REGISTERED_RIGHTS');
        });
    }
}
