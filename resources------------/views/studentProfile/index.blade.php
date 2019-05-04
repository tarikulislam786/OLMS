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

        .bg-info {
            margin-right: 2px;
        }
    </style>
@stop
@section('head_scripts')
@stop
@section('content')

    <div class="bg-light lter b-b wrapper-md">
        <div class="row">
            <div class="col-sm-6"><h1 class="m-n font-thin h3">Course List</h1></div>
            {{--@include('studentProfile.profileHeader')--}}
        </div>
    </div>

    <div class="wrapper-md">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-info">
                    <div class="panel-heading font-bold">
                        <div class="row">
                            <div class="col-sm-6">Course List</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="100px">Code</th>
                                <th>Course Name</th>
                                <th width="20px" style="text-align: center">Credits</th>
                                <th width="100px" style="text-align: center">Session</th>
                                <th>Teachers</th>


                                <th width="100" style="text-align: center">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($all_course_teacher) != null)
                                @foreach($all_course_teacher as $course_teacher)
                                    <tr>
                                        <td>{{$course_teacher->code}}</td>
                                        <td>{{$course_teacher->name}}</td>
                                        <td style="text-align: center">{{$course_teacher->credit}}</td>
                                        <td style="text-align: center">{{$course_teacher->session}}</td>
                                        <td>
                                            <?php

                                            $teachers = App\Model\TeacherCourse::getAllAssignedTeacherList($course_teacher->course_id);
                                            foreach ($teachers as $teacher) {
                                            ?>
                                            <a href="{{url('/student/teacher-details/'.$teacher->teacher_id)}}"
                                               target="_blank"
                                               class="label bg-info">{{$teacher->first_name.' '.$teacher->last_name}}</a>
                                            <?php } ?>
                                        </td>

                                        <td style="text-align: center">

                                            <?php
                                            $status = App\Model\StudentCourse::getStudentStatusByCourseID($course_teacher->course_id, $loggedInStudent->id);
                                            ?>


                                            @if($status==null || $status=="")
                                                @if($course_teacher->current_session==1)
                                                    {!! Form::open(['url'=>'/student/student-course-request']) !!}
                                                    <input type="hidden" name="course_id"
                                                           value="{{$course_teacher->course_id}}">
                                                    <button type="submit" class="btn btn-xs send">Send Request</button>
                                                    {!! Form::close() !!}
                                                @else
                                                    {{'-'}}
                                                @endif
                                            @elseif($status == -1) <span
                                                    style="color:red">{{'Blocked'}}</span>
                                            @elseif ($status== 0) <span
                                                    style="color:red">{{ 'Rejected'}}</span>
                                            @elseif ($status == 1) {{ 'Pending'}}
                                            @elseif($status == 2)
                                                <a href="{{url('student/course-lecture-details/'.$course_teacher->course_id)}}"
                                                   class="btn btn-success btn-xs pull-right">Go to Lecture</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <div class="alert alert-success">
                                    Not Course
                                </div>
                            @endif
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

