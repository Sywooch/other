<?php
/**
 * @package		Retina.Site
 * @subpackage	com_mailto
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

jimport('retina.application.component.controller');
jimport('retina.application.component.helper');

require_once RPATH_COMPONENT.'/helpers/mailto.php';
require_once RPATH_COMPONENT.'/controller.php';

$controller = JController::getInstance('Mailto');
$controller->registerDefaultTask('mailto');
$controller->execute(JRequest::getCmd('task'));

//$controller->redirect();
