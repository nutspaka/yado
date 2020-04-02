<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ヤドキャン') }} | ログイン・新規登録・マイページ</title>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/1343700754.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/member.css') }}" rel="stylesheet">
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
        <div><a class="home_btn" href="{{ route('home')}}">ホーム > <i class="fas fa-home"></i></a></div>
    </div>
    <footer>
        <p>宿のキャンセル待ちサービス　ヤドキャン<br>
        ©UCHIDA NISHIPA All Rights Reserved.</p>   
    </footer>
</body>
</html>
