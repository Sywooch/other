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
 * Tags_admin_inc
 * 
 * Редактирование полей, связанных с работой модуля "Теги"
 */
class Tags_admin_inc extends Diafan
{
	/**
	 * Редактирование поля "Теги"
	 * 
	 * @return void
	 */
	public function edit()
	{
		if(! DB::query_result("SELECT id FROM {modules} WHERE name='tags' LIMIT 1"))
		{
			return;
		}

		if (! $this->diafan->configmodules("tags") || $this->diafan->config('category'))
		{
			return;
		}
		Customization::inc('modules/tags/admin/tags.admin.view.php');
		$tags_view = new Tags_admin_view($this->diafan);

		echo '
		<script type="text/javascript" src="'.BASE_PATH.'modules/tags/admin/tags.admin.js"></script>

		<tr valign="top" id="tags">
			<td class="td_first">'.$this->diafan->_("Теги").'</td>
			<td>
				<div class="tags_search"></div>
				<input type="text" name="tag" size="20" autocomplete="off">
				<input type="button" value="'.$this->diafan->_('Добавить тег').'" class="tags_upload">
				<a href="javascript:void(0)" class="dashed_link tags_cloud" element_id="'.$this->diafan->edit.'">'.$this->diafan->_('Открыть теги').'</a>
				<div class="tags_container">'.$tags_view->show($this->diafan->edit).'</div>';

				echo $this->diafan->help().'
				<div class="errors error_tags"></div>
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Подключить теги" для настроек модуля
	 * 
	 * @return void
	 */
	public function edit_config()
	{
		if(! DB::query_result("SELECT id FROM {modules} WHERE name='tags' LIMIT 1"))
		{
			return;
		}

		echo '
		<tr id="tags">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				<input type="checkbox" name="'.$this->diafan->key.'" value="1"'
				.($this->diafan->value == 1 ? " checked" : '')
				.'>'
				.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Сохранение настроек конфигурации модулей
	 * 
	 * @return void
	 */
	public function save_config()
	{
		if(! DB::query_result("SELECT id FROM {modules} WHERE name='tags' LIMIT 1"))
		{
			return;
		}

		$this->diafan->set_query("tags='%d'");
		$this->diafan->set_value(! empty($_POST["tags"]) ? $_POST["tags"] : '');
	}

	/**
	 * Помечает теги на удаление или удаляет теги
	 * 
	 * @param string $module_name название модуля, к которому прикреплены теги
	 * @param integer $element_id номер элемента, к которому прикреплены теги
	 * @param integer $trash_id номер записи в корзине, с которой связано удаление
	 * @param integer $is_category удаляемый элемент - категория
	 * @return void
	 */
	public function delete($module_name, $element_id, $trash_id = 0, $is_category = false)
	{
		if(! DB::query_result("SELECT id FROM {modules} WHERE name='tags' LIMIT 1"))
		{
			return;
		}

		if ($is_category)
		{
			return;
		}
		$this->diafan->del_or_trash_where("tags", "element_id='".$element_id."' AND module_name='".$module_name."'", $trash_id);
		$this->diafan->diafan->_cache->delete("", "tags");
	}

	/**
	 * Сохраняет прикрепленные теги
	 * @return void
	 */
	public function save()
	{
		if($this->diafan->savenew)
		{
			return;
		}
		if(! DB::query_result("SELECT COUNT(id) FROM {modules} WHERE name='tags'"))
		{
			return;
		}

		if (! $this->diafan->configmodules("tags"))
		{
			return;
		}
		if(empty($_POST["act"]) && ! empty($this->diafan->oldrow["act"._LANG]))
		{
			$act = 0;
		}
		elseif(! empty($_POST["act"]) && empty($this->diafan->oldrow["act"._LANG]))
		{
			$act = 1;
		}
		else
		{
			return;
		}
		if ($this->diafan->config('category'))
		{
			$table = str_replace('_category', '', $this->diafan->table);
			$result = DB::query("SELECT id FROM {".$this->diafan->table."} WHERE cat_id=%d", $this->diafan->save);
			$element_ids = array();
			while ($row = DB::fetch_array($result))
			{
				$element_ids[] = $row["id"];
			}
			DB::query("UPDATE {tags} SET [act]='%d' WHERE module_name='%h' AND element_id IN (%h)", $act, $this->diafan->table, implode(',', $element_ids));
		}
		else
		{
			DB::query("UPDATE {tags} SET [act]='%d' WHERE module_name='%h' AND element_id=%d", $act, $this->diafan->table, $this->diafan->save);
		}
	}

	/**
	 * Блокирует/разблокирует прикрепленные теги
	 * 
	 * @param string $table таблица
	 * @param array $element_ids номера элементов, к которым прикреплены теги
	 * @param integer $act блокировать/разблокировать
	 * @return void
	 */
	public function act($table, $element_ids, $act)
	{
		if(! DB::query_result("SELECT id FROM {modules} WHERE name='tags' LIMIT 1"))
		{
			return;
		}

		if (! $this->diafan->configmodules("tags"))
		{
			return;
		}
		if ($this->diafan->config('category'))
		{
			$table = str_replace('_category', '', $table);
			$result = DB::query("SELECT id FROM {".$table."} WHERE cat_id IN (%h)", implode(',', $element_ids));
			$element_ids = array();
			while ($row = DB::fetch_array($result))
			{
				$element_ids[] = $row["id"];
			}
			if($element_ids)
			{
				DB::query("UPDATE {tags} SET [act]='%d' WHERE module_name='%h' AND element_id IN (%h)", $act, $table, implode(',', $element_ids));
			}
		}
		else
		{
			DB::query("UPDATE {tags} SET [act]='%d' WHERE module_name='%h' AND element_id IN (%h)", $act, $table, implode(',', $element_ids));
		}
	}
}