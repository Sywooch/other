<?php
/*
 * @package		EasyBlog
 * @copyright	Copyright (C) 2010 Stack Ideas Private Limited. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 *
 * EasyBlog is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

$option = JRequest::getVar( 'option' );
$view   = JRequest::getVar( 'view' );
$uid	= JRequest::getInt( 'id' );

$allowed	= array( 'entry' , 'categories' , 'teamblog' );

if( $option != 'com_easyblog' || ( $option =='com_easyblog' && !in_array( $view , $allowed ) ) || !$uid )
{
	return;
}

$subscribeType  = '';

switch( $view )
{
	case 'categories':
		$subscribeType  = 'category';
		break;
	case 'teamblog':
		$subscribeType  = 'teamblog';
		break;
	case 'entry':
	default:
		$subscribeType  = 'entry';
		break;
}


$path	= JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'helper.php';

jimport( 'joomla.filesystem.file' );

if( !JFile::exists( $path ) )
{
	return;
}

require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'helper.php' );
require_once( EBLOG_HELPERS . DIRECTORY_SEPARATOR . 'tooltip.php' );
require_once( $path );

JTable::addIncludePath( EBLOG_TABLES );
EasyBlogHelper::loadModuleCss();

$id             = JRequest::getInt( 'id' );
$subscribers    = modEasyBlogSubscribers::getUsers();
$guests         = modEasyBlogSubscribers::getGuests();

require( JModuleHelper::getLayoutPath( 'mod_subscribers' ) );
