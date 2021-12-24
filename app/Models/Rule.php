<?php

namespace App\Models;

class Rule extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = ['name','order','group'];
    protected $attributes = [
      'order'=>0,
      'group'=>'A'
    ];
    public $timestamps = false;
}
