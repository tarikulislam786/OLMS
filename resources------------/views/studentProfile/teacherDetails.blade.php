@extends('admin.master')
@section('title', 'Course List')
@section('stylesheet')
    <style>
        .mar_top_20px {
            margin-top: 20px;
        }

        .nav-tabs {
            margin-bottom: -1px;
        }

        .tab-content {
            min-height: 250px;
            background-color: #ffffff;
            padding: 10px;
            border: 1px solid #dddddd;
        }

        .well {
            padding: 10px;
        }
        .bg-info { margin-right: 2px; }
    </style>
@stop
@section('head_scripts')
@stop
@section('content')

    <div class="bg-light lter b-b wrapper-md">
        <div class="col-sm-6"><h1 class="m-n font-thin h3">Teacher Information</h1></div>
        <div class="clearfix"></div>
    </div>

    <div class="wrapper-md">
        <div class="row">
            <div class="col-sm-12">

                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img src="{{asset('images/teacher-img/'.$teacher->image)}}" alt="{{$teacher->first_name.' '.$teacher->last_name}}" width="120">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{$teacher->first_name.' '.$teacher->last_name}}</h4>
                        <p>{{$teacher->designation}}</p>
                        <p>{{$teacher->area_of_interest}}</p>
                        <p>+{{$teacher->phone}}</p>
                        <p>{{$teacher->email}}</p>
                    </div>
                </div>

                <div class="panel panel-info mar_top_20px">
                    <div class="panel-heading">
                        Courses of {{$teacher->first_name.' '.$teacher->last_name}}
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Course</th>
                                <th>Code</th>
                                <th>Session</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teacherCourses as $teacherCourse)
                                <tr>
                                    <td>{{$teacherCourse->name}}</td>
                                    <td>{{$teacherCourse->code}}</td>
                                    <td>{{$teacherCourse->session}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>

        </div>

    </div>
@stop
@section('scripts')



@stop

