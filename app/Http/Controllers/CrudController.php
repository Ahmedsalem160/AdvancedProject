<?php

namespace App\Http\Controllers;

use App\Model\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    public function __construct()
    {

    }

    public function getOffers()
    {
        return Offer::select('id','name')->get();
    }

    /*public function store(){
        return Offer::create([
            'name' =>'Offer3',
            'price'=>'5000',
            'details'=>'offer details'

        ]);
    }  */

    public function create(){
        return view('offers.create');
    }

    public function store(Request $request){
        //validate
        //$rules=[
        //    'name'=>'required|max:100|unique:offers,name',
        //    'price'=>'required|numeric',
        //    'details'=>'required|max:200',
       // ];
        $messages=[//يجب ادخال اسم العرض
            'name.required'=>__('messages.offername required'),
            'name.unique'=>'هذا الاسم موجود بالفعل من فضلك ادخل اسم اخر',
            'price.numeric'=>'يجب ادخال ارقام فقط',
        ];
        $Rules=$this->getRules();
        $validator=Validator::make($request->all(),$Rules,$messages);
        if ($validator->fails()){
            return redirect()->back()->withInputs($request->all())->withErrors($validator);
        }
        //insert
        Offer::create([
            'name' => $request->name ,
            'price'=>$request->price .'$',
            'details'=>$request->details,
        ]);
            return  redirect()->back()->with(['success'=>'تم اضافه العرض بنجاح']);
    }
    protected function getRules(){
        $rules=[
            'name'=>'required|max:100|unique:offers,name',
            'price'=>'required|numeric',
            'details'=>'required|max:200',
        ];
        return $rules;
    }

}
