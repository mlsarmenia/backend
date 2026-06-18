<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCEstateEmailTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_estate_email_type', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name_arm', 45)->nullable();
            $table->string('name_eng', 45)->nullable();
            $table->string('name_ru', 45)->nullable();
            $table->string('name_ar', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_estate_email_type');
    }
}
