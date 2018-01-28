<?php
/**
* @version 1.0.0
* @package RSEvents!Pro 1.0.0
* @copyright (C) 2012 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.plugin.helper');

if (!file_exists(JPATH_SITE.'/components/com_rseventspro/helpers/rseventspro.php')) return;
require_once JPATH_SITE.'/components/com_rseventspro/helpers/rseventspro.php';
require_once JPATH_SITE.'/components/com_rseventspro/helpers/route.php';
require_once JPATH_SITE.'/modules/mod_rseventspro_slider/helper.php';

JHTML::_('behavior.tooltip');

// Get events
$events = modRseventsProSlider::getEvents($params);

// Get params
$suffix		= $params->get('moduleclass_sfx');
$links		= $params->get('links',0);
$layout		= $params->get('layout','default');
$theme		= $params->get('theme','blue');
$pretext	= $params->get('text_above','');
$posttext	= $params->get('text_below','');
$buttons	= $params->get('buttons',1);
$links		= $params->get('links',0);
$height		= $params->get('height',250);
$width		= $params->get('width',500);
$interval	= $params->get('interval',3);
$duration	= $params->get('duration',1);
$effect		= $params->get('effect','Fx.Transitions.Bounce');
$method		= $params->get('effectmethod','easeOut');
$autoplay	= $params->get('autoplay',1);
$length		= $params->get('desc_length',200);
$title		= $params->get('showtitle',1);
$date		= $params->get('showdate',1);
$image_type	= $params->get('image_type',1);
$repeating	= $params->get('repeating',1);

if ( $image_type == 0 )
	$image_path = 'components/com_rseventspro/assets/images/events/thumbs/s_';
elseif ($image_type == 1 )
	$image_path = 'components/com_rseventspro/assets/images/events/thumbs/b_';
else 
	$image_path = 'components/com_rseventspro/assets/images/events/';

// Get Timeline params
$nr_events	= (int) $params->get('eventsperpane',3);
$teffect	= $params->get('effecttimeline','Fx.Transitions.Expo');
$tmethod	= $params->get('effectmethodtimeline','easeInOut');
$tduration	= (int) $params->get('durationtimeline',1);

// Load language
JFactory::getLanguage()->load('com_rseventspro');

// Add stylesheets
$doc = JFactory::getDocument();

if ($layout == 'default' || $layout == 'advanced') {
	$doc->addStyleSheet(JURI::root().'modules/mod_rseventspro_slider/assets/css/'.$layout.'/style_'.$theme.'.css','text/css', 'screen');
	$doc->addScript(JURI::root().'modules/mod_rseventspro_slider/assets/js/noobslide.js');
}

if ($layout == 'timeline') {
	$doc->addStyleSheet(JURI::root().'modules/mod_rseventspro_slider/assets/css/timeline/style.css','text/css', 'screen');
	$doc->addScript(JURI::root().'modules/mod_rseventspro_slider/assets/js/slider.js');	
}

// Get the Itemid
$itemid = $params->get('itemid');
$itemid = !empty($itemid) ? $itemid : RseventsproHelperRoute::getEventsItemid();

require(JModuleHelper::getLayoutPath('mod_rseventspro_slider',$layout));