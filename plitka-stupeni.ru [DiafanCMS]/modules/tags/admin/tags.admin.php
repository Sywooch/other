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
 * Tags_admin
 *
 * Редактирование тэгов
 */
class Tags_admin extends Frame_admin
{
    /**
     * @var string таблица в базе данных
     */
    public $table = 'tags_name';

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
			'rewrite' => array(
				'type' => 'function',
				'name' => 'Псевдоссылка',
				'help' => 'ЧПУ (человеко-понятные урл url), адрес страницы вида: site.ru/psewdossylka/. Смотрите настройки сайта',
			),
			'hr_map' => 'hr',
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
			'hr_map2' => 'hr',
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
			'map_no_show' => array(
				'type' => 'checkbox',
				'name' => 'Не показывать на карте сайта',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'trash', // использовать корзину
		'order', // сортируется
	);

	/**
	 * @var array локальный кэш модуля
	 */
	private $cache;

	/**
	 * Вывод списка тэгов
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить тег');
		$this->diafan->list_row();
	}

	/**
	 * Выводит объект, к которому прикреплен тэг, в списке
	 * 
	 * @return string
	 */
	public function other_row_element_id($row)
	{
		$name = DB::query_result("SELECT name FROM {".$row["module_name"]."} WHERE id=%d LIMIT 1", $row["element_id"]);
		return '</td><td>'.($name ? $name : $row["element_id"]);
	}

	/**
	 * Выводит название модуля в списке
	 * 
	 * @return string
	 */
	public function other_row_module_name($row)
	{
		if(empty($this->cache["modules"][$row["module_name"]]))
		{
			$this->cache["modules"][$row["module_name"]] = DB::query_result("SELECT title FROM {modules} WHERE name='%h' LIMIT 1", $row["module_name"]);
		}
		return '</td><td class="other_row">'.$this->cache["modules"][$row["module_name"]];
	}

	/**
	 * Сохранение поля "Псевдоссылка"
	 * @return void
	 */
	public function edit_variable_rewrite()
	{
		$this->diafan->values["site_id"] = DB::query_result("SELECT id FROM {site} WHERE module_name='tags' LIMIT 1");
		parent::__call('edit_variable_rewrite', array());
	}

	/**
	 * Сохранение поля "Псевдоссылка"
	 * @return void
	 */
	public function save_variable_rewrite()
	{
		$_POST["site_id"] = DB::query_result("SELECT id FROM {site} WHERE module_name='tags' LIMIT 1");
		parent::__call('save_variable_rewrite', array());
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("tags", "tags_name_id=".$del_id, $trash_id);
	}
}