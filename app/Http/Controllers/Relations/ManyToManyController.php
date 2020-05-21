<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\Model\Country;
use App\Model\Doctor;
use App\Model\Patient;
use App\Model\Service;
use Illuminate\Http\Request;

class ManyToManyController extends Controller
{
    public function getDoctorServices(){
        $Doctor=Doctor::with(['services'=>function($q){
            $q->select('name')->get();
        }])->find(3);
        return $Doctor ;
    }

    public function getServiceDoctors(){
        $service=Service::with(['doctors'=>function($q){
            $q->select('name','title')->get();
        }])->find(3);
        return $service ;
    }

    public function showDoctorServices($doctor_id){
        $Doctor=Doctor::find($doctor_id);
        $doctorName=$Doctor->name;
        $services=$Doctor->services;
        $doctors=Doctor::select('id','name')->get();
        $allServices=Service::select('id','name')->get();
        return view('hospital.services',compact('services','doctorName','doctors','allServices'));
    }
    public function saveServicesToDotor(Request $request){
       $doctor=Doctor::find($request->doctor_id);
       if(!$doctor)
           return abort('404');
       //$doctor->services()->attach($request->service_id);// method many to many Adding in the relation direct
       //$doctor->services()->sync($request->service_id);// Update the data without تكرار but delete the old data
        $doctor->services()->syncWithoutDetaching($request->service_id);//Append new records without deleting the old Data
       return 'success';
    }

    public function getDoctorFollowing(){
        // 3 Tables  2 just connected >> hasOneThrough
            $patient=Patient::find(2);
            return $patient->doctor;
    }

    public function DoctorsOfCountry(){
        $country=Country::find(1);
        return $country->doctors;
    }

    public function ShowCountryOfDoctor(){
        $patient=Patient::find(2);
        return $patient->doctor;
    }






}
