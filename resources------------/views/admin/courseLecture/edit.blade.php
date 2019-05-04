@extends('admin.master')

@section('title', 'Add Create Course')
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
        <h1 class="m-n font-thin h3">Create Course</h1>
    </div>
    <div class="wrapper-md">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold">Add New Course</div>
                    <div class="panel-body">
                        {{--<form role="form">--}}
                        {!! Form::open(['url'=>'/admin/course-update']) !!}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Course Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$course->name}}" placeholder="">
                                </div>
                                <div class="col-sm-3">
                                    <label>Discipline Name</label>
                                    <select name="discipline_id" id="" class="form-control">
                                        @foreach($disciplines as $discipline)
                                            <option @if($course->discipline_id == $discipline->id) selected @endif value="{{$discipline->id}}">{{$discipline->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Course Code</label>
                                    <input type="text" class="form-control" name="code" value="{{$course->code}}" placeholder="">
                                </div>
                                <div class="col-sm-3">
                                    <label>Credit</label>
                                    <input type="text" class="form-control" name="credit" value="{{$course->credit}}" placeholder="">
                                    {{--<select name="credit" id="" class="form-control">--}}
                                    {{--<option value="3">3.0</option>--}}
                                    {{--<option value="4">4.0</option>--}}
                                    {{--<option value="5">5.0</option>--}}
                                    {{--</select>--}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Caption</label>
                            <textarea name="caption" id="" class="form-control" cols="30" rows="6">{{$course->caption}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="" class="form-control" cols="30" rows="6">{{$course->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>References</label>
                                    <input type="text" class="form-control" name="references" value="{{$course->references}}" placeholder="">
                                </div>
                                <div class="col-sm-4">
                                    <label>Related Link</label>
                                    <input type="text" class="form-control" name="related_link" value="{{$course->related_link}}" placeholder="">
                                </div>
                                <div class="col-sm-4">
                                    <label>Image</label>
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
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{$course->id}}">
                        <a href="{{url('/admin/course-list')}}" class="btn btn-sm btn-default">Cancel</a>
                        <button type="submit" class="btn btn-sm btn-primary">Add Course</button>
                        {!! Form::close() !!}
                        {{--</form>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/aitl-stand-alone-filemanager.js') }}"></script>

@endsection
@section('scripts')

@stop