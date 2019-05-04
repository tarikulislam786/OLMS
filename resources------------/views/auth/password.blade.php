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
				{!! Form::open(['url'=>'/password/email','class'=>'form form-horizontal']) !!}
					<div class="form-group">
						<label class="col-md-4 control-label" style="padding-top: 6px;padding-top: 6px;color: #333333;font-weight: bold;">E-Mail Address</label>
						<div class="col-md-6" style="">
							<div class="form-group">
								<input type="email" name="email" value="" autocomplete="off" style="width: 100%;padding: 5px;border: 1px solid #b1b1b1;">
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-default" style="background-color: #1e7ebe;padding: 6px 30px;color: #fff!important;font-size: 16px;">
								Send Password Reset Link
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

</body>
</html>
