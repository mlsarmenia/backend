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
        $estatePermissions = [
            'Create Estate',
            'View Estate',
            'Edit Estate',
            'Delete Estate',
        ];
        $contactPermissions = [
            'Create Contact',
            'View Contact',
            'Edit Contact',
            'Delete Contact',
        ];
        $professionalPermissions = [
            'Create Professional',
            'View Professional',
            'Edit Professional',
            'Delete Professional',
        ];
        $messagePermissions = [
            'Create Message',
            'View Message',
            'Edit Message',
            'Delete Message',
        ];
        $locationPermissions = [
            'Create Location',
            'View Location',
            'Edit Location',
            'Delete Location',
        ];
        $userPermissions = [
            'Create User',
            'View User',
            'Edit User',
            'Delete User',
        ];
        $articlePermissions = [
            'Create Article',
            'View Article',
            'Edit Article',
            'Delete Article',
        ];
        $activityPermissions = [
            'View Activity',
        ];
        $settingsPermissions = [
            'Create Settings',
            'View Settings',
            'Edit Settings',
            'Delete Settings',
        ];
        $permissions = [
            ...$estatePermissions,
            ...$contactPermissions,
            ...$professionalPermissions,
            ...$messagePermissions,
            ...$locationPermissions,
            ...$userPermissions,
            ...$articlePermissions,
            ...$activityPermissions,
            ...$settingsPermissions,
        ];
        $data = [];
        foreach ($permissions as $permission) {
            $data[] = [
                'name' => $permission,
                'guard_name' => 'web',
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('permissions')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('permissions')->delete();
    }
};
