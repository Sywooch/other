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

class modImageWallHelper
{
	public function getPosts( &$params )
	{
		$config			= EasyBlogHelper::getConfig();
		$count			= (int) $params->get( 'count' , 0 );

		// Retrieve the model from the component.
		$model 	= EasyBlogHelper::getModel( 'Blog' );

		$categories	= trim( $params->get( 'catid' ) );
		$type		= !empty( $categories ) ? 'category' : '';

		if( !empty( $categories ) )
		{
			$categories = explode( ',' , $categories );
		}

		$sorting = array();

		$sorting[] = $params->get( 'sorting', 'latest' );
		$sorting[] = $params->get( 'ordering', 'desc' );

		$rows		= $model->getBlogsBy( $type , $categories , $sorting , $count , EBLOG_FILTER_PUBLISHED, null, false);
		$posts		= array();

		// Retreive settings from params
		$maxWidth	= $params->get( 'imagewidth' , 300 );
		$maxHeight	= $params->get( 'imageheight', 200 );


		for($i = 0; $i < count($rows); $i++)
		{

			$data 	=& $rows[$i];
			$row 	= EasyBlogHelper::getTable( 'Blog', 'Table' );
			$row->bind( $data );

			$row->media  = '';

			$imageurl    = $row->getImage();

			if( ! empty( $imageurl ) )
			{
				$media		=	$row->getImage()->getSource( 'module' );
				$imgHtml    = '<img title="'.$row->title.'" src="' . $media . '" style="width: '. $maxWidth . 'px !important;height: '. $maxHeight . 'px !important;" />';
				$row->media = $imgHtml;
			}
			else
			{

				$image = self::getImage( $row->intro . $row->content );

				if( $image !== false )
				{
					// TODO: Here's where we need to crop the image based on the cropping ratio provided in the params.
					// Currently this is just a lame hack to fix the width and height

					$pattern	= '/<\s*img [^\>]*src\s*=\s*[\""\']?([^\""\'>]*)/i';
					preg_match( $pattern , $image , $matches );

					$imageurl		= '';

					if( $matches )
					{
						$imageurl		= isset( $matches[1] ) ? $matches[1] : '';
					}

					if( !empty($imageurl) )
					{
						$imgHtml    = '<img title="'.$row->title.'" src="' . $imageurl . '" style="width: '. $maxWidth . 'px !important;height: '. $maxHeight . 'px !important;" />';
						$row->media = $imgHtml;
					}
					else
					{
						$row->media	= str_ireplace( 'src=' , ' style="width: '. $maxWidth . 'px !important;height: '. $maxHeight . 'px !important;" src=' , $image );
					}

				}
			}

			if( !empty ( $row->media ) )
			{
				$posts[]	= $row;
			}
		}

		return $posts;
	}

	/**
	 * Retrieves the first image from the post
	 *
	 * @param	string $content This is the content of the blog.
	 * @return	mixed Image element on success, false otherwise.
	 */
	public function getImage( $content )
	{
		$pattern				= '#<img[^>]*>#i';

		preg_match( $pattern , $content , $matches );

		if( isset( $matches[0] ) )
		{
			return $matches[ 0 ];
		}

		return false;
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
