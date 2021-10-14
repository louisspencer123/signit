<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Visitor;

class WelcomeController extends Controller
{
	public function index()
	{
		$visitors = Visitor::all();

		return view ('welcome', [
			'title' => 'Our visitors',
			'visitors' => $visitors
		]);
	}
}