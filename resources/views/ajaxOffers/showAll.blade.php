@extends('layouts.app')

@section('content')
    <div class="container">
       <!-- Table-->
        <table class="table table-striped table-hover " style="margin-top: 40px">
            <thead>
            <tr>
                <th scope="col">{{__('messages.Id')}}</th>
                <th scope="col">{{__('messages.Name_ar')}}</th>
                <th scope="col">{{__('messages.details_ar')}}</th>
                <th scope="col">{{__('messages.OfferPrice')}}</th>
                <th scope="col">{{__('messages.Image')}}</th>
                <th scope="col">{{__('messages.Operations')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($offers as $offer)
            <tr class="offerRow{{$offer->id}}">
                <td>{{$offer->id}}</td>
                <td>{{$offer->name}}</td>
                <td>{{$offer->details}}</td>
                <td>{{$offer->price}}</td>
                <td><img style="width: 90px; height: 90px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>
                <td>
                    <a href="{{url('ajax-offer/edit/'.$offer -> id)}}" class="btn btn-success">
                        {{__('messages.edit')}}</a>

                    <a href="{{route('offers.delete',$offer->id)}}" class="btn btn-danger">
                        {{__('messages.Delete')}}</a>

                    <a href="" offer_id="{{$offer->id}}" class="btn btn-danger delete_btn">AjaxDelete</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <!--END Table-->
    </div>
@stop

@section('script')
    <script>
        $(document).on('click','.delete_btn',function (e) {
            e.preventDefault();
            var offer_id = $(this).attr('offer_id');
            $.ajax({
                type: 'post',
                url:"{{route('ajax.delete')}}",
                data: {
                    '_token':"{{csrf_token()}}",
                    'id':offer_id,
                },

                success:function (data) {
                    if (data.status==true)
                        alert(data.msg);

                    $('.offerRow'+data.id).remove();

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


