<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_related_elements
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$cacheparams = new stdClass;
$cacheparams->cachemode = 'safeuri';
$cacheparams->class = 'modRelatedelementsHelper';
$cacheparams->method = 'getList';
$cacheparams->methodparams = $params;
$cacheparams->modeparams = array('id'=>'int', 'elementid'=>'int');

$list = JModuleHelper::moduleCache ($module, $params, $cacheparams);

if (!count($list)) {
	return;
}

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$showDate = $params->get('showDate', 0);

require JModuleHelper::getLayoutPath('mod_related_elements', $params->get('layout', 'default'));
