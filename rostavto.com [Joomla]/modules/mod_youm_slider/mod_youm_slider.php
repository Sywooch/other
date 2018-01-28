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
require_once (dirname(__FILE__).DS.'helper.php');
$module_template 			= $params->get('module_template','Default');
		$get_items             		= $params->get   ('get_items',1);
		$nitems                		= $params->get   ('nitems',4);
		$chars                 		= $params->get   ('chars',40);
		$chars_nav             		= $params->get   ('chars_nav',40);
		$ordering              		= $params->get   ('ordering',3);// 1 = ordering | 2 = popular | 3 = random 
		$getspecific 	         	= $params->get ('getspecific');
		$allow_tags					= $params->get ('allow_tags');
		
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

		if($playlist_align == 'right'){
			$infoContainerPosition = 'left';
			$ie_image = '_r';
			$sclass= '_right';
		}else{
			$infoContainerPosition = 'right';
			$ie_image = '';
			$sclass= '_left';
		}
		$imagedi_width = $playlist_width /5;
		if ($show_thumb ==1){
			$desc_width = $playlist_width - $thumb_width - 20 ;
		}else{
			$desc_width = $playlist_width - 10 ;
		}
$youmslides = modYMNSHelper::getYMNSItems($params);
require(JModuleHelper::getLayoutPath('mod_youm_slider',''.$module_template.'/default'));
$assets_random = @Module_Youmomentumsliderv20_J17_generate_key();
?>