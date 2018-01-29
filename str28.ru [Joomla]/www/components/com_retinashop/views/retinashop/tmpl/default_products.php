<?php defined('_REXEC') or die('Restricted access');


// Separator
$verticalseparator = " vertical-separator";

foreach ($this->products as $type => $productList ) {
// Calculating Products Per Row
$products_per_row = rsConfig::get ( $type.'_products_per_row', 3 ) ;
$cellwidth = ' width'.floor ( 100 / $products_per_row );

// Category and Columns Counter
$col = 1;
$nb = 1;

$productTitle = RText::_('COM_RETINASHOP_'.$type.'_PRODUCT')

?>

<div class="<?php echo $type ?>-view">

	<h4><?php echo $productTitle ?></h4>

<?php // Start the Output
foreach ( $productList as $product ) {

	// Show the horizontal seperator
	if ($col == 1 && $nb > $products_per_row) { ?>
	<div class="horizontal-separator"></div>
	<?php }

	// this is an indicator wether a row needs to be opened or not
	if ($col == 1) { ?>
	<div class="row">
	<?php }

	// Show the vertical seperator
	if ($nb == $products_per_row or $nb % $products_per_row == 0) {
		$show_vertical_separator = ' ';
	} else {
		$show_vertical_separator = $verticalseparator;
	}

		// Show Products ?>
		<div class="product floatleft<?php echo $cellwidth . $show_vertical_separator ?>">
			<div class="spacer">


					<h3>
					<?php // Product Name
					echo JHTML::link ( JRoute::_ ( 'index.php?option=com_retinashop&view=productdetails&retinashop_product_id=' . $product->retinashop_product_id . '&retinashop_category_id=' . $product->retinashop_category_id ), $product->product_name, array ('title' => $product->product_name ) ); ?>
					</h3>

					<div>
					<?php // Product Image
					if ($product->images) {
						echo JHTML::_ ( 'link', JRoute::_ ( 'index.php?option=com_retinashop&view=productdetails&retinashop_product_id=' . $product->retinashop_product_id . '&retinashop_category_id=' . $product->retinashop_category_id ), $product->images[0]->displayMediaThumb( 'class="featuredProductImage" border="0"',true,'class="modal"' ) );
					}
					?>
					</div>


					<div class="product-price">
					<?php
					if (rsConfig::get ( 'show_prices' ) == '1') {
					//				if( $featProduct->product_unit && rsConfig::get('rs_price_show_packaging_pricelabel')) {
					//						echo "<strong>". RText::_('COM_RETINASHOP_CART_PRICE_PER_UNIT').' ('.$featProduct->product_unit."):</strong>";
					//					} else echo "<strong>". RText::_('COM_RETINASHOP_CART_PRICE'). ": </strong>";

					if ($this->showBasePrice) {
						echo $this->currency->createPriceDiv( 'basePrice', 'COM_RETINASHOP_PRODUCT_BASEPRICE', $product->prices );
						echo $this->currency->createPriceDiv( 'basePriceVariant', 'COM_RETINASHOP_PRODUCT_BASEPRICE_VARIANT', $product->prices );
					}
					echo $this->currency->createPriceDiv( 'variantModification', 'COM_RETINASHOP_PRODUCT_VARIANT_MOD', $product->prices );
					echo $this->currency->createPriceDiv( 'basePriceWithTax', 'COM_RETINASHOP_PRODUCT_BASEPRICE_WITHTAX', $product->prices );
					echo $this->currency->createPriceDiv( 'discountedPriceWithoutTax', 'COM_RETINASHOP_PRODUCT_DISCOUNTED_PRICE', $product->prices );
					echo $this->currency->createPriceDiv( 'salesPrice', 'COM_RETINASHOP_PRODUCT_SALESPRICE', $product->prices );
					echo $this->currency->createPriceDiv( 'priceWithoutTax', 'COM_RETINASHOP_PRODUCT_SALESPRICE_WITHOUT_TAX', $product->prices );
					echo $this->currency->createPriceDiv( 'discountAmount', 'COM_RETINASHOP_PRODUCT_DISCOUNT_AMOUNT', $product->prices );
					echo $this->currency->createPriceDiv( 'taxAmount', 'COM_RETINASHOP_PRODUCT_TAX_AMOUNT', $product->prices );
					} ?>
					</div>

					<div>
					<?php // Product Details Button
					echo JHTML::link ( JRoute::_ ( 'index.php?option=com_retinashop&view=productdetails&retinashop_product_id=' . $product->retinashop_product_id . '&retinashop_category_id=' . $product->retinashop_category_id ), RText::_ ( 'COM_RETINASHOP_PRODUCT_DETAILS' ), array ('title' => $product->product_name, 'class' => 'product-details' ) );
					?>
					</div>
			</div>
		</div>
	<?php
	$nb ++;

	// Do we need to close the current row now?
	if ($col == $products_per_row) { ?>
	<div class="clear"></div>
	</div>
		<?php
		$col = 1;
	} else {
		$col ++;
	}
}
// Do we need a final closing row tag?
if ($col != 1) { ?>
	<div class="clear"></div>
	</div>
<?php
}
?>
</div>
<?php }
