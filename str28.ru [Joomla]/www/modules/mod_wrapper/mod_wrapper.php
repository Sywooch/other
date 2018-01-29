<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_wrapper
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$params = modWrapperHelper::getParams($params);

$load	= $params->get('load');
$url	= htmlspecialchars($params->get('url'));
$target = htmlspecialchars($params->get('target'));
$width	= htmlspecialchars($params->get('width'));
$height = htmlspecialchars($params->get('height'));
$scroll = htmlspecialchars($params->get('scrolling'));
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_wrapper', $params->get('layout', 'default'));
