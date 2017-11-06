<?php

namespace App\Console\Commands;

use App\Contest;
use App\ContestPhotos;
use App\Mail\SendingMails;
use App\Vote;
use Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Mail;

class SendExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'do:sendExcel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get list of users & send to owner';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo 'Generate E-mail';
        $mime = 'application/vnd.ms-excel'; 
        $display = 'participants.xlsx';
        $contestPhotos = Vote::select('users.firstname', 'users.lastname', 'users.email', 'contest_photos.title', 'contest_photos.likes', 'contest_photos.superlikes')
            ->join('users','users.user_id', '=', 'votes.user_id')
            ->join('contest_photos', 'contest_photos.contest_photos_id', '=', 'votes.contest_photos_id')
            ->whereDate('votes.updated_at', DB::raw('CURDATE() - 1'))
            ->get();
        $mail = Contest::join('users', 'users.user_id', '=', 'contests.user_id')->where('contests.is_active', 1)->get()->first();

        $file = Excel::create('participants', function($excel)  use($contestPhotos){
          $excel->sheet('participants', function($sheet) use($contestPhotos) {
            $sheet->loadView('participants.excel')->with('contestPhotos', $contestPhotos);
          });
        });
        Mail::send('emails.send', ['mail' => $mail], function($message) use($file, $mail){
            $message->to($mail['email']);
            $message->attach($file->store("xls",false,true)['full']);
        });
    }
}
