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
 * Shop_admin_category
 *
 * Редактирование категорий магазина
 */
class Shop_admin_category extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'shop_category';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Название',
				'multilang' => true,
			),
		/*
			'name_hone' =>  array(
				'type' => 'text',
				'name' => 'Заголовок H1',
				'help' => 'Если не заполнен, будет подставлено "название"',
				'multilang' => true,
			),
		*/
			'name_rus' =>  array(
				'type' => 'text',
				'name' => 'Название (рус., сущ.)',
				'multilang' => true,
			),
			'name_rus2' =>  array(
				'type' => 'text',
				'name' => 'Название (рус., прил.)',
				'multilang' => true,
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'default' => true,
				'multilang' => true,
			),
			'menu' => array(
				'type' => 'module',
				'name' => 'Создать пункт в меню',
			),
			'images' => array(
				'type' => 'module',
				'name' => 'Изображения',
			),
		),
		'other_rows' => array (
			'number' => array(
				'type' => 'function',
				'name' => 'Номер',
				'help' => 'Номер элемента в БД. (для разработчиков)',
			),
			'title_meta' => array(
				'type' => 'text',
				'name' => 'Заголовок окна в браузере, тэг Title',
				'help' => 'Если не заполнен, тег title будет автоматически сформирован как "Название страницы - Название сайта"',
				'multilang' => true,
			),
			'keywords' => array(
				'type' => 'text',
				'name' => 'Ключевые слова, тэг Keywords',
				'multilang' => true,
			),
			'descr' => array(
				'type' => 'textarea',
				'name' => 'Описание, тэг Description',
				'multilang' => true,
			),
			'rewrite' => array(
				'type' => 'function',
				'name' => 'Псевдоссылка',
				'help' => 'ЧПУ (человеко-понятные урл url), адрес страницы вида: site.ru/psewdossylka/. Смотрите настройки сайта',
			),
			'changefreq'   => array(
				'type' => 'function',
				'name' => 'Changefreq',
				'help' => 'Атрибут для sitemap.xml',
			),
			'priority'   => array(
				'type' => 'floattext',
				'name' => 'Priority',
				'help' => 'Атрибут для sitemap.xml',
			),
			'hr3' => 'hr',
			'site_id' => array(
				'type' => 'function',
				'name' => 'Раздел сайта',
			),
			'parent_id' => array(
				'type' => 'select',
				'name' => 'Вложенность: принадлежит',
			),
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
			'hr_map2' => 'hr',
			'map_no_show' => array(
				'type' => 'checkbox',
				'name' => 'Не показывать на карте сайта',
			),
			'show_yandex' => array(
				'type' => 'checkbox',
				'name' => 'Выгружать в Яндекс Маркет',
			),
			'access' => array(
				'type' => 'function',
				'name' => 'Доступ',
			),
			'hr4' => 'hr',
			'import_id' => array(
				'type' => 'text',
				'name' => 'Идентификатор для импорта',
			),
			'hr5' => 'hr',
			'comments' => array(
				'type' => 'module',
			),
			'rating' => array(
				'type' => 'module',
			),
			'anons' => array(
				'type' => 'editor',
				'name' => 'Анонс',
				'multilang' => true,
				'height' => 200,
			),
			'text' => array(
				'type' => 'editor',
				'name' => 'Описание',
				'multilang' => true,
			),
			'hr_map' => 'hr',
			'theme' => array(
				'type' => 'function',
				'name' => 'Шаблон страницы',
			),
			'view' => array(
				'type' => 'function',
				'name' => 'Шаблон модуля',
			),
			'view_element' => array(
				'type' => 'function',
				'name' => 'Шаблон модуля для вложенных товаров',
			),
			'hr_info' => 'hr',
			'admin_id' => array(
				'type' => 'function',
				'name' => 'Редактор',
			),
			'timeedit' => array(
				'type' => 'text',
				'name' => 'Время последнего изменения',
				'help' => 'Изменяется после сохранения элемента. Отдается в заголовке Last Modify',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'parent', // содержит вложенности
		'order', // сортируется
		'menu', // используется в меню
		'act', // показать/скрыть
		'del', // удалить
		'category', // часть модуля - категории
		'category_rel', // работают вместе с таблицей {module_category_rel}
		'element_site', // делит элементы по разделам (страницы сайта, к которым прикреплен модуль)
		'trash', // использовать корзину
		'only_self', // показывать только материалы редактора, если это задано в правах пользователя
	);

	/**
	 * @var integer количество строк, выводимых на странице
	 */
	public $nastr = 100;

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
	// print_r($_POST);
//	print_r($_REQUEST);
		if (! $this->diafan->configmodules('show_yandex_category', 'shop'))
		{
			$this->diafan->variable_unset("show_yandex");
		}
		/*
		// Таблица русского алфавита:
		$trans_table_ru = array(
			'Ч', 'Ч', 'ч', 'Ш', 'Ш', 'ш', 'Ю', 'Ю', 'ю', 'Я', 'Я', 'я',
			'А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Е', 'е', 'Ё', 'ё', 
			'Ж', 'ж', 'З', 'з', 'И', 'и', 'Й', 'й', 'К', 'к', 'Л', 'л', 'М', 'м', 
			'Н', 'н', 'О', 'о', 'П', 'п', 'Р', 'р', 'С', 'с', 'Т', 'т', 'У', 'у', 
			'Ф', 'ф', 'Х', 'х', 'К', 'к', 'Ы', 'ы', 'Э', 'э'
			
		);
		// Таблица латинского алфавита для адекватной замены букв (транслит):
		$trans_table_lat = array(
			'CH', 'Ch', 'ch', 'SH', 'Sh', 'sh', 'YU', 'Yu', 'yu', 'YA', 'Ya', 'ya',
			'A', 'a', 'B', 'b', 'V', 'v', 'G', 'g', 'D', 'd', 'E', 'e', 'E', 'e', 
			'J', 'j', 'Z', 'z', 'I', 'i', 'Y', 'y', 'K', 'k', 'L', 'l', 'M', 'm', 
			'N', 'n', 'O', 'o', 'P', 'p', 'R', 'r', 'S', 's', 'T', 't', 'U', 'u', 
			'F', 'f', 'H', 'h', 'C', 'c', 'I', 'i', 'E', 'e'
		);

		$res = DB::query('SELECT id, name1 FROM {shop_category} WHERE parent_id != "0"');
		while($s = DB::fetch_array($res))
		{
			$str = preg_replace('/W|Ь|ь|Ъ|ъ/i', '', $s['name1']);
			$str = str_replace($trans_table_lat, $trans_table_ru, $str);

			DB::query('UPDATE {shop_category} SET name_rus1 = "'.$str.'" WHERE id = "'.$s['id'].'"');
			# echo $str.'<br>';
		}
		*/
	}

	/**
	 * Выводит список категорий
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить категорию');
		$this->diafan->list_row();
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("shop_param_category_rel", "cat_id=".$del_id, $trash_id);
		$this->diafan->del_or_trash_where("shop_discount_object",    "cat_id=".$del_id, $trash_id);
	}
}