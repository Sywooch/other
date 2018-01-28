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
 * Shop_admin_ordercount
 *
 * Отчет о продажах
 */
class Shop_admin_ordercount extends Frame_admin
{
	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		if ($this->diafan->edit)
		{
			include_once ABSOLUTE_PATH.'includes/404.php';
		}
	}

	/**
	 * Выводит список заказов
	 * @return void
	 */
	public function show()
	{
		$where   = " WHERE status='3' AND trash='0'"; //начало условия отбора: не удаленные заказы со статустом "Выполнен"
		$get_nav = '';
		
		if(!empty($_GET["date_start"]))
		{
			$_GET["date_start"] = preg_replace('/[^\d\.\s\:]/i', '', $_GET['date_start']);
		}

		if(!empty($_GET["date_finish"]))
		{
			$_GET["date_finish"] = preg_replace('/[^\d\.\s\:]/i', '', $_GET['date_finish']);
		}
		$result["date_start"] =  (!empty($_GET["date_start"])?$_GET["date_start"]:date('d.m.Y', time())) ; //задаем дату "от" с начала дня
		$where .= " AND created>='".$this->diafan->unixdate($result["date_start"])."'";
		$get_nav = '?date_start='.$result["date_start"];
		
		$result["date_finish"] = (!empty($_GET["date_finish"])?$_GET["date_finish"]:date('d.m.Y H:i', time())) ; //задаем дату "до" текущим днем
		$where .= " AND created<='".$this->diafan->unixdate($result["date_finish"])."'";
		$get_nav .= ($get_nav ? '&' : '?').'date_finish='.$result["date_finish"];

		$this->diafan->_paginator->page    = $this->diafan->page;
		$this->diafan->_paginator->navlink = $this->diafan->rewrite.'/';
		$this->diafan->_paginator->get_nav = $get_nav;
		$this->diafan->_paginator->nen     = DB::query_result("SELECT COUNT(*) FROM {shop_order}".$where);
		$result["links"] = $this->diafan->_paginator->get();

		$result["rows"] = array();
		$result["summ"] = DB::query_result("SELECT SUM(summ) FROM {shop_order}".$where);
		
		//забираем все заказы, удовлетворяющие фильтру
		$result_q = DB::query_range("SELECT * FROM {shop_order}".$where." ORDER BY created DESC", $this->diafan->_paginator->polog, $this->diafan->_paginator->nastr);
		
		while ($row1 = DB::fetch_array($result_q))
		{
			//берем каждый заказ и забираем из БД его товары (ограничение 100 товаров на заказ)
			$result_q1 = DB::query_range("SELECT * FROM {shop_order_goods} WHERE order_id=%d", $row1["id"], 0, 100);

			while ($row = DB::fetch_array($result_q1))
			{
				$params = '';
				$result_p = DB::query("SELECT * FROM {shop_order_goods_param} WHERE order_good_id=%d", $row["id"]); 
				while ($row_p = DB::fetch_array($result_p))
				{
					$param_name  = DB::query_result("SELECT [name] FROM {shop_param} WHERE id=%d LIMIT 1", $row_p["param_id"]);
					$param_value = DB::query_result("SELECT [name] FROM {shop_param_select} WHERE id=%d AND param_id=%d LIMIT 1", $row_p["value"], $row_p["param_id"]);
					$params .= ($params ? ', ' : '').$param_name.': '.$param_value;
				}
				$good = DB::fetch_array(DB::query("SELECT [name], article FROM {shop} WHERE id=%d LIMIT 1", $row["good_id"]));

				$row["link"] = BASE_PATH_HREF.'shop/edit'.$row["good_id"].'/';

				$row["name"] = $good["name"].($good["article"] ? " ".$good["article"] : '')." ".$params;

				//выясняем, заказ делал пользователь или нет
				if ($row1["user_id"])
				{
						$row["user_link"] = BASE_PATH_HREF.'users/edit'.$row1["user_id"].'/';
						$row["user"]      = DB::query_result("SELECT CONCAT(fio, ' (', name, ')') FROM {users} WHERE id=%d LIMIT 1", $row1["user_id"]);
				}

				$row["created"] = $row1["created"]; //запоминаем дату текущего заказа

				$result["rows"][] = $row;
			}
		}

		$result['date'] = $this->set_date_interval();

		$this->template($result);
	}

	private function set_date_interval()
	{
		$y = date("Y");
		$m = date("m");
		$d = date("d");

		$date = array (
			'Сегодня' => array (
				$d . '.' . $m . '.' . $y,
				$d . '.' . $m . '.' . $y . ' ' . date(" H:i")
			),
			'Месяц' => array (
				'01.' . $m . '.' . $y,
				'01.' . ( $m == 12 ? 1 : $m + 1 ) . '.' . ($m == 12 ? $y + 1 : $y)
			),
			'Год'  => array (
				'01.01.' . $y,
				'31.12.' . $y . ' 23:59'
			)
		);

		return $date;
	}

	private function get_date_interval($date)
	{
		$text = '';
		foreach ($date as $type=> $i)
			$text .= '<a href="?date_start=' . $i[0] . '&date_finish=' . $i[1] . '">' . $this->diafan->_($type) . '</a>';
		return ( !empty( $text ) ? '<div class="order_count_type">' . $text . '</div>' : $text );
	}

	/**
	 * Шаблон вывода
	 * @return boolean true
	 */
	public function template($result)
	{
		echo '<div class="block">
		<form action="" method="GET">
		'.$this->diafan->_('Дата').': <input type="text" id="filed_date_start" name="date_start" value="'.$result["date_start"].'" class="timecalendar"> - 
		<input type="text" name="date_finish" id="filed_date_finish" value="'.$result["date_finish"].'" class="timecalendar">
		<input type="submit" value="'.$this->diafan->_('Поиск').'" class="button">
		'.$this->get_date_interval($result['date']).'
		</form>
		</div>
		<table class="list">
		<tr>
			<td><b>'.$this->diafan->_('Дата').'</b></td>
			<td><b>'.$this->diafan->_('Товар').'</b></td>
			<td><b>'.$this->diafan->_('Количество').'</b></td>
			<td><b>'.$this->diafan->_('Сумма').'</b></td>
			<td><b>'.$this->diafan->_('Заказ №').'</b></td>
			<td><b>'.$this->diafan->_('Пользователь').'</b></td>';
			//echo '<td></td>';
		echo '</tr>';
		foreach ($result["rows"] as $row)
		{
			echo '<tr altcolor="#eeeeee" class="tr">
			<td>'.date("d.m.Y H:i", $row["created"]).'</td>
			<td><a href="'.$row["link"].'">'.$row["name"].'</a></td>
			<td>'.$row["count_goods"].'</td>
			<td>'.$this->diafan->_shop->price_format($row["price"]).' '.$this->diafan->configmodules("currency", "shop").'</td>
			<td><a href="'.BASE_PATH_HREF.'shop/order/edit'.$row["order_id"].'/">'.$row["order_id"].'</a></td>
			<td>';
			if (! empty($row["user"]))
			{
				echo '<a href="'.$row["user_link"].'">'.$row["user"].'</a>';
			} else 
			{
				echo 'Без регистрации';
			}
			echo '</td>';
			
			echo '</tr>';
		}
		
		echo '<tr><td></td><td colspan=5 align=left><br>'.$this->diafan->_tpl->get('get_admin', 'paginator', $result["links"]).'<br></td></tr>';
		
		echo '
		<tr>
			<td align="right" colspan="3">'.$this->diafan->_('ИТОГО').': </td>
			<td colspan="3"> <b>'.$this->diafan->_shop->price_format($result["summ"]).' '.$this->diafan->configmodules("currency", "shop").'</b></td>
		</tr>';
		
		echo '</table>';
	}
}