<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $fillable = ['name', 'code', 'url'];
    protected $attributes = [
        'name' => '',
        'url' => ''
    ];
}
