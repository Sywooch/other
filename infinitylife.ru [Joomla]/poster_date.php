<?php

ini_set('display_errors','On');
error_reporting('E_ALL');

$date=$_POST['date'];




//echo $dir;

//define('JPATH_BASE', $dir );
//define( 'DS', "/");
//require_once ( JPATH_BASE .DS.'libraries'.DS.'joomla'.DS.'factory.php' );
//require_once ('/home/h/hinewsge.bget.ru/public_html/libraries/joomla/factory.php');
//echo "1111";

 
 $dir=str_replace("/action","",dirname(__FILE__));

// define('JPATH_BASE', $dir ); 

  
     define('_JEXEC', 1);
define('JPATH_BASE', $dir);
define('DS', DIRECTORY_SEPARATOR);
 
/* Required files */
require_once JPATH_BASE . DS . 'includes' . DS . 'defines.php';
require_once JPATH_BASE . DS . 'includes' . DS . 'framework.php';
 
/* Create the Application */
$app = JFactory::getApplication('site')->initialise();





$database = JFactory::getDbo();
$database->setQuery("SELECT * FROM #__k2_items WHERE catid=5");
$list = $database->loadObjectList();
 
$html="";


foreach($list as $it) { 
   
   
   $hash = md5('Image'.$it->id);
	//echo $hash;

//echo $it->publish_up;
//echo"<br>";
//echo $it->publish_down;
//echo"<br>";
$today=$date;
//echo $today;

$result=(($it->publish_up)<$today);
$result2=($today<($it->publish_down));

if(($result==true)&&($result2==true)){
	

$html=$html.'
<div class="poster_img" style="background-image:url(/media/k2/items/src/'.$hash.'.jpg);">
</div>';


}



	
	
}




echo $html;



?>