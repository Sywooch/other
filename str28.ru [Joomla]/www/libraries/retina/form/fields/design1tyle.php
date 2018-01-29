<?php
/**
 * @package     retina.Platform
 * @subpackage  Form
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

JFormHelper::loadFieldClass('groupedlist');

/**
 * Form Field class for the retina Platform.
 * Supports a select grouped list of template styles
 *
 * @package     retina.Platform
 * @subpackage  Form
 * @since       11.1
 */
class JFormFielddesign1tyle extends JFormFieldGroupedList
{

	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $type = 'design1tyle';

	/**
	 * Method to get the list of template style options
	 * grouped by template.
	 * Use the client attribute to specify a specific client.
	 * Use the template attribute to specify a specific template
	 *
	 * @return  array  The field option objects as a nested array in groups.
	 *
	 * @since   11.1
	 */
	protected function getGroups()
	{
		// Initialize variables.
		$groups = array();
		$lang = JFactory::getLanguage();

		// Get the client and client_id.
		$clientName = $this->element['client'] ? (string) $this->element['client'] : 'site';
		$client = JApplicationHelper::getClientInfo($clientName, true);

		// Get the template.
		$template = (string) $this->element['template'];

		// Get the database object and a new query object.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		// Build the query.
		$query->select('s.id, s.title, e.name as name, s.template');
		$query->from('#__template_styles as s');
		$query->where('s.client_id = ' . (int) $client->id);
		$query->order('template');
		$query->order('title');
		if ($template)
		{
			$query->where('s.template = ' . $db->quote($template));
		}
		$query->join('LEFT', '#__extensions as e on e.element=s.template');
		$query->where('e.enabled=1');

		// Set the query and load the styles.
		$db->setQuery($query);
		$styles = $db->loadObjectList();

		// Build the grouped list array.
		if ($styles)
		{
			foreach ($styles as $style)
			{
				$template = $style->template;
				$lang->load('tpl_' . $template . '.sys', $client->path, null, false, false)
					|| $lang->load('tpl_' . $template . '.sys', $client->path . '/design1/' . $template, null, false, false)
					|| $lang->load('tpl_' . $template . '.sys', $client->path, $lang->getDefault(), false, false)
					|| $lang->load('tpl_' . $template . '.sys', $client->path . '/design1/' . $template, $lang->getDefault(), false, false);
				$name = RText::_($style->name);
				// Initialize the group if necessary.
				if (!isset($groups[$name]))
				{
					$groups[$name] = array();
				}

				$groups[$name][] = JHtml::_('select.option', $style->id, $style->title);
			}
		}

		// Merge any additional groups in the XML definition.
		$groups = array_merge(parent::getGroups(), $groups);

		return $groups;
	}
}
