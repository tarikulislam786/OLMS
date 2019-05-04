@extends('admin.master')

@section('title', 'Course List')
@section('stylesheet')

@stop
@section('content')
    <div class="bg-light lter b-b wrapper-md">
        <div class="col-sm-6"><h1 class="m-n font-thin h3">Course List</h1></div>
        <div class="col-sm-6 text-right">
            <a href="{{url('/admin/course-lecture')}}" class="btn m-b-xs btn-sm btn-primary btn-addon"><i class="fa fa-plus"></i>Add Course</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="wrapper-md">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold">Course List</div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lectures as $lecture)
                                    <tr>
                                        <td>{{$lecture->id}}</td>
                                        <td></td>
                                        <td class="text-right">
                                            <a title="Edit"
                                               href="{{URL::to('/admin/course-edit/'.$lecture->id)}}"
                                               class="btn btn-sm btn-icon btn-default"><i
                                                        class="fa fa-edit"></i>
                                            </a>
                                            <a onclick="return yesDetete()" title="Delete"
                                               href="{{URL::to('/admin/course-delete/'.$lecture->id)}} "
                                               class="btn btn-sm btn-icon btn-danger"> <i
                                                        class="fa fa-trash-o"></i>
                                            </a>
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