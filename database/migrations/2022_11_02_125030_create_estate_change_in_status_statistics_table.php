<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstateChangeInStatusStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estate_change_in_status_statistics', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('estate_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('visit_count')->nullable();
            $table->date('created_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estate_change_in_status_statistics');
    }
}
