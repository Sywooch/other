<?php
/**
 * @package     Retina.Site
 * @subpackage  com_finder
 *
 * @copyright   
 * @license     
 */

// No direct access
defined('_REXEC') or die;

jimport('retina.application.component.view');
jimport('retina.methods');
jimport('retina.environment.uri');

/**
 * OpenSearch View class for Finder
 *
 * @package     Retina.Site
 * @subpackage  com_finder
 * @since       2.5
 */
class FinderViewSearch extends JView
{
	/**
	 * Method to display the view.
	 *
	 * @param   string  $tpl  A template file to load. [optional]
	 *
	 * @return  mixed  JError object on failure, void on success.
	 *
	 * @since   2.5
	 */
	public function display($tpl = null)
	{
		$doc = JFactory::getDocument();
		$app = JFactory::getApplication();

		$params = JComponentHelper::getParams('com_finder');
		$doc->setShortName($params->get('opensearch_name', $app->getCfg('sitename')));
		$doc->setDescription($params->get('opensearch_description', $app->getCfg('MetaDesc')));

		// Add the URL for the search
		$searchUri = JURI::base() . 'index.php?option=com_finder&q={searchTerms}';

		// Find the menu element for the search
		$menu = $app->getMenu();
		$elements = $menu->getelements('link', 'index.php?option=com_finder&view=search');
		if (isset($elements[0]))
		{
			$searchUri .= '&elementid=' . $elements[0]->id;
		}

		$htmlSearch = new JOpenSearchUrl;
		$htmlSearch->template = JRoute::_($searchUri);
		$doc->addUrl($htmlSearch);
	}
}
