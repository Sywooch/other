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
 * Adminsite_admin
 *
 * Редактирование страниц административной части сайта
 */
class Adminsite_admin extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'adminsite';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Название',
			),
			'rewrite' => array(
				'type' => 'text',
				'name' => 'Псевдоссылка',
				'help' => 'ЧПУ (человеко-понятные урл url), адрес страницы вида: site.ru/psewdossylka/. Смотрите настройки сайта',
			),
			'group_id' => array(
				'type' => 'select',
				'name' => 'Группа',
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Активен',
				'default' => true,
			),
			'docs' => array(
				'type' => 'text',
				'name' => 'Ссылка на документацию',
			),
			'parent_id' => array(
				'type' => 'select',
				'name' => 'Вложенность: принадлежит',
			),
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'parent', // содержит вложенности
		'act', // показать/скрыть
		'del', // удалить
		'order', // сортируется
	);

	/**
	 * @var array значения списков
	 */
	public $select_arr = array(
		'group_id' => array(
			1 => 'Контент',
			4 => 'Интернет магазин',
			2 => 'Интерактив',
			3 => 'Сервис',
			5 => 'Настройки',
		),
	);

	/**
	 * Выводит контент модуля
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить страницу');
		$this->diafan->list_row();
	}

	/**
	 * Редактирование поля "Псевдоссылка"
	 * 
	 * @return void
	 */
	public function edit_variable_rewrite()
	{
		echo '
		<tr valign="top">
			<td align="right">'.$this->diafan->variable_name().'</td>
			<td>
				<input type="text" name="'. $this->diafan->key.'" size="40" value="'
				.(! $this->diafan->addnew ? str_replace('"', '&quot;', $this->diafan->value) : '')
				.'">
				'.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Валидация поля "Псевдоссылка"
	 * 
	 * @return void
	 */
	public function validate_variable_rewrite()
	{}

	/**
	 * Сохранение поля "Псевдоссылка"
	 * 
	 * @return void
	 */
	public function save_variable_rewrite()
	{
		$this->diafan->set_query("rewrite='%h'");
		$this->diafan->set_value($_POST["rewrite"]);
	}
}