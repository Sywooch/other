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
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Usersite_admin_config
 *
 * Настройки модуля "Пользователи сайта"
 */
class Users_admin_config extends Frame_admin
{
	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'config' => array (
			'act' => array(
				'type' => 'select',
				'name' => 'Порядок активации пользователя',
			),
			'mail_as_login' => array(
				'type' => 'checkbox',
				'name' => 'Использовать e-mail в качестве логина',
			),
			'captcha' => array(
				'type' => 'checkbox',
				'name' => 'Использовать защитный код (каптчу)',
			),
			'mes' => array(
				'type' => 'textarea',
				'name' => 'Сообщение пользователю по окончанию регистрации',
				'multilang' => true,
			),
			'hide_register_form' => array(
				'type' => 'checkbox',
				'name' => 'Скрывать форму после успешной регистрации',
			),
			'hr_loginz' => 'hr',
			'loginza' => array(
				'type' => 'checkbox',
				'name' => 'Использовать авторизацию через сервис Loginza',
			),
			'loginza_widget_id' => array(
				'type' => 'text',
				'name' => 'ID виджета для сервиса Loginza',
			),
			'loginza_skey' => array(
				'type' => 'text',
				'name' => 'Секретный ключ для сервиса Loginza',
			),
			'hr_data' => 'hr',
			'format_date' => array(
				'type' => 'select',
				'name' => 'Формат даты',
			),
			'hr1' => 'hr',
			'avatar' => array(
				'type' => 'checkbox',
				'name' => 'Использовать аватар',
			),
			'avatar_width' => array(
				'type' => 'function',
				'name' => 'Размер аватара',
			),
			'avatar_height' => array(
				'type' => 'none',
			),
			'avatar_quality' => array(
				'type' => 'none',
			),
			'hr2' => 'hr',
			'sendmailadmin' => array(
				'type' => 'checkbox',
				'name' => 'Уведомлять администратора',
			),
			'emailconfadmin' => array(
				'type' => 'function',
				'name' => 'E-mail для уведомлений администратора',
			),
			'email_admin' => array(
				'type' => 'none',
				'name' => 'впишите e-mail',
			),
			'subject_admin' => array(
				'type' => 'text',
				'name' => 'Тема письма администратору',
			),
			'message_admin' => array(
				'type' => 'textarea',
				'name' => 'Текст письма администратору',
			),
			'hr3' => 'hr',
			'emailconf' => array(
				'type' => 'function',
				'name' => 'E-mail, указываемый в обратном адресе пользователю',
			),
			'subject' => array(
				'type' => 'text',
				'name' => 'Тема письма новому пользователю',
				'multilang' => true,
			),
			'message' => array(
				'type' => 'textarea',
				'name' => 'Сообщение новому пользователю',
				'multilang' => true,
			),
			'email' => array(
				'type' => 'none',
				'name' => 'впишите e-mail',
			),
			'mes_reminding' => array(
				'type' => 'text',
				'name' => 'Сообщение пользователю при восстановлении пароля',
				'multilang' => true,
			),
			'subject_reminding' => array(
				'type' => 'text',
				'name' => 'Тема письма со ссылкой на изменение пароля',
				'multilang' => true,
			),
			'message_reminding' => array(
				'type' => 'textarea',
				'name' => 'Текст письма со ссылкой на изменение пароля',
				'multilang' => true,
			),
			'subject_reminding_new_pass' => array(
				'type' => 'text',
				'name' => 'Тема письма с новым паролем',
				'multilang' => true,
			),
			'message_reminding_new_pass' => array(
				'type' => 'textarea',
				'name' => 'Текст письма с новым паролем',
				'multilang' => true,
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'config', // файл настроек модуля
	);

	/**
	 * @var array зависимости между полями
	 */
	public $show_tr_click_checkbox = array(
		'sendmailadmin' => array(
			'emailconfadmin',
			'subject_admin',
			'message_admin',
		),
		'avatar' => array(
			'avatar_width',
		),
		'loginza' => array(
			'loginza_widget_id',
			'loginza_skey',
		),
	);

	/**
	 * @var array значения списков
	 */
	public $select_arr = array(
		'act' => array(
			0 => 'при регистрации',
			1 => 'по ссылке, высланной на e-mail',
			2 => 'администратором',
		),
		'format_date' => array(
			0 => '1.05.2009',
			1 => '1 мая 2008 г.',
			2 => '1 мая',
			3 => '1 мая 2008, понедельник',
			4 => 'не отображать',
		),
	);

	/**
	 * Редактирование поля "Размер и качество аватара"
	 * 
	 * @return void
	 */
	public function edit_config_variable_avatar_width()
	{
		echo '
		<tr id="avatar_width">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td><input type="text" name="avatar_width" size="3" value="'.$this->diafan->values["avatar_width"].'" class="inpnum"> x
				<input type="text" name="avatar_height" size="3" value="'.$this->diafan->values["avatar_height"].'" class="inpnum">,
				'.$this->diafan->_('качество').'
				<input type="text" name="avatar_quality" size="2" value="'.$this->diafan->values["avatar_quality"].'" class="inpnum">'
	.$this->diafan->help().'
			</td>
		</tr>';
	}
}