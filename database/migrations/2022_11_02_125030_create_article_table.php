<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('article_type_id')->nullable()->index('fk_article_type_id_idx');
            $table->string('title_arm')->nullable();
            $table->string('title_eng')->nullable();
            $table->string('title_ru')->nullable();
            $table->string('title_ar')->nullable();
            $table->text('content_arm')->nullable();
            $table->text('content_eng')->nullable();
            $table->text('content_ru')->nullable();
            $table->text('content_ar')->nullable();
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
            $table->string('metatitle_eng', 500)->nullable();
            $table->string('metatitle_arm', 500)->nullable();
            $table->string('metatitle_ru', 500)->nullable();
            $table->string('metatitle_ar', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article');
    }
}
