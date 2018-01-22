<?php
/*------------------------------------------------------------------------
# mod_vtem_login - VTEM Slick Module
# ------------------------------------------------------------------------
# author Nguyen Van Tuyen
# copyright Copyright (C) 2011 VTEM.NET. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.vtem.net
# Technical Support: Forum - http://vtem.net/en/forum.html
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die('Restricted access');
$pretext 	= $params->get( 'pretext');
$posttext 	= $params->get( 'posttext');
$login 	= $params->get( 'login');
$logout 	= $params->get( 'logout');
$greeting 	= $params->get( 'greeting');
$name 	= $params->get( 'name');
$usesecure 	= $params->get( 'usesecure');

$document =& JFactory::getDocument();
$renderer	= $document->loadRenderer( 'module' );
$options	 = array( 'style' => "raw" );
$module	 = JModuleHelper::getModule('mod_login');
$module->params	= "pretext=$pretext\nposttext=$posttext\nlogin=$login\nlogout=$logout\ngreeting=$greeting\nname=$name\nusesecure=$usesecure";
$document->addStyleSheet(JURI::root().'modules/mod_vtem_login/css/style.css');
require(JModuleHelper::getLayoutPath('mod_vtem_login'));