<?php

namespace Shopvel\Http\Controllers;

use Illuminate\Http\Request;
use Shopvel\Http\Requests;
use Shopvel\Http\Controllers\Controller;
use View;

class DashboardController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		return View::make('dashboard');
	}
}