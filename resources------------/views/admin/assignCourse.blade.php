@extends('admin.master')
@section('title', 'Assign Teacher to Course')
@section('stylesheet')
    <style>
        .cross {
            line-height: 1.3;
        }

        .popover-content {
            width: 270px;
            padding: 5px;
        }

        .popover-markup {
            width: 205px;
            float: left;
        }

        .content {
            width: 250px;
            height: 100px;
        }

        .contentleft {
            width: 70px;
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
    </style>
@stop
@section('content')
    <div class="bg-light lter b-b wrapper-md">
        <div class="col-sm-6"><h1 class="m-n font-thin h3">Assign Teacher to Course</h1></div>
        <div class="col-sm-6 text-right">
            @if (Session::get('message') == true)
                <span class="message label bg-info m-l-xs">{{Session::get('message')}}</span>
            @endif
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="wrapper-md" ng-controller="FormDemoCtrl">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-info">
                    <div class="panel-heading font-bold">
                        <div class="row">
                            <div class="col-sm-4">Assign Teacher to Course</div>
                            <div class="col-sm-8 pull-right">
                                <div class="row">
                                    {!! Form::open(['url'=>'/admin/assigncourse']) !!}
                                    <div class="col-sm-4 pull-right">
                                        <select name="session_id" class="form-control input-sm" id="form1"
                                                onchange='this.form.submit()'>
                                            @foreach($sessions as $session)
                                                <option @if($session->id == $sessionFilterId) selected
                                                        @endif value="{{$session->id}}">{{$session->session}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4 pull-right">
                                        <select name="discipline_id" class="form-control input-sm" id="form1"
                                                onchange='this.form.submit()'>
                                            <option class="selection" value="all">All</option>
                                            @foreach($disciplines as $discipline)
                                                <option @if($discipline->id == $disciplineFilterId) selected
                                                        @endif  value="{{$discipline->id}}">{{$discipline->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {!! Form::close() !!}
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="50">Image</th>
                                <th width="100">Code</th>
                                <th>Course Name</th>
                                <th width="70">Credit</th>
                                <th width="400">Discipline</th>
                                <th width="100">Teacher Assigned</th>
                                <th width="70" class="text-center">Assign</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($courses))
                                @foreach($courses as $course)
                                    <tr>
                                        <td width="50">
                                            @if($course->image != null)
                                                <img src="{{asset('')}}{{env('filemanager_upload_source')}}{{$course->image}}"
                                                     alt="" width="45">
                                            @else
                                                <img src="{{asset('img/p0.jpg')}}" alt="" width="45">
                                            @endif
                                        </td>
                                        <td>
                                            {{$course->code}}
                                        </td>
                                        <td>
                                            {{$course->name}}
                                        </td>
                                        <td>
                                            {{$course->credit}}
                                        </td>
                                        <td>{{$course->disciplineName}}</td>
                                        <td width="250">
                                            @foreach($teacherCourses as $teacherCourse)
                                                @if($course->id == $teacherCourse->course_id)

                                                    <div class="popover-markup">
                                                        <a href="#" class="trigger">
                                                            {{$teacherCourse->first_name.' '.$teacherCourse->last_name}}
                                                        </a>

                                                        <div class="content hide">

                                                            <div class="contentleft">
                                                                @if($teacherCourse->image != null)
                                                                    <img class=""
                                                                         src="{{asset('images/student-img/'.$teacherCourse->image)}}"
                                                                         width="100%" style="">
                                                                @else
                                                                    <img class="" src="{{asset('img/p0.jpg')}}"
                                                                         width="100%" style="">
                                                                @endif
                                                            </div>
                                                            <div class="contentright">
                                                                <p>{{$teacherCourse->first_name.' '.$teacherCourse->last_name}}</p>

                                                                <p>{{$teacherCourse->designation}}</p>

                                                                <p>{{$teacherCourse->phone}}</p>

                                                                <p>{{$teacherCourse->email}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <a onclick="return yesDetete()" title="Remove From Assign"
                                                       href="{{URL::to('/admin/teacher-remove/'.$teacherCourse->assign_id)}} "
                                                       class="pull-right" id="teacher{{$teacherCourse->teacher_id}}"> <i
                                                                class="fa fa-times"></i>
                                                    </a>
                                                    <?php echo "<br/>";?>
                                                @endif

                                            @endforeach

                                        </td>
                                        <td width="70" class="text-center">

                                            <a title="Assign" data-toggle="modal" data-target="#myModal_{{$course->id}}"
                                               href="#"
                                               class="btn btn-xs btn-info">Add
                                            </a>

                                            <div class="modal fade" id="myModal_{{$course->id}}" tabindex="-1"
                                                 role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">

                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Assign Teacher to
                                                                Course</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {!! Form::open(['url'=>'/admin/teacher-course-assign']) !!}
                                                            <div class="form-group text-left">
                                                                <label>Teacher Name</label>

                                                                <select name="teacher_id"
                                                                        class="form-control input-sm teacher">
                                                                    <?php
                                                                    echo App\Model\TeacherCourse::getAllUnAssignedTeachers($course);
                                                                    ?>
                                                                </select>

                                                            </div>
                                                            <input type="hidden" name="course_id"
                                                                   value="{{$course->id}}">
                                                            <input type="hidden" name="session_id"
                                                                   value="{{$course->session_id}}">
                                                            <button type="submit" class="btn btn-primary pull-right">
                                                                Add
                                                            </button>
                                                            <div class="clearfix"></div>
                                                            {!! Form::close() !!}
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

                                    </tr>
                                @endforeach
                            @elseif(isset($teacherCoursesByFilter))
                                @foreach($teacherCoursesByFilter as $teacherCourseByFilter)
                                    <tr>
                                        <td>
                                            {{$teacherCourseByFilter->coursename}}
                                        </td>
                                        <td>{{$teacherCourseByFilter->disciplinename}}</td>
                                        <td width="250">
                                            @foreach($teacherCourses as $teacherCourse)
                                                @if($teacherCourseByFilter->id == $teacherCourse->course_id)

                                                    <div class="popover-markup">
                                                        <a href="#" class="trigger">
                                                            {{$teacherCourse->first_name.' '.$teacherCourse->last_name}}
                                                        </a>

                                                        <div class="content hide">

                                                            <div class="contentleft">
                                                                @if($teacherCourse->image != null)
                                                                    <img class=""
                                                                         src="{{asset('images/teacher-img/'.$teacherCourse->image)}}"
                                                                         width="100%" style="">
                                                                @else
                                                                    <img class="" src="{{asset('img/p0.jpg')}}"
                                                                         width="100%" style="">
                                                                @endif
                                                            </div>
                                                            <div class="contentright">
                                                                <p>{{$teacherCourse->first_name.' '.$teacherCourse->last_name}}</p>

                                                                <p>{{$teacherCourse->designation}}</p>

                                                                <p>{{$teacherCourse->phone}}</p>

                                                                <p>{{$teacherCourse->email}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <?php echo "<br/>";?>
                                                @endif

                                            @endforeach

                                        </td>

                                        <td width="70" class="text-center">

                                            <a title="Assign" data-toggle="modal"
                                               data-target="#myModal_{{$teacherCourseByFilter->id}}"
                                               href="#"
                                               class="btn btn-xs btn-info">Add
                                            </a>

                                            <div class="modal fade" id="myModal_{{$teacherCourseByFilter->id}}"
                                                 tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">

                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Assign Teacher to
                                                                Course</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {!! Form::open(['url'=>'/admin/teacher-course-assign']) !!}
                                                            <div class="form-group text-left">
                                                                <label>Teacher Name</label>

                                                                <select name="teacher_id"
                                                                        class="form-control input-sm teacher">
                                                                    <?php
                                                                    echo App\Model\TeacherCourse::getAllUnAssignedTeachers($teacherCourseByFilter);
                                                                    ?>
                                                                </select>

                                                            </div>
                                                            <input type="hidden" name="course_id"
                                                                   value="{{$teacherCourseByFilter->id}}">
                                                            <button type="submit" class="btn btn-primary pull-right">
                                                                Add
                                                            </button>
                                                            <div class="clearfix"></div>
                                                            {!! Form::close() !!}
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

                                    </tr>

                                @endforeach

                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
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
            placement: 'left',
            trigger: 'hover'
        });
    </script>

    {{--<script type="text/javascript">--}}
    {{--$(document).ready(function () {--}}
    {{--$("#form1").change(function () {//alert('hello');--}}
    {{--var curVal = $(".selection:selected").val();--}}
    {{--//alert(curVal);--}}
    {{--if (curVal.indexOf('http://') == 0) {--}}
    {{--window.location.href = this.value;--}}
    {{--}--}}
    {{--});--}}
    {{--});--}}
    {{--</script>--}}

@stop