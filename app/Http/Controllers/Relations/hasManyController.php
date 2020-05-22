<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\Model\Doctor;
use App\Model\Hospital;
use Illuminate\Http\Request;

class hasManyController extends Controller
{
    public function getHospitalDoctors(){
        $hospital = Hospital::with(['doctors'=>function($q){
            $q->select(['name','title','id','hospital_id'])->get();
        }])->find(2);
        $hospital->makeVisible('hospital_id');
        return $hospital ;
    }

    public function hospitals(){
        $hospitals= Hospital::select('id','name','address')->get();
        return view('hospital.hospitals',compact('hospitals'));
    }

    public function doctors($hospital_id){
        $hospital=Hospital::find($hospital_id);
        $doctors=$hospital->doctors;
        return view('hospital.doctors',compact('doctors'));
    }
    // get All hospital that has Doctors at least one
    public function hospitalHasDoctor(){
        $hopital=Hospital::whereHas('doctors')->get();
        return $hopital;
    }

    public function hospitalNotHasDoctor(){
        return $hopital=Hospital::whereDoesntHave('doctors')->get();
    }

    public function hospitalHasDoctorMale(){
        $hopital=Hospital::whereHas('doctors',function($q){
            $q->where('gender',1);
        })->get();
        return $hopital;
    }

    public function deleteHospital($hospital_id){
        $hospital =Hospital::findOrFail($hospital_id);
        $hospital->doctors()->delete();
        $hospital->delete();
        return redirect()->route('hospitals.all');
    }
    //accessors
    public function getDoctors(){
        $doctors= Doctor::select('id','name','gender')->get();
        /*
        if (isset($doctors) && $doctors->count()>0){
            foreach ($doctors as $doctor){
                $doctor->gender = $doctor->gender == 1 ?'male':'female';
            }
            return $doctors;
        }else{return "Not Found";}
        */
        return $doctors;
    }
}
