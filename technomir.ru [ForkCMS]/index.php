<?php
header('Content-type: text/html; charset=utf-8');
require '../config/config.php';
session_start();

if((!isset($_SESSION["price_user"]))||($_SESSION["price_user"]=="")||($_SESSION["price_user"]==NULL))
{
echo'
<script type="text/javascript">
window.location.href="/admin/login.php";
</script>
';
exit;
}

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Language" content="ru">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Панель администрирования</title>
<link rel="stylesheet" href="/css/style_price.css" />
</head>

<body style="margin:0; padding:0; border:0;">

<input type="button" value="Редактировать прайс-лист страницы Автоматизация" />

<input type="button" value="Редактировать прайс-лист страницы Веб-студия" />

<input type="button" value="Редактировать прайс-лист страницы IT Сопровождение" />

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</body>
</html>