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
<div align="center" style="width:1300px; min-height:100px; padding:10px; border:2px white solid">

<div align="center" style="width:1200px; height:40px; padding:5px; border:1px white solid; font-size:15pt">
<span>Клиенты - Изменение записи</span>
</div>
<div align="center" style="width:1200px;  border:1px white solid; border-top:0px; font-size:15pt;  padding:5px">

<?php echo'<form id="responsesForm" action="action/change.php?id='.$id.'" enctype="multipart/form-data" method="post" accept-charset="utf-8">';?>
<table style="width:1200px; font-size:11pt">
<tr>
<td style="background-color:#3637ea; width:290px; padding:2px">Клиент</td>
<td style="background-color:#3637ea; width:290px; padding:2px">Отрасль</td>
<td style="background-color:#3637ea; width:290px; padding:2px">Лояльность</td>
<td style="background-color:#3637ea; width:290px; padding:2px">Телефон</td>
<td style="background-color:#3637ea; width:290px; padding:2px">Сайт</td>
<td style="background-color:#3637ea; width:290px; padding:2px">Заметки</td>
<td style="background-color:#3637ea; width:290px; padding:2px">E-mail</td>
</tr>
<?php
$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");
$query="SELECT * FROM qdfmain WHERE ID='".$id."' ORDER BY Client";
$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
$row=mysql_fetch_array($res);
echo'
<tr>
<td style="background-color:#3637ea; width:290px; padding:2px"><textarea name="Client" id="Client"      
style="background-color:white; height:50px; width:280px; max-height:50px; max-width:280px; " 
title="Наименование организации или имя частного лица">'.$row['Client'].'</textarea></td>

<td style="background-color:#3637ea; width:290px; padding:2px">
<textarea name="Industry" id="Industry"  
style="background-color:white; height:30px; width:280px; max-height:50px; max-width:280px"
title="Чем занимается организация" >'.$row['Industry'].'</textarea>
</td>
<td style="background-color:#3637ea; width:230px; padding:2px">
<select name="Loyalty" id="Loyalty" size=1>

<option value=1'; if($row['Loyalty']=='Наш клиент'){echo' selected'; }echo'>Наш клиент</option>
<option value=2'; if($row['Loyalty']=='Горячий'){echo' selected'; }echo'>Горячий</option>
<option value=3 '; if($row['Loyalty']=='Тёплый'){echo' selected'; }echo'>Тёплый</option>
<option value=4'; if($row['Loyalty']=='Холодный'){echo' selected'; }echo'>Холодный</option>
<option value=5'; if($row['Loyalty']=='Отказ'){echo' selected'; }echo'>Отказ</option>

</select>
</td>
<td style="background-color:#3637ea; width:290px; padding:2px">
<textarea name="Phone" id="Phone"  
style="background-color:white; height:30px; width:280px; max-height:50px; max-width:280px" 
title="можно перечислить несколько номеров через запятую" >'.$row['Phone'].'</textarea>
</td>

<td style="background-color:#3637ea; width:290px; padding:2px">
<textarea name="Site" id="Site"  
style="background-color:white; height:30px; width:280px; max-height:50px; max-width:280px">'.$row['Site'].'</textarea>
</td>

<td style="background-color:#3637ea; width:290px; padding:2px">
<textarea name="Note" id="Note"  
style="background-color:white; height:30px; width:280px; max-height:50px; max-width:280px">'.$row['Note'].'</textarea>
</td>


<td style="background-color:#3637ea; width:290px; padding:2px">
<input type="text" name="Email" id="Email" style="width:160px" value="'.$row['Email'].'"/>
</td>
</tr>';
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
