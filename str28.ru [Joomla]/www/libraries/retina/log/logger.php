<?php
/**
 * @package     retina.Platform
 * @subpackage  Log
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

/**
 * Retina Logger Base Class
 *
 * This class is used to be the basis of logger classes to allow for defined functions
 * to exist regardless of the child class.
 *
 * @package     retina.Platform
 * @subpackage  Log
 * @since       11.1
 */
abstract class JLogger
{
	/**
	 * Options array for the JLog instance.
	 * @var    array
	 * @since  11.1
	 */
	protected $options = array();

	/**
	 * Constructor.
	 *
	 * @param   array  &$options  Log object options.
	 *
	 * @since   11.1
	 */
	public function __construct(array &$options)
	{
		// Set the options for the class.
		$this->options = & $options;
	}

	/**
	 * Method to add an entry to the log.
	 *
	 * @param   JLogEntry  $entry  The log entry object to add to the log.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 */
	abstract public function addEntry(JLogEntry $entry);
}
