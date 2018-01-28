<?php
#
# Шаблоны
# Все шаблоны должны храниться в одном массиве
#

# начальная инициализация
$skin = array();








# состояние корзины и ссылка на корзину (корзина пуста)
$skin['empty'] = <<<EOF
					<div id="shopcart-mirror">
						<a href="/{mod_name}/cart/"><img alt="" src="/style/shopcart.gif" width="63" height="58"></a>
						<img alt="" src="/style/shopcart-mirror.gif" width="63" height="33">
					</div>
								<h3>Ваша корзина пуста</h3>

EOF;


# состояние корзины и ссылка на корзину (корзина не пуста)
$skin['full'] = <<<EOF
					<div id="shopcart-mirror">
						<a href="/{mod_name}/cart/"><img alt="" src="/style/shopcart.gif" width="63" height="58"></a>
						<img alt="" src="/style/shopcart-mirror.gif" width="63" height="33">
					</div>
								<h3>В вашей корзине</h3>
								товаров: <span>{count}</span><br>
								<!-- на сумму: <span>{sum}</span> -->

EOF;





#------------------------------------------------------------------------------

# оформление списка сопутствующих товаров
$skin['attend'] = '<p><a href="{alias}">{title}</a></p>';





#------------------------------------------------------------------------------
# шаблон корзины
#------------------------------------------------------------------------------


# начало корзины
$skin['cart_begin'] = <<<EOF
<form method="post" action="/{mod_name}/calc/">
<table rules="rows" border="1" style="border-collapse:collapse;" bordercolor="#a1a000" cellpadding="0" cellspacing="0" width="100%" id="shop-table">
	<tr>
		<th>КОД</th>
		<th width="100%">НАИМЕНОВАНИЕ</th>
		<th nowrap>КОЛ-ВО</th>
		<th>ЦЕНА</th>
		<th>СУММА</th>
		<th></th>
	</tr>

EOF;



# один пункт корзины
$skin['cart_item'] = <<<EOF
	<tr>
			<td>{id}</td>
			<td><a href="{alias}">{title}</a></td>
			<td align=center><input class="num" maxlength="3" type="text" name="count[{id}]" value="{count}"></td>
			<td class="price" nowrap>{price}</td>
			<td class="price" nowrap>{total}</td>
			<td class="price"><a href="/shop/del/{id}/"><img alt="" src="/style/delete.gif"></a></td>
	</tr>

EOF;





# окончание корзины 
$skin['cart_end'] = <<<EOF
</table>
<br>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr valign="top">
			<td>
				<table border="0" style="border:1px solid #a1a000;" cellpadding="0" cellspacing="0" width="100%" id="shop-table">
					<tr>
						<td><input name="order_lico" checked value="ur" type="radio"></td>
						<td class="price" nowrap>Юр. лицо</td>
						<td>&nbsp;</td>
						<td><input name="order_lico" value="fiz" type="radio"></td>
						<td class="price" nowrap>Физ. лицо</td>
					</tr>
					<tr>
						<td colspan="5" align="center"><input type="submit" id="order" name="order" value="" style="width:132px;height:22px;background:url(/style/contract.gif) no-repeat;border:0;margin-bottom:6px;" title="Оформить заказ"></td>
					</tr>

				</table>
			</td>
			<td width="54"><table border="0" cellpadding="0" cellspacing="0" width="54"><tr><td></td></tr></table></td>
			<td>
				<table border="0" style="border:1px solid #a1a000;" cellpadding="0" cellspacing="0" width="100%" id="shop-table">
					<tr>
						<!-- td>Итого:</td>
						<td align="center">{total}</td>
						<td align="center"><input type="submit" name="calc" value="" style="width:17px;height:22px;background:url(/style/res.gif) no-repeat;border:0;" title="Пересчитать"></td -->
                                                <td><b>Общую цену заказа</b> уточняйте у нашего менеджера</td>
					</tr>
				</table>
			</td>
	</tr>
</table>
</form>

EOF;


# в случае, если перешли в корзину, а корзина пуста
$skin['cart_empty'] = '<div>Ваша корзина пуста</div>';

#------------------------------------------------------------------------------




# в случае, если каталога-реципиента - нет или невозможно инициировать
$skin['error_catalog'] = 'Невозможно получить доступ к каталогу-источнику';



#------------------------------------------------------------------------------


# форма заказа для физики
$skin['ur_order'] = <<<EOF
<p><b>После оформления Вами заказа,  его оплата  производится в любом отделении Сбербанка РФ по выписанным Вам счету и квитанции на оплату</b></p>
<form method=post id="fur" action="/shop/thankyou/">
<p><font color="red" id="error">{error}</font></p>
<input type="hidden" value="{lico}" name="lico">
<table border="0" cellpadding="0" cellpadding="0" width="100%" id="register">

<tr>
<th>Контактное лицо (ФИО):</th>
<td><input name="lname" id="lname" value="{lname}" type="text"  title="обязательно заполнить"></td>
</tr>

<tr>
<th>Адрес E-mail:</th>
<td><input name="email" id="email" value="{email}" type="text" title="обязательно заполнить"></td>
</tr>

<tr>
<th>Телефон:</th>
<td><input name="phone" id="phone" value="{phone}" type="text" title="обязательно заполнить"></td>
</tr>

<tr>
<th>Компания:</th>
<td><input name="company" id="company" value="{company}" type="text" title="обязательно заполнить"></td>
</tr>

<!-- tr valign="top">
<th>Юридический адрес:</th>
<td><textarea name="uradress" id="uradress">{uradress}</textarea></td>
</tr>

<tr>
<th>ИНН:</th>
<td><input name="inn" id="inn" value="{inn}" type="text" title="обязательно заполнить"></td>
</tr>

<tr>
<th>КПП:</th>
<td><input name="kpp" id="kpp" value="{kpp}" type="text" title="обязательно заполнить"></td>
</tr>

<tr>
<th>Банк:</th>
<td><input name="bank" id="bank" value="{bank}" type="text" title="обязательно заполнить"></td>
</tr>

<tr>
<th>БИК:</th>
<td><input name="bik" id="bik" value="{bik}" type="text" title="обязательно заполнить"></td>
</tr>

<tr>
<th>Р/С:</th>
<td><input name="rschet" id="rschet" value="{rschet}" type="text" title="обязательно заполнить"></td>
</tr>

<tr>
<th>Корр/Счет:</th>
<td><input name="cschet" id="cschet" value="{cschet}" type="text" title="обязательно заполнить"></td>
</tr -->

<tr>
<th>Способ доставки (выбрать):</th>
<td><select name="delivery">
	<option value="Самовывоз">Самовывоз
	<option value="Доставка транспортной компанией">Доставка транспортной компанией
	<option value="Доставка по почте">Доставка по почте
</select></td>
</tr>

<tr>
<td colspan="2" align="center"><input class="button" value="Завершить оформление" type="button" onClick="verifFormUr();">
</td>
</tr>

</table>
</form>
EOF;


# форма заказа для юрика
$skin['fiz_order'] = <<<EOF
<p><b>После оформления Вами заказа,  его оплата  производится в любом отделении Сбербанка РФ по выписанным Вам счету и квитанции на оплату</b></p>
<form method=post id="ffiz" action="/shop/thankyou/">
<p><font color="red" id="error">{error}</font></p>
<input type="hidden" value="{lico}" name="lico">
<table border="0" cellpadding="0" cellpadding="0" width="100%" id="register">

<tr>
<th>ФИО:</th>
<td><input name="lname" id="lname" value="{lname}" type="text"  title="обязательно заполнить"></td>
</tr>

<!-- tr>
<th>Имя:</th>
<td><input name="fname" id="fname" value="{fname}" type="text"  title="обязательно заполнить"></td>
</tr -->

<tr>
<th>Адрес E-mail:</th>
<td><input name="email" id="email" value="{email}" type="text" title="обязательно заполнить"></td>
</tr>

<tr>
<th>Телефон:</th>
<td><input name="phone" id="phone" value="{phone}" type="text" title="обязательно заполнить"></td>
</tr>

<!-- tr>
<th>Паспортные данные:</th>
<td><input name="pasport" id="pasport" value="{pasport}" type="text" title="обязательно заполнить"></td>
</tr>

<tr valign="top">
<th>Адрес:</th>
<td><textarea name="adress" id="adress">{adress}</textarea></td>
</tr -->

<tr>
<th>Способ доставки (выбрать):</th>
<td><select name="delivery">
	<option value="Самовывоз">Самовывоз
	<option value="Доставка транспортной компанией">Доставка транспортной компанией
	<option value="Доставка по почте">Доставка по почте
</select></td>
</tr>

<tr>
<td colspan="2" align="center">	
	<input class="button" value="Завершить оформление" type="button" onClick="verifFormFiz();">
</td>
</tr>

</table>
</form>
EOF;


# возможные ошибки
$skin['error_email'] = 'Вы указали неверный "e-mail"<br>';



# заказ отправлен
$skin['success'] = '<h3>Благодарим за заказ</h3>В ближайшее время с Вами свяжутся наши менеджеры';






#------------------------------------------------------------------------------


# начало корзины
$skin['mail_cart_begin'] = <<<EOF
<table cellspacing=1 cellpadding=1 border=1 width=100%>
	<tr>
		<th>Код</th>
		<th>Наименование</th>
		<th>Кол-во</th>
		<th>Цена</th>
		<th>Сумма</th>
		
	</tr>
EOF;



# один пункт корзины
$skin['mail_cart_item'] = <<<EOF
	<tr>
			<td align="center">{id}</td>
			<td>{title}</td>
			<td align=center>{count}</td>
			<td align=center>{price}</td>
			<td align=center>{total}</td>
			
	</tr>
EOF;





# окончание корзины 
$skin['mail_cart_end'] = '
	<tr>
			<td colspan="3"></td>
			<td align="center">Итого:</td>
			<td align="center"><b>уточняйте у менеджера</b></td>
</table>
</form>
';


#------------------------------------------------------------------------------




# письмо уведомление для пользователя
$skin['subject_foruser'] = 'Заказ на сайте {host}';
$skin['mail_foruser'] = '
<html>
<body>
Здравствуйте!<br><br><br>
На сайте {host} от вашего имени был оформлен заказ на следующие наименования из каталога:<br>
{goods}
<br><br>
Если вы не делали заказ, то не отвечайте, а просто удалите письмо.<br>
<br><br><br>

{mail_footer}
</body>
</html>
';

# письмо уведомление для менеджера
$skin['subject_formanager'] = 'Заказ №{order_num} на сайте {host}';
$skin['mail_formanager'] = '
<html>
<body>
Здравствуйте!<br><br><br>
На сайте {host} был оформлен и подтверждён заказ на следующие наименования из каталога:<br>
{goods}
<br><br>
Информация о пользователе:<br><br>
{user}

{mail_footer}
</body>
</html>
';



# данные о пользователе в письмо менеджеру - юрики
$skin['user_ur'] = <<<EOF
ФИО: {lname}<br>
Адрес E-mail: {email}<br>
Телефон: {phone}<br>
Компания: {company}<br>
Способ доставки: {delivery}<br>
EOF;
//Юридический адрес: {uradress}<br>
//ИНН: {inn}<br>
//КПП: {kpp}<br>
//Банк: {bank}<br>
//БИК: {bik}<br>
//Р/С: {rschet}<br>
//Корр/Счет: {cschet}<br>


# данные о пользователе в письмо менеджеру - физики
$skin['user_fiz'] = <<<EOF
ФИО: {lname}<br>
Адрес E-mail: {email}<br>
Телефон: {phone}<br>
Способ доставки: {delivery}<br>
EOF;
//Имя: {fname}<br>
//Паспортные данные: {pasport}<br>
//Адрес: {adress}<br>
#------------------------------------------------------------------------------




# фраза при подтверждении заказа
$skin['approve'] = <<<EOF
<h3>Заказ подтверждён.</h3>
Наши менеджеры обработают предоставленную информацию и в ближайшее время свяжутся с вами. 
EOF;

# фраза при повторном подтверждении заказа
$skin['is_approve'] = <<<EOF
Ваш заказ уже был подтверждён ранее.<br>
Повторного подтвердения не требуется. 
EOF;




#------------------------------------------------------------------------------
# Заказы пользователя
#------------------------------------------------------------------------------


# статусы заказов
$skin['statistic_status'][0] = 'Не подтверждён';
$skin['statistic_status'][1] = 'Подтверждён';
$skin['statistic_status'][2] = 'В обработке';
$skin['statistic_status'][3] = 'Оплачен';
$skin['statistic_status'][4] = 'Отгружен';
$skin['statistic_status'][100] = 'Отменён';


$skin['no_statistic'] = <<<EOF
Для неавторизованного пользователя история заказов не хранится.<br>
Вы должны <a href="/users/reg/">зарегистрироваться</a> и авторизоваться. 
EOF;


# начало корзины
$skin['statistic_empty'] = <<<EOF
<h3>История заказов пуста. Вы ещё ничего не заказывали</h3>
EOF;


# начало корзины
$skin['statistic_begin'] = <<<EOF
<table cellspacing=1 cellpadding=1 border=1 width=100%>
	<tr>
		<th>Номен заказа</th>
		<th>Дата заказа</th>
		<th>Сумма</th>
		<th>Статус</th>
	</tr>
EOF;



# один пункт корзины
$skin['statistic_item'] = <<<EOF
	<tr>
			<td align="center">{id}</td>
			<td>{rectime}</td>
			<td align=center>{total}</td>
			<td align=center>{status}{extend}</td>			
	</tr>
EOF;





# окончание корзины 
$skin['statistic_end'] = '	
</table>
';




#------------------------------------------------------------------------------











?>