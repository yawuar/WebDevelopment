<?php

namespace App\Http\Controllers;

use App\Contest;
use App\User;
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
		return view('admin.contests', ['contests' => $contests]); 
	}

	public function showForm(Request $request) {
		$responsibles = User::where('is_admin', 1)->get();
		return view('contest.add', [
			'responsibles' => $responsibles
		]);
	}

	public function getContestById($contest_id) {
		$contest = Contest::where('contest_id', $contest_id)->get()->first();
		$responsibles = User::where('is_admin', 1)->get();
		return view('contest.edit', [
			'contest' => $contest,
			'responsibles' => $responsibles
		]);
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
			'is_active' => 0,
			'user_id' => $request['responsible']
		]);
        }
		return redirect()->route('contests.index');
	}

	public function update(Request $request, $contest_id) {
		if ($request->hasFile('photo_path')) {
			$contest = Contest::where('contest_id', $contest_id);
            $request->file('photo_path')->store('/images/background');

            
            $file_name = '/images/background/' . $request->file('photo_path')->hashName();

            $contest->update([
				'title' => $request['title'],
				'content' => $request['content'],
				'photo_path' => $file_name,
				'starting_date' => $request['starting_date'],
				'ending_date' => $request['ending_date'],
				'user_id' => $request['responsible']
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
