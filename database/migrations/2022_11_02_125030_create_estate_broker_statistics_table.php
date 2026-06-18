<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstateBrokerStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estate_broker_statistics', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('estate_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('screened')->nullable();
            $table->integer('elected')->nullable();
            $table->integer('changed')->nullable();
            $table->date('created_date')->nullable();
            $table->integer('location_community_id')->nullable();
            $table->integer('location_city_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estate_broker_statistics');
    }
}
