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
	include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

/**
 * Save_admin
 *
 * Сохранение элемента
 */
class Save_admin extends Diafan
{
	/**
	 * @var Save_functions_admin функции сохранения полей
	 */
	public $_functions;

	/**
	 * @var array массив полей таблицы для SQL-запроса на обновление
	 */
	public $query;

	/**
	 * @var array массив новых значений для SQL-запроса на обновление
	 */
	public $value;

	/**
	 * @var array массив старых значений обновляемых полей
	 */
	public $oldrow;

	/**
	 * @var integer номер страницы, к которому прикреплен сохраняемый элемент
	 */
	public $save_site_id;

	/**
	 * @var integer номер родителя, к которому прикреплен сохраняемый элемент
	 */
	public $save_parent_id;

	/**
	 * @var integer номер каталога, к которому прикреплен сохраняемый элемент
	 */
	public $save_cat_id;

	/**
	 * @var integer номер сортировки сохраняемого элемента
	 */
	public $save_sort;

	/**
	 * @var string псевдоссылка сохранена
	 */
	public $is_save_rewrite = false;

	/**
	 * Вызывает функции сохранения полей
	 *
	 * @return mixed
	 */
	public function __call($name, $arguments)
	{
		if(! $this->_functions)
		{
			Customization::inc("adm/includes/save_functions.php");
			$this->_functions = new Save_functions_admin($this->diafan);
		}

		if (is_callable(array(&$this->_functions, $name)))
		{
			return call_user_func_array(array(&$this->_functions, $name), $arguments);
		}
		else
		{
			return 'fail_function';
		}
	}

	/**
	 * Добавляет элемент в базу данных
	 *
	 * @return boolean
	 */
	public function save_new()
	{
		// Проверяет права на редактирование
		if (! $this->diafan->_user->roles('edit', $this->diafan->rewrite))
		{
			include(ABSOLUTE_PATH.'includes/404.php');
		}

		// Прошел ли пользователь проверку идентификационного хэша
		if (! $this->diafan->_user->checked)
		{
			$this->diafan->redirect(URL);
			return false;
		}

		// Проверяет, пришел ли запрос из формы добавления/редактирования
		if (empty( $_POST["save_post"] ))
		{
			$this->diafan->redirect(URL);
			return false;
		}

		$def = array ();
		if ($this->diafan->config("parent"))
		{
			$def['parent_id'] = "'" . $this->diafan->parent . "'";
		}
		if ($this->diafan->config("element_site"))
		{
			$def['site_id'] = "'" . $this->diafan->get_param($_POST, "site_id", 0, 2) . "'";
		}
		if ($this->diafan->config("element"))
		{
			$def['cat_id'] = "'" . $this->diafan->get_param($_POST, "cat_id", 0, 2) . "'";
		}

		DB::query("INSERT INTO {" . $this->diafan->table . "} (" . implode(',', array_keys($def)) . ") VALUES (" . implode(',', $def) . ")");

		$this->diafan->save = DB::last_id($this->diafan->table);

		if (! $this->diafan->save)
		{
			throw new Exception('Не удалось добавить новый элемент в базу данных. Возможно, таблица '.DB_PREFIX.$this->diafan->table.' имеет неправильную структуру.');
		}

		$this->diafan->save();
	}

	/**
	 * Сохраняет изменения
	 *
	 * @return boolean
	 */
	public function save()
	{
		// Проверяет, пришел ли запрос из формы добавления/редактирования
		if (empty( $_POST["save_post"] ))
		{
			$this->diafan->redirect(URL);
			return false;
		}

		// Прошел ли пользователь проверку идентификационного хэша
		if (!$this->diafan->_user->checked)
		{
			$this->diafan->redirect(URL);
			return false;
		}

		// Проверка прав на сохранение
		if (! $this->diafan->_user->roles('edit', $this->diafan->rewrite))
		{
			$this->diafan->redirect(URL);
			return false;
		}

		// Массив $this->diafan->oldrow содержит прежние значения полей для сохраняемого элемента
		if (! $this->diafan->config("config"))
		{
			$this->diafan->oldrow = DB::fetch_array(DB::query("SELECT * FROM {" . $this->diafan->table . "} WHERE id = %d" . ( $this->diafan->config("trash") ? " AND trash='0'" : '' )." LIMIT 1", $this->diafan->save));
			if (!$this->diafan->oldrow)
			{
				include_once ABSOLUTE_PATH.'includes/404.php';
			}
		}

		// Если отмечена галочка "Видеть только свои материалы", то редактирование чужих материалов запрещено
		if($this->diafan->config("only_self") && ! empty($this->diafan->oldrow["admin_id"])
		   && $this->diafan->oldrow["admin_id"] != $this->diafan->_user->id
		   && DB::query_result("SELECT only_self FROM {users_role} WHERE id=%d LIMIT 1", $this->diafan->_user->role_id))
		{
			include_once ABSOLUTE_PATH.'includes/404.php';
		}

		// Подготовка значений полей для элемента в соответсвии с указанными типами

		foreach ($this->diafan->variables as $title => $variable_table)
		{
			$this->prepare_new_values($variable_table);
		}

		// Сохраняет конфигурацию модуля
		if ($this->diafan->config("config"))
		{
			for ($q = 0; $q < count($this->value); $q++)
			{
				$this->value[$q] = str_replace("\n", '', $this->value[$q]);
			}
			DB::query("DELETE FROM {config} WHERE module_name='%s' AND site_id=%d AND (lang_id=" . _LANG . " OR lang_id=0)", $this->diafan->module, $this->diafan->site);
			for ($q = 0; $q < count($this->value); $q++)
			{
				list( $name, $mask ) = explode('=', $this->query[$q]);
				$name = str_replace('`', '', $name);

				// записываем значение в конфигурацю если оно не пустое или если конфигурация сохраняется для раздела и оно отличается от основной конфигурации
				if (!$this->diafan->site && $this->value[$q] || $this->diafan->site && DB::query_result("SELECT value FROM {config} WHERE module_name='%s' AND site_id=0 AND name='%h'" . ($this->diafan->variable_multilang($name) ? " AND lang_id='" . _LANG . "'" : '' )." LIMIT 1", $this->diafan->module, $name) != $this->value[$q])
				{
					DB::query("INSERT INTO {config} (name, module_name, value, site_id, lang_id) VALUES ('%h', '%h', " . $mask . ", '%d', '%d')", $name, $this->diafan->module, $this->value[$q], $this->diafan->site, $this->diafan->variable_multilang($name) ? _LANG : 0);
				}
			}
			$this->diafan->done = 1;

			// Удаляет кэш конфигурации модулей
			$this->diafan->_cache->delete("configmodules", "site");
		}
		// Сохраняет элемент
		else
		{
			//if(in_array($this->query))
			if (!DB::query("UPDATE {" . $this->diafan->table . "} SET " . implode(', ', $this->query) . " WHERE id = %d", array_merge($this->value, array ( $this->diafan->save ))))
			{
				return false;
			}
		}
		// Удаляет кэш модуля
		$this->diafan->_cache->delete("", $this->diafan->module);

		$this->diafan->save_redirect();
		return true;
	}

	/**
	 * Запоминает имя переменной для сохранения
	 *
	 * @return void
	 */
	public function set_value($value)
	{
		$this->value[] = $value;
	}

	/**
	 * Запоминает значение переменной для сохранения
	 *
	 * @return void
	 */
	public function set_query($query)
	{
		$this->query[] = $query;
	}

	/**
	 * Подготавливает новые значения для сохранения
	 *
	 * @return boolean true
	 */
	private function prepare_new_values($variable_table)
	{
		foreach ($variable_table as $key => $type_value)
		{
			if(is_array($type_value))
			{
				if(! empty( $type_value["disabled"]))
				{
					continue;
				}
				if(! empty( $type_value["no_save"]))
				{
					continue;
				}
				$type_value = $type_value["type"];
			}
			else
			{
				$type_value = $type_value;
			}

			$name = $key . ( ! $this->diafan->config("config") && $this->diafan->variable_multilang($key) ? _LANG : '' );
			$func = 'save'. ( $this->diafan->config("config") ? '_config' : '' ).'_variable_' . str_replace('-', '_', $key);
			if (call_user_func_array (array(&$this->diafan, $func), array()) !== 'fail_function')
			{
				continue;
			}
			if ($type_value == 'module')
			{
				if (file_exists(ABSOLUTE_PATH . 'modules/' . $key . '/admin/' . $key . '.admin.inc.php'))
				{
					Customization::inc('modules/' . $key . '/admin/' . $key . '.admin.inc.php');
					$func = 'save' . ( $this->diafan->config("config") ? '_config' : '' );
					$class = ucfirst($key) . '_admin_inc';
					if (method_exists($class, $func))
					{
						$module_class = new $class($this->diafan);
						call_user_func_array (array(&$module_class, $func), array());
					}
				}
			}
			elseif ($type_value == 'date' || $type_value == 'datetime')
			{
				$this->query[] = $name . "='%d'";
				$this->value[] = $this->diafan->unixdate($_POST[$key]);
			}
			elseif ($type_value == 'hr')
			{
				continue;
			}
			elseif ($type_value == 'floattext')
			{
				$this->value[] = str_replace(',', '.', !empty( $_POST[$key] ) ? $_POST[$key] : 0);
				$this->query[] = $name . "='%f'";
			}
			elseif($type_value == 'editor')
			{
				$this->value[] = $this->diafan->save_field_editor($key);
				$this->query[] = $name . "='%s'";
			}
			else
			{
				$this->value[] = !empty( $_POST[$key] ) ? $_POST[$key] : '';

				if ($type_value == 'text' || $type_value == 'select' || $type_value == 'email')
				{
					$this->query[] = $name . "='%h'";
				}
				elseif ($type_value == 'checkbox' || $type_value == 'numtext')
				{
					$this->query[] = $name . "='%d'";
				}
				else //textarea,none,function,password...
				{
					$this->query[] = $name . "='%s'";
				}
			}
		}
	}

	/**
	 * Сохраняет поле с типом "Визуальный редактор"
	 *
	 * @param string $key название поля
	 * @return void
	 */
	public function save_field_editor($key)
	{
		$text = !empty( $_POST[$key] ) ? $_POST[$key] : '';
		// типограф
		if (!empty( $_POST[$key . "_typograf"] ))
		{
			include_once( ABSOLUTE_PATH . "plugins/remotetypograf.php" );

			$remoteTypograf = new RemoteTypograf();

			$remoteTypograf->htmlEntities();
			$remoteTypograf->br(false);
			$remoteTypograf->p(true);
			$remoteTypograf->nobr(3);
			$remoteTypograf->quotA('laquo raquo');
			$remoteTypograf->quotB('bdquo ldquo');

			$text = $remoteTypograf->processText($text);
		}
		// ссылки заменяем на id
		$text = $this->diafan->_route->replace_link_to_id($text);
		return $text;
	}

	/**
	 * Производит перенаправление на страницу редактирования, на список и пр.
	 *
	 * @return void
	 */
	public function save_redirect()
	{
		// если сохраняли Ajaxом, отдаем положительный результат
		if (! empty( $_SERVER["HTTP_X_REQUESTED_WITH"] ) && $_SERVER["HTTP_X_REQUESTED_WITH"] == 'XMLHttpRequest')
		{
			echo '{success:true}';
			exit;
		}

		$status = ($this->diafan->err ? 'error' . $this->diafan->err . '/' : '')
		.($this->diafan->done ? 'success' . $this->diafan->done . '/' : '');


		// Для модуля Языки сайта
		if ($this->diafan->table == "languages")
		{
			if (_LANG == $this->diafan->save)
			{
				$this->diafan->redirect(BASE_PATH.ADMIN_FOLDER . '/languages/'.$this->diafan->get_nav);
			}
			else
			{
				$this->diafan->redirect(URL.$status.$this->diafan->get_nav);
			}
		}

		$parent = '';
		if($this->diafan->save_parent_id)
		{
			$parent = 'parent'.$this->diafan->save_parent_id.'/';
		}

		$cat = '';
		if($this->diafan->save_cat_id)
		{
			$cat = 'cat'.$this->diafan->save_cat_id.'/';
		}

		switch ($_POST["save_redirect"])
		{
			case 'addnew':
				$this->diafan->redirect(URL .$cat. $parent . 'addnew1/'.$this->diafan->get_nav);
				return;

			case 'edit':
				if($this->diafan->config("only_edit"))
				{
					$this->diafan->redirect(URL .$cat. $parent . $status .$this->diafan->get_nav);
				}
				$this->diafan->redirect(URL .$cat. $parent . $status . 'edit' . $this->diafan->save . '/'.$this->diafan->get_nav);
				return;
		}

		// Если к странице прикреплен модуль, то редирект на модуль
		$module_name = !empty( $_POST["module_name"] ) ? preg_replace('/[^A-Za-z-]+/', '', $_POST["module_name"]) : '';
		if ($this->diafan->rewrite == "site" && $module_name && file_exists(ABSOLUTE_PATH . 'modules/' . $module_name . '/admin/' . $module_name . '.admin.php'))
		{
			$this->diafan->redirect(BASE_PATH_HREF . $module_name . '/site' . $this->diafan->save . '/' .$cat. $parent . $status.$this->diafan->get_nav);
			return;
		}

		if(DB::query_result("SELECT COUNT(*) FROM {%h} WHERE trash='0'", $this->diafan->table) > 10)
		{
			$ankor = '#'.$this->diafan->save;
		}

		// "Сохранить и выйти" - редирект на show_module
		$this->diafan->redirect(URL.$cat.$parent.$status.$this->diafan->get_nav.$ankor);
	}

	/**
	 * Обновляет значения для таблицы - соединения
	 *
	 * @param string $table название таблицы
	 * @param string $element_id_name название основного поля соединения
	 * @param string $rel_id_name название второго поля соединения
	 * @param array $rels передаваемы знанения второго поля
	 * @param integer $save_id значение основного поля
	 * @param integer $new (0, 1) является ли осноной элемент новым
	 * @return void
	 */
	public function update_table_rel($table, $element_id_name, $rel_id_name, $rels, $save_id, $new)
	{
		if($rels)
		{
			if(! $new)
			{
				$add = array();
				$del = array();
				$values = array();
				$result = DB::query("SELECT id, %s FROM {%s} WHERE %s=%d AND trash='0'", $rel_id_name, $table, $element_id_name, $save_id);
				while ($row = DB::fetch_array($result))
				{
					if(! in_array($row[$rel_id_name], $rels))
					{
						$del[] = $row["id"];
					}
					$values[] = $row[$rel_id_name];
				}
				foreach ($rels as $row)
				{
					if(! in_array($row, $values))
					{
						$add[] = $row;
					}
				}
				if($del)
				{
					DB::query("DELETE FROM {%s} WHERE id IN (%s)", $table, implode(",", $del));
				}
			}
			else
			{
				$add = $rels;
			}

			foreach ($add as $row)
			{
				DB::query("INSERT INTO {%s} (%s, %s) VALUES (%d, %d)", $table, $element_id_name, $rel_id_name, $save_id, $row);
			}
		}
		else
		{
			if(! $new)
			{
				DB::query("DELETE FROM {%s} WHERE %s=%d", $table, $element_id_name, $save_id);
			}
			DB::query("INSERT INTO {%s} (%s, %s) VALUES (%d, 0)", $table, $element_id_name, $rel_id_name, $save_id);
		}
	}
}