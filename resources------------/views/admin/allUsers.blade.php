@extends('admin.master')

@section('title', 'Teacher List')
@section('stylesheet')

@stop
@section('content')
    <div class="bg-light lter b-b wrapper-md">
        <div class="col-sm-6"><h1 class="m-n font-thin h3">Teacher List</h1></div>
        <div class="col-sm-6 text-right">
            @if (Session::get('message') == true)
                <span class="message label bg-info m-l-xs">{{Session::get('message')}}</span>
            @endif
        </div>
        <div class="clearfix"></div>
    </div>
    {{--{{dd($users)}}--}}
    <div class="wrapper-md" ng-controller="FormDemoCtrl">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-info">
                    <div class="panel-heading font-bold">

                        <div class="row">
                            <div class="col-sm-4">
                                <a href="{{asset('/admin/users')}}" class="btn btn-default btn-xs">Teacher List</a>
                                <a href="{{asset('/admin/student-users')}}" class="btn btn-info btn-xs">Student List</a>
                            </div>
                            <div class="col-sm-8 pull-right">
                                <div class="row">
                                    {!! Form::open(['url'=>'/admin/users']) !!}
                                    <div class="col-sm-4 pull-right">
                                        <select name="designation" id="" class="form-control input-sm"
                                                onchange='this.form.submit()'>
                                            {{--<option>Choose designation</option>--}}
                                            <option @if($designationFilter== 'all') selected @endif value="all">All</option>
                                            <option @if($designationFilter== 'Lecturer') selected @endif value="Lecturer">Lecturer</option>
                                            <option @if($designationFilter== 'Assistant Professor') selected @endif value="Assistant Professor">Assistant Professor</option>
                                            <option @if($designationFilter== 'Associate Professor') selected @endif value="Associate Professor">Associate Professor</option>
                                            <option @if($designationFilter== 'Professor') selected @endif value="Professor">Professor</option>
                                            <option @if($designationFilter== 'Other') selected @endif value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 pull-right">
                                        <select name="discipline_id" class="form-control input-sm" id="form1"
                                                onchange='this.form.submit()'>
                                            <option value="all">All Discipline</option>
                                            @foreach($disciplines as $discipline)
                                                <option  @if($discipline->id ==$disciplineFilterId) selected @endif value="{{$discipline->id}}">{{$discipline->name}}</option>
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
                                <th>Image</th>
                                <th>Name</th>
                                <th>Discipline</th>
                                <th>Designation</th>
                                <th>Area of interest</th>
                                <th class="">Email</th>
                                <th>Status</th>
                                <th width="100">Phone</th>
                                <th width="80"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($users))
                            @foreach($users as $user)
                                <tr>
                                    <td><img src="{{asset('images/teacher-img/'.$user->image)}}" width="60" alt=""></td>
                                    <td>{{$user->first_name}} {{$user->last_name}}</td>
                                    <td>{{$user->discipline_name}}</td>
                                    <td>{{$user->designation}}</td>
                                    <td>{{$user->area_of_interest}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @if($user->status == 1)
                                            {!! Form::open(['url'=>'/admin/approved-users']) !!}
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                            <button type="submit" class="btn btn-success btn-xs">Approve</button>
                                            {!! Form::close() !!}
                                        @elseif($user->status == 0)
                                            Approved
                                        @endif
                                    </td>
                                    <td>{{$user->phone}}</td>

                                    <td width="80" class="text-right">
                                        <a title="Edit"
                                           href="{{URL::to('/admin/user/'.$user->id)}}"
                                           class="btn btn-sm btn-icon btn-default"><i
                                                    class="fa fa-edit"></i>
                                        </a>
                                        <a onclick="return yesDetete()" title="Delete"
                                           href="{{URL::to('/admin/teacher-delete/'.$user->teacherid)}} "
                                           class="btn btn-sm btn-icon btn-danger"> <i
                                                    class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                                @endif
                            </tbody>
                        </table>
                    </div>
                    <footer class="panel-footer">
                        @if(isset($users))
                            <div class="row">
                                <div class="col-sm-4 text-left">
                                    <small class="text-muted inline m-t-sm m-b-sm">
                                        <?php
                                        $from = ($users->currentPage() - 1) * ($users->perPage()) + 1;
                                        $to = $from + $users->count() - 1;
                                        echo "Showing " . $from . " - " . $to . " of " . $users->total() . " items";
                                        ?>
                                    </small>
                                </div>
                                <div class="col-sm-8 text-right text-center-xs">
                                    {!! str_replace('/?', '?', $users->render()) !!}
                                </div>
                            </div>
                        @endif
                    </footer>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        setTimeout(function(){
            $('.message').slideUp();
        }, 4000);
    </script>
@stop