<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_footer
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

$app		= JFactory::getApplication();
$date		= JFactory::getDate();
$cur_year	= $date->format('Y');
$csite_name	= $app->getCfg('sitename');

if (JString::strpos(RText :: _('MOD_FOOTER_LINE1'), '%date%')) {
	$line1 = str_replace('%date%', $cur_year, RText :: _('MOD_FOOTER_LINE1'));
}
else {
	$line1 = RText :: _('MOD_FOOTER_LINE1');
}

if (JString::strpos($line1, '%sitename%')) {
	$lineone = str_replace('%sitename%', $csite_name, $line1);
}
else {
	$lineone = $line1;
}

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_footer', $params->get('layout', 'default'));
