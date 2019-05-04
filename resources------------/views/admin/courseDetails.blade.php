@extends('admin.master')

@section('title', $courseDetails->code)
@section('stylesheet')
    <style>
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
                foreach($teachers as $teacher) {
                ?>
                <a href="{{url('/student/teacher-details/'.$teacher->teacher_id)}}" class="label bg-info">{{$teacher->first_name.' '.$teacher->last_name}}</a>
                <?php } ?>

            </h5>
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
                    <div class="panel-heading font-bold">{{$courseDetails->code}}: {{$courseDetails->name}}</div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="100">Lecture#</th>
                                    <th width="300">Topic</th>
                                    <th width="300">Contents</th>
                                    <th width="200">Comment</th>
                                    <th width="100" class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lectures as $lecture)
                                    <tr>
                                        <td>{{$lecture->lecture_no}}</td>
                                        <td>{{$lecture->topic}}</td>
                                        <td>

                                            <ul class="file-list">
                                                <?php

                                                $multimediaContents = App\Model\MultimediaContent::getMultimediaContentByLectureId($lecture->lecture_id);

                                                foreach ($multimediaContents as $multimediaContent) {
                                                    $file_path = env('base_url') . "/public/uploads/source/teachers_content/" . $multimediaContent->file_path;

                                                    //echo $file_path;
                                                    $info = new SplFileInfo($multimediaContent->file_path);

                                                    echo '<li>';
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

                                                    $file = basename($file_path, ".".$info->getExtension());

                                                    echo '<a style="color:blue" href="' . $file_path . '">' . $file .".".$info->getExtension(). '</a></br>';

                                                    echo '</li>';
                                                }
                                                ?>


                                            </ul>

                                        </td>

                                        <td>{{$lecture->comment}}</td>

                                        <td width="100" class="text-center">
                                            <a href="{{url('/student/lecture-details/'.$courseDetails->id.'/'.$lecture->lecture_id)}}" class="btn btn-info btn-xs">Questions</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

@stop