<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstateRentContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estate_rent_contract', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('estate_id')->nullable()->index('ESTATE_ID');
            $table->float('initial_price', 24, 0)->nullable();
            $table->integer('initial_price_currency_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('renter_id')->nullable();
            $table->integer('agent_id')->nullable();
            $table->float('final_price', 24, 0)->nullable();
            $table->integer('final_price_currency_id')->nullable();
            $table->integer('index_col')->nullable();
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
        Schema::dropIfExists('estate_rent_contract');
    }
}
