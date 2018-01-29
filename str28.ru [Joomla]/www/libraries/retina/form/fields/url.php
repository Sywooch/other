<?php
/**
 * @package     retina.Platform
 * @subpackage  Form
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

JFormHelper::loadFieldClass('text');

/**
 * Form Field class for the retina Platform.
 * Supports a URL text field
 *
 * @package     retina.Platform
 * @subpackage  Form
 * @link        http://www.w3.org/TR/html-markup/input.url.html#input.url
 * @see         JFormRuleUrl for validation of full urls
 * @since       11.1
 */
class JFormFieldUrl extends JFormFieldText
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'Url';
}
