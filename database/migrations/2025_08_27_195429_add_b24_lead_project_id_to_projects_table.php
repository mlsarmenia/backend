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
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('b24_lead_project_id')->nullable()->after('b24_project_id');
            $table->unsignedBigInteger('b24_contact_project_id')->nullable()->after('b24_lead_project_id');
            $table->foreign('b24_lead_project_id')
                ->references('id')
                ->on('b24_lead_projects')
                ->onDelete('set null');
            $table->foreign('b24_contact_project_id')
                ->references('id')
                ->on('b24_contact_projects')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['b24_lead_project_id']);
            $table->dropForeign(['b24_contact_project_id']);
            $table->dropColumn(['b24_lead_project_id', 'b24_contact_project_id']);
        });
    }
};
