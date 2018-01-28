<?php
/**
 * Способы доставки
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

class Shop_admin_delivery extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'shop_delivery';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Название',
				'multilang' => true,
			),
			'thresholds' => array(
				'type' => 'floattext',
				'name' => 'Стоимость',
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'default' => true,
				'multilang' => true,
			),
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
			'text' => array(
				'type' => 'textarea',
				'name' => 'Описание',
				'multilang' => true,
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'act', // показать/скрыть
		'trash', // использовать корзину
		'order', // сортируется
	);

	/**
	 * Выводит список способов доставки
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить');
		$this->diafan->list_row();
	}

	/**
	 * Редактирование поля "Стоимость"
	 * @return void
	 */
	public function edit_variable_thresholds()
	{
		$rows  = array();
		if(! $this->diafan->addnew)
		{
			$result = DB::query("SELECT amount, price FROM {shop_delivery_thresholds} WHERE delivery_id=%d ORDER BY price DESC", $this->diafan->edit);
			while($row = DB::fetch_array($result))
			{
				$rows[] = $row;
			}
		}
		if(! $rows)
		{
			$rows[] = array("amount" => 0, "price" => 0);
		}
		echo '
		<script type="text/javascript" src="' . BASE_PATH . 'modules/shop/admin/shop.admin.delivery.js"></script>
		<tr id="thresholds" valign="top">
			<td class="td_first">
				'.$this->diafan->variable_name().'
			</td>
			<td>
			<table>';
			foreach($rows as $row)
			{
				echo '<tr class="threshold"><td>
				<input type="text" name="price[]" size="20" value="'.$row["price"].'">
				'.$this->diafan->_('от суммы').' <input type="text" name="amount[]" size="20" value="'.$row["amount"].'">
				<span class="threshold_actions">
							<a href="javascript:void(0)" action="delete_threshold" confirm="'.$this->diafan->_('Вы действительно хотите удалить запись?').'"><img src="'.BASE_PATH.'adm/img/delete.png" width="13" height="13" alt="'.$this->diafan->_('Удалить').'"></a>
				</span>
				</td></tr>';
			}
			echo '</table>
			<a href="javascript:void(0)" class="threshold_plus" title="'.$this->diafan->_('Добавить').'"><img src="'.BASE_PATH.'adm/img/add.png" width="16" height="16" alt="'.$this->diafan->_('Добавить').'"></a>';
			echo $this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Сохранение поля "Стоимость"
	 * @return void
	 */
	public function save_variable_thresholds()
	{
		if(! $this->diafan->savenew)
		{
			DB::query("DELETE FROM {shop_delivery_thresholds} WHERE delivery_id=%d", $this->diafan->save);
		}

		if (! empty($_POST["price"]))
		{
			foreach ($_POST["price"] as $i => $price)
			{
				$amount = $_POST["amount"][$i];
				if($price || $amount)
				{
					DB::query("INSERT INTO {shop_delivery_thresholds} (delivery_id, price, amount) VALUES (%d, %f, %f)", $this->diafan->save, $price, $amount);
				}
			}
		}
	}
}