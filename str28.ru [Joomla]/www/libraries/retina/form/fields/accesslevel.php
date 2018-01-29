<?php
/**
 * @package     retina.Platform
 * @subpackage  Form
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

JFormHelper::loadFieldClass('list');

/**
 * Form Field class for the retina Platform.
 * Provides a list of access levels. Access levels control what users in specific
 * groups can see.
 *
 * @package     retina.Platform
 * @subpackage  Form
 * @see         JAccess
 * @since       11.1
 */
class JFormFieldAccessLevel extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $type = 'AccessLevel';

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string   The field input markup.
	 *
	 * @since   11.1
	 */
	protected function getInput()
	{
		// Initialize variables.
		$attr = '';

		// Initialize some field attributes.
		$attr .= $this->element['class'] ? ' class="' . (string) $this->element['class'] . '"' : '';
		$attr .= ((string) $this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';
		$attr .= $this->element['size'] ? ' size="' . (int) $this->element['size'] . '"' : '';
		$attr .= $this->multiple ? ' multiple="multiple"' : '';

		// Initialize JavaScript field attributes.
		$attr .= $this->element['onchange'] ? ' onchange="' . (string) $this->element['onchange'] . '"' : '';

		// Get the field options.
		$options = $this->getOptions();

		return JHtml::_('access.level', $this->name, $this->value, $attr, $options, $this->id);
	}
}
