<?php
defined('_REXEC') or  die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
* Currency Selector Module
*
* NOTE: THIS MODULE REQUIRES THE retinashop COMPONENT!
/*
* @version $Id: mod_retinashop_currencies.php 5615 2012-03-06 11:14:34Z alatak $
* @package retinashop
* @subpackage modules
*
* @copyright (C) 2011 retinashop team - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* retinashop is Free Software.
* retinashop comes with absolute no warranty.
*
* www.retinashop.net
*/


/***********
 *
 * Prices in the orders are saved in the shop currency; these fields are required
 * to show the prices to the user in a later stadium.
  */
$mainframe = Jfactory::getApplication();
$vendorId = JRequest::getInt('vendorid', 1);
$text_before = $params->get( 'text_before', '');
/* table rs_vendor */
$db = JFactory::getDBO();
// the select list should include the vendor currency which is the currency in which the product prices are displayed by default.
$q  = 'SELECT CONCAT(`vendor_accepted_currencies`, ",",`vendor_currency`) AS all_currencies, `vendor_currency` FROM `#__retinashop_vendors` WHERE `retinashop_vendor_id`='.$vendorId;
$db->setQuery($q);
$vendor_currency = $db->loadAssoc();


$retinashop_currency_id = $mainframe->getUserStateFromRequest( "retinashop_currency_id", 'retinashop_currency_id',JRequest::getInt('retinashop_currency_id', $vendor_currency['vendor_currency']) );

//if (!$vendor_currency['vendor_accepted_currencies']) return;
//$currency_codes = explode(',' , $currencies->vendor_accepted_currencies );

/* table rs_currency */
//$q = 'SELECT `retinashop_currency_id`,CONCAT_WS(" ",`currency_name`,`currency_exchange_rate`,`currency_symbol`) as currency_txt FROM `#__retinashop_currencies` WHERE `retinashop_currency_id` IN ('.$currency_codes.') and enabled =1 ORDER BY `currency_name`';
$q = 'SELECT `retinashop_currency_id`,CONCAT_WS(" ",`currency_name`,`currency_symbol`) as currency_txt
FROM `#__retinashop_currencies` WHERE `retinashop_currency_id` IN ('.$vendor_currency['all_currencies'].') and (`retinashop_vendor_id` = "'.$vendorId.'" OR `shared`="1") AND published = "1" ORDER BY `ordering`,`currency_name`';
$db->setQuery($q);
$currencies = $db->loadObjectList();
/* load the template */
require(JModuleHelper::getLayoutPath('mod_retinashop_currencies'));
    ?>
