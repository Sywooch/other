<?php
header('Content-type: text/html; charset=utf-8');
require '../config/config.php';
session_start();
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Language" content="ru">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Авторизация</title>
<link rel="stylesheet" href="/css/style_price.css" />
<link rel="shortcut icon" href="/src/Backend/favicon.ico">
<link rel="stylesheet" href="/src/Backend/Core/Layout/Css/reset.css">
<link rel="stylesheet" href="/src/Backend/Core/Layout/Css/jquery_ui/fork/jquery_ui.css">
<link rel="stylesheet" href="/src/Backend/Core/Layout/Css/screen.css">
<link rel="stylesheet" href="/src/Backend/Core/Layout/Css/debug.css">
<link rel="stylesheet" href="/src/Backend/Modules/Authentication/Layout/Css/Authentication.css">
<!--[if IE 7]><link rel="stylesheet" href="/src/Backend/Core/Layout/Css/conditionals/ie7.css" /><![endif]-->
<!--[if IE 8]><link rel="stylesheet" href="/src/Backend/Core/Layout/Css/conditionals/ie8.css" /><![endif]-->

	
</head>

<body style="margin:0; padding:0; border:0; background:#EBF3F9;">

<table id="loginHolder">
		<tbody><tr>
			<td>
				
				
				<div id="loginBox">
					<div id="loginBoxTop">
						<h2>Мир технологий</h2>
					</div>
<!--
					<form accept-charset="UTF-8" action="/admin/action/login.php" method="post" id="authenticationIndex" class="forkForms submitWithLink">
												<div class="horizontal">
							<div id="loginFields">
								<p>
									<label for="backendEmail">E-mail</label>
									<input value="" id="backendEmail" name="backend_email" maxlength="255" type="text" class="inputText"> 								</p>
								<p>
									<label for="backendPassword">Пароль</label>
									<input type="password" value="" id="backendPassword" name="backend_password" class="inputText inputPassword"> 								</p>
							</div>
							<p class="spacing">
								<input name="login" type="submit" value="Логин" class="inputButton button mainButton" tabindex="-1" style="position: absolute; top: -9000px; left: -9000px;"><a class="submitButton button inputButton button mainButton" href="#undefined"><span>Логин</span></a>
							</p>
						</div>
					</form>
-->
		
					<form accept-charset="UTF-8" action="/admin/action/login.php" method="post" class="forkForms submitWithLink">
					<div class="horizontal">
					<div id="loginFields">
					<p>
					<label for="backendEmail">E-mail</label>
					<input value="" id="backend_email" name="backend_email" maxlength="255" type="text" class="inputText">
					</p>
					<p>
					<label for="backendPassword">Пароль</label>
					<input type="password" value="" id="backend_email" name="backend_password" class="inputText inputPassword">
					</p>
					</div>
					<p class="spacing">
					<input name="login" type="submit" value="Логин">
					</p>
					</div>
					</form>
				
					
				</div>

				
			</td>
		</tr>
	</tbody></table>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</body>
</html>