<?php

/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
	include dirname(dirname(__FILE__)).'/includes/404.php';
}

/**
 * Ajax
 * 
 * Каркас для обработки Ajax-запросов модуля
 */
abstract class Ajax extends Model
{
	/**
	 * @var string метка формы, обычно название модуля + идентификатор формы
	 */
	protected $tag;
 
	/**
	* @var string модуль
	*/
	protected $module;

	/**
	 * @var string значения параметров из формы, сформированные для письма пользователю
	 */
	protected $message_param;

	/**
	 * @var string значения параметров из формы, сформированные для письма администратору
	 */
	protected $message_admin_param;

	/**
	 * @var integer номер страницы сайта, к которой прикреплен моудуль
	 */
	protected $site_id;

	/**
	 * Проверяет правильность каптчи
	 * 
	 * @return boolean
	 */
	protected function check_captcha()
	{
		if (! $this->module)
		{
			$this->module = $this->diafan->module;
		}
		if (! $this->tag)
		{
			$this->tag = $this->module;
		}

		$this->result["captcha"] = '';

		if ($this->diafan->configmodules('captcha', $this->module, $this->site_id))
		{
			if (empty($_POST['update']))
			{
				$mes = $this->diafan->_captcha->is_right($this->tag);
				$this->result["captcha"] = $this->diafan->_captcha->get($this->tag, '', ! empty($_POST['update']) ? true : false);
				if ($mes)
				{
					$this->result["errors"]["captcha"] = $mes;
					return true;
				}
			}
			else
			{
				$this->result["captcha"] = $this->diafan->_captcha->get($this->tag, '', ! empty($_POST['update']) ? true : false);
				$this->result["update_captcha"] = true;
			}
		}
		return false;
	}

	/**
	 * Проверяет на заполнение обязательных полей
	 * 
	 * @param array $config настройки функции: params поля формы, prefix префикс
	* @return void
	*/
	protected function empty_required_field($config)
	{
		if(empty($config["params"]))
		{
			return;
		}
		$prefix =  ! empty($config["prefix"]) ? $config["prefix"] : '';
		$params =  $config["params"];

		foreach ($params as $row)
		{
			if ($row["required"] && $row["type"] == "attachments")
			{
				$empty_attach = true;
				if(! empty($_FILES[$prefix.'attachments'.$row["id"]]))
				{
					foreach($_FILES[$prefix.'attachments'.$row["id"]]["name"] as $i => $name)
					{
						if(! empty($name) && ! empty($_FILES[$prefix.'attachments'.$row["id"]]["tmp_name"][$i]) && ! empty($_FILES[$prefix.'attachments'.$row["id"]]["size"][$i]))
						{
							$empty_attach = false;
						}
					}
				}
				if($empty_attach)
				{
					$this->result["errors"][$prefix."p".$row["id"]] = $this->diafan->_('Пожалуйста, прикрепите файл.');
				}
				continue;
			}
			if ($row["required"] && $row["type"] == "images")
			{
				if(empty($_FILES[$prefix.'images'.$row["id"]]) || $_FILES[$prefix.'images'.$row["id"]]["name"] == '' || empty($_FILES[$prefix.'images'.$row["id"]]["size"]))
				{
					$this->result["errors"][$prefix."p".$row["id"]] = $this->diafan->_('Пожалуйста, прикрепите изображение.');
				}
				continue;
			}
			if ($row["required"] && empty($_POST[$prefix.'p'.$row["id"]]))
			{
				$this->result["errors"][$prefix."p".$row["id"]] = $this->diafan->_('Пожалуйста, заполните обязательное поле %s', false, $row["name"]);
			}

			if (! empty($_POST[$prefix."p".$row["id"]]) && $row["type"] == "email")
			{
				$this->valid_email($_POST[$prefix."p".$row["id"]], $prefix."p".$row["id"]);
			}
		}
		return;
	}

	/**
	 * Добавляет значение полей формы в базу данных
	 * 
	 * @param array $config настройки функции: id номер элемента, table таблица, params поля формы
	* @return void
	*/
	protected function insert_values($config)
	{
		if(empty($config["id"]) || empty($config["table"]) || empty($config["params"]))
		{
			return;
		}
		$id =  $config["id"];
		$table =  $config["table"];
		$params =  $config["params"];
		$prefix = ! empty($config["prefix"]) ? $config["prefix"] : '';
		$message = array();
		$message_admin = array();
		foreach ($params as $row)
		{
			$mess = '';
			// добавляем файлы
			if($row["type"] == "attachments")
			{
				if (! empty($_FILES[$prefix.'attachments'.$row["id"]]))
				{
					$row_config = unserialize($row["config"]);
					$row_config["param_id"] = $row["id"];
					$row_config["prefix"] = $prefix;

					$err = $this->diafan->_attachments->save($id, $table, $row_config);
					switch($err)
					{
						case 'success':
							$mess = $row["name"].':';
							$attachs = $this->diafan->_attachments->get($id, $table, 0, $row["id"]);
							foreach($attachs as $a)
							{
								if ($a["is_image"])
								{
									$mess .= ' <a href="'.$a["link"].'">'.$a["name"].'</a> <a href="'.$a["link"].'"><img src="'.$a["link_preview"].'"></a>';
								}
								else
								{
									$mess .= ' <a href="'.$a["link"].'">'.$a["name"].'</a>';
								}
							}
							if($row_config["attachments_access_admin"])
							{
								$mess .= '<br>'.$this->diafan->_('Для просмотра файлов авторизуйтесь на сайте как администратор.');
							}
							else
							{
								$message[] = $mess;
							}
							$message_admin[] = $mess;
							break;

						case 'empty':
							break;
						
						default:
							$this->result["errors"][$prefix."p".$row["id"]] = $err;
							DB::query("DELETE FROM {".$table."} WHERE  id=%d", $id);
							DB::query("DELETE FROM {".$table."_param_element} WHERE element_id=%d", $id);
							$this->diafan->_attachments->delete($id, $table);
							return;
					}
				}
				continue;
			}
			// добавляем изображения
			if($row["type"] == "images")
			{
				if (! empty($_FILES[$prefix.'images'.$row["id"]]) && $_FILES[$prefix.'images'.$row["id"]]['tmp_name'] != '' && $_FILES[$prefix.'images'.$row["id"]]['name'] != '')
				{
					$err = $this->diafan->_images->upload($id, $table, 0, $_FILES[$prefix.'images'.$row["id"]]['tmp_name'], $_FILES[$prefix.'images'.$row["id"]]['name'], false, false, $row["id"]);
					if($err)
					{
						$this->result["errors"][$prefix."p".$row["id"]] = $err;
					}
				}
			}

			// формируем текст письма администратору
			if (empty($_POST[$prefix."p".$row["id"]]) && $row["type"] != "checkbox")
			{
				continue;
			}

			if ($row["type"] == "text" || $row["type"] == "textarea" || $row["type"] == "email")
			{
				$_POST[$prefix."p".$row["id"]] = $this->diafan->get_param($_POST, $prefix."p".$row["id"], '', 1);
				$mess = $row["name"].': '.$_POST[$prefix."p".$row["id"]];
			}
			elseif ($row["type"] == "numtext")
			{
				$_POST[$prefix."p".$row["id"]] = (int)$this->diafan->get_param($_POST, $prefix."p".$row["id"], '', 2);
				$mess = $row["name"].': '.$_POST[$prefix."p".$row["id"]];
			}
			elseif ($row["type"] == "date")
			{
				$_POST[$prefix."p".$row["id"]] = $this->diafan->formate_in_date($_POST[$prefix."p".$row["id"]]);
				$mess = $row["name"].': '.$_POST[$prefix."p".$row["id"]];
			}
			elseif ($row["type"] == "datetime")
			{
				$_POST[$prefix."p".$row["id"]] = $this->diafan->formate_in_datetime($_POST[$prefix."p".$row["id"]]);
				$mess = $row["name"].': '.$_POST[$prefix."p".$row["id"]];
			}
			elseif ($row["type"] == "checkbox")
			{
				$value = !empty($_POST[$prefix."p".$row["id"]]) ? 1 : 0;
				if (empty($row["select_values"][$value]) && $value == 1)
				{
					$mess = $row["name"];
				}
				elseif(! empty($row["select_values"][$value]))
				{
					$mess = $row["name"].': '.$row["select_values"][$value];
				}
			}
			elseif ($row["type"] == "select" && !empty($row["select_array"]))
			{
				foreach ($row["select_array"] as $select)
				{
					if ($select["id"] == $_POST[$prefix."p".$row["id"]])
					{
						$mess = $row["name"].': '.$select["name"];
					}
				}
			}
			elseif ($row["type"] == "multiple" && !empty($row["select_array"]) && !empty($_POST[$prefix."p".$row["id"]]) && is_array($_POST[$prefix."p".$row["id"]]))
			{
				$vals = array();
				foreach ($row["select_array"] as $select)
				{
					if (in_array($select["id"], $_POST[$prefix."p".$row["id"]]))
					{
						$vals[] = $select["name"];
					}
				}
				$mess = $row["name"].': '.implode(", ", $vals);
			}
			$message_admin[] = $mess;
			$message[] = $mess;

			// добавляем значения в базу данных
			if (empty($_POST[$prefix."p".$row["id"]]))
				continue;

			if(! empty($config["multilang"]))
			{
				if(in_array($row["type"], array('text', 'textarea', 'editor')))
				{
					$value_name = '[value]';
				}
				else
				{
					$value_name = 'value'.$this->diafan->language_base_site;
				}
			}
			else
			{
				$value_name = 'value';
			}

			if ($row["type"] == "multiple")
			{
				foreach ($_POST[$prefix."p".$row["id"]] as $val)
				{
					DB::query("INSERT INTO {".$table."_param_element} (".$value_name.", param_id, element_id) VALUES ('%h', %d, %d)", $val, $row["id"], $id);
				}
			}
			else
			{
				DB::query("INSERT INTO {".$table."_param_element} (".$value_name.", param_id, element_id) VALUES ('%s', %d, %d)", nl2br(htmlspecialchars($_POST["p".$row["id"]])), $row["id"], $id);
			}
		}

		$this->message_admin_param = implode('<br>', $message_admin);
		$this->message_param = implode('<br>', $message);
	}

	/**
	 * Отправляет ответ
	 * 
	 * @return boolean
	 */
	protected function send_errors()
	{
		if(! $this->tag)
		{
			$this->tag = $this->diafan->module;
		}
		$params = array("errors", "success", "update_captcha", "redirect", "form", "form_hide", "add", "data");

		$s = false;
		foreach ($params as $v)
		{
			if (!empty($this->result[$v]))
			{
				$s = true;
				break;
			}
		}

		if ($s)
		{
			if (!empty($_POST['ajax']))
			{
				echo $this->to_json($this->result);
			}
			else
			{
				$query = '';
				if (!empty($this->result["errors"]))
				{
					foreach ($this->result["errors"] as $field => $mes)
					{
					if (empty($_POST["update"]))
					{
						$query .= '&mess'.($field ? '-'.$field : '').'='.$mes;
					}
					}
				}
				$this->diafan->redirect($this->diafan->_route->current_link().($query ? '?error='.$this->tag.$query : ''));
			}
			return true;
		}
		return false;
	}

	/**
	 * Преобразует массив в формат JSON
	 *
	 * @param array $result исходный массив
	 * @return string
	 */
	protected function to_json($result)
	{
		include_once ABSOLUTE_PATH.'plugins/json.php';
		return to_json($result);
	}

	/**
	 * Обновляет значение полей формы в базу данных
	 * 
	 * @param array $config настройки функции: id номер элемента, table таблица, params поля формы, prefix префикс
	 * @return void
	 */
	protected function update_values($config)
	{
		if(empty($config["id"]) || empty($config["table"]) || empty($config["params"]))
		{
			return;
		}
		$id =  $config["id"];
		$table =  $config["table"];
		$params =  $config["params"];
		$prefix = ! empty($config["prefix"]) ? $config["prefix"] : '';
		$rel = ! empty($config["rel"]) ? $config["rel"] : 'element';
		$no_empty_param_ids = array();
		foreach ($params as $row)
		{
			// добавляем, удаляем файлы
			if($row["type"] == "attachments")
			{
				$result = DB::query("SELECT id FROM {attachments} WHERE module_name='%s' AND element_id=%d AND param_id=%d", $table, $id, $row["id"]);
				while ($r = DB::fetch_array($result))
				{
					if (! empty($_POST["attachment_delete"]) && in_array($r["id"], $_POST["attachment_delete"]))
					{
						$this->diafan->_attachments->delete($id, $table, $r["id"]);
					}
				}

				if (! empty($_FILES[$prefix.'attachments'.$row["id"]]))
				{
					$row_config = unserialize($row["config"]);
					$row_config["param_id"] = $row["id"];
					$row_config["prefix"] = $prefix;

					$err = $this->diafan->_attachments->save($id, $table, $row_config);
					switch($err)
					{
						case 'success':
							if(! $row_config["attachments_access_admin"])
							{
								$attachments = $this->diafan->_attachments->get($id, $table, 0, $row["id"]);
								$this->result["attachments"][$prefix."attachments".$row["id"]."[]"] = $this->diafan->_tpl->get('attachments', $this->diafan->current_module, array("rows" => $attachments, "prefix" => $prefix, "param_id" => $row["id"], "use_animation" => $row_config["use_animation"]));
							}
							else
							{
								$this->result["attachments"][$prefix."attachments".$row["id"]."[]"] = "";
							}
							break;
						case 'empty':
							break;

						default:
							$this->result["errors"][$prefix."p".$row["id"]] = $err;
							return;
					}
				}
			}
			// добавляем изображения
			if($row["type"] == "images")
			{
				$result = DB::query("SELECT id FROM {images} WHERE module_name='%s' AND element_id=%d AND param_id=%d", $table, $id, $row["id"]);
				while ($r = DB::fetch_array($result))
				{
					if (! empty($_POST["image_delete"]) && in_array($r["id"], $_POST["image_delete"]))
					{
						$this->diafan->_images->delete($id, $table, $r["id"]);
					}
				}

				if (! empty($_FILES[$prefix.'images'.$row["id"]]) && $_FILES[$prefix.'images'.$row["id"]]['tmp_name'] != '' && $_FILES[$prefix.'images'.$row["id"]]['name'] != '')
				{
					$err = $this->diafan->_images->upload($id, $table, 0, $_FILES[$prefix.'images'.$row["id"]]['tmp_name'], $_FILES[$prefix.'images'.$row["id"]]['name'], false, false, $row["id"]);
					if($err)
					{
						$this->result["errors"][$prefix."p".$row["id"]] = $err;
					}
					else
					{
						$images = $this->diafan->_images->get('large', $id, $table, 0, '', $row["id"]);
						$this->result["images"][$prefix."images".$row["id"]] = $this->diafan->_tpl->get('images', $this->diafan->current_module, array("rows" => $images, "prefix" => $prefix, "param_id" => $row["id"]));
					}
				}
			}

			if (empty($_POST[$prefix."p" . $row["id"]]))
				continue;

			if ($row["type"] == "multiple")
			{
				DB::query("DELETE FROM {".$table."_param_".$rel."} WHERE param_id=%d AND ".$rel."_id=%d", $row["id"], $id);
				foreach ($_POST[$prefix."p" . $row["id"]] as $val)
				{
					DB::query("INSERT INTO {".$table."_param_".$rel."} (value, param_id, ".$rel."_id) VALUES ('%h', '%d', '%d')", $val, $row["id"], $id);
				}
			}
			elseif ($row_id = DB::query_result("SELECT id FROM {".$table."_param_".$rel."} WHERE param_id=%d AND ".$rel."_id=%d LIMIT 1", $row["id"], $id))
			{
				if ($row["type"] == "date")
				{
					$_POST[$prefix."p".$row["id"]] = $this->diafan->formate_in_date($_POST[$prefix."p".$row["id"]]);
				}
				elseif ($row["type"] == "datetime")
				{
					$_POST[$prefix."p".$row["id"]] = $this->diafan->formate_in_datetime($_POST[$prefix."p".$row["id"]]);
				}
				DB::query("UPDATE {".$table."_param_".$rel."} SET value='%h' WHERE id=%d", $_POST[$prefix."p" . $row["id"]], $row_id);
			}
			else
			{
				DB::query("INSERT INTO {".$table."_param_".$rel."} (value, param_id, ".$rel."_id) VALUES ('%h', %d, %d)", $_POST[$prefix."p" . $row["id"]], $row["id"], $id);
			}
			$no_empty_param_ids[] = $row["id"];
		}
		DB::query("DELETE FROM {".$table."_param_".$rel."} WHERE ".$rel."_id=%d".($no_empty_param_ids ? " AND param_id NOT IN (".implode(",", $no_empty_param_ids).")" : ''), $id);
	}

	/**
	 * Проверка e-mail на валидность
	 *
	 * @param string $email e-mail
	 * @param string $field название поля в массиве $_POST
	 * @return boolean
	 */
	protected function valid_email($email, $field)
	{
		if ($email)
		{
			Customization::inc('includes/validate.php');
			$mes = Validate::mail($email);
			if ($mes)
			{
				$this->result["errors"][$field] = $this->diafan->_($mes, false);
				return true;
			}
		}
		
		return false;
	}
}