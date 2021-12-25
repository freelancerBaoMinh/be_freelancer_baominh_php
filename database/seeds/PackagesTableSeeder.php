<?php


use Illuminate\Support\Facades\DB;

class PackagesTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        DB::table('packages')->insert([
            [
                'name'=>'CƠ BẢN',
                'code'=>'co_ban_1',
                'status'=>1
            ],
            [
                'name'=>'Vàng',
                'code'=>'vang',
                'status'=>1
            ]
        ]);
    }
}
