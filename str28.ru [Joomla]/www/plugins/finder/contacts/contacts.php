<?php
/**
 * @package     retina.Plugin
 * @subpackage  Finder.Contacts
 *
 * @copyright   
 * @license     
 */

defined('RPATH_BASE') or die;

jimport('retina.application.component.helper');

// Load the base adapter.
require_once RPATH_admin . '/components/com_finder/helpers/indexer/adapter.php';

/**
 * Finder adapter for retina Contacts.
 *
 * @package     retina.Plugin
 * @subpackage  Finder.Contacts
 * @since       2.5
 */
class plgFinderContacts extends FinderIndexerAdapter
{
	/**
	 * The plugin identifier.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $context = 'Contacts';

	/**
	 * The extension name.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $extension = 'com_contact';

	/**
	 * The sublayout to use when rendering the results.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $layout = 'contact';

	/**
	 * The type of content that the adapter indexes.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $type_title = 'Contact';

	/**
	 * The table name.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $table = '#__contact_details';

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
		// Make sure we're handling com_contact categories
		if ($extension == 'com_contact')
		{
			$this->categoryStateChange($pks, $value);
		}
	}

	/**
	 * Method to remove the link information for elements that have been deleted.
	 *
	 * This event will fire when contacts are deleted and when an indexed element is deleted.
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
		if ($context == 'com_contact.contact')
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
		// We only want to handle contacts here
		if ($context == 'com_contact.contact')
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
	 * @param   JTable   $row      A JTable object
	 * @param   boolean  $isNew    If the content is just about to be created
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   2.5
	 * @throws  Exception on database error.
	 */
	public function onFinderBeforeSave($context, $row, $isNew)
	{
		// We only want to handle contacts here
		if ($context == 'com_contact.contact')
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
		// We only want to handle contacts here
		if ($context == 'com_contact.contact')
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
		$element->params = $registry;

		// Build the necessary route and path information.
		$element->url = $this->getURL($element->id, $this->extension, $this->layout);
		$element->route = ContactHelperRoute::getContactRoute($element->slug, $element->catslug);
		$element->path = FinderIndexerHelper::getContentPath($element->route);

		// Get the menu title if it exists.
		$title = $this->getelementMenuTitle($element->url);

		// Adjust the title if necessary.
		if (!empty($title) && $this->params->get('use_menu_title', true))
		{
			$element->title = $title;
		}

		/*
		 * Add the meta-data processing instructions based on the contact
		 * configuration parameters.
		 */
		// Handle the contact position.
		if ($element->params->get('show_position', true))
		{
			$element->addInstruction(FinderIndexer::META_CONTEXT, 'position');
		}

		// Handle the contact street address.
		if ($element->params->get('show_street_address', true))
		{
			$element->addInstruction(FinderIndexer::META_CONTEXT, 'address');
		}

		// Handle the contact city.
		if ($element->params->get('show_suburb', true))
		{
			$element->addInstruction(FinderIndexer::META_CONTEXT, 'city');
		}

		// Handle the contact region.
		if ($element->params->get('show_state', true))
		{
			$element->addInstruction(FinderIndexer::META_CONTEXT, 'region');
		}

		// Handle the contact country.
		if ($element->params->get('show_country', true))
		{
			$element->addInstruction(FinderIndexer::META_CONTEXT, 'country');
		}

		// Handle the contact zip code.
		if ($element->params->get('show_postcode', true))
		{
			$element->addInstruction(FinderIndexer::META_CONTEXT, 'zip');
		}

		// Handle the contact telephone number.
		if ($element->params->get('show_telephone', true))
		{
			$element->addInstruction(FinderIndexer::META_CONTEXT, 'telephone');
		}

		// Handle the contact fax number.
		if ($element->params->get('show_fax', true))
		{
			$element->addInstruction(FinderIndexer::META_CONTEXT, 'fax');
		}

		// Handle the contact e-mail address.
		if ($element->params->get('show_email', true))
		{
			$element->addInstruction(FinderIndexer::META_CONTEXT, 'email');
		}

		// Handle the contact mobile number.
		if ($element->params->get('show_mobile', true))
		{
			$element->addInstruction(FinderIndexer::META_CONTEXT, 'mobile');
		}

		// Handle the contact webpage.
		if ($element->params->get('show_webpage', true))
		{
			$element->addInstruction(FinderIndexer::META_CONTEXT, 'webpage');
		}

		// Handle the contact user name.
		$element->addInstruction(FinderIndexer::META_CONTEXT, 'user');

		// Add the type taxonomy data.
		$element->addTaxonomy('Type', 'Contact');

		// Add the category taxonomy data.
		$element->addTaxonomy('Category', $element->category, $element->cat_state, $element->cat_access);

		// Add the language taxonomy data.
		$element->addTaxonomy('Language', $element->language);

		// Add the region taxonomy data.
		if (!empty($element->region) && $this->params->get('tax_add_region', true))
		{
			$element->addTaxonomy('Region', $element->region);
		}

		// Add the country taxonomy data.
		if (!empty($element->country) && $this->params->get('tax_add_country', true))
		{
			$element->addTaxonomy('Country', $element->country);
		}

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
		require_once RPATH_SITE . '/components/com_contact/helpers/route.php';

		// This is a hack to get around the lack of a route helper.
		FinderIndexerHelper::getContentPath('index.php?option=com_contact');

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
		$sql->select('a.id, a.name AS title, a.alias, a.con_position AS position, a.address, a.created AS start_date');
		$sql->select('a.created_by_alias, a.modified, a.modified_by');
		$sql->select('a.metakey, a.metadesc, a.metadata, a.language');
		$sql->select('a.sortname1, a.sortname2, a.sortname3');
		$sql->select('a.publish_up AS publish_start_date, a.publish_down AS publish_end_date');
		$sql->select('a.suburb AS city, a.state AS region, a.country, a.postcode AS zip');
		$sql->select('a.telephone, a.fax, a.misc AS summary, a.email_to AS email, a.mobile');
		$sql->select('a.webpage, a.access, a.published AS state, a.ordering, a.params, a.catid');
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

		$sql->select('u.name AS user');
		$sql->from('#__contact_details AS a');
		$sql->join('LEFT', '#__categories AS c ON c.id = a.catid');
		$sql->join('LEFT', '#__users AS u ON u.id = a.user_id');

		return $sql;
	}
}
