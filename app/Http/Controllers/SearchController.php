<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Routing\Loader\XmlFileLoader;
use Illuminate\Support\Facades\Mail;
use App\Mail\SystemAlertSendmail;

class SearchController extends Controller
{
    /* define properties */
    //出力項目の範囲 1:口コミまで  
    CONST RANGE_DISPLAY_REVIEW = 1;
    //出力項目の範囲 2:口コミ・プラン名まで
    CONST RANGE_DISPLAY_PLAN = 2;
    //表示開始
    CONST START_FROM = 1;
    //表示取得単位
    CONST HOTEL_DISPLAY = 100;
    //表示取得単位
    CONST MAX_PLAN_DISPLAY = 100;
    //表示順（4:じゃらん口コミ順）
    CONST REVIEW_ORDER = 4;
    //宿泊施設の画像のサイズ
    CONST PICT_SIZE = 5;
    //宿泊施設の画像数
    CONST PICTS = 5;

    public function index(){
        return view('index');
    }

    public function show(Request $request){

        //現在の入力をセッションへ、アプリに要求される次のユーザーリクエストの処理中だけ利用
        $request->flash();
        //URLパラメータ取得
        // if(isset($_GET)) { $param = $_GET; }
        // logger($param);
        // logger($request->all());
        //Guzzle（PHP HTTP client）
        $client = new \GuzzleHttp\Client();

        //日付加工
        // $request->stay_date = str_replace('-', '', $request->stay_date);
        $year = substr($request->stay_date,0,4);
        $month = substr($request->stay_date,4,2);
        $date = substr($request->stay_date,6,2);

        //エリア内の「在庫あり」ホテル一覧抽出（staydateあり）
        try {
            $response = $client->request(
                'GET',
                config('app.jalan_api_hotel_url'),
                ['http_errors' => false,
                 'query' =>
                  array_merge(
                    $request->all()
                    ,array(
                        'key' => config('app.jalan_api_key')
                        ,'order'=>self::REVIEW_ORDER
                        ,'xml_ptn' =>self::RANGE_DISPLAY_PLAN
                        ,'count' => self::HOTEL_DISPLAY
                    )
                  )
                ]
            );
            $responseBody = $response->getBody()->getContents();
            $hotel_stock_list = @simplexml_load_string($responseBody);
            $hotel_stock_list = json_decode(json_encode($hotel_stock_list), true);
            logger($hotel_stock_list);
            //結果が１件のときのみ、Hotelを配列にする処理
            if(!empty($hotel_stock_list["NumberOfResults"])){
                if ($hotel_stock_list["NumberOfResults"]<2) {
                    $hotel_stock_list = self::changeAry($hotel_stock_list);
                }
            }
            //200以外の場合例外処理
            if($response->getStatusCode() != 200){
                Mail::to('shogouchidapk@gmail.com')
                ->send(new SystemAlertSendmail($response->getStatusCode(),$response->getBody(),$request));    
                throw new \Exception("システムエラー", $response->getStatusCode());
            } 
        } catch (\Exception $e) {
            //throw $th;
            logger('在庫検索HTTPステータスコード：エラー'.$e->getCode());
            $hotel_list["NumberOfResults"] = 0;
            return view('result')->with([
                'hotel_list' => $hotel_list,
                'err_code' => $e->getCode()
                ]);
        }
        
        //stay_date削除
        // unset($request->stay_date);
        //エリア内の全ホテル一覧抽出（staydateなし）
        try {
            $response = $client->request(
                'GET',
                config('app.jalan_api_hotel_url'),
                ['http_errors' => false,
                 'query' =>
                  array_merge(
                    $request->except('stay_date')
                    ,array(
                        'key' => config('app.jalan_api_key')
                        ,'order'=>self::REVIEW_ORDER
                        ,'xml_ptn' =>self::RANGE_DISPLAY_REVIEW
                        ,'count' => self::HOTEL_DISPLAY
                        ,'pict_size' => self::PICT_SIZE
                        // ,'picts' => self::PICTS
                    )
                  )
                ]
            );
             // レスポンスボディを取得,XML形式のためjson、連想配列加工
        $responseBody = $response->getBody()->getContents();
        $hotel_list = @simplexml_load_string($responseBody);
        $hotel_list = json_decode(json_encode($hotel_list), true);
        logger($hotel_list);
        //$search_json = mb_convert_encoding($search_json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        //文字化け対策

        //結果が１件のときのみ、Hotelを配列にする処理
        if(!empty($hotel_list["NumberOfResults"])){
            if ($hotel_list["NumberOfResults"]<2) {
                $hotel_list = self::changeAry($hotel_list);
            }
        } 

        if(!empty($hotel_list["Hotel"])){
            //URL書き替え(APIキー剥き出しのため)
            for($j = 0; $j < count($hotel_list["Hotel"]); ++$j){  
                $url = config('app.jalan_url')
                  ."yad".$hotel_list["Hotel"][$j]["HotelID"]
                  ."/plan/?screenId=USW3001&"//プランページ
                  ."stayCount=".$request->stay_count//宿泊日数
                  ."&stayYear=".$year//年
                  ."&stayMonth=".$month//月
                  ."&stayDay=".$date//日
                  ."&adultNum=".$request->adult_num//大人
                  ."&roomCount=1"//部屋
                  ."&minPrice=".$request->min_rate//最低金額
                  ."&maxPrice=".$request->max_rate//最高金額
                ;
                if ($request->sc_num > 0) {
                    $url.="&child1Num=".$request->sc_num;//小学生(1-5まで、0だとエラー)
                }
                if ($request->has('2_meals')) {
                    $url.="&2_meals=1";//夕朝食付き
                }
                if ($request->has('onsen')) {
                    $url.="&onsen=1";
                }
                if ($request->has('o_bath')){
                    $url.="&o_bath=1";
                }
                if ($request->has('jpn_room')) {
                    $url.="&jpn_room=1";
                }

                $hotel_list["Hotel"][$j]["HotelDetailURL"] = $url;

                if(!empty($hotel_stock_list["Hotel"])){
                //在庫ありの宿があればフラグ立てる 
                  for($i = 0; $i < count($hotel_stock_list["Hotel"]); ++$i){         
                    if ($hotel_list["Hotel"][$j]["HotelID"] == $hotel_stock_list["Hotel"][$i]["HotelID"]) {
                    $hotel_list["Hotel"][$j]["PlanFlag"] = 1;
                    break;
                    }
                  }
                }
            }
        }
            //200以外の場合例外処理
            if($response->getStatusCode() != 200){
                Mail::to('shogouchidapk@gmail.com')
                ->send(new SystemAlertSendmail($response->getStatusCode(),$response->getBody(),$request));  
                throw new \Exception("システムエラー", $response->getStatusCode());
            } 
    } catch (\Exception $e) {
            //throw $th;
            logger('一覧検索HTTPステータスコード：エラー'.$e->getCode());
            $hotel_list["NumberOfResults"] = 0;
            return view('result')->with([
                'hotel_list' => $hotel_list,
                'err_code' => $e->getCode()
                ]);
    }
    //  logger($hotel_list);
     //検索結果
     return view('result')->with('hotel_list',$hotel_list);
    } 

    //結果が１件のときのみ、後続処理のためHotelを配列にするメソッド
    public function changeAry(Array $ary){
        $ary += array("Hotel2" => []);
        array_push($ary["Hotel2"],$ary["Hotel"]);
        unset($ary["Hotel"]);
        $ary += array("Hotel" => []);
        array_push($ary["Hotel"],$ary["Hotel2"][0]);
        unset($ary["Hotel2"]);
        logger("１件のときのみ構造変化");
        return $ary;
    }

    //利用規約
    public function showTerms()
    {
        return view('terms');
    }

    //プライバシーポリシー
    public function showPolicy()
    {
        return view('policy');
    }
}
