<?php


define( '_JEXEC', 1 );
define( 'DS', DIRECTORY_SEPARATOR );

$dir=str_replace("/ajax","",dirname(__FILE__));
$dir=str_replace("\ajax","",$dir);

if ( file_exists( $dir. '/defines.php' ) ) {
	include_once $dir. '/defines.php';
}
if ( !defined( '_JDEFINES' ) ) {
	define( 'JPATH_BASE', $dir );
	require_once JPATH_BASE . '/includes/defines.php';
}
require_once JPATH_BASE . '/includes/framework.php';

$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();

session_start();

//echo"222==";
$payment_method=$_POST['payment_method'];

//echo $payment_method;

$_SESSION["__k2store"]["payment_values"]["payment_plugin"]=$payment_method;
$_SESSION["__k2store"]["payment_method"]=$payment_method;

 // $_SESSION["__k2store"]["payment_values"]["payment_plugin"]="payment_banktransfer";
//  echo $_SESSION["__k2store"]["payment_values"]["payment_plugin"];
  
//  $_SESSION["__k2store"]["payment_method"]="payment_banktransfer";
 // echo $_SESSION["__k2store"]["payment_method"];
  

//echo print_r($_SESSION["__k2store"]);
//echo $first_name;
//echo"==";

?>