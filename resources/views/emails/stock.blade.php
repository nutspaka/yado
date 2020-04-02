<!DOCTYPE html>
<html lang="ja">
<style>
  body {
    background-color: white;
  }
  h2 {
    color: #736EFE;
    background-color: #5EFCE8;
    width: 100%;
    text-align: center;
  }
</style>
<body>
  <h2>宿のキャンセル待ちサービス　ヤドキャン</h2>
  <p>{{date("Y年n月j日 G:i")}} 時点で空室プランを発見しましたので、ご連絡させていただきます。</p>
  <p>※空室状況は常に変化いたしますので、ご予約の保証はできかねます。予めご了承願います。</p>

<hr>
□　監視対象　□
<br>
<p>{!!$h_name!!}<p>
<ul>
  <li>チェックイン　：{{date("Y/n/j", strtotime($conditions->stay_date))}}</li>
  <li>宿泊日数　　　：{{$conditions->stay_count}}泊</li>
  <li>予約人数　　　：大人{{$conditions->adult_num}}人
     @if (!empty($conditions->sc_num))
     、小学生{{$conditions->sc_num}}人                         
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
□　空室プラン一覧（{{$xml->NumberOfResults}}件）　□
  <ul>
    @foreach ($xml->Plan as $i)
    <li>
      <p>{{$i->Hotel->HotelName}}</p>
      <a class="btn" href="{{$i->PlanCommonDetailURL}}">{{$i->PlanName}}</a>
    </li>
    @endforeach
  </ul>
  ※この監視対象は、通知に伴い監視終了とさせていただきます。
  <br>
  <hr>
  宿のキャンセル待ちサービス　ヤドキャン
</body>
</html>