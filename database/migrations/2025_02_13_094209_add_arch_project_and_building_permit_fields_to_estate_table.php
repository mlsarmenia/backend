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
            $table->tinyInteger('arch_project_package')->default(0)->after('temporary_photos');
            $table->tinyInteger('arch_project')->default(0)->after('arch_project_package');
            $table->tinyInteger('building_permit')->default(0)->after('arch_project');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estate', function (Blueprint $table) {
            $table->dropColumn('arch_project_package');
            $table->dropColumn('arch_project');
            $table->dropColumn('building_permit');
        });
    }
};
