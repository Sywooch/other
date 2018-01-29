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

// no direct access
defined('_JEXEC') or die('Restricted access');

class modEasyBlogWelcomeHelper
{
	function getReturnURL($params, $isLogged=false)
	{
		$type  = empty($isLogged) ? 'login' : 'logout';
		$itemid =  $params->get($type);
		if($itemid)
		{
			$menu = JFactory::getApplication()->getMenu();
			$item = $menu->getItem($itemid); //var_dump($menu);die;
			if ($item)
			{
				$url = JRoute::_($item->link.'&Itemid='.$itemid, false);
			}
			else
			{
				// stay on the same page
				$uri = JFactory::getURI();
				$url = $uri->toString(array('path', 'query', 'fragment'));
			}
		}
		else
		{
			// go to EasyBlog's frontpage
			//$itemid = EasyBlogRouter::getItemId();
			//$url = JRoute::_('index.php?option=com_easyblog&view=latest&Itemid='.$itemid, false);

			// stay on same page
			$uri = JFactory::getURI();
			$url = $uri->toString(array('path', 'query', 'fragment'));
		}

		return base64_encode($url);
	}

	function getLoginStatus()
	{
		$user = JFactory::getUser();
		return (!empty($user->id)) ? true : false;
	}

	function getBloggerProfile($userid)
	{
		if(empty($userid))
		{
			return false;
		}

		$blogger = EasyBlogHelper::getTable( 'Profile', 'Table' );
	    $user   = JFactory::getUser($userid);
	    $blogger->setUser($user);

		$integrate	= new EasyBlogIntegrate();
		$profile	= $integrate->integrate($blogger);

		$profile->displayName   = $blogger->getName();

		return $profile;
	}

	function _getMenuItemId( &$params)
	{
		$itemId                 = '';
		$routeTypeCategory		= false;
		$routeTypeBlogger		= false;
		$routeTypeTag			= false;

		$routingType            = $params->get( 'routingtype', 'default' );

		if( $routingType != 'default' )
		{
			switch ($routingType)
			{
				case 'menuitem':
					$itemId					= $params->get( 'menuitemid' ) ? '&Itemid=' . $params->get( 'menuitemid' ) : '';
					break;
				default:
					break;
			}
		}

		return $itemId;
	}
}
