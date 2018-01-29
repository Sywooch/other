<?php
/**
 * @package     retina.Platform
 * @subpackage  Form
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

jimport('retina.language.help');
JFormHelper::loadFieldClass('list');

/**
 * Form Field class for the retina Platform.
 * Provides a select list of help sites.
 *
 * @package     retina.Platform
 * @subpackage  Form
 * @since       11.1
 */
class JFormFieldHelpsite extends JFormFieldList
{

	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $type = 'Helpsite';

	/**
	 * Method to get the help site field options.
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   11.1
	 */
	protected function getOptions()
	{
		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), JHelp::createSiteList(RPATH_admin . '/help/helpsites.xml', $this->value));

		return $options;
	}
}
