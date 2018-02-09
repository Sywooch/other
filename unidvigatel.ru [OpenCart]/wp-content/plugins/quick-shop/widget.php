<?php

if ( $this->cart_has_items() )
{
$currency           = get_option('quickshop_currency')       or $currency            = 'USD';
$currencySymbol     = get_option('quickshop_symbol')         or $currencySymbol      = '$';
$DecimalPoint       = get_option('quickshop_decimal')        or $defaultDecimalPoint = '.';
$thousandsSeperator = get_option('quickshop_thousands')      or $thousandsSeperator  = ',';
$freeShippingValue  = get_option('quickshop_freeshipv')      or $freeShippingValue   = 0;
$title              = get_option('quickshop_title')          or $title               = 'Your Shopping Cart';
$shippingStart      = get_option('quickshop_shipping_start') or $shippingStart       = 0;
$checkoutPageID     = get_option('quickshop_checkout_page');

echo
$before_widget . '
<div class="quickshopcart">
' . $before_title . $title . $after_title
;

echo '
<table width="184" border="0" cellpadding="0" cellspacing="0" style="width: 184px; height:50px;">
';

$count   = 1;
$total   = 0;
$postage = $shippingStart;

if ( !empty($_SESSION['qscart']) && is_array($_SESSION['qscart']) )
{
echo ' ';

foreach ( $_SESSION['qscart'] as $item )
{
echo ' ';

$total   += $item['price'] * $item['quantity'];
$count   += $item['quantity'];
$postage += $item['quantity'] * $item['shipping'];
}
}

if ( -- $count )
{
echo ' ';

if ( !get_option('quickshop_total') )
{
if ( $freeShippingValue && $freeShippingValue <= $total ) $postage = 0;

echo '
 ';
}

echo '
<tr>
<td width="30" style="text-align: right; background-color:#00253D; color:#C3C5C8;"><img src="http://www.unidvigatel.com/wp-content/plugins/quick-shop/images/5651.png" width="30" height="30"></td>
<td width="100" align="center" style="text-align: right; background-color:#00253D; color:#C3C5C8;">
' . $this->output_currency($total + $postage, $currencySymbol, $decimalPoint, $thousandsSeperator) . '
</td>
<td width="54" align="center" style="background-color:#C3C5C8; color:#00253D;"><a href="' . get_permalink($checkoutPageID) . '">
' . $this->lang['to checkout'] . '</td>
</tr>
</table>
';

$terms = get_option('quickshop_tc');

if ( !$_SESSION['qstc'] && $terms )
{
echo '
<form method="post" action="">
<p><a href="' . $terms . '" target="_blank">' . $this->lang['terms agree'] . '</a></p>
<input type="hidden" value="true" name="qstc"/>
<input type="submit" value="' . $this->lang['yes'] . '"/>
</form>
';
}
else 
echo '

';
}

echo '
</div>

' . $after_widget
;
}
else
{
if ( get_option('quickshop_display') )
{
$title = get_option('quickshop_title') or 'Ваша корзина';

echo
$before_widget . '
<div class="quickshopcart">
' . $before_title . $title . $after_title . '
<p>' . $this->lang['cart empty'] . '</p>
</div>
' . $after_widget
;
}
}
?>