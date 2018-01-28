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
 * Shop_admin_order_count
 *
 * Количество новых заказов для меню административной панели
 */
class Shop_admin_order_count extends Diafan
{
	/**
	 * Возвращает количество новых заказов для меню административной панели
	 * @return integer
	 */
	public function count()
	{
		$count = DB::query_result("SELECT COUNT(*) FROM {shop_order} WHERE status='0' AND trash='0'");
		return $count;
	}
}