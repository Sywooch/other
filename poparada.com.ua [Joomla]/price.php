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
$material_name1=$_POST['material_name1'];
$material_name2=$_POST['material_name2'];
$price=$_POST['price'];
$size=$_POST['size'];


$database = JFactory::getDbo();
$database->setQuery("SELECT * FROM #__price_material WHERE product_id='".$prodict_id."' AND material_name1='".$material_name1."' AND material_name2='".$material_name2."' AND size='".$size."'");
$list = $database->loadObjectList();
$count = $database->getAffectedRows();

if($count==0){
//вставка
$database->setQuery(" INSERT INTO #__price_material SET product_id='".$prodict_id."', material_name1='".$material_name1."', material_name2='".$material_name2."', price='".$price."', size='".$size."'  ");
$database->query();	
	
}else{
//обновление
$database->setQuery(" UPDATE #__price_material SET price='".$price."' WHERE product_id='".$prodict_id."', material_name1='".$material_name1."', material_name2='".$material_name2."', size='".$size."'  ");
$database->query();	
	
}





?>