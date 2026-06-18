<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealtorUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realtor_user_role', function (Blueprint $table) {
            $table->integer('user_id')->nullable()->index('FK_USER_ROLE_USER');
            $table->integer('role_id')->nullable()->index('FK_USER_ROLE_ROLE');
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
        Schema::dropIfExists('realtor_user_role');
    }
}
