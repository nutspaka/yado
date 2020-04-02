<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RegisterController extends Controller
{
    //indexは絶対ないといけない
    public function index(){
        return view('auth.mypage');
    }

    public function store(Request $request){
        //logger(var_dump($request->all()));

        $results = DB::table('watchlists')
        ->where([
            ['user_id','=',Auth::user()->id],
            ['deleted_at', '=',null],
            ['expired', '=',null]
        ])
        ->orderBy('created_at','desc')
        ->get();

        //登録リストは５件まで。
        if(count($results)<5){
         //バインディング
         $sql = 'INSERT INTO watchlists (user_id,h_name,h_id,conditions,created_at) '
         .'VALUES (?,?,?,?,?)';

         DB::insert($sql ,[
             Auth::user()->id,
             implode("<br>",$request->input('h_name')),
             implode(",",$request->input('h_id')),
             json_encode($request->except(['h_id','pref','_token','h_name','h_url','h_img'])),
             new Carbon()
             ]);
         }else{
             $request->session()->flash('regist_error', '登録数エラー');
         }
         
         //再送信を防ぐためにトークンを再発行
        $request->session()->regenerateToken();

         return self::showMyPage();
    }

   /**
     * Show the application's my page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMyPage(){
        //クエリビルダ使用
        logger('test');
        $results = DB::table('watchlists')
        ->where('user_id','=',Auth::user()->id)
        ->orderBy('created_at','desc')
        ->get();
        return view('auth.mypage',['watchlist' => $results]);
    }

    //削除ボタンによる削除のため物理削除
    public function destroy($watch_id){
        logger("削除実験");
        DB::table('watchlists')
        ->where([
            ['user_id', '=', Auth::user()->id],
            ['id', '=', $watch_id]
        ])
        ->delete();
        return redirect()->route('mypage');
    }

}