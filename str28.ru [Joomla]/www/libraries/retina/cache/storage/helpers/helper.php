<?php
/**
 * @package     retina.Platform
 * @subpackage  Cache
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

/**
 * Cache storage helper functions.
 *
 * @package     retina.Platform
 * @subpackage  Cache
 * @since       11.1
 */
class JCacheStorageHelper
{
	/**
	 * Cache data group
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $group = '';

	/**
	 * Cached element size
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $size = 0;

	/**
	 * Counter
	 *
	 * @var    integer
	 * @since  11.1
	 */
	public $count = 0;

	/**
	 * Constructor
	 *
	 * @param   string  $group  The cache data group
	 *
	 * @since   11.1
	 */
	public function __construct($group)
	{
		$this->group = $group;
	}

	/**
	 * Increase cache elements count.
	 *
	 * @param   string  $size  Cached element size
	 *
	 * @return  void
	 *
	 * @since   11.1
	 */
	public function updateSize($size)
	{
		$this->size = number_format($this->size + $size, 2);
		$this->count++;
	}
}
