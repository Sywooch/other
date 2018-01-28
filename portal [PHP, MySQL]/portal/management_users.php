<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require 'config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);




if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)){//если пользователь незарегистрирован, то он выбрасывается 
//на страницу авторизации

header("Refresh: 1; URL=login.php");
exit;
};

//проверка, является ли пользователь администратора.
//вычисление уровня привилегий


$dbh = mysqli_init();
mysqli_options($dbh, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT=0");
mysqli_options($dbh, MYSQLI_OPT_CONNECT_TIMEOUT, 5);

mysqli_real_connect($dbh, DB_SERVER, DB_USER, DB_PASS);

if (mysqli_connect_errno()) {
    printf("Ошибка соединения: %s\n", mysqli_connect_error());
    exit();
}
//соединение
mysqli_query($dbh,"SET NAMES utf8");
					mysqli_query ($dbh,"SET COLLATION_CONNECTION=utf8");
                   mysqli_query($dbh,"SET CHARACTER_SET_CLIENT=utf8");
					mysqli_query($dbh,"SET CHARACTER_SET_RESULTS=utf8");	
					
					mysqli_select_db($dbh, DB_BASE);
					
	$user=$_SESSION['user'];				
$query = "SELECT * FROM users WHERE name='$user' ";					
	$res=mysqli_query($dbh, $query);				
	$row=mysqli_fetch_array($res);
	
	
	
$privilege=$row['privilege'];//привилегии пользователя

if($privilege=='admin'){//если пользователь не имеет полномочий администратора, от он выбрасывается 
//на Главную страницу.


}else{
header("Refresh: 1; URL=index.php");
exit;

}

	


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Фабрика новостей - Управление пользователями</title>
<script type="text/javascript" src="jquery/jquery.js"></script>

<script type="text/javascript">
							function exit_user(){
							
							
							var show = confirm("Вы действительно хотите выйти ? Обратите внимание, что при выходе будет уничтожена Ваша корзина с новостями.");
							
							if(show==true){
							document.location.href = "action/exit_and_drop_buffer_user.php";
							}else{
							
							
							}
							
							
							}
							</script>
</head>

<body style="padding:0 !important; margin:0 !important; border:0 !important;">

<!--имя авторизованного пользователя-->
<div align="left" style="width:500px; height:50px; background-color:transparent; position:fixed; margin:0 !important;
padding:0 !important; border:0 !important; left:10px !important;">

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
					
	$user=$_SESSION['user'];				
$query = "SELECT * FROM users WHERE name='$user' ";					
	$res=mysqli_query($dbh, $query);				
	$row=mysqli_fetch_array($res);
echo"".$row['privilege']."";				
 
 
 ?>
 </strong>
 
 </span>

<span style="font-size:12pt; margin-left:10px;">
 Состояние <a href="edit_user_buffer.php" target="top" title="Посмотреть\Изменить содержимое Корзины">корзины:</a>
 
 </span>
  <span style="font-size:12pt; margin-left:3px;">
<?php
//получение содержимого корзины.
$name_user=$_SESSION['user'];//получение имени авторизованного пользователя


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
					
					
//запрос к таблице users, извлечение идентификатора пользователя по имени
$query="SELECT * FROM users WHERE name='$name_user'";

$res=mysqli_query($dbh, $query);

if($res==false){
					echo"Ошибка выполнения запроса.1";
					echo mysql_error();
					exit; }
$row=mysqli_fetch_array($res);

$id_user=$row['id'];

//получение списка всех таблиц в базе.
//поиск таблицы user_[идентификатор пользователя]_buffer_[идентификатор буфера]
$t_list=mysqli_query($dbh,'SHOW TABLES');



 
 while($row = mysqli_fetch_array($t_list)) {

//разбиение строки на части , разделитель - _

$mas_name_table=explode("_",$row[0]);

if(($mas_name_table[0]=="user")&&($mas_name_table[1]==$id_user)){//буфер пользователя найден

$buffer_user=$row[0];//наименование буфера пользователя, таблица типа user_[идентификатор пользователя]_buffer_[идентификатор буфера]

//подсчёт количества новостей в буфере пользователя.
 $res3 = mysqli_query($dbh,"SELECT COUNT(*) FROM ".$buffer_user."");
 $row3 = mysqli_fetch_row($res3);
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
<!--имя авторизованного пользователя-->





<div align="center" style="width:100%; height:100%;">
<div align="center" style="width:100%; height:60px;padding-top:10px; background-color:transparent;">
<!--кнопка Добавить пользователя -->
<div align="center" style=" width:205px; height:40px; border:2px black solid; 
							padding:0 !important; cursor:pointer; background-color:transparent; 
							position:relative !important; z-index:9 !important;" 
							onclick="button_insert_user();">
							<span style="font-size:12pt !important;"><strong>Добавить нового пользователя</strong></span>
							</div>
<!--кнопка Добавить пользователя -->
</div>


<!--поле, котором будет выводиться список пользователей-->
<div align="center" style="width:100%;">
<?php



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
					

//получение списка пользователей
$query="SELECT * FROM users ORDER BY name";

 $res=mysqli_query($dbh, $query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
					
while($row=mysqli_fetch_array($res)){//вывод списка пользователей
echo'<div align="center" style="width:100%; height:150px; border-top:1px transparent solid; border-bottom:1px transparent solid;">
<div align="left" style="width:500px; height:148px; border:1px black solid;">

<div align="left" style="width:490px; height:30px; background-color:transparent; padding-left:5px; 
padding-right:5px;">
<span style="font-size:12pt !impoirtant;"><strong>Имя:</strong> '.$row['name'].'</span>
</div>
<div align="left" style="width:490px; height:30px; background-color:transparent; padding-left:5px;
padding-right:5px;">
<span style="font-size:12pt !impoirtant;"><strong>Привилегии:</strong> '.$row['privilege'].'   
<span style="float:right; cursor:pointer; text-decoration:underline !important;" 
onclick="button_delete_user2'.$row['id'].'();">Изменить привилегии</span></span>
</div>
<div align="left" style="width:490px; height:30px; background-color:transparent; padding-left:5px;
padding-right:5px;">
<span style="font-size:12pt !impoirtant;"><strong>Дата регистрации:</strong> '.$row['date'].'</span>
</div>
<div align="left" style="width:490px; height:30px; background-color:transparent; padding-left:5px;
padding-right:5px;">
<span style="font-size:12pt !impoirtant;"><strong>Время регистрации:</strong> '.$row['time'].'</span>
</div>
<div align="right" style="width:490px; height:30px; background-color:transparent; padding-left:5px;
padding-right:5px;">
<span style="font-size:12pt !important; text-decoration:underline !important; 
 cursor:pointer !important;" 
onclick="button_delete_user'.$row['id'].'();">Удалить пользователя</span>
</div>

</div>
</div>';









//скрипт удаления пользователя
echo'
<script type="text/javascript">
							function button_delete_user'.$row['id'].'(){
							var show = confirm("Вы действительно хотите удалить пользователя '.$row['name'].' ?");
							
							if(show==true){
							document.location.href = "action/delete_user.php?id='.$row['id'].'";
							}else{
							
							
							}
							
							
							}
							</script>';
//скрипт удаления пользователя							



//вывод формы изиенения привилегий
echo'<script type="text/javascript">
							function button_delete_user2'.$row['id'].'(){
												
							div_privilege'.$row['id'].'.style.display = "block";
							
							}
							
							function hide_div_privilege'.$row['id'].'(){
							
							div_privilege'.$row['id'].'.style.display = "none";
							
							}	
							</script>';
//вывод формы изиенения привилегий



//форма изменения привилегий пользователя

echo'
<div id="div_privilege'.$row['id'].'" name="div_privilege'.$row['id'].'"
 style="position:fixed !important; width:500px !important; height:200px !important; background-color:#e6eecc !important;
 z-index:999999999900000000999999 !important; margin:0 !important; border:0 !important;
 left:50% !important; top:50% !important; margin-left:-251px !important; margin-top:-101px !important; display:none;
 border:2px black solid !important;">';
 

echo'
<form action="action/change_privilege.php?id='.$row['id'].'" id="div_privilege_form" name="div_privilege_form"
enctype="multipart/form-data" method="post" accept-charset="utf-8" onreset="hideForm(this)"> 

<div  style="width:500px !important; height:20px !important;" >
<div style="width:440px; float:left; height:20px;"></div>
<div style="width:60px; float:left; height:20px;">
<span onclick="hide_div_privilege'.$row['id'].'();" style="cursor:pointer !important;">Закрыть</span>
</div>
</div>

<div align="center" style="width:500px !important; height:40px !important; background-color:transparent;">  
<span style="font-size:14pt !important;">Смена привилегий</span>
</div>

<div style="width:500px !important; height:40px !important; background-color:transparent;">
<div style="width:50px !important; height:40px !important; float:left;" ></div>
<div style="width:450px !important; height:40px !important; float:left; background-color:transparent;">
<div style="width:200px; float:left; height:40px; background-color:transparent;">
<span style="font-size:14pt !important;">Новые привилегии:</span></div>
<div aligh="left" style="float:left; height:40px; width:200px; background-color:transparent;"> 
<select id="privilege" name="privilege" size="1" style="float:left;">
<option value="1">Корреспондент</option>
<option value="2">Редактор</option>
<option value="3">Админ</option>
</select>
</div>


</div>
</div>

<div style="width:500px; height:30px;"></div>

<div align="center" style="width:500px; height:40px;">

<input type="submit" value="OK" style="cursor:pointer !important; width:100px; height:30px;"/>
<input type="reset" value="Очистить" style="cursor:pointer !important; width:100px; height:30px;"/>

</div>



</form>';

echo'


</div>
';


//форма изменения привилегий пользователя



}//вывод списка пользователей


?>
</div>
<!--поле, котором будет выводиться список пользователей-->







<!--форма добавления нового пользователя-->
<div id="div_insert_user" name="div_insert_user"
 style="position:fixed !important; width:500px !important; height:270px !important; background-color:#e6eecc !important;
 display:none; z-index:999999999900000000999999 !important; margin:0 !important; border:0 !important;
 left:50% !important; top:50% !important; margin-left:-251px !important; margin-top:-201px !important; display:none;
 border:2px black solid !important;">
 


<form action="action/insert_user.php" id="div_insert_user_form" name="div_insert_user_form"
enctype="multipart/form-data" method="post" accept-charset="utf-8" onreset="hideForm(this)"> 

<div  style="width:500px !important; height:20px !important;" >
<div style="width:440px; float:left; height:20px;"></div>
<div style="width:60px; float:left; height:20px;">
<span onclick="hide_div_insert_user();" style="cursor:pointer !important;">Закрыть</span>
</div>
</div>

<div align="center" style="width:500px !important; height:40px !important; background-color:transparent;">  
<span style="font-size:14pt !important;">Добавление нового пользователя</span>
</div>

<div style="width:500px; height:30px; "></div>


<div style="width:500px !important; height:40px !important; background-color:transparent;">
<div style="width:10px !important; height:40px !important; float:left;" ></div>


<div style="width:490px !important; height:40px !important; float:left; background-color:transparent;">
<div align="left" style="width:180px; float:left; height:40px; background-color:transparent;">
<span style="font-size:14pt !important;">Имя пользователя:</span></div>
<div align="left" style="float:left; height:40px; width:260px; background-color:transparent;"> 
<input type="text" autocomplete="off" name="name" id="name" style="width:270px; height:20px;"/>
</div>
</div>

</div>




<div style="width:500px !important; height:40px !important; background-color:transparent;">
<div style="width:10px !important; height:40px !important; float:left;" ></div>

<div align="left" style="width:490px !important; height:40px !important; float:left; background-color:transparent;">
<div style="width:180px; float:left; height:40px; background-color:transparent">
<span style="font-size:14pt !important;">Пароль:</span></div>
<div align="left" style="float:left; height:40px; width:260px; background-color:transparent;"> 
<input type="password" name="password" id="password" style="width:270px; height:20px;"/>
</div>
</div>




<div style="width:500px !important; height:40px !important; background-color:transparent;">
<div style="width:10px !important; height:40px !important; float:left;" ></div>


<div align="left"  style="width:490px !important; height:40px !important; float:left; background-color:transparent;">
<div style="width:180px; float:left; height:40px; background-color:transparent">
<span style="font-size:14pt !important;">Уровень привилегий:</span></div>
<div align="left"  style="float:left; height:40px; width:270px; background-color:transparent;"> 

<select id="privilege" name="privilege">
<option value="1">Корреспондент</option>
<option value="2">Редактор</option>
<option value="3">Админ</option>
</select>

</div>
</div>







</div>



<div style="width:500px; height:30px;"></div>

<div align="center" style="width:500px; height:40px;">

<input type="submit" value="OK" style="cursor:pointer !important; width:150px; height:40px;"/>
<input type="reset" value="Очистить" style="cursor:pointer !important; width:150px; height:40px;"/>

</div>



</form>


</div>





							<script type="text/javascript">
							function button_insert_user(){
							
							div_insert_user.style.display = "block";
							
							}
							
							function hide_div_insert_user(){
							
							div_insert_user.style.display = "none";
							
							}	
							</script>



<?php



?>

</body>

</html>
