<?php
/**
 * @package     retina.CLI
 * @subpackage  com_finder
 *
 * @copyright   
 * @license     
 */

// Make sure we're being called from the command line, not a web interface
if (array_key_exists('REQUEST_METHOD', $_SERVER)) die();

/**
 * Finder CLI Bootstrap
 *
 * Run the framework bootstrap with a couple of mods based on the script's needs
 */

// We are a valid entry point.
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

// Import necessary classes not handled by the autoloaders
jimport('retina.application.menu');
jimport('retina.environment.uri');
jimport('retina.event.dispatcher');
jimport('retina.utilities.utility');
jimport('retina.utilities.arrayhelper');

// Import the configuration.
require_once RPATH_CONFIGURATION . '/configuration.php';

// main configuration.
$config = new JConfig;

// Configure error reporting to maximum for CLI output.
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load Library language
$lang = JFactory::getLanguage();

// Try the finder_cli file in the current language (without allowing the loading of the file in the default language)
$lang->load('finder_cli', RPATH_SITE, null, false, false)
// Fallback to the finder_cli file in the default language
|| $lang->load('finder_cli', RPATH_SITE, null, true);

/**
 * A command line cron job to run the Finder indexer.
 *
 * @package     retina.CLI
 * @subpackage  com_finder
 * @since       2.5
 */
class FinderCli extends JApplicationCli
{
	/**
	 * Start time for the index process
	 *
	 * @var    string
	 * @since  2.5
	 */
	private $_time = null;

	/**
	 * Start time for each batch
	 *
	 * @var    string
	 * @since  2.5
	 */
	private $_qtime = null;

	/**
	 * Entry point for Finder CLI script
	 *
	 * @return  void
	 *
	 * @since   2.5
	 */
	public function execute()
	{
		// Print a blank line.
		$this->out(RText::_('FINDER_CLI'));
		$this->out('============================');
		$this->out();

		$this->_index();

		// Print a blank line at the end.
		$this->out();
	}

	/**
	 * Run the indexer
	 *
	 * @return  void
	 *
	 * @since   2.5
	 */
	private function _index()
	{
		// initialize the time value
		$this->_time = microtime(true);

		// import library dependencies
		require_once RPATH_admin . '/components/com_finder/helpers/indexer/indexer.php';
		jimport('retina.application.component.helper');

		// fool the main into thinking we are running as JSite with Finder as the active component
		JFactory::getApplication('site');
		$_SERVER['HTTP_HOST'] = 'domain.com';
		define('RPATH_COMPONENT_admin', RPATH_admin . '/components/com_finder');

		// Disable caching.
		$config = JFactory::getConfig();
		$config->set('caching', 0);
		$config->set('cache_handler', 'file');

		// Reset the indexer state.
		FinderIndexer::resetState();

		// Import the finder plugins.
		JPluginHelper::importPlugin('finder');

		// Starting Indexer.
		$this->out(RText::_('FINDER_CLI_STARTING_INDEXER'), true);

		// Trigger the onStartIndex event.
		JDispatcher::getInstance()->trigger('onStartIndex');

		// Remove the script time limit.
		@set_time_limit(0);

		// Get the indexer state.
		$state = FinderIndexer::getState();

		// Setting up plugins.
		$this->out(RText::_('FINDER_CLI_SETTING_UP_PLUGINS'), true);

		// Trigger the onBeforeIndex event.
		JDispatcher::getInstance()->trigger('onBeforeIndex');

		// Startup reporting.
		$this->out(RText::sprintf('FINDER_CLI_SETUP_elementS', $state->totalelements, round(microtime(true) - $this->_time, 3)), true);

		// Get the number of batches.
		$t = (int) $state->totalelements;
		$c = (int) ceil($t / $state->batchSize);
		$c = $c === 0 ? 1 : $c;

		// Process the batches.
		for ($i = 0; $i < $c; $i++)
		{
			// Set the batch start time.
			$this->_qtime = microtime(true);

			// Reset the batch offset.
			$state->batchOffset = 0;

			// Trigger the onBuildIndex event.
			JDispatcher::getInstance()->trigger('onBuildIndex');

			// Batch reporting.
			$this->out(RText::sprintf('FINDER_CLI_BATCH_COMPLETE', ($i + 1), round(microtime(true) - $this->_qtime, 3)), true);
		}

		// Total reporting.
		$this->out(RText::sprintf('FINDER_CLI_PROCESS_COMPLETE', round(microtime(true) - $this->_time, 3)), true);

		// Reset the indexer state.
		FinderIndexer::resetState();
	}
}

// Instantiate the application object, passing the class name to JCli::getInstance
// and use chaining to execute the application.
JApplicationCli::getInstance('FinderCli')->execute();
