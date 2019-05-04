@extends('app')

@section('title', 'Registration')
<link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('bower_components/animate.css/animate.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('bower_components/simple-line-icons/css/simple-line-icons.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('css/font.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('css/app.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('css/fileinput.min.css')}}">
<style>
#student { display: none; }
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
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading text-center">Teacher Registration Form</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					@if (Session::get('message') == true)
						<div class="alert alert-danger  alert-dismissible fade in" role="alert">
							<span type="button" class="close" data-dismiss="alert" aria-label="Close"><span
										aria-hidden="true"><i class="icon-cross3"
															  id="close-search"></i></span></span>
							{{Session::get('message')}}
						</div>
					@endif
					{!!Form::open(['url'=>'/register','class'=>'form form-horizontal','id'=>'form','role'=>'form', 'files'=>true])!!}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">First Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Last Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Designation</label>
							<div class="col-md-6">
								<select name="designation" id="" class="form-control input-sm">
									<option>Choose designation</option>
									<option value="Lecturer">Lecturer</option>
									<option value="Assistant Professor">Assistant Professor</option>
									<option  value="Associate Professor">Associate Professor</option>
									<option value="Professor">Professor</option>
									<option value="Other">Other</option>
								</select>

							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Discipline</label>
							<div class="col-md-6">
								<select name="discipline_id" id="" class="form-control">
									<option value="">Select Discipline</option>
									@foreach($disciplines as $discipline)
										<option value="{{$discipline->id}}">{{$discipline->name}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" for="postImage">Profile Picture</label>

							<div class="col-md-6">
								<input id="input-file" type="file" name="image"
									   accept="image/*" class="file">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Mobile No </label>
							<div class="col-md-6" style="position: relative;">
								<input onblur="isValid_BD_Mobile_Number()" type="text" class="form-control" name="phone" value="{{ old('phone') }}" id="phone"
									   required>
								(<span style="color:#5383C1; font-size:smaller">example 8801XXXXXXXXX</span>)
								<div class="phonemessage"></div>
							</div>
							<div class="clearfix"></div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<div style="color:#d84315" id="passwordmessage"></div>
								<div id="myform">
									<input id="myPassword" onblur="isVeryStrongPassword()" type="password" class="form-control txtNewPassword password_pop"
										   required
										   name="password" value="">
								</div>
								<div class="clearfix"></div>
								<div id="sixchartor"></div>
								<p class="text-info mar-0px">(Use combination of A-Z,a-z,1-9, symbols and minimum 9 character to strong your password.)</p>
							</div>

							<div class="clearfix"></div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<div style="position: relative;">
									<input type="password" class="form-control" name="password_confirmation"
										   value="" id="txtConfirmPassword" onChange="checkPasswordMatch();"
										   required>

									<div class="registrationFormAlert divCheckPasswordMatch"></div>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div>
							<input type="hidden" name="role" value="1">
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button onclick="return gotoNextStep()" type="submit" class="btn btn-primary disabled btnCreateMyAccount">
									Register
								</button>
							</div>
						</div>
						{!! Form::close() !!}
					{{--</form>--}}
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.js')}}"></script>
<script src="{{asset('js/ui-load.js')}}"></script>
<script src="{{asset('js/ui-jp.config.js')}}"></script>
<script src="{{asset('js/ui-jp.js')}}"></script>
<script src="{{asset('js/ui-nav.js')}}"></script>
<script src="{{asset('js/ui-toggle.js')}}"></script>
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

//	function gotoNextStep()
//	{
//		if(isVeryStrongPassword()) {
//			return true;
//		}
//	}

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

<script>
	$("#phone").attr("maxlength", 13);
	function validateNumber(event) {
		var key = window.event ? event.keyCode : event.which;

		if (event.keyCode === 8 || event.keyCode === 46
				|| event.keyCode === 37 || event.keyCode === 39) {
			return true;
		}
		else if ( key < 48 || key > 57 ) {
			return false;
		}
		else return true;
	};
	$(document).ready(function(){
		$('[id^=phone]').keypress(validateNumber);
	});
</script>
<script>
	$(document).ready(function(){
		var name_input = $('input').val();
		if(name_input != null) {

			$("#nextpage").click(function () {
				$(".secondpage").addClass("show").removeClass("hidden");
				$(".firstpage").addClass("hidden");
			});
		}
	});
</script>

<script>
	function isValid_BD_Mobile_Number(){

		var Number = document.getElementById('phone').value;

		var IndNum = /^8801[15-9]\d{8}\r?$/;

		if(IndNum.test(Number)){
			// alert("OK");
			$(".phonemessage").html("<i class='fa fa-check-circle text-success'></i>");
			return true;
		}

		else{
			//$('#errormessage').text('please enter valid mobile number');

			$(".phonemessage").html("<i class='fa fa-times-circle text-danger'></i>");
			document.getElementById('phone').focus();
		}

		return false;
	}

	isCaptcha = false;

	function gotoNextStep()
	{
		if(isValid_BD_Mobile_Number()) {
			if(isVeryStrongPassword())
			{
				if(!document.getElementById("condition").checked)
				{
					$('#term_message').html('You have to agree the terms and policy.');

				}
				else {

					$('#term_message').html('');

					if(!isCaptcha) {
						$('#recaptch_message').html('Please verify that you are a human.');
					}
					else
						return true;
				}
			}
		}
		else alert("Support only Bangladeshi Mobile Number");

		return false;

	}


	function recaptchaCallback() {
		isCaptcha = true;
		$('#recaptch_message').html('');
	};




</script>

<script src="{{asset('js/fileinput.min.js')}}"></script>
<script>
	$(document).on('ready', function () {
		$("#input-file").fileinput({
			previewFileType: "image",
		});
	});
</script>
@endsection
