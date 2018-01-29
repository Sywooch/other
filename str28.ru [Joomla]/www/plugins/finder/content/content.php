<?php
/**
 * @package     retina.Plugin
 * @subpackage  Finder.Content
 *
 * @copyright   
 * @license     
 */

defined('RPATH_BASE') or die;

jimport('retina.application.component.helper');

// Load the base adapter.
require_once RPATH_admin . '/components/com_finder/helpers/indexer/adapter.php';

/**
 * Finder adapter for com_content.
 *
 * @package     retina.Plugin
 * @subpackage  Finder.Content
 * @since       2.5
 */
class plgFinderContent extends FinderIndexerAdapter
{
	/**
	 * The plugin identifier.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $context = 'Content';

	/**
	 * The extension name.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $extension = 'com_content';

	/**
	 * The sublayout to use when rendering the results.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $layout = 'article';

	/**
	 * The type of content that the adapter indexes.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $type_title = 'Article';

	/**
	 * The table name.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $table = '#__content';

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
	 * Method to update the element link information when the element category is
	 * changed. This is fired when the element category is published or unpublished
	 * from the list view.
	 *
	 * @param   string   $extension  The extension whose category has been updated.
	 * @param   array    $pks        A list of primary key ids of the content that has changed state.
	 * @param   integer  $value      The value of the state that the content has been changed to.
	 *
	 * @return  void
	 *
	 * @since   2.5
	 */
	public function onFinderCategoryChangeState($extension, $pks, $value)
	{
		// Make sure we're handling com_content categories
		if ($extension == 'com_content')
		{
			$this->categoryStateChange($pks, $value);
		}
	}

	/**
	 * Method to remove the link information for elements that have been deleted.
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
		if ($context == 'com_content.article')
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
		// Remove the elements.
		return $this->remove($id);
	}

	/**
	 * Method to determine if the access level of an element changed.
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
		if ($context == 'com_content.article' || $context == 'com_content.form')
		{
			// Check if the access levels are different
			if (!$isNew && $this->old_access != $row->access)
			{
				// Process the change.
				$this->elementAccessChange($row);
			}

			// Reindex the element
			$this->reindex($row->id);
		}

		// Check for access changes in the category
		if ($context == 'com_categories.category')
		{
			// Check if the access levels are different
			if (!$isNew && $this->old_cataccess != $row->access)
			{
				$this->categoryAccessChange($row);
			}
		}

		return true;
	}

	/**
	 * Method to reindex the link information for an element that has been saved.
	 * This event is fired before the data is actually saved so we are going
	 * to queue the element to be indexed later.
	 *
	 * @param   string   $context  The context of the content passed to the plugin.
	 * @param   JTable   $row     A JTable object
	 * @param   boolean  $isNew    If the content is just about to be created
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   2.5
	 * @throws  Exception on database error.
	 */
	public function onFinderBeforeSave($context, $row, $isNew)
	{
		// We only want to handle articles here
		if ($context == 'com_content.article' || $context == 'com_content.form')
		{
			// Query the database for the old access level if the element isn't new
			if (!$isNew)
			{
				$this->checkelementAccess($row);
			}
		}

		// Check for access levels from the category
		if ($context == 'com_categories.category')
		{
			// Query the database for the old access level if the element isn't new
			if (!$isNew)
			{
				$this->checkCategoryAccess($row);
			}
		}

		return true;
	}

	/**
	 * Method to update the link information for elements that have been changed
	 * from outside the edit screen. This is fired when the element is published,
	 * unpublished, archived, or unarchived from the list view.
	 *
	 * @param   string   $context  The context for the content passed to the plugin.
	 * @param   array    $pks      A list of primary key ids of the content that has changed state.
	 * @param   integer  $value    The value of the state that the content has been changed to.
	 *
	 * @return  void
	 *
	 * @since   2.5
	 */
	public function onFinderChangeState($context, $pks, $value)
	{
		// We only want to handle articles here
		if ($context == 'com_content.article' || $context == 'com_content.form')
		{
			$this->elementStateChange($pks, $value);
		}
		// Handle when the plugin is disabled
		if ($context == 'com_plugins.plugin' && $value === 0)
		{
			$this->pluginDisable($pks);
		}
	}

	/**
	 * Method to index an element. The element must be a FinderIndexerResult object.
	 *
	 * @param   FinderIndexerResult  $element    The element to index as an FinderIndexerResult object.
	 * @param   string               $format  The element format
	 *
	 * @return  void
	 *
	 * @since   2.5
	 * @throws  Exception on database error.
	 */
	protected function index(FinderIndexerResult $element, $format = 'html')
	{
		// Check if the extension is enabled
		if (JComponentHelper::isEnabled($this->extension) == false)
		{
			return;
		}

		// Initialize the element parameters.
		$registry = new JRegistry;
		$registry->loadString($element->params);
		$element->params = JComponentHelper::getParams('com_content', true);
		$element->params->merge($registry);

		$registry = new JRegistry;
		$registry->loadString($element->metadata);
		$element->metadata = $registry;

		// Trigger the onContentPrepare event.
		$element->summary = FinderIndexerHelper::prepareContent($element->summary, $element->params);
		$element->body = FinderIndexerHelper::prepareContent($element->body, $element->params);

		// Build the necessary route and path information.
		$element->url = $this->getURL($element->id, $this->extension, $this->layout);
		$element->route = ContentHelperRoute::getArticleRoute($element->slug, $element->catslug);
		$element->path = FinderIndexerHelper::getContentPath($element->route);

		// Get the menu title if it exists.
		$title = $this->getelementMenuTitle($element->url);

		// Adjust the title if necessary.
		if (!empty($title) && $this->params->get('use_menu_title', true))
		{
			$element->title = $title;
		}

		// Add the meta-author.
		$element->metaauthor = $element->metadata->get('author');

		// Add the meta-data processing instructions.
		$element->addInstruction(FinderIndexer::META_CONTEXT, 'metakey');
		$element->addInstruction(FinderIndexer::META_CONTEXT, 'metadesc');
		$element->addInstruction(FinderIndexer::META_CONTEXT, 'metaauthor');
		$element->addInstruction(FinderIndexer::META_CONTEXT, 'author');
		$element->addInstruction(FinderIndexer::META_CONTEXT, 'created_by_alias');

		// Translate the state. Articles should only be published if the category is published.
		$element->state = $this->translateState($element->state, $element->cat_state);

		// Add the type taxonomy data.
		$element->addTaxonomy('Type', 'Article');

		// Add the author taxonomy data.
		if (!empty($element->author) || !empty($element->created_by_alias))
		{
			$element->addTaxonomy('Author', !empty($element->created_by_alias) ? $element->created_by_alias : $element->author);
		}

		// Add the category taxonomy data.
		$element->addTaxonomy('Category', $element->category, $element->cat_state, $element->cat_access);

		// Add the language taxonomy data.
		$element->addTaxonomy('Language', $element->language);

		// Get content extras.
		FinderIndexerHelper::getContentExtras($element);

		// Index the element.
		FinderIndexer::index($element);
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
		include_once RPATH_SITE . '/components/com_content/helpers/route.php';

		return true;
	}

	/**
	 * Method to get the SQL query used to retrieve the list of content elements.
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
		$sql = is_a($sql, 'JDatabaseQuery') ? $sql : $db->getQuery(true);
		$sql->select('a.id, a.title, a.alias, a.introtext AS summary, a.fulltext AS body');
		$sql->select('a.state, a.catid, a.created AS start_date, a.created_by');
		$sql->select('a.created_by_alias, a.modified, a.modified_by, a.attribs AS params');
		$sql->select('a.metakey, a.metadesc, a.metadata, a.language, a.access, a.version, a.ordering');
		$sql->select('a.publish_up AS publish_start_date, a.publish_down AS publish_end_date');
		$sql->select('c.title AS category, c.published AS cat_state, c.access AS cat_access');

		// Handle the alias CASE WHEN portion of the query
		$case_when_element_alias = ' CASE WHEN ';
		$case_when_element_alias .= $sql->charLength('a.alias');
		$case_when_element_alias .= ' THEN ';
		$a_id = $sql->castAsChar('a.id');
		$case_when_element_alias .= $sql->concatenate(array($a_id, 'a.alias'), ':');
		$case_when_element_alias .= ' ELSE ';
		$case_when_element_alias .= $a_id.' END as slug';
		$sql->select($case_when_element_alias);

		$case_when_category_alias = ' CASE WHEN ';
		$case_when_category_alias .= $sql->charLength('c.alias');
		$case_when_category_alias .= ' THEN ';
		$c_id = $sql->castAsChar('c.id');
		$case_when_category_alias .= $sql->concatenate(array($c_id, 'c.alias'), ':');
		$case_when_category_alias .= ' ELSE ';
		$case_when_category_alias .= $c_id.' END as catslug';
		$sql->select($case_when_category_alias);

		$sql->select('u.name AS author');
		$sql->from('#__content AS a');
		$sql->join('LEFT', '#__categories AS c ON c.id = a.catid');
		$sql->join('LEFT', '#__users AS u ON u.id = a.created_by');

		return $sql;
	}
}
