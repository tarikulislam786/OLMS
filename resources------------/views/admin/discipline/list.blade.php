@extends('admin.master')

@section('title', 'Discipline List')
@section('stylesheet')

@stop
@section('content')
    <div class="bg-light lter b-b wrapper-md">
        <div class="col-sm-6"><h1 class="m-n font-thin h3">Discipline List</h1></div>
        <div class="col-sm-6 text-right">
            <a href="{{url('/admin/discipline')}}" class="btn m-b-xs btn-sm btn-primary btn-addon"><i class="fa fa-plus"></i>Add Discipline</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="wrapper-md" ng-controller="FormDemoCtrl">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-info">
                    <div class="panel-heading font-bold">Discipline List</div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th style="width:100px">Code</th>
                                <th>Name</th>
                                <th></th>
                            </tr>
                            @foreach($disciplines as $discipline)
                                <tr>
                                    <td>{{$discipline->short_name}}</td>
                                    <td>{{$discipline->name}}</td>
                                    <td class="text-right">
                                        <a title="Edit"
                                           href="{{URL::to('/admin/discipline-edit/'.$discipline->id)}}"
                                           class="btn btn-sm btn-icon btn-default"><i
                                                    class="fa fa-edit"></i>
                                        </a>
                                        <a onclick="return yesDetete()" title="Delete"
                                           href="{{URL::to('/admin/discipline-delete/'.$discipline->id)}} "
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