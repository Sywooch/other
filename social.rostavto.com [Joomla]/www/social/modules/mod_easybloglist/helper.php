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

defined('_JEXEC') or die('Restricted access');

require_once(JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'tags.php');

class modListHelper
{
	function getPosts( $params )
	{
		$mainframe		= JFactory::getApplication();
		$db 			= EasyBlogHelper::db();
		$order			= trim($params->get('order', 'postcount_desc'));
		$count			= (int) trim($params->get('count', 0));
		$showprivate	= $params->get('showprivate', true);
		$showcmmtCount	= $params->get('showcommentcount', 0);
		$config			= EasyBlogHelper::getConfig();

		$categories		= $params->get( 'catid' );

		$query			= 'SELECT a.* FROM ' . $db->nameQuote( '#__easyblog_post' ) . ' AS a '
						. 'WHERE a.' . $db->nameQuote( 'published' ) .'=' . $db->Quote( 1 );

		if(!$showprivate)
		{
			$query .= ' AND a.' . $db->nameQuote('private') . '=' . $db->Quote( 0 );
		}

		// Respect inclusion categories

		if( !empty( $categories ) )
		{
			$categories = explode( ',' , $categories );

			$query	.= ' AND a.`category_id` IN(';

			if( !is_array( $categories ) )
			{
				$categories	= array( $categories );
			}

			for( $i = 0; $i < count( $categories ); $i++ )
			{
				$query	.= $db->Quote( $categories[ $i ] );

				if( next( $categories ) !== false )
				{
					$query	.= ',';
				}
			}
			$query	.= ')';
		}

		$query .= ' AND a.' . $db->nameQuote('issitewide') . '=' . $db->Quote('1');
		$query .= ' AND a.' . $db->nameQuote('ispending') . '=' . $db->Quote('0');


		$sort 	= $params->get( 'sorting', 'latest' );
		$order 	= $params->get( 'ordering', 'desc' );

		switch( $sort )
		{
			case 'popular':
				$query	.= ' order by a.`hits` ' . $order;
				break;
			case 'alphabet':
				$query	.= ' order by a.`title` ' . $order;
				break;
			case 'latest':
			default:
				$query	.= ' order by a.`created` ' . $order;
				break;
		}


		if(!empty($count))
		{
			$query .= ' LIMIT ' . $count;
		}

		$db->setQuery( $query );

		$posts 	= $db->loadObjectList();

		return $posts;
	}

	function _getMenuItemId( $post, &$params)
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
				case 'category':
					$routeTypeCategory  = true;
					break;
				case 'blogger':
					$routeTypeBlogger  = true;
					break;
				case 'tag':
					$routeTypeTag  = true;
					break;
				default:
					break;
			}
		}

		if( $routeTypeCategory )
		{
			$xid    = EasyBlogRouter::getItemIdByCategories( $post->category_id );
		}
		else if($routeTypeBlogger)
		{
			$xid    = EasyBlogRouter::getItemIdByBlogger( $post->created_by );
		}
		else if($routeTypeTag)
		{
			$tags	= self::_getPostTagIds( $post->id );
			if( $tags !== false )
			{
				foreach( $tags as $tag )
				{
					$xid    = EasyBlogRouter::getItemIdByTag( $tag );
					if( $xid !== false )
						break;
				}
			}
		}

		if( !empty( $xid ) )
		{
			// lets do it, do it, do it, lets override the item id!
			$itemId = '&Itemid=' . $xid;
		}

		return $itemId;
	}

	function _getPostTagIds( $postId )
	{
		static $tags	= null;

		if( ! isset($tags[$postId]) )
		{
			$db = EasyBlogHelper::db();

			$query  = 'select `tag_id` from `#__easyblog_post_tag` where `post_id` = ' . $db->Quote($postId);
			$db->setQuery($query);

			$result = $db->loadResultArray();

			if( count($result) <= 0 )
				$tags[$postId] = false;
			else
				$tags[$postId] = $result;

		}

		return $tags[$postId];
	}
}
