<?php
	defined ('_JEXEC') or  die('Direct Access to ' . basename (__FILE__) . ' is not allowed.');
	/*
 * Module Helper
 *
 * @package VirtueMart
 * @copyright (C) 2010 - Patrick Kohl
 * @ Email: cyber__fr|at|hotmail.com
 *
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * VirtueMart is Free Software.
 * VirtueMart comes with absolute no warranty.
 *
 * www.virtuemart.net
 */
	if (!class_exists ('VmConfig')) {
		require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'config.php');
	}
	VmConfig::loadConfig ();
	// Load the language file of com_virtuemart.
	JFactory::getLanguage ()->load ('com_virtuemart');
	if (!class_exists ('calculationHelper')) {
		require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'calculationh.php');
	}
	if (!class_exists ('CurrencyDisplay')) {
		require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'currencydisplay.php');
	}
	if (!class_exists ('VirtueMartModelVendor')) {
		require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'models' . DS . 'vendor.php');
	}
	if (!class_exists ('VmImage')) {
		require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'image.php');
	}
	if (!class_exists ('shopFunctionsF')) {
		require(JPATH_SITE . DS . 'components' . DS . 'com_virtuemart' . DS . 'helpers' . DS . 'shopfunctionsf.php');
	}
	if (!class_exists ('calculationHelper')) {
		require(JPATH_COMPONENT_SITE . DS . 'helpers' . DS . 'cart.php');
	}
	if (!class_exists ('VirtueMartModelProduct')) {
		JLoader::import ('product', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'models');
	}
   JLoader::import( 'ratings', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart' . DS . 'models' );

class mod_virtuemart_product {

	function addtocart ($product) {
		if (isset($product->step_order_level))
							$step=$product->step_order_level;
						else
							$step=1;
						if($step==0)
							$step=1;
						$alert=JText::sprintf ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED', $step);
		
			 if ((!VmConfig::get('use_as_catalog', 0) and !empty($product->prices['salesPrice'])) && !$product->images[0]->file_is_downloadable) { ?>
									<div class="addtocart-area">
										<form method="post" class="product" action="index.php" id="addtocartproduct<?php echo $product->virtuemart_product_id ?>">
										 <input name="quantity" type="hidden" value="<?php echo $step ?>" />
										<div class="addtocart-bar2">
											<script type="text/javascript">
		function check(obj) {
 		// use the modulus operator '%' to see if there is a remainder
		remainder=obj.value % <?php echo $step?>;
		quantity=obj.value;
 		if (remainder  != 0) {
 			alert('<?php echo $alert?>!');
 			obj.value = quantity-remainder;
 			return false;
 			}
 		return true;
 		}
</script> 
											<?php // Display the quantity box 
											 foreach ($product->customfieldsCart as $field) {
											 	if ($field->custom_value=='stockable'){
											 		$stockvariant = '1';
													
											 	}else {$stockvariant = '0';}
												
												}
												//print_r($stockvariant);
												
												
												
											if ($stockvariant=='1') { ?>
											<span class="attributes"><b>*</b> Product has attributes</span>
                                            <div class="addtocart_button">
											<?php echo JHTML::link($product->link, JText::_('COM_VIRTUEMART_CART_ADD_TO').'<span>&nbsp;</span>', array('title' =>JText::_('DR_VIRTUEMART_SELECT_OPTION'),'class' => 'addtocart-button hasTooltip')); ?>
											<i></i>
                                      	  </div>
										
										<?php } else { ?>		
											<?php // Display the quantity box 

											if ($product->product_in_stock < 1) {
										 ?> <div class="addtocart_button">
												<a class="addtocart-button" href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=productdetails&layout=notify&virtuemart_product_id='.$product->virtuemart_product_id); ?>"><?php echo JText::_('COM_VIRTUEMART_CART_NOTIFY') ?></a>
												<i></i>
												</div>
												
										<?php } else { 
											if ((!empty($product->customsChilds)) || (!empty($product->customfieldsCart))) { ?>
											<span class="attributes"><b>*</b> Product has attributes</span>
                                            <div class="addtocart_button">
											<i></i>
											<?php echo JHTML::link($product->link, JText::_('COM_VIRTUEMART_CART_ADD_TO').'<span>&nbsp;</span>', array('title' =>JText::_('DR_VIRTUEMART_SELECT_OPTION'),'class' => 'addtocart-button hasTooltip')); ?></div>
                                        	<?php } else { ?>
										
										<span class="quantity-box">
											<input type="text" class="quantity-input js-recalculate" name="quantity[]" onblur="check(this);" value="<?php if (isset($product->step_order_level) && (int)$product->step_order_level > 0) {
			echo $product->step_order_level;
		} else if(!empty($product->min_order_level)){
			echo $product->min_order_level;
		}else {
			echo '1';
		} ?>"/>
											</span>
											<span class="quantity-controls">
											<input type="button" class="quantity-controls quantity-plus" />
											<input type="button" class="quantity-controls quantity-minus" />
											</span>
											<?php // Add the button
											$button_lbl = JText::_('COM_VIRTUEMART_CART_ADD_TO');
											$button_cls = 'addtocart-button cart-click'; //$button_cls = 'addtocart_button';
											?>
											<?php // Display the add to cart button ?>
											<div class="clear"></div>
											<span class="addtocart-button">
											<i></i>
												<input type="submit" name="<?php echo $button_name ?>"  class="<?php echo $button_cls ?>" value="<?php echo $button_lbl ?>" title="<?php echo $button_lbl ?>" />
											</span>
											<?php } } }?>
										</div>
										<input type="hidden" class="pname" value="<?php echo $product->product_name ?>"/>
										<input type="hidden" name="option" value="com_virtuemart" />
										<input type="hidden" name="view" value="cart" />
										<noscript><input type="hidden" name="task" value="add" /></noscript>
										<input type="hidden" name="virtuemart_product_id[]" value="<?php echo $product->virtuemart_product_id ?>" />
										<input type="hidden" name="virtuemart_category_id[]" value="<?php echo $product->virtuemart_category_id ?>" />
									</form>
									</div>
								<?php }

	}
} ?>