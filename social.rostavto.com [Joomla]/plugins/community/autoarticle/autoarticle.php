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
jimport( 'joomla.filesystem.file' );
jimport( 'joomla.plugin.plugin' );

class plgEasyBlogAutoArticle extends JPlugin
{

    function plgEasyBlogAutoArticle(& $subject, $config)
    {
		if(JFile::exists(JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'helper.php'))
		{
			require_once (JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'helper.php');
		}

		if(JFile::exists(JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'router.php'))
		{
			require_once (JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'router.php');
		}
		parent::__construct($subject, $config);
    }

	/*
	 * Run some cleanup after a blog post is deleted
	 *
	 * @param   $blog   TableBlog   The blog table.
	 * @return  null
	 */
    function onAfterEasyBlogDelete( $blog )
    {
    	// Get plugin info
    	$plugin			= JPluginHelper::getPlugin('easyblog', 'autoarticle');
    	$pluginParams 	= EasyBlogHelper::getRegistry( $plugin->params );

    	if( $pluginParams->get('unpublish') == '1' )
    	{
	        $db     = EasyBlogHelper::db();
	        $query  = 'SELECT * FROM #__easyblog_autoarticle_map WHERE `post_id`=' . $db->Quote( $blog->id );
	        $db->setQuery( $query );
	        $map	= $db->loadObject();

			if( $map )
			{
		        $query  = 'UPDATE #__content SET `state`=' . $db->Quote( 0 ) . ' '
		                . 'WHERE `id`=' . $db->Quote( $map->content_id );
				$db->setQuery( $query );
				$db->Query();

		        $query  = 'DELETE FROM #__content_frontpage '
		                . 'WHERE `content_id`=' . $db->Quote( $map->content_id );
				$db->setQuery( $query );
				$db->Query();
			}
		}
	}

    function onAfterEasyBlogSave ( $param, $isNew )
    {
		$db		= EasyBlogHelper::db();
		$user   = JFactory::getUser();

    	// Get plugin info
    	$plugin			= JPluginHelper::getPlugin('easyblog', 'autoarticle');
    	$pluginParams 	= EasyBlogHelper::getRegistry( $plugin->params );

        // easyblog blog details
		$data   = array();
		$data['title'] 			= $param->title;
		$data['alias'] 			= ( empty( $param->permalink ) ) ? EasyBlogHelper::getPermalink( $param->title ) : $param->permalink;


		if(empty($param->intro))
		{
			$data['introtext']		= $param->content;
			$data['fulltext']		= '';
		}
		else
		{
			$data['introtext']		= $param->intro;
			$data['fulltext']		= $param->content;
		}


		$EasyBlogitemId     = EasyBlogRouter::getItemId( 'latest' );
		$readmoreURL   		= EasyBlogRouter::_( 'index.php?option=com_easyblog&view=entry&id=' . $param->id . '&Itemid=' . $EasyBlogitemId);
		$readmoreURL 		= str_replace('/administrator/', '/', $readmoreURL);

		$readmoreLink       = '<a href="' . $readmoreURL . '" class="readon"><span>' . JText::_( 'Read More' ) . '</span></a>';
		$data['introtext']  = $data['introtext'] . '<br />' . $readmoreLink;

		$data['created']		= $param->created;
		$data['created_by']		= $param->created_by;
		$data['modified']		= $param->modified;
		$data['modified_by']	= $user->id;
		$data['publish_up']		= $param->publish_up;
		$data['publish_down']	= $param->publish_down;

		//these four get from plugin params
		$state		= $pluginParams->get('status');
		$access		= ( EasyBlogHelper::getJoomlaVersion() >= '1.6' ) ? 1 : 0;

		if( EasyBlogHelper::getJoomlaVersion() >= '1.6' )
		{
			if($pluginParams->get('access', '-1') == '-1')
			{
				$access = ( $param->private ) ? 2 : 1;
			}
			else
			{
				$tmpAccess  = $pluginParams->get('access');
				switch( $tmpAccess )
				{
					case '1':
						$access = '2';
						break;
					case '2':
						$access = '3';
						break;
					case '0':
					default:
						$access = '1';
						break;
				}

			}
		}
		else
		{
			$access = ($pluginParams->get('access', '-1') == '-1') ? $param->private : $pluginParams->get('access');
		}

		$section			= '0';
		$category			= $pluginParams->get('sectionCategory', '0');
		$frontpage			= ($pluginParams->get('frontpage', '-1') == '-1') ? $param->frontpage : $pluginParams->get('frontpage', '0');
		$autoMapCategory    = $pluginParams->get('autocategory', '0');

		if( EasyBlogHelper::getJoomlaVersion() <= '1.5' )
		{
			//get joomla section
			$query	= 'SELECT s.id';
			$query	.= ' FROM #__categories AS cc';
			$query	.= ' INNER JOIN #__sections AS s ON s.id = cc.section ';
			$query  .= ' AND cc.`id` = ' . $db->Quote($category);
			$db->setQuery($query);

			$section    = $db->loadResult();
			if(empty($section))
			{
			    $section	= '0';
			    $category	= '0';
			}
		}


		if( $autoMapCategory )
		{
			$autoMapped = self::mapCategory( $param->category_id );

			if( EasyBlogHelper::getJoomlaVersion() <= '1.5' )
			{
				if( !empty($autoMapped->sid) && !empty($autoMapped->cid) )
				{
				    $section	= $autoMapped->sid;
				    $category	= $autoMapped->cid;
				}
			}
			else
			{
				if( !empty($autoMapped->cid) )
				{
				    $category	= $autoMapped->cid;
				}
			}

		}

		$data['state']		= $state;
		$data['access']		= $access;
		$data['sectionid']	= $section;
		$data['catid']		= $category;

		$data['metakey']	= JRequest::getVar('keywords', '');;
		$data['metadesc']	= JRequest::getVar('description', '');

		$contentMap 	= EasyBlogHelper::getTable( 'AutoArticleMap' );
		$joomlaContent 	= JTable::getInstance('content');

		$aid    = '';

		// try to get the existing content id via the mapping table
		$contentMap->load( $param->id, true);

		if( !empty($contentMap->content_id) )
		    $aid    = $contentMap->content_id;

		if( empty($aid) && !empty( $param->permalink ) )
		{
			//try to get if the article already inserted before based on title alias.
			$query  = 'SELECT `id` FROM `#__content` WHERE `alias` = ' . $db->Quote($param->permalink);
			$db->setQuery($query);
			$aid = $db->loadResult();
		}

		if(! empty($aid))
		    $joomlaContent->load($aid);

		$joomlaContent->bind($data);

		if( EasyBlogHelper::getJoomlaVersion() >= '1.6' )
		{
			// Convert the params field to an array.
			$registry = new JRegistry;
			// $registry->loadJSON($joomlaContent->attribs);
			$joomlaContent->attribs = $registry->toArray();
		}


		$joomlaContent->store();
        $articleId  = $joomlaContent->id;

		if( is_null( $isNew ) )
		{
		    // something wrong here. test the aid to determine.
		    if( empty( $aid ) )
		    {
		        $isNew = true;
		    }
		    else
		    {
		        $isNew  = false;
		    }
		}


        if( $isNew && !empty( $articleId ) )
        {
			// if saved ok, then insert the mapping into our map table.
			$jdate 	= EasyBlogHelper::getDate();
			$map    = array();
			$map['content_id']  =   $articleId;
			$map['post_id']  	=   $param->id;
			$map['created']  	=   $jdate->toMySQL();

			$contentMap->bind($map);
			$contentMap->store();
		}

		if( $isNew )
		{
			if( EasyBlogHelper::getJoomlaVersion() <= '1.5' )
			{
				//save the article here to get the contentid
				require_once (JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_frontpage' . DIRECTORY_SEPARATOR . 'tables' . DIRECTORY_SEPARATOR . 'frontpage.php');
				$fp = new TableFrontPage($db);

				if($frontpage)
				{
					// Is the item already viewable on the frontpage?
					if (!$fp->load($articleId))
					{
						// Insert the new entry
						$query = 'INSERT INTO #__content_frontpage' .
								' VALUES ( '. (int) $articleId .', 1 )';
						$db->setQuery($query);
						if (!$db->query())
						{
							JError::raiseError( 500, $db->stderr() );
							return false;
						}
						$fp->ordering = 1;
					}
				}
				else
				{
					// Delete the item from frontpage if it exists
					if (!$fp->delete($articleId)) {
						$msg .= $fp->stderr();
					}
					$fp->ordering = 0;
				}
				$fp->reorder();
			}
			else
			{

				if($frontpage)
				{
	                //$table = $this->getTable('Featured', 'ContentTable');
	                require_once (JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_content' . DIRECTORY_SEPARATOR . 'tables' . DIRECTORY_SEPARATOR . 'featured.php');
	                $table = new ContentTableFeatured($db);

					// Insert the new entry
					$query = 'INSERT INTO #__content_frontpage' .
							' VALUES ( '. (int) $articleId .', 1 )';
					$db->setQuery($query);
					$db->query();

					$table->reorder();
				}
			}
		}

		$cache = JFactory::getCache('com_content');
		$cache->clean();
    }

	function mapCategory( $eb_catid )
	{
		$db     = EasyBlogHelper::db();

		$data   = new stdClass();
		$data->sid    = '0';
		$data->cid    = '0';

		$category	= EasyBlogHelper::getTable( 'Category' , 'Table' );
		$category->load($eb_catid);

		if( EasyBlogHelper::getJoomlaVersion() <= '1.5' )
		{
			//get joomla section
			$query	= 'SELECT cc.id as `catid`, s.id as `sectionid`';
			$query	.= ' FROM #__categories AS cc';
			$query	.= ' INNER JOIN #__sections AS s ON s.id = cc.section ';
			$query  .= ' AND cc.`title` = ' . $db->Quote($category->title);
			$db->setQuery($query);

			$section    = $db->loadObject();
			if( count($section) > 0)
			{
			    $data->sid	= $section->sectionid;
			    $data->cid	= $section->catid;
			}
		}
		else
		{
			//get joomla section
			$query	= 'SELECT cc.id as `catid`';
			$query	.= ' FROM #__categories AS cc';
			$query  .= ' WHERE cc.`title` = ' . $db->Quote($category->title);
			$db->setQuery($query);

			$section    = $db->loadObject();
			if( count($section) > 0)
			{
			    $data->cid	= $section->catid;
			}
		}

		return $data;
	}


}
