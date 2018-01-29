<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_articles_news
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$list = modArticlesNewsHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_articles_news', $params->get('layout', 'horizontal'));
