<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $now = Carbon::now();
        $permissions = [
            'Create Project',
            'View Project',
            'Edit Project',
            'Delete Project',
        ];

        foreach ($permissions as $permission) {
            $data[] = [
                'name' => $permission,
                'guard_name' => 'web',
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('permissions')->insert($data);
        Cache::forget('spatie.permission.cache');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $permissions = [
            'Create Project',
            'View Project',
            'Edit Project',
            'Delete Project',
        ];

        DB::table('permissions')->whereIn('name', $permissions)->delete();
    }
};
