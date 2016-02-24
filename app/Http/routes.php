<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

global $admin_url, $login_url, $register_url;

if(Schema::hasTable('options')){
	$admin_url = get_option('adminurl');
	$login_url = get_option('loginurl');
	$register_url = get_option('registerurl');
} else{
	$admin_url = 'admin';
	$login_url = 'login';
	$register_url = 'register';
}

Route::get('/install', 'InstallController@index');
Route::post('/install', 'InstallController@proceed');

Route::get('/api/csrf', function () {
	return csrf_token();
});

Route::get('/', function () {
	return view('welcome');
});

Route::get('/index', 'MainController@index');
Route::get('/' . $login_url, 'Auth\AuthController@getLogin');
Route::post('/' . $login_url, 'Auth\AuthController@postLogin');
Route::get('/' . $register_url, 'Auth\AuthController@getRegister');
Route::post('/' . $register_url, 'Auth\AuthController@postRegister');

Route::get('/logout', 'Auth\AuthController@getLogout');

// Dashboard
Route::group(array('prefix'=>'/','before'=>'auth|api.csrf'),function(){
	Route::get('/' . $GLOBALS['admin_url'], 'DashboardController@index');

	Route::post('/profile/edit/{id}','ProfileController@edit');

	Route::get('/sellers/listApproved/{page}','SellerController@listApproved');
	Route::get('/sellers/listPending/{page}','SellerController@listPending');
	Route::post('/sellers/approveOne/{id}','SellerController@approveOne');
	Route::post('/sellers/denyOne/{id}','SellerController@denyOne');
	Route::post('/sellers/create','SellerController@create');
	Route::post('/sellers/edit/{id}','SellerController@edit');
	Route::delete('/sellers/{id}','SellerController@delete');

	Route::get('/customers/listAll/{page}','CustomerController@listAll');
	Route::post('/customers/create','CustomerController@create');
	Route::post('/customers/edit/{id}','CustomerController@edit');
	Route::delete('/customers/{id}','CustomerController@delete');

	Route::get('/posts/listAll/{page}','PostController@listAll');
	Route::get('/posts/listApproved/{page}','PostController@listApproved');
	Route::get('/posts/listPending/{page}','PostController@listPending');
	Route::get('/posts/{id}','PostController@view');
	Route::post('/posts/approveOne/{id}','PostController@approveOne');
	Route::post('/posts/denyOne/{id}','PostController@denyOne');
	Route::post('/posts/create','PostController@create');
	Route::post('/posts/edit/{id}','PostController@edit');
	Route::delete('/posts/{id}','PostController@delete');
});

Route::any('{unknown}', function ($unknown) {
	return view('welcome');
})->where('unknown', '([A-z\d-\/_.]+)?');

//Auth filtering
Route::filter('auth', function()
{
	global $login_url;
	if (Auth::guest())
		return Redirect::to( $login_url );
});

Route::filter('api.csrf', function($route, $request)
{
	if ( Request::isMethod('post') )
	{
		if( !((Input::has('_token') AND Session::token() == Input::get('_token')) || ($request->header('X-Csrf-Token') != "" AND Session::token() == $request->header('X-Csrf-Token')) ) ){
			return Response::json('CSRF does not match', 400);
		}
	}
});