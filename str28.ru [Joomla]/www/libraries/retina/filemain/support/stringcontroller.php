<?php
/**
 * @package     retina.Platform
 * @subpackage  Filemain
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

/**
 * String Controller
 *
 * @package     retina.Platform
 * @subpackage  Filemain
 * @since       11.1
 */
class JStringController
{
	/**
	 * Defines a variable as an array
	 *
	 * @return  array
	 *
	 * @since   11.1
	 */
	public function _getArray()
	{
		static $strings = array();
		return $strings;
	}

	/**
	 * Create a reference
	 *
	 * @param   string  $reference  The key
	 * @param   string  &$string    The value
	 *
	 * @return  void
	 *
	 * @since   11.1
	 */
	public function createRef($reference, &$string)
	{
		$ref = &JStringController::_getArray();
		$ref[$reference] = & $string;
	}

	/**
	 * Get reference
	 *
	 * @param   string  $reference  The key for the reference.
	 *
	 * @return  mixed  False if not set, reference if it it exists
	 *
	 * @since   11.1
	 */
	public function getRef($reference)
	{
		$ref = &JStringController::_getArray();
		if (isset($ref[$reference]))
		{
			return $ref[$reference];
		}
		else
		{
			return false;
		}
	}
}
