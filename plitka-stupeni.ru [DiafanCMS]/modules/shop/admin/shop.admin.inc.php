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
 * Shop_admin_inc
 * 
 * Подключение модуля "Магазин" к другим модулям для административной части
 */
class Shop_admin_inc extends Diafan
{
	/**
	 * Блокирует/разблокирует различные элементы в магазине
	 * 
	 * @param string $table таблица
	 * @param array $element_ids номера элементов
	 * @param integer $act блокировать/разблокировать
	 * @return void
	 */
	public function act($table, $element_ids, $act)
	{
		// если блокирует/разблокирует скидки не через форму, пересчитывает цены
		if ($table == "shop_discount" && ! $this->diafan->save)
		{
			foreach($element_ids as $element_id)
			{
				$this->diafan->_shop->price_calc(0, $element_id);
			}
			$this->diafan->_cache->delete("", "shop");
		}
	}

	/**
	 * Восстанавливает из корзины различные элементы модуля
	 * 
	 * @param string $table таблица
	 * @param array $id номер элемента
	 * @return void
	 */
	public function restore_from_trash($table, $id)
	{
		// если восстанавливает активную скидки, пересчитывает цены
		if ($table == "shop_discount")
		{
			$result = DB::query("SELECT id FROM {shop_discount} WHERE act='1' AND id=%d", $id);
			while($row = DB::fetch_array($result))
			{
				$this->diafan->_shop->price_calc(0, $row["id"]);
			}
			$this->diafan->_cache->delete("", "shop");
		}
	}
}