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
 * Subscribtion_admin_config
 *
 * Настройки модуля "Рассылки"
 */
class Subscribtion_admin_config extends Frame_admin
{
	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'config' => array (
			'cat' => array(
				'type' => 'checkbox',
				'name' => 'Использовать категории',
			),
			'hr0' => 'hr',
			'subject' => array(
				'type' => 'text',
				'name' => 'Тема письма для рассылки',
				'multilang' => true,
			),
			'emailconf' => array(
				'type' => 'select',
				'name' => 'E-mail, указываемый в обратном адресе пользователю',
				'multilang' => true,
			),
			'email' => array(
				'type' => 'none',
				'name' => 'впишите e-mail',
				'multilang' => true,
			),
			'subscribe_in_registration' => array(
				'type' => 'checkbox',
				'name' => 'Выводить при регистрации галку «Подписаться на новости»',
			),
			'subscribe_in_order' => array(
				'type' => 'checkbox',
				'name' => 'Выводить при оформлении заказа галку «Подписаться на новости»',
			),
			'hr1' => 'hr',
			'add_mail' => array(
				'type' => 'text',
				'name' => 'Сообщение после добавления e-mail',
				'multilang' => true,
			),
			'subject_user' => array(
				'type' => 'text',
				'name' => 'Тема письма для уведомлений пользователя о подписке на рассылку',
				'multilang' => true,
			),
			'message_user' => array(
				'type' => 'textarea',
				'name' => 'Сообщение для уведомлений пользователя о подписке на рассылку',
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
}