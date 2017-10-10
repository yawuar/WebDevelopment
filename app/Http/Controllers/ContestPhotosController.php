<?php

namespace App\Http\Controllers;

use App\Contest;
use App\ContestPhotos;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContestPhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contestPhotos = ContestPhotos::all();
        return view('contest.index')->with('contestPhotos', $contestPhotos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $contest_id = Contest::select('contest_id')->where('is_active', 1)->get()->first(); 
        if ($request->hasFile('photo_path')) {
            $request->file('photo_path')->store('/images/contest');
            
            // ensure every image has a different name
            $file_name = '/images/contest/' . $request->file('photo_path')->hashName();

            ContestPhotos::create([
                'photo_path' => $file_name,
                'title' => $request['title'],
                'content' => $request['content'],
                'user_id' => Auth::user()->user_id,
                'contest_id' => $contest_id['contest_id']
            ]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function calculateLikes() {
        // needs to be placed in a cronjob
        $votes = Vote::select('contest_photos_id')->groupBy('contest_photos_id')->get();
        foreach($votes as $vote) {
            $voteLikes = Vote::where('contest_photos_id', $vote['contest_photos_id'])->where('like', 1)->count();
            $voteSuperLikes = Vote::where('contest_photos_id', $vote['contest_photos_id'])->where('super_like', 1)->count();
            if($voteLikes != 0) {
                contestPhotos::where('contest_photos_id', $vote['contest_photos_id'])->update([
                    'likes' => $voteLikes
                ]);
            }

            if($voteSuperLikes != 0) {
                contestPhotos::where('contest_photos_id', $vote['contest_photos_id'])->update([
                    'superlikes' => $voteSuperLikes
                ]);
            }
        }
    } 
}
