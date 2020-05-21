<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable=['id','name','age'];
    protected $hidden=['created_at','updated_at'];

    //has one through method
    public function doctor(){
        return $this->hasOneThrough('App\Model\Doctor','App\Model\MedicalFile','patient_id','medicalFile_id');
    }
}
