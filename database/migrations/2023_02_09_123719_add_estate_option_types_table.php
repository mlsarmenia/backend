<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estate_option_types', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name_arm')->nullable();
            $table->string('name_eng')->nullable();
            $table->string('name_ru')->nullable();
            $table->integer('estate_type')->constrained('c_estate_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estate_option_types');
    }
};
