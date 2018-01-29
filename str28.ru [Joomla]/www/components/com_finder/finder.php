<?php
/**
 * @package     Retina.Site
 * @subpackage  com_finder
 *
 * @copyright   
 * @license     
 */

defined('_REXEC') or die;

jimport('retina.application.component.controller');

require_once RPATH_COMPONENT . '/helpers/route.php';

// Execute the task.
$controller = JController::getInstance('Finder');
$controller->execute(JFactory::getApplication()->input->get('task', '', 'word'));
$controller->redirect();
