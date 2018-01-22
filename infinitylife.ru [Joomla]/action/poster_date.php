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
$database->setQuery("SELECT * FROM #__k2_items WHERE catid=5  AND trash=0 ORDER_BY publish_up DESC");
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
//$result2=($today<($it->publish_down));

if(($result==true)){
	

$catid=$it2->catid;

 $database3 = JFactory::getDbo();
     $database3->setQuery("SELECT * FROM #__k2_categories WHERE id='".$catid."'  ");
     
    $list3 = $database3->loadObjectList();
    
    foreach($list3 as $it3) {
        $cat_alias=$it3->alias;
    }

$alias1=str_replace("vse/","",$it2->alias);
$cat_alias=str_replace("vse","",$cat_alias);
$link1=str_replace("//","/","/afishi/".$cat_alias."/".$alias1);


$html=$html.'  
<div class="poster_img" style="height: calc(208px);">
<a href="'.$link1.'" style="width:100%; height:100%; display:block;">
<img class="poster_img2" src="/media/k2/items/src/'.$hash.'.jpg" style="z-index: 500;">
</a>
</div>';


}



	
	
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//<!-- поиск по подкатегориям --->


// получение идентификаторов дочерних категорий категории Афиши
$database->setQuery("SELECT * FROM #__k2_categories WHERE parent=5 AND published=1 AND trash=0");
$list = $database->loadObjectList();
 
foreach($list as $it) { 

$sub_cat_id=$it->id;


    $database2 = JFactory::getDbo();
     $database2->setQuery("SELECT * FROM #__k2_items WHERE catid=".$sub_cat_id." AND published=1 AND trash=0 ORDER_BY publish_up DESC");
     
    $list2 = $database2->loadObjectList();
    
    foreach($list2 as $it2) {
    
       $hash2 = md5('Image'.$it2->id);
    
        $today=$date;
    //echo $today;

    $result=(($it2->publish_up)<$today);
 //   $result2=($today<($it2->publish_down));

    if(($result==true)){
	

$html=$html.'  
<div class="poster_img" style="height: calc(208px);">
<a href="/component/k2/item/'.($it->id).'-'.($it->alias).'" style="width:100%; height:100%; display:block;">
<img class="poster_img2" src="/media/k2/items/src/'.$hash.'.jpg" style="z-index: 500;">
</a>
</div>';
    
    }
    
    
    }
    
    
    
    
    
}






 
 






echo $html;



?>