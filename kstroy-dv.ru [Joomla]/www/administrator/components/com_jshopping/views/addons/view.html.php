<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewAddons extends JView
{
    function displayList($tpl = null){
        JToolBarHelper::title( _JSHOP_ADDONS, 'generic.png' );
        parent::display($tpl);
	}
    
    function displayEdit($tpl = null){        
        JToolBarHelper::title(_JSHOP_ADDONS, 'generic.png' );
        JToolBarHelper::save();
        JToolBarHelper::spacer();
        JToolBarHelper::apply();
        JToolBarHelper::spacer();
        JToolBarHelper::cancel();        
        parent::display($tpl);
    }
    
    function displayInfo($tpl = null){        
        JToolBarHelper::title(_JSHOP_ADDONS, 'generic.png' );
        JToolBarHelper::cancel();        
        parent::display($tpl);
    }
}
?>