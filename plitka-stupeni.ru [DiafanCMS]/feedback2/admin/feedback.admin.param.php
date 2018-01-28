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
	include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

/**
 * Feedback_admin_param
 *
 * Конструктор обратной связи
 */
class Feedback_admin_param extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'feedback_param';

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
			'site_id' => array(
				'type' => 'select',
				'name' => 'Раздел сайта',
			),
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
			'required' => array(
				'type' => 'checkbox',
				'name' => 'Обязательно для заполнения',
			),
			'type' => array(
				'type' => 'select',
				'name' => 'Тип',
				'help' => 'Предустановка типа поля',
			),
			'param_select' => array(
				'type' => 'function',
				'name' => 'Значения',
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
		'del', // удалить
		'order', // сортируется
		'element_site', // делит элементы по разделам (страницы сайта, к которым прикреплен модуль)
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
		if($this->diafan->site)
		{
			$this->diafan->where = ' AND site_id=' . ( $this->diafan->site == 999999 ? 0 : $this->diafan->site );
		}

		$this->diafan->addnew_init('Добавить поле');

		$this->diafan->list_row();
	}

	/**
	 * Редактирование поля "Страницаы"
	 *
	 * @return void
	 */
	public function edit_variable_site_id()
	{
		if (!$this->diafan->value)
		{
			$this->diafan->value = $this->diafan->site;
		}

		echo '
		<tr valign="top">
			<td class="td_first">' . $this->diafan->variable_name() . '</td>
			<td>
				<select name="' . $this->diafan->key . '">';
		$result = DB::query("SELECT id, [name] FROM {site} WHERE trash='0' AND module_name='%s' ORDER BY id ASC", $this->diafan->module);
		while ($row = DB::fetch_array($result))
		{
			$cats[0][] = $row;
		}
		echo $this->diafan->get_options($cats, $cats[0], array ( $this->diafan->value )) . '
				</select>
				' . $this->diafan->help() . '
			</td>
		</tr>';
	}
}