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
        Schema::table('estate', function (Blueprint $table) {
            $table->longText('temporary_photos')->after('is_public_text_generation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estate', function (Blueprint $table) {
            $table->dropColumn('temporary_photos');
        });
    }
};
