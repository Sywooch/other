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
 * Utility class working with menu select lists
 *
 * @package     retina.Platform
 * @subpackage  HTML
 * @since       11.1
 */
abstract class JHtmlMenu
{
	/**
	 * Cached array of the menus.
	 *
	 * @var    array
	 * @since  11.1
	 */
	protected static $menus = null;

	/**
	 * Cached array of the menus elements.
	 *
	 * @var    array
	 * @since  11.1
	 */
	protected static $elements = null;

	/**
	 * Get a list of the available menus.
	 *
	 * @return  string
	 *
	 * @since   11.1
	 */
	public static function menus()
	{
		if (empty(self::$menus))
		{
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('menutype AS value, title AS text');
			$query->from($db->quoteName('#__menu_types'));
			$query->order('title');
			$db->setQuery($query);
			self::$menus = $db->loadObjectList();
		}

		return self::$menus;
	}

	/**
	 * Returns an array of menu elements grouped by menu.
	 *
	 * @param   array  $config  An array of configuration options.
	 *
	 * @return  array
	 */
	public static function menuelements($config = array())
	{
		if (empty(self::$elements))
		{
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('menutype AS value, title AS text');
			$query->from($db->quoteName('#__menu_types'));
			$query->order('title');
			$db->setQuery($query);
			$menus = $db->loadObjectList();

			$query->clear();
			$query->select('a.id AS value, a.title AS text, a.level, a.menutype');
			$query->from('#__menu AS a');
			$query->where('a.parent_id > 0');
			$query->where('a.type <> ' . $db->quote('url'));
			$query->where('a.client_id = 0');

			// Filter on the published state
			if (isset($config['published']))
			{
				if (is_numeric($config['published']))
				{
					$query->where('a.published = ' . (int) $config['published']);
				}
				elseif ($config['published'] === '')
				{
					$query->where('a.published IN (0,1)');
				}
			}

			$query->order('a.lft');

			$db->setQuery($query);
			$elements = $db->loadObjectList();

			// Collate menu elements based on menutype
			$lookup = array();
			foreach ($elements as &$element)
			{
				if (!isset($lookup[$element->menutype]))
				{
					$lookup[$element->menutype] = array();
				}
				$lookup[$element->menutype][] = &$element;

				$element->text = str_repeat('- ', $element->level) . $element->text;
			}
			self::$elements = array();

			foreach ($menus as &$menu)
			{
				// Start group:
				self::$elements[] = JHtml::_('select.optgroup', $menu->text);

				// Special "Add to this Menu" option:
				self::$elements[] = JHtml::_('select.option', $menu->value . '.1', RText::_('RLIB_HTML_ADD_TO_THIS_MENU'));

				// Menu elements:
				if (isset($lookup[$menu->value]))
				{
					foreach ($lookup[$menu->value] as &$element)
					{
						self::$elements[] = JHtml::_('select.option', $menu->value . '.' . $element->value, $element->text);
					}
				}

				// Finish group:
				self::$elements[] = JHtml::_('select.optgroup', $menu->text);
			}
		}

		return self::$elements;
	}

	/**
	 * Displays an HTML select list of menu elements.
	 *
	 * @param   string  $name      The name of the control.
	 * @param   string  $selected  The value of the selected option.
	 * @param   string  $attribs   Attributes for the control.
	 * @param   array   $config    An array of options for the control.
	 *
	 * @return  string
	 */
	public static function menuelementlist($name, $selected = null, $attribs = null, $config = array())
	{
		static $count;

		$options = self::menuelements($config);

		return JHtml::_(
			'select.genericlist', $options, $name,
			array(
				'id' => isset($config['id']) ? $config['id'] : 'assetgroups_' . ++$count,
				'list.attr' => (is_null($attribs) ? 'class="inputbox" size="1"' : $attribs),
				'list.select' => (int) $selected,
				'list.translate' => false
			)
		);
	}

	/**
	 * Build the select list for Menu Ordering
	 *
	 * @param   object   &$row  The row object
	 * @param   integer  $id    The id for the row. Must exist to enable menu ordering
	 *
	 * @return  string
	 *
	 * @since   11.1
	 */
	public static function ordering(&$row, $id)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		if ($id)
		{
			$query->select('ordering AS value, title AS text');
			$query->from($db->quoteName('#__menu'));
			$query->where($db->quoteName('menutype') . ' = ' . $db->quote($row->menutype));
			$query->where($db->quoteName('parent_id') . ' = ' . (int) $row->parent_id);
			$query->where($db->quoteName('published') . ' != -2');
			$query->order('ordering');
			$order = JHtml::_('list.genericordering', $query);
			$ordering = JHtml::_(
				'select.genericlist', $order, 'ordering',
				array('list.attr' => 'class="inputbox" size="1"', 'list.select' => intval($row->ordering))
			);
		}
		else
		{
			$ordering = '<input type="hidden" name="ordering" value="' . $row->ordering . '" />' . RText::_('RGLOBAL_NEWelementSLAST_DESC');
		}

		return $ordering;
	}

	/**
	 * Build the multiple select list for Menu Links/Pages
	 *
	 * @param   boolean  $all         True if all can be selected
	 * @param   boolean  $unassigned  True if unassigned can be selected
	 *
	 * @return  string
	 *
	 * @since   11.1
	 */
	public static function linkoptions($all = false, $unassigned = false)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		// get a list of the menu elements
		$query->select('m.id, m.parent_id, m.title, m.menutype');
		$query->from($db->quoteName('#__menu') . ' AS m');
		$query->where($db->quoteName('m.published') . ' = 1');
		$query->order('m.menutype, m.parent_id, m.ordering');
		$db->setQuery($query);

		$melements = $db->loadObjectList();

		// Check for a database error.
		if ($db->getErrorNum())
		{
			JError::raiseNotice(500, $db->getErrorMsg());
		}

		if (!$melements)
		{
			$melements = array();
		}

		$melements_temp = $melements;

		// Establish the hierarchy of the menu
		$children = array();
		// First pass - collect children
		foreach ($melements as $v)
		{
			$pt = $v->parent_id;
			$list = @$children[$pt] ? $children[$pt] : array();
			array_push($list, $v);
			$children[$pt] = $list;
		}
		// Second pass - get an indent list of the elements
		$list = JHtmlMenu::TreeRecurse(intval($melements[0]->parent_id), '', array(), $children, 9999, 0, 0);

		// Code that adds menu name to Display of Page(s)

		$melements = array();
		if ($all | $unassigned)
		{
			$melements[] = JHtml::_('select.option', '<OPTGROUP>', RText::_('ROPTION_MENUS'));

			if ($all)
			{
				$melements[] = JHtml::_('select.option', 0, RText::_('RALL'));
			}
			if ($unassigned)
			{
				$melements[] = JHtml::_('select.option', -1, RText::_('ROPTION_UNASSIGNED'));
			}

			$melements[] = JHtml::_('select.option', '</OPTGROUP>');
		}

		$lastMenuType = null;
		$tmpMenuType = null;
		foreach ($list as $list_a)
		{
			if ($list_a->menutype != $lastMenuType)
			{
				if ($tmpMenuType)
				{
					$melements[] = JHtml::_('select.option', '</OPTGROUP>');
				}
				$melements[] = JHtml::_('select.option', '<OPTGROUP>', $list_a->menutype);
				$lastMenuType = $list_a->menutype;
				$tmpMenuType = $list_a->menutype;
			}

			$melements[] = JHtml::_('select.option', $list_a->id, $list_a->title);
		}
		if ($lastMenuType !== null)
		{
			$melements[] = JHtml::_('select.option', '</OPTGROUP>');
		}

		return $melements;
	}

	/**
	 * Build the list representing the menu tree
	 *
	 * @param   integer  $id         Id of the menu element
	 * @param   string   $indent     The indentation string
	 * @param   array    $list       The list to process
	 * @param   array    &$children  The children of the current element
	 * @param   integer  $maxlevel   The maximum number of levels in the tree
	 * @param   integer  $level      The starting level
	 * @param   string   $type       Type of link: component, URL, alias, separator
	 *
	 * @return  array
	 *
	 * @since   11.1
	 */
	public static function treerecurse($id, $indent, $list, &$children, $maxlevel = 9999, $level = 0, $type = 1)
	{
		if (@$children[$id] && $level <= $maxlevel)
		{
			foreach ($children[$id] as $v)
			{
				$id = $v->id;

				if ($type)
				{
					$pre = '<sup>|_</sup>&#160;';
					$spacer = '.&#160;&#160;&#160;&#160;&#160;&#160;';
				}
				else
				{
					$pre = '- ';
					$spacer = '&#160;&#160;';
				}

				if ($v->parent_id == 0)
				{
					$txt = $v->title;
				}
				else
				{
					$txt = $pre . $v->title;
				}
				$pt = $v->parent_id;
				$list[$id] = $v;
				$list[$id]->treename = "$indent$txt";
				$list[$id]->children = count(@$children[$id]);
				$list = JHtmlMenu::TreeRecurse($id, $indent . $spacer, $list, $children, $maxlevel, $level + 1, $type);
			}
		}
		return $list;
	}
}
