<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_banners
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$headerText	= trim($params->get('header_text'));
$footerText	= trim($params->get('footer_text'));

require_once RPATH_ROOT . '/admin/components/com_banners/helpers/banners.php';
BannersHelper::updateReset();
$list = &modBannersHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_banners', $params->get('layout', 'default'));
