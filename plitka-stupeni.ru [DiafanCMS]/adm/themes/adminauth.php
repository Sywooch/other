<?php if (!defined("DIAFAN")){include "../../includes/404.php";}?><html>
<head>
<title><insert name="show_title"> - from diafan.ru</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="<insert name="path">css/style.css" rel="stylesheet" type="text/css">
<insert name="show_background">
<script type="text/javascript" src="http://yandex.st/jquery/1.7.1/jquery.min.js" charset="UTF-8"></script>
</head>
<body>
<table height="100%" width="100%">
	<tr valign="middle">
		<td></td>
		<td class="auth">			
			<div class="auth_content">
				<div class="auth_diafan">
					<insert value="Система управления сайтом">
					<div class="auth_url"><a href="http://<insert name="base_url">/" target="_blank"><insert name="base_url"></a></div>
				</div>
				<div class="auth_form">
					<form name="auth" method="post" action="">
					    <input type="hidden" name="action" value="auth">
						<table><tr>
						<td align="right" ><insert value="Логин">:&nbsp;</td>
						<td>
						<input class="inputauth" type="text" name="name"></td>
						</tr><tr>
						<td align="right"><insert value="Пароль">:&nbsp;</td>
						<td><input class="inputauth" type="password" name="pass"></td>
						</tr></table>
						<input class="button" type="submit" value="<insert value="Вход">" name="Submit">
						<a href="http://<insert name="base_url">/admin_reminding/" class="auth_reminding"><insert value="Забыли пароль?"></a>
						<insert name="errauth">
					</form>
				</div>
			    <insert name="show_brand" id="3">
				
			</div>
		</td>
		<td></td>
	</tr>
</table>
<script>
$(document).ready(function () {
	$(".auth_form input[name='name']").focus();
});
</script>
</body>
</html>
