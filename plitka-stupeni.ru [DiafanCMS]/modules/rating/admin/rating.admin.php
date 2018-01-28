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
 * Rating_admin
 *
 * Редактирование рейтигов
 */
class Rating_admin extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'rating';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'element_id' => array(
				'type' => 'function',
				'name' => 'Объект',
				'disabled' => true,
			),
			'rating' => array(
				'type' => 'floattext',
				'name' => 'Средняя оценка',
				'help' => 'Числовое значение, вычисляется автоматически, как отношение суммы баллов к числу проголосовавших',
			),
			'count_votes' => array(
				'type' => 'numtext',
				'name' => 'Количество голосовавших',
				'help' => 'Числовое значение',
			),
			'created' => array(
				'type' => 'datetime',
				'name' => 'Дата последнего голосования',
				'help' => 'Устанавливается после изменения рейтинга, в формате дд.мм.гггг чч:мм',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'datetime', // показывать дату в списке, сортировать по дате
		'trash', // использовать корзину
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array (
		'module_name' => 'function',
		'element_id' => 'function',
		'rating' => array(
			'type' => 'string',
			'class' => 'rating'
		),
	);

	/**
	 * @var array текст для ссылки на редактирование в списке
	 */
	public $text_for_base_link = array(
		'text' => 'Редактировать'
	);

	/**
	 * @var array локальный кэш модуля
	 */
	private $cache;

	/**
	 * Выводит список оценок
	 * @return void
	 */
	public function show()
	{
		$this->diafan->list_row();
		
		if (! $this->diafan->count)
		{
			echo '<p><b>'.$this->diafan->_('Нет оценок ретинга.').'</b><br>'.$this->diafan->_('Рейтинг выставляют посетители из пользовательской части сайта.').'</p>';
		}
	}

	/**
	 * Выводит объект, которому поставлена оценка
	 * 
	 * @return string
	 */
	public function other_row_element_id($row)
	{					
		$name = DB::query_result("SELECT [name] FROM {".$row["module_name"]."} WHERE id='%d' LIMIT 1", $row["element_id"]);
		return '<td class="element_id">'.($name ? $name : $row["element_id"]).'</td>';
	}

	/**
	 * Выводит название модуля в списке
	 * 
	 * @return string
	 */
	public function other_row_module_name($row)
	{
		$module_name = str_replace("_category", "", $row["module_name"]);
		if(empty($this->cache["modules"][$module_name]))
		{
			$this->cache["modules"][$module_name] = DB::query_result("SELECT title FROM {modules} WHERE name='%h' LIMIT 1", $module_name);
		}
		return '<td class="other_row">'.$this->cache["modules"][$module_name].(strpos($row["module_name"], "_category") !== false ? ', '.$this->diafan->_('категория') : '').'</td>';
	}

	/**
	 * Редактирование поля "Объект"
	 * @return void
	 */
	public function edit_variable_element_id()
	{
		$link = BASE_PATH_HREF.$this->diafan->values["module_name"]
		.($this->diafan->configmodules('cat', $this->diafan->values["module_name"]) ? '/cat'.DB::title($this->diafan->values["module_name"], $this->diafan->value,"cat_id") : '')
		.'/edit'.$this->diafan->value.'/';
		
		echo '
		<tr valign="top">
			<td align="right">
				'.$this->diafan->variable_name().'
			</td>
			<td>
				<a href="'.$link.'" target="_blank">'.$link.'</a>
			</td>
		</tr>';

		return true;
	}
}