// определение браузера
function getBrowserInfo() {
  var t,v = undefined;
  if (window.opera) t = 'Opera';
  else if (document.all) {
    t = 'IE';
    var nv = navigator.appVersion;
    var s = nv.indexOf('MSIE')+5;
    v = nv.substring(s,s+1);
  }
  else if (navigator.appName) t = 'Netscape';
  return {type:t,version:v};
}

// добавление закладок
function bookmark(a){
  var url = window.document.location;
  var title = window.document.title;
  var b = getBrowserInfo();
  if (b.type == 'IE' && 7 > b.version && b.version >= 4) window.external.AddFavorite(url,title);
  else if (b.type == 'Opera') {
    a.href = url;
    a.rel = "sidebar";
    a.title = url+','+title;
   return true;
  }
  else if (b.type == "Netscape") window.sidebar.addPanel(title,url,"");
  else {window.external.AddFavorite(url,title);}
  return false;
}

// обновление Captcha
function reloadCaptcha(){
  src=document.captcha.src; // запоминаем адрес капчи в переменную
  document.captcha.src='/decor/loading.gif';
  document.captcha.src=src+'?rand='+Math.random();
}

function setTyre(f){
  $(".blockSelection").css({'display': 'none'});
	blok = "#selection_" + f["tyre"].value;
  $(blok).css({'display': 'block'});
	//alert($(".tyre").val());
	$select = ".tyre option:nth-child(" + f["tyre"].value + ")'";
	$($select).attr('selected', 'selected');
}
