
$('#accept_btn').click(function() {
  //validation
  let email = $('#mail_input').val();
  if( email == '' || !email.includes('@')){
    alert('メールアドレスを入力してください');
    return;
  }
  
  $('#accept_btn').hide();
  $('#watch_wait').show();

  var obj = document.forms["watching"];
  // 非同期
  $.ajax({
    url : '/store/watch'
    , type : 'post'
    , data : $(obj).serialize()
    //受け取るデータは不要
    // , dataType : 'json'
    // , cache : false
    , timespan:3000
   }).done(function(data,textStatus,jqXHR) {
        //ex：200 success
      // console.log(jqXHR.status + textStatus);
      $('#watch_register').hide();
      $('#register_done').show();
		}).fail(function(jqXHR, textStatus, errorThrown ) {
      //ex：404 error NOT FOUND
      $('#accept_btn').show();
      alert('システムエラーにより登録に失敗しました')
			console.log(jqXHR.status + textStatus + errorThrown); 
    }).always(function(data){
      $('#watch_wait').hide();
    });
});

