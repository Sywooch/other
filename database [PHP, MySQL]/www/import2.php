<?php
session_start();
require 'config/config.php';
header('Content-type: text/html; charset=utf-8');
 if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)||($_SESSION['user']=="")){
$x="login";
header('Location: '.$x.".php");//перенаправление на форму авторизации.
 } 
 
 $file_array=file('123.csv');
 //$count=sizeof($file_array);
 $file_str=implode($file_array);
 $mas=explode("\n", $file_str);
 $count=sizeof($mas);
 
  $i=0;//количество строк в файле
 $i2=0;
 $dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");
 
 
 while($i<$count){//проход по строкам файла
 
 //echo"".$mas[$i]."</br>";
 
 
 
 $mas2=explode(";", $mas[$i]);
 $i3=0;
 echo"".$mas2[$i3]."</br>";//0
 echo"".$mas2[$i3+1]."</br>";//1
 echo"".$mas2[$i3+2]."</br>";//2
 echo"".$mas2[$i3+3]."</br>";//3
 echo"".$mas2[$i3+4]."</br>";//4
 echo"".$mas2[$i3+5]."</br>";//5
 echo"".$mas2[$i3+6]."</br>";//6
 echo"".$mas2[$i3+7]."</br>";//7
 echo"".$mas2[$i3+8]."</br>";//8
 echo"".$mas2[$i3+9]."</br>";//9
 echo"".$mas2[$i3+10]."</br>";//10
 echo"".$mas2[$i3+11]."</br>";//11
 
 $name=$mas2[$i3];//наименование компании, извлечённое из файла.
 //echo"".$name."</br>";
 $query="SELECT * FROM big_table";
 $res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
 
 $log=0;
  while($row=mysql_fetch_array($res)){
  
  if($name==$row['A']){//если компания уже есть
    $log=1;
	break;
    }//если компания уже есть
    
  }
 
 if($log==1){//компания уже есть в базе. обновление записи о ней.
   $query2="UPDATE big_table SET 
   B='".$mas2[$i3+1]."',
   D='".$mas2[$i3+7]."',
   E='".$mas2[$i3+6]."',
   F='".$mas2[$i3+3]."',
   G='".$mas2[$i3+8]."',
   City='".$mas2[$i3+2]."',
   Description='".$mas2[$i3+11]."',
   Pos1='".$mas2[$i3+9]."',
   Pos2='".$mas2[$i3+10]."' WHERE A='".$name."'   ";
    $res2=mysql_query($query2);
					if($res2==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
 echo"UPDATE </br>";
 }//компания уже есть в базе. обновление записи о ней.
 else{//компании нет в базе. добавление записи.
 $query4="SELECT COUNT(*) FROM big_table";
  $res4=mysql_query($query4);
					if($res4==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
	$row4=mysql_fetch_row($res4);
	$cl=$row4[0];
	$cl++;
				
 $query3="INSERT INTO big_table 
 VALUES ('".$cl."','".$mas2[$i3]."','".$mas2[$i3+1]."','','".$mas2[$i3+7]."','".$mas2[$i3+6]."',
 '".$mas2[$i3+3]."','".$mas2[$i3+8]."','','".$mas2[$i3+2]."','".$mas2[$i3+11]."','".$mas2[$i3+9]."','".$mas2[$i3+10]."') ";
$res3=mysql_query($query3);
					if($res3==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
echo"INSERT </br>";
 }//компании нет в базе. добавление записи.
 

 echo"<hr size=\"1\"/>";
 $i++;
$i2++;
 }//проход по строкам файла
 
 
echo"Операция прошла успешно.";




 
?>
