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
                    <div class="panel-heading font-bold">Add category</div>
                    {{Session::get('message')}}

                    <div class="panel-body">
                        {!! Form::open(array('url'=>'admin/question-answer/category/save')) !!}
                        <div class="form-group">
                            <label>Category Title</label>
                            <input type="text" name="categoryTitle" class="form-control" id="categoryTitle" required>
                        </div>

                        <a href="{{URL::to('admin/question-answer/category/list')}}"><button type="button" class="btn btn-sm btn-default">Cancel</button></a>
                        <button type="submit" class="btn btn-sm btn-info">Add</button>
                        {!! Form::close() !!}
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