
@extends('layouts.app')

    @section('content')
        <div class="container">

            <div class="flex-center position-ref full-height">


                <div class="content">
                    <div class="title m-b-md h3">
                        The Hospitals
                    </div>
                    <!-- Table-->
                    <table class="table table-striped table-hover " style="margin-top: 40px">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Processing</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($hospitals)&& $hospitals->count()>0)
                            @foreach($hospitals as $hospital)
                                <tr>
                                    <td>{{$hospital->id}}</td>
                                    <td>{{$hospital->name}}</td>
                                    <td>{{$hospital->address}}</td>

                                    <td>
                                        <a href="{{route('hospital.doctor',$hospital->id)}}" class="btn btn-success">Showing Doctors</a>
                                        <a href="{{route('hospital.delete',$hospital->id)}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <!--END Table-->

                </div>


            </div>
        </div>
    @stop



