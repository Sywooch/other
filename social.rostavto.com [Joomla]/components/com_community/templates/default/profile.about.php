<?php
/**
* @copyright (C) 2013 iJoomla, Inc. - All rights reserved.
* @license GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
* @author iJoomla.com <webmaster@ijoomla.com>
* @url https://www.jomsocial.com/license-agreement
* The PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0
* More info at https://www.jomsocial.com/license-agreement
*/
defined('_JEXEC') or die();
$noData = true;
?>
<div class="cModule cProfile-About app-box" style="background-color:transparent;">
	<h3 class="app-box-header cResetH"><?php echo JText::_('COM_COMMUNITY_ABOUT_ME');?></h3>

	<div class="app-box-content" style="background-color:transparent;">
	<?php

		foreach( $profile['fields'] as $groupName => $items )
		{
			// Gather display data for the group. If there is no data, we can
			// later completely hide the whole segment
			$hasData = false;
			ob_start();
			?>
			<div class="cField">

				<?php if( $groupName != 'ungrouped' ){ ?>
					<h3 class="cField-Title cResetH"><?php echo JText::_( $groupName ); ?></h3>
				<?php } ?>

				<ul class="cField-List cResetList">
					<?php foreach( $items as $item ) { ?>
						<?php
						if( CPrivacy::isAccessAllowed( $my->id , $profile['id'] , 'custom' , $item['access'] ) )
						{
							// There is some displayable data here
							$hasData = $hasData || CProfileLibrary::getFieldData( $item ) != '';
						?>

							<?php
							$fieldData = CProfileLibrary::getFieldData( $item );

							// Escape unless it is URL type, since URL type is in HTML format
							if($item['type'] != 'url' && $item['type'] != 'email' && $item['type']!='list') {
								$fieldData = $this->escape($fieldData);
							}

							// If textarea, we need to support multiline entry
							if($item['type'] == 'textarea')
							{
								$fieldData =  nl2br($fieldData);
							}

							if(!empty($fieldData) ){ ?>
							<li>
								<h3 class="cField-Name cResetH" style="background-color:transparent;"><?php echo JText::_( $item['name'] );   
								; ?></h3>
								<?php if( !empty($item['searchLink']) && is_array($item['searchLink']) ){ ?>
									<div class="cField-Content" style="background-color:transparent;">
										<?php
												foreach($item['searchLink'] as $linkKey=>$linkValue)
												{
													$item['value'] = $linkKey;
													if($item['type']=='checkbox'){
														echo '<a href="'.$linkValue.'">'.$item['value'].'</a><br />';	
													}else{
														echo '<a href="'.$linkValue.'">'.$fieldData.'</a><br />';
													}
													
												}
										?>
									</div>
								<?php } else { ?>
										<div class="cField-Content" style="background-color:transparent;">
											<?php
if($item['id']=="17"){   

//echo $fieldData;  

$MAS_f=explode("<br />",$fieldData);

for($i = 0; $i < (count($MAS_f)-1);$i++){


//имя автомобиля
   echo $MAS_f[$i]; 
//имя автомобиля 


  
   $user = JFactory::getUser(); 



//echo $user->name;

//ссылка на историю автомобиля  
  $sr="История автомобиля ".$MAS_f[$i]." пользователя ".$user->name;
  
$tmp_history="";
 
$db = JFactory::getDbo();
$query_events_2 = $db->getQuery(true);

$query_events_2->select(array('id', 'permalink', 'title'));
$query_events_2->from('#__easyblog_post');
$query_events_2->where('title LIKE \''.$sr.'\'');

$db->setQuery($query_events_2);

$results2 = $db->loadObjectList();

foreach($results2 as $element_2) {
 
   echo ' <a href="/istorii-avtomobilej-polzovatelej/entry/'.$element_2->permalink.'">История автомобиля</a>';
$tmp_history=$element_2->permalink;
 
break;
   
}   

//ссылка на историю автомобиля


//ссылка на сервисную книжку автомобиля


 $model_tmp=$MAS_f[$i];

$tmp_service_book="";
 
//$db = JFactory::getDbo();
$query_events_h = $db->getQuery(true);

$query_events_h->select(array('id', 'userid', 'ad_model'));
$query_events_h->from('#__adsmanager_ads');
$query_events_h->where('userid LIKE \''.($user->id).'\'');
$query_events_h->where('ad_model LIKE \''.$model_tmp.'\'');

$db->setQuery($query_events_h);

$resultsh = $db->loadObjectList();

foreach($resultsh as $element_h) {
 
   echo ' <a href="/servisnye-knizhki/9-servisnye-knizhki/'.$element_h->id.'-">Сервисная книжка</a>';

 $tmp_service_book=$element_h->id;
   
break;   
   
   
}   


//ссылка на сервисную книжку автомобиля





//ссылка на события автомобиля
//$model_tmp

 
$db = JFactory::getDbo();
$query_events_4 = $db->getQuery(true);

$query_events_4->select(array('id', 'name'));
$query_events_4->from('#__rseventspro_events');



$conditions = array(
  'name LIKE \''.$model_tmp.'%\' ');

$query_events_4->where($conditions);


$db->setQuery($query_events_4);

$results4 = $db->loadObjectList();

foreach($results4 as $element_4) {
 
   echo ' <a href="/moi-sobytiya/?user='.$user->id.'&model='.$model_tmp.'">События автомобиля</a>';

 
   
}   



//ссылка на события автомобиля



echo' 
 <a href="http://rostavto.com/board/3-avtomobili-s-probegom/добавить объявление?user_social='.($user->username).'&model='.$MAS_f[$i].'&history='.($tmp_history).'&service_book='.($tmp_service_book).'" 
style="margin-left:10px;">Хочу продать!</a>';






   
   echo"<br>";
   
}









}
	
else{

echo (!empty($item['searchLink'])) ? '<a href="'.$item['searchLink'].'"> '.$fieldData."".' </a>': $fieldData."" ; 

}

 ?>
											
											
											
											
										</div>
								<?php } ?>
							</li>
							<?php
							}
						}
						?>
					<?php } ?>
				</ul>
			</div>
		<?php
		$html = ob_get_contents();
		ob_end_clean();

		// We would only display the profile data in the group if there is actually some
		// data to be displayed
		if( $hasData ){
			echo $html;
			$noData = false;
		}
	}

	if ($noData)
	{
		if ($isMine)
		{
		?>
		<div class="cEmpty">
			<?php echo JText::_('COM_COMMUNITY_PROFILES_SHARE_ABOUT_YOURSELF'); ?>
		</div>
		<?php
		}
		else
		{
		?>
		<div class="cEmpty">
			<?php echo JText::_('COM_COMMUNITY_PROFILES_NO_INFORMATION_SHARE'); ?>
		</div>
		<?php
		}
	}
?>
	</div>
	<div class="app-box-footer" style="background-color:transparent;">
		<?php if( $isMine ): ?>
		<a class="edit-this" href="<?php echo CRoute::_('index.php?option=com_community&view=profile&task=edit');?>" title="<?php echo JText::_('COM_COMMUNITY_PROFILE_EDIT'); ?>"><?php echo JText::_('COM_COMMUNITY_PROFILE_EDIT'); ?></a>
		<?php endif; ?>
	</div>
</div>


