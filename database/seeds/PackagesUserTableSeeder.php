<?php


use Illuminate\Support\Facades\DB;

class PackagesUserTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        DB::table('package_users')->insert([
            'package_id'=>1,
            'user_id'=>1
        ]);
    }
}
