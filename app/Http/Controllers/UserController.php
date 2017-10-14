<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index() {
    	$users = User::all();
    	return view('admin.user')->with('users', $users);
    }

    public function change($user_id) {
    	$isAdmin = 1;
    	$user = User::where('user_id', $user_id);
    	$user->update([
    		'is_admin' =>  $isAdmin
    	]);
    	return redirect()->back();
    }

    public function disqualify($user_id) {
        $disqualified = 1;
        $user = User::where('user_id', $user_id);
        $user->update([
            'disqualified' => $disqualified
        ]);
        return redirect()->back();
    }

    public function destroy($user_id) {
        $user = User::find($user_id);
        $user->delete();

        return redirect()->route('admin.index');
    }
}