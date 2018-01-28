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
 * Files_admin_config
 *
 * Настройки модуля "Файловый архив"
 */
class Files_admin_config extends Frame_admin
{
	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'config' => array (
			'nastr' => array(
				'type' => 'numtext',
				'name' => 'Количество файлов на странице',
			),
			'hr1' => 'hr',
			'attachment_extensions' => array(
				'type' => 'text',
				'name' => 'Доступные типы файлов (через запятую)',
			),
			'hr2' => 'hr',
			'cat' => array(
				'type' => 'checkbox',
				'name' => 'Использовать категории',
			),
			'count_list' => array(
				'type' => 'numtext',
				'name' => 'Количество файлов в списке категорий',
			),
			'count_child_list' => array(
				'type' => 'numtext',
				'name' => 'Количество файлов в списке вложенной категории',
				'help' => 'Для первой страницы модуля и для страницы категории',
			),
			'children_elements' => array(
				'type' => 'checkbox',
				'name' => 'Показывать файлы подкатегорий',
			),
			'hr3' => 'hr',
			'images' => array(
				'type' => 'module',
				'name' => 'Использовать изображения',
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
			'hr4' => 'hr',
			'comments' => array(
				'type' => 'module',
				'name' => 'Показывать комментарии к файлам',
			),
			'tags' => array(
				'type' => 'module',
				'name' => 'Показывать теги файлов',
			),
			'rating' => array(
				'type' => 'module',
				'name' => 'Показывать рейтинг файлов',
			),
			'keywords' => array(
				'type' => 'module',
				'name' => 'Подключить перелинковку',
			),
			'rel_two_sided' => array(
				'type' => 'checkbox',
				'name' => 'В блоке похожих файлов связь двусторонняя',
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
}