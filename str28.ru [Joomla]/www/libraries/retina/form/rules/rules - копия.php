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
class JFormRuleRules extends JFormRule
{
	/**
	 * Method to test the value.
	 *
	 * @param   object  &$element  The JXmlElement object representing the <field /> tag for the form field object.
	 * @param   mixed   $value     The form field value to validate.
	 * @param   string  $group     The field name group control value. This acts as as an array container for the field.
	 *                             For example if the field has name="foo" and the group value is set to "bar" then the
	 *                             full field name would end up being "bar[foo]".
	 * @param   object  &$input    An optional JRegistry object with the entire data set to validate against the entire form.
	 * @param   object  &$form     The form object for which the field is being tested.
	 *
	 * @return  boolean  True if the value is valid, false otherwise.
	 *
	 * @since   11.1
	 * @throws  JException on invalid rule.
	 */
	public function test(&$item, $value, $group = null, &$input = null, &$form = null)
	{
		// Get the possible field actions and the ones posted to validate them.
		$fieldActions = self::getFieldActions($item);
		$valueActions = self::getValueActions($value);

		// Make sure that all posted actions are in the list of possible actions for the field.
		foreach ($valueActions as $action)
		{
			if (!in_array($action, $fieldActions))
			{
				return false;
			}
		}

		return true;
	}

	/**
	 * Method to get the list of permission action names from the form field value.
	 *
	 * @param   mixed  $value  The form field value to validate.
	 *
	 * @return  array  A list of permission action names from the form field value.
	 *
	 * @since   11.1
	 */
	protected function getValueActions($value)
	{
		// Initialise variables.
		$actions = array();

		// Iterate over the asset actions and add to the actions.
		foreach ((array) $value as $name => $rules)
		{
			$actions[] = $name;
		}

		return $actions;
	}

	/**
	 * Method to get the list of possible permission action names for the form field.
	 *
	 * @param   object  $element  The JXMLElement object representing the <field /> tag for the
	 *                            form field object.
	 *
	 * @return  array   A list of permission action names from the form field element definition.
	 *
	 * @since   11.1
	 */
	protected function getFieldActions($item)
	{
		// Initialise variables.
		$actions = array();

		// Initialise some field attributes.
		$section = $item['section'] ? (string) $item['section'] : '';
		$component = $item['component'] ? (string) $item['component'] : '';

		// Get the asset actions for the element.
		$elActions = JAccess::getActions($component, $section);

		// Iterate over the asset actions and add to the actions.
		foreach ($elActions as $item)
		{
			$actions[] = $item->name;
		}

		// Iterate over the children and add to the actions.
		foreach ($item->children() as $el)
		{
			if ($el->getName() == 'action')
			{
				$actions[] = (string) $el['name'];
			}
		}

		return $actions;
	}
}
