<?php
	global $admin_url, $login_url, $register_url;
	$role = Auth::user()->role;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Shopvel</title>
	<base href="{{ url('/') }}/" />
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/ionicons.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/gritter.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/style.css') }}">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body ng-app="shopvel" ng-controller="mainController" <?php body_class(); ?>>
	<aside id="admin-menu">
		<ul class="admin-menu-main">
			<li class="menu-item"><a href="{{ $admin_url }}/#/"><i class="ion-easel"></i><div class="menu-name">Dashboard</div></a></li>
			<li class="menu-item"><a href="{{ $admin_url }}/#/posts"><i class="ion-document-text"></i><div class="menu-name">Products</div></a></li>
			@if($role == 'admin')
			<li class="menu-item"><a href="{{ $admin_url }}/#/sellers"><i class="ion-person-stalker"></i><div class="menu-name">Sellers</div></a></li>
			@endif
			<li class="menu-item"><a href="{{ $admin_url }}/#/customers"><i class="ion-ios-people"></i><div class="menu-name">Customers</div></a></li>
			<li class="menu-item"><a href="{{ $admin_url }}/#/profile"><i class="ion-ios-person"></i><div class="menu-name">Profile</div></a></li>
			<li class="menu-item"><a href="{{ $admin_url }}/#/"><i class="ion-android-color-palette"></i><div class="menu-name">Themes</div></a></li>
			<li class="menu-item"><a href="{{ $admin_url }}/#/"><i class="ion-ios-toggle"></i><div class="menu-name">Plugins</div></a></li>
		</ul>
	</aside>
	<div class="admin-content">
		<main id="main" ng-view></main>
		<div class="overlay"><div class="loader"></div></div>
	</div>
	<footer class="footer">
		<div class="row">
			<div class="col-md-12">
				<div>Copyright</div>
			</div>
		</div>
	</footer>

	<script type="text/javascript" src="{{ asset('resources/assets/js/jquery-1.11.3.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('resources/assets/js/bootstrap.min.js') }}" crossorigin="anonymous"></script>
	<script type="text/javascript" src="{{ asset('resources/assets/js/jquery.gritter.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('resources/assets/js/angular.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('resources/assets/js/angular-route.min.js') }}"></script>
	<script type='text/javascript' src="{{ asset('resources/assets/js/dirPagination.js') }}"></script>
	<script type="text/javascript" src="{{ asset('resources/assets/js/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('resources/assets/js/routes.js') }}"></script>

	<script type="text/javascript" src="{{ asset('resources/assets/ckeditor/ckeditor.js') }}"></script>

	<script type="text/javascript" src="{{ asset('resources/assets/js/script.js') }}"></script>
	@include('adminbar')
</body>
</html>