<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_request', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('announcement_id')->nullable()->index('announcement_idx');
            $table->integer('requester_id')->nullable()->index('requester_idx');
            $table->string('confirm_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcement_request');
    }
}
