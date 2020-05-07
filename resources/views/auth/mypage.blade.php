@extends('layouts.app')

@section('content')
<h2>キャンセル待ち登録リスト</h2>
<small><i class="fas fa-user-secret"></i>･･･キャンセル待ち中&nbsp;&nbsp;<i class="fas fa-check"></i>･･･終了&nbsp;&nbsp;<i class="fas fa-paper-plane"></i>･･･通知済</small>
@if (session('regist_error'))
  <div class="alert alert-success" role="alert">{{ session('regist_error') }}
  </div>
@endif
<p>キャンセル待ち対象は５件まで登録可能です。<br>
<small>※宿泊日時を越えたキャンセル待ち対象は自動で「終了」となります。</small></p>
  @if(count($watchlist)==0)
  <br>
    <h2>対象はありません</h2>
  @else
    <table>
          <tr class="head_tr">
            <th>状態</th>
            <th>対象</th>
            <th>宿泊日（泊）</th>
            <th>条件</th>
            <th></th>
          </tr>
          @foreach ($watchlist as $i)
          {{-- キャンセル待ち中 --}}
                 @if ($i->deleted_at == null && $i->expired == null)
                  <tr class="monitor">
                    <td><i class="fas fa-user-secret"></i></td>
                 @elseif($i->expired != null)
                 <tr class="notice">
                   <td class=""><i class="fas fa-check"></i></td>
                 @else
                  <tr class="notice">
                    <td class=""><i class="fas fa-paper-plane"></i></td>
                 @endif                 
                      <td>
                        <p>{!! $i->h_name !!}</p>
                      </td>
                      <td>
                        {{date("n/j", strtotime(json_decode($i->conditions,true)["stay_date"]))}}<br>
                        ({{json_decode($i->conditions,true)["stay_count"]}}泊)
                      </td>
                      <td><small>大人{{json_decode($i->conditions,true)["adult_num"]}}名<br>
                        @if (!empty(json_decode($i->conditions,true)["sc_num"]))
                        小学生{{json_decode($i->conditions,true)["sc_num"]}}名<br>                         
                        @endif
                        @if (!empty(json_decode($i->conditions,true)["min_rate"]))
                        下限:{{json_decode($i->conditions,true)["min_rate"]}}円<br>                         
                        @endif
                        @if (!empty(json_decode($i->conditions,true)["max_rate"]))
                        上限:{{json_decode($i->conditions,true)["max_rate"]}}円<br>                         
                        @endif
                        @if (!empty(json_decode($i->conditions,true)["onsen"]))
                        温泉                        
                        @endif
                        @if (!empty(json_decode($i->conditions,true)["o_bath"]))
                        &nbsp;&nbsp;露天風呂                        
                        @endif
                        @if (!empty(json_decode($i->conditions,true)["jpn_room"]))
                        &nbsp;&nbsp;和室                        
                        @endif
                        </small>
                      </td>
                      <td>
                      <form action="/delete/{{$i->id}}" method="POST">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="submit" value="×"> 
                        </form>
                      </td>
                    </tr>
                 
          @endforeach
      </table>
    @endif
@endsection