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
require_once JPATH_SITE.'/modules/mod_rseventspro_map/helper.php';

JFactory::getDocument()->addScript('https://maps.google.com/maps/api/js?sensor=false');
JFactory::getDocument()->addStyleSheet(JURI::root(true).'/modules/mod_rseventspro_map/style.css');
JFactory::getLanguage()->load('com_rseventspro');

$events		= modRseventsProMap::getEvents($params);
$width		= $params->get('width',0);
$width		= empty($width) ? '99%' : $width.'px';
$height		= $params->get('height',250);

// Get the Itemid
$itemid = $params->get('itemid');
$itemid = !empty($itemid) ? $itemid : RseventsproHelperRoute::getEventsItemid();

if (!empty($events))
	require(JModuleHelper::getLayoutPath('mod_rseventspro_map'));