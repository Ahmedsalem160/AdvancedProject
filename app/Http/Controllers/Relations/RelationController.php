<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Phone;
use App\User;

class RelationController extends Controller
{
    public function hasOneRelation(){
        //return all data of user but with out Data at relation
        //$user= \App\User::find(2);

        // Comment >>>> return data of user with data of Another table relation
        $user= \App\User::with(['phone'=>function($q){
          $q -> select('code','mobile','user_id');
        }])->find(1);
        //$user= \App\User::find(2);
        //return $phone;
        return response()->json($user);
    }

    public function hasOneRelationReverse(){
        $phone =\App\Model\Phone::with(['user'=>function ($q){
            $q->select('id','name','email');
        }])->find(1);

        //some Attribute hidden in its Model and needed to make it Visible
        $phone->makeVisible(['user_id']);

        //To make Attribute Hidden
        $phone->makeHidden(['created_at','updated_at']);
        //To return users that belongs to Phone Model you must make forign Key Visible
        return $phone;

    }

    public function userHasPhone(){
        return User::whereHas('phone')->get();
    }

    public function userNotHasPhone(){
        return User::whereDoesntHave('phone')->get();
    }

    public function userHasPhoneWithCondition(){
        return User::whereHas('phone',function ($q){
            $q->where('code','02');
        })->get();
    }

}
