@extends('admin.master')

@section('title', 'Course List')
@section('stylesheet')

@stop
@section('content')
    <div class="bg-light lter b-b wrapper-md">
        <div class="col-sm-6">
            <h1 class="m-n font-thin h3">Course List</h1>
        </div>
        <div class="col-sm-6 text-right">
            {{--<a href="{{url('/admin/course-lecture')}}" class="btn m-b-xs btn-sm btn-primary btn-addon"><i class="fa fa-plus"></i>Add Course</a>--}}
        </div>
        <div class="clearfix"></div>
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
                        <div class="courseSection">
                            <div class="row">
                                @foreach($courses as $course)
                                    <div class="col-sm-4">
                                        <div class="item" style="@if($course->current_session==1) background-color: rgba(118, 241, 147, 0.42) @endif">
                                            <a href="{{url('/teacher/teacher-courses/'.$course->id)}}">
                                                <div class="course_img">
                                                    @if(!empty($course->image))
                                                        <img src="{{asset('')}}{{env('filemanager_upload_source')}}{{$course->image}}" class="img-responsive">
                                                    @else
                                                        <img src="{{asset('img/p0.jpg')}}" alt="" class="img-responsive">
                                                    @endif
                                                </div>
                                                <div class="course_info">
                                                    <p><b>{{$course->code}}: {{$course->name}}</b></p>
                                                    <p>Session: {{$course->session}}</p>
                                                    <p>Credit: {{$course->credit}}</p>

                                                    {{--@if($course->total>0)<p style="padding-top: 5px; color:#B11815">Blocked Students:  {{$course->total}} </p> @endif--}}
                                                </div>
                                            </a>

                                            <?php

                                            $status = App\Model\TeacherCourse::getCourseStatusByCourseID($course->id);

                                            ?>

                                            @if($status[3]>0)<a style="margin-right: 10px;" class="label bg-success" href="{{url('/teacher/student-request')}}">Approved Students:  {{$status[3]}} </a> @endif
                                            @if($status[2]>0)<a style="margin-right: 10px;"  class="label bg-info" href="{{url('/teacher/student-request')}}">Pending:  {{$status[2]}} </a> @endif
                                            @if($status[0]>0)<a style="margin-right: 10px; background-color: #B6172D;"  class="label bg-info" href="{{url('/teacher/student-request')}}">Blocked:  {{$status[0]}} </a> @endif
                                            @if($status[1]>0)<a style="margin-right: 10px;"  class="label bg-warning"   href="{{url('/teacher/student-request')}}">Rejected:  {{$status[1]}} </a> @endif
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        {{--</ul>--}}
                    </div>
                    {{--<footer class="panel-footer">--}}

                    {{--</footer>--}}
                </div>

                </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#form1").change(function() {//alert('hello');
                var curVal = $(".selection:selected").val();
                //alert(curVal);
                if (curVal.indexOf('http://') == 0) {
                    window.location.href = this.value;
                }
            });
        });
    </script>
@stop