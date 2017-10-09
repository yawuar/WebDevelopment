<?php

namespace App\Http\Controllers;

use App\Contest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContestController extends Controller
{
	public function index() {
		// set active number var
		$active_number = 1;
		// get contest that is active
		$contest = Contest::where('is_active', $active_number)->get()->first(); 
		// return view with data of contest
		return view('index')->with('contest', $contest);
	}
}
