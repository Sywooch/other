<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_whosonline
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Include the whosonline functions only once
require_once dirname(__FILE__).'/helper.php';

$showmode = $params->get('showmode', 0);

if ($showmode == 0 || $showmode == 2) {
	$count	= modWhosonlineHelper::getOnlineCount();
}

if ($showmode > 0) {
	$names	= modWhosonlineHelper::getOnlineUserNames($params);
}

$linknames = $params->get('linknames', 0);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_whosonline', $params->get('layout', 'default'));
