@extends('admin.master')

@section('title', 'Add Session')
@section('stylesheet')
    <style>
        .input-group { width: 100%; }
    </style>
@stop
@section('content')
    <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">Add Session</h1>
    </div>
    <div class="wrapper-md" ng-controller="FormDemoCtrl">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading font-bold">Add Session</div>
                    <div class="panel-body">
                        {!! Form::open(['url'=>'/admin/session-save']) !!}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Session Name</label>
                                        <input type="text" class="form-control" name="session" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <a href="{{url('/admin/session-list')}}" class="btn btn-sm btn-default">Cancel</a>
                            <button type="submit" class="btn btn-sm btn-primary">Add Session</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

@stop