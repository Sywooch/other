<?php
/**
bv * @package		Retina.Site
 * @subpackage	com_contact
 * 
 * 
 */

// No direct access
defined('_REXEC') or die;

jimport('retina.application.component.modellist');

/**
 * @package		Retina.Site
 * @subpackage	com_contact
 */
class ContactModelCategory extends JModelList
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
				'con_position', 'a.con_position',
				'suburb', 'a.suburb',
				'state', 'a.state',
				'country', 'a.country',
				'ordering', 'a.ordering',
				'sortname',
				'sortname1', 'a.sortname1',
				'sortname2', 'a.sortname2',
				'sortname3', 'a.sortname3'
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
				$params->loadString($element->params);
				$element->params = $params;
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
		//sqlsrv changes
		$case_when = ' CASE WHEN ';
		$case_when .= $query->charLength('a.alias');
		$case_when .= ' THEN ';
		$a_id = $query->castAsChar('a.id');
		$case_when .= $query->concatenate(array($a_id, 'a.alias'), ':');
		$case_when .= ' ELSE ';
		$case_when .= $a_id.' END as slug';

		$case_when1 = ' CASE WHEN ';
		$case_when1 .= $query->charLength('c.alias');
		$case_when1 .= ' THEN ';
		$c_id = $query->castAsChar('c.id');
		$case_when1 .= $query->concatenate(array($c_id, 'c.alias'), ':');
		$case_when1 .= ' ELSE ';
		$case_when1 .= $c_id.' END as catslug';
		$query->select($this->getState('list.select', 'a.*') . ','.$case_when.','.$case_when1);
	//	. ' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(\':\', a.id, a.alias) ELSE a.id END as slug, '
	//	. ' CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(\':\', c.id, c.alias) ELSE c.id END AS catslug ');
		$query->from($db->quoteName('#__contact_details').' AS a');
		$query->join('LEFT', '#__categories AS c ON c.id = a.catid');
		$query->where('a.access IN ('.$groups.')');


		// Filter by category.
		if ($categoryId = $this->getState('category.id')) {
			$query->where('a.catid = '.(int) $categoryId);
			$query->where('c.access IN ('.$groups.')');
		}

		// Filter by state
		$state = $this->getState('filter.published');
		if (is_numeric($state)) {
			$query->where('a.published = '.(int) $state);
		}
		// Filter by start and end dates.
		$nullDate = $db->Quote($db->getNullDate());
		$nowDate = $db->Quote(JFactory::getDate()->toSql());

		if ($this->getState('filter.publish_date')){
			$query->where('(a.publish_up = ' . $nullDate . ' OR a.publish_up <= ' . $nowDate . ')');
			$query->where('(a.publish_down = ' . $nullDate . ' OR a.publish_down >= ' . $nowDate . ')');
		}

		// Filter by language
		if ($this->getState('filter.language')) {
			$query->where('a.language in (' . $db->Quote(JFactory::getLanguage()->getTag()) . ',' . $db->Quote('*') . ')');
		}

		// Set sortname ordering if selected
		if ($this->getState('list.ordering') == 'sortname') {
			$query->order($db->escape('a.sortname1').' '.$db->escape($this->getState('list.direction', 'ASC')));
			$query->order($db->escape('a.sortname2').' '.$db->escape($this->getState('list.direction', 'ASC')));
			$query->order($db->escape('a.sortname3').' '.$db->escape($this->getState('list.direction', 'ASC')));
		} else {
			$query->order($db->escape($this->getState('list.ordering', 'a.ordering')).' '.$db->escape($this->getState('list.direction', 'ASC')));
		}

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
		$params	= JComponentHelper::getParams('com_contact');
		$db		= $this->getDbo();
		// List state information
		$format = JRequest::getWord('format');
		if ($format=='feed') {
			$limit = $app->getCfg('feed_limit');
		}
		else {
			$limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
		}
		$this->setState('list.limit', $limit);

		$limitstart = JRequest::getVar('limitstart', 0, '', 'int');
		$this->setState('list.start', $limitstart);

		// Get list ordering default from the parameters
		$menuParams = new JRegistry();
		if ($menu = $app->getMenu()->getActive()) {
			$menuParams->loadString($menu->params);
		}
		$mergedParams = clone $params;
		$mergedParams->merge($menuParams);

		$orderCol	= JRequest::getCmd('filter_order', $mergedParams->get('initial_sort', 'ordering'));
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
		if ((!$user->authorise('core.edit.state', 'com_contact')) &&  (!$user->authorise('core.edit', 'com_contact'))){
			// limit to published for people who can't edit or edit.state.
			$this->setState('filter.published', 1);

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
			$categories = JCategories::getInstance('Contact', $options);
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
		if(!is_object($this->_element))
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
		if(!is_object($this->_element))
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
