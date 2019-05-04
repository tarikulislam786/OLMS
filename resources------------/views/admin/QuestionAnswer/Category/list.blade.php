@extends("admin.master")

@section('title', 'Question')

@section('childcontent')
    <div id="content" class="app-content" role="main">

        <div class="app-content-body ">
            <div class="bg-light lter b-b wrapper-md">
                <h1 class="m-n font-thin h3">Question Answering</h1>
            </div>
            <div class="wrapper-md">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold">
                        Categories
                    </div>

                    <div> <!--class="table-responsive">-->
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

                        <table class="table table-striped b-t b-light">
                            <thead>
                            <tr>
                                <th>Category Title</th>
                                <th style="width:100px" class="text-right">Created</th>
                                <th style="width:100px" class="text-right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($Categories as $Category)
                                <tr>
                                    <td>{{$Category->title}}</td>
                                    <td class="text-right">{{$Category->created_at->format('d-m-Y')}}</td>
                                    <td class="text-right">
                                        <a title="Edit"
                                           href="{{URL::to('/admin/question-answer/category/edit/'.$Category->id)}}"
                                           class="btn btn-sm btn-icon btn-default"><i class="fa fa-edit"></i></a>
                                        <a onclick="return yesDetete()" title="Delete"
                                           href="{{URL::to('/admin/question-answer/category/delete/'.$Category->id)}}"
                                           class="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-sm-4 text-left">
                                <small class="text-muted inline m-t-sm m-b-sm">
                                    <?php
                                        //echo $Categories->render();
                                    $from = ($Categories->currentPage() - 1) * ($Categories->perPage()) + 1;
                                    $to = $from + $Categories->count() - 1;
                                    echo "Showing " . $from . " - " . $to . " of " . $Categories->total() . " items";
                                    ?> </small>
                            </div>
                            <div class="col-sm-8 text-right text-center-xs">{!! str_replace('/?', '?', $Categories->render()) !!}</div>
                        </div>
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







