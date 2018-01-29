<?php

session_start();

$host = $_POST['host'];
$uid = $_POST['uid'];
$pwd = $_POST['pwd'];

$_SESSION['db'] = $_POST;

if (!$conn = @ mysql_connect($host, $uid, $pwd)) {
    $output = 'Error';
}
else {
    $output = 'OK';
}
echo $output;
?>