<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
                'key' => 'website_logo',
                'value' => 'default/logo.png',
                'type' => 'image',
                'display_name' => 'Website Logo',
                'details' => '',
                'tag' => '',
                'group' => 'site',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'mobile_logo',
                'value' => 'default/small-logo.png',
                'type' => 'image',
                'display_name' => 'Mobile Logo',
                'details' => '',
                'tag' => '',
                'group' => 'site',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'favicon',
                'value' => 'default/favicon.png',
                'type' => 'image',
                'display_name' => 'Favicon',
                'details' => '',
                'tag' => '',
                'group' => 'site',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'website_title',
                'value' => 'Test',
                'type' => 'text',
                'display_name' => 'Website Title',
                'details' => '',
                'tag' => '',
                'group' => 'site',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'facebook_url',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Facebook URL',
                'details' => '',
                'tag' => '',
                'group' => 'site',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'twitter_url',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Twitter URL',
                'details' => '',
                'tag' => '',
                'group' => 'site',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'instagram_url',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Instagram URL',
                'details' => '',
                'tag' => '',
                'group' => 'site',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'youtube_url',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Youtube URL',
                'details' => '',
                'tag' => '',
                'group' => 'site',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'session_limit',
                'value' => '120',
                'type' => 'number',
                'display_name' => 'Session Limit (In munites)',
                'details' => '',
                'tag' => '',
                'group' => 'site',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'company_name',
                'value' => 'Tecsms',
                'type' => 'text',
                'display_name' => 'Company Name',
                'details' => '',
                'tag' => '',
                'group' => 'company',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'company_address',
                'value' => 'test',
                'type' => 'text_area',
                'display_name' => 'Company Address',
                'details' => '',
                'tag' => '',
                'group' => 'company',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'company_email',
                'value' => '',
                'type' => 'email',
                'display_name' => 'Company Email',
                'details' => '',
                'tag' => '',
                'group' => 'company',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'phone_number',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Phone Number',
                'details' => '',
                'tag' => '',
                'group' => 'company',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'admin_email',
                'value' => '',
                'type' => 'email',
                'display_name' => 'Admin Email',
                'details' => '',
                'tag' => '',
                'group' => 'company',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'paypal_email',
                'value' => '',
                'type' => 'email',
                'display_name' => 'Paypal Mail',
                'details' => '',
                'tag' => '',
                'group' => 'company',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'support_name',
                'value' => 'test name',
                'type' => 'text',
                'display_name' => 'Support Name',
                'details' => '',
                'tag' => '',
                'group' => 'company',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'support_email',
                'value' => 'test@test.com',
                'type' => 'email',
                'display_name' => 'Support Email',
                'details' => '',
                'tag' => '',
                'group' => 'company',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'notification_email',
                'value' => '',
                'type' => 'email',
                'display_name' => 'Notification Email',
                'details' => '',
                'tag' => '',
                'group' => 'company',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'paypal_mode',
                'value' => 'sandbox',
                'type' => 'text',
                'display_name' => 'Paypal Mode',
                'details' => '',
                'tag' => '',
                'group' => 'keys',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'paypal_client_id',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Paypal Client Id',
                'details' => '',
                'tag' => '',
                'group' => 'keys',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'paypal_client_secret',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Paypal Client Secret',
                'details' => '',
                'tag' => '',
                'group' => 'keys',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'paypal_api_username',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Paypal Api Username',
                'details' => '',
                'tag' => '',
                'group' => 'keys',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'paypal_api_password',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Paypal Api Password',
                'details' => '',
                'tag' => '',
                'group' => 'keys',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'paypal_api_secret',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Paypal Api Secret',
                'details' => '',
                'tag' => '',
                'group' => 'keys',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'google_client_id',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Google Client Id',
                'details' => '',
                'tag' => '',
                'group' => 'keys',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'google_client_secret',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Google Client Secret',
                'details' => '',
                'tag' => '',
                'group' => 'keys',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'google_redirect_url',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Google Redirect URL',
                'details' => '',
                'tag' => '',
                'group' => 'keys',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'facebook_client_id',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Facebook Client Id',
                'details' => '',
                'tag' => '',
                'group' => 'keys',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'facebook_client_secret',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Facebook Client Secret',
                'details' => '',
                'tag' => '',
                'group' => 'keys',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'facebook_redirect_url',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Facebook Redirect URL',
                'details' => '',
                'tag' => '',
                'group' => 'keys',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'twilio_sid',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Twilio SID',
                'details' => '',
                'tag' => '',
                'group' => 'keys',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'twilio_token',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Twilio Client Secret',
                'details' => '',
                'tag' => '',
                'group' => 'keys',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'twilio_from_number',
                'value' => '',
                'type' => 'text',
                'display_name' => 'Twilio Number',
                'details' => '',
                'tag' => '',
                'group' => 'keys',
                'status' => 'publish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        Setting::insert($settings);
    }
}
