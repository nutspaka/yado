<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>{{Config::get('app.name')}}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Noto+Sans+JP:400,700" rel="stylesheet">
        <script src="https://kit.fontawesome.com/1343700754.js" crossorigin="anonymous"></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/appForSp.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">
        <!-- Js -->
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
        <script src="{{ asset('js/pref.js') }}"></script>
        <script src="{{ asset('js/disp.js') }}" defer></script>
        <script src="{{ asset('js/search.js') }}" defer></script>
    </head>
    <body>
    <form id="conditions" method="post" action="/store/watch">
        <div id="menu">
            <div id="logo">
              <img src="/images/logo.png" width="240" alt="logo"> 
            </div>
            <span id="rebtn" class="rebtn"><i class="fas fa-chevron-circle-down"></i> 再検索</span> 
            <div id="menu_input">
                <p>\泊まりたい地域を検索しよう/</p> 
                <select name="pref">
                　<option value=''>都道府県を選択</option>
                </select>
                <select name="l_area" >
                　<option value=''>エリアを選択</option>
                </select>
                <select name="s_area" >　
                　<option value=''>地域を選択</option>
                </select>
                <label>宿泊日<input type="text" id="datepicker" maxlength="10" value="{{date("Y/m/d", strtotime("1 day"))}}">&nbsp;&nbsp;<input type="number" min="1" max="10" name="stay_count" value={{ old('stay_count',1) }}>泊
                </label>
                <input name="stay_date" type="hidden" min={{date("Ymd")}} max={{date("Ymd", strtotime("3 month"))}} value="{{date("Ymd", strtotime("1 day"))}}">
                {{-- <label>チェックアウト
                    <input autocomplete="off" class="datepicker" name="stay_end_date"　type="text" min={{date("Ymd")}} max={{date("Ymd", strtotime("3 month"))}}  value={{ old('stay_date',date("m/d", strtotime("2 day")))}} >
                </label> --}}
                <label>大人&nbsp;&nbsp;<input type="number" name="adult_num" min=1 max=10 value={{ old('adult_num',2) }} >人</label>
                <div id="picky_btn" class='btn-slide-toggle'>
                    <span>＋</span>&nbsp;詳細&nbsp;
                </div>          
                <div id="picky_detail" style="display: none">
                    <label>小学生<input type="number" name="sc_num" min=0 max=5  value={{ old('sc_num',null) }}>人</label>
                    <label>予算（1泊1室）<br>
                        <input type="number" name="min_rate" min="0" placeholder="下限なし" autocomplete="off">〜<input type="number" name="max_rate" min="0" placeholder="上限なし" autocomplete="off">円
                    </label>
                    <label>
                        <input type="checkbox" name="onsen" value="1">&nbsp;温泉
                        <input type="checkbox" name="o_bath" value="1">&nbsp;露天風呂
                        <input type="checkbox" name="jpn_room" value="1">&nbsp;和室
                    </label>
                </div>

                <a href="javascript:void(0)" id="search" class="btn">検索する</a>
                <p>
                  @auth
                    <div><a class="caution" href="{{ route('mypage')  }}">登録リスト ></a>&nbsp;<a class="caution" href="{{ route('logout')  }}">ログアウト ></a></div>
                    <small>{{Auth::user()->email}}でログイン中</small><br>
                    @else
                    <small>
                    ※監視登録には<a class="caution" href="{{ route('login') }}">ログイン ></a>
                    <a class="caution" href="{{ route('register') }}">通知先登録 ></a>
                    が必要です。
                     </small> 
                  @endauth
                  <br>
                  <div><a lass="caution" href="{{ route('contact.index') }}"><i class="far fa-envelope"></i>お問い合わせ</a></div>
                </p>
            </div>     
        </div>
        <div class="result_script">
            <div id="my-spinner" class="box loaded">
            　<div class="spinner type1">
                <span>検索中..</span>
            　</div>
            </div>
            <div id="result"><small>検索結果：</small><span id="result_num"></span><small> 軒</small>
            </div>
            <div id="result_list">
                    {{-- 検索結果 --}}
                    <div class="balloon-right">
                        <p>どこも満室だ..&nbsp;でも泊まりたい。</p>
                        <img class="cat1" src="./images/cat1.png" alt="cat1">
                    </div>
                    <br>
                    <div class="balloon-left">
                        <img class="cat2" src="./images/cat2.png" alt="cat2">
                        <p>え！ヤドキャン<br>登録してにゃいの？</p>
                    </div>
                    <br>
            </div>
                <hr>
                <div class="service_script">
                    <h2 class="under">ヤドキャンは、無料の空室お知らせサービスです。</h2>
                    <p>満室の宿が空くのを監視し、空き次第お知らせします。<br>
                    <small>※本サービスは「<a href="https://www.jalan.net/jw/jwp0000/jww0001.do">じゃらんWebサービス</a>」を使用しており、じゃらん掲載中の宿に対応しています。</small></p>
                        <a href="https://www.jalan.net/jw/jwp0000/jww0001.do" target="_blank">
                        <img src="https://www.jalan.net/jalan/doc/jws/images/jws_88_50_gray.gif" alt="じゃらん Web サービス" title="じゃらん Web サービス" border="0">
                        </a>
                    <h3>|ご利用方法</h3>
                    <ol>
                        <li><strong>メールアドレス登録</strong><br>
                            空室通知を受け取るメールアドレスを<a class="caution" href="{{ route('register') }}">登録</a>してください<br>
                            <small>※登録済みの方は<a class="caution" href="{{ route('login') }}">ログイン</a>してください</small></li><br>
                        <li><strong>宿を検索</strong><br>
                            地域・宿泊日等の条件をご指定ください</li><br>
                        <li><strong>監視登録</strong><br>
                            満室の宿にチェックしたものが監視対象となります<br>
                            <small>※登録リストは５件まで作成可能です。</small></li><br>
                        <li><strong>待機</strong><br>
                            空きが出るまでお待ちください。<br>
                            登録宿に１つでも空きが出た場合、すぐにメールで通知されます<br>
                            <small>※通知済および宿泊日を超過した監視対象は監視終了となります。</small></li>
                    </ol>
                    <br>
                    <h3>|メンテナンスのお知らせ</h3>
                    <p>以下の日程の0:00am～8:00amは、じゃらんnetシステムメンテナンスに伴い、全サービス一時停止させていただきます。</p>
                    <label>2020年</label>
                    <ul>
                        <li>4月20日(月)</li>
                        <li>5月25日(月)</li>
                        <li>6月29日(月)</li>
                        <li>7月27日(月)</li>
                        <li>8月24日(月)</li>
                        <li>9月28日(月)</li>
                        <li>10月26日(月)</li>
                        <li>11月24日(火)</li>
                        <li>12月14日(月)</li>
                    </ul>
                    <label>2021年</label>
                    <ul>
                        <li>1月25日(月)</li>
                        <li>2月24日(水)</li>
                        <li>3月29日(月)</li>
                    </ul>
               </div>
        </div>
        <div id="watch_register">
            @auth
              @if(empty(Auth::user()->email_verified_at))
              <input class="btn watch" type="submit" value="チェックした宿を監視登録" disabled> 
              <span>※監視登録には、<a class="caution" href="{{ route('mypage') }}">メール認証</a>が必要です。</span>
              @else
              <input class="btn watch" type="submit" value="チェックした宿を監視登録">
              @endif
            @else
              <input class="btn watch" type="submit" value="チェックした宿を監視登録" disabled> 
              <small>
                  ※監視登録には<a class="caution" href="{{ route('login') }}">ログイン</a>&nbsp;
                  <a class="caution" href="{{ route('register') }}">通知先登録</a>
                  が必要です。  
              </small>
            @endauth
        </div>
    @csrf
    </form>
    <div id="btn-pagetop" style="display:none">
        <a class="btn-pagetop__link" href="#conditions"><i class="fas fa-chevron-circle-up"></i></a>
    </div>
    <footer>
        <p>ヤドキャン<br>
        ©UCHIDA NISHIPA All Rights Reserved.</p>   
    </footer>
    </body>
</html>