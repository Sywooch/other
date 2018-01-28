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
 * Shop_admin_discount
 *
 * Скидки
 */
class Shop_admin_discount extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'shop_discount';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'discount' => array(
				'type' => 'floattext',
				'name' => 'Скидка в процентах (%)',
			),
			'deduction' => array(
				'type' => 'floattext',
				'name' => 'Скидка в виде фиксированной суммы',
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'default' => true,
			),
			'hr2' => 'hr',
			'amount' => array(
				'type' => 'floattext',
				'name' => 'Cкидка действует на товары дороже',
				'help' => 'Cкидка применится только на те товары, которые дороже указанной суммы',
			),
			'threshold' => array(
				'type' => 'numtext',
				'name' => 'Скидка действует от общей суммы заказа',
				'help' => 'Скидка начнет действовать когда пользователь наберет в корзину товаров на указанную сумму',
			),   
			'threshold_cumulative' => array(
				'type' => 'numtext',
				'name' => 'Скидка действует от общей суммы оплаченных заказов',
				'help' => 'Скидка начнет действовать когда пользователь оплатит товаров на указанную сумму',
			),
			'user_id' => array(
				'type' => 'numtext',
				'name' => 'Скидка только для пользователя',
				'help' => 'Укажите номер id пользователя. Скидка будет действовать только для одного пользователя. Или номер добавится при указании этим пользователем пользователем кода купона.',
			),
			'coupon' => array(
				'type' => 'text',
				'name' => 'Код купона',
				'help' => 'Код купона сообщите пользователю.',
			),
			'count_use' => array(
				'type' => 'numtext',
				'name' => 'Сколько раз можно использовать купон',
				'help' => 'Скидка становится неактивной, если она исчерпала этот лимит. Если поле не заполнено, ограничение по количеству раз не действует.',
			),
			'hr3' => 'hr',
			'role_id' => array(
				'type' => 'select',
				'name' => 'Тип покупателя',
			),
			'date_start' => array(
				'type' => 'datetime',
				'name' => 'Период действия скидки',
			),
			'date_finish' => array(
				'type' => 'datetime',
			),
			'object' => array(
				'type' => 'function',
				'name' => 'Объект',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'act', // показать/скрыть
		'del', // удалить
		'trash', // использовать корзину
	);

	/**
	 * @var array списки из таблицы
	 */
	public $select = array(
		'role_id' => array(
			'users_role',
			'id',
			'nameLANG',
			'',
			'Все',
			"trash='0'",
		),
	);

	/**
	 * @var array текст для ссылки на редактирование в списке
	 */
	public $text_for_base_link = array(
		'variable' => 'discount, e.deduction',
	);

	/**
	 * Выводит список заказов
	 * @return void
	 */
	public function show()
	{	
		$this->diafan->addnew_init('Добавить скидку');

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
		$get_nav_params["search_date_start"] = 0;
		$get_nav_params["search_date_finish"] = 0;

		if (! empty($_GET["search_date_start"]))
		{
			$get_nav_params["search_date_start"] = $this->diafan->unixdate($_GET["search_date_start"]);
			$this->diafan->get_nav .= ( $this->diafan->get_nav ? '&amp;' : '?' ) . 'search_date_start='. $get_nav_params["search_date_start"];
			$get_nav_params["search_date_start"] = date('d.m.Y H:i', $date_start);
		}
		if (! empty($_GET["search_date_finish"]))
		{
			$get_nav_params["search_date_finish"] = $this->diafan->unixdate($_GET["search_date_finish"]);
			$this->diafan->get_nav .= ( $this->diafan->get_nav ? '&amp;' : '?' ) . 'search_date_finish=' . $get_nav_params["search_date_finish"];
			$get_nav_params["search_date_finish"] = date('d.m.Y H:i', $date_finish);
		}
		$this->diafan->get_nav_params = $get_nav_params;

		if ($this->diafan->get_nav_params["search_date_start"] && $this->diafan->get_nav_params["search_date_finish"])
		{
			$this->diafan->where .= " AND ((date_start <= '".$this->diafan->get_nav_params["search_date_start"]."' OR date_start = '0') AND (date_finish >= '".$this->diafan->get_nav_params["search_date_start"]."' OR date_finish = '0')"
			." OR date_start >= '".$this->diafan->get_nav_params["search_date_start"]."' AND date_start <= '".$this->diafan->get_nav_params["search_date_finish"]."')";
		}
		elseif ($this->diafan->get_nav_params["search_date_start"])
		{
			$this->diafan->where = " AND (date_start<='".$this->diafan->get_nav_params["search_date_start"]."' OR date_start='0') AND (date_finish>='".$this->diafan->get_nav_params["search_date_start"]."' OR date_finish='0')";
		}
		elseif ($this->diafan->get_nav_params["search_date_finish"])
		{
			$this->diafan->where = " AND (date_start<='".$this->diafan->get_nav_params["search_date_finish"]."' OR date_start='0') AND (date_finish>='".$this->diafan->get_nav_params["search_date_finish"]."' OR date_finish='0')";
		}
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

		$html = '<form action="" method="GET">
		'.$this->diafan->_('Дата').': <input type="text" name="date_start" value="'.($this->diafan->get_nav_params["search_date_start"] ? date('d.m.Y H:i', $this->diafan->get_nav_params["search_date_start"]) : "").'" class="timecalendar"> - 
		<input type="text" name="date_finish" value="'.($this->diafan->get_nav_params["search_date_finish"] ? date('d.m.Y H:i', $this->diafan->get_nav_params["search_date_finish"]) : "").'" class="timecalendar">
		<input type="submit" value="'.$this->diafan->_('Поиск').'"  class="button">
		</form>';

		return $html;
	}

	/**
	 * Заглушка для вывода даты окончания действия скидки в списке
	 * @return string
	 */
	public function other_row_date_finish($row)
	{
		return '';
	}

	/**
	 * Формирует основную ссылку для элемента в списке
	 *
	 * @param array $row информация о текущем элменте списка
	 * @param integer $level уровень вложенности
	 * @return string
	 */
	public function get_base_link($row, $level)
	{
		if(! empty($row["deduction"]))
		{
			$name = $row["deduction"].' '.$this->diafan->configmodules("currency", "shop");
		}
		else
		{
			$name = $row["discount"].' %';
		}

		$link = '<a href="';
		if ($this->diafan->_user->roles('init', $this->diafan->rewrite))
		{

			$link .= $this->diafan->_route->current_admin_link().'edit'.$row["id"].'/'.$this->diafan->get_nav.'" title="'.$this->diafan->_('Редактировать').' ('.$row["id"].')';
		}
		else
		{
			$link .= '#';
		}
		$link .= '"';
		if ($this->diafan->config("act") && !$row["act"])
		{
			$link .= ' class="noplus"';
		}
		$link .= '>'.$name.'</a>';
		return $link;
	}

	/**
	 * Редактирование поля "Объект"
	 * @return void
	 */
	public function edit_variable_object()
	{
		$marker = "&nbsp;&nbsp;";
		$result = DB::query("SELECT id, [name], parent_id FROM {shop_category} WHERE trash='0' ORDER BY id ASC");
		while ($row = DB::fetch_array($result))
		{
			$cats[$row["parent_id"]][] = $row;
		}

		$values = array();
		if (! $this->diafan->addnew)
		{
			$result = DB::query("SELECT cat_id FROM {shop_discount_object} WHERE discount_id='%d' AND cat_id>0", $this->diafan->edit);
			while ($row = DB::fetch_array($result))
			{
				$values[] = $row["cat_id"];
			}
		}
		Customization::inc('modules/shop/admin/shop.admin.view.php');

		echo '
		<tr valign="top">
			<td class="td_first">
				'.$this->diafan->_('Категории').'
			</td>
			<td>
				<select name="cat_ids[]" multiple="multiple">'
				.$this->diafan->get_options($cats, $cats[0], $values).'
				</select>
			</td>
		</tr>
		<script type="text/javascript" src="'.BASE_PATH.'modules/shop/admin/shop.admin.discount.js"></script>
		<tr valign="top">
			<td class="td_first">
				'.$this->diafan->_('Товары').'
			</td>
			<td>
				<div class="rel_elements">';
				if (! $this->diafan->addnew)
				{
					$view = new Shop_admin_view($this->diafan);
					echo $view->discount_goods($this->diafan->edit);
				}
				echo '</div>
				<a href="javascript:void(0)" class="rel_module_plus" title="'.$this->diafan->_('Добавить').'"><img src="'.BASE_PATH.'adm/img/add.png" width="16" height="16" alt="'.$this->diafan->_('Добавить').'"></a>
				<div class="hide" id="rel_module_container"></div>
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Пользователь"
	 * @return void
	 */
	public function edit_variable_user_id()
	{
		echo '
		<tr>
			<td class="td_first">
				'.$this->diafan->variable_name().'
			</td>
			<td>
				<input type="text" name="user_id" size="20" value="'.$this->diafan->value.'">
				'.$this->diafan->help().'
			</td>
		</tr>';
		if(! empty($this->diafan->values["user_id"]))
		{
			echo '
			<tr>
				<td></td>
				<td><a href="'.BASE_PATH.ADMIN_FOLDER.'/users/edit'.$this->diafan->values["user_id"].'/">'.DB::query_result("SELECT CONCAT(fio,' (',name,')') FROM {users} WHERE id=%d LIMIT 1", $this->diafan->values["user_id"]).'</a></td>
			</tr>';
		}
	}

	/**
	 * Редактирование поля "Код купона"
	 * @return void
	 */
	public function edit_variable_coupon()
	{
		echo '
		<tr>
			<td class="td_first">
				'.$this->diafan->variable_name().'
			</td>
			<td>
				<input type="text" name="coupon" size="20" value="'.$this->diafan->value.'">
				<a href="#" id="coupon_generate">'.$this->diafan->_('сгенерировать').'</a>
				'.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Сохранение поля "Объект"
	 * @return void
	 */
	public function save_variable_object()
	{
		DB::query("DELETE FROM {shop_discount_object} WHERE discount_id=%d AND good_id=0", $this->diafan->save);

		if (! empty($_POST["cat_ids"]))
		{
			foreach ($_POST["cat_ids"] as $id)
			{
				DB::query("INSERT INTO {shop_discount_object} (discount_id, cat_id) VALUES (%d, %d)", $this->diafan->save, $id);
			}
		}
		elseif (! DB::query_result("SELECT id FROM {shop_discount_object} WHERE discount_id=%d LIMIT 1", $this->diafan->save))
		{
			DB::query("INSERT INTO {shop_discount_object} (discount_id) VALUES (%d)", $this->diafan->save);
		}
		DB::query("UPDATE {shop_discount} SET act='%d' WHERE id=%d", ! empty($_POST["act"]) ? '1' : '0', $this->diafan->save);
	}

	/**
	 * Сохранение поля "Пользователь"
	 * @return void
	 */
	public function save_variable_user_id()
	{
		$this->diafan->set_query("user_id=%d");
		$this->diafan->set_value($_POST["user_id"]);
	}

	/**
	 * Пользовательская функция, выполняемая перед редиректом при сохранении скидки
	 *
	 * @return void
	 */
	public function save_redirect()
	{
		$this->diafan->_shop->price_calc(0, $this->diafan->save);
		parent::__call('save_redirect', array());
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->_shop->price_calc(0, $del_id);
		$this->diafan->del_or_trash_where("shop_discount_object", "discount_id=".$del_id, $trash_id);
		$this->diafan->del_or_trash_where("shop_price", "discount_id=".$del_id, $trash_id);
	}
}