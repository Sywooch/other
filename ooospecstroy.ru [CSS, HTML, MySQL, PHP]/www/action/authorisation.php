<?php
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);


if($_GET['x']==0){//вывести форму
echo'
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Режим администратора</title>
<link rel="stylesheet" href="css/global.css"/>
<link rel="stylesheet" href="css/style.css"/>
<link rel="stylesheet" href="css/style_header.css"/>
<link rel="stylesheet" href="css/style_content.css"/>
<link rel="stylesheet" href="css/style_footer.css"/>
</head>';
echo'
<body class="body_style">
<!--самый главный блок, по размерам занимает всю страницу--> 
<div align="center" class="main_block">
<!--контент-->
<div class="myriad_pro12 content">
<table  width="732px" align="center" border="0" cellpadding="0" cellpadding="0" style="position:relative;z-index:9999999" >
		<tbody>
		<tr>
						<td class="style19 content_table_td">
			<p class="style75" align="justify">
			<div><h3>Режим администратора</h3></div>';
		echo'<div style="width:690px; height:550px; border-style:solid; border-width:1px; border-color:black;padding:10px; overflow:auto">
		    <div align="left" style="width:660px">
	<p align="center" class="style58" style="text-align:center">
		<span  style="background-color: transparent" class="style111">';
echo'<form id="newPasswordForm" action="authorisation.php?x=1" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<strong style="margin-left:100px">Введите пароль: <input id="password_admin" type="password" name="password_admin" style="width: 188px; 
background-color:#FFFF99;">';
echo'
<div align="center" style="width:690px; height:40px; margin-top:10px">
<strong style="margin-left:0px"><input type="submit" value="Готово" name="upload" style="width: 125px; height: 38px; margin-left:0px" />
 </strong></div>
  </form>

	</span>	</p>	
</div>

			</div>
			
		
			</p></td>
		</tr>
	</tbody></table>


</div><!--контент-->



<!--самый главный блок, по размерам занимает всю страницу-->
</div>


</body>
</html>';
}//вывести форму
else if($_GET['x']==1){//обращение к базе

$dbh2=mysql_connect('localhost','root','fiexitheitheivae')or die("Невозможно соединиться с сервером.");
mysql_select_db('db_specstroy')or die("Невозможно подключиться к базе.");
$query2 = "SELECT * FROM admin";
 $res2=mysql_query($query2);
 if($res2==false){
 echo"Ошибка выполнения запроса.";
 echo mysql_error();
 exit; }

 $row2=mysql_fetch_array($res2);
if(md5($_POST['password_admin'])==$row2['password']){//авторизация успешна 
$_SESSION['bool_admin']=1;
header("Refresh: 1; URL=admin.php");
echo'Авторизация прошла успешно. Перенаправление...';
exit;
 }//авторизация успешна
else{//авторизация неуспешна
$_SESSION['bool_admin']=NULL;
header("Refresh: 1; URL=admin.php");
echo'Ошибка! Неверный пароль. Перенаправление...';
exit;
}//авторизация неуспешна


}//обращение к базе



?>