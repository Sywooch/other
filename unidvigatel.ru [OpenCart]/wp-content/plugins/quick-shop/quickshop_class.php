<?php

class quickShop

{

public

$pluginPath

;



function init()

{

if ( isset($_GET['quickshop']) && $_GET['quickshop'] == 'tinymce' )

{

$inventory = $this->get_inventory();



require($this->pluginPath . 'tinymce/dialog.php');



exit;

}



session_start();



// Clear cart after payment

if ( isset($_GET['qsreturn']) )

{

$_SESSION['qscart'] = array();



$this->update_quantity();



header('Location: ' . get_option('quickshop_payment_return_url'));



exit;

}



// Load tinymce button

if ( current_user_can('edit_posts') || current_user_can('edit_pages') )

{

if ( get_user_option('rich_editing') == 'true' )

{

 add_filter('mce_buttons',          array($this, 'tinymce_button'));

 add_filter('mce_external_plugins', array($this, 'tinymce_plugin'));

}

}



require($this->pluginPath . 'language.php');



if ( !empty($_POST) ) $this->process_form();

}



function tinymce_button($buttons)

{

array_push($buttons, '|', 'quickShop');



return $buttons;

}



function tinymce_plugin($plugin_array)

{

$plugin_array['quickShop'] = get_bloginfo('wpurl') . '/wp-content/plugins/quick-shop/tinymce/editor_plugin.js'; // RavanH



return $plugin_array;

}



function shortcode($atts, $content = '')

{

if ( !get_option('quickshop_logged') || is_user_logged_in() )

{

$inventory = $this->get_inventory();



if ( isset($atts['product']) && isset($inventory[$atts['product']]) )

{

$currencySymbol     = get_option('quickshop_symbol')    or $currencySymbol     = ' р.';

$decimalPoint       = get_option('quickshop_decimal');

$thousandsSeperator = get_option('quickshop_thousands') or $thousandsSeperator  = ' ';



$product_id = trim(preg_replace('/__+/', '_', preg_replace('/[^a-z0-9_]/s', '_', strtolower($atts['product']))), '_');



$price    = $this->output_currency($inventory[$atts['product']]['price'],    $currencySymbol, $decimalPoint, $thousandsSeperator);

$shipping = $this->output_currency($inventory[$atts['product']]['shipping'], $currencySymbol, $decimalPoint, $thousandsSeperator);



$form = '

<form id="form-' . $product_id . '" class="quickshop" method="post" action="">





';



if ( !empty($inventory[$atts['product']]['properties']) )

{

foreach ( $inventory[$atts['product']]['properties'] as $property_name => $properties )

{

$form .= '';



foreach ( $properties as $property )

{

 $property . '</option>';

}



$form .= '';

}

}

else

{

$form .= '<input type="hidden" name="product" value="' . $atts['product'] . '"/> ';

}

$form .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td align="left"><span style="color: #FFF;"> ' . $price . '</span></td>

    <td align="right"><input type="hidden" name="price"     value="' . $inventory[$atts['product']]['price']    . '"/>

<input type="hidden" name="shipping"  value="' . $inventory[$atts['product']]['shipping'] . '"/>

<input type="hidden" name="qslink"    value="' . $this->get_url()                         . '"/>

<input type="hidden" name="addcart"   value="1"/>

<input type="submit" style="text-indent:-999px;width:50px;height:20px;border:none;background-image:url(' . $this->pluginURL . 'images/korzina.png)" value="" title="Добавить в корзину"/></td>

  </tr>

</table>

</form>

';



return $form;

}

}

}



function get_inventory()

{

$inventory = array();



$products = explode("\n", trim(get_option('quickshop_products')));



$defaultShipping  = get_option('quickshop_shipping');



foreach ( $products as $i => $d )

{

list($name, $price, $shipping, $properties) = array_map('trim', explode('|', $d));



if ( $properties )

{

list($property_name, $properties) = array_map('trim', explode(':', $properties));



$properties = array(

$property_name => array_map('trim', explode(',', $properties))

);

}

else

{

$properties = array();

}



$inventory[$name] = array(

'price'      => $price,

'shipping'   => $shipping ? $shipping : $defaultShipping,

'properties' => $properties,

);

}



return $inventory;

}



function process_form()

{

switch ( TRUE )

{

case !empty($_POST['addcart']):

$this->item_add();



break;

case !empty($_POST['delcart']):

$this->item_remove();



break;

case !empty($_POST['cquantity']):

$this->update_quantity();



break;

case !empty($_POST['qstc']):

$_SESSION['qstc'] = $_POST['qstc'];



break;

}

}



// Add item

function item_add()

{

$count    = 1;    

$products = $_SESSION['qscart'];



if (!is_numeric($_POST['amount']))

                    $_POST['amount'] = 1;



if ( is_array($products) )

{

foreach ( $products as $key => $item )

if ( $item['name'] == $_POST['product'] )

{

                                        $count++;

$item['quantity'] += $_POST['amount'];



unset($products[$key]);



array_push($products, $item);

}

}

else $products = array();



if ( $count == 1 )

{

$price = !empty($_POST[$_POST['product']]) ? $_POST[$_POST['product']] : $_POST['price'];

      

$product = array(

'name'        => stripslashes($_POST['product']),

'price'       => $price,

'quantity'    => $_POST['amount'],

'shipping'    => $_POST['shipping'],

'qslink'      => $_POST['qslink'],

'item_number' => $_POST['item_number']

);



array_push($products, $product);

}



sort($products);



$_SESSION['qscart'] = $products;

}



// Remove item

function item_remove()

{

$products = $_SESSION['qscart'];



foreach ( $products as $key => $item )

{

if ( $item['name'] == $_POST['product'] )

{

unset($products[$key]);

}

}



$_SESSION['qscart'] = $products;

}



// Update quantity

function update_quantity()

{

$products = $_SESSION['qscart'];



foreach ( $products as $key => $item )

{

if ( $item['name'] == $_POST['product'] && $_POST['quantity'] )

{

$item['quantity'] = $_POST['quantity'];



unset($products[$key]);



array_push($products, $item);

}

elseif ( $item['name'] == $_POST['product'] && !$_POST['quantity'] )

{

unset($products[$key]);

}

}



sort($products);



$_SESSION['qscart'] = $products;

}



function quickshop_widgets()

{

register_sidebar_widget('Quick Shop Cart', array($this, 'widget_quickshop'));

}



function widget_quickshop($args)

{

extract($args);



require($this->pluginPath . 'widget.php');

}



// added by RavanH for MU compatibility >>

function whitelist_options($options) { 

$options['quickshop-options'] = array(

'quickshop_currency',

'quickshop_churl',

'quickshop_symbol',

'quickshop_decimal',

'quickshop_addcart',

'quickshop_total',

'quickshop_display',

'quickshop_location',

'quickshop_freeshipv',

'quickshop_title',

'quickshop_tc',

'quickshop_logged',

'quickshop_checkout_page',

'quickshop_paypal_email',

'quickshop_paypal_notify_url',

'quickshop_payment_return_url',

'quickshop_paypal_enabled',

'quickshop_email_enabled'

 ); 

$options['quickshop-products'] = array(

'quickshop_products',

'quickshop_shipping',

'quickshop_shipping_start'

 ); 

return $options; 

}

// <<



function content_filter($content)

{

global $post;



if ( get_option('quickshop_checkout_page') == $post->ID )

{

$currencySymbol     = get_option('quickshop_symbol');

$decimalPoint       = get_option('quickshop_decimal');

$thousandsSeperator = get_option('quickshop_thousands');



ob_start();



$totalPrice    = 0;

$totalShipping = get_option('quickshop_shipping_start');



if ( !empty($_SESSION['qscart']) )

{

foreach ( $_SESSION['qscart'] as $item )

{

$totalPrice    += $item['price'] * $item['quantity'];

$totalShipping += $item['shipping'];

}

}



require($this->pluginPath . 'checkout.php');



$content .= ob_get_contents();



ob_end_clean();

}



return $content;

}



function quickshop_options_page()

{ 

// changed identifier (4th parameter, must be unique) by RavanH

add_options_page('Quick Shop',          'Quick Shop', 'manage_options', 'quick-shop-options' , array($this, 'quickshop_options')); 

add_management_page('Quick Shop Products', 'Quick Shop', 'manage_options', 'quick-shop-products', array($this, 'quickshop_tools')  );

// some eye candy on the options pages

wp_enqueue_script('common');

wp_enqueue_script('wp-lists');

wp_enqueue_script('postbox');



}



function quickshop_options()

{

$currency           = get_option('quickshop_currency')  or $currency           = 'AUD';

$currencySymbol     = get_option('quickshop_symbol')    or $currencySymbol     = '$';

$decimalPoint       = get_option('quickshop_decimal')   or $decimalPoint       = '.';

$thousandsSeperator = get_option('quickshop_thousands') or $thousandsSeperator = ',';

$checkoutPageID     = get_option('quickshop_checkout_page');

$displayEmpty       = get_option('quickshop_display') ? 'checked="checked"' : '';

$totalOnly          = get_option('quickshop_total')   ? 'checked="checked"' : '';

$loggedOnly         = get_option('quickshop_logged')  ? 'checked="checked"' : '';

$freeShippingValue  = get_option('quickshop_freeshipv') or $freeShippingValue  = '0';

$title              = get_option('quickshop_title')     or $title              = 'Your Shopping Cart';

$termsURL           = get_option('quickshop_tc');

$paymentReturnURL   = get_option('quickshop_payment_return_url') or $paymentReturnURL = '';

$emailEnabled       = get_option('quickshop_email_enabled');



// Checkout options

// PayPal -->

$payPalEnabled    = get_option('quickshop_paypal_enabled');

$payPalEmail      = get_option('quickshop_paypal_email')       or $paypalEmail      = '';

$payPalNotifyURL  = get_option('quickshop_paypal_notify_url')  or $paypalNotifyURL  = '';

// <-- PayPal



if ( get_option('quickshop_location') == 'after' ) $symbolAfter = 'checked="checked"';

else                                               $symbolBefore  = 'checked="checked"';



require($this->pluginPath . 'adm_options.php');

}



function quickshop_tools()

{

$shipping      = get_option('quickshop_shipping')       or $shipping      = '5.00';

$shippingStart = get_option('quickshop_shipping_start') or $shippingStart = '10.00';

$products      = get_option('quickshop_products')       or $products      = '';



require($this->pluginPath . 'adm_products.php');

}



function cart_has_items()

{

return isset($_SESSION['qscart']) && is_array($_SESSION['qscart']) && $_SESSION['qscart'];

}



function output_currency($price, $currencySymbol, $decimalPoint, $thousandsSeperator)

{

return

get_option('quickshop_location') == 'after' ?

number_format(( float ) $price, 0, $decimalPoint, $thousandsSeperator) . $currencySymbol :

$currencySymbol . number_format(( float ) $price, 0, $decimalPoint, $thousandsSeperator)

;

}



function get_url()

{

return 'http' . ( $_SERVER['HTTPS'] == 'on' ? 's' : '' ) . '://' .

( $_SERVER['SERVER_PORT'] == '80' ? $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] : $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'] );

}

}



?>