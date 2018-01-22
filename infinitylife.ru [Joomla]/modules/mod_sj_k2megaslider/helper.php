<?php
/*------------------------------------------------------------------------
 # Sj K2 Mega Slider  - Version 1.1
 # Copyright (C) 2011 SmartAddons.Com. All Rights Reserved.
 # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Author: SmartAddons.Com
 # Websites: http://www.smartaddons.com/
 -------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );

if (! class_exists("modK2MegaSlider") ) { 
require_once (dirname(__FILE__) .DS. 'assets' .DS.'libsmegaslider.php');

class modK2MegaSlider {
	var $module_name = '';
	function process($params, $module) {
		
		$enable_cache 		=   $params->get('cache',1);
		$cachetime			=   $params->get('cache_time',0);
		$this->module_name = $module->module;
		
		if($enable_cache==1) {		
			$conf =& JFactory::getConfig();
			$cache = &JFactory::getCache($module->module);
			$cache->setLifeTime( $params->get( 'cache_time', $conf->getValue( 'config.cachetime' ) * 60 ) );
			$cache->setCaching(true);
		//	$cache->setCacheValidation(true);
			$items =  $cache->get( array('modK2MegaSlider', 'getList'), array($params, $module));
		} else {
			$items = modK2MegaSlider::getList($params, $module);
		}
		
		return $items;		
		
	}
	
	
	function getList ($params, $module) {
		
        $content = new YTMegaSlider();
        $content->featured = $params->get('featured', 2);
		$content->showtype = $params->get('showtype', 0);
		$content->category = $params->get('category', 0);
		$content->listIDs = $params->get('itemIds', '');
        $content->themes = $params->get('theme', 'default');
        $content->limit = $params->get('total', 5);
        $content->customUrl = $params->get('customUrl', '');
        $content->customUrlImage = $params->get('customUrlImage', '');
        $content->sort_order_field = $params->get('sort_order_field', "created");
        $content->thumb_height = $params->get('thumb_height', "150px");
        $content->thumb_width = $params->get('thumb_width', "120px");
        $content->max_main_description		=   $params->get('limit_main_description',25);
        $content->max_normal_description		=   $params->get('limit_normal_description',25);
        $content->small_thumb_height = $params->get('small_thumb_height', "0");
        $content->small_thumb_width = $params->get('small_thumb_width', "0");
        $content->target = $params->get('target', '_self');
        $content->cutStr_style = $params->get('cutStr_style', 'removing');
        $content->web_url = JURI::base();
        $content->max_normal_title        =   $params->get('limit_normal_title',25);
        $content->max_main_title        =   $params->get('limit_main_title',250); 
        $content->showprice        =   $params->get('showprice','show');
        $content->resize_folder = JPATH_CACHE.DS. $module->module .DS."images";
        $content->url_to_resize = $content->web_url . "cache/". $module->module ."/images/";
        $content->imagesource = $params->get('imagesource', 1);
        $content->cropresizeimage = $params->get('cropresizeimage', 1);
        
		$items = $content->getList($module);
				
		return $items;
	}
}
			
} 
if(!class_exists('Browser')){
	class Browser
	{
		private $props    = array("Version" => "0.0.0",
									"Name" => "unknown",
									"Agent" => "unknown") ;
	
		public function __Construct()
		{
			$browsers = array("firefox", "msie", "opera", "chrome", "safari",
								"mozilla", "seamonkey",    "konqueror", "netscape",
								"gecko", "navigator", "mosaic", "lynx", "amaya",
								"omniweb", "avant", "camino", "flock", "aol");
	
			$this->Agent = strtolower($_SERVER['HTTP_USER_AGENT']);
			foreach($browsers as $browser)
			{
				if (preg_match("#($browser)[/ ]?([0-9.]*)#", $this->Agent, $match))
				{
					$this->Name = $match[1] ;
					$this->Version = $match[2] ;
					break ;
				}
			}
		}
	
		public function __Get($name)
		{
			if (!array_key_exists($name, $this->props))
			{
				die("No such property or function {$name}");
			}
			return $this->props[$name] ;
		}
	
		public function __Set($name, $val)
		{
			if (!array_key_exists($name, $this->props))
			{
				SimpleError("No such property or function.", "Failed to set $name", $this->props);
				die;
			}
			$this->props[$name] = $val ;
		}
	
	} 
}	
?>

