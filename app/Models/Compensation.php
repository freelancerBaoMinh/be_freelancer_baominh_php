<?php

namespace App\Models;

class Compensation extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'compensations';
    protected $fillable = ['user_id', 'insurance_name', 'birthday', 'phone', 'cmnd', 'email',
        'level', 'pay_request', 'day_off', 'is_cash', 'bank_number', 'bank_name',
        'bank_addr', 'bank_account', 'date_of_acident', 'diagnose', 'hospital_name',
        'date_of_admission', 'date_of_discharge', 'media','status'];
    protected $attributes = [
        'insurance_name' => '',
        'birthday' => 0,
        'phone' => 0,
        'cmnd' => '',
        'level' => 0,
        'pay_request'=>0,
        'day_off'=>0,
        'is_cash'=>0,
        'bank_number'=>'',
        'bank_name'=>'',
        'bank_addr'=>'',
        'bank_account'=>'',
        'date_of_acident'=>0,
        'diagnose'=>'',
        'hospital_name'=>'',
        'date_of_admission'=>0,
        'date_of_discharge'=>0,
        'media'=>'[]',
        'status'=>0
    ];
}
