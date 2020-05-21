<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable=['name'];
    protected $hidden=['created_at','updated_at'];

    public function doctors(){
        return $this->hasManyThrough('App\Model\Doctor','App\Model\Hospital','country_id','hospital_id');
    }
}
