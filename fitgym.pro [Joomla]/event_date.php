<?php
 ini_set('display_errors','On');
error_reporting('E_ALL');
 
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



$date=$_POST["date"];
 

$database = JFactory::getDbo();
$database->setQuery("SELECT * FROM #__k2_items WHERE catid=11  AND trash=0");
$list = $database->loadObjectList();

$html="";
$cnt=0;
foreach($list as $it) { 

$date1=substr($it->created,0,10);
$date=substr($date,0,10);
//$html=$html.$date."=".$date1."   ";

if($date==$date1){

$it->title = JString::substr($it->title, 0, 25);






$html=$html.'
<div id="event_itemContainer" class="tmp3 item_0">
				
<!-- Start K2 Item Layout -->
<div id="event_catItemView">
    
    <div id="event_catItemImageBlock" class="tmp3">
        
        <a href="/sobytiya/'.$it->id.'" title="'.$it->title.'" 
		style="background-image:url(\'/media/k2/items/cache/'.md5("Image".$it->id).'_M.jpg\')">
        </a>
    </div>
    
    <div id="event_info_item">
        
        <span class="region">Амурская область</span>
        
        <a href="/sobytiya/15" id="event_catItemTitle">'.$it->title.'</a>
    
        <div id="catItemTagsBlock">
            <ul>
                                    <li><a id="event_catItemTags" href="/novosti-rezultaty-poiska/tag/Амурская%20область">Амурская область</a></li>
                            </ul>
        </div> 

        <div id="event_line_clr"></div>
        
        <div id="event_catItemDateCreated">
            02.07.2015        </div>

        <div id="event_catItemHits">
            <p style="float: right;">55</p>
            <div style="margin-top: 4px; width:17px; height: 11px;margin-right: 3px; background-image: url(\'/images/eyes.png\'); background-size: 85%;background-repeat: no-repeat; background-position:center; float: right;"></div>
            
        </div>
        
    </div>
</div>
<!-- end K2 Item Layout -->			</div>

';

$cnt++;

if($cnt==12){ break; };

}



}
 
 
 echo $html;
 
?>