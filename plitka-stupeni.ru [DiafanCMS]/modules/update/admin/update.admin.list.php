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
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Update_admin_list
 *
 * Список закрытых для обновления файлов
 */
class Update_admin_list extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'update';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Название',
			),
			'user_id' => array(
				'type' => 'function',
				'name' => 'Пользователь',
			),
			'created' => array(
				'type' => 'datetime',
				'name' => 'Дата',
				'help' => 'Вводится в формате дд.мм.гггг чч:мм',
			),
			'text' => array(
				'type' => 'textarea',
				'name' => 'Примечание'
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'date', // показывать дату в списке, сортировать по дате
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array (
		'user_id' => 'function',
		'text' => 'text',
	);

	/**
	 * Выводит контент модуля
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить файл');
		
		$this->diafan->list_row();	
	}

	/**
	 * Выводит имя пользователя, добавившего файл
	 * @return string
	 */
	public function other_row_user_id($row)
	{
		return '</td><td>'
		.($row["user_id"] ? '<a href="'.BASE_PATH_HREF.'users/edit'.$row["user_id"].'/">'.DB::title("users", $row["user_id"], "fio").'</a>' : '');
	}

	/**
	 * Сохранение поля "Пользователь"
	 * 
	 * @return void
	 */
	public function save_variable_user_id()
	{
		if ($this->diafan->savenew)
		{
			$this->diafan->set_query("user_id='%d'");
			$this->diafan->set_value($this->diafan->_user->id);
		}
	}
}