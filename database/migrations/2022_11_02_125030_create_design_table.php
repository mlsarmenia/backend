<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('design_room_id')->nullable()->index('fk_design_room_id_idx');
            $table->integer('design_room_type_id')->nullable()->index('fk_design_room_type_id_idx');
            $table->integer('design_color_id')->nullable()->index('fk_design_design_color_id_idx');
            $table->integer('design_style_id')->nullable()->index('fk_design_design_style_id_idx');
            $table->integer('design_price_id')->nullable()->index('fk_design_design_price_id_idx');
            $table->string('title_arm')->nullable();
            $table->string('title_eng')->nullable();
            $table->string('title_ru')->nullable();
            $table->string('title_ar')->nullable();
            $table->text('comment_arm')->nullable();
            $table->text('comment_eng')->nullable();
            $table->text('comment_ru')->nullable();
            $table->text('comment_ar')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('created_on')->nullable();
            $table->integer('last_modified_by')->nullable();
            $table->dateTime('last_modified_on')->nullable();
            $table->string('main_image_file_name', 245)->nullable();
            $table->string('main_image_file_path', 245)->nullable();
            $table->string('main_image_file_path_thumb', 245)->nullable();
            $table->boolean('is_published')->nullable();
            $table->boolean('is_approved')->nullable();
            $table->integer('view_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('design');
    }
}
