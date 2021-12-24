<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('details')->insert([
           [
               'value'=>'40.000.000 /năm',
               'package_id'=>1,
               'rule_id'=>1
           ],
            [
                'value'=>'Giới hạn /ngày: 800.000/ngày, và tối đa 60 ngày/ năm',
                'package_id'=>1,
                'rule_id'=>1
            ]
        ]);
    }
}
