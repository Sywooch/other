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
 * Clauses_admin
 *
 * Редактирование статей
 */
class Clauses_admin extends Frame_admin
{
    /**
     * @var string таблица в базе данных
     */
    public $table = 'clauses';

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
			'created' => array(
				'type' => 'date',
				'name' => 'Дата',
				'help' => 'Вводится в формате дд.мм.гггг чч:мм',
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'help' => 'Если не отмечена, статья на сайте не отображается',
				'default' => true,
				'multilang' => true,
			),
			'hr1' => 'hr',
			'images' => array(
				'type' => 'module',
				'name' => 'Изображения',
			),
			'hr2' => 'hr',
			'rel_elements' => array(
				'type' => 'function',
				'name' => 'Похожие статьи',
			),
			'hr3' => 'hr',
			'cat_id' => array(
				'type' => 'function',
				'name' => 'Категория',
			),
			'anons' => array(
				'type' => 'editor',
				'name' => 'Анонс',
				'help' => 'Небольшая вводная часть статьи, выводится в списках статей',
				'multilang' => true,
				'height' => 200,
			),
			'text' => array(
				'type' => 'editor',
				'name' => 'Описание',
				'multilang' => true,
			),
			'search' => array(
				'type' => 'module',
			),
		),
		'other_rows' => array (
			'tags' => array(
				'type' => 'module',
			),
			'hr3' => 'hr',
			'menu' => array(
				'type' => 'module',
				'name' => 'Создать пункт в меню',
			),
			'hr_menu' => 'hr',
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
			'hr_map2' => 'hr',
			'access' => array(
				'type' => 'function',
				'name' => 'Доступ',
			),
			'date_start' => array(
				'type' => 'date',
				'name' => 'Период показа',
			),
			'date_finish' => array(
				'type' => 'date',
			),
			'hr_period' => 'hr',
			'view' => array(
				'type' => 'none',
			),
			'prior' => array(
				'type' => 'checkbox',
				'name' => 'Важно (всегда сверху)',
				'help' => 'Если отмечена, статья выведется в начале списка, независимо от общей сортировки по дате',
			),
			'map_no_show' => array(
				'type' => 'checkbox',
				'name' => 'Не показывать на карте сайта',
			),
			'site_id' => array(
				'type' => 'function',
				'name' => 'Раздел сайта',
			),
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
			'hr4' => 'hr',
			'counter_view' => array(
				'type' => 'function',
				'name' => 'Счетчик просмотров',
				'no_save' => true,
			),
			'comments' => array(
				'type' => 'module',
			),
			'rating' => array(
				'type' => 'module',
			),
			'hr5' => 'hr',
			'theme' => array(
				'type' => 'function',
				'name' => 'Шаблон страницы',
			),
			'view' => array(
				'type' => 'function',
				'name' => 'Шаблон модуля',
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
		'act', // показать/скрыть
		'menu', // используется в меню
		'del', // удалить
		'prior', // сортировать по полю приоритет
		'order', // сортируется
		'element_site', // делит элементы по разделам (страницы сайта, к которым прикреплен модуль)
		'element', // используются группы
		'element_multiple', // модуль может быть прикреплен к нескольким группам
		'search_name', // скать по названию
		'trash', // использовать корзину
		'only_self', // показывать только материалы редактора, если это задано в правах пользователя
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array (
		'anons' => 'text',
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		if(! $this->diafan->configmodules("cat", "clauses", $this->diafan->site))
		{
			$this->diafan->config("element", false);
			$this->diafan->config("element_multiple", false);
		}
	}

	/**
	 * Выводит список статей
	 * @return void
	 */
	public function show()
	{
		if ($this->diafan->config('element') && ! $this->diafan->not_empty_categories)
		{
			echo '<div class="error">'.sprintf($this->diafan->_('В %sнастройках%s модуля подключены категории, чтобы начать добавлять статью создайте хотя бы одну %sкатегорию%s.'), '<a href="'.BASE_PATH_HREF.'clauses/config/">', '</a>','<a href="'.BASE_PATH_HREF.'clauses/category/'.($this->diafan->site ? 'site'.$this->diafan->site.'/' : '').'">', '</a>').'</div>';
		}
		else
		{
			$this->diafan->addnew_init('Добавить статью');
		}
	
		$this->diafan->list_row();
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("clauses_rel", "element_id=".$del_id." OR rel_element_id=".$del_id, $trash_id);
		$this->diafan->del_or_trash_where("clauses_counter", "element_id=".$del_id, $trash_id);
	}
}