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
 * Shop_admin_importexport_element
 *
 * Импорт
 */
class Shop_admin_importexport_element extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'shop_import';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Название',
			),
			'type' => array(
				'type' => 'select',
				'name' => 'Тип',
			),
			'required' => array(
				'type' => 'checkbox',
				'name' => 'Выдавать ошибку, если значение не задано',
			),
			'params' => array(
				'type' => 'function',
				'name' => 'Дополнительные настройки',
			),
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
			'cat_id' => array(
				'type' => 'select',
				'name' => 'Категория',
			),
			'js' => array(
				'type' => 'function',
				'no_save' => true,
			),
		),
		'other_rows' => array (
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'element', // используются группы
		'trash', // использовать корзину
		'order', // сортируется
		'category_flat', // категори не содержат вложенности
		'category_no_multilang', // имя категории не переводиться
	);

	/**
	 * @var array значения списков
	 */
	public $select_arr = array(
		'type' => array(
			'id' => 'Идентификатор (уникальный код)',
			'name' => 'Название',
			'article' => 'Артикул',
			'anons' => 'Анонс',
			'text' => 'Текст',
			'keywords' => 'Ключевые слова, тэг Keywords',
			'descr' => 'Описание, тэг Description',
			'title_meta' => 'Заголовок окна в браузере, тэг Title',
			'price' => 'Цена',
			'count' => 'Количество',
			'cats' => 'Категория',
			'empty' => 'Пропуск',
			'parent' => 'Родитель',
			'param' => 'Дополнительная характеристика',
			'images' => 'Имена изображений',
			'rel_goods' => 'Идентификаторы связанных товаров',
			'no_buy' => 'Товар временно отсутствует',
			'act' => 'Показывать на сайте',
			'rewrite' => 'Псевдоссылка',
			'menu' => 'Отображать в меню',
			'hit' => 'Поле "Хит"',
			'new' => 'Поле "Новинка"',
			'action' => 'Поле "Акция"',
			'is_file' => 'Товар является файлом',
			'show_yandex' => 'Выгружать в Яндекс Маркет',
			'yandex' => 'Значения полей для Яндекс Маркета',
			'access' => 'Доступ',
			'map_no_show' => 'Не показывать элемент на карте сайта',
			'sort' => 'Номер для сортировки',
			'admin_id' => 'Редактор',
			'theme' => 'Шаблон сайта',
			'view' => 'Шаблон модуля (modules/shop/views/shop.view.шаблон.php)',
			'date_start' => 'Дата и время начала показа',
			'date_finish' => 'Дата и время окончания показа',
		),
		'type_cat' => array(
			'id' => 'category,good',
			'name' => 'category,good',
			'article' => 'good',
			'anons' => 'category,good',
			'text' => 'category,good',
			'keywords' => 'category,good',
			'descr' => 'category,good',
			'title_meta' => 'category,good',
			'price' => 'good',
			'count' => 'good',
			'cats' => 'good',
			'empty' => 'category,good',
			'parent' => 'category',
			'param' => 'good',
			'images' => 'category,good',
			'rel_goods' => 'good',
			'no_buy' => 'good',
			'act' => 'category,good',
			'rewrite' => 'category,good',
			'menu' => 'category',
			'hit' => 'good',
			'new' => 'good',
			'action' => 'good',
			'is_file' => 'good',
			'show_yandex' => 'category,good',
			'yandex' => 'good',
			'access' => 'category,good',
			'map_no_show' => 'category,good',
			'sort' => 'category,good',
			'admin_id' => 'category,good',
			'theme' => 'category,good',
			'view' => 'category,good',
			'date_start' => 'good',
			'date_finish' => 'good',
		),
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function show_import()
	{
		if ( ! empty($_POST["upload"]) || ! empty($_GET["upload"]))
		{
			Customization::inc('modules/shop/admin/shop.admin.import.php');
			$shop_admin_import = new Shop_admin_import($this->diafan);
			$shop_admin_import->upload();
		}
		elseif ( ! empty($_POST['action']))//опереации с импортированными элементами
		{
			Customization::inc('modules/shop/admin/shop.admin.import.php');
			$shop_admin_import = new Shop_admin_import($this->diafan);
			switch ($_POST['action'])
			{
				case 'act_import':
					$shop_admin_import->act(true);
					exit;
					break;

				case 'deact_import':
					$shop_admin_import->act(false);
					exit;
					break;

				case 'remove_import':
					$shop_admin_import->remove();
					exit;
					break;
			}
		}
	}

	/**
	 * Выводит список сообщений
	 * @return void
	 */
	public function show()
	{
		$this->show_import();
		if (DB::query_result("SELECT id FROM {shop_import} WHERE cat_id=%d AND trash='0' LIMIT 1", $this->diafan->cat))
		{
			echo '
			<div class="block">
				Внимание! Перед импортом создайте резервную копию базы данных на случай неудачного импорта.
				В импортируемой таблице должны быть колонки с данными о товарах/категориях в том порядке, который указан ниже.
				<hr>
				<form action="" enctype="multipart/form-data" method="post">
				<input type="hidden" name="upload" value="true">
				<input type="file" name="file">
				<input type="submit" value="'.$this->diafan->_('Отправить').'" class="button">
				<br>'.$this->diafan->_('Тип файла для импорта - CSV').'
				</form>';

			$import = DB::fetch_array(DB::query("SELECT * FROM {shop_import_category} WHERE id=%d LIMIT 1", $this->diafan->cat));
			$where = '';
			if($import["type"] != 'category' && $import["cat_id"])
			{
				$where .= " AND cat_id=".$import["cat_id"];
			}

			$act_import = DB::query_result("SELECT id FROM {shop".($import["type"] == 'category' ? '_category' : '')."} WHERE import='1' AND [act]='0' AND site_id=%d ".$where." LIMIT 1", $import["site_id"]);
			$deact_import = DB::query_result("SELECT id FROM {shop".($import["type"] == 'category' ? '_category' : '')."} WHERE import='1' AND [act]='1' AND site_id=%d ".$where." LIMIT 1", $import["site_id"]);
	
			if($act_import || $deact_import)
			{
				echo '
				<script type="text/javascript" src="'.BASE_PATH.'modules/shop/admin/shop.admin.importexport.element.js"></script>
				<br>
				<form method="post" action="'.URL.'">
				<input type="hidden" value="" name="action">
				Результаты последнего импорта: &nbsp; &nbsp;';
				if($act_import)
				{
					echo '<input type="submit" class="button shop_import_button" rel="act_import" value="'.$this->diafan->_('Показать на сайте').'" > &nbsp; &nbsp;';
				}
				if($deact_import)
				{
					echo '<input type="submit" class="button shop_import_button" rel="deact_import" value="'.$this->diafan->_('Скрыть на сайте').'" > &nbsp; &nbsp;';
				}
				echo '<input type="submit" class="button shop_import_button" rel="remove_import" value="'
			   .$this->diafan->_('Удалить').'" >
				</form>';
			}
			echo '</div>';
			echo '
			<div class="block"><b><a href="'.str_replace('/'.ADMIN_FOLDER, '', BASE_PATH_HREF).'shop/export/'.$this->diafan->cat.'/">'.$this->diafan->_('Экспорт в формат CSV').'</a></b>
			'.$this->diafan->_('Если у Вас есть на сайте товары, Вы можете скачать это файл как пример для импорта.').'</div>';
		}

		$this->diafan->addnew_init('Добавить поле');

		$this->diafan->list_row($this->diafan->cat);
	}

	/**
	 * Редактирование поля "JS"
	 * @return void
	 */
	public function edit_variable_js()
	{
		echo '<script type="text/javascript" src="'.BASE_PATH.'modules/shop/admin/shop.admin.importexport.element.js"></script>';
	}

	/**
	 * Редактирование поля "Тип"
	 * @return void
	 */
	public function edit_variable_type()
	{
		echo '
		<tr id="type">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				<select name="type">';
				foreach ($this->diafan->select_arr('type') as $key => $value)
				{
					echo '<option value="'.$key.'"'.($this->diafan->value == $key ? ' selected' : '');
					$type = $this->diafan->select_arr('type_cat', $key);
					if(strpos($type, 'good') !== false)
					{
						echo ' good="true"';
					}
					if(strpos($type, 'category') !== false)
					{
						echo ' category="true"';
					}
					echo '>'.$value.'</option>';
				}
				echo '</select>
				'.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Параметры"
	 * @return void
	 */
	public function edit_variable_params()
	{
		$type = '';
		if(! $this->diafan->addnew)
		{
			$params = unserialize($this->diafan->value);
			$type = $this->diafan->values["type"];
		}

		// меню
		echo '
		<tr id="param_menu_id" class="params param_menu">
			<td class="td_first">'.$this->diafan->_('Категория меню').'</td>
			<td>';
		$result = DB::query("SELECT id, [name] FROM {menu_category} WHERE trash='0' ORDER BY id ASC");
		if (DB::num_rows($result) > 0)
		{
			echo '<select name="param_menu_id">';
			echo '<option value="0">-</option>';
			while ($row = DB::fetch_array($result))
			{
				echo '<option value="'.$row["id"].'"'
				.($type == 'menu' && ! empty($params["id"]) && $params["id"] == $row["id"] ? ' selected="selected" ' : '' )
				.'>'.$row["name"].'</option>';
			}
			echo '</select>';
		}
		echo '
			</td>
		</tr>';

		// дополнительная характеристика
		$param_select_type = $type == 'param' && ! empty($params["select_type"]) ? $params["select_type"] : '';
		echo '
		<tr id="param_id" class="params param_param">
			<td class="td_first">'.$this->diafan->_('Характеристика').'</td>
			<td>';
		$result = DB::query("SELECT id, [name], type FROM {shop_param} WHERE trash='0' ORDER BY id ASC");
		if (DB::num_rows($result) > 0)
		{
			echo '<select name="param_id">';
			echo '<option value="0">-</option>';
			while ($row = DB::fetch_array($result))
			{
				echo '<option value="'.$row["id"].'"'
				.($type == 'param' && ! empty($params["id"]) && $params["id"] == $row["id"] ? ' selected="selected" ' : '' )
				.' type="'.$row["type"].'">'.$row["name"].'</option>';
			}
			echo '</select>';
		}
		echo '
			</td>
		</tr>
		<tr id="param_select_type" class="params param_param">
			<td class="td_first">'.$this->diafan->_('Значения списка').'</td>
			<td><select name="param_select_type">
			<option value="key"'.($param_select_type == 'key' ? ' selected' : '').'>'.$this->diafan->_('номер').'</option>
			<option value="value"'.($param_select_type == 'value' ? ' selected' : '').'>'.$this->diafan->_('название').'</option>
			</select>
			</td>
		</tr>';

		// цена, количество
		$param_delimitor = ($type == 'price' || $type == 'count') && ! empty($params["delimitor"]) ? $params["delimitor"] : '&';
		$param_select_type = ($type == 'price' || $type == 'count') && ! empty($params["select_type"]) ? $params["select_type"] : '';
		$param_count = $type == 'price' && ! empty($params["count"]) ? $params["count"] : '';
		$param_currency = $type == 'price' && ! empty($params["currency"]) ? $params["currency"] : '';
		$param_select_currency = $type == 'price' && ! empty($params["select_currency"]) ? $params["select_currency"] : '';
		echo '
		<tr id="param_delimitor" class="params param_price param_count">
			<td class="td_first">'.$this->diafan->_('Разделитель параметров, влияющих на цену, количества и валюты в пределах одного значения цены/количества').'</td>
			<td>
				<input name="param_delimitor" type="text" value="'.$param_delimitor.'" size="20">
			</td>
		</tr>
		<tr id="param_price_select_type" class="params param_price param_count">
			<td class="td_first">'.$this->diafan->_('Значения параметров, влияющих на цену').'</td>
			<td><select name="param_price_select_type">
			<option value="key"'.($param_select_type == 'key' ? ' selected' : '').'>'.$this->diafan->_('номер').'</option>
			<option value="value"'.($param_select_type == 'value' ? ' selected' : '').'>'.$this->diafan->_('название').'</option>
			</select>
			</td>
		</tr>
		<tr id="param_count" class="params param_price">
			<td class="td_first">'.$this->diafan->_('Указывать количество').'</td>
			<td><input name="param_count" value="1" type="checkbox"'.($param_count ? ' checked' : '').'>
			</td>
		</tr>
		<tr id="param_currency" class="params param_price">
			<td class="td_first">'.$this->diafan->_('Указывать валюту').'</td>
			<td><input name="param_currency" value="1" type="checkbox"'.($param_currency ? ' checked' : '').'>
			</td>
		</tr>
		<tr id="param_select_currency" class="params param_price">
			<td class="td_first">'.$this->diafan->_('Значение валюты').'</td>
			<td><select name="param_select_currency">
			<option value="key"'.($param_select_currency == 'key' ? ' selected' : '').'>'.$this->diafan->_('номер').'</option>
			<option value="value"'.($param_select_currency == 'value' ? ' selected' : '').'>'.$this->diafan->_('название').'</option>
			</select>
			</td>
		</tr>';

		// id,  rel_goods
		$param_type = (in_array($type, array('id', 'rel_goods')) && ! empty($params["type"]) ? $params["type"] : '');
		echo '
		<tr id="param_type" class="params param_id param_rel_goods">
			<td class="td_first">'.$this->diafan->_('Использовать в качестве идентификаторов').'</td>
			<td>
				<select name="param_type">
				<option value=""'.(! $param_type ? ' selected' : '').'>'.$this->diafan->_('собственное значение').'</option>
				<option value="site"'.($param_type == 'site' ? ' selected' : '').'>'.$this->diafan->_('идентификатор на сайте').'</option>
				<option value="article"'.($param_type == 'article' ? ' selected' : '').'>'.$this->diafan->_('артикул').'</option>
				</select>
			</td>
		</tr>';

		// parent, cats
		$param_type = (in_array($type, array('cats', 'parent')) && ! empty($params["type"]) ? $params["type"] : '');
		echo '
		<tr id="param_cats_type" class="params param_cats param_parent">
			<td class="td_first">'.$this->diafan->_('Использовать в качестве идентификаторов').'</td>
			<td>
				<select name="param_cats_type">
				<option value=""'.(! $param_type ? ' selected' : '').'>'.$this->diafan->_('собственное значение').'</option>
				<option value="site"'.($param_type == 'site' ? ' selected' : '').'>'.$this->diafan->_('идентификатор на сайте').'</option>
				<option value="name"'.($param_type == 'name' ? ' selected' : '').'>'.$this->diafan->_('название').'</option>
				</select>
			</td>
		</tr>';

		// date_start, date_finish
		$date_start = (in_array($type, array('date_start', 'date_finish')) && ! empty($params["date_start"]) ? $params["date_start"] : '');
		$date_finish = (in_array($type, array('date_start', 'date_finish')) && ! empty($params["date_finish"]) ? $params["date_finish"] : '');
		echo '
		<tr id="param_date_start" class="params param_date_start param_date_finish">
			<td class="td_first">'.$this->diafan->_('Диапазон значений').'</td>
			<td>
				<input type="text" name="param_date_start" size="20" value="'
				.($date_start ? date("d.m.Y H:i", $date_start) : '')
				.'" class="timecalendar" showTime="true">
				-
				<input type="text" name="param_date_finish" size="20" value="'
				.($date_finish ? date("d.m.Y H:i", $date_finish) : '')
				.'" class="timecalendar" showTime="true">
			</td>
		</tr>';

		// изображения
		echo '
		<tr id="param_directory" class="params param_images">
			<td class="td_first">'.$this->diafan->_('Папка с изображениями для загрузки (относительно корня сайта)').'</td>
			<td>
				<input name="param_directory" type="text" value="'.($type == 'images' && ! empty($params["directory"]) ? $params["directory"] : '').'" size="40">
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Категория"
	 * @return void
	 */
	public function edit_variable_cat_id()
	{
		$options = array();
		$result = DB::query("SELECT id, name, type FROM {shop_import_category} WHERE trash='0'");
		while($row = DB::fetch_array($result))
		{
			$options[] = $row;
		}
		if(! $this->diafan->value)
		{
			$this->diafan->value = $this->diafan->cat;
		}
		echo '
		<tr id="cat_id">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				<select name="cat_id">';
				foreach ($options as $row)
				{
					echo '<option value="'.$row["id"].'"'.($this->diafan->value == $row["id"] ? ' selected' : '').' type="'.$row["type"].'">'.$row["name"].'</option>';
				}
				echo '</select>
				'.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Валидация поля "Тип"
	 * @return void
	 */
	public function validate_variable_type()
	{
		if($_POST["type"] == 'menu' || $_POST["type"] == 'param' || $_POST["type"] == 'empty')
		{
			return;
		}
		if($id = DB::query_result("SELECT id FROM {shop_import} WHERE cat_id=%d AND type='%h' LIMIT 1", $this->diafan->cat, $_POST["type"]))
		{
			if($this->diafan->addnew || $id != $this->diafan->edit)
			{
				$this->diafan->set_error('param_type', 'Поле с такими настройками уже существует');
			}
		}
	}

	/**
	 * Валидация поля "Параметры"
	 * @return void
	 */
	public function validate_variable_params()
	{
		switch($_POST["type"])
		{
			case 'menu':
				if(! $_POST["param_menu_id"])
				{
					$this->diafan->set_error('param_menu_id', 'Выберите категорию меню');
				}
				else
				{
					$params = array("id" => $this->diafan->get_param($_POST, "param_menu_id", 0, 2));
					if($id = DB::query_result("SELECT id FROM {shop_import} WHERE cat_id=%d AND type='menu' AND params='%s' LIMIT 1", $this->diafan->cat, serialize($params)))
					{
						if($this->diafan->addnew || $id != $this->diafan->edit)
						{
							$this->diafan->set_error('param_menu_id', 'Поле с такими настройками уже существует');
						}
					}
				}
				break;

			case 'param':
				if(! $_POST["param_id"])
				{
					$this->diafan->set_error('param_id', 'Выберите характеристику');
				}
				else
				{
					$params = array("id" => $this->diafan->get_param($_POST, "param_id", 0, 2));
					if($id = DB::query_result("SELECT id FROM {shop_import} WHERE cat_id=%d AND type='param' AND params='%s' LIMIT 1", $this->diafan->cat, serialize($params)))
					{
						if($this->diafan->addnew || $id != $this->diafan->edit)
						{
							$this->diafan->set_error('param_id', 'Поле с такими настройками уже существует');
						}
					}
				}
				break;

			case 'date_start':
			case 'date_finish':
				$params = array();
				if(! empty($_POST["param_date_start"]))
				{
					$this->diafan->set_error('param_date_start', Validate::datetime($_POST["param_date_start"]));
				}
				if(! empty($_POST["param_date_finish"]))
				{
					$this->diafan->set_error('param_date_start', Validate::datetime($_POST["param_date_finish"]));
				}
				break;

			case 'images':
				if(empty($_POST["param_directory"]))
				{
					$this->diafan->set_error('param_directory', 'Задайте папку с изображениями');
				}
				break;
		}
	}

	/**
	 * Сохранение поля "Параметры"
	 * @return void
	 */
	public function save_variable_params()
	{
		switch($_POST["type"])
		{
			case 'menu':
				$params = array("id" => $this->diafan->get_param($_POST, "param_menu_id", 0, 2));
				break;

			case 'param':
				$params = array(
						"id" => $this->diafan->get_param($_POST, "param_id", 0, 2),
						"select_type" => $_POST["param_select_type"] == 'key' ? 'key' : 'value',
					);
				break;

			case 'price':
				$params = array(
						"delimitor" => $this->diafan->get_param($_POST, "param_delimitor", 0, 1),
						"select_type" => $_POST["param_price_select_type"] == 'key' ? 'key' : 'value',
						"count" => ! empty($_POST["param_count"]) ? 1 : 0,
						"currency" => ! empty($_POST["param_currency"]) ? 1 : 0,
						"select_currency" => $_POST["param_select_currency"] == 'key' ? 'key' : 'value'
					);
				break;

			case 'count':
				$params = array(
						"delimitor" => $this->diafan->get_param($_POST, "param_delimitor", 0, 1),
						"select_type" => $_POST["param_price_select_type"] == 'key' ? 'key' : 'value'
					);
				break;

			case 'id':
			case 'rel_goods':
				$params = array("type" => in_array($_POST["param_type"], array('site', 'article')) ? $_POST["param_type"] : '');
				break;

			case 'cats':
			case 'parent':
				$params = array("type" => in_array($_POST["param_cats_type"], array('site', 'name'))  ? $_POST["param_cats_type"] : '');
				break;

			case 'date_start':
			case 'date_finish':
				$params = array();
				if(! empty($_POST["param_date_start"]))
				{
					$params["date_start"] = $this->diafan->unixdate($_POST["param_date_start"]);
				}
				if(! empty($_POST["param_date_finish"]))
				{
					$params["date_finish"] = $this->diafan->unixdate($_POST["param_date_finish"]);
				}
				break;

			case 'images':
				$params = array('directory' => strip_tags($_POST["param_directory"]));
				break;
		}
		if(empty($params))
		{
			$params = '';
		}
		else
		{
			$params = serialize($params);
		}
		$this->diafan->set_query("params='%s'");
		$this->diafan->set_value($params);
	}
}