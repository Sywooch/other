<?php

/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Users_admin_param
 *
 * Конструктор формы регистрации
 */
class Users_admin_param extends Frame_admin
{
    /**
     * @var string таблица в базе данных
     */
    public $table = 'users_param';

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
			'required' => array(
				'type' => 'checkbox',
				'name' => 'Обязательно для заполнения',
			),
			'show_in_page' => array(
				'type' => 'checkbox',
				'name' => 'Выводить на странице пользователя',
			),
			'show_in_form_no_auth' => array(
				'type' => 'checkbox',
				'name' => 'Выводить в форме регистрации',
			),
			'show_in_form_auth' => array(
				'type' => 'checkbox',
				'name' => 'Выводить в форме редактирования данных',
			),
			'roles' => array(
				'type' => 'function',
				'name' => 'Тип пользователя',
			),
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
			'type' => array(
				'type' => 'select',
				'name' => 'Тип',
			),
			'param_select' => array(
				'type' => 'function',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'order', // сортируется
		'trash', // использовать корзину
	);

	/**
	 * @var array значения списков
	 */
	public $select_arr = array(
		'type' => array(
			'text' => 'строка',
			'numtext' => 'число',
			'date' => 'дата',
			'datetime' => 'дата и время',
			'textarea' => 'текстовое поле',
			'checkbox' => 'галочка',
			'select' => 'выпадающий список',
			'multiple' => 'список с выбором нескольких значений',
			'email' => 'электронный ящик',
			'title' => 'заголовок группы характеристик',
			'attachments' => 'файлы',
			'images' => 'изображения',
		),
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array (
		'type' => array('type' => 'select', 'class' => 'param_type'),
	);

	/**
	 * Выводит список полей формы
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить поле');
		$this->diafan->list_row();
	}

	/**
	 * Редактирование поля "Тип пользователя"
	 * @return void
	 */
	public function edit_variable_roles()
	{
		$roles[0] = array();
		$result = DB::query("SELECT id, [name] FROM {users_role} WHERE trash='0' ORDER BY id ASC");
		while ($row = DB::fetch_array($result))
		{
			$roles[0][] = $row;
		}
		if(count($roles[0]) < 1)
		{
			return;
		}
		$values = array ();
		if (!$this->diafan->addnew)
		{
			$result = DB::query("SELECT role_id FROM {users_param_role_rel} WHERE element_id=%d AND trash='0'", $this->diafan->edit);
			while ($row = DB::fetch_array($result))
			{
				$values[] = $row["role_id"];
			}
		}
		echo '
		<tr valign="top" id="roles">
			<td class="td_first">' . $this->diafan->variable_name() . '</td>
			<td>
			<select name="roles[]" multiple="multiple">';
			if (!empty( $roles ))
			{
				echo $this->diafan->get_options($roles, $roles[0], $values);
			}
			echo '</select>
			</td>
		</tr>';
	}

	/**
	 * Сохранение поля "Тип пользователя"
	 * @return string
	 */
	public function save_variable_roles()
	{
		$this->diafan->update_table_rel("users_param_role_rel", "element_id", "role_id", ! empty($_POST['roles']) ? $_POST['roles'] : array(), $this->diafan->save, $this->diafan->savenew);
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("users_param_role_rel", "element_id=".$del_id, $trash_id);
	}
}