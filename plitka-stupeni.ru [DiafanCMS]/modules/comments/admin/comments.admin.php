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
 * Comments_admin
 *
 * Редактирование комментариев
 */
class Comments_admin extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'comments';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'text' => array(
				'type' => 'textarea',
				'name' => 'Комментарий',
			),
			'created' => array(
				'type' => 'datetime',
				'name' => 'Дата добавления',
				'help' => 'В формате дд.мм.гггг чч:мм',
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'help' => 'Если не отмечена, комментарий не будет виден на сайте',
				'default' => true,
			),
			'parent_id' => array(
				'type' => 'function',
				'name' => 'Вложенность: принадлежит',
			),
			'hr1' => 'hr',
			'element_id' => array(
				'type' => 'function',
				'name' => 'Объект',
				'disabled' => true,
			),
			'hr2' => 'hr',
			'user_id' => array(
				'type' => 'function',
				'name' => 'Пользователь',
			),
			'param' => array(
				'type' => 'function',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'act', // показать/скрыть
		'del', // удалить
		'datetime', // показывать дату в списке, сортировать по дате
		'trash', // использовать корзину
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array (
		'element_id' => 'function',
		'module_name' => 'function',
	);

	/**
	 * @var array текст для ссылки на редактирование в списке
	 */
	public $text_for_base_link = array(
		'variable' => 'text'
	);

	/**
	 * @var array локальный кэш модуля
	 */
	private $cache;

	/**
	 * Выводит контент модуля
	 * 
	 * @return void
	 */
	public function show()
	{
		if(! empty($_GET["rew"]))
		{
			$rew = preg_replace('/[^0-9A-Za-z_]+/', '', $_GET["rew"]);
			$this->diafan->get_nav .= ($this->diafan->get_nav ? '&' : '?').'rew='.$rew;
			$this->diafan->where = " AND module_name='".preg_replace('/[^A-Za-z_]+/', '', $rew)."' AND element_id=".$this->diafan->get_param($_GET, "rew", 0, 2);
		}

		$this->diafan->list_row();	
		
		if (! $this->diafan->count)
		{
			echo '<p><b>'.$this->diafan->_('Комментариев нет.').'</b><br>'.$this->diafan->_('Комментарии оставляются посетителями из пользовательской части сайта.').'</p>';
		}
	}

	/**
	 * Выводит объект, к которому прикреплен комментарий, в списке
	 * 
	 * @return string
	 */
	public function other_row_element_id($row)
	{
		if (empty($this->cache["elements"][$row["module_name"]][$row["element_id"]]))
		{
			$name = DB::query_result("SELECT ".($row["module_name"] != 'faq' ? '[name]' : '[anons]')." FROM {".$row["module_name"]."} WHERE id=%d LIMIT 1", $row["element_id"]);
			$name = $this->diafan->short_text($name);
			$this->cache["elements"][$row["module_name"]][$row["element_id"]] = ($name ? $name : $row["element_id"]);
		}
		return '</td><td class="other_row">'.$this->cache["elements"][$row["module_name"]][$row["element_id"]];
	}

	/**
	 * Выводит название модуля в списке
	 * 
	 * @return string
	 */
	public function other_row_module_name($row)
	{
		if(empty($this->cache["modules"][$row["module_name"]]))
		{
			$this->cache["modules"][$row["module_name"]] = DB::query_result("SELECT title FROM {modules} WHERE name='%h' LIMIT 1", $row["module_name"]);
		}
		return '</td><td class="other_row">'.$this->cache["modules"][$row["module_name"]];
	}

	/**
	 * Редактирование поля "Объект"
	 * 
	 * @return void
	 */
	public function edit_variable_element_id()
	{
		$module_name = str_replace('_category', '', $this->diafan->values["module_name"]);
		
		if ($module_name == "site")
		{
			$link = $this->diafan->_route->link($this->diafan->value);
		}
		elseif (strpos($this->diafan->values["module_name"], '_category') !== false)
		{
			$element = DB::fetch_array(DB::query("SELECT site_id FROM {%s} WHERE id=%d LIMIT 1", $this->diafan->values["module_name"], $this->diafan->value));
			$link = $this->diafan->_route->link($element["site_id"], $module_name, $this->diafan->value);
		}
		else
		{
			$element = DB::fetch_array(DB::query("SELECT site_id, cat_id FROM {%s} WHERE id=%d LIMIT 1", $this->diafan->values["module_name"], $this->diafan->value));
			$link = $this->diafan->_route->link($element["site_id"], $module_name, $element["cat_id"], $this->diafan->value);
		}
		$link = BASE_PATH.$link;

		echo '
		<tr valign="top">
			<td align="right">'.$this->diafan->variable_name().'</td>
			<td>
				<a href="'.$link.'" target="_blank">'.$link.'</a>
				<br>
				<a href="'.$this->diafan->get_admin_url('page').'?rew='.$this->diafan->values["module_name"].$this->diafan->value.'">'.$this->diafan->_('Все комментарии по этой ссылке').'</a>'
				.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Дополнительные параметры"
	 * 
	 * @return void
	 */
	public function edit_variable_param()
	{
		parent::__call('edit_variable_param', array("AND (module_name='".$this->diafan->values["module_name"]."' OR module_name='')"));
	}

	/**
	 * Сохранение поля "Дополнительные параметры"
	 * 
	 * @return void
	 */
	public function save_variable_param()
	{
		parent::__call('save_variable_param', array(" AND (module_name='' OR module_name='".$this->diafan->oldrow["module_name"]."')"));
	}
}