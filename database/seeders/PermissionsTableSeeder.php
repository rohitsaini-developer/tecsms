<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'name'          => 'permission_create',
                'guard_name'    => 'web',
            ],
            [
                'name'          => 'permission_edit',
                'guard_name'    => 'web',
            ],
            [
                'name'          => 'permission_show',
                'guard_name'    => 'web',
            ],
            [
                'name'          => 'permission_delete',
                'guard_name'    => 'web',
            ],
            [
                'name'          => 'permission_access',
                'guard_name'    => 'web',
            ],
            [
                'name'          => 'role_create',
                'guard_name'    => 'web',
            ],
            [
                'name'          => 'role_edit',
                'guard_name'    => 'web',
            ],
            [
                'name'          => 'role_show',
                'guard_name'    => 'web',
            ],
            [
                'name'      => 'role_delete',
                'guard_name'    => 'web',
            ],
            [
                'name'      => 'role_access',
                'guard_name'    => 'web',
            ],
        ];
        Permission::insert($permissions);
    }
}
