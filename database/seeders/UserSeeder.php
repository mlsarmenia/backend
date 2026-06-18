<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $userId = DB::table('users')->insertGetId([
            'name' => 'admin',
            'email' => 'mlsarmenia8@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $roleId = DB::table('roles')->insertGetId([
            'name' => 'Administrator',
            'guard_name' => 'web',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => $roleId,
            'model_type' => 'App\Models\User',
            'model_id' => $userId,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $permissionIds = DB::table('permissions')->pluck('id');
        $rolePermissions = $permissionIds->map(function ($permissionId) use ($roleId, $now) {
            return [
                'permission_id' => $permissionId,
                'role_id' => $roleId,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        })->toArray();

        DB::table('role_has_permissions')->insert($rolePermissions);
        Cache::forget('spatie.permission.cache');
    }
}
