<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name'          => 'admin',
                'guard_name'    => 'web',
            ],
            [
                'name'          => 'postpaid',
                'guard_name'    => 'web',
            ],
            [
                'name'          => 'prepaid',
                'guard_name'    => 'web',
            ],
        ];

        foreach($roles as $role){
            $existingRole = Role::where('name', $role['name'])->exists();
            if (!$existingRole) {
                $role = Role::create($role);
            }
        }
    }
    
    
}
