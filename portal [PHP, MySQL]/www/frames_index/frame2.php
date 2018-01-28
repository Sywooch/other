<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require '../config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);


if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)){//если пользователь незарегистрирован, то он выбрасывается 
//на страницу авторизации

header("Refresh: 1; URL=login.php");
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


<!--ajax-->
<script type="text/javascript" src="../jquery/jquery.js"></script>
<!--ajax-->



</head>

<body  style="background-color:white; margin:0 !important; padding:0 !important; border:0 !important;">

<div id="div_frame2" name="div_frame2" style="padding:0; border:0; margin:0; width:100%; height:100%; position:fixed;
 background-color:white; 
display:none;  z-index:99999999999; opacity: 0.7;  filter: alpha(Opacity=70);  ">
</div>


<?php
if((!isset($_GET['date']))){
///попадаем сюда изначально
}else{




if(isset($_GET['id'])){
$id_yellow=$_GET['id'];//идентификатор новости, используется для раскраски выбранного блока.
};
//попадаем сюда после выбора блока с датой в первом фрейме
$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");//соединение
mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                    mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");

$date=$_GET['date'];//дата


///перезагрузка первого фрейма 
//выделение выбранной даты.
echo'
<script type="text/javascript">
parent.frame1.location = "frame1.php?date='.$date.'";
</script>';





$query = "SELECT * FROM news WHERE date='".$date."' ORDER BY time DESC";
$res=mysql_query($query);

///////цикл
$count_scroll=0;
$count_scroll2=0;
while($row=mysql_fetch_array($res)){

if($privilege=='admin'){//пользователь имеет привилегии Администратора

 if($row['edit']=='1'){//новость редактируется
//если новость редактируется, то Администратор не сможет её удалить.

}//новость редактируется
else{//новость не редактируется

echo'<div id="delete_news_block'.$row['id'].'" name="delete_news_block'.$row['id'].'"
 style="width:100%; height:20px; margin-top:10px; border-bottom:2px black solid; display:block;" >';

echo'
					<!--кнопка Удалить Новостной блок -->
							<div align="center" style="width:95px; height:18px; border:1px black solid; 
							padding:0 !important; cursor:pointer; background-color:transparent; 
							position:relative !important; z-index:9 !important;
							float:left; border-left:0px black solid;" 
							onclick="button_delete'.$row['id'].'();">
							<span style="font-size:10pt !important;">Удалить</span>
							</div>
							<!--кнопка Удалить Новостной блок  -->';
							
							
					echo'		<script type="text/javascript">
							function button_delete'.$row['id'].'(){
							var show = confirm("Вы действительно хотите удалить новостной блок ?");
							
							if(show==true){
							document.location.href = "../action/delete_news_block.php?id='.$row['id'].'";
							}else{
							
							
							}
							
							
							}
							</script>';
							
							
	echo'</div>';	

}//новость не редактируется

}//пользователь имеет привилегии Администратора


//-----------------------------------
//Проверка, используется ли данная новость в каком-либо выпуске новостей
//$row['id']  - идентификатор новости
//просмотр всех таблиц типа (buffer_[идентификатор буфера]) и поиск в них
//новости с идентификатором $row['id'].
$log=0;//примет значение 1 , если новость используется
//В противном случае принимает значение 0.
$name_radio="";//наименование радио, в выпуске которого задействована новость.

//получение списка всех таблиц в базе.
//поиск таблицы user_[идентификатор пользователя]_buffer_[идентификатор буфера]
$t_list=mysql_query('SHOW TABLES') or die("Invalid query: " . mysql_error());
 

 
 while($row2 = mysql_fetch_array($t_list)) {

//разбиение строки на части , разделитель - _

$mas_name_table2=explode("_",$row2[0]);

if(($mas_name_table2[0]=="buffer")){//буфер найден

$buffer2=$row2[0];//наименование буфера, таблица типа buffer_[идентификатор буфера]

$buffer2_id=$mas_name_table2[1];//идентификатор буфера
//поиск в буфере новости с идентификатором $row['id']
$query3=mysql_query("SELECT * FROM ".$buffer2." WHERE id=".$row['id']."");

 if (!$result = mysql_fetch_array($query3)){
        // записи нет
       
    }
    else
    {
       //запись есть
	   $log=1;
	   
	   //определение радио, в котором задействована новость.
	   $query4="SELECT * FROM news_releases WHERE id_buffer=".$buffer2_id."";
	   $res4=mysql_query($query4);
		$row4=mysql_fetch_array($res4);
	   $name_radio=$row4['radio'];
	   
	   break;
	   
    }

}//буфер пользователя найден


      }//конец цикла


 

//----------------------------------

echo'<div id="div'.$row['id'].'" name="div'.$row['id'].'" 
style="width:100%; height:300px; position:absolute; background-color:transparent; z-index:99999999999; 
display:none;"></div>';


if($row['edit']=='0'){  
echo'<a target="frame3" href="frame3.php?id='.$row['id'].'" > ';
}else{


};

if(isset($_GET['id'])){
 if(($row['id']==$id_yellow)){
  echo'<div style="width:100%; height:300px; border-bottom:2px black solid; cursor:pointer; background-color:yellow;">';
  $count_scroll2=$count_scroll;
  }else{
  echo'<div style="width:100%; height:300px; border-bottom:2px black solid; cursor:pointer;">';
 }
}else{
 echo'<div style="width:100%; height:300px; border-bottom:2px black solid; cursor:pointer;">';
}
$id=$row['id'];



echo'<!--заголовок и время создания/редактирования-->
<div style="width:100%; height:40px; border-bottom:1px black solid; background-color:transparent;">
<div align="left" style="padding-top:5px; padding-bottom:5px; height:30px; float:left; width:80%; background-color:transparent;
font-size:16pt !important; font-weigh:bold !important">
<span style="color:black; font-size:16pt; margin-left:10px; "  id="head'.$id.'" name="head'.$id.'">
<strong>'.$row['head'].'</strong></span>
</div>

<div align="left" style=" height:40px; float:left; width:20%; background-color:transparent;
padding">
<div align="right" style="height:40px; float:left; width:90%;background-color:transparent;">
<div style="width:100%; height:5px; "></div>
<span style="color:black; font-size:14pt;">'.$row['time'].'</span>

</div>

<div style="height:40px; float:left; width:10%; background-color:transparent;"></div>

</div>

</div>


<!---->
<div style="width:100%; height:259px; background-color:transparent;">
<div style="width:90%; height:259px; float:left; background-color:transparent;">
<div style="width:90%; height:30px; background-color:transparent;">
<span style="margin-left:10px;color:black;" id="author'.$id.'" name="author'.$id.'">'.$row['author'].'</span></div>
<div align="center" style="width:100%; height:180px; background-color:transparent;  padding-top:5px; padding-bottom:15px; overflow:hidden; ">';
echo'
<div align="left" style="width:90%; height:180px; overflow:hidden; background-color:transparent;">';


echo'
<span style="color:black; font-size:10pt !important;" id="text'.$id.'" name="text'.$id.'"  >'.$row['text'].'</span>
';

echo'
</div>';

echo'
</div>
<div style="width:90%; height:30px; background-color:transparent; overflow:hidden;">
<span style="margin-left:10px; color:black;" id="tags'.$id.'" name="tags'.$id.'" >'.$row['tags'].'</span>
</div>

</div>
<div style="width:10%; height:259px; float:left; background-color:transparent;">
<!--метка - статус редактирования новости-->
<div style="width:100%; height:30px; background-color:transparent;">


<div id="edit1'.$id.'" name="edit1'.$id.'" ';

 
echo' style="width:30px; height:30px;';
 
 if($row['edit']=='1'){
 echo'background-color:red; background-image:url(\'../images/stop.jpg \'); background-repeat:no-repeat; ';
 
 
 //новость редактируется
 }else{
 echo' background-color:green; display:none;';//новость отредактирована
  };
 
 
 echo'
 "></div>
</div>
';

if($log==1){
echo'
<div style="width:100%; height:30px; background-color:transparent;">
<div style="width:30px; height:30px; background-color:green;
background-image:url(\'../images/radio/'.$name_radio.'.jpg\'); background-repeat:no-repeat;"
 title="Новость используется в выпуске новостей радиостанции '.$name_radio.'"
 >

</div>
</div>
';
};


if($row['edited']!='0'){
echo'
<div style="width:100%; height:30px; background-color:transparent;">
<div style="width:30px; height:30px; background-color:blue;
background-image:url(\'../images/edited.jpg\'); background-repeat:no-repeat;"
 title="Новость отредактирована пользователем '.$row['edited'].'"
 >

</div>
</div>
';
};




echo'

</div>

</div>
</div>

</div>
';

if($row['edit']=='0'){  
echo'</a> ';
}else{


};



echo'
<script type="text/javascript">
	setInterval(function() {
	
   	$.ajax({
					type: "POST",
					url: "../ajax_action/ajax_action_head_down.php?id='.$id.'",
					data: "id="+'.$id.',
					success: function(html){
						$("#head'.$id.'").html(html);
						 document.getElementById("head'.$id.'").style.fontWeight="bold";
					  
				   }
				})
				return false;
				
	}, 1000);
</script>


<script type="text/javascript">
setInterval(function() {
  	$.ajax({
					type: "POST",
					url: "../ajax_action/ajax_action_text_down.php?id='.$id.'",
					data: "id="+'.$id.',
					success: function(html){
				


//замена object на img.
html=html.replace(/<object/g,"<div style=\"width:300px; height:20px; display:inline-block; background-color:transparent; overflow:hidden; color:transparent !important; background-image:url(\'../images/player.jpg \'); background-repeat:no-repeat;\" ");

html=html.replace(/<object\/>/g,"<div/>");
html=html.replace(/<embed/g,"<input style=\"display:none;\"");


	   $("#text'.$id.'").html(html);
 
				
						
				   }
				})
				return false;
				
	}, 1000);
</script>	


<script type="text/javascript">	
	setInterval(function() {
   	$.ajax({
					type: "POST",
					url: "../ajax_action/ajax_action_author_down.php?id='.$id.'",
					data: "id="+'.$id.',
					success: function(html){
					    $("#author'.$id.'").html(html);
						//document.getElementById("author'.$id.'").innerHTML = html;
						
				   }
				})
				return false;
				
	}, 1000);
	</script>
	
	
<script type="text/javascript">
	setInterval(function() {
   	$.ajax({
					type: "POST",
					url: "../ajax_action/ajax_action_tags_down.php?id='.$id.'",
					data: "id="+'.$id.',
					success: function(html){
					    $("#tags'.$id.'").html(html);
						//document.getElementById("author'.$id.'").innerHTML = html;
						
				   }
				})
				return false;
				
	}, 1000);
	
	</script>

<script type="text/javascript">
	setInterval(function() {
   	$.ajax({
					type: "POST",
					url: "../ajax_action/ajax_action_edit_down.php?id='.$id.'",
					data: "id="+'.$id.',
					success: function(html){
					
					if(html==1){
					$(\'#edit1'.$id.'\').css("background-color","red");
					$(\'#edit1'.$id.'\').css("background-image","url(../images/stop.jpg)");
					var elm = parent.frame2.document.getElementById("div'.$row['id'].'");
					elm.style.display = "block";// блокировка блока
	
	var elm2 = parent.frame2.document.getElementById("delete_news_block'.$row['id'].'");
					elm2.style.display = "none";// сокрытие кнопки Удалить
					 }else{
					 
					$(\'#edit1'.$id.'\').css("background-color","transparent");
					$(\'#edit1'.$id.'\').css("background-image","url(../images/stop2.png)");
					 var elm2 = parent.frame2.document.getElementById("delete_news_block'.$row['id'].'");
					elm2.style.display = "block";// показ кнопки Удалить
					 }
					 
					 
						//document.getElementById("author'.$id.'").innerHTML = html;
						
				   }
				})
				return false;
				
	}, 200);
	
	</script>
	

';

$count_scroll++;

}
///////цикл



$height_scroll=$count_scroll2*300;
echo'
<script type="text/javascript">
 

$(document).ready(function(){
   window.scrollBy(0,'.$height_scroll.');
});
</script>';


};


?>


</body>

</html>
