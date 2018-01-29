<?php
defined('_REXEC') or  die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/*
*Cart Ajax Module
*
* @version $Id: mod_retinashop_cart.php 5482 2012-02-19 00:49:18Z Milbo $
* @package retinashop
* @subpackage modules
*
* 	@copyright (C) 2010 - Patrick Kohl
// W: demo.st42.fr
// E: cyber__fr|at|hotmail.com
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* retinashop is Free Software.
* retinashop comes with absolute no warranty.
*
* www.retinashop.net
*/
/*if (!class_exists( 'rsConfig' )) {
require(RPATH_admin . DS . 'components' . DS . 'com_retinashop'.DS.'helpers'.DS.'config.php');}
//rsConfig::loadConfig();

rsJsApi::jPrice();
rsJsApi::cssSite();*/
$jsVars  = ' jQuery(document).ready(function(){
	jQuery(".rsCartModule").productUpdate();

});' ;

if (!class_exists( 'rsConfig' )) require(RPATH_admin . DS . 'components' . DS . 'com_retinashop'.DS.'helpers'.DS.'config.php');

if(!class_exists('retinashopCart')) require(RPATH_rs_SITE.DS.'helpers'.DS.'cart.php');
$cart = retinashopCart::getCart(false);
$data = $cart->prepareAjaxData();
$lang = JFactory::getLanguage();
$extension = 'com_retinashop';
$lang->load($extension);//  when AJAX it needs to be loaded manually here >> in case you are outside retinashop !!!
if ($data->totalProduct>1) $data->totalProductTxt = RText::sprintf('COM_RETINASHOP_CART_X_PRODUCTS', $data->totalProduct);
else if ($data->totalProduct == 1) $data->totalProductTxt = RText::_('COM_RETINASHOP_CART_ONE_PRODUCT');
else $data->totalProductTxt = RText::_('COM_RETINASHOP_EMPTY_CART');
if (false && $data->dataValidated == true) {
	$taskRoute = '&task=confirm';
	$linkName = RText::_('COM_RETINASHOP_CART_CONFIRM');
} else {
	$taskRoute = '';
	$linkName = RText::_('COM_RETINASHOP_CART_SHOW');
}
$useSSL = rsConfig::get('useSSL',0);
$useXHTML = true;
$data->cart_show = '<a style ="float:right;" href="'.JRoute::_("index.php?option=com_retinashop&view=cart".$taskRoute,$useXHTML,$useSSL).'">'.$linkName.'</a>';
$data->billTotal = $lang->_('COM_RETINASHOP_CART_TOTAL').' : <strong>'. $data->billTotal .'</strong>';

rsJsApi::jQuery();
rsJsApi::jPrice();
rsJsApi::cssSite();
$document = JFactory::getDocument();
//$document->addScriptDeclaration($jsVars);
$moduleclass_sfx = $params->get('moduleclass_sfx', '');
$show_price = (bool)$params->get( 'show_price', 1 ); // Display the Product Price?
$show_product_list = (bool)$params->get( 'show_product_list', 1 ); // Display the Product Price?
/* Laod tmpl default */
require(JModuleHelper::getLayoutPath('mod_retinashop_cart'));
 ?>