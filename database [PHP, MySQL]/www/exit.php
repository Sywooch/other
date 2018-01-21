<?php
session_start();
require 'config/config.php';
header('Content-type: text/html; charset=utf-8');
 unset($_SESSION['user']);
 $x="login";
header('Location: '.$x.".php");//перенаправление на форму авторизации.
?>
