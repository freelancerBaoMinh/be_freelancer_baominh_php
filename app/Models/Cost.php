<?php

namespace App\Models;

class Cost extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
      'request_id','invoice_date','cost'
    ];
    protected $attributes = [
        'cost'=>0,
        'invoice_date'=>0
    ];
}
