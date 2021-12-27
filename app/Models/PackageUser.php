<?php

namespace App\Models;

class PackageUser extends \Illuminate\Database\Eloquent\Model
{
    protected $table ='package_users';
    protected $fillable = ['package_id','user_id','status'];
    protected $attributes = [
      'status'=>1
    ];
}
