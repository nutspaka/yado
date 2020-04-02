//ページトップ
// var thisOffset;
// $(window).on('load',function(){
//   thisOffset = $('セレクタ').offset().top + $('セレクタ').outerHeight();
//   alert(thisOffset);
// });
 
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

// 絞り込み
$(document).on("click", "#picky_btn", function(){
  $('#picky_detail').slideToggle(250);
  if($('#picky_btn span').text()=="＋"){
    $('#picky_btn span').text("ー")
  }else{
    $('#picky_btn span').text("＋")
  };
});

// 監視登録ボタン表示
$(document).on("click", ".watch_item", function(){
  if ($(this).next('input').is(':checked')) {
    $(this).next('input').prop('checked', false);
  } else {
    $(this).next('input').prop('checked', true);
  }
  //登録ボタン
  if($('.watch_item').is(':checked')){
    $('#watch_register').css('display','block');
  }else{
    $('#watch_register').css('display','none');
  }
});

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
  dateFormat: 'yy/mm/dd',
  maxDate: '+3m',
  minDate: 0,
});
$('#datepicker').change(function() {
  let stay_date =$(this).val().replace(new RegExp("/", 'g'), "");
  $('input[name="stay_date"]').val(stay_date);
  // alert("change")
  console.log("Date Change");

});