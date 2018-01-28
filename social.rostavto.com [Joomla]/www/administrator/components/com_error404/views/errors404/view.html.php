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

class errors404Viewerrors404 extends JView
{
	

	
	function display($tpl = null)
	{
		
    
    $model =& $this->getModel();
	//$db = $model->connectCdprof();
		$id_abonnes = $model->getUserId();
	//$choixform = $model->getQueryVariable('choixform');
		$errors =& $this->get('Data');
	
	//test if plugins Redirect and error404 are activated
	$redirectActivated=$model->testRedirectPlugin();
	$error404Activated=$model->testError404Plugin();
				
    JToolBarHelper::title( JText::_('COM_ERROR404_ERROR404'));
    if (JPluginHelper::isEnabled('error404','stat'))
    {
    	JToolBarHelper::custom('goStats','default.png','default.png','Statistiques',false,false);
    }
    JToolBarHelper::deleteList();
    JToolBarHelper::editListX();
    JToolBarHelper::addNewX();
    JToolBarHelper::preferences( 'com_error404','600','700' );
    
 
    $this->assignRef('errors', $errors);
    $this->assignRef('id_abonnes', $id_abonnes);
    $this->assignRef( 'redirectActivated', $redirectActivated);
	$this->assignRef( 'error404Activated', $error404Activated);
    parent::display($tpl);
	
	}
}
