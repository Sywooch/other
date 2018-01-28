<?php
/**
 * @version		2.6.x
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>


<!--- popup form --->

<?php

?>


<script src="/components/com_k2/js/k2.js?v2.6.9&amp;sitepath=/" type="text/javascript"></script>
<script src="/templates/poparada/js/jui/bootstrap.min.js" type="text/javascript"></script>
<script src="/media/k2store/js/k2store-noconflict.js" type="text/javascript"></script>
<script src="/media/k2store/js/k2storejqui.js" type="text/javascript"></script>
<script src="/media/k2store/js/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
<script src="/media/k2store/js/k2store.js" type="text/javascript"></script>




<div class="popup_fon"></div>
<div class="popup_form popup_catalog">
	<input type="hidden" id="tovar_id" value=""/>
    
    <input type="hidden" id="size_value_1" value=""/>
    <input type="hidden" id="size_value_2" value=""/>
    <input type="hidden" id="material_up_value_1" value=""/>
    <input type="hidden" id="material_up_value_2" value=""/>
    <input type="hidden" id="material_down_value_1" value=""/>
    <input type="hidden" id="material_down_value_2" value=""/>
    
    
	<div class="popup_head">
    	<span class="popup_tovar_info tmp1">
        

<!-------->
<div id="k2store-product-281" class="k2store k2store-product-info" style="display:none;">

<form action="/index.php?option=com_k2store&amp;view=mycart" method="post" class="k2storeCartForm1" id="k2storeadminForm_281" name="k2storeadminForm_281" enctype="multipart/form-data">

	<div class="warning"></div>



	<!-- metricts -->

	<!-- stock -->
	
	<!-- is catalogue mode enabled?-->
	
		
		
   <!-- product options -->
   <?php //echo $this->loadTemplate('options'); ?>

       <div class="options">
                              <!-- option id = 2 -->
		  <script>
			  function pc(){
				  var prc = jQuery('option:selected').attr('data-to-price');
				  prc = prc.substr(0, prc.length-1) + 'грн.';
				  document.getElementById('price_eq').innerHTML = prc;

			  }
		  </script>


            <div id="option-149" class="option">
                            <span class="required">*</span>
                            <b>Выбор размера:</b><br>
              <div class="select-wrapper">
                <select class="form-control" name="product_option[149]" onclick="pc();">
                                                      <option data-to-price="710.000" value="1">маленький (S)
                  </option>
                                               <!--       <option data-to-price="910.000" value="3079">средний (M)
                  </option>
                                                      <option data-to-price="1220.000" value="3080">большой (L)
                  </option>-->
                                  </select>
              </div>
            </div>
            <br>
           



      <!-- radio -->

      

        
                     </div> 
      
<script type="text/javascript">

</script>   <!--  trigger plugin events -->
   				


					<!--base price-->
			<div class="form-group clearfix">
				<span itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" id="product_price_281" class="product_price pull-left">
										<span>Цена:</span>
					<span id="price_eq" itemprop="price">710.00 грн.</span>
									</span>

				<!--special price-->
			  
			

		<!-- sku -->

		  
		<!-- Quantity field -->
							<input type="hidden" name="product_qty" class="product_qty" value="1" size="2">
					</div><!-- /.form-group -->
	<!-- /.container -->

				     <!-- Add to cart button -->
											<div id="add_to_cart_281" class="k2store_add_to_cart form-group">
					        <input type="hidden" id="k2store_product_id" name="product_id" value="281">
<!--
					        <input type="hidden" name="05180f4102bae858f500ba923d720f41" value="1">					        
                            <input type="hidden" name="return" value="aHR0cDovL2F1dG8ubGFibGVuZC5ydS9wdWZpay1zaW55YS1wdGljYQ==">-->
					        <input value="Купить" type="submit" class="k2store_cart_button btn btn_add_to_cart" onclick="yaCounter21503773.reachGoal('addToCart'); return true;">
					    </div>
				     
		 
	

				<div class="k2store-notification" style="display: none;">
						<div class="message"></div>
						<div class="cart_link"><a class="btn btn-success" href="/index.php?option=com_k2store&amp;view=mycart" onclick="ga('send', 'pageview', '/aaaaaa');">Просмотр корзины</a></div>
						<div class="cart_dialogue_close" onclick="jQuery(this).parent().slideUp().hide();">x</div>
				</div>
				<div class="error_container">
					<div class="k2product"></div>
					<div class="k2stock"></div>
				</div>

<input type="hidden" name="option" value="com_k2store">
<input type="hidden" name="view" value="mycart">
<input type="hidden" id="task" name="task" value="add">
</form>

	</div>
       
<!-------->
        
        
	     <span class="text_underline"><span class="popup_count">1</span> <span class="popup_tovar">товар</span></span>
			
        
        
         <span>на сумму</span> <span class="popup_price"><?php //==++ echo K2StoreHelperCart::dispayPriceWithTax($item->price, $item->tax, $this->params->get('price_display_options', 1)); ?></span> <span></span></span>
    	<div class="popup_close"></div>
    </div>
    
    <span class="popup_price_hidden" style="display:none;"><?php //==++ echo $item->price; ?></span>
    
    
    <div class="popup_content">
    	<div class="popup_image"><img src="<?php //==++echo $item->imageMedium; ?>"/></div>
        <div class="popup_name"><?php //==++echo $item->title; ?></div>
        <span class="dop dop1">Размер: <span id="dop1"></span></span>
        <span class="dop dop2">Ткань верха: <span id="dop2"></span></span>
        <span class="dop dop3">Ткань низа: <span id="dop3"></span></span>
        
        <div class="popup_count">
        	<div class="popup_minus"></div>
            <input tyle="text" class="popup_text" value="1"/>
            <div class="popup_plus"></div>
            <span class="popup_container_price">
            	<span> = </span>
            	<span class="popup_price"><?php  //==++echo K2StoreHelperCart::dispayPriceWithTax($item->price, $item->tax, $this->params->get('price_display_options', 1)); ?></span>
            	<span></span>
            </span>
            
        </div>
        
        <a href="#" class="popup_text4">Выбрать другой размер и ткань</a>
        <!--
        <span class="popup_text2">Вернуться на страницу</span>
        <span class="popup_main_button">Оформить заказ через сайт</span>
        -->
        
    </div>
    
    <div class="popup_footer">
    	<span class="popup_text1">Быстрый заказ</span>
        <span class="popup_text2">Оставьте номер телефона для консультирования и оформления заказа</span>
        <span class="popup_phone_code">+38</span>
        <input type="text" class="popup_phone"/>
        <input type="button" class="popup_phone_button" value="Жду звонка"/>
        <span class="popup_link_tovar" style="display:none;"></span>
        
        <span class="popup_error">Пожалуйста, укажите правильный номер</span>
    
    </div>
    
    
</div>




<div class="popup_form2">
	<div class="popup_close"></div>
    <span class="text1">Спасибо</span>
    <span class="text2">Наши менеджеры свяжутся с вами в<br>ближайшее время</span>

</div>


<?php

?>












<!-- Start K2 Category Layout -->
<div id="k2Container" class="itemListView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">
	<?php if($this->params->get('show_page_title')): ?>
	<!-- Page title -->
	<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
	<?php endif; ?>
	<?php if ($_SERVER['REQUEST_URI'] == '/beskarkasnaya-mebel-katalog.html') { ?>
		<h1 style="text-align:center;">Бескаркасная мебель</h1>
	<?php } ?>
	<?php if($this->params->get('catFeedIcon')): ?>
	<!-- RSS feed icon -->
	<div class="k2FeedIcon">
		<a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
			<span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></span>
		</a>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

	<?php if(isset($this->category) || ( $this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories) )): ?>
	<!-- Blocks for current category and subcategories -->
	<div class="itemListCategoriesBlock">

		<?php if(isset($this->category) && ( $this->params->get('catImage') || $this->params->get('catTitle') || $this->params->get('catDescription') || $this->category->event->K2CategoryDisplay )): ?>
		<!-- Category block -->
		<div class="itemListCategory">

			<?php if(isset($this->addLink)): ?>
			<!-- Item add link -->
			<span class="catItemAddLink">
				<a class="modal" rel="{handler:'iframe',size:{x:990,y:650}}" href="<?php echo $this->addLink; ?>">
					<?php echo JText::_('K2_ADD_A_NEW_ITEM_IN_THIS_CATEGORY'); ?>
				</a>
			</span>
			<?php endif; ?>

			<?php if($this->params->get('catImage') && $this->category->image): ?>
			<!-- Category image -->
			<img alt="<?php echo K2HelperUtilities::cleanHtml($this->category->name); ?>" src="<?php echo $this->category->image; ?>" style="width:<?php echo $this->params->get('catImageWidth'); ?>px; height:auto;" />
			<?php endif; ?>

			<?php if($this->params->get('catTitle')): ?>
			<!-- Category title -->

			<h1 class="text-center"><?php echo $this->category->name; ?><?php if($this->params->get('catTitleItemCounter')) echo ' ('.$this->pagination->total.')'; ?></h1>
			<?php endif; ?>

			<!-- K2 Plugins: K2CategoryDisplay -->
			<?php echo $this->category->event->K2CategoryDisplay; ?>

			<div class="clr"></div>
		</div>
		<?php endif; ?>

		<?php if($this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories)): ?>
		<!-- Subcategories -->
		<div class="itemListSubCategories">
			
			<?php foreach($this->subCategories as $key=>$subCategory): ?>
			<div id="<?php echo($subCategory->alias); ?>" class="dropdown-item-title pad-top">
				</div>

			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('subCatColumns'))==0))
				$lastContainer= ' subCategoryContainerLast';
			else
				$lastContainer='';
			?>

			<div class="subCategoryContainer<?php echo $lastContainer; ?>"<?php echo (count($this->subCategories)==1) ? '' : ' style="width:'.number_format(100/$this->params->get('subCatColumns'), 1).'%;"'; ?>>
				<div class="subCategory">
					<?php if($this->params->get('subCatImage') && $subCategory->image): ?>
				<!-- Subcategory image -->
					<a class="subCategoryImage" href="<?php echo $subCategory->link; ?>">
						<img alt="<?php echo K2HelperUtilities::cleanHtml($subCategory->name); ?>" src="<?php echo $subCategory->image; ?>" />
					</a>
					<?php endif; ?>

				<!-- Subcategory title -->
				
					<?php if($this->params->get('subCatTitle')): ?>
					<h2>
						<a href="<?php echo $subCategory->link; ?>">
							<?php echo $subCategory->name; ?><?php if($this->params->get('subCatTitleItemCounter')) echo ' ('.$subCategory->numOfItems.')'; ?>
						</a>
					</h2>
					<?php endif; ?>

					<?php if($this->params->get('subCatDescription')): ?>
					<!-- Subcategory description -->
					<p><?php echo $subCategory->description; ?></p>
					<?php endif; ?>

					<div class="clr"></div>
				</div>
			</div>
			<?php if(($key+1)%($this->params->get('subCatColumns'))==0): ?>
			<div class="clr"></div>
			<?php endif; ?>
			<?php endforeach; ?>

			<div class="clr"></div>
		</div>
		<?php endif; ?>

	</div>
	<?php endif; ?>



	<?php if((isset($this->leading) || isset($this->primary) || isset($this->secondary) || isset($this->links)) && (count($this->leading) || count($this->primary) || count($this->secondary) || count($this->links))): ?>
	<!-- Item list -->
	<div class="itemList container-fluid container-improved-position">

		<?php if(isset($this->leading) && count($this->leading)): ?>
		<!-- Leading items -->
		<div id="itemListLeading">
			<?php foreach($this->leading as $key=>$item): ?>

			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('num_leading_columns'))==0) || count($this->leading)<$this->params->get('num_leading_columns') )
				$lastContainer= ' itemContainerLast';
			else
				$lastContainer='';
			?>
			
			<div class="itemContainer<?php echo $lastContainer; ?>"<?php echo (count($this->leading)==1) ? '' : ' style="width:'.number_format(100/$this->params->get('num_leading_columns'), 1).'%;"'; ?>>
				<?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>
			</div>
			<?php if(($key+1)%($this->params->get('num_leading_columns'))==0): ?>
			<div class="clr"></div>
			<?php endif; ?>
			<?php endforeach; ?>
			<div class="clr"></div>
		</div>
		<?php endif; ?>

		<?php if(isset($this->primary) && count($this->primary)): ?>
		<!-- Primary items -->
		<div id="itemListPrimary" class="row">
			<?php foreach($this->primary as $key=>$item): ?>
			
			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('num_primary_columns'))==0) || count($this->primary)<$this->params->get('num_primary_columns') )
				$lastContainer= ' itemContainerLast';
			else
				$lastContainer='';
			?>
			
			<div class="itemContainer col-sm-4 col-xs-6">
				<?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>
			</div>
			<?php if (($key+1)%3 == 0) : ?>
				<!-- Add the extra clearfix for only the required viewport -->
					<div class="clearfix visible-sm-block visible-md-block visible-lg-block"></div>
					<hr class="visible-sm-block visible-md-block visible-lg-block">
				<?php if (($key+1)%2 == 0) : ?>
					<div class="clearfix visible-xs-block"></div>
					<hr class="visible-xs-block">
				<?php endif ?>
			<?php elseif (($key+1)%2 == 0) : ?>
				<div class="clearfix visible-xs-block"></div>
				<hr class="visible-xs-block">
			<?php endif ?>
			
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<?php if(isset($this->secondary) && count($this->secondary)): ?>
		<!-- Secondary items -->
		<div id="itemListSecondary">
			<?php foreach($this->secondary as $key=>$item): ?>
			
			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('num_secondary_columns'))==0) || count($this->secondary)<$this->params->get('num_secondary_columns') )
				$lastContainer= ' itemContainerLast';
			else
				$lastContainer='';
			?>
			
			<div class="itemContainer<?php echo $lastContainer; ?>"<?php echo (count($this->secondary)==1) ? '' : ' style="width:'.number_format(100/$this->params->get('num_secondary_columns'), 1).'%;"'; ?>>
				<?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>
			</div>
			<?php if(($key+1)%($this->params->get('num_secondary_columns'))==0): ?>
			<div class="clr"></div>
			<?php endif; ?>
			<?php endforeach; ?>
			<div class="clr"></div>
		</div>
		<?php endif; ?>

		<?php if(isset($this->links) && count($this->links)): ?>
		<!-- Link items -->
		<div id="itemListLinks">
			<h4><?php echo JText::_('K2_MORE'); ?></h4>
			<?php foreach($this->links as $key=>$item): ?>

			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('num_links_columns'))==0) || count($this->links)<$this->params->get('num_links_columns') )
				$lastContainer= ' itemContainerLast';
			else
				$lastContainer='';
			?>

			<div class="itemContainer<?php echo $lastContainer; ?>"<?php echo (count($this->links)==1) ? '' : ' style="width:'.number_format(100/$this->params->get('num_links_columns'), 1).'%;"'; ?>>
				<?php
					// Load category_item_links.php by default
					$this->item=$item;
					echo $this->loadTemplate('item_links');
				?>
			</div>
			<?php if(($key+1)%($this->params->get('num_links_columns'))==0): ?>
			<div class="clr"></div>
			<?php endif; ?>
			<?php endforeach; ?>
			<div class="clr"></div>
		</div>
		<?php endif; ?>

	</div>

	<!-- Pagination -->
	<?php if($this->pagination->getPagesLinks()): ?>
	<div class="k2Pagination">
		<?php if($this->params->get('catPagination')) echo $this->pagination->getPagesLinks(); ?>
		<div class="clr"></div>
		<?php if($this->params->get('catPaginationResults')) echo $this->pagination->getPagesCounter(); ?>
	</div>
	<?php endif; ?>

	<?php endif; ?>
	

			<?php if($this->params->get('catDescription')): ?>
			<!-- Category description -->
			<div style="margin-bottom:30px;" class="container">
				<div class="row">
					<div class="col-md-12">
						<p><?php echo $this->category->description; ?></p>
					</div>
				</div>
			</div>
			<?php endif; ?>
</div>
<!-- End K2 Category Layout -->
<script>
	jQuery(document).ready(function($) {
		if (typeof jQuery != 'undefined' && typeof MooTools != 'undefined' ) {
        Element.implement({
            slide: function(how, mode){
                return this;
            }
        });
		}
		console.log('ready 2');
		/*catalog images*/
    NavBarView.hoverImgs($('.product-image-hover'));
	});
</script>


<!-- popup ---->





<script type="text/javascript">
var $j=jQuery.noConflict();
//$j('.btn_add_to_cart').click(function(){
//$j('.catItemBody .basket_button').click(function(){
//	$j('.popup_fon').fadeIn(500);
//	$j('.popup_form').fadeIn(500);
	
	
//});


function catalog_poup(title,image,price,link1,id1){

	$j('.popup_fon').fadeIn(500);
	$j('.popup_form').fadeIn(500);

	//заполнение параметров
	$j('.k2store.k2store-product-info').attr("id",'k2store-product-'+id1);
	$j('form.k2storeCartForm1').attr("id","k2storeadminForm_"+id1);
	$j('form.k2storeCartForm1').attr("name","k2storeadminForm_"+id1);
	$j('.product_price.pull-left').attr("id","product_price_"+id1);
	$j('#price_eq').html(price+" грн.");
	$j('.k2store_add_to_cart.form-group').attr("id","add_to_cart_"+id1);
	$j('#k2store_product_id').val(id1);
	$j('.popup_form .popup_price').html(price+" грн.");
	$j('.popup_form .popup_price_hidden').html(price);
	$j('.popup_form .popup_image img').attr('src',image);
	$j('.popup_form .popup_name').html(title);
 	$j('.popup_form .popup_price').html(price+" грн.");
	$j('.popup_form .popup_link_tovar').html(link1);
	/**/
	$j('.popup_form #tovar_id').val(id1);
	
	$j('.popup_form .popup_content .popup_count .popup_text').val('1');
	
	$j('.popup_form .popup_text4').attr('href',link1);
	
	//получение трёх дополнительных параметров
	params = { product_id:id1 };

	$j.ajax({
	type: "POST",
	url: "/ajax/dop.php",
	data: params,
	async: false,
	success: function(data){
	
	var result = jQuery.parseJSON( data );
	if(result[2]=="1S"){ result[2]="Маленький (S)"; }
	else if(result[2]=="1M"){ result[2]="Средний (M)"; }
	else if(result[2]=="1L"){ result[2]="Большой (L)"; }
	
	$j(".popup_form .popup_content #dop1").html(result[2]);
	$j(".popup_form .popup_content #dop2").html(result[0]);
	$j(".popup_form .popup_content #dop3").html(result[1]);
	
	
	$j(".popup_form #size_value_1").val(result[3]);
	$j(".popup_form #size_value_2").val(result[4]);
	
	
	$j(".popup_form #material_up_value_1").val(result[5]);
	$j(".popup_form #material_up_value_2").val(result[6]);
	
	
	$j(".popup_form #material_down_value_1").val(result[7]);
	$j(".popup_form #material_down_value_2").val(result[8]);
	
	
	
	}})
	
	
}





$j('.popup_form .popup_head .popup_close').click(function(){
	
	$j('.popup_fon').fadeOut(500);
	$j('.popup_form').fadeOut(500);
	count_nulled();
});






function popup_price_change(){
	var count1=$j('.popup_form .popup_content .popup_count .popup_text').val();
	var price_one=$j('.popup_price_hidden').html();

	
	price_one=parseInt(price_one);
	var final_price=price_one*count1;
	
	
	var old_price=$j('.popup_price').html();
	var old_price_m=old_price.split(" ");
	var tmp=old_price_m[1];
	final_price=final_price+" "+tmp;
	$j('.popup_price').html(final_price);
	popup_count_change();
}


function declOfNum(number, titles)  
{  
    cases = [2, 0, 1, 1, 1, 2];  
    return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];  
}


function popup_count_change(){
	var count1=$j('.popup_form .popup_content .popup_count .popup_text').val();
	$j('.popup_tovar_info .popup_count').html(count1);
	var text1=declOfNum(count1,['товар','товара','товаров']);
	$j('.popup_tovar_info .popup_tovar').html(text1);
	$j('.popup_form .product_qty').val(count1);
}


$j('.popup_form .popup_content .popup_count .popup_plus').click(function(){
	
	var count1=$j('.popup_form .popup_content .popup_count .popup_text').val();
	count1=parseInt(count1)+1;
	$j('.popup_form .popup_content .popup_count .popup_text').val(count1);
	popup_price_change();
});	

$j('.popup_form .popup_content .popup_count .popup_minus').click(function(){
	var count1=$j('.popup_form .popup_content .popup_count .popup_text').val();
	if(count1>1){
	count1=parseInt(count1)-1;
	$j('.popup_form .popup_content .popup_count .popup_text').val(count1);
	}
	popup_price_change();
	
});	

$j('.popup_form .popup_content .popup_count .popup_text').focusout(function(){
  popup_price_change();
});



function count_nulled(){
	//$j('.popup_form .popup_count').html("1");
	//$j('.popup_form .product_qty').val("1");
	$j('.popup_form .popup_content .popup_count .popup_text').val("1");
	popup_count_change();
	
}


function second_passed() {

	 location.href="/index.php?option=com_k2store&view=mycart&Itemid=220";

}


function second_passed2() {

	 location.href="/index.php?option=com_k2store&view=checkout&Itemid=220";

}


function send_to_basket(){
	
	
	
	var product_qty = $j('.popup_form .popup_content .popup_count .popup_text').val();
	var product_id = $j('.popup_form #tovar_id').val();
	
	var size_value_1=$j('.popup_form #size_value_1').val();
	var size_value_2=$j('.popup_form #size_value_2').val();
	var material_up_value_1=$j('.popup_form #material_up_value_1').val();
	var material_up_value_2=$j('.popup_form #material_up_value_2').val();
	var material_down_value_1=$j('.popup_form #material_down_value_1').val();
	var material_down_value_2=$j('.popup_form #material_down_value_2').val();
	

	
	
//	params = { product_qty:product_qty,product_id:product_id,option:"com_k2store",view:"mycart",task:"add",product_option:{"148":"1",size_value_1:size_value_2,material_up_value_1:material_up_value_2,material_down_value_1:material_down_value_2}};
	var product_option2 = {};
	//product_option2={"148":"1","114":size_value_2,"115":material_up_value_2,"116":material_down_value_2}
	product_option2[size_value_1]=size_value_2;
	product_option2[material_up_value_1]=material_up_value_2;
	product_option2[material_down_value_1]=material_down_value_2;
	
	
	
	//params = { product_qty:product_qty,product_id:product_id,option:"com_k2store",view:"mycart",task:"add",product_option:{"148":"1",size_value_1:size_value_2,"115":material_up_value_2,"116":material_down_value_2}};

	params = { product_qty:product_qty,product_id:product_id,option:"com_k2store",view:"mycart",task:"add",product_option:product_option2};

	
	$j.ajax({
	type: "POST",
	url: "/index.php?option=com_k2store&view=mycart",
	data: params,
	async: false,
	success: function(data){
	
	//alert(data);
	var data1=$j('.error2').html();
	data1=data1+" -- "+data;

	$j('.error2').html(data1);



	}})
	 
	
}



$j('.popup_form .text_underline').click(function(){
	//$j(".popup_form form").submit();
	send_to_basket();
	 
	setTimeout(second_passed, 2000)

});


$j('.popup_form .popup_content .popup_main_button').click(function(){
	//$j(".popup_form form").submit();
	send_to_basket();
	 
	setTimeout(second_passed2, 2000)

});


$j('.popup_form .popup_content .popup_text1').click(function(){
	//$j(".popup_form form").submit();
	send_to_basket();
	
	$j(".popup_form").fadeOut(500);
	count_nulled();
	$j(".popup_fon").fadeOut(500);
	
});


$j('.popup_form .popup_footer .popup_phone_button').click(function(){

//var tovar_link="<?php  echo JURI::base().($item->link); ?>";
var tovar_link=$j('.popup_form .popup_footer .popup_tovar_link').html();
var tovar_name=$j('.popup_form .popup_name').html();

var phone=$j('.popup_form .popup_footer .popup_phone').val();

if( ( phone.length == 10 )&&(phone.match(/^\d+$/)) ){
	
$j('.popup_form .popup_error').fadeOut(500);

phone="+38"+$j('.popup_form .popup_footer .popup_phone').val();

params = { tovar_link:tovar_link,tovar_name:tovar_name,phone:phone};

	
$j.ajax({
type: "POST",
url: "/ajax/callme.php",
data: params,
async: false,
success: function(data){
	
$j('.popup_form2').fadeIn(500);
$j('.popup_form').fadeOut(500);
count_nulled();

}})

}else{
	
$j('.popup_form .popup_error').fadeIn(500);	

}



});




$j('.popup_form .popup_content .popup_text2').click(function(){

	$j(".popup_form").fadeOut(500);
	count_nulled();
	$j(".popup_fon").fadeOut(500);
	
});





$j('.popup_form2 .popup_close').click(function(){

$j('.popup_form2').fadeOut(500);
$j('.popup_fon').fadeOut(500);

});


</script>




<span class="error2"></span>
<?php
//$inp = '\u0412\u044b\u0431\u043e\u0440 \u0440\u0430\u0437\u043c\u0435\u0440\u0430 \u0442\u0440\u0435\u0431\u0443\u0435\u0442\u0441\u044f';
//$s = preg_replace('/\\\u0([0-9a-fA-F]{3})/','&#x\1;',$inp);
//echo html_entity_decode($s, ENT_NOQUOTES, 'UTF-8');

?>



