<?php
session_start();

header('Content-type: text/html; charset=utf-8');
require '../config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);



if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)){//если пользователь незарегистрирован, то он выбрасывается 
//на страницу авторизации

header(" Refresh: 1; URL=login.php");
};




$user=$_SESSION['user'];//имя пользователя


$dbh = mysqli_init();
mysqli_options($dbh, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT=0");
mysqli_options($dbh, MYSQLI_OPT_CONNECT_TIMEOUT, 5);

mysqli_real_connect($dbh, DB_SERVER, DB_USER, DB_PASS);

if (mysqli_connect_errno()) {
    printf("Ошибка соединения: %s\n", mysqli_connect_error());
    exit();
}

mysqli_query($dbh,"SET NAMES utf8");
					mysqli_query ($dbh,"SET COLLATION_CONNECTION=utf8");
                   mysqli_query($dbh,"SET CHARACTER_SET_CLIENT=utf8");
					mysqli_query($dbh,"SET CHARACTER_SET_RESULTS=utf8");	

					mysqli_select_db($dbh, DB_BASE);


$query = "SELECT * FROM users WHERE name='".$user."'";
$res=mysqli_query($dbh, $query);
$row=mysqli_fetch_array($res);
$privilege=$row['privilege'];//привилегии пользователя





?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

<!--ajax-->
<script type="text/javascript" src="../jquery/jquery.js"></script>
<!--ajax-->

  <link rel="stylesheet" href="../includes/index.css" media="screen">

  <style type="text/css">
        iframe {
            width:500px; height:400px;
            border:1px solid #000;
            margin-bottom:5px;
        }
        input {margin-right:5px; padding:3px;}
        .bold {font-weight:bold;}
        .ital {font-style:italic;}
        .under {text-decoration:underline;}
    </style>




</head>

<body style="background-color:white; margin:0 !important; padding:0 !important; border:0 !important;
width:100% !important;" onclick="dis();" >





<?php
if((isset($_GET['ok']))&&($_GET['ok']=='1')){
//попадаем сюда после нажатия кнопки Готово


//передача первому фрейму сегодняшней даты
$today=getdate();
$today_date=$today['year']."-".$today['mon']."-".$today['mday'];
$date=$today_date;

echo'
<!--обновление первого фрейма-->
<script type="text/javascript">
window.parent.frame1.document.location.reload();
window.parent.frame1.document.location = "frame1.php?date='.$date.'";
</script>
<!--обновление первого фрейма-->';

//передача второму фрейму сегодняшней даты
$today=getdate();
$today_date=$today['year']."-".$today['mon']."-".$today['mday'];
$date=$today_date;

echo'
<script type="text/javascript">
parent.frame2.location = "frame2.php?date='.$date.'";
</script>';




}

if((!isset($_GET['id']))){
///попадаем сюда изначально

}else if($_GET['id']=="_"){
//попадаем сюда при создании новостного блока

//генерация id

$today=getdate();
$today_date=$today['year']."".$today['mon']."".$today['mday'];
$date=$today_date;//дата

$time=$today['hours']."".$today['minutes']."".$today['seconds'];//время

$random=rand();

$id=$date.$time.$random;


echo'
<form id="form_insert" name="form_insert" method="post"  >

<!--поле с заголовком новости-->
<div align="center" style="width:100%; height:50px; background-color:transparent; ">
<div align="left" style="width:90%; height:50px; background-color:transparent;  ">
<input type="text" id="head" name="head" autocomplete="off" style="width:90%; height:30px; margin-top:10px; font-size:14pt;" 
value="" onclick="dis();" onblur="dis();" />
</div>
</div>
<!--поле с заголовком новости-->



<!--поле с текстом-->

<div align="center" style="width:100%; height:465px; background-color:transparent;">
<div style="width:100%; height:20px;"></div>

	<div>
		

		
		<div >
			
		
<script type="text/javascript">
// ***********************
//  вывод iframe и получение доступа к нему
// ***********************

// Выводим в HTML-поток iframe
document.write("<iframe  frameborder=\'no\' src=\'#\' id=\'frameId\' name=\'frameId\' style=\'width:90%;\' onclick=\'dis();\' onblur=\'dis();\'></iframe><br/>");
// Определим Gecko-браузеры, т.к. они отличаются в своей работе от Оперы и IE
var isGecko = navigator.userAgent.toLowerCase().indexOf("gecko") != -1;
// Получаем доступ к объектам window & document для ифрейма
var iframe = (isGecko) ? document.getElementById("frameId") : frames["frameId"];
var iWin = (isGecko) ? iframe.contentWindow : iframe.window;
var iDoc = (isGecko) ? iframe.contentDocument : iframe.document;

// ***********************
// Добавим на пустую страницу ифрейма произвольный HTML-код
// ***********************

// Формируем HTML-код
iHTML = "<html><head>\n";
iHTML += "<style>\n";
iHTML += "body, div, p, td {font-size:12px; font-family:tahoma; margin:0px; padding:0px;}";
iHTML += "p {margin-top: 0px !important; margin-bottom: 0px !important; line-height: 3px !important;}";
iHTML += "body {margin:5px;}";
iHTML += ".oranzh {color:#FF6300;}";
iHTML += "</style>\n";
iHTML += "<body>';



echo'</body>";
iHTML += "</html>";
// Добавляем его с помощью методов объекта document
iDoc.open();
iDoc.write(iHTML);
iDoc.close();

// ***********************
// Инициализация свойства designMode объекта document
// ***********************

if (!iDoc.designMode) alert("Визуальный режим редактирования не поддерживается Вашим браузером");
else iDoc.designMode = (isGecko) ? "on" : "On";

// ***********************
// Простейшие элементы редактирования: жирность, курсив, подчеркивание
// ***********************

// Выведем HTML-код этих элементов
document.write("<input type=\'button\' value=\'Ж\' onclick=\'setBold()\' class=\'bold\' style=\'width:60px;\' />");
document.write("<input type=\'button\' value=\'К\' onclick=\'setItal()\' class=\'ital\' style=\'width:60px;\' />");
document.write("<input type=\'button\' value=\'Ч\' onclick=\'setUnder()\' class=\'under\' style=\'width:60px;\' />");
document.write("<input type=\'button\' value=\'Вставить аудио\' onclick=\'insert_audio()\' class=\'bold\' style=\'width:160px;\' />");
// Запишем код функции, для выставления форматирования
// Используется метод execCommand объекта document
function setBold() {
	iWin.focus();
	iWin.document.execCommand("bold", null, "");
}
function setItal() {
	iWin.focus();
	iWin.document.execCommand("italic", null, "");
}
function setUnder() {
	iWin.focus();
	iWin.document.execCommand("underline", null, "");
}
function setLink() {
	var url = prompt("Введите URL:", "http://");
	if (!url) return;
	iWin.focus();
	iWin.document.execCommand("CreateLink", null, url);
}
function setH1() {
	iWin.focus();
	execCommandImitation("<object classid=\"clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B\" codebase=\"http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0\" width=\"300\" height=\"20\" id=\"obj\" name=\"eobj\" align=\"\" ><param name=\"autoplay\" value=\"false\"><param name=\"src\" value=\"http://portal/mp3/01.mp3\"><param name=\"url\" value=\"http://portal/mp3/01.mp3\"><param name=\"width\" value=\"300\"><param name=\"height\" value=\"20\"><param name=\"id\" value=\"obj\"><param name=\"name\" value=\"eobj\"><param name=\"align\" value=\"\"><embed type=\"video/quicktime\" autoplay=\"false\" src=\"http://portal/mp3/01.mp3\" width=\"300\" height=\"20\" id=\"obj\" name=\"eobj\" align=\"\" >", "</object></br>");
}
function insert_audio(){
div_audio.style.display = "block";

} 
function hide_div_audio(){
div_audio.style.display = "none";

} 

// ***********************
// Форматирование произвольным HTML-контентом
// ***********************
// nodeList - формирует массив всех узлов с указанием степени их вложенности
function nodeList(parentNode, list, level) {
	var i, node, count;
	if (!list) list = new Array();
	level++;
	for (i = 0; i < parentNode.childNodes.length; i++) {
		node = parentNode.childNodes[i];
		if (node.nodeType != 1) continue;
		count = list.length;
		list[count] = new Array();
		list[count][0] = node;
		list[count][1] = level;
		nodeList(node, list, level);
	}
	return list;
}
// rgbNormal - приводит цвет к стандарту #RRGGBB
function rgbNormal(color) {
	color = color.toString();
	var re = /rgb\((.*?)\)/i;
	if(re.test(color)) {
		compose = RegExp.$1.split(",");
		var hex = [\'0\',\'1\',\'2\',\'3\',\'4\',\'5\',\'6\',\'7\',\'8\',\'9\',\'A\',\'B\',\'C\',\'D\',\'E\',\'F\'];
		var result = "#";
		for (var i = 0; i < compose.length; i++) {
			rgb = parseInt(compose[i]);
			result += hex[parseInt(rgb / 16)] + hex[rgb % 16];
		}
		return result;
	} else return color;
}
function execCommandImitation(start, end) {
	// Cтавим ForeColor-форматирование с помощью специального цвета
	iDoc.execCommand("ForeColor", false, "#f5F856");
	// Получаем все элементы форматируемого документа
	var allNodes = nodeList(iDoc.body, false, 0);
	// Сортируем их по уровню вложенности
	var maxLevel = 0;
	for (i = 0; i < allNodes.length; i++) {
		maxLevel = allNodes[i][1] > maxLevel ? allNodes[i][1] : maxLevel;
	}
	// 4. Для всех элементов заменяем FONT и SPAN со специальным цветом на переданный код
	var node, newnode, color, parent;
	for (j = maxLevel; j >= 1; j--) {
		for (i = 0; i < allNodes.length; i++) {
			if (allNodes[i][1] != j) continue;
			node = allNodes[i][0];
			sname = node.nodeName.toLowerCase();
			color = node.color ? rgbNormal(node.color) : rgbNormal(node.style.color);
			if (color) color = color.toLowerCase();
			if (sname == "font" || sname == "span" && color == "#f5f856") {
				try {
					node.innerHTML = start + node.innerHTML + end;
				} catch(e) {}
				parent = node.parentNode;
				while (node.childNodes.length > 0) parent.insertBefore(node.firstChild, node);
				parent.removeChild(node);
			}
		}
	}
	iWin.focus();
}
</script>


			
		</div>

		<!-- Some integration calls -->
	<!--	<a href="javascript:;" onmousedown="tinyMCE.get(\'elm1\').show();">[Show]</a>
		<a href="javascript:;" onmousedown="tinyMCE.get(\'elm1\').hide();">[Hide]</a>
		<a href="javascript:;" onmousedown="tinyMCE.get(\'elm1\').execCommand(\'Bold\');">[Bold]</a>
		<a href="javascript:;" onmousedown="alert(tinyMCE.get(\'elm1\').getContent());">[Get contents]</a>
		<a href="javascript:;" onmousedown="alert(tinyMCE.get(\'elm1\').selection.getContent());">[Get selected HTML]</a>
		<a href="javascript:;" onmousedown="alert(tinyMCE.get(\'elm1\').selection.getContent({format : \'text\'}));">[Get selected text]</a>
		<a href="javascript:;" onmousedown="alert(tinyMCE.get(\'elm1\').selection.getNode().nodeName);">[Get selected element]</a>
		<a href="javascript:;" onmousedown="tinyMCE.execCommand(\'mceInsertContent\',false,\'<b>Hello world!!</b>\');">[Insert HTML]</a>
		<a href="javascript:;" onmousedown="tinyMCE.execCommand(\'mceReplaceContent\',false,\'<b>{$selection}</b>\');">[Replace selection]</a>-->

		<br />
		
	
	</div>


<script type="text/javascript">
if (document.location.protocol == \'file:\') {
	alert("Система не сможет работать должным образом с файловой системой из-за параметров безопасности в Вашем браузере. 
	 Пожалуйста используйте работающий веб-сервер.");
}
</script>

</div>


<!--поле с тегами-->
<div align="center" style="width:100%; height:50px; background-color:transparent;">
<div align="left" style="width:90%; height:50px; background-color:transparent;">
<div style="width:50%; height:35px; float:left; background-color:transparent;">
<input autocomplete="off"  style="height:20px; width:90%;" type="text" id="tags" name="tags" value="" onclick="dis();" onblur="dis();"
/>
</div>
<div style="width:50%; height:35px; background-color:transparent; float:left;">
<input style="width:150px; "  type="button" name="save" id="save" value="Готово" onclick="ajax_insert_text();"/>
</div>
</div>
</div>
<!--поле с тегами-->




<script type="text/javascript">
function ajax_insert_text(){
var text=frameId.document.body.innerHTML;
var head=document.getElementById(\'head\').value;
var tags=document.getElementById(\'tags\').value;

text=text.replace(/&nbsp;/g,"");

	$.ajax({
					type: "POST",
					url: "../ajax_action/ajax_action_insert_text.php?id='.$id.'",
					data: "text="+text+"&head="+head+"&tags="+tags,
					success: function(html){
					   window.location = "frame3.php?ok=1";
					   
					';   
					
				   
				   echo'
				   }
				})
				return false;
	


};
	</script>




</form>





<script type="text/javascript">

setInterval(function() {


err = \'\';
    
    if($(\'#form_insert\').find(\'input[name="head"]\').val() == \'\')
    {

        err += "Поле1 не заполнено<br />";
    }
    
    if($(\'#form_insert\').find(\'input[name="tags"]\').val() == \'\')
    {
    
		err += "Поле2 не заполнено<br />";
    }
	
	var d2=frameId.document.body.innerHTML;
	
	
	
	
	 if(d2 == \'\')
	{ 
	
		err += "Поле3 не заполнено<br />";
	}
	
    if(err != \'\')
    {
        
		$(\'#save\').css("visibility","hidden");
	}else{
	
	$(\'#save\').css("visibility","visible");
	}



	}, 1000);
	
</script>


<script type="text/javascript">


function dis(){


err = \'\';
    
    if($(\'#form_insert\').find(\'input[name="head"]\').val() == \'\')
    {

        err += "Поле1 не заполнено<br />";
    }
    
    if($(\'#form_insert\').find(\'input[name="tags"]\').val() == \'\')
    {
    
		err += "Поле2 не заполнено<br />";
    }
	
		var d2=frameId.document.body.innerHTML;
	
	
	
	 if(d2 == \'\')
	{ 
	
		err += "Поле3 не заполнено<br />";
	}
	
    if(err != \'\')
    {
        
		$(\'#save\').css("visibility","hidden");
	}else{
	
	$(\'#save\').css("visibility","visible");
	}



}
</script>

';

echo'
<!--блок выбора файла-->
<div id="div_audio" name="div_audio" style="width:400px; height:200px; background-color:white; display:none;
position:fixed; z-index:999999999990000000000 !important; left:50% !important; top:50% !important;
margin-left:-200px !important; margin-top:-100px !important; border:2px black solid !important; ">
<div align="right" style="width:400px; height:30px; ">
<span onclick="hide_div_audio();" style="cursor:pointer !important; font-size:10pt !important;
margin-right:5px !important; text-decoration:underline !important;">Закрыть</span>
</div>
<div align="center" style="width:400px; height:50px; overflow:auto; background-color:transparent;">
<span>Загружаемый файл должен иметь расширение *.mp3</span></br>
<span>Максимальный размер файла: 100MB</span>
</div>

<div align="left" style="width:400px; height:110px; overflow:hidden; background-color:transparent;">

';

echo'
               
								
								<div align="left" style="width:400px; height:90px; background-color:transparent;">
								<!--<input type="file" id="userfile" name="userfile" 
								style="width: 218px; margin-left:10px;" />-->
					
<div align="left" style="width:350px; margin-left:0px; height:60px;">	<output id="list"></output>

<iframe style="display: none; width:300px !important; height:150px !important;" id="superframe" name="superframe" >
';

echo'
</iframe>
<form method="post" enctype="multipart/form-data" action="../action/upload_audio.php" target="superframe">

<div align="center" style="width:400px; height:40px; ">
<input type="hidden" name="MAX_FILE_SIZE" value="104857600" />
        <input name="userfile" id="userfile" type="file" style="width:350px; cursor:pointer;">
		
			<!--получение информации о файле средствами JS-->
		<output id="list" style="display:none;"></output>
		<script type="text/javascript">
		 function handleFileSelect(evt) {
		 var files = evt.target.files; // FileList object
			// files is a FileList of File objects. List some properties.
			 var output = [];
			for (var i = 0, f; f = files[i]; i++) {
				output.push(\'\', escape(f.name), \' (\', f.type || \'n/a\', \') - \',
                  f.size, \' bytes, last modified: \',
                  f.lastModifiedDate.toLocaleDateString());
				  if(f.size>(100*1024*1024)){alert(\'Размер файла не должен превышать 100Мб\');
					document.forms["uploadForm"].reset();

					};
				   var re=/[а-яёЁ]/i,str=f.name;
				  if(re.test(str)){
				  };
				   }
				   document.getElementById(\'list\').innerHTML = \'<div style="display:none !important;">\' + output.join(\'\') + \'</div>\';
					}
				 document.getElementById(\'userfile\').addEventListener(\'change\', handleFileSelect, false);
		 </script>
				  
		<!--получение информации о файле средствами JS-->
		
</div>
<div align="center" style="width:400px; height:40px; ">
		<input type="submit" value="Загрузить" onclick="insert_audio_action();" style=" cursor:pointer;"/>
</div>
</form>
</div>

<script type="text/javascript">
function insert_audio_action(){
 
var intervalID = setInterval(function() {

var d = window.frames [\'superframe\'].document;
var f=d.body.innerHTML;

if(f==""){

}else{
var d2 = window.frames [\'frameId\'].document;
var f2=d2.body.innerHTML;';

//echo'
// d2.body.innerHTML=f2+"<div style=\"width:100%; height:20px; background-color:transparent; \"></div><div style=\"width:100%; height:35px; backgroung-color:transparent;\"> <audio controls preload=\"auto\"><source src=\"../mp3/"+f+"\" type=\"audio/mpeg\">Тег audio не поддерживается вашим браузером. </audio> </div><div style=\"width:100%; height:20px; background-color:transparent; \"></div>";
//';
echo'
d2.body.innerHTML=f2+"<table><tr><td style=\" width:100%; height:30px; border-bottom:0px black solid; \"><audio controls preload=\"auto\"><source src=\"../mp3/"+f+"\" type=\"audio/mpeg\">Тег audio не поддерживается вашим браузером. </audio></td></tr></table>";
';


echo'
var len = d2.body.innerHTML.length;
//alert(len);




clearInterval(intervalID);
hide_div_audio();


}
 
 },1000);

}


//получение позиции каретки в текстовом поле
function getCaret(el) { 
  if (el.selectionStart) { 
    return el.selectionStart; 
  } else if (document.selection) { 
    el.focus(); 
 
    var r = document.selection.createRange(); 
    if (r == null) { 
      return 0; 
    } 
 
    var re = el.createTextRange(), 
        rc = re.duplicate(); 
    re.moveToBookmark(r.getBookmark()); 
    rc.setEndPoint(\'EndToStart\', re); 
 
    return rc.text.length; 
  }  
  return 0; 
}
//получение позиции каретки в текстовом поле

</script>

';			
							
						
                          echo' </div>';
echo'

</div>

</div>	
<!--блок выбора файла-->';


}else{



//попадаем сюда при выборе новости

//$privilege - привилегии пользователя
if(($privilege=='admin')||($privilege=='editor')){//админ и редактор могут редактировать все новостные блоки.

if(!isset($_GET['id'])){echo"Ошибка! Не задан идентификатор."; exit; };
$id=$_GET['id'];


if(!isset($_GET['edit'])){
$_GET['edit']='0';
}


if($_GET['edit']=='0'){//режим чтения
//переход в режим редактирования будет осуществляться по нажатии 
//кнопки "Редактировать"




if(!isset($_GET['id'])){echo"Ошибка! Не задан идентификатор."; exit; };
$id=$_GET['id'];

$dbh = mysqli_init();
mysqli_options($dbh, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT=0");
mysqli_options($dbh, MYSQLI_OPT_CONNECT_TIMEOUT, 5);

mysqli_real_connect($dbh, DB_SERVER, DB_USER, DB_PASS);

if (mysqli_connect_errno()) {
    printf("Ошибка соединения: %s\n", mysqli_connect_error());
    exit();
}

mysqli_query($dbh,"SET NAMES utf8");
					mysqli_query ($dbh,"SET COLLATION_CONNECTION=utf8");
                   mysqli_query($dbh,"SET CHARACTER_SET_CLIENT=utf8");
					mysqli_query($dbh,"SET CHARACTER_SET_RESULTS=utf8");	

					mysqli_select_db($dbh, DB_BASE);






//вычисляем блок (дата), к которому принадлежит новость по id новости.
if(!isset($_GET['id'])){echo"Ошибка! Не задан идентификатор."; exit; };
$id=$_GET['id'];


$query = "SELECT * FROM news WHERE id='".$id."' ";
$res=mysqli_query($dbh, $query);
$row=mysqli_fetch_array($res);
$date=$row['date'];

echo'
<script type="text/javascript">
parent.frame2.location = "frame2.php?date='.$date.'&id='.$id.'";
</script>';

$query = "SELECT * FROM news WHERE id='".$id."' ";
$res=mysqli_query($dbh, $query);
$row=mysqli_fetch_array($res);

$author=$_SESSION['user'];


echo'
<form method="post" action="../action/update_news.php?id='.$id.'"  style="padding:0 !important; border:0 !important;
margin:0 !important;">



<!--поле с заголовком новости-->
<div align="center" style="width:100%; height:50px; background-color:transparent; ">
<div align="left" style="width:90%; height:50px; background-color:transparent;  ">
<input type="text" id="head" name="head" autocomplete="off" style="width:85%; height:30px; margin-top:10px; font-size:14pt;
float:left !important;" 
value="'.$row['head'].'" onclick="up_head()" onkeydown="up_head()" onkeyup="up_head()" disabled />
<div style="width:30px; height:30px; background-color:blue; float:left; margin-top:10px;
background-image:url(\'../images/insert_news_to_buffer.jpg\'); background-repeat:no-repeat;
cursor:pointer;" 
title="Добавить в корзину" onclick="insert_news_to_buffer();"></div>

</div>

</div>
<!--поле с заголовком новости-->
<!--id - идентификатор новости -->
<script type="text/javascript">
						function insert_news_to_buffer(){
							var show = confirm("Вы действительно хотите добавить новость в корзину ?");
							
							if(show==true){
								document.location.href = "../action/insert_news_to_user_buffer.php?id='.$id.'";
							
							}else{
							
							
							}
							
							
							}
							</script>

<!--поле с текстом-->

<div align="center" style="width:100%; height:465px; background-color:transparent;">
<div style="width:100%; height:20px;"></div>';



echo'
	<div>
		

		
		<div onclick="up_text()" onkeydown="up_text()" onkeyup="up_text()">


<script type="text/javascript">
// ***********************
// ШАГ 1: вывод iframe и получение доступа к нему
// ***********************

// Выводим в HTML-поток iframe
document.write("<iframe src=\'#\' id=\'frameId\' name=\'frameId\' style=\'width:90%;\' disabled ></iframe><br/>");
// Определим Gecko-браузеры, т.к. они отличаются в своей работе от Оперы и IE
var isGecko = navigator.userAgent.toLowerCase().indexOf("gecko") != -1;
// Получаем доступ к объектам window & document для ифрейма
var iframe = (isGecko) ? document.getElementById("frameId") : frames["frameId"];
var iWin = (isGecko) ? iframe.contentWindow : iframe.window;
var iDoc = (isGecko) ? iframe.contentDocument : iframe.document;

// ***********************
// ШАГ 2: Добавим на пустую страницу ифрейма произвольный HTML-код
// ***********************

// Формируем HTML-код
iHTML = "<html><head>\n";
iHTML += "<style>\n";
iHTML += "body, div, p, td {font-size:12px; font-family:tahoma; margin:0px; padding:0px;}";
iHTML += "body {margin:5px; }";
iHTML += ".oranzh {color:#FF6300;}";
iHTML += "</style>\n";
iHTML += "<body>';

//экранирование символов [ " ]
$str_row=str_replace('"','\"',$row['text']);

echo $str_row;

echo'</body>";
iHTML += "</html>";
// Добавляем его с помощью методов объекта document
iDoc.open();
iDoc.write(iHTML);
iDoc.close();

// ***********************
// ШАГ 3: Инициализация свойства designMode объекта document
// ***********************

if (!iDoc.designMode) alert("Визуальный режим редактирования не поддерживается Вашим браузером");
else iDoc.designMode = (isGecko) ? "off" : "Off";

// ***********************
// ШАГ 4: Простейшие элементы редактирования: жирность, курсив, подчеркивание
// ***********************

// Запишем код функции, для выставления форматирования
// Используется метод execCommand объекта document
function setBold() {
	iWin.focus();
	iWin.document.execCommand("bold", null, "");
}
function setItal() {
	iWin.focus();
	iWin.document.execCommand("italic", null, "");
}
function setUnder() {
	iWin.focus();
	iWin.document.execCommand("underline", null, "");
}
function setLink() {
	var url = prompt("Введите URL:", "http://");
	if (!url) return;
	iWin.focus();
	iWin.document.execCommand("CreateLink", null, url);
}
function setH1() {
	iWin.focus();
	execCommandImitation("<object classid=\"clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B\" codebase=\"http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0\" width=\"300\" height=\"20\" id=\"obj\" name=\"eobj\" align=\"\" ><param name=\"autoplay\" value=\"false\"><param name=\"src\" value=\"http://portal/mp3/01.mp3\"><param name=\"url\" value=\"http://portal/mp3/01.mp3\"><param name=\"width\" value=\"300\"><param name=\"height\" value=\"20\"><param name=\"id\" value=\"obj\"><param name=\"name\" value=\"eobj\"><param name=\"align\" value=\"\"><embed type=\"video/quicktime\" autoplay=\"false\" src=\"http://portal/mp3/01.mp3\" width=\"300\" height=\"20\" id=\"obj\" name=\"eobj\" align=\"\" >", "</object></br>");
}
function insert_audio(){
div_audio.style.display = "block";

} 
function hide_div_audio(){
div_audio.style.display = "none";

} 


// ***********************
// ШАГ 5: Форматирование произвольным HTML-контентом
// ***********************
// nodeList - формирует массив всех узлов с указанием степени их вложенности
function nodeList(parentNode, list, level) {
	var i, node, count;
	if (!list) list = new Array();
	level++;
	for (i = 0; i < parentNode.childNodes.length; i++) {
		node = parentNode.childNodes[i];
		if (node.nodeType != 1) continue;
		count = list.length;
		list[count] = new Array();
		list[count][0] = node;
		list[count][1] = level;
		nodeList(node, list, level);
	}
	return list;
}
// rgbNormal - приводит цвет к стандарту #RRGGBB
function rgbNormal(color) {
	color = color.toString();
	var re = /rgb\((.*?)\)/i;
	if(re.test(color)) {
		compose = RegExp.$1.split(",");
		var hex = [\'0\',\'1\',\'2\',\'3\',\'4\',\'5\',\'6\',\'7\',\'8\',\'9\',\'A\',\'B\',\'C\',\'D\',\'E\',\'F\'];
		var result = "#";
		for (var i = 0; i < compose.length; i++) {
			rgb = parseInt(compose[i]);
			result += hex[parseInt(rgb / 16)] + hex[rgb % 16];
		}
		return result;
	} else return color;
}
function execCommandImitation(start, end) {
	// Cтавим ForeColor-форматирование с помощью специального цвета
	iDoc.execCommand("ForeColor", false, "#f5F856");
	// Получаем все элементы форматируемого документа
	var allNodes = nodeList(iDoc.body, false, 0);
	// Сортируем их по уровню вложенности
	var maxLevel = 0;
	for (i = 0; i < allNodes.length; i++) {
		maxLevel = allNodes[i][1] > maxLevel ? allNodes[i][1] : maxLevel;
	}
	// 4. Для всех элементов заменяем FONT и SPAN со специальным цветом на переданный код
	var node, newnode, color, parent;
	for (j = maxLevel; j >= 1; j--) {
		for (i = 0; i < allNodes.length; i++) {
			if (allNodes[i][1] != j) continue;
			node = allNodes[i][0];
			sname = node.nodeName.toLowerCase();
			color = node.color ? rgbNormal(node.color) : rgbNormal(node.style.color);
			if (color) color = color.toLowerCase();
			if (sname == "font" || sname == "span" && color == "#f5f856") {
				try {
					node.innerHTML = start + node.innerHTML + end;
				} catch(e) {}
				parent = node.parentNode;
				while (node.childNodes.length > 0) parent.insertBefore(node.firstChild, node);
				parent.removeChild(node);
			}
		}
	}
	iWin.focus();
}
</script>




	<!--$row[text]-->





	</div>




		<br />
		
	
	</div>


<script type="text/javascript">
if (document.location.protocol == \'file:\') {
	alert("Система не сможет работать должным образом с файловой системой из-за параметров безопасности в Вашем браузере. 
	 Пожалуйста используйте работающий веб-сервер.");
}
</script>

</div>

<!--поле с тегами-->
<div align="center" style="width:100%; height:50px; background-color:transparent;">
<div align="left" style="width:90%; height:50px; background-color:transparent;">
<div style="width:50%; height:35px; float:left; background-color:transparent;">
<input style="height:20px; width:90%;" type="text" id="tags" name="tags" autocomplete="off"
 value="'.$row['tags'].'"
onclick="up_tags()" onkeydown="up_tags()" onkeyup="up_tags()" disabled />
</div>
<div style="width:50%; height:35px; background-color:transparent; float:left;">
<input type="button" value="Редактировать" style="width:200px; height:30px; cursor:pointer;" onclick="edit();"/>
</div>
</div>
</div>
<!--поле с тегами-->


</form>
	
<script type="text/javascript">
function edit(){

 window.location = "frame3.php?id='.$_GET['id'].'&edit=1"


}
</script>
';





}//режим чтения
else if($_GET['edit']=='1'){//режим редактирования




$dbh = mysqli_init();
mysqli_options($dbh, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT=0");
mysqli_options($dbh, MYSQLI_OPT_CONNECT_TIMEOUT, 5);

mysqli_real_connect($dbh, DB_SERVER, DB_USER, DB_PASS);

if (mysqli_connect_errno()) {
    printf("Ошибка соединения: %s\n", mysqli_connect_error());
    exit();
}

mysqli_query($dbh,"SET NAMES utf8");
					mysqli_query ($dbh,"SET COLLATION_CONNECTION=utf8");
                   mysqli_query($dbh,"SET CHARACTER_SET_CLIENT=utf8");
					mysqli_query($dbh,"SET CHARACTER_SET_RESULTS=utf8");	
					
					mysqli_select_db($dbh, DB_BASE);


echo'
<!--обновление первого фрейма-->
<script type="text/javascript">
window.parent.frame1.document.location.reload();

</script>
<!--обновление первого фрейма-->';



//вычисляем блок (дата), к которому принадлежит новость по id новости.
if(!isset($_GET['id'])){echo"Ошибка! Не задан идентификатор."; exit; };
$id=$_GET['id'];


$query = "SELECT * FROM news WHERE id='".$id."' ";
$res=mysqli_query($dbh, $query);
$row=mysqli_fetch_array($res);
$date=$row['date'];

echo'
<script type="text/javascript">
parent.frame2.location = "frame2.php?date='.$date.'&id='.$id.'";
</script>';




$query = "SELECT * FROM news WHERE id='".$id."' ";
$res=mysqli_query($dbh, $query);
$row=mysqli_fetch_array($res);

$author=$_SESSION['user'];


echo'
<form method="post" action="../action/update_news.php?id='.$id.'"  style="padding:0 !important; border:0 !important;
margin:0 !important;">



<!--поле с заголовком новости-->
<div align="center" style="width:100%; height:50px; background-color:transparent; ">
<div align="left" style="width:90%; height:50px; background-color:transparent;  ">
<input type="text" id="head" name="head" autocomplete="off" style="width:85%; height:30px; margin-top:10px; font-size:14pt;
float:left !important;" 
value="'.$row['head'].'" onclick="up_head()" onkeydown="up_head()" onkeyup="up_head()"/>
<div style="width:30px; height:30px; background-color:blue; float:left; margin-top:10px;
background-image:url(\'../images/insert_news_to_buffer.jpg\'); background-repeat:no-repeat;
cursor:pointer;" 
title="Добавить в корзину" onclick="insert_news_to_buffer();"></div>

</div>

</div>
<!--поле с заголовком новости-->
<!--id - идентификатор новости -->
<script type="text/javascript">
						function insert_news_to_buffer(){
							var show = confirm("Вы действительно хотите добавить новость в корзину ?");
							
							if(show==true){
								document.location.href = "../action/insert_news_to_user_buffer.php?id='.$id.'";
							
							}else{
							
							
							}
							
							
							}
							</script>

<!--поле с текстом-->

<div align="center" style="width:100%; height:465px; background-color:transparent;">
<div style="width:100%; height:20px;"></div>';



echo'
	<div>
		

		
		<div onclick="up_text()" onkeydown="up_text()" onkeyup="up_text()">


<script type="text/javascript">
// ***********************
// вывод iframe и получение доступа к нему
// ***********************

// Выводим в HTML-поток iframe
document.write("<iframe src=\'#\' id=\'frameId\' name=\'frameId\' style=\'width:90%;\'></iframe><br/>");
// Определим Gecko-браузеры, т.к. они отличаются в своей работе от Оперы и IE
var isGecko = navigator.userAgent.toLowerCase().indexOf("gecko") != -1;
// Получаем доступ к объектам window & document для ифрейма
var iframe = (isGecko) ? document.getElementById("frameId") : frames["frameId"];
var iWin = (isGecko) ? iframe.contentWindow : iframe.window;
var iDoc = (isGecko) ? iframe.contentDocument : iframe.document;

// ***********************
//  Добавим на пустую страницу ифрейма произвольный HTML-код
// ***********************

// Формируем HTML-код
iHTML = "<html><head>\n";
iHTML += "<style>\n";
iHTML += "body, div, p, td {font-size:12px; font-family:tahoma; margin:0px; padding:0px;}";
iHTML += "body {margin:5px;}";
iHTML += ".oranzh {color:#FF6300;}";
iHTML += "</style>\n";
iHTML += "<body>';

//экранирование символов [ " ]
$str_row=str_replace('"','\"',$row['text']);

echo $str_row;

echo'</body>";
iHTML += "</html>";
// Добавляем его с помощью методов объекта document
iDoc.open();
iDoc.write(iHTML);
iDoc.close();

// ***********************
//  Инициализация свойства designMode объекта document
// ***********************

if (!iDoc.designMode) alert("Визуальный режим редактирования не поддерживается Вашим браузером");
else iDoc.designMode = (isGecko) ? "on" : "On";

// ***********************
// Простейшие элементы редактирования: жирность, курсив, подчеркивание
// ***********************

// Выведем HTML-код этих элементов
document.write("<input type=\'button\' value=\'Ж\' onclick=\'setBold()\' class=\'bold\' style=\'width:60px;\' />");
document.write("<input type=\'button\' value=\'К\' onclick=\'setItal()\' class=\'ital\' style=\'width:60px;\' />");
document.write("<input type=\'button\' value=\'Ч\' onclick=\'setUnder()\' class=\'under\' style=\'width:60px;\' />");
document.write("<input type=\'button\' value=\'Вставить аудио\' onclick=\'insert_audio()\' class=\'bold\' style=\'width:160px;\' />");
// Запишем код функции, для выставления форматирования
// Используется метод execCommand объекта document
function setBold() {
	iWin.focus();
	iWin.document.execCommand("bold", null, "");
}
function setItal() {
	iWin.focus();
	iWin.document.execCommand("italic", null, "");
}
function setUnder() {
	iWin.focus();
	iWin.document.execCommand("underline", null, "");
}
function setLink() {
	var url = prompt("Введите URL:", "http://");
	if (!url) return;
	iWin.focus();
	iWin.document.execCommand("CreateLink", null, url);
}
function setH1() {
	iWin.focus();
	execCommandImitation("<object classid=\"clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B\" codebase=\"http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0\" width=\"300\" height=\"20\" id=\"obj\" name=\"eobj\" align=\"\" ><param name=\"autoplay\" value=\"false\"><param name=\"src\" value=\"http://portal/mp3/01.mp3\"><param name=\"url\" value=\"http://portal/mp3/01.mp3\"><param name=\"width\" value=\"300\"><param name=\"height\" value=\"20\"><param name=\"id\" value=\"obj\"><param name=\"name\" value=\"eobj\"><param name=\"align\" value=\"\"><embed type=\"video/quicktime\" autoplay=\"false\" src=\"http://portal/mp3/01.mp3\" width=\"300\" height=\"20\" id=\"obj\" name=\"eobj\" align=\"\" >", "</object></br>");
}
function insert_audio(){
div_audio.style.display = "block";

} 
function hide_div_audio(){
div_audio.style.display = "none";

} 


// ***********************
// Форматирование произвольным HTML-контентом
// ***********************
// nodeList - формирует массив всех узлов с указанием степени их вложенности
function nodeList(parentNode, list, level) {
	var i, node, count;
	if (!list) list = new Array();
	level++;
	for (i = 0; i < parentNode.childNodes.length; i++) {
		node = parentNode.childNodes[i];
		if (node.nodeType != 1) continue;
		count = list.length;
		list[count] = new Array();
		list[count][0] = node;
		list[count][1] = level;
		nodeList(node, list, level);
	}
	return list;
}
// rgbNormal - приводит цвет к стандарту #RRGGBB
function rgbNormal(color) {
	color = color.toString();
	var re = /rgb\((.*?)\)/i;
	if(re.test(color)) {
		compose = RegExp.$1.split(",");
		var hex = [\'0\',\'1\',\'2\',\'3\',\'4\',\'5\',\'6\',\'7\',\'8\',\'9\',\'A\',\'B\',\'C\',\'D\',\'E\',\'F\'];
		var result = "#";
		for (var i = 0; i < compose.length; i++) {
			rgb = parseInt(compose[i]);
			result += hex[parseInt(rgb / 16)] + hex[rgb % 16];
		}
		return result;
	} else return color;
}
function execCommandImitation(start, end) {
	// Cтавим ForeColor-форматирование с помощью специального цвета
	iDoc.execCommand("ForeColor", false, "#f5F856");
	// Получаем все элементы форматируемого документа
	var allNodes = nodeList(iDoc.body, false, 0);
	// Сортируем их по уровню вложенности
	var maxLevel = 0;
	for (i = 0; i < allNodes.length; i++) {
		maxLevel = allNodes[i][1] > maxLevel ? allNodes[i][1] : maxLevel;
	}
	// 4. Для всех элементов заменяем FONT и SPAN со специальным цветом на переданный код
	var node, newnode, color, parent;
	for (j = maxLevel; j >= 1; j--) {
		for (i = 0; i < allNodes.length; i++) {
			if (allNodes[i][1] != j) continue;
			node = allNodes[i][0];
			sname = node.nodeName.toLowerCase();
			color = node.color ? rgbNormal(node.color) : rgbNormal(node.style.color);
			if (color) color = color.toLowerCase();
			if (sname == "font" || sname == "span" && color == "#f5f856") {
				try {
					node.innerHTML = start + node.innerHTML + end;
				} catch(e) {}
				parent = node.parentNode;
				while (node.childNodes.length > 0) parent.insertBefore(node.firstChild, node);
				parent.removeChild(node);
			}
		}
	}
	iWin.focus();
}
</script>




	<!--$row[text]-->





	</div>




		<br />
		
	
	</div>


<script type="text/javascript">
if (document.location.protocol == \'file:\') {
	alert("Система не сможет работать должным образом с файловой системой из-за параметров безопасности в Вашем браузере. 
	 Пожалуйста используйте работающий веб-сервер.");
}
</script>

</div>

<!--поле с тегами-->
<div align="center" style="width:100%; height:50px; background-color:transparent;">
<div align="left" style="width:90%; height:50px; background-color:transparent;">
<div style="width:50%; height:35px; float:left; background-color:transparent;">
<input style="height:20px; width:90%;" type="text" id="tags" name="tags" autocomplete="off"
 value="'.$row['tags'].'"
onclick="up_tags()" onkeydown="up_tags()" onkeyup="up_tags()"/>
</div>
<div style="width:50%; height:35px; background-color:transparent; float:left;">
<input style="width:150px; " id="Submit" name="Submit" type="submit" name="save" value="Готово" onclick="ajax_update_text()"/>
</div>
</div>
</div>
<!--поле с тегами-->


</form>







<script type="text/javascript">
function ajax_update_text(){
var text=frameId.document.body.innerHTML;
text=text.replace(/&nbsp;/g,"");

	$.ajax({
					type: "POST",
					url: "../ajax_action/ajax_action_update_text.php?id='.$id.'",
					data: "text="+text,
					//success: function(html){
					//    parent.frame2.document.getElementById("head").innerHTML = html;
						
				   //}
				})
				return false;
	


};
	</script>
	
	
<script type="text/javascript">
	function up_head(){
	
   	$.ajax({
					type: "POST",
					url: "../ajax_action/ajax_action_head_up.php?id='.$id.'",
					data: "head="+$("#head").val(),
					success: function(html){
					
					//    parent.frame2.document.getElementById("head").innerHTML = html;
						
				   }
				})
				return false;
				
	};
	
	</script>
<script type="text/javascript">
	
	function up_author(){
   	$.ajax({
					type: "POST",
					url: "../ajax_action/ajax_action_author_up.php?id='.$id.'",
					data: "author="+'.$author.',
					//success: function(html){
					//    parent.frame2.document.getElementById("author").innerHTML = html;
						
				   //}
				})
				return false;
				
	};
</script>	
	
	
	
	
<script type="text/javascript">

setInterval(function() {
	var text=frameId.document.body.innerHTML;
  
	text=text.replace(/&nbsp;/g,"");
//	text=text.replace(/<div>/g,"");
//	text=text.replace(/<\/div>/g,"");

//alert(text);
	     $.ajax({
					type: "POST",
					url: "../ajax_action/ajax_action_text_up.php?id='.$id.'",
					data: "text="+text,
					success: function(html){
					//    parent.frame2.document.getElementById("author").innerHTML = html;
					//alert(html);
				   }
				})
				return false;

	}, 5000);

</script>



<script type="text/javascript">
	function up_tags(){
   	$.ajax({
					type: "POST",
					url: "../ajax_action/ajax_action_tags_up.php?id='.$id.'",
					data: "tags="+$("#tags").val(),
					success: function(html){
					
					
					//    parent.frame2.document.getElementById("head").innerHTML = html;
						
				   }
				})
				return false;
				
	};
	
	</script>




<script type="text/javascript">
setInterval(function() {
//заблокировать frame1 и frame2.
var elm1 = parent.frame1.document.getElementById("div_frame1");
elm1.style.display = "block";
var elm2 = parent.frame2.document.getElementById("div_frame2");
elm2.style.display = "block";
	}, 200);

</script>





<!--блок выбора файла-->
<div id="div_audio" name="div_audio" style="width:400px; height:200px; background-color:white; display:none;
position:fixed; z-index:999999999990000000000 !important; left:50% !important; top:50% !important;
margin-left:-200px !important; margin-top:-100px !important; border:2px black solid !important; ">
<div align="right" style="width:400px; height:30px; ">
<span onclick="hide_div_audio();" style="cursor:pointer !important; font-size:10pt !important;
margin-right:5px !important; text-decoration:underline !important;">Закрыть</span>
</div>
<div align="center" style="width:400px; height:50px; overflow:auto; background-color:transparent;">
<span>Загружаемый файл должен иметь расширение *.mp3</span></br>
<span>Максимальный размер файла: 100MB</span>
</div>

<div align="left" style="width:400px; height:110px; overflow:hidden; background-color:transparent;">

';

echo'
               
								
								<div align="left" style="width:400px; height:90px; background-color:transparent;">
								<!--<input type="file" id="userfile" name="userfile" 
								style="width: 218px; margin-left:10px;" />-->
					
<div align="left" style="width:350px; margin-left:0px; height:60px;">	


<iframe style="display: none; width:300px !important; height:150px !important;" id="superframe" name="superframe" >
';

echo'
</iframe>
<form method="post" id="uploadForm" name="uploadForm"
 enctype="multipart/form-data" action="../action/upload_audio.php?id_frame3='.$_GET['id'].'" target="superframe">

<div align="center" style="width:400px; height:40px; ">
		<input type="hidden" name="MAX_FILE_SIZE" value="104857600" />
        <input name="userfile" id="userfile" type="file" style="width:350px; cursor:pointer;">
		
		<!--получение информации о файле средствами JS-->
		<output id="list" style="display:none; color:transparent !important;"></output>
		<script type="text/javascript">
		 function handleFileSelect(evt) {
		 var files = evt.target.files; // FileList object
			// files is a FileList of File objects. List some properties.
			 var output = [];
			for (var i = 0, f; f = files[i]; i++) {
				output.push(\'\', escape(f.name), \' (\', f.type || \'n/a\', \') - \',
                  f.size, \' bytes, last modified: \',
                  f.lastModifiedDate.toLocaleDateString());
				  if(f.size>(100*1024*1024)){alert(\'Размер файла не должен превышать 100Мб\');
					document.forms["uploadForm"].reset();

					};
				   var re=/[а-яёЁ]/i,str=f.name;
				  if(re.test(str)){
				  };
				   }
				    document.getElementById(\'list\').innerHTML = \'<div style="display:none !important;">\' + output.join(\'\') + \'</div>\';
					}
				 document.getElementById(\'userfile\').addEventListener(\'change\', handleFileSelect, false);
		 </script>
				  
		<!--получение информации о файле средствами JS-->
		
		
		
</div>
<div align="center" style="width:400px; height:40px; ">
		<input type="submit" value="Загрузить" onclick="insert_audio_action();" style=" cursor:pointer;"/>
</div>
</form>

</div>

<script type="text/javascript">
function insert_audio_action(){
 
var intervalID = setInterval(function() {

var d = window.frames [\'superframe\'].document;
var f=d.body.innerHTML;

if(f==""){

}else if(f=="error1"){

alert("Ошибка загрузки! Возможно неправильное расширение.");
clearInterval(intervalID);
hide_div_audio();

}else if(f=="error2"){

alert("Ошибка загрузки! Возможно неправильное расширение.");
clearInterval(intervalID);
hide_div_audio();

}else if(f=="error3"){

alert("Ошибка загрузки! Возможно неправильное расширение.");
clearInterval(intervalID);
hide_div_audio();

}else if(f=="error4"){

alert("Ошибка загрузки! Возможно неправильное расширение.");
clearInterval(intervalID);
hide_div_audio();

}else if(f=="error5"){

alert("Ошибка загрузки! Возможно превышен допустимый размер.");
clearInterval(intervalID);
hide_div_audio();

}else if(f=="error11"){

alert("Ошибка загрузки! Размер принятого файла превысил максимально допустимый размер, который задан директивой upload_max_filesize конфигурационного файла php.ini.");
clearInterval(intervalID);
hide_div_audio();

}else if(f=="error22"){

alert("Ошибка загрузки! Размер загружаемого файла превысил значение MAX_FILE_SIZE, указанное в HTML-форме.");
clearInterval(intervalID);
hide_div_audio();

}else if(f=="error33"){

alert("Ошибка загрузки! Загружаемый файл был получен только частично.");
clearInterval(intervalID);
hide_div_audio();

}else if(f=="error44"){

alert("Ошибка загрузки! Файл не был загружен.");
clearInterval(intervalID);
hide_div_audio();

}else if(f=="error55"){

alert("Ошибка загрузки! Отсутствует временная папка.");
clearInterval(intervalID);
hide_div_audio();

}else if(f=="error66"){

alert("Ошибка загрузки! Отсутствует временная папка.");
clearInterval(intervalID);
hide_div_audio();

}else if(f=="error77"){

alert("Ошибка загрузки! Не удалось записать файл на диск.");
clearInterval(intervalID);
hide_div_audio();

}else if(f=="error88"){

alert("Ошибка загрузки! PHP-расширение остановило загрузку файла.");
clearInterval(intervalID);
hide_div_audio();

}
else{
var d2 = window.frames [\'frameId\'].document;
var f2=d2.body.innerHTML;
';  
  


//echo'
// d2.body.innerHTML=f2+"<div style=\"width:100%; height:20px; background-color:transparent; \"></div><div style=\"width:100%; height:35px; backgroung-color:yellow;\"> <audio controls preload=\"auto\"><source src=\"../mp3/"+f+"\" type=\"audio/mpeg\">Тег audio не поддерживается вашим браузером. </audio> </div><div style=\"width:100%; height:20px; background-color:transparent; \"></div>";
//';

echo'
d2.body.innerHTML=f2+"<table><tr><td style=\" width:100%; height:30px; border-bottom:0px black solid;  \"><audio controls preload=\"auto\"><source src=\"../mp3/"+f+"\" type=\"audio/mpeg\">Тег audio не поддерживается вашим браузером. </audio></td></tr></table>";
';


echo'
clearInterval(intervalID);
hide_div_audio();


}
 
 },1000);

}


//получение позиции каретки в текстовом поле
function getCaret(el) { 
  if (el.selectionStart) { 
    return el.selectionStart; 
  } else if (document.selection) { 
    el.focus(); 
 
    var r = document.selection.createRange(); 
    if (r == null) { 
      return 0; 
    } 
 
    var re = el.createTextRange(), 
        rc = re.duplicate(); 
    re.moveToBookmark(r.getBookmark()); 
    rc.setEndPoint(\'EndToStart\', re); 
 
    return rc.text.length; 
  }  
  return 0; 
}
//получение позиции каретки в текстовом поле

</script>

';			
							
						
                          echo' </div>';
echo'

</div>

</div>	
<!--блок выбора файла-->





';


}//режим редактирования

}//админ и редактор могут редактировать все новостные блоки.
else if($privilege=='correspondent'){//пользователь имеет привилегии Корреспондента

//кто автор новостного блока.
if(!isset($_GET['id'])){echo"Ошибка! Не задан идентификатор новости."; exit; };
$id=$_GET['id'];//идентификатор новости.


$dbh = mysqli_init();
mysqli_options($dbh, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT=0");
mysqli_options($dbh, MYSQLI_OPT_CONNECT_TIMEOUT, 5);

mysqli_real_connect($dbh, DB_SERVER, DB_USER, DB_PASS);

if (mysqli_connect_errno()) {
    printf("Ошибка соединения: %s\n", mysqli_connect_error());
    exit();
}

mysqli_query($dbh,"SET NAMES utf8");
					mysqli_query ($dbh,"SET COLLATION_CONNECTION=utf8");
                   mysqli_query($dbh,"SET CHARACTER_SET_CLIENT=utf8");
					mysqli_query($dbh,"SET CHARACTER_SET_RESULTS=utf8");	
					
					mysqli_select_db($dbh, DB_BASE);


$query = "SELECT * FROM news WHERE id='".$id."' ";
$res=mysqli_query($dbh, $query);
$row=mysqli_fetch_array($res);

$author=$row['author'];//автор новостного блока

if($user==$author){//если Корреспондент открыл "свой" новостной блок


if(!isset($_GET['id'])){echo"Ошибка! Не задан идентификатор."; exit; };
$id=$_GET['id'];



if(!isset($_GET['edit'])){
$_GET['edit']='0';
}


if($_GET['edit']=='0'){//режим чтения
//переход в режим редактирования будет осуществляться по нажатии 
//кнопки "Редактировать"


if(!isset($_GET['id'])){echo"Ошибка! Не задан идентификатор."; exit; };
$id=$_GET['id'];

$dbh = mysqli_init();
mysqli_options($dbh, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT=0");
mysqli_options($dbh, MYSQLI_OPT_CONNECT_TIMEOUT, 5);

mysqli_real_connect($dbh, DB_SERVER, DB_USER, DB_PASS);

if (mysqli_connect_errno()) {
    printf("Ошибка соединения: %s\n", mysqli_connect_error());
    exit();
}

mysqli_query($dbh,"SET NAMES utf8");
					mysqli_query ($dbh,"SET COLLATION_CONNECTION=utf8");
                   mysqli_query($dbh,"SET CHARACTER_SET_CLIENT=utf8");
					mysqli_query($dbh,"SET CHARACTER_SET_RESULTS=utf8");	

					mysqli_select_db($dbh, DB_BASE);



//вычисляем блок (дата), к которому принадлежит новость по id новости.
if(!isset($_GET['id'])){echo"Ошибка! Не задан идентификатор."; exit; };
$id=$_GET['id'];


$query = "SELECT * FROM news WHERE id='".$id."' ";
$res=mysqli_query($dbh, $query);
$row=mysqli_fetch_array($res);
$date=$row['date'];

echo'
<script type="text/javascript">
parent.frame2.location = "frame2.php?date='.$date.'&id='.$id.'";
</script>';

$query = "SELECT * FROM news WHERE id='".$id."' ";
$res=mysqli_query($dbh, $query);
$row=mysqli_fetch_array($res);

$author=$_SESSION['user'];


echo'
<form method="post" action="../action/update_news.php?id='.$id.'"  style="padding:0 !important; border:0 !important;
margin:0 !important;">



<!--поле с заголовком новости-->
<div align="center" style="width:100%; height:50px; background-color:transparent; ">
<div align="left" style="width:90%; height:50px; background-color:transparent;  ">
<input type="text" id="head" name="head" autocomplete="off" style="width:85%; height:30px; margin-top:10px; font-size:14pt;
float:left !important;" 
value="'.$row['head'].'" onclick="up_head()" onkeydown="up_head()" onkeyup="up_head()" disabled />
<div style="width:30px; height:30px; background-color:blue; float:left; margin-top:10px;
background-image:url(\'../images/insert_news_to_buffer.jpg\'); background-repeat:no-repeat;
cursor:pointer;" 
title="Добавить в корзину" onclick="insert_news_to_buffer();"></div>

</div>

</div>
<!--поле с заголовком новости-->
<!--id - идентификатор новости -->
<script type="text/javascript">
						function insert_news_to_buffer(){
							var show = confirm("Вы действительно хотите добавить новость в корзину ?");
							
							if(show==true){
								document.location.href = "../action/insert_news_to_user_buffer.php?id='.$id.'";
							
							}else{
							
							
							}
							
							
							}
							</script>

<!--поле с текстом-->

<div align="center" style="width:100%; height:465px; background-color:transparent;">
<div style="width:100%; height:20px;"></div>';



echo'
	<div>
		

		
		<div onclick="up_text()" onkeydown="up_text()" onkeyup="up_text()">


<script type="text/javascript">
// ***********************
// ШАГ 1: вывод iframe и получение доступа к нему
// ***********************

// Выводим в HTML-поток iframe
document.write("<iframe  src=\'#\' id=\'frameId\' name=\'frameId\' style=\'width:90%;\' disabled ></iframe><br/>");
// Определим Gecko-браузеры, т.к. они отличаются в своей работе от Оперы и IE
var isGecko = navigator.userAgent.toLowerCase().indexOf("gecko") != -1;
// Получаем доступ к объектам window & document для ифрейма
var iframe = (isGecko) ? document.getElementById("frameId") : frames["frameId"];
var iWin = (isGecko) ? iframe.contentWindow : iframe.window;
var iDoc = (isGecko) ? iframe.contentDocument : iframe.document;

// ***********************
// ШАГ 2: Добавим на пустую страницу ифрейма произвольный HTML-код
// ***********************

// Формируем HTML-код
iHTML = "<html><head>\n";
iHTML += "<style>\n";
iHTML += "body, div, p, td {font-size:12px; font-family:tahoma; margin:0px; padding:0px;}";
iHTML += "body {margin:5px; }";
iHTML += ".oranzh {color:#FF6300;}";
iHTML += "</style>\n";
iHTML += "<body>';

//экранирование символов [ " ]
$str_row=str_replace('"','\"',$row['text']);

echo $str_row;

echo'</body>";
iHTML += "</html>";
// Добавляем его с помощью методов объекта document
iDoc.open();
iDoc.write(iHTML);
iDoc.close();

// ***********************
// ШАГ 3: Инициализация свойства designMode объекта document
// ***********************

if (!iDoc.designMode) alert("Визуальный режим редактирования не поддерживается Вашим браузером");
else iDoc.designMode = (isGecko) ? "off" : "Off";

// ***********************
// ШАГ 4: Простейшие элементы редактирования: жирность, курсив, подчеркивание
// ***********************

// Запишем код функции, для выставления форматирования
// Используется метод execCommand объекта document
function setBold() {
	iWin.focus();
	iWin.document.execCommand("bold", null, "");
}
function setItal() {
	iWin.focus();
	iWin.document.execCommand("italic", null, "");
}
function setUnder() {
	iWin.focus();
	iWin.document.execCommand("underline", null, "");
}
function setLink() {
	var url = prompt("Введите URL:", "http://");
	if (!url) return;
	iWin.focus();
	iWin.document.execCommand("CreateLink", null, url);
}
function setH1() {
	iWin.focus();
	execCommandImitation("<object classid=\"clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B\" codebase=\"http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0\" width=\"300\" height=\"20\" id=\"obj\" name=\"eobj\" align=\"\" ><param name=\"autoplay\" value=\"false\"><param name=\"src\" value=\"http://portal/mp3/01.mp3\"><param name=\"url\" value=\"http://portal/mp3/01.mp3\"><param name=\"width\" value=\"300\"><param name=\"height\" value=\"20\"><param name=\"id\" value=\"obj\"><param name=\"name\" value=\"eobj\"><param name=\"align\" value=\"\"><embed type=\"video/quicktime\" autoplay=\"false\" src=\"http://portal/mp3/01.mp3\" width=\"300\" height=\"20\" id=\"obj\" name=\"eobj\" align=\"\" >", "</object></br>");
}
function insert_audio(){
div_audio.style.display = "block";

} 
function hide_div_audio(){
div_audio.style.display = "none";

} 


// ***********************
// ШАГ 5: Форматирование произвольным HTML-контентом
// ***********************
// nodeList - формирует массив всех узлов с указанием степени их вложенности
function nodeList(parentNode, list, level) {
	var i, node, count;
	if (!list) list = new Array();
	level++;
	for (i = 0; i < parentNode.childNodes.length; i++) {
		node = parentNode.childNodes[i];
		if (node.nodeType != 1) continue;
		count = list.length;
		list[count] = new Array();
		list[count][0] = node;
		list[count][1] = level;
		nodeList(node, list, level);
	}
	return list;
}
// rgbNormal - приводит цвет к стандарту #RRGGBB
function rgbNormal(color) {
	color = color.toString();
	var re = /rgb\((.*?)\)/i;
	if(re.test(color)) {
		compose = RegExp.$1.split(",");
		var hex = [\'0\',\'1\',\'2\',\'3\',\'4\',\'5\',\'6\',\'7\',\'8\',\'9\',\'A\',\'B\',\'C\',\'D\',\'E\',\'F\'];
		var result = "#";
		for (var i = 0; i < compose.length; i++) {
			rgb = parseInt(compose[i]);
			result += hex[parseInt(rgb / 16)] + hex[rgb % 16];
		}
		return result;
	} else return color;
}
function execCommandImitation(start, end) {
	// Cтавим ForeColor-форматирование с помощью специального цвета
	iDoc.execCommand("ForeColor", false, "#f5F856");
	// Получаем все элементы форматируемого документа
	var allNodes = nodeList(iDoc.body, false, 0);
	// Сортируем их по уровню вложенности
	var maxLevel = 0;
	for (i = 0; i < allNodes.length; i++) {
		maxLevel = allNodes[i][1] > maxLevel ? allNodes[i][1] : maxLevel;
	}
	// 4. Для всех элементов заменяем FONT и SPAN со специальным цветом на переданный код
	var node, newnode, color, parent;
	for (j = maxLevel; j >= 1; j--) {
		for (i = 0; i < allNodes.length; i++) {
			if (allNodes[i][1] != j) continue;
			node = allNodes[i][0];
			sname = node.nodeName.toLowerCase();
			color = node.color ? rgbNormal(node.color) : rgbNormal(node.style.color);
			if (color) color = color.toLowerCase();
			if (sname == "font" || sname == "span" && color == "#f5f856") {
				try {
					node.innerHTML = start + node.innerHTML + end;
				} catch(e) {}
				parent = node.parentNode;
				while (node.childNodes.length > 0) parent.insertBefore(node.firstChild, node);
				parent.removeChild(node);
			}
		}
	}
	iWin.focus();
}
</script>




	<!--$row[text]-->





	</div>




		<br />
		
	
	</div>


<script type="text/javascript">
if (document.location.protocol == \'file:\') {
	alert("Система не сможет работать должным образом с файловой системой из-за параметров безопасности в Вашем браузере. 
	 Пожалуйста используйте работающий веб-сервер.");
}
</script>

</div>

<!--поле с тегами-->
<div align="center" style="width:100%; height:50px; background-color:transparent;">
<div align="left" style="width:90%; height:50px; background-color:transparent;">
<div style="width:50%; height:35px; float:left; background-color:transparent;">
<input style="height:20px; width:90%;" type="text" id="tags" name="tags" autocomplete="off"
 value="'.$row['tags'].'"
onclick="up_tags()" onkeydown="up_tags()" onkeyup="up_tags()" disabled />
</div>
<div style="width:50%; height:35px; background-color:transparent; float:left;">

</div>
</div>
</div>
<!--поле с тегами-->


</form>
	

';







}//режим чтения
else if($_GET['edit']=='1'){//режим редактирования




$dbh = mysqli_init();
mysqli_options($dbh, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT=0");
mysqli_options($dbh, MYSQLI_OPT_CONNECT_TIMEOUT, 5);

mysqli_real_connect($dbh, DB_SERVER, DB_USER, DB_PASS);

if (mysqli_connect_errno()) {
    printf("Ошибка соединения: %s\n", mysqli_connect_error());
    exit();
}
mysqli_query($dbh,"SET NAMES utf8");
					mysqli_query ($dbh,"SET COLLATION_CONNECTION=utf8");
                   mysqli_query($dbh,"SET CHARACTER_SET_CLIENT=utf8");
					mysqli_query($dbh,"SET CHARACTER_SET_RESULTS=utf8");	

					mysqli_select_db($dbh, DB_BASE);
					

echo'
<!--обновление первого фрейма-->
<script type="text/javascript">
window.parent.frame1.document.location.reload();

</script>
<!--обновление первого фрейма-->';



//вычисляем блок (дата), к которому принадлежит новость по id новости.
if(!isset($_GET['id'])){echo"Ошибка! Не задан идентификатор."; exit; };
$id=$_GET['id'];


$query = "SELECT * FROM news WHERE id='".$id."' ";
$res=mysqli_query($dbh, $query);
$row=mysqli_fetch_array($res);
$date=$row['date'];

echo'
<script type="text/javascript">
parent.frame2.location = "frame2.php?date='.$date.'&id='.$id.'";
</script>';




$query = "SELECT * FROM news WHERE id='".$id."' ";
$res=mysqli_query($dbh, $query);
$row=mysqli_fetch_array($res);

$author=$_SESSION['user'];


echo'
<form method="post" action="../action/update_news.php?id='.$id.'"  style="padding:0 !important; border:0 !important;
margin:0 !important;">



<!--поле с заголовком новости-->
<div align="center" style="width:100%; height:50px; background-color:transparent; ">
<div align="left" style="width:90%; height:50px; background-color:transparent;  ">
<input type="text" id="head" name="head" autocomplete="off" style="width:85%; height:30px; margin-top:10px; font-size:14pt;
float:left !important;" 
value="'.$row['head'].'" onclick="up_head()" onkeydown="up_head()" onkeyup="up_head()"/>
<div style="width:30px; height:30px; background-color:blue; float:left; margin-top:10px;
background-image:url(\'../images/insert_news_to_buffer.jpg\'); background-repeat:no-repeat;
cursor:pointer;" 
title="Добавить в корзину" onclick="insert_news_to_buffer();"></div>

</div>

</div>
<!--поле с заголовком новости-->
<!--id - идентификатор новости -->
<script type="text/javascript">
						function insert_news_to_buffer(){
							var show = confirm("Вы действительно хотите добавить новость в корзину ?");
							
							if(show==true){
								document.location.href = "../action/insert_news_to_user_buffer.php?id='.$id.'";
							
							}else{
							
							
							}
							
							
							}
							</script>

<!--поле с текстом-->

<div align="center" style="width:100%; height:465px; background-color:transparent;">
<div style="width:100%; height:20px;"></div>';



echo'
	<div>
		

		
		<div onclick="up_text()" onkeydown="up_text()" onkeyup="up_text()">


<script type="text/javascript">
// ***********************
// ШАГ 1: вывод iframe и получение доступа к нему
// ***********************

// Выводим в HTML-поток iframe
document.write("<iframe src=\'#\' id=\'frameId\' name=\'frameId\' style=\'width:90%;\'></iframe><br/>");
// Определим Gecko-браузеры, т.к. они отличаются в своей работе от Оперы и IE
var isGecko = navigator.userAgent.toLowerCase().indexOf("gecko") != -1;
// Получаем доступ к объектам window & document для ифрейма
var iframe = (isGecko) ? document.getElementById("frameId") : frames["frameId"];
var iWin = (isGecko) ? iframe.contentWindow : iframe.window;
var iDoc = (isGecko) ? iframe.contentDocument : iframe.document;

// ***********************
// ШАГ 2: Добавим на пустую страницу ифрейма произвольный HTML-код
// ***********************

// Формируем HTML-код
iHTML = "<html><head>\n";
iHTML += "<style>\n";
iHTML += "body, div, p, td {font-size:12px; font-family:tahoma; margin:0px; padding:0px;}";
iHTML += "body {margin:5px;}";
iHTML += ".oranzh {color:#FF6300;}";
iHTML += "</style>\n";
iHTML += "<body>';

//экранирование символов [ " ]
$str_row=str_replace('"','\"',$row['text']);

echo $str_row;

echo'</body>";
iHTML += "</html>";
// Добавляем его с помощью методов объекта document
iDoc.open();
iDoc.write(iHTML);
iDoc.close();

// ***********************
// ШАГ 3: Инициализация свойства designMode объекта document
// ***********************

if (!iDoc.designMode) alert("Визуальный режим редактирования не поддерживается Вашим браузером");
else iDoc.designMode = (isGecko) ? "on" : "On";

// ***********************
// ШАГ 4: Простейшие элементы редактирования: жирность, курсив, подчеркивание
// ***********************

// Выведем HTML-код этих элементов
document.write("<input type=\'button\' value=\'Ж\' onclick=\'setBold()\' class=\'bold\' style=\'width:60px;\' />");
document.write("<input type=\'button\' value=\'К\' onclick=\'setItal()\' class=\'ital\' style=\'width:60px;\' />");
document.write("<input type=\'button\' value=\'Ч\' onclick=\'setUnder()\' class=\'under\' style=\'width:60px;\' />");
document.write("<input type=\'button\' value=\'Вставить аудио\' onclick=\'insert_audio()\' class=\'bold\' style=\'width:160px;\' />");
// Запишем код функции, для выставления форматирования
// Используется метод execCommand объекта document
function setBold() {
	iWin.focus();
	iWin.document.execCommand("bold", null, "");
}
function setItal() {
	iWin.focus();
	iWin.document.execCommand("italic", null, "");
}
function setUnder() {
	iWin.focus();
	iWin.document.execCommand("underline", null, "");
}
function setLink() {
	var url = prompt("Введите URL:", "http://");
	if (!url) return;
	iWin.focus();
	iWin.document.execCommand("CreateLink", null, url);
}
function setH1() {
	iWin.focus();
	execCommandImitation("<object classid=\"clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B\" codebase=\"http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0\" width=\"300\" height=\"20\" id=\"obj\" name=\"eobj\" align=\"\" ><param name=\"autoplay\" value=\"false\"><param name=\"src\" value=\"http://portal/mp3/01.mp3\"><param name=\"url\" value=\"http://portal/mp3/01.mp3\"><param name=\"width\" value=\"300\"><param name=\"height\" value=\"20\"><param name=\"id\" value=\"obj\"><param name=\"name\" value=\"eobj\"><param name=\"align\" value=\"\"><embed type=\"video/quicktime\" autoplay=\"false\" src=\"http://portal/mp3/01.mp3\" width=\"300\" height=\"20\" id=\"obj\" name=\"eobj\" align=\"\" >", "</object></br>");
}
function insert_audio(){
div_audio.style.display = "block";

} 
function hide_div_audio(){
div_audio.style.display = "none";

} 


// ***********************
// ШАГ 5: Форматирование произвольным HTML-контентом
// ***********************
// nodeList - формирует массив всех узлов с указанием степени их вложенности
function nodeList(parentNode, list, level) {
	var i, node, count;
	if (!list) list = new Array();
	level++;
	for (i = 0; i < parentNode.childNodes.length; i++) {
		node = parentNode.childNodes[i];
		if (node.nodeType != 1) continue;
		count = list.length;
		list[count] = new Array();
		list[count][0] = node;
		list[count][1] = level;
		nodeList(node, list, level);
	}
	return list;
}
// rgbNormal - приводит цвет к стандарту #RRGGBB
function rgbNormal(color) {
	color = color.toString();
	var re = /rgb\((.*?)\)/i;
	if(re.test(color)) {
		compose = RegExp.$1.split(",");
		var hex = [\'0\',\'1\',\'2\',\'3\',\'4\',\'5\',\'6\',\'7\',\'8\',\'9\',\'A\',\'B\',\'C\',\'D\',\'E\',\'F\'];
		var result = "#";
		for (var i = 0; i < compose.length; i++) {
			rgb = parseInt(compose[i]);
			result += hex[parseInt(rgb / 16)] + hex[rgb % 16];
		}
		return result;
	} else return color;
}
function execCommandImitation(start, end) {
	// Cтавим ForeColor-форматирование с помощью специального цвета
	iDoc.execCommand("ForeColor", false, "#f5F856");
	// Получаем все элементы форматируемого документа
	var allNodes = nodeList(iDoc.body, false, 0);
	// Сортируем их по уровню вложенности
	var maxLevel = 0;
	for (i = 0; i < allNodes.length; i++) {
		maxLevel = allNodes[i][1] > maxLevel ? allNodes[i][1] : maxLevel;
	}
	// 4. Для всех элементов заменяем FONT и SPAN со специальным цветом на переданный код
	var node, newnode, color, parent;
	for (j = maxLevel; j >= 1; j--) {
		for (i = 0; i < allNodes.length; i++) {
			if (allNodes[i][1] != j) continue;
			node = allNodes[i][0];
			sname = node.nodeName.toLowerCase();
			color = node.color ? rgbNormal(node.color) : rgbNormal(node.style.color);
			if (color) color = color.toLowerCase();
			if (sname == "font" || sname == "span" && color == "#f5f856") {
				try {
					node.innerHTML = start + node.innerHTML + end;
				} catch(e) {}
				parent = node.parentNode;
				while (node.childNodes.length > 0) parent.insertBefore(node.firstChild, node);
				parent.removeChild(node);
			}
		}
	}
	iWin.focus();
}
</script>




	<!--$row[text]-->





	</div>




		<br />
		
	
	</div>


<script type="text/javascript">
if (document.location.protocol == \'file:\') {
	alert("Система не сможет работать должным образом с файловой системой из-за параметров безопасности в Вашем браузере. 
	 Пожалуйста используйте работающий веб-сервер.");
}
</script>

</div>

<!--поле с тегами-->
<div align="center" style="width:100%; height:50px; background-color:transparent;">
<div align="left" style="width:90%; height:50px; background-color:transparent;">
<div style="width:50%; height:35px; float:left; background-color:transparent;">
<input style="height:20px; width:90%;" type="text" id="tags" name="tags" autocomplete="off"
 value="'.$row['tags'].'"
onclick="up_tags()" onkeydown="up_tags()" onkeyup="up_tags()"/>
</div>
<div style="width:50%; height:35px; background-color:transparent; float:left;">
<input style="width:150px; " type="submit" name="save" value="Готово" onclick="ajax_update_text()"/>
</div>
</div>
</div>
<!--поле с тегами-->


</form>

<script type="text/javascript">
function ajax_update_text(){
var text=frameId.document.body.innerHTML;
	$.ajax({
					type: "POST",
					url: "../ajax_action/ajax_action_update_text.php?id='.$id.'",
					data: "text="+text,
					//success: function(html){
					//    parent.frame2.document.getElementById("head").innerHTML = html;
						
				   //}
				})
				return false;
	


};
	</script>
	
	
<script type="text/javascript">
	function up_head(){
   	$.ajax({
					type: "POST",
					url: "../ajax_action/ajax_action_head_up.php?id='.$id.'",
					data: "head="+$("#head").val(),
					//success: function(html){
					//    parent.frame2.document.getElementById("head").innerHTML = html;
						
				   //}
				})
				return false;
				
	};
	
	</script>
<script type="text/javascript">
	
	function up_author(){
   	$.ajax({
					type: "POST",
					url: "../ajax_action/ajax_action_author_up.php?id='.$id.'",
					data: "author="+'.$author.',
					//success: function(html){
					//    parent.frame2.document.getElementById("author").innerHTML = html;
						
				   //}
				})
				return false;
				
	};
</script>	
	
	
	
	
<script type="text/javascript">

setInterval(function() {
	var text=frameId.document.body.innerHTML;
	text=text.replace(/&nbsp;/g,"");
	$.ajax({
					type: "POST",
					url: "../ajax_action/ajax_action_text_up.php?id='.$id.'",
					data: "text="+text,
					//success: function(html){
					//    parent.frame2.document.getElementById("author").innerHTML = html;
					
				   //}
				})
				return false;

	}, 1000);

</script>



<script type="text/javascript">
	function up_tags(){
   	$.ajax({
					type: "POST",
					url: "../ajax_action/ajax_action_tags_up.php?id='.$id.'",
					data: "tags="+$("#tags").val(),
					//success: function(html){
					//    parent.frame2.document.getElementById("head").innerHTML = html;
						
				   //}
				})
				return false;
				
	};
	
	</script>




<script type="text/javascript">
setInterval(function() {
//заблокировать frame1 и frame2.
var elm1 = parent.frame1.document.getElementById("div_frame1");
elm1.style.display = "block";
var elm2 = parent.frame2.document.getElementById("div_frame2");
elm2.style.display = "block";
	}, 200);

</script>


<script type="text/javascript">
function upload_file(){


}
</script>




<!--блок выбора файла-->
<div id="div_audio" name="div_audio" style="width:400px; height:200px; background-color:white; display:none;
position:fixed; z-index:999999999990000000000 !important; left:50% !important; top:50% !important;
margin-left:-200px !important; margin-top:-100px !important; border:2px black solid !important; ">
<div align="right" style="width:400px; height:30px; ">
<span onclick="hide_div_audio();" style="cursor:pointer !important; font-size:10pt !important;
margin-right:5px !important; text-decoration:underline !important;">Закрыть</span>
</div>
<div align="center" style="width:400px; height:50px; overflow:auto; background-color:transparent;">
<span>Загружаемый файл должен иметь расширение *.mp3</span></br>
<span>Максимальный размер файла: 100MB</span>
</div>

<div align="left" style="width:400px; height:110px; overflow:hidden; background-color:transparent;">

';

echo'
               
								
								<div align="left" style="width:400px; height:90px; background-color:transparent;">
								<!--<input type="file" id="userfile" name="userfile" 
								style="width: 218px; margin-left:10px;" />-->
					
<div align="left" style="width:350px; margin-left:0px; height:60px;">	<output id="list"></output>

<iframe style="display: none; width:300px !important; height:150px !important;" id="superframe" name="superframe" >
';

echo'
</iframe>
<form method="post" enctype="multipart/form-data" action="../action/upload_audio.php?id_frame3='.$_GET['id'].'" target="superframe">

<div align="center" style="width:400px; height:40px; ">
        <input name="userfile" type="file" style="width:350px; cursor:pointer;">
		
			<!--получение информации о файле средствами JS-->
		<output id="list" style="display:none; color:transparent !important;"></output>
		<script type="text/javascript">
		 function handleFileSelect(evt) {
		 var files = evt.target.files; // FileList object
			// files is a FileList of File objects. List some properties.
			 var output = [];
			for (var i = 0, f; f = files[i]; i++) {
				output.push(\'\', escape(f.name), \' (\', f.type || \'n/a\', \') - \',
                  f.size, \' bytes, last modified: \',
                  f.lastModifiedDate.toLocaleDateString());
				  if(f.size>(100*1024*1024)){alert(\'Размер файла не должен превышать 100Мб\');
					document.forms["uploadForm"].reset();

					};
				   var re=/[а-яёЁ]/i,str=f.name;
				  if(re.test(str)){
				  };
				   }
				    document.getElementById(\'list\').innerHTML = \'<div style="display:none !important;">\' + output.join(\'\') + \'</div>\';
					}
				 document.getElementById(\'userfile\').addEventListener(\'change\', handleFileSelect, false);
		 </script>
				  
		<!--получение информации о файле средствами JS-->
		
		
		
</div>
<div align="center" style="width:400px; height:40px; ">
		<input type="submit" value="Загрузить" onclick="insert_audio_action();" style=" cursor:pointer;"/>
</div>
</form>
</div>

<script type="text/javascript">
function insert_audio_action(){
 
var intervalID = setInterval(function() {

var d = window.frames [\'superframe\'].document;
var f=d.body.innerHTML;

if(f==""){

}else{
var d2 = window.frames [\'frameId\'].document;
var f2=d2.body.innerHTML;

 
d2.body.innerHTML=f2+"<table><tr><td style=\" width:100%; height:30px; border-bottom:0px black solid; \"><audio controls preload=\"auto\"><source src=\"../mp3/"+f+"\" type=\"audio/mpeg\">Тег audio не поддерживается вашим браузером. </audio></td></tr></table>";

clearInterval(intervalID);
hide_div_audio();



}


    },1000);




}
</script>

';			
							
							
							
							
							
							
                          echo' </div>';
							
							




echo'

</div>

</div>	
<!--блок выбора файла-->





';

}//режим редактирования


}//если Корреспондент открыл "свой" новостной блок
else if($user!=$author){//если Корреспондент открыл "чужой" новостной блок



if(!isset($_GET['id'])){echo"Ошибка! Не задан идентификатор."; exit; };
$id=$_GET['id'];

$dbh = mysqli_init();
mysqli_options($dbh, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT=0");
mysqli_options($dbh, MYSQLI_OPT_CONNECT_TIMEOUT, 5);

mysqli_real_connect($dbh, DB_SERVER, DB_USER, DB_PASS);

if (mysqli_connect_errno()) {
    printf("Ошибка соединения: %s\n", mysqli_connect_error());
    exit();
}

mysqli_query($dbh,"SET NAMES utf8");
					mysqli_query ($dbh,"SET COLLATION_CONNECTION=utf8");
                   mysqli_query($dbh,"SET CHARACTER_SET_CLIENT=utf8");
					mysqli_query($dbh,"SET CHARACTER_SET_RESULTS=utf8");	

					mysqli_select_db($dbh, DB_BASE);



//вычисляем блок (дата), к которому принадлежит новость по id новости.
if(!isset($_GET['id'])){echo"Ошибка! Не задан идентификатор."; exit; };
$id=$_GET['id'];


$query = "SELECT * FROM news WHERE id='".$id."' ";
$res=mysqli_query($dbh, $query);
$row=mysqli_fetch_array($res);
$date=$row['date'];



$query = "SELECT * FROM news WHERE id='".$id."' ";
$res=mysqli_query($dbh, $query);
$row=mysqli_fetch_array($res);

$author=$_SESSION['user'];


echo'
<form method="post" action="../action/update_news.php?id='.$id.'"  style="padding:0 !important; border:0 !important;
margin:0 !important;">



<!--поле с заголовком новости-->
<div align="center" style="width:100%; height:50px; background-color:transparent; ">
<div align="left" style="width:90%; height:50px; background-color:transparent;  ">
<input type="text" id="head" name="head" autocomplete="off" style="width:85%; height:30px; margin-top:10px; font-size:14pt;
float:left !important;" 
value="'.$row['head'].'" onclick="up_head()" onkeydown="up_head()" onkeyup="up_head()" disabled />
<div style="width:30px; height:30px; background-color:blue; float:left; margin-top:10px;
background-image:url(\'../images/insert_news_to_buffer.jpg\'); background-repeat:no-repeat;
cursor:pointer;" 
title="Добавить в корзину" onclick="insert_news_to_buffer();"></div>

</div>

</div>
<!--поле с заголовком новости-->
<!--id - идентификатор новости -->
<script type="text/javascript">
						function insert_news_to_buffer(){
							var show = confirm("Вы действительно хотите добавить новость в корзину ?");
							
							if(show==true){
								document.location.href = "../action/insert_news_to_user_buffer.php?id='.$id.'";
							
							}else{
							
							
							}
							
							
							}
							</script>

<!--поле с текстом-->

<div align="center" style="width:100%; height:465px; background-color:transparent;">
<div style="width:100%; height:20px;"></div>';



echo'
	<div>
		

		
		<div onclick="up_text()" onkeydown="up_text()" onkeyup="up_text()">


<script type="text/javascript">
// ***********************
// ШАГ 1: вывод iframe и получение доступа к нему
// ***********************

// Выводим в HTML-поток iframe
document.write("<iframe src=\'#\' id=\'frameId\' name=\'frameId\' style=\'width:90%;\' disabled ></iframe><br/>");
// Определим Gecko-браузеры, т.к. они отличаются в своей работе от Оперы и IE
var isGecko = navigator.userAgent.toLowerCase().indexOf("gecko") != -1;
// Получаем доступ к объектам window & document для ифрейма
var iframe = (isGecko) ? document.getElementById("frameId") : frames["frameId"];
var iWin = (isGecko) ? iframe.contentWindow : iframe.window;
var iDoc = (isGecko) ? iframe.contentDocument : iframe.document;

// ***********************
// ШАГ 2: Добавим на пустую страницу ифрейма произвольный HTML-код
// ***********************

// Формируем HTML-код
iHTML = "<html><head>\n";
iHTML += "<style>\n";
iHTML += "body, div, p, td {font-size:12px; font-family:tahoma; margin:0px; padding:0px;}";
iHTML += "body {margin:5px; }";
iHTML += ".oranzh {color:#FF6300;}";
iHTML += "</style>\n";
iHTML += "<body>';

//экранирование символов [ " ]
$str_row=str_replace('"','\"',$row['text']);

echo $str_row;

echo'</body>";
iHTML += "</html>";
// Добавляем его с помощью методов объекта document
iDoc.open();
iDoc.write(iHTML);
iDoc.close();

// ***********************
// ШАГ 3: Инициализация свойства designMode объекта document
// ***********************

if (!iDoc.designMode) alert("Визуальный режим редактирования не поддерживается Вашим браузером");
else iDoc.designMode = (isGecko) ? "off" : "Off";

// ***********************
// ШАГ 4: Простейшие элементы редактирования: жирность, курсив, подчеркивание
// ***********************

// Запишем код функции, для выставления форматирования
// Используется метод execCommand объекта document
function setBold() {
	iWin.focus();
	iWin.document.execCommand("bold", null, "");
}
function setItal() {
	iWin.focus();
	iWin.document.execCommand("italic", null, "");
}
function setUnder() {
	iWin.focus();
	iWin.document.execCommand("underline", null, "");
}
function setLink() {
	var url = prompt("Введите URL:", "http://");
	if (!url) return;
	iWin.focus();
	iWin.document.execCommand("CreateLink", null, url);
}
function setH1() {
	iWin.focus();
	execCommandImitation("<object classid=\"clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B\" codebase=\"http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0\" width=\"300\" height=\"20\" id=\"obj\" name=\"eobj\" align=\"\" ><param name=\"autoplay\" value=\"false\"><param name=\"src\" value=\"http://portal/mp3/01.mp3\"><param name=\"url\" value=\"http://portal/mp3/01.mp3\"><param name=\"width\" value=\"300\"><param name=\"height\" value=\"20\"><param name=\"id\" value=\"obj\"><param name=\"name\" value=\"eobj\"><param name=\"align\" value=\"\"><embed type=\"video/quicktime\" autoplay=\"false\" src=\"http://portal/mp3/01.mp3\" width=\"300\" height=\"20\" id=\"obj\" name=\"eobj\" align=\"\" >", "</object></br>");
}
function insert_audio(){
div_audio.style.display = "block";

} 
function hide_div_audio(){
div_audio.style.display = "none";

} 


// ***********************
// ШАГ 5: Форматирование произвольным HTML-контентом
// ***********************
// nodeList - формирует массив всех узлов с указанием степени их вложенности
function nodeList(parentNode, list, level) {
	var i, node, count;
	if (!list) list = new Array();
	level++;
	for (i = 0; i < parentNode.childNodes.length; i++) {
		node = parentNode.childNodes[i];
		if (node.nodeType != 1) continue;
		count = list.length;
		list[count] = new Array();
		list[count][0] = node;
		list[count][1] = level;
		nodeList(node, list, level);
	}
	return list;
}
// rgbNormal - приводит цвет к стандарту #RRGGBB
function rgbNormal(color) {
	color = color.toString();
	var re = /rgb\((.*?)\)/i;
	if(re.test(color)) {
		compose = RegExp.$1.split(",");
		var hex = [\'0\',\'1\',\'2\',\'3\',\'4\',\'5\',\'6\',\'7\',\'8\',\'9\',\'A\',\'B\',\'C\',\'D\',\'E\',\'F\'];
		var result = "#";
		for (var i = 0; i < compose.length; i++) {
			rgb = parseInt(compose[i]);
			result += hex[parseInt(rgb / 16)] + hex[rgb % 16];
		}
		return result;
	} else return color;
}
function execCommandImitation(start, end) {
	// Cтавим ForeColor-форматирование с помощью специального цвета
	iDoc.execCommand("ForeColor", false, "#f5F856");
	// Получаем все элементы форматируемого документа
	var allNodes = nodeList(iDoc.body, false, 0);
	// Сортируем их по уровню вложенности
	var maxLevel = 0;
	for (i = 0; i < allNodes.length; i++) {
		maxLevel = allNodes[i][1] > maxLevel ? allNodes[i][1] : maxLevel;
	}
	// 4. Для всех элементов заменяем FONT и SPAN со специальным цветом на переданный код
	var node, newnode, color, parent;
	for (j = maxLevel; j >= 1; j--) {
		for (i = 0; i < allNodes.length; i++) {
			if (allNodes[i][1] != j) continue;
			node = allNodes[i][0];
			sname = node.nodeName.toLowerCase();
			color = node.color ? rgbNormal(node.color) : rgbNormal(node.style.color);
			if (color) color = color.toLowerCase();
			if (sname == "font" || sname == "span" && color == "#f5f856") {
				try {
					node.innerHTML = start + node.innerHTML + end;
				} catch(e) {}
				parent = node.parentNode;
				while (node.childNodes.length > 0) parent.insertBefore(node.firstChild, node);
				parent.removeChild(node);
			}
		}
	}
	iWin.focus();
}
</script>




	<!--$row[text]-->





	</div>




		<br />
		
	
	</div>


<script type="text/javascript">
if (document.location.protocol == \'file:\') {
	alert("Система не сможет работать должным образом с файловой системой из-за параметров безопасности в Вашем браузере. 
	 Пожалуйста используйте работающий веб-сервер.");
}
</script>

</div>

<!--поле с тегами-->
<div align="center" style="width:100%; height:50px; background-color:transparent;">
<div align="left" style="width:90%; height:50px; background-color:transparent;">
<div style="width:50%; height:35px; float:left; background-color:transparent;">
<input style="height:20px; width:90%;" type="text" id="tags" name="tags" autocomplete="off"
 value="'.$row['tags'].'"
onclick="up_tags()" onkeydown="up_tags()" onkeyup="up_tags()" disabled />
</div>
<div style="width:50%; height:35px; background-color:transparent; float:left;">

</div>
</div>
</div>
<!--поле с тегами-->


</form>
	

';





}//если Корреспондент открыл "чужой" новостной блок




}//пользователь имеет привилегии Корреспондента


}

?>



	

</body>

</html>
