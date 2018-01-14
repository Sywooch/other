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
<span>Контакты - Изменение записи</span>
</div>
<div align="center" style="width:1000px;  border:1px white solid; border-top:0px; font-size:15pt;  padding:5px">

<?php echo'<form id="responsesForm" action="action/change2.php?id='.$id.'" enctype="multipart/form-data" method="post" accept-charset="utf-8">';?>
<table style="width:1000px; font-size:11pt">
<tr>
<td style="background-color:#3637ea; width:130px; padding:2px">Контакт</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Должность</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Город</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Сотовый телефон</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Рабочий телефон</td>
<td style="background-color:#3637ea; width:130px; padding:2px">E-mail</td>
</tr>
<?php
$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");
$query="SELECT * FROM tblcontacts WHERE ID='".$id."' ";
$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
$row=mysql_fetch_array($res);
echo'
<tr style="border:1px white solid; background-color:#3366FF">

<td style="width:130px; height:40px; padding:5px"><textarea name="Contact" id="Contact"  
style="background-color:white; height:30px; width:120px; max-height:30px; max-width:120px" 
title="ФИО контактного лица">'.$row['Contact'].'</textarea></td>


<td style="width:130px; height:40px; padding:5px"><textarea name="Title" id="Title"  
style="background-color:white; height:30px; width:130px; max-height:30px; max-width:130px" 
title="Должность контактного лица" >'.$row['Title'].'</textarea></td>




<td style="width:130px; height:40px; padding:5px"><input type="text" name="City" id="City" style="width:120px" value="'.$row['City'].'"/></td>




<td style="width:130px; height:40px; padding:5px"><input type="text" name="Phone2" id="Phone2" style="width:120px"  value="'.$row['Phone'].'"/></td>




<td style="width:130px; height:40px; padding:5px"><input type="text" name="WorkPhone" id="WorkPhone" style="width:120px" value="'.$row['WorkPhone'].'"/></td>




<td style="width:130px; height:40px; padding:5px"><input type="text" name="Email2" id="Email2" style="width:120px"  value="'.$row['Email'].'"/></td>
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
