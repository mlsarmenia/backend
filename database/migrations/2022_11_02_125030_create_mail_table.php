<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('estate_id')->nullable();
            $table->integer('sender_id')->nullable();
            $table->dateTime('sending_date')->nullable();
            $table->string('subject', 245)->nullable();
            $table->string('body', 10000)->nullable();
            $table->integer('mail_to_contact_id')->nullable();
            $table->string('mail_to_email_address', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail');
    }
}
