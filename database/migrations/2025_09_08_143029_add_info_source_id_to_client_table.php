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
        Schema::table('client', function (Blueprint $table) {
            $table->unsignedBigInteger('info_source_id')->nullable()->after('referral_id');
            $table->foreign('info_source_id')
                ->references('id')
                ->on('b24_info_sources')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client', function (Blueprint $table) {
            $table->dropForeign(['info_source_id']);
            $table->dropColumn('info_source_id');
        });
    }
};
