@extends('admin.master')
@section('title', 'Student List')
@section('stylesheet')
@stop
@section('content')
    <div class="bg-light lter b-b wrapper-md">
        <div class="col-sm-6"><h1 class="m-n font-thin h3">Student List</h1></div>
        <div class="col-sm-6 text-right">
            @if (Session::get('message') == true)
                <span class="message label bg-info m-l-xs">{{Session::get('message')}}</span>
            @endif
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="wrapper-md" ng-controller="FormDemoCtrl">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-info">
                    <div class="panel-heading font-bold">
                        <div class="row">
                            <div class="col-sm-3"><a href="{{asset('/admin/users')}}" class="btn btn-info btn-xs">Teacher
                                    List</a>
                                <a href="{{asset('/admin/student-users')}}" class="btn btn-default btn-xs">Student
                                    List</a></div>

                            {!! Form::open(['url'=>'/admin/student-users']) !!}
                            <div class="col-sm-4 pull-right">
                                <div class="input-group">
                                    <input type="text" style="height: 30px;font-size: 11px;" name="studentFilter"
                                           value="{{$studentFilter}}" class="form-control"
                                           placeholder="Search student">
                                              <span class="input-group-btn">
                                                <button class="btn btn-success" style="padding:4px" type="button">Go!</button>
                                              </span>

                                </div>
                            </div>
                            <div class="col-sm-3 pull-right">

                                    <select name="discipline_id" class="form-control input-sm" id="form1"
                                            onchange='this.form.submit()'>
                                        <option class="selection" value="all">All Discipline</option>
                                        @foreach($disciplines as $discipline)
                                            <option  @if($discipline->id ==$disciplineFilterId) selected @endif value="{{$discipline->id}}">{{$discipline->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {!! Form::close() !!}
                               </div>
                        </div>

                    <div class="panel-body">
                        {{--{{dd($users)}}--}}
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Discipline</th>
                                <th>Roll</th>
                                <th>Phone</th>
                                <th class="text-center">Email</th>
                                <th>Status</th>
                                <th width="100"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><img src="{{asset('images/student-img/'.$user->image)}}" width="60" alt=""></td>
                                    <td>{{$user->first_name}} {{$user->last_name}}</td>
                                    <td>{{$user->discipline_name}}</td>
                                    <td>{{$user->roll_no}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td class="text-center">{{$user->email}}</td>
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
                                    <td width="100" class="text-right">
                                        <a title="Edit"
                                           href="{{URL::to('/admin/edit-student-user/'.$user->id)}}"
                                           class="btn btn-sm btn-icon btn-default"><i
                                                    class="fa fa-edit"></i>
                                        </a>
                                        <a onclick="return yesDetete()" title="Delete"
                                           href="{{URL::to('/admin/student-user-delete/'.$user->id)}} "
                                           class="btn btn-sm btn-icon btn-danger"> <i
                                                    class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="clearfix"></div>
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

@stop