<?php

defined('_REXEC') or die('Restricted access');
/**
 *
 * Layout for the shopping cart
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
// Plain text formating
// echo sprintf("[%s]\n",      $s); // affichage d'une cha�ne standard
// echo sprintf("[%10s]\n",    $s); // justification � droite avec des espaces
// echo sprintf("[%-10s]\n",   $s); // justification � gauche avec des espaces
// echo sprintf("[%010s]\n",   $s); // l'espacement nul fonctionne aussi sur les cha�nes
// echo sprintf("[%'#10s]\n",  $s); // utilisation du caract�re personnalis� de s�paration '#'
// echo sprintf("[%10.10s]\n", $t); // justification � gauche mais avec une coupure � 10 caract�res
// $s = 'monkey';
// [monkey]
// [    monkey]
// [monkey    ]
// [0000monkey]
// [####monkey]
// [many monke]
// Check to ensure this file is included in Retina
// jimport( 'retina.application.component.view');
// $viewEscape = new JView();
// $viewEscape->setEscape('htmlspecialchars');
// TODO Temp fix !!!!! *********************************>>>
//$skuPrint = echo sprintf( "%64.64s",strtoupper (RText::_('COM_RETINASHOP_SKU') ) ) ;
// Head of table
echo strip_tags(RText::sprintf('COM_RETINASHOP_ORDER_PRINT_TOTAL', $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_total))) . "\n";
echo sprintf("%'-64.64s", '') . "\n";
echo RText::_('COM_RETINASHOP_ORDER_element') . "\n";
foreach ($this->orderDetails['elements'] as $element) {
    echo "\n";
    echo $element->product_quantity . ' X ' . $element->order_element_name . ' (' . strtoupper(RText::_('COM_RETINASHOP_SKU')) . $element->order_element_sku . ')' . "\n";
    if (!empty($element->product_attribute)) {
	if (!class_exists('retinashopModelCustomfields'))
	    require(RPATH_rs_admin . DS . 'models' . DS . 'customfields.php');
	$product_attribute = retinashopModelCustomfields::CustomsFieldOrderDisplay($element, 'FE');
	echo "\n" . $product_attribute . "\n";
    }
    if (!empty($element->product_basePriceWithTax) && $element->product_basePriceWithTax != $element->product_final_price) {
	echo $element->product_basePriceWithTax . "\n";
    }

    echo RText::_('COM_RETINASHOP_ORDER_PRINT_TOTAL') . $element->product_final_price;
    if (rsConfig::get('show_tax')) {
	echo ' (' . RText::_('COM_RETINASHOP_ORDER_PRINT_PRODUCT_TAX') . ':' . $this->currency->priceDisplay($element->product_tax) . ')' . "\n";
    }
    echo "\n";
}
echo sprintf("%'-64.64s", '');
echo "\n";

// Coupon
if (!empty($this->orderDetails['details']['BT']->coupon_code)) {
    echo RText::_('COM_RETINASHOP_COUPON_DISCOUNT') . ':' . $this->orderDetails['details']['BT']->coupon_code . ' ' . RText::_('COM_RETINASHOP_PRICE') . ':' . $this->currency->priceDisplay($this->orderDetails['details']['BT']->coupon_discount);
    echo "\n";
}



foreach ($this->orderDetails['calc_rules'] as $rule) {
    if ($rule->calc_kind == 'DBTaxRulesBill') {
	echo $rule->calc_rule_name . $this->currency->priceDisplay($rule->calc_amount) . "\n";
    } elseif ($rule->calc_kind == 'taxRulesBill') {
	echo $rule->calc_rule_name . ' ' . $this->currency->priceDisplay($rule->calc_amount) . "\n";
    } elseif ($rule->calc_kind == 'DATaxRulesBill') {
	echo $rule->calc_rule_name . ' ' . $this->currency->priceDisplay($rule->calc_amount) . "\n";
    }
}


echo strtoupper(RText::_('COM_RETINASHOP_ORDER_PRINT_SHIPPING')) . ' (' . strip_tags(str_replace("<br />", "\n", $this->orderDetails['shipmentName'])) . ' ) ' . "\n";
echo RText::_('COM_RETINASHOP_ORDER_PRINT_TOTAL') . ' : ' . $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_shipment);
if (rsConfig::get('show_tax')) {
    echo ' (' . RText::_('COM_RETINASHOP_ORDER_PRINT_TAX') . ' : ' . $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_shipment_tax) . ')';
}
echo "\n";
echo strtoupper(RText::_('COM_RETINASHOP_ORDER_PRINT_PAYMENT')) . ' (' . strip_tags(str_replace("<br />", "\n", $this->orderDetails['paymentName'])) . ' ) ' . "\n";
echo RText::_('COM_RETINASHOP_ORDER_PRINT_TOTAL') . ':' . $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_payment);
if (rsConfig::get('show_tax')) {
    echo ' (' . RText::_('COM_RETINASHOP_ORDER_PRINT_TAX') . ' : ' . $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_payment_tax) . ')';
}
echo "\n";

echo sprintf("%'-64.64s", '') . "\n";
// total order
echo RText::_('COM_RETINASHOP_MAIL_SUBTOTAL_DISCOUNT_AMOUNT') . ' : ' . $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_billDiscountAmount) . "\n";

echo strtoupper(RText::_('COM_RETINASHOP_ORDER_PRINT_TOTAL')) . ' : ' . $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_total) . "\n";
if (rsConfig::get('show_tax')) {
    echo ' (' . RText::_('COM_RETINASHOP_ORDER_PRINT_TAX') . ' : ' . $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_billTaxAmount) . ')' . "\n";
}
echo "\n";
?>
