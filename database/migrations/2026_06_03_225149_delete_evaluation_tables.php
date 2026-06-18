<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('c_evaluation_project_and_micro_district', function (Blueprint $table) {
            $table->dropForeign('project_and_micro_district_location_id_foreign');
        });
        Schema::dropIfExists('c_evaluation_location');
        Schema::dropIfExists('c_evaluation_project_and_micro_district');
        Schema::dropIfExists('c_evaluation_building_project');
        Schema::dropIfExists('c_evaluation_building_area');
        Schema::dropIfExists('c_evaluation_courtyard_improvement');
        Schema::dropIfExists('c_evaluation_distance_public_objects');
        Schema::dropIfExists('c_evaluation_building_floor');
        Schema::dropIfExists('c_evaluation_last_floor_availability');
        Schema::dropIfExists('c_evaluation_building_window_count');
        Schema::dropIfExists('c_evaluation_building_window_position');
        Schema::dropIfExists('c_evaluation_layout_room');
        Schema::dropIfExists('c_evaluation_balcony_available');
        Schema::dropIfExists('c_evaluation_interior_design');
        Schema::dropIfExists('c_evaluation_external_design');
        Schema::dropIfExists('c_evaluation_sun_orientation');
        Schema::dropIfExists('c_evaluation_building_type');
        Schema::dropIfExists('c_evaluation_location_type');

        $permissions = [
            'Create Evaluation',
            'View Evaluation',
            'Edit Evaluation',
            'Delete Evaluation',
        ];
        DB::table('permissions')->whereIn('name', $permissions)->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
