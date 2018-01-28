<?php

/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
	include dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/includes/404.php';
}

/**
 * Платежная квитанция на опталу
 */

if (preg_match('/(.*)\/([0-9]+)\/(.*)$/', $_GET["rewrite"], $match))
{
    $type = $match[1];
    $order_id = $match[2];
    $code = $match[3];
}
if (empty($order_id))
{
    include_once ABSOLUTE_PATH."includes/404.php";
}

if ($type == 'non_cash/memo')
{
	if (! $this->diafan->_user->roles('init', 'shop/order'))
	{
		include_once ABSOLUTE_PATH."includes/404.php";
	}
}

$row = DB::fetch_array(DB::query("SELECT user_id, summ, created, payment_id, delivery_id, delivery_summ FROM {shop_order} WHERE id=%d AND code='%s' AND trash='0' LIMIT 1", $order_id, $code));

if (empty($row))
{
    include_once ABSOLUTE_PATH."includes/404.php";
}

$values = unserialize(DB::query_result("SELECT params FROM {shop_payment} WHERE id=%d LIMIT 1", $row['payment_id']));

if (empty($values) && $type != 'non_cash/memo')
{
    include_once ABSOLUTE_PATH."includes/404.php";
}

$order_created = $row["created"];
$order_summ = $row["summ"];

$values["delivery"] = array();
if($row["delivery_id"])
{
	$values["delivery"] = DB::fetch_array(DB::query("SELECT [name] FROM {shop_delivery} WHERE id=%d LIMIT 1", $row["delivery_id"]));
	$values["delivery"]['price'] = $row["delivery_summ"];
}
$user_fio = '';
$result = DB::query("SELECT id, [name] FROM {shop_order_param} WHERE trash='0'");
while ($row = DB::fetch_array($result))
{
	switch($row["name"])
	{
		case 'ФИО':
		case 'Название':
		case 'ФИО или название компании':
			$user_fio = DB::query_result("SELECT value FROM {shop_order_param_element} WHERE param_id=%d AND element_id=%d LIMIT 1", $row["id"], $order_id);
			break;
		case 'Телефон':
		case 'Контактные телефоны (с кодом города)':
			$user_phone = DB::query_result("SELECT value FROM {shop_order_param_element} WHERE param_id=%d AND element_id=%d LIMIT 1", $row["id"], $order_id);
			break;
		case 'Индекс':
			$user_index = DB::query_result("SELECT value FROM {shop_order_param_element} WHERE param_id=%d AND element_id=%d LIMIT 1", $row["id"], $order_id);
			break;
		case 'Город':
			$user_city = DB::query_result("SELECT value FROM {shop_order_param_element} WHERE param_id=%d AND element_id=%d LIMIT 1", $row["id"], $order_id);
			break;
		case 'Улица':
		case 'Улица, проспект и пр.':
			$user_street = DB::query_result("SELECT value FROM {shop_order_param_element} WHERE param_id=%d AND element_id=%d LIMIT 1", $row["id"], $order_id);
			break;
		case 'Дом':
		case 'Номер дома':
			$user_dom = DB::query_result("SELECT value FROM {shop_order_param_element} WHERE param_id=%d AND element_id=%d LIMIT 1", $row["id"], $order_id);
			break;
		case 'Квартира':
		case 'Квартира, офис':
			$user_kv = DB::query_result("SELECT value FROM {shop_order_param_element} WHERE param_id=%d AND element_id=%d LIMIT 1", $row["id"], $order_id);
			break;
	}
}

$months_array = array(
	'01' => $this->diafan->_('января'),
	'02' => $this->diafan->_('февраля'),
	'03' => $this->diafan->_('марта'),
	'04' => $this->diafan->_('апреля'),
	'05' => $this->diafan->_('мая'),
	'06' => $this->diafan->_('июня'),
	'07' => $this->diafan->_('июля'),
	'08' => $this->diafan->_('августа'),
	'09' => $this->diafan->_('сентября'),
	'10' => $this->diafan->_('октября'),
	'11' => $this->diafan->_('ноября'),
	'12' => $this->diafan->_('декабря')
);

if ($type == 'non_cash/ul')
{
	$values["order_id"] = $order_id;
	$values["user_fio"] = $user_fio;
	$values["order_created"] = date("d.m.Y", $order_created);
	
	$values["goods"] = array();

    $order_summ = 0;
    $order_count = 0;
    $result = DB::query("SELECT * FROM {shop_order_goods} where order_id = %d", $order_id);
    while ($row = DB::fetch_array($result))
    {
		$order_summ += $row["price"] * $row["count_goods"];
		$order_count += $row["count_goods"];
		$depend = '';
		$result_p = DB::query("SELECT * FROM {shop_order_goods_param} WHERE order_good_id=%d", $row["id"]);
		while ($row_p = DB::fetch_array($result_p))
		{
			if(! $row_p["value"])
				continue;
			$param_name = DB::query_result("SELECT [name] FROM {shop_param} WHERE id=%d LIMIT 1", $row_p["param_id"]);
			$param_value = DB::query_result("SELECT s.[name] FROM {shop_param_select} as s WHERE s.id=%d AND s.param_id=%d LIMIT 1", $row_p["value"], $row_p["param_id"]);
			$depend .= ($depend ? ', ' : ' ').$param_name.': '.$param_value;
		}
		$row["name"] = DB::query_result("SELECT [name] FROM {shop} WHERE id=%d LIMIT 1", $row["good_id"]).$depend;
		$row["summ"] = $this->diafan->_shop->price_format($row["price"] * $row["count_goods"]);
		$row["price"] = $this->diafan->_shop->price_format($row["price"]);
		$values["goods"][] = $row;
    }
	if($values["delivery"])
	{
		$order_summ += $values["delivery"]['price'];
		$values["delivery"]['price'] = $this->diafan->_shop->price_format($values["delivery"]['price']);
		$values["delivery"]['summ'] = $this->diafan->_shop->price_format($values["delivery"]['price']);
    }
	$values['summ'] = $this->diafan->_shop->price_format($order_summ);
	$values['count'] = $order_count;
	$values['nds'] = (!empty($values["non_cash_nds"])) ? $this->diafan->_shop->price_format($order_summ * 100 / (100 + $values["non_cash_nds"])) : '-';
	include (ABSOLUTE_PATH."modules/cart/payment/non_cash/cart.payment.non_cash.num2str.php");
	$ns = new Num_to_str;
	$values['str_summ'] = $ns->get($order_summ);
	include ABSOLUTE_PATH.'modules/cart/payment/non_cash/cart.payment.non_cash.ul_tpl.php';
}
elseif($type == 'non_cash/memo')
{
	$values["order_id"] = $order_id;
	$values["date_d"] = date("d", $order_created);
	$values["date_m"] = $months_array[date("m", $order_created)];
	$values["date_y"] = date("Y", $order_created);
	
	$values["goods"] = array();

	$order_summ = 0;
	$order_count = 0;
	$result = DB::query("SELECT * FROM {shop_order_goods} where order_id = %d", $order_id);
	while ($row = DB::fetch_array($result))
	{
		$order_summ += $row["price"] * $row["count_goods"];
		$order_count += $row["count_goods"];
		$depend = '';
		$result_p = DB::query("SELECT * FROM {shop_order_goods_param} WHERE order_good_id=%d", $row["id"]);
		while ($row_p = DB::fetch_array($result_p))
		{
			if(! $row_p["value"])
				continue;
			$param_name = DB::query_result("SELECT [name] FROM {shop_param} WHERE id=%d LIMIT 1", $row_p["param_id"]);
			$param_value = DB::query_result("SELECT s.[name] FROM {shop_param_select} as s WHERE s.id=%d AND s.param_id=%d LIMIT 1", $row_p["value"], $row_p["param_id"]);
			$depend .= ($depend ? ', ' : ' ').$param_name.': '.$param_value;
		}
		$row["name"] = DB::query_result("SELECT [name] FROM {shop} WHERE id=%d LIMIT 1", $row["good_id"]).$depend;
		$row["summ"] = $this->diafan->_shop->price_format($row["price"] * $row["count_goods"]);
		$row["price"] = $this->diafan->_shop->price_format($row["price"]);
		$values["goods"][] = $row;
	}
	if($values["delivery"])
	{
		$order_summ += $values["delivery"]['price'];
		$values["delivery"]['price'] = $this->diafan->_shop->price_format($values["delivery"]['price']);
	}
	$values['summ'] = $this->diafan->_shop->price_format($order_summ);
	$values['count_goods'] = $order_count;
	include (ABSOLUTE_PATH."modules/cart/payment/non_cash/cart.payment.non_cash.num2str.php");
	$ns = new Num_to_str;
	$values['str_summ'] = $ns->get($order_summ);
	include ABSOLUTE_PATH.'modules/cart/payment/non_cash/cart.payment.non_cash.memo_tpl.php';
}
else
{
	$desc_order = DB::query_result("SELECT value FROM {config} WHERE module_name='shop' AND name='desc_order' AND lang_id='0' LIMIT 1");
	$order_name = str_replace('%order', $order_id, $desc_order);

	foreach(array(
		'non_cash_name',
		'non_cash_kpp',
		'non_cash_inn',
		'non_cash_tax_department',
		'non_cash_okato',
		'non_cash_ogrn',
		'non_cash_rs',
		'non_cash_bank',
		'non_cash_bik',
		'non_cash_ks',
		'non_cash_kbk',
		'non_cash_address',
		'non_cash_director',
		'non_cash_glbuh') as $name)
	{
		if(! isset($values[$name]))
		{
			$values[$name] = '';
		}
	}

	$values["order_name"] = $order_name;
	$values['user_fio'] = $user_fio;
	$values["summ_rub"] = $this->diafan->_shop->price_format(floor($order_summ));
	$values["summ_kop"] = $order_summ%1;
	$values["date_d"] = date("d", $order_created);
	$values["date_m"] = $months_array[date("m", $order_created)];
	$values["date_y"] = date("Y", $order_created);

	include ABSOLUTE_PATH.'modules/cart/payment/non_cash/cart.payment.non_cash.fl_tpl.php';
}