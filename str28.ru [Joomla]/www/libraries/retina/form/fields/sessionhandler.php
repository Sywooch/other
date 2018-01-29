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
 * Provides a select list of session handler options.
 *
 * @package     retina.Platform
 * @subpackage  Form
 * @since       11.1
 */
class JFormFieldSessionHandler extends JFormFieldList
{

	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'SessionHandler';

	/**
	 * Method to get the session handler field options.
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   11.1
	 */
	protected function getOptions()
	{
		// Initialize variables.
		$options = array();

		// Get the options from JSession.
		foreach (JSession::getStores() as $store)
		{
			$options[] = JHtml::_('select.option', $store, RText::_('RLIB_FORM_VALUE_SESSION_' . $store), 'value', 'text');
		}

		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
