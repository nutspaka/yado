<!DOCTYPE html>
<html lang="ja">
<body>
  <p>下記対象・条件でキャンセル待ちを受け付けました。<br>空室を発見次第、お知らせいたします。</p>
  <small>※空室通知メールは、空室を保証するものではございません。確認いただくタイミングによっては、再度満室となる場合もございますのでご了承願います。</small>
  <hr>
□　対象　□
<br>
<h4>{!!$h_name!!}</h4>
□　条件　□
<ul>
  <li>チェックイン　：{{date("Y年n月j日", strtotime($conditions->stay_date))}}</li>
  <li>宿泊日数　　　：{{$conditions->stay_count}}泊</li>
  <li>予約人数　　　：大人{{$conditions->adult_num}}名
     @if (!empty($conditions->sc_num))
     、小学生{{$conditions->sc_num}}名         
     @endif
  </li>
  <li>予算　　　　　：
    @if (!empty($conditions->min_rate))
    {{$conditions->min_rate}}円〜
    @endif
    @if (!empty($conditions->max_rate))
    〜{{$conditions->max_rate}}円
    @endif
　</li> 
  <li>その他　　　　：
    @if (!empty($conditions->{'2_meals'}))
    夕朝食付&nbsp;&nbsp;
    @endif
    @if (!empty($conditions->onsen))
    温泉&nbsp;&nbsp;
    @endif
    @if (!empty($conditions->o_bath))
    露天風呂&nbsp;&nbsp;
    @endif
    @if (!empty($conditions->jpn_room))
    和室&nbsp;&nbsp;
    @endif
  </li>
</ul>
<hr>
<br>
  宿のキャンセル待ちサービス　宿のマチコ
<br>
  <a href="{{route('home')}}">{{route('home')}}</a>
<br>
<small>※当メールに心あたりが無い場合は、誠におそれいりますが、破棄していただけますようお願いいたします。</small>
</body>
</html>