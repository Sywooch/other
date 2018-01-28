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
 * Shop_admin_importexport_category
 *
 * Список описанных файлов
 */
class Shop_admin_importexport_category extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'shop_import_category';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Название',
			),
			'type' => array(
				'type' => 'select',
				'name' => 'Тип',
			),
			'delete_items' => array(
				'type' => 'checkbox',
				'name' => 'Удалять неописанные в файле импорта записи',
			),
			'site_id' => array(
				'type' => 'function',
				'name' => 'Раздел сайта',
			),
			'cat_id' => array(
				'type' => 'function',
				'name' => 'Категория товаров',
			),
			'count_part' => array(
				'type' => 'numtext',
				'name' => 'Количество строк, выгружаемых за один проход скрипта',
				'default' => 200
			),
			'delimiter' => array(
				'type' => 'text',
				'name' => 'Разделитель данных в строке',
				'default' => ";"
			),
			'end_string' => array(
				'type' => 'text',
				'name' => 'Обозначать конец строки символом',
				'help' => 'Не обязательный параметр, необходим, если в описании используются переносы строк'
			),
			'encoding' => array(
				'type' => 'text',
				'name' => 'Кодировка',
				'default' => "cp1251",
				'help' => 'Обычно cp1251 или utf-8'
			),
			'sub_delimiter' => array(
				'type' => 'text',
				'name' => 'Разделитель данных внутри поля',
				'default' => "|"
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'category', // часть модуля - категории
		'link_to_element', // основная ссылка ведет к списку элементов, принадлежащих категории
		'trash', // использовать корзину
	);

	/**
	 * @var integer количество строк, выводимых на странице
	 */
	public $nastr = 100;

	/**
	 * @var array значения списков
	 */
	public $select_arr = array(
		'type' => array(
			'good' => 'Товары',
			'category' => 'Категории',
		),
	);

	/**
	 * Выводит список категорий
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить описание файла импорта/экспорта');
		$this->diafan->list_row();
	}

	/**
	 * Редактирование поля "Категория"
	 * 
	 * @return void
	 */
	public function edit_variable_cat_id()
	{
		if(! $this->diafan->configmodules("cat", "shop"))
		{
			return;
		}
		echo '
		<tr valign="top">
			<td align="right">'.$this->diafan->variable_name() . '</td>
			<td>';

		$result = DB::query("SELECT id, [name], parent_id FROM {shop_category} WHERE trash='0' ORDER BY sort ASC");
		while ($row = DB::fetch_array($result))
		{
			$cats[$row["parent_id"]][] = $row;
		}

		echo ' <select name="cat_id">
		<option value="">'.$this->diafan->_('Все').'</option>';
		echo $this->diafan->get_options($cats, $cats[0], array($this->diafan->value));
		echo '</select>';

		echo $this->diafan->help() . '
			</td>
		</tr>';
	}
}