<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Login to {{env('APP_NAME')}}</title>
	<meta name="description" content="Angularjs, Html5, Music, Landing, 4 in 1 ui kits package" />
	<meta name="keywords" content="AngularJS, angular, bootstrap, admin, dashboard, panel, app, charts, components,flat, responsive, layout, kit, ui, route, web, app, widgets" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('bower_components/animate.css/animate.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('bower_components/simple-line-icons/css/simple-line-icons.css') }}" type="text/css" />

	<link rel="stylesheet" href="{{ asset('css/font.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css" />
	<style>
		/*.strength { width: 100%; float: left; padding: 6px; border: 1px solid #ddd;*/
			/*border-radius: 2px; -webkit-border-radius: 2px; -moz-border-radius: 2px; -o-border-radius: 2px; }*/

		.mar-0px { margin: 0px; }


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
			background-color: #68D200;
			border-color: #77BF16 !important;
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
			border-radius: 2px; -webkit-border-radius: 2px; -moz-border-radius: 2px; -o-border-radius: 2px;
			-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
			box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
			-webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
			-o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
			transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
		}
	</style>

</head>
<body>
<div class="app app-header-fixed">
	<div class="container" ng-controller="SigninFormController" ng-init="app.settings.container = false;">
		<div class="passwordreset">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<div class="panel panel-default">
					<div class="panel-heading" style="border-color: #ddd;">
						<h3 class="panel-title">Reset Password</h3>
					</div>
					<div class="panel-body">
						{{--<form method="POST" action="/password/email" accept-charset="UTF-8" class="form form-horizontal"><input name="_token" type="hidden" value="xQii6t8NB1W5F8OWur7YgCw4qTvzWzGEmKBULfGZ" autocomplete="off">--}}
						{{--<form class="form-horizontal" role="form" method="POST" action="{{url('/password/reset')}}">--}}
						{!! Form::open(['url'=>'/password/reset']) !!}
						<input type="hidden" name="token" value="{{ $token }}">
						@if (count($errors) > 0)
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						@endif
						<div class="form-group">
							<label class="col-md-4 control-label" style="padding-top: 6px;padding-top: 6px;color: #333333;font-weight: bold;">E-Mail Address</label>
							<div class="col-md-6" style="">
								<div class="form-group">
									<input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
									{{--<input type="email" name="email" value="" autocomplete="off" style="width: 100%;padding: 5px;border: 1px solid #b1b1b1;">--}}
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label" style="padding-top: 6px;padding-top: 6px;color: #333333;font-weight: bold;">Create Password</label>
							<div class="col-md-6" style="">
								<div class="form-group">
									<div style="color:#d84315" id="passwordmessage"></div>
									<div id="myform">
										<input type="password" name="password" value="" id="myPassword" onblur="isVeryStrongPassword()"
										   class="form-control txtNewPassword password_pop" required
										   autocomplete="off">
									</div>
									<div class="clearfix"></div>
									<div id="sixchartor"></div>
									<p class="text-info mar-0px">(Use combination of A-Z,a-z,1-9, symbols and minimum 9 character to strong your password.)</p>
								</div>
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label" style="padding-top: 6px;padding-top: 6px;color: #333333;font-weight: bold;">Confirm Password</label>
							<div class="col-md-6" style="">
								<div class="form-group">
									<div style="position: relative;">
										<input type="password" name="password_confirmation" value="" autocomplete="off"
										   id="txtConfirmPassword" onChange="checkPasswordMatch();" class="form-control" required>
										<div class="registrationFormAlert divCheckPasswordMatch"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-default" style="background-color: #1e7ebe;padding: 6px 30px;color: #fff!important;font-size: 16px;">
									Reset Your Password
								</button>
							</div>
						</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>


	</div>


</div>



<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('js/ui-load.js') }}"></script>
<script src="{{ asset('js/ui-jp.config.js') }}"></script>
<script src="{{ asset('js/ui-jp.js') }}"></script>
<script src="{{ asset('js/ui-nav.js') }}"></script>
<script src="{{ asset('js/ui-toggle.js') }}"></script>
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


</body>
</html>
