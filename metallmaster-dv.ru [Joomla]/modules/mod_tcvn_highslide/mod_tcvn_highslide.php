<?php 
/*
# ------------------------------------------------------------------------
# TCVN Highslide Module for Joomla 2.5
# ------------------------------------------------------------------------
# Copyright(C) 2008-2012 www.Thecoders.vn. All Rights Reserved.
# @license http://www.gnu.org/licenseses/gpl-3.0.html GNU/GPL
# Author: Thecoders.vn
# Websites: http://Thecoders.com
# ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die;
 
// Include the syndicate functions only once
require_once dirname(__FILE__) . DS . 'helper.php';

$list 			= modTCVNHighSlideHelper::getList($params, $module->module); 
$tmp 			= $params->get('module_height', 'auto' );
$moduleHeight   = ($tmp=='auto') ? 'auto' : (int)$tmp.'px';
$tmp 			= $params->get('module_width', 'auto' );
$moduleWidth    = ($tmp=='auto') ? 'auto': (int)$tmp . 'px';
$thumbWidth    	= (int)$params->get('thumbnail_width', 48);
$thumbHeight   	= (int)$params->get('thumbnail_height', 74);
$popupHeight 	= (int)$params->get('popup_height', 200);
$popupWidth 	= (int)$params->get('popup_width', 200);

$outline_type 		= $params->get('outline_type', '');
$control_type 		= $params->get('control_type', 'text');
$showMove 			= $params->get('showMove', '1');
$showClose 			= $params->get('showClose', '1');
$popup_position 	= $params->get('popup_position', 'center');
$dimming_opacity	= $params->get('dimming_opacity', '0.5');
$interval 			= $params->get('interval', 1000);
$repeat 			= $params->get('repeat', 1);
$class 				= $params->get('class', "");
$captionText 		= $params->get('captionText', "");
$centr_content 		= $params->get('centr-content', "");
$item_layout 		= $params->get('item_layout', "slideshow-caption");
$auto_renderthumb 	= $params->get("auto_renderthumb", 1);

$widthHeight = "";
if(!$auto_renderthumb){
	$widthHeight = ' width="'.$thumbWidth.'px" height="'.$thumbHeight.'px"';
}

$overrideAttr 		= "";
$overrideAttr 		.= "height:".$popupWidth.",width:".$popupHeight.",outlineType: '".$outline_type."',align:'".$popup_position."',dimmingOpacity:".$dimming_opacity.",numberPosition:'heading',display:'',transitions:['expand', 'crossfade'],wrapperClassName:'".$class."'";
$theme		    	=  $params->get('theme', 'default'); 

modTCVNHighSlideHelper::loadMediaFiles($params, $module, $theme);

$itemLayoutPath = modTCVNHighSlideHelper::getItemLayoutPath($module->module, $theme, $item_layout);

if(!empty($theme)) {
	$layout = trim($theme) . DS . 'default';
	require(JModuleHelper::getLayoutPath($module->module, $layout));
} 
else {
	require(JModuleHelper::getLayoutPath($module->module));
}
// split pages following the max items display on each page.