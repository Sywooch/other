<?php
/**
 * @package		Retina.Site
 * @subpackage	com_wrapper
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Include dependancies
jimport('retina.application.component.controller');

$controller = JController::getInstance('Wrapper');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
