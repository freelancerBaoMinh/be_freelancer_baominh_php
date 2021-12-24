<?php

namespace App\Models;

class Package extends \Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;
    protected $fillable = ['name','code'];
}
