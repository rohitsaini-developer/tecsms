<?php
namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        // admin permission
        $all_permissions = Permission::all();
        $admin_permissions = $all_permissions;
        Role::findOrFail(1)->permissions()->sync($admin_permissions);
    }
}
