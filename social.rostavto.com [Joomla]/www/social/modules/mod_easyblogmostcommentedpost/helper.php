<?php
/*
 * @package		mod_easyblogmostcommentedpost
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

require_once( JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'constants.php' );
require_once( EBLOG_HELPERS . DIRECTORY_SEPARATOR . 'helper.php' );

class modEasyBlogMostCommentedPostHelper
{
	function getMostCommentedPost(&$params)
	{
		$mainframe	= JFactory::getApplication();
		$db         = EasyBlogHelper::db();
		$my         = JFactory::getUser();

		$config     	= EasyBlogHelper::getConfig();
		$count			= (INT)trim($params->get('count', 0));
		$categories		= $params->get( 'catid' );

		if( !empty( $categories ) )
		{
			$categories		= explode( ',' , $categories );
		}

		$showprivate	= $params->get('showprivate', true);
		$showcomment	= $params->get('showlatestcomment', true);

	    $queryExclude   = '';
		$excludeCats	= array();

	    //get teamblogs id.
	    if( $config->get( 'main_includeteamblogpost' ) )
	    {
			$teamBlogIds	= EasyBlogHelper::getViewableTeamIds();
			if( count( $teamBlogIds ) > 0 )
            	$teamBlogIds    = implode( ',' , $teamBlogIds);
	    }


		// get all private categories id
	    $excludeCats	= EasyBlogHelper::getPrivateCategories();

		if(! empty($excludeCats))
		{
		    $queryExclude .= ' AND a.`category_id` NOT IN (' . implode(',', $excludeCats) . ')';
		}


		//$query  = 'SELECT a.`id`, a.`title`, a.`intro`, a.`content`, a.`permalink`, a.`hits`, a.`created_by`, a.`created`, count(b.`id`) as `comment_count`, a.`blogpassword`, a.`category_id`';
		$query  = 'SELECT a.*, count(b.`id`) as `comment_count`';
		if($showcomment)
			$query	.= ', c.`id` as `comment_id`, c.`comment`, c.`created_by` as `commentor`, c.`title` as `comment_title`, c.`name` as `commentor_name`';

		if($config->get( 'main_includeteamblogpost' ) && !empty($teamBlogIds) )
			$query  .= ' ,u.`team_id`';

		$query	.= ' FROM `#__easyblog_post` AS a';
		$query	.= '  LEFT JOIN `#__easyblog_comment` AS b ON a.`id` = b.`post_id`';
		if($showcomment)
		{
			$query	.= '  LEFT JOIN `#__easyblog_comment` AS c ON a.`id` = c.`post_id`';
			$query	.= '    AND c.`id` = (SELECT MAX(d.`id`) FROM `#__easyblog_comment` AS d WHERE c.`post_id` = d.`post_id`)';
		}

		if($config->get( 'main_includeteamblogpost' ) && !empty($teamBlogIds) )
		{
		    $query  .= ' LEFT JOIN `#__easyblog_team_post` AS u ON a.id = u.post_id';
		}


		$query	.= ' WHERE a.`published` = ' . $db->Quote('1');

	    if( $config->get( 'main_includeteamblogpost' ) && !empty($teamBlogIds))
	    {
			$query	.= ' AND (u.team_id IN ('.$teamBlogIds.') OR a.`issitewide` = ' . $db->Quote('1') . ')';
		}
		else
		{
		    $query	.= ' AND a.`issitewide` = ' . $db->Quote('1');
		}

		if(! $showprivate)
		    $query .= ' AND a.`private` = ' . $db->Quote('0');


		// Respect inclusion categories
		if( !empty( $categories ) )
		{
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


		$query	.= $queryExclude;
		$query	.= ' GROUP BY a.`id`';
		$query	.= ' HAVING (`comment_count` > 0)';
		$query	.= ' ORDER BY `comment_count` DESC';

		if($count > 0)
			$query  .= ' LIMIT ' . $count;


		$db->setQuery($query);

		$posts   = $db->loadObjectList();

		$result         = array();
		if( count($posts) > 0 )
		{
			for($i = 0; $i < count($posts); $i++ )
			{
				$data 	=& $posts[$i];
				$row 	= EasyBlogHelper::getTable( 'Blog', 'Table' );
				$row->bind( $data );

				$row->comment_id	= isset( $data->comment_id ) ? $data->comment_id : '';
				$row->comment    	= isset( $data->comment ) ? $data->comment : '';
				$row->commentor    	= isset( $data->commentor ) ? $data->commentor : '0';
				$row->comment_title	= isset( $data->comment_title ) ? $data->comment_title : '';
				$row->commentor_name	= isset( $data->commentor_name ) ? $data->commentor_name : '';

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


				if($params->get('showlatestcomment', true))
				{
					if( $row->commentor != 0 )
					{
						$commentor	= EasyBlogHelper::getTable( 'Profile', 'Table' );
						$commentor->load( $row->commentor );

						$row->commentor		= $commentor;
					}
					else
					{
						$obj    = new stdClass();
						$obj->id = '0';
						$obj->nickname = ( !empty ( $row->commentor_name ) ) ? $row->commentor_name : JText::_( 'COM_EASYBLOG_GUEST' );

						$commentor	= EasyBlogHelper::getTable( 'Profile', 'Table' );
						$commentor->bind($obj);

						$row->commentor		= $commentor;
					}
				}

				$author = EasyBlogHelper::getTable( 'Profile', 'Table' );
				$row->author		= $author->load( $row->created_by );
				$row->comment_count = EasyBlogHelper::getCommentCount($row->id);
				$row->date			= EasyBlogDateHelper::toFormat( EasyBlogHelper::getDate( $row->created ) , $params->get( 'dateformat' , '%d %B %Y' ) );

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

				$result[]   = $row;

			}//end for
		}



		return $result;
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
