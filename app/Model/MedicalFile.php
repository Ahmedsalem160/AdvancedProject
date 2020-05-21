<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MedicalFile extends Model
{
    protected $table="medical_files";
    protected $fillable=['id','pdf','patient_id'];
    protected $hidden=['created_at','updated_at'];
}
