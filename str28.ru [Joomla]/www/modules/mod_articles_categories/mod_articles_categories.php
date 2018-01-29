<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_articles_categories
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Include the helper functions only once
require_once dirname(__FILE__).'/helper.php';

$list = modArticlesCategoriesHelper::getList($params);
if (!empty($list)) {
	$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
	$startLevel = reset($list)->getParent()->level;
	require JModuleHelper::getLayoutPath('mod_articles_categories', $params->get('layout', 'default'));
}
