<?php
/**
 * Авторизация
 *
 * Шаблон
 * шаблонного тега <insert name="show_login" module="registration" [template="шаблон"]>:
 * блок авторизации
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

if (!$result["user"])
{
	$text = $result["error"];
	$text .= '<div class="login">';
	$text .= '<form method="post" action="' . $result["action"] . '">
		<input type="hidden" name="action" value="auth">
		<span class="infofield">' . $this->diafan->_('Логин') . '</span>
		<input type="text" name="name" value="" size="18" class="inptext">
		<span class="infofield">' . $this->diafan->_('Пароль') . '</span>
		<input type="password" name="pass" value="" size="18" class="inptext">
		<span class="infofield">' . $this->diafan->_('Чужой компьютер') . '</span>
		<input type="checkbox" name="not_my_computer" value="1" class="inpcheckbox">
		<span class="button_wrap"><input type="submit" value="Войти" class="button"></span><br>';
	if (! empty($result["reminding"]))
	{
		$text .= '<a href="' . $result["reminding"] . '">' . $this->diafan->_('Забыли пароль?') . '</a> ';
	}
	if(! empty($result["registration"]))
	{
		$text .= '<a href="' . $result["registration"] . '">' . $this->diafan->_('Регистрация') . '</a>';
	}
	$text .= '</form>';
	
	if(! empty($result["use_loginza"]))
	{
	    $text .= '<script src="http://loginza.ru/js/widget.js" type="text/javascript"></script>
	    <br><a href="https://loginza.ru/api/widget?token_url=http://'.BASE_URL.'" class="loginza">
		<img src="http://loginza.ru/img/providers/yandex.png" alt="Yandex" title="Yandex">
		<img src="http://loginza.ru/img/providers/google.png" alt="Google" title="Google Accounts">
		<img src="http://loginza.ru/img/providers/vkontakte.png" alt="Вконтакте" title="Вконтакте">
		<img src="http://loginza.ru/img/providers/mailru.png" alt="Mail.ru" title="Mail.ru">
		<img src="http://loginza.ru/img/providers/twitter.png" alt="Twitter" title="Twitter">
		<img src="http://loginza.ru/img/providers/loginza.png" alt="Loginza" title="Loginza">
		<img src="http://loginza.ru/img/providers/myopenid.png" alt="MyOpenID" title="MyOpenID">
		<img src="http://loginza.ru/img/providers/openid.png" alt="OpenID" title="OpenID">
		<img src="http://loginza.ru/img/providers/webmoney.png" alt="WebMoney" title="WebMoney">
	    </a><br><br>';
	}
	$text .= '</div>';
}
else
{
	$text = '<div class="login">';
	if (!empty($result["avatar"]))
	{
		$text .= '<img src="' . BASE_PATH.USERFILES.'/avatar/' . $result["name"] . '.png" width="' . $result["avatar_width"] . '" height="' . $result["avatar_height"] . '" alt="' . $result["fio"] . ' (' . $result["name"] . ')" class="login_avatar">';
	}
	$text .= $this->diafan->_('Здравствуйте') . ', ';
	if($result['userpage'])
	{
		$text .= '<a href="' . $result['userpage'] . '">' . $result["fio"] . '</a>';
	}
	else
	{
		$text .= $result["fio"];
	}
	$text.= '!
	<div>';
	if(! empty($result["usersettings"]))
	{
		$text .= '<a href="' . $result["usersettings"] . '">' . $this->diafan->_('Редактировать данные') . '</a><br>';
	}
	if (!empty($result['messages']))
	{
		$text.= '<a href="' . $result['messages'] . '">' . $result['messages_name'] . ' (<b>' . $result['messages_unread'] . '</b>)</a><br>';
	}
	$text.= '<br>
	<a href="' . BASE_PATH_HREF . 'logout/?'.rand(0, 99999).'">' . $this->diafan->_('Выйти') . '</a>
	</div>';
	$text .= '</div>';
}
return $text;