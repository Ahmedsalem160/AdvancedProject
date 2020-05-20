
@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md h3">
                    Doctors
                </div>
                <!-- Table-->
                <table class="table table-striped table-hover " style="margin-top: 40px">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Title</th>
                        <th scope="col">Processing</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($doctors)&& $doctors->count()>0)
                        @foreach($doctors as $doctor)
                            <tr>
                                <td>{{$doctor->id}}</td>
                                <td>{{$doctor->name}}</td>
                                <td>{{$doctor->title}}</td>

                                <td>
                                    <a href="{{ route('show.doctor.services',$doctor->id) }}" class="btn btn-success">Show Services</a>

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
