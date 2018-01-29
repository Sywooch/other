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
require_once JPATH_SITE.'/modules/mod_rseventspro_attendees/helper.php';

JFactory::getDocument()->addStyleSheet(JURI::root().'modules/mod_rseventspro_attendees/style.css');

$guests = modRseventsProAttendees::getGuests();
$suffix	= $params->get('moduleclass_sfx');
$option = JFactory::getApplication()->input->get('option');
$layout = JFactory::getApplication()->input->get('layout');

if ($option == 'com_rseventspro' && $layout == 'show' && !empty($guests))
	require(JModuleHelper::getLayoutPath('mod_rseventspro_attendees'));