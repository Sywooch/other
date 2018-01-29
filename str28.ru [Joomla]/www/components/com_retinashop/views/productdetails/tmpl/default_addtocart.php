<?php
/**
 *
 * Show the product details page
 *
 * @package	Magazin
 * @subpackage
 * @author Max Milbers, Valerie Isaksen
 * @todo handle child products
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_addtocart.php 5758 2012-03-31 10:15:11Z Milbo $
 */
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');
?>
<div align="right" class="addtocart-area" style="padding:0 !important; 
  width:200px !important; ">

    <form method="post" class="product js-recalculate" action="index.php" >
	<?php // Product custom_fields
	if (!empty($this->product->customfieldsCart)) { ?>
    	<div class="product-fields">
		<?php foreach ($this->product->customfieldsCart as $field) { ?>
		    <div class="product-field product-field-type-<?php echo $field->field_type ?>">
			<span class="product-fields-title" ><b><?php echo RText::_($field->custom_title) ?></b></span>
			<?php if ($field->custom_tip)
			    echo JHTML::tooltip($field->custom_tip, RText::_($field->custom_title), 'tooltip.png'); ?>
			<span class="product-field-display"><?php echo $field->display ?></span>

			<span class="product-field-desc"><?php echo $field->custom_field_desc ?></span>
		    </div><br />
		    <?php
		}
		?>
    	</div>
	<?php
	}
	/* Product custom Childs
	 * to display a simple link use $field->retinashop_product_id as link to child product_id
	 * custom_value is relation value to child
	 */

	if (!empty($this->product->customsChilds)) {
	    ?>
    	<div class="product-fields">
    <?php foreach ($this->product->customsChilds as $field) { ?>
		    <div class="product-field product-field-type-<?php echo $field->field->field_type ?>">
			<span class="product-fields-title" ><b><?php echo RText::_($field->field->custom_title) ?></b></span>
			<span class="product-field-desc"><?php echo RText::_($field->field->custom_value) ?></span>
			<span class="product-field-display"><?php echo $field->display ?></span>

		    </div><br />
		<?php } ?>
    	</div>
<?php } ?>

	<div class="addtocart-bar">

<?php // Display the quantity box 

    $stockhandle = rsConfig::get('stockhandle', 'none');
    if (($stockhandle == 'disableit' or $stockhandle == 'disableadd') and ($this->product->product_in_stock - $this->product->product_ordered) < 1) {
 ?>
		<a href="<?php echo JRoute::_('index.php?option=com_retinashop&view=productdetails&layout=notify&retinashop_product_id='.$this->product->retinashop_product_id); ?>"><?php echo RText::_('COM_RETINASHOP_CART_NOTIFY') ?></a>

<?php } else { ?>
						<!-- <label for="quantity<?php echo $this->product->retinashop_product_id; ?>" class="quantity_box"><?php echo RText::_('COM_RETINASHOP_CART_QUANTITY'); ?>: </label> -->
	    <span class="quantity-box">
		<input type="text" class="quantity-input js-recalculate" name="quantity[]" value="<?php if (isset($this->product->min_order_level) && (int) $this->product->min_order_level > 0) {
    echo $this->product->min_order_level;
} else {
    echo '1';
} ?>" />
	    </span>
	    <span class="quantity-controls js-recalculate">
		<input type="button" class="quantity-controls quantity-plus" />
		<input type="button" class="quantity-controls quantity-minus" />
	    </span>
	    <?php // Display the quantity box END ?>

	    <?php
	    // Display the add to cart button
	    ?>
		<span class="addtocart-button">
		<input type="submit" name="addtocart"  class="addtocart-button" value="<?php //echo RText::_('COM_RETINASHOP_CART_ADD_TO') ?>" title="<?php echo RText::_('COM_RETINASHOP_CART_ADD_TO') ?>" />
		</span>
<?php } ?>

	    <div class="clear"></div>
	</div>

	<?php // Display the add to cart button END  ?>
	<input type="hidden" class="pname" value="<?php echo $this->product->product_name ?>" />
	<input type="hidden" name="option" value="com_retinashop" />
	<input type="hidden" name="view" value="cart" />
	<noscript><input type="hidden" name="task" value="add" /></noscript>
	<input type="hidden" name="retinashop_product_id[]" value="<?php echo $this->product->retinashop_product_id ?>" />
<?php /** @todo Handle the manufacturer view */ ?>
	<input type="hidden" name="retinashop_manufacturer_id" value="<?php echo $this->product->retinashop_manufacturer_id ?>" />
	<input type="hidden" name="retinashop_category_id[]" value="<?php echo $this->product->retinashop_category_id ?>" />
    </form>

    <div class="clear"></div>
</div>
