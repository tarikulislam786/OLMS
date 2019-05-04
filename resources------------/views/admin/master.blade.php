<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{env('APP_NAME')}} :: @yield('title')</title>
    <meta name="description" content="Teacher Student Forum." />
    <meta name="keywords" content="Teacher, Student, Forum, Learn, Teaching." />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('bower_components/animate.css/animate.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('bower_components/simple-line-icons/css/simple-line-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/font.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/app.css')}}" type="text/css" />
    <script src="{{ asset('js/jquery.min.js') }}"></script>


    <!--[if IE]>
        <link rel="stylesheet" href="{{asset('css/non-responsive.css')}}" type="text/css" />
    <![endif]-->
    {{--<!--[if IE 7]>--}}
        {{--<link rel="stylesheet" href="{{asset('css/non-responsive.css')}}" type="text/css" />--}}
    {{--<![endif]-->--}}
    {{--<!--[if IE 9]>--}}
        {{--<link rel="stylesheet" href="{{asset('css/non-responsive.css')}}" type="text/css" />--}}
    {{--<![endif]-->--}}

    @yield('stylesheet')
    @yield('head_scripts')
    <script type="text/javascript">
        function yesDetete() {
            return confirm('Are You Sure You Want To Delete?')
        }
    </script>
</head>
<body>

<div class="app app-header-fixed">

    <!-- header -->
    <header id="header" class="app-header navbar" role="menu">
        <!-- navbar header -->
        <div class="navbar-header bg-dark" style="text-align: center">
            <button class="pull-right visible-xs dk" ui-toggle="show" target=".navbar-collapse">
                <i class="glyphicon glyphicon-cog"></i>
            </button>
            <button class="pull-right visible-xs" ui-toggle="off-screen" target=".app-aside" ui-scroll="app">
                <i class="glyphicon glyphicon-align-justify"></i>
            </button>
            <!-- brand -->
            <a href="#/" class="navbar-brand text-lt">
                <img src="img/logo.png" alt="." class="hide">
                <span class="hidden-folded m-l-xs">{{env('APP_NAME')}}</span>
            </a>
            <!-- / brand -->
        </div>
        <!-- / navbar header -->

        <!-- navbar collapse -->
        <div class="collapse pos-rlt navbar-collapse box-shadow bg-white-only">
            <!-- buttons -->
            <div class="nav navbar-nav hidden-xs">
                <a href="#" class="btn no-shadow navbar-btn" ui-toggle="app-aside-folded" target=".app">
                    <i class="fa fa-dedent fa-fw text"></i>
                    <i class="fa fa-indent fa-fw text-active"></i>
                </a>
                {{--<a href="#" class="btn no-shadow navbar-btn" ui-toggle="show" target="#aside-user">--}}
                    {{--<i class="icon-user fa-fw"></i>--}}
                {{--</a>--}}
            </div>
            <!-- / buttons -->
            <!-- search form -->
            <form class="navbar-form navbar-form-sm navbar-left shift" ui-shift="prependTo" data-target=".navbar-collapse" role="search" ng-controller="TypeaheadDemoCtrl">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm bg-light no-border rounded padder" placeholder="">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-sm bg-light rounded"><i class="fa fa-search"></i></button>
              </span>
                    </div>
                </div>
            </form>
            <!-- / search form -->

            <!-- nabar right -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
                      <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                          @if(Auth::user()->role == 1)
                            <img src="{{asset('images/teacher-img/'.Auth::user()->image)}}" alt="...">
                          @elseif(Auth::user()->role == 2)
                              <img src="{{asset('images/student-img/'.Auth::user()->image)}}" alt="...">
                          @elseif(Auth::user()->role == 3)
                              <img src="{{asset('images/admin-img/'.Auth::user()->image)}}" alt="...">
                          @endif
                        <i class="on md b-white bottom"></i>
                      </span>
                                    @if(!empty($studentRequestsCount))

                                <span class="badge badge-sm bg-danger pull-right-xs">
                                    {{$studentRequestsCount}}
                                </span>
                             @endif

                        <span class="hidden-sm hidden-md"></span>{{Auth::user()->first_name}} {{Auth::user()->last_name}} <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight w">
                        @if(!empty($studentRequestsCount))
                        <li>
                            <a href="{{url('/admin/student-request')}}">Student Request
                                <span class="badge badge-sm bg-danger pull-right-xs">
                                    {{$studentRequestsCount}}
                                </span>
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="{{url('/logout')}}">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- / navbar right -->
        </div>
        <!-- / navbar collapse -->
    </header>
    <!-- / header -->

    <!-- aside -->
    <aside id="aside" class="app-aside hidden-xs bg-dark">
        <div class="aside-wrap">
            <div class="navi-wrap">
                <!-- user -->
                <div class="clearfix hidden-xs text-center" id="aside-user">
                    <div class="wrapper">
                        <a href="#">
                            <span class="thumb-lg w-auto-folded avatar m-t-sm">
                                @if(Auth::user()->role == 1)
                                    <img src="{{asset('images/teacher-img/'.Auth::user()->image)}}" class="img-full" alt="{{Auth::user()->first_name.' '.Auth::user()->last_name}}">
                                @elseif(Auth::user()->role == 2)
                                    <img src="{{asset('images/student-img/'.Auth::user()->image)}}" class="img-full" alt="{{Auth::user()->first_name.' '.Auth::user()->last_name}}">
                                @elseif(Auth::user()->role == 3)
                                    <img src="{{asset('images/admin-img/'.Auth::user()->image)}}" class="img-full" alt="Admin">
                                @endif
                            </span>
                        </a>
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle hidden-folded">
                        <a class="clear">
                          <span class="block m-t-sm" id="hideusername">
                            <strong class="font-bold text-lt">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</strong>
                            {{--<b class="caret"></b>--}}
                          </span>
                          <span class="text-muted text-xs block" id="hiderole" style="padding-top:5px;padding-bottom: 5px">
                              @if(Auth::user()->role == 1)
                                  {{'Teacher'}}
                              @elseif(Auth::user()->role == 2)
                                  {{'Student'}}
                              @elseif(Auth::user()->role == 3)
                                  {{'Admin'}}
                              @endif
                          </span>


                            @if(Auth::user()->role == 1)
                                <a href="{{url('/teacher/edit-profile')}}" class="btn btn-success btn-xs" id="editprofile">Edit Profile</a>
                                <a href="{{url('/teacher/edit-profile')}}" class="btn btn-success btn-xs" id="hideprofile" style="display: none;">Edit</a>
                            @elseif(Auth::user()->role == 2)
                                <a href="{{url('/student/edit-student-profile')}}" class="btn btn-success btn-xs" id="editprofile">Edit Profile</a>
                                <a href="{{url('/student/edit-student-profile')}}" class="btn btn-success btn-xs" id="hideprofile" style="display: none;">Edit</a>
                            @elseif(Auth::user()->role == 3)
                                <a href="{{url('/admin/edit-profile')}}" class="btn btn-success btn-xs" id="editprofile">Edit Profile</a>
                                <a href="{{url('/admin/edit-profile')}}" class="btn btn-success btn-xs" id="hideprofile" style="display: none;">Edit</a>
                            @endif
                        </a>
                    <div class="line dk hidden-folded">

                    </div>

                <!-- / user -->

                <!-- nav -->
                <nav ui-nav class="navi clearfix">
                    <ul class="nav" style="text-align: left">
                        {{--<li class="hidden-folded padder m-t m-b-sm text-muted text-xs">--}}
                            {{--<span>Components</span>--}}
                        {{--</li>--}}
                        {{--<li class="line dk"></li>--}}
                        @if(Auth::user()->role == 1)

                            <li>
                                <a href="{{url('/teacher/course-list')}}">
                                    <i class="icon-notebook icon"></i>
                                    <span>Course List</span>

                                </a>
                            </li>


                            <li>
                                <a href="{{url('/teacher/student-request')}}">

                                   <?php
                                    $pendingStatus = App\Model\StudentCourse::getStudent_NewStatusCount(Auth::user()->id);
                                    ?>
                                    @if(isset($pendingStatus) && $pendingStatus->count >0)<b class="badge bg-info pull-right">{{$pendingStatus->count}}</b>@endif

                                    <i class="icon-user icon text-success-lter"></i>
                                    <span>Student Request</span>

                                </a>
                            </li>





                        @elseif(Auth::user()->role == 2)
                            <li>
                                <a href="{{url('/student/course-list')}}">
                                    <i class="icon-notebook icon"></i>
                                    <span>Course List</span>

                                </a>
                            </li>



                        @elseif(Auth::user()->role == 3)
                            <li>
                                <a href="{{url('/admin/discipline-list')}}">
                                    <i class="fa fa-building-o"></i>
                                    <span>Discipline</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/admin/session-list')}}">
                                    <i class="fa fa-arrows-h"></i>
                                    <span>Session</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/admin/course-list')}}">
                                    <i class="fa fa-book"></i>
                                    <span>Course</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{url('/admin/assigncourse')}}">
                                    <i class="fa fa-thumb-tack"></i>
                                    <span>Assign Teacher</span>
                                </a>
                            </li>
                            <li class="line dk hidden-folded"></li>
                            <li>
                                <a href="{{url('/admin/users')}}">
                                    <i class="icon-user icon text-success-lter"></i>
                                    {{--<b class="badge bg-success pull-right">30%</b>--}}
                                    <span>Users</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
                <!-- nav -->

            </div>
        </div>
    </aside>
    <!-- / aside -->

    <!-- content -->
    <div id="content" class="app-content" role="main">
        <div class="app-content-body ">

            @yield('content')

        </div>
    </div>
    <!-- / content -->

    <!-- footer -->
    <footer id="footer" class="app-footer" role="footer">
        <div class="wrapper b-t bg-light">
            <span class="pull-right">Version: 1.0.1 <a href ui-scroll="app" class="m-l-sm text-muted"></a></span>
            Copyright &copy; 2016. {{env('APP_FULL_NAME')}}
        </div>
    </footer>
    <!-- / footer -->

</div>

<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.js')}}"></script>
<script src="{{asset('js/ui-load.js')}}"></script>
<script src="{{asset('js/ui-jp.config.js')}}"></script>
<script src="{{asset('js/ui-jp.js')}}"></script>
<script src="{{asset('js/ui-nav.js')}}"></script>
<script src="{{asset('js/ui-toggle.js')}}"></script>
<script>
    setTimeout(function(){
        $('.message').slideUp();
    }, 4000);
</script>
@yield('scripts')
</body>
</html>
