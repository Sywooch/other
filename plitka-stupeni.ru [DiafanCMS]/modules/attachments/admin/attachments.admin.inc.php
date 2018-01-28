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
 * Attachments_admin_inc
 * 
 * Подключение модуля "Прикрепленные файлы" к другим модулям для административной части
 */
class Attachments_admin_inc extends Diafan
{
	/**
	 * Редактирование поля "Прикрепленные файлы"
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
		$name = $this->diafan->variable_name();
		$help = 'attachments';
		$config = array(
			"use_animation" => $this->diafan->configmodules("use_animation", $this->diafan->module, $site_id),
			"max_count_attachments" => $this->diafan->configmodules("max_count_attachments", $this->diafan->module, $site_id),
			"attachment_extensions" => $this->diafan->configmodules("attachment_extensions", $this->diafan->module, $site_id),
		);
		$this->edit_view('', $name, $help, $config);
	}

	/**
	 * Редактирование поля с типом "Файлы" из конструктора
	 *
	 * @param integer $id номер поля конструктора
	 * @param string $name имя поля конструктора
	 * @param string $help описание поля конструктора
	 * @param string $config конфигурация поля
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	public function edit_param($id, $name, $help, $config, $attr = '')
	{
		$config = unserialize($config);
		$this->edit_view($id, $name, $help, $config, $attr);
	}

	/**
	 * Шаблон редактирования файлов
	 * 
	 * @param integer $id номер поля конструктора
	 * @param string $name имя поля
	 * @param string $help описание поля
	 * @param array $config конфигурация
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	private function edit_view($id, $name, $help, $config, $attr = '')
	{
		echo '<script type="text/javascript" src="' . BASE_PATH .'modules/attachments/admin/attachments.admin.inc.js"></script>
		<tr id="attachments'.$id.'" class="attachments" valign="top"'.$attr.'>
			<td class="td_first">'.$name.'</td>
			<td>';
			if(! $this->diafan->addnew)
			{
				$anim_link = '';
				$anim = '';
				if(! empty($config["use_animation"]))
				{
					$anim_link = ' rel="prettyPhoto[attachments_link]"';
					$anim = ' rel="prettyPhoto[attachments]"';
				}
				$attachments = $this->diafan->_attachments->get($this->diafan->edit, $this->diafan->table, 0, $id);
				foreach ($attachments as $row)
				{
					echo '<div class="attachment">
					<input type="hidden" name="hide_attachment_delete[]" value="'.$row["id"].'">';
					if ($row["is_image"])
					{
						echo '<a href="'.$row["link"].'"'.$anim.'><img src="'.$row["link_preview"].'"></a> ';
						echo '<a href="'.$row["link"].'"'.$anim_link.'>'.$row["name"].'</a>';
					}
					else
					{
						echo '<a href="'.$row["link"].'">'.$row["name"].'</a>
						';
					}
					echo '<a href="#" class="attachment_delete" confirm="'.$this->diafan->_('Вы действительно хотите удалить файл?').'"><img src="'.BASE_PATH.'adm/img/delete.png" width="13" height="13" alt="'.$this->diafan->_('Удалить').'"></a></div>';
				}
			}
			echo '
			<div class="attachment_files">
				<input type="file" name="attachments'.$id.'[]" size="40" max="'.$config["max_count_attachments"].'" class="inpfiles">
			</div>';
			if ($config["attachment_extensions"])
			{
				echo '<div class="attachment_extensions">('.$this->diafan->_('Доступные типы файлов').': '.$config["attachment_extensions"].')</div>';
			}
			echo $this->diafan->help($help).'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Прикрепленные файлы" для настроек модуля
	 * 
	 * @return void
	 */
	public function edit_config()
	{
		$fields = array('max_count_attachments', 'attachment_extensions', 'recognize_image', 'attach_big_width', 'attach_big_height', 'attach_big_quality', 'attach_medium_width', 'attach_medium_height', 'attach_medium_quality', 'use_animation', 'attachments_access_admin');
		foreach ($fields as $field)
		{
			if (empty($values[$field]))
			{
				$values[$field] = $this->diafan->configmodules($field, $this->diafan->module, $this->diafan->site);
			}
		}
		$this->diafan->show_tr_click_checkbox('attachments', array(
			'max_count_attachments',
			'attachment_extensions',
			'recognize_image',
			'upload_max_filesize'
		));
		echo '
		<tr id="attachments">
			<td class="td_first">'.$this->diafan->variable_name("attachments").'</td>
			<td>
				<input type="checkbox" name="attachments"'.$this->diafan->show_tr_click_checkbox("attachments").'" value="1" '
				.(! empty($this->diafan->values["attachments"]) ? " checked" : '')
				.' id="attachments_">
				'.$this->diafan->help("attachments").'
			</td>
		</tr>';
		$this->edit_config_view($values);
	}

	/**
	 * Редактирование настроек поля конструктора с типом "Файлы"
	 * 
	 * @param string $config конфигурация поля
	 * @return void
	 */
	public function edit_config_param($config)
	{
		$values = unserialize($config);
		$this->edit_config_view($values);
	}

	/**
	 * Настройки модуля
	 *
	 * @param array $values значения настроек
	 * @return void
	 */
	private function edit_config_view($values)
	{
		$fields = array('max_count_attachments', 'attachment_extensions', 'recognize_image', 'attach_big_width', 'attach_big_height', 'attach_big_quality', 'attach_medium_width', 'attach_medium_height', 'attach_medium_quality', 'use_animation', 'attachments_access_admin');
		foreach ($fields as $field)
		{
			if (empty($values[$field]))
			{
				$values[$field] = "";
			}
		}
		$this->diafan->show_tr_click_checkbox('recognize_image', array(
			'attach_big',
			'attach_medium',
			'attach_use_animation'
		));
		echo '
		<script type="text/javascript" src="' . BASE_PATH .'modules/attachments/admin/attachments.admin.inc.js"></script>
		<tr id="max_count_attachments">
			<td class="td_first">'.$this->diafan->_("Максимальное количество добавляемых файлов").'</td>
			<td>
				<input type="text" name="max_count_attachments" size="20" value="'.$values["max_count_attachments"].'" class="inpnum">
			</td>
		</tr>
		<tr id="attachment_extensions">
			<td class="td_first">'.$this->diafan->_("Доступные типы файлов (через запятую)").'</td>
			<td>
				<input type="text" name="attachment_extensions" size="40" value="'.$values["attachment_extensions"].'">
			</td>
		</tr>
		<tr id="attachments_access_admin">
			<td class="td_first">'.$this->diafan->_("Доступ к файлам только для админа").'</td>
			<td>
				<input type="checkbox" name="attachments_access_admin"'.($values["attachments_access_admin"] ? '  checked' : '').'>
			</td>
		</tr>
		<tr id="recognize_image">
			<td class="td_first">'.$this->diafan->_("Распознавать изображения").'</td>
			<td>
				<input type="checkbox" name="recognize_image"'
				.(! extension_loaded('gd')
				 ? ' onclick="javascript:alert(\''.$this->diafan->_('Параметр не может быть включен, так как не установлена библиотека GD. Обратитесь в техподдержку вашего хостинга!').'\');" value="0"'
				 : $this->diafan->show_tr_click_checkbox("recognize_image").' value="1" '
				   .($values["recognize_image"] == 1 ? " checked" : '')
				 )
				.' id="recognize_image_">
			</td>
		</tr>
		<tr id="attach_big">
			<td class="td_first">'.$this->diafan->_('Размер большого изображения').'</td>
			<td><input type="text" name="attach_big_width" size="3" value="'.$values["attach_big_width"].'" class="inpnum"> x
				<input type="text" name="attach_big_height" size="3" value="'.$values["attach_big_height"].'" class="inpnum">,
				'.$this->diafan->_('качество').'
				<input type="text" name="attach_big_quality" size="2" value="'.$values["attach_big_quality"].'" class="inpnum">'
				.$this->diafan->help("Размер и качество, до которых изображение будет автоматически изменяться после загрузки").'
			</td>
		</tr>
		<tr id="attach_medium">
			<td class="td_first">'.$this->diafan->_('Размер маленького изображения').'</td>
			<td>
				<input type="text" name="attach_medium_width" size="3" value="'.$values["attach_medium_width"].'" class="inpnum"> x
				<input type="text" name="attach_medium_height" size="3" value="'.$values["attach_medium_height"].'" class="inpnum">,
				'.$this->diafan->_('качество').'
				<input type="text" name="attach_medium_quality" size="2" value="'.$values["attach_medium_quality"].'" class="inpnum">'
				.$this->diafan->help("Размер и качество, до которых изображение будет автоматически изменяться после загрузки").'
			</td>
		</tr>
		<tr id="attach_use_animation">
			<td class="td_first">'.$this->diafan->_("Использовать анимацию при увеличении изображений").'</td>
			<td>
				<input type="checkbox" name="use_animation" value="1"'.($values["use_animation"] == 1 ? " checked" : '').'>
			</td>
		</tr>
		<tr id="upload_max_filesize">
			<td class="td_first">'.$this->diafan->_("Максимальный размер загружаемых файлов").'</td>
			<td>
				'.ini_get('upload_max_filesize').'
			</td>
		</tr>';
	}

	/**
	 * Сохранение поля "Прикрепленные файлы"
	 * 
	 * @return void
	 */
	public function save()
	{
		$result = DB::query("SELECT id FROM {attachments} WHERE module_name='%s' AND element_id=%d", $this->diafan->table, $this->diafan->save);
		while ($row = DB::fetch_array($result))
		{
			if (! empty($_POST["attachment_delete"]) && in_array($row["id"], $_POST["attachment_delete"]))
			{
				$this->diafan->_attachments->delete($this->diafan->save, $this->diafan->table, $row["id"]);
			}
		}

		if (! empty($_FILES['attachments']))
		{
			$config["site_id"] = $this->diafan->get_param($_POST, "site_id", 0, 2);
			$config["type"] = 'configmodules';

			$err = $this->diafan->_attachments->save($this->diafan->save, $this->diafan->table, $config);

			if (! empty($err) && $err != 'success' && $err != 'empty')
			{
				throw new Exception($err);
			}
		}
	}

	/**
	 * Сохранение поля с типом "Файлы" из конструктора
	 *
	 * @param integer $id номер поля
	 * @param array $config настройки для поля конструктора
	 * @return void
	 */
	public function save_param($id, $config)
	{
		$result = DB::query("SELECT id FROM {attachments} WHERE module_name='%s' AND element_id=%d AND param_id=%d", $this->diafan->table, $this->diafan->save, $id);
		while ($row = DB::fetch_array($result))
		{
			if (! empty($_POST["attachment_delete"]) && in_array($row["id"], $_POST["attachment_delete"]))
			{
				$this->diafan->_attachments->delete($this->diafan->save, $this->diafan->table, $row["id"], $id);
			}
		}

		if (! empty($_FILES['attachments'.$id]))
		{
			$config = unserialize($config);
			$config["param_id"] = $id;

			$err = $this->diafan->_attachments->save($this->diafan->save, $this->diafan->table, $config);

			if (! empty($err) && $err != 'success' && $err != 'empty')
			{
				throw new Exception($err);
			}
		}
	}

	/**
	 * Сохранение настроек конфигурации модулей
	 * 
	 * @return void
	 */
	public function save_config()
	{
		$fields = array('attachments', 'max_count_attachments', 'attachments_access_admin', 'recognize_image', 'attach_big_width', 'attach_big_height', 'attach_big_quality', 'attach_medium_width', 'attach_medium_height', 'attach_medium_quality', 'use_animation');
		foreach ($fields as $field)
		{
			$this->diafan->set_query($field."='%h'");
			$this->diafan->set_value(! empty($_POST[$field]) ? $_POST[$field] : '');
		}
		$this->diafan->set_query("attachment_extensions='%h'");
		$this->diafan->set_value(! empty($_POST["attachment_extensions"]) ? $_POST["attachment_extensions"] : '');
	}

	/**
	 * Сохранение настроек для поля конструктора
	 * 
	 * @return void
	 */
	public function save_config_param()
	{
		if($_POST["type"] == "attachments")
		{
			$config = array(
				'max_count_attachments'    => $this->diafan->get_param($_POST, "max_count_attachments", 0, 2),
				"attachment_extensions"    => $this->diafan->get_param($_POST, "attachment_extensions", 0, 1),
				"recognize_image"          => ! empty($_POST["recognize_image"]) ? 1 : 0,
				"attachments_access_admin" => ! empty($_POST["attachments_access_admin"]) ? 1 : 0,
				"attach_big_width"         => $this->diafan->get_param($_POST, "attach_big_width", 0, 2),
				"attach_big_height"        => $this->diafan->get_param($_POST, "attach_big_height", 0, 2),
				"attach_big_quality"       => $this->diafan->get_param($_POST, "attach_big_quality", 0, 2),
				"attach_medium_width"      => $this->diafan->get_param($_POST, "attach_medium_width", 0, 2),
				"attach_medium_height"     => $this->diafan->get_param($_POST, "attach_medium_height", 0, 2),
				"attach_medium_quality"    => $this->diafan->get_param($_POST, "attach_medium_quality", 0, 2),
				"use_animation"            => ! empty($_POST["use_animation"]) ? 1 : 0,
			);
			$value = serialize($config);
			$this->diafan->set_query("config='%s'");
			$this->diafan->set_value($value);
		}
	}

	/**
	 * Помечает файлы на удаление или удаляет файлы
	 * 
	 * @param string $module_name название модуля, к которому прикреплены файлы
	 * @param integer $element_id номер элемента, к которому прикреплены файлы
	 * @param integer $trash_id номер записи в корзине, с которой связано удаление
	 * @param integer $is_category удаляемый элемент - категория
	 * @return void
	 */
	public function delete($module_name, $element_id, $trash_id = 0, $is_category = false)
	{
		if ($is_category)
		{
			return;
		}
		$is_param = false;
		if(strpos($module_name, '_param') !== false)
		{
			$module_name = str_replace('_param', '', $module_name);
			$is_param = true;
		}
		if (is_dir(ABSOLUTE_PATH.USERFILES."/".$module_name))
		{
			if (is_dir(ABSOLUTE_PATH.USERFILES."/".$module_name."/files"))
			{
				if ($_POST["action"] == "delete")
				{
					$result = DB::query("SELECT id, name, is_image FROM {attachments} WHERE module_name='%s' AND ".($is_param ? "param_id" : "element_id")."=%d", $module_name, $element_id);
					while ($row = DB::fetch_array($result))
					{
						if ($row["is_image"])
						{
							@unlink(ABSOLUTE_PATH.USERFILES."/".$module_name."/imgs/".$row["name"]);
							@unlink(ABSOLUTE_PATH.USERFILES."/".$module_name."/imgs/small/".$row["name"]);
						}
						else
						{
							@unlink(ABSOLUTE_PATH.USERFILES."/".$module_name."/files/".$row["id"]);
						}						
					}
				}
				$this->diafan->del_or_trash_where("attachments", ($is_param ? "param_id" : "element_id")."='".$element_id."' AND module_name='".$module_name."'", $trash_id);
			}
		}
	}

	/**
	 * Удаляет файл
	 * 
	 * @param integer $id номер удаляемого файла
	 * @return void
	 */
	public function del_from_trash($id, $table)
	{
		$row = DB::fetch_array(DB::query("SELECT module_name, element_id FROM {attachments} WHERE id=%d LIMIT 1", $id));
		$this->diafan->_attachments->delete($row["element_id"], $row["module_name"], $id);
	}
}