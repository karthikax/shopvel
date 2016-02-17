<?php

namespace Shopvel\Http\Controllers;

use Shopvel\User;
use Auth, Input;
use Illuminate\Http\Request;
use Shopvel\Http\Requests;
use Shopvel\Http\Controllers\Controller;

class ProfileController extends Controller
{

	protected $data = array();

	public function __construct()
	{
		$this->middleware('auth');
		$this->data['user'] = Auth::user();
	}

	public function edit($id){
		if( $this->data['user']->id != $id ) exit;
		if(User::where('username',trim(Input::get('username')))->where('id','<>',$id)->count() > 0){
			return json_encode(array("jsTitle"=>"Edit Profile","jsStatus"=>"0","jsMessage"=>"Username already used" ));
			exit;
		}
		if(User::where('email',Input::get('email'))->where('id','<>',$id)->count() > 0){
			return json_encode(array("jsTitle"=>"Edit Profile","jsStatus"=>"0","jsMessage"=>"Email already used" ));
			exit;
		}
		$pw = Input::get('password');
		if( (null !== $pw) && ($pw != Input::get('password_confirmation')) ){
			return json_encode(array("jsTitle"=>"Password","jsStatus"=>"0","jsMessage"=>"Passwords do not match"));
			exit;
		}
		if( strlen($pw) > 0 && strlen($pw) < 6 ){
			return json_encode(array("jsTitle"=>"Password","jsStatus"=>"0","jsMessage"=>"Password should be at least 6 characters long"));
			exit;
		}

		$User = User::find($id);
		$User->username = Input::get('username');
		$User->email = Input::get('email');
		$User->name = Input::get('name');
		//$User->save();
		return json_encode(array("jsTitle"=>"Edit Profile","jsStatus"=>"1","jsMessage"=>"Profile edited successfully"));
		exit;
	}
}