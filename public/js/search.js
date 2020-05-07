
const today = new Date();
const future = new Date();
$('#search').click(function() {

//validation
  let err_ary = new Array();
　if($('select[name="l_area"]').val()<1){
  　err_ary.push('エリアを選択してください');
  }

  //宿泊日
  if($('#datepicker').val() == ''){
    err_ary.push('宿泊日を入力してください');
  }else{
    future.setMonth(future.getMonth() + 3);
    console.log('３ヶ月先');
    console.log(future);
    let idate = $('#hide_date').val();
    let datepicker = new Date(idate.slice(0,4),idate.slice(4,6)-1,idate.slice(6));
    console.log('宿泊日');
    console.log(datepicker);
    if( datepicker <= today || datepicker >= future)
    {
      err_ary.push('宿泊日は明日から３ヶ月以内でyyyy年mm月dd日形式で指定してください');
    }
  }

  if($('input[name="stay_count"]').val() == ''){
    err_ary.push('泊数を入力してください');
  }
  if($('input[name="adult_num"]').val() >10 || $('input[name="adult_num"]').val() < 1){
    err_ary.push('大人の人数を入力してください');
  }
  if($('input[name="sc_num"]').val() > 5 ) {
    err_ary.push('小学生は1から5の間で入力して下さい。');
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

  //loading
  $('#my-spinner').removeClass("loaded");
  
  // 既存検索結果消去
  // $("#count").remove();
  // $("#result_num").text('');
  // $("#result_list").children().remove();

  // 検索結果取得
  // $.ajax({
  //   url : '/search'
  //   , type : 'get'
  //   , data:$("#conditions").serializeArray()//JSON形式取得
  //   , dataType : 'json'
  //   // , cache : false
  //   , timespan:3000
  //  }).done(function(data,textStatus,jqXHR) {
  //       //ex：200 success
  //       //console.log(jqXHR.status + textStatus);
  //     if(data.NumberOfResults != '0'){
  //       $.each(data.Hotel, function(index, hotel){
  //         let review_int = Math.floor(hotel.Rating); 
  //         let review_decimal = Math.round(hotel.Rating - review_int); 
  //         if(hotel.PlanFlag==null){
  //           //満室
  //           $("#result_list").append(
  //             '<hr><div class="h_detail"><img class="img_treat" src=' + hotel.PictureURL + " alt='ホテルイメージ' title=" + hotel.PictureCaption + "></div>"
  //            + '<p><span class="full">&nbsp;満室</span>&nbsp;<i class="far fa-hand-point-right"></i><input id='+ hotel.HotelID +' class="watch_item option-input02" type="checkbox" name="h_id[]" value='+hotel.HotelID+'>キャンセル待ちする'
  //            +'<input style="display: none" type="checkbox" name="h_name[]" value=' +hotel.HotelName+ '>'
  //            +'<br><br><a target="_blank" href=' + hotel.HotelDetailURL + '><span style="color:black">&nbsp;'+ hotel.HotelName + '</span></a></p>'
  //            + '<div class="wrap"><span class="rate rate'+review_int +'-'+ review_decimal +'"></span><strong>'+hotel.Rating+'</strong> <i class="far fa-comment-dots"></i>'+hotel.NumberOfRatings+'</div>'
  //            + '<span class="wrap">¥'+Number(hotel.SampleRateFrom).toLocaleString()+"〜</span></div>"
  //          )
  //         }else{
  //           //空室
  //           $("#result_list").append(
  //             '<hr><div class="h_detail"><img class="img_treat" src=' + hotel.PictureURL + " alt='ホテルイメージ' title=" + hotel.PictureCaption + "></div>"
  //            + '<a target="_blank" href=' + hotel.HotelDetailURL + '>'
  //            + '<p><span class="vacancy">&nbsp;空室あり <i class="far fa-window-restore"></i></span><br><br><span style="color:black">&nbsp;' + hotel.HotelName + '</span></p></a>'
  //            + '<div class="wrap"><span class="rate rate'+review_int +'-'+ review_decimal +'"></span><strong>'+hotel.Rating+'</strong> <i class="far fa-comment-dots"></i>'+hotel.NumberOfRatings+'</div>'
  //            + '<span class="wrap">¥'+Number(hotel.SampleRateFrom).toLocaleString()+"〜</span></div>"
  //          )
  //         }
  //       })
  //     }else{
  //       $("#result_list").append('<p class="alert">システムエラーが発生しました。</p>')
  //     }
	// 	}).fail(function(jqXHR, textStatus, errorThrown ) {
  //     //ex：404 error NOT FOUND
	// 		console.log(jqXHR.status + textStatus + errorThrown); 
	// 	}).always(function(hotel){
  //       $("#result").css('display','block');
  //       $("#result_num").text(hotel.NumberOfResults);
  //       //ローディング表示削除
  //       let spinner = document.getElementById('my-spinner');
  //       spinner.classList.add('loaded');
  //   });
  $('#conditions').submit();
  }
});

