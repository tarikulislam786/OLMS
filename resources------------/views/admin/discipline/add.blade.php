@extends('admin.master')

@section('title', 'Add New Discipline')
@section('stylesheet')
    <style>
        .input-group { width: 100%; }
    </style>
@stop
@section('content')
    <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">Add New Discipline</h1>
    </div>
    <div class="wrapper-md" ng-controller="FormDemoCtrl">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading font-bold">Add New Discipline</div>
                    <div class="panel-body">
                        {!! Form::open(['url'=>'/admin/discipline-save']) !!}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Short Name (e.g. CSE, ECE)</label>
                                        <input type="text" class="form-control" name="short_name" placeholder="">
                                    </div>
                                    <div class="col-sm-10">
                                        <label>Full Name (e.g. Computer Science & Engineering)</label>
                                        <input type="text" class="form-control" name="name" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <a href="{{url('/admin/discipline-list')}}" class="btn btn-sm btn-default">Cancel</a>
                            <button type="submit" class="btn btn-sm btn-primary">Add Discipline</button>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

@stop