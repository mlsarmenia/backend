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
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name_arm', 20);
            $table->string('name_eng', 20);
            $table->string('name_ru', 20);
            $table->string('surname_arm', 20);
            $table->string('surname_eng', 20);
            $table->string('surname_ru', 20);
            $table->string('title_arm', 80);
            $table->string('title_eng', 80);
            $table->string('title_ru', 80);
            $table->string('image', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
