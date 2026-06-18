<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCEvaluationBuildingTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_evaluation_building_type', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name_arm', 100)->nullable();
            $table->string('name_eng', 100)->nullable();
            $table->string('name_ru', 100)->nullable();
            $table->string('name_ar', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_evaluation_building_type');
    }
}
