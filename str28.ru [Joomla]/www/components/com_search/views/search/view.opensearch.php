<?php
/**
 * @package		Retina.Site
 * @subpackage	Weblinks
 * 
 * 
 */

// No direct access
defined('_REXEC') or die;

jimport('retina.application.component.view');
jimport('retina.methods');
jimport('retina.environment.uri');

/**
 * OpenSearch View class for the Search component
 *
 * @static
 * @package		Retina.Site
 * @subpackage	Search
 * @since 1.7
 */
class SearchViewSearch extends JView
{
	function display($tpl = null)
	{
		$doc = JFactory::getDocument();
		$app = JFactory::getApplication();

		$params = JComponentHelper::getParams('com_search');
		$doc->setShortName($params->get('opensearch_name', $app->getCfg('sitename')));
		$doc->setDescription($params->get('opensearch_description', $app->getCfg('MetaDesc')));

		// Add the URL for the search
		$searchUri = JURI::base().'index.php?option=com_search&searchword={searchTerms}';

		// Find the menu element for the search
		$menu	= $app->getMenu();
		$elements	= $menu->getelements('link', 'index.php?option=com_search&view=search');
		if (isset($elements[0])) {
			$searchUri .= '&elementid='.$elements[0]->id;
		}

		$htmlSearch = new JOpenSearchUrl();
		$htmlSearch->template = JRoute::_($searchUri);
		$doc->addUrl($htmlSearch);
	}
}
