<?php
/*------------------------------------------------------------------------
# com_k2store - K2 Store
# ------------------------------------------------------------------------
# author    Ramesh Elamathi - Weblogicx India http://www.weblogicxindia.com
# copyright Copyright (C) 2012 Weblogicxindia.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://k2store.org
# Technical Support:  Forum - http://k2store.org/forum/index.html
-------------------------------------------------------------------------*/


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$item = @$this->item;
$formName = 'k2storeadminForm_'.$item->product_id;
require_once (JPATH_SITE.'/components/com_k2store/helpers/cart.php');
require_once (JPATH_ADMINISTRATOR.'/components/com_k2store/library/select.php');
require_once (JPATH_ADMINISTRATOR.'/components/com_k2store/library/inventory.php');

if(isset($this->product->item_cart_text) && (JString::strlen($this->product->item_cart_text) > 0 ) ) {
	$cart_text = $this->product->item_cart_text;
} else {
	$cart_text = JText::_('K2STORE_ADD_TO_CART');
}
$inventoryCheck = K2StoreInventory::isAllowed($item);
$action = JRoute::_('index.php?option=com_k2store&view=mycart');
?>


<div class="popup_fon"></div>
<div class="popup_form popup_detail">
	<input type="hidden" id="tovar_id" value="<?php echo $item->product_id; ?>">
	<div class="popup_head">
    	<span class="popup_tovar_info">
        

<!-------->


       
<!-------->
        
        
	     <span class="text_underline"><span class="popup_count">1</span> <span class="popup_tovar">товар</span></span>
			
        
        
         <span>на сумму</span> <span class="popup_price"><?php  echo K2StoreHelperCart::dispayPriceWithTax($item->price, $item->tax, $this->params->get('price_display_options', 1)); ?></span> <span></span></span>
    	<div class="popup_close"></div>
    </div>
    
    <span class="popup_price_hidden" style="display:none;"><?php echo $item->price; ?></span>
    
    
    <div class="popup_content">
    	<div class="popup_image"><img src="<?php echo $item->imageMedium; ?>"/></div>
        <div class="popup_name"><?php echo $item->title; ?></div>
        <div class="popup_count">
        	<div class="popup_minus"></div>
            <input type="text" class="popup_text" value="1"/>
            <div class="popup_plus"></div>
            <span class="popup_container_price">
            	<span> = </span>
            	<span class="popup_price"><?php  echo K2StoreHelperCart::dispayPriceWithTax($item->price, $item->tax, $this->params->get('price_display_options', 1)); ?></span>
            	<span></span>
            </span>
            
            
            
            
        </div>
        
        <div class="block_material block_material_1">
            <span class="text_size">Размер: <span></span></span>
            <span class="text_material">Ткань: <span></span></span>
            <span class="text_diametr">Диаметр: <span></span></span>
            <span class="text_height">Высота: <span></span></span>
            <div class="material_block"></div>	
        </div>
            
        <div class="block_material block_material_2">
           <!-- <span class="text_size">Размер: <span></span></span>-->
            <span class="text_material">Ткань: <span></span></span>
            <!--<span class="text_diametr">Диаметр: <span></span></span>
            <span class="text_height">Высота: <span></span></span>-->
            <div class="material_block"></div>
            	
        </div>
       		
       		
       		
       	<span class="return_select">Выбрать другие размер и ткань</span>
            
            
        
        
        
        <span class="popup_text1">Продолжить покупки</span>
        <span class="popup_text2">Вернуться на страницу</span>
        <span class="popup_main_button">Оформить заказ</span>
        
        
    </div>
    
    <div class="popup_footer">
    	<span class="popup_text1">Быстрый заказ</span>
        <span class="popup_text2">Оставьте номер телефона для консультирования и оформления заказа</span>
        <span class="popup_phone_code">+38</span>
        <input type="text" class="popup_phone"/>
        <input type="button" class="popup_phone_button" value="Жду звонка"/>
        
        <span class="popup_error">Пожалуйста, укажите правильный номер</span>
    
    </div>
    
    
</div>




<div class="popup_form2">
	<div class="popup_close"></div>
    <span class="text1">Спасибо</span>
    <span class="text2">Наши менеджеры свяжутся с вами в<br>ближайшее время</span>

</div>







<?php
//echo"<pre>";
//print_r($item);
//echo"</pre>";
?>

<div id="k2store-product-<?php echo $item->product_id; ?>" class="k2store k2store-product-info">
<?php if(count(JModuleHelper::getModules('k2store-addtocart-top')) > 0 ): ?>
	<div class="k2store_modules">
		<?php echo K2StoreHelperModules::loadposition('k2store-addtocart-top'); ?>
	</div>
<?php endif; ?>

<form action="<?php echo $action; ?>" method="post" class="k2storeCartForm1" id="<?php echo $formName; ?>" name="<?php echo $formName; ?>" enctype="multipart/form-data">

	<div class="warning"></div>



	<!-- metricts -->

	<!-- stock -->
	<?php if($this->params->get('show_stock_field', 0) && K2STORE_PRO==1):?>
		<div id='product_stock_<?php echo $item->product_id; ?>' class="product_stock">
		<?php if($inventoryCheck->can_allow):?>
			<?php if($item->product_stock > 0): ?>
	 			<span><?php echo JText::_( "K2STORE_IN_STOCK" ); ?>:</span>
				<span><?php echo $item->product_stock; ?></span>
			<?php endif; ?>
		<?php elseif($inventoryCheck->backorder && $inventoryCheck->can_allow == 0):?>
			<?php echo JText::_('K2STORE_ADDTOCART_BACKORDER_ALERT'); ?>
		<?php else: ?>
				<span><?php echo JText::_( "K2STORE_OUT_OF_STOCK" ); ?></span>
		<?php endif; ?>
		</div>
	<?php endif;?>

	<!-- is catalogue mode enabled?-->
	<?php if(!$this->params->get('catalog_mode', 0)):?>

		<?php
		//registered users check
		$allow = true;
		$is_register = $this->params->get('isregister', 0);
		if($is_register && !JFactory::getUser()->id) {
			//user not logged in. set to false
			$allow = false;
		}
		?>

		<?php if($allow):?>

   <!-- product options -->
   <?php echo $this->loadTemplate('options'); ?>
   <!--  trigger plugin events -->
   	<?php if(isset($item->event->K2StoreBeforeCartDisplay)):?>
		<?php echo $item->event->K2StoreBeforeCartDisplay; ?>
	<?php endif; ?>



			<?php if($this->params->get('show_price_field', 1)):?>
		<!--base price-->
			<div class="form-group clearfix">
				<span itemprop="offers" itemscope itemtype="http://schema.org/Offer" id="product_price_<?php echo $item->product_id; ?>" class="product_price pull-left">
					<?php if($item->special_price > 0.000) echo '<strike>'; ?>
					<span>Цена:</span>
					<span id="price_eq" itemprop="price"><?php  echo K2StoreHelperCart::dispayPriceWithTax($item->price, $item->tax, $this->params->get('price_display_options', 1)); ?></span>
					<?php if($item->special_price > 0.000) echo '</strike>'; ?>
				</span>

				<!--special price-->
			  <?php if($item->special_price > 0.000) :?>
			    <span id="product_special_price_<?php echo $item->product_id; ?>" class="product_special_price">
			    	<?php  echo K2StoreHelperCart::dispayPriceWithTax($item->special_price, $item->sp_tax, $this->params->get('price_display_options', 1)); ?>
			    </span>
			  <?php endif;?>

			<?php endif; ?>


		<!-- sku -->

		  <?php if($this->params->get('show_sku_field', 0)):?>
		 		<div id='product_sku_<?php echo $item->product_id; ?>' class="product_sku">
					<span><?php echo JText::_( "K2STORE_SKU" ); ?>:</span>
					<span><?php echo $this->product->product_sku; ?></span>
		   		</div>
			<?php endif;?>

		<!-- Quantity field -->
			<?php if($this->params->get('show_qty_field', 1)):?>
				<div id='product_quantity_input_<?php echo $item->product_id; ?>' class="product_quantity_input pull-left">

					<span class="select-wrapper"><input class="form-control" type="number" min="1" name="product_qty" value="<?php echo $item->product_quantity; ?>" size="2" /></span>
					<?php if(isset($item->item_minimum_notice)):?>
					<br />
					<small class="k2store-minmum-quantity muted"><?php echo $item->item_minimum_notice; ?></small>
					<?php endif; ?>
				</div>
			<?php else:?>
				<input type="hidden" name="product_qty" value="<?php echo $item->product_quantity; ?>" size="2" />
			<?php endif; ?>
		</div><!-- /.form-group -->
	<!-- /.container -->

				     <!-- Add to cart button -->
					<?php if($inventoryCheck->can_allow || $inventoryCheck->backorder):?>
						<div id='add_to_cart_<?php echo $item->product_id; ?>' class="k2store_add_to_cart form-group">
					        <input type="hidden" id="k2store_product_id" name="product_id" value="<?php echo $item->product_id; ?>" />

					        <?php echo JHTML::_( 'form.token' ); ?>
					        <input type="hidden" name="return" value="<?php echo base64_encode( JUri::getInstance()->toString() ); ?>" />
					        <input value="<?php echo $cart_text; ?>" type="button" class="k2store_cart_button btn btn_add_to_cart" onclick="yaCounter21503773.reachGoal('addToCart'); return true;"/>
					    </div>
				     <?php else: ?>
				     <div class="k2store_no_stock">
				      <input value="<?php echo JText::_('K2STORE_OUT_OF_STOCK'); ?>" type="button" class="k2store_cart_button k2store_button_no_stock btn btn-warning" />
				     </div>
					<?php endif; ?>

		 <?php endif; //registerd users check ?>

	<?php endif; //catalogue mode check ?>


				<div class="k2store-notification" style="display: none;">
						<div class="message"></div>
						<div class="cart_link"><a class="btn btn-success" href="<?php echo $action; ?>" onClick="ga('send', 'pageview', '/aaaaaa');"><?php echo JText::_('K2STORE_VIEW_CART')?></a></div>
						<div class="cart_dialogue_close" onclick="jQuery(this).parent().slideUp().hide();">x</div>
				</div>
				<div class="error_container">
					<div class="k2product"></div>
					<div class="k2stock"></div>
				</div>

<input type="hidden" name="option" value="com_k2store" />
<input type="hidden" name="view" value="mycart" />
<input type="hidden" id="task" name="task" value="add" />
</form>

	<?php if(count(JModuleHelper::getModules('k2store-addtocart-bottom')) > 0 ): ?>
	<div class="k2store_modules">
		<?php echo K2StoreHelperModules::loadposition('k2store-addtocart-bottom'); ?>
	</div>
	<?php endif; ?>
</div>



<script type="text/javascript">
var $j=jQuery.noConflict();
$j('.btn_add_to_cart').click(function(){
$j('.k2_error').html("");

var log_error=0;
if( ($j('#btn-fabric-1').length) && (($j('.material_id_1').html())=="") ){
	$j('.k2_error_1').html("Требуется выбор ткани верха (основа)");
	log_error=1;
}

if( ($j('#btn-fabric-2').length) && (($j('.material_id_2').html())=="") ){
	$j('.k2_error_2').html("Требуется выбор ткани низа (дополнительная)");	
	log_error=1;
}

if(log_error==1){
return false;	
}


	$j('.popup_fon').fadeIn(500);
	$j('.popup_form').fadeIn(500);


if(($j('#btn-fabric-2').length)==0){

	$j(".block_material.block_material_2").css("display","none");
	$j(".popup_form.popup_detail .popup_content").css("height","326px");
	$j(".popup_form.popup_detail").css("height","538px");
	$j(".popup_form.popup_detail").css("margin-top","-272px");
}; 


//заполнение параметров материала и размера для всплывающего окна
var material_1=$j("#btn-fabric-1").css("background-image");
var material_2=$j("#btn-fabric-2").css("background-image");


var material_1_name=$j(".material_name_1").html();
var material_2_name=$j(".material_name_2").html();

var size_name=$j("#selectSize option:selected").text();

if((size_name=="Маленький (S)")||(size_name=="маленький (S)")){
	var diameter=$j(".table.table-striped tr:nth-child(2) td:nth-child(2)").html();
	var height=$j(".table.table-striped tr:nth-child(2) td:nth-child(3)").html();

}else if((size_name=="Средний (M)")||(size_name=="средний (M)")){
	var diameter=$j(".table.table-striped tr:nth-child(3) td:nth-child(2)").html();
	var height=$j(".table.table-striped tr:nth-child(3) td:nth-child(3)").html();
	
}else if((size_name=="Большой (L)")||(size_name=="большой (L)")){
	var diameter=$j(".table.table-striped tr:nth-child(4) td:nth-child(2)").html();
	var height=$j(".table.table-striped tr:nth-child(4) td:nth-child(3)").html();
	
}


$j(".block_material.block_material_1 .material_block").css("background-image",material_1);
$j(".block_material.block_material_2 .material_block").css("background-image",material_2);

$j(".popup_form.popup_detail .block_material.block_material_1 .text_material span").html(material_1_name);
$j(".popup_form.popup_detail .block_material.block_material_2 .text_material span").html(material_2_name);

$j(".popup_form.popup_detail .block_material.block_material_1 .text_size span").html(size_name);

$j(".popup_form.popup_detail .block_material.block_material_1 .text_diametr span").html(diameter);
$j(".popup_form.popup_detail .block_material.block_material_1 .text_height span").html(height);
	
});








$j('.popup_form .popup_head .popup_close').click(function(){
	
	$j('.popup_fon').fadeOut(500);
	$j('.popup_form').fadeOut(500);
	count_nulled();
});



function count_nulled(){
	//$j('.popup_form .popup_count').html("1");
	//$j('.popup_form .product_qty').val("1");
	$j('.popup_form .popup_content .popup_count .popup_text').val("1");
	popup_count_change();
	
}



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



function second_passed() {

	 location.href="/index.php?option=com_k2store&view=mycart&Itemid=220";

}

function second_passed2() {

	 location.href="/index.php?option=com_k2store&view=checkout&Itemid=220";

}



function send_to_basket(){
	
	
	
	var product_qty = $j('.popup_form .popup_content .popup_count .popup_text').val();
	var product_id = $j('.popup_form #tovar_id').val();
	
	var size_value="1";
	var material_value_1="1";
	var size_id="1";
	var material_id_1="1";
	var size2_id="1";
	var size2_value="1";
	var material_value_2="1";
	var material_id_2="1";
	
	if($j(".select-wrapper #selectSize").length){
	size_id=$j(".select-wrapper #selectSize").attr("name");
	size_id=size_id.replace("product_option[","");
	size_id=size_id.replace("]","");
	}
	
	
	
	if($j(".select-wrapper #selectSize").length){
	//size_value=$j(".select-wrapper #selectSize").val();
	size_value=$j(".select-wrapper #selectSize option:selected").data("value");
	}
	
	
	
	
	
	
	
	
	if($j(".option.option_material").length){
	material_id_1=$j(".option.option_material").attr("id");
	material_id_1=material_id_1.replace("option-","");
	}
	
	if($j(".material_id_1").length){
	material_value_1=$j(".material_id_1").html();
	}
	
	
	if($j(".option.option_material").length){
	material_id_2=$j(".option.option_material").attr("id");
	material_id_2=material_id_2.replace("option-","");
	}
	
	if($j(".material_id_2").length){
	material_value_2=$j(".material_id_2").html();
	}
	
	
	if($j(".option.option_size2").length){
	size2_id=$j(".option.option_size2").attr("id");
	size2_id=size2_id.replace("option-","");
	
	size2_value=$j(".option.option_size2 select").val();
	
	}
	
	<?php
	if(!isset($GLOBALS["size_id"])){ $GLOBALS["size_id"]="1"; }
	if(!isset($GLOBALS["size2_id"])){ $GLOBALS["size2_id"]="1"; }
	if(!isset($GLOBALS["material_id_1"])){ $GLOBALS["material_id_1"]="1"; }
	if(!isset($GLOBALS["material_id_2"])){ $GLOBALS["material_id_2"]="1"; }
	
	
	?>
	
	var price_num=$j("#option-value-"+material_value_1).attr("data-category");
	
	
	size_value=parseInt(size_value)+parseInt(price_num)-1;
	
	
	
	
	
	
	
	
	
	
	//alert("<?php echo $GLOBALS["size_id"]; ?>");
	//alert(size_value);


	//alert("<?php echo $GLOBALS["material_id_1"]; ?>");
	//alert(material_value_1);
	
	//alert("<?php echo $GLOBALS["material_id_2"]; ?>");
	//alert(material_value_2);


//var product_option={"148":"1","148":"1","148":"1"};
//var product_option={"148":"1","<?php echo $GLOBALS["size_id"]; ?>":size_value,"<?php echo $GLOBALS["material_id"]; ?>":material_value};
	var price = $j(".popup_price_hidden").html();
	
	var price_m=price.split(' ');
	price=price_m[0];
	price=parseInt(price);	
	//alert(price);
		
	var price_num1=$j("#option-value-"+material_value_1).attr("data-category");	
	var price_num2=$j("#option-value-"+material_value_2).attr("data-category");	
	
	if((price_num1!=price_num2)&&(material_value_2!="1")){
		
		//product_id - идентификатор товара
		var material_name1=$j(".material_name_1").html();
		var material_name2=$j(".material_name_2").html();
		//price
		var size=$j('#selectSize').val();
			
		params2 = { product_id:product_id,material_name1:material_name1,material_name2:material_name2,price:price,size:size };
	
	
		$j.ajax({
			type: "POST",
			url: "/ajax/price.php",
			data:params2,
			async: false,
			success: function(data){
	
				//alert(data);

		}})
	
		



	
	}
	
		
		
		
	
		
	params = { product_qty:product_qty,product_id:product_id,option:"com_k2store",view:"mycart",task:"add",price:price,product_option:{"148":"1","<?php echo $GLOBALS["size_id"]; ?>":size_value,"<?php echo $GLOBALS["material_id_1"]; ?>":material_value_1,"<?php echo $GLOBALS["material_id_2"]; ?>":material_value_2,"<?php echo $GLOBALS["size2_id"]; ?>":size2_value},stock:{item_price:price,special_price:price,price:price}};
	
	//params = { product_qty:product_qty,product_id:product_id,option:"com_k2store",view:"mycart",task:"add",price:"100",price_without_tax:"100",total:"200",total_without_tax:"200",product_option:{"148":"1","<?php echo $GLOBALS["size_id"]; ?>":size_value,"<?php echo $GLOBALS["material_id_1"]; ?>":material_value_1,"<?php echo $GLOBALS["material_id_2"]; ?>":material_value_2,"<?php echo $GLOBALS["size2_id"]; ?>":size2_value},stock:{item_price:"100",special_price:"100",price:"100",product:"100"}};
	
	
		

//+"&product_option="+product_option
	//alert(product_option);
	
	$j.ajax({
	type: "POST",
	url: "/index.php?option=com_k2store&view=mycart&price="+price+"&product_id="+product_id+"",
	//data: "product_qty="+product_qty+"&product_id="+product_id+"&option="+"com_k2store"+"&view="+"mycart"+"&task="+"add"+"&product_option="+product_option,
	data:params,
	async: false,
	success: function(data){
	
	//alert(data);
	var data1=$j('.error2').html();
	data1=data1+" -- "+data;

	$j('.error2').html(data1);



	}})
	



	/*
	params = { product_qty:product_qty,product_id:product_id,option:"com_k2store",view:"mycart",task:"add",product_option:{"148":"1"}};



	
	$j.ajax({
	type: "POST",
	url: "/index.php?option=com_k2store&view=mycart",
	data: params,
	success: function(data){
	
	//alert(data);
	var data1=$j('.error2').html();
	data1=data1+" -- "+data;

	$j('.error2').html(data1);



	}})


*/







	 
	
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


$j('.popup_form .popup_content .popup_text2').click(function(){

	$j(".popup_form").fadeOut(500);
	count_nulled();
	$j(".popup_fon").fadeOut(500);
	
});


$j('.popup_form .return_select').click(function(){

	$j(".popup_form").fadeOut(500);
	count_nulled();
	$j(".popup_fon").fadeOut(500);
	
});




$j('.popup_form .popup_footer .popup_phone_button').click(function(){

var tovar_link="<?php  echo JURI::base().($item->link); ?>";
var tovar_name="<?php  echo $item->title; ?>";

var phone=$j('.popup_form .popup_footer .popup_phone').val();




if( ( phone.length == 10 )&&(phone.match(/^\d+$/)) ){

$j('.popup_form .popup_error').fadeOut(500);

phone="+38"+$j('.popup_form .popup_footer .popup_phone').val();

var tovar_size=$j('.popup_form.popup_detail .block_material .text_size span').html();
var material_up_name=$j('.popup_form.popup_detail .block_material.block_material_1 .text_material span').html();
var material_down_name=$j('.popup_form.popup_detail .block_material.block_material_2 .text_material span').html();
var material_up_color=$j('.material_fabric_1').html();
var material_down_color=$j('.material_fabric_2').html();
var link_image_1=$j('#btn-fabric-1').css("background-image");
var link_image_2=$j('#btn-fabric-2').css("background-image");




//+++++++++++++

params = { tovar_link:tovar_link,tovar_name:tovar_name,phone:phone,tovar_size:tovar_size,material_up_name:material_up_name,material_down_name:material_down_name,material_up_color:material_up_color,material_down_color:material_down_color,link_image_1:link_image_1,link_image_2:link_image_2};

	
$j.ajax({
type: "POST",
url: "/ajax/callme.php",
data: params,
success: function(data){
//alert(data);	
$j('.popup_form2').fadeIn(500);
$j('.popup_form').fadeOut(500);
count_nulled();


}})

}else{
	
$j('.popup_form .popup_error').fadeIn(500);	

}



});



$j('.popup_form2 .popup_close').click(function(){

$j('.popup_form2').fadeOut(500);
$j('.popup_fon').fadeOut(500);

});




$j("#fabricsModal1 .block_order_call_text1").click(function(){
	
	if($j("#fabricsModal1 .block_order_call").hasClass("show")){
		//alert("1");
		$j("#fabricsModal1 .block_order_call").removeClass("show");	
		$j("#fabricsModal1 .block_order_call").addClass("hide");	
		
	}else{
		//alert("2");
		$j("#fabricsModal1 .block_order_call").addClass("show");	
		$j("#fabricsModal1 .block_order_call").removeClass("hide");
		
	}

})



$j("#fabricsModal2 .block_order_call_text1").click(function(){
	
	if($j("#fabricsModal2 .block_order_call").hasClass("show")){
		//alert("1");
		$j("#fabricsModal2 .block_order_call").removeClass("show");	
		$j("#fabricsModal2 .block_order_call").addClass("hide");	
		
	}else{
		//alert("2");
		$j("#fabricsModal2 .block_order_call").addClass("show");	
		$j("#fabricsModal2 .block_order_call").removeClass("hide");
		
	}

})


$j(".block_order_call_button").on('click', function () {

	var phone = $j("#block_order_call_phone").val();
	var tovar_name=$j(".itemTitle").html();
	tovar_name = tovar_name.replace(/\r|\n/g, '');
	tovar_name = tovar_name.replace(/^\s+/, '');
	
	
	if( (phone.match(/^\d+$/)) ){
		
		
		//alert(phone);
		//alert(tovar_name);
		
		
		
		params = { phone:phone,tovar_name:tovar_name};

	
		$j.ajax({
		type: "POST",
		url: "/ajax/callme_2.php",
		data: params,
		success: function(data){
		
		
			$j('.popup_form2').fadeIn(500);
			$j('.popup_fon').fadeIn(500);
			$j('.fabricsModal .block_order_call').removeClass("show");
			$j('.fabricsModal .block_order_call').addClass("hide");
			
		


		}})

		
		
		
	
	}else{
	   $j("#block_order_call_phone").val("Введите корректный номер телефона");
	   $j("#block_order_call_phone").css("color","red");
		return false;
	}
	
});



$j(document).on('focus click', '.fabricsModal .block_order_call #block_order_call_phone',  function(e){

	if($j(this).val()=="Введите корректный номер телефона"){
		$j(this).val("");
		$j(this).css("color","#c6c6c6");
	}
   
});

</script>


