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
 * Renders a button separator
 *
 * @package     retina.Platform
 * @subpackage  HTML
 * @since       11.1
 */
class JButtonSeparator extends JButton
{
	/**
	 * Button type
	 *
	 * @var   string
	 */
	protected $_name = 'Separator';

	/**
	 * Get the HTML for a separator in the toolbar
	 *
	 * @param   array  &$definition  Class name and custom width
	 *
	 * @return  The HTML for the separator
	 *
	 * @since  11.1
	 *
	 * @see    JButton::render()
	 */
	public function render(&$definition)
	{
		// Initialise variables.
		$class = null;
		$style = null;

		// Separator class name
		$class = (empty($definition[1])) ? 'spacer' : $definition[1];
		// Custom width
		$style = (empty($definition[2])) ? null : ' style="width:' . intval($definition[2]) . 'px;"';

		return '<li class="' . $class . '"' . $style . ">\n</li>\n";
	}

	/**
	 * Empty implementation (not required for separator)
	 *
	 * @return  void
	 *
	 * @since   11.1
	 */
	public function fetchButton()
	{
	}
}
