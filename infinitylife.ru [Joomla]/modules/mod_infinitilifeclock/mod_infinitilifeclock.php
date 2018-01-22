<?php
/**
 * @package     Ghost_Russia.JoomlaSite
 * @subpackage  Templates.Ghost_Russia.mod_infinitilifeClock
 *
 * @copyright   Copyright (C) 2007 - 2015 Ghost_Russia. All rights reserved.
 * @author Vladislav Fursov
 */

defined('_JEXEC') or die;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$doc = JFactory::getDocument();
$doc->addScript(JURI::base() . '/modules/mod_infinitilifeclock/js/clock.js');
require JModuleHelper::getLayoutPath('mod_infinitilifeclock', $params->get('layout', 'default'));
