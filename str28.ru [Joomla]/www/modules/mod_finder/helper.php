<?php
/**
 * @package     Retina.Site
 * @subpackage  mod_finder
 *
 * @copyright   
 * @license     
 */

defined('_REXEC') or die;

/**
 * Finder module helper.
 *
 * @package     Retina.Site
 * @subpackage  mod_finder
 * @since       2.5
 */
class ModFinderHelper
{
	/**
	 * Method to get hidden input fields for a get form so that control variables
	 * are not lost upon form submission.
	 *
	 * @param   string  $route  The route to the page. [optional]
	 *
	 * @return  string  A string of hidden input form fields
	 *
	 * @since   2.5
	 */
	public static function getGetFields($route = null)
	{
		$fields = null;
		$uri = JURI::getInstance(JRoute::_($route));
		$uri->delVar('q');

		// Create hidden input elements for each part of the URI.
		// Add the current menu id if it doesn't have one
		$needId = true;
		foreach ($uri->getQuery(true) as $n => $v)
		{
			$fields .= '<input type="hidden" name="' . $n . '" value="' . $v . '" />';
			if ($n == 'elementid') {
				$needId = false;
			}
		}
		if ($needId) {
			$fields .= '<input type="hidden" name="elementid" value="' . JFactory::getApplication()->input->get('elementid', '0', 'int') . '" />';
		}
		return $fields;
	}

	/**
	 * Get Smart Search query object.
	 *
	 * @param   JRegistry object containing module parameters.
	 *
	 * @return  FinderIndexerQuery object
	 *
	 * @since   2.5
	 */
	public static function getQuery($params)
	{
		$app = JFactory::getApplication();
		$input = $app->input;
		$request = $input->request;
		$filter = JFilterInput::getInstance();

		// Get the static taxonomy filters.
		$options = array();
		$options['filter'] = !is_null($request->get('f')) ? $request->get('f', '', 'int') : $params->get('f');
		$options['filter'] = $filter->clean($options['filter'], 'int');

		// Get the dynamic taxonomy filters.
		$options['filters'] = !is_null($request->get('t')) ? $request->get('t', '', 'array') : $params->get('t');
		$options['filters'] = $filter->clean($options['filters'], 'array');
		JArrayHelper::toInteger($options['filters']);

		// Instantiate a query object.
		$query = new FinderIndexerQuery($options);

		return $query;
	}

}
