<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionalProfessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_profession', function (Blueprint $table) {
            $table->integer('user_id')->nullable()->index('FK_PROFESSIONAL_USER');
            $table->integer('profession_id')->nullable()->index('FK_PROFESSIONAL_PROFESSION');
            $table->integer('id')->primary();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professional_profession');
    }
}
