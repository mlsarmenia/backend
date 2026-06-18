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
            $table->renameColumn('crm_project_id', 'b24_project_id');
            $table->renameColumn('crm_product_id', 'b24_product_id');
            $table->string('b24_stage_id', 20)->nullable()->after('b24_product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estate', function (Blueprint $table) {
            $table->dropColumn('b24_stage_id');
            $table->renameColumn('b24_project_id', 'crm_project_id');
            $table->renameColumn('b24_product_id', 'crm_product_id');
        });
    }
};
