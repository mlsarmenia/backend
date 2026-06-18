<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('project');
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title_arm');
            $table->string('title_en')->nullable();
            $table->string('title_ru')->nullable();
            $table->text('content_arm')->nullable();
            $table->text('content_en')->nullable();
            $table->text('content_ru')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('community_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('pm_project_id')->nullable();
            $table->unsignedBigInteger('b24_project_id')->nullable();
            $table->string('featured_image')->nullable();
            $table->timestamps();

            $table->foreign('b24_project_id')
                ->references('id')
                ->on('b24_projects')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
