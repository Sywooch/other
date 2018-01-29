<?php
/**
 * @package     retina.Plugin
 * @subpackage  Finder.Categories
 *
 * @copyright   
 * @license     
 */

defined('RPATH_BASE') or die;

jimport('retina.application.component.helper');
jimport('retina.filemain.file');

// Load the base adapter.
require_once RPATH_admin . '/components/com_finder/helpers/indexer/adapter.php';

/**
 * Finder adapter for retina Categories.
 *
 * @package     retina.Plugin
 * @subpackage  Finder.Categories
 * @since       2.5
 */
class plgFinderCategories extends FinderIndexerAdapter
{
	/**
	 * The plugin identifier.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $context = 'Categories';

	/**
	 * The extension name.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $extension = 'com_categories';

	/**
	 * The sublayout to use when rendering the results.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $layout = 'category';

	/**
	 * The type of content that the adapter indexes.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $type_title = 'Category';

	/**
	 * The table name.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $table = '#__categories';

	/**
	 * The field the published state is stored in.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $state_field = 'published';

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
	public function onFinderDelete($context, $table)
	{
		if ($context == 'com_categories.category')
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
		// We only want to handle categories here
		if ($context == 'com_categories.category')
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
		// We only want to handle categories here
		if ($context == 'com_categories.category')
		{
			// Query the database for the old access level if the element isn't new
			if (!$isNew)
			{
				$this->checkelementAccess($row);
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
		// We only want to handle categories here
		if ($context == 'com_categories.category')
		{
			// The category published state is tied to the parent category
			// published state so we need to look up all published states
			// before we change anything.
			foreach ($pks as $pk)
			{
				$sql = clone($this->getStateQuery());
				$sql->where('a.id = ' . (int) $pk);

				// Get the published states.
				$this->db->setQuery($sql);
				$element = $this->db->loadObject();

				// Translate the state.
				$temp = $this->translateState($value);

				// Update the element.
				$this->change($pk, 'state', $temp);

				// Reindex the element
				$this->reindex($pk);
			}
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

		// Need to import component route helpers dynamically, hence the reason it's handled here
		if (JFile::exists(RPATH_SITE . '/components/' . $element->extension . '/helpers/route.php'))
		{
			include_once RPATH_SITE . '/components/' . $element->extension . '/helpers/route.php';
		}

		$extension = ucfirst(substr($element->extension, 4));

		// Initialize the element parameters.
		$registry = new JRegistry;
		$registry->loadString($element->params);
		$element->params = $registry;

		$registry = new JRegistry;
		$registry->loadString($element->metadata);
		$element->metadata = $registry;

		 /* Add the meta-data processing instructions based on the categories
		 * configuration parameters.
		 */
		// Add the meta-author.
		$element->metaauthor = $element->metadata->get('author');

		// Handle the link to the meta-data.
		$element->addInstruction(FinderIndexer::META_CONTEXT, 'link');
		$element->addInstruction(FinderIndexer::META_CONTEXT, 'metakey');
		$element->addInstruction(FinderIndexer::META_CONTEXT, 'metadesc');
		$element->addInstruction(FinderIndexer::META_CONTEXT, 'metaauthor');
		$element->addInstruction(FinderIndexer::META_CONTEXT, 'author');
		//$element->addInstruction(FinderIndexer::META_CONTEXT, 'created_by_alias');

		// Trigger the onContentPrepare event.
		$element->summary = FinderIndexerHelper::prepareContent($element->summary, $element->params);

		// Build the necessary route and path information.
		$element->url = $this->getURL($element->id, $element->extension, $this->layout);
		if (class_exists($extension . 'HelperRoute') && method_exists($extension . 'HelperRoute', 'getCategoryRoute'))
		{
			$class = $extension . 'HelperRoute';

			// This is necessary for PHP 5.2 compatibility
			$element->route = call_user_func(array($class, 'getCategoryRoute'), $element->id);

			// Use this when PHP 5.3 is minimum supported
			//$element->route = $class::getCategoryRoute($element->id);
		}
		else
		{
			$element->route = ContentHelperRoute::getCategoryRoute($element->slug, $element->catid);
		}
		$element->path = FinderIndexerHelper::getContentPath($element->route);

		// Get the menu title if it exists.
		$title = $this->getelementMenuTitle($element->url);

		// Adjust the title if necessary.
		if (!empty($title) && $this->params->get('use_menu_title', true))
		{
			$element->title = $title;
		}

		// Translate the state. Categories should only be published if the parent category is published.
		$element->state = $this->translateState($element->state);

		// Add the type taxonomy data.
		$element->addTaxonomy('Type', 'Category');

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
		// Load com_content route helper as it is the fallback for routing in the indexer in this instance.
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
		$sql->select('a.id, a.title, a.alias, a.description AS summary, a.extension');
		$sql->select('a.created_user_id AS created_by, a.modified_time AS modified, a.modified_user_id AS modified_by');
		$sql->select('a.metakey, a.metadesc, a.metadata, a.language, a.lft, a.parent_id, a.level');
		$sql->select('a.created_time AS start_date, a.published AS state, a.access, a.params');

		// Handle the alias CASE WHEN portion of the query
		$case_when_element_alias = ' CASE WHEN ';
		$case_when_element_alias .= $sql->charLength('a.alias');
		$case_when_element_alias .= ' THEN ';
		$a_id = $sql->castAsChar('a.id');
		$case_when_element_alias .= $sql->concatenate(array($a_id, 'a.alias'), ':');
		$case_when_element_alias .= ' ELSE ';
		$case_when_element_alias .= $a_id.' END as slug';
		$sql->select($case_when_element_alias);
		$sql->from('#__categories AS a');
		$sql->where($db->quoteName('a.id') . ' > 1');

		return $sql;
	}

	/**
	 * Method to get a SQL query to load the published and access states for
	 * a category and section.
	 *
	 * @return  JDatabaseQuery  A database object.
	 *
	 * @since   2.5
	 */
	protected function getStateQuery()
	{
		$sql = $this->db->getQuery(true);
		$sql->select($this->db->quoteName('a.id'));
		$sql->select($this->db->quoteName('a.published') . ' AS cat_state');
		$sql->select($this->db->quoteName('a.access') . ' AS cat_access');
		$sql->from($this->db->quoteName('#__categories') . ' AS a');

		return $sql;
	}
}
