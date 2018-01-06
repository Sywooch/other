<?php
/**
 * @version		$Id$
 * @author		Joomlaites
 * @package		Joomlaites
 * @subpackage	mod_jimagerotator
 * @copyright	Copyright (C) 2015 Joomlaites. All rights reserved.
 * @license		License GNU General Public License version 2 or later; see LICENSE.txt, see LICENSE.php
 */
// no direct access
defined('_JEXEC') or die('Restricted access'); 
require_once __DIR__ . '/helper.php';
$images = $params->get('path_folder.images');
//include css
JHTML::stylesheet('modules/' . $module->module . '/elements/jquery.bxslider.css');
JHTML::stylesheet('modules/' . $module->module . '/elements/bjqs.css');
JHTML::script('modules/' . $module->module . '/elements/bjqs-1.3.js',true);

JHTML::script('modules/' . $module->module . '/elements/jquery.bxslider.js',true);

$animation = '';
if (trim($params->get('animation')) == 'slide'){
	$animation = $params->get('anim_slide','slidehrz');
}elseif (trim($params->get('animation'))==='slice'){
	$animation = $params->get('anim_slice','slicezoom');
}else{
	$animation = $params->get('animation');
}
$maincontainerwidth = $params->get('maincontainerwidth');
$camera_pag = $params->get('camera_pag');
$arrow_button = $params->get('arrow_button');
$sliderboxwidth = $params->get('sliderboxwidth');
$sliderboxheight = $params->get('sliderboxheight');
$autorun = $params->get('autorun');
$sliderboxmargin = $params->get('sliderboxmargin');
$sliderboxpadding = $params->get('sliderboxpadding');
$numberboxshow = $params->get('numberboxshow');
$bx_image_container_padding = $params->get('bx_image_container_padding');
$bx_image_container_margin = $params->get('bx_image_container_margin');
$bx_image_container_background = $params->get('bx_image_container_background');
$bx_image_container_shadow_color = $params->get('bx_image_container_shadow_color');
$bx_image_container_shadow_size = $params->get('bx_image_container_shadow_size');

$borderleftstyle = $params->get('borderleftstyle');
$borderleftweight = $params->get('borderleftweight');
$borderleftcolor = $params->get('borderleftcolor');
$borderrightstyle = $params->get('borderrightstyle');
$borderrightweight = $params->get('borderrightweight');
$borderrightcolor = $params->get('borderrightcolor');
$img_margin = $params->get('img_margin');

$img_background = $params->get('img_background');
$img_shadow = $params->get('img_shadow');
$img_shadow_size = $params->get('img_shadow_size');

$lists = modjImagerotatorHelper::getList($params);

require (JModuleHelper::getLayoutPath('mod_jimagerotator',$params->get('layout', 'default')));