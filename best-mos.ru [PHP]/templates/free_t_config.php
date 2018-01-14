<?
#
#  модуль docs
#


# недостающая часть к форме ввода данных
$free_form['form_fields'] = <<<EOF
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_naznach"><b>Прошу прислать каталог</b></span> </td>
		<td width="5">&nbsp;</td>
		<td>			
			<select id="naznach" name="naznach" style="width:300px;">
				
			<option value=""></option>
				{catalog_list}
			</select>
		</td>
</tr>
<tr>
		<td colspan=3><br><i>Все поля обязательны для заполнения</i><br><input type="button" value="Отправить" onClick="onFormOrderSubmit()"></td>
</tr>
</table>
EOF;



$free_form['send_done'] = <<<EOF
Все введённые данные отправлены нашим менеджерам.<br>
Мы обязательно отправим вам заказанный каталог.
EOF;




# письмо клиенту с его регистрационными данными и инфой о заказе
$_free_mail_message = <<<EOF
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
</head>
<body>
<b>Здравствуйте.</b>
<br><br>
Пользователь заказал бесплатный каталог: <b>{catalog_title}</b>
<br><br><br>
Контактные данные пользователя:<br>
<b>Фамилия:</b> {f}<br>
<b>Имя:</b> {i}<br>
<b>Отчество:</b> {o}<br>
<b>Адрес доставки:</b> {adress}
<br><br>
--<br>
C уважением, best-mos.ru
<br>
<br>



</body>
</html>
EOF;


?>
