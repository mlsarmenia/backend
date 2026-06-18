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
        Schema::create('c_evaluation_project_and_micro_district', function (Blueprint $table) {
            $table->id();
            $table->string('name_arm', 45)->nullable();
            $table->string('name_eng', 45)->nullable();
            $table->string('name_ru', 45)->nullable();
            $table->decimal('coefficient', 6, 0)->nullable();
            $table->integer('c_evaluation_location_id')->nullable();
            $table->timestamps();

            $table->foreign('c_evaluation_location_id', 'project_and_micro_district_location_id_foreign')
                ->references('id')
                ->on('c_evaluation_location')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('c_evaluation_project_and_micro_district', function (Blueprint $table) {
            $table->dropForeign('project_and_micro_district_location_id_foreign');
        });
        Schema::dropIfExists('c_evaluation_project_and_micro_district');
    }
};
