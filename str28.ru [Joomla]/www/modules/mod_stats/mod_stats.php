<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_stats
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$serverinfo = $params->get('serverinfo');
$siteinfo	= $params->get('siteinfo');

$list = modStatsHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_stats', $params->get('layout', 'default'));
