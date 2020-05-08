$(function(){
  //入力済みカレンダー読み込み
  idate = $('#hide_date').val();
  let year = idate.slice(0,4);
  let month = idate.slice(4,6);
  let day = idate.slice(6);
  let fmtdate = year + "年"　+ month + "月" + day  +"日";
  $('#datepicker').val(fmtdate);
  
  //こだわり入力あるか
  let commitment = false;
  if($('#onsen_inputed').val() == '1'){
    $('input[name="onsen"]').prop("checked",true);
    commitment = true;
  }
  if($('#o_bath_inputed').val() == '1'){
    $('input[name="o_bath"]').prop("checked",true);
    commitment = true;
  }
  if($('#jpn_room_inputed').val() == '1'){
    $('input[name="jpn_room"]').prop("checked",true);
    commitment = true;
  }
  if($('#2_meals_inputed').val() == '1'){
    $('input[name="2_meals"]').prop("checked",true);
    commitment = true;
  }
  if($('input[name="min_rate"]').val() != '' || $('input[name="max_rate"]').val() != ''){
    commitment = true;
  }
  //こだわりを開く
  if(commitment){
    $('#picky_detail').slideToggle(250);
  }

  $('#my-spinner').addClass("loaded");

  // 画面下位置からフェード(px)
  var effect_pos = 80; 

  // スクロールまたはロードするたびに実行
  $(window).on('scroll load', function(){
      var scroll_top = $(this).scrollTop();
      var scroll_btm = scroll_top + $(this).height();
      var pos = scroll_btm - effect_pos;

      // effect_posがthis_posを超えたとき、エフェクトが発動
      $('.scroll-fade').each( function() {
          var this_pos = $(this).offset().top;
          if ( pos > this_pos ) {
              $(this).css({
                  opacity: 1,
                  transform: 'translateY(0)',
              });
          }
      });
  });
});

$(window).scroll(function(){
  // console.log($(window).scrollTop())
  // console.log($(window).height())
	if( $(window).scrollTop() + $(window).height() > $(window).height()*2){
    // 特定の要素を超えた
    $('#btn-pagetop').css('display','block');
	} else {
    // 特定の要素を超えていない
    $('#btn-pagetop').css('display','none');
	}
});

//ページトップスクロール
$(function(){
  $('.scroll_top').click(function () {
     $('body, html').animate({ scrollTop: 0 }, 500);
     return false;
  });
});

// 絞り込み
$(document).on("click", "#picky_btn", function(){
  $('#picky_detail').slideToggle(250);
  // if($('#picky_btn span').text()=="＋"){
  //   $('#picky_btn span').text("ー")
  // }else{
  //   $('#picky_btn span').text("＋")
  // };
});

// キャンセル待ちボタン押下、モーダル表示
$(document).on("click", ".wait", function(){
  $('#register_modal').show(450);
  $('#mail_input').focus();
  let h_name = $(this).find('.target_h_name').val();
  let h_id = $(this).find('.target_h_id').val();
  $('#h_name_modal').text(h_name);
  $('#h_name').val(h_name);
  $('#h_id').val(h_id);
});

// モーダル閉じる
$('#close').click(function() {
  $('#register_modal').hide(410);
  $('#register_done').hide(420);
  $('#watch_register').show(420);
  $('#accept_btn').show(420);
})
$('#modal_close').click(function() {
  $('#register_modal').hide(410);
  $('#register_done').hide(420);
  $('#watch_register').show(420);
  $('#accept_btn').show(420);
})

// 予算
$('input[name="max_rate"]').change(function() {
  if($('input[name="max_rate"]').val() == 0){
    $('input[name="max_rate"]').val('');
  };
});
$('input[name="min_rate"]').change(function() {
  if($('input[name="min_rate"]').val() == 0){
    $('input[name="min_rate"]').val('');
  };
});

// 宿泊日
$('#datepicker').datepicker({
  language: 'ja',
  changeMonth: false,
  duration: 300,
  showAnim: 'show',
  dateFormat: 'yy年mm月dd日',
  maxDate: '+3m',
  minDate: '+1d',
});
$('#datepicker').change(function() {
  let stay_date =$(this).val().replace(/(年)|(月)|(日)/g,'');
  $('input[name="stay_date"]').val(stay_date);
  // alert("change")
  console.log("Date Change");

});