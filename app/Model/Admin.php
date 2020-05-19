<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable =[ 'name', 'email', 'password',];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected  $guard  ="admin";
}
