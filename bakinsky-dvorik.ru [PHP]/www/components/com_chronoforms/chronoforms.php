<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
/* ensure that this file is called by another file */
defined('_JEXEC') or die('Restricted access');

/**
 * Load the HTML class
 */
require_once(JApplicationHelper::getPath('front_html'));
require_once(JApplicationHelper::getPath('class'));

require_once(JPATH_BASE .DS.'includes'.DS.'defines.php');
require_once(JPATH_BASE .DS.'includes'.DS.'framework.php');
$mainframe =& JFactory::getApplication();
//load chronoforms classes
require_once(JPATH_COMPONENT.DS.'libraries'.DS.'chronoform.php');
jimport('joomla.application.component.controller');

$formname = JRequest::getVar('chronoform');
if(empty($formname)){
	$params = $mainframe->getPageParameters('com_chronoforms');
	$formname = $params->get('formname');
}
$MyForm = CFChronoForm::getInstance($formname);
if(empty($MyForm->form_name)){
	echo "There is no form with this name or may be the form is unpublished, Please check the form and the url and the form management.";
	return;
}

//Main switch statement
$event = JRequest::getVar('event');
if(empty($event)){
	$event = 'load';
}
process($MyForm, $event);
/*switch($task){
	case 'submit':
		process($MyForm, 'submit');
		break;
	default:
		process($MyForm, $task);
		break;
}*/

function process($form, $event = ''){
	$form->process($event);
	HTML_ChronoForms::processView($form);
}
?>