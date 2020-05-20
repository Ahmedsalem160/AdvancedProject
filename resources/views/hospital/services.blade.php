
@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md h3">
                    Doctor>>{{$doctorName}}
                </div>
                <!-- Table-->
                <table class="table table-striped table-hover " style="margin-top: 40px">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Processing</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(isset($services)&& $services->count()>0)
                        @foreach($services as $service)
                            <tr>
                                <td>{{$service->id}}</td>
                                <td>{{$service->name}}</td>

                                <td>
                                <a href="#" class="btn btn-success">Wait</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <!--END Table-->
                <br> <br><h2>Adding Services</h2>
                <!--Form -->
                <form method="Post" action="{{route('save.services.ToDoctor')}}" >
                @csrf
                <!-- select list Doctors  -->
                    <div class="form-group">
                        <label for="name">Choose Doctor</label>
                        <select name="doctor_id" class="form-control">
                            @if(isset($doctors) && $doctors->count()>0)
                                @foreach($doctors as $doctor)
                                <option value="{{$doctor->id}}" class="form-control">{{$doctor->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <!-- select list Services  -->
                    <div class="form-group">
                        <label for="name">Choose Service</label>
                        <select name="service_id[]" class="form-control" multiple>
                            @if(isset($allServices) && $allServices->count()>0)
                                @foreach($allServices as $allService)
                                    <option value="{{$allService->id}}">{{$allService->name}}</option>
                                @endforeach
                            @endif

                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary">Adding Service</button>
                </form>
                <!--END Form -->

            </div>

        </div>
    </div>
@stop
