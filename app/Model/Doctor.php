<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable=['title','name','hospital_id'];
    protected $hidden=['hospital_id'];


    ######################## Begin Relations ###############################
    public function hospital(){// forign key cannot be written
        return $this->belongsTo('App\Model\Hospital','hospital_id');
    }
    ######################## END Relations ##################################
}
