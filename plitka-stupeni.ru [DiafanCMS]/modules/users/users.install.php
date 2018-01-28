<?php

/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

/**
 * Users_install
 *
 * Установка модуля "Пользователи сайта"
 */
$title = "Пользователи";

$db = array(
	"tables" => array(
		array(
			"name" => "users_actlink",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "link",
					"type" => "varchar(250) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "user_id",
					"type" => "int(11) unsigned NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "created",
					"type" => "INT(10) unsigned NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
	),
	"modules" => array(
		array(
			"name" => "users",
			"module_name" => "users",
			"admin" => true,
			"site" => true,
			"title" => "Пользователи",
		),
		array(
			"name" => "userpage",
			"module_name" => "users",
			"site" => true,
			"site_page" => true,
			"title" => "Страница пользователя",
		),
		array(
			"name" => "usersettings",
			"module_name" => "users",
			"site" => true,
			"site_page" => true,
			"title" => "Настройки аккаунта",
		),
		array(
			"name" => "registration",
			"module_name" => "users",
			"site" => true,
			"site_page" => true,
			"title" => "Регистрация",
		),
		array(
			"name" => "reminding",
			"module_name" => "users",
			"site" => true,
			"site_page" => true,
			"title" => "Восстановление доступа",
		),
	),
	"sites" => array(
		array(
			"name" => array('Регистрация', 'Registration'),
			"act" => true,
			"sort" => 17,
			"module_name" => "registration",
			"map_no_show" => true,
			"noindex" => true,
			"search_no_show" => true,
			"rewrite" => "registration",
		),
		array(
			"name" => array('Восстановление доступа', 'Restore access to your account'),
			"act" => true,
			"sort" => 18,
			"module_name" => "reminding",
			"map_no_show" => true,
			"noindex" => true,
			"search_no_show" => true,
			"rewrite" => "reminding",
		),
		array(
			"name" => array('Настройки аккаунта', 'Settings'),
			"act" => true,
			"sort" => 18,
			"module_name" => "usersettings",
			"map_no_show" => true,
			"noindex" => true,
			"search_no_show" => true,
			"rewrite" => "settings",
		),
		array(
			"name" => array('Страница пользователя', 'User page'),
			"act" => true,
			"sort" => 19,
			"module_name" => "userpage",
			"map_no_show" => true,
			"noindex" => true,
			"search_no_show" => true,
			"rewrite" => "user",
		),
	),
	"config" => array(
		array(
			"name" => "captcha",
			"value" => "1",
		),
		array(
			"name" => "sendmailadmin",
			"value" => "1",
		),
		array(
			"name" => "act",
			"value" => "1",
		),
		array(
			"name" => "subject_admin",
			"value" => "%title (%url). Новый пользователь",
		),
		array(
			"name" => "message_admin",
			"value" => "Здравствуйте, администратор сайта %title (%url)!<br>На сайте появился новый пользователь: %fio (%login), %email.",
		),
		array(
			"name" => "mes",
			"value" => array(
				"Вы удачно зарегистрированы. Для активации аккаунта пройдите по ссылке, высланной на ваш e-mail.",
				"Congratulations! You have successful registered. In order to activate your account please click the link send to your e-mail.",
			),
		),
		array(
			"name" => "subject",
			"value" => array(
				'Вы зарегистрированы на сайте %title (%url)',
				'You registered on web site %title (%url).',
			),
		),
		array(
			"name" => "message",
			"value" => array(
				"Здравствуйте, %fio!<br>Вы зарегистрированы на сайте %title (%url).<br>Логин: %login<br>Пароль: %password<br>Для активации аккаунта пройдите по ссылке %actlink<br>Ссылка действует в течении суток.",
				"Hello, %fio!<br>You registered on web site %title (%url).<br>Username: %login<br>Password: %password<br>In order to activate your account please click the link %actlink<br>Link act in next day.",
			),
		),
		array(
			"name" => "mes_reminding",
			"value" => array(
				"На ваш e-mail отправлена ссылка на форму изменения пароля.",
				"In your e-mail sent a link to the password change form.",
			),
		),
		array(
			"name" => "subject_reminding",
			"value" => array(
				"Восстановление доступа к сайту %title (%url).",
				"Restore access to the site %title (%url).",
			),
		),
		array(
			"name" => "message_reminding",
			"value" => array(
				"Здравствуйте, %fio!<br>Вы запросили восстановление доступа к сайту %title (%url).<br>Для изменения пароля пройдите по ссылке: %actlink",
				"Hello, %fio!<br>You have requested the restoration of access to the site %title (%url).<br>To change the password, go to: %actlink",
			),
		),        
		array(
			"name" => "subject_reminding_new_pass",
			"value" => array(
				"Новый пароль на сайте %title (%url)",
				"New password on the site %title (%url)",
			),
		),
		array(
			"name" => "message_reminding_new_pass",
			"value" => array(
				"Здравствуйте, %fio!<br>Вы изменили пароль на сайте %title (%url).<br>Логин: %login<br>Пароль: %password",
				"Hello, %fio!<br>You have changed your password on the site %title (%url).<br>Username: %login<br>Password: %password",
			),
		),
		array(
			"name" => "avatar",
			"value" => "1",
		),
		array(
			"name" => "avatar_width",
			"value" => "50",
		),
		array(
			"name" => "avatar_height",
			"value" => "50",
		),
		array(
			"name" => "avatar_quality",
			"value" => "80",
		),
	),
);

$example = array(
        "UPDATE {site} SET
		".multilang(
	"textLANG='<p>Регистрация на сайте нашего зоопарка дает многое: для посетителей доступ к некоторым закрытым страницам, голосованиям и т.д. А администрация нашего зоопарка часто делает рассылки интересных новостей по базе наших пользователей.</p>'", ", textLANG='<p>Registration on a site of our zoo gives much: for visitors access to some closed pages, votings etc. And the administration of our zoo often does dispatches of interesting news on base of our users.</p>'", ""
)."
	WHERE module_name='registration'",
"UPDATE {site} SET
		".multilang(
	"textLANG='<p>Если вы забыли пароль, вам необходимо ввести ваш логин и почтовый ящик в форму ниже и нажать отправить. Новый пароль придет к вам на почту. Восстановление старого пароля невозможно, т.к. пароли шифруются по алгоритму md5.</p>'", ", textLANG='<p>If you have forgotten the password, it is necessary for you to enter your login and a mail box into the form more low and to press to send. The new password will come to you on mail. Restoration of the old password is impossible, since passwords are ciphered on algorithm md5.</p>'", ""
)."
	WHERE module_name='reminding'",

        "INSERT INTO {users} (name, password, mail, created, fio, act) VALUES (
		'kukushkin',
		'48222981add3862a4c8e9646fd77b1d1',
		'kukushkin@site.com',
		'1231794000',
		'Кукушкин Адольф',
		'1'
	)",

        "INSERT INTO {users} ( name, password, mail, created, fio, act) VALUES (
		'filimon',
		'c42a922f981091217a808fb6eea48e26',
		'filimon@site.ru',
		'1234126800',
		'Филимон Авруцкий',
		'1'
	)"
);

/**
 * Выполняет действия для основной установки модуля
 * 
 * @return void
 */
function module_basic_users()
{
	if (!is_dir(ABSOLUTE_PATH.USERFILES.'/avatar'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/avatar', 0777);
	}
}

/**
 * Выполняет действия для установки примеров заполнения модуля
 * 
 * @return void
 */
function module_example_users()
{
	if (!file_exists(ABSOLUTE_PATH.USERFILES.'/avatar/filimon.png'))
	{
		copy(DEMO_PATH.'avatar/filimon.png', ABSOLUTE_PATH.USERFILES.'/avatar/filimon.png');
	}
	if (!file_exists(ABSOLUTE_PATH.USERFILES.'/avatar/kukushkin.png'))
	{
		copy(DEMO_PATH.'avatar/kukushkin.png', ABSOLUTE_PATH.USERFILES.'/avatar/kukushkin.png');
	}
}