<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstateDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estate_document', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('comment_arm', 500)->nullable();
            $table->string('comment_eng', 500)->nullable();
            $table->string('comment_ru', 500)->nullable();
            $table->string('comment_ar', 500)->nullable();
            $table->integer('document_type_id')->nullable();
            $table->integer('estate_id')->nullable();
            $table->string('path', 500)->nullable();
            $table->string('path_thumb', 500)->nullable();
            $table->string('file_name', 500)->nullable();
            $table->boolean('is_public')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estate_document');
    }
}
