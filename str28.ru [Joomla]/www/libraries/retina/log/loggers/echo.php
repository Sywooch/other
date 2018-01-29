<?php
/**
 * @package     retina.Platform
 * @subpackage  Log
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

jimport('retina.log.logger');

/**
 * retina Echo logger class.
 *
 * @package     retina.Platform
 * @subpackage  Log
 * @since       11.1
 */
class JLoggerEcho extends JLogger
{
	/**
	 * @var    array  Translation array for JLogEntry priorities to text strings.
	 * @since  11.1
	 */
	protected $priorities = array(
		JLog::EMERGENCY => 'EMERGENCY',
		JLog::ALERT => 'ALERT',
		JLog::CRITICAL => 'CRITICAL',
		JLog::ERROR => 'ERROR',
		JLog::WARNING => 'WARNING',
		JLog::NOTICE => 'NOTICE',
		JLog::INFO => 'INFO',
		JLog::DEBUG => 'DEBUG');

	/**
	 * Method to add an entry to the log.
	 *
	 * @param   JLogEntry  $entry  The log entry object to add to the log.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 */
	public function addEntry(JLogEntry $entry)
	{
		echo $this->priorities[$entry->priority] . ': ' . $entry->message . (empty($entry->category) ? '' : ' [' . $entry->category . ']') . "\n";
	}
}
