<?php
session_start();
require 'config/config.php';
header('Content-type: text/html; charset=utf-8');
 //echo"".$_GET['id_action']."</br>";
  if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)||($_SESSION['user']=="")){
$x="login";
header('Location: '.$x.".php");//перенаправление на форму авторизации.
 }
if((!isset($_GET['id_action']))||($_GET['id_action']==NULL)||($_GET['id_action']=="")){
echo'Ошибка! Не задан основной параметр.';
exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Учёт клиентов</title>

<script type="text/javascript" src="js/jquery.min.js"></script>

<script type="text/javascript">
function f_show(){
$("#f").show(2000);
}
</script>
</head>

<body style="background-color:blue; color:white">
<?php
echo"<span style=\"position:absolute; background-color:black\">Вы вошли как: <strong>".$_SESSION['user']."</strong></span>";


?>
<div align="center" style="width:100%; color:white; font-family:Arial, Helvetica, sans-serif">
<div align="center" style="width:1300px; min-height:100px; padding:10px; border:2px white solid">

<div align="center" style="width:1200px; height:40px; padding:5px; border:1px white solid; font-size:15pt">
<span>События - Изменение записи</span>
</div>
<div align="center" style="width:1200px;  border:1px white solid; border-top:0px; font-size:15pt;  padding:5px">

<table style="width:1100px; font-size:11pt">
<tr>
<td style="background-color:#3637ea; width:200px; padding:2px"></td>
<td style="background-color:#3637ea; width:15px; padding:2px">ID</td>
<td style="background-color:#3637ea; width:118px; padding:2px">Тип</td>
<td style="background-color:#3637ea; width:118px; padding:2px">Тема</td>
<td style="background-color:#3637ea; width:118px; padding:2px">Начало</td>
<td style="background-color:#3637ea; width:118px; padding:2px">Приоритет</td>
<td style="background-color:#3637ea; width:118px; padding:2px">Статус</td>
<td style="background-color:#3637ea; width:118px; padding:2px">Заметки</td>
<td style="background-color:#3637ea; width:118px; padding:2px">Менеджер, ответственный за совершение события</td>
<td style="background-color:#3637ea; width:118px; padding:2px">Добавлено</td>
<td style="background-color:#3637ea; width:15px; padding:2px">ID Клиента</td>
</tr>

<?php

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");

if(!isset($_GET['sort'])){
$query="SELECT * FROM tblactions WHERE ClientID='".$_GET['id_action']."' ORDER BY ActionType";
}
else if($_GET['sort']==1){
$query="SELECT * FROM tblactions WHERE ClientID='".$_GET['id_action']."' ORDER BY ActionType";
}
else if($_GET['sort']==2){
$query="SELECT * FROM tblactions WHERE ClientID='".$_GET['id_action']."' ORDER BY ActionType DESC";
}
else if($_GET['sort']==3){
$query="SELECT * FROM tblactions WHERE ClientID='".$_GET['id_action']."' ORDER BY ActionTitle";
}
else if($_GET['sort']==4){
$query="SELECT * FROM tblactions WHERE ClientID='".$_GET['id_action']."' ORDER BY ActionTitle DESC";
}
else if($_GET['sort']==5){
$query="SELECT * FROM tblactions WHERE ClientID='".$_GET['id_action']."' ORDER BY StartTime";
}
else if($_GET['sort']==6){
$query="SELECT * FROM tblactions WHERE ClientID='".$_GET['id_action']."' ORDER BY StartTime DESC";
}
else if($_GET['sort']==7){
$query="SELECT * FROM tblactions WHERE ClientID='".$_GET['id_action']."' ORDER BY Priority";
}
else if($_GET['sort']==8){
$query="SELECT * FROM tblactions WHERE ClientID='".$_GET['id_action']."' ORDER BY Priority DESC";
}
else if($_GET['sort']==9){
$query="SELECT * FROM tblactions WHERE ClientID='".$_GET['id_action']."' ORDER BY ActionStatus";
}
else if($_GET['sort']==10){
$query="SELECT * FROM tblactions WHERE ClientID='".$_GET['id_action']."' ORDER BY ActionStatus DESC";
}
else if($_GET['sort']==11){
$query="SELECT * FROM tblactions WHERE ClientID='".$_GET['id_action']."' ORDER BY Date";
}
else if($_GET['sort']==12){
$query="SELECT * FROM tblactions WHERE ClientID='".$_GET['id_action']."' ORDER BY Date DESC";
}

$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

 while($row=mysql_fetch_array($res)){

 echo'<tr>
 <td style="background-color:#3637ea; width:200px; padding:2px"><a href="action/delete_actions.php?id='.$row['ID'].'" style="color:white">Удалить запись</a>
  <a href="change_form3.php?id='.$row['ID'].'" style="color:white">Изменить запись</a></td>
<td style="background-color:#3637ea; width:15px; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:118px; padding:2px">'.$row['ActionType'].'</td>
<td style="background-color:#3637ea; width:118px; padding:2px">'.$row['ActionTitle'].'</td>
<td style="background-color:#3637ea; width:118px; padding:2px">'.$row['StartTime'].'</td>
<td style="background-color:#3637ea; width:118px; padding:2px">'.$row['Priority'].'</td>
<td style="background-color:#3637ea; width:118px; padding:2px">'.$row['ActionStatus'].'</td>
<td style="background-color:#3637ea; width:118px; padding:2px">'.$row['Note'].'</td>
<td style="background-color:#3637ea; width:118px; padding:2px">'.$row['Manager'].'</td>
<td style="background-color:#3637ea; width:118px; padding:2px">'.$row['Date'].'</td>
<td style="background-color:#3637ea; width:15px; padding:2px">'.$row['ClientID'].'</td>
</tr>';

 
 
 }

?>


</table>

</div>

<?php
echo'<table border="0" width="90%" cellpadding="5" align="center">

<tr>

<td>
Сортировка: 
<select name="sort" style="width:178px;margin-left:3px;background-color:#FFFF99" 
onChange="if(';
echo"this.options[this.selectedIndex].value!=''){window.location=this.options[this.selectedIndex].value}";
echo'else{this.options[selectedIndex=0];}">
<option value="actions.php?sort=1"'; if($_GET['sort']==1){echo' selected';} echo'>"Тип" - возрастание</option>
<option value="actions.php?sort=2"'; if($_GET['sort']==2){echo' selected';} echo'>"Тип" - убывание</option>
<option value="actions.php?sort=3"'; if($_GET['sort']==3){echo' selected';} echo'>"Тема" - возрастание</option>
<option value="actions.php?sort=4"'; if($_GET['sort']==4){echo' selected';} echo'>"Тема" - убывание</option>
<option value="actions.php?sort=5"'; if($_GET['sort']==5){echo' selected';} echo'>"Начало" - возрастание</option>
<option value="actions.php?sort=6"'; if($_GET['sort']==6){echo' selected';} echo'>"Начало" - убывание</option>
<option value="actions.php?sort=7"'; if($_GET['sort']==7){echo' selected';} echo'>"Приоритет" - возрастание</option>
<option value="actions.php?sort=8"'; if($_GET['sort']==8){echo' selected';} echo'>"Приоритет" - убывание</option>
<option value="actions.php?sort=9"'; if($_GET['sort']==9){echo' selected';} echo'>"Статус" - возрастание</option>
<option value="actions.php?sort=10"'; if($_GET['sort']==10){echo' selected';} echo'>"Статус" - убывание</option>
<option value="actions.php?sort=11"'; if($_GET['sort']==11){echo' selected';} echo'>"Добавлено" - возрастание</option>
<option value="actions.php?sort=12"'; if($_GET['sort']==12){echo' selected';} echo'>"Добавлено" - убывание</option>
</select></td></tr>






</table>';
?>

<!--поиск-->
<div id="f2" name="f2" style="width:520px; height:30px; margin-top:10px">
			<input name="Button1" type="button" value="Поиск" onclick="f_show()" />
			</div>
			<div id="f" name="f" style="width:520px; height:250px; border-style:solid; border-width:1px; 
			border-color:white;padding:10px; margin-top:10px; display:none">
			 <form id="responsesForm" action="action/search_actions.php" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					
                        <table border="0">
                            <tr><!--имя-->
                                <td style="height: 35px; width: 130px;border-style:solid; border-width:1px; border-color:white">
								<span style="margin-left:20px">Что искать</span>
								</td> 
								
                                <td style="height: 35px; width:360px;border-style:solid; border-width:1px; border-color:white">
								 <input type="text" name="title" maxlength="30" style="width: 200px;background-color:#FFFF99;margin-left:3px"/>
								</td>
                            </tr><!--имя-->
							
                            <tr><!--текст-->
                                <td style="height: 85px; width:130px; border-style:solid; border-width:1px; border-color:white">
								<span style="margin-left:20px">Где искать</span>
								</td> 
								
                                <td style="height:85px; width:360px; border-style:solid; border-width:1px; border-color:white">
										<div id="checkboxes" >	
									<input type="checkbox" name="Checkbox1"> 
									<span>Тип</span><br>
									<input type="checkbox" name="Checkbox2">
									<span>Тема</span><br>
									<input type="checkbox" name="Checkbox3"> 
									<span>Приоритет</span><br>
									<input type="checkbox" name="Checkbox4"> 
									<span>Статус</span><br>
									<input type="checkbox" name="Checkbox5"> 
									<span>Заметки</span><br>
									<input type="checkbox" name="Checkbox6"> 
									<span>Менеджер, ответственный за совершение события<br></span>
       

									</div>

								
								</td>
                            </tr><!--текст-->
		              </table>
                        <input type="submit" name="submit" value="Искать" 
						style="width: 119px; height: 38px; margin-top:10px; 
						-moz-border-radius: 5px;
						-webkit-border-radius: 5px;
						border-radius: 5px;
						background-image:url('images/button.png');"/>
						
                        <input type="reset" value="Сброс" 
						style="width: 119px; height: 38px; margin-top:10px " />
						
  
                        
						

                    </form>
			
			</div>



<!--поиск-->

<a href="index.php"><input type="button" value="На главную" style="height:40px; width:100px; cursor:pointer; margin-top:20px" /></a>


</div>
</div>
</body>

</html>
