<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'id'         => '1',
                'title'      => 'Token Resend Limit',
                'key'        => 'token_resend_limit',
                'value'      => 10,
                'field_type' => 'number',
                'details'    => '',
                'status'     => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        Setting::insert($settings);
    }
}
