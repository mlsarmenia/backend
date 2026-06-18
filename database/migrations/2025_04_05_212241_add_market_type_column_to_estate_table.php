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
            $table->unsignedTinyInteger('market_type')->default(2)->after('estate_type_id');
            $table->boolean('is_company_project')->default(false)->after('market_type');
            $table->unsignedBigInteger('crm_project_id')->nullable()->after('is_company_project');
            $table->unsignedBigInteger('crm_product_id')
                ->nullable()
                ->unique('estate_crm_product_id_unique')
                ->after('crm_project_id');
            $table->unsignedBigInteger('primary_market_product_id')
                ->nullable()
                ->unique('estate_primary_market_product_id_unique')
                ->after('crm_product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estate', function (Blueprint $table) {
            $table->dropUnique(['crm_product_id']);
            $table->dropUnique(['primary_market_product_id']);
            $table->dropColumn([
                'market_type',
                'is_company_project',
                'crm_project_id',
                'crm_product_id',
                'primary_market_product_id',
            ]);
        });
    }
};
