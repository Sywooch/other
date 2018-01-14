<?php
session_start();
require 'config/config.php';
header('Content-type: text/html; charset=utf-8');
  if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)||($_SESSION['user']=="")){
$x="login";
header('Location: '.$x.".php");//перенаправление на форму авторизации.
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
<span>Мои контакты</span>
</div>
<div align="center" style="width:1200px;  border:1px white solid; border-top:0px; font-size:15pt;  padding:5px">

<table style="width:1100px; font-size:11pt">
<tr>
<td style="background-color:#3637ea; width:200px; padding:2px"></td>
<td style="background-color:#3637ea; width:20px; padding:2px">ID</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Контакт</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Должность</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Город</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Сотовый телефон</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Рабочий телефон</td>
<td style="background-color:#3637ea; width:130px; padding:2px">e-mail</td>
<td style="background-color:#3637ea; width:60px; padding:2px">Дата добавления</td>
<td style="background-color:#3637ea; width:20px; padding:2px">ID клиента</td>
</tr>

<?php

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");
//каждый пользователь может видеть только те записи, которые добавил он.

if(!isset($_GET['sort'])){
$query="SELECT * FROM tblcontacts WHERE UserName='".$_SESSION['user']."' ORDER BY Contact";
}
else if($_GET['sort']==1){
$query="SELECT * FROM tblcontacts WHERE UserName='".$_SESSION['user']."' ORDER BY Contact";
}
else if($_GET['sort']==2){
$query="SELECT * FROM tblcontacts WHERE UserName='".$_SESSION['user']."' ORDER BY Contact DESC";
}
else if($_GET['sort']==3){
$query="SELECT * FROM tblcontacts WHERE UserName='".$_SESSION['user']."' ORDER BY City";
}
else if($_GET['sort']==4){
$query="SELECT * FROM tblcontacts WHERE UserName='".$_SESSION['user']."' ORDER BY City DESC";
}
else if($_GET['sort']==5){
$query="SELECT * FROM tblcontacts WHERE UserName='".$_SESSION['user']."' ORDER BY AddTime";
}
else if($_GET['sort']==6){
$query="SELECT * FROM tblcontacts WHERE UserName='".$_SESSION['user']."' ORDER BY AddTime DESC";
}


$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

 while($row=mysql_fetch_array($res)){
 
 echo'<tr>
 <td style="background-color:#3637ea; width:200px; padding:2px"><a href="action/delete_contacts.php?id='.$row['ID'].'" style="color:white">Удалить запись</a>
 <a href="change_form2.php?id='.$row['ID'].'" style="color:white">Изменить запись</a></td>
<td style="background-color:#3637ea; width:20px; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Contact'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Title'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['City'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Phone'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['WorkPhone'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Email'].'</td>
<td style="background-color:#3637ea; width:60px; padding:2px">'.$row['AddTime'].'</td>
<td style="background-color:#3637ea; width:20px; padding:2px">'.$row['ClientTD'].'</td>
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
<option value="my_contacts.php?sort=1"'; if($_GET['sort']==1){echo' selected';} echo'>"Контакты" - возрастание</option>
<option value="my_contacts.php?sort=2"'; if($_GET['sort']==2){echo' selected';} echo'>"Контакты" - убывание</option>
<option value="my_contacts.php?sort=3"'; if($_GET['sort']==3){echo' selected';} echo'>"Город" - возрастание</option>
<option value="my_contacts.php?sort=4"'; if($_GET['sort']==4){echo' selected';} echo'>"Город" - убывание</option>
<option value="my_contacts.php?sort=5"'; if($_GET['sort']==5){echo' selected';} echo'>"Дата добавления" - возрастание</option>
<option value="my_contacts.php?sort=6"'; if($_GET['sort']==6){echo' selected';} echo'>"Дата добавления" - убывание</option>
</select></td></tr>






</table>';
?>

<!--поиск-->
<div id="f2" name="f2" style="width:520px; height:30px; margin-top:10px">
			<input name="Button1" type="button" value="Поиск" onclick="f_show()" />
			</div>
			<div id="f" name="f" style="width:520px; height:250px; border-style:solid; border-width:1px; 
			border-color:white;padding:10px; margin-top:10px; display:none">
			 <form id="responsesForm" action="action/search_my_contacts.php" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					
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
									<span>Контакт</span><br>
									<input type="checkbox" name="Checkbox2">
									<span>Город</span><br>
									<input type="checkbox" name="Checkbox3"> 
									<span>Сотовый телефон</span><br>
									<input type="checkbox" name="Checkbox4"> 
									<span>Рабочий телефон</span><br>
									<input type="checkbox" name="Checkbox5"> 
									<span>E-mail</span><br>
								
       

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
