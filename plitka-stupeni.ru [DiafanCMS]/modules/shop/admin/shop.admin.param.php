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
	include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

/**
 * Shop_admin_param
 *
 * Редактирование дополнительных характеристик товаров
 */
class Shop_admin_param extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'shop_param';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Название',
				'help' => 'Имя дополнительной характеристики товара, доступно для заполнения при редактировании товара',
				'multilang' => true,
			),
			'type' => array(
				'type' => 'select',
				'name' => 'Тип',
				'help' => 'Предустановка типа дополнительной характеристики',
			),
			'required' => array(
				'type' => 'checkbox',
				'name' => 'Доступен к выбору при заказе',
			),
			'measure_unit' => array(
				'type' => 'text',
				'name' => 'Единица измерения',
				'multilang' => true,
			),
			'param_select' => array(
				'type' => 'function',
				'name' => 'Значения, псевдоссылка',
			),
			'page' => array(
				'type' => 'checkbox',
				'name' => 'Отдельная страница для значений',
			),
			'category' => array(
				'type' => 'function',
			),
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
			'hr1' => 'hr',
			'search' => array(
				'type' => 'checkbox',
				'name' => 'Использовать в форме поиска',
				'help' => 'Если отмечена, данная характеристика товар будет использована при поиске',
			),
			'list' => array(
				'type' => 'checkbox',
				'name' => 'Показывать в списке',
			),
			'block' => array(
				'type' => 'checkbox',
				'name' => 'Показывать в блоке товаров',
			),
			'display_in_sort' => array(
				'type' => 'checkbox',
				'name' => 'Отображать параметры в блоке для сортировки товаров',
			),
			'hr2' => 'hr',
			'text' => array(
				'type' => 'textarea',
				'name' => 'Описание характеристики',
				'multilang' => true,
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'order', // сортируется
		'trash', // использовать корзину
	);

	/**
	 * @var array значения списков
	 */
	public $select_arr = array(
		'type' => array(
			'text' => 'строка',
			'numtext' => 'число',
			'date' => 'дата',
			'datetime' => 'дата и время',
			'textarea' => 'текстовое поле',
			'checkbox' => 'галочка',
			'select' => 'выпадающий список',
			'multiple' => 'список с выбором нескольких значений',
			'editor' => 'поле с визуальным редактором',
			'title' => 'заголовок группы характеристик',
			'attachments' => 'файлы',
			'images' => 'изображения',
		),
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array (
		'type' => array('type' => 'select', 'class' => 'param_type'),
		'id' => 'function',
	);

	/**
	 * @var array дополнительные групповые операции
	 */
	public $group_action = array(
		"param_category_rel" => array('name' => "Применить к категории", 'module' => 'shop'),
		"param_category_unrel" => array('name' => "Открепить от категории", 'module' => 'shop')
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		if ( ! $this->diafan->configmodules("cat", "shop", $this->diafan->site))
		{
			$this->diafan->variable_unset("cat_id");
		}

		if ($this->diafan->cat)
		{
			$this->diafan->cat = $this->diafan->cat == 9999 ? 0 : $this->diafan->cat;
			$this->diafan->where .= " AND e.id IN (SELECT element_id FROM {shop_param_category_rel} WHERE cat_id='" . $this->diafan->cat . "')";
		}
	}

	/**
	 * Выводит список дополнительных характеристик товара
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить характеристику');
		$this->diafan->list_row();
	}

	/**
	 * Поиск
	 *
	 * @return string
	 */
	public function show_search()
	{
		if($this->diafan->edit)
			return '';

		$html = '';

		if ($this->diafan->configmodules("cat", "shop", $this->diafan->site))
		{
			$cats_filter = array();
			foreach($this->diafan->categories as $row)
			{
				$cats_filter[$row["parent_id"]][] = $row;
			}
			if($cats_filter)
			{
				$html = $this->diafan->_('Категория') . ': <select rel="' . $this->diafan->get_admin_url('cat', 'site') . '" class="redirect" name="cat">'
				. '<option value="">' . $this->diafan->_('Все') . '</option>'
				. '<option value="9999"' . ($this->diafan->cat == 9999 ? ' selected' : '') . '>' . $this->diafan->_('Общие') . '</option>';
				$html .= $this->diafan->get_options($cats_filter, $cats_filter[0], array($this->diafan->cat))
				. '</select>';
			}
		}

		return $html;
	}

	/**
	 * Выводит тип характеристики в списке характеристик
	 * @return string
	 */
	public function other_row_id($row)
	{
		$cats = array();
		$result = DB::query("SELECT s.[name] FROM {shop_param_category_rel} as c INNER JOIN {shop_category} as s ON s.id=c.cat_id"
						. " WHERE element_id='%d'", $row["id"]);
		while ($row_cat = DB::fetch_array($result))
		{
			$cats[] = $row_cat["name"];
		}
		if ( ! $cats)
		{
			$cats[] = $this->diafan->_('Общие');
		}
		return '</td><td class="param_cats">' . implode(', ', $cats);
	}

	/**
	 * Выводит фильтры для панели групповых  операций
	 *
	 * @param string $value последнее выбранное значение в списке групповых операций
	 * @return string
	 */
	public function group_action_panel_filter($value)
	{
		$cats = array();
		$cats_filter = array();
		$result = DB::query(
				"SELECT id, [name], parent_id FROM {shop_category} WHERE trash='0'"
				." ORDER BY id ASC"
			);
		while ($row = DB::fetch_array($result))
		{
			$cats[] = $row;
			$cats_filter[$row["parent_id"]][] = $row;
		}
		$this->diafan->categories = $cats;

		$dop = '<div class="dop_param_category_rel dop_param_category_unrel'.($value != 'param_category_rel' && $value != 'param_category_unrel' ? ' hide' : '').'">';
		$dop .= '<select rel="'.$this->diafan->get_admin_url('page', 'cat').'" name="cat">';
		$dop .= $this->diafan->get_options($cats_filter, $cats_filter[0], array($this->diafan->cat));
		$dop .= '</select>';
		$dop .= '</div>';

		return $dop;
	}

	/**
	 * Редактирование поля "Параметры"
	 * @return void
	 */
	public function edit_variable_param_select()
	{
		$value = array();
		if (empty($this->diafan->values["type"]))
		{
			$this->diafan->values["type"] = '';
		}
		if ( ! $this->diafan->addnew && in_array($this->diafan->values["type"], array('select', 'multiple', 'checkbox')))
		{
			$result_select = DB::query("SELECT [name], value, id, sort, act FROM {shop_param_select} WHERE param_id=%d ORDER BY sort ASC", $this->diafan->edit);
			while ($row_select = DB::fetch_array($result_select))
			{
				if ($this->diafan->values["type"] == 'checkbox')
				{
					$value[$row_select["value"]] = $row_select["name"];
				}
				else
				{
					$row_select["rewrite"] = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='shop' AND param_id=%d LIMIT 1", $row_select["id"]);
					$value[] = $row_select;
				}
			}
		}

		echo '
		<script type="text/javascript" src="' . BASE_PATH . 'js/admin/admin.param_select.js"></script>
		<script type="text/javascript" src="' . BASE_PATH . 'modules/shop/admin/shop.admin.param.js"></script>

		<tr id="param" valign="top">
			<td class="td_first">' . $this->diafan->variable_name() . '</td>
			<td>
			<table>';

		$fileds = false;
		if (in_array($this->diafan->values["type"], array('select', 'multiple')))
		{
			foreach ($value as $row)
			{
				echo '
				<tr class="param">
					<td>
						<input type="hidden" name="param_id[]" value="' . $row["id"] . '" class="param_id">
						<input type="hidden" name="param_sort[]" value="' . $row["sort"] . '" class="param_sort">
						<input type="checkbox" name="param_act[' . $row["id"] . ']" value="1"'.($row["act"] == 1 ? ' checked="checked"' : '').'>
						<input type="text" name="paramv[]" size="30" value="' . str_replace('"', '&quot;', $row["name"]) . '">
						<input type="text" name="param_rewrite[]" size="20" value="' . $row["rewrite"] . '">
						<span class="param_actions">
							<a href="javascript:void(0)" action="delete_param" confirm="' . $this->diafan->_('Вы действительно хотите удалить запись?') . '"><img src="' . BASE_PATH . 'adm/img/delete.png" width="13" height="13" alt="' . $this->diafan->_('Удалить') . '"></a>
							<a href="javascript:void(0)" action="up_param"><img src="' . BASE_PATH . 'adm/img/up.gif" width="14" height="16" alt="' . $this->diafan->_('Выше') . '"></a>
							<a href="javascript:void(0)" action="down_param"><img src="' . BASE_PATH . 'adm/img/down.gif" width="14" height="16" alt="' . $this->diafan->_('Ниже') . '"></a>
						</span>
					</td>
				</tr>';
				$fileds = true;
			}
		}
		if ( ! $fileds)
		{
			echo '
			<tr class="param">
				<td>
					<input type="text" name="paramv[]" size="30" value="">
					<input type="text" name="param_rewrite[]" size="20" value="">
					<span class="param_actions">
						<a href="javascript:void(0)" action="delete_param" confirm="' . $this->diafan->_('Вы действительно хотите удалить запись?') . '">
							<img src="' . BASE_PATH . 'adm/img/delete.png" width="15" height="15" alt="' . $this->diafan->_('Удалить') . '">
						</a>
					</span>
				</td>
			</tr>';
		}
		echo '</table>
				<a href="javascript:void(0)" class="param_plus" title="' . $this->diafan->_('Добавить') . '"><img src="' . BASE_PATH . 'adm/img/add.png" width="16" height="16" alt="' . $this->diafan->_('Добавить') . '"></a>
			</td>
		</tr>
		<tr id="param_check">
			<td class="td_first">' . $this->diafan->variable_name() . '</td>
			<td>
				' . $this->diafan->_('да') . ' <input type="text" name="paramk_check1" size="20" value="'
		. ( ! empty($value[1]) && $this->diafan->values["type"] == 'checkbox' ? str_replace('"', '&quot;', $value[1]) : '')
		. '">
				&nbsp;&nbsp;
				' . $this->diafan->_('нет') . ' <input type="text" name="paramk_check0" size="20" value="'
		. ( ! empty($value[0]) && $this->diafan->values["type"] == 'checkbox' ? str_replace('"', '&quot;', $value[0]) : '') . '">
			</td>
		</tr>';
		Customization::inc('modules/attachments/admin/attachments.admin.inc.php');
		$attachment = new Attachments_admin_inc($this->diafan);
		$attachment->edit_config_param(! empty($this->diafan->values["config"]) ? $this->diafan->values["config"] : '');

		Customization::inc('modules/images/admin/images.admin.inc.php');
		$images = new Images_admin_inc($this->diafan);
		$images->edit_config_param(! empty($this->diafan->values["config"]) ? $this->diafan->values["config"] : '');
	}

	/**
	 * Редактирование поля "Категория"
	 * 
	 * @return void
	 */
	public function edit_variable_category()
	{
		if(! $this->diafan->configmodules("cat", "shop"))
		{
			return;
		}
		$shop_pages = array();
		$shop_page_result = DB::query("SELECT id, [name] FROM {site} WHERE trash='0' AND module_name='shop'");
		while ($row = DB::fetch_array($shop_page_result))
		{
			$shop_pages[$row['id']] = $row['name'];
		}

		echo '
		<tr valign="top">
			<td align="right">'.$this->diafan->_('Категория') . '</td>
			<td>';

		$result = DB::query("SELECT id, [name], parent_id, site_id FROM {shop_category} WHERE trash='0' ORDER BY sort ASC");
		while ($row = DB::fetch_array($result))
		{
			$cats[$row["site_id"]][$row["parent_id"]][] = $row;
		}

		$values = array();
		if ( ! $this->diafan->addnew)
		{
			$result = DB::query("SELECT cat_id FROM {shop_param_category_rel} WHERE element_id='%d'", $this->diafan->edit);
			while ($row = DB::fetch_array($result))
			{
				$values[] = $row["cat_id"];
			}
		}
		elseif($this->diafan->cat)
		{
			$values[] = $this->diafan->cat;
		}

		echo ' <select name="cat_ids[]" multiple="multiple">';
		foreach($shop_pages as $site_id => $name)
		{
			if(! empty($cats[$site_id]))
			{
				if(count($shop_pages) > 1)
				{
					echo '<optgroup label="'.$name.'">';
				}
				echo $this->diafan->get_options($cats[$site_id], $cats[$site_id][0], $values);
				if(count($shop_pages) > 1)
				{
					echo '</optgroup>';
				}
			}
		}
		echo '</select>';

		echo $this->diafan->help() . '
			</td>
		</tr>';
	}

	/**
	 * Сохранение поля "Параметры"
	 * @return void
	 */
	public function save_variable_param_select()
	{
		switch ($_POST["type"])
		{
			case "select":
			case "multiple":
				# print_r($_POST); die();
				$ids = array();
				foreach ($_POST["paramv"] as $key => $value)
				{
					$id = 0;
					if ( ! empty($_POST["param_id"][$key]))
					{
						$id = $_POST["param_id"][$key];
					}
					if ($id)
					{
						$sort = $_POST["param_sort"][$key];
						DB::query("UPDATE {shop_param_select} SET [name]='%h', sort=%d".(isset($_POST["param_act"][$id]) && $_POST["param_act"][$id] == 1 ? ', act="1"' : ', act="0"')." WHERE id=%d", $value, $sort, $id);
					}
					elseif ($value)
					{
						DB::query("INSERT INTO {shop_param_select} (param_id, [name]) VALUES (%d, '%h')", $this->diafan->save, $value);
						$id = DB::last_id("shop_param_select");
						DB::query("UPDATE {shop_param_select} SET sort=id WHERE id=%d", $id);
					}
					else
					{
						continue;
					}
					if ( ! empty($_POST["param_rewrite"][$key]))
					{
						if(empty($site_id))
						{
							$site_id = DB::query_result("SELECT id FROM {site} WHERE [act]='1' AND trash='0' AND module_name='shop' LIMIT 1");
						}
						$rewrite = DB::fetch_array(DB::query("SELECT id, rewrite, site_id FROM {rewrite} WHERE module_name='shop' AND param_id=%d LIMIT 1", $id));
						if ( ! empty($rewrite["id"]))
						{

							if ($rewrite["rewrite"] != trim($_POST["param_rewrite"][$key]) || $site_id != $rewrite["site_id"])
							{
								DB::query("UPDATE {rewrite} SET site_id=%d, rewrite='%h' WHERE param_id=%d", $site_id, trim($_POST["param_rewrite"][$key]), $id);
							}
						}
						else
						{
							DB::query("INSERT INTO {rewrite} (module_name, site_id, param_id, rewrite) VALUES ('shop', %d, %d, '%h')", $site_id, $id, trim($_POST["param_rewrite"][$key]));
						}
					}
					else
					{
						DB::query("DELETE FROM {rewrite} WHERE module_name='shop' AND param_id=%d", $id);
					}
					$ids[] = $id;
				}

				if ( ! empty($ids))
				{
					DB::query("DELETE FROM {shop_param_select} WHERE param_id=%d AND id NOT IN (%h)", $this->diafan->save, implode(",", $ids));
				}

				break;
			case "checkbox":

				if ($this->diafan->oldrow["type"] == "checkbox" && ($_POST["paramk_check1"] || $_POST["paramk_check0"]))
				{
					$result = DB::query("SELECT id, value FROM {shop_param_select} WHERE param_id=%d", $this->diafan->save);
					while ($row = DB::fetch_array($result))
					{
						if ($row["value"] == 1)
						{
							DB::query("UPDATE {shop_param_select} SET [name]='%h' WHERE id=%d", $_POST["paramk_check1"], $row["id"]);
							$check1 = true;
						}
						elseif ($row["value"] == 0)
						{
							DB::query("UPDATE {shop_param_select} SET [name]='%h' WHERE id=%d", $_POST["paramk_check0"], $row["id"]);
							$check0 = true;
						}
					}
					DB::query("DELETE FROM {shop_param_select} WHERE param_id=%d AND value NOT IN (0,1)", $this->diafan->save);
				}
				else
				{
					DB::query("DELETE FROM {shop_param_select} WHERE param_id=%d", $this->diafan->save);
				}
				if (empty($check0) && $_POST["paramk_check0"])
				{
					DB::query("INSERT INTO {shop_param_select} (param_id, value, [name]) VALUES (%d, 0, '%h')", $this->diafan->save, $_POST["paramk_check0"]);
				}
				if (empty($check1) && $_POST["paramk_check1"])
				{
					DB::query("INSERT INTO {shop_param_select} (param_id, value, [name]) VALUES (%d, 1, '%h')", $this->diafan->save, $_POST["paramk_check1"]);
				}

				break;

			default:
				DB::query("DELETE FROM {shop_param_select} WHERE param_id=%d", $this->diafan->save);
		}
		Customization::inc('modules/attachments/admin/attachments.admin.inc.php');
		$attachment = new Attachments_admin_inc($this->diafan);
		$attachment->save_config_param();

		Customization::inc('modules/images/admin/images.admin.inc.php');
		$images = new Images_admin_inc($this->diafan);
		$images->save_config_param();
	}

	/**
	 * Сохранение поля "Отдельная страница для значений"
	 * 
	 * @return void
	 */
	public function save_variable_page()
	{
		$this->diafan->set_query("page='%d'");
		$this->diafan->set_value(($_POST["type"] == 'multiple' || $_POST["type"] == 'select') && ! empty($_POST["page"]) ? 1 : 0);
	}

	/**
	 * Сохранение поля "Категория"
	 * 
	 * @return void
	 */
	public function save_variable_category()
	{
		DB::query("DELETE FROM {shop_param_category_rel} WHERE element_id=%d", $this->diafan->save);

		if(! empty($_POST["cat_ids"]))
		{
			foreach ($_POST["cat_ids"] as $cat_id)
			{
				DB::query("INSERT INTO {shop_param_category_rel} (element_id, cat_id) VALUES(%d, %d)", $this->diafan->save, $cat_id);
			}
		}
		else
		{
			DB::query("INSERT INTO {shop_param_category_rel} (element_id) VALUES(%d)", $this->diafan->save);
		}
	}

	/**
	 * Сохранение кнопки "Доступен к выбору при заказе"
	 * @return void
	 */
	public function save_variable_required()
	{
		$this->diafan->set_query("required='%d'");
		$this->diafan->set_value(! empty($_POST["required"]) && $_POST["type"] == 'multiple' ? '1' : '0');

		if(! empty($_POST["required"]) && $_POST["type"] == 'multiple' && empty($this->diafan->oldrow["required"]))
		{
			if(! empty($_POST["cat_ids"]))
			{
				foreach($_POST["cat_ids"] as $id)
				{
					$cats[] = intval($id);
				}
			}
			$result = DB::query(
					"SELECT p.*, pr.id AS param_isset FROM {shop_price} AS p"
					.(! empty($cats) ? " INNER JOIN {shop_category_rel} AS c ON c.element_id=p.good_id AND cat_id IN (".implode(',', $cats).")" : '')
					." LEFT JOIN {shop_price_param} AS pr ON p.id=pr.price_id AND pr.param_id=%d", $this->diafan->save
				);
			while($row = DB::fetch_array($result))
			{
				if($row["param_isset"])
					continue;

				DB::query("INSERT INTO {shop_price_param} (price_id, param_id, param_value) VALUES (%d, %d, 0)", $row["id"], $this->diafan->save);
			}
		}
		elseif(empty($_POST["required"]) || $_POST["type"] != 'multiple')
		{
			DB::query("DELETE FROM {shop_price_param} WHERE param_id=%d", $this->diafan->save);
		}
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("shop_price_param", "param_id=" . $del_id, $trash_id);
	}
}