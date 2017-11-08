<?php

namespace App\Http\Controllers;

use App\ContestPhotos;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VotesController extends Controller
{
    public function storeLike(Request $request, $contest_photos_id) {
        // get vote only if user doesn't have like a specific photo
        if($request) {
            $vote = Vote::where('contest_photos_id', $contest_photos_id)->where('user_id', Auth::user()->user_id)->get()->first();
            $contestPhoto = ContestPhotos::where('contest_photos_id', $contest_photos_id);

            // check if user has already liked it
            if(!$vote) {
                // insert into database
                $createdVote = Vote::create([
                    'like' => 1,
                    'super_like' => 0,
                    'isLiked' => 1,
                    'contest_photos_id' => $contest_photos_id,
                    'user_id' => Auth::user()->user_id
                ]);
                // if vote is succesfully inserted update & increment column likes from contest photos
                if($createdVote) ContestPhotos::where('contest_photos_id', $contest_photos_id)->increment('likes');
                return redirect()->back();
            }

            if($vote){
                $isLiked = 1;
                $voted = Vote::where('contest_photos_id', $contest_photos_id)->where('user_id', Auth::user()->user_id)->where('isLiked', 0)->where('like', 1)->where('super_like', 0);
                $contestPhoto->increment('likes');
                $voted->update(['isLiked' => $isLiked]);

                // tell user that contest photo is already liked
                return redirect()->back();
            }
        }

        return redirect()->back();
    }

    public function unLike($contest_photos_id) {
        // get vote only if user doesn't have like a specific photo
        $vote = Vote::where('contest_photos_id', $contest_photos_id)
            ->where('user_id', Auth::user()->user_id)
            ->where('like', 1);
        $contestPhoto = ContestPhotos::where('contest_photos_id', $contest_photos_id);

        $contestPhoto->decrement('likes');
        $vote->update(['isLiked' => 0]);
        // $vote->delete();

        return redirect()->back();
    }

    public function storeSuperLike(Request $request, $contest_photos_id) {
        // get vote and check if it already has given a superlike
        $vote = Vote::where('user_id', Auth::user()->user_id)->where('super_like', 1)->get();
        // TODO: set time. Every user can use 1 super like every 24 hours

        // check if user has given just 1 superlike
        if(count($vote) < 1) {
            // insert into database
            $createdVote = Vote::create([
                'like' => 0,
                'super_like' => 1,
                'isLiked' => 0,
                'contest_photos_id' => $contest_photos_id,
                'user_id' => Auth::user()->user_id
            ]);
            // if vote is succesfully inserted update & increment column superlikes from contest photos
            if($createdVote) ContestPhotos::where('contest_photos_id', $contest_photos_id)->increment('superlikes', 5);
            return redirect()->back();
        } else {
            // return error
            return redirect()->back();
        }
    }
}
