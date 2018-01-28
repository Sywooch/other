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
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

/**
 * Subscribtion_admin_sms
 *
 * Рассылки по SMS
 */
class Subscribtion_admin_sms extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'subscribtion_sms';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Название',
			),
			'created' => array(
				'type' => 'date',
				'name' => 'Дата добавления',
				'help' => 'Вводится в формате дд.мм.гггг чч:мм',
			),
			'send' => array(
				'type' => 'checkbox',
				'name' => 'Отправить',
			),
			'hr2' => 'hr',
			'text' => array(
				'type' => 'textarea',
				'name' => 'Текст рассылки',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'date', // показывать дату в списке, сортировать по дате
		'search_name', // искать по названию
		'trash', // использовать корзину
	);

	/**
	 * Выводит список SMS-рассылок
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить SMS-рассылку');

		$this->diafan->list_row();
	}

	/**
	 * Выводит системное сообщение
	 *
	 * @return void
	 */
	public function show_error_message()
	{
		if ($this->diafan->error >= 10)
		{
			$count = $this->diafan->error - 10;
			$this->diafan->error = 0;
		}

		if (! empty($count))
		{
			echo '<div class="error">'.$this->diafan->_('Рассылка отправлена. Количество писем: ').' '.$count.'</div>';
		}
	}

	/**
	 * Редактирование поля "Отправить сообщение"
	 * @return void
	 */
	public function edit_variable_send()
	{

		if (! empty($this->diafan->values["sends"]))
			return;

		echo '
		<tr>
			<td align="right">
				'.(! empty($this->diafan->values["send"]) ? $this->diafan->_('Отправлено') : $this->diafan->variable_name()).'
			</td>
			<td>
				<input type="checkbox" name="'.$this->diafan->key.'" value="1"'.(! empty($this->diafan->values["sends"]) ? ' checked' : '').'>'
				.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Дата отправки"
	 * @return void
	 */
	public function edit_variable_created()
	{
		if ($this->diafan->addnew)
			return;

		echo '
		<tr>
			<td align="right">
				'.($this->diafan->values["send"] ? $this->diafan->_('Дата отправки') : $this->diafan->variable_name()).'
			</td>
			<td>
				'.date("D, d M Y H:i:s", ($this->diafan->value ? $this->diafan->value : time()))
				.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Сохранение поля "Дата отправки"
	 * @return void
	 */
	public function save_variable_created()
	{
		$created = $this->diafan->oldrow["created"];

		if (! $created || ! empty($_POST["text"]) && ! empty($_POST["send"]))
		{
			$created = time();
		}

		$this->diafan->set_query("created='%d'");
		$this->diafan->set_value($created);
	}

	/**
	 * Сохранение поля "Отправить рассылку"
	 * @return void
	 */
	public function save_variable_send()
	{
		if (empty($_POST["text"]) && ! empty($_POST["send"]))
		{
			$this->diafan->err = 10;
			return;
		}

		if (empty($_POST["send"]) || empty($_POST["text"]))
		{
			return;
		}

		$result = DB::query("SELECT phone FROM {subscribtion_phones} WHERE act='1' AND trash='0'");
		while ($row = DB::fetch_array($result))
		{
			include_once(ABSOLUTE_PATH."includes/sms.php");
			Sms::send($_POST["text"], $row["phone"]);
			$k++;
		}
		$this->diafan->err = 10 + $k;

		$this->diafan->set_query("send='%d'");
		$this->diafan->set_value(1);
	}
}