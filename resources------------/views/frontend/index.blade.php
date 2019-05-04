<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{env('APP_NAME')}}</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{asset('frontend_resourses/css/bootstrap.min.css')}}" type="text/css">
    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('frontend_resourses/font-awesome/css/font-awesome.min.css')}}" type="text/css">
    <!-- Plugin CSS -->
    <link rel="stylesheet" href="{{asset('frontend_resourses/css/animate.min.css')}}" type="text/css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('frontend_resourses/css/creative.css')}}" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>

    </style>

</head>

<body id="page-top">

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">{{env('APP_NAME')}}</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#courses">Course</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="{{url('/login')}}">Login</a>
                        {{--<a class="page-scroll" href="#contact">Login</a>--}}
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="container">
            <div class="header-content">
                <div class="row">
                    <div class="col-sm-4">

                    </div>
                    <div class="col-sm-8">
                        <h1>{{env('APP_FULL_NAME')}}</h1>
                        <p>Current Session: {{$current_session->session}}</p>
                    </div>
                </div>

                {{--<hr>--}}
                {{--<p>Start Bootstrap can help you build better websites using the Bootstrap CSS framework! Just download your template and start going, no strings attached!</p>--}}
                {{--<a href="#about" class="btn btn-primary btn-xl page-scroll">Find Out More</a>--}}
            </div>
        </div>
    </header>



    <section id="courses">
        {{--<div class="container">--}}
            {{--<div class="row">--}}
                {{--<div class="col-lg-12 text-center">--}}
                    {{--<h2 class="section-heading">At Your Service</h2>--}}
                    {{--<hr class="primary">--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="fixed-sidebar-nav hidden-xs">
                        <div class="list-group">
                            <?php
                            $flag=0;
                            $pre_dis_name ="";
                            ?>
                            @foreach($courses as $course)
                                <?php
                                if($pre_dis_name != $course->discipline_name)
                                {
                                    $flag=0;

                                }
                                if($flag==0)
                                {
                                    echo '<a href="#courses_'.$course->discipline_id.'" class="list-group-item page-scroll">';
                                    echo '<p class="list-group-item-heading">'.$course->discipline_name.'</p>';
                                    echo '</a>';
                                    $pre_dis_name = $course->discipline_name;
                                    $flag=1;
                                }
                                ?>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="col-sm-8">

                    <div class="courseSection">
                        <div class="department section">
                                <?php
                                $flag=0;
                                $pre_dis_name ="";
                                ?>
                                @foreach($courses as $course)
                                    <?php
                                    if($pre_dis_name != $course->discipline_name)
                                    {
                                        $flag=0;
                                        echo '<div class="clearfix"></div>';
                                    }
                                    if($flag==0)
                                    {
                                        echo '<h2 class="section-heading" id="courses_'.$course->discipline_id.'">'.$course->discipline_name.'</h2>';
                                        $pre_dis_name =$course->discipline_name;
                                        $flag=1;
                                    }
                                    ?>
                                        <div class="course-list">
                                            {{--                                                <a href="{{url('/teacher/teacher-courses/'.$course->id)}}">--}}
                                            <div class="course_img">
                                                @if(!empty($course->image))
                                                    <img src="{{asset('')}}{{env('filemanager_upload_source')}}{{$course->image}}"
                                                         class="img-responsive">
                                                @else
                                                    <img src="{{asset('img/p0.jpg')}}" alt=""
                                                         class="img-responsive">
                                                @endif
                                            </div>
                                            <div class="course_info">
                                                <p><b>{{$course->code}}: {{$course->name}}</b></p>
                                                <p>Session: {{$course->session}}</p>
                                                <p>Credit: {{$course->credit}}</p>
                                                <p>Teacher: {{$course->first_name.' '.$course->last_name}}</p>
                                            </div>
                                            {{--</a>--}}
                                            <?php
                                            $status = App\Model\TeacherCourse::getCourseStatusByCourseID($course->id);
                                            ?>
                                            @if($status[3]>0)<a style="margin-right: 10px;" class="label bg-success"
                                                                href="{{url('/teacher/student-request')}}">Registered
                                                Students: {{$status[3]}} </a> @endif
                                            <div class="clearfix"></div>
                                        </div>
                                @endforeach
                                <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Let's Get In Touch!</h2>
                    <hr class="primary">
                    <p>That's great! Give us a call or send us an email and we will get back to you as soon as possible!</p>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x wow bounceIn"></i>
                    <p>123-456-6789</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                    <p><a href="mailto:your-email@your-domain.com">feedback@wbms.com</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="{{asset('frontend_resourses/js/jquery.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('frontend_resourses/js/bootstrap.min.js')}}"></script>

    <!-- Plugin JavaScript -->
    <script src="{{asset('frontend_resourses/js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('frontend_resourses/js/jquery.fittext.js')}}"></script>
    <script src="{{asset('frontend_resourses/js/wow.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('frontend_resourses/js/creative.js')}}"></script>


</body>

</html>
