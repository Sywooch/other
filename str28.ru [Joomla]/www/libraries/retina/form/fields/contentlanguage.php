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
 * Provides a list of content languages
 *
 * @package     retina.Platform
 * @subpackage  Form
 * @see         JFormFieldLanguage for a select list of application languages.
 * @since       11.1
 */
class JFormFieldContentLanguage extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $type = 'ContentLanguage';

	/**
	 * Method to get the field options for content languages.
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   11.1
	 */
	protected function getOptions()
	{
		// Merge any additional options in the XML definition.
		return array_merge(parent::getOptions(), JHtml::_('contentlanguage.existing'));
	}
}
