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
 * Del_admin
 *
 * Удаление элемента
 */
class Del_admin extends Diafan
{
	/**
	 * @var array список модулей, подключаемый при удалении элемента или категории
	 */
	private $include_modules = array ();

	/**
	 * @var array локальный кэш файла
	 */
	private $cache;

	/**
	 * Удаляет элемент
	 *
	 * @return void
	 */
	public function del()
	{
		// Прошел ли пользователь проверку идентификационного хэша
		if (!$this->diafan->_user->checked)
		{
			echo "{error:'HASH'}";
			return;
		}

		//проверка прав пользователя на удаление
		if (! $this->diafan->_user->roles('del', $this->diafan->rewrite))
		{
			echo "{error:'ROLES'}";
			return;
		}

		$redirect = URL;

		if (!empty( $_POST["id"] ))
		{
			$ids = array ( $_POST["id"] );
			if ($this->diafan->config("parent"))
			{
				$parent_id = DB::query_result("SELECT parent_id FROM {".$this->diafan->table."} WHERE id=%d LIMIT 1", $_POST["id"]);
				if($parent_id && $this->diafan->parent != $parent_id)
				{
					$redirect = str_replace('parent'.$this->diafan->parent.'/', '', $redirect).'parent'.$parent_id.'/';
				}
			}
		}
		else
		{
			$ids = $_POST["ids"];
		}
		//тип данных - категория
		if ($this->diafan->config("category"))
		{
			foreach ($ids as $id)
			{
				$this->del_category($this->diafan->table, intval($id));
			}
		}
		//тип данных - элемент
		else
		{
			//поиск элементов колекции и добавление их в массив удаляемых
			$result_query = DB::query("SELECT rel_element_id FROM {".$this->diafan->table."_rel} WHERE element_id IN (".implode(',', $ids).")");
			while($row = DB::fetch_array($result_query))
			{
				array_push($ids,$row['rel_element_id']);
			}
			foreach ($ids as $id)
			{
				$this->del_element($this->diafan->table, intval($id));
			}
		}
		if ($_POST["action"] == "trash")
		{
			$result_q = DB::query("SELECT id, count_children FROM {trash}");
			while ($row = DB::fetch_array($result_q))
			{
				$count = DB::query_result("SELECT COUNT(*) FROM {trash_parents} WHERE parent_id=%d LIMIT 1", $row["id"]);
				if($row["count_children"] != $count)
				{
					DB::query("UPDATE {trash} SET count_children=%d WHERE id=%d", $count, $row["id"]);
				}
			}
		}
		$this->diafan->_cache->delete("", $this->diafan->module);

		include_once ABSOLUTE_PATH . 'plugins/json.php';
		$result["redirect"] = $redirect;
		echo to_json($result);
	}

	/**
	 * Удаляет категорию
	 *
	 * @param string $table название таблицы
	 * @param integer $del_id номер удаляемой записи
	 * @param integer $trash_pid номер записи в корзине, с которой связано удаление
	 * @return void
	 */
	private function del_category($table, $del_id, $trash_pid = 0)
	{
		$del_row = DB::fetch_array(DB::query("SELECT * FROM {" . $table . "} WHERE id=%d LIMIT 1", $del_id));

		$trash_id = $this->del_or_trash($table, $del_id, $trash_pid);

		$this->diafan->_cache->delete("", $this->diafan->module);

		$this->del_or_trash_where("rewrite", "cat_id='" . $del_id . "' AND module_name='" . str_replace('_category', '', $table) . "'", $trash_id);
		$this->del_or_trash_where("access", "cat_id='" . $del_id . "' AND module_name='" . str_replace('_category', '', $table) . "'", $trash_id);
		$this->include_modules('delete', $table, $del_id, $trash_id, true);

		// функция удаления, описанная в модуле
		$this->diafan->delete($del_id, $trash_id);

		if (isset( $del_row["parent_id"] ))
		{
			$this->del_or_trash_where($table . "_parents", "element_id='" . $del_id . "'", $trash_id);

			$result = DB::query("SELECT id FROM {" . $table . "} WHERE parent_id=%d", $del_id);

			while ($row = DB::fetch_array($result))
			{
				$this->del_category($table, $row["id"], $trash_id);
			}
			if (!$trash_pid && $del_row["parent_id"])
			{
				$count = DB::query_result("SELECT COUNT(*) FROM {" . $table . "} WHERE trash='0' AND parent_id=%d LIMIT 1", $del_row["parent_id"]);
				DB::query("UPDATE {" . $table . "} SET count_children=%d WHERE id=%d", $count, $del_row["parent_id"]);
			}
		}

		$table = str_replace("_category", '', $table);
		$result = DB::query("SELECT id FROM {" . $table . "} WHERE cat_id=%d", $del_id);

		while ($row = DB::fetch_array($result))
		{
			$this->del_element($table, $row["id"], $trash_id);
		}

		if ($this->diafan->config("category_rel"))
		{
			$this->del_or_trash_where($table . "_category_rel", "cat_id='" . $del_id . "'", $trash_id);
		}
	}

	/**
	 * Удаляет элементы в категории
	 *
	 * @param string $table название таблицы
	 * @param integer $del_id номер удаляемой записи
	 * @param integer $trash_pid номер записи в корзине, с которой связано удаление
	 * @return void
	 */
	private function del_element($table, $del_id, $trash_pid = 0)
	{
		$del_row = DB::fetch_array(DB::query("SELECT * FROM {" . $table . "} WHERE id=%d LIMIT 1", $del_id));

		$trash_id = $this->del_or_trash($table, $del_id, $trash_pid);

		if ($table == "site")
		{
			$this->del_or_trash_where("rewrite", "site_id='" . $del_id . "' AND module_name='" . $table . "'", $trash_id);
		}
		else
		{
			$this->del_or_trash_where("rewrite", "element_id='" . $del_id . "' AND module_name='" . $table . "'", $trash_id);
		}
		$this->del_or_trash_where("access", "element_id='" . $del_id . "' AND module_name='" . $table . "'", $trash_id);

		$this->include_modules('delete', $table, $del_id, $trash_id);

		//если это удаление элементов из удаляемой категории
		if ($this->diafan->config("category"))
		{
			if(! isset($this->cache["class_element"]))
			{
				Customization::inc('modules/'.$this->diafan->module.'/admin/'.$this->diafan->module.'.admin.php');
				$module_class = ucfirst($this->diafan->module).'_admin';
				$this->cache["class_element"] = new $module_class($this->diafan);
			}
			if(is_callable(array($this->cache["class_element"], 'delete')))
			{
				call_user_func_array(array($this->cache["class_element"], 'delete'), array($del_id, $trash_id));
			}
		}
		// если удаляем неспосредственно сам элемент
		else
		{
			// функция удаления, описанная в модуле
			$this->diafan->delete($del_id, $trash_id);

			// удаляет значения списка для полей конструктора
			if($this->diafan->is_variable("param_select"))
			{
				$this->del_or_trash_where($table."_element", "param_id=".$del_id, $trash_id);
				$this->del_or_trash_where($table."_select",  "param_id=".$del_id, $trash_id);
				$this->del_or_trash_where("images",  "module_name='".$this->diafan->module."' AND param_id=".$del_id, $trash_id);
			}
		}

		if (isset( $del_row["parent_id"] ))
		{
			$this->del_or_trash_where($table . "_parents", "element_id='" . $del_id . "'", $trash_id);

			$result = DB::query("SELECT id FROM {" . $table . "} WHERE parent_id=%d", $del_id);

			while ($row = DB::fetch_array($result))
			{
				$this->del_element($table, $row["id"], $trash_id);
			}
			if ($del_row["parent_id"])
			{
				$count = DB::query_result("SELECT COUNT(*) FROM {" . $table . "} WHERE trash='0' AND parent_id=%d LIMIT 1", $del_row["parent_id"]);
				DB::query("UPDATE {" . $table . "} SET count_children=%d WHERE trash='0' AND id=%d", $count, $del_row["parent_id"]);
			}
		}

		if (isset( $del_row["cat_id"] ) && ( $this->diafan->config("category_rel") || $this->diafan->config("element_multiple") ))
		{
			$this->diafan->del_or_trash_where($table . "_category_rel", "element_id='" . $del_id . "'", $trash_id);
		}
	}

	/**
	 * Помечает строку на удаление или удаляет строку из базы данных
	 *
	 * @param string $table название таблицы
	 * @param integer $del_id номер удаляемой записи
	 * @param integer $trash_id номер записи в корзине, с которой связано удаление
	 * @return integer|boolean true
	 */
	public function del_or_trash($table, $del_id, $trash_id)
	{
		if ($_POST["action"] == "trash")
		{
			DB::query("UPDATE {" . $table . "} SET trash='1' WHERE id=%d", $del_id);
			DB::query("INSERT INTO {trash} (table_name, module_name, element_id, created, parent_id, user_id) VALUES ('%s', '%s', '%d', '%d', '%d', '%d')", $table, $this->diafan->module, $del_id, time(), $trash_id, $this->diafan->_user->id);
			$parents = $this->diafan->get_parents($trash_id, "trash");
			if ($trash_id)
			{
				$parents[] = $trash_id;
			}
			$id = DB::last_id("trash");
			foreach ($parents as $parent_id)
			{
				DB::query("INSERT INTO {trash_parents} (`element_id`, `parent_id`) VALUES (%d, %d)", $id, $parent_id);
			}
			return $id;
		}
		else
		{
			$trash_id = DB::query_result("SELECT id FROM {trash} WHERE element_id=%d AND table_name='%s' LIMIT 1", $del_id, $table);
			DB::query("DELETE FROM {trash} WHERE id=%d", $trash_id);
			DB::query("DELETE FROM {trash_parents} WHERE parent_id=%d OR element_id=%d", $trash_id, $trash_id);
			DB::query("DELETE FROM {" . $table . "} WHERE id=%d", $del_id);
		}
		return true;
	}

	/**
	 * Помечает строки на удаление или удаляет строки из базы данных
	 *
	 * @param string $table название таблицы
	 * @param string $del_where SQL-условие для удаление записей в базе данных
	 * @param integer $trash_id номер записи в корзине, с которой связано удаление
	 * @return void
	 */
	public function del_or_trash_where($table, $del_where, $trash_id)
	{
		if ($_POST["action"] == "trash")
		{
			$result = DB::query("SELECT * FROM {" . $table . "} WHERE " . $del_where . " AND trash='0'");
			$parents = $this->diafan->get_parents($trash_id, "trash");
			if ($trash_id)
			{
				$parents[] = $trash_id;
			}
			while ($row = DB::fetch_array($result))
			{
				DB::query("INSERT INTO {trash} (table_name, module_name, element_id, created, parent_id, user_id) VALUES ('%s', '%s', '%d', '%d', '%d', '%d')", $table, $table, $row["id"], time(), $trash_id, $this->diafan->_user->id);
				$id = DB::last_id("trash");
				foreach ($parents as $parent_id)
				{
					DB::query("INSERT INTO {trash_parents} (`element_id`, `parent_id`) VALUES (%d, %d)", $id, $parent_id);
				}
			}
			DB::query("UPDATE {" . $table . "} SET trash='1' WHERE " . $del_where);

		}
		else
		{
			$del_ids = DB::query_result("SELECT GROUP_CONCAT(id SEPARATOR ',') FROM {" . $table . "} WHERE " . $del_where);
			if($del_ids)
			{
				$trash_id = DB::query("SELECT id FROM {trash} WHERE element_id IN (%s) AND table=%h", $del_ids, $table);
				DB::query("DELETE FROM {trash} WHERE id=%d", $trash_id);
				DB::query("DELETE FROM {trash_parents} WHERE parent_id=%d OR element_id=%d", $trash_id, $trash_id);
				DB::query("DELETE FROM {" . $table . "} WHERE " . $del_where);
			}
		}
	}

	/**
	 * Подключает удаление информации, описанной в модуле
	 *
	 * @param string $method название метода
	 * @param string $table название таблицы
	 * @param integer $del_id номер удаляемого элемента
	 * @param integer $trash_id номер записи в корзине, с которой связано удаление
	 * @param boolean $is_category удаляемый элемент - категория
	 * @return void
	 */
	public function include_modules($method, $table, $del_id, $trash_id, $is_category = false)
	{
		if (empty($this->include_modules))
		{
			if (! $dirr = opendir(ABSOLUTE_PATH.'modules'))
			{
				throw new Exception('Папка '.ABSOLUTE_PATH.'modules не существует.');
			}
			while (( $module = readdir($dirr) ) !== false)
			{
				if (file_exists(ABSOLUTE_PATH . 'modules/' . $module . '/admin/' . $module . '.admin.inc.php'))
				{
					include_once ABSOLUTE_PATH . 'modules/' . $module . '/admin/' . $module . '.admin.inc.php';
					$class = ucfirst($module) . '_admin_inc';
					if (method_exists($class, $method))
					{
						$this->include_modules[$class] = new $class($this->diafan);
					}
				}
			}
		}
		foreach ($this->include_modules as $class => $func)
		{
			call_user_func_array (array(&$this->include_modules[$class], $method), array(str_replace('_category', '', $table), $del_id, $trash_id, $is_category));
		}
	}

	/**
	 * Удаляет элементы из корзины
	 *
	 * @param string $table название таблицы
	 * @param integer $id номер удаляемого элемента
	 * @param integer $trash_id номер записи в корзине, с которой связано удаление
	 * @return void
	 */
	public function del_from_trash($table, $id, $trash_id)
	{
		list($module) = explode('_', $table);
		if (file_exists(ABSOLUTE_PATH.'modules/'.$module.'/admin/'.$module.'.admin.inc.php'))
		{
			include_once ABSOLUTE_PATH.'modules/'.$module.'/admin/'.$module.'.admin.inc.php';
			$func = 'del_from_trash';
			$class = ucfirst($module) . '_admin_inc';
			if (method_exists($class, $func))
			{
				$class_admin_inc = new $class($this->diafan);
				$class_admin_inc->del_from_trash($id, $table);
			}
		}
		DB::query("DELETE FROM {trash} WHERE id=%d", $trash_id);
		DB::query("DELETE FROM {" . $table . "} WHERE id=%d", $id);
		DB::query("DELETE FROM {trash_parents} WHERE parent_id=%d OR element_id=%d", $trash_id, $trash_id);

		$result = DB::query("SELECT element_id, table_name, id FROM {trash} WHERE parent_id=%d", $trash_id);
		while ($row = DB::fetch_array($result))
		{
			$this->diafan->del_from_trash($row["table_name"], $row["element_id"], $row["id"]);
		}
	}
}
