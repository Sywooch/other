<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_random_image
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$link	= $params->get('link');

$folder	= modRandomImageHelper::getFolder($params);
$images	= modRandomImageHelper::getImages($params, $folder);

if (!count($images)) {
	echo RText::_('MOD_RANDOM_IMAGE_NO_IMAGES');
	return;
}

$image = modRandomImageHelper::getRandomImage($params, $images);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
require JModuleHelper::getLayoutPath('mod_random_image', $params->get('layout', 'default'));
