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
require_once JPATH_SITE.'/components/com_rseventspro/helpers/calendar.php';
require_once JPATH_SITE.'/modules/mod_rseventspro_calendar/helper.php';

JHTML::_('behavior.tooltip');

// Get events
$events = modRseventsProCalendar::getEvents($params);

// Load language
JFactory::getLanguage()->load('com_rseventspro');

// Add stylesheets
$doc = JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'modules/mod_rseventspro_calendar/style.css');
$doc->addScript(JURI::root().'components/com_rseventspro/assets/js/scripts.js');

// Get a new instance of the calendar
$calendar = new RSEPROCalendar($events,$params,true);
$calendar->class_suffix = $params->get('moduleclass_sfx','');

$itemid = $params->get('itemid');
$itemid = !empty($itemid) ? $itemid : RseventsproHelperRoute::getCalendarItemid();

require(JModuleHelper::getLayoutPath('mod_rseventspro_calendar'));