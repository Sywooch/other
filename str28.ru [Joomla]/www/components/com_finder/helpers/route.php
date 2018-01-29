<?php
/**
 * @package     Retina.Site
 * @subpackage  com_finder
 *
 * @copyright   
 * @license     
 */

defined('_REXEC') or die;

jimport('retina.application.component.helper');

/**
 * Finder route helper class.
 *
 * @package     Retina.Site
 * @subpackage  com_finder
 * @since       2.5
 */
class FinderHelperRoute
{
	/**
	 * Method to get the route for a search page.
	 *
	 * @param   integer  $f  The search filter id. [optional]
	 * @param   string   $q  The search query string. [optional]
	 *
	 * @return  string  The search route.
	 *
	 * @since   2.5
	 */
	public static function getSearchRoute($f = null, $q = null)
	{
		// Get the menu element id.
		$query = array('view' => 'search', 'q' => $q, 'f' => $f);
		$element = self::getelementid($query);

		// Get the base route.
		$uri = clone(JUri::getInstance('index.php?option=com_finder&view=search'));

		// Add the pre-defined search filter if present.
		if ($f !== null)
		{
			$uri->setVar('f', $f);
		}

		// Add the search query string if present.
		if ($q !== null)
		{
			$uri->setVar('q', $q);
		}

		// Add the menu element id if present.
		if ($element !== null)
		{
			$uri->setVar('elementid', $element);
		}

		return $uri->toString(array('path', 'query'));
	}

	/**
	 * Method to get the route for an advanced search page.
	 *
	 * @param   integer  $f  The search filter id. [optional]
	 * @param   string   $q  The search query string. [optional]
	 *
	 * @return  string  The advanced search route.
	 *
	 * @since   2.5
	 */
	public static function getAdvancedRoute($f = null, $q = null)
	{
		// Get the menu element id.
		$query = array('view' => 'advanced', 'q' => $q, 'f' => $f);
		$element = self::getelementid($query);

		// Get the base route.
		$uri = clone(JUri::getInstance('index.php?option=com_finder&view=advanced'));

		// Add the pre-defined search filter if present.
		if ($q !== null)
		{
			$uri->setVar('f', $f);
		}

		// Add the search query string if present.
		if ($q !== null)
		{
			$uri->setVar('q', $q);
		}

		// Add the menu element id if present.
		if ($element !== null)
		{
			$uri->setVar('elementid', $element);
		}

		return $uri->toString(array('path', 'query'));
	}

	/**
	 * Method to get the most appropriate menu element for the route based on the
	 * supplied query needles.
	 *
	 * @param   array  $query  An array of URL parameters.
	 *
	 * @return  mixed  An integer on success, null otherwise.
	 *
	 * @since   2.5
	 */
	public static function getelementid($query)
	{
		static $elements, $active;

		// Get the menu elements for com_finder.
		if (!$elements || !$active)
		{
			$app = JFactory::getApplication('site');
			$com = JComponentHelper::getComponent('com_finder');
			$menu = $app->getMenu();
			$active = $menu->getActive();
			$elements = $menu->getelements('component_id', $com->id);
			$elements = is_array($elements) ? $elements : array();
		}

		// Try to match the active view and filter.
		if ($active && @$active->query['view'] == @$query['view'] && @$active->query['f'] == @$query['f'])
		{
			return $active->id;
		}

		// Try to match the view, query, and filter.
		foreach ($elements as $element)
		{
			if (@$element->query['view'] == @$query['view'] && @$element->query['q'] == @$query['q'] && @$element->query['f'] == @$query['f'])
			{
				return $element->id;
			}
		}

		// Try to match the view and filter.
		foreach ($elements as $element)
		{
			if (@$element->query['view'] == @$query['view'] && @$element->query['f'] == @$query['f'])
			{
				return $element->id;
			}
		}

		// Try to match the view.
		foreach ($elements as $element)
		{
			if (@$element->query['view'] == @$query['view'])
			{
				return $element->id;
			}
		}

		return null;
	}
}
