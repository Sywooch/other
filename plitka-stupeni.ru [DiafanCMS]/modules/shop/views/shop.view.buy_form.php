<?php
/**
 * Кнопка «Купить»
 *
 * Шаблон вывода кнопки «Купить», в котором характеристики, влияющие на цену выводятся в виде выпадающего списка
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


if (empty($result["row"]['price_arr']))
	return false;

echo '
<form method="post" action="" class="shop_form ajax">
<input type="hidden" name="good_id" value="'. $result["row"]["id"].'">
<input type="hidden" name="module" value="shop">
<input type="hidden" name="action" value="buy">
<input type="hidden" name="ajax" value="">';

if ($result["row"]["no_buy"] || empty($result["row"]["count"]))
{
	echo '<div class="shop_no_buy shop_no_buy_good">' . $this->diafan->_('Товар временно отсутствует') . '</div>';
	$hide_submit = true;
	$waitlist = true;
}

// у товара несколько цен
if ($result["row"]["price_arr"])
{
	echo '<div class="shop_form_param">';
	foreach ($result["result"]["depends_param"] as $param)
	{
		if(! empty($result["row"]["param_multiple"][$param["id"]]))
		{
			if(count($result["row"]["param_multiple"][$param["id"]]) == 1)
			{
				foreach($result["row"]["param_multiple"][$param["id"]] as $value => $depend)
				{
					echo '<input type="hidden" name="param'.$param["id"].'" value="'.$value.'"'.($depend == 'depend' ? ' class="depend_param"' : '').'>';
				}
			}
			else
			{
				$select = '';
				foreach($param["values"] as $value)
				{
					if(! empty($result["row"]["param_multiple"][$param["id"]][$value["id"]]))
					{
						if(! $select)
						{
							$select = $param["name"].': <select name="param'.$param["id"].'" class="inpselect'.($result["row"]["param_multiple"][$param["id"]][$value["id"]] == 'depend' ? ' depend_param' : '').'">';
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
	foreach($result["row"]["price_arr"] as $price)
	{
		$param_code = '';
		foreach($price["param"] as $p)
		{
			if($p["value"])
			{
				$param_code .= ' param'.$p["id"].'="'.$p["value"].'"';
			}
		}
		if(! empty($price["image_rel"]))
		{
		    $param_code .= ' image_id="'.$price["image_rel"].'"';
		}
		echo '<div class="shop_param_price"'.$param_code.'>';
			echo '<div class="shop_price">' . $this->diafan->_('Цена') . ': <span class="shop_price_value">' . $price["price"] . '</span> <span class="shop_price_currency">' . $result["result"]["currency"] . '</span></div>';
			if (!empty($price["old_price"]))
			{
				echo '<div class="shop_old_price">' . $this->diafan->_('Старая цена') . ': <span class="shop_price_value">' . $price["old_price"] . '</span>'
				. ' <span class="shop_price_currency">' . $result["result"]["currency"] . '</span></div>';
			}
			if (! $price["count"] && empty($hide_submit))
			{
				echo '<span class="shop_no_buy">' . $this->diafan->_('Товар временно отсутствует') . '</span>';
				$waitlist = true;
			}
		echo '</div>';
	}
}
if(! empty($waitlist))
{
	echo '
	<div class="shop_waitlist">
		'.$this->diafan->_('Сообщить когда появиться на e-mail').'
		<input type="text" name="mail" value="'.$this->diafan->_user->mail.'" class="inptext">
		<span class="button_wrap"><input type="button" class="button" value="'.$this->diafan->_('Ок', false).'" action="wait"></span>
		<div class="errors error_waitlist" style="display:none"></div>
	</div>';
}
if (empty($result["row"]['is_file']) && (empty($hide_submit) || $result["result"]["wishlist_link"]))
{
	echo '<input type="text" class="inpnum" value="1" name="count" size="1">';
}
if(empty($hide_submit))
{
	echo '<span class="button_wrap"><input type="button" class="button" value="'.$this->diafan->_('Купить', false).'" action="buy"></span>';
}
if($result["result"]["wishlist_link"])
{
	echo '<span class="button_wrap"><input type="button" class="button" value="'.$this->diafan->_('Отложить', false).'" action="wish"></span>';
}

echo '<div class="error">';
if (!empty($result["row"]["count_in_cart"]))
{
	echo $this->diafan->_('В <a href="%s">корзине</a> %s шт.', true, BASE_PATH_HREF . $result["result"]["cart_link"], $result["row"]["count_in_cart"]);
}
echo '</div>';
echo '</form>';
if(empty($GLOBALS["include_shop_js"]))
{
	$GLOBALS["include_shop_js"] = true;
	echo '<script type="text/javascript" src="'.BASE_PATH.'modules/shop/shop.js"></script>';
}