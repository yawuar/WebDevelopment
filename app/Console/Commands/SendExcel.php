<?php

namespace App\Console\Commands;

use App\ContestPhotos;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Excel;

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
        $contestPhotos = ContestPhotos::select('users.firstname', 'users.lastname', 'users.email', 'contest_photos.title', 'contest_photos.likes', 'contest_photos.superlikes')
            ->whereDate('contest_photos.created_at', DB::raw('CURDATE()'))->join('users','users.user_id', '=', 'contest_photos.user_id')->get();
        Excel::create('participants', function($excel)  use($contestPhotos){
          $excel->sheet('participants', function($sheet) use($contestPhotos) {
            $sheet->loadView('participants.excel')->with('contestPhotos', $contestPhotos);
            //$sheet->fromArray($contestPhotos);
          });
        })->save('xlsx', storage_path('app/exports'));

        echo $contestPhotos;
    }
}
