<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstateStructureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estate_structure', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('estate_id')->nullable();
            $table->float('area', 24, 0)->nullable();
            $table->integer('structure_type_id')->nullable();
            $table->string('comment_arm', 500)->nullable();
            $table->string('comment_eng', 500)->nullable();
            $table->string('comment_ru', 500)->nullable();
            $table->string('comment_ar', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estate_structure');
    }
}
