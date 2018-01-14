<?
#
#  модуль shop
#

#---------------------------------------------------------------------------------------------------
# работа с корзиной и в корзине
#---------------------------------------------------------------------------------------------------

# ссылка на корзину - пустая
$_shop_cartlink_empty = <<<EOF
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="24"><div class="basketlink"><a href="/shop/cart/">Ваша&nbsp;корзина</a>&nbsp;</div></td>
		<td align="right" style="background: url(/i/i_basket.gif) no-repeat left; padding-left: 40px; cursor:pointer;" onClick="document.location='/shop/cart/';">пуста</td>
	</tr>
</table>
EOF;

# ссылка на корзину - полная
$_shop_cartlink_full = <<<EOF
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="24"><div class="basketlink"><a href="/shop/cart/">Ваша&nbsp;корзина</a>&nbsp;</div></td>
		<td align="right" style="background: url(/i/i_basket-f.gif) no-repeat left top; padding-left: 40px;cursor:pointer;" onClick="document.location='/shop/cart/';"><a href="/shop/cart/" class="coll">товаров:<b>&nbsp;{goods_count}</b></a></td>
	</tr>
</table>
EOF;


# перед корзиной - форма
$_shop_cart['pre_begin'] = <<<EOF
{SHOP_INFO}
<br><br>
EOF;

$_shop_cart['post_after_reception'] = '<tr>
		<td height="36"></td>
		<td style="color:#FFFFFF;font-weight:bold; background:#93be50 url(/i/bg_line.gif) repeat-x left bottom;" >
		<nobr><input type="radio" name="type_pay_{CATALOG_ID}" value="post_after_reception" {checked_post_after_reception} onClick="choose_payment_method();"> Наложенный платёж<br></td>
		<td>заказ, оплачивается на почте при получении почтового отправления</td>
	</tr>';


$_shop_cart['post_perevod'] = '
<tr><td width="" height=\"34\"></td><td bgcolor="#93be50" style="color:#FFFFFF;font-weight:bold;"><nobr><input type="radio" name="type_pay_{CATALOG_ID}" value="post_perevod" {checked_post_perevod} onClick="mainFormSend();"> Частичная предоплата</td>
<td>т.е. оплачивается часть стоимости заказа почтовым или банковским переводом, остальная часть оплачивается на почте при получении почтового отправления</td>
</tr>';

//$_shop_cart['limit_owerflow'] = '<tr><td colspan=3 style="color: red;">Обращаем Ваше внимание, что в соответствии с <a href="/help/rules_{CAT_ID}/">условиями каталога</a> , заказы стоимостью выше {LIMIT} руб выполняются только на условиях частичной предоплаты.</td></tr>';
$_shop_cart['limit_owerflow'] = '';


# шаблон корзины
$_shop_cart['begin'] = <<<EOF
<p>{INFO}</p>
<h2>{CATALOG_TITLE}</h2>
{OPLATA_BLOCK}
<br>
<table cellspacing=0 cellpadding=4 border=1 width=100% style="border-collapse:collapse;" rules=rows bordercolor="#A7A6AA">
	<tr>
		<th>Заказ</th>
		<th>Наименование</th>
		<th>Кол-во</th>
		<th>Цена, кат.</th>
		<th>Сумма, кат.</th>
		<th>&nbsp;</th>
</tr>
EOF;

$_shop_cart['oplata_block'] = <<<EOF
<table cellspacing=0 cellpadding=4 border="0" width=100%>
	<tr bgcolor="#cae6a1">
		<td><nobr><b>Способ оплаты</b></nobr></td>
		<td colspan="2"><b> (<font color="red">обязательно указать</font>):</b></td>
	</tr>
	<tr style="height:10px;">
		<td colspan="3"></td>
	</tr>
	{LIMIT_OVERFLOW}
	{POST_AFTER_RECEPTION}
	{POST_PEREVOD}    
    {POST_CREDIT}
	<tr style="height:10px;">
		<td colspan="3"></td>
	</tr>
	<tr style="display:{DISLPAY};">
		<td align=right></td>		
		<td colspan="2" style="border:#FF9900 1px solid;">{predoplata_error}Укажите сумму: <input type="text" style="width: 60px; text-align: center; background: #fff; border: 1px solid #A7A6AA; font-size: 14px; color: #F8941D; padding: 0px 2px 0px 2px; margin: 0px; height: 20px;" name="predoplata_sum[{CATALOG_ID}]" value={PREDOPLATA_{CATALOG_ID}}  onBlur="mainFormSend();"></td>
	</tr>
</table>
EOF;

$_shop_cart['item'] = <<<EOF
	<tr>
		<td>{ID}</td>
		<td>{TITLE}</td>
		<td align=center><input type="text" id="count{ID}" name="count[{ID}]" style="width: 24px; text-align: center; background: transparent; border: 1px solid #A7A6AA; font-size: 14px; color: #F8941D; padding: 0px 2px 0px 2px; margin: 0px; height: 20px;" onfocus="this.select();" value="{COUNT}" maxlength="3" onBlur="mainFormSend();"></td>
		<td align=center>{COST}</td><input type="hidden" value="{COST}" id="cost{ID}">
		<td align=center id="sumhtml{ID}">{SUM}</td><input type="hidden" value="{SUM}" id="sum{ID}">
		<td><a href="/shop/del/{ID}/">Отказаться</a></td>
</tr>
EOF;

$_shop_cart['sum_error'] = <<<EOF
<font color="red">Сумма предоплаты должна быть не менее {persent}% от стоимости товара: {predoplata}</font><br>
EOF;

# концовка 
$_shop_cart['end'] = '
</table>
<br>
<table cellspacing=0 cellpadding=4 border=0 align=center>
<tr><td width=50%></td><td width=50%></td></tr>
<tr><td align=right>Выриант доставки:</td>
<td>
	{delivery_select}
</td></tr>
<tr><td align=right>Итого по каталогу: </td><td><nobr><b>{PRE_TOTAL}</b></td></tr>
<tr><td align=right>Скидка:</td><td><nobr><b>{SKIDKA}</b></td></tr>
<tr><td align=right>Комплектация:</td><td><nobr><b>{KOMPLEKT}</b></td></tr>
<tr><td align=right>{TOTAL_TITLE} </td><td><nobr><b>{TOTAL}</b></td></td></tr>
<tr><td colspan=2 align=center><i>{SBOR}</i></td></tr>
</table>
';

# итоговые данные по всей корзине
$_shop_cart['after_end'] = <<<EOF
<!-- h2>Итого по заказу</h2>
<hr style="height:1px;border:1px solid #A7A6AA;" noshade>
<table cellspacing=0 cellpadding=4 border=0 align=center>
<tr><td width=50%></td><td width=50%></td></tr>
<tr><th align="right" id="totalhtml">Итого цена по каталогам: </td><td><nobr>{PRE_TOTAL}</th></tr>
<tr><td align="right"><b>Скидка:</b> </td><td><nobr>{SKIDKA}</td></tr>
<tr><td align="right"><b>Итого со скидкой:</b> </td><td><nobr>{PRE_TOTAL-SKIDKA}</td></tr>
<tr><td align="right"><b>Комплектация:</b> </td><td><nobr>{KOMPLEKT}</td></tr>
<tr><td align="right"><b>Предоплата продекларированная:</b> </td><td><nobr>{PREDOPLATA}</td></tr>
<tr><th align="right" id="totalhtml">Итого по заказу: </td><td><nobr>{TOTAL}</th></tr -->


<table cellspacing=0 cellpadding=4 border=0 align=center>
<tr><td colspan=2 align="center">
{order_button}<input type="button" value="Пересчитать" onClick="mainFormSend();" style="background: transparent; border: 1px solid #A7A6AA; font-size: 14px; color: #F8941D; height: 22px;">
</td></tr>
<input type="hidden" value="{TOTAL}" id="total">
</table>

<script>
// обработчик нажатия enter
$("input").keypress(function (e) {	
      if (e.which == 13) {
		mainFormSend();	
      }
});
</script>

EOF;

# в случае, если перешли в корзину, а корзина пуста
$_shop_cart_empty = '<div>Ваша корзина пуста</div>';


# в случае, если перешли в корзину, а корзина пуста
$_shop_cart_needauth = '<font color="red"><b>Для продолжения оформления заказа необходимо<br><a href="/authorization/reg/">пройти процедуру регисрации/авторизации</a></b></font><br><br>';


#---------------------------------------------------------------------------------------------------
# КОНЕЦ: работа с корзиной и в корзине
#---------------------------------------------------------------------------------------------------


#---------------------------------------------------------------------------------------------------
# работа с формой заказа и регистрации
#---------------------------------------------------------------------------------------------------

# форма заказа для зарегистрированных пользователей
$_shop_order['begin'] = <<<EOF
<h1>Оформление заказа</h1>
<input type="radio" name="first_buy" value="yes" {yes} onClick="onOrder()"> Заказываю для другого человека<br>
<input type="radio" name="first_buy" value="no" {no} onClick="onOrder()"> Заказываю для себя
<br><br>
EOF;

$_shop_order['choose_payment_method'] = <<<EOF
<h2>Способ оплаты</h2>
<p>Пожалуйста, выберите желаемый способ оплаты Вашего заказа:</p>
<input type="hidden" name="prepay" value="{pay_summ}"/>
<input type="hidden" name="delivery" value="{delivery}"/>
<div style="padding-left:20px">
<label class="radio">
    <input type="radio" name="pay_method" id="optionsRadios1" value="bank" checked>Банковский перевод</label>		
<label class="radio">
    <input type="radio" name="pay_method" id="optionsRadios2" value="post">Почтовый перевод</label>
<label class="radio">		
    <input type="radio" name="pay_method" id="optionsRadios2" value="card">Банковская карта (Visa или MasterCard)</label>
<br><br>
<button type="button" class="btn btn-success" onclick="onFormOrderSubmit();">Оформить заказ</button>
<div>
EOF;


# форма заказа для незарегистрированных пользователей
$_shop_order['body_first_buy'] = <<<EOF
<b>{ADDING_TEXT}</b><br><br>
<input type="hidden" id="first_buy" value="yes">
<table border=0 cellspacing=0 cellpadding=0 width="100%">
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td style="width:200px;" align="right"><span>Я знаю почтовый индекс!</span> </td>
		<td width="5">&nbsp;</td>
		<td><input class="reg_inpit" id="myindex"  name="myindex" value="" onKeyUp="onMyIndex()"> <input type="button" value="Проверить" onClick="onMyIndex();"></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td style="width:200px;" align="right"><span id="span_region">Регион:</span> </td>
		<td width="5">&nbsp;</td>
		<td><select class="reg_inpit" id="region"  name="region" onChange="onChangeRegion();">{regions}</select></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_rayon">Район:</span> </td>
		<td width="5">&nbsp;</td>
		<td><select class="reg_inpit" disabled="disabled"  id="rayon" name="rayon" onChange="onChangeRayon();"></select></span></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_gorod">Почтовое отделение:</span> </td>
		<td width="5">&nbsp;</td>
		<td><select class="reg_inpit" disabled="disabled" id="gorod" name="gorod" onChange="onChangeGorod();"></select></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_adress">Адрес почтового отделения:</span> </td>
		<td width="5">&nbsp;</td>
		<td><textarea class="reg_inpit" DISABLED name="adress" id="adress"></textarea></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_adress_deliver">Адрес доставки:<br>(округ, улица, дом, квартира)</span> </td>
		<td width="5">&nbsp;</td>
		<td><textarea  class="reg_inpit" name="adress_deliver" id="adress_deliver"></textarea></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_f">Фамилия:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input class="reg_inpit" type=text id="f" name="f"></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_i">Имя:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input class="reg_inpit"  type=text name="i" id="i" value=""></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_o">Отчество:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input class="reg_inpit"  type=text id="o" name="o" value=""></td></tr>
		
		{docs}
		
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_email">E-mail:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input style="width:300px;"  type=text id="email" name="email" value=""></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_phone">Контактный телефон:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input style="width:300px;"  type=text id="phonenum" name="phone" value=""></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_comment">Комментарий к заказу:</span> </td>
		<td width="5">&nbsp;</td>
		<td><textarea style="width:300px;" id="comment" name="comment"></textarea></td></tr>
	<tr>

<tr height="25"><td colspan="3"></td></tr>			
		
		
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_user_name">Логин:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input style="width:300px;"  type=text id="user_name" name="user_name" value=""></td></tr>
	

<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_passwd">Пароль:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input style="width:300px;"  type=text id="passwd" name="passwd" value=""></td></tr>
		
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_passwd2">Пароль, повтор:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input style="width:300px;"  type=text id="passwd2" name="passwd2" value=""></td></tr>		
		
<tr>
	<td colspan=3><br><i>Все поля обязательны для заполнения (кроме комментария)</i><br><input type="button" value="Отправить заказ" onClick="onFormOrderSubmit()"></td></tr>
</table>
<a href="/shop/cart/">Вернуться в корзину</a>  
EOF;


# форма заказа для незарегистрированных пользователей
$_shop_order['body_not_first_buy'] = <<<EOF
<input type="hidden" id="first_buy" value="no">
<table border=0 cellspacing=0 cellpadding=0 width="100%">
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';"><td width="200" align="right"><span id="span_email">Введите ваш email:</span> </td><td width="5">&nbsp;</td><td><input style="width:300px;" type=text id="email" name="email" value=""></td></tr>
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';"><td width="200" align="right"><span id="span_index">Почтовый ваш почтовый индекс:</span> </td><td width="5">&nbsp;</td><td><input style="width:300px;" type=text id="index" name="index" value=""></td></tr>
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';"><td align="right"><span id="span_comment">Комментарий к заказу:</span> </td><td width="5">&nbsp;</td><td><textarea style="width:300px;" id="comment" name="comment"></textarea></td></tr>
<tr><td colspan=3><br><i>Все поля обязательны для заполнения (кроме комментария)</i><br><input type="button" value="Отправить заказ" onClick="onFormOrderSubmit()"></td></tr>
</table>
EOF;

//<script>window.scroll(0,0);</script>
$_shop_order['do_order'] = <<<EOF
<input type="hidden" id="first_buy" value="no">
<b>{f} {i} {o}</b>, мы очень рады, что вы остановили свой выбор на нашем каталоге!<br><br>
<i>Комментарий к заказу:</i><br><textarea style="width:300px;" id="comment" name="comment"></textarea>
<br><br>
<b>Готовы ли вы оформить заказ?</b> <input type="button" value="Заказать" onClick="onFormOrderSubmit()" onclick="yaCounter7397239.reachGoal('ORDER'); return true;"><br>
<a href="/shop/cart/">Вернуться в корзину</a>  
EOF;

#---------------------------------------------------------------------------------------------------
# КОНЕЦ: работа с формой заказа и регистрации
#---------------------------------------------------------------------------------------------------



#---------------------------------------------------------------------------------------------------
# работа с отправкой информационных писем пользователю
#---------------------------------------------------------------------------------------------------


# перед корзиной - форма
$_shop_cart_formail['pre_begin'] = <<<EOF
{SHOP_MAIL_INFO}
<br><br>
EOF;

# шаблон корзины
$_shop_cart_formail['begin'] = <<<EOF
<p>{INFO}</p>
<h2>{CATALOG_TITLE}</h2>
<table cellspacing=0 cellpadding=4 border=0>
<tr><th>Заказ</th><th>Наименование</th><th>Количество</th><th>Цена,кат.</th><th>Сумма,кат.</th></tr>
EOF;

$_shop_cart_formail['item'] = <<<EOF
<tr>
	<td>{ID}</td><td>{TITLE}</td><td align=center>{COUNT}</td><td align=center>{COST}</td><td align=center>{SUM}</td>	
</tr>
EOF;

$_shop_cart_formail['sum_error'] = <<<EOF
EOF;

# концовка 
$_shop_cart_formail['end'] = '
<tr><td colspan=4 align=right>Итого по каталогу: </td><td align=center><nobr><b>{PRE_TOTAL}</b></nobr></td></td></tr>
<tr><td colspan=3></td><td align=right>Скидка:</td><td align=center><nobr><b>{SKIDKA}</b></nobr></td></tr>
<tr><td colspan=3></td><td align=right>Комплектация:</td><td align=center><nobr><b>{KOMPLEKT}</b></nobr></td></tr>
<tr><td colspan=4 align=right>{TOTAL_TITLE} </td><td align=center><nobr><b>{TOTAL}</b></nobr></td></td></tr>
<tr><td colspan=2></td><td  colspan=3 align=center><i>{SBOR}</i></td></tr>	
</table><br><br>
';

# итоговые данные по всей корзине
$_shop_cart_formail['after_end'] = <<<EOF
<h2>Итого по заказу</h2>
<hr style="height:1px;border:1px solid #A7A6AA;" noshade>
<table cellspacing=0 cellpadding=4 border=0 align=center>
<tr><td width=50%></td><td width=50%></td></tr>
<table cellspacing=0 cellpadding=4 border=0 align=center>
<tr><th align="right" id="totalhtml">Итого цена по каталогам: </td><td><nobr>{PRE_TOTAL}</nobr></th></tr>
<tr><td align="right"><b>Скидка:</b> </td><td><nobr>{SKIDKA}</nobr></td></tr>
<tr><td align="right"><b>Итого со скидкой:</b> </td><td><nobr>{PRE_TOTAL-SKIDKA}</nobr></td></tr>
<tr><td align="right"><b>Комплектация:</b> </td><td><nobr>{KOMPLEKT}</nobr></td></tr>
<tr><td align="right"><b>Предоплата продекларированная:</b> </td><td><nobr>{PREDOPLATA}</nobr></td></tr>
<tr><th align="right" id="totalhtml">Итого: </td><td><nobr>{TOTAL}</nobr></th></tr>

</table>
EOF;

# письмо клиенту с его регистрационными данными и инфой о заказе
$_shop_mail_message = <<<EOF
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
</head>
<body>
<b>Здравствуйте,</b> {f} {i}!
<br><br>
Ваши регистрационные данные в системе best-mos.ru:
<br><br>
логин: <b>{user_email}</b><br>
пароль: <b>{user_pass}</b>
<br><br>
Используйте их при следующем посещении нашего сайта или во время оформления нового заказа!!!
<!-- h2>Информация о заказе<br>обязательно подтвердите заказ, перейдя по ссылке <a href="{ALIAS}">{ALIAS}</a></h2 -->

{ORDER}
<br>
<br>
--<br>
C уважением, best-mos.ru
<br>
<br>



</body>
</html>
EOF;

$_orderdel_mail_message = <<<EOF
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
</head>
<body>
<b>Здравствуйте,</b> {f} {i}!
<br><br>
По вашему запроосу было произведено удаление вашего заказа от {order_date} 
<br>
<br>
--<br>
C уважением, best-mos.ru
<br>
<br>



</body>
</html>
EOF;

# заказ принят, спасибо за него!
$_shop_OrderDo_done = <<<EOF
<h1>Оформление заказа</h1>
<b>Ваш заказ оформлен.</b><br><br>
На ваш e-mail выслано письмо с полной информацией о заказе.<br><br>
Вы можете отслеживать статусы и управлять вашими заказами в разделе - <a href="/shop/ordersinfo/">ИСТОРИЯ ЗАКАЗОВ</a>
EOF;



# сообщение для пользователя, подтвердившего свой заказ
$_shop_confirm_ok = <<<EOF
<h1>Подтверждение заказа</h1>
Вы подтвердили заказ. Спасибо.<br>
<i>Наш каталог часто обновляется, следите за новинками и подарками!</i>
EOF;

# сообщение для пользователя, подтвердившего свой заказ
$_shop_confirm_error1 = <<<EOF
<h1>Подтверждение заказа</h1>
Ваш заказ уже подтверждён и находится в обработке.<br>
<i>Наш каталог часто обновляется, следите за новинками и подарками!</i>
EOF;

# сообщение для пользователя, подтвердившего свой заказ
$_shop_confirm_error2 = <<<EOF
<h1>Подтверждение заказа</h1>
Ошибка! Возможно вы перешли на сайт по ошибочной ссылке или же вы мошенник. Осторожно!<br>
<i>Наш каталог часто обновляется, следите за новинками и подарками!</i>
EOF;

#---------------------------------------------------------------------------------------------------
# КОНЕЦ: работа с отправкой информационных писем пользователю
#---------------------------------------------------------------------------------------------------



#---------------------------------------------------------------------------------------------------
# работа с выгрузкой заказов во внешнюю систему через XML
#---------------------------------------------------------------------------------------------------

$_shop_xml['begin'] = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<dataroot>
EOF;

$_shop_xml_ZakazOUT['item'] = <<<EOF
<order>
<ZakazID>{order_id}</ZakazID> 
<DTReg>{order_time}</DTReg>
<ClientID>{user_id}</ClientID> 
<PredoplataSum>{predoplata_sum}</PredoplataSum>
<Comment>{comment}</Comment>
<UserUpdate>{user_is_active}</UserUpdate>
<AuthorID>{author_id}</AuthorID>
</order>
EOF;

$_shop_xml_ZakazPozOUT['item'] = <<<EOF
<item>
<ZakazID>{id_order}</ZakazID> 
<CatalogID>{catalog_id}</CatalogID>
<LotID>{lot_id}</LotID>
<LotCount>{lot_count}</LotCount>
<PositionStatus>{zakaz_status}</PositionStatus> 
</item>
EOF;

$_shop_xml['end'] = <<<EOF
</dataroot>
EOF;

#---------------------------------------------------------------------------------------------------
# КОНЕЦ: работа с выгрузкой заказов во внешнюю систему через XML
#---------------------------------------------------------------------------------------------------




#---------------------------------------------------------------------------------------------------
# работа с формирование счетов для отправки пользователю
#---------------------------------------------------------------------------------------------------

$_shop_oplata_bank = <<<EOF
<table height="400" cellspacing="1" cellpadding="1" border="1" width="100%">
    <tbody>
        <tr>
            <td style="width:142px;">Кассир
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr style="height:230px;">
                        <td valign="top" style="width:142px;">&nbsp;</td>
                    </tr>
            </table>
            Извещение</td>
            <td valign="top">
            <p><b>Получатель</b>: <u>{company}<br />
            </u><b>КПП</b>: <u>{kpp}</u>&nbsp;&nbsp;&nbsp;&nbsp; <b>ИНН</b>: <u>{inn}</u>&nbsp;&nbsp; <b>Код ОКАТО</b>: <u>{okato}<br />
            </u><b>Р/сч</b>.: <u>{rschot}</u>&nbsp;&nbsp; <b>в</b>: <u>{bank}<br />
            </u><b>БИК</b>: <u>{bik}</u>&nbsp;&nbsp;&nbsp; <b>К/сч</b>.: {kschot}<br />
            <b>Код бюджетной классификации (КБК)</b>: <u>{kbk}</u><br />
            <b>Платёж</b>: <u>Оплата по каталогу {catalog_title}<br />
            </u><b>Плательщик</b>: <u>{f} {i} {o}<br />
            </u><b>Адрес плательщика</b>: <u>{adress}<br />
            </u><b>ИНН плательщика</b>: ______________________________<br />
            <b>№ л/сч. плательщика</b>: ______________________________</p>
            <p><b>Сумма</b>: {predoplata} руб. <u>&nbsp; 00&nbsp;&nbsp; </u>коп.&nbsp;</p>
            <p><b>Подпись</b>: _________ <b>Дата</b>: &quot;_____&quot; ________ 200___г.</p>
            </td>
        </tr>
        <tr>
            <td valign="bottom">
            <p>Квитанция</p>
            <p>Кассир</p>
            </td>
            <td valign="top">
            <p><b>Получатель</b>: <u>{company}<br />
            </u><b>КПП</b>: <u>{kpp}</u>&nbsp;&nbsp;&nbsp;&nbsp; <b>ИНН</b>: <u>{inn}</u>&nbsp;&nbsp; <b>Код ОКАТО</b>: <u>{okato}<br />
            </u><b>Р/сч</b>.: <u>{rschot}</u>&nbsp;&nbsp; <b>в</b>: <u>{bank}<br />
            </u><b>БИК</b>: <u>{bik}</u>&nbsp;&nbsp;&nbsp; <b>К/сч</b>.: {kschot}<br />
            <b>Код бюджетной классификации (КБК)</b>: <u>{kbk}</u><br />
            <b>Платёж</b>: <u>Оплата по каталогу {catalog_title}<br />
            </u><b>Плательщик</b>: <u>{f} {i} {o}<br />
            </u><b>Адрес плательщика</b>: <u>{adress}<br />
            </u><b>ИНН плательщика</b>: _______________________________<br />
            <b>№ л/сч. плательщика</b>: _______________________________</p>
            <p><b>Сумма</b>: {predoplata} руб. <u>&nbsp; 00&nbsp;&nbsp; </u>коп.&nbsp;</p>
            <p><b>Подпись</b>: _________ <b>Дата</b>: &quot;_____&quot; ________ 200___г.</p>
            </td>
        </tr>
    </tbody>
</table>
EOF;


$_shop_olpata_pochta = <<<EOF
<table height="393" cellspacing="1" cellpadding="1" border="1" width="100%">
    <tbody>
        <tr>
            <td style="width:170px;">&nbsp;</td>
            <td valign="top">
            <p>
            <table cellspacing="1" cellpadding="1" border="0" width="100%">
                <tbody>
                    <tr>
                        <td width="150">
                        <p><img src="http://www.best-mos.ru/i/gerb.gif"></p>                        
                        <p>&nbsp;</p>
                        <p>№______________<br />
                        (по р.ф.11)</p>
                        </td>
                        <td width="20">
                        <p>&nbsp;</p>
                        <p><b>П<br />
                        Р<br />
                        И<br />
                        Е<br />
                        М</b></p>
                        </td>
                        <td align="right" valign="top">ф.112э</td>
                    </tr>
                </tbody>
            </table>
            </p>
            <p><b>ПОЧТОВЫЙ ПЕРЕВОД&nbsp; (Электронный)&nbsp;</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>на </b>{predoplata} <b>руб</b>.&nbsp;<u> 00&nbsp;</u> <b>коп</b>.</p>
            <p><u>{predoplata_word}</u> <b>руб</b>.&nbsp;<u> 00&nbsp;</u> <b>коп</b>.</p>
            <p>
            <table cellspacing="1" cellpadding="1" border="0" width="100%">
                <tbody>
                    <tr>
                        <td><b>Куда</b>:</td>
                        <td>{company_adress}, ИНН {inn}, КПП {kpp}, р/с{rschot} в {bank}, к/с{kschot}, БИК {bik}</td>
                    </tr>
                    <tr>
                        <td><b>Кому</b>:</td>
                        <td>{company}</td>
                    </tr>
                </tbody>
            </table>
            </p>
            <p><b>От кого</b>: {f} {i} {o}<br />
            <b>Адрес</b>: {adress}<br />
            <b>Сообщение</b>: Оплата по каталогу {catalog_title}</p>
            <p>
            <table cellspacing="1" cellpadding="1" border="0" width="100%">
                <tbody>
                    <tr>
                        <td align="right">
                        <p>__________________<br />
                        подпись оператора</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            </p>
            </td>
        </tr>
    </tbody>
</table>
EOF;


$_shop_oplata_html = <<<EOF
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
</head>
<body>
{blank}
</body>
</html>
EOF;

#---------------------------------------------------------------------------------------------------
# КОНЕЦ: работа с формирование счетов для отправки пользователю
#---------------------------------------------------------------------------------------------------




#---------------------------------------------------------------------------------------------------
# работа с отображением заказов пользователю
#---------------------------------------------------------------------------------------------------

$zakaz_status = array();
$zakaz_status[0] = 'новый';  // для заказа
$zakaz_status[1] = 'подтверждён'; // для заказа
$zakaz_status[2] = 'принят к обработке'; // для заказа
$zakaz_status[3] = 'принят';	// для позиции
$zakaz_status[4] = 'оплачен/';	// для позиции
$zakaz_status[5] = 'вернулся';	// для позиции
$zakaz_status[6] = 'Новый, аннулирован';  // для заказа
$zakaz_status[7] = 'Аннуляция подтверждена';
$zakaz_status[8] = 'Запрос отмены';  // для позиции
$zakaz_status[9] = 'Отменен';
$zakaz_status[10] = 'отказ в отмене';
$zakaz_status[11] = 'Оплачен';

$_shop_ordersinfo['best'] = <<<EOF
<script type="text/javascript">
    $(document).ready(function () {
        $("#tabs").tabs();
        $("#div_ord_info").remove();
        $(".div_ord_info2").remove();		

		$('#savepasswd').bind('click',function(){
			if ( $('#newpass').val() != $('#retpass').val() ) {
				alert("Новый пароль и подтверждение не совпадают!");
			}
			else if ($('#newpass').val().length < 6) {
				alert("Длина пароля должна быть более шести символов!");
			}
			else {
				$.post('/shop/setpasswd/ajax/',{   oldpass:$('#oldpass').val(),
												   newpass:$('#newpass').val(),
												   login: $('#login').val()
												 }, function(callback) {
													 	switch (callback) {
													 		case '0':
													 			alert("Пароль изменен успешно");
													 			break;
													 		case '-2':
													 			alert("Ошибка данных сессии. Пожалуйста, войдите на сайт еще раз");
													 		 	break;
													 		case '-1':
													 			alert("Вы ввели неверный старый пароль. Пожалуйста, попробуйте еще раз");
													 			break;
													 	}
													 	$('#oldpass').attr('value','');
													 	$('#newpass').attr('value','');
													 	$('#retpass').attr('value','');
				});
			}
		});
    });
</script>

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Мои заказы</a></li>
		<li><a href="#tabs-2">Мои данные</a></li>
		<li><a href="#tabs-3">Смена пароля</a></li>
		<!--<li><a href="#tabs-3">Мои отправления</a></li>-->
	</ul>
<div id="tabs-1" style="text-align: center">
	<h4>История заказов</h4>
	<table align="center" style="width: 70%" id="ord_table" class="table table-striped table-hover table-bordered">
	    <thead>
	        <th>#</th>
	        <th>№ заказа</th>
	        <th>Дата заказа</th>
	        <th>Сумма заказа</th>
	        <th>Статус</th>
	        <th></th>
	    </thead>
	    	<tbody>
	    	{orders_body}
	    </tbody>
	</table>
</div>
<div id="tabs-2">
    <div>
		<div id="auth">
			</form>			
			<form class="form-horizontal" id="creds_form" name="credetnial_form" method="POST" action="/shop/save_creds/">
				<!-- <div class="control-group">
						<label class="control-label" for="changePassw">Сменить пароль</label>
						<div class="controls">
								<div class="form-inline">
									<input type="password" id="oldpass" class="input-medium" placeholder="старый пароль">
									<input type="password" id="newpass"  class="input-medium" placeholder="новый пароль">
									<button type="button" id="savepasswd" class="btn">Применить</button>
								</div>
						</div>
				</div>-->
				<div class="control-group">
						<label class="control-label" for="email">E-mail</label>
						<div class="controls">
						<input type="text"  id="email" name="email" value="{email}" >
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="phone">Телефон</label>
						<div class="controls">
						<input type="text"  id="phone" name="phone" value="{phone}" >
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="post_index">Почтовый индекс</label>
						<div class="controls">
						<input readonly="readonly" type="text"   id="post_index" value="{index}" name="post_index"  >
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="oblast">Область</label>
						<div class="controls">
						<input type="text" readonly="readonly" id="oblast" name="oblast" value="{oblast}">
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="raion">Район</label>
						<div class="controls">
						<input type="text" readonly="readonly" id="raion" name="raion" value="{raion}" ">
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="town">Город</label>
						<div class="controls">
						<input type="text" readonly="readonly"  id="street" name="town" value="{town}" >
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="house">Адрес доставки</label>
						<div class="controls">
						<input type="text"  id="house" class="input-xxlarge" name="house" value="{shipping}">
						</div>
				</div>
				<div class="control-group">
						<label class="control-label" for="c_name">Получатель</label>
						<div class="controls">
						<input type="text"  id="c_name" class="input-xxlarge" name="c_name" value="{client}">
						</div>
				</div>
				<div class="control-group">
						<div class="controls">
								<button type="submit" id="sbmt" class="btn" value="Сохранить">Сохранить</button>
						</div>
				</div>
				<!--
				E-mail: <input type="text" class="form_field" id="login" name="login" value="{email}" placeholder="Логин">
				Контактный телефон: <input type="text" class="form_field" id="phone" name="phone" value="{phone}">
				Почтовый индекс: <input type="text" class="form_field" id="post_index" value="{index}" name="post_index" >
				Область: <input type="text" class="form_field" id="oblast" name="oblast" value="{oblast}" >
				Район: <input type="text" class="form_field" id="raion" name="raion" value="{raion}" >
				Город: <input type="text" class="form_field" id="street" name="town" value="{town}">
				Адрес доставки: <input type="text"   class="form_field" id="house" name="house" value="{shipping}">
				<input type="submit" id="sbmt" value="Сохранить">-->
			</form>
		</div>
	</div>
</div>
<div id="tabs-3">
	<form class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="login">Логин</label>
			<div class="controls">
				<input class="input-medium" type="text" id="login" value="{current_login}">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="oldpass">Cтарый пароль</label>
			<div class="controls">
				<input class="input-medium" type="password" id="oldpass">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="newpass">Новый пароль</label>
			<div class="controls">
				<input class="input-medium" type="password" id="newpass">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="retpass">Новый пароль еще раз</label>
			<div class="controls">
				<input class="input-medium" type="password" id="retpass">
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="button" id="savepasswd" class="btn">Применить</button>
			</div>
		</div>
	</form>
			
</div>

<!--<div id="tabs-3" style="text-align: center">
		<h4>Список почтовых отправлений</h4>
		<table align="center" style="width: 98%; font-size: 9pt; margin-left: 10px; font-size: 9pt" id="shipper_details" class="table table-striped table-bordered">
					<tr>
						<th style="width: 100px; text-align:center">Дата отправления</th>
						<th style="width: 100px; text-align:center">Тип отправления</th>
						<th style="width: 120px; text-align:center">Тип доставки</th>
						<th style="width: 180px; text-align:center">РПО</th>
						<th style="width: 160px; text-align:center">Сумма оценки</th>
						<th style="width: 160px; text-align:center">Сумма наложенного платежа</th>
					</tr>
		</table>
</div>--> <!-- end of tabs3
EOF;


$_shop_ordersinfo['begin'] = <<<EOF
<script type="text/javascript">
    $(document).ready(function () {
        $("#tabs").tabs();
        $("#div_ord_info").remove(); 
        $(".div_ord_info2").remove();
					

		$('#savepasswd').bind('click',function(){
			if ( $('#newpass').val() != $('#retpass').val() ) {
				alert("Новый пароль и подтверждение не совпадают!");
			}
			else if ($('#newpass').val().length < 6) {
				alert("Длина пароля должна быть более шести символов!");
			}
			else {
				$.post('/shop/setpasswd/ajax/',{   oldpass:$('#oldpass').val(), 
												   newpass:$('#newpass').val(),
												   login: $('#login').val() 
												 }, function(callback) { 												 	
													 	switch (callback) {
													 		case '0':
													 			alert("Пароль изменен успешно");
													 			break;
													 		case '-2':
													 			alert("Ошибка данных сессии. Пожалуйста, войдите на сайт еще раз");
													 		 	break;
													 		case '-1':
													 			alert("Вы ввели неверный старый пароль. Пожалуйста, попробуйте еще раз");						 			
													 			break;
													 	}
													 	$('#oldpass').attr('value','');
													 	$('#newpass').attr('value','');
													 	$('#retpass').attr('value','');
				});
			}
		});      
    });
</script>

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Мои заказы</a></li>
		<li><a href="#tabs-2">Мои данные</a></li>
		<li><a href="#tabs-3">Смена пароля</a></li>
		<!--<li><a href="#tabs-3">Мои отправления</a></li>-->
	</ul>
<div id="tabs-1" style="text-align: center">
	<h4>История заказов</h4>
	<table align="center" style="width: 70%" id="ord_table" class="table table-striped table-hover table-bordered">
	    <thead>
	        <th>#</th>
	        <th>№ заказа</th>
	        <th>Дата заказа</th>
	        <th>Сумма заказа</th>
	        <th>Статус</th>
	        <th></th>
	    </thead>
	    	<tbody>
	    	{orders_body}
	    </tbody>
	</table>
</div>
<div id="tabs-2">
    <div>
		<div id="auth">
			</form>
			<!--<div class="alert alert-error" style="font-size:14pt">
				<h4>Внимание!</h4>
				Уточните адрес доставки Вашего заказа:адрес должен быть оформлен буквами русского алфавита.<br />Использование при написании адреса латинских букв не дает гарантии доставки 
                Вашего заказа по месту назначения.
			</div> -->
			<form class="form-horizontal" id="creds_form" name="credetnial_form" method="POST" action="/shop/save_creds/">
				<!-- <div class="control-group">
						<label class="control-label" for="changePassw">Сменить пароль</label>
						<div class="controls">							
								<div class="form-inline">
									<input type="password" id="oldpass" class="input-medium" placeholder="старый пароль">
									<input type="password" id="newpass"  class="input-medium" placeholder="новый пароль">									
									<button type="button" id="savepasswd" class="btn">Применить</button>
								</div>						
						</div>
				</div>-->				 
				<div class="control-group">
						<label class="control-label" for="email">E-mail</label>
						<div class="controls">
						<input type="text"  id="email" name="email" value="{email}" >
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="phone">Телефон</label>
						<div class="controls">
						<input type="text"  id="phone" name="phone" value="{phone}" >
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="post_index">Почтовый индекс</label>
						<div class="controls">
						<input readonly="readonly" type="text"   id="post_index" value="{index}" name="post_index"  >
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="oblast">Область</label>
						<div class="controls">
						<input type="text" readonly="readonly" id="oblast" name="oblast" value="{oblast}">
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="raion">Район</label>
						<div class="controls">
						<input type="text" readonly="readonly" id="raion" name="raion" value="{raion}" ">
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="town">Город</label>
						<div class="controls">
						<input type="text" readonly="readonly"  id="street" name="town" value="{town}" >
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="house">Адрес доставки</label>
						<div class="controls">
						<input type="text"  id="house" class="input-xxlarge" name="house" value="{shipping}">
						</div>
				</div>
				<div class="control-group">
						<label class="control-label" for="c_name">Получатель</label>
						<div class="controls">
						<input type="text"  id="c_name" class="input-xxlarge" name="c_name" value="{client}">
						</div>
				</div>
				<div class="control-group">						
						<div class="controls">
								<button type="submit" id="sbmt" class="btn" value="Сохранить">Сохранить</button>
						</div>
				</div>
				<!--
				E-mail: <input type="text" class="form_field" id="login" name="login" value="{email}" placeholder="Логин"> 
				Контактный телефон: <input type="text" class="form_field" id="phone" name="phone" value="{phone}">
				Почтовый индекс: <input type="text" class="form_field" id="post_index" value="{index}" name="post_index" >	
				Область: <input type="text" class="form_field" id="oblast" name="oblast" value="{oblast}" >	
				Район: <input type="text" class="form_field" id="raion" name="raion" value="{raion}" >	
				Город: <input type="text" class="form_field" id="street" name="town" value="{town}">					
				Адрес доставки: <input type="text"   class="form_field" id="house" name="house" value="{shipping}">							
				<input type="submit" id="sbmt" value="Сохранить">-->
			</form>
		</div>
	</div>	
</div> 
<div id="tabs-3">
	<form class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="login">Логин</label>
			<div class="controls">
				<input class="input-medium" type="text" id="login" value="{current_login}">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="oldpass">Cтарый пароль</label>
			<div class="controls">
				<input class="input-medium" type="password" id="oldpass">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="newpass">Новый пароль</label>
			<div class="controls">
				<input class="input-medium" type="password" id="newpass">			
			</div>		
		</div>
		<div class="control-group">
			<label class="control-label" for="retpass">Новый пароль еще раз</label>
			<div class="controls">
				<input class="input-medium" type="password" id="retpass">			
			</div>		
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="button" id="savepasswd" class="btn">Применить</button>
			</div>
		</div>
	</form>
				 
</div>

<!--<div id="tabs-3" style="text-align: center">	
		<h4>Список почтовых отправлений</h4>
		<table align="center" style="width: 98%; font-size: 9pt; margin-left: 10px; font-size: 9pt" id="shipper_details" class="table table-striped table-bordered">
					<tr>						
						<th style="width: 100px; text-align:center">Дата отправления</th>
						<th style="width: 100px; text-align:center">Тип отправления</th>
						<th style="width: 120px; text-align:center">Тип доставки</th>				
						<th style="width: 180px; text-align:center">РПО</th>				
						<th style="width: 160px; text-align:center">Сумма оценки</th>	
						<th style="width: 160px; text-align:center">Сумма наложенного платежа</th>										
					</tr>
		</table>	
</div>--> <!-- end of tabs3 
EOF;


$_shop_ordersinfo['already_paid'] = "<tr><td colspan=5><p>Доставка данного заказа уже оплачена</p></td></tr>";

$_shop_ordersinfo['payment_rejected'] = "<tr><td colspan=5><p>Вы отказались от оплаты доставки этого заказа</p></td></tr>";

$_shop_ordersinfo['transaction_active'] = "<tr><td colspan=5><p>Инициирована операция оплаты. Изменить способ доставки невозможно</p></td></tr>";

$_shop_ordersinfo['payment_custom_notify'] = "<tr><td colspan=5><p>{custom_message}</p></td></tr>";


$_shop_ordersinfo['not_paid'] = <<<EOF
<script type="text/javascript">
	function goToPayment() {
		var selectedVal = $("#dost_cost$c").attr('value');			
		if ( ($("#dost_cost$c").val() != "") || (typeof($("#dost_cost$c").val()) != 'undefined') ) {
			window.location.href="/shop/confirm/{order_db_id}/"; 
		}
		else alert("Не выбран способ доставки!");
	}

	function cancelPayment() {
		if (confirm("Вниминие:в дальнейшем Вы не сможете изменить свой выбор! Вы действительно подтверждаете отказ от доставки данного заказа?")) {
			window.location.href="/shop/orderdel/{order_db_id}/";
		}
	}
</script>

<tr id="act_buttons">
	<td colspan=3><p style="margin-left: 3px" class="text-info">Итого к оплате: <strong><span id="dost_cost{count}">Выберите вариант доставки</span></strong></p>
		<input id="dost_cost_inp{count}" type="hidden" value=""/> 
		<button onClick='goToPayment()'   class="btn btn-success">Оплатить доставку</button>
		<button onClick='cancelPayment()' class="btn btn-danger">Отказаться от доставки</button>
	</td>
</tr>					
EOF;

$_shop_ordersinfo['body_best'] = <<<EOF
<script type="text/javascript">
	$(document).ready(function () {

		$("#btndel-{count}").bind('click',function(){
			if (confirm("Вы действительно хотите удалить ваш заказ? Отменить данное действие будет невозможно")) {
				var order_id={order_id};
				alert(order_id);
				$.post('/shop/ordelete/ajax',{order:order_id},function(data){
					if (data=='1')						
						window.location.href="/shop/ordersinfo/";
					else {
						alert("Произошла ошибка при удалении заказа.");											
					}
				});				
			} 			
		});

		$("#btn-{count}").bind('click',function(){
		        	$("#dialog-{count}").dialog({
		            modal: true,
		            width: 1000,
		            height: 'auto'
		        	});
					$('.ui-dialog-titlebar-close').css('float','right');
		        });

				$("#span_{order_id}").click(function(){
			        $("#div_{order_id}").slideToggle("fast");
			        $(this).toggleClass("active");
			    });

				$("#button_{order_id}").click(function(){
			        $("#div_{order_id}").slideToggle("fast");
			        $(this).toggleClass("active");
			    });
		
				/*var order='{order_no}';
				$('input[tag="i-{count}"]').bind('click',function(){
					var cost = $(this).attr('value');
					var idDost = $(this).attr('dtype');
					$('#dost_cost').empty().html(cost + ' руб.').attr('value',cost);
					$.post('/shop/updatesumm/ajax/',{order:order, summ:cost, dost:idDost});
				});*/
	});
</script>
<tr>
	<td>{count}</td>
	<td>{order_id}</td>
	<td>{order_time}</td>
	<td>{total} руб.</td>	
	<td>{item_status}</td>
	<td style="width: 90px">
		<button type="button" id="btn-{count}" class="btn btn-info btn-mini">Подробнее...</button>
		<div id="dialog-{count}" style="display: none" title="Подробности по заказу">
	    	<!-- ORDER DETAILS -->
		    	<div style="width: 1000px; height:auto; min-height: 370px">
		    	<h3 style="margin-left: 10px">Состав заказа № {order_no}: </h3>
		    	<table align="center" style="width: 990px; font-size: 9pt" id="ord_details" class="table table-striped table-hover table-bordered">
					<thead>
					<tr>
						<th align="center"><b>Лот</b></th>
						<th>Название</th>
						<th align="center"><b>Цена</b></th>
						<th align="center"><b>Кол-во</b></th>
						<th align="center"><b>Сумма</b></th>
						<th align="right"><b>Статус</b></th>
						<th align="center"><b>Cкидка</b></th>
						<th align="center"><b>Комплект.</b></th>
						<th align="center"><b>Итого</b></th>
					</tr>
					<thead
>					<tbody>
						{items}
					</tbody>
				</table>
				<div style="margin-left: 10px">				
					<p>Продекларированная предоплата: <strong>{prepay_announced} р.</strong></p>
					<p>Внесенная предоплата: <strong>{prepay_charged} р.</strong> </p>				
					<p>Предоставленная скидка: <strong>{discount} р.</strong></p>					
					<p>Стоимость комплектации: <strong>{packing} р.</strong></p>
					<h2>Итого: <strong>{total} р.</strong></h2>
					{pay_btn}
				<div>

		
				<!--<table align="center" style="width: 98%; font-size: 9pt"; margin-left: 10px; font-size: 9pt" id="shipper_details" class="table table-striped table-bordered">
					<thead>
						<th style="width: 220px">Служба доставки</th>
						<th style="width: 100px">Срок доставки</th>
						<th style="width: 100px">Стоимость</th>
						<th style="width: 60px">Выбор</th>
						<th style="width: auto">Комментарии к заказу</th>
					</thead>
					<tbody>
						{delivery_options}
						{delivery_controls}
					</tbody>
				</table>-->
				</div>
			<!-- END OF ORDER DETAILS -->
		</div>
	</td>
	<!--<td style="width: 50px">
		<button type="button" id="btndel-{count}" class="btn btn-danger btn-mini">Удалить...</button>
	</td>-->
</tr>
EOF;



$_shop_ordersinfo['body'] = <<<EOF
<script type="text/javascript">
	$(document).ready(function () {
		$("#btn-{count}").bind('click',function(){
		        	$("#dialog-{count}").dialog({
		            modal: true,       
		            width: 1000,    
		            height: 'auto'                         
		        	});
					$('.ui-dialog-titlebar-close').css('float','right');
		        });

				$("#span_{order_id}").click(function(){
			        $("#div_{order_id}").slideToggle("fast");
			        $(this).toggleClass("active");
			    });

				$("#button_{order_id}").click(function(){
			        $("#div_{order_id}").slideToggle("fast");
			        $(this).toggleClass("active");
			    });	  

				/*var order='{order_no}';  
				$('input[tag="i-{count}"]').bind('click',function(){
					var cost = $(this).attr('value');			
					var idDost = $(this).attr('dtype');
					$('#dost_cost').empty().html(cost + ' руб.').attr('value',cost);
					$.post('/shop/updatesumm/ajax/',{order:order, summ:cost, dost:idDost});
				});*/
	});
</script>
<tr>
	<td>{count}</td>
	<td>{order_id}</td>
	<td>{order_time}</td>
	<td>{total} руб.</td>
	<td>{item_status}</td>
	<td style="width: 90px">
		<button type="button" id="btn-{count}" class="btn btn-info btn-mini">Подробнее...</button>
		<div id="dialog-{count}" style="display: none" title="Подробности по заказу">    
	    	<!-- ORDER DETAILS -->
		    	<div style="width: 1000px; min-height: 500px">
		    	<h3 style="margin-left: 10px">Состав заказа № {n_zakaz}: </h3>
		    	<table align="center" style="width: 990px; font-size: 9pt" id="ord_details" class="table table-striped table-hover table-bordered">
					<thead>
					<tr>
						<th align="center"><b>Лот</b></th>
						<th>Название</th>
						<th align="center"><b>Цена</b></th>
						<th align="center"><b>Кол-во</b></th>
						<th align="center"><b>Сумма</b></th>
						<th align="right"><b>Статус</b></th>
						<th align="center"><b>Cкидка</b></th>
						<th align="center"><b>Комплект.</b></th>
						<th align="center"><b>Итого</b></th>				
					</tr>
					<thead>
					<tbody>
						{items}
					</tbody>
				</table>
				<h3 style="margin-left: 10px">Выберите способ доставки заказа: </h3>		
				<table align="center" style="width: 98%; font-size: 9pt"; margin-left: 10px; font-size: 9pt" id="shipper_details" class="table table-striped table-bordered">
					<thead>
						<th style="width: 220px">Служба доставки</th>
						<th style="width: 100px">Срок доставки</th>
						<th style="width: 100px">Стоимость</th>
						<th style="width: 60px">Выбор</th>	
						<th style="width: auto">Комментарии к заказу</th>				
					</thead>
					<tbody>						
						{delivery_options}						
						{delivery_controls}
					</tbody>				
				</table>			
				</div>
			<!-- END OF ORDER DETAILS -->		
		</div>
	</td>
</tr>
EOF;


$_shop_ordersinfo['item'] = <<<EOF
EOF;


$_shop_ordersinfo['old_begin'] = '<h3>История заказов</h3><ol>';

$_shop_ordersinfo['old_item'] = <<<EOF
    <p>
	    <li type="1"><span style="font-size:14;cursor:hand; cursor:pointer;color:blue;" id="span_{order_id}"><b>Заказ №{order_id} от {order_time} на сумму {total} руб.</b></span><input id="button_{order_id}" type="button" value="Подробнее"><br>
		    <div class="div_ord_info2">
		    Статус: <b>{item_status}</b>&nbsp{pay_link}<br>
		    - Продекларированная предоплата = {predoplata} руб.<br>
		    - Получена предоплата в размере {predoplata_fact} руб.
		    </div>
	    </li>
	</p>
<div id="div_{order_id}" style="display: none;">
<div id="div_ord_info">Заказ от {order_time} на сумму {total} руб. с учетом предоплаты ({predoplata})<br>
- Продекларированная предоплата = {predoplata} руб.<br>
- Получена предоплата в размере {predoplata_fact} руб.<br>
+ почтовые расходы на пересылку Вашего заказа (просьба уточнять почтовый тариф на почте по месту жительства) 
</div>
<table class="ordertable" cellspacing=0 cellpadding=4 border=1 width=98% style="border-collapse:collapse;" rules=rows bordercolor="#A7A6AA">
		<tr>
			<td align="center"><b>Лот</b></td>
			<td><b>Название</b></td>
			<td align="center"><b>Цена</b></td>
			<td align="center"><b>Количество</b></td>
			<td align="center"><b>Сумма</b></td>
			<td align="right"><b>Статус</b></td>
			<td align="center"><b>Cкидка</b></td>
			<td align="center"><b>Комплектация</b></td>
			<td align="center"><b>Итого по позиции</b></td>
			<td></td>
		</tr>
		{items}
	</table>
<br>
{total_part}
</div>
<script>
$("#span_{order_id}").click(function(){
        $("#div_{order_id}").slideToggle("fast");
        $(this).toggleClass("active");
    });
$("#button_{order_id}").click(function(){
        $("#div_{order_id}").slideToggle("fast");
        $(this).toggleClass("active");
    });

$(function(){
	$('#tabs>ul').remove();
});
</script>
EOF;

$_shop_ordersinfo1['item'] = <<<EOF
		<tr>
			<td>{count}</td>
			<td>{order_id}</td>
			<td>{order_time}</td>
			<td>{total} руб.</td>
			<td>{item_status}</td>
			<td style="width: 90px">
				<button type="button" id="btn-{count}" class="btn btn-info btn-mini">Подробнее...</button>
			</td>
		</tr>
	<!--	{tab_terminator}
	</div>   <!-- /tabs-1 -->
    
    </div>     
    <div id="dialog-{count}" style="display: none" title="Подробности по заказу">    
    	<!-- ORDER DETAILS -->
	    	<div style="width: 1000px; min-height: 500px">
	    	<h3 style="margin-left: 10px">Состав заказа: </h3>
	    	<table align="center" style="width: 990px; font-size: 9pt" id="ord_details" class="table table-striped table-hover table-bordered">
				<thead>
				<tr>
					<th align="center"><b>Лот</b></th>
					<th>Название</th>
					<th align="center"><b>Цена</b></th>
					<th align="center"><b>Кол-во</b></th>
					<th align="center"><b>Сумма</b></th>
					<th align="right"><b>Статус</b></th>
					<th align="center"><b>Cкидка</b></th>
					<th align="center"><b>Комплект.</b></th>
					<th align="center"><b>Итого</b></th>				
				</tr>
				<thead>
				<tbody>
					{items}
				</tbody>
			</table>
			<h3 style="margin-left: 10px">Выберите способ доставки заказа: </h3>		
			<table align="center" style="width: 98%; font-size: 9pt"; margin-left: 10px; font-size: 9pt" id="shipper_details" class="table table-striped table-bordered">
				<thead>
					<th style="width: 220px">Служба доставки</th>
					<th style="width: 100px">Срок доставки</th>
					<th style="width: 100px">Стоимость</th>
					<th style="width: 60px">Выбор</th>	
					<th style="width: auto">Комментарии к заказу</th>				
				</thead>
				<tbody>
					{delivery_options}
					<tr>
						<td colspan=3><p style="margin-left: 3px" class="text-info">Итого к оплате: <strong><span id="dost_cost">{dost_cost}</span></strong></p>
						<!-- <button onClick='if ($("#dost_cost").val() != "") window.location.href="/shop/confirm/{order_db_id}/"; else alert("Не выбран способ доставки!")' class="btn btn-success">Оплатить доставку</button> -->
						<button onClick='window.location.href="/shop/orderdel/{order_db_id}/"' class="btn btn-danger">Отказаться от доставки</button></td>
					</tr>					
				</tbody>				
			</table>			
			</div>
		<!-- END OF ORDER DETAILS -->		
	</div> -->

    <script type="text/javascript">
    $(document).ready(function () {
        $("#tabs").tabs();
        $("#div_ord_info").remove(); 
        $(".div_ord_info2").remove();
		//$("#company_logo").attr("src","/i/logo_temp.png");
		//$("#verski").remove();
		$(".number").empty().html("640 5771");	

        $("#btn-{count}").bind('click',function(){
        	$("#dialog-{count}").dialog({
            modal: true,       
            width: 1000,    
            height: 'auto'                         
        	});
			$('.ui-dialog-titlebar-close').css('float','right');
        });

		$("#span_{order_id}").click(function(){
	        $("#div_{order_id}").slideToggle("fast");
	        $(this).toggleClass("active");
	    });

		$("#button_{order_id}").click(function(){
	        $("#div_{order_id}").slideToggle("fast");
	        $(this).toggleClass("active");
	    });	  

		var order='{order_no}';  
		$('input[tag="i-{count}"]').bind('click',function(){
			var cost = $(this).attr('value');			
			$('#dost_cost').empty().html(cost).attr('value',cost);
			$.post('/shop/updatesumm/ajax/',{order:order, summ:cost});
		});
    });
    </script>
EOF;

$_shop_ordersinfo['total_part'] = <<<EOF
- Предоставленная скидка = {skidka} руб.<br>
- Стоимость комплектации = {komplekt} руб.<br>
- Итого = {z_sum} руб.<br>
EOF
; 

$_shop_ordersinfo['good_new_ogld'] = <<<EOF
<tr>
	<td align="center">{lot_id}</td>
	<td>{title}</td>
	<td align="center">{kat_price}</td>
	<td align="center">{lot_count}</td>
	<td align="center">{total}</td>
	<td align="right">{zakaz_status}</td>
	<td colspan=3>&nbsp</td>	
</tr>
EOF;

$_shop_ordersinfo['good_new_best'] = <<<EOF
<tr>
	<td align="center">{lot_id}</td>
	<td>{title}</td>
	<td align="center">{kat_price}</td>
	<td align="center">{lot_count}</td>
	<td align="center">{total}</td>
	<td align="right">{zakaz_status}</td>
	<td align="center">{skidka_sum}</td>
	<td align="center">{compl_sum}</td>
	<td align="center">{z_sum}</td>
</tr>
EOF;

$_shop_ordersinfo['good_new'] = <<<EOF
<tr>
	<td align="center">{lot_id}</td>
	<td>{title}</td>
	<td align="center">{kat_price}</td>
	<td align="center">{lot_count}</td>
	<td align="center">{total}</td>
	<td align="right">{zakaz_status}</td>
	<td colspan=3>&nbsp</td>
	<td><a href="/shop/cancelitem/{item_id}/" onClick="if (confirm('Вы уверены, что хотите отказаться от этой позиции?')) return true; else return false;">Отказаться</a></td>
</tr>
EOF;

$_shop_ordersinfo['good'] = <<<EOF
<tr>
	<td align="center">{lot_id}</td>
	<td>{title}</td>
	<td align="center">{kat_price}</td>
	<td align="center">{lot_count}</td>
	<td align="center">{total}</td>
	<td align="right">{zakaz_status}</td>
	<td align="center">{skidka_sum}</td>
	<td align="center">{compl_sum}</td>
	<td align="center">{z_sum}</td>
	<td></td>
</tr>
EOF;


$_shop_ordersinfo['empty'] = <<<EOF
<b>К сожалению вы ещё ничего не заказывали</b>
EOF;


#---------------------------------------------------------------------------------------------------
# КОНЕЦ: работа с отображением заказов пользователю
#---------------------------------------------------------------------------------------------------




#---------------------------------------------------------------------------------------------------
# работа с списком сопутствующих товаров
#---------------------------------------------------------------------------------------------------

# сопутствующие товары
$_shop_attend['begin'] = <<<EOF
<p><b>C  этим товаром чаще всего заказывают</b></p>
<ul>
EOF;

// <DIV style="FLOAT: left; MARGIN: 0px 10px 10px 0px;"><a href="{ALIAS}"><img src="{PHOTO_THUMB}" style="border:2px solid #336699;"><center>{TITLE}</center></a></div>
$_shop_attend['item'] = <<<EOF
<li>
<a href="{ALIAS}">{TITLE}</a>
</li>
EOF;

$_shop_attend['end'] = <<<EOF
</ul>
EOF;

#---------------------------------------------------------------------------------------------------
# КОНЕЦ: работа с списком сопутствующих товаров
#---------------------------------------------------------------------------------------------------


// две кнопки, появляются после регистрации или авторизации из корзины
$_shop_form_after_auth = <<<EOF
<form method="post" action="/shop/orderdo/">
<input type="hidden" name="first_buy" value="no">
Комментарий к заказу:<br>
<textarea style="width:300px;" id="comment" name="comment"></textarea><br>
<input value="Оформить заказ" type="submit" onClick="$('#cartform').attr('action', '/shop/orderdo/ajax/');">
</form> 
<a href="/shop/cart/">Вернуться в корзину</a>
EOF;
?>
