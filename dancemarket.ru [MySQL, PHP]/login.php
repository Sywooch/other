<? session_start();
include("../db.php"); 
if(isset($_SERVER['HTTP_X_REAL_IP'])) {$ip=$_SERVER['HTTP_X_REAL_IP'];}else{
$ip=$_SERVER['REMOTE_ADDR'];}
if (!empty($_SESSION['admin']) and !empty($_SESSION['admin_id']) and $ip==$_SESSION['admin'] and !empty($_SESSION['admin_name'])) {
echo'
<script language="JavaScript"> 
window.location.href = "index.php?a=index"
</script>';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Панель администратирования</title>
<link rel="stylesheet" href="tpl/css/style.css" type="text/css" />
<script type="text/javascript" src="tpl/js/jquery.js"></script>
<script type="text/javascript" src="tpl/js/js.js"></script>
<link rel="icon" href="tpl/img/favicon.png" type="image/x-icon">
</head>
<body>
<div class="wrapper">
<div class="head">
<a href="login.php"><img src="tpl/img/lamp.png"/></a></div>
<center>
<div class="form_login">
<form onsubmit="return false;">
<div class="login_label">Логин</div>
<input class="input" id="login" type="text" value="" />
<div class="password_label">Пароль</div>
<input class="input" id="password" type="password" value="" />
<div class="btn_" id="btn_"><a href="javascript:void(0)" onclick="log_in()" class="a_b">ВОЙТИ</a></div>
</form>
</div>
<center>
<div class="er_l">
<div id="result"></div>
</div>
</center>
</center>
<? include("tpl/footter.php"); ?>