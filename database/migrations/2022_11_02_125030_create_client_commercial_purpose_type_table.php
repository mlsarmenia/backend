<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientCommercialPurposeTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_commercial_purpose_type', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('client_id', 45)->nullable();
            $table->string('commercial_purpose_type_id', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_commercial_purpose_type');
    }
}
