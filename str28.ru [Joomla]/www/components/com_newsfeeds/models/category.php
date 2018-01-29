<?php
/**
 * 
 * 
 */

// No direct access
defined('_REXEC') or die;

jimport('retina.application.component.modellist');

/**
 * Newsfeeds Component Category Model
 *
 * @package		Retina.Site
 * @subpackage	com_newsfeeds
 * @since 1.5
 */
class NewsfeedsModelCategory extends JModelList
{
	/**
	 * Category elements data
	 *
	 * @var array
	 */
	protected $_element = null;

	protected $_articles = null;

	protected $_siblings = null;

	protected $_children = null;

	protected $_parent = null;

	/**
	 * The category that applies.
	 *
	 * @access	protected
	 * @var		object
	 */
	protected $_category = null;

	/**
	 * The list of other newfeed categories.
	 *
	 * @access	protected
	 * @var		array
	 */
	protected $_categories = null;

	/**
	 * Constructor.
	 *
	 * @param	array	An optional associative array of configuration settings.
	 * @see		JController
	 * @since	1.6
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'name', 'a.name',
				'numarticles', 'a.numarticles',
				'link', 'a.link',
				'ordering', 'a.ordering',
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to get a list of elements.
	 *
	 * @return	mixed	An array of objects on success, false on failure.
	 */
	public function getelements()
	{
		// Invoke the parent getelements method to get the main list
		$elements = parent::getelements();

		// Convert the params field into an object, saving original in _params
		for ($i = 0, $n = count($elements); $i < $n; $i++) {
			$element = &$elements[$i];
			if (!isset($this->_params)) {
				$params = new JRegistry();
				$element->params = $params;
				$params->loadString($element->params);
			}
		}

		return $elements;
	}

	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return	string	An SQL query
	 * @since	1.6
	 */
	protected function getListQuery()
	{
		$user	= JFactory::getUser();
		$groups	= implode(',', $user->getAuthorisedViewLevels());

		// Create a new query object.
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		// Select required fields from the categories.
		$query->select($this->getState('list.select', 'a.*'));
		$query->from($db->quoteName('#__newsfeeds').' AS a');
		$query->where('a.access IN ('.$groups.')');

		// Filter by category.
		if ($categoryId = $this->getState('category.id')) {
			$query->where('a.catid = '.(int) $categoryId);
			$query->join('LEFT', '#__categories AS c ON c.id = a.catid');
			$query->where('c.access IN ('.$groups.')');
		}

		// Filter by state
		$state = $this->getState('filter.published');
		if (is_numeric($state)) {
			$query->where('a.published = '.(int) $state);
		}

		// Filter by start and end dates.
		$nullDate = $db->Quote($db->getNullDate());
		$date = JFactory::getDate();
		$nowDate = $db->Quote($date->format($db->getDateFormat()));

		if ($this->getState('filter.publish_date')){
			$query->where('(a.publish_up = ' . $nullDate . ' OR a.publish_up <= ' . $nowDate . ')');
			$query->where('(a.publish_down = ' . $nullDate . ' OR a.publish_down >= ' . $nowDate . ')');
		}

		// Filter by language
		if ($this->getState('filter.language')) {
			$query->where('a.language in ('.$db->Quote(JFactory::getLanguage()->getTag()).','.$db->Quote('*').')');
		}

		// Add the list ordering clause.
		$query->order($db->escape($this->getState('list.ordering', 'a.ordering')).' '.$db->escape($this->getState('list.direction', 'ASC')));

		return $query;
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app	= JFactory::getApplication();
		$params	= JComponentHelper::getParams('com_newsfeeds');

		// List state information
		$limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
		$this->setState('list.limit', $limit);

		$limitstart = JRequest::getVar('limitstart', 0, '', 'int');
		$this->setState('list.start', $limitstart);

		$orderCol	= JRequest::getCmd('filter_order', 'ordering');
		if (!in_array($orderCol, $this->filter_fields)) {
			$orderCol = 'ordering';
		}
		$this->setState('list.ordering', $orderCol);

		$listOrder	=  JRequest::getCmd('filter_order_Dir', 'ASC');
		if (!in_array(strtoupper($listOrder), array('ASC', 'DESC', ''))) {
			$listOrder = 'ASC';
		}
		$this->setState('list.direction', $listOrder);

		$id = JRequest::getVar('id', 0, '', 'int');
		$this->setState('category.id', $id);

		$user = JFactory::getUser();
		if ((!$user->authorise('core.edit.state', 'com_newsfeeds')) &&  (!$user->authorise('core.edit', 'com_newsfeeds'))){
			// limit to published for people who can't edit or edit.state.
			$this->setState('filter.published',	1);

			// Filter by start and end dates.
			$this->setState('filter.publish_date', true);
		}

		$this->setState('filter.language', $app->getLanguageFilter());

		// Load the parameters.
		$this->setState('params', $params);
	}

	/**
	 * Method to get category data for the current category
	 *
	 * @param	int		An optional ID
	 *
	 * @return	object
	 * @since	1.5
	 */
	public function getCategory()
	{
		if(!is_object($this->_element))
		{
			$app = JFactory::getApplication();
			$menu = $app->getMenu();
			$active = $menu->getActive();
			$params = new JRegistry();

			if($active)
			{
				$params->loadString($active->params);
			}

			$options = array();
			$options['countelements'] = $params->get('show_cat_elements', 1) || $params->get('show_empty_categories', 0);
			$categories = JCategories::getInstance('Newsfeeds', $options);
			$this->_element = $categories->get($this->getState('category.id', 'root'));
			if(is_object($this->_element))
			{
				$this->_children = $this->_element->getChildren();
				$this->_parent = false;
				if($this->_element->getParent())
				{
					$this->_parent = $this->_element->getParent();
				}
				$this->_rightsibling = $this->_element->getSibling();
				$this->_leftsibling = $this->_element->getSibling(false);
			} else {
				$this->_children = false;
				$this->_parent = false;
			}
		}

		return $this->_element;
	}

	/**
	 * Get the parent category.
	 *
	 * @param	int		An optional category id. If not supplied, the model state 'category.id' will be used.
	 *
	 * @return	mixed	An array of categories or false if an error occurs.
	 */
	public function getParent()
	{
		if (!is_object($this->_element))
		{
			$this->getCategory();
		}
		return $this->_parent;
	}

	/**
	 * Get the sibling (adjacent) categories.
	 *
	 * @return	mixed	An array of categories or false if an error occurs.
	 */
	function &getLeftSibling()
	{
		if (!is_object($this->_element))
		{
			$this->getCategory();
		}
		return $this->_leftsibling;
	}

	function &getRightSibling()
	{
		if(!is_object($this->_element))
		{
			$this->getCategory();
		}
		return $this->_rightsibling;
	}

	/**
	 * Get the child categories.
	 *
	 * @param	int		An optional category id. If not supplied, the model state 'category.id' will be used.
	 *
	 * @return	mixed	An array of categories or false if an error occurs.
	 */
	function &getChildren()
	{
		if(!is_object($this->_element))
		{
			$this->getCategory();
		}
		return $this->_children;
	}
}
