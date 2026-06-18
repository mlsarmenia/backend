<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('estate_document')->whereNull('estate_id')->delete();

        $subQuery = DB::table('estate_document')
            ->selectRaw('MAX(id) as id')
            ->from('estate_document')
            ->groupBy('estate_id', 'path');

        DB::table('estate_document')
            ->whereNotIn('id', function (Builder $query) use ($subQuery) {
                $query->select('id')
                    ->fromSub($subQuery, 'unique_rows');
            })
            ->delete();

        Schema::table('estate_document', function (Blueprint $table) {
            $table->unique(['estate_id', 'path'], 'estate_document_estate_id_path_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estate_document', function (Blueprint $table) {
            $table->dropIndex('estate_document_estate_id_path_index');
        });
    }
};
