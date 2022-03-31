<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $roles = array('admin','postpaid','prepaid');
        foreach($roles as $val){
            $getroles = Role::where('name', $val)->first();
            if($val == 'admin'){
                $permissions = Permission::all();
                $getroles->permissions()->sync($permissions);

            }else if($val == 'postpaid'){
                $permission_array = array();
                $permissions = Permission::whereIn('name',$permission_array)->get();
                $getroles->permissions()->sync($permissions);

            }else{
                $permission_array = array();
                $permissions = Permission::whereIn('name',$permission_array)->get();
                $getroles->permissions()->sync($permissions);
            }
        }
    }
}
