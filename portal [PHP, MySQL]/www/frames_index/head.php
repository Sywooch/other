<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require '../config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="../jquery/jquery.js"></script>




<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script type="text/javascript" src="../jquery/jquery.js"></script>

<script type="text/javascript">

function frame3()
{
parent.frame3.location = "frame3.php?id=_";
}

</script>
<script type="text/javascript">
							function exit_user(){
							
							
							var show = confirm("Вы действительно хотите выйти ? Обратите внимание, что при выходе будет уничтожена Ваша корзина с новостями.");
							
							if(show==true){
							parent.window.location.href = "../action/exit_and_drop_buffer_user.php";
							}else{
							
							
							}
							
							
							}
							</script>
</head>

<body style="background-color:transparent; margin:0 !important; padding:0 !important; border:0 !important;">
<div style="width:100%; height:50px; ">

<div align="left" style="width:500px; height:50px; background-color:transparent; float:left;">
<span style="font-size:12pt;margin-left:3px;">Вы вошли как: <strong><?php echo"".$_SESSION['user']."";

if(!isset($_SESSION['user'])){
echo"error";
}

 ?></strong><span style="font-size:12pt; margin-left:10px; text-decoration:underline;
 cursor:pointer;" onclick="exit_user();">Выход</span></br>
 	
	
 
 
 
 <span style="font-size:12pt;margin-left:3px;">Привилегии: </span>
 <strong>
 <?php

 //вычисление уровня привилегий
 $dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");//соединение
mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                    mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");
	$user=$_SESSION['user'];				
$query = "SELECT * FROM users WHERE name='$user' ";					
	$res=mysql_query($query);				
	$row=mysql_fetch_array($res);
echo"".$row['privilege']."";				
 
 $privilege=$row['privilege'];//привилегии пользователя.
 
 ?>
 </strong>
 
 </span>
<span style="font-size:12pt; margin-left:10px;">
 Состояние <a href="../edit_user_buffer.php" target="top" title="Посмотреть\Изменить содержимое Корзины">корзины:</a>
 
 </span>
  <span id="span_user_buffer" name="span_user_buffer" style="font-size:12pt; margin-left:3px;">
<?php
//получение содержимого корзины.
$name_user=$_SESSION['user'];//получение имени авторизованного пользователя
$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");
					
//запрос к таблице users, извлечение идентификатора пользователя по имени
$query="SELECT * FROM users WHERE name='$name_user'";

$res=mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса.1";
					echo mysql_error();
					exit; }
$row=mysql_fetch_array($res);

$id_user=$row['id'];

//получение списка всех таблиц в базе.
//поиск таблицы user_[идентификатор пользователя]_buffer_[идентификатор буфера]
$t_list=mysql_query('SHOW TABLES') or die("Invalid query: " . mysql_error());



 
 while($row = mysql_fetch_array($t_list)) {

//разбиение строки на части , разделитель - _

$mas_name_table=explode("_",$row[0]);

if(($mas_name_table[0]=="user")&&($mas_name_table[1]==$id_user)){//буфер пользователя найден

$buffer_user=$row[0];//наименование буфера пользователя, таблица типа user_[идентификатор пользователя]_buffer_[идентификатор буфера]

//подсчёт количества новостей в буфере пользователя.
 $res3 = mysql_query("SELECT COUNT(*) FROM ".$buffer_user."");
 $row3 = mysql_fetch_row($res3);
 $total = $row3[0]; // всего записей

if($total==0){//буфер пользователя пуст

echo"<strong>Корзина пуста</strong>";
}else if($total>0){

echo"<strong>".$total." новостей</strong>";
}


break;
}//буфер пользователя найден


      }//конец цикла





?> 
 </span>
 

 
</div>



<div align="center" style="float:right; width:200px; height:50px; background-color:transparent;">
<a onclick="frame3()" target="frame2" href="frame2.php" style="color:white; text-decoration:none;">
<div style="width:150px; height:40px; background-color:transparent; margin-top:4px; border:2px black solid; ">
<span style="color:black; text-decoration:none; font-size:12pt !important;"><strong>Создать новостной блок</strong></span>
</div></a>
</div>

<div align="center" style="float:right; width:200px; height:50px; background-color:transparent;">
<a href="../create_news.php?step=1" target="_top" style="color:white; text-decoration:none;">
<div style="width:150px; height:40px; background-color:transparent; margin-top:4px; border:2px black solid; ">
<span style="color:black; text-decoration:none; font-size:12pt !important"><strong>Создать новостной выпуск</strong></span>
</div></a>
</div>

<?php
if($privilege=='admin'){//кнопка Управление пользователями доступна только Администратору
echo'
<div align="center" style="float:right; width:200px; height:50px; background-color:transparent;">
<a href="../management_users.php" target="_top" style="color:white; text-decoration:none;">
<div style="width:150px; height:40px; background-color:transparent; margin-top:4px; border:2px black solid; ">
<span style="color:black; text-decoration:none; font-size:12pt !important"><strong>Управление пользователями</strong></span>
</div></a>
</div>';
}//кнопка Управление пользователями доступна только Администратору
else{};


?>



<div align="center" style="float:right; width:200px; height:50px; background-color:transparent;">
<a href="../index_create_news_releases.php" target="_top" style="color:white; text-decoration:none;">
<div style="width:170px; height:40px; background-color:transparent; margin-top:4px; border:2px black solid; ">
<span style="color:black; text-decoration:none; font-size:11pt !important"><strong>Просмотр новостных выпусков</strong></span>
</div></a>
</div>



</div>

 <!--чтение состояния корзины-->
 <script type="text/javascript">	
 
 
	setInterval(function() {
	
   	$.ajax({
					type: "POST",
					url: "../ajax_action/ajax_action_buffer_user_down.php",
					data: "id="+'',
					success: function(html){
					    $("#span_user_buffer").html(html);
						//document.getElementById("author'.$id.'").innerHTML = html;
						
				   }
				})
				return false;
				
	}, 1000);
	</script>

</body>

</html>
