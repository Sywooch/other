<?php
error_reporting(~E_NOTICE);

#if (file_exists('install/index.php')) header('Location: install/');
header('Content-Type: text/html; charset=utf-8'); 
require_once('../config.php');
require_once('../config/config.php');
session_cache_expire(60*24);

$_SESSION['db'] = $_POST;

$host = $_POST['host'];
$uid = $_POST['uid'];
$pwd = $_POST['pwd'];

if (!$conn = @ mysql_connect($host, $uid, $pwd)) {
    $output = 'ConnectionError';
}
else {
    $database_name = mysql_real_escape_string($_POST['database_name']);
    $database_name = str_replace("`", "", $database_name);

    if (!@ mysql_select_db($database_name, $conn)) {
        $output = 'NotExists';
    }
    else {
        $output = 'OK';
    }
}

echo $output;
?>