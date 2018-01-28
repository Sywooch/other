<?php
session_start();
if(!isset($_SESSION['bool_admin'])||($_SESSION['bool_admin']==NULL)){
header("Refresh: 1; URL=authorisation.php?x=0");
echo'Перенаправление...';
exit;
}

?>

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

</head>

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
			<div><h3>Режим администратора</h3></div>
			<div style="width:690px; height:350px; border-style:solid; border-width:1px; border-color:black;padding:10px; overflow:auto">
		
		<?php
		$dbh=mysql_connect('localhost','root','fiexitheitheivae')or die("Невозможно соединиться с MySQL сервером!");
		mysql_select_db('db_specstroy')or die("Невозможно подключиться к базе!");
		$query="SELECT * FROM response_table ORDER BY date_time DESC";
		$res = mysql_query($query);
		if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
		
		 while($row=mysql_fetch_array($res)){
		echo' <p class="myriad_pro12">';
		echo' <span class="myriad_pro12_strong"><strong>';
		$f2 = $row['name'];
		echo"".$f2." / ".$row['date_time']."";
		echo'</strong></span></br>';
		$f2=$row['text'];
		echo"".$f2."</br>";			
		echo'<a href="delete.php?name='.$row['name'].'&comment='.$row['text'].'&date_time='.$row['date_time'].'">Удалить</a>';
		echo'</p>';
		echo'<hr size="1">';
			
		 
		 
		 }
		
				
			
		?>	
			
		
			</div>
			
		<div><p><a href="admin_new_password.php">Сменить пароль</a></p></div>	
		<div><p><a href="exit.php">Уйти</a></p></div>	
			
			</p></td>
		</tr>
	</tbody></table>


</div><!--контент-->



<!--самый главный блок, по размерам занимает всю страницу-->
</div>

