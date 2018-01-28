<?php
/**
 *
 *
 * @package    error404
 * @subpackage Components
 * components/com_error404/error404.php
 * @link http://www.cdprof.com
 * @license    GNU/GPL
 */

// No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

/**
 * error404 Model
 *
 * @package    error404
 * @subpackage Components
 */
class errors404Modelerror404 extends JModel
{
function __construct()
{
    parent::__construct();
 
    $array = JRequest::getVar('cid',  0, '', 'array');
    $this->setId((int)$array[0]);
}

function setId($id)
{
    // Set id and wipe data
    $this->_id        = $id;
    $this->_data    = null;
}

	
	
function connectCdprof()
	{
		// Connection to database 
		$db	   =& JFactory::getDBO();
		return $db;
	}
	
function getUserId()
	{
		$user	= JFactory::getUser();
		$id_abonnes = $user->id;
		return $id_abonnes;
	}
	
function &getData()
{
    // Load the data
    if (empty( $this->_data )) {
        $query = ' SELECT * FROM #__error404 '.
                '  WHERE id_error404 = '.$this->_id;
        $this->_db->setQuery( $query );
        $this->_data = $this->_db->loadObject();
    }
    if (!$this->_data) {
        $this->_data = new stdClass();
        $this->_data->id_error404 = 0;
        $this->_data->chaine = null;
        $this->_data->type = null;
    }
    return $this->_data;
}

/**
 * Method to store a record
 *
 * @access    public
 * @return    boolean    True on success
 */
function store()
{
    $row =& $this->getTable();
 
    $data = JRequest::get( 'post' );
    // Bind the form fields to the error404 table
    if (!$row->bind($data)) {
        $this->setError($this->_db->getErrorMsg());
        return false;
    }
 
    // Make sure the error404 record is valid
    if (!$row->check()) {
        $this->setError($this->_db->getErrorMsg());
        return false;
    }
 
    // Store the web link table to the database
    if (!$row->store()) {
        $this->setError($this->_db->getErrorMsg());
        return false;
    }
 
    return true;
}


/**
 * Method to delete record(s)
 *
 * @access    public
 * @return    boolean    True on success
 */
function delete()
{
    $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
    $row =& $this->getTable();
 
    foreach($cids as $cid) {
        if (!$row->delete( $cid )) {
            $this->setError( $row->getErrorMsg() );
            return false;
        }
    }
 
    return true;
}

		
function stop($msg = '')
{
    global $mainframe;
    echo $msg;
    $mainframe->close();
}

}