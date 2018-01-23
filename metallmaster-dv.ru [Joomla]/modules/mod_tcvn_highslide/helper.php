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

require_once JPATH_SITE . DS . 'components' . DS . 'com_content' . DS . 'helpers' . DS . 'route.php';

if(!defined('PhpThumbFactoryLoaded')) {
	require_once dirname(__FILE__) . DS . 'libs' . DS . 'phpthumb' . DS . 'ThumbLib.inc.php';
	define('PhpThumbFactoryLoaded',1);
}
if(!class_exists("TCVNDataSourceBase")) {
	require_once dirname(__FILE__) . DS . "libs" . DS . "source" . DS . "source_base.php";
}

abstract class modTCVNHighSlideHelper 
{
	/**
	 * get list articles
	 */
	public static function getList($params, $moduleName)
	{
		if($params->get('enable_cache','0')) { 
			$cache =& JFactory::getCache($moduleName);
			$cache->setCaching(true);
			$cache->setLifeTime($params->get('cache_time', 15 ) * 60);	
			return $cache->get(array('modTCVNHighSlideHelper', 'getGroupObject'), array($params)); 
		} 
		else {
			return self::getListBySourceName($params, $moduleName);
		}	
	}
	
	/**
  	 * Get list of articles follow conditions user selected
     * 
     * @param JParameter $params
     * @return array containing list of article
     */ 
	 
	public static function getListBySourceName(&$params, $moduleName) 
	{
	 	// create thumbnail folder 	
	 	$tmppath 	= JPATH_SITE . DS . 'cache';
		$moduleName = 'tcvnthumbs' ;
	 	$thumbPath 	= $tmppath . DS. $moduleName . DS;
		
		if(!file_exists($tmppath)) {
			JFolder::create($tmppath, 0777);
		}
		 
		if(!file_exists($thumbPath)) {
			JFolder::create($thumbPath, 0777);
		}
		
		// get call object to process getting source
		$source = $params->get('data_source', 'content');
		$path 	= dirname(__FILE__) . DS . "libs" . DS . "source" . DS . $source . DS . "source.php";
	
		if(!file_exists($path)) {
			return array();	
		}
		
		require_once $path;
		$objectName = "TCVN" . ucfirst($source) . "HLDataSource";
	 	$object 	= new $objectName();
	 	$items		= $object->setThumbPathInfo($thumbPath, JURI::base()."cache/".$moduleName."/" )
					->setImagesRendered(array('thumbnail' => array((int)$params->get('thumbnail_width', 60), (int)$params->get( 'thumbnail_height', 60 ))) )
					->getList($params);
					
  		return $items;
	}
         
	/**
	 * load css - javascript file.
	 * 
	 * @param JParameter $params;
	 * @param JModule $module
	 * @return void.
	 */
	public static function loadMediaFiles($params, $module, $theme='')
	{
		$mainframe 	= JFactory::getApplication();
		$template 	= self::getTemplate();
		$document 	= &JFactory::getDocument();
		$url_base 	= JURI::base() . 'modules/' . $module->module . '/assets/';
		
		//load style of module
		if(file_exists(JPATH_BASE . DS . 'templates/' . $template . '/css/' . $module->module . '.css')) {
			JHTML::stylesheet('templates/' . $template . '/css/' . $module->module . '.css');		
		}
		
		// load style of theme follow the setting
		if($theme && $theme != -1) {
			$tPath = JPATH_BASE . DS . 'templates' . DS . $template . DS . 'css' . DS . $module->module . '_' . $theme . '.css';
			
			if(file_exists($tPath)) {
				JHTML::stylesheet('templates/' . $template . '/css/' . $module->module . '_' . $theme . '.css');
			}
			else {
				JHTML::stylesheet('modules/' . $module->module . '/tmpl/' . $theme . '/assets/style.css');
				$document->addStyleSheet(JURI::base() . 'modules/' . $module->module . '/tmpl/' . $theme . '/assets/style.css');
			}
		}
		else {
			$document->addStyleSheet($url_base . 'style.css');
		}
		
		if($params->get('showClose') == "1")
			$document->addStyleSheet($url_base.'css/showClose.css');
		else 
			$document->addStyleSheet($url_base.'css/hideClose.css');
			
		if($params->get('showMove') == "1")
			$document->addStyleSheet($url_base.'css/showMove.css');
		else
			$document->addStyleSheet($url_base.'css/hideMove.css');
			
		if($params->get('control_type') == "icon")
			$document->addStyleSheet($url_base.'css/iconControl.css');
			
		$easing  = $params->get("easing", "easeInQuad");
		$easings = explode("_", $easing);
		
		if(count($easings) == 2) {
			$easing1 = $easings[0];
			$easing2 = $easings[1];
			$easing  = "hs.easing='" . $easing1 . "';";
			
			if($easing2 == "fadeInOut"){
				$easing.= "hs.fadeInOut=true;";
			}
			else{
				$easing.= " hs.easingClose='".$easing2."';";
			}
		}
		else{
			$easing = "hs.easing='".$easing."';";
		}
		
		$document->addStyleSheet($url_base . 'css/highslide-styles.css');
		$document->addStyleSheet($url_base . 'css/highslide.css');
		$document->addScript($url_base . "js/highslide-full.js");
		$document->addScript($url_base . "js/highslide.config.js");
		$document->addScript($url_base . "js/more_functions.js");
		$document->addScript($url_base . "js/swfobject.js");
		$document->addScriptDeclaration($easing."hs.graphicsDir = '".$url_base."graphics/'; hs.showCredits = false; hs.align = '".$params->get('popup_position',"")."'; hs.dimmingOpacity =". (float)trim($params->get('dimming_opacity'))."; ");
		
		
		
		if($params->get('outline_type') =="" )	$document->addScriptDeclaration(" hs.outlineType = '';");
		elseif($params->get('outline_type') == "outer-glow")	$document->addScriptDeclaration("hs.outlineType = 'outer-glow';");
		elseif($params->get('outline_type') == "rounded-white")	$document->addScriptDeclaration("hs.outlineType = 'rounded-white';");
		elseif($params->get('outline_type') == "drop-shadow")	$document->addScriptDeclaration("hs.outlineType = 'drop-shadow';");
		elseif($params->get('outline_type') == "beveled")		$document->addScriptDeclaration("hs.outlineType = 'beveled';");
		elseif($params->get('outline_type') == "glossy-dark")	$document->addScriptDeclaration("hs.outlineType = 'glossy-dark';");
		elseif($params->get('outline_type') == "rounded-black")	$document->addScriptDeclaration("hs.outlineType = 'rounded-black';"); 
	}
	
	/**
	 * get name of current template
	 */
	public static function getTemplate()
	{
		$mainframe = JFactory::getApplication();
		return $mainframe->getTemplate();
	}
	
	/**
	 * Get Layout of the item, if found the overriding layout in the current template, the module will use this file
	 * 
	 * @param string $moduleName is the module's name;
	 * @params string $theme is name of theme choosed
	 * @params string $itemLayoutName is name of item layout.
	 * @return string is full path of the layout
	 */
	public static function getItemLayoutPath($moduleName, $theme ='', $itemLayoutName='_item')
	{
		$layout = trim($theme)?trim($theme) . DS . '_item' . DS . $itemLayoutName : '_item' . DS . $itemLayoutName;	
		$path 	= JModuleHelper::getLayoutPath($moduleName, $layout);	
		
		if(trim($theme) && !file_exists($path)) {
			// if could not found any item layout in the theme folder, so the module will use the default layout.
			return JModuleHelper::getLayoutPath($moduleName, '_item' . DS . $itemLayoutName);
		}
		
		return $path;
	}
	
	public static function getHighSlideAttr($captionId, $slideshowGroup, $item, $params, $overrideAttr="")
	{
		static $status = "";
		
		$item->filetype = isset($item->filetype) ? $item->filetype : "";
		
		if($item->filetype == "youtube") {
				$highslide = "hs.htmlExpand(this,{".$overrideAttr.",objectType: 'iframe', allowSizeReduction: false, wrapperClassName: 'draggable-header no-footer', preserveContent: false, objectLoadTime: 'after',captionId:'".$captionId."', slideshowGroup:'".$slideshowGroup. "'})";
		}
		elseif($item->filetype == "flash") {
			$overrideAttr = '
							   maincontentId: '.$item->id.',	
							   objectType: \'swf\',
							   allowSizeReduction: false,
							   outlineType: \'rounded-white\',
							   swfOptions: { version: \'7\' },
							   wmode:\'transparent\',
							   preserveContent: true, 
							   objectWidth: '.(int)$params->get('popup_height', 200).', 
							   objectHeight: '.(int)$params->get('popup_width', 200).',
							   maincontentText: \''.JTEXT::_('You need to upgrade your flash player').'\', '.$overrideAttr.',captionId:\''.$captionId.'\', slideshowGroup:\''.$slideshowGroup. '\'';
			$highslide = "hs.htmlExpand(this,{".$overrideAttr."})";
			
			if(empty($status)) {
				echo  '
					<script type="text/javascript">
					function good(){
					hs.skin.contentWrapper =
				\'<div id="flash" class="highslide-header">  \'+
					\'<h1>This is a custom header</h1>\'+
					\'<a href="#" title="{hs.lang.closeTitle}" \'+
							\'onclick="return hs.close(this)">\'+
						\'<span>More</span></a>\'+
				\'</div>\'+
				\'<div class="highslide-body"></div>\'+
				\'<div class="highslide-footer"><div>\'+
					\'<b>This is a custom footer</b>\'+
				\'</div></div>\' }</script>';
				$status = "checked";
			}
		}
		elseif($item->filetype == "ajax") {
			$highslide = "hs.htmlExpand(this,{objectType: 'ajax',contentId:'".$captionId."', slideshowGroup:'".$slideshowGroup. "'})";
		}
		elseif($item->filetype == "iframe") {
			$highslide = "hs.htmlExpand(this,{".$overrideAttr.",objectType: 'iframe',captionId:'".$captionId."', slideshowGroup:'".$slideshowGroup. "'})";
		}
		elseif($item->filetype == "html") {
			$highslide = "hs.htmlExpand(this,{".$overrideAttr.",headingText: '".$item->subtitle."',contentId:'".$captionId."', slideshowGroup:'".$slideshowGroup. "'})";
		}
		else {
			$highslide = "hs.expand(this,{".$overrideAttr.",captionId:'".$captionId."', slideshowGroup:'".$slideshowGroup."'})";
		}
		
		return $highslide;
	}
}