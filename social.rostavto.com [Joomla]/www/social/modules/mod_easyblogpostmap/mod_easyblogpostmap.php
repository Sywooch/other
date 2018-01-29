<?php
/**
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

$helper	= JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'helper.php';

jimport( 'joomla.filesystem.file' );

if( !JFile::exists( $helper ) )
{
	return;
}
require_once( $helper );
require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'helper.php' );
require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'location.php' );

$my 				= JFactory::getUser();
$config				= EasyBlogHelper::getConfig();
$easyblogInstalled 	= true;

$loadedHeaders		= EasyBlogHelper::loadHeaders();

$posts				= modEasyBlogPostMapHelper::getPosts($params);
$category			= '';
$team				= '';
$bloggers			= '';
$tag				= '';

$locations			= array();

$posts = modEasyBlogPostMapHelper::sortLocation( $posts );

$totalPosts = count( $posts );

// always store first location
$locations[] = new modEasyBlogMapLocation( $posts[0] );

// store previous post by reference
$previousPost =& $locations[0];

// start from second location to check
for( $i = 1; $i < $totalPosts; $i++ )
{
	$post =& $posts[$i];
	$postObj = new modEasyBlogMapLocation ( $post );

	if( modEasyBlogPostMapHelper::sameLocation( $post, $previousPost ) )
	{
		$previousPost->content .= $postObj->content;
		$previousPost->ratingid[] = $postObj->id;
	}
	else
	{
		$locations[] = $postObj;
		$previousPost =& $locations[count($locations) - 1];
	}
}

$language			= JFactory::getLanguage();
$language->load( 'com_easyblog' , JPATH_ROOT );

$document			= JFactory::getDocument();
$document->addStyleSheet( rtrim(JURI::root(), '/') . '/components/com_easyblog/assets/css/module.css' );

require( JModuleHelper::getLayoutPath( 'mod_easyblogpostmap' ) );
