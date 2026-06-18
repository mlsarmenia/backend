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
        Schema::table('article', function (Blueprint $table) {
            $table->dropForeign('fk_article_type_id');
        });
        Schema::dropIfExists('article');
        Schema::dropIfExists('c_article_type');

        $permissions = [
            'Create Article',
            'View Article',
            'Edit Article',
            'Delete Article',
        ];
        DB::table('permissions')->whereIn('name', $permissions)->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
