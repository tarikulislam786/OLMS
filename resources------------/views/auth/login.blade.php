<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Login to {{env('APP_NAME')}}</title>
    <meta name="description" content="Angularjs, Html5, Music, Landing, 4 in 1 ui kits package"/>
    <meta name="keywords"
          content="AngularJS, angular, bootstrap, admin, dashboard, panel, app, charts, components,flat, responsive, layout, kit, ui, route, web, app, widgets"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('bower_components/animate.css/animate.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}"
          type="text/css"/>
    <link rel="stylesheet" href="{{ asset('bower_components/simple-line-icons/css/simple-line-icons.css') }}"
          type="text/css"/>

    <link rel="stylesheet" href="{{ asset('css/font.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css"/>

</head>
<body style="background-image: url('img/header-bg.png')">
<div class="app app-header-fixed">
    <div class="container w-xxl w-auto-xs" ng-controller="SigninFormController"
         ng-init="app.settings.container = false;">
        <h2 class="navbar-brand block m-t">{{env('APP_NAME')}}</h2>

        <div class="m-b-lg">
            {!! Form::open(array('url'=>'/login')) !!}

            <div class="list-group list-group-sm">
                <div class="list-group-item">
                    <input type="email" placeholder="Email" class="form-control no-border" name="email" required>
                </div>
                <div class="list-group-item">
                    <input type="password" placeholder="Password" class="form-control no-border" name="password"
                           required>
                </div>
            </div>
            <button type="submit" class="btn btn-lg btn-primary btn-block">Log in</button>
            <div class="form-group text-right">
                <a href="{{url('password/email')}}">Forgot Your Password?</a>
            </div>
            <h3 class="text-center">Or</h3>

            <div class="row">
                <div class="col-sm-6">
                    <a href="{{url('/teacher-registration')}}" type="submit" class="btn btn-lg btn-info btn-block">Teacher
                        Register</a>
                </div>
                <div class="col-sm-6">
                    <a href="{{url('/student-registration')}}" type="submit" class="btn btn-lg btn-info btn-block">Student
                        Register</a>
                </div>
            </div>


            {!! Form::close() !!}
            @if (Session::get('message') == true)
                <div class="alert alert-danger alert-dismissible fade in mar_top_10px" role="alert">
                    <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true"><i class="icon-cross3" id="close-search"></i></span></span>
                    {{Session::get('message')}}
                </div>
            @endif
        </div>
        <div class="text-center" ng-include="'tpl/blocks/page_footer.html'">
            <p>
                <small class="text-muted">Copyright &copy; <?php echo date("Y");?> - {{env('APP_NAME')}}.com</small>
            </p>
        </div>

        @if(env('DEVELOPMEMT_MODE') == 1)
            <div class="alert alert-info alert-dismissible fade in mar_top_10px" role="alert">
                <p>Admin (3)   : topaccess38@gmail.com</p>
                </br>
                <p>Teacher (1) :  djane1429@gmail.com</p>
                <p style="padding-left:70px">nehabaleki@gmail.com</p>
                <br>
                <p>Student (2) : hoggpeter388@gmail.com</p>
                <p style="padding-left:70px">firefly.rob@yahoo.com</p>
                </br>
                <h4>Password: aaAA11!!aa</h4>

            </div>
        @endif
    </div>


</div>


<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('js/ui-load.js') }}"></script>
<script src="{{ asset('js/ui-jp.config.js') }}"></script>
<script src="{{ asset('js/ui-jp.js') }}"></script>
<script src="{{ asset('js/ui-nav.js') }}"></script>
<script src="{{ asset('js/ui-toggle.js') }}"></script>

</body>
</html>
