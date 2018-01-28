<!-- <meta content="text/html; charset=windows-1251" http-equiv="content-type" /> -->

	<div class="atb">
		<div class="atitle"><h1>Пользователь: <b>{usertitle}</b></h1></div>
		<div class="pre-at atext2">
		
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="atext2">
				<tr>
					<td align="left" width="110" valign="top"><img src="{foto}" border="0" alt="" /></td>
					<td align="left" valign="top" style="padding-left:5px;">Дата регистрации: {registration}
						<br />Последнее посещение: {lastdate}
						<br />Группа: {status} [time_limit] в группе до: {time_limit}[/time_limit]
						<br /><br />
						[not-group=5][ {pm} ][/not-group] {edituser}
					</td>
				</tr>
			</table>
		
		</div>
	</div>

[not-logged]
<div id="options" style="display:none;">

	<div class="atb">
		<div class="atitle"><h1>Редактирование профиля</h1></div>
		<div class="pre-at atext2">
		
		<table class="leftb">
			<tr>
				<td class="label" width="22%">Ваше Имя:</td>
				<td width="78%"><input type="text" name="fullname" value="{fullname}" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">Ваш E-Mail:</td>
				<td><input type="text" name="email" value="{editmail}" class="f_input" /><br />
				<div class="checkbox">{hidemail}</div>
				<div class="checkbox"><input type="checkbox" id="subscribe" name="subscribe" value="1" /> <label for="subscribe">Отписаться от подписанных новостей</label></div></td>
			</tr>
			<tr>
				<td class="label">Место жительства:</td>
				<td><input type="text" name="land" value="{land}" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">Список игнорируемых пользователей:</td>
				<td>{ignore-list}</td>
			</tr>
			<tr>
				<td class="label">Номер ICQ:</td>
				<td><input type="text" name="icq" value="{icq}" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">Старый пароль:</td>
				<td><input type="password" name="altpass" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">Новый пароль:</td>
				<td><input type="password" name="password1" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">Повторите:</td>
				<td><input type="password" name="password2" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label" valign="top">Блокировка по IP:<br />Ваш IP: {ip}</td>
				<td>
				<div><textarea name="allowed_ip" rows="5" class="f_textarea">{allowed-ip}</textarea></div>
				<div>
					<span style="color:red; font-size:11px">
					* Внимание! Будьте бдительны при изменении данной настройки.
					Доступ к Вашему аккаунту будет доступен только с того IP-адреса или подсети, который Вы укажете.
					Вы можете указать несколько IP адресов, по одному адресу на каждую строчку.
					<br />
					Пример: 192.48.25.71 или 129.42.*.*</span>
				</div>
				</td>
			</tr>
			<tr>
				<td class="label">Аватар:</td>
				<td>
				<input type="file" name="image" class="f_input2" /><br />
				<div class="checkbox"><input type="checkbox" name="del_foto" id="del_foto" value="yes" /> <label for="del_foto">Удалить фотографию</label></div>
				</td>
			</tr>
			<tr>
				<td class="label">О себе:</td>
				<td><textarea name="info" rows="5" class="f_textarea">{editinfo}</textarea></td>
			</tr>
			<tr>
				<td class="label">Подпись:</td>
				<td><textarea name="signature" rows="5" class="f_textarea">{editsignature}</textarea></td>
			</tr>
			{xfields}
		</table>
		
		<input class="bbcodes" type="submit" name="submit" value="Отправить" />
		<input name="submit" type="hidden" id="submit" value="submit" />
		
		</div>
	</div>
	
</div>
[/not-logged]