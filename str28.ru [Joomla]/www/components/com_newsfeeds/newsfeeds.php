<?php
/**
 * @package		Retina.Site
 * @subpackage	com_newsfeeds
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Require the com_content helper library
jimport('retina.application.component.controller');
require_once RPATH_COMPONENT.'/helpers/route.php';
JTable::addIncludePath(RPATH_COMPONENT_admin . '/tables');

$controller	= JController::getInstance('Newsfeeds');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
