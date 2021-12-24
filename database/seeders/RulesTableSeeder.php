<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

class RulesTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        DB::table('rules')->insert([
            [
                'name'=>'ĐIỀU TRỊ NỘI TRÚ DO ỐM ĐAU, BỆNH TẬT, TAI NẠN (loại trừ ung thư)',
                'order'=>0,
                'group'=>'A'
            ],
            [
                'name'=>'*Giới hạn viện phí/năm. \nChi phí nằm viện điều trị nội trú không quá 60 ngày/năm. Giới hạn ngày. \nChi phí phòng, giường bệnh. \n Chi phí chăm sóc đặc biệt. \n Các chi phí bệnh viện tổng hợp.',
                'order'=>1,
                'group'=>'A'
            ],
            [
                'name'=>'Điều trị ngoại trú do ốm đau bệnh tật, tai nạn/năm',
                'order'=>1,
                'group'=>'B'
            ],
            [
                'name'=>'Hồi hương thi hài',
                'order'=>13,
                'group'=>'A'
            ]
        ]);
    }
}
