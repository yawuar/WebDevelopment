<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\SendingMails;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function send(){

    	$mail = Mail::to('yawuarsernadelgado@gmail.com')->send('emails.send');
	}
}
