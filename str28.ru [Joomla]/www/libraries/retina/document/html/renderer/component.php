<?php
/**
 * @package     retina.Platform
 * @subpackage  Document
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

/**
 * Component renderer
 *
 * @package     retina.Platform
 * @subpackage  Document
 * @since       11.1
 */
class JDocumentRendererComponent extends JDocumentRenderer
{
	/**
	 * Renders a component script and returns the results as a string
	 *
	 * @param   string  $component  The name of the component to render
	 * @param   array   $params     Associative array of values
	 * @param   string  $content    Content script
	 *
	 * @return  string  The output of the script
	 *
	 * @since   11.1
	 */
	public function render($component = null, $params = array(), $content = null)
	{
		return $content;
	}
}
