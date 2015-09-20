<?php

namespace Shopvel\Http\Controllers;

use Illuminate\Http\Request;
use Shopvel\Http\Requests;
use Shopvel\Http\Controllers\Controller;

class MainController extends Controller
{
	public function index()
	{
		return response()->json(['name' => 'Test Name', 'data' => 'Test Data']);
	}
}