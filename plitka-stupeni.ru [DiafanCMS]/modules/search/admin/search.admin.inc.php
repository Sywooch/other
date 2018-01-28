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
 * Search_admin_inc
 * 
 * Подключение модуля "Поиск" к другим модулям для административной части
 */
class Search_admin_inc extends Diafan
{
	/**
	 * Добавление элемента в поисковый индекс.
	 * 
	 * @return void
	 */
	public function save()
	{
		if(! DB::query_result("SELECT id FROM {modules} WHERE module_name='search' LIMIT 1"))
		{
			return;
		}

		if ($this->diafan->variable_multilang('rewrite') && ! $this->diafan->is_save_rewrite)
		{
			$this->diafan->get_rewrite();
		}

		Customization::inc('modules/search/admin/search.admin.index.php');
		$search_admin_index = new Search_admin_index($this->diafan);

		$search_admin_index->config = array(
				"module_name" => $this->diafan->module,
				"table_name" => $this->diafan->table,
				"element_id" => $this->diafan->save,
				"lang_id" => $this->diafan->variable_multilang("act") ? _LANG : '',
				"is_save" => true,
			);

		$search_admin_index->add();
	}

	/**
	* Удаление поискового индекса для выбранных модулей
	* 
	* @param array $table_name таблица
	* @param integer $element_id идентификатор элемента
	* @param integer $trash_id идентификатор элемента
	* @param bool $is_category категория или нет
	* @return void
	*/
	public function delete($table_name, $element_id, $trash_id = 0, $is_category = false)
	{
		if(! DB::query_result("SELECT id FROM {modules} WHERE module_name='search' LIMIT 1"))
		{
			return;
		}

		Customization::inc('modules/search/admin/search.admin.index.php');
		$search_admin_index = new Search_admin_index($this->diafan);

		list($module_name) = explode('_', $table_name);
		$search_admin_index->config = array(
				"module_name" => $module_name,
				"table_name" => $table_name.($is_category ? '_category' : ''),
				"element_id" => $element_id,
			);

		$search_admin_index->delete();
	}

	/**
	* Создание/удаление поискового индекса при активации/деактивации/удалении элементов
	* 
	* @param array $table_name таблица
	* @param array $element_ids номера элементов
	* @param boolean $act активация/деактивация
	* @return void
	*/
	public function act($table_name, $element_ids, $act)
	{
		// только при активации/деактивации из  списка, при сохранении индексируем функцией save
		if($this->diafan->save)
		{
			return;
		}

		if(! DB::query_result("SELECT id FROM {modules} WHERE module_name='search' LIMIT 1"))
		{
			return;
		}

		Customization::inc('modules/search/admin/search.admin.index.php');
		$search_admin_index = new Search_admin_index($this->diafan);
		
		list($module_name) = explode('_', $table_name);
		$search_admin_index->config = array(
				"module_name" => $module_name,
				"table_name" => $table_name,
				"element_ids" => $element_ids,
				"lang_id" => _LANG,
			);
		
		if($act)
		{
			$search_admin_index->add();
		}
		else
		{
			$search_admin_index->delete();
		}
	}

	/**
	 * Восстанавливает из корзины различные элементы модуля
	 * 
	 * @param string $table_name таблица
	 * @param array $id номер элемента
	 * @return void
	 */
	public function restore_from_trash($table_name, $id)
	{
		if(! DB::query_result("SELECT id FROM {modules} WHERE module_name='search' LIMIT 1"))
		{
			return;
		}

		Customization::inc('modules/search/admin/search.admin.index.php');
		$search_admin_index = new Search_admin_index($this->diafan);

		list($module_name) = explode('_', $table_name);
		$search_admin_index->config = array(
				"module_name" => $module_name,
				"table_name" => $table_name,
				"element_id" => $id,
			);
		
		$search_admin_index->add();
	}
}