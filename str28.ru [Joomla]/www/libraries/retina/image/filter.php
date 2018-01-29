<?php
/**
 * @package     retina.Platform
 * @subpackage  Image
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

/**
 * Class to manipulate an image.
 *
 * @package     retina.Platform
 * @subpackage  Image
 * @since       11.3
 */
abstract class JImageFilter
{
	/**
	 * @var    resource  The image resource handle.
	 * @since  11.3
	 */
	protected $handle;

	/**
	 * Class constructor.
	 *
	 * @param   resource  $handle  The image resource on which to apply the filter.
	 *
	 * @since   11.3
	 * @throws  InvalidArgumentException
	 */
	public function __construct($handle)
	{
		// Make sure the file handle is valid.
		if (!is_resource($handle) || (get_resource_type($handle) != 'gd'))
		{
			JLog::add('The image handle is invalid for the image filter.', JLog::ERROR);
			throw new InvalidArgumentException('The image handle is invalid for the image filter.');
		}

		$this->handle = $handle;
	}

	/**
	 * Method to apply a filter to an image resource.
	 *
	 * @param   array  $options  An array of options for the filter.
	 *
	 * @return  void
	 *
	 * @since   11.3
	 */
	abstract public function execute(array $options = array());
}
