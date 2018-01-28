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
class errors404ModelStats extends JModel
{
var $_data;
var $_stats;
var $_total = null;
var $_pagination = null;
//var $_top = null;
var $_colonne;//table's column to count
var $_max_top; //number of tops to display
	
function __construct()
  {
        parent::__construct();
 
        global $option;
        $mainframe=JFactory::getApplication();
 
        // Get pagination request variables
        $limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
        $limitstart = JRequest::getVar('limitstart', 0, '', 'int');
 
        // In case limit has been changed, adjust it
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
 
        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);
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
	
function getData()
	{
		if (empty($this->_data))
		{
		$query = "SELECT * FROM #__error404_stats ORDER BY id_error404_stats DESC";
		$this->_data=$this->_getList($query,$this->getState('limitstart'),$this->getState('limit'));
		}
		return $this->_data;
		}

function getTotal()
  {
        // Load the content if it doesn't already exist
        if (empty($this->_total)) {
            $query = "SELECT * FROM #__error404_stats";
            $this->_total = $this->_getListCount($query);    
        }
        return $this->_total;
  }
  
function getPagination()
  {
        // Load the content if it doesn't already exist
        if (empty($this->_pagination)) {
            jimport('joomla.html.pagination');
            $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
        }
        return $this->_pagination;
  }

function getStats()
{
	//calculate statistics about the errors
	if (empty($this->_stats))
	{
		$query="SELECT ".$this->_colonne.",count(*) AS total FROM #__error404_stats GROUP BY ".$this->_colonne." ORDER BY total DESC LIMIT ".$this->_max_top;
		$this->_stats=$this->_getList($query);
	}
	return $this->_stats;
}
		
}