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
 * Supports a text field telephone numbers.
 *
 * @package     retina.Platform
 * @subpackage  Form
 * @link        http://www.w3.org/TR/html-markup/input.tel.html
 * @see         JFormRuleTel for telephone number validation
 * @see         JHtmlTel for rendering of telephone numbers
 * @since       11.1
 */
class JFormFieldTel extends JFormFieldText
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'Tel';
}
