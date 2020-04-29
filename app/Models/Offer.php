<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table ="offers"; //match between model & table if you don't write with the right spilling
    protected $fillable =['photo','name_ar','name_en','price','details_ar','details_en','created_at','updated_at'];
    protected $hidden =['created_at','updated_at']; //any field in hidden You cannot access it or retrive or any operation


}
