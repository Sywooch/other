<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class faqlsModelCategory extends JModelList
{
	var $_id = null;
	var $_data = null;
	var $_category = null;
	var $_pagination = null;
	var $_grMan = null;
	var $_sort = null;

	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct()
	{
		parent::__construct();
		
		$id = JRequest::getVar('id', 0, '', 'int');
		$this->setId((int)$id);
	}

	function setId($id)
	{
		// Set section ID and wipe data
		$this->_id			= $id;
		$this->_category	= null;
		$this->_data		= array();
	}

	function getData()
	{
		$app = JFactory::getApplication();
		$params = $app->getParams();
		$user = JFactory::getUser();
		$limit = $params->get('display_num');
		$userfaql = $app->getUserState('com_faql.userfaql'); // To take permissions of the user for com_faql
		
		$db = JFactory::getDBO();
		// Get total
		$where = $this->_buildContentWhere();
		$query = 'SELECT id, whom, checked_out, checked_out_time FROM #__faql '.$where;
		$db->setQuery($query);
		$items = $db->loadObjectList();
		if ($db->getErrorNum()) {
			$error = JError::raiseWarning(500, $db->stderr());
			return false;
		}
		
		$table = $this->getTable('faql');
		// Set real pagination total
		$total = count($items);
		$tot = 0;
		foreach ($items as $item) {
			if ($userfaql->get('guest') OR ($userfaql->get('manager') AND ($user->id == $item->whom OR $item->whom == -1)) OR $userfaql->get('SuperUser')) {
				$tot++;
			}
			// Reset checkout for my
			if ($item->checked_out AND ($userfaql->get('manager') OR $userfaql->get('SuperUser'))) {
				$time_ch = strtotime(JHTML::_('date', $item->checked_out_time, 'd-m-Y H:i:s'));
				$time_t = time();
				if ($time_t - $time_ch > 600 ) {
					$table->checkIn($item->id); // Reset checkout 10min
				}
			}
		}
		if ($tot > 0) $total = $tot;
		// Get pagination
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination($total, JRequest::getVar('limitstart', 0, '', 'int'),  $limit);
		}
		
		// Get data faql
		if (empty($this->_data)) {
			$query = $this->_buildQuery();
			$db->setQuery($query);
			$this->_data = $db->loadObjectList();
			if ($db->getErrorNum()) {
				$error = JError::raiseWarning(500, $db->stderr());
				return false;
			}
		}
		
		return $this->_data;
	}
	
	function getCquestAnswer()
	{
		$db = JFactory::getDBO();
		$query = 'SELECT id, published, state, created, created_ans FROM #__faql WHERE catid = '.(int) $this->_id.' AND published = 1';
		$db->setQuery($query);
		$nquest = $db->loadObjectList();
		if ($db->getErrorNum()) {
			$error = JError::raiseWarning(500, $db->stderr());
			return false;
		}
		
		// Get count questions and answers in category
		$datetoday = date('Y-m-d');
		$catquest = (object) '';
		$catquest->numquestion = 0;
		$catquest->numanswer = 0;
		$catquest->catansw_t = 0;
		$catquest->catquest_t = 0;
		$numbquest = count($nquest);
		$catquest->numquestion = $numbquest;  // questions in category
		foreach ( $nquest as $row ) {
			if ($row->state == 2) {
				$catquest->numanswer++; // answers in category
				if (strcmp(substr($row->created_ans, 0, 10), $datetoday) == 0) {
					$catquest->catansw_t++; // answers in category today
				}
			}
			if (strcmp(substr($row->created, 0, 10), $datetoday) == 0) {
				$catquest->catquest_t++;  // questions in category today
			}
		}
	
		return $catquest;
	}
	
	/**
	 * Method to get the total number items for the category faql
	 * @return integer
	 */
	function getCount()
	{
		$db = JFactory::getDBO();
		$query = 'SELECT COUNT(*) FROM #__faql WHERE catid='.$this->_id;
		$db->setQuery($query);
		$count = $db->loadResult();
		if ($db->getErrorNum()) {
			$error = JError::raiseWarning(500, $db->stderr());
			return false;
		}

		return $count;
	}
	
	function getPagination()
	{
		return $this->_pagination;
	}

	/**
	 * Method to get section data for the current section
	 *
	 * @since 1.5
	 */
	function getCategory()
	{
		// Load the Category data
		$db = JFactory::getDBO();
		if (empty($this->_category)) {
			$query = 'SELECT c.id AS id, c.title AS title, c.description AS description, c.params AS params, gr.id_group FROM #__categories AS c'.
			' LEFT JOIN #__faql_man AS gr ON gr.id_cat = c.id ' .
			'WHERE c.id = '.(int) $this->_id;
			$this->_db->setQuery($query, 0, 1);
			$this->_category = $this->_db->loadObject();
		}
		if ($db->getErrorNum()) {
			$error = JError::raiseWarning(500, $db->stderr());
			return false;
		}

		// Convert the params field to a registry.
		$catpar = new JRegistry;
		$obj = json_decode(trim($this->_category->params));
		$catpar->loadObject($obj);
		$this->_category->params = $catpar;

		return $this->_category;
	}
	
	function getGrMan()
	{
		// Cet group managers
		$db = JFactory::getDBO();
		if (empty($this->_grMan)) {
			$query = 'SELECT id_group FROM #__faql_man WHERE id_cat = '.(int) $this->_id;
			$this->_db->setQuery($query);
			$this->_grMan = $this->_db->loadResult();
		}
		if ($db->getErrorNum()) {
			$error = JError::raiseWarning(500, $db->stderr());
			return false;
		}
		
		return $this->_grMan;
	}
	
	function _buildQuery()
	{
		$app = JFactory::getApplication();
		$params = $app->getParams();
		$where		= $this->_buildContentWhere();
		$orderby	= $this->_buildContentOrderBy();
		// Get the pagination variables
		$limit = $this->_pagination->limit;
		$limitstart	= $this->_pagination->limitstart;
		$limititem = ' LIMIT '.$limitstart.','.$limit;

		$query = 'SELECT *' .
			' FROM #__faql' . 
			$where.
			$orderby.
			$limititem;

		return $query;
	}
	
	function _buildContentWhere()
	{
		$app = JFactory::getApplication();
		$user = JFactory::getUser();
		$userfaql = $app->getUserState('com_faql.userfaql'); // To take permissions of the user for com_faql
		$whom = '';
		if ($userfaql->get('manager') OR $userfaql->get('SuperUser')) {
			$all_item = '';
			if (!$userfaql->get('SuperUser')) {
				$whom = ' AND (whom = '.$user->id.' OR whom = -1)';
			}
		}
		else $all_item = ' AND published = 1 ';
		$where = ' WHERE catid = '.(int)$this->_id.''.$whom.''.$all_item;
		return $where;
	}
	
	function _buildContentOrderBy()
	{
		$orderby = ' ORDER BY ';
		
		switch ($this->_sort)
		{
			case 'ot':
				$orderby .= 'ordering asc';
				break;
			case 'od':
				$orderby .= 'ordering desc';
				break;
			case 'nt':
				$orderby .= 'id asc';
				break;
			case 'nd':
				$orderby .= 'id desc';
				break;
			case 'dqt':
				$orderby .= 'created asc';
				break;
			case 'dqd':
				$orderby .= 'created desc';
				break;
			case 'dat':
				$orderby .= 'created_ans asc';
				break;
			case 'dad':
				$orderby .= 'created_ans desc';
				break;
			case '0':
			default:
				$orderby .= 'ordering asc';
				break;
		}

		return $orderby;
	}
	
	public function getGlobalSort($sortval=null, $cat=null)
	{
		if (empty($sortval) AND empty($cat)) $idcat = (int)$this->_id;
		else $idcat = $cat;
		$sort = array();
		$app = JFactory::getApplication();
		$globalsort = $app->getUserState('com_faql.sort'.$idcat); // get GlobalSort

		if (empty($globalsort))
		{
			// Creat new GlobalSort
			$app = JFactory::getApplication();
			$params = $app->getParams();
			$sortdefault = $params->get('order_question');
			$val = $sortdefault;
		}
		else {
			if (empty($sortval) AND empty($cat)) {
				$this->_sort = $globalsort['sort'];
				return;
			}
			$val = $sortval;
		}
		$sort['sort'] = $val;
		switch ($val)
		{
			case 'ot':
				$sort['text'] = JText::_( 'ORDER_TOP' );
				break;
			case 'od':
				$sort['text'] = JText::_( 'ORDER_DOWN' );
				break;
			case 'nt':
				$sort['text'] = JText::_( 'NUMBER_TOP' );
				break;
			case 'nd':
				$sort['text'] = JText::_( 'NUMBER_DOWN' );
				break;
			case 'dqt':
				$sort['text'] = JText::_( 'QUEST_TOP' );
				break;
			case 'dqd':
				$sort['text'] = JText::_( 'QUEST_DOWN' );
				break;
			case 'dat':
				$sort['text'] = JText::_( 'ANSWER_TOP' );
				break;
			case 'dad':
				$sort['text'] = JText::_( 'ANSWER_DOWN' );
				break;
			case '0':
			default:
				$sort['text'] = JText::_( 'ORDER_TOP' );
				break;
		}
		$app->setUserState('com_faql.sort'.$idcat, $sort); // set GlobalSort
		$this->_sort = $sort['sort'];
		
		return;
	}
}
