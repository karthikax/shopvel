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

if(Schema::hasTable('options')){
	$admin_url = '/' . get_option('adminurl');
	$login_url = '/' . get_option('loginurl');
	$register_url = '/' . get_option('registerurl');
} else{
	$admin_url = '/admin';
	$login_url = '/login';
	$register_url = '/register';
}

Route::get('/install','InstallController@index');
Route::post('/install','InstallController@proceed');

Route::get('/api/csrf', function () {
	return csrf_token();
});

Route::get('/', function () {
	return view('welcome');
});

Route::get('/index','MainController@index');
Route::get($admin_url,'DashboardController@index');
Route::get($login_url,'Auth\AuthController@getLogin');
Route::post($login_url,'Auth\AuthController@postLogin');