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
	include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

/**
 * Feedback_admin_config
 *
 * Настройки модуля "Обратная связь"
 */
class Feedback_admin_config extends Frame_admin
{
	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'config' => array (
			'captcha' => array(
				'type' => 'checkbox',
				'name' => 'Использовать защитный код (каптчу)',
			),
			'hr0' => 'hr',
			'add_message' => array(
				'type' => 'textarea',
				'name' => 'Сообщение после отправки',
				'multilang' => true,
			),
			'hr1' => 'hr',
			'subject' => array(
				'type' => 'text',
				'name' => 'Тема письма для ответа',
				'multilang' => true,
			),
			'message' => array(
				'type' => 'textarea',
				'name' => 'Сообщение для ответа',
				'multilang' => true,
			),
			'emailconf' => array(
				'type' => 'select',
				'name' => 'E-mail, указываемый в обратном адресе пользователю',
			),
			'email' => array(
				'type' => 'none',
				'name' => 'впишите e-mail',
			),
			'hr3' => 'hr',
			'sendmailadmin' => array(
				'type' => 'checkbox',
				'name' => 'Уведомлять о поступлении новых сообщений на e-mail',
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
				'name' => 'Уведомлять о поступлении новых сообщений по SMS',
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
			'hr5' => 'hr',
			'admin_page'     => array(
				'type' => 'checkbox',
				'name' => 'Отдельный пункт в меню администрирования для каждого раздела сайта',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'element_site', // делит элементы по разделам (страницы сайта, к которым прикреплен модуль)
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