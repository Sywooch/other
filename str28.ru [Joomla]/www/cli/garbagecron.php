<?php
/**
 * @package		retina.Cli
 *
 * 
 * 
 */

// Make sure we're being called from the command line, not a web interface
if (array_key_exists('REQUEST_METHOD', $_SERVER)) die();

// Initialize retina framework
define('_REXEC', 1);
define('DS', DIRECTORY_SEPARATOR);

// Load main defines
if (file_exists(dirname(dirname(__FILE__)) . '/defines.php'))
{
	require_once dirname(dirname(__FILE__)) . '/defines.php';
}

if (!defined('_RDEFINES'))
{
	define('RPATH_BASE', dirname(dirname(__FILE__)));
	require_once RPATH_BASE . '/includes/defines.php';
}

// Get the framework.
require_once RPATH_LIBRARIES . '/import.php';

// Bootstrap the CMS libraries.
require_once RPATH_LIBRARIES . '/cms.php';

// Force library to be in JError legacy mode
JError::$legacy = true;

/**
 * Cron job to trash expired cache data
 *
 * @package  retina.CLI
 * @since    2.5
 */
class GarbageCron extends JApplicationCli
{
	/**
	 * Entry point for the script
	 *
	 * @return  void
	 *
	 * @since   2.5
	 */
	public function execute()
	{
		$cache = JFactory::getCache();
		$cache->gc();
	}
}

JApplicationCli::getInstance('GarbageCron')->execute();
