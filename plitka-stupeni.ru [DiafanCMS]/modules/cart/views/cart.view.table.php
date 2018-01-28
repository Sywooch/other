<?php
/**
 * Таблица купленных товаров
 *
 * Шаблон вывода таблицы с товарами в корзине
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN')) {
    include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

//шапка таблицы
$text = '<table class="cart" style="width: 100%;">
	<tr class="title_cart">
		<th class="cart_first_th" valign="midle" align="center" >' . $this->diafan->_('Изображение ') . '</th>
		<th valign="midle" align="center" class="name_prod" >' . $this->diafan->_(' Название	 ') . '</th>
		<th valign="midle" align="center" >' . $this->diafan->_('Количество') . '</th>
		<th valign="midle" align="center" >Ед.изм.</th>
		<th valign="midle" align="center" >' . $this->diafan->_('Цена') . ', ' . $result["currency"] . '</th>
		'.($result["discount"] ? '<th valign="midle" align="center" >' . $this->diafan->_('Скидка').'</th>' : '').'
		<th valign="midle" align="center" >' . $this->diafan->_('Сумма') . ', ' . $result["currency"] . '</th>
		'.(empty($result["hide_form"]) ? '<th valign="midle" align="center"  class="cart_last_th">' . $this->diafan->_('Удалить') . '</th>' : '').'
	</tr>';
//товары
if (! empty($result["rows"]))
{
	foreach ($result["rows"] as $row)
	{
		$parent = DB::fetch_array(DB::query('SELECT r.rewrite FROM {shop_rel} sr 
												LEFT JOIN {rewrite} r ON r.module_name = "shop"
											WHERE r.element_id = sr.element_id AND sr.rel_element_id = "'.$row['id'].'"'));
		$parentURL = $parent['rewrite'].'/';
		$text .= '
		<tr class="desc_prod_cart">
			<td class="cart_images" valign="midle" align="center" >';
		if (!empty($row["img"]))
		{
			$text .= '<a href="' . BASE_PATH_HREF . $parentURL . '"><img src="' . $row["img"]["src"] . '" width="' . $row["img"]["width"] . '" height="' . $row["img"]["height"] . '" alt="' . $row["img"]["alt"] . '" title="' . $row["img"]["title"] . '"></a> ';
		}
		$text .= '</td>
			<td class="cart_name" valign="midle" align="center" >';
			if(! empty($row["cat"]))
			{
				$text .= '';
			}
			$text .= '<a  href="' . BASE_PATH_HREF . $parentURL . '">' . $row["name"];
	/*		$text .= (!empty($row["article"]) ? '<br/>' . $this->diafan->_('Артикул') . ': ' . $row["article"] : '');  */
			$text .= '</a></td>
			<td class="cart_count" valign="midle" align="center" >'.(empty($result["hide_form"]) ? ' <!-- <span class="cart_count_minus" >-</span> --> <input  type="text" value="' . $row["count"] . '" data-type="'.$row["units"].'" name="editshop' . $row["id"] . '" class="inpnum" size="2"> <!-- <span  class="cart_count_plus">+</span> --> ' : $row["count"]).'</td>
			<td valign="midle" align="center" >' . $row["units"] . '</td>
			<td class="cart_price" valign="midle" align="center" >' . $row["price"] . '</td>
			'.($result["discount"] ? '<td class="cart_discount" valign="midle" align="center" >' . ($row["discount"] ? $row["discount"].'%' : '') . '</td>' : '').'
			<td class="cart_summ" valign="midle" align="center" >' . $row["summ"] . '</td>
			'.(empty($result["hide_form"]) ? '<td class="cart_remove" valign="midle" align="center" ><span><input type="checkbox" name="del' . $row["id"] . '" value="1"></span></td>' : '').'
		</tr>';
	}

	//итоговая строка для товаров
	$text .= '
		<!-- <tr class="cart_last_tr">
			<td class="cart_total" colspan="2" valign="midle" align="center" >' . $this->diafan->_('Итого за товары') . '</td>
			<td class="cart_count" valign="midle" align="center" >' . $result["count"] . '</td>
			<td valign="midle" align="center" >&nbsp;</td>
			'.($result["discount"] ? '<td valign="midle" align="center" >&nbsp;</td>' : '').'
			<td class="cart_summ" valign="midle" align="center" >' . $result["summ_goods"] . '</td>
			'.(empty($result["hide_form"]) ? '<td class="cart_last_td" valign="midle" align="center" >&nbsp;</td>' : '').'
		</tr> --> </table><table>';

	//дополнительно
	if (! empty($result["additional_cost"])) 
	{
		$text .= '<tr><th colspan="'.($result["discount"] ? 6 : 5).'">'.$this->diafan->_('Дополнительно').'</th>
		<th class="cart_last_th">' . $this->diafan->_('Добавить') . '</th></tr>';
		foreach($result["additional_cost"] as $row)
		{
			if(! empty($result["hide_form"]) && ! in_array($row["id"], $result["cart_additional_cost"]) && ! $row["required"])
				continue;

			if ($row['amount'])
			{
				$row['text'] .= '<br>'.$this->diafan->_('Бесплатно от суммы').' '.$row['amount'].' '.$result["currency"];
			}
			$text .= '
			<tr>
				<td colspan="'.($result["discount"] ? 4 : 3).'">
					<div class="cart_additional_cost_name">'.$row["name"].'</div>
					'.(empty($result["hide_form"]) ? '<div class="cart_additional_cost_text">'.$row['text'].'</div>' : '').'
				</td>
				<td class="cart_price">'.($row['percent'] ? $row['percent'].'%' : $row["price"]).'</td>
				<td class="cart_summ">'.$row["summ"].'</td>
				'.(empty($result["hide_form"]) ? '<td class="cart_check">' : '');
			if(! $row["required"] && empty($result["hide_form"]))
			{
				$text .= '<input name="additional_cost_ids[]" value="'.$row['id'].'" type="checkbox" '.(in_array($row["id"], $result["cart_additional_cost"]) ? ' checked' : '').'>';
			}
			$text  .= (empty($result["hide_form"]) ? '</td>' : '').'
			</tr>';
		}
	}

	//способы доставки
	if (! empty($result["delivery"])) 
	{
		$text .= '<tr><th valign="midle" align="center"  colspan="'.($result["discount"] ? 6 : 5).'">'.$this->diafan->_('Способ доставки').'</th>
		<th class="cart_last_th" valign="midle" align="center" >' . $this->diafan->_('Выбрать') . '</th></tr>';
		foreach($result["delivery"] as $row)
		{
			if(! empty($result["hide_form"]) && $row["id"] != $result["cart_delivery"])
				continue;

			if (! empty($row["thresholds"]) && empty($result["hide_form"]))
			{
			    foreach($row["thresholds"]  as $r)
			    {
				if($r["amount"])
				{
				    $row['text'] .= '<br>'.($r["price"] ? $this->diafan->_('Стоимость').' '.$r["price"].' '.$result["currency"].' '.$this->diafan->_('от суммы') : $this->diafan->_('Бесплатно от суммы')).' '.$r['amount'].' '.$result["currency"];
				}
				else
				{
				    $row['text'] .= '<br>'.($r["price"] ? $this->diafan->_('Стоимость').' '.$r["price"].' '.$result["currency"] : $this->diafan->_('Бесплатно'));
				}
			    }
			}
			$text .= '
			<tr>
				<td valign="midle" align="center"  colspan="'.($result["discount"] ? 5 : 4).'">
					<div class="cart_delivery_name">'.$row["name"].'</div>
					'.(empty($result["hide_form"]) ? '<div class="cart_delivery_text">'.$row['text'].'</div>' : '').'
				</td>
				<td valign="midle" align="center"  class="cart_summ">'.$row["price"].'</td>
				'.(empty($result["hide_form"]) ? '<td class="cart_check" valign="midle" align="center" ><input name="delivery_id" value="'.$row['id'].'" type="radio" '.($row["id"] == $result["cart_delivery"] ? ' checked' : '').'></td>' : '').'
			</tr>';
		}
	}
}


//итоговая строка таблицы
$text .= '
	<!-- <tr class="cart_last_tr">
		<td class="cart_total" colspan="2" valign="midle" align="center" >' . $this->diafan->_('Итого к оплате') . '</td>
		<td valign="midle" align="center" >&nbsp;</td>
		<td valign="midle" align="center" >&nbsp;</td>
		'.($result["discount"] ? '<td valign="midle" align="center" >&nbsp;</td>' : '').'
		<td valign="midle" align="center"  class="cart_summ">' . $result["summ"] . '</td>
		'.(empty($result["hide_form"]) ? '<td valign="midle" align="center"  class="cart_last_td">&nbsp;</td>' : '').'
	</tr> -->
</table>';

$text .= '<div class="catr_bottom_conteiner"><div class="cart_table_bottom">';
$text .= '<span class="button_wrap"><input type="submit" class="btn btn2" value="' . $this->diafan->_('Пересчитать', false) . '"></span>';
# $text .= '<span class="button_wrap"><input type="submit" class="btn btn2" value="' . $this->diafan->_('Очистить', false) . '"></span>';
$text .= '<div class="to_pay">';
$text .= '<div>Сумма заказа:</div>';
$text .= '<div>' . $result["summ"] . ' руб.</div>';
$text .= '</div>';
$text .= '</div></div>';
$text .='<script>';
$text .='$(".inpnum").keyup(function(){
			var data = $(this).val();
			var type = $(this).data("type");
			$(this).val(input_check(data,type));
});';
$text .='</script>';
return $text;
