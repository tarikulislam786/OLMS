@extends("admin.master")

@section('title', 'Question')

@section('childcontent')
    <div id="content" class="app-content" role="main">

        <div class="app-content-body ">
            <div class="bg-light lter b-b wrapper-md">
                <h1 class="m-n font-thin h3">User's Comment</h1>
            </div>
            <div class="wrapper-md">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold">
                        Pending Comments
                    </div>
                    <div class="row wrapper">
                        <div class="col-sm-9 m-b-xs">
                            <a href="{{URL::to('/admin/question-answer/category/add/')}}"
                               class="btn btn-sm btn-success btn-addon"><i class="fa fa-plus"></i>Category</a>
                            {{--<select class="input-sm form-control w-sm inline v-middle">--}}
                                {{--@foreach($allCategories as $category)--}}
                                    {{--<option value="{{$category->id}}">{{$category->title}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                            {{--<button class="btn btn-sm btn-success">Category</button>--}}
                            {{--<a href="{{URL::to('/admin/quiz-test/questions/add/')}}"--}}
                               {{--class="btn btn-sm btn-default btn-addon"><i class="fa fa-plus"></i>Question</a>--}}
                            {{--<a href="{{URL::to('/admin/quiz-test/categories/add/')}}"--}}
                               {{--class="btn btn-sm btn-default btn-addon"><i class="fa fa-plus"></i>Category</a>--}}
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
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                            <tr>
                                <!--<th>
                                    <label class="i-checks m-b-none">
                                        <input type="checkbox"><i></i>
                                    </label>
                                </th>-->

                                <th>Question Title</th>
                                <th style="width:100px" class="text-right">Created</th>
                                <th style="width:100px">Status</th>
                                <th style="width:60px"  class="text-right"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(isset($totalPendingComments))
                                    @foreach($totalPendingComments as $totalPendingComment)
                                        <tr>
                                            <td>{{$totalPendingComment->comment}}</td>
                                            <td class="text-right">{{$totalPendingComment->created_at}}</td>
                                            <td>
                                                <label class="i-switch i-switch-md bg-info m-t-xs m-r">
                                                    {!! Form::open(array('url'=>'/admin/question-answer/comments/makeApprove/'.$totalPendingComment->id)) !!}
                                                    <input type="hidden" name="comment_id" value="{{$totalPendingComment->id}}">
                                                    <input type="hidden" name="pendingComment" value="{{$totalPendingComment->status}}">
                                                    <input type="checkbox" onChange="this.form.submit()">
                                                    <i></i>
                                                    {!! Form::close() !!}
                                                </label>

                                            </td>
                                            <td class="text-right">
                                                <a title="Delete" onclick="return yesDetete()"
                                                   href="{{URL::to('/admin/question-answer/comments/delete/'.$totalPendingComment->id)}}"
                                                   class="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash-o"></i></a>
                                            </td>

                                        </tr>

                                    @endforeach
                                @endif

                            </tbody>
                        </table>

                    </div>
                    <footer class="panel-footer">
                        @if(isset($totalPendingComments))
                        <div class="row">

                            <div class="col-sm-4 text-left">
                                <small class="text-muted inline m-t-sm m-b-sm">
                                    <?php
                                    $from = ($totalPendingComments->currentPage() - 1) * ($totalPendingComments->perPage()) + 1;
                                    $to = $from + $totalPendingComments->count() - 1;

                                    echo "Showing " . $from . " - " . $to . " of " . $totalPendingComments->total() . " items";

                                    ?>
                                </small>
                            </div>
                            <div class="col-sm-8 text-right text-center-xs">
                                {!! str_replace('/?', '?', $totalPendingComments->render()) !!}
                            </div>
                        </div>
                        @endif
                    </footer>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading font-bold">
                        Approved Comments
                    </div>
                    <div class="row wrapper">
                        <div class="col-sm-9 m-b-xs">
                            {{--<select class="input-sm form-control w-sm inline v-middle">--}}
                                {{--@foreach($allCategories as $category)--}}
                                {{--<option value="{{$category->id}}">{{$category->title}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                            {{--<button class="btn btn-sm btn-success">Category</button>--}}
                            {{--<a href="{{URL::to('/admin/quiz-test/questions/add/')}}"--}}
                               {{--class="btn btn-sm btn-default btn-addon"><i class="fa fa-plus"></i>Question</a>--}}
                            {{--<a href="{{URL::to('/admin/quiz-test/categories/add/')}}"--}}
                               {{--class="btn btn-sm btn-default btn-addon"><i class="fa fa-plus"></i>Category</a>--}}
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
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                            <tr>
                                <!--<th>
                                    <label class="i-checks m-b-none">
                                        <input type="checkbox"><i></i>
                                    </label>
                                </th>-->

                                <th>Question Title</th>
                                <th  style="width:100px" class="text-right">Created</th>
                                <th style="width:100px">Status</th>
                                <th style="width:60px"  class="text-right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($totalApproveComments))
                                @foreach($totalApproveComments as $totalApproveComment)
                                    <tr>
                                        <td>{{$totalApproveComment->comment}}</td>
                                        <td  class="text-right">{{$totalApproveComment->created_at}}</td>
                                        <td>
                                            <label class="i-switch i-switch-md bg-info m-t-xs m-r">
                                                {!! Form::open(array('url'=>'/admin/question-answer/comments/makePending/'.$totalApproveComment->id)) !!}
                                                <input type="hidden" name="comment_id" value="{{$totalApproveComment->id}}">
                                                <input type="hidden" name="approveComment" value="{{$totalApproveComment->status}}">
                                                <input type="checkbox" checked onChange="this.form.submit()">
                                                <i></i>
                                                {!! Form::close() !!}
                                            </label>

                                        </td>
                                        <td  class="text-right">
                                            <a title="Delete" onclick="return yesDetete()"
                                               href="{{URL::to('/admin/question-answer/comments/delete/'.$totalApproveComment->id)}}"
                                               class="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash-o"></i></a>
                                        </td>

                                    </tr>

                                @endforeach
                            @endif

                            </tbody>
                        </table>

                    </div>
                    <footer class="panel-footer">
                        @if(isset($totalApproveComments))
                        <div class="row">

                            <div class="col-sm-4 text-left">
                                <small class="text-muted inline m-t-sm m-b-sm">
                                    <?php
                                    $from = ($totalApproveComments->currentPage() - 1) * ($totalApproveComments->perPage()) + 1;
                                    $to = $from + $totalApproveComments->count() - 1;

                                    echo "Showing " . $from . " - " . $to . " of " . $totalApproveComments->total() . " items";

                                    ?>
                                </small>
                            </div>
                            <div class="col-sm-8 text-right text-center-xs">
                                {!! str_replace('/?', '?', $totalApproveComments->render()) !!}
                            </div>
                        </div>
                        @endif
                    </footer>
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