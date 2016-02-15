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

use Shopvel\Option;

function add_option( $option, $value = '' ) {
	$option = new Option;
	$option->option_name = $option;
	$option->option_value = $value;
	$option->save();
}

function get_option( $name ) {
	$option = Option::where('option_name', '=', $name)->pluck('option_value');
	return $option;
}