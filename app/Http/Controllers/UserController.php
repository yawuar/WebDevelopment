<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Excel;

class UserController extends Controller
{
    public function index() {
    	$users = User::all();
    	return view('admin.user')->with('users', $users);
    }

    public function change($user_id) {
    	$isAdmin = 1;
    	$user = User::where('user_id', $user_id);
        if($user->get()->first()['is_admin'] == 1) {
            $isAdmin = 0;
        }
    	$user->update([
    		'is_admin' =>  $isAdmin
    	]);
    	return redirect()->back();
    }

    public function disqualify($user_id) {
        $disqualified = 1;
        $user = User::where('user_id', $user_id);
        if($user->get()->first()['disqualified'] == 1) {
            $disqualified = 0;
        }

        $user->update([
            'disqualified' => $disqualified
        ]);
        return redirect()->back();
    }

    public function destroy($user_id) {
        $user = User::where('user_id', $user_id);
        $user->delete();

        return redirect()->route('participants');
    }

    public function download() {
        $users = User::get();
        $file = Excel::create('participants', function($excel)  use($users){
          $excel->sheet('participants', function($sheet) use($users) {
            $sheet->loadView('participants.participants')->with('users', $users);
          });
        })->export('xlsx');
    }
}