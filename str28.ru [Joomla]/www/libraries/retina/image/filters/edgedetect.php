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
 * Image Filter class to add an edge detect effect to an image.
 *
 * @package     retina.Platform
 * @subpackage  Image
 * @since       11.3
 */
class JImageFilterEdgedetect extends JImageFilter
{
	/**
	 * Method to apply a filter to an image resource.
	 *
	 * @param   array  $options  An array of options for the filter.
	 *
	 * @return  void
	 *
	 * @since   11.3
	 * @throws  RuntimeException
	 */
	public function execute(array $options = array())
	{
		// Verify that image filter support for PHP is available.
		if (!function_exists('imagefilter'))
		{
			// @codeCoverageIgnoreStart
			JLog::add('The imagefilter function for PHP is not available.', JLog::ERROR);
			throw new RuntimeException('The imagefilter function for PHP is not available.');
			// @codeCoverageIgnoreEnd
		}

		// Perform the edge detection filter.
		imagefilter($this->handle, IMG_FILTER_EDGEDETECT);
	}
}
