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

use Shopvel\Options;

function add_option( $option, $value = '' ) {
	$options = new Options;
	$options->option_name = $option;
	$options->option_value = $value;
	$options->save();
}

function get_option( $option ) {
	$options = Options::where('option_name', '=', $option)->pluck('option_value');
	return $options;
}