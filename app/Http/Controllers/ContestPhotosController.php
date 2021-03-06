<?php

namespace App\Http\Controllers;

use App\Contest;
use App\ContestPhotos;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContestPhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contest_id = Contest::where('is_active', 1)->get()->first();
        $contestPhotos = ContestPhotos::select('contest_photos.photo_path', 'contest_photos.title', 'contest_photos.content', 'contest_photos.user_id', 'contest_photos.likes', 'contest_photos.superlikes')->join('users', 'users.user_id', '=', 'contest_photos.user_id')->where('contest_photos.contest_id', $contest_id['contest_id'])->orderBy('contest_photos.likes', 'desc')->orderBy('contest_photos.superlikes', 'desc')->where('users.disqualified', 0)->get();
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

        $this->validate($request, [
            'photo_path' => 'required|image',
            'title' => 'required|string|max:25',
            'content' => 'required|string|max:100',
        ]);
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
}
