<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
        <title>検索結果｜{{Config::get('app.name')}}</title>
        <!-- SEO -->
        <meta name="google-site-verification" content="0j6Bd19LIzIti7FXc9014gkZ3NmGAqFZ88CnsEcaFKc" />
        <meta name="description" content="1分簡単手続きで宿をキャンセル待ち！ホテル・旅館のキャンセル待ちサービスなら「宿のマチコ」-じゃらんnet掲載の宿に対応-">
        <meta name="keywords" content="旅行,じゃらん,満室">
        <link rel="canonical" href="{{route('home')}}">
        <meta property="og:locale" content="ja_JP">
        <meta property="og:type" content="service">
        <meta property="og:site_name" content="宿のマチコ">
        <meta property="og:url" content="{{route('home')}}">
        <meta property="article:tag" content="旅館">
        <meta property="article:tag" content="宿泊">
        <meta property="article:tag" content="ホテル">
        <meta property="article:tag" content="じゃらん">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Noto+Sans+JP:400,700" rel="stylesheet">
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
        <script src="{{ asset('js/register.js') }}?<?php echo date('Ymd-Hi'); ?>" defer></script>
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
              {{-- 検索ボックス --}}
              @include('layouts.parts.search') 
            </div>    
        </div>
    </form>
        <main class="result_script">
        検索結果:<h1 class="color-grd">{{$hotel_list["NumberOfResults"]}}</h1>軒<small>※じゃらん人気順</small>
        <br>
        @if ($hotel_list["NumberOfResults"] > 100)
        <p>※100件を超えた検索結果は表示できません。宿泊条件の絞り込みをお願いします。</p>
        @endif
        @if ($hotel_list["NumberOfResults"] > 0)
        {{-- ホテル一覧 --}}
        @foreach ($hotel_list["Hotel"] as $hotel)
        <div class="searchBoxNew scroll-fade">
            <div class="content">
                @if (isset($hotel["PlanFlag"]))
                <div class="availability">
                    <span>&nbsp;空室&nbsp;</span>
                </div>
                @else
                <div class="availability full">
                    <span>&nbsp;満室&nbsp;</span>
                </div>
                @endif
                <div class="info">
                  <h2>{{$hotel["HotelName"]}}</h2>
                  <div class="lr">
                    <div>
                    @if (doubleval($hotel["Rating"])!=0)
                     <span class='rate rate{{floor($hotel["Rating"])}}-{{round(doubleval($hotel["Rating"])-floor($hotel["Rating"]))}}'></span>&nbsp;
                     <strong class="rate_num">
                        {{doubleval($hotel["Rating"])}}                           
                     </strong>                        
                    @else
                    <small>ー (有効口コミ数未達) </small>
                    @endif
                     <span>&nbsp;<i class="far fa-comment-dots"></i>{{$hotel["NumberOfRatings"]}}&nbsp;</span><span>&nbsp;¥{{$hotel["SampleRateFrom"]}}〜</span>
                    </div>
                  </div>
                  @if (isset($hotel["PlanFlag"]))
                    <a target="_blank" href={{$hotel["HotelDetailURL"]}}>
                        <div class="btn book"><i class="far fa-window-restore"></i>&nbsp;じゃらんnetで予約する&nbsp;></div>
                    </a>
                  @else
                   <div class="btn wait">
                    <input style="display: none" class="target_h_name" value={{$hotel["HotelName"]}}>
                    <input style="display: none" class="target_h_id" value={{$hotel["HotelID"]}}>
                      <span><i class="far fa-clock"></i>&nbsp;キャンセル待ちをする&nbsp;></span>
                   </div>
                  @endif
                </div><!-- info -->
              @if(isset($hotel["PictureURL"]))
              　<img src="{{$hotel["PictureURL"]}}" class="bg scale lazyloaded" data-scale="best-fill" alt="外観" data-src={{$hotel["PictureURL"]}}>
              @else
                <img src="" class="bg scale lazyloaded" data-scale="best-fill" alt>
              @endif
            </div>
        </div>
        @endforeach
        @elseif(isset($err_code))
        <br>
        <h3 class="alert">Sorry..</h3>
        <p class="alert">システムエラーが発生しました。</p>
        <br>
          @if($err_code =='406')
          　<p class="alert">一時的な過負荷のため、現在検索することができません。<br>お手数ですが時間を置いて再度検索をお試しください。</p>
          　<div class="btn reload"><input type="button" value="再度検索条件を指定" onclick="window.location.reload();" /></div>
          @elseif($err_code =='503')
          　<p class="alert">じゃらんnetシステムのメンテナンス、もしくは一時的な過負荷のため現在検索することができません。</p>
          　<a style="text-decoration:underline" target="_blank" href="https://www.jalan.net/jalan/doc/howto/maintenance.html">定期メンテナンスのお知らせ</a>
          @endif
        @else
        <p>対象が見つかりませんでした。<br>検索条件を再設定の上、検索し直してください。</p>
        @endif
        <br>
        <div class="scroll_top">
            <a class="btn search" href="javascript:void(0)">検索条件を指定する</a>
        </div> 
        <br>

        </main>
        @include('layouts.parts.footer') 
    {{-- 登録モーダル --}}
    <div id="register_modal">
        <div class="background">
        </div>
        <div class="register_form">
          <span id="close">×</span>
          <br>
          <h2 id="h_name_modal" class="color-grd"></h2>
          {{-- 登録前 --}}
          <form id="watch_register" name="watching" method="post" action="">
            <h3>空室通知先を入力してください</h3>
            <p class="mailaddress">メールアドレス</p>
            <input id="mail_input" name="email" type="email" placeholder="sample@wait.com" required>
            {{-- 登録待ち --}}
            <div id="watch_wait">
                 <h4>通信中..</h4>
            </div>
            <div id="accept_btn">
            　<a href="javascript:void(0)" class="btn watch gradient">空室通知をリクエスト</a>
            </div>
            <br>
            <br>
            <div style="display: none">
              <input name="h_id" id="h_id" >
              <input name="h_name" id="h_name">
              <input name="stay_count" value={{ old('stay_count',1) }}>
              <input name="stay_date" value={{old('stay_date')}}>
              <input name="adult_num" value={{ old('adult_num',2) }}>
              <input name="sc_num" value={{ old('sc_num',null) }}>
              <input name="min_rate" value={{old('min_rate')}}>
              <input name="max_rate" value={{old('max_rate')}}>
              <input id="onsen_inputed" name="onsen" value={{old('onsen')}}>
              <input id="o_bath_inputed" name="o_bath" value={{old('o_bath')}}>
              <input id="jpn_room_inputed" name="jpn_room" value={{old('jpn_room')}}>
              <input id="2_meals_inputed" name="2_meals" value={{old('2_meals')}}>
            </div> 
            @csrf
          </form>
          {{-- 登録後 --}}
          <div id="register_done">
            <h3>受付完了メールを送信しました</h3>
            <h2 id="maillogo">≡ <i class="far fa-envelope"></i></h2>
            <p id="modal_notice">
              <small>※メールが届いていない場合、メールアドレスの打ち間違いの他、迷惑メールフォルダに振り分けられている可能性が考えられます。</small>
              <br>
              <small>※空室通知メールは、空室を保証するものではございません。確認いただくタイミングによっては、再度満室となる場合もございます。</small>
            </p>
            <span id="modal_close" class="btn"><small>閉じる</small></span>
          </div>
        </div>
    </div>
    </body>
</html>