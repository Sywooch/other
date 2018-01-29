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
 * Form Field class for the retina Framework.
 *
 * @package     retina.Platform
 * @subpackage  Form
 * @since       11.4
 */
class JFormFieldPlugins extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var    string
	 * @since  11.4
	 */
	protected $type = 'Plugins';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 *
	 * @since   11.4
	 */
	protected function getOptions()
	{
		// Initialise variables
		$folder	= $this->element['folder'];

		if (!empty($folder))
		{
			// Get list of plugins
			$db     = JFactory::getDbo();
			$query  = $db->getQuery(true);
			$query->select('element AS value, name AS text');
			$query->from('#__extensions');
			$query->where('folder = ' . $db->q($folder));
			$query->where('enabled = 1');
			$query->order('ordering, name');
			$db->setQuery($query);

			$options = $db->loadObjectList();

			$lang = JFactory::getLanguage();
			foreach ($options as $i => $element)
			{
				$source = RPATH_PLUGINS . '/' . $folder . '/' . $element->value;
				$extension = 'plg_' . $folder . '_' . $element->value;
					$lang->load($extension . '.sys', RPATH_admin, null, false, false)
				||	$lang->load($extension . '.sys', $source, null, false, false)
				||	$lang->load($extension . '.sys', RPATH_admin, $lang->getDefault(), false, false)
				||	$lang->load($extension . '.sys', $source, $lang->getDefault(), false, false);
				$options[$i]->text = RText::_($element->text);
			}

			if ($db->getErrorMsg())
			{
				JError::raiseWarning(500, RText::_('JFRAMEWORK_FORM_FIELDS_PLUGINS_ERROR_FOLDER_EMPTY'));
				return '';
			}

		}
		else
		{
			JError::raiseWarning(500, RText::_('JFRAMEWORK_FORM_FIELDS_PLUGINS_ERROR_FOLDER_EMPTY'));
		}

		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
