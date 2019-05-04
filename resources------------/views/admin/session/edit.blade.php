@extends('admin.master')

@section('title', 'Update Session')
@section('stylesheet')
    <style>
        .input-group { width: 100%; }
    </style>
@stop
@section('content')
    <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">Update Session</h1>
    </div>
    <div class="wrapper-md" ng-controller="FormDemoCtrl">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading font-bold">Update Session</div>
                    <div class="panel-body">
                        {!! Form::open(['url'=>'/admin/session-update']) !!}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Session</label>
                                    <input type="text" class="form-control" name="session" value="{{$session->session}}" placeholder="">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{$session->id}}">
                        <a href="{{url('/admin/session-list')}}" class="btn btn-sm btn-default">Cancel</a>
                        <button type="submit" class="btn btn-sm btn-primary">Update Session</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

@stop