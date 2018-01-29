<?php
/**
 * @package     retina.Platform
 * @subpackage  Form
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

/**
 * Form Rule class for the retina Platform.
 *
 * @package     retina.Platform
 * @subpackage  Form
 * @since       11.1
 */
class JFormRuleBoolean extends JFormRule
{
	/**
	 * The regular expression to use in testing a form field value.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $regex = '^(?:[01]|true|false)$';

	/**
	 * The regular expression modifiers to use when testing a form field value.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $modifiers = 'i';
}
