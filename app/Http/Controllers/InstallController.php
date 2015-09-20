<?php

namespace Shopvel\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Schema, Artisan, View, Config, Input;

class InstallController extends BaseController {

	var $data = array();
	
	public function __construct(){
		
	}
	
	public function index($method = "main")
	{
		try{
			if(Schema::hasTable('options')){
				$this->data['currStep'] = "0";
			} else{
				Artisan::call('migrate');
				$this->data['currStep'] = "1";
			}
		}catch(Exception $e){}

		$this->data['languages'] = config('app.locales');
		return View::make('install', $this->data);
	}

	public function proceed()
	{
		if(Input::get('currStep') == "1"){
			$lang = Input::get('language');
			Config::set('app.locale', $lang);
			$this->data['currStep'] = "2";
		}
		if(Input::get('currStep') == "2"){
			$title		= isset( $_POST['title'] ) ? $_POST['title'] : 'Shopvel';
			$username	= $_POST['username'];
			$password	= $_POST['password'];
			$password2	= $_POST['password2'];
			$email		= $_POST['email'];
			$url		= $_POST['url'];

			$this->data['currStep'] = "3";
			if( empty($username) || empty($password) || empty($email) || ( $password !== $password2 ) ){
				if( empty($username) || empty($password) || empty($email) ){
					$this->data['installErrors'][] = "Please fill in all required(*) fields.";
				}
				if( $password !== $password2 ){
					$this->data['installErrors'][] = "Password fields are not identical.";
				}
				$this->data['currStep'] = "2";
			} else{
				add_user($username, $email, $password, 'admin', '', 1);
				add_option('sitename', $title);
				add_option('sitedescription', '');
				add_option('adminurl', $url);
				add_option('theme', 'default');
				$this->data['currStep'] = "3";
			}
		}
		return View::make('install', $this->data);
	}

}