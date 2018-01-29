<?php
/**
 * @package		Retina.Site
 * @subpackage	com_users
 * 
 * 
 * @since		1.5
 */

defined('_REXEC') or die;

jimport('retina.application.component.controller');
require_once RPATH_COMPONENT.'/helpers/route.php';

// Launch the controller.
$controller = JController::getInstance('Users');
$controller->execute(JRequest::getCmd('task', 'display'));
$controller->redirect();
