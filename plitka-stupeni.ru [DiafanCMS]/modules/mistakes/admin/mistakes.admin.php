<?php
/**
 * Ошибки на сайте
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

class Mistakes_admin extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'mistakes';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'created' => array(
				'type' => 'datetime',
				'name' => 'Дата и время',
			),
			'url' => array(
				'type' => 'text',
				'name' => 'URL',
				'no_save' => true,
			),
			'selected_text' => array(
				'type' => 'textarea',
				'name' => 'Выделенный текст',
			),
			'comment' => array(
				'type' => 'textarea',
				'name' => 'Комментарий',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'datetime', // показывать дату в списке, сортировать по дате
	);

	/**
	 * @var array текст для ссылки на редактирование в списке
	 */
	public $text_for_base_link = array(
		'variable' => 'url'
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array (
		'selected_text' => 'text', 
		'comment' => 'text',
	);

	/**
	 * Выводит список ошибок на сайте
	 * @return void
	 */
	public function show()
	{
		$this->diafan->list_row();

		if (! $this->diafan->count)
		{
			echo '<center>'.$this->diafan->_('Чтобы соообщить об ошибке на Вашем сайте, посетители могут выделить текст и нажать ctrl+Enter').'</center>';
		}
	}

	/**
	 * Редактирование поля "URL"
	 * @return void
	 */
	public function edit_variable_url()
	{
		echo '<tr id="url">
		<td class="td_first">'.$this->diafan->variable_name().'</td>  
		<td><a href="'.$this->diafan->value.'">'.$this->diafan->value.'</a></td>
		</tr>';
	}
}