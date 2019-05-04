@extends('admin.master')
@section('title', 'Edit Lecture')
@section('stylesheet')

@stop
@section('head_scripts')
@stop
@section('content')


    {{--<div class="bg-light lter b-b wrapper-md">--}}
        {{--@include('teacherProfile.profileHeader')--}}
    {{--</div>--}}
    <div class="wrapper-md">
        <div class="row">
            <div class="col-sm-12">
                {!! Form::open(['url'=>'/teacher/course-lecture-update', 'files'=>true]) !!}
                <div class="form-group">
                    <label>Topic</label>
                    <input type="text" class="form-control" name="topic" value="{{$lecture->topic}}"/>


                    <?php

                    $multimediaContents =    App\Model\MultimediaContent::getMultimediaContentByLectureId($lecture->lecture_id);

                    foreach($multimediaContents as $multimediaContent)
                    {
                        $file_path =  env('base_url')."/public/uploads/source/teachers_content/".Auth::user()->id."/".$multimediaContent->file_path;

                        //echo $file_path;

                        echo '<a style="color:blue" href="'.$file_path.'">'.$multimediaContent->file_path.'</a></br>';
                    }
                    ?>

                </div>

                <div class="form-group">
                    <label>Files (Multimedia Contents) </label>

                    <div class="input-group" style="padding-top: 10px;">
                        <input id="text_uploaded_file_1" name="text_uploaded_file_1" type="text" value="" class="form-control" readonly=""/>
                                            <span class="input-group-btn">
                                                <a href="{{env('base_url')}}/filemanager/dialog.php?crossdomain=1&type=0&field_id=text_uploaded_file_1&relative_url=1&akey={{Session::get('encrypted_teacher_id')}}" class="iframe-btn_1" type="button">
                                                    <span class="btn btn-default btn-file"><span class="glyphicon glyphicon-folder-open" style="padding-right: 3px;"></span> Choose</span></a>
                                            </span>
                    </div>
                    <div class="input-group" style="padding-top: 10px;">
                        <input id="text_uploaded_file_2" name="text_uploaded_file_2" type="text" class="form-control" readonly=""/>
                                            <span class="input-group-btn">
                                                <a href="{{env('base_url')}}/filemanager/dialog.php?crossdomain=1&type=0&field_id=text_uploaded_file_2&relative_url=1&akey={{Session::get('encrypted_teacher_id')}}" class="iframe-btn_2" type="button">
                                                    <span class="btn btn-default btn-file"><span class="glyphicon glyphicon-folder-open" style="padding-right: 3px;"></span> Choose</span></a>
                                            </span>
                    </div>
                    <div class="input-group" style="padding-top: 10px;">
                        <input id="text_uploaded_file_3" name="text_uploaded_file_3" type="text" class="form-control" readonly=""/>
                                            <span class="input-group-btn">
                                                <a href="{{env('base_url')}}/filemanager/dialog.php?crossdomain=1&type=0&field_id=text_uploaded_file_3&relative_url=1&akey={{Session::get('encrypted_teacher_id')}}" class="iframe-btn_3" type="button">
                                                    <span class="btn btn-default btn-file"><span class="glyphicon glyphicon-folder-open" style="padding-right: 3px;"></span> Choose</span></a>
                                            </span>
                    </div>
                    <div class="input-group" style="padding-top: 10px;">
                        <input id="text_uploaded_file_4" name="text_uploaded_file_4" type="text" class="form-control" readonly=""/>
                                            <span class="input-group-btn">
                                                <a href="{{env('base_url')}}/filemanager/dialog.php?crossdomain=1&type=0&field_id=text_uploaded_file_4&relative_url=1&akey={{Session::get('encrypted_teacher_id')}}" class="iframe-btn_4" type="button">
                                                    <span class="btn btn-default btn-file"><span class="glyphicon glyphicon-folder-open" style="padding-right: 3px;"></span> Choose</span></a>
                                            </span>
                    </div>
                    <div class="input-group" style="padding-top: 10px;">
                        <input id="text_uploaded_file_5" name="text_uploaded_file_5" type="text" class="form-control" readonly=""/>
                                            <span class="input-group-btn">
                                                <a href="{{env('base_url')}}/filemanager/dialog.php?crossdomain=1&type=0&field_id=text_uploaded_file_5&relative_url=1&akey={{Session::get('encrypted_teacher_id')}}" class="iframe-btn_5" type="button">
                                                    <span class="btn btn-default btn-file"><span class="glyphicon glyphicon-folder-open" style="padding-right: 3px;"></span> Choose</span></a>
                                            </span>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


@stop
@section('scripts')

    <script>
        $('select[id="role"]').change(function () {
            if ($(this).find('.teacher').is(':selected'))
                $('#teacher').show();
            else
                $('#teacher').hide();
            if ($(this).find('.student').is(':selected'))
                $('#student').show();
            else
                $('#student').hide();
        });
    </script>


    <script src="{{asset('js/fileinput.min.js')}}"></script>
    <script>
        $(document).on('ready', function () {
            $("#input-file").fileinput({
                previewFileType: "image",
                browseClass: "btn btn-success"
            });
        });
    </script>

@stop