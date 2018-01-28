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
 * Shop_admin_payhistory
 *
 * История платежей
 */
class Shop_admin_payhistory extends Frame_admin
{
	/**
	 * @var array значения списков
	 */
	public $select_arr = array(
		"status" => array(
			""            => '',
			"request_pay" => 'запрос платежа',
			"pay"         => 'оплачено',
		)
	);

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
	 * Выводит список платежей
	 * @return void
	 */
	public function show()
	{
		$where   = " WHERE 1=1";
		$get_nav = '';
		$payments = $this->get_payments();
		
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
		$this->diafan->_paginator->nen     = DB::query_result("SELECT COUNT(*) FROM {shop_pay_history}".$where);
		$result["links"] = $this->diafan->_paginator->get();

		$result["rows"] = array();
		
		//забираем все заказы, удовлетворяющие фильтру
		$result_q = DB::query_range("SELECT * FROM {shop_pay_history}".$where." ORDER BY created DESC", $this->diafan->_paginator->polog, $this->diafan->_paginator->nastr);
		
		while ($row = DB::fetch_array($result_q))
		{
			if($row["user_id"])
			{
				$row["user_link"] = BASE_PATH.ADMIN_FOLDER.'/users/edit'.$row["user_id"].'/';
				$row["user"] = DB::query_result("SELECT CONCAT(fio, ' (', name, ')') FROM {users} WHERE id=%d LIMIT 1", $row["user_id"]);
			}
			$row["name"] = ! empty($payments[$row["payment"]]) ? $payments[$row["payment"]] : '';
			$row["status"] = $this->diafan->select_arr("status", $row["status"]);
			$row["summ"] = $this->diafan->_shop->price_format($row["summ"]).' '.$this->diafan->configmodules("currency", "shop");
			$result["rows"][] = $row;
		}

		$this->template($result);
	}

	/**
	 * Шаблон вывода
	 * @return void
	 */
	public function template($result)
	{
		echo '<div class="block">
		<form action="" method="GET">
		'.$this->diafan->_('Дата').': <input type="text" id="filed_date_start" name="date_start" value="'.$result["date_start"].'" class="timecalendar"> - 
		<input type="text" name="date_finish" id="filed_date_finish" value="'.$result["date_finish"].'" class="timecalendar">
		<input type="submit" value="'.$this->diafan->_('Поиск').'">
		</form>
		</div>
		<table class="list">
		<tr>
			<td><b>'.$this->diafan->_('Дата').'</b></td>
			<td><b>'.$this->diafan->_('Платежная система').'</b></td>
			<td><b>'.$this->diafan->_('Статус').'</b></td>
			<td><b>'.$this->diafan->_('Сумма').'</b></td>
			<td><b>'.$this->diafan->_('Заказ №').'</b></td>
			<td><b>'.$this->diafan->_('Пользователь').'</b></td>';
			//echo '<td></td>';
		echo '</tr>';
		foreach ($result["rows"] as $row)
		{
			echo '<tr altcolor="#eeeeee" class="tr">
			<td>'.date("d.m.Y H:i", $row["created"]).'</td>
			<td>'.$row["name"].'</td>
			<td>'.$row["status"].'</td>
			<td>'.$row["summ"].'</td>
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
		
		echo '</table>';
	}

	/**
	 * Получает список всех платежных систем
	 *
	 * @return array
	 */
	private function get_payments()
	{
		$rows = array();
		if (! $dirr = opendir(ABSOLUTE_PATH."modules/cart/payment"))
		{
			throw new Exception('Папка '.ABSOLUTE_PATH.'modules/cart/payment не существует.');
		}
		while (($row = readdir($dirr)) !== false)
		{
			if (file_exists(ABSOLUTE_PATH.'modules/cart/payment/'.$row.'/cart.payment.'.$row.'.admin.php'))
			{
				Customization::inc('modules/cart/payment/'.$row.'/cart.payment.'.$row.'.admin.php');
				$config_class = 'Cart_payment_'.$row.'_admin';
				$class = new $config_class();
				$rows[$row] = $class->config["name"];
			}
		}
		return $rows;
	}
}