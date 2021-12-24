<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContractsTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        DB::table('contracts')->insert([
            [
                'contract_number'=>'AD0137/21I708220',
                'code'=>'1381',
                'name'=>'Trần Thị Ngọc Thuỷ',
                'company_name'=>'KUSTO',
                'date_of_birth'=>'2000-02-02',
                'cmnd'=>'524095',
                'agency_ids'=>'[1,2]',
                'gender'=>0,
                'effective_date'=>'2021-12-15',
                'end_date'=>'2022-12-14',
                'package_code'=>1,
                'email'=>'dtphat@baominh.com.vn',
                'user_id'=>1,
                'relationship'=>'',
                'created_at'=>Carbon::now()
            ],
            [
                'contract_number'=>'AD0137/21I708220',
                'code'=>'1466',
                'name'=>Str::random(10),
                'company_name'=>'KUSTO',
                'date_of_birth'=>'2000-02-02',
                'cmnd'=>'524095',
                'agency_ids'=>'[1]',
                'gender'=>0,
                'effective_date'=>'2021-12-15',
                'end_date'=>'2022-12-14',
                'package_code'=>1,
                'email'=>'dtphat@baominh.com.vn',
                'user_id'=>1,
                'relationship'=>'',
                'created_at'=>Carbon::now()
            ]
        ]);
    }
}
