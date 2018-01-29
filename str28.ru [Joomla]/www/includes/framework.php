<?php
/**
 * @package		Retina.Site
 * @subpackage	Application
 * 
 * 
 */

// No direct access.
defined('_REXEC') or die;

//
// retina main checks.
//

@ini_set('magic_quotes_runtime', 0);
@ini_set('zend.ze1_compatibility_mode', '0');

//
// Installation check, and check on removal of the install directory.
//

if (!file_exists(RPATH_CONFIGURATION.'/configuration.php') || (filesize(RPATH_CONFIGURATION.'/configuration.php') < 10) || file_exists(RPATH_INSTALLATION.'/index.php')) {

	if (file_exists(RPATH_INSTALLATION.'/index.php')) {
		header('Location: '.substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], 'index.php')).'installation/index.php');
		exit();
	} else {
		echo 'No configuration file found and no installation code available. Exiting...';
		exit();
	}
}

//
// retina main startup.
//

// main includes.
require_once RPATH_LIBRARIES.'/import.php';

// Force library to be in JError legacy mode
JError::$legacy = true;
JError::setErrorHandling(E_NOTICE, 'message');
JError::setErrorHandling(E_WARNING, 'message');
JError::setErrorHandling(E_ERROR, 'message', array('JError', 'customErrorPage'));

// Botstrap the CMS libraries.
require_once RPATH_LIBRARIES.'/cms.php';

// Pre-Load configuration.
ob_start();
require_once RPATH_CONFIGURATION.'/configuration.php';
ob_end_clean();

// main configuration.
$config = new JConfig();

// Set the error_reporting
switch ($config->error_reporting)
{
	case 'default':
	case '-1':
		break;

	case 'none':
	case '0':
		error_reporting(0);
		break;

	case 'simple':
		error_reporting(E_ERROR | E_WARNING | E_PARSE);
		ini_set('display_errors', 1);
		break;

	case 'maximum':
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		break;

	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
		break;

	default:
		error_reporting($config->error_reporting);
		ini_set('display_errors', 1);
		break;
}

define('JDEBUG', $config->debug);

unset($config);

//
// retina framework loading.
//

// main profiler.
if (JDEBUG) {
	jimport('retina.error.profiler');
	$_PROFILER = JProfiler::getInstance('Application');
}

//
// retina library imports.
//

jimport('retina.application.menu');
jimport('retina.environment.uri');
jimport('retina.utilities.utility');
jimport('retina.event.dispatcher');
jimport('retina.utilities.arrayhelper');
