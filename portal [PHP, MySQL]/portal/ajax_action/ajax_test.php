<?php 
session_start();
require '../config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);


//header('Content-type: text/html; charset=utf-8');

 header("Content-type: text/txt; charset=UTF-8");



					
////////////////////////////////////////////////////////
//echo"".$_POST['z']."";
 //print_r($_REQUEST);
	//echo"123";

if(isset($_POST['z'])) {
   header("Content-type: text/txt; charset=UTF-8");
    if($_POST['z']=='1') {
        echo 'запрос POST успешно обработан, z = 1';
    }
    else {
        echo 'карявый POST запрос';
    }
}
echo"".$_POST['z']."";

 ?>