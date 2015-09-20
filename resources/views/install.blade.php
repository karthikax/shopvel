<!DOCTYPE html>
<html>
<head>
	<title>Laravel</title>

	<link href="https://fonts.googleapis.com/css?family=Lato:100,400" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/style.css') }}">
	<style>

		body {
			margin: 0;
			padding: 0;
			width: 100%;
			font-weight: 400;
			color: #727682;
			font-family: 'Lato';
			background: #f8f8f8;
		}

		.container.no-wrap {
			max-width: 800px;
			margin-top: 50px;
		}

		.container.wrap {
			text-align: center;
			max-width: 800px;
			margin-top: 50px;
			background: #fff;
			border: 1px solid #ccc;
		}

		.content {
			text-align: center;
			padding: 20px 0;
		}

		.title {
			font-size: 56px;
		}
		.list-only + .styledSelect + .options {
			min-width: 300px;
			max-height: 200px;
			overflow: auto;
		}
		.heading {
			min-width: 300px;
			background: #F6F6F7;
			padding: 5px;
			border: 2px solid #BBB;
			border-bottom: 0;
		}
		.languages button{
			margin-top: 220px;
			min-width: 300px;
		}
		.alert ul{
			list-style: none;
		}
	</style>
</head>
<body>
	@if($errors->any())
		<h4 style='color:red;'>{{$errors->first()}}</h4>
	@endif

	@if( $currStep == "0" )
		<div class="container no-wrap">
			<div class="content">
				<div class="title">Already installed.</div>
				<center>You need to drop all tables in your database to reinstall.</center>
			</div>
		</div>
	@elseif( $currStep == "1" )
		<div class="container no-wrap">
			<div class="content languages">
				<div class="title">Shopvel</div>
				<div class="heading">Select Language</div>
				<form method="post">
					<select class="list-only" name="language">
						@foreach( $languages as $code => $language )
							<option value="{{ $code }}">{{ $language }}</option>
						@endforeach
					</select>
					<input type="hidden" name="currStep" value="{{ $currStep }}">
					{!! csrf_field() !!}
					<button type="submit" class="btn btn-success">Select</button>
				</form>
			</div>
		</div>
	@elseif( $currStep == "2" )
		<div class="container wrap">
			<div class="content">
				<div class="title">Shopvel</div>
				@if( isset($installErrors) )
					<div class="alert alert-danger">
						<ul>
							@foreach( $installErrors as $error )
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				<form class="form-horizontal" method="post">
					<div class="form-group">
						<label for="title" class="col-sm-3 control-label">Site Title</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="title" name="title" placeholder="Shopvel">
						</div>
					</div>
					<div class="form-group">
						<label for="username" class="col-sm-3 control-label">Username *</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="username" name="username" placeholder="admin" >
						</div>
						<div class="col-sm-9 col-sm-offset-3">
							<small>Username can only have alphanumeric characters, underscores, hyphens, period and @ symbol</small>
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-sm-3 control-label">Password, Repeat *</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" name="password" id="password-meter" >
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-9 col-sm-offset-3">
							<input type="password" class="form-control" name="password2" id="password-repeat" >
						</div>
						<div class="col-sm-9 col-sm-offset-3">
							<small>Hint: Password should be at least 7 characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! @ # $ % ^ &amp; ) ( .</small>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-3 control-label">Your Email *</label>
						<div class="col-sm-9">
							<input type="email" class="form-control" name="email" id="email" >
						</div>
						<div class="col-sm-9 col-sm-offset-3">
							<small>Double check your email before continuing.</small>
						</div>
					</div>
					<div class="form-group">
						<label for="url" class="col-sm-3 control-label">Admin Url</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" value="{{ url('/') }}/" disabled>
						</div>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="url" id="url" placeholder="admin" >
						</div>
						<div class="col-sm-9 col-sm-offset-3">
							<small>Define URL endpoint to access your admin dashboard.</small>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<input type="hidden" name="currStep" value="{{ $currStep }}">
							{!! csrf_field() !!}
							<button type="submit" class="btn btn-success btn-block">Install Shopvel</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	@elseif( $currStep == "3" )
		<div class="container main">
			<div class="content">
				<div class="title">Completed</div>
			</div>
		</div>
	@endif

	<script type="text/javascript" src="{{ asset('resources/assets/js/jquery-1.11.3.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('resources/assets/js/script.js') }}"></script>
</body>
</html>
