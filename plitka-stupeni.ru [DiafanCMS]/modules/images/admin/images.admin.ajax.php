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
 * Images_admin_ajax
 * 
 * Обработка Ajax-запросов при работе с изображениями в административной части
 */
class Images_admin_ajax extends Frame_admin
{
	/**
	 * @var array результаты, передаваемы Ajaxом
	 */
	private $result;

	/**
	 * Вызывает обработку Ajax-запросов
	 * 
	 * @return void
	 */
	public function ajax()
	{
		if(! empty($_GET["action"]) && $_GET["action"] == 'upload')
		{
			$this->upload();
			exit;
		}
		// Прошел ли пользователь проверку идентификационного хэша
		if (! $this->diafan->_user->checked)
		{
			$this->result["error"] = 'ERROR';
			$this->send_json();
		}

		$this->result["hash"] = $this->diafan->_user->get_hash();

		if (! empty($_POST["action"]))
		{
			switch($_POST["action"])
			{
				case 'delete':
					$this->delete();
					break;

				case 'edit':
					$this->edit();
					break;

				case 'save':
					$this->save();
					break;

				case 'up':
				case 'down':
					$this->sort();
					break;

				case 'selectarea':
					$this->selectarea();
					break;

				case 'resize':
					$this->resize();
					break;
			}
		}
	}

	/**
	 * Загружает изображение
	 * 
	 * @return void
	 */
	private function upload()
	{
		if (! $this->diafan->_user->roles('edit', $this->diafan->rewrite))
		{
			$this->result["error"] = $this->diafan->_('Извините, у вас нет прав на сохранение.');
			$this->send_json();
		}
		if (isset($_GET['qqfile']))
		{
			$_FILES["image"]['name'] = $_GET['qqfile'];
			$_FILES["image"]['tmp_name'] = $this->qq_temp_name();
		}
		elseif (isset( $_FILES['qqfile'] ))
		{
			$_FILES["image"] = $_FILES['qqfile'];
		}

		if (! isset($_FILES["image"]) || ! is_array($_FILES["image"]) || $_FILES["image"]['name'] == '')
		{
			$this->result["errors"]["image"] = $this->diafan->_('Вы забыли добавить файл для загрузки');
			$this->send_json();
		}
		$module_name = $this->diafan->config('category') ? $this->diafan->module : $this->diafan->table;
		$module_tag = $this->diafan->config('category') ? $this->diafan->module.'cat' : $this->diafan->table;
		$param_id = $this->diafan->get_param($_GET, "param_id", 0, 2);

		$this->result["id"] = $this->get_id_element();
		if($this->diafan->variable('images', 'count') == 1)
		{
			$this->diafan->_images->delete($this->result["id"], $module_tag);
		}

		if(! empty($_GET['name']) &&  $_GET['name'] != 'undefined')
		{
			$new_name = preg_replace('/[^A-Za-z0-9-_]+/', '', strtolower($this->diafan->translit(substr($_GET['name'], 0, 50))));
		}
		else
		{
			$extension = strrchr($_FILES["image"]['name'], '.');
			$new_name = preg_replace('/[^A-Za-z0-9-_]+/', '', strtolower($this->diafan->translit(substr(str_replace($extension, '', $_FILES["image"]['name']), 0, 50))));
		}
		$site_id = $this->diafan->get_param($_GET, 'site_id', 0, 2);
		$tmpcode = (! empty($_REQUEST["tmpcode"]) ? $_REQUEST["tmpcode"] : '');

		$result = $this->diafan->_images->upload($this->result["id"], $module_name, $site_id, $_FILES["image"]['tmp_name'], $new_name, $this->diafan->config('category'), true, $param_id, $tmpcode);

		unlink($_FILES["image"]['tmp_name']);

		Customization::inc('modules/images/admin/images.admin.view.php');
		$images_view = new Images_admin_view($this->diafan);

		if ($result)
		{
			if(is_array($result))
			{
				foreach($result as $r)
				{
					$this->result["selectarea"][] = $images_view->selectarea($r);
				}
			}
			else
			{
				$this->result["errors"]["image"] = $result;
				$this->send_json();
			}
		}
		$this->diafan->_cache->delete("", $module_name);

		$this->result["data"]   = $images_view->show($this->result["id"], $param_id);
		$this->result["target"] = ".images_container".$param_id;
		$this->result["success"] = true;

		$this->send_json();
	}

	private function qq_temp_name()
	{
		$input = fopen("php://input", "r");
		$tmpfname = tempnam(ABSOLUTE_PATH.'cache', "diafan");

		$temp = fopen($tmpfname, "w");

		$realSize = stream_copy_to_stream($input, $temp);
		fclose($input);
		fclose($temp);

		if (!isset( $_SERVER["CONTENT_LENGTH"] ) || $realSize != (int)$_SERVER["CONTENT_LENGTH"])
		{
			return false;
		}

		return $tmpfname;
	}

	/**
	 * Сохраняет пользовательское выделение изображения
	 * 
	 * @return void
	 */
	private function selectarea()
	{
		if (! $this->diafan->_user->roles('edit', $this->diafan->rewrite))
		{
			$this->result["error"] = $this->diafan->_('Извините, у вас нет прав на сохранение.');
			$this->send_json();
		}
		if(empty($_POST["id"]) || empty($_POST["variation_id"]))
			return false;

		if(! isset($_POST["x1"]) || ! isset($_POST["x2"]) || ! isset($_POST["y1"]) || ! isset($_POST["y2"]))
			return false;

		if($_POST["x1"] == $_POST["x2"] || $_POST["y1"] == $_POST["y2"])
			return false;
		
		$variation = DB::fetch_array(DB::query("SELECT * FROM {images_variations} WHERE id=%d LIMIT 1", $_POST["variation_id"]));
		$actions = unserialize($variation["param"]);
		
		$file_name = DB::query_result("SELECT name FROM {images} WHERE id=%d LIMIT 1", $_POST["id"]);

		$module_name = $this->diafan->config('category') ? $this->diafan->module : $this->diafan->table;
		$path = ABSOLUTE_PATH.USERFILES."/".$module_name."/".$variation["folder"]."/".$file_name;

		Customization::inc("includes/image.php");
		Image::crop($path, $_POST["x2"] - $_POST["x1"], $_POST["y2"] - $_POST["y1"], $variation["quality"], 'top', $_POST["y1"], 'left', $_POST["x1"]);
		$this->diafan->_images->get_variation_image($file_name, $module_name, $variation, false, true);

		$this->send_json();
	}

	/**
	 * Удаляет изображение
	 * 
	 * @return void
	 */
	private function delete()
	{
		if (! $this->diafan->_user->roles('del', $this->diafan->rewrite))
		{
			$this->result["error"] = $this->diafan->_('Извините, у вас нет прав на удаление.');
			$this->send_json();
		}
		if (empty($_POST["element_id"]) && empty($_POST["tmpcode"]))
		{
			$this->result["error"] = 'ERROR';
			$this->send_json();
		}
		$element_id = (! empty($_POST["element_id"]) ? $_POST["element_id"] : 0);
		$tmpcode = (! empty($_POST["tmpcode"]) ? $_POST["tmpcode"] : '');
		$module_name = $this->diafan->config('category') ? $this->diafan->module : $this->diafan->table;
		$module_tag = $this->diafan->config('category') ? $this->diafan->module.'cat' : $this->diafan->table;

		$image_id = intval($_POST['image_id']);
		if (! empty($image_id))
		{
			$row = DB::fetch_array(DB::query("SELECT id, module_name, element_id, param_id FROM {images} WHERE id=%d and module_name='%s' LIMIT 1", $image_id, $module_tag));
			if ($row)
			{
				$this->diafan->_images->delete($row["element_id"], $row["module_name"], $row["id"]);
				$this->diafan->_cache->delete("", $module_name);
		
				Customization::inc('modules/images/admin/images.admin.view.php');
				$images_view = new Images_admin_view($this->diafan);
		
				$this->result["data"]   = $images_view->show($element_id, $row["param_id"]);
				$this->result["target"] = ".images_container".$row["param_id"];
			}
		}

		$this->send_json();
	}

	/**
	 * Редактирует изображение
	 * 
	 * @return void
	 */
	private function edit()
	{
		if (empty($_POST["element_id"]) && empty($_POST["tmpcode"]))
		{
			$this->result["error"] = 'ERROR';
			$this->send_json();
		}
		$element_id = (! empty($_POST["element_id"]) ? $_POST["element_id"] : 0);
		$tmpcode = (! empty($_POST["tmpcode"]) ? $_POST["tmpcode"] : '');
		$module_name = $this->diafan->config('category') ? $this->diafan->module : $this->diafan->table;

		$image_id = intval($_POST['image_id']);
		$row = DB::fetch_array(DB::query("SELECT id, [alt], [title], name FROM {images} WHERE id=%d AND element_id=%d AND tmpcode='%s' LIMIT 1", $image_id, $element_id, $tmpcode));
		if (! $row)
		{
			$this->result["error"] = 'ERROR';
			$this->send_json();
		}

		$this->diafan->_cache->delete("", $module_name);

		Customization::inc('modules/images/admin/images.admin.view.php');
		$images_view = new Images_admin_view($this->diafan);

		$this->result["data"] = $images_view->edit_attribute($row);
		$this->result["target"] = ".images_actions[image_id=".$image_id."]";

		$this->send_json();
	}

	/**
	 * Сохраняет данные об изображении
	 * 
	 * @return void
	 */
	private function save()
	{
		if (empty($_POST["element_id"]) && empty($_POST["tmpcode"]))
		{
			$this->result["error"] = 'ERROR';
			$this->send_json();
		}
		$element_id = (! empty($_POST["element_id"]) ? $_POST["element_id"] : 0);
		$tmpcode = (! empty($_POST["tmpcode"]) ? $_POST["tmpcode"] : '');
		$module_name = $this->diafan->config('category') ? $this->diafan->module : $this->diafan->table;

		$image_id = intval($_POST['image_id']);
		$row_image = DB::fetch_array(DB::query("SELECT id, [alt], [title], element_id, param_id FROM {images} WHERE id=%d AND element_id=%d AND tmpcode='%s' LIMIT 1", $image_id, $element_id, $tmpcode));
		if($row_image["alt"] != $_POST["alt"] || $row_image["title"] != $_POST["title"])
		{
			DB::query("UPDATE {images} SET [alt]='%h', [title]='%h' WHERE id=%d AND element_id=%d AND tmpcode='%s'", $_POST["alt"], $_POST["title"], $image_id, $element_id, $tmpcode);
	
			$this->diafan->_cache->delete("", $module_name);
		}

		Customization::inc('modules/images/admin/images.admin.view.php');
		$images_view = new Images_admin_view($this->diafan);

		$this->result["data"]   = $images_view->show($row_image["element_id"], $row_image["param_id"]);
		$this->result["target"] = ".images_container".$row_image["param_id"];

		$this->send_json();
	}

	/**
	 * Сортирует изображения
	 * 
	 * @return void
	 */
	private function sort()
	{
		if (empty($_POST["element_id"]) && empty($_POST["tmpcode"]))
		{
			$this->result["error"] = 'ERROR';
			$this->send_json();
		}
		$element_id = (! empty($_POST["element_id"]) ? $_POST["element_id"] : 0);
		$tmpcode = (! empty($_POST["tmpcode"]) ? $_POST["tmpcode"] : '');
		$module_name = $this->diafan->config('category') ? $this->diafan->module : $this->diafan->table;
		$module_tag = $this->diafan->config('category') ? $this->diafan->module.'cat' : $this->diafan->table;

		$image_id = intval($_POST['image_id']);
		if (! empty($image_id))
		{
			$row_image = DB::fetch_array(DB::query("SELECT sort, param_id FROM {images} WHERE id=%d AND element_id=%d AND tmpcode='%s' LIMIT 1", $image_id, $element_id, $tmpcode));
			$oldsort = $row_image["sort"];
			$row = DB::fetch_array(DB::query("SELECT id, sort FROM {images} WHERE element_id=%d AND tmpcode='%s' AND module_name='%s' AND id<>%d AND param_id=%d AND"
				  .($_POST["action"] == "up" ? " sort<=%d ORDER BY sort DESC" : " sort>=%d ORDER BY sort ASC")." LIMIT 1",
				  $element_id, $tmpcode, $module_tag, $image_id, $row_image["param_id"], $oldsort));
			if ($row)
			{
				DB::query("UPDATE {images} SET sort=%d WHERE id=%d", $oldsort, $row["id"]);
				DB::query("UPDATE {images} SET sort=%d WHERE id=%d", $row["sort"], $image_id);
			}
			$this->diafan->_cache->delete("", $module_name);
	
			Customization::inc('modules/images/admin/images.admin.view.php');
			$images_view = new Images_admin_view($this->diafan);
	
			$this->result["data"]   = $images_view->show($element_id, $row_image["param_id"]);
			$this->result["target"] = ".images_container".$row_image["param_id"];
		}

		$this->send_json();
	}

	/**
	 * Изменяет размер всех загруженных изображений
	 * 
	 * @return void
	 */
	private function resize()
	{
		if (! $this->diafan->_user->roles('edit', $this->diafan->rewrite))
		{
			$this->result["error"] = $this->diafan->_('Извините, у вас нет прав на сохранение.');
			$this->send_json();
		}
		set_time_limit(3600);

		$images_variations = array();
		$result = DB::query("SELECT * FROM {images_variations} WHERE trash='0' ORDER BY id ASC");
		while($row = DB::fetch_array($result))
		{
			$images_variations[$row["id"]] = $row;
		}

		if(! empty($_POST["images_variation_id"]))
		{
			$variations = array();
			foreach($_POST["images_variation_id"] as $id)
			{
				$variations[] = $id;
			}
			$count = 0;

			$result = DB::query("SELECT i.name, i.element_id, i.id, i.module_name FROM {images} AS i"
			.($this->diafan->site ? " INNER JOIN {".$this->diafan->module."} AS m ON i.element_id=m.id AND m.site_id=".$this->diafan->site : '')
			." WHERE i.module_name='%s' AND i.trash='0' AND i.param_id=0 LIMIT %d, 30", $this->diafan->module, (! empty($_POST["resize_count"]) ? $_POST["resize_count"] : 0));
			while ($row = DB::fetch_array($result))
			{
				if(! file_exists(ABSOLUTE_PATH.USERFILES."/original/".$row["name"]))
				{
					$this->diafan->_images->delete($row["element_id"], $row["module_name"], $row["id"]);
					continue;
				}
				foreach($images_variations as $images_variation)
				{
					if (file_exists(ABSOLUTE_PATH.USERFILES."/".$this->diafan->module.'/'.$images_variation['folder'].'/'.$row["name"]))
					{
						unlink(ABSOLUTE_PATH.USERFILES."/".$this->diafan->module.'/'.$images_variation['folder'].'/'.$row["name"]);
					}
					if(in_array($images_variation['id'], $variations))
					{
						$this->diafan->_images->get_variation_image($row["name"], $this->diafan->module, $images_variation);
					}
				}
				$count++;
			}
		}

		if(! empty($_POST["images_variation_cat_id"]))
		{
			$variations = array();
			foreach($_POST["images_variation_cat_id"] as $id)
			{
				$variations[] = $id;
			}

			$result = DB::query("SELECT i.name, i.element_id, i.id, i.module_name FROM {images} AS i"
			.($this->diafan->site ? " INNER JOIN {".$this->diafan->module."_category} AS m ON i.element_id=m.id AND m.site_id=".$this->diafan->site : '')
			." WHERE i.module_name='%s' LIMIT %d, 30", $this->diafan->module."cat", (! empty($_POST["resize_count"]) ? $_POST["resize_count"] : 0));
			while ($row = DB::fetch_array($result))
			{
				if(! file_exists(ABSOLUTE_PATH.USERFILES."/original/".$row["name"]))
				{
					$this->diafan->_images->delete($row["element_id"], $row["module_name"], $row["id"]);
					continue;
				}
				foreach($images_variations as $images_variation)
				{
					if (file_exists(ABSOLUTE_PATH.USERFILES."/".$this->diafan->module.'/'.$images_variation['folder'].'/'.$row["name"]))
					{
						unlink(ABSOLUTE_PATH.USERFILES."/".$this->diafan->module.'/'.$images_variation['folder'].'/'.$row["name"]);
					}
					if(in_array($images_variation['id'], $variations))
					{
						$this->diafan->_images->get_variation_image($row["name"], $this->diafan->module, $images_variation);
					}
				}
				$count++;
			}
		}
		if($count)
		{
			$this->result["error"] = 'next';
		}
		else
		{
			$this->result["error"] = $this->diafan->_('Размер изображений успешно изменен');
		}

		$this->send_json();
	}

	/**
	 * Отдает ответ Ajax
	 * 
	 * @return void
	 */
	private function send_json()
	{
		if ($this->result)
		{
			include_once ABSOLUTE_PATH.'plugins/json.php';
			echo to_json($this->result);
			exit;
		}
	}

	/**
	 * Возвращает номер элемента, к которому подключается фотография или тэг
	 * 
	 * @return integer
	 */
	private function get_id_element()
	{
		if (! empty($_REQUEST["id"]))
		{
			return intval($_REQUEST["id"]);
		}
		else
		{
			return 0;
		}
	}
}
