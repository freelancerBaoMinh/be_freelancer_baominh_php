<?php

namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => Str::random(6),
                'password' => Hash::make('123456'),
                'admin_id' => 0,
                'role' => 0,
                'avatar' => '',
                'fcm_token' => '',
                'device' => 0,
                'status' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'username' => Str::random(6),
                'password' => Hash::make('123456'),
                'admin_id' => 0,
                'role' => 1,
                'avatar' => '',
                'fcm_token' => '',
                'device' => 0,
                'status' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'username' => Str::random(6),
                'password' => Hash::make('123456'),
                'admin_id' => 0,
                'role' => 2,
                'avatar' => '',
                'fcm_token' => '',
                'device' => 0,
                'status' => 1,
                'created_at' => Carbon::now()
            ]]);
    }
}
