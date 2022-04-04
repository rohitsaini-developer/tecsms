<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                        => 1,
                'name'                      => 'Super Admin',
                'email'                     => 'admin@tecsms.com',
                'password'                  => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
                'email_verified_at'         => date("Y-m-d H:i:s"),
                'phone_number'              => "9313234655",
                'country_id'          => "91",
                'phone_number_verified_at'  => date("Y-m-d H:i:s"),
                'remember_token'            => null,
                'created_at'                => date('Y-m-d H:i:s'),
                'updated_at'                => date('Y-m-d H:i:s'),
            ],
        ];
        User::insert($users);
    }
}
