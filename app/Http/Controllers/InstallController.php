<?php

namespace Shopvel\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Schema;
use Artisan;

class InstallController extends BaseController {

	var $data = array();
	
	public function __construct(){
		
	}
	
	public function index($method = "main")
	{
		try{
			if(Schema::hasTable('options')){
				echo "Already installed";
			} else{
				Artisan::call('migrate');
			}
		}catch(Exception $e){}

		$this->data['currStep'] = "welcome";
	}

}