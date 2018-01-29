<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_articles_popular
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$list = modArticlesPopularHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_articles_popular', $params->get('layout', 'default'));
