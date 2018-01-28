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
 * Подключение модуля "Магазин"
 */
class Shop_inc extends Diafan
{
	/**
	 * @var object бэкэнд
	 */
	private $backend;

	/**
	 * Подключает расширения для подключения
	 * 
	 * @return mixed
	 */
	public function __call($name, $args)
	{
		list($prefix, $method) = explode('_', $name, 2);
		switch($prefix)
		{
			case 'price':
				if(! isset($this->backend['price']))
				{
					Customization::inc('modules/shop/inc/shop.inc.price.php');
					$this->backend['price'] = new Shop_inc_price($this->diafan);
				}
				$shop = &$this->backend['price'];
				break;

			case 'order':
				if(! isset($this->backend['order']))
				{
					Customization::inc('modules/shop/inc/shop.inc.order.php');
					$this->backend['order'] = new Shop_inc_order($this->diafan);
				}
				$shop = &$this->backend['order'];
				break;

			default:
				return false;
		}
		return call_user_func_array(array(&$shop, $method), $args);
	}
}