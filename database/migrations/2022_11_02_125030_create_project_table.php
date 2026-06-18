<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('code', 45)->nullable();
            $table->integer('estate_type_id')->nullable();
            $table->integer('project_type_id')->nullable();
            $table->string('name_arm', 500)->nullable();
            $table->string('name_eng', 500)->nullable();
            $table->string('name_ru', 500)->nullable();
            $table->string('name_ar', 500)->nullable();
            $table->string('description_arm', 500)->nullable();
            $table->string('description_eng', 500)->nullable();
            $table->string('description_ru', 500)->nullable();
            $table->string('description_ar', 500)->nullable();
            $table->string('main_photo_name', 500)->nullable();
            $table->string('main_photo_path', 500)->nullable();
            $table->string('main_photo_thumb_path', 500)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('updated_on')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project');
    }
}
