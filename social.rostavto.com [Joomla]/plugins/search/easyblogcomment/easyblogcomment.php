<?php
/**
* @package		Eblog
* @copyright	Copyright (C) 2010 Stack Ideas Private Limited. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Eblog is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Restricted access');

require_once( JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'constants.php' );
require_once( JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'helper.php' );

if(EasyBlogHelper::getJoomlaVersion() < '1.6')
{
    JPlugin::loadLanguage( 'plg_search_easyblog_comment' );
}

class plgSearchEasyblogComment extends JPlugin
{
	function plgSearchEasyblogComment( &$subject, $params )
	{
		parent::__construct( $subject, $params );
	}
	
	//joomla 1.5
	function onSearchAreas()
	{
		return plgSearchEasyblogComment::getAreas();
	}
	
	//joomla 1.6
	function onContentSearchAreas()
	{
		return plgSearchEasyblogComment::getAreas();
	}
	
	//joomla 1.5
	function onSearch( $text, $phrase='', $ordering='', $areas=null )
	{
	 	return plgSearchEasyblogComment::commentSearch( $text, $phrase, $ordering, $areas );
	}
	
	//joomla 1.6
	function onContentSearch( $text, $phrase='', $ordering='', $areas=null )
	{
		return plgSearchEasyblogComment::commentSearch( $text, $phrase, $ordering, $areas );
	}
	
	function getAreas()
	{
		JFactory::getLanguage()->load( 'com_easyblog' , JPATH_ROOT );

		$areas = array( 'comments' => JText::_( 'PLG_EASYBLOG_SEARCH_COMMENTS' ) );
		
		return $areas;
	}
	
	function exists()
	{
		$path	= JPATH_ROOT . DIRECTORY_SEPARATOR . 'administrator' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'easyblog.xml';
		
		jimport( 'joomla.filesystem.file' );
		return JFile::exists( $path );		
	}
	
	function commentSearch( $text, $phrase='', $ordering='', $areas=null )
	{
	 	$plugin	= JPluginHelper::getPlugin('search', 'easyblogcomment');
	 	$params 	= EasyBlogHelper::getRegistry( $plugin->params );
	 	
		if( !plgSearchEasyblogComment::exists() )
		{
			return array();
		}
		
		if (is_array( $areas )) {
			if (!array_intersect( $areas, array_keys( plgSearchEasyblogComment::getAreas() ) )) {
				return array();
			}
		}
		
		$text = trim( $text );
		if ($text == '') {
			return array();
		}

		$result	= plgSearchEasyblogComment::getResult( $text , $phrase );

		if( !$result )
			return array();

		require_once( EBLOG_HELPERS . DS . 'router.php' );
		
		$mainframe	= JFactory::getApplication();
		$limit		= ($mainframe->getCfg('list_limit') == 0) ? 5 : $mainframe->getCfg('list_limit');
		
		for( $i = 0; $i < count($result); $i++)
		{
		    $row    =& $result[ $i ];
		
			$post 	= EasyBlogHelper::getTable( 'Blog' );
			$post->load($row->post_id);
			
			$link = $params->get('link', '1');
			
			//check if link to comment or link to post
			if($link)
			{
				$comments = plgSearchEasyblogComment::getAllComments($row->post_id);
				$total = count($comments);
				$limitstart	= 0;
				
				if( $total > 0)
				{
				$counter = 0;
				while($comments[$counter]->id != $row->id)
				{
					$counter++;
				}
				
					$limitstart = floor($counter / $limit) * $limit;
				}					
								
				$limitstart	= $limitstart ? '&limitstart=' . $limitstart : '';	
				$row->href	= EasyBlogRouter::getEntryRoute( $row->post_id ).$limitstart.'#comments';
			}
			else
			{
				$row->href		= EasyBlogRouter::getEntryRoute( $row->post_id ).'#comments';
			}
			
			$row->section	= JText::sprintf( 'PLG_EASYBLOG_SEARCH_COMMENTS_SECTION', $post->title);
			
			if( empty($row->title) )
			{
				$row->title	= JString::substr( $row->comment, 0, 30 ) . '...';
			}
		}
		
		return $result;
	}
	
	function getResult( $text , $phrase)
	{
		$db		= JFactory::getDBO();
		$where	= array();

		switch ($phrase)
		{
			case 'exact':
				$where[]	= 'title LIKE ' . $db->Quote( '%'.$db->getEscaped( $text, true ).'%', false );
				$where[]	= 'comment LIKE ' . $db->Quote( '%'.$db->getEscaped( $text, true ).'%', false );
				
				$where 		= '(' . implode( ') OR (', $where ) . ')';
				break;
			case 'all':
			case 'any':
			default:
				$words		= explode( ' ', $text );
				$wheres		= array();
				
				foreach ($words as $word)
				{
					$word		= $db->Quote( '%'.$db->getEscaped( $word, true ).'%', false );
					
					$where[]	= 'title LIKE ' . $word;
					$where[]	= 'comment LIKE ' . $word;
					$wheres[] 	= implode( ' OR ', $where );					
				}
				$where = '(' . implode( ($phrase == 'all' ? ') AND (' : ') OR ('), $wheres ) . ')';
				break;
		}
	
		$query	= 'SELECT *, `comment` AS text, "2" as browsernav '
				. 'FROM #__easyblog_comment '
				. 'WHERE ' . $where . ' '
				. 'AND `published`=' . $db->Quote( 1 );

		$db->setQuery( $query );
		return $db->loadObjectList();
	}
	
	function getAllComments($blogId)
	{
		$db	= JFactory::getDBO();
		
		$query  = '';
		
		$query	= 'SELECT a.*, (count(b.id) - 1) AS `depth` FROM `#__easyblog_comment` a,';
		$query	.= ' `#__easyblog_comment` b'; 
		$query	.= ' WHERE a.`post_id` = '.$db->Quote($blogId);
		$query	.= ' AND b.`post_id` = '.$db->Quote($blogId);
		$query	.= ' AND a.`published` = 1';
		$query	.= ' AND b.`published` = 1';
		$query	.= ' AND a.`lft` BETWEEN b.`lft` AND b.`rgt`';
		$query	.= ' GROUP BY a.`id`';
		
		// prepare the query to get total comment
		$queryTotal  	= 'SELECT COUNT(1) FROM (';
		$queryTotal		.= $query;
		$queryTotal		.= ') AS x';
		
		$query	.= ' ORDER BY a.`lft`';
		
		$db->setQuery( $queryTotal );
		$this->_total	= $db->loadResult();
				
		// the actual content sql
		$db->setQuery($query);
		if($db->getErrorNum() > 0)
		{
			JError::raiseError( $db->getErrorNum() , $db->getErrorMsg() . $db->stderr());
		}
		
		$result	= $db->loadObjectList();  
		return $result;
	}
}