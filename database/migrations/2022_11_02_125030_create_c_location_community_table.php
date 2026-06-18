<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCLocationCommunityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_location_community', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->boolean('is_deleted')->nullable();
            $table->date('last_modified_on')->nullable();
            $table->integer('version')->nullable();
            $table->integer('sort_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('name_arm', 500)->nullable();
            $table->string('name_eng', 500)->nullable();
            $table->string('name_ru', 500)->nullable();
            $table->string('name_ar', 500)->nullable();
            $table->integer('last_modified_by')->nullable();
            $table->string('comment', 250)->nullable();
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
        Schema::dropIfExists('c_location_community');
    }
}
