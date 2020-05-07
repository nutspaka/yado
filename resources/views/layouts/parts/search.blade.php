<div id="menu_input">
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
        大人<input type="number" name="adult_num" min=1 max=10 value={{ old('adult_num',2) }}>名&nbsp;
        小学生<input type="number" name="sc_num" min=0 max=5 placeholder="0" value={{ old('sc_num',null) }}>名&nbsp;
        <span id="picky_btn" class='btn-slide-toggle'>こだわり<i class="fas fa-angle-down"></i>
        </span>   
      </div>       
      <div id="picky_detail" style="display: none">
          予算<input class="budget" type="number" name="min_rate" min="0" step="1000" placeholder="下限なし" autocomplete="off" value={{ old('min_rate') }}>~<input class="budget" type="number" name="max_rate" min="0" step="1000" placeholder="上限なし" autocomplete="off" value={{ old('max_rate')}}>円<small>※1部屋1泊あたり</small>
          <label>
            <input type="checkbox" name="2_meals" value="1">夕朝食付&nbsp;
            <input type="checkbox" name="onsen" value="1">温泉&nbsp;
            <input type="checkbox" name="o_bath" value="1">露天風呂&nbsp;
            <input type="checkbox" name="jpn_room" value="1">和室
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