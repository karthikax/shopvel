<!DOCTYPE html>
<html>
<head>
	<title>Laravel</title>

	<link href="https://fonts.googleapis.com/css?family=Lato:100,400" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/style.css') }}">
	<style>
		html, body {
			height: 100%;
		}

		body {
			margin: 0;
			padding: 0;
			width: 100%;
			display: table;
			font-weight: 400;
			color: #727682;
			font-family: 'Lato';
		}

		.container {
			text-align: center;
			display: table-cell;
			vertical-align: middle;
		}

		.content {
			text-align: center;
			display: inline-block;
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
	</style>
</head>
<body>
	<div class="container">
		<div class="content">
			@if($errors->any())
				<h4 style='color:red;'>{{$errors->first()}}</h4>
			@endif

			@if( $currStep == "installed" )
				<div class="title">Already installed.</div>
				<center>You need to drop all tables in your database to reinstall.</center>
			@elseif( $currStep == "1" )
				<div class="languages">
					<form method="post">
						<div class="heading">Select Language</div>
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
			@endif
		</div>
	</div>

	<script type="text/javascript" src="{{ asset('resources/assets/js/jquery-1.11.3.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('resources/assets/js/script.js') }}"></script>
</body>
</html>
