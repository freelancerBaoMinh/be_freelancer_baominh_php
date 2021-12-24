<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgenciesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('agencies')->insert([
            [
                'name' => 'Aon',
                'code' => 'aon',
                'url' => '',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Tomaho',
                'code' => 'tomaho',
                'url' => '',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
