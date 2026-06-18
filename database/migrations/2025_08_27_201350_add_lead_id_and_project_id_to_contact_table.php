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
        Schema::table('contact', function (Blueprint $table) {
            $table->unsignedBigInteger('b24_lead_id')->nullable()->after('created_by');
            $table->unsignedBigInteger('project_id')->nullable()->after('b24_contact_id');
            $table->unsignedBigInteger('b24_lead_project_id')->nullable()->after('project_id');
            $table->unsignedBigInteger('b24_contact_project_id')->nullable()->after('b24_lead_project_id');

            $table->unique('b24_lead_id');
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropUnique(['b24_lead_id']);
            $table->dropColumn(['b24_lead_id', 'project_id', 'b24_lead_project_id', 'b24_contact_project_id']);
        });
    }
};
