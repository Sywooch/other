<?php
defined('_REXEC') or  die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/*
* Module Helper
*
* @package retinashop
* @copyright (C) 2010 - Patrick Kohl
* @ Email: cyber__fr|at|hotmail.com
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* retinashop is Free Software.
* retinashop comes with absolute no warranty.
*
* www.retinashop.net
*/
if (!class_exists( 'rsConfig' )) require(RPATH_admin . DS . 'components' . DS . 'com_retinashop'.DS.'helpers'.DS.'config.php');
rsConfig::loadConfig();
if (!class_exists( 'rsImage' )) require(RPATH_admin . DS . 'components' . DS . 'com_retinashop'.DS.'helpers'.DS.'image.php');
if(!class_exists('TableMedias')) require(RPATH_rs_admin.DS.'tables'.DS.'medias.php');
if(!class_exists('TableManufacturer_medias')) require(RPATH_rs_admin.DS.'tables'.DS.'manufacturer_medias.php');
if(!class_exists('TableManufacturers')) require(RPATH_rs_admin.DS.'tables'.DS.'manufacturers.php');
if (!class_exists( 'retinashopModelManufacturer' )){
   JLoader::import( 'manufacturer', RPATH_admin . DS . 'components' . DS . 'com_retinashop' . DS . 'models' );
}
?>