<?php
/**
 * @package     mod_dmsfilter
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later
 * @author      Misha Datsko <misha@datsko.info> - http://datsko.info
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once(dirname(__FILE__).DS.'helper.php' );

$act = $params->get('act','default');
$title_tag = $params->get('title_tag','h3');
$title_categories = $params->get('title_categories','Categories');
$title_manufacturers = $params->get('title_manufacturers','Manufacturers');
$title_prices = $params->get('title_prices','Prices');
$show_titles = $params->get('show_titles','0');
$show_categories = $params->get('show_categories','0');
$show_manufacturers = $params->get('show_manufacturers','0');
$show_prices = $params->get('show_prices','0');
$jquery = $params->get('jquery','0');
$jquerynoconflict = $params->get('jquerynoconflict','0');
$jqueryui = $params->get('jqueryui','0');
$jqueryuicss = $params->get('jqueryuicss','0');
$prow = $params->get('prow',3);
$cbrowse = $params->get('cbrowse','browse-view');
$inmodal = $params->get('inmodal','0');
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$document = JFactory::getDocument();
if($jqueryuicss){
	$document->addStyleSheet('//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css');
}
if($jquery){
	$document->addScript('//code.jquery.com/jquery-1.10.2.js');
}
if($jquerynoconflict){
	$document->addScriptDeclaration('jQuery.noConflict();');
}
if($jqueryui){
	$document->addScript('//code.jquery.com/ui/1.10.4/jquery-ui.js');
}
$document->addStyleSheet(JURI::base().'modules/mod_dmsfilter/css/style.css');
$document->addScript(JURI::base().'modules/mod_dmsfilter/js/js.js');

$filterdata = modDmsfilterHelper::getFilterdata($params);
require(JModuleHelper::getLayoutPath('mod_dmsfilter'));
?>
