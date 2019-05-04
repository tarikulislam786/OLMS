@extends("admin.master")

@section('title', 'Question')

@section('childcontent')
    <div id="content" class="app-content" role="main">

        <div class="app-content-body ">
            <div class="bg-light lter b-b wrapper-md">
                <h1 class="m-n font-thin h3">User List</h1>
            </div>
            <div class="wrapper-md">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold">
                        Users
                    </div>

                    <div> <!--class="table-responsive">-->
                        <div class="row wrapper">
                            <div class="col-sm-9 m-b-xs">

                                <a href="{{URL::to('/admin/user/add')}}"
                                   class="btn btn-sm btn-success btn-addon"><i class="fa fa-plus"></i>User</a>
                                {{--<a href="{{URL::to('/admin/quiz-test/question/add')}}"--}}
                                   {{--class="btn btn-sm btn-default btn-addon"><i class="fa fa-plus"></i>Role</a>--}}
                            </div>

                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" class="input-sm form-control" placeholder="Search">
								  <span class="input-group-btn">
									<button class="btn btn-sm btn-default" type="button">Go!</button>
								  </span>
                                </div>
                            </div>
                        </div>

                        <table class="table table-striped b-t b-light">
                            <thead>
                            <tr>
                                <th style="width:50px">Photo</th>
                                <th>Name</th>
                                <th style="width:100px" class="text-right">Role</th>
                                <th  class="text-right">Email</th>

                                <th style="width:100px" class="text-center">Last Login</th>
                                <th style="width:100px" class="text-center">Created</th>
                                <th style="width:100px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--@foreach($users as $user)--}}
                                {{--@if($user->role != 0)--}}
                                    {{--<tr>--}}
                                        {{--<td style="width:50px"><img style="height:30px;" src="{{asset('')}}{{env('filemanager_thumbs')}}{{$user->image}}"/></td>--}}
                                        {{--<td></td>--}}
                                        {{--<td class="text-right"></td>--}}
                                        {{--<td class="text-right">{{$user->email}}</td>--}}

                                        {{--<td class="text-center">{{$user->created_at->format('d-m-Y h:m a')}}</td>--}}
                                        {{--<td class="text-center">{{$user->created_at->format('d-m-Y')}}</td>--}}
                                        {{--<td class="text-right">--}}
                                            {{--<a title="Edit"--}}
                                               {{--href="{{URL::to('/admin/user/edit/'.$user->id)}}"--}}
                                               {{--class="btn btn-sm btn-icon btn-default"><i class="fa fa-edit"></i></a>--}}

                                            {{--<a onclick="return yesDetete()" title="Delete"--}}
                                               {{--href="{{URL::to('/admin/user/delete/'.$user->id)}}"--}}
                                               {{--class="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash-o"></i></a>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
        <!--for datetimepicker-->
    <script type="text/javascript">
        $('#datetimepicker').datetimepicker({
            format: 'yyyy-MM-dd hh:mm:ss',
            language: 'pt-BR'
        });
    </script>
@stop







