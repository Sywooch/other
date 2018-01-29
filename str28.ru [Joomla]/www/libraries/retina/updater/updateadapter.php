<?php
/**
 * @package     retina.Platform
 * @subpackage  Updater
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

jimport('retina.base.adapterinstance');

/**
 * UpdateAdapter class.
 *
 * @package     retina.Platform
 * @subpackage  Updater
 * @since       11.1
 */
class JUpdateAdapter extends JAdapterInstance
{
	/**
	 * @var    string
	 * @since  11.1
	 */
	protected $xml_parser;

	/**
	 * @var    array
	 * @since 11.1
	 */
	protected $_stack = array('base');

	/**
	 * ID of update site
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $_update_site_id = 0;

	/**
	 * Columns in the extensions table to be updated
	 *
	 * @var    array
	 * @since  11.1
	 */
	protected $_updatecols = array('NAME', 'ELEMENT', 'TYPE', 'FOLDER', 'CLIENT', 'VERSION', 'DESCRIPTION', 'INFOURL');

	/**
	 * Gets the reference to the current direct parent
	 *
	 * @return  object
	 *
	 * @since   11.1
	 */
	protected function _getStackLocation()
	{
		return implode('->', $this->_stack);
	}

	/**
	 * Gets the reference to the last tag
	 *
	 * @return  object
	 *
	 * @since   11.1
	 */
	protected function _getLastTag()
	{
		return $this->_stack[count($this->_stack) - 1];
	}
}
