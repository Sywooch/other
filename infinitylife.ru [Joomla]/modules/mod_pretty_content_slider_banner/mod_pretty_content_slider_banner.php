<?php

/*------------------------------------------------------------------------
# "Pretty Content Slider Banner" Joomla module
# Copyright (C) 2013 joombig. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: joombig.com
# Website: http://www.joombig.com
-------------------------------------------------------------------------*/

//no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

// Path assignments
$mosConfig_absolute_path = JPATH_SITE;
$mosConfig_live_site = JURI :: base();
if(substr($mosConfig_live_site, -1)=="/") { $mosConfig_live_site = substr($mosConfig_live_site, 0, -1); }
 
// get parameters from the module's configuration
$tabNumber = 5;

$enable_jQuery = $params->get('enable_jQuery',1);
$moduleWidth = $params->get('moduleWidth','800');
$moduleHeight = $params->get('moduleHeight','300');
$modulestyle = $params->get('modulestyle',0);
switch ($modulestyle) {
    case 0:
        $viewstyle = "0";
        break;
    case 1:
        $viewstyle = "-10";
        break;
    case 2:
        $viewstyle = "10";
        break;
}
$enable_border = $params->get('enable_border',1);
$autoplay = $params->get('autoplay',1);
$timespeed = $params->get('timespeed','3000');

for ($loop = 1; $loop <= $tabNumber; $loop += 1) {
$NameItem[$loop] = $params->get('NameItem'.$loop);
}

for ($loop = 1; $loop <= $tabNumber; $loop += 1) {
$image[$loop] = $params->get('image'.$loop,$loop.'.jpg');
}
for ($loop = 1; $loop <= $tabNumber; $loop += 1) {
$DesShort[$loop] = $params->get('DesShort'.$loop);
}
for ($loop = 1; $loop <= $tabNumber; $loop += 1) {
$DesLong[$loop] = $params->get('DesLong'.$loop);
}
for ($loop = 1; $loop <= $tabNumber; $loop += 1) {
$LinkDetail[$loop] = $params->get('LinkDetail'.$loop);
}
$color_title 		= $params->get('color_title', "#ffffff");
$color_desshort 		= $params->get('color_desshort', "#ffffff");
$color_deslong 		= $params->get('color_deslong', "#ffffff");

$font_size_title 		= $params->get('font_size_title', "20");
$font_size_desshort 		= $params->get('font_size_desshort', "30");
$font_size_deslong 		= $params->get('font_size_deslong', "14");

$background_color_title 		= $params->get('background_color_title', "#222");
$boder_color_title 		= $params->get('boder_color_title', "#000");

$background_color_des 		= $params->get('background_color_des', "#222");
$boder_color_des 		= $params->get('boder_color_des', "#000");

// get the document object
$doc =  JFactory::getDocument();

require(JModuleHelper::getLayoutPath('mod_pretty_content_slider_banner'));