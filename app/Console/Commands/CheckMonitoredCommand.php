<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SystemAlertSendmail;
use App\Mail\OrderShipped;
use Carbon\Carbon;

class CheckMonitoredCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-monitored';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '監視対象をチェック';

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
        //
        $this->info('Check Monitored List !!');
        logger("Cron action: Check Monitored List");

        $results = DB::table('watchlists')
        ->join('users', 'watchlists.user_id', '=', 'users.id')
        ->select('watchlists.h_name','watchlists.id','watchlists.h_id','users.email','watchlists.conditions')
        ->where([
            ['deleted_at', '=',null],
            ['expired', '=',null],])
        ->get();

        //１つずつ空室検索実行 Guzzle（PHP HTTP client）
        $client = new \GuzzleHttp\Client();

        foreach ($results  as $i) {      
            $response = $client->request(
                'GET',
                config('app.jalan_api_stock_url'),
                ['http_errors' => false,
                 'query' => array_merge(
                     json_decode($i->conditions, true),
                     array('key' => config('app.jalan_api_key'),'h_id' => $i->h_id)
                     )
                ] 
            );
            //システムエラー発生通知
            if($response->getStatusCode() != 200){
                Mail::to('shogouchidapk@gmail.com')
                ->send(new SystemAlertSendmail($response->getStatusCode(),$response->getBody(),$results));
                continue;
            }  
            $responseBody = $response->getBody()->getContents();
            $xml = @simplexml_load_string($responseBody);

            $conditions = json_decode($i->conditions);
            $h_name = $i->h_name;

            //空室プランがあったらユーザに通知
            if($xml->NumberOfResults > 0){
                
                Mail::to($i->email)
                // ->bcc('shogouchidapk@gmail.com')
                ->send(new OrderShipped($xml,$conditions,$h_name));
                // $this->info('Email sent.');

                //通知後は論理削除
                DB::table('watchlists')
                ->where([
                    ['id', '=', $i->id]
                ])
                ->update(['deleted_at'=> new Carbon()]);
            }
        } 
    }
}
