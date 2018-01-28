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
 * Votes_admin_element
 *
 * Список ответов пользователей
 */
class Votes_admin_userversion extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'votes_userversion';

	/**
	 * @var array локальный кэш файла
	 */
	private $cache;

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'text' => array(
				'type' => 'text',
				'name' => 'Ответ',
			),			
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'trash', // использовать корзину
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array (
		'cat_id' => 'function',
	);

	/**
	 * @var array текст для ссылки на редактирование в списке
	 */
	public $text_for_base_link = array(
		'variable' => 'text'
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		if ($this->diafan->cat)
		{
			$this->diafan->where .= " AND e.cat_id=".$this->diafan->cat;
		}
		$result = DB::query("SELECT v.id, v.[name] FROM {votes_category} as v"
				    ." INNER JOIN {votes_userversion} as u ON u.cat_id=v.id AND u.trash='0'"
				    ." WHERE v.trash='0' GROUP BY v.id ORDER BY v.id ASC");
		while ($row = DB::fetch_array($result))
		{
			$this->cache["cats"][0][] = $row;
			$this->cache["votes_cats"][$row["id"]] = $row["name"];
		}
	}

	/**
	 * Выводит список ответов
	 * @return void
	 */
	public function show()
	{
		$this->diafan->list_row();

		if (! $this->diafan->count)
		{
			echo '<p><b>'.$this->diafan->_('Ответов нет.').'</b><br>'.$this->diafan->_('Свои варианты ответов посетители оставляют в пользовательской части сайта, если у опроса отмечена опция «Свой вариант ответа».').'</p>';
		}
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

		$html = '';

		if(! empty($this->cache["cats"]))
		{
			$cats = $this->cache["cats"];
			$html = $this->diafan->_('Опрос') . ': <select rel="' . $this->diafan->get_admin_url('cat').'" class="redirect" name="cat">'
			.'<option value="">'.$this->diafan->_('Все').'</option>';
			$html .= $this->diafan->get_options($cats, $cats[0], array($this->diafan->cat))
			. '</select>';
		}

		return $html;
	}

	/**
	 * Выводит вопрос в списке
	 * @return string
	 */
	public function other_row_cat_id($row)
	{
		return '</td><td class="comment">'.(! empty($this->cache["votes_cats"][$row["cat_id"]]) ? $this->cache["votes_cats"][$row["cat_id"]] : '');
	}
}