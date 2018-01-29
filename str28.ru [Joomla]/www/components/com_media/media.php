<?php
/**
 * @package		Retina.Site
 * @subpackage	com_media
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

$params = JComponentHelper::getParams('com_media');
// Make sure the user is authorized to view this page
$user = JFactory::getUser();
$asset = JRequest::getCmd('asset');
$author = JRequest::getCmd('author');
if (!$asset or
		!$user->authorise('core.edit', $asset)
	&&	!$user->authorise('core.create', $asset)
	&& 	count($user->getAuthorisedCategories($asset, 'core.create')) == 0
	&&	!($user->id==$author && $user->authorise('core.edit.own', $asset)))
{
	return JError::raiseWarning(403, RText::_('RERROR_ALERTNOAUTHOR'));
}

// Set the path definitions
define('COM_MEDIA_BASE',	RPATH_ROOT.'/'.$params->get('image_path', 'images'));
define('COM_MEDIA_BASEURL', JURI::root().'/'.$params->get('image_path', 'images'));

$lang = JFactory::getLanguage();
	$lang->load('com_media', RPATH_admin, null, false, false)
	||	$lang->load('com_media', RPATH_admin, $lang->getDefault(), false, false);

// Load the admin HTML view
require_once RPATH_COMPONENT_admin.'/helpers/media.php';

// Require the base controller
require_once RPATH_COMPONENT.'/controller.php';

// Make sure the user is authorized to view this page
$user	= JFactory::getUser();
$app	= JFactory::getApplication();
$cmd	= JRequest::getCmd('task', null);

if (strpos($cmd, '.') != false) {
	// We have a defined controller/task pair -- lets split them out
	list($controllerName, $task) = explode('.', $cmd);

	// Define the controller name and path
	$controllerName	= strtolower($controllerName);
	$controllerPath	= RPATH_COMPONENT_admin.'/controllers/'.$controllerName.'.php';

	// If the controller file path exists, include it ... else lets die with a 500 error
	if (file_exists($controllerPath)) {
		require_once $controllerPath;
	}
	else {
		JError::raiseError(500, RText::_('RERROR_INVALID_CONTROLLER'));
	}
}
else {
	// Base controller, just set the task :)
	$controllerName = null;
	$task = $cmd;
}

// Set the name for the controller and instantiate it
$controllerClass = 'MediaController'.ucfirst($controllerName);

if (class_exists($controllerClass)) {
	$controller = new $controllerClass();
}
else {
	JError::raiseError(500, RText::_('RERROR_INVALID_CONTROLLER_CLASS'));
}

// Set the model and view paths to the admin folders
$controller->addViewPath(RPATH_COMPONENT_admin.'/views');
$controller->addModelPath(RPATH_COMPONENT_admin.'/models');

// Perform the Request task
$controller->execute($task);

// Redirect if set by the controller
$controller->redirect();
