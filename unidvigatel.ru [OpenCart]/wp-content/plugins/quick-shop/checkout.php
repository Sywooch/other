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



echo '
<table width="100%">
';

$count   = 1;
$total   = 0;
$postage = $shippingStart;

if ( !empty($_SESSION['qscart']) && is_array($_SESSION['qscart']) )
{
echo '
<tr>
<th width="23%" style="background-color:#00253D; color:#C3C5C8;">Товар</th>
<th width="23%" style="background-color:#00253D; color:#C3C5C8;">Кол-во</th>
<th width="35%" style="background-color:#00253D; color:#C3C5C8;">Цена</th>
<th width="19%" style="background-color:#00253D; color:#C3C5C8;">Сумма</th>
</tr>
';

foreach ( $_SESSION['qscart'] as $item )
{
echo '
<tr>
<td align="center" style="overflow: hidden;">
<a href="' . $item['qslink'] . '">' . $item['name'] . '</a>
</td>
<td align="center">
<form method="post" name="cquantity" action="#quickshop" style="display:inline;border:none">
<input type="hidden" name="product" value="' . $item['name'] . '"/>
<input type="text" name="quantity" value="' . $item['quantity'] . '" size="2"/>
<input type="submit" name="cquantity" style="text-indent:-999px;width:16px;height:16px;border:none;background-image:url(' . $this->pluginURL . 'images/cart_refresh.png)" value="Обновить" title="Обновить"/>
<input type="submit" name="delcart" style="text-indent:-999px;width:16px;height:16px;border:none;background-image:url(' . $this->pluginURL . 'images/cart_remove.png)" value="Очистить" title="Очистить"/>
</form>
</td>
<td align="center">
' . $this->output_currency($item['price'], $currencySymbol, $decimalPoint, $thousandsSeperator) . '
</td>
<td align="center">' . $this->output_currency($item['price'] * $item['quantity'], $currencySymbol, $decimalPoint, $thousandsSeperator) . '</td>
</tr>
';

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
<td align="right">&nbsp;</td>
<td align="right">&nbsp;</td>
<td align="right" style=" background-color:#CCC;"><span style=" text-align: right;"><strong>Общая стоимость:</strong></span></td>
<td align="center" style=" background-color:#CCC;"><strong>' . $this->output_currency($total + $postage, $currencySymbol, $decimalPoint, $thousandsSeperator) . ' </strong></td>
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

<?php if ( !empty($_SESSION['qscart']) ): ?>

<tr>
<td style="overflow: hidden;">&nbsp;</td>
</tr>

<!-- PayPal -->
<?php if ( get_option('quickshop_paypal_enabled') ): ?>
<h3>Paypal</h3>
<form method="post" action="https://www.paypal.com/cgi-bin/webscr">
<fieldset>
<input type="hidden" name="business"      value="<?php echo get_option('quickshop_paypal_email') ?>"/>
<input type="hidden" name="cmd"           value="_cart"/>
<input type="hidden" name="upload"        value="1"/>
<input type="hidden" name="item_name_1"   value="Shipping"/>
<input type="hidden" name="amount_1"      value="<?php echo $totalShipping ?>"/>
<input type="hidden" name="notify_url"    value="<?php echo get_option('quickshop_paypal_notify_url') ?>"/>
<input type="hidden" name="return"        value="<?php echo $this->get_url() . ( strstr($this->get_url(), '?') ? '&' : '?' ) ?>qsreturn=true"/>
<input type="hidden" name="currency_code" value="<?php echo get_option('quickshop_currency') ?>"/>
<?php foreach ( $_SESSION['qscart'] as $i => $item ): ?>
<input type="hidden" name="item_name_<?php echo $i + 2 ?>" value="<?php echo $item['name']     ?>"/>
<input type="hidden" name="quantity_<?php  echo $i + 2 ?>" value="<?php echo $item['quantity'] ?>"/>
<input type="hidden" name="amount_<?php    echo $i + 2 ?>" value="<?php echo $item['price']    ?>"/>
<?php endforeach; ?>
<input class="button" type="submit" value="Купить сейчас"/>
</fieldset>
</form>
<?php endif ?>
<!-- /PayPal -->

<!--Электронная почта-->
<?php if ( get_option('quickshop_email_enabled') ): ?>
<h3>Пару слов о Вас</h3>
<?php 
if (function_exists('insert_custom_cform'))
{
$fields = array();

// Need help? See your /wp-admin/admin.php?page=cforms/cforms-help.php
$formdata = array(
array('ФИО *','textfield',0,1,0,1,0),
array('Наименование  компании *','textfield',0,1,0,1,0),
array('Город *','textfield',0,1,0,0,0),
array('Контактный телефон *','textfield',0,1,0,0,0),
array('Skype','textfield',0,0,0,0,0),
array('Email *','textfield',0,1,1,0,0),
array('Транспортная компания *#-Выберите одну-|#позже#Транс мир#ЖелДор#Деловые линии#Энергия#Мой город#ПЭК#Шерл#Автотрейдинг#АЛТАН','selectbox',0,1,0,0,0),
array('','fieldsetend',0,0,0,0,0),
array('','fieldsetstart',0,0,0,0,0)
);

$body = '';
foreach ( $_SESSION['qscart'] as $item )
{
$price    = $this->output_currency($item['price'],    $currencySymbol, $decimalPoint, $thousandsSeperator);
$shipping = $this->output_currency($item['shipping'], $currencySymbol, $decimalPoint, $thousandsSeperator);
$formdata[] = array( $item['quantity'] . ' x  '. $item['name'] . '|Цена: ' . $price . $item['qslink'], 'hidden',0,0,0,0,0);
}
$formdata[] = array('Сумма доставки|' . $this->output_currency($totalShipping, $currencySymbol, $decimalPoint, $thousandsSeperator) , 'hidden',0,0,0,0,0);
$formdata[] = array('Сумма заказа|' . $this->output_currency($totalPrice + $totalShipping, $currencySymbol, $decimalPoint, $thousandsSeperator), 'hidden',0,0,0,0,0);
$formdata[] = array('', 'textonly',0,0,0,0,0);
$formdata[] = array('','fieldsetend',0,0,0,0,0);

$i=0;

foreach ( $formdata as $field ) {
$fields['label'][$i]        = $field[0];
$fields['type'][$i]         = $field[1];
$fields['isdisabled'][$i]   = $field[2];
$fields['isreq'][$i]        = $field[3];
$fields['isemail'][$i]      = $field[4];
$fields['isclear'][$i]      = $field[5];
$fields['isreadonly'][$i++] = $field[6];
}

insert_custom_cform($fields,'');
}
else
{
?><span class="error"><noindex><a href="http://www.deliciousdays.com/cforms-plugin/" target="_blank" rel="nofollow">Вы должны установить CFormsII перед тем, как начнете использовать функцию электронной почты.</a></noindex></span><?php
    }
?>
<?php endif ?>
<!--/Электронная почта-->

<!-- Authorize.Net -->
<!--
<?php
$loginID        = 'API_LOGIN_ID';
$transactionKey = 'TRANSACTION_KEY';
$amount         = '19.99';
$description    = 'Sample Transaction';
$testMode       = 'false';
$sequence       = rand(1, 1000);
$timeStamp      = time();

$invoice   = date('YmdHis');
$fingerprint = hash_hmac('md5', $loginID . '^' . $sequence . '^' . $timeStamp . '^' . $amount . '^', $transactionKey);
?>

<form method="post" action="$url">
<input type="hidden" name="x_login"        value="<?php echo $loginID ?>"/>
<input type="hidden" name="x_amount"       value="<?php echo $amount ?>"/>
<input type="hidden" name="x_description"  value="<?php echo $description ?>"/>
<input type="hidden" name="x_invoice_num"  value="<?php echo $invoice ?>"/>
<input type="hidden" name="x_fp_sequence"  value="<?php echo $sequence ?>"/>
<input type="hidden" name="x_fp_timestamp" value="<?php echo $timeStamp ?>"/>
<input type="hidden" name="x_fp_hash"      value="<?php echo $fingerprint ?>"/>
<input type="hidden" name="x_test_request" value="<?php echo $testMode ?>"/>
<input type="hidden" name="x_show_form"    value="PAYMENT_FORM"/>
<input type="submit" value="Pay with Authorize.Net"/>
</form>
-->
<!-- /Authorize.Net -->
<?php else: ?>
<p><strong><?php echo $this->lang['cart empty'] ?></strong></p>
<?php endif ?>