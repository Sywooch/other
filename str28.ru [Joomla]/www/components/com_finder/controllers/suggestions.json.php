<?php
/**
 * @package     Retina.Site
 * @subpackage  com_finder
 *
 * @copyright   
 * @license     
 */

defined('_REXEC') or die;

jimport('retina.application.component.controller');

/**
 * Suggestions JSON controller for Finder.
 *
 * @package     Retina.Site
 * @subpackage  com_finder
 * @since       2.5
 */
class FinderControllerSuggestions extends JController
{
	/**
	 * Method to find search query suggestions.
	 *
	 * @return  void
	 *
	 * @since   2.5
	 */
	public function display()
	{
		$return = array();

		$params = JComponentHelper::getParams('com_finder');
		if ($params->get('show_autosuggest', 1))
		{
			// Get the suggestions.
			$model = $this->getModel('Suggestions', 'FinderModel');
			$return = $model->getelements();
		}

		// Check the data.
		if (empty($return))
		{
			$return = array();
		}

		// Send the response.
		echo json_encode($return);
		JFactory::getApplication()->close();
	}
}
