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
 * Cart
 *
 * Контроллер модуля "Корзина товаров, оформление заказа"
 */
class Cart extends Controller
{
	/**
	 * Инициализация модуля
	 * 
	 * @return void
	 */
	public function init()
	{
		if ($this->diafan->configmodules('not_buy', 'shop') || ($this->diafan->configmodules('security_user', 'shop') && ! $this->diafan->_user->id))
		return false;

		$this->rewrite_variable_names = array('step', 'show');
		$this->diafan->rewrite_variable_names = $this->rewrite_variable_names;

		$this->diafan->hide_previous_next = true;

		$model = new Cart_model($this->diafan);
		if (empty($this->diafan->step))
		{
			$this->result = $model->form();
		}
		// платежная система
		elseif ($this->diafan->step == 2 && $this->diafan->show)
		{
			$this->result = $model->payment();
		}
		//подтверждение или опровержение платежа
		elseif (($this->diafan->step == 3 || $this->diafan->step == 4))
		{
			$this->result = $model->result();
		}
		else
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}
		$this->diafan->timeedit = time();
	}

	/**
	 * Выводит контент модуля
	 * 
	 * @return boolean true
	 */
	public function show_module()
	{
		if ($this->diafan->configmodules('not_buy', 'shop') || ($this->diafan->configmodules('security_user', 'shop') && ! $this->diafan->_user->id))
		return false;

		if (empty($this->diafan->step))
		{
			$this->diafan->_tpl->get('form', 'cart', $this->result);
		}
		// платежная система
		elseif ($this->diafan->step == 2 && $this->diafan->show)
		{
			if($this->result["method"])
			{
				include_once ABSOLUTE_PATH.'modules/cart/payment/'.$this->result["method"].'/cart.payment.'.$this->result["method"].'.view.php';
			}
			else
			{
				$this->diafan->_tpl->get('payment', 'cart', $this->result);
			}
		}
		//подтверждение/опровержение платежа
		elseif (($this->diafan->step == 3 || $this->diafan->step == 4))
		{
			echo $this->diafan->_tpl->get('result', 'cart', $this->result);
		}
		return true;
	}

	/**
	 * Шаблонная функция: количество товаров в корзине
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return boolean
	 */
	public function show_block($attributes)
	{
                
		if ($this->diafan->configmodules('not_buy', 'shop') || ($this->diafan->configmodules('security_user', 'shop') && ! $this->diafan->_user->id))
			return false;

		$attributes = $this->get_attributes($attributes, 'template');

		Customization::inc('modules/cart/cart.model.php');
		$model = new Cart_model($this->diafan);
		$result = $model->show_block();

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_'.$attributes["template"], 'cart', $result))
		{
			$this->diafan->_tpl->get('show_block', 'cart', $result);
		}
		return true;
	}
}