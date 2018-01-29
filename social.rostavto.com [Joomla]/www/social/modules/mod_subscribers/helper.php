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

require_once(JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'helper.php');

class modEasyBlogSubscribers
{
	public function getUsersQuery()
	{
		$id		= JRequest::getInt( 'id' );
		$view	= JRequest::getVar( 'view' );
		$query	= '';
		$db		= EasyBlogHelper::db();


		switch( $view )
		{
			case 'entry':
			    $query  = 'SELECT a.`id` FROM ' . $db->nameQuote( '#__users' ) . ' AS a '
			            . 'INNER JOIN ' . $db->nameQuote( '#__easyblog_post_subscription' ) . ' AS b '
			            . 'ON a.`id` = b.`user_id` '
			            . 'WHERE '
			            . 'b.`user_id` != 0 '
			            . 'AND b.`post_id` = ' . $db->Quote( $id );


			break;
			case 'categories':
			    $query  = 'SELECT a.`id` FROM ' . $db->nameQuote( '#__users' ) . ' AS a '
			            . 'INNER JOIN ' . $db->nameQuote( '#__easyblog_post_subscription' ) . ' AS b '
			            . 'ON a.`id` = b.`user_id` '
			            . 'WHERE '
			            . 'b.`user_id` != 0 '
			            . 'AND b.`post_id` = ' . $db->Quote( $id );
			break;
			case 'teamblog':
			    $query  = 'SELECT a.`id` FROM ' . $db->nameQuote( '#__users' ) . ' AS a '
			            . 'INNER JOIN ' . $db->nameQuote( '#__easyblog_post_subscription' ) . ' AS b '
			            . 'ON a.`id` = b.`user_id` '
			            . 'WHERE '
			            . 'b.`user_id` != 0 '
			            . 'AND b.`post_id` = ' . $db->Quote( $id );
			break;
		}

		return $query;
	}

	public function getUsers()
	{
	    $id     = JRequest::getVar( 'id' );
	    $view	= JRequest::getVar( 'view' );
	    $db     = EasyBlogHelper::db();

		$blog		= EasyBlogHelper::getTable( 'Blog' );
		$blog->load( $id );
		$query		= '';

		if( $view == 'entry' )
		{
			$query	= 'SELECT a.' . $db->nameQuote( 'user_id' ) . ' FROM ' . $db->nameQuote( '#__easyblog_post_subscription' ) . ' AS a '
					. 'INNER JOIN ' . $db->nameQuote( '#__users' ) . ' AS b '
					. 'ON b.' . $db->nameQuote( 'id' ) . '=a.' . $db->nameQuote( 'user_id' ) . ' '
					. 'WHERE ' . $db->nameQuote( 'user_id' ) . '!=' . $db->Quote( 0 ) . ' '
					. 'AND a.' . $db->nameQuote( 'post_id' ) . '=' . $db->Quote( $id );
		}

		if( $view == 'categories' || $view == 'entry' )
		{
			$id		= $view == 'entry' ? $blog->category_id : $id;

			if( $view == 'entry' )
			{
				$query	.= ' UNION ';
			}

			$query	.= 'SELECT a.' . $db->nameQuote( 'user_id' ) . ' FROM ' . $db->nameQuote( '#__easyblog_category_subscription' ) . ' AS a '
					. 'INNER JOIN ' . $db->nameQuote( '#__users' ) . ' AS b '
					. 'ON b.' . $db->nameQuote( 'id' ) . '=a.' . $db->nameQuote( 'user_id' ) . ' '
					. 'WHERE ' . $db->nameQuote( 'user_id' ) . '!=' . $db->Quote( 0 ) . ' '
					. 'AND a.' . $db->nameQuote( 'category_id') . '=' . $db->Quote( $id );
		}

		if( $view == 'teamblog' || $view == 'entry')
		{
			if( $view == 'entry' )
			{
				$query	.= ' UNION ';
			}

			$query	.= 'SELECT a.' . $db->nameQuote( 'user_id' ) . ' FROM ' . $db->nameQuote( '#__easyblog_team_subscription' ) . ' AS a '
					. 'INNER JOIN ' . $db->nameQuote( '#__users' ) . ' AS b '
					. 'ON b.' . $db->nameQuote( 'id' ) . '=a.' . $db->nameQuote( 'user_id' );

			if( $view == 'entry' )
			{
				$query	.= ' INNER JOIN ' . $db->nameQuote( '#__easyblog_team_post' ) . ' AS c '
						. 'ON c.' . $db->nameQuote( 'team_id' ) . '=a.' . $db->nameQuote( 'team_id') . ' '
						. 'WHERE a.' . $db->nameQuote( 'user_id' ) . '!=' . $db->Quote( 0 ) . ' '
						. 'AND c.' . $db->nameQuote( 'post_id' ) . '=' . $db->Quote( $id );
			}
			else
			{
				$query	.= ' WHERE ' . $db->nameQuote( 'user_id' ) . '!=' . $db->Quote( 0 ) . ' '
						. 'AND a.' . $db->nameQuote( 'team_id' ) . '=' . $db->Quote( $id );
			}
		}

		$db->setQuery( $query );

		$result = $db->loadObjectList();

		if( !$result )
		{
		    return false;
		}

		$subscribers    = array();

		foreach( $result as $row )
		{
		    JTable::addIncludePath( EBLOG_TABLES );
		    $subscriber = EasyBlogHelper::getTable( 'Profile' , 'Table' );
		    $subscriber->load( $row->user_id );

		    $subscribers[]  = $subscriber;
		}

		return $subscribers;
	}

	public function getGuests()
	{
	    $id     = JRequest::getVar( 'id' );
	    $view	= JRequest::getVar( 'view' );
	    $db     = EasyBlogHelper::db();

		$blog		= EasyBlogHelper::getTable( 'Blog' );
		$blog->load( $id );
		$query		= '';

		if( $view == 'entry' )
		{
			$query	.= 'SELECT COUNT(1) FROM(';

			$query	.= 'SELECT a.`fullname` FROM ' . $db->nameQuote( '#__easyblog_post_subscription' ) . ' AS a '
					. 'WHERE a.' . $db->nameQuote( 'user_id' ) . '=' . $db->Quote( 0 ) . ' '
					. 'AND a.' . $db->nameQuote( 'post_id' ) . '=' . $db->Quote( $id );
		}

		if( $view == 'categories' || $view == 'entry' )
		{
			$cid		= $view == 'entry' ? $blog->category_id : $id;

			if( $view == 'entry' )
			{
				$query	.= ' UNION ';

				$query	.= 'SELECT a.`fullname` FROM ' . $db->nameQuote( '#__easyblog_category_subscription' ) . ' AS a '
						. 'WHERE a.' . $db->nameQuote( 'user_id' ) . '=' . $db->Quote( 0 ) . ' '
						. 'AND a.' . $db->nameQuote( 'category_id') . '=' . $db->Quote( $cid );
			}
			else
			{
				$query	.= 'SELECT COUNT(1) FROM ' . $db->nameQuote( '#__easyblog_category_subscription' ) . ' AS a '
						. 'WHERE a.' . $db->nameQuote( 'user_id' ) . '=' . $db->Quote( 0 ) . ' '
						. 'AND a.' . $db->nameQuote( 'category_id') . '=' . $db->Quote( $cid );
			}
		}

		if( $view == 'teamblog' || $view == 'entry')
		{
			if( $view == 'entry' )
			{
				$query	.= ' UNION ';
			}



			if( $view == 'entry' )
			{
				$query	.= 'SELECT a.`fullname` FROM ' . $db->nameQuote( '#__easyblog_team_subscription' ) . ' AS a '
						. ' INNER JOIN ' . $db->nameQuote( '#__easyblog_team_post' ) . ' AS c '
						. 'ON c.' . $db->nameQuote( 'team_id' ) . '=a.' . $db->nameQuote( 'team_id') . ' '
						. 'WHERE a.' . $db->nameQuote( 'user_id' ) . '=' . $db->Quote( 0 ) . ' '
						. 'AND c.' . $db->nameQuote( 'post_id' ) . '=' . $db->Quote( $id );
			}
			else
			{
				$query	.= 'SELECT COUNT(1) FROM ' . $db->nameQuote( '#__easyblog_team_subscription' ) . ' AS a '
						. ' WHERE ' . $db->nameQuote( 'user_id' ) . '=' . $db->Quote( 0 ) . ' '
						. 'AND a.' . $db->nameQuote( 'team_id' ) . '=' . $db->Quote( $id );
			}
		}

		if( $view == 'entry' )
		{
			$query	.= ') AS x';
		}

		$db->setQuery( $query );

		return (int) $db->loadResult();
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
