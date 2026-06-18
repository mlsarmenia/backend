<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCDesignRoomTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('c_design_room_type', function (Blueprint $table) {
            $table->foreign(['PARENT_ID'], 'fk_parent_id')->references(['ID'])->on('c_design_room')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('c_design_room_type', function (Blueprint $table) {
            $table->dropForeign('fk_parent_id');
        });
    }
}
