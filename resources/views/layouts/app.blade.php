<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>{{ config('app.name', '宿のマチコ') }} | お問い合わせ・利用規約・プライバシーポリシー</title>
    <!-- SEO -->
    <meta name="google-site-verification" content="zZJeigZ3oMBLJZqCp6K0uchELbQkerXUc17sPqJyzAg" />
    <meta name="description" content="お問い合わせ・利用規約・プライバシーポリシー|宿のキャンセル待ちサービスの「宿のマチコ」-じゃらんnet掲載のホテル・旅館に対応-">
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
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/1343700754.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <noscript>
      <div class="noScript">サイトを利用するためには、JavaScriptを有効にしてください。</div>
    </noscript>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/member.css') }}?<?php echo date('Ymd-Hi'); ?>" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div id="service_logo"> 
          <a href="/">
            <img class="logoimg" src="/images/logo.png" alt="logo">
          </a>
        </div>
        <br>
        <main class="py-4">
            @yield('content')
        </main>
        <br>
        {{-- <a href="{{ route('home')}}"><small>検索画面に戻る ></small></a>
        <br> --}}
    </div>

    @include('layouts.parts.footer')
</body>
</html>
