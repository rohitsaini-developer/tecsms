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
                'name'            => 'permission-browse',
                'guard_name'      => 'web',
                'controller_name' => 'permissions',
                'function_name'   => 'index',
                'route_name'      => 'permissions'
            ],
            [
                'name'            => 'permission-add',
                'guard_name'      => 'web',
                'controller_name' => 'permissions',
                'function_name'   => 'create',
                'route_name'      => 'permissions'
            ],
            [
                'name'            => 'permission-store',
                'guard_name'      => 'web',
                'controller_name' => 'permissions',
                'function_name'   => 'store',
                'route_name'      => 'permissions'
            ],
            [
                'name'            => 'permission-edit',
                'guard_name'      => 'web',
                'controller_name' => 'permissions',
                'function_name'   => 'edit',
                'route_name'      => 'permissions'
            ],
            [
                'name'            => 'permission-update',
                'guard_name'      => 'web',
                'controller_name' => 'permissions',
                'function_name'   => 'update',
                'route_name'      => 'permissions'
            ],
            [
                'name'            => 'permission-view',
                'guard_name'      => 'web',
                'controller_name' => 'permissions',
                'function_name'   => 'show',
                'route_name'      => 'permissions'
            ],
            [
                'name'            => 'permission-delete',
                'guard_name'      => 'web',
                'controller_name' => 'permissions',
                'function_name'   => 'destroy',
                'route_name'      => 'permissions'
            ],

            [
                'name'            => 'role-browse',
                'guard_name'      => 'web',
                'controller_name' => 'roles',
                'function_name'   => 'index',
                'route_name'      => 'roles'
            ],
            [
                'name'            => 'role-add',
                'guard_name'      => 'web',
                'controller_name' => 'roles',
                'function_name'   => 'create',
                'route_name'      => 'roles'
            ],
            [
                'name'            => 'role-store',
                'guard_name'      => 'web',
                'controller_name' => 'roles',
                'function_name'   => 'store',
                'route_name'      => 'roles'
            ],
            [
                'name'            => 'role-edit',
                'guard_name'      => 'web',
                'controller_name' => 'roles',
                'function_name'   => 'edit',
                'route_name'      => 'roles'
            ],
            [
                'name'            => 'role-update',
                'guard_name'      => 'web',
                'controller_name' => 'roles',
                'function_name'   => 'update',
                'route_name'      => 'roles'
            ],
            [
                'name'            => 'role-view',
                'guard_name'      => 'web',
                'controller_name' => 'roles',
                'function_name'   => 'show',
                'route_name'      => 'roles'
            ],
            [
                'name'            => 'role-delete',
                'guard_name'      => 'web',
                'controller_name' => 'roles',
                'function_name'   => 'destroy',
                'route_name'      => 'roles'
            ],

            [
                'name'            => 'user-browse',
                'guard_name'      => 'web',
                'controller_name' => 'users',
                'function_name'   => 'index',
                'route_name'      => 'users'
            ],
            [
                'name'            => 'user-add',
                'guard_name'      => 'web',
                'controller_name' => 'users',
                'function_name'   => 'create',
                'route_name'      => 'users'
            ],
            [
                'name'            => 'user-store',
                'guard_name'      => 'web',
                'controller_name' => 'users',
                'function_name'   => 'store',
                'route_name'      => 'users'
            ],
            [
                'name'            => 'user-edit',
                'guard_name'      => 'web',
                'controller_name' => 'users',
                'function_name'   => 'edit',
                'route_name'      => 'users'
            ],
            [
                'name'            => 'user-update',
                'guard_name'      => 'web',
                'controller_name' => 'users',
                'function_name'   => 'update',
                'route_name'      => 'users'
            ],
            [
                'name'            => 'user-view',
                'guard_name'      => 'web',
                'controller_name' => 'users',
                'function_name'   => 'show',
                'route_name'      => 'users'
            ],
            [
                'name'            => 'user-delete',
                'guard_name'      => 'web',
                'controller_name' => 'users',
                'function_name'   => 'destroy',
                'route_name'      => 'users'
            ],
            [
                'name'            => 'user-profile-access',
                'guard_name'      => 'web',
                'controller_name' => 'users',
                'function_name'   => 'profile',
                'route_name'      => 'users'
            ],
            [
                'name'            => 'user-profile-update',
                'guard_name'      => 'web',
                'controller_name' => 'users',
                'function_name'   => 'updateProfile',
                'route_name'      => 'users'
            ],
            [
                'name'            => 'user-change-password',
                'guard_name'      => 'web',
                'controller_name' => 'users',
                'function_name'   => 'changePassword',
                'route_name'      => 'users'
            ],
            [
                'name'            => 'user-change-update-password',
                'guard_name'      => 'web',
                'controller_name' => 'users',
                'function_name'   => 'updatePassword',
                'route_name'      => 'users'
            ],
            [
                'name'            => 'user-change-password-admin',
                'guard_name'      => 'web',
                'controller_name' => 'users',
                'function_name'   => 'changePasswordByAdmin',
                'route_name'      => 'users'
            ],
            [
                'name'            => 'user-update-password-admin',
                'guard_name'      => 'web',
                'controller_name' => 'users',
                'function_name'   => 'updatePasswordByAdmin',
                'route_name'      => 'users'
            ],
        ];

        foreach($permissions as $permission_val){

            $existingPermission = Permission::where('name', $permission_val['name'])->exists();

            if (!$existingPermission) {
                $permission = Permission::create($permission_val);
            }

        }
    }
}
