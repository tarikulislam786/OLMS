@extends('admin.master')

@section('title', 'Question-List')
@section('stylesheet')
@section('stylesheet')
    <style>
        .pos-rlt { border: 1px solid #dddddd; margin-bottom: 10px; }
    </style>
@stop
@section('content')
    <div class="bg-light lter b-b wrapper-md">
        <div class="col-sm-6">

            <h1 class="m-n font-thin h3">Lectures of {{$courseDetails->code}}: {{$courseDetails->name}} </h1>
            <h4>Session: {{$courseDetails->session}}</h4>
            <h5>Credit: {{$courseDetails->credit}}</h5>
            <h5>

                <?php
                echo "By: ";
                $teachers = App\Model\TeacherCourse::getAllAssignedTeacherList($courseDetails->id);
                foreach($teachers as $teacher)
               {
                    echo '<span style=" padding-right:10px;"><a class="label bg-info" href="'.url('/student/teacher-details/' . $teacher->teacher_id) . '">' . $teacher->first_name . ' ' . $teacher->last_name . '</a></span>';

                }
                ?>

            </h5>


        </div>
        <div class="col-sm-6 text-right">
            <a style="margin-top: 80px;" href="{{url('/teacher/teacher-courses'.'/'.$courseDetails->id)}}" class="btn m-b-xs btn-sm btn-success btn-addon"><i class="fa fa-mail-reply"></i>Back to Course Detail</a>

        </div>
        <div class="clearfix"></div>
    </div>
    <div class="wrapper-md">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-info">

                    <div class="panel-body">

                        <div class="padder">
                            <div class="streamline b-l b-info m-l-lg m-b padder-v">
                                @foreach($questions as $question)
                                <div>
                                    <p class="pull-left thumb-sm avatar m-l-n-md">
                                        @if($question->user_role == 1)
                                            <img src="{{asset('images/teacher-img/'.$question->user_image)}}" class="img-circle" alt="...">
                                        @elseif($question->user_role == 2)
                                            <img src="{{asset('images/student-img/'.$question->user_image)}}" class="img-circle" alt="...">
                                        @endif
                                    </p>

                                    <div class="m-l-lg">
                                        <div class="m-b-xs">
                                            <a href="" class="h4"></a>
                                            <div class="panel-heading pos-rlt">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <span class="arrow left pull-up"></span>
                                                        <a href="{{url('/teacher/question-answer/'.$question->id)}}" class="btn-link text-underline">{{$question->question}}</a>
                                                    </div>
                                                    <div class="col-sm-6" style="text-align: right">
                                                        By: <a style="color:blue" href="#">{{$question->first_name}} {{$question->last_name}}</a> <br>
                                                        <span style="font-size: 10px">Date: {{date('d M Y, G:ia', strtotime($question->created_at))}}</span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                @endforeach

                                    <div class="m-l-lg">
                                        <div class="m-b-xs">
                                            <div class="panel panel-default m-t-md m-b-n-sm pos-rlt">
                                                {!! Form::open(['url'=>'/teacher/question']) !!}
                                                <textarea class="form-control no-border" rows="3" name="question" placeholder="Your question..."></textarea>
                                                <input type="hidden" name="course_lecture_id" value="{{$lectures->id}}">
                                                <div class="panel-footer bg-light lter">
                                                    <button type="submit" class="btn btn-info pull-right btn-sm">Ask Question</button>
                                                    <div class="clearfix"></div>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                            {{--</div>--}}
                                        </div>
                                    </div>
                            </div>
                        </div>
                        @if (Session::get('message') == true)
                            <div class="alert alert-success fade in message mar_top_20px" role="alert">
                                {{Session::get('message')}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        setTimeout(function(){
            $('.message').slideUp();
        }, 4000);
    </script>
@stop