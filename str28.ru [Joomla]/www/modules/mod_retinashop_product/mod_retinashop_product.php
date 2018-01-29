<?php
defined('_REXEC') or die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/*
* featured/Latest/Topten/Random Products Module
*
* @version $Id: mod_retinashop_product.php 2789 2011-02-28 12:41:01Z oscar $
* @package retinashop
* @subpackage modules
*
* 	@copyright (C) 2010 - Patrick Kohl
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* retinashop is Free Software.
* retinashop comes with absolute no warranty.
*
* www.retinashop.net
*/

if (!class_exists( 'rsModel' )) require(RPATH_admin.DS.'components'.DS.'com_retinashop'.DS.'helpers'.DS.'rsmodel.php');

// Setting
$max_elements = 		$params->get( 'max_elements', 2 ); //maximum number of elements to display
$layout = $params->get('layout','default');
$category_id = 		$params->get( 'retinashop_category_id', null ); // Display products from this category only
$filter_category = 	(bool)$params->get( 'filter_category', 0 ); // Filter the category
$display_style = 	$params->get( 'display_style', "div" ); // Display Style
$products_per_row = $params->get( 'products_per_row', 4 ); // Display X products per Row
$show_price = 		(bool)$params->get( 'show_price', 1 ); // Display the Product Price?
$show_addtocart = 	(bool)$params->get( 'show_addtocart', 1 ); // Display the "Add-to-Cart" Link?
$headerText = 		$params->get( 'headerText', '' ); // Display a Header Text
$footerText = 		$params->get( 'footerText', ''); // Display a footerText
$Product_group = 	$params->get( 'product_group', 'featured'); // Display a footerText

$mainframe = Jfactory::getApplication();
$retinashop_currency_id = $mainframe->getUserStateFromRequest( "retinashop_currency_id", 'retinashop_currency_id',JRequest::getInt('retinashop_currency_id',0) );


$key = 'products'.$category_id.'.'.$max_elements.'.'.$filter_category.'.'.$display_style.'.'.$products_per_row.'.'.$show_price.'.'.$show_addtocart.'.'.$Product_group.'.'.$retinashop_currency_id;

$cache	= JFactory::getCache('mod_retinashop_product', 'output');
if (!($output = $cache->get($key))) {
	ob_start();
	// Try to load the data from cache.


	/* Load  rs fonction */
	if (!class_exists( 'mod_retinashop_product' )) require('helper.php');



	$vendorId = JRequest::getInt('vendorid', 1);



	if ($filter_category ) $filter_category = TRUE;

	$productModel = rsModel::getModel('Product');

	$products = $productModel->getProductListing($Product_group, $max_elements, $show_price, true, false,$filter_category, $category_id);
	$productModel->addImages($products);

	$totalProd = 		count( $products);
	if(empty($products)) return false;
	$currency = CurrencyDisplay::getInstance( );

	if ($show_addtocart) {
		rsJsApi::jQuery();
		rsJsApi::jPrice();
		rsJsApi::cssSite();
	}
	/* Load tmpl default */
require(JModuleHelper::getLayoutPath('mod_retinashop_product',$layout));
	$output = ob_get_clean();
	$cache->store($output, $key);
}
echo $output;
?>
