<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable=['id','title','name','hospital_id','medicalFile_id'];
    protected $hidden=['hospital_id','created_at','updated_at','pivot'];


    ######################## Begin Relations ###############################
    // one To many
    public function hospital(){// forign key cannot be written
        return $this->belongsTo('App\Model\Hospital','hospital_id');
    }
    //Many To Many
    public function services(){
        return $this->belongsToMany('App\Model\Service','doctor_service','doctor_id','service_id');
    }
    //has Many through >> get the country of Doctor
    public function country(){
        return $this->hasManyThrough('App\Model\Country','App\Model\Hospital','hospital_id','country_id');
    }
    ######################## END Relations ##################################
}
