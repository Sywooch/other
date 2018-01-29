<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_breadcrumbs
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

// Get the breadcrumbs
$list	= modBreadCrumbsHelper::getList($params);
$count	= count($list);

// Set the default separator
$separator = modBreadCrumbsHelper::setSeparator($params->get('separator'));
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_breadcrumbs', $params->get('layout', 'default'));
