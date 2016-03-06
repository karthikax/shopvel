<?php

namespace Shopvel\Http\Controllers;

use Shopvel\Product;
use Shopvel\User;
use Auth, Input, Response, DB;
use Illuminate\Http\Request;
use Shopvel\Http\Requests;
use Shopvel\Http\Controllers\Controller;

class ProductController extends Controller
{

	protected $data = array();

	public function __construct(){
		$this->middleware('auth');
		$this->data['user'] = Auth::user();
	}

	public function listAll($page = 1){
		$role = $this->data['user']->role;
		$toReturn = array();
		$toReturn['posts'] = DB::table('posts')->leftJoin('users', 'posts.author', '=', 'users.id')->select('posts.*', 'users.username')
							->where('posts.status','active')->orderBy('posts.created_at','ASC')->take('20')->skip(20* ($page - 1) )->get();
		$toReturn['totalItems'] = Product::where('status','active')->count();
		$toReturn['userRole'] = $role;

		return $toReturn;
	}

	public function listApproved($page = 1){
		$role = $this->data['user']->role;
		if( !( $role == 'admin' || $role == 'seller' ) ) exit;
		$toReturn = array();
		if( $role == 'admin'){
			$posts = Product::where('status','active')->orderBy('created_at','ASC')->take('20')->skip(20* ($page - 1) )->get(['id','name','title','type','status']);
			$count = Product::where('status','active')->count();
		}else{
			$posts = Product::where('status','active')->where('author',$this->data['user']->id)->orderBy('created_at','ASC')->take('20')->skip(20* ($page - 1) )->get(['id','name','title','type','status']);
			$count = Product::where('status','active')->where('author',$this->data['user']->id)->count();
		}
		$toReturn['posts'] = $posts;
		$toReturn['totalItems'] = $count;
		$toReturn['userRole'] = $role;

		return $toReturn;
	}

	public function listPending($page = 1){
		$role = $this->data['user']->role;
		if( !( $role == 'admin' || $role == 'seller' ) ) exit;
		$toReturn = array();
		if( $role == 'admin'){
			$posts = Product::where('status','pending')->orderBy('created_at','ASC')->take('20')->skip(20* ($page - 1) )->get(['id','name','title','type','status']);
			$count = Product::where('status','pending')->count();
		}else{
			$posts = Product::where('status','pending')->where('author',$this->data['user']->id)->orderBy('created_at','ASC')->take('20')->skip(20* ($page - 1) )->get(['id','name','title','type','status']);
			$count = Product::where('status','pending')->where('author',$this->data['user']->id)->count();
		}
		$toReturn['posts'] = $posts;
		$toReturn['totalItems'] = $count;
		$toReturn['userRole'] = $role;

		return $toReturn;
	}

	public function view($id){
		$role = $this->data['user']->role;
		$post = DB::table('posts')->leftJoin('users', 'posts.author', '=', 'users.id')->where('posts.id', $id)->select('posts.*', 'users.username')->first();
		if( $post->status !== 'active' ){
			if( !( $role == 'admin' || $role == 'seller' ) ) exit;
			if( $role == 'seller' ){
				if( !( $post->author == $this->data['user']->id ) ) exit;
			}
		}
		return Response::json( $post );
	}

	public function approveOne($id){
		if( $this->data['user']->role != 'admin' ) exit;
		$user = Product::find($id);
		$user->status = 'active';
		$user->save();
		return $this->listPending();
	}

	public function denyOne($id){
		if( $this->data['user']->role != 'admin' ) exit;
		$user = Product::find($id);
		$user->status = 'pending';
		$user->save();
		return $this->listApproved();
	}

	public function create(){
		$role = $this->data['user']->role;
		if( !( $role == 'admin' || $role == 'seller' ) ) exit;
		if(Product::where('name',trim(Input::get('name')))->count() > 0){
			return json_encode(array("jsTitle"=>"Add Post","jsStatus"=>"0","jsMessage"=>"Name already used" ));
			exit;
		}
		if( $role == 'admin' ){
			$author = ( null !== Input::get('author') ) ? Input::get('author') : $this->data['user']->id;
			$status = 'active';
			$message = 'Post created successfully';
		}else{
			$author = $this->data['user']->id;
			$status = 'pending';
			$message = 'Post created. Will be published once admin approves.';
		}

		$Post = new Product();
		$Post->author = (int)$author;
		$Post->name = Input::get('name');
		$Post->title = Input::get('title');
		$Post->content = Input::get('content');
		$Post->status = $status;
		$Post->type = "post";
		$Post->save();
		return json_encode(array("jsTitle"=>"Add Post","jsMessage"=>$message,"list"=>$this->listApproved() ));
		exit;
	}

	public function edit($id){
		$role = $this->data['user']->role;
		if( !( $role == 'admin' || $role == 'seller' ) ) exit;
		if(Product::where('name',trim(Input::get('name')))->where('id','<>',$id)->count() > 0){
			return json_encode(array("jsTitle"=>"Edit Post","jsStatus"=>"0","jsMessage"=>"Name already used" ));
			exit;
		}

		$Post = Product::find($id);
		if( $role == 'admin' ){
			$author = Input::get('author');
			$Post->author = (int)$author;
			$Post->status = Input::get('status');
		}
		$Post->name = Input::get('name');
		$Post->title = Input::get('title');
		$Post->content = Input::get('content');
		$Post->save();
		return json_encode(array("jsTitle"=>"Edit Post","jsMessage"=>"Post edited successfully","list"=>$this->listApproved() ));
		exit;
	}

	public function delete($id){
		if( $this->data['user']->role != 'admin' ) exit;
		Product::find($id)->delete();	
		return 1;
	}
}