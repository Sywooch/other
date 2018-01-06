<?php
/*------------------------------------------------------------------------
# mod_filterednews - Filtered News Module
# ------------------------------------------------------------------------
# author    Jesús Vargas Garita
# copyright Copyright (C) 2010 joomlahill.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomlahill.com
# Technical Support:  Forum - http://www.joomlahill.com/forum
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;

global $filterednews_id;

if ( !$filterednews_id ) : $filterednews_id = 1; endif;

//require_once __DIR__ . '/helper.php';
require_once dirname(__FILE__) . '/helper.php';

$list = modFilteredNewsHelper::getFN_List($params);

if ( !count($list ) ) return;

if ( $alt_title = $params->get('alt_title', '') ) echo '<h3>' . $alt_title . '</h3>';

$layout = $params->get('layout', 'default');

if ( $layout != 'default' ) {
	modFilteredNewsHelper::addFN_CSS($params,$layout,$filterednews_id);
}

require(JModuleHelper::getLayoutPath('mod_filterednews', $layout));

$filterednews_id++;