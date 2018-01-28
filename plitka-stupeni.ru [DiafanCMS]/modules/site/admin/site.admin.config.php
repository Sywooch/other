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
 * Site_admin_config
 *
 * Настройки модуля "Страницы сайта"
 */
class Site_admin_config extends Frame_admin
{
	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'config' => array (
			'images' => array(
				'type' => 'module',
				'name' => 'Использовать изображения',
				'help' => 'Если отмечена, к страницам сайта можно будет прикреплять изображения, которые будут выводиться под текстом',
			),
			'hr' => 'hr',
			'protect' => array(
				'type' => 'checkbox',
				'name' => 'Защита от копирования',
				'help' => 'Если отмечена, на сайте будет отключена возможность копирования текста в буфер (если в шаблоне есть соответствующий тег show_protect)',
			),
			'comments' => array(
				'type' => 'module',
				'name' => 'Прикрепить комментарии к страницам сайта',
				'help' => 'Если отмечена, пользователи сайта будут иметь возможность оставить комментарии к каждой странице сайта',
			),
			'tags' => array(
				'type' => 'module',
				'name' => 'Подключить теги',
				'help' => 'Если отмечена, к страницам сайта можно будет прикреплять теги',
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