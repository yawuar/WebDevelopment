<?php

namespace App\Console\Commands;

use App\Contest;
use Carbon\Carbon;
use Illuminate\Console\Command;

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

        $time = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now('Europe/Brussels'))->format('Y-m-d H:i:s');

        if($time >= $contest['starting_date'] && $time <= $contest['ending_date']) {
            var_dump('contest is still busy');
            // contest is still busy
            // check if contest = 1
        } else {
            var_dump('contest is over');
            Contest::where('is_active', $active_number)->update([
                'is_active' => 0
            ]);
            // contest is over start new one
            // set contest active = 0
        }
    }
}
