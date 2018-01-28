<?php
    
    // Check to ensure this file is included in Joomla!
    defined('_JEXEC') or die('Restricted access');
	$continue_link = $_SERVER['HTTP_REFERER'];
	$this->continue_link = $continue_link;

    if(!class_exists('VirtueMartCart')) require(JPATH_VM_SITE.DS.'helpers'.DS.'cart.php');
    if (!class_exists('CurrencyDisplay'))
        require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'currencydisplay.php');
    $currency = CurrencyDisplay::getInstance();
    $cart = VirtueMartCart::getCart(false);
  
    foreach ($cart->products as $product){   
	
?>
    <div style="overflow: hidden;">
        <div class="prices" style="float: right;">
			<?php echo $currency->priceDisplay($product->product_price); ?>
		</div>
			<span class="quantity">
				<?php 
					if ($product->image->file_url_thumb){ 
                ?>
					<img style="max-width:20px; max-height:20px; margin-bottom:-4px;" src="/<?php echo $product->image->file_url_thumb ;?>" />
                <?php 
				
					}
					echo  $product->quantity; 
				?>
			</span>&nbsp;x&nbsp;
			<span class="product_name"><?php echo $product->product_name ?></span>
    </div>
    <?php 
        $billTotal+=$product->product_price * $product->quantity;
    }
    echo "<h4>Всего на сумму:". $currency->priceDisplay($billTotal)."</h4>";
	?>
	<div class="popupcart" style="text-align:center; width:400px;">
		<h3>Товар добавлен в корзину</h3>
		<?php 
			if($this->product){
				if ($this->product->file_url_thumb){
			?>
            <img src="/<?php echo $this->product->file_url_thumb;?>" />
            <?php 
            }
        ?>
			<br>
			<span style="display:block; padding:10px;">
			<?php echo $this->product->product_name; ?>
			</span>
			<?php 
			}
			?>
		<br style="clear:both">
		<div style="padding:10px 20px; overflow: hidden;">
		<?php 
			echo '<a class="continue floatleft" href="' . $this->continue_link . '" >' . JText::_('COM_VIRTUEMART_CONTINUE_SHOPPING') . '</a>';
			echo '<a class="showcart nice-link button big floatright" href="' . $this->cart_link . '">' . JText::_('COM_VIRTUEMART_CART_SHOW') . '</a>'; 
		?>
    </div>
	</div>