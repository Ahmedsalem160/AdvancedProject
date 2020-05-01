<?php

namespace App\Traits;


Trait OfferTrait
{
    function SaveImage($photo,$folder){
        $file_extention = $photo->getClientOriginalExtension();
        $file_name = time().'.'.$file_extention;
        //$path = 'images/offers';
        $path =$folder;
        $photo->move($path,$file_name);
        return $file_name;
    }
}
