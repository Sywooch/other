<?php
/**
 * @package		AdsManager
 * @copyright	Copyright (C) 2010-2013 JoomPROD.com. All rights reserved.
 * @license		GNU/GPL
 */
// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

$conf= $this->conf;

$tmp_model_2="";


$document	= JFactory::getDocument();
if ($conf->metadata_mode != 'nometadata') {
	$document->setMetaData("description", $this->content->metadata_description);
	$document->setMetaData("keywords", $this->content->metadata_keywords);
}
?>
<?php if ($conf->display_inner_pathway == 1) { ?>
<div class="adsmanager_pathway breadcrumb" style="display:none;">
<?php 
	$pathway ="";
	$nb = count($this->pathlist);
	for ($i = $nb - 1 ; $i >0;$i--)
	{
		$pathway .= '<a href="'.$this->pathlist[$i]->link.'">'.$this->pathlist[$i]->text.'</a>';
		$pathway .= ' <img src="'.$this->baseurl.'components/com_adsmanager/images/arrow.png" alt="arrow" /> ';
	}
	$pathway .= '<a href="'.$this->pathlist[0]->link.'">'.$this->pathlist[0]->text.'</a>';
echo $pathway;

if (function_exists('getContentClass')) 
	$classcontent = getContentClass($this->content,"details");
else
	$classcontent = "";
?>   
</div>


<?php } ?>
<?php echo $this->content->event->onContentBeforeDisplay; ?>
<?php if (@$conf->print==1) {?>
<div align='right'>
<?php if (JRequest::getInt('print',0) == 1) {
	echo TTools::print_screen();
} else {
	$url = "index.php?option=com_adsmanager&view=details&catid=".$this->content->catid."&id=".$this->content->id;
	echo TTools::print_popup($url); 
}?>
</div>
<?php } ?>

<h1>Сервисная книжка</h1>


<?php

//текущий адрес

  $result = ''; 
  $result .= 'http://';
  $result .= $_SERVER['SERVER_NAME'];
  $result .= $_SERVER['REQUEST_URI'];
  
// echo $result."<br>";


$MAS_url=explode("/",$result);

$count=count($MAS_url);

//echo $MAS_url[$count-1];

$tmp_url=str_replace("-","",$MAS_url[$count-1]);

//echo $tmp_url;




$db = JFactory::getDbo();
$query_events_u = $db->getQuery(true);

$query_events_u->select(array('id', 'ad_model'));
$query_events_u->from('#__adsmanager_ads');
$query_events_u->where('id LIKE \''.$tmp_url.'\'');


$db->setQuery($query_events_u);

$resultsu = $db->loadObjectList();

foreach($resultsu as $element_u) {
 

echo"<h1>".$element_u->ad_model."</h1>";

 $tmp_model_2=$element_u->ad_model;
   
}   


/*

$db = JFactory::getDbo();
$query_events_h = $db->getQuery(true);

$query_events_h->select(array('id', 'userid', 'ad_model'));
$query_events_h->from('#__adsmanager_ads');
$query_events_h->where('userid LIKE \''.($user->id).'\'');
$query_events_h->where('ad_model LIKE \''.$model_tmp.'\'');

$db->setQuery($query_events_h);

$resultsh = $db->loadObjectList();

foreach($resultsh as $element_h) {
 
   echo ' <a href="/servisnye-knizhki/9-servisnye-knizhki/'.$element_h->id.'-">Сервисная книжка</a>';

 
   
}   


*/

?>





 <div class="addetailsmain">
   <div class="adsmanager_ads_image" style="float:left;">
			<?php
			$this->loadScriptImage($this->conf->image_display);
			if (count($this->content->images) == 0)
				$image_found = 0;
			else
				$image_found = 1;
			foreach($this->content->images as $img)
			{
				$thumbnail = JURI::base()."images/com_adsmanager/ads/".$img->thumbnail;
				$image = JURI::base()."images/com_adsmanager/ads/".$img->image;
				switch($this->conf->image_display)
			    {
					case 'popup':
						echo "<a href=\"javascript:popup('$image');\"><img src='".$thumbnail."' alt='".htmlspecialchars($this->content->ad_headline)."' /></a>";
						break;
					case 'lightbox':
					case 'lytebox':
						echo "<a href='".$image."' rel='lytebox[roadtrip".$this->content->id."]'><img src='".$thumbnail."' alt='".htmlspecialchars($this->content->ad_headline)."' /></a>"; 
						break;
					case 'highslide':
						echo "<a id='thumb".$this->content->id."' class='highslide' onclick='return hs.expand (this)' href='".$image."'><img src='".$thumbnail."' alt='".htmlspecialchars($this->content->ad_headline)."' /></a>";
						break;
					case 'default':	
					default:
						echo "<a href='".$image."' target='_blank'><img src='".$thumbnail."' alt='".htmlspecialchars($this->content->ad_headline)."' /></a>";
						break;
				}
			}
			if (($image_found == 0)&&($conf->nb_images >  0))
			{
				echo '<img src="'.ADSMANAGER_NOPIC_IMG.'" alt="nopic" />'; 
			}
			?>
		</div>
    <div class="adsmanager_ads_body" >
			
		
			
			<div class="adsmanager_ads_contact"  style="display:none;">
			<?php $strtitle = "";if (@$this->positions[4]->title) {$strtitle = JText::_($this->positions[4]->title);} ?>
			<?php echo "<h2>".@$strtitle."</h2>"; 
			if (($this->userid != 0)||($conf->show_contact == 0)) {		
				if (isset($this->fDisplay[5]))
				{		
					foreach($this->fDisplay[5] as $field)
					{	
						$c = $this->field->showFieldValue($this->content,$field); 
						if(($c !== "")&&($c !== null)) {
							$title = $this->field->showFieldTitle(@$this->content->catid,$field);
							if ($title != "")
								echo "<b>".htmlspecialchars($title)."</b>: ";
							echo "$c<br/>";
						}
					} 
				}
				if (($this->content->userid != 0)&&($conf->allow_contact_by_pms == 1))
				{
					echo TLink::getPMSLink($this->content);
				}
			}
			else
			{
				echo JText::_('ADSMANAGER_CONTACT_NOT_LOGGED');
			}
			?>
			</div>
	    </div>
		<div class="adsmanager_spacer"></div>
	</div>
</div>


<div class="<?php echo $classcontent;?> addetails" style="font-size:15px;">	
  <h1 style="font-size:14pt !important;">	
		<?php 
		if (isset($this->fDisplay[1]))
		{
			foreach($this->fDisplay[1] as $field)
			{
				$c = $this->field->showFieldValue($this->content,$field); 
				if (($c !== "")&&($c !== null)) {
					$title = $this->field->showFieldTitle(@$this->content->catid,$field);
					if ($title != "")
                      echo "</br><b>".htmlspecialchars($title)."</b>: ";
					echo "$c ";
				}
			}
			
			echo'<div style="background-color:transparent; height:20px; width:100%;"></div>';
			
			
			
			
			/*foreach($this->fDisplay[1] as $field)
			{
			    $c = $this->field->showFieldValue($this->content,$field); 
				
					$title = $this->field->showFieldTitle(@$this->content->catid,$field);
					
                      echo "</br><b>".htmlspecialchars($title)."</b>: ";
					echo "$c ";
				
			}*/
			
			
		} ?>
  </h1>
	
	
<div class="adsmanager_ads_desc" style="display:none;">
			<?php $strtitle = "";if (@$this->positions[2]->title) {$strtitle = JText::_($this->positions[2]->title);} ?>
			<?php echo "<h2>".@$strtitle."</h2>"; 
			if (isset($this->fDisplay[3]))
			{	
				foreach($this->fDisplay[3] as $field)
				{
					$c = $this->field->showFieldValue($this->content,$field); 
					if (($c !== "")&&($c !== null)) {
						$title = $this->field->showFieldTitle(@$this->content->catid,$field);
						if ($title != "")
							echo "<b>".htmlspecialchars($title)."</b>: ";
						echo "$c<br/>";
					}
				}
			} ?>
	</div>	
	
<div class="adsmanager_ads_desc" style="display:none;">
			<?php $strtitle = "";if (@$this->positions[5]->title) {$strtitle = JText::_($this->positions[5]->title);} ?>
			<?php echo "<h2>".@$strtitle."</h2>"; 
			if (isset($this->fDisplay[6]))
			{	
				foreach($this->fDisplay[6] as $field)
				{
					$c = $this->field->showFieldValue($this->content,$field); 
					if (($c !== "")&&($c !== null)) {
						$title = $this->field->showFieldTitle(@$this->content->catid,$field);
						if ($title != "")
							echo "<b>".htmlspecialchars($title)."</b>: ";
						echo "$c<br/>";
					}
				}
			} ?>
			</div>	
	
<?php


?>	

	
	
	<div class="adsmanager_ads_price" style="background-color:transparent;">
			<?php $strtitle = "";if (@$this->positions[1]->title) {$strtitle = JText::_($this->positions[1]->title);} ?>
			<?php echo "<b>".@$strtitle."</b>"; 
			if (isset($this->fDisplay[2]))
			{
			
			$diagnostic=0;
			$zamena_rashodnyh=0;
			$zamena_komplectyushih=0;
			
				foreach($this->fDisplay[2] as $field)
				{
					$c = $this->field->showFieldValue($this->content,$field); 
					if (($c !== "")&&($c !== null)) {
						$title = $this->field->showFieldTitle(@$this->content->catid,$field);
						if ($title != ""){
						
						if( (strpos(htmlspecialchars($title), "Диагностика:")!==false)&&($diagnostic==0) ){
						
						$title=str_replace("Диагностика:", "", $title);
						$title=trim($title);
						echo'<h1 style="font-size:14pt; "><b>Диагностика:</b></h1>';
						$diagnostic++;
						}
						$title=str_replace("Диагностика:", "", $title);
						

						
						if( (strpos(htmlspecialchars($title), "Замена расходных материалов:")!==false)&&($zamena_rashodnyh==0) ){
						
						$title=str_replace("Замена расходных материалов:", "", $title);
						$title=trim($title);
						echo'<h1 style="font-size:14pt; "><b>Замена расходных материалов:</b></h1>';
						$zamena_rashodnyh++;
						}
						$title=str_replace("Замена расходных материалов:", "", $title);
						
						

						if( (strpos(htmlspecialchars($title), "Замена комплектующих:")!==false)&&($zamena_komplectyushih==0) ){
						
						$title=str_replace("Замена комплектующих:", "", $title);
						$title=trim($title);
						echo'<h1 style="font-size:14pt; "><b>Замена комплектующих:</b></h1>';
						$zamena_komplectyushih++;
						}
						$title=str_replace("Замена комплектующих:", "", $title);
					


	
						
						echo "<b>".htmlspecialchars($title)."</b>: ";
						}	
						echo "$c<br/>";
						$title=htmlspecialchars($title);
						$MAS_EVENTS_1[$title]=htmlspecialchars($c);
						
					}
				}
			}
			?>
			</div>	
	




	
<?php	

$db = JFactory::getDbo();
$query_events_1 = $db->getQuery(true);

$query_events_1->select(array('id', 'parent', 'name', 'created', 'start', 'end', 'description', 'owner'));
$query_events_1->from('#__rseventspro_events');
$query_events_1->where('owner LIKE \''.$this->content->userid.'\'');

$db->setQuery($query_events_1);

$results = $db->loadObjectList();

echo"</br><h1>События:</h1></br>";

foreach($results as $element_1) {
 
 
 
$pos=strpos($element_1->name, $tmp_model_2 );

if ($pos === false) {
    
} else {
    

 
 
 
 echo"<strong>Событие:</strong> ".$element_1->name."</br>";
 echo"<strong>Дата:</strong> ".$element_1->created."</br>";
 echo"<strong>Описание:</strong> ".$element_1->description."</br>";
 
  //  echo "".$element_1->id." = ".." = ".$element_1->created." = ".$element_1->start." = ".$element_1->description."=".$element_1->owner."</br>";


echo'<div style="width:100%; height:2px; background-color:black; margin-top:5px; margin-bottom:5px;"></div>';
 

}




}


echo"</br></br>";

?>
	

	
</br><h1>Необходимо произвести:</h1>	
	
<?php

//$MAS_EVENTS_1[htmlspecialchars($title)]=htmlspecialchars($c);

$tmp_3=0;

foreach($MAS_EVENTS_1 as $key => $el){


$text_1=$key;//событие (диагностика двигателя)
$text_1=str_replace("Диагностика:","",$text_1);
$text_1=str_replace("Замена расходных материалов:","",$text_1);
$text_1=str_replace("Замена комплектующих:","",$text_1);
$text_1=str_replace("Как часто проводится","",$text_1);
$text_1=trim($text_1);

//echo" text_1 ".$text_1."</br>";

$text_2=$el;//периодичность события (раз в месяц)

switch($text_2){

case "Раз в месяц":
{$text_2=30; break;}

case "Раз в 3 месяца":
{$text_2=90; break;}

case "Раз в 6 месяцев":
{$text_2=180; break;}

case "Раз в год":
{$text_2=360; break;}

case "Раз в 2 года":
{$text_2=720; break;}

}

$current_date_1=mktime(0, 0, 0, date("m")  , date("d"), date("Y"));

$current_date_1_days=$current_date_1/60/60/24;
$current_date_1_days=floor($current_date_1_days);

//$current_date_2=date("l", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));



$db2 = JFactory::getDbo();
$query_events_1 = $db->getQuery(true);

$query_events_1->select(array('id', 'parent', 'name', 'created', 'start', 'end', 'description', 'owner'));
$query_events_1->from('#__rseventspro_events');
$query_events_1->where('owner LIKE \''.$this->content->userid.'\' ');

//echo $tmp_model_2."<br>";
//echo $text_1."<br>";

$tmp_model_text_1=$tmp_model_2." : ".$text_1;

//echo"<br>".$tmp_model_text_1."<br>";

$tmp_model_text_1=trim($tmp_model_text_1);

$query_events_1->where('name LIKE \''.$tmp_model_text_1.'\' ');


$query_events_1->order('created DESC');


$db->setQuery($query_events_1);

$results = $db->loadObjectList();


$i_tmp_1=0;

foreach($results as $element_1) {


  
 //echo"<strong>Событие:</strong> ".$element_1->name."</br>";
 //echo"<strong>Дата:</strong> ".$element_1->created."</br>";
$text_1=strtolower($text_1);
$element_1->name=strtolower($element_1->name);
 
$text_1=mb_strtolower($text_1);
$element_1->name=mb_strtolower($element_1->name);
 

$text_1_1=$tmp_model_2." : ".$text_1;
$text_1_1=strtolower($text_1_1);
$text_1_1=mb_strtolower($text_1_1);


//echo "<br> element_1->name = ".$element_1->name."";
//echo "<br> text_1_1 = ".$text_1_1."<br>"; 
 
 
 //echo" ".$text_1." = ".$element_1->name."</br>";
if($text_1_1==$element_1->name){ 
//echo"<br>==".$text_1_1." == ".$element_1->name."<br>";
//разница между $current_date_1 и $element_1->created в днях
//если она больше $text_2, то вывести сообщение


$element_1->created=substr($element_1->created, 0, 10);

$MAS_element=explode("-",$element_1->created);


$element_1->created=mktime(0, 0, 0, $MAS_element[1], $MAS_element[2], $MAS_element[0]);


$element_1->created=($element_1->created)/60/60/24;

$element_1->created=floor($element_1->created);

if( ($current_date_1_days - $element_1->created)>$text_2){

echo" - ".$text_1."</br>"; $tmp_3++;

}



$i_tmp_1++;
  }

//echo"".$element_1->created."</br>"; 
//echo"".$current_date_1_days."</br>"; 
break;


}


if($i_tmp_1==0){ echo" - ".$text_1."</br>"; $tmp_3++; };





  //echo " " . $text_1 . " " . $text_2 ."  ";
 // echo "<br><br>";
  
  
  
  
}
 
if($tmp_3==0){ echo"Напоминаний нет.</br></br>"; }; 
 

?>	
	
	
	
	
	
	
	
</br>	
		
<!--<span>События:</span></br>	-->	
<!--frame-->	
<!--	
<div style="width:100%; height:520px">
 <iframe src="/sobytiya-frejm/?user=<?php   echo $this->content->userid; ?>" width="100%" height="500px;"  align="left">
    Ваш браузер не поддерживает плавающие фреймы!
 </iframe>
</div>
-->
<!--frame-->		
		
		<?php //echo $this->content->event->onContentAfterTitle; ?>
		<div>
		<?php 
		if ($this->content->userid != 0)
		{
			//echo JText::_('ADSMANAGER_SHOW_OTHERS'); 
			/*$target = TLink::getUserAdsLink($this->content->userid);
			
		    if ($conf->display_fullname == 1)
				echo "<a href='$target' ><b>".$this->content->fullname."</b></a>";
			else
				echo "<a href='$target' style=\"background-color:transparent;\"><b>".$this->content->user."</b></a>";
				*/
			
			if ($this->userid == $this->content->userid)	{
			?>
			<div>
			<?php
				$target = TRoute::_("index.php?option=com_adsmanager&task=write&catid=".$this->content->category."&id=".$this->content->id);
				echo "<a href='".$target."'>".JText::_('ADSMANAGER_CONTENT_EDIT')."</a>";
				echo "&nbsp;";
				$target = TRoute::_("index.php?option=com_adsmanager&task=delete&catid=".$this->content->category."&id=".$this->content->id);
				echo "<a href='".$target."'>".JText::_('ADSMANAGER_CONTENT_DELETE')."</a>";
			?>
			</div>
			<?php
			}
		}
		?>
		</div>
		<div class="addetails_topright">
		<?php $strtitle = "";if (@$this->positions[3]->title) {$strtitle = JText::_($this->positions[3]->title); } ?>
			<?php if (@$strtitle != "") echo "<h2>".@$strtitle."</h2>"; 
			if (isset($this->fDisplay[4]))
			{
				foreach($this->fDisplay[4] as $field)
				{
					$c = $this->field->showFieldValue($this->content,$field); 
					if (($c !== "")&&($c !== null)) {
						$title = $this->field->showFieldTitle(@$this->content->catid,$field);
						if ($title != "")
							echo "<b>".htmlspecialchars($title)."</b>: ";
						echo "$c<br/>";
					}
				} 
			}?>
		</div>
 <?php echo $this->content->event->onContentAfterDisplay; ?>
<div class="back_button">
<a href='javascript:history.go(-1)'>
<?php echo JText::_('ADSMANAGER_BACK_TEXT'); ?>
</a>
</div>