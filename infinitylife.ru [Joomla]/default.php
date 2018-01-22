<?php
/**
 * @version		2.6.x
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>




<?php


//$items[0]->catid
$catimg = JPATH_SITE."/media/k2/categories/".$items[0]->catid.".*";
$fullpath = glob($catimg);
$ext = pathinfo($fullpath[0], PATHINFO_EXTENSION);
$catimg = "/media/k2/categories/".$items[0]->catid.".".$ext;

$module->title = str_replace(" ", "<br>", $module->title);



//echo "===]".$module->title;
?>



<?php


$module->title = str_replace("События<br>партнёров", "События партнёров", $module->title);

?>
<div style="background-image: url('<?php echo $catimg; ?>');" class="tmp7 k2ItemsBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>" id="k2ModuleBox<?php echo $module->id; ?>">
    <div>
        <div>
            <div>
                <h1><?php echo $module->title; ?></h1>
                
            </div>
        </div>
    </div>
    <div>
        
    <?php 
    if(($module->title)=="новости"){ echo '<div class="tmp_text1">запуск раздела:</div><div class="tmp_text2">ИЮЛЬ 2015</div>';  }; 
    if(($module->title)=="Обзоры"){ echo '<div class="tmp_text1">запуск раздела:</div><div class="tmp_text2">ИЮЛЬ 2015</div>';  }; 
   // if(($module->title)=="Видео"){ echo '<div class="tmp_text1">запуск раздела:</div><div class="tmp_text2">ИЮЛЬ 2015</div>';  }; 
    if(($module->title)=="События партнёров"){ echo '<div class="tmp_text1">запуск раздела:</div><div class="tmp_text2">ИЮЛЬ 2015</div>';  }; 
    if(($module->title)=="Купоны"){ echo '';  }; 
    if(($module->title)=="Голосования и опросы"){ echo '';  }; 
    
    
    ?>    
       
     
     
       

<!-----===================================---->       

<?php if(($module->title)=="Видео"){  ?>

<?php
// получить последние 4 видео
require_once("apiKey.php");

$database = JFactory::getDbo();
$database->setQuery("SELECT * FROM #__k2_categories WHERE  parent='51'");
$list = $database->loadObjectList();
                                        
$i_video=0;                                
foreach($list as $it){
    
	$pos = strpos($it->name, '-!-');
	if ($pos === false) {
		continue;
	}
	
	$ex = explode("-!-", $it->name);
	
	
	
	
	
	
	
	$userVideo = $ex[1];
	$userVideo=trim($userVideo);
	
	$opts = array(
  	'http'=>array(
    'method'=>"GET",
    'header'=>"Origin: http://amur.infinitilife.ru/video"
  	)
	);
	
//echo $userVideo;


$maxInPage=4;
$page="";

$data = file_get_contents("https://www.googleapis.com/youtube/v3/search?key=".$apiKey."&channelId=".$userVideo."&part=snippet,id&order=date&maxResults=".$maxInPage."&pageToken=".$page, false, stream_context_create($opts));
	
$json = json_decode($data);


//print_r($json);
	for($i = 0; count($json->items)>$i; $i++){
	$forItem = $json->items[$i];
	$idVideo = $forItem->id->videoId;
	
	$data = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails,statistics,status&id=".$idVideo."&key=".$apiKey, false, stream_context_create($opts));
	$videoJson = json_decode($data);
	
	//print_r($videoJson);//die;
	?>
	
	
	
	<!--
	<a href="<?php  echo"/video/".($it->alias)."/".$idVideo;     ?>" class="main_video" style="background-image:url(http://img.youtube.com/vi/<?php  echo $idVideo; ?>/hqdefault.jpg);">
	<span>
	<?php
	if(strlen($videoJson->items[0]->snippet->title)>250){
	    echo mb_substr ($videoJson->items[0]->snippet->title,0,250); echo " ...";
    	$title=mb_substr ($videoJson->items[0]->snippet->title,0,250)." ...";
	}else{
	    echo $videoJson->items[0]->snippet->title;
    	$title=$videoJson->items[0]->snippet->title;
	}
	?>
	
	<?php
	
	
			$publish_date=$videoJson->items[0]->snippet->publishedAt;
			$publish_date=str_replace("T"," ",$publish_date);
			$publish_date=str_replace(".000Z","",$publish_date);
			
			 //echo  $publish_date;  
			 
			
	
	?>
	    
	</span>    
	    
	</a>
	-->
	<?php
	//$mas_link[$i_video]="/video/".($it->alias)."/".$idVideo;
	//$mas_title[$i_video]=$title;
	//$mas_img[$i_video]="http://img.youtube.com/vi/".$idVideo."/hqdefault.jpg";
	//$mas_date[$i_video]=$publish_date;
	
	//$mas_date2=$mas_date;
	
	//$mas[$i_video]["link"]="/video/".($it->alias)."/".$idVideo;
	//$mas[$i_video]["title"]=$title;
	//$mas[$i_video]["img"]="http://img.youtube.com/vi/".$idVideo."/hqdefault.jpg";
	//$mas[$i_video]["date"]=$publish_date;

$link="/video/".($it->alias)."/".$idVideo;
$title=$title;
$img="http://img.youtube.com/vi/".$idVideo."/hqdefault.jpg";


$mas["".$link."-!-".$title."-!-".$img.""]=$publish_date;
	

	?>
	
	
	
	
	
	
	
	<?php
	
	
	
	
	
	
	    
	}



}







$database = JFactory::getDbo();
$database->setQuery("SELECT * FROM #__k2_items WHERE catid='52' AND trash='0'"); 
$list = $database->loadObjectList();
foreach($list as $it) { 
   
//echo $url;

if((($url!="/video")&&($url!="/video/infinitilife"))){ break; }

$ext=$it->extra_fields_search;
//echo $ext;
$ext=trim($ext);

$data = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails,statistics,status&id=".$ext."&key=".$apiKey, false, stream_context_create($opts));

$videoJson = json_decode($data);



$link="/video/infinitilife/".$it->alias;
$title=$videoJson->items[0]->snippet->title;
$img="http://img.youtube.com/vi/".$ext."/hqdefault.jpg";

$publish_date=$videoJson->items[0]->snippet->publishedAt;
$publish_date=str_replace("T"," ",$publish_date);
$publish_date=str_replace(".000Z","",$publish_date);

$mas["".$link."-!-".$title."-!-".$img.""]=$publish_date;


}






arsort($mas);

$r=0;
foreach($mas as $k=>$v){
  //echo "$k ";echo"<br>";
  
$k_m=explode("-!-",$k);

$link_v=$k_m[0];
$title_v=$k_m[1];
$img_v=$k_m[2];

echo'<a href="'.$link_v.'" class="main_video">
<div class="icon" style="background-image:url('.$img_v.');"></div>
<span>
'.$title_v.'
</span>
</a>';	
  
  
  
  
  
if($r==1){
break;    
}  
$r++;    
} 

?>


<?php } ?>

<!-----===================================---->    
    
      
     
     
     
       

<!-----===================================---->       
<?php if(($module->title)=="Афиши"){  ?>




<?php  shuffle($items);  ?>
<?php foreach ($items as $key=>$item):
?>   

<?php    
    $datetime = explode(" ", $item->created);
    $date = explode("-", $datetime[0]);
    $time = explode(":", $datetime[1]);

    ?>
    

    
    
        <div class="info tmp8">
    
<?php


//echo $item->catid;


$catid=$item->catid;

 $database3 = JFactory::getDbo();
     $database3->setQuery("SELECT * FROM #__k2_categories WHERE id='".$catid."'  ");
     
    $list3 = $database3->loadObjectList();
    
    foreach($list3 as $it3) {
        $cat_alias=$it3->alias;
     //   echo $cat_alias;
    }


?>            
<?php
$alias1=str_replace("vse/","",$item->alias);
$cat_alias=str_replace("vse","",$cat_alias);
$link1=str_replace("//","/","/afishi/".$cat_alias."/".$alias1);
?>



            
<?php if($params->get('itemImage') && isset($item->imageSmall)): ?>

            <div class="img">
                
                

                <a class="moduleItemImage" href="<?php 
                
                //echo $item->link; 
                echo $link1; 
                ?>" title="<?php echo JText::_('K2_CONTINUE_READING'); ?> &quot;<?php echo K2HelperUtilities::cleanHtml($item->title); ?>&quot;">
                    <div style="background-image: url('<?php echo $item->imageSmall; ?>');" class="tmp9"></div>
                </a>
            </div>
<?php endif; ?>
            <div class="text"><a style="display: block;" class="moduleItemTitle" 
            title="<?php echo JText::_('K2_CONTINUE_READING'); ?> &quot;<?php echo K2HelperUtilities::cleanHtml($item->title); ?>&quot;" 
            href="<?php echo $link1; ?>"><?php echo $item->title; ?></a></div>
            <div class="views"><?php echo $item->hits; ?></div>
            <div class="time"><?php echo $time[0].":".$time[1]; ?></div>
            <div class="data"><?php echo $date[2].".".$date[1].".".$date[0]; ?></div>
            
            
            
            
            
        </div>
        <?php endforeach; ?>
        
        
<?php  }else{  ?>


<?php foreach ($items as $key=>$item):
   

    
    $datetime = explode(" ", $item->created);
    $date = explode("-", $datetime[0]);
    $time = explode(":", $datetime[1])
    ?>
        <div>
<?php if($params->get('itemImage') && isset($item->imageSmall)): ?>
            <div class="img">
                <a class="moduleItemImage" href="<?php echo $item->link; ?>" title="<?php echo JText::_('K2_CONTINUE_READING'); ?> &quot;<?php echo K2HelperUtilities::cleanHtml($item->title); ?>&quot;">
                    <div style="background-image: url('<?php echo $item->imageSmall; ?>');"></div>
                </a>
            </div>
<?php endif; ?>
            <div class="text"><a style="display: block;" class="moduleItemTitle" title="<?php echo JText::_('K2_CONTINUE_READING'); ?> &quot;<?php echo K2HelperUtilities::cleanHtml($item->title); ?>&quot;" href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a></div>
            <div class="views"><?php echo $item->hits; ?></div>
            <div class="time"><?php echo $time[0].":".$time[1]; ?></div>
            <div class="data"><?php echo $date[2].".".$date[1].".".$date[0]; ?></div>
            
            
            
            
            
        </div>
        <?php endforeach; ?>

<?php } ?>

<!-----===================================---->    
    
        
        
        
        
    </div>
</div>