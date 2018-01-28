<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if ( ! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Shop_admin_import
 *
 * Импорт
 */
class Shop_admin_import extends Diafan
{
	/**
	 * @var array конфигурация текущего импорта
	 */
	private $import;

	/**
	 * @var array характеристики товара в магазине
	 */
	private $params;

	/**
	 * @var array поля "показывать в меню"
	 */
	private $menus;

	/**
	 * @var array поля, заданные для текущего импорта
	 */
	private $fields;

	/**
	 * @var string данные о текущем элементе импорта
	 */
	private $data_string;

	/**
	 * @var array данные о текущем элементе импорта
	 */
	private $data;

	/**
	 * @var integer номер текущего элемента импорта
	 */
	private $id;

	/**
	 * @var resource ссылка на файл импорта
	 */
	private $handle;

	/**
	 * @var array ошибки импорта
	 */
	private $errors;

	/**
	 * @var array локальный кэш модуля
	 */
	private $cache;

	/**
	 * Загружает файл импорта
	 * @return void
	 */
	public function upload()
	{
		if (isset($_FILES["file"]) && is_array($_FILES["file"]) && $_FILES["file"]['name'] != '')
		{
			move_uploaded_file($_FILES["file"]['tmp_name'], ABSOLUTE_PATH.USERFILES.'/tmp');
			echo '<meta http-equiv="Refresh" content="0; url='.URL.'?ftell=0&amp;upload=true">';
			exit;
		}
		elseif ( ! file_exists(ABSOLUTE_PATH.USERFILES.'/tmp'))
		{
			$this->diafan->redirect(URL);
			exit;
		}

		// устанавливает настройки импорта
		$this->init_config();
		
		$result = $this->import();
		if($this->errors)
		{
			if($result == 'next')
			{
				echo '<p><a href="'.URL.'?ftell='.ftell($this->handle).'&amp;upload=true">'.$this->diafan->_('Продолжить').'</a></p>';
			}
			echo '<div class="error"><p>'.implode("</p><p>", $this->errors).'</p></div>';
			return;
		}
		switch($result)
		{
			case 'success':
				$this->diafan->redirect_js(URL.'success1/');
				exit;
				break;

			case 'next':
				echo '<meta http-equiv="Refresh" content="0; url='.URL.'?ftell='.ftell($this->handle).'&amp;upload=true">';
				exit;
				break;

			case 'empty':
				$this->diafan->redirect_js(URL);
				exit;
				break;
		}
	}

	/**
	 * Импорт
	 * 
	 * @return string $result
	 */
	private function import()
	{
		if (empty($this->fields))
		{
			return 'empty';
		}

		// первая итерация импорта
		if (empty($_GET['ftell']))
		{
			// подготовка базы данных
			$this->prepare();
		}

		Customization::inc("includes/image.php");

		$this->handle = fopen(ABSOLUTE_PATH.USERFILES.'/tmp', "r");
		if (isset($_GET['ftell']))
		{
			fseek($this->handle, $_GET['ftell']);
		}
		$i = 1;
		$cache = array();
		$is_end = true;
		// построчное считывание и анализ строк из файла
		while (($data_string = fgets($this->handle)) !== false)
		{
			if ($this->import["encoding"] == 'cp1251')
			{
				$data_string = utf::to_utf($data_string);
			}
			if(! $is_end)
			{
				$this->data_string .= $data_string;
			}
			else
			{
				$this->data_string = $data_string;
			}

			if(! $is_end = $this->prepare_data())
			{
				continue;
			}

			$this->id = 0;

			if ($this->is_field("id"))
			{
				switch($this->field("id", "param_type"))
				{
					case "site":
						$type_id = 'id';
						break;

					case "article":
						$type_id = 'article';
						break;

					default:
						$type_id = 'import_id';
						break;
				}
				$this->id = DB::query_result(
						"SELECT id FROM {".$this->import["table"]."} WHERE ".$type_id."='%s'"
						." AND trash='0' AND site_id=%d"
						.($this->import["type"] != 'category' && $this->import["cat_id"] ? " AND cat_id=".$this->import["cat_id"] : '')
						." LIMIT 1",
						$this->field_value("id"), $this->import["site_id"]
					);
				if($this->id)
				{
					$this->update_row();
				}
				else
				{
					$this->insert_row();
				}
			}
			else
			{
				$this->insert_row();
			}

			$this->set_images();

			$this->set_access();

			if ($this->import["type"] == 'good')
			{
				$this->set_category_rel();

				$this->set_price_count();

				$this->set_params();

				$this->set_rels();
			}

			$this->set_rewrite();

			$this->set_menu();

			if ($i == $this->import["count_part"])
			{
				return 'next';
			}

			$i++;
		}
		fclose($this->handle);
		unlink(ABSOLUTE_PATH.USERFILES.'/tmp');

		$this->finish_update_sort();

		$this->finish_rels();

		$this->finish_delete();

		$this->finish_parent();

		$this->finish_access();

		$this->finish_menu();

		$this->diafan->_cache->delete("", "shop");
		return 'success';
	}

	/**
	 * Устанавливает настройки импорта
	 *
	 * @return void
	 */
	private function init_config()
	{
		$this->import = DB::fetch_array(DB::query("SELECT * FROM {shop_import_category} WHERE id=%d LIMIT 1", $this->diafan->cat));
		$this->import["table"] = 'shop'.($this->import["type"] == 'category' ? "_category" : "");
		$this->import["end_string"] = htmlspecialchars_decode($this->import["end_string"]);
		if(! $this->import["count_part"])
		{
			$this->import["count_part"] = 200;
		}
		if(! $this->import['delimiter'])
		{
			$this->import["delimiter"] = ";";
		}
		if(! $this->import['sub_delimiter'])
		{
			$this->import["sub_delimiter"] = "|";
		}

		$k = 0;
		$this->fields = array();
		$this->params = array();
		$this->menus = array();

		//получаем типы полей учавствующих в импорте
		$result = DB::query("SELECT type, name, required, params FROM {shop_import} WHERE trash='0' AND cat_id=%d ORDER BY sort ASC", $this->diafan->cat);
		while ($row = DB::fetch_array($result))
		{
			$k++;
			if ($row["type"] == "param")
			{
				$this->params[$k-1] = array(
						'name' => $row["name"],
						'required' => $row["required"],
					);
				$params = unserialize($row["params"]);
				$this->params[$k-1]["id"] = $params["id"];
				$this->params[$k-1]["select_type"] = $params["select_type"];
				$this->params[$k-1]["type"] = DB::query_result("SELECT type FROM {shop_param} WHERE id=%d LIMIT 1", $params["id"]);
				$this->params[$k-1]["values"] = array();
				if ($this->params[$k-1]["type"] == 'select' || $this->params[$k-1]["type"] == 'multiple')
				{
					$result2 = DB::query("SELECT id, [name] FROM {shop_param_select} WHERE param_id=%d", $params["id"]);
					while ($row2 = DB::fetch_array($result2))
					{
						$this->params[$k-1]["values"][$row2["name"]] = $row2["id"];
					}
				}
				continue;
			}
			if($row["type"] == 'menu')
			{
				$params = unserialize($row["params"]);
				$this->menus[$k-1] = array(
						'name' => $row["name"],
						'required' => $row["required"],
						'id' => $params["id"],
					);
				continue;
			}
			$this->fields[$row["type"]] = array(
					'i' => $k - 1,
					'name' => $row["name"],
					'required' => $row["required"],
				);
			$params = unserialize($row["params"]);
			if($params)
			{
				foreach($params as $key => $value)
				{
					$this->fields[$row["type"]]['param_'.$key] = $value;
				}
			}
		}
		Customization::inc("includes/validate.php");
	}

	/**
	 * Подготовка базы данных
	 *
	 * @return void
	 */
	private function prepare()
	{
		// включаем режим обновления
		DB::query("UPDATE {".$this->import["table"]."} SET `import`='0' WHERE `import`='1'"
			  .($this->import["type"] != 'category' && $this->import["cat_id"] ? " AND cat_id=".$this->import["cat_id"] : ''));

		// удаляет неописанные в файле импорта записи
		$this->prepare_delete();

		// подготовка к импорту поля "Родитель"
		$this->prepare_parent();

		// подготовка к импорту поля "Связанные товары"
		$this->prepare_rels();
	}

	/**
	 * Удаление записей в БД, если в импорте НЕ участвуют идентификаторы элементов
	 *
	 * @return void
	 */
	private function prepare_delete()
	{
		if(! $this->import["delete_items"])
			return;

		// удалим в конце все не помеченные import='1'
		if($this->is_field('id'))
			return;

		$this->delete();
	}

	/**
	 * Подготавливает к импорту поля "Родитель"
	 *
	 * @return void
	 */
	public function prepare_parent()
	{
		if ($this->import["type"] != 'category')
			return;

		if (! $this->is_field("id") || ! $this->is_field("parent"))
			return;

		if($this->field("parent", "param_type") == 'site')
			return;

		DB::query("ALTER TABLE {shop_category} ADD `import_parent_id` VARCHAR( 32 ) NOT NULL AFTER `import_id`");
	}

	/**
	 * Подготавливает к импорту поля "Связанные товары"
	 *
	 * @return void
	 */
	public function prepare_rels()
	{
		if ($this->import["type"] != 'good')
			return;
		
		if (! $this->is_field("id") || ! $this->is_field("rel_goods"))
			return;

		if($this->field("rel_goods", "param_type") == 'site')
			return;

		DB::query("ALTER TABLE {shop_rel} ADD `rel_element_id_temp` VARCHAR( 32 ) NOT NULL");
	}

	/**
	 * Подготавливает данные о текущем элементе
	 *
	 * @return void
	 */
	private function prepare_data()
	{
		if($this->import["end_string"])
		{
			$len = strlen($this->import["end_string"]);
			$data_string = trim($this->data_string);
			$lendata = strlen($data_string);
			if(substr($this->data_string, $lendata - $len, $len) != $this->import["end_string"])
			{
				return false;
			}
			else
			{
				$this->data_string = substr($this->data_string, 0, $lendata - $len);
			}
		}
		$this->data = $this->getcsv($this->data_string, $this->import["delimiter"]);
		if(! $this->data)
		{
			return false;
		}

		foreach ($this->data as $key => $value)
		{
			$this->data[$key] = trim($value);
		}

		foreach ($this->fields as $type => $k)
		{
			$value = $this->field_value($type);
			if(! $value)
			{
				if($this->field($type, 'required'))
				{
					$this->error_validate($type, 'значение не задано');
				}
				continue;
			}

			// подготовка полей, содержащих несколько значений
			if (in_array($type, array("cats", "rel_goods", "images", "access", "yandex", "price", "count")))
			{
				$d = explode($this->import["sub_delimiter"], $value);
				$value = array();
				foreach($d as $i => $v)
				{
					$v = trim($v);
					if(! $v)
						continue;

					$value[$i] = $v;
				}
			}
			// валидация
			switch($type)
			{
				case 'id':
				case 'parent':
					if($this->field($type, 'param_type') == 'site')
					{
						if(preg_match('/[^0-9]+/', $value))
						{
							$this->error_validate($type, 'значение должно быть числом');
							$value = preg_replace('/[^0-9]+/', '', $value);
						}
					}
					break;
				case 'cats':
				case 'rel_goods':
					if($this->field($type, 'param_type') == 'site')
					{
						$new_value = array();
						foreach($value as $v)
						{
							if(preg_match('/[^0-9]+/', $v))
							{
								$this->error_validate($type, 'значение должно быть числом');
								$v = preg_replace('/[^0-9]+/', '', $v);
							}
							if($v)
							{
								$new_value[] = $v;
							}
						}
						$value = $new_value;
					}
					break;
				case 'name':
				case 'keywords':
				case 'descr':
				case 'title_meta':
					$new_value = strip_tags($value);
					if($value !=  $new_value)
					{
						$this->error_validate($type, 'HTML-теги не допустимы');
						$value = $new_value;
					}
					break;
				case 'article':
					$new_value = strip_tags($value);
					if($value !=  $new_value)
					{
						$this->error_validate($type, 'HTML-теги не допустимы');
						$value = $new_value;
					}
					if(utf::strlen($value) > 30)
					{
						$this->error_validate($type, 'значение поля должно быть не более 30 символов');
					}
					break;
				case 'show_yandex':
				case 'no_buy':
				case 'act':
				case 'hit':
				case 'new':
				case 'action':
				case 'is_file':
				case 'map_no_show':
				case 'hit':
				case 'new':
				case 'action':
				case 'is_file':
					if($value === '1' || $value === 1 || $value === 'true' || $value === 'TRUE' || $value === true)
					{
						$value = 1;
					}
					elseif($value === '0' || $value === 0 || $value === 'false' || $value === 'FALSE' || $value === false)
					{
						$value = 0;
					}
					else
					{
						$this->error_validate($type, 'допустимы только следующие значения 1, 0, true, false');
						$value = 0;
					}
					break;
				case 'sort':
					if(preg_match('/[^0-9]+/', $value))
					{
						$this->error_validate($type, 'значение должно быть числом');
						$value = preg_replace('/[^0-9]+/', '', $value);
					}
					break;
				case 'admin_id':
					if(preg_match('/[^0-9]+/', $value))
					{
						$this->error_validate($type, 'значение должно быть числом');
						$value = preg_replace('/[^0-9]+/', '', $value);
					}
					if($value)
					{
						if(! isset($this->cache["admin_id"][$value]))
						{
							$this->cache["admin_id"][$value] = DB::query_result("SELECT id FROM {users} WHERE id=%d AND trash='0' LIMIT 1", $value);
						}
						if(! $this->cache["admin_id"][$value])
						{
							$this->error_validate($type, 'пользователя не существует');
							$value = 0;
						}
					}
					break;
				case 'theme':
					if(! file_exists(ABSOLUTE_PATH.'themes/'.$value))
					{
						$this->error_validate($type, $this->diafan->_('файл %s не существует', ABSOLUTE_PATH.'themes/'.$value), false, false);
						$value = '';
					}
					break;
				case 'view':
					if(! file_exists(ABSOLUTE_PATH.'modules/shop/views/shop.view.'.$value.'.php'))
					{
						$this->error_validate($type, $this->diafan->_('файл %s не существует', ABSOLUTE_PATH.'modules/shop/views/shop.view.'.$value.'.php'), false, false);
						$value = '';
					}
					break;
				case 'date_start':
				case 'date_finish':
					if($error = Validate::datetime($value))
					{
						$this->error_validate($type, $error);
						$value = 0;
					}
					else
					{
						$value = $this->diafan->unixdate($value);
						if($this->field($type, 'param_date_start') > $value)
						{
							$this->error_validate($type, $this->diafan->_('значение не должно быть меньше %s', date('d.m.Y H:i', $this->field($type, 'param_date_start'))), false, false);
							$value = 0;
						}
						elseif($this->field($type, 'param_date_finish') < $value)
						{
							$this->error_validate($type, $this->diafan->_('значение не должно быть больше %s', date('d.m.Y H:i', $this->field($type, 'param_date_finish'))), false, false);
							$value = 0;
						}
					}
					break;
				case 'access':
					$new_value = array();
					foreach($value as $v)
					{
						if(preg_match('/[^0-9]+/', $v))
						{
							$this->error_validate($type, 'значение должно быть числом');
							$v = preg_replace('/[^0-9]+/', '', $v);
						}
						if($v)
						{
							if(! isset($this->cache["roles"][$v]))
							{
								$this->cache["roles"][$v] = DB::query_result("SELECT id FROM {users_role} WHERE id=%d AND trash='0' LIMIT 1", $v);
							}
							if(! $this->cache["roles"][$v])
							{
								$this->error_validate($type, 'роли пользователя не существует');
								$v = 0;
							}
						}
						if($v)
						{
							$new_value[] = $v;
						}
					}
					$value = $new_value;
					break;
				case 'yandex':
					$value = implode("\n", $value);
					break;
					
			}
			$this->field_value($type, $value);
		}
		return true;
	}

	/**
	 * Производит разбор данных CSV
	 *
	 * @param string $st строка
	 * @param string $d символ разделителя поля
	 * @param strign $q символ ограничителя поля
	 * @return array
	 */
	private function getcsv($st, $d = ",", $q = '"')
	{
		$list = array();

		while ($st !== "" && $st !== false)
		{
			if ($st[0] !== $q)
			{
				// Non-quoted.
				list ($field) = explode($d, $st, 2);
				$st = substr($st, strlen($field)+strlen($d));
			}
			else
			{
				// Quoted field.
				$st = substr($st, 1);
				$field = "";
				while (1)
				{
					// Find until finishing quote (EXCLUDING) or eol (including)
					preg_match("/^((?:[^$q]+|$q$q)*)/sx", $st, $p);
					$part = $p[1];
					$partlen = strlen($part);
					$st = substr($st, strlen($p[0]));
					$field .= str_replace($q.$q, $q, $part);
					if (strlen($st) && $st[0] === $q)
					{
						// Found finishing quote.
						list ($dummy) = explode($d, $st, 2);
						$st = substr($st, strlen($dummy)+strlen($d));
						break;
					}
					else
					{
						return false;
					}
				}
			}
			$list[] = $field;
		}
		return $list;
	}

	/**
	 * Добавляет ошибку в лог
	 *
	 * @param string $type тип поля
	 * @param string $error ошибка
	 * @param string $name имя поля, на котором произошла ошибка
	 * @param boolean $lang текст ошибки нужно переводить
	 * @return void
	 */
	private function error_validate($type, $error, $name = false, $lang = true)
	{
		$name = $name === false ? $this->field($type, 'name') : $name;
		if($lang)
		{
			$error = $this->diafan->_($error);
		}
		$this->errors[] = $this->diafan->_('Ошибка в строке').': '.$this->data_string.'<br><b>'.$name.', '.$type.': '.$error.'</b>';
	}

	/**
	 * Определяет задано ли в импорте поле с указанным типом
	 *
	 * @param string $type тип поля
	 * @return boolean
	 */
	private function is_field($type)
	{
		return isset($this->fields[$type]) ? true : false;
	}

	/**
	 * Возвращает значение поля с указанным типом или задает новое значение
	 *
	 * @param string $type тип поля
	 * @param mixed $value новое значение
	 * @return mixed
	 */
	private function field_value($type, $value = false)
	{
		if(! isset($this->fields[$type]["i"]))
		{
			return '';
		}
		if($value !== false)
		{
			$this->data[$this->fields[$type]["i"]] = $value;
		}
		else
		{
			return isset($this->data[$this->fields[$type]["i"]]) ? $this->data[$this->fields[$type]["i"]] : '';
		}
	}

	/**
	 * Возвращает данные о поле по типу
	 *
	 * @param string $type тип поля
	 * @param string $name название получаемых данных
	 * @return mixed
	 */
	private function field($type, $name)
	{
		if(isset($this->fields[$type][$name]))
		{
			return $this->fields[$type][$name];
		}
		return false;
	}

	/**
	 * Добавление записи в БД, если в импорте участвуют идентификаторы элементов
	 *
	 * @return void
	 */
	public function insert_row()
	{
		$this->id = 0;
		if($this->is_field("id") && $this->field("id", "param_type") == 'site')
		{
			$id_empty = DB::query_result("SELECT id FROM {".$this->import["table"]."} WHERE id=%d LIMIT 1", $this->field_value("id")) ? false : true;
		}
		$fields = array("import", "site_id", "timeedit");
		$mask = array("'%d'", "%d", "%d");
		$values = array('1', $this->import["site_id"], time());
		if($this->is_field("id") && $this->field("id", "param_type") == 'site' && $id_empty)
		{
			$fields[] = "id";
			$mask[] = "%d";
			$values[] = $this->field_value("id");
			$this->id = $this->field_value("id");
		}
		if($this->is_field("id") && ! $this->field("id", "param_type"))
		{
			$fields[] = "import_id";
			$mask[] = "'%s'";
			$values[] = $this->field_value("id");
		}
		if($this->is_field("act"))
		{
			$fields[] = "[act]";
			$mask[] = "'%d'";
			$values[] = ($this->field_value("act") ? 1 : 0);
		}
		if($this->is_field("name"))
		{
			$fields[] = "[name]";
			$mask[] = "'%h'";
			$values[] = $this->field_value("name");
		}
		if($this->is_field("keywords"))
		{
			$fields[] = "[keywords]";
			$mask[] = "'%h'";
			$values[] = $this->field_value("keywords");
		}
		if($this->is_field("descr"))
		{
			$fields[] = "[descr]";
			$mask[] = "'%h'";
			$values[] = $this->field_value("descr");
		}
		if($this->is_field("title_meta"))
		{
			$fields[] = "[title_meta]";
			$mask[] = "'%h'";
			$values[] = $this->field_value("title_meta");
		}
		if($this->is_field("anons"))
		{
			$fields[] = "[anons]";
			$mask[] = "'%s'";
			$values[] = $this->field_value("anons");
		}
		if($this->is_field("text"))
		{
			$fields[] = "[text]";
			$mask[] = "'%s'";
			$values[] = $this->field_value("text");
		}
		if($this->is_field("map_no_show"))
		{
			$fields[] = "map_no_show";
			$mask[] = "'%d'";
			$values[] = ($this->field_value("map_no_show") ? 1 : 0);
		}
		if($this->is_field("sort"))
		{
			$fields[] = "sort";
			$mask[] = "%d";
			$values[] = $this->field_value("sort");
		}
		if($this->is_field("theme"))
		{
			$fields[] = "theme";
			$mask[] = "'%h'";
			$values[] = $this->field_value("theme");
		}
		if($this->is_field("view"))
		{
			$fields[] = "view";
			$mask[] = "'%h'";
			$values[] = $this->field_value("view");
		}
		if($this->is_field("admin_id"))
		{
			$fields[] = "admin_id";
			$mask[] = "%d";
			$values[] = $this->field_value("admin_id");
		}
		if($this->is_field("access"))
		{
			$fields[]= "access";
			$mask[] = "'%d'";
			$values[] = ($this->field_value("access") ? 1 : 0);
		}
		if($this->is_field("show_yandex"))
		{
			$fields[] = "show_yandex";
			$mask[] = "'%d'";
			$values[] = ($this->field_value("show_yandex") ? 1 : 0);
		}
		if($this->import["type"] == 'category')
		{
			if($this->is_field("parent"))
			{
				if($this->field("parent", "param_type") == 'site')
				{
					$fields[] = "parent_id";
					$mask[] = "%d";
				}
				else
				{
					$fields[] = "import_parent_id";
					$mask[] = "'%s'";
				}
				$values[] = $this->field_value("parent");
			}
		}
		elseif($this->import["type"] == 'good')
		{
			if($this->is_field("id") && $this->field("id", "param_type") == 'article')
			{
				$fields[] = "article";
				$mask[] = "'%h'";
				$values[] = $this->field_value("id");
			}
			elseif($this->is_field("article"))
			{
				$fields[] = "article";
				$mask[] = "'%h'";
				$values[] = $this->field_value("article");
			}
			if($this->is_field("date_start"))
			{
				$fields[] = "date_start";
				$mask[] = "%d";
				$values[] = $this->field_value("date_start");
			}
			if($this->is_field("date_finish"))
			{
				$fields[] = "date_finish";
				$mask[] = "%d";
				$values[] = $this->field_value("date_finish");
			}
			if($this->is_field("no_buy"))
			{
				$fields[] = "no_buy";
				$mask[] = "'%d'";
				$values[] = ($this->field_value("no_buy") ? 1 : 0);
			}
			if($this->is_field("hit"))
			{
				$fields[] = "hit";
				$mask[] = "'%d'";
				$values[] = ($this->field_value("hit") ? 1 : 0);
			}
			if($this->is_field("new"))
			{
				$fields[] = "new";
				$mask[] = "'%d'";
				$values[] = ($this->field_value("new") ? 1 : 0);
			}
			if($this->is_field("action"))
			{
				$fields[] = "action";
				$mask[] = "'%d'";
				$values[] = ($this->field_value("action") ? 1 : 0);
			}
			if($this->is_field("is_file"))
			{
				$fields[] = "is_file";
				$mask[] = "'%d'";
				$values[] = ($this->field_value("is_file") ? 1 : 0);
			}
			if($this->is_field("yandex"))
			{
				$fields[] = "yandex";
				$mask[] = "'%h'";
				$values[] = $this->field_value("yandex");
			}
		}
		DB::query("INSERT INTO {".$this->import["table"]."} (".implode(",", $fields).") VALUES (".implode(",", $mask).")", $values);

		if(! $this->id)
		{
			$this->id = DB::last_id($this->import["table"]);
		}

		if($this->is_field("id") && $this->field("id", "param_type") == 'site' && ! $id_empty)
		{
			$this->error_validate('id', $this->diafan->_('запись с идентификатором %d перемещена в корзину, новая запись добавлена с новым идентификатом %d', $this->field_value("id"), $this->id), false, false);
		}
	}

	/**
	 * Обновляем записи в БД для существующего элемента
	 *
	 * @return void
	 */
	public function update_row()
	{
		$query = "UPDATE {".$this->import["table"]."} SET"
		." import='1',"
		." site_id=%d,"
		."timeedit=%d";
		$values = array($this->import["site_id"], time());
		if($this->is_field("act"))
		{
			$query .= ", [act]='%d'";
			$values[] = ($this->field_value("act") ? 1 : 0);
		}
		if($this->is_field("name"))
		{
			$query .= ", [name]='%h'";
			$values[] = $this->field_value("name");
		}
		if($this->is_field("keywords"))
		{
			$query .= ", [keywords]='%h'";
			$values[] = $this->field_value("keywords");
		}
		if($this->is_field("descr"))
		{
			$query .= ", [descr]='%h'";
			$values[] = $this->field_value("descr");
		}
		if($this->is_field("title_meta"))
		{
			$query .= ", [title_meta]='%h'";
			$values[] = $this->field_value("title_meta");
		}
		if($this->is_field("anons"))
		{
			$query .= ", [anons]='%s'";
			$values[] = $this->field_value("anons");
		}
		if($this->is_field("text"))
		{
			$query .= ", [text]='%s'";
			$values[] = $this->field_value("text");
		}
		if($this->is_field("map_no_show"))
		{
			$query .= ", map_no_show='%d'";
			$values[] = ($this->field_value("map_no_show") ? 1 : 0);
		}
		if($this->is_field("sort"))
		{
			$query .= ", sort=%d";
			$values[] = $this->field_value("sort");
		}
		if($this->is_field("theme"))
		{
			$query .= ", theme='%h'";
			$values[] = $this->field_value("theme");
		}
		if($this->is_field("view"))
		{
			$query .= ", view='%h'";
			$values[] = $this->field_value("view");
		}
		if($this->is_field("admin_id"))
		{
			$query .= ", admin_id=%d";
			$values[] = $this->field_value("admin_id");
		}
		if($this->is_field("access"))
		{
			$query .= ", access='%d'";
			$values[] = ($this->field_value("access") ? 1 : 0);
		}
		if($this->is_field("show_yandex"))
		{
			$query .= ", show_yandex='%d'";
			$values[] = ($this->field_value("show_yandex") ? 1 : 0);
		}
		if($this->import["type"] == 'category')
		{
			if($this->is_field("parent"))
			{
				if($this->field("parent", "param_type") == 'site')
				{
					$query .= ", parent_id=%d";
				}
				else
				{
					$query .= ", import_parent_id='%h'";
				}
				$values[] = $this->field_value("parent");
			}
		}
		if($this->import["type"] == 'good')
		{
			if($this->is_field("id") && $this->field("id", "param_type") == 'article')
			{
				$query .= ", article='%h'";
				$values[] = $this->field_value("id");
			}
			elseif($this->is_field("article"))
			{
				$query .= ", article='%h'";
				$values[] = $this->field_value("article");
			}
			if($this->is_field("date_start"))
			{
				$query .= ", date_start=%d";
				$values[] = $this->field_value("date_start");
			}
			if($this->is_field("date_finish"))
			{
				$query .= ", date_finish=%d";
				$values[] = $this->field_value("date_finish");
			}
			if($this->is_field("no_buy"))
			{
				$query .= ", no_buy='%d'";
				$values[] = ($this->field_value("no_buy") ? 1 : 0);
			}
			if($this->is_field("hit"))
			{
				$query .= ", hit='%d'";
				$values[] = ($this->field_value("hit") ? 1 : 0);
			}
			if($this->is_field("new"))
			{
				$query .= ", new='%d'";
				$values[] = ($this->field_value("new") ? 1 : 0);
			}
			if($this->is_field("action"))
			{
				$query .= ", action='%d'";
				$values[] = ($this->field_value("action") ? 1 : 0);
			}
			if($this->is_field("is_file"))
			{
				$query .= ", is_file='%d'";
				$values[] = ($this->field_value("is_file") ? 1 : 0);
			}
			if($this->is_field("yandex"))
			{
				$query .= ", yandex='%h'";
				$values[] = $this->field_value("yandex");
			}
		}
		$query .= " WHERE id=%d";
		$values[] = $this->id;
		DB::query($query, $values);
	}

	/**
	 * Обработка поля "Доступ"
	 *
	 * @return void
	 */
	private function set_access()
	{
		if(! $this->is_field("access"))
			return;

		DB::query("DELETE FROM {access} WHERE module_name='shop' AND ".($this->import["type"] == 'good' ? 'element' : 'cat')."_id=%d", $this->id);
		$value = $this->field_value("access");
		if(! $value)
			return;
		foreach ($value as $role_id)
		{
			DB::query("INSERT INTO {access} (module_name, ".($this->import["type"] == 'good' ? 'element' : 'cat')."_id, role_id) VALUES ('shop', %d, %d)", $this->id, $role_id);
		}
	}

	/**
	 * Обработка поля "Псевдоссылка"
	 *
	 * @return void
	 */
	private function set_rewrite()
	{
		if(! $this->is_field("rewrite"))
			return;

		$value = $this->field_value("rewrite");

		if(! $value)
		{
			$name = '';
			if($this->field_value("name"))
			{
				$name = $this->field_value("name");
			}
			else
			{
				$name = $this->id;
			}
			Customization::inc('adm/includes/save_functions.php');
			$save_functions = new Save_functions_admin($this->diafan);
			$value = $save_functions->generate_rewrite($name);
			if($this->import["type"] == 'good' && ! empty($this->cache["current_cat"]))
			{
				if(! isset($this->cache["cats_rewrite"][$this->cache["current_cat"]]))
				{
					$this->cache["cats_rewrite"][$this->cache["current_cat"]] = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='shop' AND cat_id=%d LIMIT 1", $this->cache["current_cat"]);
				}
				$value = $this->cache["cats_rewrite"][$this->cache["current_cat"]].'/'.$value;
			}
		}

		$rewrite = DB::fetch_array(DB::query("SELECT id, rewrite, cat_id FROM {rewrite} WHERE module_name='shop' AND ".($this->import["type"] == 'good' ? 'element' : 'cat')."_id=%d LIMIT 1", $this->id));

		if($this->import["type"] == 'category')
		{
			$cat_id = $this->id;
			$element_id = 0;
		}
		else
		{
			$cat_id = 0;
			$element_id = $this->id;
		}

		if (! $rewrite)
		{
			DB::query("INSERT INTO {rewrite} (module_name, site_id, element_id, cat_id, rewrite) VALUES ('shop', %d, %d, %d, '%s')", $this->import["site_id"], $element_id, $cat_id, $value);
			$rewrite_id = DB::last_id("rewrite");
		}
		else
		{
			$rewrite_id = $rewrite["id"];
		}

		if(! DB::query_result("SELECT id FROM {rewrite} WHERE trash='0' AND id<>%d AND rewrite='%s' LIMIT 1", $rewrite_id, $value))
		{
			if(! $rewrite)
				return;
		}
		else
		{
			$value .= $rewrite_id;
			$this->error_validate('rewrite', $this->diafan->_('псевдоссылка не уникальнa, значение изменено на %s',$value), false, false);
		}
		DB::query("UPDATE {rewrite} SET rewrite='%s', cat_id=%d, site_id=%d WHERE id=%d", $value, $cat_id, $this->import["site_id"], $rewrite_id);
	}

	/**
	 * Обработка поля "Категории"
	 * 
	 * @return void
	 */
	private function set_category_rel()
	{
		$this->cache["current_cat"] = 0;
		if (! $this->is_field("cats"))
		{
			if($this->id)
			{
				$this->cache["current_cats"] = array();
				$result = DB::query("SELECT * FROM {shop_category_rel} WHERE element_id=%d", $this->id);
				while($row  = DB::fetch_array($result))
				{
					$this->cache["current_cats"][] = $row["cat_id"];
				}
				if(empty($this->cache["current_cats"]) && $this->import["cat_id"])
				{
					$this->cache["current_cats"] = array($this->import["cat_id"]);
					DB::query("INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (%d, %d)", $this->id, $this->import["cat_id"]);
					DB::query("UPDATE {shop} SET cat_id=%d WHERE id=%d", $this->import["cat_id"], $this->id);
				}
			}
			return;
		}

		if ($this->is_field("id"))
		{
			DB::query("DELETE FROM {shop_category_rel} WHERE element_id=%d", $this->id);
		}
		$this->cache["current_cats"] = array();
		$first_cat_id = 0;
		switch($this->field("cats", "param_type"))
		{
			case 'name':
				$name_id = '[name]';
				break;

			case 'site':
				$name_id = 'id';
				break;

			default:
				$name_id = 'import_id';
				break;
		}
		if($this->field_value("cats"))
		{
			foreach($this->field_value("cats") as $cat)
			{
				if ( ! isset($this->cache["cats"][$cat]))
				{
					$this->cache["cats"][$cat] =
						DB::query_result("SELECT id FROM {shop_category} WHERE ".$name_id."='%s' AND trash='0' LIMIT 1", $cat);
				}
				if(empty($this->cache["cats"][$cat]))
				{
					$this->error_validate('cats', $this->diafan->_('категория %s не найдена', $cat), false, false);
					continue;
				}
				if(empty($first_cat_id))
				{
					$first_cat_id = $this->cache["cats"][$cat];
				}
				DB::query("INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (%d, %d)", $this->id, $this->cache["cats"][$cat]);
				$this->cache["current_cats"][] = $this->cache["cats"][$cat];
			}
		}
		DB::query("UPDATE {shop} SET cat_id=%d WHERE id=%d", $first_cat_id, $this->id);
		$this->cache["current_cat"] = $first_cat_id;
	}

	/**
	 * Обработка полей "Цена" и "Количество"
	 * 
	 * @return void
	 */
	private function set_price_count()
	{
		if (! $this->is_field("price") && ! $this->is_field("count"))
			return;

		if($this->is_field("count"))
		{
			$count_value = $this->set_count();
		}
		if ($this->is_field("price"))
		{
			if($this->is_field("id"))
			{
				DB::query("DELETE FROM {shop_price_param} WHERE price_id IN (SELECT price_id FROM {shop_price} WHERE good_id=%d)", $this->id);
				DB::query("DELETE FROM {shop_price} WHERE good_id=%d", $this->id);
			}
			$price_value = $this->set_price();
			foreach($price_value as $row)
			{
				if(empty($row["count"]))
				{
					$row["count"] = 0;
					if(! empty($count_value))
					{
						foreach($count_value as $c)
						{
							if($c["params"] == $row["params"])
							{
								$row["count"] = $c["count"];
							}
						}
					}
				}
				$this->diafan->_shop->price_insert($this->id, $row["price"], $row["count"], $row["params"], $row["currency"]);
			}
		}
		else
		{
			foreach($count_value as $row)
			{
				$price = $this->diafan->_shop->get_price($this->id, $row["params"], 0, false);
				if(! empty($row["price_id"]))
				{
					DB::query("UPDATE {shop_price} SET count=%d WHERE price_id=%d", $row["count"], $price["price_id"]);
				}
				else
				{
					$this->diafan->_shop->price_insert($this->id, 0, $row["count"], $row["params"], 0);
				}
			}
		}
		$this->diafan->_shop->price_calc($this->id);
	}

	/**
	 * Подготавливает значение поля "Цена"
	 *
	 * @return array
	 */
	private function set_price()
	{
		$new_values = array();
		if(! isset($this->cache["multiple_params"]))
		{
			$this->cache["multiple_params"] = array();
			$result = DB::query("SELECT id, [name] FROM {shop_param} WHERE type='multiple' AND required='1' AND trash='0'");
			while($row = DB::fetch_array($result))
			{
				$result2 = DB::query("SELECT id, [name] FROM {shop_param_select} WHERE param_id=%d", $row["id"]);
				while ($row2 = DB::fetch_array($result2))
				{
					$row["values"][$row2["id"]] = $row2["name"];
				}
				$result2 = DB::query("SELECT cat_id FROM {shop_param_category_rel} WHERE element_id=%d", $row["id"]);
				while ($row2 = DB::fetch_array($result2))
				{
					$row["cats"][] = $row2["cat_id"];
				}
				$this->cache["multiple_params"][$row["id"]] = $row;
			}
		}

		$param_delimitor = $this->field('price', 'param_delimitor') ? $this->field('price', 'param_delimitor') : '&';
		$param_select_type = $this->field('price', 'param_select_type');
		foreach($this->field_value("price") as $v)
		{
			$new_v = array();
			$v = explode($param_delimitor, $v);
			if($error = Validate::floattext($v[0]))
			{
				$this->error_validate('price', $error);
				continue;
			}
			$new_v["count"] = 0;
			if($this->field('price', 'param_count'))
			{
				$new_v["count"] = $v[1];
				if(preg_match('/[^0-9]+/', $new_v["count"]))
				{
					$this->error_validate('price', 'количество должно быть числом');
					$new_v["count"] = preg_replace('/[^0-9]+/', '', $new_v["count"]);
				}
				unset($v[1]);
			}
			$new_v["currency"] = 0;
			if($this->field('price', 'param_currency'))
			{
				$i = $this->field('price', 'param_count') ? 2 : 1;
				$currency = $v[$i];
				if($currency)
				{
					if(! isset($this->cache["currency"]))
					{
						$this->cache["currency"] = array();
						$result = DB::query("SELECT id, name FROM {shop_currency} WHERE trash='0'");
						while($row = DB::fetch_array($result))
						{
							if($this->field('price', 'param_select_currency') == 'value')
							{
								$this->cache["currency"][$row["name"]] = $row["id"];
							}
							else
							{
								$this->cache["currency"][$row["id"]] = $row["id"];
							}
						}
					}
					if(empty($this->cache["currency"][$currency]))
					{
						$this->error_validate('price', 'некорректное значение валюты');
						continue;
					}
					else
					{
						$new_v["currency"] = $this->cache["currency"][$currency];
					}
				}
				unset($v[$i]);
			}
			$new_v["price"] = str_replace(',', '.', $v[0]);
			unset($v[0]);
			$new_params = array();
			foreach($v as $i => $p)
			{
				if(! $p)
					continue;

				list($param_id, $param_value) = explode('=', $p);
				if(empty($param_id))
				{
					$this->error_validate('price', 'некорректное значение параметра, влияющего на цену');
					continue;
				}
				if(empty($param_value))
				{
					$param_value = 0;
				}

				$new_params[$param_id] = $param_value;
			}
			$multiple_params = array();
			foreach($this->cache["multiple_params"] as $id => $param)
			{
				$in_cats = true;
				if(! in_array(0, $param["cats"]) && $this->cache["current_cats"])
				{
					$in_cats = false;
					foreach($this->cache["current_cats"] as $cat)
					{
						if(in_array($cat, $param["cats"]))
						{
							$in_cats = true;
							break;
						}
					}
				}
				if($in_cats)
				{
					$multiple_params[] = $id;
				}
				if($param_select_type == 'value')
				{
					$id = $param["name"];
				}
				if($in_cats && ! in_array($id, array_keys($new_params)))
				{
					$new_params[$id] = 0;
				}
			}
			foreach($new_params as $id => $value)
			{
				$new_id = 0;
				foreach($this->cache["multiple_params"] as $param)
				{
					if($param_select_type == 'value')
					{
						$param_id = $param["name"];
					}
					else
					{
						$param_id = $param["id"];
					}
					if($param_id == $id)
					{
						$new_id = $param["id"];
						if($value)
						{
							$new_value = 0;
							foreach($param["values"] as $v_k => $v_v)
							{
								if($param_select_type == 'value')
								{
									$param_value = $v_v;
								}
								else
								{
									$param_value = $v_k;
								}
								if($param_value == $value)
								{
									$new_value = $v_k;
									break;
								}
							}
							if(! $new_value)
							{
								$this->error_validate('price', 'не верно задано значение параметра, влияющего на цену');
								continue;
							}
							$value = $new_value;
						}
						break;
					}
				}
				if(! $new_id)
				{
					$this->error_validate('price', 'не верно задан параметр, влияющий на цену');
					continue;
				}
				$id = $new_id;
				if(! in_array($id, $multiple_params))
				{
					$this->error_validate('price', 'параметр, влияющий на цену не может быть применен к товару');
					continue;
				}
				$new_params[$id] = $value;
			}
			$new_v["params"] = $new_params;
			$new_values[] = $new_v;
		}
		return $new_values;
	}

	/**
	 * Подготавливает значение поля "Количество"
	 *
	 * @return array
	 */
	private function set_count()
	{
		$new_values = array();
		if(! isset($this->cache["multiple_params"]))
		{
			$this->cache["multiple_params"] = array();
			$result = DB::query("SELECT id, [name] FROM {shop_param} WHERE type='multiple' AND required='1' AND trash='0'");
			while($row = DB::fetch_array($result))
			{
				$result2 = DB::query("SELECT id, [name] FROM {shop_param_select} WHERE param_id=%d", $row["id"]);
				while ($row2 = DB::fetch_array($result2))
				{
					$row["values"][$row2["id"]] = $row2["name"];
				}
				$result2 = DB::query("SELECT cat_id FROM {shop_param_category_rel} WHERE element_id=%d", $row["id"]);
				while ($row2 = DB::fetch_array($result2))
				{
					$row["cats"][] = $row2["cat_id"];
				}
				$this->cache["multiple_params"][$row["id"]] = $row;
			}
		}

		$param_delimitor = $this->field('count', 'param_delimitor') ? $this->field('count', 'param_delimitor') : '&';
		$param_select_type = $this->field('count', 'param_select_type');
		foreach($this->field_value("count") as $v)
		{
			$new_v = array();
			$v = explode($param_delimitor, $v);
			if($error = Validate::numtext($v[0]))
			{
				$this->error_validate('count', $error);
				continue;
			}
			$new_v["count"] = $v[0];
			unset($v[0]);
			$new_params = array();
			foreach($v as $i => $p)
			{
				if(! $p)
					continue;

				list($param_id, $param_value) = explode('=', $p);
				if(empty($param_id))
				{
					$this->error_validate('count', 'некорректное значение параметра, влияющего на цену');
					continue;
				}
				if(empty($param_value))
				{
					$param_value = 0;
				}

				$new_params[$param_id] = $param_value;
			}
			$multiple_params = array();
			foreach($this->cache["multiple_params"] as $id => $param)
			{
				$in_cats = true;
				if(! in_array(0, $param["cats"]) && $this->cache["current_cats"])
				{
					$in_cats = false;
					foreach($this->cache["current_cats"] as $cat)
					{
						if(in_array($cat, $param["cats"]))
						{
							$in_cats = true;
							break;
						}
					}
				}
				if($in_cats)
				{
					$multiple_params[] = $id;
				}
				if($param_select_type == 'value')
				{
					$id = $param["name"];
				}
				if($in_cats && ! in_array($id, array_keys($new_params)))
				{
					$new_params[$id] = 0;
				}
			}
			foreach($new_params as $id => $value)
			{
				$new_id = 0;
				foreach($this->cache["multiple_params"] as $param)
				{
					if($param_select_type == 'value')
					{
						$param_id = $param["name"];
					}
					else
					{
						$param_id = $param["id"];
					}
					if($param_id == $id)
					{
						$new_id = $param["id"];
						if($value)
						{
							$new_value = 0;
							foreach($param["values"] as $v_k => $v_v)
							{
								if($param_select_type == 'value')
								{
									$param_value = $v_v;
								}
								else
								{
									$param_value = $v_k;
								}
								if($param_value == $value)
								{
									$new_value = $v_k;
									break;
								}
							}
							if(! $new_value)
							{
								$this->error_validate('count', 'не верно задано значение параметра, влияющего на цену');
								continue;
							}
							$value = $new_value;
						}
						break;
					}
				}
				if(! $new_id)
				{
					$this->error_validate('count', 'не верно задан параметр, влияющий на цену');
					continue;
				}
				$id = $new_id;
				if(! in_array($id, $multiple_params))
				{
					$this->error_validate('count', 'параметр, влияющий на цену не может быть применен к товару');
					continue;
				}
				$new_params[$id] = $value;
			}
			$new_v["params"] = $new_params;
			$new_values[] = $new_v;
		}
		return $new_values;
	}

	/**
	 * Обработка поля "Связанные товары"
	 *
	 * @return void
	 */
	private function set_rels()
	{
		if ($this->import["type"] != 'good')
			return;

		if(! $this->is_field("id") || ! $this->is_field("rel_goods"))
			return;

		if (! $this->field_value("rel_goods"))
			return;

		DB::query("DELETE FROM {shop_rel} WHERE element_id=%d", $this->id);

		if($this->field("rel_goods", "param_type") == 'site')
		{
			foreach ($this->field_value("rel_goods") as $relation)
			{
				DB::query("INSERT INTO {shop_rel} (element_id, rel_element_id) VALUES (%d, %d)", $this->id, $relation);
			}
			return;
		}

		foreach ($this->field_value("rel_goods") as $relation)
		{
			DB::query("INSERT INTO {shop_rel} (element_id, rel_element_id_temp) VALUES (%d, '%s')", $this->id, $relation);
		}
	}

	/**
	 * Обработка поля "Меню"
	 *
	 * @return void
	 */
	private function set_menu()
	{
		foreach ($this->menus as $k => $param)
		{
			if ( ! $param["id"])
				continue;

			$value = isset($this->data[$k]) ? $this->data[$k] : '';
			if(! $value)
			{
				if($param['required'])
				{
					$this->error_validate('menu', 'значение не задано', $param["name"]);
				}
				continue;
			}

			if ($this->is_field("id"))
			{
				$id = DB::query_result("SELECT id FROM {menu} WHERE cat_id=%d AND module_name='shop' AND ".($this->import["type"] == 'good' ? 'element_id' : 'module_cat_id')."=%d LIMIT 1", $param["id"], $this->id);
				if($id)
				{
					$children = $this->diafan->get_children($this->id, 'menu');
					$children[] = $id;
					DB::query("DELETE FROM {menu} WHERE id IN (".implode(",", $children).")");
					DB::query("DELETE FROM {menu_parents} WHERE element_id IN (".implode(",", $children).")");
				}
			}

			if ($value)
			{
				DB::query(
						"INSERT INTO {menu} ([name], module_name, site_id, "
						.($this->import["type"] == 'good' ? 'element_id' : 'module_cat_id')
						.", cat_id, sort, [act]) VALUES ('%s', 'shop', %d, %d, %d, %d, '%d')",
						$this->field_value('name'),
						$this->import["site_id"],
						$this->id,
						$param["id"],
						$this->field_value('sort') ? $this->field_value('sort') : $this->id,
						$this->field_value('act') ? 1 : 0
					);
			}
		}
	}

	/**
	 * Прикрепление характеристик к товару
	 * 
	 * @return void
	 */
	private function set_params()
	{
		foreach ($this->params as $k => $param)
		{
			if ( ! $param["id"])
				continue;

			if ($this->is_field("id"))
			{
				DB::query("DELETE FROM {shop_param_element} WHERE param_id=%d AND element_id=%d", $param["id"], $this->id);
			}

			$value = isset($this->data[$k]) ? $this->data[$k] : '';
			if(empty($value))
			{
				if($param['required'])
				{
					$this->error_validate('param', 'значение не задано', $param["name"]);
				}
				continue;
			}

			switch ($param["type"])
			{
				case 'multiple':
					$new_value =  array();
					$d = explode($this->import["sub_delimiter"], $value);
					foreach($d as $v)
					{
						$v = trim($v);
						if($v)
						{
							if(isset($param["values"][$v]) && $param["select_type"] == 'value')
							{
								$new_value[] = $param["values"][$v];
							}
							elseif(in_array($v, array_keys($param["values"])) && $param["select_type"] == 'key')
							{
								$new_value[] = $v;
							}
							else
							{
								$this->error_validate('param', $this->diafan->_('"%s" нет в списке значений', $v), $k, false);
							}
						}
					}
					$value = $new_value;
					break;

				case 'select':
					if($value)
					{
						if(isset($param["values"][$value]) && $param["select_type"] == 'value')
						{
							$value = $param["values"][$value];
						}
						elseif(! in_array($value, array_keys($param["values"])) && $param["select_type"] == 'key')
						{
							$this->error_validate('param', $this->diafan->_('"%s" нет в списке значений', $value), $param["name"], false);
							$value = '';
						}
					}
					break;

				case 'date':
					if($error = Validate::date($value))
					{
						$this->error_validate('param', $error, $param["name"]);
						$value = '';
					}
					else
					{
						$value = $this->diafan->formate_in_date($value);
					}
					break;

				case 'datetime':
					if($error = Validate::datetime($value))
					{
						$this->error_validate('param', $error, $param["name"]);
						$value = '';
					}
					else
					{
						$value = $this->diafan->formate_in_datetime($value);
					}
					break;

				case 'numtext':
					if(preg_match('/[^0-9]+/', $value))
					{
						$this->error_validate('param', 'значение должно быть числом', $param["name"]);
						$value = preg_replace('/[^0-9]+/', '', $value);
					}
					break;

				case 'title':
					$value = '';
					break;

				case 'checkbox':
					if($value === '1' || $value === 1 || $value === 'true' || $value === 'TRUE' || $value === true)
					{
						$value = 1;
					}
					elseif($value === '0' || $value === 0 || $value === 'false' || $value === 'FALSE' || $value === false)
					{
						$value = 0;
					}
					else
					{
						$this->error_validate('param', 'допустимы только следующие значения 1, 0, true, false', $param["name"]);
						$value = 0;
					}
					break;

				case 'attachments':
					$value = '';
					break;
			}

			if(empty($value))
			{
				if($param['required'])
				{
					$this->error_validate('param', 'значение не задано', $param["name"]);
				}
				continue;
			}
			$value_name = in_array($param["type"], array('text', 'textarea', 'editor')) ? "[value]" : "value".$this->diafan->language_base_site;
			if (is_array($value))
			{
				foreach($value as $v)
				{
					DB::query("INSERT INTO {shop_param_element} (".$value_name.", param_id, element_id) VALUES ('%s', %d, %d)", $v, $param["id"], $this->id);
				}
			}
			else
			{
				DB::query("INSERT INTO {shop_param_element} (".$value_name.", param_id, element_id) VALUES ('%s', %d, %d)", $value, $param["id"], $this->id);
			}
		}
	}

	/**
	 * Загружает все изображения товара
	 *
	 * @return void
	 */
	public function set_images()
	{
		if ( ! $this->is_field("images"))
			return;

		$this->diafan->_images->delete($this->id, 'shop'.($this->import["type"] == 'category' ? 'cat' : ''));

		if (! $this->field_value("images"))
			return;

		if(! $this->field("images", 'param_directory'))
		{
			$this->error_validate('images', $this->diafan->_('Невозможно загрузить изображения %s, так как в настройках не указана папка, где они храняться.', implode(" ", $this->field_value("images"))), false, false);
			return;
		}

		if(! $images = $this->get_images_data())
			return;

		foreach ($images as $image)
		{
			$error = $this->diafan->_images->upload($this->id, 'shop', $this->import['site_id'], $image['address'], $image['name'], ($this->import["type"] == 'category'));
			if($error)
			{
				$this->error_validate('images', $image['address'].': '.$error, false, false);
			}
		}
	}

	/**
	 * Получение данных об изображениях, доступных для загрузки
	 *
	 * @return array
	 */
	public function get_images_data()
	{
		$directory = trim(preg_replace('/(^\/)|(\.)|(\/$)/', '', $this->field("images", 'param_directory'))).'/';
		$images = array();
		foreach ($this->field_value("images") as $image_address)
		{
			if ( ! file_exists(ABSOLUTE_PATH.$directory.$image_address))
			{
				$this->error_validate('images', $this->diafan->_('Файл %s не найден', ABSOLUTE_PATH.$directory.$image_address), false, false);
				continue;
			}

			$temp = array();
			$temp['address'] = ABSOLUTE_PATH.$directory.$image_address;
			$temp['name'] = $this->field_value("name") ? preg_replace('/[^A-Za-z0-9-_]+/', '', strtolower($this->diafan->translit(substr($this->field_value("name"), 0, 50)))) : $this->id;

			$images[] = $temp;
		}

		return $images;
	}


	/**
	 * Обновление сортировки
	 * 
	 * @return void
	 */
	public function finish_update_sort()
	{
		DB::query("UPDATE {".$this->import["table"]."} SET sort=id WHERE sort=0");
	}

	/**
	 * Удаление старых записей в БД, если в импорте участвуют идентификаторы элементов
	 *
	 * @return void
	 */
	public function finish_delete()
	{
		if (! $this->import["delete_items"])
			return;

		if (! $this->is_field('id'))
			return;

		$this->delete(0);
	}

	/**
	 * Обработка временных данных поля "Родитель"
	 *
	 * @return void
	 */
	public function finish_parent()
	{
		if ($this->import["type"] == 'good')
			return;

		if (! $this->is_field("id") || ! $this->is_field("parent"))
			return;

		// если задано поле "Родитель" у категорий
		$result = DB::query("SELECT id".(! $this->field("parent", "param_type") || $this->field("parent", "param_type") == "name" ? ", import_parent_id" : '').", parent_id FROM {shop_category} WHERE `import`='1'");
		while ($row = DB::fetch_array($result))
		{
			// удаляем всех старых родителей
			DB::query("DELETE FROM {shop_category_parents} WHERE element_id=%d", $row["id"]);

			if ((! $this->field("parent", "param_type") || $this->field("parent", "param_type") == "name") && $row["import_parent_id"])
			{
				if ( ! isset($this->cache["cats"][$row["import_parent_id"]]))
				{
					$this->cache["cats"][$row["import_parent_id"]] =
							DB::query_result("SELECT id FROM {shop_category} WHERE "
							.(! $this->field("parent", "param_type") ? "import_id='%h'" : "[name]='%s'")
							." AND trash='0' LIMIT 1", $row["import_parent_id"]);
				}
				$row["parent_id"] = $this->cache["cats"][$row["import_parent_id"]];
				DB::query("UPDATE {shop_category} SET parent_id=%d WHERE id=%d", $row["parent_id"], $row["id"]);
			}
			if($row["parent_id"])
			{
				$parent_id = $row["parent_id"];
				$parents = array();
				while ($parent_id > 0 && ! in_array($parent_id, $parents))
				{
					$parents[] = $parent_id;
					DB::query("INSERT INTO {shop_category_parents} (`element_id`, `parent_id`) VALUES (%d, %d)", $row["id"], $parent_id);
					$parent_id = DB::query_result("SELECT parent_id FROM {shop_category} WHERE id=%d LIMIT 1", $parent_id);
				}
			}
		}
		// пересчитываем количество детей у всех категорий
		$result = DB::query("SELECT id FROM {shop_category}");
		while ($row = DB::fetch_array($result))
		{
			$count = DB::query_result("SELECT COUNT(*) FROM  {shop_category_parents} WHERE parent_id=%d", $row["id"]);
			DB::query("UPDATE {shop_category} SET count_children=%d WHERE id=%d", $count, $row["id"]);
		}

		if(! $this->field("parent", "param_type") || $this->field("parent", "param_type") == "name")
		{
			DB::query("UPDATE {shop_category} SET parent_id=0 WHERE import_parent_id=''");
			DB::query("ALTER TABLE {shop_category} DROP `import_parent_id`");
		}
	}

	/**
	 * Обработка временных данных поля "Доступ"
	 *
	 * @return void
	 */
	public function finish_access()
	{
		if ($this->import["type"] == 'good')
		{
			// для импортированных товаров проверяет доступ к категориям, если ограничен, то органичевает доступ к товару
			$result = DB::query("SELECT cat_id, id, access FROM {shop} WHERE `import`='1' AND site_id=%d", $this->import["site_id"]);
			while ($row = DB::fetch_array($result))
			{
				if(! $row["cat_id"])
					continue;

				if(! isset($this->cache["access_cat"][$row["cat_id"]]))
				{
					$this->cache["access_cat"][$row["cat_id"]] = array();
					$access = DB::query_result("SELECT access FROM {shop_category} WHERE id=%d LIMIT 1", $row["cat_id"]);
					if($access)
					{
						$result_a = DB::query("SELECT role_id FROM {access} WHERE module_name='shop' AND cat_id=%d", $row["cat_id"]);
						while ($row_a = DB::fetch_array($result_a))
						{
							$this->cache["access_cat"][$row["cat_id"]][] = $row_a["role_id"];
						}
					}
				}
				if($this->cache["access_cat"][$row["cat_id"]])
				{
					$access = array();
					if($row["access"])
					{
						$result_a = DB::query("SELECT role_id FROM {access} WHERE module_name='shop' AND element_id=%d", $row["id"]);
						while ($row_a = DB::fetch_array($result_a))
						{
							$access[] = $row_a["role_id"];
						}
					}
					else
					{
						DB::query("UPDATE {shop} SET access='1' WHERE id=%d", $row["id"]);
					}
					foreach($this->cache["access_cat"][$row["cat_id"]] as $role_id)
					{
						if(! in_array($role_id, $access))
						{
							DB::query("INSERT INTO {access} (module_name, element_id, role_id) VALUES ('shop', %d, %d)", $row["id"], $role_id);
							$access[] = $role_id;
						}
					}
				}
			}
			return;
		}

		$result = DB::query("SELECT id, access, parent_id FROM {shop_category} WHERE `import`='1' AND site_id=%d ORDER BY count_children DESC", $this->import["site_id"]);
		while ($row = DB::fetch_array($result))
		{
			// для импортированных категорий проверяет доступ к родителю, если ограничен, то органичевает доступ к категории
			if($row["parent_id"])
			{
				$this->get_access($row["parent_id"]);
				if($this->cache["access_cat"][$row["parent_id"]])
				{
					$this->get_access($row["id"], $row["access"]);
					foreach($this->cache["access_cat"][$row["parent_id"]] as $role_id)
					{
						if(! in_array($role_id, $this->cache["access_cat"][$row["id"]]))
						{
							DB::query("INSERT INTO {access} (module_name, cat_id, role_id) VALUES ('shop', %d, %d)", $row["id"], $role_id);
							$this->cache["access_cat"][$row["id"]][] = $role_id;
							$row["access"] = '1';
						}
					}
					if(! $row["access"] && $this->cache["access_cat"][$row["id"]])
					{
						DB::query("UPDATE {shop_category} SET access='1' WHERE id=%d", $row["id"]);
					}
				}
			}

			if(! $row["access"] && (! isset($this->cache["access_cat"][$row["id"]]) || ! $this->cache["access_cat"][$row["id"]]))
				continue;

			$this->get_access($row["id"]);

			// ограничевает доступ к вложенным категориям
			$children = $this->diafan->get_children($row["id"], 'shop_category');
			if($children)
			{
				$result_ch = DB::query("SELECT id, access FROM {shop_category} WHERE id IN (".implode(",", $children).")");
				while ($row_ch = DB::fetch_array($result_ch))
				{
					$this->get_access($row_ch["id"], $row_ch["access"]);
					foreach($this->cache["access_cat"][$row["id"]] as $role_id)
					{
						if(! in_array($role_id, $this->cache["access_cat"][$row_ch["id"]]))
						{
							DB::query("INSERT INTO {access} (module_name, cat_id, role_id) VALUES ('shop', %d, %d)", $row_ch["id"], $role_id);
							$this->cache["access_cat"][$row_ch["id"]][] = $role_id;
						}
					}
					if(! $row_ch["access"] && $this->cache["access_cat"][$row_ch["id"]])
					{
						DB::query("UPDATE {shop_category} SET access='1' WHERE id=%d", $row_ch["id"]);
					}
				}
			}

			// ограничивает доступ к вложенным товарам
			$result_ch = DB::query("SELECT id, access FROM {shop} WHERE cat_id=%d", $row["id"]);
			while ($row_ch = DB::fetch_array($result_ch))
			{
				$access = array();
				if($row_ch["access"])
				{
					$result_a = DB::query("SELECT role_id FROM {access} WHERE module_name='shop' AND cat_id=%d", $row_ch["id"]);
					while ($row_a = DB::fetch_array($result_a))
					{
						$access[] = $row_a["role_id"];
					}
				}
				foreach($this->cache["access_cat"][$row["id"]] as $role_id)
				{
					if(! in_array($role_id, $access))
					{
						DB::query("INSERT INTO {access} (module_name, element_id, role_id) VALUES ('shop', %d, %d)", $row_ch["id"], $role_id);
					}
				}
				if(! $row_ch["access"] && $this->cache["access_cat"][$row["id"]])
				{
					DB::query("UPDATE {shop} SET access='1' WHERE id=%d", $row_ch["id"]);
				}
			}
		}
	}

	/**
	 * Формирует массив прав доступа к категории
	 *
	 * @param integer $id номер категории
	 * @param mixed $access общий доступ ограничен/не ограничен
	 * @return void
	 */
	private function get_access($id, $access = 'check')
	{
		if(! isset($this->cache["access_cat"][$id]))
		{
			$this->cache["access_cat"][$id] = array();
			if($access === 'check')
			{
				$access = DB::query("SELECT access FROM {shop_category} WHERE id=%d", $id);
			}
			if($access)
			{
				$result = DB::query("SELECT role_id FROM {access} WHERE module_name='shop' AND cat_id=%d", $id);
				while ($row = DB::fetch_array($result))
				{
					$this->cache["access_cat"][$id][] = $row["role_id"];
				}
			}
		}
	}

	/**
	 * Обработка временных данных поля "Связанные товары"
	 *
	 * @param array $this->import конфигурация импорта
	 * @param array $this->fields массив типов полей, используемых в импорте
	 * @return void
	 */
	public function finish_rels()
	{
		if ($this->import["type"] != 'good')
			return;
		
		if(! $this->is_field("id") || ! $this->is_field("rel_goods"))
			return;

		if($this->field("rel_goods", "param_type") == 'site')
			return;

		$type = $this->field("rel_goods", "param_type") == 'article' ? 'article' : 'import_id';

		$result = DB::query("SELECT id, ".$type." as aid FROM {shop} WHERE `import`='1' AND site_id=%d", $this->import["site_id"]);
		while($row = DB::fetch_array($result))
		{
			DB::query("UPDATE {shop_rel} SET rel_element_id=%d WHERE rel_element_id_temp='%s'", $row["id"], $row["aid"]);
		}
		DB::query("DELETE FROM {shop_rel} WHERE rel_element_id=element_id");

		DB::query("ALTER TABLE {shop_rel} DROP `rel_element_id_temp`");
	}

	/**
	 * Отображение элементов в меню
	 * 
	 * @return void
	 */
	public function finish_menu()
	{
		if (! $this->menus)
			return;
		
		foreach($this->menus as $param)
		{
			$result = DB::query(
					"SELECT s.*, m.id AS menu_id FROM {menu} AS m"
					." INNER JOIN {".$this->import["table"]."} AS s"
					." ON s.import='1' AND m.".($this->import["type"] == 'good' ? 'element_id' : 'module_cat_id')."=s.id"
					." WHERE  m.module_name='shop' AND m.site_id=%d AND m.trash='0'"
					.($this->import["type"] == 'category' ? ' ORDER BY s.count_children DESC' : ''),
					$param["id"]
				);
			while($row = DB::fetch_array($result))
			{
				if($this->import["type"] == 'category')
				{
					$menu_parent = 0;
					if($row["parent_id"])
					{
						$parents = $this->diafan->get_parents($row["id"], 'shop_category');
						$menu_parent = DB::query_result(
								"SELECT m.id FROM {menu} AS m"
								." INNER JOIN {shop_category} AS s"
								." ON m.module_cat_id=s.id AND s.trash='0'"
								." WHERE s.id IN (".implode(',', $parents).") AND m.cat_id=%d AND m.trash='0'"
								." ORDER BY s.count_children ASC LIMIT 1",
								$param["id"]);
					}
					if(! $menu_parent)
					{
						$menu_parent = DB::query("SELECT id FROM {menu} WHERE module_name='site' WHERE site_id=%d AND trash='0'", $this->import["site_id"]);
					}

					DB::query("UPDATE {menu} SET parent_id=%d, access='%d' WHERE id=%d", $menu_parent, $row["access"], $row["menu_id"]);
					if(! $menu_parent)
						continue;

					$menu_parents = $this->diafan->get_parents($menu_parent, 'menu');
					$menu_parents[] = $menu_parent;
					foreach($menu_parents as $m)
					{
						DB::query("INSERT INTO {menu_parents} (parent_id, element_id) VALUES (%d, %d)", $m, $row["menu_id"]);
					}
				}
				else
				{
					$menu_parent = 0;
					if($row["cat_id"])
					{
						$parents = $this->diafan->get_parents($row["cat_id"], 'shop_category');
						$parents[] = $row["cat_id"];
						$menu_parent = DB::query_result(
								"SELECT m.id FROM {menu} AS m"
								." INNER JOIN {shop_category} AS s"
								." ON m.module_cat_id=s.id AND s.trash='0'"
								." WHERE s.id IN (".implode(',', $parents).") AND m.cat_id=%d AND m.trash='0'"
								." ORDER BY s.count_children ASC LIMIT 1",
								$param["id"]);
					}
					if(! $menu_parent)
					{
						$menu_parent = DB::query("SELECT id FROM {menu} WHERE module_name='site' WHERE site_id=%d AND trash='0'", $this->import["site_id"]);
					}

					DB::query("UPDATE {menu} SET parent_id=%d, access='%d' WHERE id=%d", $menu_parent, $row["access"], $row["menu_id"]);
					if(! $menu_parent)
						continue;

					$menu_parents = $this->diafan->get_parents($menu_parent, 'menu');
					$menu_parents[] = $menu_parent;
					foreach($menu_parents as $m)
					{
						DB::query("INSERT INTO {menu_parents} (parent_id, element_id) VALUES (%d, %d)", $m, $row["menu_id"]);
					}
				}
			}
			// пересчитываем количество детей у всех пунктов меню
			$result = DB::query("SELECT id FROM {menu} WHERE cat_id=%d", $param["id"]);
			while ($row = DB::fetch_array($result))
			{
				$count = DB::query_result("SELECT COUNT(*) FROM  {menu_parents} WHERE parent_id=%d", $row["id"]);
				DB::query("UPDATE {menu} SET count_children=%d WHERE id=%d", $count, $row["id"]);
			}
		}
	}


	/**
	 * Удаление записей в БД
	 *
	 * @param mixed $import import=0, import=1, false
	 * @return void
	 */
	private function delete($import = false)
	{
		$where =  '';
		if($import !== false)
		{
			$where = " AND `import`='".$import."'";
		}
		if(! isset($this->cache["images_variations_folder"]))
		{
			$result = DB::query("SELECT folder FROM {images_variations}");
			while ($row = DB::fetch_array($result))
			{
				$this->cache["images_variations_folder"][] = $row["folder"];
			}
		}
		if ($this->import["type"] == 'good')
		{
			if(! isset($this->cache["module"]["comments"]))
			{
				$this->cache["module"]["comments"] = DB::query_result("SELECT id FROM {modules} WHERE module_name='comments' LIMIT 1");
			}
			if(! isset($this->cache["module"]["tags"]))
			{
				$this->cache["module"]["tags"] = DB::query_result("SELECT id FROM {modules} WHERE module_name='tags' LIMIT 1");
			}
			if(! isset($this->cache["module"]["rating"]))
			{
				$this->cache["module"]["rating"] = DB::query_result("SELECT id FROM {modules} WHERE module_name='rating' LIMIT 1");
			}
			$where .= ($this->import["type"] != 'category' && $this->import["cat_id"] ? " AND cat_id=".$this->import["cat_id"] : '');
			$shop = " IN (SELECT id FROM {shop} WHERE site_id=%d".$where.")";

			DB::query("DELETE FROM {shop_category_rel} WHERE element_id".$shop, $this->import["site_id"]);
			DB::query("DELETE FROM {shop_rel} WHERE element_id".$shop, $this->import["site_id"]);
			DB::query("DELETE FROM {shop_cart} WHERE good_id".$shop, $this->import["site_id"]);
			DB::query("DELETE FROM {shop_wishlist} WHERE good_id".$shop, $this->import["site_id"]);
			DB::query("DELETE FROM {shop_waitlist} WHERE good_id".$shop, $this->import["site_id"]);
			DB::query("DELETE FROM {shop_rel} WHERE rel_element_id".$shop, $this->import["site_id"]);
			DB::query("DELETE FROM {shop_price_param} WHERE price_id IN (SELECT p.price_id FROM {shop_price} as p INNER JOIN {shop} as s ON p.good_id=s.id AND s.site_id=%d".$where.")", $this->import["site_id"]);
			DB::query("DELETE FROM {shop_price} WHERE good_id".$shop, $this->import["site_id"]);
			DB::query("DELETE FROM {shop_param_element} WHERE element_id".$shop, $this->import["site_id"]);
			DB::query("DELETE FROM {shop_discount_object} WHERE good_id".$shop, $this->import["site_id"]);
			DB::query("DELETE FROM {access} WHERE module_name='shop' AND element_id".$shop, $this->import["site_id"]);
			DB::query("DELETE FROM {menu} WHERE module_name='shop' AND element_id".$shop, $this->import["site_id"]);
			DB::query("DELETE FROM {rewrite} WHERE module_name='shop' AND element_id".$shop, $this->import["site_id"]);
			if($this->cache["module"]["comments"])
			{
				DB::query("DELETE FROM {comments} WHERE module_name='shop' AND element_id".$shop, $this->import["site_id"]);
			}
			if($this->cache["module"]["tags"])
			{
				DB::query("DELETE FROM {tags} WHERE module_name='tags' AND element_id".$shop, $this->import["site_id"]);
			}
			if($this->cache["module"]["rating"])
			{
				DB::query("DELETE FROM {rating} WHERE module_name='shop' AND element_id".$shop, $this->import["site_id"]);
			}
			$result = DB::query("SELECT * FROM {images} WHERE module_name='shop' AND element_id".$shop, $this->import["site_id"]);
			while ($row = DB::fetch_array($result))
			{
				foreach($this->cache["images_variations_folder"] as $folder)
				{
					if(file_exists(ABSOLUTE_PATH.USERFILES."/shop/".$folder."/".$row["name"]))
					{
						unlink(ABSOLUTE_PATH.USERFILES."/shop/".$folder."/".$row["name"]);
					}
				}
				unlink(ABSOLUTE_PATH.USERFILES."/original/".$row["name"]);
				unlink(ABSOLUTE_PATH.USERFILES."/small/".$row["name"]);
			}
			DB::query("DELETE FROM {images} WHERE module_name='shop' AND element_id".$shop, $this->import["site_id"]);

			$result = DB::query("SELECT * FROM {attachments} WHERE module_name='shop' AND element_id".$shop, $this->import["site_id"]);
			while ($row = DB::fetch_array($result))
			{
				if ($row["is_image"])
				{
					@unlink(ABSOLUTE_PATH.USERFILES.'/shop/imgs/'.$row["name"]);
					@unlink(ABSOLUTE_PATH.USERFILES.'/shop/imgs/small/'.$row["name"]);
				}
				else
				{
					@unlink(ABSOLUTE_PATH.USERFILES.'/shop/files/'.$row["id"]);
				}
			}
			DB::query("DELETE FROM {attachments} WHERE module_name='shop' AND element_id".$shop, $this->import["site_id"]);

			DB::query("DELETE FROM {shop} WHERE site_id=%d".$where, $this->import["site_id"]);
		}
		else
		{
			if(! isset($this->cache["module"]["comments"]))
			{
				$this->cache["module"]["comments"] = DB::query_result("SELECT id FROM {modules} WHERE module_name='comments' LIMIT 1");
			}
			if(! isset($this->cache["module"]["rating"]))
			{
				$this->cache["module"]["rating"] = DB::query_result("SELECT id FROM {modules} WHERE module_name='rating' LIMIT 1");
			}
			$shop = " IN (SELECT id FROM {shop_category} WHERE site_id=%d".$where.")";
			DB::query("DELETE FROM {shop_category_parents} WHERE element_id".$shop, $this->import["site_id"]);
			DB::query("DELETE FROM {shop_param_category_rel} WHERE cat_id".$shop, $this->import["site_id"]);
			DB::query("DELETE FROM {shop_category_rel} WHERE cat_id".$shop, $this->import["site_id"]);
			DB::query("DELETE FROM {shop_discount_object} WHERE cat_id".$shop, $this->import["site_id"]);
			DB::query("DELETE FROM {access} WHERE module_name='shop' AND cat_id".$shop, $this->import["site_id"]);
			DB::query("DELETE FROM {menu} WHERE module_name='shop' AND cat_id".$shop, $this->import["site_id"]);
			DB::query("DELETE FROM {rewrite} WHERE module_name='shop' AND cat_id".$shop, $this->import["site_id"]);
			if($this->cache["module"]["comments"])
			{
				DB::query("DELETE FROM {comments} WHERE module_name='shop_category' AND element_id".$shop, $this->import["site_id"]);
			}
			if($this->cache["module"]["rating"])
			{
				DB::query("DELETE FROM {rating} WHERE module_name='shop_category' AND element_id".$shop, $this->import["site_id"]);
			}
			$result = DB::query("SELECT * FROM {images} WHERE module_name='shopcat' AND element_id".$shop, $this->import["site_id"]);
			while ($row = DB::fetch_array($result))
			{
				foreach($this->cache["images_variations_folder"] as $folder)
				{
					if(file_exists(ABSOLUTE_PATH.USERFILES."/shop/".$folder."/".$row["name"]))
					{
						unlink(ABSOLUTE_PATH.USERFILES."/shop/".$folder."/".$row["name"]);
					}
				}
				unlink(ABSOLUTE_PATH.USERFILES."/original/".$row["name"]);
				unlink(ABSOLUTE_PATH.USERFILES."/small/".$row["name"]);
			}
			DB::query("DELETE FROM {images} WHERE module_name='shopcat' AND element_id".$shop, $this->import["site_id"]);
			DB::query("DELETE FROM {shop_category} WHERE site_id=%d".$where, $this->import["site_id"]);
		}
	}
	/**
	 * Удаляет импортированные элементы с сайта
	 *
	 * @return void
	 */
	public function remove()
	{
		$this->import = DB::fetch_array(DB::query("SELECT * FROM {shop_import_category} WHERE id=%d LIMIT 1", $this->diafan->cat));
		$this->import["table"] = 'shop'.($this->import["type"] == 'category' ? "_category" : "");

		$this->delete(1);

		$this->diafan->redirect_js(URL.'error3/');
	}

	/**
	 * Публикует / скрывает результаты импорта
	 *
	 * @param boolean $act активность элемента на сайте
	 * @return void
	 */
	public function act($act)
	{
		$this->import = DB::fetch_array(DB::query("SELECT * FROM {shop_import_category} WHERE id=%d LIMIT 1", $this->diafan->cat));
		$this->import["table"] = 'shop'.($this->import["type"] == 'category' ? "_category" : "");

		DB::query("UPDATE {".$this->import["table"]."} SET [act]='%d' WHERE site_id=%d AND import='1'"
			  .($this->import["type"] != 'category' && $this->import["cat_id"] ? " AND cat_id=".$this->import["cat_id"] : ''),
		          $act ? 1 : 0, $this->import["site_id"]);

		if($this->import["type"] == 'category')
		{
			DB::query("UPDATE {menu} SET [act]='%d' WHERE module_name='shop' AND module_cat_id IN (SELECT id FROM {shop_category} WHERE site_id=%d AND `import`='1')", $act ? 1 : 0, $this->import["site_id"]);
		}

		$this->diafan->redirect_js(URL.'success1/');
	}
}