<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_search
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$lang = JFactory::getLanguage();

if ($params->get('opensearch', 1)) {
	$doc = JFactory::getDocument();
	$app = JFactory::getApplication();

	$ostitle = $params->get('opensearch_title', RText::_('MOD_SEARCH_SEARCHBUTTON_TEXT').' '.$app->getCfg('sitename'));
	$doc->addHeadLink(JURI::getInstance()->toString(array('scheme', 'host', 'port')).JRoute::_('&option=com_search&format=opensearch'), 'search', 'rel', array('title' => htmlspecialchars($ostitle), 'type' => 'application/opensearchdescription+xml'));
}

$upper_limit = $lang->getUpperLimitSearchWord();

$button			= $params->get('button', '');
$imagebutton	= $params->get('imagebutton', '');
$button_pos		= $params->get('button_pos', 'left');
$button_text	= htmlspecialchars($params->get('button_text', RText::_('MOD_SEARCH_SEARCHBUTTON_TEXT')));
$width			= intval($params->get('width', 20));
$maxlength		= $upper_limit;
$text			= htmlspecialchars($params->get('text', RText::_('MOD_SEARCH_SEARCHBOX_TEXT')));
$label			= htmlspecialchars($params->get('label', RText::_('MOD_SEARCH_LABEL_TEXT')));
$set_elementid		= intval($params->get('set_elementid', 0));
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

if ($imagebutton) {
	$img = modSearchHelper::getSearchImage($button_text);
}
$melementid = $set_elementid > 0 ? $set_elementid : JRequest::getInt('elementid');
require JModuleHelper::getLayoutPath('mod_search', $params->get('layout', 'default'));
