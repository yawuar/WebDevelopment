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

	public function getContests() {
		$contests = Contest::get();
		return view('admin.contests')->with('contests', $contests); 
	}

	public function store(Request $request) {
		if ($request->hasFile('photo_path')) {
            $request->file('photo_path')->store('/images/background');
            
            $file_name = '/images/background/' . $request->file('photo_path')->hashName();

            Contest::create([
			'title' => $request['title'],
			'content' => $request['content'],
			'starting_date' => $request['starting_date'],
			'ending_date' => $request['ending_date'],
			'photo_path' => $file_name,
			'is_active' => 0
		]);
        }
		return redirect()->route('contests.index');
	}

	public function destroy($contest_id) {
		$contest = Contest::where('contest_id', $contest_id);
		$isActive = $contest->where('is_active', 1)->get()->first()->is_active;
		if($isActive != 1) {
			$contest->delete();
		} else {
			// show popup message
			// that gives explanation why admin can't delete the following user
		}

    	return redirect()->route('contests.index');
	}
}
