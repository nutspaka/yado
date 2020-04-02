$('#rebtn').click(function (e) { 
  $('#menu_input').removeClass('humberger');
  $(this).removeClass('rebtnSp');
})

$('#search').click(function() {

//validation
  let err_ary = new Array();
　if($('select[name="s_area"]').val()<1){
  　err_ary.push('地域を選択してください');
  }

  //宿泊日
  if($('#datepicker').val() == ''){
    err_ary.push('宿泊日を入力してください');
  }else{
    var today = new Date();
    var future = new Date();
    future.setMonth(future.getMonth() + 3);
    console.log(future);
    var inputdate = $('#datepicker').val();
    var datepicker = new Date(inputdate.slice(0,4),inputdate.slice(5,7)-1,inputdate.slice(8));
    console.log(datepicker);
    if( datepicker < today || datepicker > future)
    {
      err_ary.push('宿泊日は本日から３ヶ月以内に指定してください');
    }
  }

  if($('input[name="stay_count"]').val() == ''){
    err_ary.push('泊数を入力してください');
  }
  if($('input[name="adult_num"]').val() >10 || $('input[name="adult_num"]').val() < 1){
    err_ary.push('大人の人数を入力してください');
  }
  // 予算
  let max_rate = $('input[name="max_rate"]').val();
  let min_rate = $('input[name="min_rate"]').val();
  if(Number(max_rate) > 0){
    if(Number(min_rate) > Number(max_rate)){
      err_ary.push('予算の上限金額と下限金額の選択が正しくありません');
    }
  };

  if(err_ary.length > 0){
    alert(err_ary.join("\n"));
    return;
  }
  else
  {

  // スマホ用
  $('#menu_input').toggleClass('humberger');
  $('#rebtn').addClass('rebtnSp');

  //loading
  $('#my-spinner').removeClass("loaded");
  // 既存検索結果消去
  $("#count").remove();
  $("#result_num").text('');
  $("#result_list").children().remove();

  // 検索結果取得
  $.ajax({
    url : '/search'
    , type : 'get'
    , data:$("#conditions").serializeArray()//JSON形式取得
    , dataType : 'json'
    // , cache : false
    , timespan:3000
   }).done(function(data,textStatus,jqXHR) {
        //ex：200 success
        //console.log(jqXHR.status + textStatus);
      if(data.NumberOfResults != '0'){
        $.each(data.Hotel, function(index, hotel){
          let review_int = Math.floor(hotel.Rating); 
          let review_decimal = Math.round(hotel.Rating - review_int); 
          if(hotel.PlanFlag==null){
            $("#result_list").append(
            '<hr>'
            +'<div class="condition gradient">'
            +'<label for='+ hotel.HotelID +'>×満室　　'
            +'<input id='+ hotel.HotelID +' class="watch_item" type="checkbox" name="h_id[]" value=' +hotel.HotelID+'> 監視する'
            +'<input style="display: none" type="checkbox" name="h_name[]" value=' +hotel.HotelName+ '>'
            +'</label></div>'
            )
          }else{
            $("#result_list").append(
              '<hr>'
              +'<div class="condition"><a target="_blank" href=' + hotel.HotelDetailURL + '>'
              +'◎空室</a></div>'
            )
          }
          $("#result_list").append(
             '<div class="h_detail"><img class="img_treat" src=' + hotel.PictureURL + " alt='ホテルイメージ' title=" + hotel.PictureCaption + "></div>"
            + '<div class="h_detail">'
            + '<a target="_blank" href=' + hotel.HotelDetailURL + '>'
            + '<p class="font_em">' + hotel.HotelName + '</p></a>'
            + '<div class="wrap"><span class="rate rate'+review_int +'-'+ review_decimal +'"></span> <strong>'+hotel.Rating+'</strong> <i class="far fa-comment-dots"></i>'+hotel.NumberOfRatings+'件</div>'
            + '<p class="wrap">¥'+Number(hotel.SampleRateFrom).toLocaleString()+"〜</p></div>"
          )
        })
      }else{
        $("#result_list").append('<p class="alert">システムエラーが発生しました。</p>')
      }
		}).fail(function(jqXHR, textStatus, errorThrown ) {
      //ex：404 error NOT FOUND
			console.log(jqXHR.status + textStatus + errorThrown); 
		}).always(function(hotel){
        $("#result").css('display','block');
        $("#result_num").text(hotel.NumberOfResults);
        //ローディング表示削除
        let spinner = document.getElementById('my-spinner');
        spinner.classList.add('loaded');
    });
  }
});

