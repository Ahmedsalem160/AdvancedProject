<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable=['address','name','country_id'];
    protected $hidden=['created_at','updated_at'];

    ######################## Begin Relations ###############################
    public function doctors(){// forign key cannot be written
        return $this->hasMany('App\Model\Doctor','hospital_id','id');//the last is primary Key
    }
    ######################## END Relations ##################################
}
