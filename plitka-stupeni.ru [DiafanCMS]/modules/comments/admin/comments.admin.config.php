<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Comments_admin_config
 *
 * Настройки модуля "Комментарии"
 */
class Comments_admin_config extends Frame_admin
{
	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'config' => array (
			'format_date' => array(
				'type' => 'select',
				'name' => 'Формат даты',
			),
			'count_level' => array(
				'type' => 'numtext',
				'name' => 'Максимальная вложенность',
			),
			'max_count' => array(
				'type' => 'numtext',
				'name' => 'Максимальное количество комментариев на странице',
			),
			'use_bbcode' => array(
				'type' => 'checkbox',
				'name' => 'Использовать bbCode',
			),
			'hr1' => 'hr',
			'user_name' => array(
				'type' => 'checkbox',
				'name' => 'Отображать имя пользователя, добавившего комментарий',
			),
			'only_user' => array(
				'type' => 'checkbox',
				'name' => 'Только для зарегистрированных пользователей',
			),
			'captcha' => array(
				'type' => 'checkbox',
				'name' => 'Использовать защитный код (каптчу)',
			),
			'security_moderation' => array(
				'type' => 'checkbox',
				'name' => 'Модерация сообщений',
				'help' => 'Если отмечена, комментарии будут отображаться на сайте только после того, как администратор вручную установит активность',
			),
			'hr2' => 'hr',
			'error_insert_message' => array(
				'type' => 'text',
				'name' => 'Ваше сообщение уже имеется в базе',
				'multilang' => true,
			),
			'add_message' => array(
				'type' => 'text',
				'name' => 'Спасибо! Ваш комментарий будет проверен в ближайшее время и появится на сайте.',
				'multilang' => true,
			),
			'hr3' => 'hr',
			'sendmailadmin' => array(
				'type' => 'checkbox',
				'name' => 'Уведомлять о поступлении новых комментариев на e-mail',
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
				'name' => 'Тема письма для уведомлений',
			),
			'message_admin' => array(
				'type' => 'textarea',
				'name' => 'Сообщение для уведомлений',
			),
			'hr4' => 'hr',
			'sendsmsadmin' => array(
				'type' => 'checkbox',
				'name' => 'Уведомлять о поступлении новых комментариев по SMS',
			),
			'sms_admin' => array(
				'type' => 'text',
				'name' => 'Номер телефона в федеральном формате',
			),
			'sms_message_admin' => array(
				'type' => 'textarea',
				'name' => 'Сообщение для уведомлений',
				'help' => 'Не более 800 символов',
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
		'sendsmsadmin' => array(
			'sms_admin',
			'sms_message_admin',
		),
	);

	/**
	 * @var array значения списков
	 */
	public $select_arr = array(
		'format_date' => array(
			0 => '1.05.2009',
			1 => '1 мая 2008 г.',
			2 => '1 мая',
			3 => '1 мая 2008, понедельник',
			4 => 'не отображать',
			5 => 'вчера 15:30',
		),
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		if(! SMS)
		{
			$this->diafan->variable("sendsmsadmin", "disabled", true);
			$name = $this->diafan->variable("sendsmsadmin", "name").'<br>'.$this->diafan->_('Необходимо %sнастроить%s SMS-уведомления.', '<a href="'.BASE_PATH_HREF.'config/">', '</a>');
			$this->diafan->variable("sendsmsadmin", "name", $name);
			$this->diafan->configmodules("sendsmsadmin", $this->diafan->module, $this->diafan->site, _LANG, 0);
		}
	}
}