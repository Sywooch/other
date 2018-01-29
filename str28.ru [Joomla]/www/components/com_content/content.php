<?php
/**
 * @package		Retina.Site
 * @subpackage	com_content
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Include dependancies
jimport('retina.application.component.controller');
require_once RPATH_COMPONENT.'/helpers/route.php';
require_once RPATH_COMPONENT.'/helpers/query.php';

$controller = JController::getInstance('Content');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
