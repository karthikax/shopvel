<!DOCTYPE html>
<html>
<head>
	<title>Page Not Found.</title>

	<link href="https://fonts.googleapis.com/css?family=Lato:100,400" rel="stylesheet" type="text/css">

	<style>
		html, body {
			height: 100%;
		}

		body {
			margin: 0;
			padding: 0;
			width: 100%;
			color: #B0BEC5;
			display: table;
			font-weight: 100;
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
			font-size: 72px;
			margin-bottom: 40px;
		}
		.description{
			font-weight: 400;
		}
		a{
			text-decoration: none;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="title">Whoops.. 404.</div>
		<div class="description">That page couldn't be found. <a href="{{ url('/') }}">Return Home</a></div>
	</div>
</body>
</html>
