<?php
/*
 * @package		mod_easyblogwelcome
 * @copyright	Copyright (C) 2010 Stack Ideas Private Limited. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 *
 * EasyBlog is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */
defined('_JEXEC') or die('Restricted access');

$path	= JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'helper.php';

jimport( 'joomla.filesystem.file' );

if( !JFile::exists( $path ) )
{
	return;
}
require_once( $path );
require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'helper.php');


JTable::addIncludePath( EBLOG_TABLES );
EasyBlogHelper::loadModuleCss();

$isLogged			= modEasyBlogWelcomeHelper::getLoginStatus();
$return				= modEasyBlogWelcomeHelper::getReturnURL($params, $isLogged);
$blogger			= EasyBlogHelper::getTable( 'Profile' , 'Table' );
$blogger->load( JFactory::getUser()->id );

$useMenuItem        = modEasyBlogWelcomeHelper::_getMenuItemId($params);

require_once( EBLOG_HELPERS . DIRECTORY_SEPARATOR . 'acl.php' );
$useracl	= EasyBlogACLHelper::getRuleSet();
$config 	= EasyBlogHelper::getConfig();

if( EasyBlogHelper::getJoomlaVersion() >= '1.6' )
{
	$comUserOption	= 'com_users';
	$tasklogin		= 'user.login';
	$tasklogout		= 'user.logout';
	$viewRegister	= 'registration';
	$InputPassword	= 'password';
}
else
{
	$comUserOption	= 'com_user';
	$tasklogin		= 'login';
	$tasklogout		= 'logout';
	$viewRegister	= 'register';
	$InputPassword	= 'passwd';
}


require(JModuleHelper::getLayoutPath('mod_easyblogwelcome'));
