<?php

namespace App\Http\Controllers;

use App\Contest;
use App\ContestPhotos;
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
        // var_dump(public_path() . '/images/contest/');
        // return '';
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
