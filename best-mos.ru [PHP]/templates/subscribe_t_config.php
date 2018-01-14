<?php
#
# шаблоны модуля
#


//-------------------------------------
// пользовательская часть
//-------------------------------------

$_subscribe_form = <<<EOF
		<table width="100%" border="0" cellpadding="0" cellspacing="0" id="scribeform">
		<form method="post">
		<tr valign="top"><td class="fieldname">Подписка на новости<br><b>{RESULT}</b></td></tr>
		<tr valign="middle">
		<td width="99%"><input class="scribeformfield" type="text" id="subscribe" name="subscribe" value="Ваш e-mail" OnFocus="if ($('#subscribe').val()=='Ваш e-mail') $('#subscribe').val('');" OnBlur="if ($('#subscribe').val()=='') $('#subscribe').val('Ваш e-mail');" maxlength=150 border="0"></td>
		<td width="1%"  style="padding: 0px 0px 0px 8px;" valign="bottom"><input type="image"  src="/i/b_scribe.gif" style="cursor: hand; cursor: pointer; padding: 0px; margin: 0px;">
		
		</td>
		</tr>
		<tr><td height="12"><table border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td></tr>
		</form>
		</table>
EOF;





//-------------------------------------
// администраторская часть
//-------------------------------------

// тема письма рассылки
$_subscribe_subject = "Почтовая рассылка сайта fssmo.ru";


// шаблон новости для письма расылки
$_subscribe_news = <<<EOF
<table border="0"><tr>
<td>{DOCUMENTDATE}</td><td>{TITLE}</td>
</tr><tr>
<td></td><td>{SBODY}</td>
</tr><tr>
<td></td><td><a href="{ALIAS}">{ALIAS}</a></td>
</tr></table>
<br />
<br />
EOF;



// шаблон письма
$_subscribe_mail = <<<EOF
<h2>Новости сайта {HOST}</h2><br>
{MAIL}


Для удаления вашего email из списка рассылки перейдите по <a href="{DEL_ALIAS}">этой ссылке</a>.
<br><br>
--<br>
С уважением, {COMPANY}!
EOF;

$_subscribe_mail_info = <<<EOF
<html>
<body>
Здравствуйте!<br><br>
Для подтверждения рассылки, перейдите по <a href="{ALIAS}">ссылке</a>.
<br><br>
--<br>
С уважением, {COMPANY}

</body>
</html>
EOF;

?>