<?php 
ini_set('display_errors',1);
error_reporting(E_ALL);



$dir=str_replace("/ajax","",dirname(__FILE__));
$dir=str_replace("\ajax","",dirname(__FILE__));
$dir=str_replace("/ajax","",$dir);
//echo "==".$dir."==";  

 
  
define('_JEXEC', 1);
define('JPATH_BASE', $dir);
define('DS', DIRECTORY_SEPARATOR);

 
/* Required files */
require_once JPATH_BASE . DS . 'includes' . DS . 'defines.php';
require_once JPATH_BASE . DS . 'includes' . DS . 'framework.php';
require_once JPATH_BASE .DS.'libraries'.DS.'joomla'.DS.'factory.php';
//require_once JPATH_BASE.DS.'libraries'.DS.'import.php';
//require_once JPATH_BASE.DS.'administratior'.'/components/com_zoo/config.php';
require_once ( JPATH_LIBRARIES.DS.'import.php');
$app = JFactory::getApplication('site')->initialise();



$prodict_id=$_POST['product_id'];

$rows = array();

$material1="";
$material2="";
$size="";
$database = JFactory::getDbo();
$database->setQuery("SELECT * FROM #__k2store_optionvalues WHERE option_id=2 LIMIT 1");
$list = $database->loadObjectList();
foreach($list as $item) {
	$material1=$item->optionvalue_name;
	$material2=$item->optionvalue_name;
	$rows[]=$material1;
	$rows[]=$material2;
}




//получение размера
$database->setQuery("SELECT * FROM #__k2store_product_options WHERE option_id=1 AND product_id='".$prodict_id."'");
$list = $database->loadObjectList();
$count = $database->getAffectedRows();

if($count==0){
	
	$database->setQuery("SELECT * FROM #__k2store_product_options WHERE option_id=7 AND product_id='".$prodict_id."'");
	$list = $database->loadObjectList();
	$count = $database->getAffectedRows();
	
	foreach($list as $item) {
		$product_option_id=$item->product_option_id;
	}


	$database->setQuery(" SELECT * FROM #__k2store_product_optionvalues WHERE product_option_id='".$product_option_id."' AND product_id='".$prodict_id."' AND option_id='7' LIMIT 1");
	$list = $database->loadObjectList();
	foreach($list as $item) {
		$optionvalue_id=$item->optionvalue_id;
		$product_optionvalue_id=$item->product_optionvalue_id;
		$product_option_id=$item->product_option_id;

	}


	$database->setQuery("SELECT * FROM #__k2store_optionvalues WHERE optionvalue_id='".$optionvalue_id."'");
	$list = $database->loadObjectList();
	foreach($list as $item) {
		$optionvalue_name=$item->optionvalue_name;
	}


	$size=$optionvalue_name;

	$rows[]=$size;

	
	$size_value2=$product_optionvalue_id;
	$size_value1=$product_option_id;
	
	$rows[]=$size_value1;
	$rows[]=$size_value2;


	
	
	
	
	
}else{


	foreach($list as $item) {
		$product_option_id=$item->product_option_id;
	}


	$database->setQuery(" SELECT * FROM #__k2store_product_optionvalues WHERE product_option_id='".$product_option_id."' AND product_id='".$prodict_id."' AND option_id='1' LIMIT 1");
	$list = $database->loadObjectList();
	foreach($list as $item) {
		$optionvalue_id=$item->optionvalue_id;
		$product_optionvalue_id=$item->product_optionvalue_id;
		$product_option_id=$item->product_option_id;
		
	}


	$database->setQuery("SELECT * FROM #__k2store_optionvalues WHERE optionvalue_id='".$optionvalue_id."'");
	$list = $database->loadObjectList();
	foreach($list as $item) {
		$optionvalue_name=$item->optionvalue_name;
	}


	$size=$optionvalue_name;

	$rows[]=$size;
	
	$size_value2=$product_optionvalue_id;
	$size_value1=$product_option_id;
	
	$rows[]=$size_value1;
	$rows[]=$size_value2;
	


	
}


//получение материала
//материал верха

$database->setQuery("SELECT * FROM #__k2store_product_options WHERE option_id=2 AND product_id='".$prodict_id."'");
$list = $database->loadObjectList();
$count = $database->getAffectedRows();

foreach($list as $item) {
	$product_option_id=$item->product_option_id;
}


$database->setQuery(" SELECT * FROM #__k2store_product_optionvalues WHERE product_option_id='".$product_option_id."' AND product_id='".$prodict_id."' AND option_id='2' LIMIT 1");
$list = $database->loadObjectList();
foreach($list as $item) {
	$optionvalue_id=$item->optionvalue_id;
	$product_optionvalue_id=$item->product_optionvalue_id;
	$product_option_id=$item->product_option_id;
}


$database->setQuery("SELECT * FROM #__k2store_optionvalues WHERE optionvalue_id='".$optionvalue_id."'");
$list = $database->loadObjectList();
foreach($list as $item) {
	$optionvalue_name=$item->optionvalue_name;
}



	
$material_up_value2=$product_optionvalue_id;
$material_up_value1=$product_option_id;

$rows[]=$material_up_value1;
$rows[]=$material_up_value2;





//материал низа

$database->setQuery("SELECT * FROM #__k2store_product_options WHERE option_id=3 AND product_id='".$prodict_id."'");
$list = $database->loadObjectList();
$count = $database->getAffectedRows();

foreach($list as $item) {
	$product_option_id=$item->product_option_id;
}


$database->setQuery(" SELECT * FROM #__k2store_product_optionvalues WHERE product_option_id='".$product_option_id."' AND product_id='".$prodict_id."' AND option_id='3' LIMIT 1");
$list = $database->loadObjectList();
foreach($list as $item) {
	$optionvalue_id=$item->optionvalue_id;
	$product_optionvalue_id=$item->product_optionvalue_id;
	$product_option_id=$item->product_option_id;
}


$database->setQuery("SELECT * FROM #__k2store_optionvalues WHERE optionvalue_id='".$optionvalue_id."'");
$list = $database->loadObjectList();
foreach($list as $item) {
	$optionvalue_name=$item->optionvalue_name;
}



	
$material_down_value2=$product_optionvalue_id;
$material_down_value1=$product_option_id;

$rows[]=$material_down_value1;
$rows[]=$material_down_value2;

















echo json_encode($rows);

?>