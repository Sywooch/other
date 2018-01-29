<?php
/**
*
* Order elements view
*
* @package	Magazin
* @subpackage Orders
* @author Max Milbers, Valerie Isaksen
* @link http://www.retinashop.net
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: details_elements.php 5432 2012-02-14 02:20:35Z Milbo $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

 if ( rsConfig::get('show_tax')) {
    $colspan=7;
 } else {
    $colspan=8;
 }
?>
<table class="html-email" width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr align="left" class="sectiontableheader" >
		<td align="left" width="5%" style="border:1px black solid !important">
		<strong><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_SKU') ?></strong></td>
		<td align="left" colspan="2" width="40%" style="border:1px black solid !important">
		<strong><?php echo RText::_('COM_RETINASHOP_PRODUCT_NAME_TITLE') ?></strong></td>
		<td align="center" width="10%" style="border:1px black solid !important">
		<strong><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_PRODUCT_STATUS') ?></strong></td>
		<td align="right" width="10%" style="border:1px black solid !important" >
		<strong><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_PRICE') ?></strong></td>
		<td align="right" width="5%" style="border:1px black solid !important">
		<strong><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_QTY') ?></strong></td>
		<?php if ( rsConfig::get('show_tax')) { ?>
		<td align="right" width="10%" style="border:1px black solid !important">
		<strong><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_PRODUCT_TAX') ?></strong></td>
		  <?php } ?>
		<td align="right" width="11%" style="border:1px black solid !important">
<strong><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_SUBTOTAL_DISCOUNT_AMOUNT') ?></strong></td>
		<td align="right" width="10%" style="border:1px black solid !important">
		<strong><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_TOTAL') ?></strong></td>
	</tr>

<?php
	foreach($this->orderDetails['elements'] as $element) {
		$qtt = $element->product_quantity ;
//		$_link = JRoute::_('index.php?option=com_retinashop&view=productdetails&retinashop_category_id=' . $element->retinashop_category_id . '&retinashop_product_id=' . $element->retinashop_product_id,true);
		$_link =JURI::root().'index.php?option=com_retinashop&view=productdetails&retinashop_category_id=' . $element->retinashop_category_id . '&retinashop_product_id=' . $element->retinashop_product_id;


		?>
		<tr valign="top" >
			<td align="left" style="border:1px black solid !important">
				<?php echo $element->order_element_sku; ?>
			</td>
			<td align="left" colspan="2" style="border:1px black solid !important">
				<a href="<?php echo $_link; ?>"><?php echo $element->order_element_name; ?></a>
				<?php
// 				rsdebug('$element',$element);
					if (!empty($element->product_attribute)) {
							if(!class_exists('retinashopModelCustomfields'))require(RPATH_rs_admin.DS.'models'.DS.'customfields.php');
							$product_attribute = retinashopModelCustomfields::CustomsFieldOrderDisplay($element,'FE');
						echo $product_attribute;
					}
				?>
			</td>
			<td align="center" style="border:1px black solid !important">
				<?php echo $this->orderstatuses[$element->order_status]; ?>
			</td>
			<td align="right"   class="priceCol" style="border:1px black solid !important">
			    <?php echo '<span >'.$this->currency->priceDisplay($element->product_element_price) .'</span><br />'; ?>
			</td>
			<td align="right" style="border:1px black solid !important">
				<?php echo $qtt; ?>
			</td>
			<?php if ( rsConfig::get('show_tax')) { ?>
				<td align="right" class="priceCol" style="border:1px black solid !important">
				<?php echo "<span  class='priceColor2'>".$this->currency->priceDisplay($element->product_tax ,0, $qtt)."</span>" ?></td>
                                <?php } ?>
			<td align="right" class="priceCol" style="border:1px black solid !important" >
				<?php echo  $this->currency->priceDisplay( $element->product_subtotal_discount );  //No quantity is already stored with it ?>
			</td>
			<td align="right"  class="priceCol" style="border:1px black solid !important">
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
<!--<tr>
<td colspan="<?php //echo $colspan ?>" style="border:1px black solid !important"></td></tr>-->
 <tr class="sectiontableentry1">
			<td colspan="6" align="right" style="border:1px black solid !important">
			<?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_PRODUCT_PRICES_TOTAL'); ?></td>

                        <?php if ( rsConfig::get('show_tax')) { ?>
			<td align="right" style="border:1px black solid !important">
			<?php echo "<span  class='priceColor2'>".$this->currency->priceDisplay($this->orderDetails['details']['BT']->order_tax)."</span>" ?></td>
                        <?php } ?>
			<td align="right" style="border:1px black solid !important">
			<?php echo "<span  class='priceColor2'>".$this->currency->priceDisplay($this->orderDetails['details']['BT']->order_discountAmount)."</span>" ?></td>
			<td align="right" style="border:1px black solid !important">
			<?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_salesPrice) ?></td>
		  </tr>
<?php
if ($this->orderDetails['details']['BT']->coupon_discount <> 0.00) {
    $coupon_code=$this->orderDetails['details']['BT']->coupon_code?' ('.$this->orderDetails['details']['BT']->coupon_code.')':'';
	?>
	<tr>
		<td align="right" class="pricePad" colspan="5" style="border:1px black solid !important; ">
		<?php echo RText::_('COM_RETINASHOP_COUPON_DISCOUNT').$coupon_code ?></td>
			<td align="right" style="border:1px black solid !important">
			</td>

			<?php if ( rsConfig::get('show_tax')) { ?>
				<td align="right" style="border:1px black solid !important"> </td>
                                <?php } ?>
		<td align="right" style="border:1px black solid !important">
		<?php echo '- '.$this->currency->priceDisplay($this->orderDetails['details']['BT']->coupon_discount); ?></td>
		<td align="right" style="border:1px black solid !important"></td>
	</tr>
<?php  } ?>


	<?php
		foreach($this->orderDetails['calc_rules'] as $rule){
			if ($rule->calc_kind== 'DBTaxRulesBill') { ?>
			<tr>
				<td colspan="6"  align="right" class="pricePad" style="border:1px black solid !important">
				<?php echo $rule->calc_rule_name ?> </td>

                                   <?php if ( rsConfig::get('show_tax')) { ?>
				<td align="right" style="border:1px black solid !important"> </td>
                                <?php } ?>
				<td align="right" style="border:1px black solid !important"> 
				<?php echo  $this->currency->priceDisplay($rule->calc_amount);  ?></td>
				<td align="right" style="border:1px black solid !important">
				<?php echo  $this->currency->priceDisplay($rule->calc_amount);  ?> </td>
			</tr>
			<?php
			} elseif ($rule->calc_kind == 'taxRulesBill') { ?>
			<tr>
				<td colspan="6"  align="right" class="pricePad"
				style="border:1px black solid !important"><?php echo $rule->calc_rule_name ?> </td>
				<?php if ( rsConfig::get('show_tax')) { ?>
				<td align="right" style="border:1px black solid !important">
				<?php echo $this->currency->priceDisplay($rule->calc_amount); ?> </td>
				 <?php } ?>
				<td align="right" style="border:1px black solid !important"><?php    ?> </td>
				<td align="right" style="border:1px black solid !important">
				<?php echo $this->currency->priceDisplay($rule->calc_amount);   ?> </td>
			</tr>
			<?php
			 } elseif ($rule->calc_kind == 'DATaxRulesBill') { ?>
			<tr>
				<td colspan="6"   align="right" class="pricePad"
				style="border:1px black solid !important"><?php echo $rule->calc_rule_name ?> </td>
				<?php if ( rsConfig::get('show_tax')) { ?>
				<td align="right" style="border:1px black solid !important"> </td>
				 <?php } ?>
				<td align="right" style="border:1px black solid !important">
				<?php  echo   $this->currency->priceDisplay($rule->calc_amount);  ?> </td>
				<td align="right" style="border:1px black solid !important">
				<?php echo $this->currency->priceDisplay($rule->calc_amount);  ?> </td>
			</tr>

			<?php
			 }

		}
		?>


	<tr>
		<td align="right" class="pricePad" colspan="6" style="border:1px black solid !important; background-color:yellow !important">
		<?php //echo $this->orderDetails['shipmentName']; 
				$tmp_str=explode("<span class=\"rsshipment_description\">", $this->orderDetails['shipmentName']);
				echo"</br><strong>".$tmp_str[0]."</strong>";
				echo"</br>".$tmp_str[1]."";
				?></td>


			<?php if ( rsConfig::get('show_tax')) { ?>
				<td align="right" style="border:1px black solid !important">
				<?php echo "<span  class='priceColor2'>".$this->currency->priceDisplay($this->orderDetails['details']['BT']->order_shipment_tax)."</span>" ?></td>
                                <?php } ?>
				<td align="right" style="border:1px black solid !important"></td>
				<td align="right" style="border:1px black solid !important">
				<?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_shipment+ $this->orderDetails['details']['BT']->order_shipment_tax); ?></td>

	</tr>

<tr>
		<td align="right" class="pricePad" colspan="6" style="border:1px black solid !important;">
		<?php //echo $this->orderDetails['paymentName'];
		$tmp_str=explode("<span class=\"rspayment_description\">", $this->orderDetails['paymentName']);
				echo"</br><strong>".$tmp_str[0]."</strong>";
				echo"</br>".$tmp_str[1]."";
				
		?></td>

			<?php if ( rsConfig::get('show_tax')) { ?>
				<td align="right" style="border:1px black solid !important">
				<?php echo "<span  class='priceColor2'>".$this->currency->priceDisplay($this->orderDetails['details']['BT']->order_payment_tax)."</span>" ?></td>
                                <?php } ?>
				<td align="right" style="border:1px black solid !important;"></td>
				<td align="right" style="border:1px black solid !important">
				<?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_payment+ $this->orderDetails['details']['BT']->order_payment_tax); ?></td>


	</tr>

	<tr>
		<td align="right" class="pricePad" colspan="6" style="border:1px black solid !important">
		<strong><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_TOTAL') ?></strong></td>

		 <?php if ( rsConfig::get('show_tax')) {  ?>
		<td align="right" style="border:1px black solid !important">
		<span  class='priceColor2'><?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_billTaxAmount); ?></span></td>
		 <?php } ?>
		<td align="right" style="border:1px black solid !important"> 
		<span  class='priceColor2'><?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_billDiscountAmount); ?></span></td>
		<td align="right" style="border:1px black solid !important">
		<strong><?php echo $this->currency->priceDisplay($this->orderDetails['details']['BT']->order_total); ?></strong></td>
	</tr>

</table>
