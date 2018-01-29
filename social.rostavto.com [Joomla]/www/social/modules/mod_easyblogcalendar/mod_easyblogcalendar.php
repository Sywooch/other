<?php
/**
* @version		$Id: mod_login.php 14401 2010-01-26 14:10:00Z louis $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$user 				= JFactory::getUser();
$easyblogInstalled	= false;
$itemId 			= JRequest::getInt('Itemid', 0);

jimport( 'joomla.filesystem.file' );

if(JFile::exists(JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'easyblog.php'))
{
	require_once( JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'constants.php' );
	require_once( EBLOG_HELPERS . DIRECTORY_SEPARATOR . 'helper.php' );
	require_once( EBLOG_HELPERS . DIRECTORY_SEPARATOR . 'router.php' );
	require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'helper.php');

	$easyblogInstalled	= true;
	$document			= JFactory::getDocument();

	$option = JRequest::getCmd( 'option', '' );
	if($option!="com_easyblog")
	{
		EasyBlogHelper::loadHeaders();
	}

	$defaultItemId	= EasyBlogRouter::getItemId('latest');
	$itemId 		= JRequest::getInt('Itemid', $defaultItemId);

	$customId       = modEasyBlogCalendarHelper::_getMenuItemId( $params );
	if( !empty($customId) )
	{
		$itemId	= $customId;
	}

	$document->addScriptDeclaration( 'var siteurl="'.trim(JURI::root(), '/').'";' );
	$document->addScript( rtrim(JURI::root(), '/') . '/modules/mod_easyblogcalendar/assets/js/script.js' );
	$document->addStyleSheet( rtrim(JURI::root(), '/') . '/components/com_easyblog/assets/css/module.css' );
}

require(JModuleHelper::getLayoutPath('mod_easyblogcalendar'));
