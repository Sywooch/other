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
 * Provides a select list of integers with specified first, last and step values.
 *
 * @package     retina.Platform
 * @subpackage  Form
 * @since       11.1
 */
class JFormFieldInteger extends JFormFieldList
{

	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'Integer';

	/**
	 * Method to get the field options.
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   11.1
	 */
	protected function getOptions()
	{
		// Initialize variables.
		$options = array();

		// Initialize some field attributes.
		$first = (int) $this->element['first'];
		$last = (int) $this->element['last'];
		$step = (int) $this->element['step'];

		// Sanity checks.
		if ($step == 0)
		{
			// Step of 0 will create an endless loop.
			return $options;
		}
		elseif ($first < $last && $step < 0)
		{
			// A negative step will never reach the last number.
			return $options;
		}
		elseif ($first > $last && $step > 0)
		{
			// A position step will never reach the last number.
			return $options;
		}

		// Build the options array.
		for ($i = $first; $i <= $last; $i += $step)
		{
			$options[] = JHtml::_('select.option', $i);
		}

		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
