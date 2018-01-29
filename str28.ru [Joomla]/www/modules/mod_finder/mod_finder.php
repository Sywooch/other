<?php
/**
 * @package     Retina.Site
 * @subpackage  mod_finder
 *
 * @copyright   
 * @license     
 */

defined('_REXEC') or die;

// Register dependent classes.
JLoader::register('FinderHelperRoute', RPATH_SITE . '/components/com_finder/helpers/route.php');
JLoader::register('FinderHelperLanguage', RPATH_admin . '/components/com_finder/helpers/language.php');

// Include the helper.
require_once dirname(__FILE__) . '/helper.php';

if (!defined('FINDER_PATH_INDEXER'))
{
	define('FINDER_PATH_INDEXER', RPATH_admin . '/components/com_finder/helpers/indexer');
}
JLoader::register('FinderIndexerQuery', FINDER_PATH_INDEXER . '/query.php');

// Check for OpenSearch
if ($params->get('opensearch', 1))
{
/*
This code intentionally commented
	$doc = JFactory::getDocument();
	$app = JFactory::getApplication();

	$ostitle = $params->get('opensearch_title', RText::_('MOD_FINDER_SEARCHBUTTON_TEXT') . ' ' . $app->getCfg('sitename'));
	$doc->addHeadLink(
						JURI::getInstance()->toString(array('scheme', 'host', 'port')) . JRoute::_('&option=com_finder&format=opensearch'),
						'search', 'rel', array('title' => $ostitle, 'type' => 'application/opensearchdescription+xml')
					);
*/

}

// Initialize module parameters.
$params->def('field_size', 20);

// Get the route.
$route = FinderHelperRoute::getSearchRoute($params->get('f', null));

// Load component language file.
FinderHelperLanguage::loadComponentLanguage();

// Load plug-in language files.
FinderHelperLanguage::loadPluginLanguage();

// Get Smart Search query object.
$query = modFinderHelper::getQuery($params);

require JModuleHelper::getLayoutPath('mod_finder', $params->get('layout', 'default'));
