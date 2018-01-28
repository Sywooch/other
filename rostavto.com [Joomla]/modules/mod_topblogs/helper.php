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

class modTopBlogsHelper
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

		$categories	= $params->get( 'catid' );

		$query			= 'SELECT a.* , SUM( b.value ) AS ratings FROM ' . $db->nameQuote( '#__easyblog_post' ) . ' AS a '
						. 'LEFT JOIN ' . $db->nameQuote( '#__easyblog_ratings' ) . ' AS b '
						. 'ON a.id=b.uid '
						. 'AND b.type=' . $db->Quote( 'entry' ) . ' '
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
		$query .= 'AND a.' . $db->nameQuote('ispending') . '=' . $db->Quote('0') . ' ';
		$query .= 'GROUP BY b.uid ';
		$query .= 'ORDER BY ' . $db->nameQuote('ratings') . ' DESC ';

		if(!empty($count))
		{
			$query .= ' LIMIT ' . $count;
		}

		$db->setQuery( $query );
		$result		= $db->loadObjectList();

		$posts         = array();

		if(count($result) > 0)
		{
			for($i = 0; $i < count($result); $i++ )
			{
				$data 	=& $result[$i];
				$row 	= EasyBlogHelper::getTable( 'Blog', 'Table' );
				$row->bind( $data );

				// @rule: Before anything get's processed we need to format all the microblog posts first.
				if( !empty( $row->source ) )
				{
					EasyBlogHelper::formatMicroblog( $row );
				}

				$row->media = '';
				$isImage    = $row->getImage();
				if( empty( $row->source ) && empty( $isImage ) )
				{
					$row->media = EasyBlogModulesHelper::getMedia( $row , $params );
				}

				$author = EasyBlogHelper::getTable( 'Profile', 'Table' );
				$row->author		= $author->load( $row->created_by );

				$date		= EasyBlogDateHelper::dateWithOffSet($row->created);
				$row->date	= EasyBlogDateHelper::toFormat( $date , $config->get('layout_dateformat', '%A, %d %B %Y') );

				$requireVerification = false;
				if($config->get('main_password_protect', true) && !empty($row->blogpassword))
				{
					$row->title	= JText::sprintf('COM_EASYBLOG_PASSWORD_PROTECTED_BLOG_TITLE', $row->title);
					$requireVerification = true;
				}

				if($requireVerification && !EasyBlogHelper::verifyBlogPassword($row->blogpassword, $row->id))
				{
					$theme = new CodeThemes();
					$theme->set('id', $row->id);
					$theme->set('return', base64_encode(EasyBlogRouter::_('index.php?option=com_easyblog&view=entry&id='.$row->id)));
					$row->intro			= $theme->fetch( 'blog.protected.php' );
					$row->content		= $row->intro;
					$row->showRating	= false;
					$row->protect		= true;
				}
				else
				{

					// strip off media
					$row->intro			= EasyBlogHelper::getHelper( 'Videos' )->strip( $row->intro);
					$row->content		= EasyBlogHelper::getHelper( 'Videos' )->strip( $row->content);

					$row->intro			= EasyBlogHelper::getHelper( 'Gallery' )->strip( $row->intro);
					$row->content		= EasyBlogHelper::getHelper( 'Gallery' )->strip( $row->content);

					// Process jomsocial albums
					$row->intro			= EasyBlogHelper::getHelper( 'Album' )->strip( $row->intro );
					$row->content		= EasyBlogHelper::getHelper( 'Album' )->strip( $row->content );

					// @rule: Process audio files.
					$row->intro			= EasyBlogHelper::getHelper( 'Audio' )->strip( $row->intro );
					$row->content		= EasyBlogHelper::getHelper( 'Audio' )->strip( $row->content );


					$row->showRating	= true;
					$row->protect		= false;
				}


				// Determine what content to use
				$summary	= '';

				if( $params->get( 'showintro' ) == '0' && !empty( $row->intro ) )
				{
					$summary	= $row->intro;
				}
				else
				{
					$summary	= $row->content;

					// Module might configure the contents to be read from the main content. If the content has no read more,
					// we need to be intelligent enough to get from the intro.
					if( empty( $summary ) )
					{
						$summary	= $row->intro;
					}
				}

				if( $params->get( 'textcount') != 0 && JString::strlen( strip_tags( $summary ) ) > $params->get( 'textcount' ) )
				{
					$row->summary	= JString::substr( strip_tags( $summary ) , 0 , $params->get( 'textcount' ) ) . '...';
				}
				else
				{
					$row->summary	= $summary;
				}



				$posts[] = $row;
			}
		}

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
