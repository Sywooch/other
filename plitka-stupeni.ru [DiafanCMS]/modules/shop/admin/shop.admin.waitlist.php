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
 * Shop_admin_waitlist
 *
 * Список ожиданий
 */
class Shop_admin_waitlist extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'shop_waitlist';

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'datetime', // показывать дату в списке, сортировать по дате
		'trash', // использовать корзину
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array (
		'mail' => 'string',
		'good_id' => 'function',
		'user_id' => 'function',
		'param' => 'none',
	);

	/**
	 * @var array текст для ссылки на редактирование в списке
	 */
	public $text_for_base_link = array();

	/*
	 * @var array локальный кэш модуля
	 */
	private $cache;

	/**
	 * Выводит список заказов
	 * @return void
	 */
	public function show()
	{
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
		$get_nav_params["search_date_start"] = '';
		$get_nav_params["search_date_finish"] = '';

		if (! empty($_GET["search_date_start"]))
		{
			$date_start = $this->diafan->unixdate($_GET["search_date_start"]);
			$this->diafan->where .= " AND created>=".$date_start;
			$get_nav_params["search_date_start"] = date('d.m.Y H:i', $date_start);
			$this->diafan->get_nav .= ( $this->diafan->get_nav ? '&amp;' : '?' ) . 'search_date_start='. $get_nav_params["search_date_start"];
		}
		if (! empty($_GET["search_date_finish"]))
		{
			$date_finish = $this->diafan->unixdate($_GET["search_date_finish"]);
			$this->diafan->where .= " AND created<=".$date_finish;
			$get_nav_params["search_date_finish"] = date('d.m.Y H:i', $date_finish);
			$this->diafan->get_nav .= ( $this->diafan->get_nav ? '&amp;' : '?' ) . 'search_date_finish=' . $get_nav_params["search_date_finish"];
		}
		$this->diafan->get_nav_params = $get_nav_params;
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
		'.$this->diafan->_('Дата').': <input type="text" name="search_date_start" value="'.$this->diafan->get_nav_params["search_date_start"].'" class="timecalendar"> - 
		<input type="text" name="search_date_finish" value="'.$this->diafan->get_nav_params["search_date_finish"].'" class="timecalendar">
		<input type="submit" value="'.$this->diafan->_('Поиск').'"  class="button">
		</form>';
		
		$date = $this->set_date_interval();
		$html .= '<div class="order_count_type">';
		foreach ($date as $type=> $i)
		{
			$html .= '<a href="?search_date_start=' . $i[0] . '&search_date_finish=' . $i[1] . '">' . $this->diafan->_($type) . '</a>';
		}
		$html .= '</div>';
		return $html;
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

	/**
	 * Выводит товар
	 * @return string
	 */
	public function other_row_good_id($row)
	{
		$params = unserialize($row["param"]);
		if(! isset($this->cache["goods"][$row["good_id"]]))
		{
			$good = DB::fetch_array(DB::query("SELECT [name], article FROM {shop} WHERE id=%d LIMIT 1", $row["good_id"]));

			
			$this->cache["goods"][$row["good_id"]]["link"] = BASE_PATH_HREF.'shop/edit'.$row["good_id"].'/';

			$this->cache["goods"][$row["good_id"]]["name"] = $good["name"].($good["article"] ? " ".$good["article"] : '');
		}
		$name = $this->cache["goods"][$row["good_id"]]["name"];
		foreach ($params as $id => $value)
		{
			if (! isset($this->cache["param_names"][$id]))
			{
				$this->cache["param_names"][$id] = DB::query_result("SELECT [name] FROM {shop_param} WHERE id=%d LIMIT 1", $id);
			}
			if (! isset($this->cache["select_names"][$id][$value]))
			{
				$this->cache["select_names"][$id][$value] =
					DB::query_result("SELECT [name] FROM {shop_param_select} WHERE param_id=%d AND id=%d LIMIT 1", $id, $value);
			}
			$name .= ', '.$this->cache["param_names"][$id].': '.$this->cache["select_names"][$id][$value];
		}
		$link = $this->cache["goods"][$row["good_id"]]["link"];

		return '<td class="name"><a href="'.$link.'">'.$name.'</a></td>';
	}

	/**
	 * Выводит пользователя
	 * @return string
	 */
	public function other_row_user_id($row)
	{
		if(! $row["user_id"])
		{
			return '<td></td>';
		}
		if(! isset($this->cache["user_id"][$row["user_id"]]))
		{
			$this->cache["user_id"][$row["user_id"]]["link"] = BASE_PATH_HREF.'users/edit'.$row["user_id"].'/';
			$this->cache["user_id"][$row["user_id"]]["fio"]  = DB::query_result("SELECT CONCAT(fio, ' (', name, ')') FROM {users} WHERE id=%d LIMIT 1", $row["user_id"]);
		}
		$link = $this->cache["user_id"][$row["user_id"]]["link"];
		$fio = $this->cache["user_id"][$row["user_id"]]["fio"];
		return '<td class="name"><a href="'.$link.'">'.$fio.'</a></td>';
	}
}