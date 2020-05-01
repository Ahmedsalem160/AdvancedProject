<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Model\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CrudController extends Controller
{
    use OfferTrait;

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

    public function store(OfferRequest $request){
        //validate
        //$rules=[
        //    'name'=>'required|max:100|unique:offers,name',
        //    'price'=>'required|numeric',
        //    'details'=>'required|max:200',
       // ];
        /*
        $messages=[//يجب ادخال اسم العرض
            'name.required'=>__('messages.offername required'),
            'name.unique'=>'هذا الاسم موجود بالفعل من فضلك ادخل اسم اخر',
            'price.numeric'=>'يجب ادخال ارقام فقط',
        ];
        $Rules=$this->getRules();
        $validator=Validator::make($request->all(),$Rules,$messages);
        if ($validator->fails()){
            return redirect()->back()->withInputs($request->all())->withErrors($validator);
        }*/
        //Adding Photo
            //in Traits
        $file_name=$this->SaveImage($request->photo,'images/offers');
        //insert
        Offer::create([
            'photo'=>$file_name,
            'name_ar' => $request->name_ar ,
            'name_en' => $request->name_en ,
            'price'=>$request->price .'$',
            'details_ar'=>$request->details_ar,
            'details_en'=>$request->details_en,
        ]);
            return  redirect()->back()->with(['success'=>'تم اضافه العرض بنجاح']);
    }
   /*
    *
     protected function getRules(){
        $rules=[
            'name'=>'required|max:100|unique:offers,name',
            'price'=>'required|numeric',
            'details'=>'required|max:200',
        ];
        return $rules;
    }
*/

    public function showAll(){
        $offers = Offer::select('id',
                    'name_'.LaravelLocalization::getCurrentLocale() . ' as name',
                    'details_'.LaravelLocalization::getCurrentLocale() . ' as details',
                    'price')->get();
        return view('offers.showAll',compact('offers'));

    }

    public function editOffer($offer_id){ // I can recieve the id with any varname
        Offer::findOrFail($offer_id);
        $offer = Offer::select('id','name_ar','name_en','details_ar','details_en','price')->find($offer_id);
        return view('offers.edit',compact('offer'));
    }

    public function updateOffer(OfferRequest $request,$offer_id){
        //validation
        //Update
        $offer = Offer::findOrFail($offer_id);
        $offer->update($request->all());
        return redirect()->back()->with(['success'=>'Update Done successfully']);

    }
}

