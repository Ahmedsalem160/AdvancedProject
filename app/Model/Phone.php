<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable=['code','mobile','user_id'];
    protected $hidden=['user_id'];
    ######################## Begin Relations ###############################
    public function user(){// forign key cannot be written
        return $this->belongsTo('App\User','user_id');
    }
    ######################## END Relations ##################################
}
