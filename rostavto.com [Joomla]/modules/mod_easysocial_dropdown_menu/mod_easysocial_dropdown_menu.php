<?php
/**
* @package		EasySocial
* @copyright	Copyright (C) 2010 - 2012 Stack Ideas Sdn Bhd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasySocial is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined( '_JEXEC' ) or die( 'Unauthorized Access' );

// Include main engine
$file 	= JPATH_ROOT . '/administrator/components/com_easysocial/includes/foundry.php';

jimport( 'joomla.filesystem.file' );

if( !JFile::exists( $file ) )
{
	return;
}

// Include the engine file.
require_once( $file );
require_once( dirname( __FILE__ ) . '/helper.php' );

// Check if Foundry exists
if( !Foundry::exists() )
{
	Foundry::language()->load( 'com_easysocial' , JPATH_ROOT );
	echo JText::_( 'COM_EASYSOCIAL_FOUNDRY_DEPENDENCY_MISSING' );
	return;
}

$my 		= Foundry::user();

if( !$my->id )
{
	return;
}

// Load up the module engine
$modules 	= Foundry::modules( 'mod_easysocial_dropdown_menu' );

// We need these packages
$modules->loadComponentScripts();
$modules->loadComponentStylesheets();
$modules->addDependency( 'css' , 'javascript' );

// Get menu items
$items 		= array();

if( $params->get( 'render_menus' , false ) )
{
	$items 		= ModEasySocialDropdownMenuHelper::getItems( $params );
}

// Get the logout return
$logoutMenu 	= Foundry::config()->get( 'general.site.logout' );
$logoutReturn 	= Foundry::get( 'toolbar' )->getRedirectionUrl( $logoutMenu );
$logoutReturn	= base64_encode( $logoutReturn );

// Get the layout to use.
$layout 	= $params->get( 'layout' , 'default' );
$suffix 	= $params->get( 'suffix' , '' );


require( JModuleHelper::getLayoutPath( 'mod_easysocial_dropdown_menu' , $layout ) );
