<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_weblinks
 * @copyright	Copyright (C) 2005 - 2009 Open Source Matters, Inc. All rights reserved.
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Include the weblinks functions only once
require_once dirname(__FILE__).'/helper.php';

$list = modWeblinksHelper::getList($params);

if (!count($list)) {
	return;
}

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_weblinks', $params->get('layout', 'default'));
