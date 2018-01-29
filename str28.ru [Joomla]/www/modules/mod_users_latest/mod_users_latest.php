<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_users_latest
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Include the latest functions only once
require_once dirname(__FILE__).'/helper.php';
$shownumber = $params->get('shownumber', 5);
$names	= moduserslatestHelper::getUsers($params);
$linknames = $params->get('linknames', 0);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_users_latest', $params->get('layout', 'default'));
