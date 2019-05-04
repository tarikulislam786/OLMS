@extends('admin.master')

@section('title', 'Add Course Lecture')
@section('stylesheet')
    <style>
        .input-group { width: 100%; }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('fancybox/jquery.fancybox.css?v=2.1.5') }}" media="screen" />
@stop
@section('head_scripts')
    <script type="text/javascript" src="{{ asset('fancybox/jquery.fancybox.js?v=2.1.5') }}"></script>
@stop
@section('content')
    <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">Course Lecture</h1>
    </div>
    <div class="wrapper-md">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold">Add New Course Lecture</div>
                    <div class="panel-body">
                        {{--<form role="form">--}}
                        {!! Form::open(['url'=>'/admin/course-lecture-save']) !!}

                            <div class="form-group">
                                <label>Course</label>
                                <select name="course_id" id="" class="form-control">
                                    @foreach($courses as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Topic</label>
                                <textarea name="topic" class="form-control" id="" rows="6"></textarea>
                            </div>
                            <div class="form-group">
                                <label>File</label>
                                <div class="input-group">
                                    <input id="text_uploaded_image" name="image" type="text" class="form-control" readonly="">
                                    <span class="input-group-btn">
                                        <a href="{{env('base_url')}}/filemanager/dialog.php?crossdomain=1&type=1&field_id=text_uploaded_image&relative_url=1&akey=dsflFWR9u2xQa"
                                           class="iframe-btn" type="button">
                                        <span class="btn btn-default btn-file">
                                             <span class="glyphicon glyphicon-folder-open" style="padding-right: 3px;"></span>
                                                 Choose file
                                        </span></a>
                                    </span>
                                </div>
                                <img style="margin-top:5px;" src="" id="selected_preview_image"/>
                            </div>
                            <a href="{{url('/admin/course-list')}}" class="btn btn-sm btn-default">Cancel</a>
                            <button type="submit" class="btn btn-sm btn-primary">Add Course</button>
                        {!! Form::close() !!}
                        {{--</form>--}}
                    </div>
                </div>
            </div>
            <script src="{{asset('js/aitl-stand-alone-filemanager.js')}}"></script>
        </div>
    </div>

@endsection
@section('scripts')

@stop