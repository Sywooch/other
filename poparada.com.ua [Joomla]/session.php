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

//echo"11---12==";
$first_name=$_POST['first_name'];
$phone_1=$_POST['phone_1'];
$email=$_POST['email'];
$shipping_method=$_POST['shipping_method'];
$city=$_POST['city'];
$address_1=$_POST['address_1'];


$_SESSION["__k2store"]["guest"]["billing"]["first_name"]=$first_name;
$_SESSION["__k2store"]["guest"]["billing"]["phone_1"]=$phone_1;
$_SESSION["__k2store"]["guest"]["billing"]["email"]=$email;
$_SESSION["__k2store"]["shipping_method"]="shipping_standard";
$_SESSION["__k2store"]["shipping_values"]["shipping_name"]=$shipping_method;
$_SESSION["__k2store"]["shipping_values"]["shipping_price"]="0";
$_SESSION["__k2store"]["shipping_values"]["shipping_extra"]="0";
$_SESSION["__k2store"]["shipping_values"]["shipping_code"]="0";
$_SESSION["__k2store"]["shipping_values"]["shipping_tax"]="0";
$_SESSION["__k2store"]["shipping_values"]["shipping_plugin"]="shipping_standard";
$_SESSION["__k2store"]["payment_values"]["address_1"]=$address_1;
$_SESSION["__k2store"]["payment_values"]["city"]=$city;




//echo $_SESSION["__k2store"]["guest"]["billing"]["first_name"]."-s";
//echo $_SESSION["__k2store"]["guest"]["billing"]["phone_1"]."-s";
//echo $_SESSION["__k2store"]["guest"]["billing"]["email"]."-s";
//echo $_SESSION["__k2store"]["shipping_values"]["shipping_name"]."-s";

//echo print_r($_SESSION["__k2store"]);
//echo $first_name;
//echo"==";

?>