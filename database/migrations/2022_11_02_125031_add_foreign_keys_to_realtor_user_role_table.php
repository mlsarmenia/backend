<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRealtorUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('realtor_user_role', function (Blueprint $table) {
            $table->foreign(['USER_ID'], 'FK_USER_ROLE_USER')->references(['ID'])->on('realtor_user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('realtor_user_role', function (Blueprint $table) {
            $table->dropForeign('FK_USER_ROLE_USER');
        });
    }
}
