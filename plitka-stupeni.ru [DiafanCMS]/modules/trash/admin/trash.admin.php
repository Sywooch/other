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
 * Trash_admin
 *
 * Корзина с удаленными элементами
 */
class Trash_admin extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'trash'; 

	/**
	 * @var array настройки отображения
	 */
	public $config = array(
		'del',	//удалить
		'datetime',	//показывать дату и время в списке
		'parent', //содержит вложенности
	);

	/**
	 * @var array текст для ссылки на редактирование в списке
	 */
	public $text_for_base_link = array();

	/**
	 * @var array список дополнительных полей, выводимых в списке
	 */
	public $config_other_row = array(
		'element_id' => 'function',
		'module_name' => 'none',
		'table_name' => 'function',
		'user_id' => 'function',
	);

	/**
	 * @var array дополнительные групповые операции
	 */
	public $group_action = array(
		"restore" => array('name' => "Восстановить")
	);

	/**
	 * @var array локальный кэш модуля
	 */
	private $cache;

	/**
	 * Выводит список удаленных в коризун элементов
	 * @return void
	 */
	public function show()
	{
		$this->diafan->list_row();

		if (! $this->diafan->count)
		{
			echo '<p><b>'.$this->diafan->_('Корзина пуста.').'</b><br>'.$this->diafan->_('Удаленных элементов сайта нет.').'</p>';
		}
	}

	/**
	 * Фильтр вывода
	 *
	 * @return void
	 */
	public function show_module_contents()
	{
		if ($this->diafan->count)
		{
			echo '<p>
			<form action="" method="post">
			<input name="action" type="hidden" value="delete">
			<input name="all" type="hidden" value="true">
			<input name="check_hash_user" type="hidden" value="'.$this->diafan->_user->get_hash().'">
			<input type="submit" class="button" value="'.$this->diafan->_('Очистить корзину').'">
			</form>
			</p>';
		}
	}

	/**
	 * Проверяет можно ли удалить текущий элемент строки
	 *
	 * @param array $row информация о текущем элменте списка
	 * @return boolean
	 */
	public function check_delete($row)
	{
		// нельзя удалить из корзины элемент, который удален по взаимосвязи с другим
		if($row["parent_id"])
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	/**
	 * Восстанавливает элементы из корзины
	 * @return void
	 */
	public function restore()
	{
		// Прошел ли пользователь проверку идентификационного хэша
		if (! $this->diafan->_user->checked)
		{
			$this->diafan->redirect(URL);
			return;
		}

		if (! empty($_POST["id"]))
		{
			$ids = array($_POST["id"]);
		}
		else
		{
			$ids = $_POST["ids"];
		}
		foreach ($ids as $id)
		{
			$id = intval($id);
			$this->restore_id($id);
		}

		include_once ABSOLUTE_PATH.'plugins/json.php';
		$result["redirect"] = URL;
		echo to_json($result);
	}

	/**
	 * Восстанавливает элемент из корзины
	 * 
	 * @param integer $id номер восстанавливаемого элемента
	 * @return void
	 */
	private function restore_id($id)
	{
		$row = DB::fetch_array(DB::query("SELECT table_name, element_id, module_name, id FROM {trash} WHERE id=%d LIMIT 1", $id));

		if (! $row)
		{
			return;
		}

		//проверка прав пользователя на удаление
		if (! $this->diafan->_user->roles('del', $row["module_name"]))
		{
			return;
		}
		$this->diafan->_cache->delete('', $row["module_name"]);

		$this->restore_elements($row["table_name"], $row["element_id"], $row["id"]);
	}

	/**
	 * Восстанавливает связанные элементы из корзины
	 *
	 * @param string $table название таблицы
	 * @param integer $id номер восстанавливаемого элемента
	 * @param integer $trash_id номер записи в корзине
	 * @return void
	 */
	private function restore_elements($table, $id, $trash_id)
	{
		DB::query("UPDATE {".$table."} SET trash='0' WHERE id=%d", $id);
		DB::query("DELETE FROM {trash} WHERE id=%d", $trash_id);
		DB::query("DELETE FROM {trash_parents} WHERE parent_id=%d AND element_id=%d", $trash_id, $trash_id);

		$result = DB::query("SELECT element_id, table_name,id FROM {trash} WHERE parent_id=%d", $trash_id);

		while ($row = DB::fetch_array($result))
		{
			$this->restore_elements($row["table_name"], $row["element_id"], $row["id"]);
		}
		if (strpos($table, '_parents') === false)
		{
			$del_row = DB::fetch_array(DB::query("SELECT * FROM {".$table."} WHERE id=%d LIMIT 1", $id));
			if (! empty($del_row["parent_id"]))
			{
				$count = DB::query_result("SELECT COUNT(*) FROM {".$table."} WHERE trash='0' AND parent_id=%d", $del_row["parent_id"]);
				DB::query("UPDATE {".$table."} SET count_children=%d WHERE id=%d", $count, $del_row["parent_id"]);
			}
		}
		$this->include_modules('restore_from_trash', $table, $id, 0);
	}

	/**
	 * Удаляет элемент или элементы из корзины
	 * @return void
	 */
	public function del()
	{
		// Прошел ли пользователь проверку идентификационного хэша
		if (! $this->diafan->_user->checked)
		{
			$this->diafan->redirect(URL);
			return;
		}
		// очистка корзины
		if(! empty($_POST["all"]))
		{
			$result = DB::query("SELECT table_name, element_id, id FROM {trash} WHERE parent_id=0");
			while($row = DB::fetch_array($result))
			{
				$this->diafan->del_from_trash($row["table_name"], $row["element_id"], $row["id"]);
			}
			$this->diafan->redirect(URL.'success1/');
		}

		if (! empty($_POST["id"]))
		{
			$ids = array($_POST["id"]);
		}
		else
		{
			$ids = $_POST["ids"];
		}
		foreach ($ids as $id)
		{
			$id = intval($id);
			$this->del_id($id);
		}

		include_once ABSOLUTE_PATH.'plugins/json.php';
		$result["redirect"] = URL;
		echo to_json($result);
	}

	/**
	 * Удаляет элемент из корзины
	 * 
	 * @param integer $id номер удаляемого элемента
	 * @return void
	 */
	private function del_id($id)
	{
		$row = DB::fetch_array(DB::query("SELECT table_name, element_id, id FROM {trash} WHERE id=%d LIMIT 1", $id));

		if (! $row)
		{
			return;
		}
		$this->diafan->del_from_trash($row["table_name"], $row["element_id"], $row["id"]);
	}

	/**
	 * Выводит название удаленного объекта в списке
	 * @return string
	 */
	public function other_row_element_id($row)
	{
		$data = '<td>';
		switch($row["table_name"])
		{
			case "images":
				$image_row = DB::fetch_array(DB::query("SELECT name, module_name FROM {".$row["table_name"]."} WHERE id=%d LIMIT 1", $row["element_id"]));

				if ($image_row && file_exists(ABSOLUTE_PATH.USERFILES."/".$image_row["module_name"]."/small/".$image_row["name"]))
				{
					$data .= '<img src="http://'.BASE_URL.'/'.USERFILES.'/'.$image_row["module_name"]."/small/".$image_row["name"].'" border="0">';
				}
				break;

			case "users":
				$user = DB::fetch_array(DB::query("SELECT fio, name FROM {".$row["table_name"]."} WHERE id=%d LIMIT 1", $row["element_id"]));
				$data .= $user["fio"].' ('.$user["name"].')';
				break;

			case "tags":
				$text = DB::query_result("SELECT [name] FROM {tags_name} WHERE id IN ("
							." SELECT tags_name_id FROM {".$row["table_name"]."} WHERE id=%d) LIMIT 1", $row["element_id"]);
				$data .= ($text ? $this->diafan->short_text($text) : $row["element_id"]);
				break;

			case "rating":
				$rating = DB::query_result("SELECT rating FROM {".$row["table_name"]."} WHERE id=%d LIMIT 1", $row["element_id"]);
				$data .= ($rating ? $rating : $row["element_id"]);
				break;

			case "feedback":
				$data .= $this->diafan->_('Сообщение из формы обратной связи');
				break;

			case "feedback_param_element":
				$param = DB::fetch_array(DB::query("SELECT param_id, value FROM {".$row["table_name"]."} WHERE id=%d LIMIT 1", $row["element_id"]));
				$param_name = DB::query_result("SELECT [name] FROM {feedback_param} WHERE id=%d LIMIT 1", $param["param_id"]);
				$data .= $param_name.': '.$param["value"];
				break;

			case "shop_order":
				$data .= $this->diafan->_('Заказ №').' '.$row["element_id"];
				break;

			case "shop_discount":
				$discount = DB::query_result("SELECT discount FROM {shop_discount} WHERE id=%d LIMIT 1", $row["element_id"]);
				$data .= $this->diafan->_('Скидка').' '.$discount.'%';
				break;

			case "shop_rel":
				$data .= $this->diafan->_('Связи между товарами');
				break;

			case "shop_param_element":
				$param = DB::fetch_array(DB::query("SELECT param_id, value FROM {".$row["table_name"]."} WHERE id=%d LIMIT 1", $row["element_id"]));
				$param_name = DB::query_result("SELECT [name] FROM {shop_param} WHERE id=%d LIMIT 1", $param["param_id"]);
				$data .= $param_name.': '.$param["value"];
				break;

			case "rewrite":
				$data .= $this->diafan->_('Псевдоссылка');
				break;

			default:
				$element = DB::fetch_array(DB::query("SELECT * FROM {".$row["table_name"]."} WHERE id=%d LIMIT 1", $row["element_id"]));
				$name = $row["element_id"];
				if (! empty($element["name"]))
				{
					$name = $element["name"];
				}
				elseif (! empty($element["name"._LANG]))
				{
					$name = $element["name"._LANG];
				}
				elseif (! empty($element["text"]))
				{
					$name = $this->diafan->short_text($element["text"], 50);
				}
				elseif (! empty($element["text"._LANG]))
				{
					$name = $this->diafan->short_text($element["text"._LANG], 50);
				}
				if ($row["table_name"] == "shop_price")
				{
					return $element["price"].' '.$this->diafan->configmodules("currency", "shop");
				}
				elseif (strpos($row["table_name"], '_parents') !== false)
				{
					$name = $this->diafan->_('Родительские связи');
				}
				elseif (strpos($row["table_name"], '_category_rel') !== false)
				{
					$name = $this->diafan->_('Связи с категориями');
				}
				$data .= $name;
		}
		return $data.'</td>';
	}

	/**
	 * Выводит название модуля удаленного объекта в списке
	 * @return string
	 */
	public function other_row_table_name($row)
	{
		$name_array = explode('_', $row["table_name"]);
		foreach ($name_array as $n)
		{
			if(! isset($this->cache["module"][$n]))
			{
				$this->cache["module"][$n] = DB::query_result("SELECT title FROM {modules} WHERE name='%h' LIMIT 1", $n);
			}
			if($this->cache["module"][$n])
			{
				$name[] = $this->cache["module"][$n];
			}
		}
		if (! empty($name))
		{
			$name = implode(', ', $name);
		}
		else
		{
			$name = $row["table_name"];
		}
		return '</td><td>'.$name
		.'</td><td class="restore-action">'.(! $row["parent_id"] ? '<a href="javascript:void(0);" action="restore">'.$this->diafan->_('Восстановить').'</a>':'');
	}

	/**
	 * Выводит имя пользователя, удалившего элемент
	 * @return string
	 */
	public function other_row_user_id($row)
	{
		return '</td><td>'
		.(! $row["parent_id"] && $row["user_id"] ? '<a href="'.BASE_PATH_HREF.'users/edit'.$row["user_id"].'/">'.DB::title("users", $row["user_id"], "fio").'</a>':'');
	}
}