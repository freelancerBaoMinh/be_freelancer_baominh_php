<?php

namespace App\Models;

class Contract extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
        'name', 'email', 'contract_number', 'code', 'company_name',
        'date_of_birth', 'cmnd', 'gender', 'effective_date', 'end_date', 'agency_ids',
        'gender', 'package_code', 'relationship','user_id','status','relationship_name'
    ];
    protected $attributes = [
        'contract_number' => '',
        'name' => '',
        'company_name' => '',
        'agency_ids' => '[]',
        'gender' => 0,
        'relationship' => 0,
        'status'=>1,
        'relationship_name'=>''
    ];
}
