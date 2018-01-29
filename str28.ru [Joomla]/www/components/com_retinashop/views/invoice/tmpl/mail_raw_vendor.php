<?php
/**
*
* Layout for the shopping cart, look in mailshopper for more details
*
* @package	Magazin
* @subpackage Cart
* @author Max Milbers, Valerie Isaksen
*
* @link http://www.retinashop.net
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');


//	echo RText::_('COM_RETINASHOP_CART_MAIL_VENDOR_TITLE').$this->vendor->vendor_name.'<br/>';
	echo str_replace("<br />", "\n",  RText::sprintf('COM_RETINASHOP_MAIL_VENDOR_CONTENT',$this->vendor->vendor_store_name,$this->shopperName,$this->currency->priceDisplay($this->orderDetails['details']['BT']['order_total']),$this->orderDetails['details']['BT']['order_number'] ));

if(!empty($this->orderDetails['details']['BT']->customer_note)) {
	echo "\n" . RText::sprintf('COM_RETINASHOP_CART_MAIL_VENDOR_SHOPPER_QUESTION', $this->orderDetails['details']['BT']->customer_note);
}
echo "\n";
