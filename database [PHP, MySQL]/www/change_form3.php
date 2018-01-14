<?php
session_start();
require 'config/config.php';
header('Content-type: text/html; charset=utf-8');
 if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)||($_SESSION['user']=="")){
$x="login";
header('Location: '.$x.".php");//перенаправление на форму авторизации.
 }
 $id=$_GET['id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Учёт клиентов</title>

<script type="text/javascript" src="js/jquery.min.js"></script>




</head>

<body style="background-color:blue; color:white">
<?php
echo"<span style=\"position:absolute; background-color:black\">Вы вошли как: <strong>".$_SESSION['user']."</strong></span>";


?>
<div align="center" style="width:100%; color:white; font-family:Arial, Helvetica, sans-serif">
<div align="center" style="width:1100px; min-height:100px; padding:10px; border:2px white solid">

<div align="center" style="width:1000px; height:40px; padding:5px; border:1px white solid; font-size:15pt">
<span>События - Изменение записи</span>
</div>
<div align="center" style="width:1000px;  border:1px white solid; border-top:0px; font-size:15pt;  padding:5px">

<?php echo'<form id="responsesForm" action="action/change3.php?id='.$id.'" enctype="multipart/form-data" method="post" accept-charset="utf-8">';?>
<table style="width:1000px; font-size:11pt">
<tr>
<td style="background-color:#3637ea; width:130px; padding:2px">Тип</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Тема</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Начало</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Приоритет</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Статус</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Заметки</td>
</tr>
<?php
$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");
$query="SELECT * FROM tblactions WHERE ID='".$id."' ";
$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
$row=mysql_fetch_array($res);
echo'
<tr style="border:1px white solid; border-bottom:0px">

<td style="width:130px; height:60px; padding:5px"><textarea name="Type" id="Type"      
style="background-color:white; height:50px; width:120px; max-height:50px; max-width:120px; " 
title="Тип события">'.$row['ActionType'].'</textarea></td>

<td style="width:130px; height:40px; padding:5px"><textarea name="Theme" id="Theme"  
style="background-color:white; height:30px; width:120px; max-height:50px; max-width:180px"
title="Тема">'.$row['ActionTitle'].'</textarea></td>';

$StartTime=$row['StartTime'];
$year=$StartTime[0].$StartTime[1].$StartTime[2].$StartTime[3];
$mouth=$StartTime[5].$StartTime[6];
$day=$StartTime[8].$StartTime[9];

$StartTime=$year."-".$mouth."-".$day."";

echo'<td style="width:130px; height:40px; padding:5px"><input type="date" name="Begin" id="Begin" value="'.$StartTime.'"/>';


//if($row['Priority']==1){$row['Priority']='Высокий'; }
//else if($row['Priority']==2){$row['Priority']='Средний'; }
//else if($row['Priority']==3){$row['Priority']='Низкий'; }



echo'
</td>

<td style="width:130px; height:40px; padding:5px">
<select name="Priority" id="Priority" size=1>
<option value=1'; if($row['Priority']==1){echo' selected';}echo'>Высокий</option>
<option value=2'; if($row['Priority']==2){echo' selected';}echo'>Средний</option>
<option value=3'; if($row['Priority']==3){echo' selected';}echo'>Низкий</option>
</select></td>

<td style="width:130px; height:40px; padding:5px"><input type="text" name="Status" id="Status" value="'.$row['ActionStatus'].'"/></td>

<td style="width:130px; height:40px; padding:5px"><textarea name="Note" id="Note"  
style="background-color:white; height:30px; width:120px; max-height:50px; max-width:120px">'.$row['Note'].'</textarea></td>
</tr>

';
?>


</table>

 <input type="submit" name="submit" value="Готово" 
						style="width: 119px; height: 38px; margin-top:10px; 
						
						"/>
						
                        <input type="reset" value="Сброс" 
						style="width: 119px; height: 38px; margin-top:10px " />
			   </form>			
</div>



</div>


</div>
</body>

</html>
