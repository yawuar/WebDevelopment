<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contest;

class ContestController extends Controller
{
	public function index() {
		$active_number = 1;
		$contest = Contest::where('is_active', $active_number)->get()->first(); 
		return view('index')->with('contest', $contest);
	}
}
