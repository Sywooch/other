<?php // no direct access



defined('_JEXEC') or die('Restricted access');
$col= 1 ;
$pwidth= ' width'.floor ( 100 / $products_per_row );
if ($products_per_row > 1) { $float= "floatleft";}
else {$float="center";}
?>

<?php
if( (JURI::current()== (JURI::base()."landshafty-pod-klych"))||(JURI::current()== (JURI::base()."gotovye-landshafty")) ){
?>

<div class="landshafty_filter">
<a href="/index.php/rezultaty-poiska/ландшафты-под-ключ/?custom_f_24[0]=31&custom_f_24[1]=32&custom_f_24[2]=33&
custom_f_24[3]=34&custom_f_24[4]=35&custom_f_24[5]=36&custom_f_24[6]=37&custom_f_24[7]=38&custom_f_24[8]=39&custom_f_24[9]=3130">0-10 соток</a>
<a href="/index.php/rezultaty-poiska/ландшафты-под-ключ/?custom_f_24[0]=3130&custom_f_24[1]=3131&custom_f_24[2]=3132&
custom_f_24[3]=3133&custom_f_24[4]=3134&custom_f_24[5]=3135&custom_f_24[6]=3136
&custom_f_24[7]=3137&custom_f_24[8]=3138&custom_f_24[9]=3139&custom_f_24[10]=3230">10-20 соток</a>
<a href="/index.php/rezultaty-poiska/ландшафты-под-ключ/?custom_f_24[0]=3230&
custom_f_24[1]=3231&
custom_f_24[2]=3232&
custom_f_24[3]=3233&
custom_f_24[4]=3234&
custom_f_24[5]=3235&
custom_f_24[6]=3236
&custom_f_24[7]=3237&
custom_f_24[8]=3238&
custom_f_24[9]=3239&
custom_f_24[10]=3330&
custom_f_24[11]=3331&
custom_f_24[12]=3332&
custom_f_24[13]=3333&
custom_f_24[14]=3334&
custom_f_24[15]=3335&
custom_f_24[16]=3336&
custom_f_24[17]=3337&
custom_f_24[18]=3338&
custom_f_24[19]=3339&
custom_f_24[20]=3430">20-40 соток</a>
<a href="/index.php/rezultaty-poiska/ландшафты-под-ключ/?custom_f_24[0]=40&
custom_f_24[1]=41&
custom_f_24[2]=42&
custom_f_24[3]=43&
custom_f_24[4]=44&
custom_f_24[5]=45&
custom_f_24[6]=46
&custom_f_24[7]=47&
custom_f_24[8]=48&
custom_f_24[9]=49&
custom_f_24[10]=50&
custom_f_24[11]=51&
custom_f_24[12]=52&
custom_f_24[13]=53&
custom_f_24[14]=54&
custom_f_24[15]=55&
custom_f_24[16]=56&
custom_f_24[17]=57&
custom_f_24[18]=58&
custom_f_24[19]=59&
custom_f_24[20]=60&
custom_f_24[21]=61&
custom_f_24[22]=62&
custom_f_24[23]=63&
custom_f_24[24]=64&
custom_f_24[25]=65&
custom_f_24[26]=66&
custom_f_24[27]=67&
custom_f_24[28]=68&
custom_f_24[29]=69&
custom_f_24[30]=70&
custom_f_24[31]=71&
custom_f_24[32]=72&
custom_f_24[33]=73&
custom_f_24[34]=74&
custom_f_24[35]=75&
custom_f_24[36]=76&
custom_f_24[37]=77&
custom_f_24[38]=78&
custom_f_24[39]=79&
custom_f_24[40]=80&
custom_f_24[41]=81&
custom_f_24[42]=82&
custom_f_24[43]=83&
custom_f_24[44]=84&
custom_f_24[45]=85&
custom_f_24[46]=86&
custom_f_24[47]=87&
custom_f_24[48]=88&
custom_f_24[49]=89&
custom_f_24[50]=90&
custom_f_24[51]=91&
custom_f_24[52]=92&
custom_f_24[53]=93&
custom_f_24[54]=94&
custom_f_24[55]=95&
custom_f_24[56]=96&
custom_f_24[57]=97&
custom_f_24[58]=98&
custom_f_24[59]=99&
custom_f_24[60]=100">40 сот.-1 га</a>
</div>

<?php
}
?>



<?php
if( (JURI::current()== (JURI::base()."rastenya-i-cviety")) ){
?>


<div class="landshafty_filter">
<a href="/index.php/rezultaty-poiska/rastenya-i-cviety/?custom_f_32[0]=31">тенелюбивые</a>
<a href="/index.php/rezultaty-poiska/rastenya-i-cviety/?custom_f_33[0]=31">светолюбивые</a>
<a href="/index.php/rezultaty-poiska/rastenya-i-cviety/?custom_f_34[0]=31">теневыносливые</a>
</div>


<?php
}
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
		<?php // if ($show_category) { ?>

			<div class="cat">
				<?php echo JHTML::link(JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$product->virtuemart_category_id), $product->category_name); ?>
			</div>
			<?php //} ?>	
			
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


<div class="block_view_all" style="width:100%; height:100px; text-align:center;">

<?php
$all_link="catalog";
//echo JURI::current();
if(JURI::current()== (JURI::base()."proekty-i-idei")){ 
$all_link="catalog/vse-tovary-kategorii-proekty-i-idei";
}else if(JURI::current()== (JURI::base()."gotovye-tsvetniki")){
$all_link="vse-tovary-kategorii-gotovye-tsvetniki";
}else if(JURI::current()== (JURI::base()."kompozitsii-iz-khvojnykh-rastenij")){
$all_link="vse-tovary-kategorii-kompozitsii-iz-khvojnykh-rastenij";
}else if(JURI::current()== (JURI::base()."kombinirovannye-kompozitsii-khvojnye-listvennye-tsvety")){
$all_link="vse-tovary-kategorii-kombinirovannye-kompozitsii";
}else if(JURI::current()== (JURI::base()."listvennye-kompozitsii")){
$all_link="vse-tovary-kategorii-listvennye-kompozitsii";
}

else if(JURI::current()== (JURI::base()."khvojnye")){
$all_link="vse-tovary-kategorii-khvojnye";
}
else if(JURI::current()== (JURI::base()."listvennye")){
$all_link="vse-tovary-kategorii-listvennye";
}
else if(JURI::current()== (JURI::base()."plodovye")){
$all_link="vse-tovary-kategorii-plodovye";
}
else if(JURI::current()== (JURI::base()."kustarniki")){
$all_link="vse-tovary-kategorii-kustarniki";
}
else if(JURI::current()== (JURI::base()."krupnomery")){
$all_link="vse-tovary-kategorii-krupnomery";
}
else if(JURI::current()== (JURI::base()."karlikovye-formy-dlya-mini-fasadov")){
$all_link="vse-tovary-kategorii-karlikovye-formy-dlya-mini-fasadov";
}
else if(JURI::current()== (JURI::base()."bonsaj")){
$all_link="vse-tovary-kategorii-bonsaj";
}
else if(JURI::current()== (JURI::base()."rastenya-i-cviety")){
$all_link="catalog/vse-tovary-kategorii-rasteniya-i-tsvety";
}


else if(JURI::current()== (JURI::base()."catalog/besedki")){
$all_link="catalog/vse-tovary-kategorii-besedki";
}
else if(JURI::current()== (JURI::base()."catalog/vazony")){
$all_link="catalog/vse-tovary-kategorii-vazony";
}
else if(JURI::current()== (JURI::base()."catalog/terrasy")){
$all_link="catalog/vse-tovary-kategorii-terrasy";
}
else if(JURI::current()== (JURI::base()."catalog/parniki")){
$all_link="catalog/vse-tovary-kategorii-parniki";
}
else if(JURI::current()== (JURI::base()."catalog/vodojomy")){
$all_link="catalog/vse-tovary-kategorii-vodojomy";
}
else if(JURI::current()== (JURI::base()."catalog/mebel")){
$all_link="catalog/vse-tovary-kategorii-mebel";
}
else if(JURI::current()== (JURI::base()."catalog/patio")){
$all_link="catalog/vse-tovary-kategorii-patio";
}
else if(JURI::current()== (JURI::base()."catalog/domiki")){
$all_link="catalog/vse-tovary-kategorii-domiki";
}

else if(JURI::current()== (JURI::base()."parki-dvory-ozelenenie")){
$all_link="catalog/vse-tovary-kategorii-parki-dvory-ozelenenie";
}

else if(JURI::current()== (JURI::base()."landshafty-pod-klych")){
$all_link="catalog/vse-tovary-kategorii-landshafty-pod-klyuch";
}



?>

<a href="<?php echo JURI::base().$all_link; ?>">
<input type="button" class="view_all" value="ПОКАЗАТЬ ЕЩЁ">
</a>


</div>



<?php	if ($footerText) : ?>
	<div class="vmfooter <?php echo $params->get( 'moduleclass_sfx' ) ?>">
		 <?php echo $footerText ?>
	</div>
<?php endif; ?>
</div>

