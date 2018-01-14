<?php
session_start();
require 'config/config.php';
header('Content-type: text/html; charset=utf-8');
//  if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)||($_SESSION['user']=="")){
//$x="login";
//header('Location: '.$x.".php");//перенаправление на форму авторизации.
// }

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

function action(t){
var t2=("actions2.php?id_action="+t);

window.location.href=t2;

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
<span>Все клиенты</span>
</div>
<div align="center" style="width:1200px;  border:1px white solid; border-top:0px; font-size:15pt;  padding:5px">

<table style="width:1100px; font-size:11pt">
<tr style="font-size:10pt">
<td style="background-color:#3637ea; width:200px; padding:2px"></td>
<td style="background-color:#3637ea; width:10px; padding:2px">ID</td>
<td style="background-color:#3637ea; width:100px; padding:2px">Клиент</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Отрасль</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Лояльность</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Телефон</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Сайт</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Заметки</td>
<td style="background-color:#3637ea; width:130px; padding:2px">E-mail</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Адрес</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Категории</td>
<td style="background-color:#3637ea; width:60px; padding:2px">Кто добавил запись</td>

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
$query="SELECT * FROM qdfmain ORDER BY Client";
}
else if($_GET['sort']==1){
$query="SELECT * FROM qdfmain ORDER BY Client";
}
else if($_GET['sort']==2){
$query="SELECT * FROM qdfmain ORDER BY Client DESC";
}
else if($_GET['sort']==3){
$query="SELECT * FROM qdfmain ORDER BY Loyalty";
}
else if($_GET['sort']==4){
$query="SELECT * FROM qdfmain ORDER BY Loyalty DESC";
}

$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

 while($row=mysql_fetch_array($res)){

//если есть связанное событие
 $query2="SELECT * FROM tblactions ORDER BY StartTime";
 $res2=mysql_query($query2);
					if($res2==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
					
 $query3="SELECT * FROM tblcontacts";
 $res3=mysql_query($query3);
					if($res3==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }


$ind=0;
$ind2=0;

 while($row2=mysql_fetch_array($res2)){
  if($row2['ClientID']==$row['ID']){$ind=1;break;}//имеется связанное событие.
 
  }

  
   while($row3=mysql_fetch_array($res3)){
  if($row3['ClientTD']==$row['ID']){$ind2=1;break;}//имеются связанные контакты.
 
  }
  
  
  if($ind==0){
 echo'<tr style="font-size:8pt">
 <td style="background-color:#3637ea; width:200px; padding:2px"><a href="action/delete.php?id='.$row['ID'].'" style="color:white">Удалить запись</a>
<a href="change_form.php?id='.$row['ID'].'" style="color:white">Изменить запись</a></td>
<td style="background-color:#3637ea; width:10px; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:90px; padding:2px">'.$row['Client'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Industry'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Loyalty'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Phone'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Site'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Note'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Email'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Adress'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Categories'].'</td>
<td style="background-color:#3637ea; width:60px; padding:2px">'.$row['User'].'</td>
<td style="width:60px; padding:2px; color:white"><a href="input2.php?id='.$row['ID'].'" alt="" style="color:white">Добавить событие</a></br>
<a href="input_contact_form.php?id='.$row['ID'].'" alt="" style="color:white">Добавить контакт</a></br>';
if($ind2==1){echo'<a href="contacts2.php?id='.$row['ID'].'" alt="" style="color:lime">Посмотреть контакты</a></td>';};
echo'</tr>';}
else if($ind==1){
 echo'
 <tr style="font-size:8pt">
 <td style="background-color:#3637ea; width:200px; padding:2px"><a href="action/delete.php?id='.$row['ID'].'" style="color:white">Удалить запись</a>
 <a href="change_form.php?id='.$row['ID'].'" style="color:white">Изменить запись</a></td>
 <td style="background-color:#3637ea; width:10px; padding:2px; border:1px yellow solid; cursor:pointer"
 title="Имеется связанное событие. Кликните, чтобы посмотреть." onclick=\'action('.$row['ID'].');\'>'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:90px; padding:2px; border:1px yellow solid; cursor:pointer" 
title="Имеется связанное событие. Кликните, чтобы посмотреть." onclick=\'action('.$row['ID'].');\'>'.$row['Client'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px; border:1px yellow solid; cursor:pointer" 
title="Имеется связанное событие. Кликните, чтобы посмотреть." onclick=\'action('.$row['ID'].');\'>'.$row['Industry'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px; border:1px yellow solid; cursor:pointer" 
title="Имеется связанное событие. Кликните, чтобы посмотреть." onclick=\'action('.$row['ID'].');\'>'.$row['Loyalty'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px; border:1px yellow solid; cursor:pointer" 
title="Имеется связанное событие. Кликните, чтобы посмотреть." onclick=\'action('.$row['ID'].');\'>'.$row['Phone'].'</td>

<td style="background-color:#3637ea; width:100px; padding:2px; border:1px yellow solid; cursor:pointer" 
title="Имеется связанное событие. Кликните, чтобы посмотреть." onclick=\'action('.$row['ID'].');\'>'.$row['Site'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px; border:1px yellow solid; cursor:pointer" 
title="Имеется связанное событие. Кликните, чтобы посмотреть." onclick=\'action('.$row['ID'].');\'>'.$row['Note'].'</td>

<td style="background-color:#3637ea; width:100px; padding:2px; border:1px yellow solid; cursor:pointer" 
title="Имеется связанное событие. Кликните, чтобы посмотреть." onclick=\'action('.$row['ID'].');\'>'.$row['Email'].'</td>

<td style="background-color:#3637ea; width:100px; padding:2px; border:1px yellow solid; cursor:pointer" 
title="Имеется связанное событие. Кликните, чтобы посмотреть." onclick=\'action('.$row['ID'].');\'>'.$row['Adress'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px; border:1px yellow solid; cursor:pointer" 
title="Имеется связанное событие. Кликните, чтобы посмотреть." onclick=\'action('.$row['ID'].');\'>'.$row['Categories'].'</td>


<td style="background-color:#3637ea; width:60px; padding:2px; border:1px yellow solid; cursor:pointer" 
title="Имеется связанное событие. Кликните, чтобы посмотреть." onclick=\'action('.$row['ID'].');\'>'.$row['User'].'</td>
<td style="width:60px; padding:2px; color:white"><a href="input2.php?id='.$row['ID'].'" alt="" style="color:white">Добавить событие</a></br>
<a href="input_contact_form.php?id='.$row['ID'].'" alt="" style="color:white">Добавить контакт</a></td></br>';
if($ind2==1){echo'<a href="contacts2.php?id='.$row['ID'].'" alt="" style="color:lime">Посмотреть контакты</a></td>';};
echo'</tr>';
}

 
 
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
<option value="clients.php?sort=1"'; if($_GET['sort']==1){echo' selected';} echo'>"Клиенты" - возрастание</option>
<option value="clients.php?sort=2"'; if($_GET['sort']==2){echo' selected';} echo'>"Клиенты" - убывание</option>
<option value="clients.php?sort=3"'; if($_GET['sort']==3){echo' selected';} echo'>"Лояльность" - возрастание</option>
<option value="clients.php?sort=4"'; if($_GET['sort']==4){echo' selected';} echo'>"Лояльность" - убывание</option>

</select></td></tr>






</table>';
?>

<!--поиск-->
<div id="f2" name="f2" style="width:520px; height:30px; margin-top:10px">
			<input name="Button1" type="button" value="Поиск" onclick="f_show()" />
			</div>
			<div id="f" name="f" style="width:520px; height:250px; border-style:solid; border-width:1px; 
			border-color:white;padding:10px; margin-top:10px; display:none">
			 <form id="responsesForm" action="action/search_clients.php" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					
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
									<span>Клиент</span><br>
									<input type="checkbox" name="Checkbox2">
									<span>Отрасль</span><br>
									<input type="checkbox" name="Checkbox3"> 
									<span>Лояльность</span><br>
									<input type="checkbox" name="Checkbox4"> 
									<span>Телефон</span><br>
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
