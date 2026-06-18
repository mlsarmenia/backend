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
        Schema::table('c_evaluation_project_and_micro_district', function (Blueprint $table) {
            $table->decimal('coefficient', 10, 0)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('c_evaluation_project_and_micro_district', function (Blueprint $table) {
            $table->decimal('coefficient', 6, 0)->nullable()->change();
        });
    }
};
