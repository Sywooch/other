<?php
/*------------------------------------------------------------------------
 # Sj K2 Mega Slider  - Version 1.1
 # Copyright (C) 2011 SmartAddons.Com. All Rights Reserved.
 # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Author: SmartAddons.Com
 # Websites: http://www.smartaddons.com/
 -------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );

require_once (dirname(__FILE__).DS.'helper.php');

jimport("joomla.filesystem.folder");
jimport("joomla.filesystem.file");

/*-- Process---*/

$start							= $params->get("start", 1);
$target 						= $params->get("target", '');
$jquery 						= $params->get("jquery", 0);
$total                          = $params->get("total",1);
$play 							= $params->get("play", 'true');
$theme 							= $params->get("theme", 'default');
$effect 						= $params->get("effect", 'fade');
$slideshow_speed 				= $params->get("slideshow_speed", 800);
$timer_speed 					= $params->get("timer_speed", 4000);
$opacity_main                   = $params->get("opacity_main", 0.7);
$start_clock_on_mouseOut 		= $params->get("start_clock_on_mouseOut", 'true');
$start_clock_on_mouseOutAfter 	= $params->get("start_clock_on_mouseOutAfter", 3000);
$caption_animation_speed 		= $params->get("caption_animation_speed", 800);
$main_background 				= $params->get("main_background", '#000000');
$main_color 				    = $params->get("main_color", '#FFFFFF');
$title_color 					= $params->get("title_color", '#FFFFFF');
$title_active_color 			= $params->get("title_active_color", '#FFFFFF');
$normal_description_color       = $params->get("normal_description_color", '#FFFFFF');
$normal_desc_active_color       = $params->get("normal_description_active_color", '#FFFFFF');
$normal_background              = $params->get("normal_background", '#2c0da0');

$prenext_show 					= $params->get("prenext_show", 1);
$caption_show 					= $params->get("caption_show", 'true');
$thumb_height 					= $params->get('thumb_height', "400");
$thumb_width 					= $params->get('thumb_width', "300");
$small_thumb_height 			= $params->get('small_thumb_height', "75");
$small_thumb_width 				= $params->get('small_thumb_width', "55");		
$show_readmore 					= $params->get('show_readmore', "0");
$show_description 				= $params->get('show_description', "0");
$show_normal_image              = $params->get('show_normal_image', "1");
$show_main_image                = $params->get('show_main_image', "1");
$description_color 				= $params->get('description_color', "#FFFFFF");
$link_caption					= $params->get('link_caption', 1);
$link_image						= $params->get('link_image', 1);
$auto_play						= $params->get('auto_play', 1);
$show_img_on_right				= $params->get('show_img_on_right',1);
$button_theme					= $params->get('button_theme','number');
$desc_box_width					= $params->get('desc_box_width','440');

$num_item_per_page              = $params->get('num_item_per_page','4');
$show_readmore_slideii          = $params->get('show_readmore_slideii','1');
$readmore_sliderii              = $params->get('readmore_sliderii');
$show_buttons_slideii           = $params->get('show_buttons_slideii','1');
$show_title_slideshowii         = $params->get('show_title_slideshowii','1');
$show_caption_slide             = $params->get('show_caption_slide','1');
$show_normal_description        = $params->get('show_normal_description','1');


$width_module_mega              = $params->get('width_module_mega','800');
$bg_navication                  = $params->get('bg_navication','#E4E4E4');
$bg_item_nav                    = $params->get('bg_item_nav','#FF8880');
$color_title_item_nav           = $params->get('color_title_item_nav','#000000');
$color_content_item_nav         = $params->get('color_content_item_nav','#FFFFFF');
$nav_style_mega                 = $params->get('nav_style_mega','nav_style01');
$position_image_display         = $params->get('position_image_display','left');
$width_opacity                  = $params->get('width_opacity','250');
$main_description_color         = $params->get("main_description_color", '#000000');
$main_title_color               = $params->get("main_title_color", '#000000');
$show_buttons_mega              = $params->get("show_buttons_mega", 'display');
$readmore_mega_text             = $params->get("readmore_mega_text", 'Readmore');
$stylereadmore                  = $params->get("stylereadmore", 'style3');
$showhidenavigation             = $params->get("showhidenavigation", 'show_nav');
$showmaindesc                   = $params->get("showmaindesc", '1');
$showmaintitle                  = $params->get("showmaintitle", '1');
$shownormaltitle                = $params->get("shownormaltitle", '1');
$shownormaldesc                 = $params->get("shownormaldesc", '1');
$showreadmore                   = $params->get("showreadmore", '1');
$shownormalimage                = $params->get("shownormalimage", '1');
$maintitlecolor                 = $params->get("maintitlecolor", '#000000');
$maindesccolor                  = $params->get("maindesccolor", '#000000');
$coloritemnav                   = $params->get("coloritemnav", '#000000');
$colorcontentnav                = $params->get("colorcontentnav", '#FFFFFF');
$bgmainitem                     = $params->get("bgmainitem", '#E5F3FB');
$shownumbutton                  = $params->get("shownumbutton", 'show');
$showmaincontent                = $params->get("showmaincontent", 1);
$show_intro                     = $params->get('show_intro', 0);    
$show_footer                    = $params->get('show_footer', 0);   
$intro_text                     = $params->get("intro_text", "");
$footer_text                    = $params->get("footer_text", "");



$showButton = '';
if($show_buttons_mega == 'display'){
    $showButton = 'block';    
}elseif($show_buttons_mega == 'hide' || $show_buttons_mega == 'hover'){
    $showButton = 'none';
}
if($nav_style_mega == 'nav_style02' && $shownormalimage == 0){
    $small_thumb_width = 0;
}

if($position_image_display == "left"){
    $shadownl = 'shadown-l-left';
    $shadownr = 'shadown-r-left';
    $button_image_theme1 = 'class-button-image-position-right-'.$theme;
}else{
    $shadownl = 'shadown-l-right';
    $shadownr = 'shadown-r-right';
    $button_image_theme1 = 'class-button-image-position-left-'.$theme;
}
if($position_image_display == "left"){
    $class_position_image = 'megaslider-main-image-'.$theme;
    $class_position_content = 'content-mega-main-'.$theme;
    $class_position_readmore = 'icon_readmore_right_'.$stylereadmore;
}else{
    $class_position_image = 'megaslider-main-image-right-'.$theme;
    $class_position_content = 'content-mega-main-right-'.$theme;
    $class_position_readmore = 'icon_readmore_'.$stylereadmore;
}
if(($showmaintitle == 0 && $showmaindesc == 0 && $showreadmore == 0) || $showmaincontent == 0){
    $showmaincontent = 0;
}else{
    $showmaincontent = 1;
}
if($showmaintitle == 0 && $showmaindesc == 0 && $showreadmore == 0){
    $showmaincontenttheme3 = 0;
    $showmaincontenttheme4 = 0;
    $showmaincontenttheme1 = 0;
}else{
    $showmaincontenttheme3 = 1;
    $showmaincontenttheme4 = 1;
    $showmaincontenttheme1 = 1;
}
$start--;
$readmore_img = '<div class="readmore_button"><p>'.JText::_('read more ').'</p></div>';


$center = round($thumb_height/2);
$bottom = 220;
$widthIe = 0;
if($center>$bottom)
	$botoom = $center; 

$browser = new Browser();
if($browser->Name=='msie' && floor($browser->Version)==6){$widthIe = 3;}
if (!defined ('K2_MEGA_SLIDER')) {
	define ('K2_MEGA_SLIDER', 1);
	  if($jquery){  
	    if (!defined ('YTCJQUERY')){
		    define('YTCJQUERY', 1);
		    JHTML::script('yt.jquery-1.5.min.js', JURI::base() . '/modules/'.$module->module.'/assets/js/');				
	    }
	    JHTML::script('script.megaslider.js',JURI::base() . '/modules/'.$module->module.'/assets/js/');
      }
	/* Add css*/	
	$browser = new Browser();
	
    if($browser->Name=='msie' && floor($browser->Version)==7)	
	{
		JHTML::stylesheet('ie7.css', JURI::base() . '/modules/'.$module->module.'/assets/');
	}

    JHTML::stylesheet('style.css', JURI::base() . '/modules/'.$module->module.'/assets/');	
	
	/* add JS files*/		
}
$contentHelper = new modK2MegaSlider();
$items = $contentHelper->process($params, $module);

require( JPATH_BASE .DS.'modules'.DS.'mod_sj_k2megaslider'.DS.'assets'.DS.'style-multi.php' );
$count_items = count($items);
$heightItem = ($thumb_height/$num_item_per_page);
$normalHeight = $heightItem - 20;
//echo $normalHeight;die;
if($count_items<$num_item_per_page){
    $count_items = $num_item_per_page;
}
elseif($count_items>=$num_item_per_page){
    $count_items = $count_items;
    $num_item_per_page = $num_item_per_page;
}
if($nav_style_mega == 'nav_style02' && $theme == 'theme3'){
    $item_normal_width = (($width_module_mega-20)/$num_item_per_page)-7;
    
}
if($theme == 'theme3'){
    $left_number_button = ($thumb_width + (($width_module_mega - ($thumb_width + 50))/2) - ($num_item_per_page * 40)/2) + 30;
}
if($nav_style_mega == 'nav_style02' && $theme != 'theme3'){
    $item_normal_width = (($width_module_mega-20)/$num_item_per_page)-14;
}
if($theme != 'theme3'){
    $left_number_button = $thumb_width + (($width_module_mega - ($thumb_width + 50))/2) - ($num_item_per_page * 40)/2;
}


if($count_items > 0 ) {
	if ($count_items > 1) {
			foreach($items as $key=>$item)
			{
				if($key==0)
				{
					$pre = $count_items-1;
					$nex = $key+1;
				} 
				elseif(($key+1)==$count_items)
				{
					$pre = $key-1;
					$nex = 0;
				}
				else
				{
					$pre = $key-1;
					$nex = $key+1;
				}
			}

		} else {
			$items[0]['pre'] = "";
		$items[0]['nex'] = "";
		}
} 	
/* Show html*/
$path = JModuleHelper::getLayoutPath( 'mod_sj_k2megaslider', $theme );
if (file_exists($path)) {
	require($path);
}
?>
