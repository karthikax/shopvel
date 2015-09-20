<form method="post">
	<input name="username">
	<input name="password">
	<input name="remember" type="checkbox">
	{!! csrf_field() !!}
	<button type="submit">Login</button>
</form>