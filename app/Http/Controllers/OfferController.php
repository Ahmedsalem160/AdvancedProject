<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Model\Offer;
use App\Traits\OfferTrait;
use http\Env\Response;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class OfferController extends Controller
{
    use OfferTrait;
    public  function create(){
        return view('ajaxOffers.create');
    }

    public  function store(OfferRequest $request){
        $file_name=$this->SaveImage($request->photo,'images/offers');
        //insert
        $createOffer=Offer::create([
            'photo'=>$file_name,
            'name_ar' => $request->name_ar ,
            'name_en' => $request->name_en ,
            'price'=>$request->price .'$',
            'details_ar'=>$request->details_ar,
            'details_en'=>$request->details_en,
        ]);
        if ($createOffer) {
            return response()->json([
                'status' => true,
                'msg' => 'Saving Done Successfully',
            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg' => 'Saving Faild ',
            ]);
        }
    }

    public function showAll(){
        $offers = Offer::select('id',
            'name_'.LaravelLocalization::getCurrentLocale() . ' as name',
            'details_'.LaravelLocalization::getCurrentLocale() . ' as details',
            'price')->get();
        return view('ajaxOffers.showAll',compact('offers'));

    }

    public function deleteOffer(Request $request){
        $offer=Offer::find($request->id);
        if ($offer) {
            return response()->json([
                'status' => true,
                'msg' => 'Deleting Done Successfully',
                'id' => $request->id,
            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg' => 'Deleting Faild ',
            ]);
        }

        $offer->delete();
    }

    public function editOffer(Request $request){
        Offer::findOrFail($request->offer_id);
        $offer = Offer::select('id','name_ar','name_en','details_ar','details_en','price')->find($request->offer_id);
        return view('ajaxOffers.edit',compact('offer'));
    }

    public function updateOffer(Request $request){
        $offer = Offer::findOrFail($request->offer_id);
        if (!$offer){
            return response()->json([
                'status' => false,
                'msg' => 'Deleting Faild ',
            ]);
        }else{
            return response()->json([
                'status' => true,
                'msg' => 'Updating Done Successfully',
                'id' => $request->id,
            ]);
        }
        $offer->update($request->all());

    }


}
