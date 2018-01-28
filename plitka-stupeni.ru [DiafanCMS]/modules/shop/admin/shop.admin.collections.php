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
//echo "ffffff";
/**
 * Shop_admin
 *
 * Редактирование товаров
 */
class Shop_admin_collections extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'shop';
	
	public $where = " AND e.cat_id != '8'";
	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Название',
				'help' => 'Название товара',
				'multilang' => true,
			),
			'name_rus' => array(
				'type' => 'text',
				'name' => 'Название (рус.)',
				'multilang' => true,
			),
			'price' => array(
				'type' => 'floattext',
				'name' => 'Цена',
				'no_save' => true,
			),
			'article' => array(
				'type' => 'text',
				'name' => 'Артикул',
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'help' => 'Если не отмечена, товар не будет виден на сайте',
				'default' => true,
				'multilang' => true,
			),
			'no_buy' => array(
				'type' => 'checkbox',
				'name' => 'Товар временно отсутствует',
				'help' => 'Если отмечена, у товара не будет кнопки "Купить", а выведется сообщение "Товар временно отсутствует"',
			),
			'hr1' => 'hr',
			'hit' => array(
				'type' => 'checkbox',
				'name' => 'Хит',
			),
			'new' => array(
				'type' => 'checkbox',
				'name' => 'Новинка',
			),
			'action' => array(
				'type' => 'checkbox',
				'name' => 'Акция',
			),
			'hr3' => 'hr',
			'files' => array(
				'type' => 'function',
			),
			'images' => array(
				'type' => 'module',
				'name' => 'Изображения',
			),
			'hr4' => 'hr',
			'discounts' => array(
				'type' => 'function',
				'name' => 'Скидки',
			),
			'hr5' => 'hr',
			'param' => array(
				'type' => 'function',
				'name' => 'Характеристики',
				'multilang' => true,
			),
			'hr6' => 'hr',
			'elementos_sort' => array(			
				'type' => 'function',
				'name' => 'Сортировка товаров',
			),
			
			'hr7' => 'hr',
			'rel_elements' => array(
				'type' => 'function',
				'name' => 'Похожие товары',
			),
			'hr8' => 'hr',
			'cat_id' => array(
				'type' => 'function',
				'name' => 'Категория',
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
			'clone' => array(
				'type' => 'function',
				'name' => 'Клонирование товара',
				'no_save' => true,
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
			'site_id' => array(
				'type' => 'function',
				'name' => 'Раздел сайта',
			),
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
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
			'map_no_show' => array(
				'type' => 'checkbox',
				'name' => 'Не показывать на карте сайта',
			),
			'hr8' => 'hr',
			'show_yandex' => array(
				'type' => 'checkbox',
				'name' => 'Выгружать в Яндекс.Маркет',
			),
			'yandex' => array(
				'type' => 'function',
				'name' => 'Поля для Яндекс.Маркета',
			),
			'hr9' => 'hr',
			'import_id' => array(
				'type' => 'text',
				'name' => 'Идентификатор для импорта',
			),
			'hr10' => 'hr',
			'theme' => array(
				'type' => 'function',
				'name' => 'Шаблон страницы',
			),
			'view' => array(
				'type' => 'function',
				'name' => 'Шаблон модуля',
			),
			'hr4' => 'hr',
			'statistics' => array(
				'type' => 'function',
				'name' => 'Товар купили раз',
				'no_save' => true,
			),
			'comments' => array(
				'type' => 'module',
			),
			'rating' => array(
				'type' => 'module',
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
		'order', // сортируется
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
	 * @var array поля для быстрого редактирования в списке
	 */
	public $fast_edit_rows = array(
		'price' => 'function'
	);

	/**
	 * @var array зависимости между полями
	 */
	public $show_tr_click_checkbox = array(
		'show_yandex' => array(
			'yandex'
		)
	);

	/**
	 * @var array валюты
	 */
	private $currency;

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		if(! $this->diafan->configmodules("cat", "shop", $this->diafan->site))
		{
			$this->diafan->config("element", false);
			$this->diafan->config("element_multiple", false);
		}

		if ( ! $this->diafan->configmodules('show_yandex_element', 'shop'))
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

		$res = DB::query('SELECT id, name1 FROM {shop} WHERE cat_id != "8"');
		while($s = DB::fetch_array($res))
		{
			$str = preg_replace('/W|Ь|ь|Ъ|ъ/i', '', $s['name1']);
			$str = str_replace($trans_table_lat, $trans_table_ru, $str);

			DB::query('UPDATE {shop} SET name_rus1 = "'.$str.'" WHERE id = "'.$s['id'].'"');
			# echo $str.'<br>';
		}
		*/
	}
	
	/*public function other_row_name($row)
	{
		//return '<td>'.DB::query_result("SELECT name FROM {shop} ORDER BY name ASC",$row['name']).'</td>';
		return '<td>'.DB::query_result("SELECT name FROM {shop} WHERE name=%s",$row['name']).'</td>';
	}*/
	
	/**
	 * Выводит список товаров
	 * @return void
	 */
	public function show()
	{
		echo '<script type="text/javascript" src="'.BASE_PATH.'modules/shop/admin/shop.admin.js"></script>';

		if ($this->diafan->config('element') && ! $this->diafan->not_empty_categories)
		{
			echo '<div class="error">'.sprintf($this->diafan->_('В %sнастройках%s модуля подключены категории, чтобы начать добавлять товар создайте хотя бы одну %sкатегорию%s.'),'<a href="'.BASE_PATH_HREF.'shop/config/">', '</a>', '<a href="'.BASE_PATH_HREF.'shop/category/'.($this->diafan->site ? 'site'.$this->diafan->site.'/' : '').'">', '</a>').'</div>';
		}
		else
		{
			$this->diafan->addnew_init('Добавить товар');
		}
		
		$this->diafan->list_row();
	}

	/**
	 * Определяет строку с GET переменными
	 *
	 * @return void
	 */
	public function set_get_nav()
	{
		$get_nav_params = $this->diafan->get_nav_params;
		$get_nav_params["search_count"] = '';
		if (!empty( $_GET["search_name"] ))
		{
			$get_nav_params["search_name"] = $this->diafan->get_param($_GET, "search_name", '', 1);
			$this->diafan->get_nav .= ( $this->diafan->get_nav ? '&amp;' : '?' ).'search_name='.$get_nav_params["search_name"];
			$this->diafan->where .= " AND ([name] LIKE '%%".str_replace(array("'", "%"), array("\\'", "%%"), $get_nav_params["search_name"])."%%' OR article LIKE '%%".str_replace(array("'", "%"), array("\\'", "%%"), $get_nav_params["search_name"])."%%')";
		}
		if (!empty( $_GET["no_buy"] ))
		{
			$get_nav_params["no_buy"] = '1';
			$this->diafan->get_nav .= ( $this->diafan->get_nav ? '&amp;' : '?' ).'no_buy=1';
			$this->diafan->where .= " AND no_buy='1'";
		}
		$this->diafan->get_nav_params = $get_nav_params;
	}

	/**
	 * Поиск
	 *
	 * @return boolean
	 */
	public function show_search()
	{
		$html = '
		<form action="'.BASE_PATH_HREF.$this->diafan->rewrite.'/'.( $this->diafan->cat ? 'cat'.$this->diafan->cat.'/' : '' ).'" method="GET">
		'.$this->diafan->_('Название').': <input type="text" name="search_name" value="'.(! empty($this->diafan->get_nav_params["search_name"]) ? $this->diafan->get_nav_params["search_name"] : '' ).'" size="20">
		'.$this->diafan->_('Товар временно отсутствует').': <input name="no_buy" value="1" type="checkbox"'.(! empty($this->diafan->get_nav_params["no_buy"]) ? ' checked' : '').'>
		<input type="submit" class="button" value="'.$this->diafan->_('Найти').'">
		</form>';

		return $html;
	}

	/**
	 * Функция быстрого редактирования цены товаров в списке
	 * @return void
	 */
	public function fast_row_price($item)
	{
		$rows = $this->diafan->_shop->price_get_base($item["id"]);
		$num_decimal_places = $this->diafan->configmodules("format_price_1", "shop", $item["site_id"]);

		echo '</td><td class="fast_edit fast_edit_price">';
		foreach($rows as $row)
		{
			echo '<input type="text" row_id="'.$row['id'].'" name="price" value="'.number_format($row["price"], $num_decimal_places, ',', '').'" size="3"> '.$row['currency_name'];
			if(count($rows) > 1)
			{
				if($rows[0] == $row)
				{
					echo '<a href="#">↓</a><div>';
				}
				else
				{
					echo '<br>';
				}
			}
		}
		if(count($rows) > 1)
		{
			echo '</div>';
		}
	}

	/**
	 * Функция быстрого сохранения цены товаров, отредактированной в списке
	 * @return boolean
	 */
	public function fast_save_price()
	{
		$price_id = $this->diafan->get_param($_POST, 'id', 0, 2);
		if(! $price_id)
		{
			return false;
		}
		$good_id = DB::query_result("SELECT good_id FROM {shop_price} WHERE id=%d LIMIT 1", $price_id);
		if(! $good_id)
		{
			return false;
		}
		DB::query("UPDATE {shop_price} SET price=%f WHERE id=%d LIMIT 1", $_POST['value'], $price_id);
		$this->diafan->_shop->price_calc($good_id);
		return true;
	}

	/**
	 * Вывод кнопки "Акция"
	 * @return void
	 */
	public function edit_variable_action()
	{
		$this->diafan->values["action"] = ! empty($this->diafan->values["action"]) ? 1 : 0;
		$this->diafan->show_table_tr_checkbox('check_action', $this->diafan->variable_name(), $this->diafan->values["action"], $this->diafan->help(), false);
	}

	/**
	 * Вывод кнопки "Клонировать товар"
	 * @return void
	 */
	public function edit_variable_clone()
	{
		// Проверяет права на редактирование
		if (! $this->diafan->_user->roles('edit', 'shop'))
		{
			return;
		}
		echo '<script type="text/javascript" src="'.BASE_PATH.'modules/shop/admin/shop.admin.js"></script>';

		if ($this->diafan->addnew)
		{
			return;
		}

		echo '
		<tr>
			<td class="td_first">

			</td>
			<td>
				<input type="button" value="'.$this->diafan->variable_name().'" class="shop_clone button" rel="'.$this->diafan->edit.'">
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Цена"
	 * @return void
	 */
	public function edit_variable_price()
	{
		global $num_decimal_places;
		if ( ! $this->diafan->addnew)
		{
			$rows = $this->diafan->_shop->price_get_base($this->diafan->edit);
			foreach($rows as $i => $row)
			{
				$rows[$i]["image_rel"] = DB::fetch_array(DB::query("SELECT i.id, i.name FROM {images} AS i INNER JOIN {shop_price_image_rel} AS r ON r.image_id=i.id AND price_id=%d", $row["price_id"]));
				if(empty($rows[$i]["image_rel"]))
				{
					$rows[$i]["image_rel"]["id"] = '';
				}
				if(! $i)
				{
					$this->diafan->values["price"] = $row["price"];
					$this->diafan->values["count"] = $row["count_goods"];
					$this->diafan->values["currency_id"] = $row["currency_id"];	
				}
			}
			$this->diafan->values["price_arr"] = $rows;
			$num_decimal_places = $this->diafan->configmodules("format_price_1", "shop", $this->diafan->values["site_id"]);
		}
		else
		{
			$num_decimal_places = $this->diafan->configmodules("format_price_1", "shop", $this->diafan->site);
		}
		$this->currency = array();
		$result = DB::query("SELECT * FROM {shop_currency} WHERE trash='0'");
		while($row = DB::fetch_array($result))
		{
			$this->currency[] = $row;
		}

		echo '
		<tr id="price">
			<td class="td_first">
				'.$this->diafan->variable_name().'
			</td>
			<td>
				<input type="text" name="'.$this->diafan->key.'" size="20" value="'.( ! empty($this->diafan->values["price"]) ? number_format($this->diafan->values["price"], $num_decimal_places, ',', '') : '')
		. '" class="inpnum"> ';
		if ($this->diafan->configmodules("use_count_goods"))
		{
			echo $this->diafan->_('Количество').'
				<input type="text" name="count" size="20" value="'.( ! empty($this->diafan->values["count"]) ? $this->diafan->values["count"] : 0)
			. '" class="inpnum">';
		}
		if($this->currency)
		{
			echo ' '.$this->diafan->_('валюта').': <input name="currency" type="radio" value="0"'.(empty($this->diafan->values["currency_id"]) ? ' checked' : '').'> '.$this->diafan->_('основная');
			foreach($this->currency as $c)
			{
				echo ' <input name="currency" type="radio" value="'.$c["id"].'"'.(! empty($this->diafan->values["currency_id"]) && $this->diafan->values["currency_id"] == $c["id"] ? ' checked' : '').'> '.$c["name"];
			}
		}
		echo $this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Статистика"
	 * @return void
	 */
	public function edit_variable_statistics()
	{
		if ($this->diafan->addnew)
		{
			return;
		}
		if($this->diafan->configmodules("counter"))
		{
			$counter_view = DB::query_result("SELECT count_view FROM {shop_counter} WHERE element_id=%d LIMIT 1", $this->diafan->edit);
			if(! $counter_view)
			{
				$counter_view = 0;
			}

			echo '
			<tr>
			<td class="td_first">'.$this->diafan->_('Просмотров товара').'</td>
			<td>'.$counter_view.'</td>
			</tr>';
		}
		echo '
		<tr>
			<td class="td_first">'.$this->diafan->_('Товар купили раз').'</td>
			<td>'.$this->diafan->values['counter_buy'].'</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Яндекс.Маркет"
	 * @return void
	 */
	public function edit_variable_yandex()
	{
		if ( ! $this->diafan->configmodules("yandex"))
		{
			return;
		}

		$u = array();

		if ( ! $this->diafan->addnew)
		{
			if ($this->diafan->value)
			{
				$conf_arr = explode("\n", $this->diafan->value);
				foreach ($conf_arr as $c_a)
				{
					list($k, $v) = explode("=", $c_a, 2);
					$u[$k] = $v;
				}
			}
		}

		echo '
		<tr id="yandex" valign="top">
			<td align="right">'
				. $this->diafan->variable_name().$this->diafan->help().'
			</td>
			<td>'
		. $this->diafan->_('Основная ставка').':<br>
		<input type="text" maxLength="70" name="yandex_bid" size="40" class="inptext" value="'.( ! empty($u["bid"]) ? $u["bid"] : '').'"> '.$this->diafan->help('Целое положительное значение. Например: 21, что соответствует ставке 0,21 у.е. Если параметр не задан, то задается настройками модуля.')
		.'<br>'
		. $this->diafan->_('Ставка для карточек').':<br>
		<input type="text" maxLength="70" name="yandex_cbid" size="40" class="inptext" value="'.( ! empty($u["cbid"]) ? $u["cbid"] : '').'"> '.$this->diafan->help('Целое положительное значение. Например: 21, что соответствует ставке 0,21 у.е. Если параметр не задан, то задается настройками модуля.')
		.'<br>'
		. $this->diafan->_('Группа товаров / категория').':<br>
		<input type="text" maxLength="70" name="yandex_typePrefix" size="40" class="inptext" value="'.( ! empty($u["typePrefix"]) ? $u["typePrefix"] : '').'"><br>'
		. '<br>'.$this->diafan->_('Производитель').':<br>
		<input type = "text" maxLength="70" name="yandex_vendor" size="40" class="inptext" value="'.( ! empty($u["vendor"]) ? $u["vendor"] : '').'"><br>'
		. $this->diafan->_('Модель').':<br>
		<input type = "text" maxLength="70" name="yandex_model" size="40" class="inptext" value="'.( ! empty($u["model"]) ? $u["model"] : '').'"><br>'
		. $this->diafan->_('Код товара (указывается код производителя)').':<br>
		<input type = "text" maxLength="70" name="yandex_vendorCode" size="40" class="inptext" value="'.( ! empty($u["vendorCode"]) ? $u["vendorCode"] : '').'"><br>'
		. $this->diafan->_('Отличие товара от других, или акции магазина (кроме скидок)').':<br>
		<input type = "text" maxLength="50" name="yandex_sales_notes" size="40" class="inptext" value="'.( ! empty($u["sales_notes"]) ? $u["sales_notes"] : '').'"><br>'
		. $this->diafan->_('Официальная гарантия производителя').':
		<input type = "checkbox" name="yandex_manufacturer_warranty" value="1"'.( ! empty($u["manufacturer_warranty"]) ? ' checked' : '').'><br><br>'
		. $this->diafan->_('Страна производства товара').':<br>
		<input type = "text" maxLength="70" name="yandex_country_of_origin" size="40" class="inptext" value="'.( ! empty($u["country_of_origin"]) ? $u["country_of_origin"] : '').'">
			</td>
		</tr>';
	}

	/**
	 * Редактирование кнопки "Скидки"
	 * @return void
	 */
	public function edit_variable_discounts()
	{
		// скидки
		$discounts = array();
		$result = DB::query("SELECT * FROM {shop_discount} WHERE act='1' AND trash='0'");
		while($row = DB::fetch_array($result))
		{
			if($row["date_finish"] && $row["date_finish"] < time())
			{
				continue;
			}
			$row["objects"] = array();
			$result_object = DB::query("SELECT * FROM {shop_discount_object} WHERE discount_id=%d", $row["id"]);
			while($row_object = DB::fetch_array($result_object))
			{
				$row["objects"][] = $row_object;
			}
			$discounts[] = $row;
		}
		// категории текущего товара
		$cats = array();
		if(! $this->diafan->addnew)
		{
			$result_cat = DB::query("SELECT cat_id FROM {shop_category_rel} WHERE element_id=%d", $this->diafan->edit);
			while($row_cat = DB::fetch_array($result_cat))
			{
				$cats[] = $row_cat["cat_id"];
			}
		}
		foreach($discounts as $i => $d)
		{
			$discounts[$i]["in_discount"] = false;
			$discounts[$i]["in_discount_check"] = false;
			if(empty($d["objects"][0]) || empty($d["objects"][0]["cat_id"]) && empty($d["objects"][0]["good_id"]))
			{
				$discounts[$i]["in_discount"] = true;
			}
			elseif(! $this->diafan->addnew)
			{
				foreach($d["objects"] as $d_o)
				{
					if($d_o["cat_id"] && in_array($d_o["cat_id"], $cats))
					{
						$discounts[$i]["in_discount"] = true;
						break;
					}
					elseif($d_o["good_id"] == $this->diafan->edit)
					{
						$discounts[$i]["in_discount_check"] = true;
						break;
					}
					
				}
			}
		}
		echo '<tr valign="top" id="discounts">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>';
		foreach($discounts as $d)
		{
			echo '<div><input type="checkbox" name="discounts[]" value="'.$d["id"].'"';
			if($d["in_discount_check"])
			{
				echo ' checked';
			}
			echo '>'.$d["discount"].'%';
			if($d["in_discount"])
			{
				echo ' — '.$this->diafan->_('общая');
			}
			echo '</div>';
		}
			echo '
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Дополнительные параметры"
	 *
	 * @return void
	 */
	public function edit_variable_param()
	{
		global $num_decimal_places;
		//значения характеристик
		$values = array();
		$rvalues = array();
		if (! $this->diafan->addnew)
		{
			$result_el = DB::query("SELECT value".$this->diafan->language_base_site." as rv, [value], param_id FROM {shop_param_element} WHERE element_id=%d", $this->diafan->edit);
			while ($row_el = DB::fetch_array($result_el))
			{
				$values[$row_el["param_id"]][] = $row_el["value"];
				$rvalues[$row_el["param_id"]][] = $row_el["rv"];
			}
		}

		// выбирает все характеристики (при смене раздела/категории просто показываем или скрываем характеристики)
		$result = DB::query("SELECT id, [name], type, required, [measure_unit], [text], config FROM {shop_param} WHERE trash='0' ORDER BY sort ASC");

		$multiple_params = array();
		$params = array();
		$depend_price = array();
		while ($row = DB::fetch_array($result))
		{
			// выбирает категории, к которым прикреплена характеристика
			$row["cats"] = array();
			$result_rel = DB::query("SELECT cat_id FROM {shop_param_category_rel} WHERE element_id=%d", $row["id"]);
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
				$result_select = DB::query("SELECT [name], id FROM {shop_param_select} WHERE param_id=%d ORDER BY sort ASC", $row["id"]);
				while ($row_select = DB::fetch_array($result_select))
				{
					$row["options"][] = $row_select;
				}
			}
			if ($row["type"] == 'multiple' && $row["required"])
			{
				$multiple_params[] = $row;
				if(! empty($this->diafan->values["price_arr"]))
				{
					foreach($this->diafan->values["price_arr"] as $price)
					{
						if(! empty($price["param"][$row["id"]]))
						{
							$depend_price[$row["id"]] = true;
						}
					}
				}
			}
			$params[] = $row;
		}

		if ( ! empty($multiple_params))
		{
			echo '<tr id="price_arr"><td colspan="2">
			<table id="param_table"><tr>';
			foreach ($multiple_params as $row)
			{
				echo '<td class="shop_param_td param_value_td'.$row["id"].'" '.implode(" ", $row["cats"]).(empty($depend_price[$row["id"]]) ? ' style="display:none"' : '').'>'.$row['name'].'</td>';
			}

			echo '<td class="shop_price_td">'.$this->diafan->_('Цена').'</td>';

			if ($this->diafan->configmodules("use_count_goods", "shop", $this->diafan->site))
			{
				echo '<td class="shop_price_td">'.$this->diafan->_('Количество').'</td>';
			}
			if($this->currency)
			{
				echo '<td class="shop_price_td">' .$this->diafan->_('валюта'). '</td>';
			}
			echo '<td></td></tr>';
			if(! empty($this->diafan->values["price_arr"]))
			{
				foreach($this->diafan->values["price_arr"] as $price)
				{
					echo '<tr class="param">';

					foreach ($multiple_params as $row)
					{
						echo '<td class="shop_param_td param_value_td'.$row["id"].'" '.implode(" ", $row["cats"]).(empty($depend_price[$row["id"]]) ? ' style="display:none"' : '').'>
						<select name="'.(empty($depend_price[$row["id"]]) ? 'hide_' : '').'param_value'.$row["id"].'[]">';
						foreach($row["options"] as $opt)
						{
							echo '<option value="'.$opt["id"].'"'.(! empty($price["param"][$row["id"]]) && $price["param"][$row["id"]] == $opt["id"] ? ' selected' : '').'>'.$opt["name"].'</option>';
						}
						echo '</select></td>';
					}

					echo '<td class="shop_price_td"><input name="param_price[]" value="'.number_format($price["price"], $num_decimal_places, ',', '').'" size="5" type="text" class="inpnum"></td>';

					if ($this->diafan->configmodules("use_count_goods", "shop", $this->diafan->site))
					{
						echo '<td class="shop_price_td"><input name="param_count[]" value="'.$price["count_goods"].'" size="5" type="text" class="inpnum"></td>';
					}
					if($this->currency)
					{
						echo '<td class="shop_price_td"><select name="param_currency[]">
						<option value="0">'.$this->diafan->_('основная').'</option>';
						foreach($this->currency as $c)
						{
							echo ' <option value="'.$c["id"].'"'.($price["currency_id"] == $c["id"] ? ' selected' : '').'>'.$c["name"].'</option>';
						}
						echo '</select></td>';
					}
					echo '<td class="param_image_rel_actions">
					<input name="price_image_rel[]" value="'.$price["image_rel"]["id"].'" type="hidden"><span'.(! $price["image_rel"]["id"] ? ' style="display: none"': '').'>';
					if($price["image_rel"]["id"])
					{
						echo '<img src="'.BASE_PATH.USERFILES.'/small/'.$price["image_rel"]["name"].'">';
					}
					echo '<a confirm="'.$this->diafan->_('Вы действительно хотите удалить связь?').'" class="delete_price_image_rel" href="javascript:void(0)">x</a>
					</span>
					<a href="javascript:void(0)" class="add_price_image_rel" title="'.$this->diafan->_('Добавить связь с изображением').'"><img src="'.BASE_PATH.'adm/img/add_image.gif" width="20" height="20" alt="'.$this->diafan->_('Добавить связь с изображением').'"></a></td>';

					echo '<td><span class="param_actions" style="display: none;">
					<a confirm="'.$this->diafan->_('Вы действительно хотите удалить запись?').'" action="delete_param" href="javascript:void(0)">
						<img width="13" height="13" alt="'.$this->diafan->_('Удалить').'" src="'.BASE_PATH.'adm/img/delete.png">
					</a>
					</span></td>';
					echo '</tr>';
				}
			}
			else
			{
				echo '<tr class="param">';

				foreach ($multiple_params as $row)
				{
					echo '<td class="shop_param_td param_value_td'.$row["id"].'" '.implode(" ", $row["cats"]).(empty($depend_price[$row["id"]]) ? ' style="display:none"' : '').'>
					<select name="'.(empty($depend_price[$row["id"]]) ? 'hide_' : '').'param_value'.$row["id"].'[]">';
					foreach($row["options"] as $opt)
					{
						echo '<option value="'.$opt["id"].'">'.$opt["name"].'</option>';
					}
					echo '</select></td>';
				}

				echo '<td class="shop_price_td"><input name="param_price[]" size="5" value="" type="text" class="inpnum"></td>';

				if ($this->diafan->configmodules("use_count_goods", "shop", $this->diafan->site))
				{
					echo '<td class="shop_price_td"><input name="param_count[]" size="5" value="" type="text" class="inpnum"></td>';
				}
				if($this->currency)
				{
					echo '<td class="shop_price_td"><select name="param_currency[]">
					<option value="0">'.$this->diafan->_('основная').'</option>';
					foreach($this->currency as $c)
					{
						echo ' <option value="'.$c["id"].'">'.$c["name"].'</option>';
					}
					echo '</select></td>';
				}
				echo '<td class="param_image_rel_actions">
				<input name="price_image_rel[]" value="" type="hidden">
				<span style="display:none"><a confirm="'.$this->diafan->_('Вы действительно хотите удалить связь?').'" class="delete_price_image_rel" href="javascript:void(0)">x</a></span>
				<a href="javascript:void(0)" class="add_price_image_rel" title="'.$this->diafan->_('Добавить связь с изображением').'"><img src="'.BASE_PATH.'adm/img/add_image.gif" width="20" height="20" alt="'.$this->diafan->_('Добавить связь с изображением').'"></a></td>';
				echo '<td><span class="param_actions" style="display: none;">
				<a confirm="'.$this->diafan->_('Вы действительно хотите удалить запись?').'" action="delete_param" href="javascript:void(0)">x</a>
				</span></td>';
				echo '</tr>';
			}
			echo '</table>
				<a href="javascript:void(0)" class="param_plus" title="'.$this->diafan->_('Добавить').'"><img src="'.BASE_PATH.'adm/img/add_new.png" width="14" height="14" alt="'.$this->diafan->_('Добавить').'"></a>
			<hr></td></tr>';
		}
		foreach ($params as $row)
		{
			$attr = ' class="shop_param" '.implode(" ", $row["cats"]);

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
	
				case 'editor':
					$value = (! empty($values[$row["id"]]) ? $values[$row["id"]][0] : '');
					$this->diafan->show_table_tr_editor("param".$row["id"], $row["name"], $value, $help, $attr);
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
	 * Выводит одну строку формы редактирования с типом "Список с выбором нескольких значений"
	 *
	 * @param string $id номер параметра
	 * @param string $name описание поля
	 * @param string $value значение поля
	 * @param string $help часть кода, вываодящая подсказку к полю
	 * @param boolean $required поле обазательно для заполнения при заказе
	 * @param array $options значения списка
	 * @param array $depend_price характеристики, влияющие на цену
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	private function show_table_tr_multiple_param($id, $name, $values, $help, $required, $options, $depend_price, $attr)
	{
		echo '
		<tr id="param'.$id.'"'.$attr.' valign="top">
			<td class="td_first">'.$name.'</td>
			<td>';
			if($required)
			{
				echo '<input type="checkbox" name="depend_price" rel="'.$id.'"'.(! empty($depend_price[$id]) ? ' checked' : '').'> '.$this->diafan->_('Влияет на цену').'<br>';
			}
			echo '<select name="param'.$id.'[]" multiple="multiple"'.(! empty($depend_price[$id]) ? ' style="display:none"' : '').'>';
				foreach ($options as $k => $select)
				{
					if(is_array($select))
					{
						$k = $select["id"];
						$select = $select["name"];
					}
					echo '<option value="'.$k.'"'.(in_array($k, $values) ? ' selected' : '').'>'.$select.'</option>';
				}
				echo '</select>
				'.$help.'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Файлы"
	 * @return void
	 */
	public function edit_variable_files()
	{
		if ( ! $this->diafan->configmodules("use_non_material_goods", "shop", $this->diafan->site))
		{
			return;
		}

		if ($this->diafan->configmodules("use_count_goods", "shop", $this->diafan->site))
		{
			echo '<tr>
			<td align="right"><td><div class="error">'
			. sprintf($this->diafan->_('Для продажи файлов, необходимо отключить опцию <br> <b>%s</b> <br> в конфигурации магазина.'), $this->diafan->_('Учитывать остатки товаров на складе'))
			. '</div></td></tr>';
			return;
		}

		$file_type = 1;
		echo '
		<tr>
			<td align="right">'.$this->diafan->_('Загрузить файл').'</td>
			<td>';
		if ( ! empty($this->diafan->values["link"]))
		{
			$file_type = 2;
		}
		else
		{
			$this->diafan->values["link"] = '';
			$result = DB::query("SELECT id, name FROM {attachments} WHERE module_name='".$this->diafan->table."' AND element_id='%d'", $this->diafan->edit);
			while ($row = DB::fetch_array($result))
			{
				echo '<input type="hidden" name="delete_attachment" value="0"><div class="attachment">
				<a href="'.BASE_PATH.'attachments/get/'.$row["id"]."/".$row["name"].'">'.$row["name"].'</a>
				<a href="javascript:void(0)" class="delete_file"><img src="'.BASE_PATH.'adm/img/delete.png" width="13" height="13" alt="'.$this->diafan->_('Удалить').'"></a></div>';
			}
		}
		echo '<div class="file_type1'.($file_type == 2 ? ' hide' : '')
		. '"><input type="file" name="attachment" size="40">'.$this->diafan->help().'</div></td>
		</tr>';
	}

	/**
	 * Сохранение поля "Акция"
	 * @return void
	 */
	public function save_variable_action()
	{
		$this->diafan->set_query("action='%d'");
		$this->diafan->set_value(! empty($_POST["check_action"]) ? 1 : 0);
	}

	/**
	 * Сохранение кнопки "Скидки"
	 * @return void
	 */
	public function save_variable_discounts()
	{
		$old_discounts = array();
		$result = DB::query("SELECT discount_id FROM {shop_discount_object} WHERE good_id=%d", $this->diafan->save);
		while($row = DB::fetch_array($result))
		{
			$old_discounts[]  = $row["discount_id"];
		}
		$discounts = array();
		if(! empty($_POST["discounts"]))
		{
			$discounts = $_POST["discounts"];
		}
		foreach($discounts as $discount)
		{
			if(! in_array($discount, $old_discounts))
			{
				DB::query("INSERT INTO {shop_discount_object} (discount_id, good_id) VALUES (%d, %d)", $discount, $this->diafan->save);
				if(DB::query_result("SELECT COUNT(*) FROM {shop_discount_object} WHERE discount_id=%d AND good_id=0 AND cat_id=0", $discount))
				{
					DB::query("DELETE FROM {shop_discount_object} WHERE discount_id=%d AND good_id=0 AND cat_id=0", $discount);
					$this->diafan->_shop->price_calc(0, $discount);
				}
			}
		}
		foreach($old_discounts as $discount)
		{
			if(! in_array($discount, $discounts))
			{
				DB::query("DELETE FROM {shop_discount_object} WHERE discount_id=%d AND good_id=%d", $discount, $this->diafan->save);
				if(! DB::query_result("SELECT COUNT(*) FROM {shop_discount_object} WHERE discount_id=%d", $discount))
				{
					DB::query("INSERT INTO {shop_discount_object} (discount_id, good_id) VALUES (%d, 0)", $discount);
					$this->diafan->_shop->price_calc(0, $discount);
				}
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
		$result = DB::query("SELECT p.id, p.type, p.required, p.config FROM {shop_param} as p "
						. " INNER JOIN {shop_param_category_rel} as cp ON cp.element_id=p.id "
						. ($this->diafan->configmodules("cat", "shop", $this->diafan->save_site_id) && ! empty($cats) ?
							" AND  cp.cat_id IN (".implode(",", $cats).") " : "")
						. " WHERE p.trash='0' GROUP BY p.id ORDER BY p.sort ASC");
		$multiple_param_ids = array();

		while ($row = DB::fetch_array($result))
		{
			if($row["type"] == 'attachments')
			{
				Customization::inc('modules/attachments/admin/attachments.admin.inc.php');
				$attachment = new Attachments_admin_inc($this->diafan);
				$attachment->save_param($row["id"], $row["config"]);
				continue;
			}

			$id_param = DB::query_result("SELECT id FROM {shop_param_element} WHERE param_id=%d AND element_id=%d LIMIT 1", $row["id"], $this->diafan->save);

			if($row["type"] == 'multiple' && $row["required"])
			{
				$multiple_param_ids[] = $row['id'];
				if(! empty($_POST['param_value'.$row["id"]]))
				{
					continue;
				}
			}

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
							DB::query("DELETE FROM {shop_param_element} WHERE param_id=%d AND element_id=%d", $row["id"], $this->diafan->save);
							foreach ($_POST['param'.$row["id"]] as $v)
							{
								DB::query("INSERT INTO {shop_param_element} (value".$lang.", param_id, element_id) VALUES ('%d', %d, %d)", $v, $row["id"], $this->diafan->save);
							}
						}
						break;

					default:
						if (empty($id_param))
						{
							DB::query(
								"INSERT INTO {shop_param_element} (".(in_array($row["type"], array("text", "editor", "textarea")) ?
									'[value]' : 'value'.$lang)
								.", param_id, element_id) VALUES ('%s', %d, %d)", $_POST['param'.$row["id"]], $row["id"], $this->diafan->save
							);
						}
						else
						{
							DB::query(
								"UPDATE {shop_param_element} SET ".(in_array($row["type"], array("text", "editor", "textarea")) ?
									'[value]' : 'value'.$lang)
								." = '%s' WHERE param_id=%d AND element_id=%d", $_POST['param'.$row["id"]], $row["id"], $this->diafan->save
							);
						}
				}
			}
			else
			{
				DB::query("DELETE FROM {shop_param_element} WHERE param_id=%d AND element_id=%d", $row["id"], $this->diafan->save);
			}

			$ids[] = $row["id"];
		}

		DB::query("DELETE FROM {shop_param_element} WHERE".($ids ? " param_id NOT IN (".implode(", ", $ids).") AND" : "")." element_id=%d", $this->diafan->save);

		// отправляет уведомление о поступлении товара		
		if (! $this->diafan->savenew && empty($_POST["no_buy"])
			&& $multiple_param_ids && ! empty($_POST["param_price"]))
		{
			for ($k = 0; $k < count($_POST['param_price']); $k ++ )
			{
				if (empty($_POST['param_price'][$k]) || empty($_POST['param_count'][$k]))
					continue;

				$params = array();
				foreach ($multiple_param_ids as $id)
				{
					$params[$id] = ! empty($_POST['param_value'.$id][$k]) ? $_POST['param_value'.$id][$k] : 0;
				}

				$row_price = $this->diafan->_shop->price_get($this->diafan->save, $params, 0);
				if(! $row_price["count_goods"])
				{
					$this->send_mail_waitlist($params);
				}
			}
		}

		if (! $this->diafan->savenew)
		{
			// удаляет все цены
			DB::query("DELETE FROM {shop_price_param} WHERE price_id IN (SELECT id FROM {shop_price} WHERE good_id=%d)", $this->diafan->save);
			DB::query("DELETE FROM {shop_price_image_rel} WHERE price_id IN (SELECT id FROM {shop_price} WHERE good_id=%d)", $this->diafan->save);
			DB::query("DELETE FROM {shop_price} WHERE good_id=%d", $this->diafan->save);
		}
		// обновляет категорию, чтобы правильно вычислить скидку
		DB::query("UPDATE {shop} SET cat_id=%d WHERE id=%d", $_POST["cat_id"], $this->diafan->save);

		// несколько вариантов цены и количества
		if ($multiple_param_ids && ! empty($_POST["param_price"]))
		{
			$selected_param_combinations = array();
			for ($k = 0; $k < count($_POST['param_price']); $k ++ )
			{
				if (empty($_POST['param_price'][$k]))
					continue;

				$price = true;
				$params = array();
				foreach ($multiple_param_ids as $id)
				{
					$value = ! empty($_POST['param_value'.$id][$k]) ? $_POST['param_value'.$id][$k] : 0;
					$params[$id] = $value;
				}

				//комбинация значений парамертов уже встречалась
				if (in_array(implode('_', $params), $selected_param_combinations))
					continue;

				$selected_param_combinations[] = implode('_', $params);
				if(! empty($_POST['price_image_rel'][$k]))
				{
					$image_id = DB::query_result("SELECT id FROM {images} WHERE id=%d AND trash='0'", $_POST['price_image_rel'][$k]);
				}
				else
				{
					$image_id = 0;
				}

				$this->diafan->_shop->price_insert(
						$this->diafan->save,
						$_POST['param_price'][$k],
						(! empty($_POST['param_count'][$k]) ? $_POST['param_count'][$k] : 0),
						$params,
						(! empty($_POST['param_currency'][$k]) ? $_POST['param_currency'][$k] : 0),
						'',
						$image_id
					);
			}
		}
		// простые цена и количество
		elseif(! $multiple_param_ids && ! empty($_POST["price"]))
		{
			$this->diafan->_shop->price_insert(
					$this->diafan->save,
					$_POST['price'],
					! empty($_POST['count']) ? $_POST['count'] : 0,
					array(),
					! empty($_POST['currency']) ? $_POST['currency'] : 0
				);
		}
		$this->diafan->_shop->price_calc($this->diafan->save);
	}

	/**
	 * Сохранение поля "Яндекс.Маркет"
	 * @return void
	 */
	public function save_variable_yandex()
	{
		if ( ! $this->diafan->configmodules("yandex"))
		{
			return;
		}

		$this->diafan->set_query("yandex='%s'");
		$this->diafan->set_value(
		'typePrefix='.str_replace("\n", '', $this->diafan->get_param($_POST, "yandex_typePrefix", '', 1))."\n"
		.'vendor='.str_replace("\n", '', $this->diafan->get_param($_POST, "yandex_vendor", '', 1))."\n"
		.'model='.str_replace("\n", '', $this->diafan->get_param($_POST, "yandex_model", '', 1))."\n"
		.'vendorCode='.str_replace("\n", '', $this->diafan->get_param($_POST, "yandex_vendorCode", '', 1))."\n"
		.'sales_notes='.str_replace("\n", '', $this->diafan->get_param($_POST, "yandex_sales_notes", '', 1))."\n"
		.'manufacturer_warranty='.str_replace("\n", '', $this->diafan->get_param($_POST, "yandex_manufacturer_warranty", '', 1))."\n"
		.'country_of_origin='.str_replace("\n", '', $this->diafan->get_param($_POST, "yandex_country_of_origin", '', 1))."\n"
		.'bid='.$this->diafan->get_param($_POST, "yandex_bid", '', 1)."\n"
		.'cbid='.$this->diafan->get_param($_POST, "yandex_cbid", '', 1));
	}

	/**
	 * Сохранение поля "Файлы"
	 * @return void
	 */
	public function save_variable_files()
	{
		if ( ! $this->diafan->configmodules("use_non_material_goods", "shop", $this->diafan->site)
				|| $this->diafan->configmodules("use_count_goods", "shop", $this->diafan->site))
		{
			return;
		}
		$altname = str_replace('/', '_', strtolower(substr($this->diafan->translit($_POST["name"]), 0, 40)));
		if ( ! empty($_POST["delete_attachment"]))
		{
			$result = DB::query("SELECT id FROM {attachments} WHERE module_name='".$this->diafan->table."' AND element_id='%d'", $this->diafan->save);
			while ($row = DB::fetch_array($result))
			{
				DB::query("DELETE FROM {attachments} WHERE id='%d'", $row["id"]);
				unlink(ABSOLUTE_PATH.USERFILES.'/'.$this->diafan->table.'/files/'.$row["id"]);
			}
		}

		if ( ! empty($file_deleted))
		{
			$this->diafan->set_query("is_file='%s'");
			$this->diafan->set_value("0");
		}

		if (isset($_FILES["attachment"]) && is_array($_FILES["attachment"]) && $_FILES["attachment"]['name'] != '')
		{
			if(empty($_POST["delete_attachment"]))
			{
				$oldid = DB::query_result("SELECT id FROM {attachments} WHERE module_name='%s' AND element_id=%d LIMIT 1", $this->diafan->table, $this->diafan->save);
				if ($oldid)
				{
					unlink(ABSOLUTE_PATH.USERFILES.'/'.$this->diafan->table.'/files/'.$oldid);
					DB::query("DELETE FROM {attachments} WHERE id=%d", $oldid);
				}
			}

			Customization::inc("modules/attachments/attachments.inc.php");
			if (!$this->diafan->save_site_id)
			{
				$this->diafan->get_site_id();
			}
			
			$this->diafan->configmodules('attachments', 'shop', $this->diafan->save_site_id, _LANG, 1);

			$err = $this->diafan->_attachments->upload($_FILES['attachment'], $this->diafan->table, $this->diafan->save, false, array('type' => 'configmodules', 'site_id' => $this->diafan->save_site_id));

			if ( ! empty($err))
			{
				throw new Exception($err);
			}
			$this->diafan->set_query("is_file='%s'");
			$this->diafan->set_value("1");
		}
	}

	/**
	 * Сохранение кнопки "Товар временно отсутствует"
	 * @return void
	 */
	public function save_variable_no_buy()
	{
		$this->diafan->set_query("no_buy='%d'");
		$this->diafan->set_value(! empty($_POST["no_buy"]) ? '1' : '0');

		if(! $this->diafan->savenew && empty($_POST["no_buy"]) && $this->diafan->oldrow["no_buy"])
		{
			$this->send_mail_waitlist();
		}
	}

	/**
	 * Отправляет уведомления о поступлении товара
	 * @return void
	 */
	private function send_mail_waitlist($param = '')
	{
		if(empty($_POST["no_buy"]))
		{
			if($param)
			{
				asort($param);
				$param = serialize($param);
			}
			include_once ABSOLUTE_PATH.'includes/mail.php';
			$email = ($this->diafan->configmodules("emailconf", 'shop', $this->diafan->oldrow["site_id"])
					   && $this->diafan->configmodules("email", 'shop', $this->diafan->oldrow["site_id"])
					   ? $this->diafan->configmodules("email", 'shop', $this->diafan->oldrow["site_id"]) : '' );

			$result = DB::query("SELECT * FROM {shop_waitlist} WHERE trash='0' AND good_id=%d".($param ? " AND param='%s'" : ''), $this->diafan->save, $param);
			while($row = DB::fetch_array($result))
			{
				if(! empty($GLOBALS["send_mail_waitlist"][$row["mail"]]))
					continue;
		
				$GLOBALS["send_mail_waitlist"][$row["mail"]] = true;

				if(! isset($subject[$row["lang_id"]]))
				{
					$subject[$row["lang_id"]] = str_replace(array ( '%title', '%url' ), array ( TITLE, BASE_URL ), $this->diafan->configmodules('subject_waitlist', 'shop', $this->diafan->oldrow["site_id"], $row["lang_id"]));

					$name = $row["lang_id"] == _LANG ? $_POST["name"] : $this->diafan->oldrow["name".$row["lang_id"]];
					$message[$row["lang_id"]] = str_replace(array ( '%title', '%url', '%good' ), array ( TITLE, BASE_URL, $name), $this->diafan->configmodules('message_waitlist', 'shop', $this->diafan->oldrow["site_id"], $row["lang_id"]));
				}
				
				send_mail($row["mail"], $subject[$row["lang_id"]], $message[$row["lang_id"]],  $email);
			}
			DB::query("DELETE FROM {shop_waitlist} WHERE trash='0' AND good_id=%d".($param ? " AND param='%s'" : ''), $this->diafan->save, $param);
		}
	}

	
	public function edit_variable_elementos_sort(){
	
		echo '<tr id="colors">
		<td class="td_first">'.$this->diafan->variable_name().'</td>  
		<td><iframe src="/collection_vide.php?id='.$this->diafan->values['id'].'" width="500" frameborder="0" height="300" align="left"> Ваш браузер не поддерживает плавающие фреймы!</iframe></td>
		</tr>';
	}
	
	
	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("shop_price_param", "price_id IN (SELECT id FROM {shop_price} WHERE good_id=".$del_id.")", $trash_id);
		$this->diafan->del_or_trash_where("shop_price_image_rel", "price_id IN (SELECT id FROM {shop_price} WHERE good_id=".$del_id.")", $trash_id);
		$this->diafan->del_or_trash_where("shop_price", "good_id=".$del_id, $trash_id);
		$this->diafan->del_or_trash_where("shop_rel", "element_id=".$del_id." OR rel_element_id=".$del_id, $trash_id);
		$this->diafan->del_or_trash_where("shop_discount_object", "good_id=".$del_id, $trash_id);
		$this->diafan->del_or_trash_where("shop_param_element", "element_id=".$del_id, $trash_id);
		$this->diafan->del_or_trash_where("shop_cart", "good_id=".$del_id, $trash_id);
		$this->diafan->del_or_trash_where("shop_wishlist", "good_id=".$del_id, $trash_id);
		$this->diafan->del_or_trash_where("shop_waitlist", "good_id=".$del_id, $trash_id);
		$this->diafan->del_or_trash_where("shop_counter", "element_id=".$del_id, $trash_id);
	}
}
