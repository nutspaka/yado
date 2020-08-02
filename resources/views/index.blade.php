<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
        <title>{{Config::get('app.name')}}｜TOPページ</title>
        <!-- SEO -->
        <meta name="google-site-verification" content="zZJeigZ3oMBLJZqCp6K0uchELbQkerXUc17sPqJyzAg" />
        <meta name="description" content="1分簡単手続きで宿をキャンセル待ち！ホテル・旅館のキャンセル待ちサービスなら「宿のマチコ」-じゃらんnet掲載の宿に対応-">
        <meta name="keywords" content="旅行,じゃらん,満室">
        <link rel="canonical" href="https://www.yadonomachiko.work">
        <meta property="og:locale" content="ja_JP">
        <meta property="og:type" content="service">
        <meta property="og:site_name" content="宿のマチコ">
        <meta property="og:url" content="https://www.yadonomachiko.work">
        <meta property="article:tag" content="旅館">
        <meta property="article:tag" content="宿泊">
        <meta property="article:tag" content="ホテル">
        <meta property="article:tag" content="じゃらん">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@300&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/1343700754.js" crossorigin="anonymous"></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}?<?php echo date('Ymd-Hi'); ?>" rel="stylesheet">
        <link href="{{ asset('css/appForSp.css') }}?<?php echo date('Ymd-Hi'); ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">
        <!-- Js -->
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
        <script src="{{ asset('js/pref.js') }}?<?php echo date('Ymd-Hi'); ?>"></script>
        <script src="{{ asset('js/disp.js') }}?<?php echo date('Ymd-Hi'); ?>" defer></script>
        <script src="{{ asset('js/search.js') }}?<?php echo date('Ymd-Hi'); ?>" defer></script>
        <noscript>
            <div class="noScript">サイトを利用するためには、JavaScriptを有効にしてください。</div>
         </noscript>
    </head>
    <body>
    <div class="nav-bar">
        <a href="/">
            <img class="logo" src="/images/logo.png" alt="logo">
          </a>
        <a class="contact" href="{{ route('contact.index') }}"><i class="far fa-envelope"></i>お問い合わせ</a>
    </div>
<form id="conditions" method="get" action="{{route('search')}}">
        <div id="menu" class="gradient">
            <div id="head-line">
              <h1>１分でかんたん<br>宿をキャンセル待ち</h1>
              {{-- 検索ボックス --}}
              @include('layouts.parts.search') 
            </div>    
        </div>
        <br>
        <div class="about">
            <span class="color-grd scroll-fade">キャンセル待ちシステム</span><br>
            <h2 class="color-grd scroll-fade">宿のマチコの特徴</h2>
            <br>
            <div class="featureList">
                <div class="meritBox scroll-fade">
                    <div class="meritImg"><a href="https://www.jalan.net/jw/jwp0000/jww0001.do" target="_blank"><img class="jalanlogo" src="https://www.jalan.net/jalan/doc/jws/images/jws_88_50_gray.gif" alt="じゃらん Web サービス" title="じゃらん Web サービス" border="0"></a></div>
                    <h3 class="title">安心のシステム</h3>
                    <p class="description">日本最大級の旅行予約サイト「じゃらんnet」のシステムと連携。最新の空室情報を取得し、ホテル・旅館のキャンセル待ちをシステムが行います。</p>
                </div>
                <div class="meritBox scroll-fade">
                    <div class="meritImg">￥<span class="freePrice color-grd">0</span></div>
                    <h3 class="title">完全無料</h3>
                    <p class="description">当サイトは有志で運営しており、0円でご利用いただけます。利用料は一切かかりません。</p>
                </div>
                <div class="meritBox scroll-fade">
                    <div class="meritImg"><img width="60px" src="/images/noregister.png" alt="会員登録不要"></div>
                    <h3 class="title">会員手続き不要</h3>
                    <p class="description">会員手続き不要で、すぐにご利用できます。キャンセル待ちを利用する場合のみ、空室通知先メールアドレスを入力してください。</p>
                </div>
            </div>
        </div>
        <main class="about">
            <h2 class="color-grd scroll-fade">ご利用方法</h2>
            <br>
                <div class="scroll-fade">
                    <h3 class="title color-grd">STEP01</h3>
                    <div>宿（ホテル・旅館等）を検索</div>
                </div>
                <br>
                <div class="scroll-fade">
                    <h3 class="title color-grd">STEP02</h3>
                    <div>満室の宿をクリック、空室通知をリクエスト</div>
                </div>
                <br>
                <div class="scroll-fade">
                    <h3 class="title color-grd">STEP03</h3>
                    <div>空室が出るまでお待ちください。<br>
                    <small>※空室が見つかった場合、メール通知されます。</small>
                    </div>
                </div>
                <br>
        </main>
        @include('layouts.parts.footer') 
    </form>
    <div > 
    <div style="display:none">
    <input id="onsen_inputed" value={{old('onsen')}}>
    <input id="o_bath_inputed" value={{old('o_bath')}}>
    <input id="jpn_room_inputed" value={{old('jpn_room')}}>
    <input id="2_meals_inputed" value={{old('2_meals')}}>
    </div>
    </body>
</html>