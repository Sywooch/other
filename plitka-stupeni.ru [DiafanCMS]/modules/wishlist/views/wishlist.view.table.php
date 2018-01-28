<?php
/**
 * Таблица с товарами в списке желаний
 *
 * Шаблон вывода таблицы с товарами в списке желаний
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (! defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

//шапка таблицы
$text = '<table class="wishlist">
	<tr>
		<th class="wishlist_first_th"></th>
		<th>' . $this->diafan->_('Наименование товара') . '</th>
		<th>' . $this->diafan->_('Количество') . '</th>
		<th>' . $this->diafan->_('Цена') . ', ' . $result["currency"] . '</th>
		<th>' . $this->diafan->_('Сумма') . ', ' . $result["currency"] . '</th>
		<th>' . $this->diafan->_('Удалить') . '</th>
		<th class="wishlist_last_th"></th>
		
	</tr>';
//товары
if (! empty($result["rows"]))
{
	foreach ($result["rows"] as $row)
	{
		$text .= '
		<tr>
			<td class="wishlist_img">';
		if (!empty($row["img"]))
		{
			$text .= '<a href="' . BASE_PATH_HREF . $row["link"] . '"><img src="' . $row["img"]["src"] . '" width="' . $row["img"]["width"] . '" height="' . $row["img"]["height"] . '" alt="' . $row["img"]["alt"] . '" title="' . $row["img"]["title"] . '"></a> ';
		}
		$text .= '</td>
			<td class="wishlist_name"><a href="' . BASE_PATH_HREF . $row["link"] . '">' . $row["name"] . (!empty($row["article"]) ? '<br/>' . $this->diafan->_('Артикул') . ': ' . $row["article"] : '') . '</a></td>
			<td class="wishlist_count"><input type="text" value="' . $row["count"] . '" name="editshop' . $row["id"] . '" class="inpnum" size="2"></td>
			<td class="wishlist_price">' . $row["price"] . '</td>
			<td class="wishlist_summ">' . $row["summ"] . '</td>
			<td class="wishlist_delete"><input type="checkbox" name="del' . $row["id"] . '" value="1"></td>
			<td class="wishlist_buy"><span class="button_wrap"><input type="button" class="button" value="'.$this->diafan->_('Купить', false).'" good_id="' . $row["id"] . '"></span></td>
		</tr>';
	}
}


//итоговая строка таблицы
$text .= '
	<tr class="wishlist_last_tr">
		<td class="wishlist_total" colspan="2">' . $this->diafan->_('ИТОГО') . '</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td class="wishlist_summ">' . $result["summ"] . '</td>
		<td class="wishlist_last_td">&nbsp;</td>
	</tr>
</table>';

return $text;