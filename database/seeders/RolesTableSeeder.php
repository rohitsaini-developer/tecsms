<?php
namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

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
