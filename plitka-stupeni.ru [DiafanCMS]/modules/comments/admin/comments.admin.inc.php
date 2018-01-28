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
 * Comments_admin_inc
 * 
 * Подключение модуля "Комментарии" к другим модулям для административной части
 */
class Comments_admin_inc extends Diafan
{
	/**
	 * Редактирование поля "Комментарии"
	 * 
	 * @return boolean
	 */
	public function edit()
	{
		if(! DB::query_result("SELECT id FROM {modules} WHERE name='comments' LIMIT 1"))
		{
			return;
		}

		if (! $this->diafan->configmodules("comments") && ! $this->diafan->config('category')
		   || ! $this->diafan->configmodules("comments_cat") && $this->diafan->config('category')
		   || $this->diafan->addnew
		)
		{
			return false;
		}

		echo '
		<tr id="comments">
			<td class="td_first"></td>
			<td>'
			.(DB::query_result("SELECT id FROM {comments} WHERE (module_name='%h' or module_name='') AND element_id='%d' AND trash='0' LIMIT 1", $this->diafan->table, $this->diafan->edit)
			  ? '<a href="'.BASE_PATH_HREF.'comments/?rew='.$this->diafan->table.$this->diafan->edit.'" target="_blank">'.$this->diafan->variable_name("comments").'</a>'
			  : $this->diafan->_('Комментариев нет')
			).$this->diafan->help().'
			</td>
		</tr>';
		return true;
	}

	/**
	 * Редактирование поля "Подключить комментарии" для настроек модуля
	 * 
	 * @return void
	 */
	public function edit_config()
	{
		if(! DB::query_result("SELECT id FROM {modules} WHERE name='comments' LIMIT 1"))
		{
			return;
		}

		$fields = array('comments', 'comments_cat');
		foreach ($fields as $field)
		{
			if (empty($this->diafan->values[$field]))
			{
				$this->diafan->values[$field] = $this->diafan->configmodules($field);
			}
		}
		$this->diafan->show_tr_click_checkbox('cat', 'comments_cat');

		echo '
		<tr id="comments">
			<td class="td_first">'.$this->diafan->variable_name("comments").'</td>
			<td>
				<input type="checkbox" name="comments" value="1"'
				.($this->diafan->values["comments"] == 1 ? " checked" : '')
				.'>'
				.$this->diafan->help("comments").'
			</td>
		</tr>';

		if ($this->diafan->is_variable("cat"))
		{
			echo '
			    <script language="javascript" type="text/javascript">
				$(document).ready(function(){
					$(\'input[name=cat]\').attr("rel", $(\'input[name=cat]\').attr("rel") + \',#comments_cat\');
				});
				</script>
			<tr'.(! $this->diafan->values["cat"] ? ' class="hide"' : '').' id="comments_cat">
				<td class="td_first">'.$this->diafan->_("Показывать комментарии к категориям").'</td>
				<td>
					<input type="checkbox" name="comments_cat" value="1"'
					.($this->diafan->values["comments_cat"] == 1 ? " checked" : '')
					.'>
				</td>
			</tr>';
		}
	}

	/**
	 * Сохранение настроек конфигурации модулей
	 * 
	 * @return void
	 */
	public function save_config()
	{
		if(! DB::query_result("SELECT id FROM {modules} WHERE name='comments' LIMIT 1"))
		{
			return;
		}

		$fields = array('comments', 'comments_cat');

		foreach ($fields as $field)
		{
			$this->diafan->set_query($field."=%d");
			$this->diafan->set_value(! empty($_POST[$field]) ? $_POST[$field] : '');
		}
	}

	/**
	 * Помечает комментарии на удаление или удаляет комментарии
	 * 
	 * @param string $module_name название модуля, к которому прикреплены комментарии
	 * @param integer $element_id номер элемента, к которому прикреплены комментарии
	 * @param integer $trash_id номер записи в корзине, с которой связано удаление
	 * @param integer $is_category удаляемый элемент - категория
	 * @return void
	 */
	public function delete($module_name, $element_id, $trash_id = 0, $is_category = false)
	{
		if(! DB::query_result("SELECT id FROM {modules} WHERE name='comments' LIMIT 1"))
		{
			return;
		}

		if ($is_category)
		{
			$this->diafan->del_or_trash_where("comments", "element_id='".$element_id."' AND module_name='".$module_name."_category'", $trash_id);
			$this->diafan->diafan->_cache->delete("","comments");
		}
		else
		{
			$this->diafan->del_or_trash_where("comments", "element_id='".$element_id."' AND module_name='".$module_name."'", $trash_id);
			$this->diafan->diafan->_cache->delete("", "comments");
		}
	}
}
