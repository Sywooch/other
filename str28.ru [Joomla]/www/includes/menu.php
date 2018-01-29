<?php
/**
 * 
 * 
 */

// No direct access.
defined('_REXEC') or die;

/**
 * JMenu class
 *
 * @package		Retina.Site
 * @subpackage	Application
 * @since		1.5
 */
class JMenuSite extends JMenu
{
	/**
	 * Loads the entire menu table into memory.
	 *
	 * @return array
	 */
	public function load()
	{
		// Initialise variables.
		$db		= JFactory::getDbo();
		$app	= JApplication::getInstance('site');
		$query	= $db->getQuery(true);

		$query->select('m.id, m.menutype, m.title, m.alias, m.note, m.path AS route, m.link, m.type, m.level, m.language');
		$query->select('m.browserNav, m.access, m.params, m.home, m.img, m.template_style_id, m.component_id, m.parent_id');
		$query->select('e.element as component');
		$query->from('#__menu AS m');
		$query->leftJoin('#__extensions AS e ON m.component_id = e.extension_id');
		$query->where('m.published = 1');
		$query->where('m.parent_id > 0');
		$query->where('m.client_id = 0');
		$query->order('m.lft');

		// Set the query
		$db->setQuery($query);
		if (!($this->_elements = $db->loadObjectList('id'))) {
			JError::raiseWarning(500, RText::sprintf('RERROR_LOADING_MENUS', $db->getErrorMsg()));
			return false;
		}

		foreach($this->_elements as &$element) {
			// Get parent information.
			$parent_tree = array();
			if (isset($this->_elements[$element->parent_id])) {
				$parent_tree  = $this->_elements[$element->parent_id]->tree;
			}

			// Create tree.
			$parent_tree[] = $element->id;
			$element->tree = $parent_tree;

			// Create the query array.
			$url = str_replace('index.php?', '', $element->link);
			$url = str_replace('&amp;', '&', $url);

			parse_str($url, $element->query);
		}
	}

	/**
	 * Gets menu elements by attribute
	 *
	 * @param	string	$attributes	The field name
	 * @param	string	$values		The value of the field
	 * @param	boolean	$firstonly	If true, only returns the first element found
	 *
	 * @return	array
	 */
	public function getelements($attributes, $values, $firstonly = false)
	{
		$attributes = (array) $attributes;
		$values 	= (array) $values;
		$app		= JApplication::getInstance('site');

		if ($app->isSite())
		{
			// Filter by language if not set
			if (($key = array_search('language', $attributes)) === false)
			{
				if ($app->getLanguageFilter())
				{
					$attributes[] 	= 'language';
					$values[] 		= array(JFactory::getLanguage()->getTag(), '*');
				}
			}
			elseif ($values[$key] === null)
			{
				unset($attributes[$key]);
				unset($values[$key]);
			}

			// Filter by access level if not set
			if (($key = array_search('access', $attributes)) === false)
			{
				$attributes[] = 'access';
				$values[] = JFactory::getUser()->getAuthorisedViewLevels();
			}
			elseif ($values[$key] === null)
			{
				unset($attributes[$key]);
				unset($values[$key]);
			}
		}

		return parent::getelements($attributes, $values, $firstonly);
	}

	/**
	 * Get menu element by id
	 *
	 * @param	string	$language	The language code.
	 *
	 * @return	object	The element object
	 * @since	1.5
	 */
	public function getDefault($language = '*')
	{
		if (array_key_exists($language, $this->_default) && JApplication::getInstance('site')->getLanguageFilter()) {
			return $this->_elements[$this->_default[$language]];
		}
		elseif (array_key_exists('*', $this->_default)) {
			return $this->_elements[$this->_default['*']];
		}
		else {
			return 0;
		}
	}

}
