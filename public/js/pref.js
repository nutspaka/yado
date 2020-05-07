$(document).ready(function(){
  //入力済み用
  let pref_code = $('#pref_inputed').val();
  let l_area = $('#l_area_inputed').val();
  let s_area = $('#s_area_inputed').val();
  //都道府県（初期表示）
  $.ajax({
    url : './xml/area.xml'
    , type : 'get'
    , dataType : 'xml'
    , cache : false
    , success : function(data) {
    $(data).find("Prefecture").each(function(){
      $('select[name="pref"]').append("<option value="+$(this).attr('cd')+">"+$(this).attr('name')+"</option>");
      if(pref_code == $(this).attr('cd')){
        $("#pref option[value='" + pref_code + "']").prop('selected', true);
        prefChange(pref_code);
        lareaChange(l_area);
      }
    }) ;
    }
    , error : function() {
    alert("システムが一時停止しています。") ;
    }
  }); 

  function prefChange(prefcd){
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
        if(l_area == $(this).attr('cd')){
          $("#l_area option[value='" + l_area + "']").prop('selected', true);
        }
      }) ;
      }
      , error : function() {
      alert("システムが一時停止しています。") ;
      }
      });
  }

  function lareaChange(areacd){
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
        if(s_area == $(this).attr('cd')){
          $("#s_area option[value='" + s_area + "']").prop('selected', true);
        }
      }) ;
      }
      , error : function() {
      alert("システムが一時停止しています。") ;
      }
      });
  }
  
  //都道府県（動的表示）
  $('select[name="pref"]').change(function() {
    let prefcd = $('select[name="pref"]').val();
    prefChange(prefcd);
    //オプション解除
    $('select[name="l_area"] option').attr("selected", false);
  })

  //広域エリア（動的表示）
  $('select[name="l_area"]').change(function() {
    let areacd  = $('select[name="l_area"]').val();
    lareaChange(areacd);
    //オプション解除
    $('select[name="s_area"] option').attr("selected", false);
  })
}); 