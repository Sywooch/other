<?php
/**
 * @package     retina.Platform
 * @subpackage  Form
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

JFormHelper::loadFieldClass('filelist');

/**
 * Supports an HTML select list of image
 *
 * @package     retina.Platform
 * @subpackage  Form
 * @since       11.1
 */
class JFormFieldImageList extends JFormFieldFileList
{

	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $type = 'ImageList';

	/**
	 * Method to get the list of images field options.
	 * Use the filter attribute to specify allowable file extensions.
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   11.1
	 */
	protected function getOptions()
	{
		// Define the image file type filter.
		$filter = '\.png$|\.gif$|\.jpg$|\.bmp$|\.ico$|\.jpeg$|\.psd$|\.eps$';

		// Set the form field element attribute for file type filter.
		$this->element->addAttribute('filter', $filter);

		// Get the field options.
		return parent::getOptions();
	}
}
