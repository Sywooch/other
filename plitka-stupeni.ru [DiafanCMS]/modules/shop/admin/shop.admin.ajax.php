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
 * Shop_admin_ajax
 * 
 * Обработка Ajax-запросов в административной части модуля Магазин
 */
class Shop_admin_ajax extends Frame_admin
{
	/**
	 * @var array результаты, передаваемы Ajaxом
	 */
	private $result;

	/**
	 * Вызывает обработку Ajax-запросов
	 * 
	 * @return void
	 */
	public function ajax()
	{
		// Прошел ли пользователь проверку идентификационного хэша
		if ($_POST["action"] != "show_rel_goods")
		{
			if ( ! $this->diafan->_user->checked)
			{
				$this->result["error"] = 'ERROR_HASH';
				$this->send_json();
			}
		}
		$this->result["hash"] = $this->diafan->_user->get_hash();

		if ( ! empty($_POST["action"]))
		{
			switch ($_POST["action"])
			{
				case 'show_discount_goods':
					$this->show_discount_goods();
					break;

				case 'discount_good':
					$this->discount_good();
					break;

				case 'delete_discount_good':
					$this->delete_discount_good();
					break;

				case 'clone_good':
					$this->clone_good();
					break;

				case 'show_order_goods':
					$this->show_order_goods();
					break;

				case 'add_order_good':
					$this->add_order_good();
					break;

				case 'new_order':
					$this->new_order();
					break;

				case 'list_site_id':
					$this->list_site_id();
					break;

				case 'param_category_rel':
				case 'param_category_unrel':
					$this->param_category();
					break;
			}
		}
	}

	/**
	 * Подгружает список товаров
	 * 
	 * @return void
	 */
	private function show_discount_goods()
	{
		if (empty($_POST["discount_id"]))
		{
			$_POST["discount_id"] = 0;
		}
		$nastr = 16;
		$list = '';
		if (empty($_POST["page"]))
		{
			$start = 0;
			$page = 1;
			if ( ! isset($_POST["search"]))
			{
				$list = $this->diafan->_('Поиск').': <input type="text" size="30" class="rel_module_search">
				<div class="rel_all_elements_container">';
			}
		}
		else
		{
			$page = intval($_POST["page"]);
			$start = ($page - 1) * $nastr;
		}
		$discount_goods = array();
		if ($_POST["discount_id"])
		{
			$result = DB::query("SELECT good_id FROM {shop_discount_object} WHERE discount_id=%d", $_POST["discount_id"]);
			while ($row = DB::fetch_array($result))
			{
				$discount_goods[] = $row["good_id"];
			}
		}
		if ( ! empty($_POST["search"]))
		{
			$count = DB::query_result("SELECT COUNT(*) FROM {shop} WHERE trash='0' AND LOWER([name]) LIKE LOWER('%%%h%%')", $_POST["search"]);
			$result = DB::query_range("SELECT id, [name] FROM {shop} WHERE trash='0' AND LOWER([name]) LIKE LOWER('%%%h%%')", $_POST["search"], $start, $nastr);
		}
		else
		{
			$count = DB::query_result("SELECT COUNT(*) FROM {shop} WHERE trash='0'");
			$result = DB::query_range("SELECT id, [name] FROM {shop} WHERE trash='0'", $start, $nastr);
		}
		while ($row = DB::fetch_array($result))
		{
			$img = DB::query_result("SELECT name FROM {images} WHERE element_id=%d AND module_name='shop' AND trash='0' ORDER BY sort ASC LIMIT 1", $row["id"]);
			$list .= '<div class="rel_module" element_id="'.$row["id"].'">
			<div'.(in_array($row["id"], $discount_goods) ? ' class="rel_module_selected"' : '').'>
			'.($img ? '<a href="#"><img src="'.BASE_PATH.USERFILES.'/small/'.$img.'"></a><br>' : '').'
			<a href="#">'.$row["name"].'</a>
			</div>
			</div>';
		}
		$list .= '<div class="clear rel_module_navig">';
		for ($i = 1; $i <= ceil($count / $nastr); $i ++ )
		{
			if ($i != $page)
			{
				$list .= '<a href="#" page="'.$i.'">'.$i.'</a> ';
			}
			else
			{
				$list .= '['.$i.'] ';
			}
		}
		$list .= '</div>';
		if (empty($_POST["page"]) && ! isset($_POST["search"]))
		{
			$list .= '</div>';
		}

		$this->result["data"] = $list;

		$this->send_json();
	}

	/**
	 * Прикрепляет скидку к товару
	 * 
	 * @return void
	 */
	private function discount_good()
	{
		if ( ! $_POST["discount_id"])
		{
			DB::query("INSERT INTO {shop_discount} () VALUES ()");
			$_POST["discount_id"] = DB::last_id("shop_discount");
			$this->result["id"] = $_POST["discount_id"];
		}
		Customization::inc('modules/shop/admin/shop.admin.view.php');
		if ( ! DB::query_result("SELECT id FROM {shop_discount_object} WHERE good_id=%d AND discount_id=%d LIMIT 1", $_POST["good_id"], $_POST["discount_id"]))
		{
			DB::query("INSERT INTO {shop_discount_object} (good_id, discount_id) VALUES (%d, %d)", $_POST["good_id"], $_POST["discount_id"]);
		}

		$shop_admin_view = new Shop_admin_view($this->diafan);
		$this->result["data"] = $shop_admin_view->discount_goods($_POST["discount_id"]);

		$this->send_json();
	}

	/**
	 * Удаляет скидку на товар
	 * 
	 * @return void
	 */
	private function delete_discount_good()
	{
		DB::query("DELETE FROM {shop_discount_object} WHERE good_id=%d AND discount_id=%d", $_POST['good_id'], $_POST['discount_id']);

		$this->diafan->_cache->delete("", $this->diafan->module);

		$this->send_json();
	}

	/**
	 * Клонирует товар
	 * 
	 * @return void
	 */
	private function clone_good()
	{
		// Проверяет права на редактирование
		if (! $this->diafan->_user->roles('edit', 'shop'))
		{
			return;
		}
		$id = intval($_POST['id']);
		if (empty($id))
			return;

		$row = DB::fetch_array(DB::query("SELECT * FROM {shop} WHERE id=%d LIMIT 1", $id));

		foreach ($row as $k => $v)
		{
			if ($k == 'name'.$this->diafan->language_base_site)
			{
				$v = $this->diafan->_('КОПИЯ').' '.$v;
			}
			$row[$k] = "'".$v."'";
		}
		unset($row['id']);
		unset($row['counter_buy']);

		DB::query('INSERT INTO {shop} ('.implode(',', array_keys($row)).') VALUES ('.implode(',', $row).')');

		$n_id = DB::last_id("shop");
		$site_id = $row['site_id'];

		$result = DB::query("SELECT cat_id, trash FROM {shop_category_rel} WHERE element_id='%d'", $id);
		while ($row = DB::fetch_array($result))
		{
			DB::query("INSERT INTO {shop_category_rel} (element_id, cat_id, trash) VALUES (%d, %d, '%s')", $n_id, $row['cat_id'], $row['trash']);
		}
		
		$prices = array();
		$result = DB::query("SELECT * FROM {shop_price} WHERE good_id=%d AND trash='0'", $id);
		while ($row = DB::fetch_array($result))
		{
			$row['good_id'] = $n_id;
			foreach ($row as $k => $v)
			{
				if($k != "id")
				{
					$row_param[$k] = "'".$v."'";
				}
			}
			DB::query('INSERT INTO {shop_price} ('.implode(',', array_keys($row_param)).') VALUES ('.implode(',', $row_param).')');
			if($row["id"] == $row["price_id"])
			{
				$price_id = DB::last_id("shop_price");
				$prices[$row["price_id"]] = $price_id;

				$result_param = DB::query("SELECT param_id, param_value FROM {shop_price_param} WHERE price_id=%d", $row["price_id"]);
				while ($row_param = DB::fetch_array($result_param))
				{
					DB::query("INSERT INTO {shop_price_param} (price_id, param_id, param_value) VALUES (%d, %d, %d)", $price_id, $row_param["param_id"], $row_param["param_value"]);
				}
			}
		}
		foreach($prices as $old => $new)
		{
			DB::query("UPDATE {shop_price} SET price_id=%d WHERE price_id=%d AND good_id=%d", $new, $old, $n_id);
		}

		$result = DB::query("SELECT * FROM {shop_param_element} WHERE element_id='%d' AND trash='0'", $id);
		while ($row = DB::fetch_array($result))
		{
		unset($row["id"]);
			$row['element_id'] = $n_id;
			foreach ($row as $k => &$v)
				$v = "'".$v."'";
			DB::query('INSERT INTO {shop_param_element} ('.implode(',', array_keys($row)).') VALUES ('.implode(',', $row).')');
		}
	}

	/**
	 * Подгружает список товаров для добавления в заказ
	 * 
	 * @return void
	 */
	private function show_order_goods()
	{
		if (empty($_POST["order_id"]))
		{
			$_POST["order_id"] = 0;
		}
		$nastr = 18;
		$list = '';
		if (empty($_POST["page"]))
		{
			$start = 0;
			$page = 1;
			if ( ! isset($_POST["search"]) && ! isset($_POST["cat_id"]))
			{
				$list = '<form>'.$this->diafan->_('Поиск').': <input type="text" size="30" class="order_goods_search">';
				if($this->diafan->configmodules("cat", "shop"))
				{
					$result = DB::query("SELECT id, [name], parent_id FROM {shop_category} WHERE trash='0' ORDER BY sort ASC");
					while ($row = DB::fetch_array($result))
					{
						$cats[$row["parent_id"]][] = $row;
					}
					$vals = array();
					if(! empty($_POST["cat_id"]))
					{
						$vals[] = $this->diafan->get_param($_POST, "cat_id", 2);
					}
					$list.= ' <select name="cat_id" class="order_goods_cat_id"><option value="">'.$this->diafan->_('Все').'</option>'.$this->diafan->get_options($cats, $cats[0], $vals).'</select>';
				}
				$list.= '</form><div class="order_all_goods_container">';
			}
		}
		else
		{
			$page = intval($_POST["page"]);
			$start = ($page - 1) * $nastr;
		}

		$where = '';
		if(! empty($_POST["cat_id"]))
		{
			$where = " AND cat_id=".$this->diafan->get_param($_POST, "cat_id", 2);
		}

		if ( ! empty($_POST["search"]))
		{
			$count = DB::query_result("SELECT COUNT(*) FROM {shop} WHERE trash='0' AND LOWER([name]) LIKE LOWER('%%%h%%')".$where, $_POST["search"]);
			$result = DB::query_range("SELECT id, [name] FROM {shop} WHERE trash='0' AND LOWER([name]) LIKE LOWER('%%%h%%')".$where, $_POST["search"], $start, $nastr);
		}
		else
		{
			$count = DB::query_result("SELECT COUNT(*) FROM {shop} WHERE trash='0'".$where);
			$result = DB::query_range("SELECT id, [name] FROM {shop} WHERE trash='0'".$where, $start, $nastr);
		}
		$user_id = DB::query_result("SELECT user_id FROM {shop_order} WHERE id=%d LIMIT 1", $_POST["order_id"]);
		while ($row = DB::fetch_array($result))
		{
			$img = DB::query_result("SELECT name FROM {images} WHERE element_id=%d AND module_name='shop' AND trash='0' ORDER BY sort ASC LIMIT 1", $row["id"]);
			$prices = $this->diafan->_shop->price_get_all($row["id"], $user_id);
			$list .= '<div class="order_good">
			<div>
			'.($img ? '<img src="'.BASE_PATH.USERFILES.'/small/'.$img.'"><br>' : '').'
			'.$row["name"];
			foreach($prices as $price)
			{
				$list .= '<br><a href="#" price_id="'.$price["id"].'">'.$this->diafan->_shop->price_format($price["price"]).' '.$this->diafan->configmodules("currency", "shop").'</a>';
			}
			$list .= '</div>
			</div>';
		}
		$list .= '<div class="clear order_goods_navig">';
		for ($i = 1; $i <= ceil($count / $nastr); $i ++ )
		{
			if ($i != $page)
			{
				$list .= '<a href="#" page="'.$i.'">'.$i.'</a> ';
			}
			else
			{
				$list .= '['.$i.'] ';
			}
		}
		$list .= '</div>';
		if (empty($_POST["page"]) && ! isset($_POST["search"]))
		{
			$list .= '</div>';
		}

		$this->result["data"] = $list;

		$this->send_json();
	}

	/**
	 * Добавляет выбранный товар в заказ
	 * 
	 * @return void
	 */
	private function add_order_good()
	{
		if (empty($_POST["price_id"]))
		{
			return;
		}
		if(empty($_POST["order_id"]))
		{
			DB::query("INSERT INTO {shop_order} () VALUES ()");
			$_POST["order_id"] = DB::last_id("shop_order");
			$this->result["order_id"] = $_POST["order_id"];
		}
		$format_price = intval($this->diafan->configmodules("format_price_1", "shop"));
		$price = DB::fetch_array(DB::query("SELECT price_id, price, good_id FROM {shop_price} WHERE id=%d LIMIT 1", $_POST["price_id"]));
		$where = array();
		$params = array();
		$result = DB::query("SELECT param_id, param_value FROM {shop_price_param} WHERE price_id=%d AND trash='0'", $price["price_id"]);
		while ($row = DB::fetch_array($result))
		{
			$params[$row["param_id"]] = $row["param_value"];
			$where[] = "s.param_id=".intval($row["param_id"])." AND s.value=".intval($row["param_value"]);
		}
		if(! DB::query_result("SELECT g.id FROM {shop_order_goods} AS g WHERE g.order_id=%d AND g.good_id=%d"
				.($where ? " AND (SELECT COUNT(*) FROM {shop_order_goods_param} AS s WHERE g.id=s.order_good_id AND (".implode(" OR ", $where).")) = ".count($where) : ""), 
				$_POST["order_id"], $price["good_id"]))
		{
			DB::query("INSERT INTO {shop_order_goods} (order_id, good_id, count_goods, price) VALUES (%d, %d, 1, %f)", $_POST["order_id"], $price["good_id"], $price["price"]);
			$order_good_id = DB::last_id("shop_order_goods");
			$depend = '';
			if($params)
			{
				foreach($params as $id => $value)
				{
					DB::query("INSERT INTO {shop_order_goods_param} (value, param_id, order_good_id) VALUES (%d, %d, %d)", $value, $id, $order_good_id);
					if(! $value)
						continue;
					$param_name  = DB::query_result("SELECT [name] FROM {shop_param} WHERE id=%d LIMIT 1", $id);
					$param_value = DB::query_result("SELECT [name] FROM {shop_param_select} WHERE id=%d LIMIT 1", $value);
					$depend .= ($depend ? ', ' : '').$param_name.': '.$param_value;
				}
			}
			$good = DB::fetch_array(DB::query("SELECT [name], article FROM {shop} WHERE id=%d LIMIT 1", $price["good_id"]));
			$img = DB::query_result("SELECT i.name FROM {images} AS i
			LEFT JOIN {shop_price_image_rel} AS r ON r.image_id=i.id AND r.price_id=%d
			WHERE i.element_id=%d AND i.module_name='shop' AND i.trash='0'
			ORDER BY r.image_id DESC LIMIT 1",
			$price["price_id"], $price["good_id"]);

			$this->result["data"] = '
			<tr class="tr_good">
				<td id="first">'.($img ? '<img src="'.BASE_PATH.USERFILES.'/small/'.$img.'">' : '').'</td>
				<td><a href="'.BASE_PATH_HREF.'shop/edit'.$price["good_id"].'/">'.$good["name"].' '.$depend.' '.$good["article"].'</a></td>
				<td align="center"><input type="text" name="count_goods'.$order_good_id.'" value="1" size="2"></td>
				<td align="right">'.$this->diafan->_shop->price_format($price["price"]).'</td>
				<td align="right"><input type="text" name="price_goods'.$order_good_id.'" value="'.number_format($price["price"], $format_price, ".", "").'" size="4"></td>
				<td></td>
				<td align="right">'.$this->diafan->_shop->price_format($price["price"]).'</td>
				<td><a href="javascript:void(0)" confirm="'.$this->diafan->_('Вы действительно хотите удалить запись?').'" class="delete_order_good" title="'.$this->diafan->_('Удалить').'">
				<img src="'.BASE_PATH.'adm/img/delete.png" width="13" height="13" alt="'.$this->diafan->_('Удалить').'"></a></td>
</tr>';
		}

		$this->send_json();
	}

	/**
	 * Проверяет наличие новых заказов
	 * 
	 * @return void
	 */
	private function new_order()
	{
		$last_order_id = $this->diafan->get_param($_POST, "last_order_id", 0, 2);

		$this->result["next_order_id"] = DB::query_result("SELECT id FROM {shop_order} WHERE id>%d AND trash='0' LIMIT 1", $last_order_id);

		$this->send_json();
	}

	/**
	 * Подгружает список модулей
	 * 
	 * @return void
	 */
	private function list_site_id()
	{
		if (! $_POST["parent_id"])
		{
			$list = '<div class="menu_list menu_list_first"><div class="block_header">'.$this->diafan->_('Страницы сайта').'</div>';
		}
		else
		{
			$list = '<div class="menu_list">';
		}
		
		$result = DB::query("SELECT id, [name], module_name, count_children FROM {site} WHERE [act]='1' AND trash='0' AND parent_id='%d' AND block='0' ORDER BY sort ASC", $_POST["parent_id"]);
		while ($row = DB::fetch_array($result))
		{
			$list .= '<p site_id="'.$row["id"].'" module_name="site" element_id="" cat_id="">';
			if ($row["count_children"])
			{
				$list .= '<a href="#" class="plus menu_plus">+</a>';
			}
			else
			{
				$list .= '&nbsp;&nbsp;';
			}
			$list .= '&nbsp;<a href="'.BASE_PATH_HREF.'site/edit'.$row["id"].'/" class="menu_select">'.$row["name"].'</a></p>';
		}
		$list .= '</div>';

		$this->result["data"] = $list;

		$this->send_json();
	}

	/**
	 * Прикрепляет/открепляет характеристику к категории
	 * 
	 * @return void
	 */
	private function param_category()
	{
		if(! empty($_POST["cat"]) || ! empty($_POST["ids"]))
		{
			$ids = array();
			foreach($_POST["ids"] as $id)
			{
				$id = intval($id);
				if($id)
				{
					$ids[] = $id;
				}
			}
			if($ids)
			{
				DB::query("DELETE FROM {shop_param_category_rel} WHERE element_id IN(%s) AND cat_id=%d", implode(",", $ids), $_POST["cat"]);
			}
			if($_POST["action"] == 'param_category_rel')
			{
				foreach($ids as $id)
				{
					DB::query("INSERT INTO {shop_param_category_rel} (element_id, cat_id) VALUES (%d, %d)", $id, $_POST["cat"]);
				}
			}
		}

		$this->result["redirect"] = "sdfd";
		//$this->result["redirect"] = URL;
		$this->send_json();
	}

	/**
	 * Отдает ответ Ajax
	 * 
	 * @return void
	 */
	private function send_json()
	{
		if ($this->result)
		{
			include_once ABSOLUTE_PATH.'plugins/json.php';
			echo to_json($this->result);
			exit;
		}
	}
}
