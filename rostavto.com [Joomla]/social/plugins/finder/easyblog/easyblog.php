<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Finder.Content
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_BASE') or die;

jimport('joomla.application.component.helper');

// Load the base adapter.
require_once JPATH_ADMINISTRATOR . '/components/com_finder/helpers/indexer/adapter.php';

/**
 * Finder adapter for com_content.
 *
 * @package     Joomla.Plugin
 * @subpackage  Finder.Content
 * @since       2.5
 */
class plgFinderEasyBlog extends FinderIndexerAdapter
{
	/**
	 * The plugin identifier.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $context = 'EasyBlog';

	/**
	 * The extension name.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $extension = 'com_easyblog';

	/**
	 * The sublayout to use when rendering the results.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $layout = 'entry';

	/**
	 * The type of content that the adapter indexes.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $type_title = 'EasyBlog';

	/**
	 * The table name.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $table = '#__easyblog_post';

	/**
	 * Constructor
	 *
	 * @param   object  &$subject  The object to observe
	 * @param   array   $config    An array that holds the plugin configuration
	 *
	 * @since   2.5
	 */
	public function __construct(&$subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}

	/**
	 * Method to remove the link information for items that have been deleted.
	 *
	 * @param   string  $context  The context of the action being performed.
	 * @param   JTable  $table    A JTable object containing the record to be deleted
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   2.5
	 * @throws  Exception on database error.
	 */
	public function onFinderAfterDelete($context, $table)
	{
		if ($context == 'easyblog.blog')
		{
			$id = $table->id;
		}
		elseif ($context == 'com_finder.index')
		{
			$id = $table->link_id;
		}
		else
		{
			return true;
		}
		// Remove the items.
		return $this->remove($id);
	}

	/**
	 * Method to determine if the access level of an item changed.
	 *
	 * @param   string   $context  The context of the content passed to the plugin.
	 * @param   JTable   $row      A JTable object
	 * @param   boolean  $isNew    If the content has just been created
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   2.5
	 * @throws  Exception on database error.
	 */
	public function onFinderAfterSave($context, $row, $isNew)
	{
		// We only want to handle articles here
		if ($context == 'easyblog.blog' )
		{
			// Reindex the item
			$this->reindex($row->id);
		}

		return true;
	}

	/**
	 * Method to index an item. The item must be a FinderIndexerResult object.
	 *
	 * @param   FinderIndexerResult  $item    The item to index as an FinderIndexerResult object.
	 * @param   string               $format  The item format
	 *
	 * @return  void
	 *
	 * @since   2.5
	 * @throws  Exception on database error.
	 */
	protected function index(FinderIndexerResult $item, $format = 'html')
	{
		// Check if the extension is enabled
		if (JComponentHelper::isEnabled($this->extension) == false)
		{
			return;
		}



		// Build the necessary route and path information.
		$item->url		= 'index.php?option=com_easyblog&view=entry&id='. $item->id;
		$item->route 	= $item->url;
		$item->path 	= FinderIndexerHelper::getContentPath($item->route);


		// map easyblog post privacy into joomla access
		if( empty( $item->private ) )
		{
			$item->access   = '1';
		}
		else
		{
			$item->access   = '2';
		}

		// truncate blog content to get the summary.
		$blog   = new stdClass();
		$blog->intro        = $item->intro;
		$blog->content      = $item->content;
		EasyBlogHelper::truncateContent($blog);

		// if the post is pasword protected, dont show the summary.
		if( !empty( $item->blogpassword ) )
		{
			$item->summary          = JText::_('PLG_FINDER_EASYBLOG_PASSWORD_PROTECTED');
		}
		else
		{
			$item->summary          = $blog->text;
		}

		$item->body 			= $item->intro . $item->content;

		// Add the meta-author.
		$item->metaauthor 	= !empty($item->created_by_alias) ? $item->created_by_alias : $item->author;
		$item->author 		= !empty($item->created_by_alias) ? $item->created_by_alias : $item->author;

		// Add the meta-data processing instructions.
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'metakey');
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'metadesc');
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'metaauthor');
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'author');

		// Add the type taxonomy data.
		$item->addTaxonomy('Type', 'EasyBlog');

		// Add the author taxonomy data.
		if (!empty($item->author) || !empty($item->created_by_alias))
		{
			$item->addTaxonomy('Author', !empty($item->created_by_alias) ? $item->created_by_alias : $item->author);
		}

		// Add the category taxonomy data.
		$item->addTaxonomy('Category', $item->category, $item->cat_state, $item->cat_access);

		// Add the language taxonomy data.
		if( empty( $item->language ) )
			$item->language = '*';

		$item->addTaxonomy('Language', $item->language);

		// Get content extras.
		FinderIndexerHelper::getContentExtras($item);

		// Index the item.
		if( EasyBlogHelper::getJoomlaVersion() >= '3.0' )
		{
			$this->indexer->index($item);
		}
		else
		{
			FinderIndexer::index( $item );
		}
	}

	/**
	 * Method to setup the indexer to be run.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   2.5
	 */
	protected function setup()
	{
		// Load dependent classes.
		require_once( JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'helper.php' );
		require_once( JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'router.php' );
		return true;
	}

	/**
	 * Method to get the SQL query used to retrieve the list of content items.
	 *
	 * @param   mixed  $sql  A JDatabaseQuery object or null.
	 *
	 * @return  JDatabaseQuery  A database object.
	 *
	 * @since   2.5
	 */
	protected function getListQuery($sql = null)
	{
		$db = JFactory::getDbo();
		// Check if we can use the supplied SQL query.
// 		$sql = is_a($sql, 'JDatabaseQuery') ? $sql : $db->getQuery(true);
// 		$sql->select('a.id, a.title, a.alias, a.introtext AS summary, a.fulltext AS body');
// 		$sql->select('a.state, a.catid, a.created AS start_date, a.created_by');
// 		$sql->select('a.created_by_alias, a.modified, a.modified_by, a.attribs AS params');
// 		$sql->select('a.metakey, a.metadesc, a.metadata, a.language, a.access, a.version, a.ordering');
// 		$sql->select('a.publish_up AS publish_start_date, a.publish_down AS publish_end_date');
// 		$sql->select('c.title AS category, c.published AS cat_state, c.access AS cat_access');
//
// 		// Handle the alias CASE WHEN portion of the query
// 		$case_when_item_alias = ' CASE WHEN ';
// 		$case_when_item_alias .= $sql->charLength('a.alias');
// 		$case_when_item_alias .= ' THEN ';
// 		$a_id = $sql->castAsChar('a.id');
// 		$case_when_item_alias .= $sql->concatenate(array($a_id, 'a.alias'), ':');
// 		$case_when_item_alias .= ' ELSE ';
// 		$case_when_item_alias .= $a_id.' END as slug';
// 		$sql->select($case_when_item_alias);
//
// 		$case_when_category_alias = ' CASE WHEN ';
// 		$case_when_category_alias .= $sql->charLength('c.alias');
// 		$case_when_category_alias .= ' THEN ';
// 		$c_id = $sql->castAsChar('c.id');
// 		$case_when_category_alias .= $sql->concatenate(array($c_id, 'c.alias'), ':');
// 		$case_when_category_alias .= ' ELSE ';
// 		$case_when_category_alias .= $c_id.' END as catslug';
// 		$sql->select($case_when_category_alias);
//
// 		$sql->select('u.name AS author');
// 		$sql->from('#__content AS a');
// 		$sql->join('LEFT', '#__categories AS c ON c.id = a.catid');
// 		$sql->join('LEFT', '#__users AS u ON u.id = a.created_by');


		$sql = is_a($sql, 'JDatabaseQuery') ? $sql : $db->getQuery(true);
		$sql->select( 'a.*, b.title AS category, u.name AS author, eu.nickname AS created_by_alias');

        $sql->select('1 AS access');
        $sql->select('a.published AS state,a.id AS ordering');
		$sql->select('b.published AS cat_state, 1 AS cat_access');
		$sql->select('m.keywords AS metakay, m.description AS metadesc');
 		$sql->from('#__easyblog_post AS a');
		$sql->join('LEFT', '#__easyblog_category AS b ON b.id = a.category_id');
		$sql->join('LEFT', '#__users AS u ON u.id = a.created_by');
		$sql->join('LEFT', '#__easyblog_users AS eu ON eu.id = a.created_by');
		$sql->join('LEFT', '#__easyblog_meta AS m ON m.content_id = a.id and m.type = ' . $db->Quote('post'));

		return $sql;
	}
}
