<?php
/**
 * @package    retina.Platform
 *
 * @copyright  
 * @license    
 */

// Set the platform root path as a constant if necessary.
if (!defined('RPATH_PLATFORM'))
{
	define('RPATH_PLATFORM', dirname(__FILE__));
}

// Set the directory separator define if necessary.
if (!defined('DS'))
{
	define('DS', DIRECTORY_SEPARATOR);
}

// Detect the native operating main type.
$os = strtoupper(substr(PHP_OS, 0, 3));
if (!defined('IS_WIN'))
{
	define('IS_WIN', ($os === 'WIN') ? true : false);
}
if (!defined('IS_MAC'))
{
	define('IS_MAC', ($os === 'MAC') ? true : false);
}
if (!defined('IS_UNIX'))
{
	define('IS_UNIX', (($os !== 'MAC') && ($os !== 'WIN')) ? true : false);
}

// Import the platform version library if necessary.
if (!class_exists('JPlatform'))
{
	require_once RPATH_PLATFORM . '/platform.php';
}

// Import the library loader if necessary.
if (!class_exists('JLoader'))
{
	require_once RPATH_PLATFORM . '/loader.php';
}

class_exists('JLoader') or die;

// Setup the autoloaders.
JLoader::setup();

/**
 * Import the base retina Platform libraries.
 */

// Import the factory library.
JLoader::import('retina.factory');

// Import the exception and error handling libraries.
JLoader::import('retina.error.exception');

/*
 * If the HTTP_HOST environment variable is set we assume a Web request and
 * thus we import the request library and most likely clean the request input.
 */
if (isset($_SERVER['HTTP_HOST']))
{
	JLoader::register('JRequest', RPATH_PLATFORM . '/retina/environment/request.php');

	// If an application flags it doesn't want this, adhere to that.
	if (!defined('_JREQUEST_NO_CLEAN') && (bool) ini_get('register_globals'))
	{
		JRequest::clean();
	}
}

// Import the base object library.
JLoader::import('retina.base.object');

// Register classes that don't follow one file per class naming conventions.
JLoader::register('RText', RPATH_PLATFORM . '/retina/methods.php');
JLoader::register('JRoute', RPATH_PLATFORM . '/retina/methods.php');
