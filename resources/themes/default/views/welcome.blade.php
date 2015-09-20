<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Shopvel</title>
	<base href="{{ url('/') }}/" />
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/style.css') }}">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body ng-app="shopvel" ng-controller="mainController">
	<aside id="menu">
		<nav>
			<ul>
				<li>Menu1</li>
				<li>Menu2</li>
				<li>Menu3</li>
				<li>Menu4</li>
			</ul>
		</nav>
	</aside>
	<div class="container">
		<div class="title">This is Default Theme</div>
		<main id="main" ng-view></main>
	</div>

	<script type="text/javascript" src="{{ asset('resources/assets/js/jquery-1.11.3.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('resources/assets/js/angular.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('resources/assets/js/angular-route.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('resources/assets/js/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('resources/assets/js/routes.js') }}"></script>

	<script type="text/javascript" src="{{ asset('resources/assets/js/script.js') }}"></script>
</body>
</html>