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
 * Comments_admin_param
 *
 * Конструктор комментариев
 */
class Comments_admin_param extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'comments_param';

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
			'module_name' => array(
				'type' => 'select',
				'name' => 'Модуль',
			),
			'type' => array(
				'type' => 'select',
				'name' => 'Тип',
			),
			'required' => array(
				'type' => 'checkbox',
				'name' => 'Обязательно для заполнения',
			),
			'show_in_list' => array(
				'type' => 'checkbox',
				'name' => 'Выводить в списке',
			),
			'show_in_form_auth' => array(
				'type' => 'checkbox',
				'name' => 'Выводить в форме для авторизованных пользователей',
			),
			'show_in_form_no_auth' => array(
				'type' => 'checkbox',
				'name' => 'Выводить в форме для неавторизованных пользователей',
			),
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
			'param_select' => array(
				'type' => 'function',
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
		'module_name' => array('type' => 'select', 'class' => 'parent_name'),
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		$this->diafan->select_arr("module_name", '-', $this->diafan->_('Все'));

		$result = DB::query("SELECT DISTINCT e.name, o.module_name FROM {config} AS o INNER JOIN {adminsite} AS e ON o.module_name = e.rewrite WHERE o.name = 'comments' AND o.value = '1' AND e.parent_id = '0'");
		while ($row = DB::fetch_array($result))
		{
			$this->diafan->select_arr("module_name", $row['module_name'], $row['name']);
		}
	}

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
	 * Определяет строку с GET переменными
	 *
	 * @return void
	 */
	public function set_get_nav()
	{
		$get_nav_params = $this->diafan->get_nav_params;
		$get_nav_params["module_name"] = '';

		if (!empty( $_GET["module_name"] ))
		{
			$get_nav_params["module_name"] = $this->diafan->get_param($_GET, "module_name", '', 1);
			$this->diafan->get_nav .= ( $this->diafan->get_nav ? '&amp;' : '?' ) . 'module_name=' . $get_nav_params["module_name"];
			$this->diafan->where .= " AND module_name='" . ($get_nav_params["module_name"] != 'all' ? str_replace(array("'", "%"), array("\\'", "%%"), $get_nav_params["module_name"]) : ''). "'";
		}
		$this->diafan->get_nav_params = $get_nav_params;
	}

	/**
	 * Поиск
	 *
	 * @return string
	 */
	public function show_search()
	{
		if($this->diafan->edit)
			return '';

		$this->upload();
		$html = '<script type="text/javascript" src="'.BASE_PATH.'modules/comments/admin/comments.admin.param.js"></script>

		<p>'.$this->diafan->_('Модуль').': <select rel="'.$this->diafan->get_admin_url('cat', 'site').'" class="inpselect" name="module_name" id="select_module"><option value=""></option>';
		foreach($this->diafan->select_arr("module_name") as $k => $v)
		{
			if(! $k)
			{
				$k = 'all';
			}
			$html .= '<option value="'.$k.'"'.($this->diafan->get_nav_params["module_name"] == $k ? ' selected' : '').'>'.$v.'</option>';
		}
		$html .= '</select></p>';

		return $html;
	}
}