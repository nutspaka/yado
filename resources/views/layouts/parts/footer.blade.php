
<head>
  <meta charset="utf-8">
  <style>
footer{
  width: 100%;
  background-color:rgb(56, 55, 55);
  font-size: 12px;
  font-weight: lighter;
  color: #fff;
  text-align: center;
  padding: 5px;
}
.information-list {
  margin-bottom: 0px;
  list-style: none;
  order: 2;
  display: -ms-grid;
  display: inline-grid;
  -ms-grid-columns: 1fr 1fr;
  grid-template-columns: 1fr 1fr;
  grid-column-gap: 10px;
  text-align: left;
  font-size: 14px;
  width: fit-content;
}
  </style>
</head>

<footer>
  <div id="snslogo">
    <div id="fb-root"></div>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v7.0"></script>
    <div class="fb-like" data-href="https://yadonomachiko.work" data-width="" data-layout="button" data-action="recommend" data-size="small" data-share="true"></div>
    &nbsp;<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>   
    &nbsp;<a href="https://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="basic" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/v4/public/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
   </div>
  <ul class="information-list">
    <li><a href="{{ route('home')}}">ホーム</a></li>
    <li class="information-list-item"><a class="information-link" href="{{ route('contact.index') }}">お問い合わせ</a></li>
    {{-- <li class="information-list-item"><a class="information-link" href="/advertising-terms-and-conditions">広告掲載に関する規約</a></li> --}}
    <li class="information-list-item"><a class="information-link" href="{{ route('terms') }}">利用規約</a></li>
    <li class="information-list-item"><a class="information-link" href="{{ route('policy') }}">プライバシーポリシー</a></li>
    {{-- <li class="information-list-item"><a class="information-link" href="/legal">特定商取引法に基づく表記</a></li> --}}
    {{-- <li class="information-list-item"><a class="information-link" target="_blank" rel="noopener" href="/">運営会社</a></li> --}}
    {{-- <li class="information-list-item"><a class="information-link js-gtm-click-sender" target="_blank" rel="noopener" data-event-category="UI：フッターメニュー" data-event-label="footer_advertising_lp_text_link_20191114" href="/">広告掲載</a></li>
    <li class="information-list-item"><a class="information-link" href="/">プレスリリース</a></li> --}}
  </ul>
  <h4>©2020 {{Config::get('app.name')}} All Rights Reserved.</h4>
  </footer>