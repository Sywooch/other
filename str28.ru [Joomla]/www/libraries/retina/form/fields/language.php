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
 * Supports a list of installed application languages
 *
 * @package     retina.Platform
 * @subpackage  Form
 * @see         JFormFieldContentLanguage for a select list of content languages.
 * @since       11.1
 */
class JFormFieldLanguage extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'Language';

	/**
	 * Method to get the field options.
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   11.1
	 */
	protected function getOptions()
	{
		// Initialize some field attributes.
		$client = (string) $this->element['client'];
		if ($client != 'site' && $client != 'admin')
		{
			$client = 'site';
		}

		// Merge any additional options in the XML definition.
		$options = array_merge(
			parent::getOptions(),
			JLanguageHelper::createLanguageList($this->value, constant('RPATH_' . strtoupper($client)), true, true)
		);

		return $options;
	}
}
