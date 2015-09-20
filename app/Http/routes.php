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

Route::get('/install','InstallController@index');
Route::post('/install','InstallController@proceed');

Route::get('/api/csrf', function () {
	return csrf_token();
});

Route::get('/', function () {
	return view('welcome');
});

Route::get('/index','MainController@index');