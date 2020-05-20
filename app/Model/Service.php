<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable=['id','name'];
    protected $hidden=['created_at','updated_at','pivot'];

    public function doctors(){
        return $this->belongsToMany('App\Model\Doctor','doctor_service','doctor_id','service_id');
    }
}
