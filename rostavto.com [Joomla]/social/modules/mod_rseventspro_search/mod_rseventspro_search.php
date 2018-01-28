<?php
/**
* @version 1.0.0
* @package RSEvents!Pro 1.0.0
* @copyright (C) 2012 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

if (!file_exists(JPATH_SITE.'/components/com_rseventspro/helpers/rseventspro.php')) return;
require_once JPATH_SITE.'/components/com_rseventspro/helpers/rseventspro.php';
require_once JPATH_SITE.'/components/com_rseventspro/helpers/route.php';
require_once JPATH_SITE.'/modules/mod_rseventspro_search/helper.php';

JHTML::_('behavior.tooltip');

$suffix		= $params->get('moduleclass_sfx');
$layout		= $params->get('layout','ajax');
$links		= (int) $params->get('links',0);
$categories	= (int) $params->get('categories',0);
$locations	= (int) $params->get('locations',0);
$start		= (int) $params->get('start',0);
$end		= (int) $params->get('end',0);
$archive	= (int) $params->get('archive',0);

$locationslist	= JHTML::_('select.genericlist', modRseventsProSearch::getLocations(), 'rslocations[]', 'size="5" multiple="multiple" style="width:75%"', 'value', 'text' ,0);
$archivelist	= JHTML::_('select.genericlist', modRseventsProSearch::getYesNo(), 'rsarchive', 'class="input-small"', 'value', 'text' ,0);
$categorieslist = JHTML::_('select.genericlist', modRseventsProSearch::getCategories(), 'rscategories[]', 'size="5" multiple="multiple" style="width:75%"', 'value', 'text' ,0);

// Load language
JFactory::getLanguage()->load('com_rseventspro');

// Add stylesheets
JFactory::getDocument()->addStyleSheet(JURI::root().'modules/mod_rseventspro_search/assets/css/style.css');
JFactory::getDocument()->addScript(JURI::root().'components/com_rseventspro/assets/js/scripts.js');
if (rseventsproHelper::isJ3()) JFactory::getDocument()->addStyleSheet(JURI::root().'modules/mod_rseventspro_search/assets/css/j3.css');

if (($start || $end) && $layout == 'default')
	JFactory::getDocument()->addScriptDeclaration("window.addEvent('domready', function(){ rs_check_dates(); });");

// Get the Itemid
$itemid = $params->get('itemid');
$itemid = !empty($itemid) ? $itemid : RseventsproHelperRoute::getEventsItemid();

require(JModuleHelper::getLayoutPath('mod_rseventspro_search',$layout));