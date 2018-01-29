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
 * Utility class working with content language select lists
 *
 * @package     retina.Platform
 * @subpackage  HTML
 * @since       11.1
 */
abstract class JHtmlContentLanguage
{
	/**
	 * Cached array of the content language elements.
	 *
	 * @var    array
	 * @since  11.1
	 */
	protected static $elements = null;

	/**
	 * Get a list of the available content language elements.
	 *
	 * @param   boolean  $all        True to include All (*)
	 * @param   boolean  $translate  True to translate All
	 *
	 * @return  string
	 *
	 * @since   11.1
	 *
	 * @see     JFormFieldContentLanguage
	 */
	public static function existing($all = false, $translate = false)
	{
		if (empty(self::$elements))
		{
			// Get the database object and a new query object.
			$db		= JFactory::getDBO();
			$query	= $db->getQuery(true);

			// Build the query.
			$query->select('a.lang_code AS value, a.title AS text, a.title_native');
			$query->from('#__languages AS a');
			$query->where('a.published >= 0');
			$query->order('a.title');

			// Set the query and load the options.
			$db->setQuery($query);
			self::$elements = $db->loadObjectList();
			if ($all)
			{
				array_unshift(self::$elements, new JObject(array('value' => '*', 'text' => $translate ? RText::alt('RALL', 'language') : 'RALL_LANGUAGE')));
			}

			// Detect errors
			if ($db->getErrorNum())
			{
				JError::raiseWarning(500, $db->getErrorMsg());
			}
		}
		return self::$elements;
	}
}
