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

jimport( 'joomla.filesystem.file' );

if( !JFile::exists( JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'easyblog.php') )
{
	return;
}

require_once( JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'constants.php' );
require_once( EBLOG_HELPERS . DIRECTORY_SEPARATOR . 'helper.php' );
require_once( EBLOG_HELPERS . DIRECTORY_SEPARATOR . 'modules.php' );
require_once( EBLOG_HELPERS . DIRECTORY_SEPARATOR . 'router.php' );
require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'helper.php');

JTable::addIncludePath( EBLOG_TABLES );
EasyBlogHelper::loadModuleCss();
EasyBlogHelper::loadHeaders();

$document	= JFactory::getDocument();
$document->addStyleSheet( rtrim(JURI::root(), '/') . '/components/com_easyblog/assets/css/module.css' );

$language			= JFactory::getLanguage();
$language->load( 'com_easyblog' , JPATH_ROOT );

$config         	= EasyBlogHelper::getConfig();
$result				= modTopBlogsHelper::getPosts( $params );

require(JModuleHelper::getLayoutPath('mod_topblogs'));
