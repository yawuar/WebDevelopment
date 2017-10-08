<?php

namespace App\Http\Controllers;

use App\Contest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContestController extends Controller
{
	public function index() {

		// $end = Carbon::now()->addSeconds(10);
		// var_dump('ending hour = ' . $end);

		// $now = Carbon::now();

		// var_dump('beginning hour = ' . $now);

		// $length = $end->diffInSeconds($now);
		// var_dump($length);


		$active_number = 1;
		$contest = Contest::where('is_active', $active_number)->get()->first(); 

		$time = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now('Europe/Brussels'))->format('Y-m-d H:i:s');

		// this also works
		//var_dump(Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now('Europe/Brussels'))->between(Carbon::createFromFormat('Y-m-d H:i:s', $contest['starting_date']), Carbon::createFromFormat('Y-m-d H:i:s', $contest['ending_date'])));

		if($time >= $contest['starting_date'] && $time <= $contest['ending_date']) {
			// var_dump('contest is still busy');
			// contest is still busy
			// check if contest = 1
		} else {
			// var_dump('contest is over');
			// contest is over start new one
			// set contest active = 0
		}

		return view('index')->with('contest', $contest);
	}
}
