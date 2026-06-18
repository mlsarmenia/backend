<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCDailyPriceInAmdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_daily_price_in_amd', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->boolean('is_deleted')->nullable();
            $table->date('last_modified_on')->nullable();
            $table->integer('version')->nullable();
            $table->char('sort_id', 20)->nullable();
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
        Schema::dropIfExists('c_daily_price_in_amd');
    }
}
