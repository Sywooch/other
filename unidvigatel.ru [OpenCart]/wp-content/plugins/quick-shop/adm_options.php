<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div>
<h2>Настройки Quick Shop</h2>
<form method="post" action="options.php">
<?php 
// edited by RavanH for MU compatibility >>
if(function_exists(settings_fields)) { 
settings_fields('quickshop-options'); 
} else { 
wp_nonce_field('update-options'); 
echo '<input name="action" type="hidden" value="update" />'; 
echo '<input name="page_options" type="hidden" value="quickshop_currency,quickshop_churl,quickshop_symbol,quickshop_decimal,quickshop_addcart,quickshop_total,quickshop_display,quickshop_location,quickshop_freeshipv,quickshop_title,quickshop_tc,quickshop_logged,quickshop_checkout_page,quickshop_paypal_email,quickshop_paypal_notify_url,quickshop_payment_return_url,quickshop_paypal_enabled,quickshop_email_enabled" />'; }
// <<
?>
<table class="form-table">
<tr valign="top">
<th scope="row">
Название корзины
</th>
<td>
<input type="text" name="quickshop_title" value="<?php echo $title ?>"/>
</td>
</tr>
<tr valign="top">
<th scope="row">
Валюта
</th>
<td>
<input type="text" name="quickshop_currency" value="<?php echo $currency ?>" size="5"/>
Например USD, RUB, EUR
</td>
</tr>
<tr valign="top">
<th scope="row">
Символ валюты
</th>
<td>
<input type="text" name="quickshop_symbol" value="<?php echo $currencySymbol ?>" size="5"/>
Например $, &#163; - 
<label>до <input type="radio" name="quickshop_location" value="before" <?php echo $symbolBefore ?>></label> или
<label>после <input type="radio" name="quickshop_location" value="after"  <?php echo $symbolAfter  ?>> числа?</label>
</td>
</tr>
<tr valign="top">
<th scope="row">
Десятичная точка
</th>
<td>
<input type="text" name="quickshop_decimal" value="<?php echo $decimalPoint ?>" size="5"/>
точка или запятая
</td>
</tr>
<tr valign="top">
<th scope="row">
Тысячи сепаратор
</th>
<td>
<input type="text" name="quickshop_seperator" value="<?php echo $thousandsSeperator ?>" size="5"/>
точка, запятая или пробел
</td>
</tr>
<tr valign="top">
<th scope="row">
Показывать корзину если она пустая?
</th>
<td>
<input type="checkbox" name="quickshop_display" value="1" <?php echo $displayEmpty ?>/>
</td>
</tr>
<tr valign="top">
<th scope="row">
Показать только общее?
</th>
<td>
<input type="checkbox" name="quickshop_total" value="1" <?php echo $totalOnly ?>/>
когда вы не используете почтовые сборы
</td>
</tr>
<tr valign="top">
<th scope="row">
Предел бесплатной доставки
</th>
<td>
<input type="text" name="quickshop_freeshipv" value="<?php echo $feeShippingValue ?>" size="5"/>
<?php echo $currencySymbol ?>
</td>
</tr>
<tr valign="top">
<th scope="row">
Страница заказа
</th>
<td>
<select name="quickshop_checkout_page">
<option value="">Выбор страницы...</option>
<?php
foreach ( get_pages() as $page )
echo '
<option value="' . $page->ID . '"' . ( $checkoutPageID == $page->ID ? ' selected="selected"' : '' ) . '>' . $page->post_title . '</option>
';
?>
</select>
</td>
</tr>
<tr valign="top">
<th scope="row">
Страница сроков и условий
</th>
<td>
<input type="text" name="quickshop_tc" value="<?php echo $termsURL ?>" size="70"/>
Должно начинаться с "http://"
</td>
</tr>
<tr valign="top">
<th scope="row">
Кнопку "Купить" только для зарегистрированных пользователей?
</th>
<td>
<input type="checkbox" name="quickshop_logged" value="1" <?php echo $loggedOnly ?>/>
</td>
</tr>
</table>

<h3>Параметры заказа</h3>
<table class="form-table">
<tr valign="top">
<th scope="row">
Куда вернуть после оплаты?
</th>
<td>
<input type="text" name="quickshop_payment_return_url" value="<?php echo $paymentReturnURL ?>"/>
</td>
</tr>
</table>

<h4>Форма данных (адрес, телефон и т.д.)</h4>
<table class="form-table">
<tr valign="top">
<th scope="row">
Включить
</th>
<td>
<input type="checkbox" name="quickshop_email_enabled" <?php echo $emailEnabled ? ' checked="checked"' : '' ?>"/>
</td>
</tr>
</table>

<h4>PayPal</h4>
<table class="form-table">
<tr valign="top">
<th scope="row">
Включить
</th>
<td>
<input type="checkbox" name="quickshop_paypal_enabled" <?php echo $payPalEnabled ? ' checked="checked"' : '' ?>"/>
</td>
</tr>
<tr valign="top">
<th scope="row">
Paypal e-mail
</th>
<td>
<input type="text" name="quickshop_paypal_email" value="<?php echo $payPalEmail ?>"/>
</td>
</tr>
<tr valign="top">
<th scope="row">
Страница уведомления
</th>
<td>
<input type="text" name="quickshop_paypal_notify_url" value="<?php echo $payPalNotifyURL ?>"/>
</td>
</tr>
</table>
<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" class="button-primary"/>
<!-- removed by RavanH for MU compatibility
<input type="hidden" name="action" value="update"/>
<input type="hidden" name="page_options" value="quickshop_currency,quickshop_churl,quickshop_symbol,quickshop_decimal,quickshop_addcart,quickshop_total,quickshop_display,quickshop_location,quickshop_freeshipv,quickshop_title,quickshop_tc,quickshop_logged,quickshop_checkout_page,quickshop_paypal_email,quickshop_paypal_notify_url,quickshop_payment_return_url,quickshop_paypal_enabled,quickshop_email_enabled"/> -->
</p>
</form>
</div>