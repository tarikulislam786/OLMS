@extends('admin.master')

@section('title', 'Course List')
@section('stylesheet')


@section('content')
    <div class="bg-light lter b-b wrapper-md">
        <div class="col-sm-6"><h1 class="m-n font-thin h3">Course List</h1></div>
        <div class="col-sm-6 text-right">
            <a href="{{url('/admin/course')}}" class="btn m-b-xs btn-sm btn-primary btn-addon"><i class="fa fa-plus"></i>Add Course</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="wrapper-md">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-info">
                    <div class="panel-heading font-bold">
                        <div class="row">
                            <div class="col-sm-4">Course List</div>
                            <div class="col-sm-8 pull-right">
                                <div class="row">
                                    {!! Form::open(['url'=>'/admin/course-list']) !!}
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
                                    <th width="130">Course Code</th>
                                    <th>Name</th>
                                    <th width="100" class="text-center">Credit</th>
                                    <th width="400">Discipline</th>


                                    <th width="100"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                    <tr>
                                        <td width="50">
                                            @if($course->image != null)
                                                <img src="{{asset('')}}{{env('filemanager_upload_source')}}{{$course->image}}" alt="" width="45">
                                            @else
                                                <img src="{{asset('img/p0.jpg')}}" alt="" width="45">
                                            @endif
                                        </td>
                                        <td>{{$course->code}}</td>
                                        <td>{{$course->name}}</td>
                                        <td width="100" class="text-center">{{$course->credit}}</td>
                                        <td>{{$course->disciplineName}}</td>
                                        <td width="100" class="text-right">
                                            <a title="Edit"
                                               href="{{URL::to('/admin/course-edit/'.$course->id)}}"
                                               class="btn btn-sm btn-icon btn-default"><i
                                                        class="fa fa-edit"></i>
                                            </a>
                                            <a onclick="return yesDetete()" title="Delete"
                                               href="{{URL::to('/admin/course-delete/'.$course->id)}} "
                                               class="btn btn-sm btn-icon btn-danger"> <i
                                                        class="fa fa-trash-o"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <footer class="panel-footer">
                        @if(isset($courses) && !isset($session_id))
                            <div class="row">
                                <div class="col-sm-4 text-left">
                                    <small class="text-muted inline m-t-sm m-b-sm">
                                        <?php
                                        $from = ($courses->currentPage() - 1) * ($courses->perPage()) + 1;
                                        $to = $from + $courses->count() - 1;
                                        echo "Showing " . $from . " - " . $to . " of " . $courses->total() . " items";
                                        ?>
                                    </small>
                                </div>
                                <div class="col-sm-8 text-right text-center-xs">
                                    {!! str_replace('/?', '?', $courses->render()) !!}
                                </div>
                            </div>
                        @endif
                    </footer>
                </div>
            </div>
        </div>
    </div>

@endsection

@stop