@extends("admin.master")

@section('title', 'Question')

@section('childcontent')
    <div id="content" class="app-content" role="main">

        <div class="app-content-body ">
            <div class="bg-light lter b-b wrapper-md">
                <h1 class="m-n font-thin h3">User Answers</h1>
            </div>
            <div class="wrapper-md">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold">
                        Pending Answers
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
                                @if(isset($totalPendingAnswers))
                                    @foreach($totalPendingAnswers as $totalPendingAnswer)
                                        <tr>
                                            <td>{{$totalPendingAnswer->answer}}</td>
                                            <td class="text-right">{{$totalPendingAnswer->created_at}}</td>
                                            <td>
                                                <label class="i-switch i-switch-md bg-info m-t-xs m-r">
                                                    {!! Form::open(array('url'=>'/admin/question-answer/answers/makeApprove/'.$totalPendingAnswer->id)) !!}
                                                    <input type="hidden" name="answer_id" value="{{$totalPendingAnswer->id}}">
                                                    <input type="hidden" name="pendingAnswer" value="{{$totalPendingAnswer->status}}">
                                                    <input type="checkbox" onChange="this.form.submit()">
                                                    <i></i>
                                                    {!! Form::close() !!}
                                                </label>

                                            </td>
                                            <td class="text-right">
                                                <a title="Delete" onclick="return yesDetete()"
                                                   href="{{URL::to('/admin/question-answer/answers/delete/'.$totalPendingAnswer->id)}}"
                                                   class="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash-o"></i></a>
                                            </td>

                                        </tr>

                                    @endforeach
                                @endif

                            </tbody>
                        </table>

                    </div>
                    <footer class="panel-footer">
                        @if(isset($totalPendingAnswers))
                        <div class="row">

                            <div class="col-sm-4 text-left">
                                <small class="text-muted inline m-t-sm m-b-sm">
                                    <?php
                                    $from = ($totalPendingAnswers->currentPage() - 1) * ($totalPendingAnswers->perPage()) + 1;
                                    $to = $from + $totalPendingAnswers->count() - 1;

                                    echo "Showing " . $from . " - " . $to . " of " . $totalPendingAnswers->total() . " items";

                                    ?>
                                </small>
                            </div>
                            <div class="col-sm-8 text-right text-center-xs">
                                {!! str_replace('/?', '?', $totalPendingAnswers->render()) !!}
                            </div>
                        </div>
                        @endif
                    </footer>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading font-bold">
                        Approved Answers
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
                                <th style="width:100px" class="text-right">Created</th>
                                <th style="width:100px">Status</th>
                                <th style="width:60px"  class="text-right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($totalApproveAnswers))
                                @foreach($totalApproveAnswers as $totalApproveAnswer)
                                    <tr>
                                        <td>{{$totalApproveAnswer->answer}}</td>
                                        <td class="text-right">{{$totalApproveAnswer->created_at}}</td>
                                        <td>
                                            <label class="i-switch i-switch-md bg-info m-t-xs m-r">
                                                {!! Form::open(array('url'=>'/admin/question-answer/answers/makePending/'.$totalApproveAnswer->id)) !!}
                                                <input type="hidden" name="answer_id" value="{{$totalApproveAnswer->id}}">
                                                <input type="hidden" name="approveAnswer" value="{{$totalApproveAnswer->status}}">
                                                <input type="checkbox" checked onChange="this.form.submit()">
                                                <i></i>
                                                {!! Form::close() !!}
                                            </label>

                                        </td>
                                        <td class="text-right">
                                            <a title="Delete" onclick="return yesDetete()"
                                               href="{{URL::to('/admin/question-answer/answers/delete/'.$totalApproveAnswer->id)}}"
                                               class="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash-o"></i></a>
                                        </td>

                                    </tr>

                                @endforeach
                            @endif

                            </tbody>
                        </table>

                    </div>
                    <footer class="panel-footer">
                        @if(isset($totalApproveAnswers))
                        <div class="row">

                            <div class="col-sm-4 text-left">
                                <small class="text-muted inline m-t-sm m-b-sm">
                                    <?php
                                    $from = ($totalApproveAnswers->currentPage() - 1) * ($totalApproveAnswers->perPage()) + 1;
                                    $to = $from + $totalApproveAnswers->count() - 1;

                                    echo "Showing " . $from . " - " . $to . " of " . $totalApproveAnswers->total() . " items";

                                    ?>
                                </small>
                            </div>
                            <div class="col-sm-8 text-right text-center-xs">{!! str_replace('/?', '?', $totalApproveAnswers->appends(['sort' => 'answer'])->render()) !!}

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