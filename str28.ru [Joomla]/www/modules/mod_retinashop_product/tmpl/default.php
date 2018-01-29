<?php // no direct access 2
defined('_REXEC') or die('Restricted access');
$col= 1 ;
$pwidth= ' width'.floor ( 100 / $products_per_row );
if ($products_per_row > 1) { $float= "floatleft";}
else {$float="center";}
?>
<div class="rsgroup<?php echo $params->get( 'moduleclass_sfx' ) ?>" >

<?php if ($headerText) { ?>
	<div class="rsheader"  ><?php echo $headerText ?></div>
<?php }
if ($display_style =="div") { ?>
<div class="rsproduct<?php echo $params->get('moduleclass_sfx'); ?>" >
<?php foreach ($products as $product) { ?>
	<div class="<?php echo $pwidth ?> <?php echo $float ?>" ><div class="spacer">
<?php
 if (!empty($product->images[0]) )
 $image = $product->images[0]->displayMediaThumb('class="featuredProductImage" border="0"',false) ;
 else $image = '';
 echo JHTML::_('link', JRoute::_('index.php?option=com_retinashop&view=productdetails&retinashop_product_id='.$product->retinashop_product_id.'&retinashop_category_id='.$product->retinashop_category_id),$image,array('title' => $product->product_name) );
 echo '<div class="clear"></div>';
 $url = JRoute::_('index.php?option=com_retinashop&view=productdetails&retinashop_product_id='.$product->retinashop_product_id.'&retinashop_category_id='.
$product->retinashop_category_id); ?>		<a href="<?php echo $url ?>"><?php echo $product->product_name ?></a>		<?php	echo '<div class="clear"></div>';

 if ($show_price) {
 // 		echo $currency->priceDisplay($product->prices['salesPrice']);
 if (!empty($product->prices['salesPrice'] ) ) echo $currency->createPriceDiv('salesPrice','',$product->prices,true);
 // 		if ($product->prices['salesPriceWithDiscount']>0) echo $currency->priceDisplay($product->prices['salesPriceWithDiscount']);
 if (!empty($product->prices['salesPriceWithDiscount']) ) echo $currency->createPriceDiv('salesPriceWithDiscount','',$product->prices,true);
 }
 if ($show_addtocart) echo mod_retinashop_product::addtocart($product);
 ?>
 </div></div>
	<?php
		if ($col == $products_per_row && $products_per_row && $col < $totalProd ) {
			echo "	</div><div style='clear:both;'>";
			$col= 1 ;
		} else {
			$col++;
		}
	} ?>
</div>
<br style='clear:both;' />

<?php
} else {
$last = count($products)-1;
?>

<ul class="rsproduct<?php echo $params->get('moduleclass_sfx'); ?>" style=" border:0px black solid !important; 
height:222px !important; width:224px !important;
background-image:url('../../../../design1/retina_template/images/frame.png') !important; 
background-repeat:no-repeat !important;
padding-top:40px !important;">
<?php foreach ($products as $product) : ?>
 <li class="<?php echo $pwidth ?> <?php echo $float ?>">
 <?php
 if (!empty($product->images[0]) )
			$image = $product->images[0]->displayMediaThumb('class="featuredProductImage" border="0"',false) ;
		else $image = '';
			echo JHTML::_('link', JRoute::_('index.php?option=com_retinashop&view=productdetails&retinashop_product_id='.$product->retinashop_product_id.'&retinashop_category_id='.$product->retinashop_category_id),$image,array('title' => $product->product_name) );
			echo '<div class="clear"></div>';
			echo'<div style="width:200px; margin-left:10px;">';
			
	$url = JRoute::_('index.php?option=com_retinashop&view=productdetails&retinashop_product_id='.$product->retinashop_product_id.'&retinashop_category_id='.
$product->retinashop_category_id); ?>		<a href="<?php echo $url ?>"><?php echo $product->product_name ?></a>	

</div>
	<?php	echo '<div class="clear"></div>';

		if ($show_price) {
			echo $currency->createPriceDiv('salesPrice','',$product->prices,true);
			if ($product->prices['salesPriceWithDiscount']>0) echo $currency->createPriceDiv('salesPriceWithDiscount','',$product->prices,true);
		}
		if ($show_addtocart) echo mod_retinashop_product::addtocart($product);
		?>
	</li>
<?php
	if ($col == $products_per_row && $products_per_row && $last ) {
		echo '
		</ul><div class="clear"></div>
		<ul  class="rsproduct'.$params->get('moduleclass_sfx')  .'" 
		style="border:0px black solid !important; 
height:222px !important; width:224px !important;
background-image:url(../../../../design1/retina_template/images/frame.png) !important; 
padding-top:40px !important;
background-repeat:no-repeat;">';
		$col= 1 ;
	} else {
		$col++;
	}
	$last--;
	endforeach; ?>
</ul><div class="clear"></div>

<?php }
	if ($footerText) : ?>
	<div class="rsfooter<?php echo $params->get( 'moduleclass_sfx' ) ?>">
		 <?php echo $footerText ?>
	</div>
<?php endif; ?>
</div>