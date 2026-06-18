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
        $this->enableTimestampsForAllTables();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->disableTimestampsForAllTables();
    }

    /**
     * Enable timestamps for all tables.
     *
     * @return void
     */
    private function enableTimestampsForAllTables()
    {
        $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();

        foreach ($tables as $table) {
            if (!Schema::hasColumn($table, 'created_at')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->timestamps();
                });
            }
        }
    }

    /**
     * Disable timestamps for all tables.
     *
     * @return void
     */
    private function disableTimestampsForAllTables()
    {
        $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();

        foreach ($tables as $table) {
            if (Schema::hasColumn($table, 'created_at')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropTimestamps();
                });
            }
        }
    }
};
