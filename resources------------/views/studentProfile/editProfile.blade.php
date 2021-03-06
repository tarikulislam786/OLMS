@extends('admin.master')
@section('title', 'Edit Profile')
@section('stylesheet')
    <style>
        #myform input[type="password"] {
            /*background: transparent;*/
            /*-webkit-appearance: none;*/
            /*-webkit-box-shadow: none;*/
            /*-moz-box-shadow: none;*/
            /*box-shadow: none;*/
            /*-webkit-transition: border .25s linear, color .25s linear;*/
            /*-moz-transition: border .25s linear, color .25s linear;*/
            /*-o-transition: border .25s linear, color .25s linear;*/
            /*transition: border .25s linear, color .25s linear;*/
            /*-webkit-backface-visibility: hidden;*/
            /*width: 100%;*/
        }

        #myform input[type="password"]:focus {
            outline: 0;
        }

        #myform {
            position: relative;
        }

        .strength_meter {
            width: 100%;
            height: 10px;
            background-color: #CCCCCC;
            z-index: -1;
        }

        .button_strength {
            text-decoration: none;
            color: #000;
            font-size: 13px;
        }

        .strength_meter div {
            width: 0%;
            height: 10px;
            text-align: right;
            color: #000;
            line-height: 10px;
            -webkit-transition: all .3s ease-in-out;
            -moz-transition: all .3s ease-in-out;
            -o-transition: all .3s ease-in-out;
            -ms-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out;
            padding-right: 12px;
        }

        .strength_meter div p {
            position: absolute;
            top: 38px;
            right: 0px;
            color: #000;
            font-size: 13px;
            padding: 0px;
            line-height: 1;
        }

        .veryweak {
            background-color: #FFA0A0;
            border-color: #F04040 !important;
            width: 25% !important;
        }

        .weak {
            background-color: #FFB78C;
            border-color: #FF853C !important;
            width: 50% !important;
        }

        .medium {
            background-color: #FFEC8B;
            border-color: #FC0 !important;
            width: 75% !important;
        }

        .strong {
            background-color: #C3FF88;
            border-color: #8DFF1C !important;
            width: 100% !important;
        }
        .registrationFormAlert, .phonemessage {
            position: absolute;
            top: 10px;
            right: -20px;
        }
        .strength {
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        }
        .mar-0px { margin: 0px; }
        .fileinput-upload, .fileinput-remove { display: none; }
    </style>

@stop
@section('head_scripts')
@stop
@section('content')
    <div class="bg-light lter b-b wrapper-md">
        @include('teacherProfile.profileHeader')
    </div>
    <div class="wrapper-md">
        {{--{{dd($profile)}}--}}
        <div class="row">
            <div class="col-sm-12">
                {!! Form::open(['url'=>'/student/student-profile-update', 'files'=>true]) !!}
                <div class="modal-body text-left">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="{{$profile->first_name}}">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{$profile->last_name}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control" value="{{$profile->email}}">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Password</label>
                                <input type="text" name="password" class="form-control" value="">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


@stop
@section('scripts')

    <script>
        $('select[id="role"]').change(function () {
            if ($(this).find('.teacher').is(':selected'))
                $('#teacher').show();
            else
                $('#teacher').hide();
            if ($(this).find('.student').is(':selected'))
                $('#student').show();
            else
                $('#student').hide();
        });
    </script>
    <script>
        function checkPasswordMatch() {
            var password = $(".txtNewPassword").val();
            var confirmPassword = $("#txtConfirmPassword").val();
            if (password != confirmPassword)
                $(".divCheckPasswordMatch").html("<i class='fa fa-times-circle text-danger'></i>");
            else {
                $(".divCheckPasswordMatch").html("<i class='fa fa-check-circle text-success'></i>");
            }
        }
        $(document).ready(function () {
            $("#txtConfirmPassword").keyup(checkPasswordMatch);
        });

        function gotoNextStep()
        {
            if(isVeryStrongPassword()) {
                return true;
            }
        }

    </script>

    <script type="text/javascript" src="{{asset('js/strength.js')}}"></script>
    <script>
        $(document).ready(function ($) {
            $('#myPassword').strength({
                strengthClass: 'strength',
                strengthMeterClass: 'strength_meter',
                strengthButtonClass: 'button_strength',
                strengthButtonText: 'Show Password',
                strengthButtonTextToggle: 'Hide Password'
            });
        });
    </script>

    <script src="{{asset('js/fileinput.min.js')}}"></script>
    <script>
        $(document).on('ready', function () {
            $("#input-file").fileinput({
                previewFileType: "image",
                browseClass: "btn btn-success"
            });
        });
    </script>

@stop