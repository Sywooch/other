<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_custom
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

if ($params->def('prepare_content', 1))
{
	JPluginHelper::importPlugin('content');
	$module->content = JHtml::_('content.prepare', $module->content, '', 'mod_custom.content');
}

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_custom', $params->get('layout', 'default'));
