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
            $table->string('apartment_code', 30)->nullable()->after('crm_product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estate', function (Blueprint $table) {
            $table->dropColumn('apartment_code');
        });
    }
};
