<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCMessageTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_message_type', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('sort_id')->nullable();
            $table->string('name_arm')->nullable();
            $table->string('name_eng')->nullable();
            $table->string('name_ru')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('comment')->nullable();
            $table->boolean('is_deleted')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('created_on')->nullable();
            $table->integer('last_modified_by')->nullable();
            $table->dateTime('last_modified_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_message_type');
    }
}
