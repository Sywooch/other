<?php
header('Content-type: text/html; charset=windows-1251');

ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////


 $file_array=file('../zagran_pas/file.csv');
  $file_str=implode($file_array);



$str=$_GET['number'];
 
$pos = strpos($file_str, $str);
if ($pos === false) {

header("Refresh: 1; URL=/servis-avtomaticheskoy-proverki-gotovnosti-zagranichnogo-pasporta/index.php?pas=no");

}else{

header("Refresh: 1; URL=/servis-avtomaticheskoy-proverki-gotovnosti-zagranichnogo-pasporta/index.php?pas=yes");

}




exit;

?>