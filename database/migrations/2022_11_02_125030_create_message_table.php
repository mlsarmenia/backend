<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('recipient_id')->nullable()->index('RECIPIENT_ID');
            $table->integer('estate_id')->nullable();
            $table->string('sender_name')->nullable();
            $table->string('sender_email')->nullable();
            $table->string('sender_phone', 20)->nullable();
            $table->integer('message_type_id')->nullable();
            $table->integer('feedback_type_id')->nullable();
            $table->integer('service_id')->nullable();
            $table->integer('overall_rating')->nullable();
            $table->float('offering_price', 24, 0)->nullable();
            $table->integer('offering_currency_id')->nullable();
            $table->text('message_text')->nullable();
            $table->boolean('is_read')->nullable();
            $table->boolean('is_verified')->nullable();
            $table->dateTime('sent_on')->nullable();
            $table->string('ip_address', 15)->nullable();

            $table->index(['message_type_id', 'is_verified'], 'type_and_verified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message');
    }
}
