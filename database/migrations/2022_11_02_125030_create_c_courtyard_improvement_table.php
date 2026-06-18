<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCCourtyardImprovementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_courtyard_improvement', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->char('sort_id', 20)->nullable();
            $table->string('name_arm', 100)->nullable();
            $table->string('name_eng', 100)->nullable();
            $table->string('name_ru', 100)->nullable();
            $table->string('name_ar', 100)->nullable();
            $table->date('last_modified_on')->nullable();
            $table->integer('last_modified_by')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('created_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_courtyard_improvement');
    }
}
