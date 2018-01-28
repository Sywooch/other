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
class errors404Modelerrors404 extends JModel
{
var $_data;
	

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
		$query = "SELECT * FROM #__error404";
		$this->_data=$this->_getList($query);
		}
		return $this->_data;
		}
		
function stop($msg = '')
{
    global $mainframe;
    echo $msg;
    $mainframe->close();
}

function testRedirectPlugin()
	{
		$redirectPlugin=JPluginHelper::isEnabled('system','redirect');
		$redirectActivated=($redirectPlugin===TRUE)?"<span style=\"color:red;\">".JTEXT::_("COM_ERROR404_ACTIVATED")."</span>":"<span style=\"color:green;\">".JTEXT::_("COM_ERROR404_NOT_ACTIVATED")."</span>";
		return $redirectActivated;
	}

function testError404Plugin()
	{
		$error404Plugin=JPluginHelper::isEnabled('system','error404');
		$error404Activated=($error404Plugin===TRUE)?"<span style=\"color:green;\">".JTEXT::_("COM_ERROR404_ACTIVATED")."</span>":"<span style=\"color:red;\">".JTEXT::_("COM_ERROR404_NOT_ACTIVATED")."</span>";
		return $error404Activated;
	}
}