<?php
/**
 * @package     retina.Platform
 * @subpackage  Application
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

jimport('retina.application.component.model');

/**
 * Prototype element model.
 *
 * @package     retina.Platform
 * @subpackage  Application
 * @since       11.1
 */
abstract class JModelelement extends JModel
{
	/**
	 * An element.
	 *
	 * @var    array
	 * @since  11.1
	 */
	protected $element = null;

	/**
	 * An element.
	 *
	 * @var    array
	 * @deprecated use $element declare as private
	 */
	protected $_element = null;

	/**
	 * Model context string.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $context = 'group.type';

	/**
	 * Model context string.
	 *
	 * @var    string
	 * @since  11.1
	 * @deprecated use $context declare as private
	 */
	protected $_context = 'group.type';

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return  string  A store id.
	 *
	 * @since   11.1
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		return md5($id);
	}
}
