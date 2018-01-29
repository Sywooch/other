<?php
/**
*
* Order elements view
*
* @package	Magazin
* @subpackage Orders
* @author Oscar van Eijk, Valerie Isaksen
* @link http://www.retinashop.net
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: details_elements.php 5836 2012-04-09 13:13:21Z Milbo $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

if($this->format == 'pdf'){
	$widthTable = '100';
	$widtTitle = '27';
} else {
	$widthTable = '100';
	$widtTitle = '49';
}

?>
<table width="<?php echo $widthTable ?>%" cellspacing="0" cellpadding="0" border="0">
	<tr align="left" class="sectiontableheader">
		<th align="left" width="5%"><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_SKU') ?></th>
		<th align="left" colspan="2" width="<?php echo $widtTitle ?>%" ><?php echo RText::_('COM_RETINASHOP_PRODUCT_NAME_TITLE') ?></th>
		<th align="center" width="10%"><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_PRODUCT_STATUS') ?></th>
		<th align="right" width="10%" ><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_PRICE') ?></th>
		<th align="left" width="5%"><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_QTY') ?></th>
		<?php if ( rsConfig::get('show_tax')) { ?>
		<th align="right" width="10%" ><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_PRODUCT_TAX') ?></th>
		  <?php } ?>
		<th align="right" width="11%"><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_SUBTOTAL_DISCOUNT_AMOUNT') ?></th>
		<th align="right" width="10%"><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_TOTAL') ?></th>
	</tr>
<?php
	foreach($this->orderdetails['elements'] as $element) {
		$qtt = $element->product_quantity ;
		$_link = JRoute::_('index.php?option=com_retinashop&view=productdetails&retinashop_category_id=' . $element->retinashop_category_id . '&retinashop_product_id=' . $element->retinashop_product_id);
?>
		<tr valign="top">
			<td align="left">
				<?php echo $element->order_element_sku; ?>
			</td>
			<td align="left" colspan="2" >
				<a href="<?php echo $_link; ?>"><?php echo $element->order_element_name; ?></a>
				<?php
// 				rsdebug('tmpl details_element $element',$element);
					if (!empty($element->product_attribute)) {
							if(!class_exists('retinashopModelCustomfields'))require(RPATH_rs_admin.DS.'models'.DS.'customfields.php');
							$product_attribute = retinashopModelCustomfields::CustomsFieldOrderDisplay($element,'FE');
						echo $product_attribute;
					}
				?>
			</td>
			<td align="center">
				<?php echo $this->orderstatuses[$element->order_status]; ?>
			</td>
			<td align="right"   class="priceCol" >
			    <?php echo '<span >'.$this->currency->priceDisplay($element->product_element_price) .'</span><br />'; ?>
			</td>
			<td align="right" >
				<?php echo $qtt; ?>
			</td>
			<?php if ( rsConfig::get('show_tax')) { ?>
				<td align="right" class="priceCol"><?php echo "<span  class='priceColor2'>".$this->currency->priceDisplay($element->product_tax ,0, $qtt)."</span>" ?></td>
                                <?php } ?>
			<td align="right" class="priceCol" >
				<?php echo  $this->currency->priceDisplay( $element->product_subtotal_discount );  //No quantity is already stored with it ?>
			</td>
			<td align="right"  class="priceCol">
				<?php
				$element->product_basePriceWithTax = (float) $element->product_basePriceWithTax;
				$class = '';
				if(!empty($element->product_basePriceWithTax) && $element->product_basePriceWithTax != $element->product_final_price ) {
					echo '<span class="line-through" >'.$this->currency->priceDisplay($element->product_basePriceWithTax,0,$qtt) .'</span><br />' ;
				}

				echo $this->currency->priceDisplay(  $element->product_subtotal_with_tax ,0); //No quantity or you must use product_final_price ?>
			</td>
		</tr>

<?php
	}
?>
 <tr class="sectiontableentry1">
			<td colspan="6" align="right"><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_PRODUCT_PRICES_TOTAL'); ?></td>

                        <?php if ( rsConfig::get('show_tax')) { ?>
			<td align="right"><?php echo "<span  class='priceColor2'>".$this->currency->priceDisplay($this->orderdetails['details']['BT']->order_tax)."</span>" ?></td>
                        <?php } ?>
			<td align="right"><?php echo "<span  class='priceColor2'>".$this->currency->priceDisplay($this->orderdetails['details']['BT']->order_discountAmount)."</span>" ?></td>
			<td align="right"><?php echo $this->currency->priceDisplay($this->orderdetails['details']['BT']->order_salesPrice) ?></td>
		  </tr>
<?php
if ($this->orderdetails['details']['BT']->coupon_discount <> 0.00) {
    $coupon_code=$this->orderdetails['details']['BT']->coupon_code?' ('.$this->orderdetails['details']['BT']->coupon_code.')':'';
	?>
	<tr>
		<td align="right" class="pricePad" colspan="5"><?php echo RText::_('COM_RETINASHOP_COUPON_DISCOUNT').$coupon_code ?></td>
			<td align="right">&nbsp;</td>

			<?php if ( rsConfig::get('show_tax')) { ?>
				<td align="right">&nbsp;</td>
                                <?php } ?>
		<td align="right"><?php echo '- '.$this->currency->priceDisplay($this->orderdetails['details']['BT']->coupon_discount); ?></td>
		<td align="right">&nbsp;</td>
	</tr>
<?php  } ?>


	<?php
		foreach($this->orderdetails['calc_rules'] as $rule){
			if ($rule->calc_kind== 'DBTaxRulesBill') { ?>
			<tr >
				<td colspan="6"  align="right" class="pricePad"><?php echo $rule->calc_rule_name ?> </td>

                                   <?php if ( rsConfig::get('show_tax')) { ?>
				<td align="right"> </td>
                                <?php } ?>
				<td align="right"> <?php echo  $this->currency->priceDisplay($rule->calc_amount);  ?></td>
				<td align="right"><?php echo  $this->currency->priceDisplay($rule->calc_amount);  ?> </td>
			</tr>
			<?php
			} elseif ($rule->calc_kind == 'taxRulesBill') { ?>
			<tr >
				<td colspan="6"  align="right" class="pricePad"><?php echo $rule->calc_rule_name ?> </td>
				<?php if ( rsConfig::get('show_tax')) { ?>
				<td align="right"><?php echo $this->currency->priceDisplay($rule->calc_amount); ?> </td>
				 <?php } ?>
				<td align="right"><?php    ?> </td>
				<td align="right"><?php echo $this->currency->priceDisplay($rule->calc_amount);   ?> </td>
			</tr>
			<?php
			 } elseif ($rule->calc_kind == 'DATaxRulesBill') { ?>
			<tr >
				<td colspan="6"   align="right" class="pricePad"><?php echo $rule->calc_rule_name ?> </td>
				<?php if ( rsConfig::get('show_tax')) { ?>
				<td align="right"> </td>
				 <?php } ?>
				<td align="right"><?php  echo   $this->currency->priceDisplay($rule->calc_amount);  ?> </td>
				<td align="right"><?php echo $this->currency->priceDisplay($rule->calc_amount);  ?> </td>
			</tr>

			<?php
			 }

		}
		?>


	<tr>
		<td align="right" class="pricePad" colspan="6"><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_SHIPPING') ?></td>


			<?php if ( rsConfig::get('show_tax')) { ?>
				<td align="right"><?php echo "<span  class='priceColor2'>".$this->currency->priceDisplay($this->orderdetails['details']['BT']->order_shipment_tax)."</span>" ?></td>
                                <?php } ?>
				<td align="right">&nbsp;</td>
				<td align="right"><?php echo $this->currency->priceDisplay($this->orderdetails['details']['BT']->order_shipment+ $this->orderdetails['details']['BT']->order_shipment_tax); ?></td>

	</tr>

<tr>
		<td align="right" class="pricePad" colspan="6"><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_PAYMENT') ?></td>

			<?php if ( rsConfig::get('show_tax')) { ?>
				<td align="right"><?php echo "<span  class='priceColor2'>".$this->currency->priceDisplay($this->orderdetails['details']['BT']->order_payment_tax)."</span>" ?></td>
                                <?php } ?>
				<td align="right">&nbsp;</td>
				<td align="right"><?php echo $this->currency->priceDisplay($this->orderdetails['details']['BT']->order_payment+ $this->orderdetails['details']['BT']->order_payment_tax); ?></td>


	</tr>

	<tr>
		<td align="right" class="pricePad" colspan="6"><strong><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_TOTAL') ?></strong></td>

		 <?php if ( rsConfig::get('show_tax')) {  ?>
		<td align="right"><span  class='priceColor2'><?php echo $this->currency->priceDisplay($this->orderdetails['details']['BT']->order_billTaxAmount); ?></span></td>
		 <?php } ?>
		<td align="right"><span  class='priceColor2'><?php echo $this->currency->priceDisplay($this->orderdetails['details']['BT']->order_billDiscountAmount); ?></span></td>
		<td align="right"><strong><?php echo $this->currency->priceDisplay($this->orderdetails['details']['BT']->order_total); ?></strong></td>
	</tr>

</table>
