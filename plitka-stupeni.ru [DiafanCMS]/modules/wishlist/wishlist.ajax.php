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
    include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

/**
 * Wishlist_ajax
 *
 * Обработка запроса при пересчете суммы покупки в списке желаний
 */
class Wishlist_ajax extends Ajax 
{
    /**
     * Обрабатывает полученные данные из формы
     * 
     * @return boolean
     */
    public function ajax_request()
    {
        if (! empty($_POST['module']) && $_POST['module'] == 'wishlist' && (! $this->diafan->configmodules('security_user', 'shop') || $this->diafan->_user->id) || empty($_POST["action"]))
        {
			switch($_POST["action"])
			{
				case 'recalc':
					return $this->recalc();

				case 'buy':
					return $this->buy();

				default :
					return false;
			}
		}
		return false;
	}

    /**
     * Пересчет суммы заказа
     * 
     * @return boolean
     */
	private function recalc()
	{
		$wishlist = $this->diafan->_wishlist->get();
		if ($wishlist)
		{
			foreach ($wishlist as $good_id => $array)
			{
				foreach ($array as $param => $c)
				{
					$index = $good_id.'_'.str_replace(array('{',':',';','}',' ','"',"'"), '', $param);
					if (! empty($_POST['del'.$index]))
					{
						$_POST['editshop'.$index] = 0;
					}
					$this->diafan->_wishlist->set($_POST['editshop'.$index], $good_id, $param, "count");
				}
			}
		}
		$this->diafan->_wishlist->write();
		$json["error"] = $this->diafan->_('Изменения сохранены!', false);

		if (!empty($_POST['ajax']))
		{
			Customization::inc('modules/wishlist/wishlist.model.php');
			$model  = new Wishlist_model($this->diafan);
			$result = $model->form();

			$json["table"] = $this->diafan->_tpl->get('table', 'wishlist', $result);

			echo $this->to_json($json);
		}
		else
		{
			$this->diafan->redirect($this->diafan->_route->current_link() . '?error=wishlist&mess=' . $json["error"]);
		}
		return true;
    }

	/**
	 * Добавляет товар в корзину
	 * 
	 * @return boolean
	 */
	private function buy()
	{
		if (empty($_POST['good_id']) || $this->diafan->configmodules('security_user', 'shop') && ! $this->diafan->_user->id)
		{
			return false;
		}
		$count = $this->diafan->get_param($_POST, "count", 1, 2);
		$count = $count > 0 ? $count : 1;

		$wishlist = $this->diafan->_wishlist->get();
		if ($wishlist)
		{
			foreach ($wishlist as $good_id => $array)
			{
				foreach ($array as $param => $c)
				{
					if($good_id.'_'.str_replace(array('{',':',';','}',' ','"',"'"), '', $param) == $_POST['good_id'])
					{
						if($count_cart = $this->diafan->_cart->get($good_id, $param, "count"))
						{
							$count += $count_cart;
						}
						$cart = array(
								"count" => $count,
								"is_file" => $c["is_file"],
							);
						if($this->result["error"] = $this->diafan->_cart->set($cart, $good_id, $param))
						{
							echo $this->to_json($this->result);
							return true;
						}
						$this->diafan->_cart->recalc();
						$this->diafan->_cart->write();

						$this->diafan->_wishlist->set('', $good_id, $param);
						$this->diafan->_wishlist->write();

						DB::query("UPDATE {shop} SET counter_buy=counter_buy+1 WHERE id='%d'", $good_id);

						$cart_tpl = array(
								"count" => $count,
								"summ" => $this->diafan->_shop->price_format($this->diafan->_cart->get_summ_discount()),
								"currency" => $this->diafan->configmodules("currency", "shop")
							);
						$this->result["target"] = "#show_cart";
						$this->result["data"]   = $this->diafan->_tpl->get('info', 'cart', $cart_tpl);

						$cart_link = BASE_PATH_HREF.$this->diafan->_route->module("cart", true);
						$this->result["error"] = $this->diafan->_('Товар добавлен в <a href="%s">корзину</a>', false, $cart_link);
						$this->result["success"] = true;

						Customization::inc('modules/wishlist/wishlist.model.php');
						$model  = new Wishlist_model($this->diafan);
						$result = $model->form();

						$this->result["table"] = $this->diafan->_tpl->get('table', 'wishlist', $result);

						echo $this->to_json($this->result);
						return true;
					}
				}
			}
		}
		$this->result["error"] = 'ERROR';
		echo $this->to_json($this->result);
		return true;
	}
}