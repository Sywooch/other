<?php
// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

$conf= $this->conf;

$document	= JFactory::getDocument();
if ($conf->metadata_mode != 'nometadata') {
	$document->setMetaData("description", $this->content->metadata_description);
	$document->setMetaData("keywords", $this->content->metadata_keywords);
}
?>
<?php if ($conf->display_inner_pathway == 1) { ?>
<div class="adsmanager_pathway">
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
<div class="<?php echo $classcontent;?> addetails">	
		<h1>	
		<?php 
		if (isset($this->fDisplay[1]))
		{
			foreach($this->fDisplay[1] as $field)
			{
				$c = $this->field->showFieldValue($this->content,$field); 
				if ($c != "") {
					$title = $this->field->showFieldTitle(@$this->content->catid,$field);
					if ($title != "")
						echo htmlspecialchars($title).": ";
					echo "$c ";
				}
			}
		} ?>
		</h1>
		<?php echo $this->content->event->onContentAfterTitle; ?>
		<div>
		<?php 
		if ($this->content->userid != 0)
		{
		//	echo JText::_('ADSMANAGER_SHOW_OTHERS'); 
			if ($conf->comprofiler == 3) {
					   		$target = TRoute::_("index.php?option=com_community&view=profile&userid=".$this->content->userid);
			}
			else if (COMMUNITY_BUILDER_ADSTAB == 1)
		    {
				$target = TRoute::_("index.php?option=com_comprofiler&task=userProfile&tab=AdsManagerTab&user=".$this->content->userid);
			}
		    else
		    {
				$target = TRoute::_("index.php?option=com_adsmanager&view=list&user=".$this->content->userid);
		    }
		    
		    if ($conf->display_fullname == 1)
				echo "";
			else
				echo "";
			
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
					if ($c != "") {
						$title = $this->field->showFieldTitle(@$this->content->catid,$field);
						if ($title != "")
							echo htmlspecialchars($title).": ";
						echo "$c<br/>";
					}
				} 
			}?>
		</div>
	<div class="addetailsmain">
		<div class="adsmanager_ads_body">
			<div class="adsmanager_ads_desc">
			<?php $strtitle = "";if (@$this->positions[2]->title) {$strtitle = JText::_($this->positions[2]->title);} ?>
			<?php echo "<h2>".@$strtitle."</h2>"; 
			if (isset($this->fDisplay[3]))
			{	
				foreach($this->fDisplay[3] as $field)
				{
					$c = $this->field->showFieldValue($this->content,$field); 
					if ($c != "") {
						$title = $this->field->showFieldTitle(@$this->content->catid,$field);
						if ($title != "")
							echo htmlspecialchars($title).": ";
						echo "$c<br/>";
					    
					}
				}
			}
?>
			</div>
			<div class="adsmanager_ads_price">
			<?php $strtitle = "";if (@$this->positions[1]->title) {$strtitle = JText::_($this->positions[1]->title);} ?>
			<?php echo "<b>".@$strtitle."</b>"; 
			if (isset($this->fDisplay[2]))
			{
				foreach($this->fDisplay[2] as $field)
				{
					$c = $this->field->showFieldValue($this->content,$field); 
					if ($c != "") {
						$title = $this->field->showFieldTitle(@$this->content->catid,$field);
						if ($title != "")
							echo htmlspecialchars($title).": ";
						echo "$c<br/>";
					}
				}
			}
			?>
			</div>
			<div class="adsmanager_ads_desc" style="background-color:transparent;">
			<?php
			$model_tmp1="";
			$year_tmp1="";
			?>			
			
			
			
			
			<?php $strtitle = "";if (@$this->positions[5]->title) {$strtitle = JText::_($this->positions[5]->title);} ?>
			<?php echo "<h2>".@$strtitle."</h2>"; 
			if (isset($this->fDisplay[6]))
			{	
				foreach($this->fDisplay[6] as $field)
				{
					$c = $this->field->showFieldValue($this->content,$field); 
					if ($c != "") {
						$title = $this->field->showFieldTitle(@$this->content->catid,$field);
						if ($title != "")
							echo htmlspecialchars($title).": ";
						echo "$c<br/>";
						
											
						if($title=="Марка"){ $model_tmp1 = $c;  };
						if($title=="Год выпуска"){$year_tmp1 = $c; };
					}
				}
			} ?>
			</div>
			<div class="adsmanager_ads_contact" style="background-color:transparent;">
			<?php $strtitle = "";if (@$this->positions[4]->title) {$strtitle = JText::_($this->positions[4]->title);} ?>
			<?php echo "<h2>".@$strtitle."</h2>"; 
			if (($this->userid != 0)||($conf->show_contact == 0)) {		
				if (isset($this->fDisplay[5]))
				{		
					foreach($this->fDisplay[5] as $field)
					{	
						$c = $this->field->showFieldValue($this->content,$field); 
						if ($c != "") {
							$title = $this->field->showFieldTitle(@$this->content->catid,$field);
							if ($title != "")
								echo htmlspecialchars($title).": ";
							echo "$c<br/>";
						}
					} 
				}
				if (($this->content->userid != 0)&&($conf->allow_contact_by_pms == 1))
				{
					if ($conf->display_fullname == 1)
						$pmsText= sprintf(JText::_('ADSMANAGER_PMS_FORM'),$this->content->fullname);
					else
						$pmsText= sprintf(JText::_('ADSMANAGER_PMS_FORM'),$this->content->user);
					$pmsForm = TRoute::_("index.php?option=com_uddeim&task=new&recip=".$this->content->userid);
					echo '<a href="'.$pmsForm.'">'.$pmsText.'</a><br />';
				}
			}
			else
			{
				echo JText::_('ADSMANAGER_CONTACT_NOT_LOGGED');
			}
			?>
			
			
			<?php
			
			//$this->content->userid  - идентификатор пользователя, разместившего объявление
			
//echo $this->content->userid;
$social_user="";

		$db = JFactory::getDbo();	
$query_user = $db->getQuery(true);

$query_user->select(array('username'));
$query_user->from('#__users');
$query_user->where('id LIKE \''.($this->content->userid).'\'');

$db->setQuery($query_user);

$resultsuser = $db->loadObjectList();

foreach($resultsuser as $element_user) {

$social_user=$element_user->username;

break;	

}


//echo $social_user;



require ''.JPATH_ROOT.'/config_db_social/config.php';

$dbh=mysql_connect(DB_SERVER_S,DB_USER_S,DB_PASS_S) or die ("Невозможно соединиться с сервером.");

mysql_select_db(DB_BASE_S) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
			
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");

//$model_tmp1;
//$year_tmp1





		
$query_ra="SELECT * FROM avto_users WHERE username='".($social_user)."'";

$res_ra=mysql_query($query_ra);
					if($res_ra==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

while($row_ra=mysql_fetch_array($res_ra)){			
	
$social_user_id=$row_ra['id'];


}

//echo $social_user_id;



$query_history="SELECT * FROM avto_easyblog_post WHERE created_by='".($social_user_id)."'";

$res_history=mysql_query($query_history);
					if($res_history==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
$history_permalink="";
while($row_history=mysql_fetch_array($res_history)){			

$pos = strpos($row_history['title'], $model_tmp1);
if ($pos === false) {

}else{

$history_permalink=$row_history['permalink'];

}	
	
}


if(($history_permalink=="")||($history_permalink==NULL)){    }else{
//ссылка на историю автомобиля
echo'<br><a href="/social/istorii-avtomobilej-polzovatelej/entry/'.$history_permalink.'"><b>История автомобиля</b></a><br>';
}



$query_service="SELECT * FROM avto_adsmanager_ads WHERE userid='".($social_user_id)."'";

$res_service=mysql_query($query_service);
					if($res_service==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
$service_permalink="";				
while($row_service=mysql_fetch_array($res_service)){					

$pos = strpos($row_service['ad_model'], $model_tmp1);
if ($pos === false) {

}else{

$service_permalink=$row_service['id'];

}


}



if(($service_permalink=="")||($service_permalink==NULL)){    }else{
 echo'<a href="/social/servisnye-knizhki/9-servisnye-knizhki/'.$service_permalink.'-"><b>Сервисная книжка автомобиля</b></a>
';
}
		
			?>
			
			
			</div>
	    </div>
		<div class="adsmanager_ads_image">
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
				echo '<img align="center" src="'.ADSMANAGER_NOPIC_IMG.'" alt="nopic" />'; 
			}
			?>
		</div>
		<div class="adsmanager_spacer"></div>
	</div>
</div>
<?php echo $this->content->event->onContentAfterDisplay; ?>
<div class="back_button">
<a class="button" href='javascript:history.go(-1)'>
<?php echo JText::_('ADSMANAGER_BACK_TEXT'); ?>
</a>
</div>