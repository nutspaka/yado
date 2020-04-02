$(document).ready(function(){
  
  //都道府県（初期表示）
  $.ajax({
    url : './xml/area.xml'
    , type : 'get'
    , dataType : 'xml'
    , cache : false
    , success : function(data) {
    $(data).find("Prefecture").each(function(){
      $('select[name="pref"]').append("<option value="+$(this).attr('cd')+">"+$(this).attr('name')+"</option>");
    }) ;
    }
    , error : function() {
    alert("システムが一時停止しています。") ;
    }
  });  

  
  //都道府県（動的表示）
  $('select[name="pref"]').change(function() {
    var prefcd = $(this).val();
    $('select[name="l_area"] option').remove();
    $('select[name="l_area"]').append("<option value=''>エリアを選択</option>")
    $('select[name="s_area"] option').remove();
    $('select[name="s_area"]').append("<option value=''>地域を選択</option>")
    $.ajax({
      url : './xml/area.xml'
      , type : 'get'
      , dataType : 'xml'
      , cache : false
      , success : function(data) {
      $(data).find("Prefecture[cd="+prefcd+"]").find("LargeArea").each(function(){
        $('select[name="l_area"]').append("<option value="+$(this).attr('cd')+">"+$(this).attr('name')+"</option>");
      }) ;
      }
      , error : function() {
      alert("システムが一時停止しています。") ;
      }
      });
  })

  //広域エリア（動的表示）
  $('select[name="l_area"]').change(function() {
    var areacd = $(this).val();
    $('select[name="s_area"] option').remove();
    $('select[name="s_area"]').append("<option value=''>地域を選択</option>")
    $.ajax({
      url : './xml/area.xml'
      , type : 'get'
      , dataType : 'xml'
      , cache : false
      , success : function(data) {
      $(data).find("LargeArea[cd="+areacd+"]").find("SmallArea").each(function(){
        $('select[name="s_area"]').append("<option value="+$(this).attr('cd')+">"+$(this).attr('name')+"</option>");
      }) ;
      }
      , error : function() {
      alert("システムが一時停止しています。") ;
      }
      });
  })
}); 