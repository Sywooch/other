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

// If user is logged in, skip this
if( JFactory::getUser()->id )
{
	return;
}

// Include the engine file.
require_once( $file );

Foundry::language()->load( 'com_easysocial' , JPATH_ROOT );

// Check if Foundry exists
if( !Foundry::exists() )
{
	echo JText::_( 'COM_EASYSOCIAL_FOUNDRY_DEPENDENCY_MISSING' );
	return;
}

$my 		= Foundry::user();

// Load our own helper file.
require_once( dirname( __FILE__ ) . '/helper.php' );

// Load up the module engine
$modules 	= Foundry::modules( 'mod_easysocial_register' );

// We need foundryjs here
$modules->loadComponentScripts();

// We need these packages
$modules->addDependency( 'css' , 'javascript' );

// Get the layout to use.
$layout 	= $params->get( 'layout' , 'default' );
$suffix 	= $params->get( 'suffix' , '' );
$config 	= Foundry::config();

// Get the profile id
$profileId 	= $params->get( 'profile_id' );

// If there's no profile id, skip this altogether
if( !$profileId )
{
	return;
}

// Determines if we should show the gender field
$showGender	= false;

if( $params->get( 'show_gender' , false ) == true )
{
	// Test if there is a gender field for this profile.
	$model	= Foundry::model( 'Profiles' );

	if( $model->hasCustomFieldType( $profileId , 'gender' ) )
	{
		$showGender	= true;
	}
}

// Get the splash image url.
$splashImage	= $params->get( 'splash_image_url' , JURI::root() . 'modules/mod_easysocial_register/images/splash.jpg' );


require( JModuleHelper::getLayoutPath( 'mod_easysocial_register' , $layout ) );
