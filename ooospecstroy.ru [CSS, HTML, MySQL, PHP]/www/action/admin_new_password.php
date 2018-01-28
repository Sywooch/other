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
<script type="text/javascript" src="http://specstroy/js/jquery-1.8.2(2).js"></script>
<script type="text/javascript">
function click_radio(){
$('input#password_old_text').fadeOut(500);
$('input#password_new_text').fadeOut(1000);
$('input#password_new2_text').fadeOut(1500);
}

function click_radio2(){
$('input#password_old_text').fadeIn(500);
$('input#password_new_text').fadeIn(1000);
$('input#password_new2_text').fadeIn(1500);
}
</script>
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
			<div style="width:690px; height:550px; border-style:solid; border-width:1px; border-color:black;padding:10px; overflow:auto">
		    <div align="left" style="width:660px">
	<p align="center" class="style58" style="text-align:center">
		<span  style="background-color: transparent" class="style111">
<form id="newPasswordForm" action="admin_new_password_action.php" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<strong style="margin-left:100px">Старый пароль: <input id="password_old" type="password" name="password_old" style="width: 188px; 
background-color:#FFFF99;"
oninput="document.getElementById('password_old_text').value=this.value;"
onkeydown="document.getElementById('password_old_text').value=this.value; ">
<input id="password_old_text" type="text" name="password_old_text" style="width: 188px; background-color:#FFFF99;" ></strong>
</br>


<strong style="margin-left:106px">Новый пароль: <input type="password" name="password_new" style="width: 188px; background-color:#FFFF99"
oninput="document.getElementById('password_new_text').value=this.value;"
onkeydown="document.getElementById('password_new_text').value=this.value; ">
<input id="password_new_text" type="text" name="password_new_text" style="width: 188px; background-color:#FFFF99;"></strong>
</br>
<strong style="margin-left:41px">Подтверждение пароля: <input type="password" name="password_new2" style="width: 188px; background-color:#FFFF99"
oninput="document.getElementById('password_new2_text').value=this.value;"
onkeydown="document.getElementById('password_new2_text').value=this.value; ">
<input id="password_new2_text" type="text" name="password_new2_text" style="width: 188px; background-color:#FFFF99;"></strong>
</br>
</br>
<strong style="margin-left:0px"><input type="submit" value="Готово" name="upload" style="width: 125px; height: 38px; margin-left:216px" />
<input name="vote_check" type="radio" value="1" onclick="click_radio2()" selected>Показать пароли</input>
<input name="vote_check" type="radio" value="2" onclick="click_radio()">Скрыть пароли</input>
 </strong>
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
</html>