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
 * Search
 *
 * Контроллер модуля "Поиск"
 */
class Search extends Controller
{
	/**
	 * Инициализация модуля
	 * 
	 * @return void
	 */
	public function init()
	{
	   $this->rewrite_variable_names = array('page');
	   $model = new Search_model($this->diafan);
	   $this->result = $model->show_module();
	}

	/**
	 * Выводит контент модуля
	 * 
	 * @return void
	 */
	public function show_module()
	{
		$this->diafan->_tpl->get('show', 'search', $this->result);
	}

	/**
	 * Шаблонный тег <insert name="show_search" module="search"
	 * [button="надпись на кнопке"] [template="шаблон"]>:
	 * форма поиска по сайту
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_search($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'button', 'template');
		
		$button = $this->diafan->_($attributes["button"], false);

		Customization::inc('modules/search/search.model.php');
		$model = new Search_model($this->diafan);
		$result = $model->show_search($button);

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_search_'.$attributes["template"], 'search', $result))
		{
			$this->diafan->_tpl->get('show_search', 'search', $result);
		}
	}
}