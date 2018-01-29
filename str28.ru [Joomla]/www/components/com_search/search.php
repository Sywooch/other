<?php
/**
 * @package		Retina.Site
 * @subpackage	com_search
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

jimport('retina.application.component.controller');

// Create the controller
$controller = JController::getInstance('Search');

// Perform the Request task
$controller->execute(JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();
