<?php
/**
 * Заказы пользователя
 *
 * Шаблон вывода заказов пользователя
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

if (empty($result['order']))
	return true;

$color = array(
	0 => "red",
	1 => "blue",
	2 => "gray",
	3 => "darkgreen",
	4 => "darkgreen"
);

echo '<div class="block_header">'.$this->diafan->_('Ваши заказы').'</div>';
echo '<table border="0" style="width:100%">
		<tr>
		<th><b>№</b></td>
		<th><b>'.$this->diafan->_('Дата').'</b></td>
		<th><b>'.$this->diafan->_('Товары').'</b></td>
		<th><b>'.$this->diafan->_('Статус').'</b></td>
		<th><b>'.$this->diafan->_('Сумма').'</b></td>
		</tr>';

foreach ($result['order'] as $order)
{
	echo '<tr>';
	echo '<td>' . $order['id'] . '</td>';
	echo '<td>' . $order['created'] . '</td>';
	echo '<td><div class="order_goods">';

	if (!empty($order['goods']))
	{
		foreach ($order['goods'] as $tovar)
		{
			echo $tovar . '<br>';
		}
	}

	echo '</div></td>';

	echo '<td>';
	echo '<span style="color:' . $color[$order["status"]] . ';font-weight: bold;">';
	echo $order['status_name'];
	echo '</span>';
	echo '</td>';
	echo '<td>' . $order['summ'] . '</td>';
	echo '</tr>';
}

echo '
<tr>
	<td colspan=4 align=right>'.$this->diafan->_('Итого выполненных заказов сумму').': </td>
	<td><b>' . $result['itogo'] . '</b></td>
</tr>';
echo '</table>';