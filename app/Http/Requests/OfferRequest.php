<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar'=>'required|max:100|unique:offers,name_ar',
            'name_en'=>'required|max:100|unique:offers,name_en',
            'price'=>'required|numeric',
            'details_ar'=>'required|max:200',
            'details_en'=>'required|max:200',
        ];
    }
    public function messages(){
        return[
            'name_ar.required'=>__('messages.offerNameRequired'),
            'name_ar.unique'=>__('messages.nameUnique'),
            'name_ar.max'=>__('messages.nameMax'),
            'name_en.required'=>__('messages.offerNameRequired'),
            'name_en.unique'=>__('messages.nameUnique'),
            'name_en.max'=>__('messages.nameMax'),
            'price.numeric'=>__('messages.priceNumeric'),
            'price.required'=>__('messages.priceRequired'),
            'details_ar.required'=>__('messages.detailsRequired'),
            'details_ar.max'=>__('messages.detailsMax'),
            'details_en.required'=>__('messages.detailsRequired'),
            'details_en.max'=>__('messages.detailsMax'),
        ];
    }

}
