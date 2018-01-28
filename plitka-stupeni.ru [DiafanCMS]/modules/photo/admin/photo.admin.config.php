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
 * Photo_admin_config
 *
 * Конфигурация фотогалереи
 */
class Photo_admin_config extends Frame_admin
{
	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'config'       => array (
			'nastr' => array(
				'type' => 'numtext',
				'name' => 'Количество фотографий на странице',
			),
			'hr1' => 'hr',
			'cat' => array(
				'type' => 'checkbox',
				'name' => 'Использовать альбомы',
				'help' => 'Разделение фотогалереи на альбомы-подкатегории.',
			),
			'count_list' => array(
				'type' => 'numtext',
				'name' => 'Количество фотографий в списке альбомов',
			),
			'count_child_list' => array(
				'type' => 'numtext',
				'name' => 'Количество фотографий в списке вложенной категории',
				'help' => 'Для первой страницы фотогалереи и для страницы категории',
			),
			'children_elements' => array(
				'type' => 'checkbox',
				'name' => 'Показывать фотографии вложенных альбомов',
				'help' => 'Если отмечена, в списке фотоальбомов будут отображатся последние добавленные фотографии из всех вложенных альбомов.',
			),
			'hr2' => 'hr',
			'images' => array(
				'type' => 'module',
				'name' => 'Изображения',
			),
			'hr3' => 'hr',
			'multiupload_act'     => array(
				'type' => 'checkbox',
				'name' => 'Активировать фотографии сразу после групповой загрузки',
			),
			'page_show' => array(
				'type' => 'checkbox',
				'name' => 'Открывать фотографию на отдельной странице',
				'help' => 'Если не отмечена, фотографии из альбома будут сразу увеличиваться. Если отмечена, каждая фотография будет открываться на отдельной странице с полным текстовым описанием, ее можно будет комментировать, ставить рейтинг.',
			),
			'rel_two_sided' => array(
				'type' => 'checkbox',
				'name' => 'В блоке похожих фотографий связь двусторонняя',
			),
			'hr4' => 'hr',
			'comments' => array(
				'type' => 'module',
				'name' => 'Показывать комментарии к фотографиям',
			),
			'tags' => array(
				'type' => 'module',
				'name' => 'Подключить теги',
			),
			'rating' => array(
				'type' => 'module',
				'name' => 'Показывать рейтинг фотографий',
			),
			'keywords' => array(
				'type' => 'module',
				'name' => 'Подключить перелинковку',
			),
			'hr_count' => 'hr',
			'counter' => array(
				'type' => 'checkbox',
				'name' => 'Счетчик просмотров',
			),
			'counter_site' => array(
				'type' => 'checkbox',
				'name' => 'Выводить счетчик на сайте',
			),
			'hr7' => 'hr',
			'title_tpl' => array(
				'type' => 'text',
				'name' => 'Шаблон для автоматического генерирования Title',
				'help' => 'Если шаблон задан, то заголовок автоматически генерируется по шаблону. В шаблон можно добавить %title - заданный заголовок, %name - название, %category - название категории, %parent_category - название категории верхнего уровня',
				'multilang' => true
			),
			'title_tpl_cat' => array(
				'type' => 'text',
				'name' => 'Шаблон для автоматического генерирования Title для категории',
				'help' => 'Если шаблон задан, то заголовок автоматически генерируется по шаблону. В шаблон можно добавить %title - заданный заголовок, %name - название категории, %parent - название категории верхнего уровня',
				'multilang' => true
			),
			'keywords_tpl' => array(
				'type' => 'text',
				'name' => 'Шаблон для автоматического генерирования Keywords',
				'help' => 'Если шаблон задан, то поле Keywords автоматически генерируется по шаблону. В шаблон можно добавить %keywords - заданные ключевые слова, %name - название, %category - название категории, %parent_category - название категории верхнего уровня',
				'multilang' => true
			),
			'keywords_tpl_cat' => array(
				'type' => 'text',
				'name' => 'Шаблон для автоматического генерирования Keywords для категории',
				'help' => 'Если шаблон задан, то поле Keywords автоматически генерируется по шаблону. В шаблон можно добавить %keywords - заданные ключевые слова, %name - название категории, %parent - название категории верхнего уровня',
				'multilang' => true
			),
			'descr_tpl' => array(
				'type' => 'text',
				'name' => 'Шаблон для автоматического генерирования Description',
				'help' => 'Если шаблон задан, то поле Description автоматически генерируется по шаблону. В шаблон можно добавить %descr - заданное описание, %name - название, %category - название категории, %parent_category - название категории верхнего уровня',
				'multilang' => true
			),
			'descr_tpl_cat' => array(
				'type' => 'text',
				'name' => 'Шаблон для автоматического генерирования Description для категории',
				'help' => 'Если шаблон задан, то поле Description автоматически генерируется по шаблону. В шаблон можно добавить %descr - заданное описание, %name - название категории, %parent - название категории верхнего уровня',
				'multilang' => true
			),
			'themes' => array(
				'type' => 'function',
			),
			'theme_list' => array(
				'type' => 'none',
				'name' => 'Шаблон для списка элементов',
				'help' => 'Параметр для разработчиков! Не устанавливайте, если не уверены в результате.',
			),
			'view_list' => array(
				'type' => 'none',
			),
			'theme_first_page' => array(
				'type' => 'none',
				'name' => 'Шаблон для первой страницы модуля (если подключены категории)',
				'help' => 'Параметр для разработчиков! Не устанавливайте, если не уверены в результате.',
			),
			'view_first_page' => array(
				'type' => 'none',
			),
			'theme_id' => array(
				'type' => 'none',
				'name' => 'Шаблон для страницы элемента',
				'help' => 'Параметр для разработчиков! Не устанавливайте, если не уверены в результате.',
			),
			'view_id' => array(
				'type' => 'none',
			),
			'hr_admin_page' => 'hr',
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
		'cat' => array(
			'count_list',
			'children_elements',
			'count_child_list',
			'title_tpl_cat',
			'keywords_tpl_cat',
			'descr_tpl_cat',
		),
		'counter' => array(
			'counter_site',
		),
	);

	/**
	 * Подключение js файла
	 * 
	 * @return void
	 */
	public function edit_config_variable_view_id()
	{
		echo '<script type="text/javascript" src="' . BASE_PATH . 'modules/photo/admin/photo.admin.config.js"></script>';
	}
}