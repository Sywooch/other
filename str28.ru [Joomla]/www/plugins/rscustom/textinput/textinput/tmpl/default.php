<?php
	defined('_REXEC') or die();
	$class='rscustom-textinput';
	//if ($field->custom_price_by_letter) $class='rscustom-textinput';?>
	<input class="<?php echo $class ?>" type="text" value="" size="<?php echo $this->params->custom_size ?>" name="customPlugin[<?php echo $this->retinashop_custom_id ?>][<?php echo $this->_name?>][comment]"><br />
<?php
	// preventing 2 x load javascript
	static $textinputjs;
	if ($textinputjs) return true;
	$textinputjs = true ;
	//javascript to update price
	$document = JFactory::getDocument();
	$document->addScriptDeclaration('
jQuery(document).ready( function($) {
	jQuery(".rscustom-textinput").keyup(function() {
			formProduct = $(".productdetails-view").find(".product");
			retinashop_product_id = formProduct.find(\'input[name="retinashop_product_id[]"]\').val();
		retinashop.setproducttype(formProduct,retinashop_product_id);
		});

});
	');