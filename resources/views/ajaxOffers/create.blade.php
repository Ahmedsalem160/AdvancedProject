
@extends('layouts.app')

    @section('content')
        <div class="container">

            <div class="flex-center position-ref full-height">


                <div class="content">
                    <div class="title m-b-md h3">
                        {{__('messages.Add Your Offer')}}
                    </div>
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    <br>
                    <!--Form -->
                    <form method="Post" id="offerForm" action="" enctype="multipart/form-data">
                        @csrf
                        <!-- name_ar  -->
                        <div class="form-group">
                            <label for="name">{{__('messages.Name_ar')}}</label>
                            <input type="text" name="name_ar" class="form-control"  placeholder="{{__('messages.Enter Name_ar')}}">
                            @error('name_ar')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <!-- name_en  -->
                        <div class="form-group">
                            <label for="name">{{__('messages.Name_en')}}</label>
                            <input type="text" name="name_en" class="form-control"  placeholder="{{__('messages.Enter Name_en')}}">
                            @error('name_en')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Price">{{__('messages.OfferPrice')}}</label>
                            <input type="text" name="price" class="form-control" placeholder="{{__('messages.OfferPrice')}}">
                            @error('price')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <!-- details_ar  -->
                        <div class="form-group">
                            <label for="Details">{{__('messages.details_ar')}}</label>
                            <input type="text" name="details_ar" class="form-control" placeholder="{{__('messages.details_ar')}}">
                            @error('details_ar')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <!-- details_en  -->
                        <div class="form-group">
                            <label for="Details">{{__('messages.details_en')}}</label>
                            <input type="text" name="details_en" class="form-control" placeholder="{{__('messages.details_en')}}">
                            @error('details_en')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <!-- Photo  -->
                        <div class="form-group">
                            <label for="Photo">{{__('messages.AddPhoto')}}</label>
                            <input type="file" name="photo" class="form-control" >
                            @error('photo')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <button id="save_offer" class="btn btn-primary">{{__('messages.Save IT')}}</button>
                    </form>
                    <!--END Form -->
                </div>


            </div>
        </div>
    @stop


@section('script')
<script>
    $(document).on('click','#save_offer',function (e) {
        e.preventDefault();
        //To get all responses from the Form
        var formData = new FormData($('#offerForm')[0]);

        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url:"{{route('ajax.offer.store')}}",
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

/*
data:{
    '_token' :"{{csrf_token()}}",
        'photo' :$("input[name='photo']").val(),
        'name_ar' : $("input[name='name_ar']").val(),
        'name_en' :$("input[name='name_en']").val(),
        'price':$("input[name='price']").val(),
        'details_ar':$("input[name='details_ar']").val(),
        'details_en':$("input[name='details_en']").val(),
}
*/

</script>
@stop
