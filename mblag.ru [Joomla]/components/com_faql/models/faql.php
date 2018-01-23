<?php
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.model');

class faqlsModelfaql extends JModel
{
	var $_id = null;
	var $_data = null;
	var $_catid = null;

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
		$this->_catid = JRequest::getVar('catid', 0, '', 'int');
	}

	function setId($id)
	{
		// Set weblink id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}


	function &getData()
	{
		// Load the data
		if (empty($this->_data))
		{
			$db =& JFactory::getDBO();
			$query = 'SELECT w.*, cc.title AS cattitle, cc.id AS catid' .
					' FROM #__faql AS w' .
					' LEFT JOIN #__categories AS cc ON cc.id = w.catid' .
					' WHERE w.id = '. (int) $this->_id;
			$this->_db->setQuery($query);
			$this->_data = $this->_db->loadObject();
			if ($db->getErrorNum()) {
				$error = JError::raiseWarning(500, $db->stderr());
			return false;
			}
		}
		
		return $this->_data;
	}
	
	/**
	 * Method to checkin/unlock 
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function checkin()
	{
		if ($this->_id)
		{
			$faql = & $this->getTable();
			if(! $faql->checkIn($this->_id)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return false;
	}

	/**
	 * Method to checkout/lock the 
	 *
	 * @access	public
	 * @param	int	$uid	User ID of the user checking the article out
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function checkout($uid = null)
	{
		if ($this->_id)
		{
			// Make sure we have a user id to checkout the article with
			if (is_null($uid)) {
				$user	=& JFactory::getUser();
				$uid	= $user->get('id');
			}

			$faql = & $this->getTable();
			$faql->load($this->_id);

			if(!$faql->checkOut($uid, $this->_id)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}

			return true;
		}
		return false;
	}
	
	function store($data)
	{
		//jexit(print_r($data)); /* For debug */
		$app = JFactory::getApplication();
		$userfaql = $app->getUserState('com_faql.userfaql'); // To take permissions of the user for com_faql
		
		$user = JFactory::getUser();
		$datenow =& JFactory::getDate();
		
		$params = $app->getParams();
		$autopubl = $params->get( 'autopublication', 0 );
		
		$table =& $this->getTable();
		
		$config =& JFactory::getConfig();
		$tzoffset = $config->getValue('config.offset');

		if ($data['id'] < 1) {
			$data['created'] = $datenow->toMySQL();
		} else {
			$date =& JFactory::getDate($data['created'], $tzoffset);
			$data['created'] = $date->toMySQL();
		}

		if (!$userfaql->get('guest') AND $data['id'] < 1) {
			$data['created_by'] = $user->username;
			$data['email'] = $user->email;
		}

		if ($data['id'] < 1) {
			$data['whom'] = $data['idadm'];
			if ($autopubl == 1) $data['published'] = 1;
			else $data['published'] = 0;
		} else {
			if (!array_key_exists('created_ans', $data)) $data['created_ans'] = 0;
			else {
				$config =& JFactory::getConfig();
				$tzoffset = $config->getValue('config.offset');
				$date = & JFactory::getDate($data['created_ans'], $tzoffset);
				$data['created_ans'] = $date->toMySQL();
			}
		}

		// Bind the form fields to  table
		if (!$table->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// if new item, order last in appropriate group
		if (!$table->id) {
			$where = 'catid = ' . (int) $table->catid ;
			$table->ordering = $table->getNextOrder( $where );
		}
		// Make sure table is valid
		if (!$table->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store table to the database
		if (!$table->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		$table->reorder('catid = '.(int) $data['catid']);
		
		return true;
	}
}