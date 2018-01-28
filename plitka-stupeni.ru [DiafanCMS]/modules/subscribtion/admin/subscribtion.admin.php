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
 * Subscribtion_admin
 *
 * Рассылки
 */
class Subscribtion_admin extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'subscribtion';

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
				'type' => 'editor',
				'name' => 'Описание',
			),
			'cat_id' => array(
				'type' => 'select',
				'name' => 'Категория',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'date', // показывать дату в списке, сортировать по дате
		'element', // используются группы
		'element_multiple', // модуль может быть прикреплен к нескольким группам
		'search_name', // скать по названию
		'trash', // использовать корзину
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		if(! $this->diafan->configmodules("cat", "subscribtion", $this->diafan->site))
		{
			$this->diafan->config("element", false);
			$this->diafan->config("element_multiple", false);
		}
		if (count($this->diafan->languages) < 2)
		{
			$this->diafan->variable_unset('lang');
		}
	}

	/**
	 * Выводит список рассылок
	 * @return void
	 */
	public function show()
	{
		if ($this->diafan->config('element') && ! $this->diafan->not_empty_categories)
		{
			echo '<div class="error">'.sprintf($this->diafan->_('В %sнастройках%s модуля подключены категории, чтобы начать добавлять рассылку создайте хотя бы одну %sкатегорию%s.'), '<a href="'.BASE_PATH_HREF.'subscribtion/config/">', '</a>','<a href="'.BASE_PATH_HREF.'subscribtion/category/">', '</a>').'</div>';
		}
		else
		{
			$this->diafan->addnew_init('Добавить рассылку');
		}

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

		$subject = str_replace(
			array(
				'%title',
				'%url',
				'%subject'
			),
			array(
				TITLE,
				BASE_URL,
				$this->diafan->get_param($_POST, "name", '', 1)
			),
			$this->diafan->configmodules('subject')
		);

		$message = str_replace(
			'/'.USERFILES,
			'http://'.BASE_URL.'/'.USERFILES,
			$_POST["text"]
		);

		$k = 0;
		$ids = '';
		$cats_array = array();
		$id_array = array();
		
		if ($this->diafan->configmodules("cat"))
		{
			$cats_array[] = $_POST["cat_id"];
			if (! empty($_POST["cat_ids"]))
			{
				foreach ($_POST["cat_ids"] as $cat_id)
				{
					$cats_array[] = $cat_id;
				}
			}
			
			$result_ids =  DB::query("SELECT DISTINCT(element_id) FROM {subscribtion_emails_cat_unrel} WHERE cat_id IN (".implode(',', $cats_array).")");
			while($row_ids = DB::fetch_array($result_ids))
			{
				$id_array[] = $row_ids['element_id'];
			}
			if(!empty($id_array))
			{
				$ids .= ' AND id NOT IN ('.implode(',', $id_array).')';
			}		    
		}
		
		$result = DB::query("SELECT mail FROM {subscribtion_emails} WHERE act='1' AND trash='0'".$ids);
		
		while ($row = DB::fetch_array($result))
		{
			include_once(ABSOLUTE_PATH."includes/mail.php");
			send_mail(
				$row["mail"],
				$subject,
				$message,
				($this->diafan->configmodules("emailconf") && $this->diafan->configmodules("email") ? $this->diafan->configmodules("email") : '')
			);
			
			$k++;
		}
		$this->diafan->err = 10 + $k;

		$this->diafan->set_query("send='%d'");
		$this->diafan->set_value(1);
	}
}