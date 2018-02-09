<?php
// added by RavanH >>
if (!empty($_GET['updated']) && $_GET['updated']=='true') {
echo "<div id=\"message\" class=\"updated fade\"><p><strong>".__('Settings saved.')."</strong></p></div>";
}
// <<
?>
<div class="wrap">
<div id="icon-upload" class="icon32"><br /></div>
<h2>Товары Quick Shop</h2>
<form method="post" action="options.php">
<?php 
// modified by RavanH for MU compatibility >>
if(function_exists(settings_fields)) { 
settings_fields('quickshop-products'); 
} else { 
wp_nonce_field('update-options'); 
echo '<input name="action" type="hidden" value="update" />'; 
echo '<input name="page_options" type="hidden" value="quickshop_products,quickshop_shipping,quickshop_shipping_start" />'; 
}
// and some eye candy
wp_nonce_field('closedpostboxes','closedpostboxesnonce',false);
wp_nonce_field('meta-box-order','meta-box-order-nonce',false);
// <<
?>
<div id="poststuff" class="metabox-holder has-right-sidebar">
<div id="side-info-column" class="inner-sidebar">
<div id="side-sortables" class="meta-box-sortables">
<div id="submitdiv" class="postbox ">
<div class="handlediv" title="<?php _e('Click to toggle') ?>"><br /></div><h3 class='hndle'><span><?php _e('Кроме того','quick-shop') ?></span></h3>
<div class="inside">
<div class="submitbox" id="submitpost">
<div id="minor-publishing">
<div class="misc-pub-section misc-pub-section-last">
<p><strong>Примеры</strong></p>
<p>Никаких дополнительных свойств, по умолчанию доставки:<br /></p>
<p><code>Cap | 25.00</code></p>
<p>Дополнительные цвета товара, по умолчанию доставки:<br /></p>
<p><code>Bag | 120.00 | | Color : Red, Blue</code></p>
<p>Дополнительные размеры товара и разная доставка<br /></p>
<p><code>Shirt | 9.95 | 4.00 | Size : S, M, L</code></p>
</div>
</div>
<div id="major-publishing-actions">
<div id="publishing-action">
<input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" class="button-primary"/>
<!-- removed by RavanH for MU compatibility
<input type="hidden" name="action" value="update"/>
<input type="hidden" name="page_options" value="quickshop_products,quickshop_shipping,quickshop_shipping_start"/>
 -->
</div>
<div class="clear"></div>
</div>
</div>
</div>
</div>
<div id="previewdiv" class="postbox "><div class="handlediv" title="<?php _e('Click to toggle') ?>"><br /></div><h3 class='hndle'><span><?php _e('Доставка', 'quick-shop') ?></span></h3><div class="inside">
<label>Стартовая цена: <input type="text" name="quickshop_shipping_start" value="<?php echo $shippingStart ?>" size="5"/></label>
<br />
<label>Стоимость доставки по умол-нию: <input type="text" name="quickshop_shipping" value="<?php echo $shipping ?>" size="5"/></label>
</div>
</div>
</div>
</div> <!-- side-info-column inner-sidebar -->
<div id="post-body" class="has-sidebar ">
<div id="post-body-content" class="has-sidebar-content">
<div id="normal-sortables" class="meta-box-sortables">
<div id="settings" style="min-height: 800px;">
<div id="basicdiv" class="postbox ">
<div class="handlediv" title="<?php _e('Click to toggle') ?>"><br /></div><h3 class='hndle'><span><?php _e('Товары', 'quick-shop') ?></span></h3>
<div class="inside">
<p>Добавить каждый продукт с новой строки.</p>
<p><code>product name | price [ | [ shipping ] [ | property : 1, 2 [ , ... ] ] ]</code></p>
<fieldset class="options">
<label>Список товаров:<br />
<textarea name="quickshop_products" style="width: 100%;" rows="20"><?php echo $products ?></textarea></label>
</fieldset>
</div> <!-- inside -->
</div> <!-- postbox -->
</div>
</div> <!-- post-body-content has-sidebar-content -->
</div> <!--post-body has-sidebar -->
</div> <!-- poststuff metabox-holder has-right-sidebar -->
</form>
</div> <!-- wrap -->

<script type='text/javascript'>
// <![CDATA[
jQuery(document).ready( function($) {
// close postboxes that should be closed
jQuery('.if-js-closed').removeClass('if-js-closed').addClass('closed');

// postboxes
<?php
global $wp_version;
if(version_compare($wp_version,"2.7-alpha", "<")){
echo "add_postbox_toggles('quick-shop-products');"; //For WP2.6 and below
}
else{
echo "postboxes.add_postbox_toggles('quick-shop-products');"; //For WP2.7 and above
}
?>

});
//]]>
</script>