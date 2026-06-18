<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDesignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('design', function (Blueprint $table) {
            $table->foreign(['DESIGN_PRICE_ID'], 'fk_design_price_id')->references(['ID'])->on('c_design_price')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['DESIGN_ROOM_TYPE_ID'], 'fk_design_room_type_id')->references(['ID'])->on('c_design_room_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['DESIGN_COLOR_ID'], 'fk_design_color_id')->references(['ID'])->on('c_design_color')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['DESIGN_ROOM_ID'], 'fk_design_room_id')->references(['ID'])->on('c_design_room')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['DESIGN_STYLE_ID'], 'fk_design_style_id')->references(['ID'])->on('c_design_style')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('design', function (Blueprint $table) {
            $table->dropForeign('fk_design_price_id');
            $table->dropForeign('fk_design_room_type_id');
            $table->dropForeign('fk_design_color_id');
            $table->dropForeign('fk_design_room_id');
            $table->dropForeign('fk_design_style_id');
        });
    }
}
