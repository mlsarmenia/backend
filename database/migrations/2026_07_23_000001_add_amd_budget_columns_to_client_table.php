<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('client', function (Blueprint $table) {
            $table->double('price_from_amd')->nullable()->after('price_from_usd');
            $table->double('price_to_amd')->nullable()->after('price_to_usd');
        });

        // Legacy budgets have no currency and production values are stored at AMD scale.
        DB::table('client')
            ->whereNull('currency_id')
            ->update([
                'price_from_amd' => DB::raw('price_from'),
                'price_to_amd' => DB::raw('price_to'),
            ]);
    }

    public function down(): void
    {
        Schema::table('client', function (Blueprint $table) {
            $table->dropColumn(['price_from_amd', 'price_to_amd']);
        });
    }
};
