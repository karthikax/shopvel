<?php

namespace Shopvel\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Schema;
use Artisan;
use View;
use Config;
use Input;

class InstallController extends BaseController {

	var $data = array();
	
	public function __construct(){
		
	}
	
	public function index($method = "main")
	{
		try{
			if(Schema::hasTable('options')){
				//echo "Already installed";
			} else{
				Artisan::call('migrate');
			}
		}catch(Exception $e){}

		$this->data['currStep'] = "1";
		$this->data['languages'] = config('app.locales');
		return View::make('install', $this->data);
	}

	public function proceed()
	{
		if(Input::get('currStep') == "1"){
			var_dump( $_POST );
		}
	}

}