<?php
// No direct access
defined('_JEXEC') or die;

jimport( 'joomla.application.component.view' );

class faqlsViewfaql extends JView
{
	function display($tpl = null)
	{
		$document	= JFactory::getDocument();
		$user = &JFactory::getUser();
		$data =& $this->get('data');
		if (!is_object($data)) return;
	
		$lists['published'] = JHTML::_('select.booleanlist',  'published', 'class="inputbox"', intval($data->published) );

		$state_ans[] = JHTML::_('select.option','0', JText::_( 'WAITING_ANSWER' ) );
		if ($data->email) $disabled = false;
		else $disabled = true;
		$state_ans[] = JHTML::_('select.option','1', JText::_( 'DIRECT_ANSWER' ), 'value', 'text', $disabled );
		$state_ans[] = JHTML::_('select.option','2', JText::_( 'YES_ANSWER' ) );
		$lists['state_ans'] = JHTML::_('select.genericlist',  $state_ans, 'state', '', 'value', 'text', intval($data->state));
		
		$baseurl = JURI::root();
		$document->addStyleSheet($baseurl . "components/com_faql/css/faql.css");
		$document->addScript($baseurl.'components/com_faql/js/editform.js');
		
		$uri = & JFactory::getURI();	
		
		$this->action = $uri->toString();
		$this->data = $data;
		$this->user = $user;
		$this->lists = $lists;
		
		parent::display($tpl);
	}
}