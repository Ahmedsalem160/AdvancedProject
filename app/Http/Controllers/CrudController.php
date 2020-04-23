<?php

namespace App\Http\Controllers;

use App\Model\Offer;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function __construct()
    {

    }

    public function getOffers()
    {
        return Offer::select('id','name')->get();
    }

    public function store(){
        return Offer::create([
            'name' =>'Offer3',
            'price'=>'5000',
            'details'=>'offer details'

        ]);
    }
}
