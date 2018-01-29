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
 * Utility class for categories
 *
 * @package     retina.Platform
 * @subpackage  HTML
 * @since       11.1
 */
abstract class JHtmlCategory
{
	/**
	 * Cached array of the category elements.
	 *
	 * @var    array
	 * @since  11.1
	 */
	protected static $elements = array();

	/**
	 * Returns an array of categories for the given extension.
	 *
	 * @param   string  $extension  The extension option e.g. com_something.
	 * @param   array   $config     An array of configuration options. By default, only
	 *                              published and unpublished categories are returned.
	 *
	 * @return  array
	 *
	 * @since   11.1
	 */
	public static function options($extension, $config = array('filter.published' => array(0, 1)))
	{
		$hash = md5($extension . '.' . serialize($config));

		if (!isset(self::$elements[$hash]))
		{
			$config = (array) $config;
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);

			$query->select('a.id, a.title, a.level');
			$query->from('#__categories AS a');
			$query->where('a.parent_id > 0');

			// Filter on extension.
			$query->where('extension = ' . $db->quote($extension));

			// Filter on the published state
			if (isset($config['filter.published']))
			{
				if (is_numeric($config['filter.published']))
				{
					$query->where('a.published = ' . (int) $config['filter.published']);
				}
				elseif (is_array($config['filter.published']))
				{
					JArrayHelper::toInteger($config['filter.published']);
					$query->where('a.published IN (' . implode(',', $config['filter.published']) . ')');
				}
			}

			$query->order('a.lft');

			$db->setQuery($query);
			$elements = $db->loadObjectList();

			// Assemble the list options.
			self::$elements[$hash] = array();

			foreach ($elements as &$element)
			{
				$repeat = ($element->level - 1 >= 0) ? $element->level - 1 : 0;
				$element->title = str_repeat('- ', $repeat) . $element->title;
				self::$elements[$hash][] = JHtml::_('select.option', $element->id, $element->title);
			}
		}

		return self::$elements[$hash];
	}

	/**
	 * Returns an array of categories for the given extension.
	 *
	 * @param   string  $extension  The extension option.
	 * @param   array   $config     An array of configuration options. By default, only published and unpublished categories are returned.
	 *
	 * @return  array   Categories for the extension
	 *
	 * @since   11.1
	 */
	public static function categories($extension, $config = array('filter.published' => array(0, 1)))
	{
		$hash = md5($extension . '.' . serialize($config));

		if (!isset(self::$elements[$hash]))
		{
			$config = (array) $config;
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);

			$query->select('a.id, a.title, a.level, a.parent_id');
			$query->from('#__categories AS a');
			$query->where('a.parent_id > 0');

			// Filter on extension.
			$query->where('extension = ' . $db->quote($extension));

			// Filter on the published state
			if (isset($config['filter.published']))
			{
				if (is_numeric($config['filter.published']))
				{
					$query->where('a.published = ' . (int) $config['filter.published']);
				}
				elseif (is_array($config['filter.published']))
				{
					JArrayHelper::toInteger($config['filter.published']);
					$query->where('a.published IN (' . implode(',', $config['filter.published']) . ')');
				}
			}

			$query->order('a.lft');

			$db->setQuery($query);
			$elements = $db->loadObjectList();

			// Assemble the list options.
			self::$elements[$hash] = array();

			foreach ($elements as &$element)
			{
				$repeat = ($element->level - 1 >= 0) ? $element->level - 1 : 0;
				$element->title = str_repeat('- ', $repeat) . $element->title;
				self::$elements[$hash][] = JHtml::_('select.option', $element->id, $element->title);
			}
			// Special "Add to root" option:
			self::$elements[$hash][] = JHtml::_('select.option', '1', RText::_('RLIB_HTML_ADD_TO_ROOT'));
		}

		return self::$elements[$hash];
	}
}
