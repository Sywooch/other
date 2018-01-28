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
 * Images_inc
 * Работа с изображениями
 */
class Images_inc extends Model
{
	/**
	 * var array локальный кэш подключения
	 */
	private $cache;

	/**
	 * var array максимальный размер и качество оригинала изображения
	 */
	private $original = array(3000, 3000, 90);

	/**
	 * var array размер и качество изображения, выводимого в административной части
	 */
	private $small = array(50, 50, 70);

	/**
	 * Получает изображения, прикрепленные к элементу модуля
	 *
	 * @param string $variation размер изображения, указанный в настройках модуля
	 * @param integer $element_id номер элемента, к которому прикреплены изображения
	 * @param string $module_name название модуля, по умолчанию модуль, прикрепленный к текущей странице
	 * @param integer $site_id страница сайта, к которой прикреплен элемент
	 * @param string $alt альтернативный текст получаемых изображений
	 * @param boolean $is_category изображения прикреплены к категории
	 * @param integer $count количество изображений
	 * @param string $link_to_variation размер изображения, на который ведет ссылка
	 * @return array
	 */
	public function get($variation, $element_id, $module_name, $site_id, $alt, $param_id = 0, $is_category = false, $count = 0, $link_to = '')
	{
		if(! $variation)
		{
			return array();
		}
		$this->get_variations();
		
		if($param_id)
		{
			if(! isset($this->cache["param_config"][$module_name][$param_id]))
			{
				$this->cache["param_config"][$module_name][$param_id] = unserialize(DB::query_result("SELECT config FROM {%s_param} WHERE id=%d LIMIT 1", $module_name, $param_id));
			}
			$module_variations = $this->cache["param_config"][$module_name][$param_id];
		}
		else
		{
			$module_variations = unserialize($this->diafan->configmodules('images_variations'.($is_category ? '_cat' : ''), $module_name, $site_id));
		}
		if(! $module_variations)
			return array();

		$variation_folder = '';
		$link_to_variation_folder = '';
		foreach($module_variations as $module_variation)
		{
			if($module_variation['name'] == $variation && ! empty($this->cache["images_variations"][$module_variation['id']]))
			{
				$variation_folder = $this->cache["images_variations"][$module_variation['id']]["folder"];
			}
			if($link_to && $module_variation['name'] == $link_to && ! empty($this->cache["images_variations"][$module_variation['id']]))
			{
				$link_to_variation_folder = $this->cache["images_variations"][$module_variation['id']]["folder"];
			}
		}
		if(! $variation_folder)
		{
			return array();
		}

		$images = array();
		$result = DB::query(
				"SELECT id, name, [alt], [title] FROM {images}"
				." WHERE module_name='%s' AND element_id=%d AND param_id=%d AND trash='0'"
				.(is_array($count) ? " AND id IN (".implode(",", $count).")" : "")
				." ORDER BY sort ASC"
				.($count && ! is_array($count) ? " LIMIT ".$count : ''),
				$module_name.($is_category ? 'cat' : ''),
				$element_id, $param_id
			);
		while ($row = DB::fetch_array($result))
		{
			if(! file_exists(ABSOLUTE_PATH.USERFILES.'/'.$module_name.'/'.$variation_folder.'/'.$row["name"]))
			{
				continue;
			}

			
			if ($link_to_variation_folder)
			{
				$img["link"] = USERFILES.'/'.$module_name.'/'.$link_to_variation_folder.'/'.$row["name"];

				if (! $this->diafan->configmodules('use_animation', $module_name))
				{
					list($img["link_width"], $img["link_height"]) = getimagesize(ABSOLUTE_PATH.USERFILES.'/'.$module_name.'/'.$link_to_variation_folder.'/'.$row["name"]);
					$img["type"] = "large_image";
				}
				else
				{
					$img["type"] = "animation";
				}
			}
			else
			{
				$img["type"] = "link";
				$img["link"] = $link_to;
			}
			$img["id"] = $row["id"];
			list($img["width"], $img["height"]) = getimagesize(ABSOLUTE_PATH.USERFILES.'/'.$module_name.'/'.$variation_folder.'/'.$row["name"]);
			$img["alt"] = $row["alt"] ? $row["alt"] : $alt;
			$img["title"] = $row["title"] ? $row["title"] : $alt;
			$img["src"] = BASE_PATH.USERFILES.'/'.$module_name.'/'.$variation_folder.'/'.$row["name"];
			$images[] = $img;
		}
		return $images;
	}

	/*
	 * Удаляет прикрепленные изображения
	 *
	 * @param integer $element_id номер элемента, к которому прикреплены изображения
	 * @param string $module_name название модуля
	 * @param integer $image_id номер изображения
	 * @return void
	*/
	public function delete($element_id, $module_name, $image_id = 0)
	{
		$this->get_variations();
		if ($image_id)
		{
			$result = DB::query("SELECT * FROM {images} WHERE id=%d AND element_id=%d AND module_name='%h'", $image_id, $element_id, $module_name);
		}
		else
		{
			$result = DB::query("SELECT * FROM {images} WHERE element_id=%d AND module_name='%h'", $element_id, $module_name);
		}
		$module_name = str_replace("cat", "", $module_name);
		while ($row = DB::fetch_array($result))
		{
			DB::query("DELETE FROM {images} WHERE id='%d'", $row["id"]);
			if(file_exists(ABSOLUTE_PATH.USERFILES.'/original/'.$row["name"]))
			{
				unlink(ABSOLUTE_PATH.USERFILES.'/original/'.$row["name"]);
			}
			if(file_exists(ABSOLUTE_PATH.USERFILES.'/small/'.$row["name"]))
			{
				unlink(ABSOLUTE_PATH.USERFILES.'/small/'.$row["name"]);
			}
			foreach($this->cache["images_variations"] as $variation)
			{
				if(file_exists(ABSOLUTE_PATH.USERFILES.'/'.$module_name.'/'.$variation['folder'].'/'.$row["name"]))
				{
					unlink(ABSOLUTE_PATH.USERFILES.'/'.$module_name.'/'.$variation['folder'].'/'.$row["name"]);
				}
			}
		}
	}

	/*
	 * Удаляет прикрепленные изображения
	 *
	 * @param integer $element_id номер элемента, к которому прикреплены изображения
	 * @param string $module_name название модуля
	 * @param integer $site_id страница сайта
	 * @param sting $tmp_name расположение файла
	 * @param string $new_name название файла без расширения
	 * @param boolean $is_category изображения прикрепляются к категории
	 * @param boolean $handle ручная загрузка изображений по одной
	 * @param integer $param_id
	 * @param string $tmpcode временный код для прикрепления изображений к еще не созданному  элементу
	 * @return mixed
	*/
	public function upload($element_id, $module_name, $site_id, $tmp_name, $new_name, $is_category = false, $handle = false, $param_id = 0, $tmpcode = '')
	{
		if(! is_dir(ABSOLUTE_PATH.USERFILES."/original"))
		{
			mkdir(ABSOLUTE_PATH.USERFILES."/original", 0777);
			$text = 'Options -Indexes
			<files *>
			deny from all
			</files>';
		
			$fp = fopen(ABSOLUTE_PATH.USERFILES.'/original/.htaccess', "w");
			fwrite($fp, $text);
			fclose($fp);
		}

		$config_cat = $is_category ? '_cat' : '';
		if($param_id)
		{
			$config_images_variations = DB::query_result("SELECT config FROM {%s_param} WHERE id=%d LIMIT 1", $module_name, $param_id);
		}
		else
		{
			$config_images_variations = $this->diafan->configmodules("images_variations".$config_cat, $module_name, $site_id);
		}

		if (! $config_images_variations)
		{
			if($param_id)
			{
				return $this->diafan->_('В настройках полня не заданы размеры изображения.');
			}
			else
			{
				return $this->diafan->_('В настройках модуля не заданы размеры изображения.');
			}
		}

		$tmp = time().rand(0, 9999);
		if (! copy($tmp_name, ABSOLUTE_PATH.USERFILES."/original/".$tmp))
		{
			unlink(ABSOLUTE_PATH.USERFILES."/original/".$tmp);
			return $this->diafan->_('Не удалось загрузить файл. Возможно, закрыт доступ к папке или файл превышает максимально допустимый размер.');
		}
		else
		{
			$tmp_name = ABSOLUTE_PATH.USERFILES."/original/".$tmp;
		}
		
		$info = @getimagesize($tmp_name);
		if ($info == false)
		{
			unlink($tmp_name);
			return $this->diafan->_('Не верный формат файла. Изображения загружаются только в форматах  GIF, JPEG, PNG.');
		}

		Customization::inc("includes/image.php");

		$mimes = array(
			'image/gif' => 'gif',
			'image/jpeg' => 'jpg',
			'image/png' => 'png',
			'image/pjpeg' => 'jpg',
			'image/x-png'=> 'png'
		);
		if(empty($info['mime']) || ! in_array($info['mime'], array_keys($mimes)))
		{
			unlink($tmp_name);
			return $this->diafan->_('Не верный формат файла. Изображения загружаются только в форматах  GIF, JPEG, PNG.');
		}
		$extension = $mimes[$info['mime']];

		$new_name .= '.'.$extension;
		$rand = mt_rand(0, 999999);

		DB::query(
				"INSERT INTO {images} (module_name, element_id, param_id, name, tmpcode, created) VALUES ('%s', %d, %d, '%s', '%s', %d)",
				$module_name.($is_category ? "cat" : ""),
				$element_id,
				$param_id,
				$rand,
				$tmpcode,
				time()
			);

		$id = DB::query_result(
				"SELECT MAX(id) FROM {images} WHERE module_name='%s' AND element_id=%d AND param_id=%d AND name='%s' AND tmpcode='%s'",
				$module_name.($is_category ? "cat" : ""),
				$element_id,
				$param_id,
				$rand,
				$tmpcode
			);
		$new_name = $id.'_'.$new_name;
		DB::query("UPDATE {images} SET name='%h', sort=id WHERE id=%d", $new_name, $id);

		if (! copy($tmp_name, ABSOLUTE_PATH.USERFILES."/original/".$new_name))
		{
			unlink($tmp_name);
			$this->delete($element_id, $module_name.($is_category ? "cat" : ""), $id);
			return $this->diafan->_('Не удалось загрузить файл. Возможно, закрыт доступ к папке или файл превышает максимально допустимый размер.');
		}
		unlink($tmp_name);

		// уменьшает оригинал до размеров максимальных размеров
		if ($info[0] > $this->original[0] || $info[1] > $this->original[1])
		{
			if (! Image::resize(ABSOLUTE_PATH.USERFILES."/original/".$new_name, $this->original[0], $this->original[1], $this->original[2]))
			{
				$this->delete($element_id, $module_name.($is_category ? "cat" : ""), $id);
				return $this->diafan->_('Не верный формат файла. Изображения загружаются только в форматах  GIF, JPEG, PNG.');
			}
		}

		if(! is_dir(ABSOLUTE_PATH.USERFILES."/small"))
		{
			mkdir(ABSOLUTE_PATH.USERFILES."/small", 0777);
		}

		// добавляет вариант изображения, выводимый в административной части
		copy(ABSOLUTE_PATH.USERFILES."/original/".$new_name, ABSOLUTE_PATH.USERFILES."/small/".$new_name);
		Image::resize(ABSOLUTE_PATH.USERFILES."/small/".$new_name, $this->small[0], $this->small[1], $this->small[2]);

		if(! is_dir(ABSOLUTE_PATH.USERFILES."/".$module_name))
		{
			mkdir(ABSOLUTE_PATH.USERFILES."/".$module_name, 0777);
		}
		$this->get_variations();
		$module_images_variations = unserialize($config_images_variations);
		foreach($module_images_variations as $module_variation)
		{
			if(empty($this->cache["images_variations"][$module_variation["id"]]))
				continue;

			$variation = $this->cache["images_variations"][$module_variation["id"]];

			$action = $this->get_variation_image($new_name, $module_name, $variation, $handle);
			if($action && $action["name"] == 'selectarea')
			{
				$path = BASE_PATH.USERFILES."/".$module_name."/".$variation["folder"]."/".$new_name;
				$selectarea[] = array("id" => $id, "variant_id" => $module_variation["id"], "path" => $path, "width" => $action["width"], "height" => $action["height"]);
			}
		}
		if(! empty($selectarea))
		{
			return $selectarea;
		}
		else
		{
			return false;
		}
	}
	
	public function get_variation_image($file_name, $module_name, $variation, $handle = false, $after_selectarea = false)
	{
		Customization::inc("includes/image.php");

		if(! is_dir(ABSOLUTE_PATH.USERFILES."/".$module_name."/".$variation["folder"]))
		{
			mkdir(ABSOLUTE_PATH.USERFILES."/".$module_name."/".$variation["folder"], 0777);
		}

		$path = ABSOLUTE_PATH.USERFILES."/".$module_name."/".$variation["folder"]."/".$file_name;
		if(! $after_selectarea)
		{
			copy(ABSOLUTE_PATH.USERFILES."/original/".$file_name, $path);
			chmod($path, 0755);
		}

		$actions = unserialize($variation["param"]);
		foreach($actions as $action)
		{
			if($after_selectarea)
			{
				if($action["name"] == 'selectarea')
				{
					$after_selectarea = false;
				}
				continue;
			}
			switch($action["name"])
			{
				case 'resize':
					Image::resize($path, $action["width"], $action["height"], $variation["quality"], $action["max"]);
					break;

				case 'selectarea':
					if($handle)
					{
						return $action;
					}
					break;

				case 'crop':
					Image::crop($path, $action["width"], $action["height"], $variation["quality"], $action["vertical"], $action["vertical_px"], $action["horizontal"], $action["horizontal_px"]);
					break;

				case 'wb':
					Image::wb($path, $variation["quality"]);
					break;

				case 'watermark':
					Image::watermark($path, ABSOLUTE_PATH.USERFILES."/watermark/".$action["file"], $variation["quality"], $action["vertical"], $action["vertical_px"], $action["horizontal"], $action["horizontal_px"]);
					break;
			}
		}
	}
	
	/**
	 * Выбирает все размеры изображений
	 *
	 * @return void
	 */
	private function get_variations()
	{
		if(! isset($this->cache["images_variations"]))
		{
			$this->cache["images_variations"] = array();
			$result = DB::query("SELECT * FROM {images_variations} WHERE trash='0' ORDER BY id ASC");
			while($row = DB::fetch_array($result))
			{
				$this->cache["images_variations"][$row["id"]] = $row;
			}
		}
	}
}