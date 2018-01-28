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
 * Forum_admin_element
 *
 * Редактирование сообщений
 */
class Forum_admin_element extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'forum';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'default' => true,
			),
			'del' => array(
				'type' => 'checkbox',
				'name' => 'Удалено модератором',
			),
			'author' => array(
				'type' => 'function',
				'name' => 'Автор',
				'no_save' => true,
			),
			'created' => array(
				'type' => 'datetime',
				'name' => 'Дата',
				'help' => 'Вводится в формате дд.мм.гггг чч:мм',
			),
			'user_update' => array(
				'type' => 'function',
				'no_save' => true,
			),
			'cat_id' => array(
				'type' => 'function',
				'name' => 'Тема',
			),
			'text' => array(
				'type' => 'textarea',
				'name' => 'Сообщение',
			),
			'attachments' => array(
				'type' => 'module',
				'name' => 'Прикрепленные файлы',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'act', // показать/скрыть
		'element', // используются группы
		'category_no_multilang', // имя категории не переводиться
		'trash', // использовать корзину
		'datetime', // показывать дату в списке, сортировать по дате
	);

	/**
	 * @var array текст для ссылки на редактирование в списке
	 */
	public $text_for_base_link = array(
		'variable' => 'text'
	);

	/**
	 * Выводит список сообщений
	 * @return void
	 */
	public function show()
	{
		$this->diafan->list_row();
	}

	/**
	 * Редактирование поля "Автор"
	 * @return void
	 */
	public function edit_variable_author()
	{
		if (! $this->diafan->value)
			return;

		echo '
		<tr>
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td><a href="'.BASE_PATH_HREF.'users/edit'.$this->diafan->value.'/">'
			.DB::query_result("SELECT CONCAT(fio, '(', name, ')') FROM {users} WHERE id=%d LIMIT 1", $this->diafan->value)
			.'</a>'
			.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Обновление"
	 * @return void
	 */
	public function edit_variable_user_update()
	{
		if (! $this->diafan->value)
			return;
		echo '
		<tr>
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td><a href="'.BASE_PATH_HREF.'users/edit'.$this->diafan->value.'/">'
			.DB::query_result("SELECT CONCAT(fio, '(', name, ')') FROM {users} WHERE id=%d LIMIT 1", $this->diafan->value).'</a>, '.date("d.m.Y H:i", $this->diafan->values["date_update"])
			.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Тема"
	 *
	 * @return void
	 */
	public function edit_variable_cat_id()
	{
		if($this->diafan->values["parent_id"])
			return;

		$cats[0] = array();
		$result = DB::query(
				"SELECT c.id, c.name, COUNT(p.id) AS count FROM {forum_category} AS c"
				." LEFT JOIN {forum_category_parents} AS p ON p.element_id=c.id"
				." GROUP BY c.id HAVING count=2 ORDER BY name ASC"
			);
		while($row = DB::fetch_array($result))
		{
			$cats[0][] = $row;
		}

		echo '
		<tr valign="top" id="cat_id">
			<td class="td_first">' . $this->diafan->variable_name() . '</td>
			<td>
			<select name="cat_id">';
			if (! empty( $cats[0] ))
			{
				echo $this->diafan->get_options($cats, $cats[0], array($this->diafan->value));
			}
			echo '</select>
			' . $this->diafan->help() . '
			</td>
		</tr>';
	}

	/**
	 * Сохранение поля "Тема"
	 *
	 * @return void
	 */
	public function save_variable_cat_id()
	{
		if($this->diafan->oldrow["parent_id"])
			return;
		
		if($this->diafan->oldrow["cat_id"] == $_POST["cat_id"])
			return;

		$this->diafan->set_query("cat_id=%d");
		$this->diafan->set_value($_POST["cat_id"]);

		$childen = $this->diafan->get_children($this->diafan->save, "forum");
		if($childen)
		{
			DB::query("UPDATE {forum} SET cat_id=%d WHERE id IN (%s)", $_POST["cat_id"], implode(',', $childen));
		}
	}

	/**
	 * Удаляет категорию
	 * @return void
	 */
	public function del()
	{
		// Прошел ли пользователь проверку идентификационного хэша
		if (! $this->diafan->_user->checked)
		{
			$this->diafan->redirect(URL);
			return;
		}

		if (! $this->diafan->_user->roles('del', $this->diafan->rewrite))
		{
			$this->diafan->redirect(URL);
			return;
		}

		if (! empty($_POST["id"]))
		{
			$ids = array($_POST["id"]);
		}
		else
		{
			$ids = $_POST["ids"];
		}
		foreach ($ids as $id)
		{
			$id = intval($id);
			$dels = $this->diafan->get_children($id, "forum");
			$dels[] = $id;
			DB::query("DELETE FROM {forum_show} WHERE table_name='forum' AND element_id IN (".implode(",", $dels).")");
		}

		parent::__call('del', array());
	}
}