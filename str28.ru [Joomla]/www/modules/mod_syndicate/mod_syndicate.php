<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_syndicate
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$params->def('format', 'rss');

$link = modSyndicateHelper::getLink($params);

if (is_null($link)) {
	return;
}

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$text = htmlspecialchars($params->get('text'));

require JModuleHelper::getLayoutPath('mod_syndicate', $params->get('layout', 'default'));
