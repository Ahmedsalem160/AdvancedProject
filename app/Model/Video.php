<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table="videoes";
    protected $fillable=['name','viewer'];

}
