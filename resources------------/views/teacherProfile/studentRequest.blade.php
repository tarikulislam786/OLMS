@extends('admin.master')

@section('title', 'Student Request')
@section('stylesheet')
    <style>
        .mar_top_20px {
            margin-top: 20px;
        }

        .popover-content {
            width: 270px;
            padding: 5px;
        }

        .content {
            width: 250px;
        }

        .contentleft {
            width: 80px;
            float: left;
            margin-right: 5px;
        }

        .contentright {
            width: auto;
            overflow: hidden;
        }

        .contentright p {
            font-size: 11px;
            margin-bottom: 2px;
        }

        .content .contentright p {
            float: right;
            text-align: right
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

        .iapprove input:checked + i {
            border-color: green;
        }
        .iapprove input:checked + i:before {
            background-color: green;
        }

        .iblock input:checked + i {
            border-color: #CA1E1E;
        }
        .iblock input:checked + i:before {
            background-color: #CA1E1E;
        }

        .ireject input:checked + i {
            border-color: gray;
        }
        .ireject input:checked + i:before {
            background-color: gray;
        }


    </style>
@stop
@section('head_scripts')
@stop
@section('content')

    <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">Student Request</h1>
    </div>
    <div class="wrapper-md">
        <div class="row">
            <div class="col-sm-12">

                <div class="panel panel-info">
                    <div class="panel-heading font-bold">
                        <div class="row">
                            <div class="col-sm-4">
                                Student Request
                                {{--@if($requestStatusId == 1) New @endif--}}
                                {{--@if($requestStatusId == 2) Approved @endif--}}
                                {{--@if($requestStatusId == -1) Block @endif--}}
                                {{--@if($requestStatusId == 0) Rejected @endif--}}
                            </div>
                            <div class="col-sm-8 pull-right">
                                <div class="row">
                                    {!! Form::open(['url'=>'teacher/student-request']) !!}
                                    <div class="col-sm-4 pull-right">
                                        <select name="status" class="form-control input-sm" id="form1"
                                                onchange='this.form.submit()'>
                                            <option @if($requestStatusFilterId == 1) selected @endif value="1">New @if($new>0) ({{$new}})@endif</option>
                                            <option @if($requestStatusFilterId == 2) selected @endif value="2">Approved @if($approve>0)({{$approve}})@endif</option>
                                            <option @if($requestStatusFilterId == -1) selected @endif value="-1">Blocked @if($block>0)({{$block}})@endif</option>
                                            <option @if($requestStatusFilterId == 0) selected @endif value="0">Rejected @if($reject>0)({{$reject}})@endif</option>
                                        </select>
                                    </div>

                                    {{--<div class="col-sm-4 pull-right">--}}
                                        {{--<select name="course_id" class="form-control input-sm" id="form1"--}}
                                                {{--onchange='this.form.submit()'>--}}
                                            {{--<option value="all">Select Course</option>--}}
                                            {{--@foreach($courses as $course)--}}
                                                {{--<option @if($courseID== $course->id) selected @endif value="{{$course->id}}">{{$course->name}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">

                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th style="width:100px">Photo</th>
                                <th style="width:100px">Roll#</th>
                                <th>Student Name</th>
                                <th>Department</th>
                                <th>Requested Course</th>
                                <th width="250">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($studentRequests as $studentRequest)
                                <tr>
                                    <td><img class=""
                                             src="{{asset('images/student-img/'.$studentRequest->image)}}"
                                             width="60px" style=""></td>

                                    <td>{{$studentRequest->roll_no}}</td>

                                    <td>
                                        <div class="popover-markup">
                                            <a href="#" class="trigger">{{$studentRequest->first_name.' '.$studentRequest->last_name}}</a>

                                            <div class="content hide">

                                                <div class="contentleft">
                                                    <img class="" src="{{asset('images/student-img/'.$studentRequest->image)}}" width="100%" style="">
                                                </div>
                                                <div class="contentright">
                                                    <p>{{$studentRequest->first_name.' '.$studentRequest->last_name}}</p>
                                                    <p>Roll : {{$studentRequest->roll_no}}</p>
                                                    <p>Discipline : {{$studentRequest->discipline_short_name}}</p>
                                                    <p>Phone : {{$studentRequest->phone}}</p>
                                                    <p>Email : {{$studentRequest->email}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="myModal_{{$studentRequest->user_id}}"
                                             tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"
                                                            id="myModalLabel">{{'Student Details Of '.$studentRequest->first_name.' '.$studentRequest->last_name}}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>First Name : {{$studentRequest->first_name}}</p>
                                                        <p>Last Name : {{$studentRequest->last_name}}</p>
                                                        <p>Roll : {{$studentRequest->roll_no}}</p>
                                                        <p>Discipline : {{$studentRequest->discipline_short_name}}</p>
                                                        <p>Phone : {{$studentRequest->phone}}</p>
                                                        <p>Email : {{$studentRequest->email}}</p>
                                                        <p>Area Of Interest : {{$studentRequest->area_of_interest}}</p>
                                                        <p>Photo :</p><img src="{{asset('images/student-img/'.$studentRequest->image)}}" style="width: 150px">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td> {{$studentRequest->discipline_full_name}}</td>
                                    <td>{{$studentRequest->code}}: {{$studentRequest->course_name}}</td>

                                    <td width="170">
                                        {!! Form::open(['url'=>'/teacher/teacher-course-request-approve']) !!}
                                        <input type="hidden" name="course_id" value="{{$studentRequest->student_course_id}}">
                                        <div>
                                            <label style="padding-right: 5px;" class="i-checks iapprove">
                                                <input @if($studentRequest->status == "2") checked @endif onchange="this.form.submit()" type="radio" name="status" value="2" id="feature_approve">
                                                <i></i>Approve
                                            </label>
                                            <label  style="padding-right: 5px;" class="i-checks iblock">
                                                <input @if($studentRequest->status == "-1") checked @endif onchange="this.form.submit()" type="radio" name="status" value="-1" id="feature_block">
                                                <i></i>Block
                                            </label>
                                            <label  style="padding-right: 5px;" class="i-checks ireject">
                                                <input @if($studentRequest->status == "0") checked @endif onchange="this.form.submit()" type="radio" name="status" value="0" id="feature_reject">
                                                <i></i>Reject
                                            </label>
                                        </div>

                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                {{--@endif--}}
                            @endforeach
                            </tbody>
                        </table>
                        @if(!empty($studentRequests))
                            <div class="pull-right">
                                {!! Form::open(['url'=>'/teacher/teacher-course-all-request-approve']) !!}
                                <?php
                                $i = 0;
                                ?>
                                @foreach($studentRequests as $studentRequest)
                                    <input type="hidden" name="approvedStudentId{{$i++}}"
                                           value="{{$studentRequest->student_id}}">
                                @endforeach
                                {{--<button type="submit" class="btn btn-success btn-sm" id="approveall">Approve All--}}
                                {{--</button>--}}
                                {!! Form::close() !!}
                            </div>
                        @endif
                    </div>

                </div>


            </div>

        </div>
    </div>

@stop
@section('scripts')

    <script>
        setTimeout(function () {
            $('.message').slideUp();
        }, 4000);
    </script>

    <script>
        $('.popover-markup > .trigger').popover({
            html: true,
            title: function () {
                return $(this).parent().find('.head').html();
            },
            content: function () {
                return $(this).parent().find('.content').html();
            },
            container: 'body',
            placement: 'right',
            trigger: 'hover'
        });
    </script>
@stop


