<?php
#
# Шаблоны
# Все шаблоны должны храниться в одном массиве
#

# начальная инициализация
$skin = array();



// оформление дефолтного шаблона
$skin['login_form']        = <<<EOF
<form method="post">
<table border="0" cellspacing="0" cellpadding="0" width="100%" id="register">
<tr>
	<td colspan=2>
		<font color=#EE0000>{error}</font>
		<table border=0 cellspacing=0 cellpadding=0 height=5><td></td></table>
	</td>
</tr>
<tr>
	<td>
		<input type=text name='login' class=reg style="width: 100" onfocus="this.value=''" value="Логин" size=14 maxlength=20>
	</td>
	<td>		
	</td>
</tr>
<tr>
	<td>
		<input type='password' onfocus="this.value=''" name='password' class=reg style="width: 100" value="Пароль" size=14 maxlength=20>
	</td>
	<td><input type=submit class=reg style="background-color: #FDF0DE" value="Ok"></td>
</tr>
<tr>
	<td colspan=2>
		<a href='/users/reg/'>Регистрация</a>
		<br>
		<a href='/users/restore/'>Забыт пароль?</a>
	</td>
</tr>
</table>
</form>
EOF;




# блок с информацией об авторизованном пользоватле
$skin['user_block']        = <<<EOF
<table border="0" cellspacing="0" cellpadding="0" width="100%" id="register">
<tr>
	<td>
		<span class="reg_title">Здравствуйте, <b>{user_fname} ({user_name})</b></span>
	</td>
</tr>

<tr>
	<td>
		<a href="/users/edit/"><font class="reg_title">Профиль</font></a>
		<br>
		<a href="/users/logout/">Выход</a>		
	</td>
</tr>
</table>
EOF;


$skin['restore_form']        = <<<EOF
<font color="red">{error}</font>
<form method=post action="/users/dorestore/">
<table border="0" cellspacing="0" cellpadding="0" width="100%" id="register">
<tr valign=top>	
	<td>Введите ваш E-mail:</td>
	<td><input type=text name='user_email' class=text value="" style="width:135" size=3></td>
	<td><input type=submit value="Выслать"></td>
</tr>
</table>
</form>
EOF;


# пароль удачно восстановлен
$skin['restore_success'] = <<<EOF
Пароль успешно выслан на адрес, введенный Вами при регистрации.<br>
Вы можете перейти на <a href="/">главную страницу</a> сайта.
EOF;


$skin['reg_form'] = <<<EOF
<font color="red">{error}</font>
<form method=post action="/users/doreg/">
<table border="0" cellspacing="0" cellpadding="0" width="100%" id="register">

<tr>
<th>Логин:</th>
<td><input name="user_name" value="{user_name}" type="text" title="обязательно заполнить"></td>
</tr>

<tr>
<th>Пароль:</th>
<td><input name="user_pass" class="text" value="{user_pass}" type="password" title="обязательно заполнить"></td>
</tr>

<tr>
<th>Повтор пароля:</td>
<td><input name="user_pass2" class="text" value="{user_pass2}" type="password" title="обязательно заполнить"></td>
</tr>

<tr>
<th>E-mail:</td>
<td><input name="user_email" class="text" value="{user_email}" type="text" title="обязательно заполнить"></td>
</tr>

{extend}

<tr>
<th></th>
<td><img border="0" src="/users/captcha/"></td>
</tr>

<tr>
<th></th>
<td>Введите код, который вы видите выше:<br><input name="captcha" class="text" value="" type="text"></td>
</tr>

<tr>
<td colspan="2" align="center"><input class="button" value="Отправить" type="submit"></td>
</tr>

</table>
</form>

EOF;



// расширенные поля при регистарции
$skin['reg_form_extend']        = <<<EOF
<tr>
<th>Фамилия:</td>
<td><input name="user_lname" value="{user_lname}" type="text"></td>
</tr>

<tr>
<th>Имя:</td>
<td><input name="user_fname" value="{user_fname}" type="text"></td>
</tr>

<tr>
<th>Должность:</td>
<td><input name="user_role" class="text" value="{user_role}" type="text"></td>
</tr>

<tr>
<th>ИНН:</td>
<td><input name="user_inn" class="text" value="{user_inn}" type="text"></td>
</tr>

<tr>
<th>Контактный телефон:</td>
<td><input name="user_phone" class="text" value="{user_phone}" type="text"></td>
</tr>

<tr>
<th>Фактический адрес:</td>
<td><input name="user_factadr" class="text" value="{user_factadr}" type="text"></td>
</tr>

<tr>
<th>Юридический телефон:</td>
<td><input name="user_uradr" class="text" value="{user_uradr}" type="text"></td>
</tr>

EOF;


// указываем, какие из полей обязательны для заполнения
# перечень пунктов в reg_form_extend_necessary должны быть такие же как и поля в reg_form_extend
# потому что при проверке входных используются их ОДИНАКОВЫЕ имена
$skin['reg_form_extend_necessary'] = array();
$skin['reg_form_extend_necessary']['user_lname'] = 'Не заполнено поле "Фамилия"<br>';
$skin['reg_form_extend_necessary']['user_fname'] = 'Не заполнено поле "Имя"<br>';
$skin['reg_form_extend_necessary']['user_role'] = 'Не заполнено поле "Должность"<br>';
$skin['reg_form_extend_necessary']['user_inn'] = 'Не заполнено поле "ИНН"<br>';
$skin['reg_form_extend_necessary']['user_phone'] = 'Не заполнено поле "Контактный телефон"<br>';
$skin['reg_form_extend_necessary']['user_factadr'] = 'Не заполнено поле "Фактический адрес"<br>';
$skin['reg_form_extend_necessary']['user_uradr'] = 'Не заполнено поле "Юридический телефон"<br>';






# успешная регистрация
$skin['reg_success'] = <<<EOF
Вы успешно зарегистрировались в нашей системе.<br>
Сообщение с ключем активации профиля отправлено Вам по электронной почте.<br>
Вы можете перейти на <a href="/">главную страницу</a> сайта.
EOF;



$skin['edit_form'] = <<<EOF
<font color="red">{error}</font>
<form method=post action="/users/doedit/">
<input type="hidden" name="user_id" value="{user_id}">
<table border="0" cellspacing="0" cellpadding="0" width="100%" id="register">

<tr>
<th>Логин:</td>
<td>{user_name}</td>
<td></td>
</tr>

<tr>
<th>Пароль:</td>
<td><input name="user_pass" class="text" value="{user_pass}" type="password"></td>
</tr>

<tr>
<th>Повтор пароля:</td>
<td><input name="user_pass2" class="text" value="{user_pass}" type="password"></td>
</tr>

<tr>
<th>E-mail:</td>
<td><input name="user_email" class="text" value="{user_email}" type="text"  title="обязательно заполнить"></td>
</tr>

{extend}

<tr>
<th></th>
<td><input class="button" value="Отправить" type="submit"></td>
</tr>

</table>
</form>

EOF;

# успешная регистрация
$skin['edit_success'] = <<<EOF
Профиль изменeн.<br><br>
Вы можете перейти на <a href="/">главную страницу</a> сайта.
EOF;



# пользователь подтвердил свою регистрацию
$skin['approve_success'] = <<<EOF
Ваш аккаунт успешно активирован.<br>
Воспользуйтесь формой входа на главной странице.<br><br>
Вы можете перейти на <a href="/">главную страницу</a> сайта.
EOF;


# при подтверждении регистрации - ошибка
$skin['approve_error'] = <<<EOF
Ваш аккаунт не удалось активировать.<br>
Такого ключа активации не существует в нашей базе данных. Обратитесь к администратору сайта.<br><br>
Вы можете перейти на <a href="/">главную страницу</a> сайта.
EOF;


?>