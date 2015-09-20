<?php

/*
|--------------------------------------------------------------------------
| Application Options Helpers
|--------------------------------------------------------------------------
|
| Here is where you can register all option helper functions for application.
| It's a breeze. Simply create functions and use it wherever required.
|
*/

use Shopvel\User, \Hash;

function add_user( $username, $email, $password, $role = 'subscriber', $name = '', $activated = 1 ) {
	$options = new User;
	$options->username	= $username;
	$options->email		= $email;
	$options->password	= Hash::make($password);
	$options->role		= $role;
	$options->name		= $name;
	$options->activated	= $activated;
	$options->save();
}