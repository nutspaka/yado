<div id="menu_input" role="search">
                <!-- <div id="name_lookup">
                    <input name="h_name" type="text" placeholder="宿名・キーワードから探す">
                </div> -->
    <div id="place_lookup">
      <select id="pref" name="pref">
        <option value=''>都道府県を選択</option>
      </select>
      <select id="l_area" name="l_area" >
         <option value=''>エリアを選択</option>
      </select>
      <select id="s_area"  name="s_area" >　
        　<option value=''>地域を選択</option>
      </select>
    </div>
     <div id="stay_form">
       <span id="cal"><i class="far fa-calendar-alt"></i></span>
       <input type="text" id="datepicker" class="cal_input" maxlength="15" value='{{ old("stay_date",date("Y年m月d日", strtotime("1 day")))}}' readonly placeholder="2020年01月01日">
       から<input type="number" min="1" max="10" name="stay_count" value={{ old("stay_count",1) }}>泊
       <input id="hide_date" name="stay_date" type="hidden" value='{{ old("stay_date",date("Ymd", strtotime("1 day")))}}'>
                {{-- <label>チェックアウト
                    <input autocomplete="off" class="datepicker" name="stay_end_date"　type="text" min={{date("Ymd")}} max={{date("Ymd", strtotime("3 month"))}}  value={{ old('stay_date',date("m/d", strtotime("2 day")))}} >
                </label> --}}
      </div>
      <div>
        <label>大人</label><input type="number" name="adult_num" min=1 max=10 value={{ old('adult_num',2) }}>
        <label>小学生</label><input type="number" name="sc_num" min=0 max=5 placeholder="0" value={{ old('sc_num',null) }}>
        <span id="picky_btn" class='btn-slide-toggle'><label>こだわり<i class="fas fa-angle-down"></i></label>
        </span>   
      </div>       
      <div id="picky_detail" style="display: none">
          <label>１泊の予算</label>
          <input class="budget" type="number" name="min_rate" min="0" step="1000" placeholder="下限なし" autocomplete="off" value={{ old('min_rate') }}>〜
          <input class="budget" type="number" name="max_rate" min="0" step="1000" placeholder="上限なし" autocomplete="off" value={{ old('max_rate')}}>
          <br>
          <label>
            <input type="checkbox" id="2_meals" name="2_meals" value="1"><label for="2_meals">夕朝食付</label>
            <input type="checkbox" id="onsen" name="onsen" value="1"><label for="onsen">温泉</label>
            <input type="checkbox" id="o_bath" name="o_bath" value="1"><label for="o_bath">露天風呂</label>
            <input type="checkbox" id="jpn_room" name="jpn_room" value="1"><label for="jpn_room">和室</label>
          </label>
      </div>
      <a href="javascript:void(0)" id="search" class="search btn">宿を検索 <i class="fas fa-search"></i></a>
                  {{-- @auth
                    <div><a href="{{ route('mypage')  }}">登録リスト</a> | <a href="{{ route('logout')  }}">ログアウト</a></div>
                    <small>{{Auth::user()->email}}でログイン中</small><br>
                    @else
                    <div>
                    <a href="{{ route('login') }}">ログイン</a> | <a href="{{ route('register') }}">通知先登録</a>
                    <small>※キャンセル待ち登録にはログインが必要です</small>
                    </div>
                  @endauth --}}
</div>
<div id="btn-pagetop" style="display:none">
  <a class="scroll_top btn-pagetop__link" href="#conditions"><i class="fas fa-chevron-circle-up"></i></a>
</div> 
<div style="display:none">
  <input id="pref_inputed" value={{old('pref')}}>
  <input id="l_area_inputed" value={{old('l_area')}}>
  <input id="s_area_inputed" value={{old('s_area')}}>
</div>
<div id="my-spinner" class="box">
  　<div class="spinner type1">
      <span>通信中..</span>
  　</div>
</div>