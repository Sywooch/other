<?php
session_start();
header('Content-type: text/html; charset=utf-8');
unset($_SESSION['word']);
if ( (!isset( $_POST['inputtext_id'] ))||(!isset( $_POST['search_method'] ))||( $_POST['inputtext_id']=="")||(trim($_POST['inputtext_id'])=="") ) { 
    $pacth=$_GET['prev'];
	header("Refresh: 1; URL=".$pacth."");
echo'Некорректный ввод: поле ввода не должно быть пустым. Перенаправление...';
	die();//прекращение выполнения функции. 
  } 
if(strlen($_POST['inputtext_id'])<4){ 
   $pacth=$_GET['prev'];
header("Refresh: 2; URL=".$pacth."");
echo'Некорректный ввод: минимальная длина запроса должна быть 4 символа. Перенаправление...';
	die();//прекращение выполнения функции. 
	}
  
  
header('Content-type: text/html; charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="продажа и установка предпусковых отопителей, жидкостных и воздушных отопителей, систем очистки топлива, тахографы, средства мониторинга транспорта благовещенск, ремонт спецтехники"/>
<meta name="keywords" content="автокомфорт благовещенск амурская область, авто-комфорт благовещенск" />
<meta name="robots" content="all"/>
<meta name="revisit-after" content="10 days"/>
<meta name="document-state" content="Dynamic"/>
<meta name="generator" content="notepad++">
<meta name="author" content="retina-studio">
<meta http-equiv="X-UA-Compatible" content="IE=edge" ><!--всегда исползовать стандартный режим отображения-->
<link href="/favicon.png" rel="icon" type="image/png"/>

<title>Поиск  - торгово-ремонтная компания, благовещенск, амурская область - спецавтотехника, запчасти для спецавтотехники, специализированное автооборудование, webasto, прамотроник, тахографы, ремонт спецтехники, предпусковые подогреватели</title>

<link rel="stylesheet" href="css/style.css" />
<map name="ImageMap">
<area href="index.php" shape="rect" alt="not image" coords="10, 0, 117, 106"/>
<area href="index.php" shape="rect" alt="not image" coords="127, 17, 610, 63"/>
</map>
<script type="text/javascript" src="js/jquery-1.8.2.js"></script>
<script type="text/javascript" src="js/jquery.highlight.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38692430-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript">
     function DisBlock2_2(){
   $('div#rightcol2').fadeIn(1500);
   					}
  function close_block_2(){
   $('div#rightcol2').fadeOut(1500);
  	}

  function DisBlock2_3(){
   $('div#rightcol3').fadeIn(1500);
   					}
  function close_block_3(){
   $('div#rightcol3').fadeOut(1500);
  	}

  function DisBlock2_4(){
   $('div#rightcol4').fadeIn(1500);
   					}
  function close_block_4(){
   $('div#rightcol4').fadeOut(1500);
  	}

  function DisBlock2_5(){
   $('div#rightcol5').fadeIn(1500);
   					}
  function close_block_5(){
   $('div#rightcol5').fadeOut(1500);
  	}	
	
</script>
<style type="text/css"> 
   .rightcol_style {
    position: fixed;
    left: 0%; /* Сдвиг слоя влево */
    top: 0%; /* Смещение слоя вниз */
    width: 100%; /* Ширина слоя */
    background: #C0C0C0; /* Цвет фона */
    float:none;
    display:none;
	z-index:9999999;
   }
</style>
<script language="javascript" type="text/javascript">
function doMenu(){

if(chapter.style.display=='none'){
chapter.style.display='block';}

}

function doMenu2(){
if(chapter.style.display=='block'){
chapter.style.display='none';}

}

function doMenu3(){
if(chapter.style.display=='block'){
setTimeout(func, 3000);
}
function func() {
  chapter.style.display='none';
}


}
</script>
<script type="text/javascript">

function tmp(form){
if(form.vote_check[0].checked){ 
 search_submit(form);
 }
if(form.vote_check[1].checked){

  var searchTerm=$('#inputtext_id').val();
  $('table').removeHighlight();
  if(searchTerm){
  $('table').highlight(searchTerm);
  }
         
	
  
  
}//form.vote_check[1].checked



}

function search_submit(form){
var text=form.inputtext_id.value;
var method=form.search_method.value;
document.location.href='search.php?text='+text+'&method='+method;
}

function click_radio(){
//document.getElementById('search_method').style.display='none';
$('select#search_method').fadeOut(1500);
}

function click_radio2(){
//document.getElementById('search_method').style.display='inline';
$('select#search_method').fadeIn(1500);
}




</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

function tmp(form){
if(form.vote_check[0].checked){ 
 search_submit(form);
 }
if(form.vote_check[1].checked){

  var searchTerm=$('#inputtext_id').val();
  $('table').removeHighlight();
  if(searchTerm){
  $('table').highlight(searchTerm);
  }
         
	
  
  
}//form.vote_check[1].checked



}

function search_submit(form){
var text=form.inputtext_id.value;
var method=form.search_method.value;
document.location.href='search.php?text='+text+'&method='+method;
}

function click_radio(){
//document.getElementById('search_method').style.display='none';
$('select#search_method').fadeOut(1500);
}

function click_radio2(){
//document.getElementById('search_method').style.display='inline';
$('select#search_method').fadeIn(1500);
}
function click_radio3(){
//document.getElementById('search_method').style.display='inline';
$('select#search_method').fadeIn(1500);
}



</script>


<style type="text/css">

html, body {
  margin:0;
  padding:0;
  width:100%;
  height:100%;
}
#content {
  position: relative;
  min-height: 100%;
}
* html #content {
  height: 100%;
}
#footer {
  position: relative;
  margin-top: 0px;
 
}

</style>


</head>

<body class="body_style" align="center">
<?php include_once("analyticstracking.php") ?>
<div id="content" style=" width:100%" align="center">

<div align="center" style=" width:100%;  margin:0px; padding:0px; margin-top:0px;-moz-box-sizing: border-box; 
-webkit-box-sizing: border-box;box-sizing: border-box;margin-left:0px;">
<div class="div1_style" align="center"><!--общий блок-->


<div class="header_style"><!--шапка-->

<div align="left" class="header_up_style"><!--верхняя половина шапки-->

<div class="div2_style">
<img style="margin-left:0px" src="images/logo.png" alt="" usemap="#ImageMap"  border="0"/>
</div>
</div><!--верхняя половина шапки-->
<div align="left" class="header_center_style"><!--центральная половина шапки-->

<div style="height:28px; width:250px; margin-left:429px; margin-top:16px; float:left; 
background-repeat-x:no-repeat; background-repeat-y:no-repeat; background-repeat:no-repeat; 
background-position-y:3px; background-position-x:0px">
<div style="height:28px; width:250px; margin-top:0px"><!--поиск-->

  <form id="searchForm" action="search.php?prev=index.php" enctype="multipart/form-data" method="post" accept-charset="utf-8" style="padding:0; border:0">
   <table>
    <tbody>
	<tr style="width:100%">
	 
	 <td style="width:100%; padding-left:20px">

	<div style="background-repeat:no-repeat; height:28px; width:250px; background-image:url('images/search.png');
	  background-repeat-x:no-repeat;background-repeat-y:no-repeat;margin-left:0px">
	
	<!--поле для ввода фразы-->
	<input type="text" maxlength="100" name="inputtext_id" id="inputtext_id" 
	style="float:left; margin-top:6px; margin-left:12px; width:195px; border:0; "  onclick="click_radio3()"/>
<!--поле для ввода фразы-->
	
   
   


<!--кнопка Искать-->
 	   <input type="submit" value="" style="margin-left:12px;margin-top:5px; cursor: pointer; background-image:url('images/submit_fon.png');">

	 
	 </div>
	 
	 
	  <select name="search_method" id="search_method" style="display:none; margin-left:40px" ><!--критерии поиска-->
	  <option value="0">фраза полностью</option>
	  <option value="1">вхождение всех слов</option>
	  <option value="2">наличие любого слова</option>
	 </select>
	 
	 </td>
	 </tr>
	 <tr>
	 <td style="color: #FFFFFF;">
	 </td>
	 </tr>
	</tbody>
   </table>
  </form> 

</div><!--поиск-->
</div>

<div align="center" class="div3_style">

</div>





</div><!--центральная половина шапки-->

<div align="center" class="header_down_style"><!--нижняя половина шапки-->

<div align="left" class="menu_style"><!--меню-->
<?php
include("templates/menu.php");
?>

</div><!--меню-->

<!--второе меню-->
<div align="left" class="menu2_style">
<?php
include("templates/menu2.php");
?>
</div><!--второе меню-->


</div><!--нижняя половина шапки-->

</div><!--шапка-->
</div><!--общий блок-->
<!--===============================================================================================================-->
<div align="center" class="content_style"><!--контент-->
<table>
<tr>
<td align="center" style="width:1000px">
<table style="margin-top:20px" width="910px" align="center" border="0" cellpadding="0" cellspacing="0">
<tr>
<td  align="justify" class="td_style" style="text-align:justify !important">
<!--[if IE]><td align="left" class="td_style"><![endif]-->

<?php

echo'<h1 class="h1_style">Результаты поиска:</h1>';


$text=$_POST['inputtext_id'];
$method=$_POST['search_method'];

//убрать лишние пробелы из начала и конца строки.
$text=trim($text); 

//убрать лишние пробелы из середины строки.
$text=str_replace("  "," ",$text);
$text=str_replace("  "," ",$text);
$text=str_replace("  "," ",$text);
$text=str_replace("  "," ",$text);

//убрать теги из строки
$text=strip_tags($text);


//echo"".$text."</br>";
//echo"".$method."</br>";


//проход по заданным страницам, и, если найдено совпадение, то вывести ссылку на страницу
$file[0]='content/content_contacts.php';
$file[1]='content/content_imoblaizer.php';
$file[2]='content/content_index.php';
$file[3]='content/content_monitoring.php';
$file[4]='content/content_pramotronic.php';
$file[5]='content/content_repair_of_special.php';
$file[6]='content/content_separs.php';
$file[7]='content/content_taxograf.php';
$file[8]='content/content_webasto.php';


//ассоциативный массив, задающий соответстие между именами файлов страниц и заголовками страниц.
$name_ass['contacts.php']='Контакты';
$name_ass['imoblaizer.php']='Модули обхода имоблайзера';
$name_ass['index.php']='Главная';
$name_ass['monitoring.php']='Мониторинг транспорта';
$name_ass['pramotronic.php']='Pramotronic';
$name_ass['repair_of_special.php']='Ремонт спецтехники';
$name_ass['separs.php']='Сепараторы';
$name_ass['taxograf.php']='Тахография';
$name_ass['webasto.php']='Webasto';




if($text!=""){
///////////////////////////////////////////////////////////////////////

$global_count=0;

if($method==0){//фраза полностью
$c=0;


while($c<count($file)){//проход по файлам
$file_array=file($file[$c]);
$file_str=implode($file_array);//преобразование содержимого файла в строку.

//удаление тегов
$file_str=strip_tags($file_str);


$pos=stripos($file_str,$text);




if ($pos === false) {
   
} else {



$_SESSION['word']=$text;
//echo"</br>=".$_SESSION['word']."=</br>";

//убрать подстроку _content.
$result_file_string=str_replace("content_","",$file[$c]);
$result_file_string=str_replace("content/","",$result_file_string);


echo"<p class=\"p_style\"><a href=".$result_file_string."  style=\"text-decoration:underline; color:#666666\">".$name_ass[$result_file_string]."</a></p>";  
$global_count++;
}
$c++;
}//проход по файлам
}//фраза полностью

//////////////////////////////////////////////////////////////////////

elseif($method==1){//вхождение всех слов

$c=0;
while($c<count($file)){//проход по файлам
$file_array=file($file[$c]);
$file_str=implode($file_array);

//удаление тегов
$file_str=strip_tags($file_str);



//разложение строки на подстроки
$mas_str=NULL;
$mas_str=explode(" ",$text);
$log=0;
$i=0;



while($i<count($mas_str)){

//удаление пробелов из подстрок
$mas_str[$i]=trim($mas_str[$i]);



$pos=stripos($file_str,$mas_str[$i]);


if ($pos === false) {
$log=1;  break;
} else {
 
}
$i++;
}
if($log==0){  

$_SESSION['word']=$text;
//echo"</br>=".$_SESSION['word']."=</br>";

//убрать подстроку content_.
$result_file_string=str_replace("content_","",$file[$c]);
$result_file_string=str_replace("content/","",$result_file_string);

echo"<p class=\"p_style\"><a href=".$result_file_string." style=\"text-decoration:underline; color:#666666\">".$name_ass[$result_file_string]."</a></p>";  
$global_count++;



}
$c++;
}//проход по файлам



}//вхождение всех слов
////////////////////////////////////////////////////////////////////////
elseif($method==2){//наличие хотя бы одного слова
$c=0;
while($c<count($file)){//проход по файлам
$file_array=NULL;
$file_array=file($file[$c]);
$file_str="";
$file_str=implode($file_array);

//удаление тегов
$file_str=strip_tags($file_str);



//разложение строки на подстроки
$mas_str=NULL;
$mas_str=explode(" ",$text);
$log=0;
$i=0;
while($i<count($mas_str)){

$mas_str[$i]=trim($mas_str[$i]);
$pos=stripos($file_str,$mas_str[$i]);




if ($pos === false) {
 
} else {


 $log=1; 
}
$i++;
}
if($log==1){  


$_SESSION['word']=$text;
//echo"</br>123=".$_SESSION['word']."=123</br>";

//убрать подстроку content_.
$result_file_string=str_replace("content_","",$file[$c]);
$result_file_string=str_replace("content/","",$result_file_string);

echo"<p class=\"p_style\"><a href=".$result_file_string." style=\"text-decoration:underline; color:#666666\">".$name_ass[$result_file_string]."</a></p>";  
$global_count++;
}
$c++;
}//проход по файлам

}//наличие хотя бы одного слова


if($global_count==0){
echo'<h1 class="h1_style">К сожалению по Вашему запросу ничего не найдено.</h1>';
};
//////////////////////////////////////////////////////////////////////////

}//if($text!="")

?>

</td>
</tr>

</table>
</td>
</tr>

</table>




</div><!--контент-->
</div>
</div><!-- id content-->
<!--=======================================================-->
<div align="center" id="footer" style="width:100%; height:100px; 
background-image:url('../images/footer.jpg'); background-position:center;
background-repeat:no-repeat">
<div align="left" class="footer_style" ><!--подвал-->

<div align="left" style="height:75px; width:470px; float:left;padding-top:25px; padding-left:30px">
<div align="left" style="width:250px; height:50px; margin-left:0px; margin-top:0px;  color:#FFFFFF;
font-family:'Myriad Pro'; font-size:9pt; float:left; left:0; top:0; ">
<?php
include("content/footer_text_left.php");
?>
</div>
</div>


<div align="right" style="height:75px; width:470px; float:left; padding-top:25px; padding-right:30px">
<div align="right" style="width:110px; height:50px; margin-left:0px; margin-top:0px; color:#FFFFFF;
font-family:'Myriad Pro'; font-size:9pt">



<?php
include("content/footer_text_right.php");
?>


</div>
</div>


</div><!--подвал-->
</div>
<!--=====================================================-->


<div class="rightcol_style" id="rightcol" name="rightcol" onclick="close_block()" style="width:100%;height:100%">
<div style="top:50%;left:50%; position:absolute;margin:-100px 0 0 -225px;"><img src="images/webasto2_big.jpg"/></div>
</div>


</body>

</html>
