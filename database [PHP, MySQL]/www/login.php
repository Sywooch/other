<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require 'config/config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Учёт клиентов</title>
<style type="text/css">

html, body {
  margin:0;
  padding:0;
  width:100%;
  height:100%;
}
#content {
  position: relative;
  min-height: 100%;
}
* html #content {
  height: 100%;
}
#footer {
  position: relative;
  margin-top: 51px;
  height: 51px;
}

</style>


</head>

<body style="background-color:#0b0b0b;  ">


<div align="center"  id="content" style="width:100% ;
background-image:url('images/login/fon.png'); background-repeat:no-repeat; background-position:50% 0%; background-color:#0b0b0b; "><!--id="content"-->

<form id="uploadForm" action="action/login.php" enctype="multipart/form-data" method="post" accept-charset="utf-8">

<div align="center" style="width:390px; height:341px;  position:absolute;  top:50%;left:50%; margin: -170px 0 0 -195px; 
background-image:url('images/login/form.png'); background-repeat:no-repeat; text-align:center;">

<div align="center" style="text-align:center; width:390px; height:190px; margin-top:150px;">

<div name="name" id="name" style="width:320px; padding-left:36px; padding-right:36px; height:38px; margin-top:0px" >
<input type="text" style="width:259px; height:38px; border:0; margin:0; background-image:url('images/login/login.png');
background-repeat:no-repeat; padding-left:10px; padding-right:50px; color:#757575;
font-family:Arial, Helvetica, sans-serif; font-size:12pt; font-weight:bolder;
outline: none; "  placeholder="Login"/>
</div>

<div style="width:320px; padding-left:37px; padding-right:35px; height:38px; margin-top:20px" >
<input type="password" name="pass" id="pass" style="width:259px; height:38px; border:0; margin:0; background-image:url('images/login/password.png');
background-repeat:no-repeat; padding-left:10px; padding-right:50px; color:#757575;
font-family:Arial, Helvetica, sans-serif; font-size:12pt; font-weight:bolder;
outline: none; margin-top:0px"  placeholder="Password"/>
</div>

<div style="width:320px; padding-left:37px; padding-right:35px; height:38px; margin-top:20px" >
<input type="submit"  value="" style="height:38px; width:113px; background-image:url('images/login/button.png'); 
background-repeat:no-repeat; cursor:pointer"/>
</div>

</div>


<!--<div align="center" style="width:100%; color:white; font-family:Arial, Helvetica, sans-serif;">
<!--<div align="center" style="width:700px; min-height:100px; padding:10px; border:2px white solid">



<div align="center" style="width:670px; height:40px; padding:5px; border:1px white solid; font-size:15pt">
<span>Вход</span>
</div>
<div align="center" style="width:680px;  border:1px white solid; border-top:0px; font-size:15pt; padding-top:20px; padding-bottom:20px">
<form id="uploadForm" action="action/login.php" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<table style="padding:5px">
<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:60px; padding:5px; text-align:right; background-color:#3366FF"><span style="font-size:12pt">Имя пользователя</span></td>
<td style="width:300px; height:60px; padding:5px; background-color:#3366FF"> 
<select name="name" style="width:178px;margin-left:3px;background-color:#FFFF99">-->
<?php
/*$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");

$query="SELECT * FROM users ORDER BY name";
$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
$i=1;					
 while($row=mysql_fetch_array($res)){

echo'<option value='.$row['name'].' selected>'.$row['name'].'</option>';

}
*/
?>
<!--
</select>
</td>
</tr>
<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:60px; padding:5px; text-align:right; background-color:#3366FF"><span style="font-size:12pt">Пароль</span></td>
<td style="width:300px; height:60px; padding:5px; background-color:#3366FF">
<input type="password" name="pass"  style="width: 200px;background-color:#FFFF99;margin-left:3px"/>
</td>
</tr>
</table>
<input type="submit" value="Готово" style="height:50px; width:100px"/>
</form>

</div>


</div>-->
<!--</div>-->

</div>

</form>

</div><!--id="content"-->

<div id="footer" style=" width:100%; background-image:url('images/login/fon_footer.png'); 
background-repeat:no-repeat; background-position:50% 0%; background-color:#0b0b0b; "><!--id="footer"-->
  
</div><!--id="footer"-->


</body>

</html>
