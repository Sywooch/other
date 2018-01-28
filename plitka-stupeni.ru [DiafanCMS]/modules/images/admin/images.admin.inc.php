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
 * Images_admin_inc
 * 
 * Редактирование полей, связанных с работой модуля "Изображения"
 */
class Images_admin_inc extends Diafan
{
	/**
	 * var array локальный кэш подключения
	 */
	private $cache;

	/**
	 * Редактирование поля "Изображения"
	 * 
	 * @return void
	 */
	public function edit()
	{
		if($this->diafan->addnew)
		{
			$site_id = $this->diafan->site;
		}
		else
		{
			$site_id = ! empty($this->diafan->values["site_id"]) ? $this->diafan->values["site_id"] : 0;
		}
		if ($this->diafan->config('category') && ! $this->diafan->configmodules("images_cat", $this->diafan->module, $site_id)
		   || ! $this->diafan->config('category') && ! $this->diafan->configmodules("images", $this->diafan->module, $site_id))
		{
			return;
		}
		$name = $this->diafan->variable_name();
		$help = 'images';
		$this->edit_view(0, $name, $help);
	}

	/**
	 * Редактирование поля с типом "Изображения" из конструктора
	 *
	 * @param integer $id номер поля конструктора
	 * @param string $name имя поля конструктора
	 * @param string $help описание поля конструктора
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	public function edit_param($id, $name, $help, $attr = '')
	{
		$this->edit_view($id, $name, $help, $attr);
	}

	/**
	 * Шаблон редактирования изображений
	 * 
	 * @param integer $id номер поля конструктора
	 * @param string $name имя поля
	 * @param string $help описание поля
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	private function edit_view($id, $name, $help, $attr = '')
	{
		$this->diafan->config('multiupload', true);
		if (! extension_loaded('gd'))
		{
			echo '<div class="error">'.$this->diafan->_('Внимание! Не установлена библиотека GD. Работа модуля ограничена. Обратитесь в техподдержку вашего хостинга!').'</div>';
		}
		Customization::inc('modules/images/admin/images.admin.view.php');
		if(! isset($GLOBALS["include_images_admin_js"]))
		{
			echo '<script type="text/javascript" src="'.BASE_PATH.'modules/images/admin/images.admin.inc.js"></script>';
			$GLOBALS["include_images_admin_js"] = true;
		}
		if($this->diafan->addnew && empty($GLOBALS["images_hidden_tmpcode"]))
		{
			echo '<input type="hidden" name="tmpcode" value="'.md5(rand(0, 9999)).'">';
			$GLOBALS["images_hidden_tmpcode"] = true;
		}

		echo '<tr valign="top" id="images'.$id.'"'.$attr.'>
			<td class="td_first">'.$name.'</td>
			<td param_id="'.$id.'">	
				<div class="images_container images_container'.$id.'">';
				if (! $this->diafan->addnew)
				{
					$images_view = new Images_admin_view($this->diafan);
					echo $images_view->show($this->diafan->edit, $id);
				}
				echo '</div>
				'.$this->diafan->help($help).'
				<div class="errors error_images'.$id.'"></div>
				<div class="selectarea"></div>
			</td>
		</tr>';
		if(strpos($attr, 'class="') !== false)
		{
			$attr = str_replace('class="', 'class="images_tr ', $attr);
		}
		else
		{
			$attr .= ' class="images_tr"';
		}
		echo '<tr'.$attr.'>
			<td colspan="2">
				<div class="file-uploader" id="file-uploader'.$id.'" param_id="'.$id.'">
					<noscript>
						<p>Please enable JavaScript to use file uploader.</p>
						<!-- or put a simple form for upload here -->
					</noscript>
				</div>
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Подключить изображения" в настройках модуля
	 * 
	 * @return void
	 */
	public function edit_config()
	{
		$fields = array('images', 'images_variations', 'list_img', 'use_animation', 'resize');

		$category = false;
		if ($this->diafan->is_variable("cat"))
		{
			$category = true;
			$fields[] = 'images_cat';
			$fields[] = 'images_variations_cat';
			$fields[] = 'list_img_cat';
		}

		foreach ($fields as $field)
		{
			if (empty($this->diafan->values[$field]))
			{
				$this->diafan->values[$field] = $this->diafan->configmodules($field);
			}
		}
		$this->diafan->show_tr_click_checkbox('images', array(
				'list_img',
				'images_variations',
				'use_animation',
				'upload_max_filesize',
				'resize'
		));
		if ($category)
		{
			$this->diafan->show_tr_click_checkbox('images_cat', 'images_variations_cat');
			$this->diafan->show_tr_click_checkbox('images_cat', 'list_img_cat');
			$this->diafan->show_tr_click_checkbox('cat', 'images_cat');
			?>
			<script language="javascript" type="text/javascript">$('input[name=cat]').attr("rel", $('input[name=cat]').attr("rel") + ',#images_cat');</script>
			<?php
		}
		echo '
		<script type="text/javascript" src="'.BASE_PATH.'modules/images/admin/images.admin.inc.config.js?1"></script>

		<tr id="images">
			<td class="td_first">'.$this->diafan->variable_name("images").'</td>
			<td>
				<input type="checkbox" name="images"'
				.(! extension_loaded('gd')
				 ? ' onclick="javascript:alert(\''.$this->diafan->_('Параметр не может быть включен, так как не установлена библиотека GD. Обратитесь в техподдержку вашего хостинга!').'\');" value="0"'
				 : $this->diafan->show_tr_click_checkbox("images").' value="1" '
				   .($this->diafan->values["images"] == 1 ? " checked" : '')
				 )
				.' id="images_">
				'.$this->diafan->help("images").'
			</td>
		</tr>';
		$count_variation = $this->diafan->variable("images", "count_variation");
		$this->edit_config_view($this->diafan->values["images_variations"], $count_variation);

		if ($this->diafan->module != 'site')
		{
			echo '
			<tr id="list_img">
				<td class="td_first">'.$this->diafan->_("Отображение изображений в списке").'</td>
				<td>
					<select name="list_img">
						<option value="0"'.($this->diafan->values["list_img"] == 0 ? ' selected' : '').'>'.$this->diafan->_('нет').'</option>
						<option value="1"'.($this->diafan->values["list_img"] == 1 ? ' selected' : '').'>'.$this->diafan->_('показывать одно изображение').'</option>
						<option value="2"'.($this->diafan->values["list_img"] == 2 ? ' selected' : '').'>'.$this->diafan->_('показывать все изображения').'</option>
					</select>
				</td>
			</tr>';
		}
		if ($category)
		{
			echo '
			<tr id="images_cat"'.(! $this->diafan->values["cat"] ? ' class="hide"' : '').'>
				<td class="td_first">'.$this->diafan->_("Использовать изображения для категории").'</td>
				<td>
					<input type="checkbox" name="images_cat"'
					.(! extension_loaded('gd')
					 ? ' onclick="javascript:alert(\''.$this->diafan->_('Параметр не может быть включен, так как не установлена библиотека GD. Обратитесь в техподдержку вашего хостинга!').'\');" value="0"'
					 : $this->diafan->show_tr_click_checkbox("images_cat").' value="1" '
					   .($this->diafan->values["images_cat"] == 1 ? " checked" : '')
					 )
					.' id="images_cat_">
				</td>
			</tr>
			<tr id="images_variations_cat"'.(! $this->diafan->values["cat"] ? ' class="hide"' : '').' valign="top">
				<td class="td_first">'.$this->diafan->_("Генерировать %sразмеры изображений%s для категорий", '<a href="'.BASE_PATH_HREF.'images/" target="_blank">', '</a>').'</td>
				<td>';
				$variations = unserialize($this->diafan->values["images_variations_cat"]);
				$variation_medium = array('name' => 'medium', 'id'  => 0);
				$variation_large = array('name' => 'large', 'id'  => 0);
				if($variations)
				{
					foreach($variations as $variation)
					{
						if($variation["name"] == 'medium')
						{
							$variation_medium = $variation;
						}
						if($variation["name"] == 'large')
						{
							$variation_large = $variation;
						}
					}
				}
				$this->get_images_variation(true, $count_variation, $variation_large);
				$this->get_images_variation(true, $count_variation, $variation_medium);
				if($variations)
				{
					foreach($variations as $variation)
					{
						if($variation["name"] != 'medium' && $variation["name"] != 'large')
						{
							$this->get_images_variation(true, $count_variation, $variation);
						}
					}
				}
				$this->get_images_variation(true, $count_variation);
				echo '
				<a href="javascript:void(0)" class="images_variation_plus" title="'.$this->diafan->_('Добавить').'"><img src="'.BASE_PATH.'adm/img/add.png" width="16" height="16" alt="'.$this->diafan->_('Добавить').'"></a>';
				echo '</td>
			</tr>
			<tr id="list_img_cat"'.(! $this->diafan->values["cat"] ? ' class="hide"' : '').' valign="top">
				<td class="td_first">'.$this->diafan->_("Отображение изображений категорий в списке категорий").'</td>
				<td>
					<select name="list_img_cat">
						<option value="0"'.($this->diafan->values["list_img_cat"] == 0 ? ' selected' : '').'>'.$this->diafan->_('нет').'</option>
						<option value="1"'.($this->diafan->values["list_img_cat"] == 1 ? ' selected' : '').'>'.$this->diafan->_('показывать одно изображение').'</option>
						<option value="2"'.($this->diafan->values["list_img_cat"] == 2 ? ' selected' : '').'>'.$this->diafan->_('показывать все изображения').'</option>
					</select>
				</td>
			</tr>';
		}
		echo '
		<tr id="use_animation">
			<td class="td_first">'.$this->diafan->_("Использовать анимацию при увеличении изображений").'</td>
			<td>
				<input type="checkbox" name="use_animation" value="1"'.($this->diafan->values["use_animation"] == 1 ? " checked" : '').'>
			</td>
		</tr>';
		$this->edit_config_view_2();
		echo '
		<tr id="resize" valign="top">
			<td class="td_first">'.$this->diafan->_("Применить настройки ко всем ранее загруженным изображениям").'</td>
			<td>
				<input type="button" name="resize" confirm="'.$this->diafan->_('Изменения необратимы! Для изменения размера необходимо некоторое время. Не закрывайте окно браузера до окончания выполнения скрипта. Продолжить?').'" value="'.$this->diafan->_('Применить').'">
				<div class="errors images_loading_resize"><img src="'.BASE_PATH.'adm/img/loading.gif"></div>
				<div class="errors error_resize"></div>
			</td>
		</tr>';
	}

	/**
	 * Редактирование настроек поля конструктора с типом "Изображения"
	 * 
	 * @param string $config конфигурация поля
	 * @return void
	 */
	public function edit_config_param($config)
	{
		$this->edit_config_view($config, 1);
	}

	/**
	 * Настройки модуля
	 *
	 * @param string $images_variations серилизованные данные о размерах изображений
	 * @param integer $count_variation количество допустимых вариантов изображения
	 * @return void
	 */
	private function edit_config_view($images_variations, $count_variation)
	{
		echo '
		<tr id="images_variations" valign="top">
			<td class="td_first">'.$this->diafan->_("Генерировать %sразмеры изображений%s", '<a href="'.BASE_PATH_HREF.'images/" target="_blank">', '</a>').'</td>
			<td>';
			$variations = unserialize($images_variations);
			$variation_medium = array('name' => 'medium', 'id'  => 0);
			$variation_large = array('name' => 'large', 'id'  => 0);
			if($variations)
			{
				foreach($variations as $variation)
				{
					if($variation["name"] == 'medium')
					{
						$variation_medium = $variation;
					}
					if($variation["name"] == 'large')
					{
						$variation_large = $variation;
					}
				}
			}
			$this->get_images_variation(false, $count_variation, $variation_large);
			if($count_variation != 1)
			{
				$this->get_images_variation(false, $count_variation, $variation_medium);
			}
			if($variations && $count_variation != 1)
			{
				foreach($variations as $variation)
				{
					if($variation["name"] != 'medium' && $variation["name"] != 'large')
					{
						$this->get_images_variation(false, $count_variation, $variation);
					}
				}
			}
			if($count_variation != 1)
			{
				$this->get_images_variation(false, $count_variation);
				echo '
				<a href="javascript:void(0)" class="images_variation_plus" title="'.$this->diafan->_('Добавить').'"><img src="'.BASE_PATH.'adm/img/add.png" width="16" height="16" alt="'.$this->diafan->_('Добавить').'"></a>';
			}
			echo '</td>
		</tr>';
	}

	/**
	 * Настройки модуля, вторая часть
	 *
	 * @return void
	 */
	private function edit_config_view_2()
	{
		echo '
		<tr id="upload_max_filesize">
			<td class="td_first">'.$this->diafan->_("Максимальный размер загружаемых файлов").'</td>
			<td>
				'.ini_get('upload_max_filesize').'
			</td>
		</tr>';
	}

	/**
	 * Выводит вариант размера изображений в настройках модуля
	 *
	 * @param boolean $is_category настройка для категорий
	 * @param integer $count_variation количество допустимых вариантов изображения
	 * @param array $module_variation выбранный вариант
	 * @return void
	 */
	private function get_images_variation($is_category, $count_variation, $module_variation = array())
	{
		if(! isset($this->cache["image_variations"]))
		{
			$this->cache["image_variations"] = array();
			$result = DB::query("SELECT id, name FROM {images_variations} WHERE trash='0' ORDER BY id ASC");
			while($row = DB::fetch_array($result))
			{
				$this->cache["image_variations"][] = $row;
			}
		}
		echo '
		<div class="images_variation"'.(empty($module_variation) ? ' style="display:none"' : '').'>';
		if(empty($module_variation))
		{
			$module_variation = array("name" => '', "id" => 0);
		}
		echo '<select name="images_variation'.($is_category ? '_cat' : '').'_id[]">';
		foreach($this->cache["image_variations"] as $variation)
		{
			echo '<option value="'.$variation["id"].'"'.($variation["id"] == $module_variation["id"] ? ' selected' : '').'>'.$variation["name"].'</option>';
		}
		echo '</select> ';
		if($module_variation["name"] == 'medium' || $module_variation["name"] == 'large' || $count_variation == 1)
		{
			echo '<input type="hidden" name="images_variation'.($is_category ? '_cat' : '').'_name[]" size="10" value="'.$module_variation["name"].'">';
			if($module_variation["name"] == 'medium')
			{
				echo 'medium';
			}
			if($module_variation["name"] == 'large' && $count_variation != 1)
			{
				echo 'large';
			}
		}
		else
		{
			echo '<input type="text" name="'.(! $module_variation["id"] ? 'hide_' : '').'images_variation'.($is_category ? '_cat' : '').'_name[]" size="10" value="'.$module_variation["name"].'" title="'.$this->diafan->_('Название размера для шаблонного тега').'">
			<a href="javascript:void(0)" confirm="'.$this->diafan->_('Все изображения этого размера будут удалены. Вы действительно хотите удалить размер?').'" class="images_variation_delete"><img src="'.BASE_PATH.'adm/img/delete.png" width="13" height="13" alt="'.$this->diafan->_('Удалить').'"></a>';
		}
		echo '</div>';
	}

	/**
	 * Сохранение поля "Изображения"
	 * 
	 * @return void
	 */
	public function save()
	{
		if (! empty($_POST["tmpcode"]))
		{
			DB::query("UPDATE {images} SET element_id=%d, tmpcode='' WHERE module_name='%s' AND tmpcode='%s'", $this->diafan->save, $this->diafan->module.($this->diafan->config('category') ? 'cat' : ''), $_POST["tmpcode"]);
		}
		$result = DB::query("SELECT id, module_name FROM {images} WHERE element_id=0 AND created<%d AND module_name<>'editor'", time() - 14400);
		while ($row = DB::fetch_array($result))
		{
			$this->diafan->_images->delete(0, $row["module_name"], $row["id"]);
		}
	}

	/**
	 * Сохранение настроек конфигурации модулей
	 * 
	 * @return void
	 */
	public function save_config()
	{
		$fields = array('images', 'list_img', 'use_animation', 'resize');

		$category = false;
		if ($this->diafan->is_variable("cat"))
		{
			$category = true;
		}
		if ($category)
		{
			$fields[] = 'images_cat';
			$fields[] = 'list_img_cat';
		}
		foreach ($fields as $field)
		{
			$this->diafan->set_query($field."='%d'");
			$this->diafan->set_value(! empty($_POST[$field]) ? $_POST[$field] : '');
		}
		$variations = array();
		$new_variations = array();
		foreach($_POST["images_variation_name"] as $i => $name)
		{
			$variations[] = array("name" => $this->diafan->translit($name), "id" => $_POST["images_variation_id"][$i]);
			$new_variations[] = $_POST["images_variation_id"][$i];
		}
		$this->diafan->set_query("images_variations='%s'");
		$this->diafan->set_value(serialize($variations));

		if($category)
		{
			$variations = array();
			foreach($_POST["images_variation_cat_name"] as $i => $name)
			{
				$variations[] = array("name" => $this->diafan->translit($name), "id" => $_POST["images_variation_cat_id"][$i]);
			}
			$this->diafan->set_query("images_variations_cat='%s'");
			$this->diafan->set_value(serialize($variations));
		}
	}

	/**
	 * Сохранение настроек для поля конструктора
	 * 
	 * @return void
	 */
	public function save_config_param()
	{
		if($_POST["type"] == "images")
		{
			$value = array();
			$new_variations = array();
			foreach($_POST["images_variation_name"] as $i => $name)
			{
				$value[] = array("name" => $this->diafan->translit($name), "id" => $_POST["images_variation_id"][$i]);
				$new_variations[] = $_POST["images_variation_id"][$i];
			}
			$value = serialize($value);
			$this->diafan->set_query("config='%s'");
			$this->diafan->set_value($value);
		}
	}

	/**
	 * Помечает изображения на удаление или удаляет изображения
	 * 
	 * @param string $module_name название модуля, к которому прикреплены изображения
	 * @param integer $element_id номер элемента, к которому прикреплены изображения
	 * @param integer $trash_id номер записи в корзине, с которой связано удаление
	 * @param integer $is_category удаляемый элемент - категория
	 * @return void
	 */
	public function delete($module_name, $element_id, $trash_id = 0, $is_category = false)
	{
		if (is_dir(ABSOLUTE_PATH.USERFILES."/".$module_name))
		{
			if ($_POST["action"] == "delete")
			{
				$this->diafan->_images->delete($element_id, $module_name.($is_category ? 'cat' : ''));
			}
			$this->diafan->del_or_trash_where("images", "element_id='".$element_id."' AND module_name='".$module_name.($is_category ? 'cat' : '')."'", $trash_id);
		}
	}

	/**
	 * Удаляет изображение
	 * 
	 * @param integer $id номер удаляемого изображения
	 * @param string $table название таблицы
	 * @return void
	 */
	public function del_from_trash($id, $table)
	{
		switch($table)
		{
			case 'images':
				$row = DB::fetch_array(DB::query("SELECT module_name, element_id FROM {images} WHERE id=%d LIMIT 1", $id));
				$this->diafan->_images->delete($row["element_id"], $row["module_name"], $id);
				break;

			case 'images_variations':
				if(! $folder = DB::query_result("SELECT folder FROM {images_variations} WHERE id=%d AND trash='0' LIMIT 1", $id))
					return;

				if (! $dir = opendir(ABSOLUTE_PATH.USERFILES))
				{
					throw new Exception('Папка '.ABSOLUTE_PATH.USERFILES.' не существует.');
				}
				while (($module = readdir($dir)) !== false)
				{
					if(is_dir(ABSOLUTE_PATH.USERFILES.'/'.$module.'/'.$folder))
					{
						if (is_dir(ABSOLUTE_PATH.USERFILES.'/'.$module.'/'.$folder))
						{
							$dirr = opendir(ABSOLUTE_PATH.USERFILES.'/'.$module.'/'.$folder);
							while (($file = readdir($dirr)) !== false)
							{
								if($file == '.' || $file == '..')
									continue;
								if(! unlink(ABSOLUTE_PATH.USERFILES.'/'.$module.'/'.$folder.'/'.$file))
								{
									throw new Exception('Невозможно удалить файл '.ABSOLUTE_PATH.USERFILES.'/'.$module.'/'.$folder.'/'.$file.'. Проверьте права (777) доступа к файлу.');
								}
							}
							closedir($dirr);
						}
						rmdir(ABSOLUTE_PATH.USERFILES.'/'.$module.'/'.$folder);
					}
				}
				closedir($dir);
				break;
		}
	}
}