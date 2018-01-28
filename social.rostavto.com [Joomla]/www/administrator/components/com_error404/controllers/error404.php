<?php
/**
 * @package    Error 404
 * @subpackage Components
 * components/com_error404/error404.php
 * @link http://www.cdprof.com
 * @license    GNU/GPL
 */

// No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

/**
 *Admin site error404 Component Controller
 *
 * @package    error404
 * @subpackage Components
 */
class errors404Controllererror404 extends errors404Controller
{
	/**
	 * Method to display the view
	 *
	 * @access    public**/
	
function __construct()
{
    parent::__construct();
 
    // Register Extra tasks
    $this->registerTask( 'add'  ,     'edit' );
}

function edit()
{
    JRequest::setVar( 'view', 'error404' );
    JRequest::setVar( 'layout', 'form'  );
    JRequest::setVar('hidemainmenu', 1);
 
    parent::display();
}

/**
 * save a record (and redirect to main page)
 * @return void
 */
function save()
{
    $model = $this->getModel('error404');
 
    if ($model->store()) {
        $msg = JText::_( 'COM_ERROR404_MOT_CLE_SAUVE' );
    } else {
        $msg = JText::_( 'COM_ERROR404_ERREUR_SAUVEGARDE_MOT_CLE' );
    }
 
    // Check the table in so it can be edited.... we are done with it anyway
    $link = 'index.php?option=com_error404';
    $this->setRedirect($link, $msg);
}

/**
 * remove record(s)
 * @return void
 */
function remove()
{
    $model = $this->getModel('error404');
    if(!$model->delete()) {
        $msg = JText::_( 'COM_ERROR404_ERROR_DELETE' );
    } else {
        $msg = JText::_( 'COM_ERROR404_ERROR_DELETED' );
    }
 
    $this->setRedirect( 'index.php?option=com_error404', $msg );
}

/**
 * cancel editing a record
 * @return void
 */
function cancel()
{
    $msg = JText::_( 'COM_ERROR404_ANNULER' );
    $this->setRedirect( 'index.php?option=com_error404', $msg );
}

/**
 * 
 * Go to Stats page
 * @return void
 */
function goStats()
{
	$link='index.php?option=com_error404&view=stats';
	$this->setRedirect($link);
}


}