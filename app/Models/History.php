<?php

namespace App\Models;

class History extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
        'compensation_id','status','reason','pay_date','pay_total','user_id','date_request','pay_content','admin_id'
    ];
    protected $attributes = [
        'status'=>0,
        'reason'=>'',
        'pay_date'=>0,
        'pay_total'=>0,
        'date_request'=>0,
        'pay_content'=>0
    ];
}
