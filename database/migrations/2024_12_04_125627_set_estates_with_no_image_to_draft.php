<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const STATUS_DRAFT = 1;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('estate')
            ->whereNull('main_image_file_path')
            ->whereNot('estate_status_id', self::STATUS_DRAFT)
            ->update(['estate_status_id' => self::STATUS_DRAFT]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
