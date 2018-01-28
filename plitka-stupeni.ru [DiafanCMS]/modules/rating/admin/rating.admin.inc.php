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
 * Rating_admin_inc
 * 
 * Подключение модуля "Рейтинг" к другим модулям для административной части
 */
class Rating_admin_inc extends Diafan
{
	/**
	 * Редактирование поля "Рейтинг"
	 * 
	 * @return void
	 */
	public function edit()
	{
		if(! DB::query_result("SELECT id FROM {modules} WHERE name='rating' LIMIT 1"))
		{
			return;
		}

		if (! $this->diafan->configmodules("rating") && ! $this->diafan->config('category')
		   || ! $this->diafan->configmodules("rating_cat") && $this->diafan->config('category')
		   || $this->diafan->addnew
		)
		{
			return false;
		}
		
		$row = DB::fetch_array(DB::query("SELECT id, rating, count_votes FROM {rating} WHERE element_id='%d' AND module_name='%s' AND trash='0' LIMIT 1", $this->diafan->table, $this->diafan->edit));
		echo '<tr id="rating">
			<td class="td_first"></td>
			<td>'
			.($row
			 ? '
				<a href="'.BASE_PATH_HREF.'rating/edit'.$row["id"].'/">'.$this->diafan->_('Рейтинг').': '.$row["rating"]
				.' '.$this->diafan->_('голосов').': '.$row["count_votes"].'</a>'
			 : $this->diafan->_('Рейтинг').': '.$this->diafan->_('нет голосов'))
			.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Подключить рейтинг" для настроек модуля
	 * 
	 * @return void
	 */
	public function edit_config()
	{
		if(! DB::query_result("SELECT id FROM {modules} WHERE name='rating' LIMIT 1"))
		{
			return;
		}

		$fields = array('rating', 'rating_cat');
		foreach ($fields as $field)
		{
			if (empty($this->diafan->values[$field]))
			{
				$this->diafan->values[$field] = $this->diafan->configmodules($field);
			}
		}
		$this->diafan->show_tr_click_checkbox('cat', 'rating_cat');

		echo '
		<tr id="rating">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				<input type="checkbox" name="'.$this->diafan->key.'" value="1"'
				.($this->diafan->value == 1 ? " checked" : '')
				.'>'
				.$this->diafan->help().'
			</td>
		</tr>';

		if ($this->diafan->is_variable("cat"))
		{
			echo '
			    <script language="javascript" type="text/javascript">
				$(document).ready(function(){
					$(\'input[name=cat]\').attr("rel", $(\'input[name=cat]\').attr("rel") + \',#rating_cat\');
				});
				</script>
			<tr'.(! $this->diafan->values["cat"] ? ' class="hide"' : '').' id="rating_cat">
				<td class="td_first">'.$this->diafan->_("Подключить рейтинг к категориям").'</td>
				<td>
					<input type="checkbox" name="rating_cat" value="1"'
					.($this->diafan->values["rating_cat"] == 1 ? " checked" : '')
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
		if(! DB::query_result("SELECT id FROM {modules} WHERE name='rating' LIMIT 1"))
		{
			return;
		}

		$this->diafan->set_query("rating='%d'");
		$this->diafan->set_value(! empty($_POST["rating"]) ? $_POST["rating"] : '');

		if ($this->diafan->is_variable("cat"))
		{
			$this->diafan->set_query("rating_cat='%d'");
			$this->diafan->set_value(! empty($_POST["rating_cat"]) ? $_POST["rating_cat"] : '');
		}
	}

	/**
	 * Помечает рейтинг элемена на удаление или удаляет рейтинг
	 * 
	 * @param string $module_name название модуля, к которому прикреплен рейтинг
	 * @param integer $element_id номер элемента, к которому прикреплен рейтинг
	 * @param integer $trash_id номер записи в корзине, с которой связано удаление
	 * @param integer $is_category удаляемый элемент - категория
	 * @return void
	 */
	public function delete($module_name, $element_id, $trash_id = 0, $is_category = false)
	{
		if(! DB::query_result("SELECT id FROM {modules} WHERE name='rating' LIMIT 1"))
		{
			return;
		}

		if ($is_category)
		{
			return;
		}
		$this->diafan->del_or_trash_where("rating", "element_id='".$element_id."' AND module_name='".$module_name."'", $trash_id);
		$this->diafan->_cache->delete("", "rating");
	}
}