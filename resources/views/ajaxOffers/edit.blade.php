@extends('layouts.app')

@section('content')

    <div class="flex-center position-ref full-height">

        <div class="container">

            <div class="content">
                <div class="title m-b-md h2">
                    {{__('messages.UpdateYourOffer')}}
                </div>
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                <br>
                <!--Form -->
                <form method="post" id="formData_updated">
                    @csrf
                        <!--sending id of Offer TO Update page because of Ajax -->
                        <input style="display: none;" name="offer_id" value="{{$offer->id}}">
                    <!-- name_ar  -->
                    <div class="form-group">
                        <label for="name">{{__('messages.Name_ar')}}</label>
                        <input type="text" name="name_ar" value="{{$offer->name_ar}}" class="form-control"  placeholder="{{__('messages.Enter Name_ar')}}">
                        @error('name_ar')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <!-- name_en  -->
                    <div class="form-group">
                        <label for="name">{{__('messages.Name_en')}}</label>
                        <input type="text" name="name_en" value="{{$offer->name_en}}" class="form-control"  placeholder="{{__('messages.Enter Name_en')}}">
                        @error('name_en')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="Price">{{__('messages.OfferPrice')}}</label>
                        <input type="text" name="price" value="{{$offer->price}}" class="form-control" placeholder="{{__('messages.OfferPrice')}}">
                        @error('price')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <!-- details_ar  -->
                    <div class="form-group">
                        <label for="Details">{{__('messages.details_ar')}}</label>
                        <input type="text" name="details_ar" value="{{$offer->details_ar}}" class="form-control" placeholder="{{__('messages.details_ar')}}">
                        @error('details_ar')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <!-- details_en  -->
                    <div class="form-group">
                        <label for="Details">{{__('messages.details_en')}}</label>
                        <input type="text" name="details_en" value="{{$offer->details_en}}" class="form-control" placeholder="{{__('messages.details_en')}}">
                        @error('details_en')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <button id="update_offer" class="btn btn-primary">{{__('messages.Save IT')}}</button>
                </form>
                <!--END Form -->
            </div>

        </div>
    </div>

@stop

@section('script')
    <script>
        $(document).on('click','#update_offer',function (e) {
            e.preventDefault();
            //To get all responses from the Form
            var formData = new FormData($('#formData_updated')[0]);

            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url:"{{route('ajax.update')}}",
                data:formData,  //the variable that has the Form
                processData:false,
                contentType:false,
                cache:false,
                success:function (data) {
                    if (data.status==true)
                        alert(data.msg);

                },error:function (reject) {

                }

            });
        });

    </script>

@stop

