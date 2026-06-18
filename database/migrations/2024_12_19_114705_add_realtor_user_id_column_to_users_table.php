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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('realtor_user_id')->after('is_organization_admin')->nullable();

            $table->foreign('realtor_user_id')
                ->references('id')
                ->on('realtor_user')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['realtor_user_id']);
            $table->dropColumn('realtor_user_id');
        });
    }
};
