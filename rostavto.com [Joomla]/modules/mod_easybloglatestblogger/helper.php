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

class modEasyBlogLatestBloggerHelper
{
	function getLatestBlogger(&$params)
	{
	    if(file_exists(JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'helper.php'))
	    	require_once (JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'helper.php');

		$mainframe	= JFactory::getApplication();
		$db         = EasyBlogHelper::db();

		$count				= (INT)trim($params->get('count', 0));
		$excludeemptypost  	= $params->get('excludeemptypost', 0);
		$onlyFeatured  		= $params->get('onlyfeatured', 0);

		$query	= 'SELECT x.*, count(p.`id`) as `post_count` FROM (';
		$query	.= ' (SELECT a.`id`, a.`registerDate`';
		$query	.= ' FROM `#__users` AS `a`';
		$query	.= '  INNER JOIN `#__easyblog_users` AS `b` ON a.`id` = b.`id`';

		if( $onlyFeatured )
		    $query	.= '  INNER JOIN `#__easyblog_featured` AS `fb` ON a.`id` = fb.`content_id` and fb.`type` = ' . $db->Quote('blogger');

		if(EasyBlogHelper::getJoomlaVersion() >= '1.6'){
			$query	.= '  INNER JOIN `#__user_usergroup_map` AS `d` ON a.`id` = d.`user_id`';
		} else {
			$query	.= '  INNER JOIN `#__core_acl_aro` AS `c` ON a.`id` = c.`value`';
			$query	.= '    AND c.`section_value` = ' . $db->Quote('users');
			$query	.= '  INNER JOIN `#__core_acl_groups_aro_map` AS `d` ON c.`id` = d.`aro_id`';
		}

		$query	.= '  INNER JOIN `#__easyblog_acl_group` AS `e` ON d.`group_id`  = e.`content_id`';
		$query	.= '    AND e.`type` = ' . $db->Quote('group') . ' AND e.`status` = 1';
		$query	.= '  INNER JOIN `#__easyblog_acl` as `f` ON e.`acl_id` = f.`id`';
		$query	.= '    AND f.`action` = ' . $db->Quote('add_entry') . ')';
		$query	.= ' UNION ';
		$query	.= ' (SELECT a1.`id`, a1.`registerDate`';
		$query	.= ' FROM `#__users` AS `a1`';
		$query	.= '  INNER JOIN `#__easyblog_users` AS `b1` ON a1.`id` = b1.`id`';

		if( $onlyFeatured )
		    $query	.= '  INNER JOIN `#__easyblog_featured` AS `fb1` ON a1.`id` = fb1.`content_id` and fb1.`type` = ' . $db->Quote('blogger');

		$query	.= '  INNER JOIN `#__easyblog_acl_group` AS `c1` ON a1.`id`  = c1.`content_id`';
		$query	.= '    AND c1.`type` = ' . $db->Quote('assigned') . ' AND c1.`status` = 1';
		$query	.= '  INNER JOIN `#__easyblog_acl` as `d1` ON c1.`acl_id` = d1.`id`';
		$query	.= '    AND d1.`action` = ' . $db->Quote('add_entry') . ')';
		$query  .= ' ) as x LEFT JOIN `#__easyblog_post` AS p ON x.`id` = p.`created_by`';

		// Ensure that unpublished blog posts are not calculated.
		$query	.= ' AND p.`published`=' . $db->Quote( 1 );

		if($excludeemptypost)
		{
		    $query  .= ' GROUP BY x.`id` HAVING (count(p.`id`) > 0)';
		}
		else
		{
			$query  .= ' GROUP BY x.`id`';
		}

		$order 	= $params->get( 'ordertype' , 'DESC' );
		if( $order == 'POSTS' )
		{
			$query	.= ' ORDER BY `post_count` DESC';
		}
		else
		{
			$query	.= ' ORDER BY x.`registerDate` ' . $order;
		}


		if($count > 0)
			$query  .= ' LIMIT ' . $count;

		// echo $query;exit;

		$db->setQuery($query);

		$bloggers   = $db->loadObjectList();
		return $bloggers;
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
