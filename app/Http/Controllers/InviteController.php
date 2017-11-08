<?php

namespace App\Http\Controllers;

use App\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;

class InviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if(Auth::check()) {

            $this->validate($request, [
                'email' => 'required|string|max:255',
            ]);

            Mail::send('emails.invite', ['email' => $request['email'], 'name' => Auth::user()->firstname], function($message) use($request){
                $message->to($request['email']);
            });

            Invite::create([
                'email' => $request['email'],
                'user_id' => Auth::user()->user_id,
                'isValidated' => 0,
                'hasExtraPoints' => 0,
            ]);
        }

        return redirect(route('contest.index'));
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
