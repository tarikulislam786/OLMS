@extends('admin.master')

@section('title', 'Update Course')
@section('stylesheet')
    <style>
        .input-group { width: 100%; }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('fancybox/jquery.fancybox.css?v=2.1.5') }}" media="screen" />
    <script type="text/javascript" src="{{ asset('fancybox/jquery.fancybox.js?v=2.1.5') }}"></script>
@stop
@section('head_scripts')

@stop
@section('content')
    <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">Update Course</h1>
    </div>
    <div class="wrapper-md">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading font-bold">Update Course</div>
                    <div class="panel-body">

                        {!! Form::open(['url'=>'/admin/course-update']) !!}
                        <input type="hidden" value="{{$course->id}}" name="id">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Course Code <span style="font-size: smaller; color: #e14f1c">(e.g. CSE 1101)</span></label>
                                        <input type="text" class="form-control" name="code" value="{{$course->code}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Course Name</label>
                                        <input type="text" class="form-control" name="name" value="{{$course->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Credit Hour  <span style="font-size: smaller; color: #e14f1c">(e.g. 3.0)</span></label>

                                        <select name="credit" id="" class="form-control">
                                            {{--<option value="">Select Credit</option>--}}
                                            <option value="0.75" @if($course->credit=='0.75') selected @endif>0.75</option>
                                            <option value="1.5" @if($course->credit=='1.5') selected @endif>1.5</option>
                                            <option value="2.0" @if($course->credit=='2.0') selected @endif>2.0</option>
                                            <option value="3.0" @if($course->credit=='3.0') selected @endif>3.0</option>
                                            <option value="6.0" @if($course->credit=='6.0') selected @endif>6.0</option>
                                            <option value="12" @if($course->credit=='12') selected @endif>12</option>
                                            <option value="Non Credit" @if($course->credit=='Non Credit') selected @endif>Non Credit</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Discipline Name</label>
                                        <select name="discipline_id" id="" class="form-control">
                                            @foreach($disciplines as $discipline)
                                                <option @if($course->discipline_id == $discipline->id) selected @endif value="{{$discipline->id}}">{{$discipline->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Session</label>
                                        <select name="session_id" id="" class="form-control">
                                            {{--<option>Choose Session</option>--}}
                                            @foreach($sessions as $session)
                                                <option @if($session->id== $course->session_id) selected @endif value="{{$session->id}}">{{$session->session}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Related Link</label>
                                        <input type="text" class="form-control" name="related_link" value="{{$course->related_link}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Image</label>

                                        <div class="input-group">
                                            <input id="text_uploaded_image" type="text" name="image" class="form-control" value="{{$course->image}}"
                                                   readonly="">
                                                <span class="input-group-btn">
                                                    <a href="{{env('base_url')}}/filemanager/dialog.php?crossdomain=1&type=1&field_id=text_uploaded_image&relative_url=1&akey=dsflFWR9u2xQa"
                                                       class="iframe-btn" type="button">
                                                    <span class="btn btn-default btn-file">
                                                         <span class="glyphicon glyphicon-folder-open"
                                                               style="padding-right: 3px;"></span>
                                                             Choose file
                                                    </span></a>
                                                </span>
                                        </div>
                                        <img style="margin-top:5px;" src="{{asset('')}}{{env('filemanager_upload_source')}}{{$course->image}}" id="selected_preview_image"/>
                                    </div>

                                </div>

                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Caption</label>
                                        <textarea name="caption" id="" class="form-control" cols="30" rows="3">{{$course->caption}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="" class="form-control" cols="30" rows="4">{{$course->description}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Reference</label>
                                        <input type="text" name="reference_one" class="form-control" value="{{$reference->reference_one}}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="reference_two" class="form-control" value="{{$reference->reference_two}}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="reference_three" class="form-control" value="{{$reference->reference_three}}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="reference_four" class="form-control" value="{{$reference->reference_four}}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="reference_five" class="form-control"  value="{{$reference->reference_five}}">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <input type="hidden" name="id" value="{{$course->id}}">
                        <a href="{{url('/admin/course-list')}}" class="btn btn-sm btn-default">Cancel</a>
                        <button type="submit" class="btn btn-sm btn-primary">Update Course</button>
                        {!! Form::close() !!}
                        {{--</form>--}}
                    </div>
                </div>
            </div>
            <script src="{{ asset('js/aitl-stand-alone-filemanager.js') }}"></script>
        </div>
    </div>

@endsection
@section('scripts')

@stop