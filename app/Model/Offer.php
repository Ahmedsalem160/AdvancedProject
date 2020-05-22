<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\OfferScope;

class Offer extends Model
{
    protected $table ="offers"; //match between model & table if you don't write with the right spilling
    protected $fillable =['photo','name_ar','name_en','price','details_ar','details_en','status'];
    protected $hidden =['created_at','updated_at']; //any field in hidden You cannot access it or retrive or any operation
    ##### Local scope #############
    public function scopeInactiveStatus($query){
        return $query->where('status',0);
    }


    ##### Global scope ############
    protected static function boot()
    {   //Register of global scope
        parent::boot();
        static::addGlobalScope(new OfferScope);
    }


    //mutators  >> set >> Process on Save data in DB

    public function setNameEnAttribute($value){
        return $this->attributes['name_en']=strtoupper($value);
    }
}
