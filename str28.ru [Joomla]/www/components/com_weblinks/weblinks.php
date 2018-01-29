<?php
/**
 * @package		Retina.Site
 * @subpackage	com_weblinks
 * 
 * 
 */

// No direct access.
defined('_REXEC') or die;

jimport('retina.application.component.controller');
require_once RPATH_COMPONENT.'/helpers/route.php';

$controller	= JController::getInstance('Weblinks');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
