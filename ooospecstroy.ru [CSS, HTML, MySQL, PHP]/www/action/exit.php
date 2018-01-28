<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
$_SESSION['bool_admin']=NULL;
header("Refresh: 1; URL=../responses.php");
echo'Перенаправление...';
exit;

?>