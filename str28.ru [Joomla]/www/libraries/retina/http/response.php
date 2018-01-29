<?php
/**
 * @package     retina.Platform
 * @subpackage  HTTP
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die();

/**
 * HTTP response data object class.
 *
 * @package     retina.Platform
 * @subpackage  HTTP
 * @since       11.3
 */
class JHttpResponse
{
	/**
	 * @var    integer  The server response code.
	 * @since  11.3
	 */
	public $code;

	/**
	 * @var    array  Response headers.
	 * @since  11.3
	 */
	public $headers = array();

	/**
	 * @var    string  Server response body.
	 * @since  11.3
	 */
	public $body;
}
