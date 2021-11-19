<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Visitor;

class WelcomeController extends Controller
{
	public function index(){
		$latestVisitors = Visitor::orderBy('created_at', 'desc')
		->take(5)
		->get();
		
		return view('welcome', [
			'latestVisitors' => $latestVisitors
		]);
	}
}
