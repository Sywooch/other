<?php
/**
 * @package		Retina.Site
 * @subpackage	com_banners
 * 
 * 
 */

defined('_REXEC') or die;

// Include dependancies
jimport('retina.application.component.controller');

// Execute the task.
$controller	= JController::getInstance('Banners');
$controller->execute(JRequest::getVar('task', 'click'));
$controller->redirect();
