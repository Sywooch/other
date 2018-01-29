<?php
/**
 * @package Sj rs Slickslider
 * @version 2.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */
defined( '_REXEC' ) or die;

if ( !function_exists('_core_register') ){
	function _core_register($class, $path){
		if ( file_exists($path) ){
			JLoader::register($class, $path);
		}
	}
}
if ( file_exists(RPATH_admin.'/components/com_retinashop/helpers/config.php') ){
	require_once RPATH_admin.'/components/com_retinashop/helpers/config.php';
}
if ( defined('RPATH_rs_admin') ){
	// helpers
	_core_register('calculationHelper',	RPATH_rs_admin.'/helpers/calculationh.php');
	_core_register('CurrencyDisplay',	RPATH_rs_admin.'/helpers/currencydisplay.php');
	_core_register('rsImage',			RPATH_rs_admin.'/helpers/image.php');
	_core_register('ShopFunctions',		RPATH_rs_admin.'/helpers/shopfunctions.php');

	// models
	_core_register('retinashopModelCategory',	RPATH_rs_admin.'/models/category.php');
	_core_register('retinashopModelProduct',	RPATH_rs_admin.'/models/product.php');
	_core_register('retinashopModelRatings',	RPATH_rs_admin.'/models/ratings.php');
	_core_register('retinashopModelVendor',		RPATH_rs_admin.'/models/vendor.php');
	_core_register('retinashopModelretinashop',	RPATH_rs_admin.'/models/retinashop.php');
}
if ( defined('RPATH_rs_SITE') ){
	_core_register('retinashopCart',	RPATH_rs_SITE.'/helpers/cart.php');
	_core_register('CouponHelper',	RPATH_rs_SITE.'/helpers/coupon.php');
	_core_register('shopFunctionsF',	RPATH_rs_SITE.'/helpers/shopfunctionsf.php');
}
