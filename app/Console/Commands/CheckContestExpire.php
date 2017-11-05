<?php

namespace App\Console\Commands;

use App\Contest;
use App\ContestPhotos;
use App\Vote;
use App\Winner;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Mail;

class CheckContestExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'do:checkContestExpire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Contest Expire';

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
        // set active number var
        $active_number = 1;
        // get contest that is active
        $contest = Contest::where('is_active', $active_number)->get()->first(); 
        if(count($contest) > 0) {
            $time = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now('Europe/Brussels'))->format('Y-m-d H:i:s');
            if($time >= $contest['starting_date'] && $time <= $contest['ending_date']) {
                var_dump('contest is still busy');
                // contest is still busy
                // check if contest = 1
            } else {
                $this->getWinner();
                Contest::where('is_active', $active_number)->update([
                    'is_active' => 0
                ]);
                // contest is over start new one
                // set contest active = 0
            }
        } else {
            // echo 'There is no contest';
        }
    }

    protected function getWinner() {
        // get Contest Photos likes & superlikes
        $likes = ContestPhotos::orderBy('likes', 'desc')->get();
        // set default value of largest to 0
        $largest = 0;
        // set object with null as default value
        $obj = null;
        // check if there are any likes
        if(count($likes) > 0) {
            // loop through likes
            foreach($likes as $like) {
                // calculate the likes & superlikes
                $total = $like['likes'] + $like['superlikes'];
                // check if total is greater then largest number
                if($total > $largest) {
                    // put object with largest value in the obj variable
                    $obj = $like;
                    $largest = $total;
                }
            }

            // check if object exists
            if($obj) {
                // send e-mail
                Mail::raw('Iemand heeft gewonnen', function($message)
                {
                    $message->to('yawuarsernadelgado@gmail.com');
                });
                // insert winner into database
                Winner::create([
                    'user_id' => $obj['user_id'],
                    'contest_photos_id' => $obj['contest_photos_id']
                ]);
            }
        }
    }
}

