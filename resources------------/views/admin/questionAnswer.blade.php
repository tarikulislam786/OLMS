@extends('admin.master')

@section('title', 'Question-Answer')
@section('stylesheet')
    <style>
        .text-white {
        }
        .answer {
            background-color: #aeeaae;
        }
        .answer .arrow.left::after {
            border-right-color: #aeeaae;
        }
        .answer .arrow.left {
            border-right-color: #27c24c;
        }
        .question {
            background-color: #b3d8ff;
        }
        .question .arrow.left::after {
            border-right-color: #b3d8ff;
        }

        .question .arrow.left {
            border-right-color: #16aad8;
        }

    </style>
@stop
@section('content')
    <div class="bg-light lter b-b wrapper-md">
        <div class="col-sm-6"><h1 class="m-n font-thin h3"> {{$question->topic}} Question Answer </h1></div>
        <div class="col-sm-6 text-right">
            @if (Session::get('message') == true)
                <span class="text-info message">{{Session::get('message')}}</span>
            @endif
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
                                <div>
                                    <p class="pull-left thumb-sm avatar m-l-n-md">
                                        @if($question->role == 1)
                                            <img src="{{asset('images/teacher-img/'.$question->image)}}"
                                                 class="img-circle" alt="...">
                                        @elseif($question->role == 2)
                                            <img src="{{asset('images/student-img/'.$question->image)}}"
                                                 class="img-circle" alt="...">
                                        @endif
                                    </p>

                                    <div class="m-l-lg panel b-a" style="border-color: #16aad8;">
                                        <div class="panel-heading pos-rlt b-b b-light question">
                                            <span class="arrow left"></span>
                                            @if($question->user_id == Auth::user()->id)
                                                By Me
                                            @else
                                                <a href="">{{$question->first_name}} {{$question->last_name}}</a>
                                                @if($question->role == 1)
                                                    <label class="label bg-success m-l-xs">Teacher</label>
                                                @elseif($question->role == 2)
                                                    <label class="label bg-info m-l-xs">Student</label>
                                                @endif
                                            @endif

                                            <span class="text-white m-l-sm pull-right">
                                                @if(Auth::user()->role == 1)
                                                    <a href="{{url('/teacher/delete-question/'.$question->question_id)}}" onclick="return yesDetete()"><i class="fa fa-times-circle-o"></i></a>
                                                @endif
                                                <i class="fa fa-clock-o"></i>
                                                {{date('d M Y, G:ia', strtotime($question->created_at))}}
                                              </span>
                                        </div>
                                        <div class="panel-body">
                                            <div>{{$question->question}}</div>
                                            <a class="btn btn-default btn-xs" style="margin-top: 10px;" role="button"
                                               data-toggle="collapse"
                                               href="#collapse_form" aria-expanded="false"
                                               aria-controls="collapsecollapse"><i
                                                        class="fa fa-mail-reply text-muted"></i> Reply
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <div class="collapse" id="collapse_form" style="margin-left: 30px;">
                                    {{--@if(!isset($answers))--}}
                                    {{--                                                @if(Auth::user()->role == 1)--}}
                                    <h4 class="h4">Answer</h4>

                                    <div class="panel panel-default m-t-md m-b-n-sm pos-rlt">


                                        @if(Auth::user()->role==1)
                                            {!! Form::open(['url'=>'/teacher/answer']) !!}
                                        @elseif(Auth::user()->role==2)
                                            {!! Form::open(['url'=>'/student/answer']) !!}
                                        @endif

                                        <textarea class="form-control no-border" rows="3" name="answer" placeholder="Your answer..." required></textarea>
                                        <input type="hidden" name="question_id" value="{{$question->question_id}}">
                                        <div class="panel-footer bg-light lter">
                                            <button type="submit" class="btn btn-info pull-right btn-sm"><i
                                                        class="fa fa-mail-reply"></i> Send Reply
                                            </button>
                                            <div class="clearfix"></div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    {{--@endif--}}
                                    {{--@endif--}}

                                </div>

                            </div>
                        </div>

                    </div>
                </div>


                <div class="panel panel-info">
                    <div class="panel-body">


                        <div class="padder">
                            <div class="streamline b-l b-info m-l-lg m-b padder-v">
                                <div>


                                    @foreach($answers as $answer)
                                        <p class="pull-left thumb-sm avatar m-l-n-md">
                                            @if($answer->role == 1)
                                                <img src="{{asset('images/teacher-img/'.$answer->image)}}"
                                                     class="img-circle" alt="...">
                                            @elseif($answer->role == 2)
                                                <img src="{{asset('images/student-img/'.$answer->image)}}"
                                                     class="img-circle" alt="...">
                                            @endif
                                        </p>
                                        <div class="m-l-lg panel b-a" style="border-color: #27c24c;">
                                            <div class="panel-heading pos-rlt b-b b-light answer">
                                                <span class="arrow left"></span>
                                                @if($answer->user_id == Auth::user()->id)
                                                    By Me
                                                @else
                                                    <a href="">{{$answer->first_name}} {{$answer->last_name}}</a>

                                                    @if($answer->role == 1)
                                                        <label class="label bg-success m-l-xs">Teacher</label>
                                                    @elseif($answer->role == 2)
                                                        <label class="label bg-info m-l-xs">Student</label>
                                                    @endif
                                                @endif


                                                <span class="text-white m-l-sm pull-right">
                                                    @if(Auth::user()->role == 1)
                                                        <a href="{{url('/teacher/delete-answer/'.$answer->answer_id)}}" onclick="return yesDetete()"><i class="fa fa-times-circle-o"></i></a>
                                                    @endif
                                                    <i class="fa fa-clock-o"></i>
                                                    {{date('d M Y, G:ia', strtotime($answer->created_at))}}
                                                  </span>
                                            </div>
                                            <div class="panel-body">
                                                <div>{{$answer->answer}}</div>
                                                <p style="margin-top: 10px; margin-bottom: 0px;">
                                                    <a class="btn btn-default btn-xs" role="button"
                                                       data-toggle="collapse"
                                                       href="#collapse_{{$answer->answer_id}}" aria-expanded="false"
                                                       aria-controls="collapsecollapse_{{$answer->answer_id}}">
                                                        <i class="fa fa-comments"></i> Comments
                                                    </a>

                                                    <?php
                                                    foreach($commentsCount as $cc)
                                                    {?>
                                                    @if($cc->answer_id == $answer->answer_id && $cc->count>0)
                                           <span class="pull-right">{{$cc->count}} comment<?php if($cc->count>1){echo 's';}?></span>
                                                        <?php break; ?>
                                                    @endif
                                                    <?php }

                                                    ?>
                                                </p>
                                            </div>
                                        </div>




                                        <div class="collapse" id="collapse_{{$answer->answer_id}}">
                                            @foreach($comments as $comment)
                                                @if($comment->answer_id == $answer->answer_id)
                                                    <div class="m-l-lg comments" style="margin-left: 50px;">
                                                        <p class="pull-left thumb-sm avatar m-l-n-md">
                                                            @if($comment->role == 1)
                                                                <img src="{{asset('images/teacher-img/'.$comment->image)}}"
                                                                     class="img-circle" alt="...">
                                                            @elseif($comment->role == 2)
                                                                <img src="{{asset('images/student-img/'.$comment->image)}}"
                                                                     class="img-circle" alt="...">
                                                            @endif
                                                        </p>

                                                        <div class="m-l-lg panel b-a">
                                                            <div class="panel-heading pos-rlt b-b b-light">
                                                                <span class="arrow left"></span>
                                                                @if($comment->user_id == Auth::user()->id)
                                                                    By Me
                                                                @else
                                                                    <a href="">{{$comment->first_name}} {{$comment->last_name}}</a>
                                                                    @if($comment->role == 1)
                                                                        <label class="label bg-success m-l-xs">Teacher</label>
                                                                    @elseif($comment->role == 2)
                                                                        <label class="label bg-warning m-l-xs">Student</label>
                                                                    @endif
                                                                @endif

                                                                <span class="text-muted m-l-sm pull-right">
                                                                    @if(Auth::user()->role == 1)
                                                                        <a href="{{url('/teacher/delete-comment/'.$comment->comment_id)}}" onclick="return yesDetete()"><i class="fa fa-times-circle-o"></i></a>
                                                                    @endif
                                                        <i class="fa fa-clock-o"></i>
                                                                    {{date('d M Y, G:ia', strtotime($comment->created_at))}}
                                                      </span>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div>{{$comment->comment}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                            <div class="m-l-lg m-b-lg" style="margin-left: 80px;">
                                                <div class="panel panel-default m-t-md m-b-n-sm pos-rlt">

                                                    @if(Auth::user()->role==1)
                                                        {!! Form::open(['url'=>'/teacher/comment']) !!}
                                                    @elseif(Auth::user()->role==2)
                                                        {!! Form::open(['url'=>'/student/comment']) !!}
                                                    @endif

                                                    <textarea required class="form-control no-border" rows="3"
                                                              name="comment" placeholder="Your comment..."></textarea>
                                                    <input type="hidden" name="answer_id"
                                                           value="{{$answer->answer_id}}">

                                                    <div class="panel-footer bg-light lter">
{{--<<<<<<< HEAD--}}
                                                        @if (Session::get('message') == true)
                                                            <span class="text-info message">{{Session::get('message')}}</span>
                                                        @endif
                                                        <button type="submit" class="btn btn-info pull-right btn-sm"><i
                                                                    class="fa fa-comment-o"></i> Send Comment
                                                        </button>
{{--=======--}}
                                                        {{--<button type="submit" class="btn btn-info pull-right btn-sm"><i class="fa fa-comment-o"></i> Send Comment</button>--}}
{{-->>>>>>> 58134120e22ae26406a3c0d04fc2effe4c686632--}}
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>



                                    @endforeach

                                    <div class="m-l-lg m-b-lg">

                                        <div class="m-b-xs">

                                            <h4 class="h4">
                                                {{--{{Auth::user()->first_name}} {{Auth::user()->last_name}}--}}
                                            </h4>
                                            {{--<span class="text-muted m-l-sm pull-right">--}}
                                            {{--4h ago--}}
                                            {{--</span>--}}
                                            <div class="m-b">

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        setTimeout(function () {
            $('.message').slideUp();
        }, 4000);
    </script>
@stop