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
require_once JPATH_SITE.'/modules/mod_rseventspro_location/helper.php';

JFactory::getDocument()->addStyleSheet(JURI::root().'modules/mod_rseventspro_location/style.css');

$location	= modRseventsProLocation::getLocation();
$suffix		= $params->get('moduleclass_sfx');
$map		= $params->get('showmap',1);
$address	= $params->get('showaddress',1);
$url		= $params->get('showurl',1);
$width		= (int) $params->get('width',190);
$height		= (int) $params->get('height',170);
$zoom		= (int) $params->get('zoom',10);

// Get the Itemid
$itemid = $params->get('itemid');
$itemid = !empty($itemid) ? $itemid : RseventsproHelperRoute::getEventsItemid();

$option = JFactory::getApplication()->input->get('option');
$layout = JFactory::getApplication()->input->get('layout');

if ($option == 'com_rseventspro' && $layout == 'show' && !empty($location))
	require(JModuleHelper::getLayoutPath('mod_rseventspro_location'));