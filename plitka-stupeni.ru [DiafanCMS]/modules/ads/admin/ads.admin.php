<?php

/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if ( ! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Ads_admin
 *
 * Редактирование объявлений
 */
class Ads_admin extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'ads';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Заголовок',
				'multilang' => true,
			),
			'created' => array(
				'type' => 'datetime',
				'name' => 'Дата создания',
				'help' => 'Вводится в формате дд.мм.гггг чч:мм',
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'help' => 'Если не отмечена, объявление не будет видено на сайте',
				'default' => true,
				'multilang' => true,
			),
			'hr1' => 'hr',
			'counter_view' => array(
				'type' => 'function',
				'name' => 'Счетчик просмотров',
				'no_save' => true,
			),
			'rating' => array(
				'type' => 'module',
			),
			'comments' => array(
				'type' => 'module',
			),
			'images' => array(
				'type' => 'module',
				'name' => 'Изображения',
			),
			'hr4' => 'hr',
			'param' => array(
				'type' => 'function',
				'multilang' => true,
			),
			'hr5' => 'hr',
			'rel_elements' => array(
				'type' => 'function',
				'name' => 'Похожие объявления',
			),
			'hr6' => 'hr',
			'cat_id' => array(
				'type' => 'function',
				'name' => 'Категория',
			),
			'site_id' => array(
				'type' => 'function',
				'name' => 'Раздел сайта',
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
			'search' => array(
				'type' => 'module',
			),
		),
		'other_rows' => array (
			'tags' => array(
				'type' => 'module',
			),
			'hr7' => 'hr',
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
			'user_id' => array(
				'type' => 'function',
				'name' => 'Автор',
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
			'date_start' => array(
				'type' => 'date',
				'name' => 'Период показа',
			),
			'date_finish' => array(
				'type' => 'date',
			),
			'access' => array(
				'type' => 'function',
				'name' => 'Доступ',
			),
			'hr_period' => 'hr',
			'prior' => array(
				'type' => 'checkbox',
				'name' => 'Важно (всегда сверху)',
				'help' => 'Если отмечена, новость выведется в начале списка, независимо от сортировки по дате',
			),
			'map_no_show' => array(
				'type' => 'checkbox',
				'name' => 'Не показывать на карте сайта',
			),
			'hr8' => 'hr',
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
		'datetime', // показывать дату в списке, сортировать по дате
		'prior', // сортировать по полю приоритет
		'element_site', // делит элементы по разделам (страницы сайта, к которым прикреплен модуль)
		'element', // используются группы
		'element_multiple', // модуль может быть прикреплен к нескольким группам
		'search_name', // скать по названию
		'trash', // использовать корзину
		'image', // показать фотографию в списке
		'only_self', // показывать только материалы редактора, если это задано в правах пользователя
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array (
		'text' => 'text',
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		if(! $this->diafan->configmodules("cat", "ads", $this->diafan->site))
		{
			$this->diafan->config("element", false);
			$this->diafan->config("element_multiple", false);
		}
	}

	/**
	 * Выводит список объявлений
	 * @return void
	 */
	public function show()
	{
		echo '<script type="text/javascript" src="'.BASE_PATH.'modules/ads/admin/ads.admin.js"></script>';

		if ($this->diafan->config('element') && ! $this->diafan->not_empty_categories)
		{
			echo '<div class="error">'.sprintf($this->diafan->_('В %sнастройках%s модуля подключены категории, чтобы начать добавлять объявление создайте хотя бы одну %sкатегорию%s.'),'<a href="'.BASE_PATH_HREF.'ads/config/">', '</a>', '<a href="'.BASE_PATH_HREF.'ads/category/'.($this->diafan->site ? 'site'.$this->diafan->site.'/' : '').'">', '</a>').'</div>';
		}
		else
		{
			$this->diafan->addnew_init('Добавить объявление');
		}

		$this->diafan->list_row();
	}

	/**
	 * Редактирование поля "Дополнительные параметры"
	 *
	 * @return void
	 */
	public function edit_variable_param()
	{
		echo '<script type="text/javascript" src="'.BASE_PATH.'modules/ads/admin/ads.admin.js"></script>';

		//значения характеристик
		$values = array();
		$rvalues = array();
		if (! $this->diafan->addnew)
		{
			$result_el = DB::query("SELECT value".$this->diafan->language_base_site." as rv, [value], param_id FROM {ads_param_element} WHERE element_id=%d", $this->diafan->edit);
			while ($row_el = DB::fetch_array($result_el))
			{
				$values[$row_el["param_id"]][] = $row_el["value"];
				$rvalues[$row_el["param_id"]][] = $row_el["rv"];
			}
		}

		// выбирает все характеристики (при смене раздела/категории просто показываем или скрываем характеристики)
		$result = DB::query("SELECT id, [name], type, [measure_unit], [text], config FROM {ads_param} WHERE trash='0' ORDER BY sort ASC");
		$params = array();
		while ($row = DB::fetch_array($result))
		{
			// выбирает категории, к которым прикреплена характеристика
			$row["cats"] = array();
			$result_rel = DB::query("SELECT cat_id FROM {ads_param_category_rel} WHERE element_id=%d", $row["id"]);
			while ($row_rel = DB::fetch_array($result_rel))
			{
				$attr = 'cat'.$row_rel["cat_id"].'="true"';
				if(!in_array($attr, $row["cats"]))
				{
					$row["cats"][] = $attr;
				}
			}
			// значения списков
			$row["options"] = array();
			if (in_array($row["type"], array('select', 'multiple')))
			{
				$result_select = DB::query("SELECT [name], id FROM {ads_param_select} WHERE param_id=%d ORDER BY sort ASC", $row["id"]);
				while ($row_select = DB::fetch_array($result_select))
				{
					$row["options"][] = $row_select;
				}
			}
			$params[] = $row;
		}
		foreach ($params as $row)
		{
			$attr = ' class="ads_param" '.implode(" ", $row["cats"]);

			$help = $this->diafan->help($row["text"]);
			switch($row["type"])
			{
				case 'title':
					$this->diafan->show_table_tr_title("param".$row["id"], $row["name"], $help, $attr);
					break;
	
				case 'text':
					$value = (! empty($values[$row["id"]]) ? $values[$row["id"]][0] : '');
					$this->diafan->show_table_tr_text("param".$row["id"], $row["name"], $value, $help, false, $attr);
					break;
	
				case 'textarea':
					$value = (! empty($values[$row["id"]]) ? $values[$row["id"]][0] : '');
					$this->diafan->show_table_tr_textarea("param".$row["id"], $row["name"], $value, $help, false, $attr);
					break;
	
				case 'email':
					$value = (! empty($rvalues[$row["id"]]) ? $rvalues[$row["id"]][0] : '');
					$this->diafan->show_table_tr_email("param".$row["id"], $row["name"], $value, $help, false, $attr);
					break;
	
				case 'date':
					$value = (! empty($rvalues[$row["id"]]) ? $this->diafan->unixdate($this->diafan->formate_from_date($rvalues[$row["id"]][0])) : '');
					$this->diafan->show_table_tr_date("param".$row["id"], $row["name"], $value, $help, false, $attr);
					break;
	
				case 'datetime':
					$value = (! empty($rvalues[$row["id"]]) ? $this->diafan->unixdate($this->diafan->formate_from_datetime($rvalues[$row["id"]][0])) : '');
					$this->diafan->show_table_tr_datetime("param".$row["id"], $row["name"], $value, $help, false, $attr);
					break;
	
				case 'numtext':
					$value = (! empty($rvalues[$row["id"]]) ? $rvalues[$row["id"]][0] : 0);
					$this->diafan->show_table_tr_numtext("param".$row["id"], $row["name"], $value, $help, false, $attr);
					break;
	
				case 'floattext':
					$value = (! empty($rvalues[$row["id"]]) ? $rvalues[$row["id"]][0] : 0);
					$this->diafan->show_table_tr_floattext("param".$row["id"], $row["name"], $value, $help, false, $attr);
					break;
	
				case 'checkbox':
					$value = (! empty($rvalues[$row["id"]]) ? $rvalues[$row["id"]][0] : 0);
					$this->diafan->show_table_tr_checkbox("param".$row["id"], $row["name"], $value, $help, false, $attr);
					break;
	
				case 'select':
					$value = (! empty($rvalues[$row["id"]]) ? $rvalues[$row["id"]][0] : 0);
					$this->diafan->show_table_tr_select_arr("param".$row["id"], $row["name"], $value, $help, false, $row["options"], $attr);
					break;
	
				case 'multiple':
					$value = (! empty($rvalues[$row["id"]]) ? $rvalues[$row["id"]] : array());
					$this->show_table_tr_multiple_param($row["id"], $row["name"], $value, $help, $row["required"], $row["options"], $depend_price, $attr);
					break;
	
				case 'attachments':
					Customization::inc('modules/attachments/admin/attachments.admin.inc.php');
					$attachment = new Attachments_admin_inc($this->diafan);
					$attachment->edit_param($row["id"], $row["name"], $row["text"], $row["config"], $attr);
					break;

				case 'images':
					Customization::inc('modules/images/admin/images.admin.inc.php');
					$images = new Images_admin_inc($this->diafan);
					$images->edit_param($row["id"], $row["name"], $row["text"], $attr);
					break;
			}
		}
	}

	/**
	 * Сохранение поля "Дополнительные параметры"
	 *
	 * @return void
	 */
	public function save_variable_param()
	{
		if ( ! $this->diafan->save_site_id)
		{
			$this->diafan->get_site_id();
		}
		$ids = array();
		$cats = array(0);
		$lang = $this->diafan->language_base_site;
		if($_POST["cat_id"])
		{
			$cats[] = intval($_POST["cat_id"]);
		}
		if(! empty($_POST["cat_ids"]))
		{
			foreach($_POST["cat_ids"] as $id)
			{
				$cats[] = intval($id);
			}
		}
		$result = DB::query("SELECT p.id, p.type, p.config FROM {ads_param} as p "
						. " INNER JOIN {ads_param_category_rel} as cp ON cp.element_id=p.id "
						. ($this->diafan->configmodules("cat", "ads", $this->diafan->save_site_id) && ! empty($cats) ?
							" AND  cp.cat_id IN (".implode(",", $cats).") " : "")
						. " WHERE p.trash='0' GROUP BY p.id ORDER BY p.sort ASC");
		while ($row = DB::fetch_array($result))
		{
			if($row["type"] == 'attachments')
			{
				Customization::inc('modules/attachments/admin/attachments.admin.inc.php');
				$attachment = new Attachments_admin_inc($this->diafan);
				$attachment->save_param($row["id"], $row["config"]);
				continue;
			}

			$id_param = DB::query_result("SELECT id FROM {ads_param_element} WHERE param_id=%d AND element_id=%d LIMIT 1", $row["id"], $this->diafan->save);


			if ( ! empty($_POST['param'.$row["id"]]))
			{
				switch($row["type"])
				{
					case "date":
						$_POST['param'.$row["id"]] = $this->diafan->formate_in_date($_POST['param'.$row["id"]]);
						break;

					case "datetime":
						$_POST['param'.$row["id"]] = $this->diafan->formate_in_datetime($_POST['param'.$row["id"]]);
						break;

					case "editor":
						$_POST['param'.$row["id"]] = $this->diafan->save_field_editor('param'.$row["id"]);
						break;

					case "numtext":
						$_POST['param' . $row["id"]] = str_replace(',', '.', $_POST['param' . $row["id"]]);
						break;
				}

				switch($row["type"])
				{
					case "multiple":
						if(is_array($_POST['param'.$row["id"]]))
						{
							DB::query("DELETE FROM {ads_param_element} WHERE param_id=%d AND element_id=%d", $row["id"], $this->diafan->save);
							foreach ($_POST['param'.$row["id"]] as $v)
							{
								DB::query("INSERT INTO {ads_param_element} (value".$lang.", param_id, element_id) VALUES ('%d', %d, %d)", $v, $row["id"], $this->diafan->save);
							}
						}
						break;

					default:
						if (empty($id_param))
						{
							DB::query(
								"INSERT INTO {ads_param_element} (".(in_array($row["type"], array("text", "editor", "textarea")) ?
									'[value]' : 'value'.$lang)
								.", param_id, element_id) VALUES ('%s', %d, %d)", $_POST['param'.$row["id"]], $row["id"], $this->diafan->save
							);
						}
						else
						{
							DB::query(
								"UPDATE {ads_param_element} SET ".(in_array($row["type"], array("text", "editor", "textarea")) ?
									'[value]' : 'value'.$lang)
								." = '%s' WHERE param_id=%d AND element_id=%d", $_POST['param'.$row["id"]], $row["id"], $this->diafan->save
							);
						}
				}
			}
			else
			{
				DB::query("DELETE FROM {ads_param_element} WHERE param_id=%d AND element_id=%d", $row["id"], $this->diafan->save);
			}

			$ids[] = $row["id"];
		}

		DB::query("DELETE FROM {ads_param_element} WHERE".($ids ? " param_id NOT IN (".implode(", ", $ids).") AND" : "")." element_id=%d", $this->diafan->save);
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("ads_counter", "element_id=".$del_id, $trash_id);
		$this->diafan->del_or_trash_where("ads_rel", "element_id=".$del_id." OR rel_element_id=".$del_id, $trash_id);
		$this->diafan->del_or_trash_where("ads_param_element", "element_id=".$del_id, $trash_id);
	}
}
