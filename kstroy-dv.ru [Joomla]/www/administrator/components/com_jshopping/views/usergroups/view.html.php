<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewUserGroups extends JView
{
    function displayList($tpl = null){        
        JToolBarHelper::title( _JSHOP_USERGROUPS, 'generic.png' ); 
        JToolBarHelper::addNewX();
        JToolBarHelper::deleteList();        
        parent::display($tpl);
	}
    function displayEdit($tpl = null){        
        JToolBarHelper::title( $temp = ($this->edit) ? (_JSHOP_EDIT_USERGROUP) : (_JSHOP_EDIT_USERGROUP), 'generic.png' ); 
        JToolBarHelper::save();
        JToolBarHelper::spacer();
        JToolBarHelper::apply();
        JToolBarHelper::spacer();
        JToolBarHelper::cancel();        
        parent::display($tpl);
    }
}
?>