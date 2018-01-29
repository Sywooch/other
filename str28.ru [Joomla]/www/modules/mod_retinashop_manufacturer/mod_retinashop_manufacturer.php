<?php
defined('_REXEC') or  die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/*
* manufacturer Module
*
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
/* Load  rs fonction */
require('helper.php');
if (!class_exists( 'retinashopModelManufacturer' ))
   JLoader::import( 'manufacturer', RPATH_admin . DS . 'components' . DS . 'com_retinashop' . DS . 'models' );


$vendorId = JRequest::getInt('vendorid', 1);
$model = rsModel::getModel('Manufacturer');

$display_style = 	$params->get( 'display_style', "div" ); // Display Style
$manufacturers_per_row = $params->get( 'manufacturers_per_row', 1 ); // Display X manufacturers per Row
$headerText = 		$params->get( 'headerText', '' ); // Display a Header Text
$footerText = 		$params->get( 'footerText', ''); // Display a footerText
$show = 			$params->get( 'show', 'all'); // Display a footerText
$manufacturers = $model->getManufacturers(true, true,true);
$model->addImages($manufacturers);
if(empty($manufacturers)) return false;
/* load the template */
require(JModuleHelper::getLayoutPath('mod_retinashop_manufacturer'));
?>