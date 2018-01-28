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
 * Shop_admin_payment
 *
 * Редактирование методов оплаты
 */
class Shop_admin_payment extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'shop_payment';

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
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'default' => true,
				'multilang' => true,
			),
			'payment' => array(
				'type' => 'function',
				'name' => 'Платежная система',
				'help' => 'Параметры подключения выдаются платежными системами при одобрении Вашего магазина',
			),
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
			'text' => array(
				'type' => 'editor',
				'name' => 'Описание',
				'multilang' => true,
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'act', // показать/скрыть
		'del', // удалить
		'order', // сортируется
		'trash', // использовать корзину
	);

	/**
	 * Выводит список методов оплаты
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить');
		$this->diafan->list_row();
	}

	/**
	 * Редактирование поля "Платежная система"
	 * @return void
	 */
	public function edit_variable_payment()
	{
		$rows = $this->get_rows();
		$values = array();
		if ( ! $this->diafan->addnew)
		{
			$values = unserialize(DB::query_result("SELECT params FROM {" . $this->diafan->table . "} WHERE id=%d LIMIT 1", $this->diafan->edit));
		}
		echo '
		<script type="text/javascript">
		$(document).ready(function(){
			$("select[name=payment]").change(function(){
				$(".tr_payment").hide();
				$(".tr_payment[payment="+$(this).val()+"]").show();
			});
			$(".tr_payment[payment="+$("select[name=payment]").val()+"]").show();
		});
		</script>
		<tr>
			<td class="td_first">
				' . $this->diafan->variable_name() . '
			</td>
			<td><select name="payment"><option value="">-</option>';
		foreach($rows as $row)
		{
			echo '<option value="'.$row["name"].'"'.($this->diafan->value == $row["name"] ? ' selected' : '').'>'.$row["config"]["name"].'</option>';
		}
		echo '</select></td>
		</tr>';

		foreach ($rows as $row)
		{
			foreach ($row["config"]["params"] as $key => $name)
			{
				if(is_array($name))
				{
					if($name["type"] == 'function')
					{
						$config_class = 'Cart_payment_'.$row["name"].'_admin';
						$class = new $config_class();
						if (is_callable(array(&$class, "edit_variable_".$key)))
						{
							call_user_func_array(array(&$class, "edit_variable_".$key), array());
							continue;
						}
					}
					$type = $name["type"];
					$name = $name["name"];
				}
				else
				{
					$type = 'text';
				}
				echo '<tr class="tr_payment" payment="'.$row["name"].'" style="display:none">
					<td class="td_first">' . $this->diafan->_($name) . '</td><td>';
		
				switch($type)
				{
					case 'checkbox':
					echo '<input type="checkbox" value="1"'.(! empty($values[$key]) ? ' checked' : '').' name="'.$key.'">';
					break;
		
					default:
					echo '<input type="text" value="'.(! empty($values[$key]) ? $values[$key] : '').'" size="40" name="'.$key.'">';
					
				}
				echo '</td></tr>';
			}
		}
	}

	/**
	 * Сохранение поля "Платежная система"
	 * @return void
	 */
	public function save_variable_payment()
	{
		if ( empty($_POST['payment']))
			return;

		$payment = $this->diafan->get_param($_POST, "payment", '', 1);
		if (! file_exists(ABSOLUTE_PATH.'modules/cart/payment/'.$payment.'/cart.payment.'.$payment.'.admin.php'))
		{
			return;
		}
		Customization::inc('modules/cart/payment/'.$payment.'/cart.payment.'.$payment.'.admin.php');
		$config_class = 'Cart_payment_'.$payment.'_admin';
		$class = new $config_class($this->diafan);

		$values = array();
		foreach ($class->config["params"] as $key => $name)
		{
			if(! empty($name["type"]) && $name["type"] == 'function')
			{
				if (is_callable(array(&$class, "save_variable_".$key)))
				{
					call_user_func_array(array(&$class, "save_variable_".$key), array());
					continue;
				}
			}
			if ( ! empty($_POST[$key]))
			{
				$values[$key] = $this->diafan->get_param($_POST, $key, '', 1);
			}
		}
		$this->diafan->set_query("payment='%s'");
		$this->diafan->set_value($payment);

		$this->diafan->set_query("params='%s'");
		$this->diafan->set_value(serialize($values));
		return true;
	}

	/**
	 * Получает список всех платежных систем
	 *
	 * @return array
	 */
	private function get_rows()
	{
		$rows = array();
		if (! $dirr = opendir(ABSOLUTE_PATH."modules/cart/payment"))
		{
			throw new Exception('Папка '.ABSOLUTE_PATH.'modules/cart/payment не существует.');
		}
		while (($row = readdir($dirr)) !== false)
		{
			if (file_exists(ABSOLUTE_PATH.'modules/cart/payment/'.$row.'/cart.payment.'.$row.'.admin.php'))
			{
				Customization::inc('modules/cart/payment/'.$row.'/cart.payment.'.$row.'.admin.php');
				$config_class = 'Cart_payment_'.$row.'_admin';
				$class = new $config_class();
				$rows[] = array("name" => $row, "config" => $class->config);
			}
		}
		return $rows;
	}
}
