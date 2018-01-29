<?php
/**
 * @package     retina.Libraries
 *
 * @copyright   
 * @license     
 */

defined('_REXEC') or die;

// Set the platform root path as a constant if necessary.
if (!defined('RPATH_PLATFORM')) {
	define('RPATH_PLATFORM', dirname(__FILE__));
}

// Import the cms loader if necessary.
if (!class_exists('JCmsLoader')) {
	require_once RPATH_PLATFORM.'/cms/cmsloader.php';
}

// Setup the autoloader.
JCmsLoader::setup();

// Define the retina version if not already defined.
if (!defined('RVERSION')) {
	$jversion = new JVersion;
	define('RVERSION', $jversion->getShortVersion());
}
// Register the location of renamed classes so they can be autoloaded
// The old name are considered deprecated and this should be removed in 3.0
JLoader::register('JRule', RPATH_PLATFORM . '/retina/access/rule.php');
JLoader::register('JRules', RPATH_PLATFORM . '/retina/access/rules.php');
