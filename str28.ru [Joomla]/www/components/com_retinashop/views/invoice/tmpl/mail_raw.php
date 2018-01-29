<?php
/**
*
* Layout for the shopper mail, when he confirmed an ordner
*
* The addresses are reachable with $this->BTaddress, take a look for an exampel at shopper_adresses.php
*
* With $this->cartData->paymentName or shipmentName, you get the name of the used paymentmethod/shippmentmethod
*
* In the array order you have details and elements ($this->orderDetails['details']), the elements gather the products, but that is done directly from the cart data
*
* $this->orderDetails['details'] contains the raw address data (use the formatted ones, like BTaddress). Interesting informatin here is,
* order_number ($this->orderDetails['details']['BT']->order_number), order_pass, coupon_code, order_status, order_status_name,
* user_currency_rate, created_on, customer_note, ip_address
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
defined('_REXEC') or die('Restricted access'); ?>

<?php
// Shop desc for shopper and vendor
// echo $this->loadTemplate('header');
// Message for shopper or vendor
echo $this->loadTemplate('shopper');
// render shipto billto adresses
echo $this->loadTemplate('shopperaddresses');
// render price list
echo  $this->loadTemplate('pricelist');
//dump($salesPriceShipment , 'rawmail');
// more infos
//echo $this->loadTemplate($this->recipient.'_more');
// end of mail
echo $this->loadTemplate('footer');
?>
