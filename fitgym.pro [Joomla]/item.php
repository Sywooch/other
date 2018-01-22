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
$app = JFactory::getApplication();
$template = $app->getTemplate('template')->template;
$doc = JFactory::getDocument();

$extraFields = new stdClass();
if($this->item->extra_fields) {
    foreach ($this->item->extra_fields as $extraField) {
        $alias = $extraField->alias;
        $extraFields->$alias = new stdClass();
        $extraFields->$alias = $extraField;
    }
}
?>

<?php if(JRequest::getInt('print')==1): ?>
<!-- Print button at the top of the print page only -->
<a class="itemPrintThisPage" rel="nofollow" href="#" onclick="window.print();return false;">
	<span><?php echo JText::_('K2_PRINT_THIS_PAGE'); ?></span>
</a>
<?php endif; ?>

<style type="text/css">
    .nivo-slider-wrapper.theme-light{
        display:none;
    }
    .ss2-align{
        display:none;
    }
    body > .nicescroll-rails{
        display:block !important;
    }
    .center > .content{
     /*   width:calc(100% + 16px) !important;*/
    }
	
	.jspPane{
	width:100% !important;	
	}
	
	.calendar_container.tmp0{
	display:none;	
	}
	
	.poster_items.tmp2{
	/*display:none;	*/
	visibility:hidden;
	}
	
	.main_afisha_banners.tmp1{
	display:none;	
	}
	
	.list_videos{
	    padding-bottom:5px !important;
	}
</style>




<?php
	$cat_k2="52";
	
	

	$database_k2 = JFactory::getDbo();
    $database_k2->setQuery("SELECT * FROM #__k2_items WHERE  catid='".$cat_k2."'");
   	$list = $database_k2->loadObjectList();
 
		foreach($list as $it) {
		    $ext2=$it->extra_fields_search;
		    
		    $id_ext2=$it->id;
		    $ext2=trim($ext2);
		    $database_k2_ins = JFactory::getDbo();
            $database_k2_ins->setQuery("UPDATE #__k2_items SET alias='".$ext2."' WHERE id='".$id_ext2."'");
            $database_k2_ins->query();
        
		    
		    
		    
		    
		}

?>



















<!---------------------------------------------------->
<div class="p1 photocontent-center <?php if( count(JModuleHelper::getModules('rightmenu')) ) echo "rightmenu" ?> video">




<div class="photo_sub_cats" style="left:50%; margin-left:-120px;">
<a class="tmp2" href="/video"  <?php $uri = &JFactory::getURI();
                                            $url = $uri->toString(array('path', 'query', 'fragment'));
                                        
                                        
		                                  if($url=="/video/".$it->alias.""){
		                                     
		                                      echo ' style="color:#2194BB;" ';
		                                      
		                                      
		                                  } ?>
		                                  >ВСЕ</a>    
    
<?php
  //$module = JModuleHelper::getModules('photocategory');
  //$attribs['style'] = 'none';
  //echo JModuleHelper::renderModule( $module[0], $attribs );

    if(JRequest::getInt('month') && JRequest::getInt('year') && JRequest::getInt('day')){ $date =  (JRequest::getInt('day') < 10 ? "0". JRequest::getInt('day') : JRequest::getInt('day')).".".(JRequest::getInt('month') < 10 ? "0". JRequest::getInt('month') : JRequest::getInt('month')).".". JRequest::getInt('year'); } else { $date = "Выбрать дату"; }
 
		                             $database = JFactory::getDbo();
		                                $database->setQuery("SELECT * FROM #__k2_categories WHERE  parent='51' AND published='1' AND trash='0'");
		                                $list = $database->loadObjectList();
                                        
                                        $uri = &JFactory::getURI();
                                            $url = $uri->toString(array('path', 'query', 'fragment'));
                                        
                                        
		                                foreach($list as $it){
		                               
		                               
		                               ?>
		                                  
		                                  
		                                   <?php //echo $url; ?>
		                                   <?php //echo "/video/".$it->alias."";  ?>
		                                  <a class="tmp2" href="/video/<?php echo $it->alias; ?>"
		                                  
		                                  <?php
		                                  
		                                   $url1=$this->item->category->alias;
                                           
		                                  if("/video/".$url1=="/video/".$it->alias.""){
		                                     
		                                      echo ' style="color:#2194BB;" ';
		                                      
		                                      
		                                  }
		                                  
		                                  
		                                  ?>
		                                  
		                                  >
										  <?php
										  
										  $ex = explode("-!-", $it->name);
										   echo $ex[0];  
										   
										   
										   
										   ?></a>
		                                  
		                                  
		                                  <?php
		                                  
		                                  
		                                }
    
    
    ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    


</div>


    
    
<span class="back"><a href="/" onclick="window.history.back();">Вернуться</a></span>
   


</div>




























<div class="poster_detail tmp1">


<!--
	<div class="calendar_top">
		<div class="calendar_container tmp1">
	<div class="calendar">
    	<div class="top">
        <div class="top2" id="top2_id">
        	<?php
			$time = date('d');
			
			
$day[0] = "ВС"; 
$day[1] = "ПН"; 
$day[2] = "ВТ"; 
$day[3] = "СР"; 
$day[4] = "ЧТ"; 
$day[5] = "ПТ"; 
$day[6] = "СБ"; 
			
			
			$day_1=date("w");
			
			
			if(($day_1==0)||($day_1==6)){
			$class="red";		
			}
			else{
			$class="";
			};
			
			echo '<a href="/afishi?day='.date("Y-m-d H:i:s").'"><div class="date '.$class.'" id="date_0" onclick="date(0, \''.date("Y-m-d H:i:s").'\');" style="width:100px !important;"><span class="date_num">'.$time.'</span>
			<span class="w_num">Сегодня</span>
			</div></a>';
			for($i=1;$i<90;$i++){
				$time = date('d', time()+(86400*$i));
				$day_1=date("w", time()+(86400*$i));
				
				if(($day_1==0)||($day_1==6)){
				$class="red";		
				}
				else{
				$class="";
				};
				
				echo '<a href="/afishi?day='.date("Y-m-d H:i:s", time()+(86400*$i)).'"><div class="date '.$class.'" id="date_'.$i.'" onclick="date('.$i.', \''.date("Y-m-d H:i:s", time()+(86400*$i)).'\');"><span class="date_num">'.$time.'</span>
				<span class="w_num">'.$day[$day_1]."</span>
				</div></a>";
			}
			
			
			?>
        </div>
        
        
        
        </div>
        
        <div class="bottom">
<!--<span class="date datepick"><a>Выбрать дату</a><input type="hidden" class="datepickhidden" value=""></span>
-->        
  <!--      
        <?php
		//вывод подкатегорий
		$database2 = JFactory::getDbo();
		$database2->setQuery("SELECT * FROM #__k2_categories WHERE parent=5");
		$list2 = $database2->loadObjectList();
 
		foreach($list2 as $it) { 
		
		echo'<span class="cat_name tmp9"><a href="/afishi/'.$it->alias.'?subcategory='.$it->id.'">'.$it->name.'</a></span>';
		
		}
		
		?> 
        
        
        </div>
        
        
        
        
    </div>
    
            <div class="button_right" onclick="c_right();"></div>
    		<div class="button_left" onclick="c_left();"></div>
</div>



	</div>-->


<script type="text/javascript">


function c_right(){
	var $j = jQuery.noConflict();
	//var len=$j('.calendar_container .top2').css('height');
	
	element = document.getElementById('top2_id');
	len = window.getComputedStyle(element).marginLeft;
	len=len.replace("px","");
	len=len-47;
	$j('.calendar_container .top2').css({'margin-left' : ''+len+'px'});

}

function c_left(){
	var $j = jQuery.noConflict();
		
	element = document.getElementById('top2_id');
	len = window.getComputedStyle(element).marginLeft;
	//alert(len);
	len=len.replace("px","");
	
	if(len!='0'){
		len=eval(len)+eval(47);
		//alert(len);
		$j('.calendar_container .top2').css({'margin-left' : ''+len+'px'});
	}



	
}
</script>


<!-- Start K2 Item Layout -->
<span id="startOfPageId<?php echo JRequest::getInt('id'); ?>"></span>



<!----------------DETAIL----------------------->




<div class="video_detail">
    <div class="player">

 
    
    
    
    <?php
     require_once("apiKey.php");
     
     
      
    $id_video=$this->item->alias;
  //  echo $id_video;
    
	$data = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=player,snippet,contentDetails,statistics,status&id=".$id_video."&key=".$apiKey, false, stream_context_create($opts));

	$videoJson = json_decode($data);

  //  echo $videoJson->items[0]->player->embedHtml;

    //print_r($videoJson);
    
    ?>

 <!--video js-->    
        
     <video id="vid1" src="" class="video-js vjs-default-skin" controls preload="auto"  width="200" height="360" data-setup='{ "techOrder": ["youtube"], "src": "http://www.youtube.com/watch?v=<?php  echo $id_video;  ?>" }'>
  </video>
    
    
    
    
    
    
 
<script type="text/javascript">
var $j2 = jQuery.noConflict();
var width1=$j2(".video_detail .player").css("width");
//alert(width1);
$j2("#vid1").attr("width", "calc("+width1+" + 9px)");

 
</script>
 
 <!--video js-->
 
 
    
    
    
    
    </div>
    
    
    
    <div class="desc">
        <span class="title"><?php echo $videoJson->items[0]->snippet->title;  ?></span>
        <span class="date"><strong>Опубликовано: </strong><?php $publish_date=$videoJson->items[0]->snippet->publishedAt;
			$publish_date=str_replace("T"," ",$publish_date);
			$publish_date=str_replace(".000Z","",$publish_date);
			
			 echo  $publish_date;   
			 
			 
			 ?></span>
        <span class="desc1"><?php
        
        echo $videoJson->items[0]->snippet->description;
        
      //  print_r($videoJson);
        
        ?></span>
        <span class="cat"><strong>Категория: </strong><?php echo $videoJson->items[0]->snippet->channelTitle; ?></span>
        <span class="license"><strong>Лицензия:</strong> Стандартная лицензия YouTube</span>
        <a class="link" target="_blank" href="https://youtu.be/<?php echo $id_video;  ?>"><span class="black">Посмотреть ролик на</span> <span class="red">YouTube</span></a>
        
        
    </div>
    
</div>



<script type="text/javascript">

var $j2 = jQuery.noConflict();
var width1=$j2(".video_detail .desc").css("height");
//alert(width1);
$j2("#vid1.video-js").attr("height", "calc("+width1+" + 30px)");
</script>


<!----------------DETAIL----------------------->









<!----------------LIST----------------------->

<?php
if(($this->item->category->id)=='52'){
	
?>	

<div class="list_videos" style="width:100%">

<?php

$database = JFactory::getDbo();
$database->setQuery("SELECT * FROM #__k2_items WHERE catid='52' AND trash='0' LIMIT 4"); 
$list = $database->loadObjectList();
foreach($list as $it) { 


$ext=$it->extra_fields_search;
//echo $ext;
$ext=trim($ext);

$data = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails,statistics,status&id=".$ext."&key=".$apiKey, false, stream_context_create($opts));

$videoJson = json_decode($data);

//echo $videoJson;


?>



<script type="text/javascript">
 //   alert("<?php echo "=".$ext."=";   ?>");
    
</script>


<?php
	//создание К2 материала
	$cat_k2="52";
	
	$k2_alias=$ext;
	//echo $k2_alias;
	
	$database_k2 = JFactory::getDbo();
    $database_k2->setQuery("SELECT * FROM #__k2_items WHERE  alias='".$k2_alias."'");
    $database_k2->query();
    $mun_q= $database_k2->getAffectedRows();
    
    if($mun_q==0){
        $title_k2=$videoJson->items[0]->snippet->title;
        
        
        
        $database_k2->setQuery("INSERT INTO #__k2_items (title,alias,catid,published,introtext,trash,access) VALUES ('".$title_k2."','".$k2_alias."','".$cat_k2."','1','<p>-</p>','0','1') ");
        $database_k2->query();
        
    }
	
	
	?>








	
<!------=================================================---->
<style type="text/css">
.poster_img2:hover {
  position: absolute;
  width: 120%;
  height: 120%;
  top: -10%;
  left: -10%;
  transition: all 0.3s ease-out 0s;
  z-index: 500000000000 !important;
  border: 2px solid #007baa;
}

.poster_img{
/*   height: calc(208px); width: calc( 100% / 5 );*/
 
  float: left;

  border: 0px #fff solid;
  position: relative; 
    
}

.black_shadow_1{
    width: 100%;
  height: 100%;
  z-index: 9;
  background-color: black;
  opacity: 0.5;
  position: absolute;
  left: 0px;
  top: 0px;
  cursor: pointer; 
}

.poster_img2{
    z-index: 1e+24;   position: absolute;
  top: 0;
  left: 0;
  display: block;
  width: 100%;
  height: 100%;
  padding: 0;
  margin: 0;
  border: 0px solid white;
  background-repeat: no-repeat;
  background-position: 50% 50%;
background-size:100%;
  box-sizing: border-box;
  transition: all 0.3s ease-out 0s;
  z-index: 1 !important;
}

</style>


<div class="poster_img video_item">
    
  

<div class="black_shadow_1">
    
    
</div>


    



    
<!--<a href="/component/k2/item/485-rezident-party" style="width:100%; height:100%; display:block;">-->
<a href="<?php   echo"/video/infinitilife/".str_replace("--","-",$k2_alias);     ?>" style="width:100%; height:100%; display:block;position: relative;">
<div class="poster_img2" style="background-color:black; background-image:url(http://img.youtube.com/vi/<?php  echo $ext; ?>/hqdefault.jpg);">
    
    
    
    <?php
	$duration=$videoJson->items[0]->contentDetails->duration;
	
	$duration=str_replace("PT","",$duration);
	$duration=str_replace("M"," : ",$duration);
	$duration=str_replace("S","",$duration);
	?>    
<span class="duration"><?php echo $duration;  ?></span>  
<div class="div_black">
    		<a href="<?php   echo"/video/infinitilife/".str_replace("--","-",$k2_alias);     ?>" class="title"><?php
			if(strlen($videoJson->items[0]->snippet->title)>40){
	echo mb_substr ($videoJson->items[0]->snippet->title,0,40); echo " ...";
    	
	}else{
	echo $videoJson->items[0]->snippet->title;
    	
	}
			 
			 
			  ?></a>
            <span class="channel"><?php echo  $videoJson->items[0]->snippet->channelTitle;  ?></span>
            <span class="hits"><?php echo  $videoJson->items[0]->statistics->viewCount;  ?> просмотров</span>
            <span class="publish_date"><?php
			$publish_date=$videoJson->items[0]->snippet->publishedAt;
			$publish_date=str_replace("T"," ",$publish_date);
			$publish_date=str_replace(".000Z","",$publish_date);
			
			 echo  $publish_date;  
			 
			 ?></span>
            
</div>    
    
    
</div>
<!--<span style="position:absolute; z-index:999999; background-color:yellow;">2015-07-15 06:36:00 - 14<br>2015-07-17 23:59:35</span>
-->
</a>

</div>	
	
<!------=================================================---->



<!--
<div class="video_item" style="background-image:url(http://img.youtube.com/vi/<?php  echo $ext; ?>/hqdefault.jpg);">
 <?php
	$duration=$videoJson->items[0]->contentDetails->duration;
	
	$duration=str_replace("PT","",$duration);
	$duration=str_replace("M"," : ",$duration);
	$duration=str_replace("S","",$duration);
	?>
<span class="duration"><?php echo $duration;  ?></span>
    
    	<div class="div_black">
    		<a  href="<?php  echo"/video/infinitilife/".$k2_alias;     ?>" class="title"><?php
			if(strlen($videoJson->items[0]->snippet->title)>35){
	echo mb_substr ($videoJson->items[0]->snippet->title,0,35); echo " ...";
    	
	}else{
	echo $videoJson->items[0]->snippet->title;
    	
	}
			 
			 
			  ?></a>
            <span class="channel"><?php echo  $videoJson->items[0]->snippet->channelTitle;  ?></span>
            <span class="hits"><?php echo  $videoJson->items[0]->statistics->viewCount;  ?> просмотров</span>
            <span class="publish_date"><?php
			$publish_date=$videoJson->items[0]->snippet->publishedAt;
			$publish_date=str_replace("T"," ",$publish_date);
			$publish_date=str_replace(".000Z","",$publish_date);
			
			 echo  $publish_date;  
			 
			 ?></span>
            
    	</div>
    </div>
-->





<?php

}

?>

    
	
</div>	
	
<?php
	
}else{

?>


<div class="list_videos" style="width:100%">
<?php
$ch_id=$videoJson->items[0]->snippet->channelId;
$maxInPage=4;
$page="";

	
	$data = file_get_contents("https://www.googleapis.com/youtube/v3/search?key=".$apiKey."&channelId=".$ch_id."&part=snippet,id&order=date&maxResults=".$maxInPage."&pageToken=".$page, false, stream_context_create($opts));

$json = json_decode($data);
	
		
	
	for($i = 0; count($json->items)>$i; $i++){
	//	echo "==<br>";
	$forItem = $json->items[$i];
	
	$idVideo = $forItem->id->videoId;
	//echo "idvideo = ".$idVideo."<br>";
	
	
		$data = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails,statistics,status&id=".$idVideo."&key=".$apiKey, false, stream_context_create($opts));
	//snippet
	
	$videoJson = json_decode($data);
	
	//print_r($videoJson);//die;
//	echo"<br><br>";
	
	
	
	?>
	

	
	
	
	
	
	
<!------=================================================---->
<style type="text/css">
.poster_img2:hover {
  position: absolute;
  width: 120%;
  height: 120%;
  top: -10%;
  left: -10%;
  transition: all 0.3s ease-out 0s;
  z-index: 500000000000 !important;
  border: 2px solid #007baa;
}

.poster_img{
/*   height: calc(208px); width: calc( 100% / 5 );*/
 
  float: left;

  border: 0px #fff solid;
  position: relative; 
    
}

.black_shadow_1{
    width: 100%;
  height: 100%;
  z-index: 9;
  background-color: black;
  opacity: 0.5;
  position: absolute;
  left: 0px;
  top: 0px;
  cursor: pointer; 
}

.poster_img2{
    z-index: 1e+24;   position: absolute;
  top: 0;
  left: 0;
  display: block;
  width: 100%;
  height: 100%;
  padding: 0;
  margin: 0;
  border: 0px solid white;
  background-repeat: no-repeat;
  background-position: 50% 50%;
background-size:100%;
  box-sizing: border-box;
  transition: all 0.3s ease-out 0s;
  z-index: 1 !important;
}

</style>


<div class="poster_img video_item">
    
  

<div class="black_shadow_1">
    
    
</div>


    



    
<!--<a href="/component/k2/item/485-rezident-party" style="width:100%; height:100%; display:block;">-->
<a href="<?php   echo"/video/".($this->item->category->alias)."/".str_replace("--","-",$idVideo);     ?>" style="width:100%; height:100%; display:block;position: relative;">
<div class="poster_img2" style="background-color:black;background-image:url(http://img.youtube.com/vi/<?php  echo $idVideo; ?>/hqdefault.jpg)">
    
    
    
    <?php
	$duration=$videoJson->items[0]->contentDetails->duration;
	
	$duration=str_replace("PT","",$duration);
	$duration=str_replace("M"," : ",$duration);
	$duration=str_replace("S","",$duration);
	?>    
<span class="duration"><?php echo $duration;  ?></span>  
<div class="div_black">
    		<a href="<?php   echo"/video/".($this->item->category->alias)."/".str_replace("--","-",$idVideo);     ?>" class="title"><?php
			if(strlen($videoJson->items[0]->snippet->title)>40){
	echo mb_substr ($videoJson->items[0]->snippet->title,0,40); echo " ...";
    	
	}else{
	echo $videoJson->items[0]->snippet->title;
    	
	}
			 
			 
			  ?></a>
            <span class="channel"><?php echo  $videoJson->items[0]->snippet->channelTitle;  ?></span>
            <span class="hits"><?php echo  $videoJson->items[0]->statistics->viewCount;  ?> просмотров</span>
            <span class="publish_date"><?php
			$publish_date=$videoJson->items[0]->snippet->publishedAt;
			$publish_date=str_replace("T"," ",$publish_date);
			$publish_date=str_replace(".000Z","",$publish_date);
			
			 echo  $publish_date;  
			 
			 ?></span>
            
</div>    
    
    
</div>
<!--<span style="position:absolute; z-index:999999; background-color:yellow;">2015-07-15 06:36:00 - 14<br>2015-07-17 23:59:35</span>
-->
</a>

</div>	
	
<!------=================================================---->
	
	
	
	
	
	
	
	
	
	<!--
    
    <div class="video_item" style="background-image:url(http://img.youtube.com/vi/<?php  echo $idVideo; ?>/hqdefault.jpg);">
    
    <?php
	$duration=$videoJson->items[0]->contentDetails->duration;
	
	$duration=str_replace("PT","",$duration);
	$duration=str_replace("M"," : ",$duration);
	$duration=str_replace("S","",$duration);
	?>
    <span class="duration"><?php echo $duration;  ?></span>
    
    	<div class="div_black">
    		<a href="<?php  echo"/video/".($this->item->category->alias)."/".$idVideo;     ?>" class="title"><?php
			if(strlen($videoJson->items[0]->snippet->title)>35){
	echo mb_substr ($videoJson->items[0]->snippet->title,0,35); echo " ...";
    	
	}else{
	echo $videoJson->items[0]->snippet->title;
    	
	}
			 
			 
			  ?></a>
            <span class="channel"><?php echo  $videoJson->items[0]->snippet->channelTitle;  ?></span>
            <span class="hits"><?php echo  $videoJson->items[0]->statistics->viewCount;  ?> просмотров</span>
            <span class="publish_date"><?php
			$publish_date=$videoJson->items[0]->snippet->publishedAt;
			$publish_date=str_replace("T"," ",$publish_date);
			$publish_date=str_replace(".000Z","",$publish_date);
			
			 echo  $publish_date;  
			 
			 ?></span>
            
    	</div>
    </div>
    -->
    
    
    <?php




}


?>
</div>


<?php
}
?>

<!----------------LIST----------------------->





<script type="text/javascript">
var $j2 = jQuery.noConflict();
var height1=$j2(".list_videos .video_item").css("width");
$j2('.list_videos .video_item').css({'height' : height1});
$j2('.list_videos .video_item').css({'background-size' : height1});

</script>





<!-- End K2 Item Layout -->








</div>



  
  
  
  
  
  
  
  
 
  
  
 











<div id="sbox-overlay" class="overlay_desc" aria-hidden="false" tabindex="-1" style="z-index: 65555; opacity: 0.7; width: 100%; height: 100%; 
display:none; position:fixed;" onclick="hide_overlay();">
    
    
    
    
    
</div>


<div id="sbox-window"  role="dialog" aria-hidden="false" class="shadow desc_modal" style="z-index: 65557;  width:600px; height: auto; display:none; left:50%; margin-left:-300px; top:30px;">
        <div id="sbox-content" style="opacity: 1; padding-top:5px; padding-bottom:5px; padding-left:10px; padding-right:10px;" class="sbox-content-image" >
        
        <?php echo $this->item->introtext;
        ?>
        </div>
        
    </div>

<script type="text/javascript">
    function hide_overlay(){
    var $j2 = jQuery.noConflict();
  
    
     $j2(".overlay_desc").css({"display" : "none"});
     
    $j2(".desc_modal").css({"display" : "none"});
    
   
    }
</script>

<style type="text/css">
    .shadow.desc_modal p{
        padding-top:0px;
        margin-top:0px;
    }
    #djslider-loader125{
        display:none !important;
    }
    
    
</style>


<script type="text/javascript">
var $j2 = jQuery.noConflict();
$j2(window).resize(function(){


  var h1=$j2(".poster_detail span.itemImage img").css("height");
 $j2(".poster_detail #k2Container").css({"height" : "calc("+h1+" + 20px)"});
    
    
});

$j2(document).ready(function(){


//var item_height=$j2(".poster_img").offsetWidth();


//alert(item_height);
//var h1=$j2(".poster_detail div.itemImageBlock").height();
//alert(h1);
// $j2(".poster_detail #k2Container").css({"height" : "calc("+h1+" + 10px)"});
});

</script>


<script type="text/javascript">

//var $j2 = jQuery.noConflict();

//$j2(document).ready(function(){

//alert("123");

////alert($j2);
//$j2(".poster_detail .poster_img2").css({"height" : ""+item_height+""});

//poster_img2
//});

</script>



<script type="text/javascript">
var $j2 = jQuery.noConflict();

<?php
//картинка категории
if($this->item->params->get('itemCategory')){


?>
//alert("<?php  echo $this->item->category->image;  ?>");

<?php
}
?>

$j2('.custombanner_video_main').css({'background-image' : 'url(/media/k2/categories/<?php echo $this->item->category->image; ?>)'});


</script>

<style type="text/css">
   .custombanner_video_main{
    margin-top: -35px;
    
   }
</style>

<script type="text/javascript">
video = document.getElementById("vid1")
video.addEventListener('fullscreenchange', function(e) {
 alert("full");
 }, false);

</script>


<script type="text/javascript">
var $j2 = jQuery.noConflict();
$j2('body').scroll(function(){
    
var t=$j2(".jspPane").css('top');
t=t.replace("-","");
t=t.replace("px","");

if(t>170){

    $j2(".photocontent-center.video").css({"position" : "fixed"});
    $j2(".photocontent-center.video").css({"top" : "75px"});
    $j2(".photocontent-center.video").css({"padding-right" : "127px"});
    $j2(".photocontent-center.video").css({"z-index" : "10"});
    $j2(".photocontent-center.video").css({"width" : "calc(100% - 125px)"});
    
}else{
    $j2(".photocontent-center.video").css({"position" : "relative"});
    $j2(".photocontent-center.video").css({"padding-right" : "0px"});
    $j2(".photocontent-center.video").css({"z-index" : "8"});
    $j2(".photocontent-center.video").css({"top" : "0px"});
    $j2(".photocontent-center.video").css({"width" : "auto"});
}
    
    
});
</script>




