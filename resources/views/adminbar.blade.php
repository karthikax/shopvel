<?php
	global $admin_url, $login_url, $register_url;
?>

@if(Auth::check())
	<div id="adminbar">
		<ul class="list-inline pull-left">
			<li class="menu-item"><a href="{{ $admin_url }}/#/" target="_self"><i class="ion-speedometer"></i>Control Panel</a></li>
			<li class="menu-item"><a href="{{ url('/') }}/#/" target="_self"><i class="ion-android-home"></i>Home</a></li>
		</ul>
		<ul class="list-inline pull-right">
			<li class="menu-item"><a href="{{ url('logout') }}" ng-click="logout()"><i class="ion-share"></i>Log Out</a></li>
		</ul>
	</div>
	@if( ! Request::is($admin_url) )
		<style type="text/css">
		#adminbar {
			direction: ltr;
			color: #ccc;
			font: 400 13px/32px "Open Sans",sans-serif;
			height: 32px;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			min-width: 600px;
			z-index: 99999;
			background: #23282d;
		}
		body{
			padding-top: 32px;
		}
		</style>
	@endif
@endif