<?php
/**
 * Кнопки «Купить» на каждый вариант товара
 *
 * Шаблон вывода кнопки «Купить», в котором каждой характеристике, влияющей на цену выведена отдельная кнопка «Купить»
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}
 
if (!$result["result"]["buy"])
	return false;

if (empty($result["row"]['price']) && empty($result["row"]['price_arr']))
	return false;

if ($result["row"]["price_arr"])
{
	$depends_param = array();
	foreach ($result["result"]["depends_param"] as $param)
	{
		$depends_param[$param["id"]]["name"] = $param["name"];
		foreach($param["values"] as $value)
		{
			$depends_param[$param["id"]]["values"][$value["id"]] = $value["name"];
		}
	}
	foreach($result["row"]["price_arr"] as $price)
	{
		echo '<form method="post" action="" class="shop_form ajax">
		<input type="hidden" name="good_id" value="' . $result["row"]["id"] . '">
		<input type="hidden" name="module" value="shop">
		<input type="hidden" name="action" value="buy">
		<input type="hidden" name="ajax" value="">';
		echo '<div class="shop_form_param">';
		foreach($price["param"] as $param)
		{
			echo ' <input type="hidden" name="param'.$param["id"].'" value="'.$param["value"].'">';
			echo $depends_param[$param["id"]]["name"].': '.$depends_param[$param["id"]]["values"][$param["value"]];
		}
		foreach ($result["result"]["depends_param"] as $param)
		{
			if(! empty($result["row"]["param_multiple"][$param["id"]]))
			{
				if(count($result["row"]["param_multiple"][$param["id"]]) == 1)
				{
					foreach($result["row"]["param_multiple"][$param["id"]] as $value => $depend)
					{
						if($depend == 'select')
						{
							echo '<input type="hidden" name="param'.$param["id"].'" value="'.$value.'">';
						}
					}
				}
				else
				{
					$select = '';
					foreach($param["values"] as $value)
					{
						if(! empty($result["row"]["param_multiple"][$param["id"]][$value["id"]])
						   && $result["row"]["param_multiple"][$param["id"]][$value["id"]] == 'select')
						{
							if(! $select)
							{
								$select = ' '.$param["name"].': <select name="param'.$param["id"].'" class="inpselect'.($result["row"]["param_multiple"][$param["id"]][$value["id"]] == 'depend' ? ' depend_param' : '').'">';
							}
	
							$select .= '<option value="'.$value["id"].'"'
							.(! empty($_GET["p" . $param["id"]]) && $_GET["p" . $param["id"]] == $value["id"] ? ' selected' : '')
							.'>'.$value["name"].'</option>';
						}
					}
					if($select)
					{
						echo $select.'</select> ';
					}
				}
			}
		}
		echo '</div>';
		echo '<div class="shop_price">' . $this->diafan->_('Цена') . ': <span class="shop_price_value">' . $price["price"] . '</span> <span class="shop_price_currency">' . $result["result"]["currency"] . '</span></div>';
		if (!empty($price["old_price"]))
		{
			echo '<div class="shop_old_price">' . $this->diafan->_('Старая цена') . ': <span class="shop_price_value">' . $price["old_price"] . '</span>'
			. ' <span class="shop_price_currency">' . $result["result"]["currency"] . '</span></div>';
		}
		if (! $price["count"] || $result["row"]["no_buy"])
		{
			echo '<div class="shop_no_buy">' . $this->diafan->_('Товар временно отсутствует') . '</div>';
			echo '
			<div class="shop_waitlist">
				'.$this->diafan->_('Сообщить когда появиться на e-mail').'
				<input type="text" name="mail" value="'.$this->diafan->_user->mail.'" class="inptext">
				<span class="button_wrap"><input type="button" class="button" value="'.$this->diafan->_('Ок', false).'" action="wait"></span>
				<div class="errors error_waitlist" style="display:none"></div>
			</div>';
		}
		if (empty($result["row"]['is_file']) && ($price["count"] && ! $result["row"]["no_buy"] || $result["result"]["wishlist_link"]))
		{
			echo '<input type="text" class="inpnum" value="1" name="count" size="1">';
		}
		if($price["count"] && ! $result["row"]["no_buy"])
		{
			echo '<span class="button_wrap"><input type="button" class="button" value="' . $this->diafan->_('Купить', false) . '" action="buy"></span>';
		}
		if($result["result"]["wishlist_link"])
		{
			echo '<span class="button_wrap"><input type="button" class="button" value="'.$this->diafan->_('Хочу', false).'" action="wish"></span>';
		}
		echo '<div class="error">';
		if (!empty($price["count_in_cart"]))
		{
			echo $this->diafan->_('В <a href="%s">корзине</a> %s шт.', true, BASE_PATH_HREF . $result["result"]["cart_link"], $price["count_in_cart"]);
		}
		echo '</div>
		</form>';
	}
}
