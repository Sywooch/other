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
require_once(JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'modules.php');
require_once(JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'easysimpleimage.php');
jimport('joomla.system.file');
jimport('joomla.system.folder');

class modEasyBlogPostMapHelper
{
	function getPosts(&$params)
	{
		$db 			= EasyBlogHelper::db();
		$config			= EasyBlogHelper::getConfig();
		$type			= $params->get( 'type' );
		$posts			= '';

		$query  = 'SELECT * FROM ' . $db->nameQuote( '#__easyblog_post' );

		// select valid latitude/longitude or address

		$query .= ' WHERE ((TRIM(' . $db->nameQuote( 'latitude' ) . ') <> ' . $db->quote( '' ) . ' AND TRIM(' . $db->nameQuote( 'longitude' ) . ') <> ' . $db->quote( '' ) . ')';
		$query .= ' OR TRIM(' . $db->nameQuote( 'address' ) . ') <> ' . $db->quote( '' ) . ')';

		/*$query .= ' WHERE ((TRIM(' . $db->nameQuote( 'latitude' ) . ') IS NOT NULL AND TRIM(' . $db->nameQuote( 'longitude' ) . ') IS NOT NULL)';
		$query .= ' OR TRIM(' . $db->nameQuote( 'address' ) . ') IS NOT NULL)';*/

		// select published post
		$query .= ' AND ' . $db->nameQuote( 'published' ) . ' = ' . $db->quote( '1' );

		if( EasyBlogHelper::getJoomlaVersion() >= '1.6' )
		{
			// @rule: When language filter is enabled, we need to detect the appropriate contents
			$filterLanguage 	= JFactory::getApplication()->getLanguageFilter();

			if( $filterLanguage )
			{
				$query	.= ' AND (';
				$query	.= ' `language`=' . $db->Quote( JFactory::getLanguage()->getTag() );
				$query	.= ' OR `language`=' . $db->Quote( '' );
				$query	.= ' )';
			}
		}


		switch( $type )
		{
			case '1' :
				// by blogger
				$bloggers = self::join( $params->get( 'bloggerid' ) );

				if( !empty( $bloggers ) )
				{
					$query .= ' AND ' . $db->nameQuote( 'created_by' ) . ' IN (' . $bloggers . ')';
				}
				break;
			case '2' :
				// by category
				$categories = self::join( $params->get( 'categoryid' ) );

				if( !empty( $categories ) )
				{
					$query .= ' AND ' . $db->nameQuote( 'category_id' ) . ' IN (' . $categories . ')';
				}
				break;

			case '3' :
				// by tag
				$tags = self::join( $params->get( 'tagid' ) );
				$post_ids = self::join( self::getTagPost( $tags ) );

				if( !empty( $post_ids ) )
				{
					$query .= ' AND ' . $db->nameQuote( 'id' ) . ' IN (' . $post_ids . ')';
				}

				break;

			case '4' :
				// by team
				$teams = self::join( $params->get( 'teamids' ) );
				$post_ids = self::join( self::getTeamPost( $teams ) );

				if( !empty( $post_ids ) )
				{
					$query .= ' AND ' . $db->nameQuote( 'id' ) . ' IN (' . $post_ids . ')';
				}

				break;

			case '0' :
			default:
				// by latest
				$featured = $params->get( 'usefeatured' );

				if( $featured )
				{
					$post_ids = self::join( self::getFeaturedPost() );

					if( !empty( $post_ids ) )
					{
						$query .= ' AND ' . $db->nameQuote( 'id' ) . ' IN (' . $post_ids . ')';
					}
				}
				break;
		}

		// always sort by latest
		$query .= ' ORDER BY ' . $db->nameQuote( 'created' ) . ' DESC';

		// set limit
		$query .= ' LIMIT ' . (int) $params->get( 'count' , 5 );

		$db->setQuery( $query );
		$posts = $db->loadObjectList();

		$posts = self::processItems( $posts, $params );
		return $posts;
	}

	private function processItems( $posts, &$params )
	{
		$config = EasyBlogHelper::getConfig();
		$total = count($posts);

		$results = array();

		for($i = 0; $i < count($posts); $i++ )
		{

			$data 	=& $posts[$i];
			$row 	= EasyBlogHelper::getTable( 'Blog', 'Table' );
			$row->bind( $data );


			$row->commentCount 	= EasyBlogHelper::getCommentCount($row->id);

			JTable::addIncludePath( EBLOG_TABLES );
			$author 			= EasyBlogHelper::getTable( 'Profile', 'Table' );
			$row->author		= $author->load( $row->created_by );
			$row->date			= EasyBlogDateHelper::toFormat( EasyBlogHelper::getDate( $row->created ) , '%d %B %Y' );

			$row->featuredImage = '';
			if($params->get( 'showfeatureimage' , 1 ))
			{
				$row->featuredImage = self::getFeaturedImage( $row , $params );
			}

			self::prepareTooltipContent( $row, $params );
			$results[] = $row;
		}

		return $results;
	}

	private function prepareTooltipContent( &$post, &$params )
	{
		$image		= '<td class="ebpostmap_featuredImage"';
		if( $params->get( 'showavatar' ) )
		{
			$image .= ' colspan = "2"';
		}
		$image		.= '>'.$post->featuredImage.'</td>'."\n";

		$author 	= EasyBlogHelper::getTable( 'Profile' );
		$author->load( $post->created_by );
		$avatar		= '<td class="ebpostmap_avatar" valign="top"><a href="'.$post->author->getProfileLink().'" class="mod-avatar"><img class="avatar" src="'.$author->getAvatar().'" /></a></td>'."\n";

		if( $params->get( 'enableratings' ) )
		{
			$disable = false;
		}
		else
		{
			$disabled = true;
		}

		$menuItemId = self::_getMenuItemId($post, $params);
		$link		= EasyBlogRouter::_( 'index.php?option=com_easyblog&view=entry&id=' . $post->id . $menuItemId );
		$title		= '<div class="ebpostmap_title"><a href="'.$link.'"><b>'.$post->title.'</b></a></div>'."\n";
		$blogger	= '<div class="ebpostmap_blogger">'.JText::sprintf( 'MOD_EASYBLOGPOSTMAP_POST_BY', $post->author->getName() ).'</div>'."\n";
		$address	= '<div class="ebpostmap_address">'.JText::sprintf( 'MOD_EASYBLOGPOSTMAP_ADDRESS_AT', $post->address ).'</div>'."\n";
		$ratings	= '<div class="ebpostmap_ratings">'.EasyBlogHelper::getHelper( 'ratings' )->getHTML( $post->id, 'entry', '',  'ebpostmap_'.$post->id.'-ratings', $disabled ).'</div>'."\n";
		$hits		= '<div class="ebpostmap_hits">'.JText::sprintf( 'MOD_EASYBLOGPOSTMAP_HITS', $post->hits ).'</div>'."\n";
		$comment	= '<div class="ebpostmap_comments">'.JText::sprintf( 'MOD_EASYBLOGPOSTMAP_TOTAL_COMMENTS', $post->commentCount ).'</div>'."\n";

		$post->html = '<div class="ebpostmap_infoWindow"><table>'."\n";

		if( $params->get( 'showfeatureimage' ) && $post->featuredImage )
		{
			$post->html .= '<tr>' . $image . '</tr>'."\n";
		}

		$post->html .= '<tr>';

		if( $params->get( 'showavatar' ) )
		{
			$post->html .= $avatar;
		}

		$post->html .= '<td class="ebpostmap_detail">';

		$post->html .= $title;

		if( $params->get( 'showauthor' ) )
		{
			$post->html .= $blogger;
		}

		if( $params->get( 'showaddress' ) )
		{
			$post->html .= $address;
		}

		if( $params->get( 'showcommentcount' ) )
		{
			$post->html .= $comment;
		}

		if( $params->get( 'showhits' ) )
		{
			$post->html .= $hits;
		}

		if( $params->get( 'showratings' ) )
		{
			$post->html .= $ratings;
		}

		$post->html .= '</td></tr></div>'."\n";
	}

	private function getFeaturedImage( &$row , &$params )
	{
		$image      = '';
		$isImage    = $row->getImage();
		if( ! empty( $isImage ) )
		{
			$imagesrc   = $row->getImage()->getSource('small');
			$image    = '<img title="'.$row->title.'" src="' . $imagesrc . '" />';
		}
		else
		{
			$image = EasyBlogModulesHelper::getMedia( $row , $params );
		}

		return $image;
	}

	private function getFeaturedImageOld( &$row , &$params )
	{
		$pattern	= '#<img class="featured"[^>]*>#i';
		$content	= $row->intro . $row->content;

		preg_match( $pattern , $content , $matches );

		if( isset( $matches[0] ) )
		{
			// return self::getResizedImage($matches[0] , $params );
			return self::getThumbnailImage( $matches[0] );
		}

		// If featured image is not supplied, try to use the first image as the featured post.
		$pattern				= '#<img[^>]*>#i';

		preg_match( $pattern , $content , $matches );

		if( isset( $matches[0] ) )
		{
			// After extracting the image, remove that image from the post.
			$row->intro		= str_ireplace( $matches[0] , '' , $row->intro );
			$row->content	= str_ireplace( $matches[0] , '' , $row->intro );

			return self::getThumbnailImage( $matches[0] );
		}

		// If all else fail, try to use the default image
		return false;
	}

	private function getThumbnailImage($img)
	{
		$srcpattern = '/src=".*?"/';

		preg_match( $srcpattern , $img , $src );

		if(isset($src[0]))
		{
			$imagepath	= trim(str_ireplace('src=', '', $src[0]) , '"');
			$segment 	= explode('/', $imagepath);
			$file 		= end($segment);
			$thumbnailpath = str_ireplace($file, 'thumb_'.$file, implode('/', $segment));

			if(!JFile::exists($thumbnailpath))
			{
				$image = new EasySimpleImage();
				$image->load($imagepath);
				$image->resize(64, 64);
				$image->save($thumbnailpath);
			}

			if( stristr($thumbnailpath, rtrim( JURI::root(), '/' ) ) === false )
			{
				$thumbnailpath = JURI::root() . ltrim( $thumbnailpath, '/' );
			}

			$newSrc = 'src="'.$thumbnailpath.'"';
		}
		else
		{
			return false;
		}

		$oldAttributes = array('src'=>$srcpattern, 'width'=>'/width=".*?"/', 'height'=>'/height=".*?"/');
		$newAttributes = array('src'=>$newSrc, 'width'=>'', 'height'=>'');

		return preg_replace($oldAttributes, $newAttributes, $img);
	}


	private function getFeaturedPost()
	{
		$db = EasyBlogHelper::db();

		$query  = 'SELECT ' . $db->nameQuote( 'content_id' ) . ' FROM ' . $db->nameQuote( '#__easyblog_featured' );
		$query .= ' WHERE ' . $db->nameQuote( 'type' ) . ' = ' . $db->quote( 'post' );

		$db->setQuery( $query );

		$post_ids = $db->loadResultArray();
		return $post_ids;
	}

	private function getTagPost($tagid)
	{
		$db = EasyBlogHelper::db();

		$query  = 'SELECT ' . $db->nameQuote( 'post_id' ) . ' FROM ' . $db->nameQuote( '#__easyblog_post_tag' );
		$query .= ' WHERE ' . $db->nameQuote( 'tag_id' ) . ' IN (' . $tagid . ')';

		$db->setQuery( $query );

		$post_ids = $db->loadResultArray();
		return $post_ids;
	}

	private function getTeamPost($teamid)
	{
		$db = EasyBlogHelper::db();

		$query  = 'SELECT ' . $db->nameQuote( 'post_id' ) . ' FROM ' . $db->nameQuote( '#__easyblog_team_post' );
		$query .= ' WHERE ' . $db->nameQuote( 'team_id' ) . ' IN (' . $db->quote( $teamid ) . ')';

		$db->setQuery( $query );

		$post_ids = $db->loadResultArray();
		return $post_ids;
	}

	private	function _getMenuItemId( $post, &$params)
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

	private function join($items)
	{
		$db = EasyBlogHelper::db();

		if( !is_array($items) )
		{
			$items = str_replace(' ', '', $items);
			$items = explode(',', $items);
		}

		$temp = '';

		foreach( $items as $item )
		{
			$temp[] = $db->quote( $item );
		}

		$result = implode(',', $temp);

		return $result;
	}

	public static function sortLocation( $items )
	{
		usort( $items, array( 'modEasyBlogPostMapSorter', 'latitudesort' ) );
		usort( $items, array( 'modEasyBlogPostMapSorter', 'longitudesort' ) );
		return $items;
	}

	public static function sameLocation( $a, $b )
	{
		return ( $a->latitude == $b->latitude && $a->longitude == $b->longitude );
	}
}

class modEasyBlogPostMapSorter
{
	// sort by location first
	static function customsort( $a, $b, $field )
	{
		if( $a->$field == $b->$field )
		{
			return 0;
		}

		return ( $a->$field > $b->$field ) ? -1 : 1;
	}

	function latitudesort( $a, $b )
	{
		return self::customsort( $a, $b, 'latitude' );
	}

	function longitudesort( $a, $b )
	{
		return self::customsort( $a, $b, 'longitude' );
	}
}
