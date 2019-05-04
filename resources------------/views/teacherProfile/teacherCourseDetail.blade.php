@extends('admin.master')

@section('title', 'Course Details')
@section('stylesheet')
    <style>
        .mar_top_40px {
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

        .file-list {
            margin: 0px;
            padding-left: 0px;
            list-style-type: none;
        }

        .file-list li {
            width: 100%;
            float: left;
            margin-bottom: 2px;
        }

        .file-list li i {
            margin-right: 5px;
            width: 20px;
        }
        .file-left { width: 90%; float: left; }
        .file-right { width: auto; overflow: hidden; }
    </style>

    <style>
        .input-group {
            width: 100%;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('fancybox/jquery.fancybox.css?v=2.1.5') }}" media="screen"/>
    <script type="text/javascript" src="{{ asset('fancybox/jquery.fancybox.js?v=2.1.5') }}"></script>

@stop
@section('head_scripts')
@stop
@section('content')


    <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">Lectures of {{$courses->code}} : {{$courses->name}}</h1>
        <h4>Session: {{$courses->session}}</h4>
        <h5>Credit: {{$courses->credit}}</h5>
        <h5>
            {{--<a href="{{url('/student/teacher-details/'.$teacher->teacher_id)}}" target="_blank" class="label bg-info">{{$teacher->first_name.' '.$teacher->last_name}}</a>--}}
            <?php
            echo "By: ";
            $teachers = App\Model\TeacherCourse::getAllAssignedTeacherList($courses->id);
            foreach ($teachers as $teacher) {

                    $url = url('/teacher/teacher-details/'.$teacher->teacher_id);

                    echo '<span style=" padding-right:10px;"><a  class="label bg-info" href="'.$url.'">' . $teacher->first_name . ' ' . $teacher->last_name . '</a></span>';
            }
            ?>

        </h5>

    </div>

    <div class="wrapper-md">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-info">
                    <div class="panel-heading font-bold">
                        {{$courses->code}} : {{$courses->name}}
                        <a href="#" data-toggle="modal" data-target="#myModal_{{$courses->id}}"
                           class="btn btn-success btn-xs pull-right">Add Lecture</a>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th width="50">SL</th>
                                <th width="100">Lecture #</th>
                                <th>Topic</th>
                                <th width="600">Contents</th>
                                <th width="250">Comment</th>
                                <th width="80"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lectures as $lecture)
                                @if($lecture->course_id == $courses->id)
                                    <tr>

                                        <td> {{$lecture->sl}}</td>
                                        <td> {{$lecture->lecture_no}}</td>

                                        <td>
                                            {{$lecture->topic}}
                                            <a href="{{url('/teacher/question-list/'.$courses->id.'/'.$lecture->lecture_id)}}"
                                               class="btn btn-success btn-xs pull-right"
                                                    >Question</a>
                                            {{--@foreach($questions as $question)--}}
{{--                                                @if($question->course_lecture_id == $lecture->lecture_id)--}}

                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        </td>


                                        <td>
                                            <ul class="file-list">
                                                <?php

                                                $multimediaContents = App\Model\MultimediaContent::getMultimediaContentByLectureId($lecture->lecture_id);

                                                foreach ($multimediaContents as $multimediaContent) {
                                                $file_path = env('base_url') . "/public/uploads/source/teachers_content/" . $multimediaContent->file_path;
                                                $info = new SplFileInfo($multimediaContent->file_path);

                                                echo '<li>';
                                                echo '<div class="file-left">';
                                                if ($info->getExtension() == 'pdf') {
                                                    echo '<i class="fa fa-file-pdf-o"></i>';
                                                } elseif ($info->getExtension() == 'ppt') {
                                                    echo '<i class="fa fa-file-powerpoint-o"></i>';
                                                } elseif ($info->getExtension() == 'png') {
                                                    echo '<i class="fa fa-picture-o"></i>';
                                                } elseif ($info->getExtension() == 'jpg') {
                                                    echo '<i class="fa fa-picture-o"></i>';
                                                } elseif ($info->getExtension() == 'doc') {
                                                    echo '<i class="fa fa-file-word-o"></i>';
                                                } elseif ($info->getExtension() == 'xls') {
                                                    echo '<i class="fa fa-file-excel-o"></i>';
                                                } elseif ($info->getExtension() == 'mp4' || $info->getExtension() == 'wav' || $info->getExtension() == 'webm') {
                                                    echo '<i class="fa fa-file-video-o"></i>';
                                                } elseif ($info->getExtension() == 'mp3' || $info->getExtension() == 'wav' || $info->getExtension() == 'webm' || $info->getExtension() == 'oga' || $info->getExtension() == 'ogg') {
                                                    echo '<i class="fa fa-file-audio-o"></i>';
                                                } else {
                                                    echo '<i class="fa fa-file"></i>';
                                                }

                                                $file = basename($file_path, "." . $info->getExtension());

                                                echo '<a style="color:blue" href="' . $file_path . '">' . $file . "." . $info->getExtension() . '</a>';
                                                echo '</div>';
                                                ?>
                                                    @if($lecture->teacher_id==Auth::user()->id)
                                                        <div class="file-right">
                                                            <a onclick="return yesDetete()"
                                                               title="Remove From the File."
                                                               href="{{url('/teacher/course-multimedia-delete/'.$multimediaContent->id)}}"
                                                               class="pull-right text-right"
                                                               id="teacher11"> <i class="fa fa-times"></i></a>
                                                        </div>
                                                    @endif
                                                <?php
                                                echo '</li> ';
                                                }
                                                ?>
                                            </ul>
                                        </td>

                                        <td> {{$lecture->comment}}</td>

                                        <td class="text-right" width="100">

                                            @if($lecture->teacher_id==Auth::user()->id)
                                                <a href="#" data-toggle="modal"
                                                   data-target="#lecture_{{$lecture->lecture_id}}"
                                                   class="btn btn-sm btn-icon btn-info"><i
                                                            class="glyphicon glyphicon-edit"></i></a>
                                                <a onclick="return yesDetete()"
                                                   href="{{url('teacher/course-lecture-delete/'.$lecture->lecture_id)}}"
                                                   class="btn btn-sm btn-icon btn-danger"><i
                                                            class="glyphicon glyphicon-trash"></i></a>

                                            @endif

                                            <!-- Modal -->
                                            <div class="modal fade" id="lecture_{{$lecture->lecture_id}}" tabindex="-1"
                                                 role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content text-left">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Update lecture
                                                                of {{$courses->name}}</h4>
                                                        </div>
                                                        {!! Form::open(['url'=>'/teacher/course-lecture-update', 'files'=>true]) !!}

                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-sm-2"><label>SL</label><input
                                                                                type="number" class="form-control"
                                                                                name="sl" value="{{$lecture->sl}}"
                                                                                required/></div>
                                                                    <div class="col-sm-10"><label>Lecture
                                                                            #</label><input type="text"
                                                                                            class="form-control"
                                                                                            name="lecture_no"
                                                                                            value="{{$lecture->lecture_no}}"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Topic</label>
                                                                <input type="text" class="form-control" name="topic"
                                                                       value="{{$lecture->topic}}" required/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Comment</label>
                                                                <input type="text" class="form-control" name="comment"
                                                                       value="{{$lecture->comment}}"/>
                                                            </div>

                                                            <div class="form-group">
                                                                <?php

                                                                $multimediaContents = App\Model\MultimediaContent::getMultimediaContentByLectureId($lecture->lecture_id);

                                                                ?>

                                                                <label>Files (Multimedia Contents) </label>
                                                                <?php
                                                                for($i = 1;$i <= 5;$i++)
                                                                {
                                                                $file_path = "";
                                                                if (isset($multimediaContents[$i - 1])) {
                                                                    $file_path = $multimediaContents[$i - 1]->file_path;
                                                                }
                                                                ?>
                                                                <div class="input-group" style="padding-top: 10px;">
                                                                    <input id="text_uploaded_file_<?php echo $i ?>{{$lecture->lecture_id}}"
                                                                           name="text_uploaded_file_<?php echo $i ?>"
                                                                           type="text" value="{{$file_path}}"
                                                                           class="form-control" readonly=""/>
                                                                        <span class="input-group-btn">
                                                                            <a href="{{env('base_url')}}/filemanager/dialog.php?crossdomain=1&type=0&field_id=text_uploaded_file_<?php echo $i ?>{{$lecture->lecture_id}}&relative_url=1&akey={{Session::get('encrypted_teacher_id')}}"
                                                                               class="iframe-btn_<?php echo $i ?>"
                                                                               type="button">
                                                                                <span class="btn btn-default btn-file"><span
                                                                                            class="glyphicon glyphicon-folder-open"
                                                                                            style="padding-right: 3px;"></span> Choose</span></a>
                                                                        </span>
                                                                </div>

                                                                <?php
                                                                } ?>


                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="lecture_id"
                                                                   value="{{$lecture->lecture_id}}">
                                                            <input type="hidden" name="course_id"
                                                                   value="{{$courses->id}}">
                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">Save changes
                                                            </button>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>


                    {{--Lecture Add Modal--}}
                    <div class="modal fade" id="myModal_{{$courses->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Add new lecture to
                                        {{$courses->name}}</h4>
                                </div>
                                {!! Form::open(['url'=>'/teacher/course-lecture-save']) !!}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-2"><label>SL</label><input type="number"
                                                                                              class="form-control"
                                                                                              name="sl" required/></div>
                                                <div class="col-sm-10"><label>Lecture #</label><input type="text"
                                                                                                      class="form-control"
                                                                                                      name="lecture_no"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Topic</label>
                                            <input type="text" class="form-control" name="topic" required/>
                                        </div>
                                        <div class="form-group">
                                            <label>Comment</label>
                                            <input type="text" class="form-control" name="comment"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Files (Multimedia Contents) </label>

                                        <div class="input-group" style="padding-top: 10px;">
                                            <input id="text_uploaded_file_1" name="text_uploaded_file_1" type="text"
                                                   class="form-control" readonly=""/>
                                            <span class="input-group-btn">
                                                <a href="{{env('base_url')}}/filemanager/dialog.php?crossdomain=1&type=0&field_id=text_uploaded_file_1&relative_url=1&akey={{Session::get('encrypted_teacher_id')}}"
                                                   class="iframe-btn_1" type="button">
                                                    <span class="btn btn-default btn-file"><span
                                                                class="glyphicon glyphicon-folder-open"
                                                                style="padding-right: 3px;"></span> Choose</span></a>
                                            </span>
                                        </div>
                                        <div class="input-group" style="padding-top: 10px;">
                                            <input id="text_uploaded_file_2" name="text_uploaded_file_2" type="text"
                                                   class="form-control" readonly=""/>
                                            <span class="input-group-btn">
                                                <a href="{{env('base_url')}}/filemanager/dialog.php?crossdomain=1&type=0&field_id=text_uploaded_file_2&relative_url=1&akey={{Session::get('encrypted_teacher_id')}}"
                                                   class="iframe-btn_2" type="button">
                                                    <span class="btn btn-default btn-file"><span
                                                                class="glyphicon glyphicon-folder-open"
                                                                style="padding-right: 3px;"></span> Choose</span></a>
                                            </span>
                                        </div>
                                        <div class="input-group" style="padding-top: 10px;">
                                            <input id="text_uploaded_file_3" name="text_uploaded_file_3" type="text"
                                                   class="form-control" readonly=""/>
                                            <span class="input-group-btn">
                                                <a href="{{env('base_url')}}/filemanager/dialog.php?crossdomain=1&type=0&field_id=text_uploaded_file_3&relative_url=1&akey={{Session::get('encrypted_teacher_id')}}"
                                                   class="iframe-btn_3" type="button">
                                                    <span class="btn btn-default btn-file"><span
                                                                class="glyphicon glyphicon-folder-open"
                                                                style="padding-right: 3px;"></span> Choose</span></a>
                                            </span>
                                        </div>
                                        <div class="input-group" style="padding-top: 10px;">
                                            <input id="text_uploaded_file_4" name="text_uploaded_file_4" type="text"
                                                   class="form-control" readonly=""/>
                                            <span class="input-group-btn">
                                                <a href="{{env('base_url')}}/filemanager/dialog.php?crossdomain=1&type=0&field_id=text_uploaded_file_4&relative_url=1&akey={{Session::get('encrypted_teacher_id')}}"
                                                   class="iframe-btn_4" type="button">
                                                    <span class="btn btn-default btn-file"><span
                                                                class="glyphicon glyphicon-folder-open"
                                                                style="padding-right: 3px;"></span> Choose</span></a>
                                            </span>
                                        </div>
                                        <div class="input-group" style="padding-top: 10px;">
                                            <input id="text_uploaded_file_5" name="text_uploaded_file_5" type="text"
                                                   class="form-control" readonly=""/>
                                            <span class="input-group-btn">
                                                <a href="{{env('base_url')}}/filemanager/dialog.php?crossdomain=1&type=0&field_id=text_uploaded_file_5&relative_url=1&akey={{Session::get('encrypted_teacher_id')}}"
                                                   class="iframe-btn_5" type="button">
                                                    <span class="btn btn-default btn-file"><span
                                                                class="glyphicon glyphicon-folder-open"
                                                                style="padding-right: 3px;"></span> Choose</span></a>
                                            </span>
                                        </div>
                                    </div>

                                    <input type="hidden" name="course_id" value="{{$courses->id}}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <script>

                        jQuery(document).ready(function ($) {
                            $(".iframe-btn_1").fancybox({
                                maxWidth: 1280,
                                maxHeight: 800,
                                fitToView: false,
                                width: '95%',
                                height: '95%',
                                autoSize: false,
                                closeClick: false,
                                openEffect: 'none',
                                type: 'iframe',
                                closeEffect: 'none'
                            });
                            function OnMessage_1(e) {
                                var event = e.originalEvent;
                                if (event.data.sender === 'responsivefilemanager') {
                                    if (event.data.field_id) {
                                        var fieldID = event.data.field_id;
                                        $('#' + fieldID).val(event.data.url).trigger('change');
                                        $("#text_uploaded_file_1").val($('#' + fieldID).val());
                                        $.fancybox.close();
                                        $(window).off('message', OnMessage_1);
                                    }
                                }
                            }

                            $('.iframe-btn_1').on('click', function () {
                                $(window).on('message', OnMessage_1);
                            });


                            $(".iframe-btn_2").fancybox({
                                maxWidth: 1280,
                                maxHeight: 800,
                                fitToView: false,
                                width: '95%',
                                height: '95%',
                                autoSize: false,
                                closeClick: false,
                                openEffect: 'none',
                                type: 'iframe',
                                closeEffect: 'none'
                            });
                            function OnMessage_2(e) {
                                var event = e.originalEvent;
                                if (event.data.sender === 'responsivefilemanager') {
                                    if (event.data.field_id) {
                                        var fieldID = event.data.field_id;
                                        $('#' + fieldID).val(event.data.url).trigger('change');
                                        $("#text_uploaded_file_2").val($('#' + fieldID).val());
                                        $.fancybox.close();
                                        $(window).off('message', OnMessage_2);
                                    }
                                }
                            }

                            $('.iframe-btn_2').on('click', function () {
                                $(window).on('message', OnMessage_2);
                            });


                            $(".iframe-btn_3").fancybox({
                                maxWidth: 1280,
                                maxHeight: 800,
                                fitToView: false,
                                width: '95%',
                                height: '95%',
                                autoSize: false,
                                closeClick: false,
                                openEffect: 'none',
                                type: 'iframe',
                                closeEffect: 'none'
                            });
                            function OnMessage_3(e) {
                                var event = e.originalEvent;
                                if (event.data.sender === 'responsivefilemanager') {
                                    if (event.data.field_id) {
                                        var fieldID = event.data.field_id;
                                        $('#' + fieldID).val(event.data.url).trigger('change');
                                        $("#text_uploaded_file_3").val($('#' + fieldID).val());
                                        $.fancybox.close();
                                        $(window).off('message', OnMessage_3);
                                    }
                                }
                            }

                            $('.iframe-btn_3').on('click', function () {
                                $(window).on('message', OnMessage_3);
                            });

                            $(".iframe-btn_4").fancybox({
                                maxWidth: 1280,
                                maxHeight: 800,
                                fitToView: false,
                                width: '95%',
                                height: '95%',
                                autoSize: false,
                                closeClick: false,
                                openEffect: 'none',
                                type: 'iframe',
                                closeEffect: 'none'
                            });
                            function OnMessage_4(e) {
                                var event = e.originalEvent;
                                if (event.data.sender === 'responsivefilemanager') {
                                    if (event.data.field_id) {
                                        var fieldID = event.data.field_id;
                                        $('#' + fieldID).val(event.data.url).trigger('change');
                                        $("#text_uploaded_file_4").val($('#' + fieldID).val());
                                        $.fancybox.close();
                                        $(window).off('message', OnMessage_4);
                                    }
                                }
                            }

                            $('.iframe-btn_4').on('click', function () {
                                $(window).on('message', OnMessage_4);
                            });


                            $(".iframe-btn_5").fancybox({
                                maxWidth: 1280,
                                maxHeight: 800,
                                fitToView: false,
                                width: '95%',
                                height: '95%',
                                autoSize: false,
                                closeClick: false,
                                openEffect: 'none',
                                type: 'iframe',
                                closeEffect: 'none'
                            });
                            function OnMessage_5(e) {
                                var event = e.originalEvent;
                                if (event.data.sender === 'responsivefilemanager') {
                                    if (event.data.field_id) {
                                        var fieldID = event.data.field_id;
                                        $('#' + fieldID).val(event.data.url).trigger('change');
                                        $("#text_uploaded_file_5").val($('#' + fieldID).val());
                                        $.fancybox.close();
                                        $(window).off('message', OnMessage_5);
                                    }
                                }
                            }

                            $('.iframe-btn_5').on('click', function () {
                                $(window).on('message', OnMessage_5);
                            });
                        });


                    </script>


                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')

@stop