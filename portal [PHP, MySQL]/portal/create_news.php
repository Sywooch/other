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





?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Фабрика новостей - Создание новостного выпуска</title>
<script type="text/javascript" src="jquery/jquery.js"></script>

 <link rel="stylesheet" type="text/css" href="css_menu/demo.css" />
        <link rel="stylesheet" type="text/css" href="css_menu/style2.css" />
        <link href='http://fonts.googleapis.com/css?family=Terminal+Dosis' rel='stylesheet' type='text/css' />
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

<body style="margin:0; padding:0; border:0; background-color:white !important;">

<div align="left" style="width:300px; height:70px; background-color:transparent; position:fixed; margin:0 !important;
padding:0 !important; border:0 !important; left:10px !important; z-index:99999999999999999 !important;">

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
	$res=mysqli_query($dbh,$query);				
	$row=mysqli_fetch_array($res);
echo"".$row['privilege']."";				
 
$privilege=$row['privilege'];//переменная будет использоваться для определения внешнего вида 
//и функциональности страниц для пользователя с теми или иными уровнями привилегий.


 ?>
 </strong>
 
 </span></br>
<span style="font-size:12pt; margin-left:3px;">
 Состояние <a href="edit_user_buffer.php" target="top" title="Посмотреть\Изменить содержимое Корзины"
 style="color:black !important; text-decoration:underline !important;">корзины:</a>
 
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

$res=mysqli_query($dbh,$query);

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




<?php
if(!isset($_GET['step'])){


}else if($_GET['step']=='1'){//выбор радиостанции


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
					
$query = "SELECT * FROM list_radio ORDER BY name";
$res=mysqli_query($dbh,$query);
//получение списка радиостанций



echo'
 <div class="container" >
            <div class="content" >
                <ul class="ca-menu">';


while($row=mysqli_fetch_array($res)){


if($privilege=='admin'){//кнопка Удалить радио будет доступна только Администратору.

echo'
					<!--кнопка Удалить -->
							<div align="center" style="float:left; width:95px; height:18px; border:1px black solid; 
							padding:0 !important; cursor:pointer; background-color:transparent; 
							position:relative !important; z-index:9 !important;" 
							onclick="button_delete'.$row['id'].'();">
							<span style="font-size:10pt !important;">Удалить</span>
							</div>
							<!--кнопка Удалить -->

							<script type="text/javascript">
							function button_delete'.$row['id'].'(){
							var show = confirm("Вы действительно хотите удалить радиостанцию '.$row['name'].' ?");
							
							if(show==true){
							document.location.href = "action/delete_radio.php?id='.$row['id'].'";
							}else{
							
							
							}
							
							
							}
							</script>';
							
		
}else{};

					
if($privilege=='admin'){//кнопка Переименовать будет доступна только Администратору.

	echo'<!--кнопка Переименовать -->
							<div align="center" style="float:left; width:105px; height:18px; border:1px black solid; 
							margin-left:5px !important;
							padding:0 !important; cursor:pointer; background-color:transparent; 
							position:relative !important; z-index:9 !important;" 
							onclick="button_rename'.$row['id'].'();">
							<span style="font-size:10pt !important;">Переименовать</span>
							</div>
							<!--кнопка Переименовать -->';




echo'
<div id="div_rename'.$row['id'].'" name="div_rename'.$row['id'].'"
 style="position:fixed !important; width:500px !important; height:200px !important; background-color:#e6eecc !important;
 display:none; z-index:999999999900000000999999 !important; margin:0 !important; border:0 !important;
 left:50% !important; top:50% !important; margin-left:-251px !important; margin-top:-101px !important; display:none;
 border:2px black solid !important;">';
 

echo'
<form action="action/rename_radio.php?id='.$row['id'].'" id="div_rename_form" name="div_rename_form"
enctype="multipart/form-data" method="post" accept-charset="utf-8" onreset="hideForm(this)"> 

<div  style="width:500px !important; height:20px !important;" >
<div style="width:440px; float:left; height:20px;"></div>
<div style="width:60px; float:left; height:20px;">
<span onclick="hide_div_rename'.$row['id'].'();" style="cursor:pointer !important;">Закрыть</span>
</div>
</div>

<div align="center" style="width:500px !important; height:40px !important; background-color:transparent;">  
<span style="font-size:14pt !important;">Переименование Радио</span>
</div>

<div style="width:500px !important; height:40px !important; background-color:transparent;">
<div style="width:50px !important; height:40px !important; float:left;" ></div>
<div style="width:450px !important; height:40px !important; float:left; background-color:transparent;">
<div style="width:160px; float:left; height:40px; background-color:transparent">
<span style="font-size:14pt !important;">Новое название:</span></div>
<div style="float:left; height:40px; width:290px; background-color:transparent;"> 
<input type="text" autocomplete="off" name="text" id="text" style="width:220px; height:20px;"/>
</div>


</div>
</div>

<div style="width:500px; height:30px;"></div>

<div align="center" style="width:500px; height:40px;">

<input type="submit" value="OK" style="cursor:pointer !important;"/>
<input type="reset" value="Очистить" style="cursor:pointer !important;"/>

</div>



</form>


</div>
';




							echo'<script type="text/javascript">
							function button_rename'.$row['id'].'(){
							
							div_rename'.$row['id'].'.style.display = "block";
							
							}
							
							function hide_div_rename'.$row['id'].'(){
							
							div_rename'.$row['id'].'.style.display = "none";
							
							}	
							</script>';

}else{};


				
                    echo'<li align="center">
                        <a href="create_news.php?step=2&radio='.$row['name_eng'].'" align="center">
                            <div align="center"  class="ca-content" style="left:0px !important; width:100% !important;
							">
                                <h2 class="ca-main" style="color:black !important;">'.$row['name'].'</h2>
                                
                            </div>
							<div align="left" style="width:100%; height:20px; background-color:transparent;">
							
							<div style="float:left; width:100px; height:20px; background-color:transparent;">
							
							
							
							
							</div>
							
							</div>
							
                        </a>
                    </li>
					
							

					';
					
					
					
}//конец цикла


echo'					
                    
                </ul>
            </div><!-- content -->
        </div>
		
		
		
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
';

////////////////////////////////////////////////////////////////////////////////////////////


if($privilege=='admin'){//кнопка Добавить будет доступна только Администратору.
// кнопка Добавить
echo'
<div align="center" style="width:100%; height:40px; background-color:transparent;">

<div align="center" style=" width:105px; height:18px; border:1px black solid; 
padding:0 !important; cursor:pointer; background-color:transparent; 
position:relative !important; z-index:9 !important;" 
onclick="button_insert();">
<span style="font-size:10pt !important;">Добавить</span>
</div>

</div>

';



echo'
<div id="div_insert" name="div_insert"
 style="position:fixed !important; width:500px !important; height:200px !important; background-color:#e6eecc !important;
 display:none; z-index:999999999900000000999999 !important; margin:0 !important; border:0 !important;
 left:50% !important; top:50% !important; margin-left:-251px !important; margin-top:-101px !important; display:none;
 border:2px black solid !important;">';
 

echo'
<form action="action/insert_radio.php" id="div_insert_form" name="div_insert_form"
enctype="multipart/form-data" method="post" accept-charset="utf-8" onreset="hideForm(this)"> 

<div  style="width:500px !important; height:20px !important;" >
<div style="width:440px; float:left; height:20px;"></div>
<div style="width:60px; float:left; height:20px;">
<span onclick="hide_div_insert();" style="cursor:pointer !important;">Закрыть</span>
</div>
</div>

<div align="center" style="width:500px !important; height:40px !important; background-color:transparent;">  
<span style="font-size:14pt !important;">Добавление нового Радио</span>
</div>

<div style="width:500px !important; height:40px !important; background-color:transparent;">
<div style="width:50px !important; height:40px !important; float:left;" ></div>
<div style="width:450px !important; height:40px !important; float:left; background-color:transparent;">
<div style="width:160px; float:left; height:40px; background-color:transparent">
<span style="font-size:14pt !important;">Название:</span></div>
<div style="float:left; height:40px; width:290px; background-color:transparent;"> 
<input type="text" autocomplete="off" name="text" id="text" style="width:220px; height:20px;"/>
</div>


</div>
</div>

<div style="width:500px; height:30px;"></div>

<div align="center" style="width:500px; height:40px;">

<input type="submit" value="OK" style="cursor:pointer !important;"/>
<input type="reset" value="Очистить" style="cursor:pointer !important;"/>

</div>



</form>


</div>
';




							echo'<script type="text/javascript">
							function button_insert(){
							
							div_insert.style.display = "block";
							
							}
							
							function hide_div_insert(){
							
							div_insert.style.display = "none";
							
							}	
							</script>';

}else{};






					
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}else if($_GET['step']=='2'){//выбор времени

if(isset($_GET['radio'])){



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


$radio=$_GET['radio'];

$query = "SELECT * FROM list_radio WHERE name_eng='$radio'";
$res=mysqli_query($dbh,$query);
$row=mysqli_fetch_array($res);
$radio_id=$row['id'];//вычисление идентификатора радио
$radio_name_rus=$row['name'];//русскоязычное наименование радио


$query = "SELECT * FROM list_time_radio".$radio_id." ORDER BY time";//обращение к таблице со списком 
//времени, соответствующим выбранному радио
$res=mysqli_query($dbh,$query);



echo'
<div id="div_new" name="div_new"
 style="position:fixed !important; width:500px !important; height:400px !important; background-color:#e6eecc !important;
 display:block; z-index:9999999999 !important; margin:0 !important; border:0 !important;
 left:50% !important; top:50% !important; margin-left:-251px !important; margin-top:-201px !important; display:none;
 border:2px black solid !important;">';
 

echo'
<form action="action/insert_news_releases.php" id="div_new_form" name="div_new_form"
enctype="multipart/form-data" method="post" accept-charset="utf-8" onreset="hideForm(this)"> 

<div  style="width:500px !important; height:20px !important;" >
<div style="width:440px; float:left; height:20px;"></div>
<div style="width:60px; float:left; height:20px;">
<span onclick="hide_div_new();" style="cursor:pointer !important;">Закрыть</span>
</div>
</div>

<div align="center" style="width:500px !important; height:40px !important; background-color:transparent;">  
<span style="font-size:14pt !important;">Новостной выпуск</span>
</div>

<div style="width:500px !important; height:40px !important; ">
<div style="width:50px !important; height:40px !important; float:left;" ></div>
<div style="width:450px !important; height:40px !important; float:left;">
<span style="font-size:14pt !important;">Выпуск:</span>
</div>
</div>

<div style="width:500px; height:40px;">
<div style="width:50px !important; height:40px !important; float:left;" ></div>
<div style="width:450px !important; height:40px !important; float:left;">

<span style="font-size:12pt;">'.$radio_name_rus.'</span>

<select id="new" name="new" size="1" style="display:none;">';


$query2 = "SELECT * FROM list_radio ORDER BY name ";
$res2=mysqli_query($dbh,$query2);

while($row2=mysqli_fetch_array($res2)){	

//проверка, если у данного радио не 


 echo'<option value="'.$row2['name_eng'].'" '; if($radio==$row2['name_eng']){echo' selected'; }; echo'>'.$row2['name'].'</option>';

}
	
echo'</select>
</div>
</div>

<div style="width:500px !important; height:40px !important; ">
<div style="width:50px !important; height:40px !important; float:left;" ></div>
<div style="width:450px !important; height:40px !important; float:left;">
<span style="font-size:14pt !important;">Время:</span>
</div>
</div>

<div style="width:500px; height:40px;">
<div style="width:50px !important; height:40px !important; float:left;" ></div>
<div style="width:450px !important; height:40px !important; float:left;">

<span style="font-size:12pt;" name="text_span" id="text_span"></span>

<select id="time" name="time" style="display:none;">';	
	
$tmp_count=0;

//
	
	
while($row=mysqli_fetch_array($res)){	


$row_time_options=substr($row['time'],0,5);

	echo'<option value="'.$row_time_options.'">'.$row_time_options.'</option>';
	
$tmp_count++;
}//конец цикла





echo'
</select>
</div>
</div>

<div style="width:500px; height:40px;">
</div>

<div align="center" style="width:500px; height:40px;">

<input type="submit" value="OK" style="cursor:pointer !important;"/>
<input type="button" value="Выбрать заново" style="cursor:pointer !important;" onclick="back();"/>

</div>



</form>

<script type="text/javascript">
function back(){
document.location.href = "create_news.php?step=1"; 
}
</script>


</div>
';



////////////////////////////////////////////////////////////////////////




$query = "SELECT * FROM list_time_radio".$radio_id." ORDER BY time";//обращение к таблице со списком 
//времени, соответствующим выбранному радио
$res=mysqli_query($dbh,$query);



echo'


 <div class="container">
            <div class="content">
                <ul class="ca-menu">';

$tmp_count2=0;


while($row=mysqli_fetch_array($res)){

$row_time=substr($row['time'],0,5);

//$row['id'] - идентификатор времени, которое нужно удалить
//$radio_id - идентификатор радио. Удаление будет производиться из таблицы list_time_radio[$radio_id]


if($privilege=='admin'){//кнопка Удалить будет доступна только Администратору.
echo'
					<!--кнопка Удалить -->
							<div align="center" style="width:95px; height:18px; border:1px black solid; 
							padding:0 !important; cursor:pointer; background-color:transparent; 
							position:relative !important; z-index:9 !important;
							float:left;" 
							onclick="button_delete'.$row['id'].'();">
							<span style="font-size:10pt !important;">Удалить</span>
							</div>
							<!--кнопка Удалить -->

							<script type="text/javascript">
							function button_delete'.$row['id'].'(){
							var show = confirm("Вы действительно хотите удалить время '.$row_time.' ?");
							
							if(show==true){
							document.location.href = "action/delete_time.php?id='.$row['id'].'&radio_id='.$radio_id.'";
							}else{
							
							
							}
							
							
							}
							</script>';
							
}else{};


							
if($privilege=='admin'){//кнопка Переименовать будет доступна только Администратору.							
////переименование на тайм-ленте									

	echo'<!--кнопка Переименовать -->
							<div align="center" style="float:left; width:105px; height:18px; border:1px black solid; 
							margin-left:5px !important;
							padding:0 !important; cursor:pointer; background-color:transparent; 
							position:relative !important; z-index:9 !important;" 
							onclick="button_rename'.$row['id'].'();">
							<span style="font-size:10pt !important;">Переименовать</span>
							</div>
							<!--кнопка Переименовать -->';






echo'
<div id="div_rename'.$row['id'].'" name="div_rename'.$row['id'].'"
 style="position:fixed !important; width:500px !important; height:200px !important; background-color:#e6eecc !important;
 display:none; z-index:999999999900000000999999 !important; margin:0 !important; border:0 !important;
 left:50% !important; top:50% !important; margin-left:-251px !important; margin-top:-101px !important; display:none;
 border:2px black solid !important;">';
 

echo'
<form action="action/rename_time.php?id='.$row['id'].'&radio_id='.$radio_id.'" id="div_rename_form" name="div_rename_form"
enctype="multipart/form-data" method="post" accept-charset="utf-8" onreset="hideForm(this)"> 

<div  style="width:500px !important; height:20px !important;" >
<div style="width:440px; float:left; height:20px;"></div>
<div style="width:60px; float:left; height:20px;">
<span onclick="hide_div_rename'.$row['id'].'();" style="cursor:pointer !important;">Закрыть</span>
</div>
</div>

<div align="center" style="width:500px !important; height:40px !important; background-color:transparent;">  
<span style="font-size:14pt !important;">Установка другого времени</span>
</div>

<div style="width:500px !important; height:40px !important; background-color:transparent;">
<div style="width:50px !important; height:40px !important; float:left;" ></div>
<div style="width:450px !important; height:40px !important; float:left; background-color:transparent;">
<div style="width:160px; float:left; height:40px; background-color:transparent">
<span style="font-size:14pt !important;">Новое время:</span></div>
<div style="float:left; height:40px; width:290px; background-color:transparent;"> 

<select id="time" name="time">';	



$query3 = "SELECT * FROM list_time_radio".$radio_id." ORDER BY time";	
$res3=mysqli_query($dbh,$query3);
$tmp_i=0;
	
while($row3=mysqli_fetch_array($res3)){

$mas_time_base[$tmp_i]=$row3['time'];

$tmp_i++;
}	


$mas_time_full[0]="00:00:00";
$mas_time_full[1]="01:00:00";
$mas_time_full[2]="02:00:00";
$mas_time_full[3]="03:00:00";
$mas_time_full[4]="04:00:00";
$mas_time_full[5]="05:00:00";
$mas_time_full[6]="06:00:00";
$mas_time_full[7]="07:00:00";
$mas_time_full[8]="08:00:00";
$mas_time_full[9]="09:00:00";
$mas_time_full[10]="10:00:00";
$mas_time_full[11]="11:00:00";
$mas_time_full[12]="12:00:00";
$mas_time_full[13]="13:00:00";
$mas_time_full[14]="14:00:00";
$mas_time_full[15]="15:00:00";
$mas_time_full[16]="16:00:00";
$mas_time_full[17]="17:00:00";
$mas_time_full[18]="18:00:00";
$mas_time_full[19]="19:00:00";
$mas_time_full[20]="20:00:00";
$mas_time_full[21]="21:00:00";
$mas_time_full[22]="22:00:00";
$mas_time_full[23]="23:00:00";


$difference = array_diff($mas_time_full, $mas_time_base);

$count=count($difference);





foreach($difference as $i1 => $i2){

echo'<option value="'.$i1.'">'.$i2.'</option>';

}





echo'
</select>


</div>


</div>
</div>

<div style="width:500px; height:30px;"></div>

<div align="center" style="width:500px; height:40px;">

<input type="submit" value="OK" style="cursor:pointer !important;"/>
<input type="reset" value="Очистить" style="cursor:pointer !important;"/>

</div>



</form>


</div>
';






							echo'<script type="text/javascript">
							function button_rename'.$row['id'].'(){
							
							div_rename'.$row['id'].'.style.display = "block";
							
							}
							
							function hide_div_rename'.$row['id'].'(){
							
							div_rename'.$row['id'].'.style.display = "none";
							
							}	
							</script>';


////переименование на тайм-ленте						
}else{};				
	

						
						
//проверка: соответствует ли данному времени и сегодняшней дате какой-либо выпуск новостей.

//получение сегодняшней даты
$today3=getdate();
if( ((integer)$today3['mon'])<10 ){ $today3['mon']='0'.$today3['mon']; };
if( ((integer)$today3['mday'])<10 ){ $today3['mday']='0'.$today3['mday']; };

$today_date3_check=$today3['year']."-".$today3['mon']."-".$today3['mday'];//текущая дата


$time_check=$row_time;//время
$radio_check=$radio;//радио
$radio_id_check=$radio_id;//идентификатор радио

//просмотр таблицы news_releases
//если будет найдено сочетание radio - time - date , 
//соответствующая сочетанию $radio_check - $time_check - $today_date3_check

$log_check=0;//примет значение 1, если сочетание будет найдено

$query3 = "SELECT * FROM news_releases WHERE radio='".$radio_check."'";	
$res3=mysqli_query($dbh,$query3);

while($row3=mysqli_fetch_array($res3)){

$time_tmp=substr($row3['time'],0,5);
if($time_tmp==$time_check){


if($today_date3_check==$row3['date']){
$log_check=1;
break;
}


}


}

echo'

                    <li align="center" style="height:50px !important; cursor:pointer !important;">
                        <a ';
						if($log_check==1){
							echo'title="Для данного времени уже существует выпуск новостей"';	
						}else{		
							echo'onclick="show_div_new( '.$tmp_count2.', \' '.$row_time.' \' );"'; 
						}				
			echo'			align="center" 
						style="height:50px !important; cursor:pointer !important;">
                            <div align="center"  class="ca-content" style="left:0px !important; width:100% !important;
							height:40px !important; top:5px !important; background-color:transparent !important;
							';
							if($log_check==1){
								echo'background-image:url(\'images/occupied.png \'); background-position: left center; 
								background-repeat:no-repeat; ';
							}
							echo'">
                                <h2 class="ca-main">'.$row_time.'</h2>
                                
                            </div>
                        </a>
                    </li>
	';				
					
$tmp_count2++;		

}//конец цикла



echo'
  
                </ul>
            </div><!-- content -->
        </div>
	';



if($privilege=='admin'){//кнопка Добавить время будет доступна только Администратору.
echo'
<!--добавить время-->
		
<div align="center"  style="width:100%; height:40px; background-color:transparent;">
<!--кнопка Добавить -->
							<div align="center" style="width:105px; height:18px; border:1px black solid; 
							padding:0 !important; cursor:pointer; background-color:transparent; 
							position:relative !important; z-index:9 !important;" 
							onclick="button_insert();">
							<span style="font-size:10pt !important;">Добавить</span>
							</div>
							<!--кнопка Добавить -->';



echo'
<div id="div_insert" name="div_insert"
 style="position:fixed !important; width:500px !important; height:200px !important; background-color:#e6eecc !important;
 display:none; z-index:999999999900000000999999 !important; margin:0 !important; border:0 !important;
 left:50% !important; top:50% !important; margin-left:-251px !important; margin-top:-101px !important; display:none;
 border:2px black solid !important;">';
 

echo'
<form action="action/insert_time.php?radio_id='.$radio_id.'" id="div_insert_form" name="div_insert_form"
enctype="multipart/form-data" method="post" accept-charset="utf-8" onreset="hideForm(this)"> 

<div  style="width:500px !important; height:20px !important;" >
<div style="width:440px; float:left; height:20px;"></div>
<div style="width:60px; float:left; height:20px;">
<span onclick="hide_div_insert();" style="cursor:pointer !important;">Закрыть</span>
</div>
</div>

<div align="center" style="width:500px !important; height:40px !important; background-color:transparent;">  
<span style="font-size:14pt !important;">Добавление нового времени</span>
</div>

<div style="width:500px !important; height:40px !important; background-color:transparent;">
<div style="width:50px !important; height:40px !important; float:left;" ></div>
<div style="width:450px !important; height:40px !important; float:left; background-color:transparent;">
<div style="width:160px; float:left; height:40px; background-color:transparent">
<span style="font-size:14pt !important;">Новое время:</span></div>
<div style="float:left; height:40px; width:290px; background-color:transparent;"> 

<select id="time" name="time">';	



$query4 = "SELECT * FROM list_time_radio".$radio_id." ORDER BY time";	
$res4=mysqli_query($dbh,$query4);
$tmp_i4=0;
	

while($row4=mysqli_fetch_array($res4)){

$mas_time_base4[$tmp_i4]=$row4['time'];

$tmp_i4++;
}	


$mas_time_full4[0]="00:00:00";
$mas_time_full4[1]="01:00:00";
$mas_time_full4[2]="02:00:00";
$mas_time_full4[3]="03:00:00";
$mas_time_full4[4]="04:00:00";
$mas_time_full4[5]="05:00:00";
$mas_time_full4[6]="06:00:00";
$mas_time_full4[7]="07:00:00";
$mas_time_full4[8]="08:00:00";
$mas_time_full4[9]="09:00:00";
$mas_time_full4[10]="10:00:00";
$mas_time_full4[11]="11:00:00";
$mas_time_full4[12]="12:00:00";
$mas_time_full4[13]="13:00:00";
$mas_time_full4[14]="14:00:00";
$mas_time_full4[15]="15:00:00";
$mas_time_full4[16]="16:00:00";
$mas_time_full4[17]="17:00:00";
$mas_time_full4[18]="18:00:00";
$mas_time_full4[19]="19:00:00";
$mas_time_full4[20]="20:00:00";
$mas_time_full4[21]="21:00:00";
$mas_time_full4[22]="22:00:00";
$mas_time_full4[23]="23:00:00";


$difference4 = array_diff($mas_time_full4, $mas_time_base4);

if(!isset($mas_time_base4)){
$difference4[0]="00:00:00";
$difference4[1]="01:00:00";
$difference4[2]="02:00:00";
$difference4[3]="03:00:00";
$difference4[4]="04:00:00";
$difference4[5]="05:00:00";
$difference4[6]="06:00:00";
$difference4[7]="07:00:00";
$difference4[8]="08:00:00";
$difference4[9]="09:00:00";
$difference4[10]="10:00:00";
$difference4[11]="11:00:00";
$difference4[12]="12:00:00";
$difference4[13]="13:00:00";
$difference4[14]="14:00:00";
$difference4[15]="15:00:00";
$difference4[16]="16:00:00";
$difference4[17]="17:00:00";
$difference4[18]="18:00:00";
$difference4[19]="19:00:00";
$difference4[20]="20:00:00";
$difference4[21]="21:00:00";
$difference4[22]="22:00:00";
$difference4[23]="23:00:00";

}

$count4=count($difference4);





foreach($difference4 as $i14 => $i24){

echo'<option value="'.$i14.'">'.$i24.'</option>';

}





echo'
</select>


</div>


</div>
</div>

<div style="width:500px; height:30px;"></div>

<div align="center" style="width:500px; height:40px;">

<input type="submit" value="OK" style="cursor:pointer !important;"/>
<input type="reset" value="Очистить" style="cursor:pointer !important;"/>

</div>



</form>


</div>
';






							echo'<script type="text/javascript">
							function button_insert(){
							
							div_insert.style.display = "block";
							
							}
							
							function hide_div_insert(){
							
							div_insert.style.display = "none";
							
							}	
							</script>';



echo'

</div>
		
<!--добавить время-->	
';

}else{};

	
echo'		
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

<script type="text/javascript">
function show_div_new(a,b){
div_new.style.display = "block";

//alert(b);

document.getElementById(\'text_span\').innerHTML=b;



if(a==0){
$("#time :nth-child(1)").attr("selected", "selected");
}
else if(a==1){ 
$("#time :nth-child(2)").attr("selected", "selected");
}
else if(a==2){ 
$("#time :nth-child(3)").attr("selected", "selected");
}
else if(a==3){ 
$("#time :nth-child(4)").attr("selected", "selected");
}
else if(a==4){ 
$("#time :nth-child(5)").attr("selected", "selected");
}
else if(a==5){ 
$("#time :nth-child(6)").attr("selected", "selected");
}
else if(a==6){ 
$("#time :nth-child(7)").attr("selected", "selected");
}
else if(a==7){ 
$("#time :nth-child(8)").attr("selected", "selected");
}
else if(a==8){ 
$("#time :nth-child(9)").attr("selected", "selected");
}
else if(a==9){ 
$("#time :nth-child(10)").attr("selected", "selected");
}
else if(a==10){ 
$("#time :nth-child(11)").attr("selected", "selected");
}
else if(a==11){ 
$("#time :nth-child(12)").attr("selected", "selected");
}
else if(a==12){ 
$("#time :nth-child(13)").attr("selected", "selected");
}
else if(a==13){ 
$("#time :nth-child(14)").attr("selected", "selected");
}
else if(a==14){ 
$("#time :nth-child(15)").attr("selected", "selected");
}
else if(a==15){ 
$("#time :nth-child(16)").attr("selected", "selected");
}
else if(a==16){ 
$("#time :nth-child(17)").attr("selected", "selected");
}
else if(a==17){ 
$("#time :nth-child(18)").attr("selected", "selected");
}
else if(a==18){ 
$("#time :nth-child(19)").attr("selected", "selected");
}
else if(a==19){ 
$("#time :nth-child(20)").attr("selected", "selected");
}
else if(a==20){ 
$("#time :nth-child(21)").attr("selected", "selected");
}
else if(a==21){ 
$("#time :nth-child(22)").attr("selected", "selected");
}
else if(a==22){ 
$("#time :nth-child(23)").attr("selected", "selected");
}
else if(a==23){ 
$("#time :nth-child(24)").attr("selected", "selected");
}



}

function hide_div_new(){
div_new.style.display = "none";

}

</script> 

';





}//if(isset($_GET['step']))


}


?>
</body>


</html>
