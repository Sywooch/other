<?php
/**
 * @package    error404
 * @subpackage Components
 * components/com_error404/error404.php
 * @link http://www.cdprof.com
 * @license    GNU/GPL
 */

// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the error404 Component
 *
 * @package    cdprof
 */

class errors404Viewerror404 extends JView
{
	function display($tpl = null)
{
    //get the error
    $error        =& $this->get('Data');
    $isNew        = ($error->id_error404 < 1);
 
    $text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
    JToolBarHelper::title(   JText::_( 'COM_ERROR404_ERROR404' ).': <small><small>[ ' . $text.' ]</small></small>' );
    JToolBarHelper::save();
    if ($isNew)  {
        JToolBarHelper::cancel();
    } else {
        // for existing items the button is renamed `close`
        JToolBarHelper::cancel( 'cancel', 'Close' );
    }
 
    $this->assignRef('error', $error);
    parent::display($tpl);
	
}
}