<?php

ini_set('display_errors','On');
error_reporting('E_ALL');

$date=$_POST['date'];
$razdel=$_GET['razdel'];

 $html="";

// $html=$html.$razdel;


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
 
require_once JPATH_BASE . DS . 'includes' . DS . 'defines.php';
require_once JPATH_BASE . DS . 'includes' . DS . 'framework.php';
 

$app = JFactory::getApplication('site')->initialise();




/*

$database = JFactory::getDbo();
$database->setQuery("SELECT * FROM #__k2_items WHERE catid=".$razdel." AND published=1 AND trash=0 ORDER_BY publish_up DESC");
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
<div class="poster_img" style="height: calc(208px);">
<a href="/component/k2/item/'.($it->id).'-'.($it->alias).'" style="width:100%; height:100%; display:block;">
<img class="poster_img2" src="/media/k2/items/src/'.$hash.'.jpg" style="z-index: 500;">
</a>
</div>';


}



	
	
}


*/

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//<!-- поиск по подкатегориям --->

// получение идентификаторов дочерних категорий категории Афиши



$database = JFactory::getDbo();
$database->setQuery("SELECT * FROM #__k2_categories WHERE parent=5 AND published=1 AND trash=0");
$list = $database->loadObjectList();


//$html="1111";




$m1=0;
$sql1="";
 
foreach($list as $it) { 

$sub_cat_id_m[$m1]=$it->id;

$sql1=$sql1.$sub_cat_id_m[$m1].",";
//echo $sub_cat_id_m[$m1]." = ";


$m1++;
    
}//foreach($list as $it) 



$sql1=substr_replace($sql1, '', strrpos($sql1, ','));



//$html=$sql1;




   

    $database2 = JFactory::getDbo();
    // $database2->setQuery("SELECT * FROM #__k2_items WHERE catid=".$sub_cat_id."  AND trash=0");
	  $database2->setQuery("SELECT * FROM #__k2_items WHERE catid IN (".$sql1.") AND trash=0 ORDER BY publish_down,publish_up ");
   
     
    $list2 = $database2->loadObjectList();
    
    foreach($list2 as $it2) {
    
       $hash2 = md5('Image'.$it2->id);
    
        $today=$date;
        //$today10=substr($today,0,10);
        
        
  $result=(($it2->publish_up)<$today);
$result2=($today<($it2->publish_down));        



for($i_1=0;$i_1<30;$i_1++){
//$tmp_date=("Y-m-d H:i:s", time()+(86400*$i_1));
$day_7=date("Y-m-d H:i:s", time()+(86400*$i_1));



//echo $day_7."<br>";

//$result=(($it2->publish_up)<$today);
//$result2=($today<($it2->publish_down));



$result=(($it2->publish_up)<$day_7);
$result2=($day_7<($it2->publish_down));

//echo ($it2->publish_up)." - ".;

//echo $result." = ".$result2."   <br>";

if(($result==true)&&($result2==true)){ break; };
}









if(($result==true)&&($result2==true)){
	
	
	
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
<img class="poster_img2" src="/media/k2/items/src/'.$hash2.'.jpg" style="z-index: 500;">
</a>
</div>';
    
    
  }
//    
    
    }
    
    
   
 
    











echo $html;







////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////





?>