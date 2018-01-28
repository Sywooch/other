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

if (!defined('ModEasyBlogLatestBloggerImgUriPath')) {
    define('ModEasyBlogLatestBloggerImgUriPath', JURI::root() . 'modules/mod_easybloglatestblogger/assets/');
}

jimport( 'joomla.filesystem.file' );

if( JFile::exists(JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'easyblog.php'))
{
	// Include the syndicate functions only once
	require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'helper.php');
	require_once (JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'router.php');
	require_once (JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'helper.php');
	require_once (JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'date.php');
    require_once (JPATH_ROOT . DIRECTORY_SEPARATOR . 'administrator' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'tables' . DIRECTORY_SEPARATOR . 'profile.php');

	$document = JFactory::getDocument();
	$document->addStyleSheet( rtrim(JURI::root(), '/') . '/components/com_easyblog/assets/css/module.css' );

	$bloggers		= modEasyBlogLatestBloggerHelper::getLatestBlogger($params);
	$config 		= EasyBlogHelper::getConfig();

	if(! empty($bloggers))
	{
	    for($i = 0; $i < count($bloggers); $i++)
	    {
	        $row    	=& $bloggers[$i];

		    $profile	= EasyBlogHelper::getTable( 'Profile', 'Table' );
            $profile->load( $row->id );

            $row->profile   = $profile;
	    }//end foreach
	}

	$easyblogInstalled = true;

}
else
{
	$posts 			= array();
	$entryitemid 	= '1';
	$bloggeritemid	= '1';
	$easyblogInstalled = false;
}

require(JModuleHelper::getLayoutPath('mod_easybloglatestblogger'));
