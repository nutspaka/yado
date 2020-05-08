<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
use Carbon\Carbon;

class CheckExpiredCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '期限切れている対象リストにフラグをつける';

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
        //期限切れのチェック
         $this->info('Check Expired !!');
         //logger("Cron action: Check Expired List");
 
         $results = DB::table('watchlists')
        //  ->join('users', 'watchlists.user_id', '=', 'users.id')
         ->select('h_name','id','conditions','email')
         ->where([
             ['deleted_at', '=',null],
             ['expired', '=',null],])
         ->get();
 
         $today = new Carbon();

         foreach ($results as $i) {  
            $json = json_decode($i->conditions, true);
            $stay_date = new Carbon($json["stay_date"]);
            if($today > $stay_date){
                //期限超過している場合は論理削除・通知メール
                DB::table('watchlists')
                ->where([
                    ['id', '=', $i->id]
                ])
                ->update(['expired'=> 1]);

                Mail::to($i->email)
                ->send(new OrderShipped($xml=2,json_decode($i->conditions),$i->h_name));
            }
         } 
     }
}
