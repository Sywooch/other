<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_feed
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$rssurl	= $params->get('rssurl', '');
$rssrtl	= $params->get('rssrtl', 0);

//check if feed URL has been set
if (empty ($rssurl))
{
	echo '<div>';
	echo RText::_('MOD_FEED_ERR_NO_URL');
	echo '</div>';
	return;
}

$feed = modFeedHelper::getFeed($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_feed', $params->get('layout', 'default'));
