@extends('admin.master')

@section('title', 'Session List')
@section('stylesheet')

@stop
@section('content')
    <div class="bg-light lter b-b wrapper-md">
        <div class="col-sm-6"><h1 class="m-n font-thin h3">Session List</h1></div>
        <div class="col-sm-6 text-right">
            <a href="{{url('/admin/session/add')}}" class="btn m-b-xs btn-sm btn-primary btn-addon"><i class="fa fa-plus"></i>Add Session</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="wrapper-md" ng-controller="FormDemoCtrl">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-info">
                    <div class="panel-heading font-bold">Session List</div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Session</th>
                                <th width="130">Current Session</th>
                                <th width="80"></th>
                            </tr>
                            @foreach($sessions as $session)
                                <tr>
                                    <td>{{$session->session}}</td>
                                    <td width="130">
                                        @if($session->current_session == 0)
                                            {!! Form::open(['url'=>'/admin/current-session']) !!}
                                            <input type="hidden" name="id" value="{{$session->id}}">
                                            <label class="i-switch m-t-xs m-r">
                                                <input type="checkbox" onchange="this.form.submit()">
                                                <i></i>
                                            </label>
                                            {!! Form::close() !!}
                                        @else
                                            <input type="hidden" name="id" value="{{$session->id}}">
                                            <label class="i-switch m-t-xs m-r">
                                                <input type="checkbox" checked>
                                                <i></i>
                                            </label>
                                        @endif
                                    </td>
                                    <td width="80" class="text-right">
                                        <a title="Edit"
                                           href="{{URL::to('/admin/session-edit/'.$session->id)}}"
                                           class="btn btn-sm btn-icon btn-default"><i
                                                    class="fa fa-edit"></i>
                                        </a>
                                        <a onclick="return yesDetete()" title="Delete"
                                           href="{{URL::to('/admin/session-delete/'.$session->id)}} "
                                           class="btn btn-sm btn-icon btn-danger"> <i
                                                    class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

@stop