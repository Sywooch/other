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

class errors404ViewStats extends JView
{
	function display($tpl = null)
{
    //display the errors
    $error        =& $this->get('Data');
    $pagination =& $this->get('Pagination');
    $model =& $this->getModel('stats');
	$model->_colonne="uri";
    $model->_max_top=10;
    $top10uri=& $this->get('Stats','Stats');
    $model->_colonne="useragent";
    $model->_max_top=10;
    $model->_stats=null;
    $top15ua=& $this->get('stats','stats');
     
    JToolBarHelper::title(   JText::_( 'COM_ERROR404_STATISTIQUES' ) );
    JToolBarHelper::cancel( 'cancel', 'Close' );
 
    $this->assignRef('error', $error);
    $this->assignRef('pagination', $pagination);
    $this->assignRef('top10uri', $top10uri);
    $this->assignRef('top15ua', $top15ua);
    
    parent::display($tpl);
    
}
}