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

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");//соединение
mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                    mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");

$query = "SELECT * FROM users WHERE name='".$user."'";
$res=mysql_query($query);
$row=mysql_fetch_array($res);
$privilege=$row['privilege'];//привилегии пользователя


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

<!-- TinyMCE -->
<script type="text/javascript" src="../jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
	
	verify_html : false,
	paste_remove_styles: false,
    paste_remove_spans: false,
	extended_valid_elements: "noindex, iframe, object, style, param, embed, div, p, span, table, audio",
	verify_html : "false",
	
		// General options
		mode : "textareas",
		theme : "simple",
		//plugins : "imagemanager,filemanager,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		//theme_advanced_buttons1 : "bold,italic,underline",
		//theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,undo,redo,|,forecolor,backcolor",
		//theme_advanced_buttons3 : "media",
		theme_advanced_buttons4 : "",
		theme_advanced_buttons5 : "insertfile",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",


		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
	//	template_replace_values : {
	//		username : "Some User",
	//		staffid : "991234"
	//	}
	});
</script>
<!-- /TinyMCE -->
<!--визуальный редактор-->

<!--ajax-->
<script type="text/javascript" src="../jquery/jquery.js"></script>
<!--ajax-->
 
 
 <!--audio-->
 <script>var _gaq=[['_setAccount','UA-20257902-1'],['_trackPageview']];(function(d,t){ var g=d.createElement(t),s=d.getElementsByTagName(t)[0]; g.async=1;g.src='//www.google-analytics.com/ga.js';s.parentNode.insertBefore(g,s)}(document,'script'))</script>
    <script src="http://portal/audiojs/audio.min.js"></script>
    <link rel="stylesheet" href="http://portal/includes/index.css" media="screen">
    <script>
      audiojs.events.ready(function() {
        audiojs.createAll();
      });
    </script>
<!--audio-->


</head>

<body style="background-color:white; margin:0 !important; padding:0 !important; border:0 !important;
width:100% !important;" onclick="dis();">



 <!--<audio src="http://portal/mp3/01.mp3" preload="auto"></audio>-->


<?php

if(!isset($_GET['id_buffer'])){//пустое поле

}else{
$id_buffer=$_GET['id_buffer'];//идентификатор таблицы, содержимое которой нужно вывести.
//в таблице содержится список новостей, соответствующий определённому выпуску.

$date=$_GET['date'];//дата, будет использоваться при перезагрузке второго фрейма
//перезагрузка второго фрейма
echo'
<script type="text/javascript">
parent.frame2.location = "frame2.php?date='.$date.'&id_buffer_color='.$id_buffer.'";
</script>';



$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");//соединение
mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                    mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");
	
$table_buffer="buffer_".$id_buffer;//наименование таблицы-буффера.



//проверка, существует ли таблица с заданным именем или нет (имя - buffer_идентификатор буфера)

$result = mysql_query("SHOW TABLES LIKE 'buffer_".$id_buffer."'");

$tableExists = mysql_num_rows($result) > 0;

if($tableExists==0){

//создание таблицы (buffer_[переданный идентификатор буфера])
$query2 = "CREATE TABLE ".$table_buffer." (id TEXT, date DATE, time TIME, head TEXT, author TEXT, text TEXT, tags TEXT, num TEXT, id2 INT(11) NOT NULL AUTO_INCREMENT, PRIMARY KEY(id) )";
$res2=mysql_query($query2);

}else{

};

//запрос к таблице news_releases  
$query = "SELECT * FROM news_releases WHERE id_buffer='".$id_buffer."' ";

$res=mysql_query($query);
$row=mysql_fetch_array($res);

$radio=$row['radio'];
$time=$row['time'];


//ситывание информации из news_releases
echo'
<div style="width:100%; height:50px; ">
<div style="float:left; width:80%; height:50px;">
<div style="width:100%; height:30px;"><div style="float:left; width:30px; height:30px; "></div>
<span style="font-size:18pt !important;">'.$radio.'</span></div><!--новости авторадио-->
<div style="width:100%; height:10px;"><div style="float:left; width:30px; height:30px; "></div>
<span>'.$time.'</span></div><!--10:00-->

</div>

<div align="left" style="float:left; width:20%; height:40px; background-color:transparent; padding-top:10px;">';


if(($privilege=='admin')||($privilege=='editor')){//кнопка Добавить пустой блок будет видна Администратору
//и Редактору
echo'
<!--кнопка Добавить новость -->
<a href="../action/insert_empty_news_to_buffer.php?id_buffer='.$id_buffer.'&date='.$date.'" >
<div style="width:30px; height:30px; background-color:yellow; background-image:url(\'../images/create_news_in_releases.jpg\');
background-repeat:no-repeat; float:left;" title="Добавить пустой блок"></div>
</a>';

echo'
<!--кнопка Добавить новость из корзины -->
<a >
<div style="width:30px; height:30px; margin-left:5px; 
 background-color:yellow; background-image:url(\'../images/create_news_in_releases_from_user_buffer.jpg\');
background-repeat:no-repeat; cursor:pointer; float:left " title="Добавить новость из корзины"
onclick="button_insert_news_from_user_buffer();"></div>
</a>';




echo'
<div id="div_insert_news_from_user_buffer" name="div_insert_news_from_user_buffer"
 style="position:fixed !important; width:90% !important; height:400px !important; background-color:#e6eecc !important;
 z-index:999999999900000000999999 !important; margin:0 !important; border:0 !important;
 left:50% !important; top:50% !important; margin-left:-45% !important; margin-top:-200px !important; display:none;
 border:2px black solid !important;">';
 
echo'
<form action="../action/insert_news_to_frame3_from_user_buffer.php?table_buffer='.$table_buffer.'&date='.$date.'" 
enctype="multipart/form-data" method="post" accept-charset="utf-8" onreset="hideForm(this)"> ';



echo'
<div align="right" style="width:100% !important; height:20px !important; background-color:transparent;" >
<div align="left" style="width:80px;  height:20px;">
<span onclick="hide_insert_news_from_user_buffer();" style="cursor:pointer !important;">Закрыть</span>
</div>
</div>';


echo'

<div align="center" style="width:100% !important; height:40px !important; background-color:transparent;">  
<span style="font-size:14pt !important;">Корзина</span>
</div>';
//список новостей в корзине

echo'
<div align="left" style="width:100%; height:300px; background-color:transparent; overflow:auto;">';
$user2=$_SESSION['user'];//имя пользователя


//вычисление названия таблицы-буфера пользователя.
$dbh2=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");
				
//запрос к таблице users, извлечение идентификатора пользователя по имени
$query2="SELECT * FROM users WHERE name='$user'";

$res2=mysql_query($query2);

if($res2==false){
					echo"Ошибка выполнения запроса";
					echo mysql_error();
					exit; }
$row2=mysql_fetch_array($res2);

$id_user2=$row2['id'];


//получение списка всех таблиц в базе.
//поиск таблицы user_[идентификатор пользователя]_buffer_[идентификатор буфера]
$t_list2=mysql_query('SHOW TABLES') or die("Invalid query: " . mysql_error());
 
 
 
 while($row2 = mysql_fetch_array($t_list2)) {

//разбиение строки на части , разделитель - _

$mas_name_table2=explode("_",$row2[0]);

if(($mas_name_table2[0]=="user")&&($mas_name_table2[1]==$id_user2)){//буфер пользователя найден

$buffer_user2=$row2[0];//наименование буфера пользователя, таблица типа user_[идентификатор пользователя]_buffer_[идентификатор буфера]

$query22="SELECT * FROM ".$buffer_user2." ORDER BY date, time";

$res22=mysql_query($query22);

if($res22==false){
					echo"Ошибка выполнения запроса";
					echo mysql_error();
					exit; }

//вывод содержимого корзины
$i_tmp_fr3=0;
 while($row22 = mysql_fetch_array($res22)) {
echo'<div style="width:100%; border-top:1px black solid; border-bottom:1px black solid; ">';
echo'<input type="checkbox" name="chb['.$i_tmp_fr3.']" 
value="'.$row22['id'].'" style="margin-left:5px;"/><strong>'.$row22['head'].'</strong></br>
<span style="margin-left:5px;">'.$row22['text'].'</span></br>
<span style="margin-left:5px;">'.$row22['author'].'</span></br>
<span style="margin-left:5px;">'.$row22['date'].'</span></br>
<span style="margin-left:5px;">'.$row22['time'].'</span>
';

echo'</div>';

$i_tmp_fr3++;
 }
//вывод содержимого корзины


break;
}//буфер пользователя найден
      }//конец цикла
		



echo'
</div>
';

echo'
<div align="center" style="width:100%; height:35px; background-color:transparent;">
<input type="submit" value="Добавить" style="cursor:pointer !important;"/>
<input type="reset" value="Очистить" style="cursor:pointer !important;"/>
</div>
';

echo'
</form>';


echo'
</div>
';




							echo'<script type="text/javascript">
							function button_insert_news_from_user_buffer(){
							
							div_insert_news_from_user_buffer.style.display = "block";
							
							}
							
							function hide_insert_news_from_user_buffer(){
							
							div_insert_news_from_user_buffer.style.display = "none";
							
							}	
							</script>';


};

$author_news_release=$row['author'];//автор новостного выпуска.

if($privilege=='correspondent'){//пользователь имеет привилегии Корреспондент
if($user==$author_news_release){//если имя пользователя совпадает с автором новостного выпуска, то-есть пользователь открыл "свой" 
//новостной выпуск, то кнопка Добвить пустой блок становится доступна.

echo'
<!--кнопка Добавить новость -->
<a href="../action/insert_empty_news_to_buffer.php?id_buffer='.$id_buffer.'&date='.$date.'" >
<div style="width:30px; height:30px; background-color:yellow; background-image:url(\'../images/create_news_in_releases.jpg\');
background-repeat:no-repeat; float:left; " title="Добавить пустой блок"></div>
</a>';


//если пользователь открыл свой новостной выпуск, то кнопка добавить новость из корзины 
//становится доступна
echo'
<!--кнопка Добавить новость из корзины -->
<a >
<div style="width:30px; height:30px; margin-left:5px; 
 background-color:yellow; background-image:url(\'../images/create_news_in_releases_from_user_buffer.jpg\');
background-repeat:no-repeat; cursor:pointer; float:left " title="Добавить новость из корзины"
onclick="button_insert_news_from_user_buffer();"></div>
</a>';




echo'
<div id="div_insert_news_from_user_buffer" name="div_insert_news_from_user_buffer"
 style="position:fixed !important; width:90% !important; height:400px !important; background-color:#e6eecc !important;
 z-index:999999999900000000999999 !important; margin:0 !important; border:0 !important;
 left:50% !important; top:50% !important; margin-left:-45% !important; margin-top:-200px !important; display:none;
 border:2px black solid !important;">';
 
echo'
<form action="../action/insert_news_to_frame3_from_user_buffer.php?table_buffer='.$table_buffer.'&date='.$date.'" 
enctype="multipart/form-data" method="post" accept-charset="utf-8" onreset="hideForm(this)"> ';



echo'
<div align="right" style="width:100% !important; height:20px !important; background-color:transparent;" >
<div align="left" style="width:80px;  height:20px;">
<span onclick="hide_insert_news_from_user_buffer();" style="cursor:pointer !important;">Закрыть</span>
</div>
</div>';


echo'

<div align="center" style="width:100% !important; height:40px !important; background-color:transparent;">  
<span style="font-size:14pt !important;">Корзина</span>
</div>';
//список новостей в корзине

echo'
<div align="left" style="width:100%; height:300px; background-color:transparent; overflow:auto;">';
$user2=$_SESSION['user'];//имя пользователя


//вычисление названия таблицы-буфера пользователя.
$dbh2=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");
				
//запрос к таблице users, извлечение идентификатора пользователя по имени
$query2="SELECT * FROM users WHERE name='$user'";

$res2=mysql_query($query2);

if($res2==false){
					echo"Ошибка выполнения запроса";
					echo mysql_error();
					exit; }
$row2=mysql_fetch_array($res2);

$id_user2=$row2['id'];


//получение списка всех таблиц в базе.
//поиск таблицы user_[идентификатор пользователя]_buffer_[идентификатор буфера]
$t_list2=mysql_query('SHOW TABLES') or die("Invalid query: " . mysql_error());
 
 
 
 while($row2 = mysql_fetch_array($t_list2)) {

//разбиение строки на части , разделитель - _

$mas_name_table2=explode("_",$row2[0]);

if(($mas_name_table2[0]=="user")&&($mas_name_table2[1]==$id_user2)){//буфер пользователя найден

$buffer_user2=$row2[0];//наименование буфера пользователя, таблица типа user_[идентификатор пользователя]_buffer_[идентификатор буфера]

$query22="SELECT * FROM ".$buffer_user2." ORDER BY date, time";

$res22=mysql_query($query22);

if($res22==false){
					echo"Ошибка выполнения запроса";
					echo mysql_error();
					exit; }

//вывод содержимого корзины
$i_tmp_fr3=0;
 while($row22 = mysql_fetch_array($res22)) {
echo'<div style="width:100%; border-top:1px black solid; border-bottom:1px black solid; ">';
echo'<input type="checkbox" name="chb['.$i_tmp_fr3.']" 
value="'.$row22['id'].'" style="margin-left:5px;"/><strong>'.$row22['head'].'</strong></br>
<span style="margin-left:5px;">'.$row22['text'].'</span></br>
<span style="margin-left:5px;">'.$row22['author'].'</span></br>
<span style="margin-left:5px;">'.$row22['date'].'</span></br>
<span style="margin-left:5px;">'.$row22['time'].'</span>
';

echo'</div>';

$i_tmp_fr3++;
 }
//вывод содержимого корзины


break;
}//буфер пользователя найден
      }//конец цикла
		



echo'
</div>
';

echo'
<div align="center" style="width:100%; height:35px; background-color:transparent;">
<input type="submit" value="Добавить" style="cursor:pointer !important;"/>
<input type="reset" value="Очистить" style="cursor:pointer !important;"/>
</div>
';

echo'
</form>';


echo'
</div>
';




							echo'<script type="text/javascript">
							function button_insert_news_from_user_buffer(){
							
							div_insert_news_from_user_buffer.style.display = "block";
							
							}
							
							function hide_insert_news_from_user_buffer(){
							
							div_insert_news_from_user_buffer.style.display = "none";
							
							}	
							</script>';





}//если имя пользователя совпадает с автором новостного выпуска, то-есть пользователь открыл "свой" 
//новостной выпуск, то кнопка Добвить пустой блок становится доступна.
}//пользователь имеет привилегии Корреспондент




echo'
</div>


</div>
';






//сбор идентификаторов новостей из таблицы buffer_(идентификатор буфера).
$query="SELECT * FROM buffer_".$id_buffer." ORDER BY num  ";
$res=mysql_query($query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
$string_id_text="";//строка, в которую будут записываться идентификаторы
$row=mysql_fetch_array($res);
$tmp_id="".$row['id'];
$string_id_text=$tmp_id;

while($row=mysql_fetch_array($res)){
$tmp_id=$row['id'];
$string_id_text=$string_id_text."+"."".$tmp_id;


}



//поле со скроллингом, где содержатся новостные выпуски
echo'<form action="../action/submit_news_to_buffer.php?id_buffer='.$id_buffer.'&string_id_text='.$string_id_text.'&date='.$date.'"
 id="div_new_form" name="div_new_form"
enctype="multipart/form-data" method="post" accept-charset="utf-8" onreset="hideForm(this)"> ';

echo'
<div style="width:100%; height:30px; background-color:transparent;"></div>
<div style="width:100%; height:400px; background-color:transparent; overflow:auto; border-bottom:2px black solid; 
border-top:2px black solid;">';

//количество записей в таблице
$query="SELECT COUNT(*) FROM buffer_".$id_buffer." ";
$res=mysql_query($query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
 $row = mysql_fetch_row($res);
 $total = $row[0];


$query = "SELECT * FROM buffer_".$id_buffer." ORDER BY num ";
$res=mysql_query($query);


$count_tmp=1;
while($row=mysql_fetch_array($res)){

echo'<div align="left" style="width:100%; height:130px; background-color:transparent; margin-top:10px;">'; 
echo'<div style="float:left; height:130px; width:10px; background-color:transparent;"></div>';

echo'<div style=" float:left; width:80%; height:130px; background-color:transparent;">

<textarea style="width:100%;" id="id_text_'.$row['id'].'" name="id_text_'.$row['id'].'" >'.$row['text'].'</textarea></div>';

echo'<div style="float:left;width:30px; height:130px; background-color:transparent;">';



if(($privilege=='admin')||($privilege=='editor')){//Кнопка Удалить блок доступна Администратору и Редактору
echo'<a href="../action/delete_news_from_buffer.php?id_buffer='.$id_buffer.'&id='.$row['id'].'&date='.$date.'"  style="cursor:pointer;">
<div style="width:30px; height:30px; background-color:yellow;  cursor:pointer;
background-image:url(\'../images/button_delete.jpg \'); background-repeat:no-repeat; 
 " title="Удалить"></div></a>';
 }//Кнопка Удалить блок доступна Администратору и Редактору
 
 if($privilege=='correspondent'){//пользователь имеет привилегии Корреспондент
if($user==$author_news_release){//если имя пользователя совпадает с автором новостного выпуска, то-есть пользователь открыл "свой" 
//новостной выпуск, то кнопка Удалить блок становится доступна.

echo'<a href="../action/delete_news_from_buffer.php?id_buffer='.$id_buffer.'&id='.$row['id'].'&date='.$date.'"  style="cursor:pointer;">
<div style="width:30px; height:30px; background-color:yellow;  cursor:pointer;
background-image:url(\'../images/button_delete.jpg \'); background-repeat:no-repeat; 
 " title="Удалить"></div></a>';

}
}
 

echo'<div style="width:30px; height:10px;"></div> ';

//если новость самая верхняя, то кнопка переместить наверх отсутствует
if($count_tmp==1){

}else{


if(($privilege=='admin')||($privilege=='editor')){//Кнопка Переместить выше доступна Администратору и Редактору
echo'<a href="../action/news_buffer_up.php?id_buffer='.$id_buffer.'&id='.$row['id'].'&date='.$date.'" style="cursor:pointer;">
<div style="width:30px; height:30px; background-color:yellow; background-image:url(\'../images/button_up.jpg\');
background-repeat:no-repeat;" title="Переместить выше"></div></a>';
}//Кнопка Переместить выше доступна Администратору и Редактору

 if($privilege=='correspondent'){//пользователь имеет привилегии Корреспондент
if($user==$author_news_release){//если имя пользователя совпадает с автором новостного выпуска, то-есть пользователь открыл "свой" 
//новостной выпуск, то кнопка Переместить выше становится доступна.
echo'<a href="../action/news_buffer_up.php?id_buffer='.$id_buffer.'&id='.$row['id'].'&date='.$date.'" style="cursor:pointer;">
<div style="width:30px; height:30px; background-color:yellow; background-image:url(\'../images/button_up.jpg\');
background-repeat:no-repeat;" title="Переместить выше"></div></a>';
}
}



};

echo'<div style="width:30px; height:10px;"></div> ';

//если новость самая нижняя, то кнопка переместить вниз отсутствует
if($count_tmp==$total){ 
}else{



if(($privilege=='admin')||($privilege=='editor')){//Кнопка Переместить ниже доступна Администратору и Редактору
echo'<a href="../action/news_buffer_down.php?id_buffer='.$id_buffer.'&id='.$row['id'].'&date='.$date.'" style="cursor:pointer;">
<div style="width:30px; height:30px; background-color:yellow; background-image:url(\'../images/button_down.jpg\');
background-repeat:no-repeat;" title="Переместить ниже"></div></a>';
}


 if($privilege=='correspondent'){//пользователь имеет привилегии Корреспондент
if($user==$author_news_release){//если имя пользователя совпадает с автором новостного выпуска, то-есть пользователь открыл "свой" 
//новостной выпуск, то кнопка Переместить ниже становится доступна.
echo'<a href="../action/news_buffer_down.php?id_buffer='.$id_buffer.'&id='.$row['id'].'&date='.$date.'" style="cursor:pointer;">
<div style="width:30px; height:30px; background-color:yellow; background-image:url(\'../images/button_down.jpg\');
background-repeat:no-repeat;" title="Переместить ниже"></div></a>';
}
}



}

echo'</div>';

echo'</div>';
$count_tmp++;
};


echo'
</div>


';



if(($privilege=='admin')||($privilege=='editor')){//Кнопка Готово доступна Администратору и Редактору

echo'
<div align="center" style="width:100%; height:40px; background-color:transparent; padding-top:10px;">

<input type="submit" value="Готово" style="width:200px; height:30px; cursor:pointer;"/>

</div>
';

}

 if($privilege=='correspondent'){//пользователь имеет привилегии Корреспондент
if($user==$author_news_release){//если имя пользователя совпадает с автором новостного выпуска, то-есть пользователь открыл "свой" 
//новостной выпуск, то кнопка Переместить ниже становится доступна.
echo'
<div align="center" style="width:100%; height:40px; background-color:transparent; padding-top:10px;">

<input type="submit" value="Готово" style="width:200px; height:30px; cursor:pointer;"/>

</div>
';
}
}





echo'</form>';


}




?>


	
	

</body>

</html>
