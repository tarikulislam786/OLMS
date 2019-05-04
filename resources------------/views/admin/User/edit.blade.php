@extends("admin.master")

@section('title', 'Update Admin User Registration')

@section('head_scripts')
    <link rel="stylesheet" type="text/css" href="{{ asset('fancybox/jquery.fancybox.css?v=2.1.5') }}" media="screen"/>
    <script type="text/javascript" src="{{ asset('fancybox/jquery.fancybox.js?v=2.1.5') }}"></script>
@stop
@section('childcontent')
    <div id="content" class="app-content" role="main">
        <div class="app-content-body ">


            <div class="bg-light lter b-b wrapper-md">
                <h1 class="m-n font-thin h3">Update User</h1>
            </div>
            <div class="wrapper-md">


                <div class="panel panel-default">
                    <div class="panel-heading font-bold">Update Admin User</div>
                    {{Session::get('message')}}

                    <div class="panel-body">
                        {!! Form::open(array('url'=>'/admin/user/update')) !!}
                        <input type="hidden" name="id" value="{{$user->id}}"/>

                        <div class="row">
                            <div class="col-sm-6">
                                <label>Name</label>
                                <input type="text" @if($user->name=='root') disabled @endif name="name" class="form-control" id="name" value="{{$user->name}}"/>
                            </div>
                            <div class="col-sm-6">
                                <label>Email</label>
                                <input type="text" @if($user->name=='root') disabled @endif name="email" class="form-control" id="email" value="{{$user->email}}"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 m-t">
                                <label>Password  <span style="color:green;font-size:12px">(use blank to keep the current password)</span></label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                            <div class="col-sm-6 m-t">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm-password" class="form-control"
                                       id="confirm-password">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 m-t"><label for="title">User Role</label>
                                <select style="height: 34px;" class="form-control inline m-b" name="roles">
                                    @foreach($allRoles as $role)
                                        <option @if($user->role_id == $role->id) {{'selected'}} @endif  value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 m-t">
                                <label for="title">User Photo</label>

                                <div class="input-group">
                                    <input id="text_uploaded_image" name="text_uploaded_image" type="text"
                                           class="form-control" readonly="" value="{{$user->photo}}">
                                            <span class="input-group-btn">
                                                <a href="{{env('base_url')}}/filemanager/dialog.php?crossdomain=1&type=1&field_id=text_uploaded_image&relative_url=1&akey=dsflFWR9u2xQa"
                                                   class="iframe-btn" type="button">
                                                <span class="btn btn-default btn-file">
                                                     <span class="glyphicon glyphicon-folder-open"
                                                           style="padding-right: 3px;"></span>
                                                         Choose file
                                                </span></a>
                                            </span>
                                </div>
                                <br>
                                    <img src="{{asset('')}}{{env('filemanager_thumbs')}}{{$user->photo}}"
                                     id="selected_preview_image"/>
                            </div>

                        </div>



                        <div>

                            <a href="{{URL::to('admin/user/list')}}">
                                <button type="button" class="btn btn-sm btn-default">Cancel</button>
                            </a>
                            <button type="submit" class="btn btn-sm btn-info">Update User</button>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/aitl-stand-alone-filemanager.js') }}"></script>
    </div>


@stop
@section('scripts')
<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea",theme: "modern",height: 300,
        menubar:false,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
        ],
        toolbar1: "undo redo | styleselect | forecolor backcolor | bold italic underline | " +
        "alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | " +
        "link anchor | responsivefilemanager image media preview code",
        image_advtab: true,
        relative_urls:false,
        external_filemanager_path: "{{env('base_url')}}/filemanager/",
        filemanager_title:"{{env('filemanager_title')}}",
        filemanager_access_key:"dsflFWR9u2xQa" ,
        external_plugins: { "filemanager" : "{{env('base_url')}}/filemanager/plugin.min.js"}
    });
</script>


        <!--for datetimepicker-->
    <script type="text/javascript">
        $('#datetimepicker').datetimepicker({
            format: 'yyyy-MM-dd hh:mm:ss',
            language: 'pt-BR'
        });
    </script>
@stop