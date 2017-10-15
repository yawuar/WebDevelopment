<?php

namespace App\Http\Controllers;

use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VotesController extends Controller
{
    public function storeLike(Request $request, $contest_photos_id) {
        $vote = Vote::where('contest_photos_id', $contest_photos_id)->where('user_id', Auth::user()->user_id)->get()->first();
        if(!$vote) {
            Vote::create([
                'like' => 1,
                'super_like' => 0,
                'contest_photos_id' => $contest_photos_id,
                'user_id' => Auth::user()->user_id
            ]);
            return redirect()->back();
        } else {
            // return error
            return redirect()->back();
        }
    }

    public function storeSuperLike(Request $request, $contest_photos_id) {
        $vote = Vote::where('user_id', Auth::user()->user_id)->where('super_like', 1)->get();
        // set time. Every user can use 1 super like every 24 hours
        if(count($vote) < 1) {
            Vote::create([
                'like' => 0,
                'super_like' => 1,
                'contest_photos_id' => $contest_photos_id,
                'user_id' => Auth::user()->user_id
            ]);
            return redirect()->back();
        } else {
            // return error
            return redirect()->back();
        }
    }
}
