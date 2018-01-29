<?php
/**
 * @package		Retina.Site
 * @subpackage	com_contact
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

jimport('retina.application.component.controller');
require_once RPATH_COMPONENT.'/helpers/route.php';

$controller = JController::getInstance('Contact');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
