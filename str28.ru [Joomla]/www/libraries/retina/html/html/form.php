<?php
/**
 * @package     retina.Platform
 * @subpackage  HTML
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

/**
 * Utility class for form elements
 *
 * @package     retina.Platform
 * @subpackage  HTML
 * @since       11.1
 */
abstract class JHtmlForm
{
	/**
	 * Displays a hidden token field to reduce the risk of CSRF exploits
	 *
	 * Use in conjunction with JRequest::checkToken
	 *
	 * @return  string  A hidden input field with a token
	 *
	 * @see     JRequest::checkToken
	 * @since   11.1
	 */
	public static function token()
	{
		return '<input type="hidden" name="' . JSession::getFormToken() . '" value="1" />';
	}
}
