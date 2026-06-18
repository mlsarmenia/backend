<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('title_arm', 100)->nullable();
            $table->string('title_eng', 100)->nullable();
            $table->string('title_ru', 100)->nullable();
            $table->string('title_ar', 100)->nullable();
            $table->string('description_arm', 2000)->nullable();
            $table->string('description_eng', 2000)->nullable();
            $table->string('description_ru', 2000)->nullable();
            $table->string('description_ar', 2000)->nullable();
            $table->string('url')->nullable();
            $table->integer('user_id')->nullable()->index('fk_notification_user_id_idx');
            $table->dateTime('notified_date')->nullable();
            $table->boolean('is_viewed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification');
    }
}
