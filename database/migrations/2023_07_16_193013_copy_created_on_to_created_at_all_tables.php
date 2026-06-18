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
        $tables = DB::select('SHOW TABLES');

        foreach ($tables as $table) {
            $tableName = reset($table);

            if (Schema::hasColumn($tableName, 'created_on') && Schema::hasColumn($tableName, 'created_at')) {
                DB::statement("UPDATE $tableName SET created_at = created_on");
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('created_at_all_tables', function (Blueprint $table) {
            //
        });
    }
};
