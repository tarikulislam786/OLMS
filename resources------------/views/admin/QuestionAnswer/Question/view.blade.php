@extends("admin.master")
@section('title', 'Question')
@section('childcontent')
    <div id="content" class="app-content" role="main">
        <div class="app-content-body ">
            <div class="bg-light lter b-b wrapper-md">
                <h1 class="m-n font-thin h3">User's Question</h1>
            </div>
            <div class="wrapper-md">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold">
                        Pending Questions
                    </div>
                    <div class="row wrapper">
                        <div class="col-sm-9 m-b-xs">
                            <a href="{{URL::to('/admin/question-answer/category/add/')}}"
                               class="btn btn-sm btn-success btn-addon"><i class="fa fa-plus"></i>Category</a>
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
                                <th>Question Title</th>
                                <th>Question Description</th>
                                <th style="width:100px" class="text-right">Created</th>
                                <th style="width:100px">Status</th>
                                <th style="width:60px"  class="text-right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($totalPendingQuestions))
                                @foreach($totalPendingQuestions as $totalPendingQuestion)
                                    <tr>
                                        <td>{{$totalPendingQuestion->title}}</td>
                                        <td>{{$totalPendingQuestion->description}}</td>
                                        <td class="text-right">{{$totalPendingQuestion->created_at}}</td>
                                        <td>
                                            <label class="i-switch i-switch-md bg-info m-t-xs m-r">
                                                {!! Form::open(array('url'=>'/admin/question-answer/questions/makeApprove/'.$totalPendingQuestion->id)) !!}
                                                <input type="hidden" name="question_id" value="{{$totalPendingQuestion->id}}">
                                                <input type="hidden" name="pendingQuestion" value="{{$totalPendingQuestion->status}}">
                                                <input type="checkbox" onChange="this.form.submit()">
                                                <i></i>
                                                {!! Form::close() !!}
                                            </label>
                                        </td>
                                        <td class="text-right">
                                            <a title="Delete" onclick="return yesDetete()"
                                               href="{{URL::to('/admin/question-answer/questions/delete/'.$totalPendingQuestion->id)}}"
                                               class="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <footer class="panel-footer">
                        @if(isset($totalPendingQuestions))
                            <div class="row">
                                <div class="col-sm-4 text-left">
                                    <small class="text-muted inline m-t-sm m-b-sm">
                                        <?php
                                        $from = ($totalPendingQuestions->currentPage() - 1) * ($totalPendingQuestions->perPage()) + 1;
                                        $to = $from + $totalPendingQuestions->count() - 1;
                                        echo "Showing " . $from . " - " . $to . " of " . $totalPendingQuestions->total() . " items";
                                        ?>
                                    </small>
                                </div>
                                <div class="col-sm-8 text-right text-center-xs">
                                    {!! str_replace('/?', '?', $totalPendingQuestions->render()) !!}
                                </div>
                            </div>
                        @endif
                    </footer>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading font-bold">
                        Approved Questions
                    </div>
                    <div class="row wrapper">
                        <div class="col-sm-9 m-b-xs">
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
                                <th>Question Title</th>
                                <th>Question Description</th>
                                <th style="width:100px" class="text-right">Created</th>
                                <th style="width:100px">Status</th>
                                <th style="width:60px"  class="text-right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($totalApproveQuestions))
                                @foreach($totalApproveQuestions as $totalApproveQuestion)
                                    <tr>
                                        <td>{{$totalApproveQuestion->title}}</td>
                                        <td>{{$totalApproveQuestion->description}}</td>
                                        <td class="text-right">{{$totalApproveQuestion->created_at}}</td>
                                        <td>
                                            <label class="i-switch i-switch-md bg-info m-t-xs m-r">
                                                {!! Form::open(array('url'=>'/admin/question-answer/questions/makePending/'.$totalApproveQuestion->id)) !!}
                                                <input type="hidden" name="question_id" value="{{$totalApproveQuestion->id}}">
                                                <input type="hidden" name="approveQuestion" value="{{$totalApproveQuestion->status}}">
                                                <input type="checkbox" checked onChange="this.form.submit()">
                                                <i></i>
                                                {!! Form::close() !!}
                                            </label>
                                        </td>
                                        <td class="text-right">
                                            <a title="Delete" onclick="return yesDetete()"
                                               href="{{URL::to('/admin/question-answer/questions/delete/'.$totalApproveQuestion->id)}}"
                                               class="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <footer class="panel-footer">
                        @if(isset($totalApproveQuestions))
                            <div class="row">
                                <div class="col-sm-4 text-left">
                                    <small class="text-muted inline m-t-sm m-b-sm">
                                        <?php
                                        $from = ($totalApproveQuestions->currentPage() - 1) * ($totalApproveQuestions->perPage()) + 1;
                                        $to = $from + $totalApproveQuestions->count() - 1;
                                        echo "Showing " . $from . " - " . $to . " of " . $totalApproveQuestions->total() . " items";
                                        ?>
                                    </small>
                                </div>
                                <div class="col-sm-8 text-right text-center-xs">
                                    {!! str_replace('/?', '?', $totalApproveQuestions->render()) !!}
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