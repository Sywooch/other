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
 * Renders a helpsites element
 *
 * @package     retina.Platform
 * @subpackage  Parameter
 * @since       11.1
 * @deprecated  Use JFormFieldHelpsite instead
 * @note        When updating note that JformFieldHelpsite does not end in s.
 */
class JElementHelpsites extends JElement
{
	/**
	 * Element name
	 *
	 * @var    string
	 */
	protected $_name = 'Helpsites';

	/**
	 * Fetch a help sites list
	 *
	 * @param   string       $name          Element name
	 * @param   string       $value         Element value
	 * @param   JXMLElement  &$node         JXMLElement node object containing the settings for the element
	 * @param   string       $control_name  Control name
	 *
	 * @return  string
	 *
	 * @deprecated    12.1   Use jFormFieldHelpSites::getOptions instead
	 * @since   11.1
	 */
	public function fetchElement($name, $value, &$node, $control_name)
	{
		// Deprecation warning.
		JLog::add('JElementHelpsites::fetchElement is deprecated.', JLog::WARNING, 'deprecated');

		jimport('retina.language.help');

		// Get retina version.
		$version = new JVersion;
		$jver = explode('.', $version->getShortVersion());

		$helpsites = JHelp::createSiteList(RPATH_admin . '/help/helpsites.xml', $value);
		array_unshift($helpsites, JHtml::_('select.option', '', RText::_('local')));

		return JHtml::_(
			'select.genericlist',
			$helpsites,
			$control_name . '[' . $name . ']',
			array('id' => $control_name . $name, 'list.attr' => 'class="inputbox"', 'list.select' => $value)
		);
	}
}
