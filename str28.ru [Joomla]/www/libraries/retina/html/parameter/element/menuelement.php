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
 * Renders a menu element element
 *
 * @package     retina.Platform
 * @subpackage  Parameter
 * @since       11.1
 * @deprecated  Use JformFieldMenuelement instead
 */
class JElementMenuelement extends JElement
{
	/**
	 * Element name
	 *
	 * @var    string
	 */
	protected $_name = 'Menuelement';

	/**
	 * Fetch menu element element HTML
	 *
	 * @param   string       $name          Element name
	 * @param   string       $value         Element value
	 * @param   JXMLElement  &$node         JXMLElement node object containing the settings for the element
	 * @param   string       $control_name  Control name
	 *
	 * @return  string
	 *
	 * @deprecated    12.1  useJFormFieldMenuelement::getGroups
	 * @since   11.1
	 *
	 */
	public function fetchElement($name, $value, &$node, $control_name)
	{
		// Deprecation warning.
		JLog::add('JElementMenuelement::fetchElement() is deprecated.', JLog::WARNING, 'deprecated');

		$db = JFactory::getDbo();

		$menuType = $this->_parent->get('menu_type');
		if (!empty($menuType))
		{
			$where = ' WHERE menutype = ' . $db->Quote($menuType);
		}
		else
		{
			$where = ' WHERE 1';
		}

		// Load the list of menu types
		// TODO: move query to model
		$query = 'SELECT menutype, title' . ' FROM #__menu_types' . ' ORDER BY title';
		$db->setQuery($query);
		$menuTypes = $db->loadObjectList();

		if ($state = $node->attributes('state'))
		{
			$where .= ' AND published = ' . (int) $state;
		}

		// load the list of menu elements
		// TODO: move query to model
		$query = 'SELECT id, parent_id, name, menutype, type' . ' FROM #__menu' . $where . ' ORDER BY menutype, parent_id, ordering';

		$db->setQuery($query);
		$menuelements = $db->loadObjectList();

		// Establish the hierarchy of the menu
		// TODO: use node model
		$children = array();

		if ($menuelements)
		{
			// First pass - collect children
			foreach ($menuelements as $v)
			{
				$pt = $v->parent_id;
				$list = @$children[$pt] ? $children[$pt] : array();
				array_push($list, $v);
				$children[$pt] = $list;
			}
		}

		// Second pass - get an indent list of the elements
		$list = JHtml::_('menu.treerecurse', 0, '', array(), $children, 9999, 0, 0);

		// Assemble into menutype groups
		$n = count($list);
		$groupedList = array();
		foreach ($list as $k => $v)
		{
			$groupedList[$v->menutype][] = &$list[$k];
		}

		// Assemble menu elements to the array
		$options = array();
		$options[] = JHtml::_('select.option', '', RText::_('ROPTION_SELECT_MENU_element'));

		foreach ($menuTypes as $type)
		{
			if ($menuType == '')
			{
				$options[] = JHtml::_('select.option', '0', '&#160;', 'value', 'text', true);
				$options[] = JHtml::_('select.option', $type->menutype, $type->title . ' - ' . RText::_('RGLOBAL_TOP'), 'value', 'text', true);
			}
			if (isset($groupedList[$type->menutype]))
			{
				$n = count($groupedList[$type->menutype]);
				for ($i = 0; $i < $n; $i++)
				{
					$element = &$groupedList[$type->menutype][$i];

					// If menutype is changed but element is not saved yet, use the new type in the list
					if (JRequest::getString('option', '', 'get') == 'com_menus')
					{
						$currentelementArray = JRequest::getVar('cid', array(0), '', 'array');
						$currentelementId = (int) $currentelementArray[0];
						$currentelementType = JRequest::getString('type', $element->type, 'get');
						if ($currentelementId == $element->id && $currentelementType != $element->type)
						{
							$element->type = $currentelementType;
						}
					}

					$disable = strpos($node->attributes('disable'), $element->type) !== false ? true : false;
					$options[] = JHtml::_('select.option', $element->id, '&#160;&#160;&#160;' . $element->treename, 'value', 'text', $disable);

				}
			}
		}

		return JHtml::_(
			'select.genericlist',
			$options,
			$control_name . '[' . $name . ']',
			array('id' => $control_name . $name, 'list.attr' => 'class="inputbox"', 'list.select' => $value)
		);
	}
}
