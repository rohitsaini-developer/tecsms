<?php
namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('seeders/sql/countries.sql');
        $sql    = file_get_contents($path);
        DB::unprepared($sql);
    }
}
