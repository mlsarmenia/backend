<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $now = Carbon::now();
        $permissions = [
            'Create Evaluation',
            'View Evaluation',
            'Edit Evaluation',
            'Delete Evaluation',
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
            'Create Evaluation',
            'View Evaluation',
            'Edit Evaluation',
            'Delete Evaluation',
        ];

        DB::table('permissions')->whereIn('name', $permissions)->delete();
    }
};
