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
 * Shop_admin_order
 *
 * Редактирование заказов товаров
 */
class Shop_admin_order extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'shop_order';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'number' => array(
				'type' => 'function',
				'name' => 'Заказ №',
				'help' => 'Номер элемента в БД. (для разработчиков)',
			),
			'created' => array(
				'type' => 'datetime',
				'name' => 'Дата',
				'help' => 'Вводится в формате дд.мм.гггг чч:мм',
			),
			'lang_id' => array(
				'type' => 'select',
				'name' => 'Язык интерфейса',
			),
			'hr1' => 'hr',
			'memo' => array(
				'type' => 'function',
				'name' => 'Накладная'
			),
			'goods' => array(
				'type' => 'function',
				'name' => 'Товары',
			),
			'payment_id' => array(
				'type' => 'select',
				'name' => 'Способ оплаты',
			),
			'delivery_id' => array(
				'type' => 'select',
				'name' => 'Способ доставки',
			),
			'hr2' => 'hr',
			'user_id' => array(
				'type' => 'function',
				'name' => 'Пользователь',
			),
			'param' => array(
				'type' => 'function',
			),
			'hr3' => 'hr',
			'status_id' => array(
				'type' => 'function',
				'name' => 'Статус',
				'help' => 'При смене статуса на «В обработке», количество товаров на складе уменьшается, если в конфигурации модуля отмечено «Использовать количество товаров на складе»',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'datetime', // показывать дату в списке, сортировать по дате
		'trash', // использовать корзину
	);

	/**
	 * @var array списки из таблицы
	 */
	public $select = array(
		'payment_id' => array(
			"shop_payment",
			"id",
			"nameLANG",
			"",
			"-",
			"trash='0'",
		),
		'delivery_id' => array(
			"shop_delivery",
			"id",
			"nameLANG",
			"",
			"-",
			"trash='0'",
		),
	);

	/**
	 * @var array значения списков
	 */
	public $select_arr = array(
		'color' => array(
			0 => 'red',
			1 => 'blue',
			2 => 'gray',
			3 => 'darkgreen',
			4 => 'black',
		),
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array (
		'status_id' => 'function', 
		'summ' => 'function',
		'user_id' => 'function',
	);

	/**
	 * @var array текст для ссылки на редактирование в списке
	 */
	public $text_for_base_link = array(
		'variable' => 'id',
		'text' => 'Заказ № %d'
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		if(count($this->diafan->languages) > 2)
		{
			foreach ($this->diafan->languages as $language)
			{
				$this->diafan->select_arr("lang_id", $language["id"], $language["name"]);
			}
		}
		else
		{
			$this->diafan->variable_unset("lang_id");
		}
		$result = DB::query("SELECT id, [name], status FROM {shop_order_status} WHERE trash='0' ORDER BY sort ASC");
		while($row = DB::fetch_array($result))
		{
			$GLOBALS["status"][$row["id"]] = $row["status"];
			$this->diafan->select_arr("status_id", $row["id"], $row["name"]);
		}
		if($this->diafan->addnew)
		{
			$this->diafan->variable_unset("number");
		}
	}

	/**
	 * Выводит список заказов
	 * @return void
	 */
	public function show()
	{	
		echo '<script type="text/javascript" src="'.BASE_PATH.'modules/shop/admin/shop.admin.order.js"></script>';
		echo '<script type="text/javascript">
			last_order_id = '.DB::query_result("SELECT MAX(id) FROM {shop_order} WHERE trash='0'").';
			title = \''.$this->diafan->_('Новый заказ').'\';
			timeout = 120000;
			setTimeout("check_new_order()", timeout);
		</script>';
		foreach ($this->diafan->select_arr("status_id") as $id => $value)
		{
			$first_status = $id;
			break;
		}
		$GLOBALS["summ"] = 0;

		echo '<br><a href="'.BASE_PATH_HREF.'shop/order/?status='.$first_status.'" class="new_order">'.$this->diafan->_('Проверить новые заказы').'</a><br><br>';
		
		echo '<form action="'.URL.'" method="GET">
		<p>'.$this->diafan->_('Статус').': <select name="status">
		<option value="all">'.$this->diafan->_('Все').'</option>';
		foreach ($this->diafan->select_arr("status_id") as $id => $value)
		{
			echo '<option value="'.$id.'"'.(isset($_GET["status"]) && $_GET["status"] == $id ? ' selected' : '').'>'.$value.'</option>';
		}
		echo '</select></p>
		</form>';

		if (isset($_GET["status"]))
		{
			$status = (int)$this->diafan->get_param($_GET, "status", 0, 2);
			$this->diafan->where = " AND status_id='".$status."'";
			$this->diafan->get_nav = ($this->diafan->get_nav ? '&' : '?').'status='.$status;
		}
		
		$this->diafan->addnew_init('Добавить заказ');
		$this->diafan->list_row();
		
		if (! $this->diafan->count)
		{
			echo '<center><b>'.$this->diafan->_('Заказов нет').'</b><br>('
			.$this->diafan->_('заказы создаются посетителями из пользовательской части сайта')
			.')</center>';
		}
		else
		{
			echo '<p>'.$this->diafan->_('Итог').': '.$this->diafan->_shop->price_format($GLOBALS["summ"]).' '.$this->diafan->configmodules("currency", "shop").'</p>';
			echo '<p>'.$this->diafan->_('Средний чек').': '.$this->diafan->_shop->price_format($GLOBALS["summ"] / $this->diafan->count).' '.$this->diafan->configmodules("currency", "shop").'</p>';
		}
	}

	/**
	 * Выводит имя заказчика в списке заказов
	 * @return string
	 */
	public function other_row_user_id($row)
	{
		if($row["user_id"])
		{
			$text = '</td><td class="comment"><a href="'.BASE_PATH_HREF.'users/edit'.$row["user_id"].'/">'.DB::title("users", $row["user_id"], "fio").'</a>';
		}
		else
		{
			$text = '</td><td class="comment">
				<div>
					<span></span>
					<table><tbody><tr><td>';
			$values = '';
	
			$result = DB::query("SELECT e.value, e.param_id, p.type, p.[name] FROM {shop_order_param_element} AS e"
								." INNER JOIN {shop_order_param} AS p ON e.param_id=p.id"
								. " WHERE e.trash='0' AND e.element_id=%d", $row["id"]);
			while ($row = DB::fetch_array($result))
			{
				if ($row["value"])
				{
					switch ($row["type"])
					{
						case 'select':
						case 'multiple':
							$row["value"] = DB::query_result("SELECT [name] FROM {shop_order_param_select} WHERE id=%d LIMIT 1", $row["value"]);
							break;
	
						case 'checkbox':
							$v = DB::query_result("SELECT [name] FROM {shop_order_param_select} WHERE param_id=%d AND value=1 LIMIT 1", $row["param_id"]);
							if ($v)
							{
								$row["value"] = $row["name"] . ': ' . $v;
							}
							else
							{
								$row["value"] = $row["name"];
							}
							break;
					}
					$values .= ( $values ? ', ' : '' ) . $row["value"];
				}
			}
			$text .= $values . '</td></tr></tbody></table>
			</div>';
		}
		return $text;
	}

	/**
	 * Выводит сумму заказа в списке заказов
	 * @return string
	 */
	public function other_row_summ($row)
	{
		$GLOBALS["summ"] += $row["summ"];
		return '</td><td class="summ">'
		.($row["summ"]
		 ? $this->diafan->_shop->price_format($row["summ"]).' '.$this->diafan->configmodules("currency", "shop")
		 : '');
	}

	/**
	 * Выводит статус заказа в списке заказов
	 * @return string
	 */
	public function other_row_status_id($row)
	{
		if(! isset($GLOBALS["status"][$row["status_id"]]))
		{
			$GLOBALS["status"][$row["status_id"]] = '';
		}
		return '<td class="status">'
		.'<span style="color:'.$this->diafan->select_arr("color", $GLOBALS["status"][$row["status_id"]]).';font-weight: bold;">'
		.$this->diafan->select_arr("status_id", $row["status_id"]).'</span></td>';
	}

	/**
	 * Редактирование поля "Номер"
	 * @return void
	 */
	public function edit_variable_number()
	{
		echo '<tr>
			<td align="right">
				'.$this->diafan->variable_name().'
			</td>
			<td style="color:#999999;font-weight:bold;" class="tmp1">
				'.$this->diafan->edit.' '.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Статус"
	 * @return void
	 */
	public function edit_variable_status_id()
	{
		echo '
		<tr>
			<td align="right">
				'.$this->diafan->variable_name().'
			</td>
			<td>';
		echo '<select name="status_id" id="order_select_status">';
		foreach ($this->diafan->select_arr("status_id") as $key => $value)
		{
			echo '<option value="'.$key.'"'.($key == $this->diafan->value ? ' selected' : '').'>'.$value.'</option>';
		}
		echo '</select>'.$this->diafan->help();
		echo '</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Накладная"
	 * @return void
	 */
	public function edit_variable_memo()
	{
		if($this->diafan->addnew)
			return;

		echo '
		<tr valign="top">
			<td align="right">'.$this->diafan->variable_name().'</td>
			<td><a href="'.BASE_PATH.'cart/payment/non_cash/memo/'.$this->diafan->edit.'/'.$this->diafan->values["code"].'/">'.$this->diafan->_('Сформировать').'</a></td>
		</tr>';
	}

	/**
	 * Редактирование поля "Товары"
	 * @return void
	 */
	public function edit_variable_goods()
	{
		$summ = 0;
		$count = 0;
		$cat = 0;
		echo '
		<tr valign="top">
		<td colspan="2">
                <script type="text/javascript" src="'.BASE_PATH.'modules/shop/admin/shop.admin.order.js"></script>
				<table class="border" cellspacing="0">
					<tr id="tr_first">
						<td id="first"></td>
						<td>'.$this->diafan->_('Наименование товара').'</td>
						<td>'.$this->diafan->_('Количество').'</td>
						<td>'.$this->diafan->_('Ед. изм.').'</td>
						<td>'.$this->diafan->_('Обычная цена').'</td>
						<td>'.$this->diafan->_('Цена').'</td>
						<td>'.$this->diafan->_('Скидка').'</td>
						<td>'.$this->diafan->_('Сумма').'</td>
                                                    
					</tr>';
		$format_price = intval($this->diafan->configmodules("format_price_1", "shop"));

		if(! $this->diafan->addnew)
		{
			$result = DB::query(
				"SELECT g.*, s.name".$this->diafan->language_base_site." AS name_good, s.article, s.cat_id, c.name".$this->diafan->language_base_site." AS name_cat FROM {shop_order_goods} AS g"
				." INNER JOIN {shop} AS s ON g.good_id=s.id"
				." LEFT JOIN {shop_category} AS c ON s.cat_id=c.id"
				." WHERE g.order_id=%d ORDER by c.sort ASC",
				$this->diafan->values["id"]
			); 
			while ($row = DB::fetch_array($result))
			{
				$depend = '';
				$params = array();
				$result_p = DB::query("SELECT * FROM {shop_order_goods_param} WHERE order_good_id=%d", $row["id"]); 
				while ($row_p = DB::fetch_array($result_p))
				{
					$params[$row_p["param_id"]] = $row_p["value"];
					if(! $row_p["value"])
						continue;
					$param_name  = DB::query_result("SELECT [name] FROM {shop_param} WHERE id=%d LIMIT 1", $row_p["param_id"]);
					$param_value = DB::query_result("SELECT [name] FROM {shop_param_select} WHERE id=%d AND param_id=%d LIMIT 1", $row_p["value"], $row_p["param_id"]);
					$depend .= ($depend ? ', ' : '').$param_name.': '.$param_value;
				}
				if($row["discount_id"])
				{
					if(empty($discounts[$row["discount_id"]]))
					{
						$d = DB::fetch_array(DB::query("SELECT discount, deduction FROM {shop_discount} WHERE id=%d LIMIT 1", $row["discount_id"]));
						$discounts[$row["discount_id"]] = $d["discount"] ? $d["discount"].'%' : $d["deduction"].' '.$this->diafan->configmodules("currency", "shop");
					}
					$row["discount"] = $discounts[$row["discount_id"]];
				}
				if($cat != $row["cat_id"])
				{
					echo '<tr><td></td><td colspan="6"><b>'.$row["name_cat"].'</b></tr>';
					$cat = $row["cat_id"];
				}
				$row_price = $this->diafan->_shop->price_get($row["good_id"], $params, 0, false, true);
				$img = DB::query_result("SELECT i.name FROM {images} AS i
				LEFT JOIN {shop_price_image_rel} AS r ON r.image_id=i.id AND r.price_id=%d
				WHERE i.element_id=%d AND i.module_name='shop' AND i.trash='0'
				ORDER BY r.image_id DESC LIMIT 1",
				$row_price["price_id"], $row["good_id"]);
				$units = $this->get_good_units($row["good_id"]);
				echo '
				<tr class="tr_good">
					<td id="first">'.($img ? '<img src="'.BASE_PATH.USERFILES.'/shop/collection_element/'.$img.'">' : '').'</td>
					<td><a href="'.BASE_PATH_HREF.'shop/edit'.$row["good_id"].'/">'.$row["name_good"].' '.$depend.' '.$row["article"].'</a></td>
					<td align="center"><input type="text" class="count_goods" data-type="'.$units.'" name="count_goods'.$row["id"].'" value="'.$row["count_goods"].'" size="2"></td>
					<td align="center">'.$units.'</td>
					<td align="right">'.$this->diafan->_shop->price_format($row_price["price"]).'</td>
					<td align="right"><input type="text" name="price_goods'.$row["id"].'" value="'.number_format($row["price"], $format_price, ".", "").'" size="4"></td>
					<td>'.($row["discount_id"] ? '<a href="'.BASE_PATH_HREF.'shop/discount/edit'.$row["discount_id"].'/">'.$row["discount"].'</a>' : '').'</td>
					<td align="right">'.$this->diafan->_shop->price_format($row["price"] * $row["count_goods"]).'</td>
					<td><a href="javascript:void(0)" confirm="'.$this->diafan->_('Вы действительно хотите удалить запись?').'" class="delete_order_good" title="'.$this->diafan->_('Удалить').'">
					<img src="'.BASE_PATH.'adm/img/delete.png" width="13" height="13" alt="'.$this->diafan->_('Удалить').'"></a></td>
	</tr>';
				$summ += $row["price"] * $row["count_goods"];
				$count += $row["count_goods"];
			}
		}
		echo '<tr class="tr_good">
				<td id="first">&nbsp;</td>
				<td colspan="4">
				<a href="javascript:void(0)" class="order_good_plus" title="' . $this->diafan->_('Добавить') . '"><img src="' . BASE_PATH . 'adm/img/add_new.png" width="14" height="14" alt="' . $this->diafan->_('Добавить') . '"></a>
				<div class="hide" id="order_goods_container"></div></td>
		</tr>';
		if(! $this->diafan->addnew)
		{
			$result = DB::query("SELECT a.id, a.[name], a.price, a.amount, s.id AS sid, s.summ FROM {shop_additional_cost} AS a LEFT JOIN {shop_order_additional_cost} AS s ON s.additional_cost_id=a.id AND s.order_id=%d WHERE a.trash='0'", $this->diafan->values["id"]); 
			while ($row = DB::fetch_array($result))
			{
				if($row["sid"])
				{
					$row['price'] = $row['summ'];
				}
				else
				{
					if (! empty($row['amount']))
					{
						if ($row['amount'] < $summ)
						{
							$row['price'] = 0;
						}
					}
				}
			    echo '<tr class="tr_good">
					<td id="first">&nbsp;</td>
					<td colspan="4">'.$row["name"].'</td>
					<td align="right" class="order_good_price"><input type="text" name="summ_additional_cost'.$row["id"].'" value="'.$row["price"].'" size="4"></td>
					<td><input name="additional_cost_id'.$row["id"].'" value="1" type="checkbox" '.($row["sid"] ? ' checked' : '').'></td>
				</tr>';
			}
		}
		if (! empty($this->diafan->values["delivery_id"]))
		{
			$delivery_name = DB::query_result("SELECT [name] FROM {shop_delivery} WHERE id=%d LIMIT 1", $this->diafan->values["delivery_id"]);
		    echo '<tr>
				<td id="first">&nbsp;</td>
				<td colspan="4">'.$delivery_name.'</td>
				<td align="right" class="order_good_price">'.$this->diafan->_shop->price_format($this->diafan->values["delivery_summ"]).'</td>
			</tr>';
		}
		echo '
			<tr>
				<td id="first">&nbsp;</td>
				<td>'.$this->diafan->_('ИТОГО').'</td>
				<td align="center" class="order_good_count">'.$count.'</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td align="right" class="order_good_price">'.(!$this->diafan->addnew ? $this->diafan->_shop->price_format($this->diafan->values["summ"]) : '').'</td>
			</tr>
		</table>
		'.$this->diafan->help().'
			</td>
		</tr>';
		echo '<script>
			$(".count_goods").keyup(function(){
				var data = $(this).val();
				var type = $(this).data("type");
				$(this).val(input_check(data,type));
			});
			function input_check(data,type){
				if(type == "м2"){
					data = data.replace(/[^0-9\.\,]/g,"");
					data = data.replace(",", ".");
					if(data.indexOf(".") == 0){
						data = data.substr(1, data.length);
					}
					var point_position = data.indexOf(".");
					var first_num_block = data.substr(0, point_position+1);
					var sec_num_block = data.substr(point_position+1, data.length - (point_position+1)).replace(/\D+/g,"");
					return first_num_block+sec_num_block;
				}else{
					return Number(data.replace(/\D+/g,""));
				}
			}';
		echo '</script>';
	}

	public function get_good_units($good_id)
	{
		$params = $this->get_param($good_id, 29);
		foreach($params as $param)
		{
			if($param['id'] == 5) $size_type	= $param['value'];
		}
		return $size_type;
	}
	
	/**
	 * Получает дополнительные характеристики товара
	 * 
	 * @param integer $id номер товара
	 * @param integer $site_id номер страницы, к которой прикреплен товар
	 * @param string $function функция, для которой выбираются параметры
	 * @return array
	 */
	public function get_param($id, $site_id, $function = "id")
	{
		global $param_select, $param_select_page;
		$values = array();
		$rvalues = array();
		$result_el = DB::query("SELECT e.value".$this->diafan->language_base_site." as rvalue, e.[value], e.param_id, e.id FROM {shop_param_element} as e"
		. " LEFT JOIN {shop_param_select} as s ON e.param_id=s.param_id AND e.param_id=s.id"
		. " WHERE e.element_id=%d GROUP BY e.id ORDER BY s.sort ASC", $id);
		while ($row_el = DB::fetch_array($result_el))
		{
			$values[$row_el["param_id"]][] = $row_el;
		}
		$result = DB::query("SELECT p.id, p.[name], p.type, p.page, p.[measure_unit], p.config FROM {shop_param} as p "
		. ($this->diafan->configmodules("cat", "shop", $site_id) ? " INNER JOIN {shop_category_rel} as c ON c.element_id=".$id : "")
		. " INNER JOIN {shop_param_category_rel} as cp ON cp.element_id=p.id "
		. ($this->diafan->configmodules("cat", "shop", $site_id) ?
				" AND (cp.cat_id=c.cat_id OR cp.cat_id=0) " : "")
		. " WHERE p.trash='0' "
		. ($function == "block" ? " AND p.block='1'" : '')
		. ($function == "list" ? " AND p.list='1'" : '')
		. " GROUP BY p.id ORDER BY p.sort ASC"
		);

		$param = array();
		while ($row = DB::fetch_array($result))
		{
			switch ($row["type"])
			{
				case "text":
				case "textarea":
				case "editor":
					if ( ! empty($values[$row["id"]][0]["value"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $values[$row["id"]][0]["value"],
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"]
						);
					}
					break;
				case "date":
					if ( ! empty($values[$row["id"]][0]["rvalue"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $this->diafan->formate_from_date($values[$row["id"]][0]["rvalue"]),
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"]
						);
					}
					break;
				case "datetime":
					if ( ! empty($values[$row["id"]][0]["rvalue"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $this->diafan->formate_from_datetime($values[$row["id"]][0]["rvalue"]),
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"]
						);
					}
					break;
				case "select":
					$value = ! empty($values[$row["id"]][0]["rvalue"]) ? $values[$row["id"]][0]["rvalue"] : '';
					if ($value)
					{
						if (empty($param_select[$row["id"]][$value]))
						{
							$param_select[$row["id"]][$value] = DB::query_result("SELECT [name] FROM {shop_param_select} WHERE id=%d AND param_id=%d LIMIT 1", $values[$row["id"]][0]["rvalue"], $row["id"]);
						}
						if ($row["page"])
						{
							if (empty($param_select_page[$row["id"]][$value]))
							{
								$param_select_page[$row["id"]][$value] = $this->diafan->_route->link($site_id, "shop", 0, 0, $value);
							}
							$link = $param_select_page[$row["id"]][$value];
							$param[] = array("id" => $row["id"], "name" => $row["name"], "type" => $row["type"], "value" => $param_select[$row["id"]][$value], "link" => $link);
						}
						else
						{
							$param[] = array("id" => $row["id"], "name" => $row["name"], "type" => $row["type"], "value" => $param_select[$row["id"]][$value]);
						}
					}
					break;
				case "multiple":
					if ( ! empty($values[$row["id"]]))
					{
						$value = array();
						foreach ($values[$row["id"]] as $val)
						{
							if (empty($param_select[$row["id"]][$val["rvalue"]]))
							{
								$param_select[$row["id"]][$val["rvalue"]] =
										DB::query_result("SELECT [name] FROM {shop_param_select} WHERE id=%d AND param_id=%d LIMIT 1", $val["rvalue"], $row["id"]);
							}
							if ($row["page"])
							{
								if ($this->diafan->module == 'shop' && $this->diafan->param == $val["rvalue"])
								{
									$link = '';
								}
								else
								{
									if (empty($param_select_page[$row["id"]][$val["rvalue"]]))
									{
										$param_select_page[$row["id"]][$val["rvalue"]] = $this->diafan->_route->link($site_id, "shop", 0, 0, $val["rvalue"]);
									}
									$link = $param_select_page[$row["id"]][$val["rvalue"]];
								}
								$value[] = array("id" => $row["id"], "name" => $param_select[$row["id"]][$val["rvalue"]], "link" => $link);
							}
							else
							{
								$value[] = $param_select[$row["id"]][$val["rvalue"]];
							}
						}
						$param[] = array("id" => $row["id"], "name" => $row["name"], "type" => $row["type"], "value" => $value);
					}
					break;
				case "checkbox":
					$value = ! empty($values[$row["id"]][0]["rvalue"]) ? 1 : 0;
					if ( ! isset($param_select[$row["id"]][$value]))
					{
						$param_select[$row["id"]][$value] =
								DB::query_result("SELECT [name] FROM {shop_param_select} WHERE value=%d AND param_id=%d LIMIT 1", $value, $row["id"]);
					}
					if ( ! $param_select[$row["id"]][$value] && $value == 1)
					{
						$param[] = array("id" => $row["id"], "name" => $row["name"], "type" => $row["type"], "value" => '');
					}
					else
					{
						$param[] = array("id" => $row["id"], "name" => $row["name"], "type" => $row["type"], "value" => $param_select[$row["id"]][$value]);
					}
					break;
				case "title":
					$param[] = array(
						"id" => $row["id"],
						"name" => $row["name"],
						"type" => $row["type"],
						"value" => ''
					);
					break;
				case "numtext":
					if ( ! empty($values[$row["id"]][0]["rvalue"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $values[$row["id"]][0]["rvalue"],
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"],
							"measure_unit" => $row["measure_unit"]
						);
					}
					break;
				case "images":
					$value = $this->diafan->_images->get('large', $id, "shop", 0, '', $row["id"]);
					if(! $value)
						continue 2;

					$param[] = array(
						"id" => $row["id"],
						"name" => $row["name"],
						"type" => $row["type"],
						"value" => $value
					);
					break;
				case "attachments":
					$config = unserialize($row["config"]);
					if($config["attachments_access_admin"])
						continue 2;

					$value = $this->diafan->_attachments->get($id, "shop", 0, $row["id"]);
					if(! $value)
						continue 2;

					$param[] = array(
						"id" => $row["id"],
						"name" => $row["name"],
						"type" => $row["type"],
						"value" => $value,
						"use_animation" => ! empty($config["use_animation"]) ? true : false
					);
					break;
				default:
					if ( ! empty($values[$row["id"]][0]["rvalue"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $values[$row["id"]][0]["rvalue"],
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"]
						);
					}
					break;
			}
		}
		return $param;
	}
	
	/**
	 * Сохранение поля "Товары"
	 * @return void
	 */
	public function save_variable_goods()
	{
		$summ = 0;
		$result = DB::query("SELECT * FROM {shop_order_goods} WHERE order_id=%d", $this->diafan->save); 
		while ($row = DB::fetch_array($result))
		{
			if(empty($_POST["count_goods".$row["id"]]))
			{
				DB::query("DELETE FROM {shop_order_goods} WHERE id=%d", $row["id"]);
			}
			else
			{
				$_POST["count_goods".$row["id"]] = str_replace(',', '.', $_POST["count_goods".$row["id"]]);
				$_POST["count_goods".$row["id"]] = round($_POST["count_goods".$row["id"]],3);
				if ($_POST["count_goods".$row["id"]] != $row["count_goods"])
				{
					DB::query("UPDATE {shop_order_goods} SET count_goods=%f WHERE id=%d", $_POST["count_goods".$row["id"]], $row["id"]);
				}
				if ($_POST["price_goods".$row["id"]] != $row["price"])
				{
					DB::query("UPDATE {shop_order_goods} SET price=%f WHERE id=%d", $_POST["price_goods".$row["id"]], $row["id"]);
				}

				$summ += $_POST["price_goods".$row["id"]] * $_POST["count_goods".$row["id"]];
			}
		}
		$result = DB::query("SELECT a.id, s.id AS sid, s.summ FROM {shop_additional_cost} AS a LEFT JOIN {shop_order_additional_cost} AS s ON s.additional_cost_id=a.id AND s.order_id=%d WHERE a.trash='0'", $this->diafan->save); 
		while ($row = DB::fetch_array($result))
		{
			if($row["sid"])
			{
				if(empty($_POST['additional_cost_id'.$row["id"]]))
				{
					DB::query("DELETE FROM {shop_order_additional_cost} WHERE id=%d", $row["sid"]);
				}
				elseif($row['summ'] != $_POST['summ_additional_cost'.$row["id"]])
				{
					DB::query("UPDATE {shop_order_additional_cost} SET summ=%f WHERE id=%d", $_POST['summ_additional_cost'.$row["id"]], $row["sid"]);
				}
			}
			else
			{
				if(! empty($_POST['additional_cost_id'.$row["id"]]))
				{
					DB::query("INSERT INTO {shop_order_additional_cost} (additional_cost_id, summ, order_id) VALUES (%d, %f, %d)", $row["id"], $_POST['summ_additional_cost'.$row["id"]], $this->diafan->save);
				}
			}
		}
		
		$result = DB::query("SELECT a.id, a.[name], s.summ, s.id AS a_id FROM {shop_additional_cost} AS a INNER JOIN {shop_order_additional_cost} AS s ON s.additional_cost_id=a.id WHERE s.order_id=%d", $this->diafan->save); 
		while ($row = DB::fetch_array($result))
		{
			if(! isset($_POST['summ_additional_cost'.$row["id"]]))
			{
				DB::query("DELETE FROM {shop_order_additional_cost} WHERE id=%d", $row["a_id"]);
			}
			else
			{
				if($_POST['summ_additional_cost'.$row["id"]] != $row["summ"])
				{
					DB::query("UPDATE {shop_order_additional_cost} SET summ=%f WHERE id=%d", $_POST['summ_additional_cost'.$row["id"]], $row["a_id"]);
				}
				$summ += $_POST['summ_additional_cost'.$row["id"]];
			}
		}
		DB::query("UPDATE {shop_order} SET summ=%f+delivery_summ WHERE id=%d", $summ, $this->diafan->save);
	}

	/**
	 * Сохранение поля "Способ доставки"
	 * @return void
	 */
	public function save_variable_delivery_id()
	{
		$summ = DB::query_result("SELECT summ-delivery_summ FROM {shop_order} WHERE id=%d LIMIT 1", $this->diafan->save);
		if ($row = DB::fetch_array(DB::query("SELECT price, delivery_id FROM {shop_delivery_thresholds}  WHERE delivery_id=%d AND amount<=%f ORDER BY price ASC LIMIT 1", $_POST["delivery_id"], $summ)))
		{
			$delivery_summ = $row["price"];
			$delivery_id = $row["delivery_id"];
		}
		DB::query("UPDATE {shop_order} SET summ=summ-delivery_summ+%f, delivery_summ=%f, delivery_id=%d WHERE id=%d", $delivery_summ, $delivery_summ, $delivery_id, $this->diafan->save);
	}

	/**
	 * Сохранение поля "Статус",
	 * отправка ссылок на купленные файлы при необходимости
	 * 
	 * @return void
	 */
	public function save_variable_status_id()
	{
		if($this->diafan->oldrow["status_id"] == $_POST["status_id"])
			return;

		$status = DB::query_result("SELECT status FROM {shop_order_status} WHERE id=%d LIMIT 1", $_POST["status_id"]);
		if($status == 1)
		{
			$this->diafan->_shop->order_pay($this->diafan->save);
		}
		else
		{
			$this->diafan->_shop->order_send_mail_change_status($this->diafan->save, $_POST["status_id"]);
		}

		$this->diafan->set_query("status_id=%d");
		$this->diafan->set_value($_POST["status_id"]);

		$this->diafan->set_query("status='%d'");
		$this->diafan->set_value($status);
	}

	/**
	 * Сохранение поля "Накладная"
	 * @return void
	 */
	public function save_variable_memo()
	{
		if(empty($this->diafan->oldrow["code"]))
		{
			$this->diafan->set_query("code='%s'");
			$this->diafan->set_value(md5(rand(0, 99999)));
		}
	}
    
    
	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return boolean true
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("shop_order_goods", "order_id=".$del_id, $trash_id);
		$this->diafan->del_or_trash_where("shop_order_goods_param", "order_good_id IN (SELECT id FROM {shop_order_goods} WHERE order_id=".$del_id.")", $trash_id);
		$this->diafan->del_or_trash_where("shop_order_param_element", "element_id=".$del_id, $trash_id);
	}
}