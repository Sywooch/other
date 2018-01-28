<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$col= 1 ;
$pwidth= ' width'.floor ( 100 / $products_per_row );
if ($products_per_row > 1) { $float= "floatleft";}
else {$float="center";}
?>
<div class="vmgroup <?php echo $params->get( 'moduleclass_sfx' ) ?>">

<?php if ($headerText) { ?>
	<div class="vmheader"><?php echo $headerText ?></div>
<?php }
if ($display_style =="div") { ?>
<?php 
$last = count($products)-1;
?>
<ul id="vmproduct" class="vmproduct <?php echo $params->get('moduleclass_sfx'); ?>">
<?php  $count=1; ?>
 <li class="item">
  <?php foreach ($products as $product) : ?>
 
 <div class="product-box spacer <?php if (abs($product->prices[discountAmount]) > 0) { echo 'disc'; } ?>">
 
  <?php  if ($show_title) { ?>
		<div class="Title">
			<span class="count"><?php if($count <10) { echo '0'.$count++; }else {echo $count++;} ?>.</span><?php echo JHTML::link(JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.$product->virtuemart_category_id), shopFunctionsF::limitStringByWord($product->product_name ,'40', '...'), array('title' => $product->product_name)); ?>
		</div>
	<?php } ?>	
 
 
 
 <?php if ($show_img) { ?>
    <div class="browseImage">
	 <div class="new"><?php echo JText::_('TM_NEW') ?> </div>
	 <div class="top"><?php echo JText::_('TM_TOP') ?> </div> 
	 <div class="sale" style="display:none;"><?php echo JText::_('TM_SALE') ?> </div> 
	 			<?php
			if (!empty($product->images[0]) )
					$image = $product->images[0]->displayMediaThumb('class="browseProductImage featuredProductImage" border="0"',false) ;
				else $image = '';
					echo JHTML::_('link', JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.$product->virtuemart_category_id),$image,'class="img2"');
			?>
		</div>
		<?php } ?>
		<?php  if ($show_category) { ?>
			<div class="cat">
				<?php echo JHTML::link(JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$product->virtuemart_category_id), $product->category_name); ?>
			</div>
			<?php } ?>	
			
		<div class="fleft">
		<?php if ($show_ratings) { ?>
			 <?php
			$rating = $ratingModel->getRatingByProduct($product->virtuemart_product_id);
            if( !empty($rating)) {
				$r = $rating->rating;
			} else {
				$r = 0;
			}
			$maxrating = VmConfig::get('vm_maximum_rating_scale',5);
													$ratingwidth = ( $r * 100 ) / $maxrating;//I don't use round as percetntage with works perfect, as for me
										?>
                                        	
													<span class="vote">
														<span title="" class="vmicon ratingbox" style="display:inline-block;">
															<span class="stars-orange" style="width:<?php echo $ratingwidth;?>%">
															</span>
														</span>
													</span>
		<?php } ?>								
		  <?php if ($show_price) { ?>	
				<?php if ((!VmConfig::get('use_as_catalog', 0) and !empty($product->prices['salesPrice'])) && !$product->images[0]->file_is_downloadable) { ?>

			<div class="Price">
			
			<?php
				
				$sale = $currency->createPriceDiv('priceWithoutTax','',$product->prices,true);
				$discount = $currency->createPriceDiv('discountAmount','',$product->prices,true);
					if ($product->prices['salesPrice']>0)
						echo '<span class="sales">' . $currency->createPriceDiv('salesPrice','',$product->prices,true) . '</span>';
					if ($product->prices['basePriceWithTax']>0) 
						echo '<span class="WithoutTax">' . $currency->createPriceDiv('basePriceWithTax','',$product->prices,true) . '</span>';
					if (abs($product->prices['discountAmount'])>0) 
					echo '<span class="discount">' . $currency->createPriceDiv('discountAmount','',$product->prices,true) . '</span>';
					?>
					<?php /*?><?php 
					if ((round((substr($discount,1)/substr($sale,1)),2)*100)>0) { ?>
					<span><?php  echo round((substr($discount,1)/substr($sale,1)),2)*100;?>% off</span>
					<?php } ?><?php */?>
						
			</div>
			<?php } ?>
			<?php } ?>          
         
		
			
	<?php if ($show_desc) { ?>
				<div class="description">
					<?php echo shopFunctionsF::limitStringByWord($product->product_s_desc, $row, '...') ?>
				</div>
			<?php } ?>	

			<div class="clear"></div>
			
			<div class="fright">
            
			<?php if ($show_addtocart) echo mod_virtuemart_product::addtocart($product);?>
			<?php if ($show_det) { ?>
			<div class="Details">
				<?php // Product Details Button
				echo JHTML::link($product->link, JText::_('TM_DETAILS').'<span>&gt;</span>', array('title' => $product->product_name,'class' => 'button'));
				?>
			</div>
			<?php }?>
			</div>
			<div class="clear"></div>
    </div>
	</div>
		<?php
            if ($col == $products_per_row && $products_per_row && $last) {
                echo "</li><li class='items'>";
                $col= 1 ;
            } else {
                $col++;
            }
			$last--;
            endforeach; ?>
	</li>
</ul>
<?php
} else { ?>
<script type="text/javascript" src="modules/mod_virtuemart_product/js/jquery.anythingslider.js"></script>
<?php
$js="
			jQuery(function () {							   	
			jQuery('#slider').anythingSlider({
			easing: '$effect',        // Anything other than 'linear' or 'swing' requires the easing plugin
			autoPlay: $play,                 // This turns off the entire FUNCTIONALY, not just if it starts running or not.
			delay: $pauseTime,                    // How long between slide transitions in AutoPlay mode
			buildStartStop : false,            // If autoPlay is on, this can force it to start stopped
			animationTime: $animSpeed,             // How long the slide transition takes
			buildArrows: $arrows,
			buildNavigation: $controlNav,          // If true, builds and list of anchor links to link to each slide
			pauseOnHover: $pauseOnHover,    // If true, and autoPlay is enabled, the show will pause on hover
			hashTags            : false
			});
			jQuery('.vmgroup_best   ul li .browseImage').hover(function() {
					jQuery(this).find('div.slide-info').stop().animate({ bottom: 0}, 500 , 'easeOutBack');
					},function(){
					jQuery(this).find('div.slide-info').stop().animate({ bottom: -110}, 500 , 'easeInBack');
				}); 
			});
        ";
		$document = JFactory::getDocument();
		$document->addScriptDeclaration($js);	

?>
<?php 
$last = count($products)-1;
?>
<ul id="slider" class="vmproduct">
 <li>
  <?php foreach ($products as $product) : ?>
 <div class="product-box spacer <?php if (abs($product->prices[discountAmount]) > 0) { echo 'disc'; } ?>">
 <?php if ($show_img) { ?>
    <div class="browseImage">
			<?php
			if (!empty($product->images[0]) )
					$image = $product->images[0]->displayMediaThumb('class="browseProductImage featuredProductImage" border="0"',false) ;
				else $image = '';
					echo JHTML::_('link', JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.$product->virtuemart_category_id),$image);
			?>
			<div class="slide-info">
			<?php if ($show_ratings) { ?>
			 <?php
			$rating = $ratingModel->getRatingByProduct($product->virtuemart_product_id);
            if( !empty($rating)) {
				$r = $rating->rating;
			} else {
				$r = 0;
			}
			$maxrating = VmConfig::get('vm_maximum_rating_scale',5);
													$ratingwidth = ( $r * 100 ) / $maxrating;//I don't use round as percetntage with works perfect, as for me
										?>
                                        	
													<span class="vote">
														<span title="" class="vmicon ratingbox" style="display:inline-block;">
															<span class="stars-orange" style="width:<?php echo $ratingwidth;?>%">
															</span>
														</span>
													</span>
		<?php } ?>								
			 <?php if ($show_title) { ?>
				<div class="Title">
					<?php echo JHTML::link(JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.$product->virtuemart_category_id),shopFunctionsF::limitStringByWord($product->product_name ,'30', '...'), array('title' => $product->product_name)); ?>
				</div>
			<?php } ?>	
			<?php if ($show_price) { ?>	
			<div class="Price">
			<?php
					if ($product->prices['salesPrice']>0)
						echo '<span class="sales">' . $currency->createPriceDiv('salesPrice','',$product->prices,true) . '</span>';
					if ($product->prices['basePriceWithTax']>0) 
						echo '<span class="WithoutTax">' . $currency->createPriceDiv('basePriceWithTax','',$product->prices,true) . '</span>';
					if (abs($product->prices['discountAmount'])>0) 
					echo '<span class="discount">' . $currency->createPriceDiv('discountAmount','',$product->prices,true) . '</span>';
			?>			
			</div>
			<?php } ?>
			</div>
	</div>
		
		<?php } ?>
		
		<?php if ($show_desc) { ?>
			<div class="description">
				<?php echo shopFunctionsF::limitStringByWord($product->product_s_desc, $row, '...') ?>
			</div>
		<?php } ?>	
		
            <div class="wrapper-slide">
			<?php if ($show_addtocart) echo mod_virtuemart_product::addtocart($product);?>
			<?php if ($show_det) { ?>
			<div class="Details">
				<?php // Product Details Button
				echo JHTML::link($product->link, JText::_('TM_DETAILS'), array('title' => $product->product_name,'class' => 'button'));
				?>
			</div>
			<?php }?>
			<div class="clear"></div>
			</div>
			
    	</div>
        
        
        
        
		<?php
            if ($col == $products_per_row && $products_per_row && $last) {
                echo "</li><li>";
                $col= 1 ;
            } else {
                $col++;
            }
			$last--;
            endforeach; ?>
	</li>
</ul>



<?php }
?>


<div style="width:100%; height:100px; text-align:center;">

<input type="button" class="view_all" value="ПОКАЗАТЬ ЕЩЁ">

</div>



<?php	if ($footerText) : ?>
	<div class="vmfooter <?php echo $params->get( 'moduleclass_sfx' ) ?>">
		 <?php echo $footerText ?>
	</div>
<?php endif; ?>
</div>

