<?php
	global $login_url;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Shopvel</title>
	<base href="{{ url('/') }}/" />
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link rel="icon" type="image/png" href="{{ asset('resources/assets/img/icon.png') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ theme_asset('css/style.css') }}">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">
		.signin-wrap{
			width: 400px;
			margin: auto;
			padding-top: 50px;
		}
		h3 {
			text-align: center;
			background: #eee;
			color: #BF1A1A;
			border: 1px solid #ccc;
			margin-top: 0;
			padding: 10px;
		}
		.alert{
			padding-left: 30px;
		}
		.p20{
			padding-top: 20px;
		}
	</style>
</head>

<body <?php body_class(); ?>>
	<div class="signin-wrap">
		<h3>Sign Up</h3>
		@if (count($errors) > 0)
			<ol class="alert alert-danger">
				@foreach ($errors->all() as $error)
				<li>{!! $error !!}</li>
				@endforeach
			</ol>
		@endif
		<form class="form-signin" method="post">
			<div class="form-group">
				<input type="text" class="form-control" name="name" placeholder="Name" required="" autofocus value="{{ Input::old('name') }}" />
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="username" placeholder="username" required="" value="{{ Input::old('username') }}" />
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="email" placeholder="Email Address" required="" value="{{ Input::old('email') }}" />
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="password" placeholder="Password" required="" /> 
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="password_confirmation" placeholder="Repeat Password" required="" /> 
			</div>
			<div class="checkbox">
				<label><input type="checkbox" id="seller" name="seller" {{ Input::old('seller') ? 'checked' : '' }}> Become a Seller</label>
			</div>
			{!! csrf_field() !!}
			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>   
		</form>
		<div class="p20 text-center">Already have an account? <a href="{{ $login_url }}">Sign In</a></div>
	</div>
</body>
</html>