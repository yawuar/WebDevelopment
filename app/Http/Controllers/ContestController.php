<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Winner;
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
		$winners = Winner::select('users.firstname', 'users.lastname', 'contests.title', 'users.photo_path')->join('users', 'users.user_id', '=', 'winners.user_id')
			->join('contests', 'contests.contest_id', '=', 'users.contest_id')
			->limit(5)->get();
		return view('index', ['contest' => $contest, 'winners' => $winners]);
	}

	public function getContests() {
		$contests = Contest::get();
		return view('admin.contests')->with('contests', $contests); 
	}

	// protected function validator(array $data)
 //    {
 //        return Validator::make($data, [
 //            'title' => 'required|string|max:255',
 //            'content' => 'required|string|max:255',
 //            'starting_date' => 'required|string|max:255',
 //            'ending_date' => 'required|integer|max:255',
 //            'photo_path' => 'required|string|max:255',
 //            'is_active' => 'required|string|max:255',
 //        ]);
 //    }

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
		$active = $contest->get()->first()['is_active'];
		$isActive = $contest->where('is_active', $active)->get()->first()->is_active;
		if($isActive == 0) {
			$contest->delete();
		}
		
		if($isActive == 1) {
			echo 'contest cannot be deleted';
		}

    	return redirect()->route('contests.index');
	}
}
