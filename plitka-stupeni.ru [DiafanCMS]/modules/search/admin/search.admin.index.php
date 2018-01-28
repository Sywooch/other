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
 * Search_admin_index
 *
 * Создание удаление поискового индекса
 */
class Search_admin_index extends Diafan
{
	/**
	 * @var array конфигурация поиска (module_name, table_name, element_id, elements_id, is_save, lang_id)
	 */
	public $config;

	/**
	 * @var array конфигурация поиска для индексируемой таблицы модуля
	 */
	private $search_config;

	/**
	 * Добавляет элементы в поисковый индекс
	 * 
	 * @return void
	 */
	public function add()
	{
		if(! $this->get_search_config())
			return;

		if(empty($this->config["lang_id"]))
		{
			foreach($this->diafan->languages as $lang)
			{
				$this->config["lang_id"] = $lang["id"];
				if(! empty($this->config["element_ids"]))
				{
					foreach($this->config["element_ids"] as $element_id)
					{
						$this->config["element_id"] = $element_id;
						$this->add_id();
					}
				}
				else
				{
					$this->add_id();
				}
			}
		}
		else
		{
			if(! empty($this->config["element_ids"]))
			{
				foreach($this->config["element_ids"] as $element_id)
				{
					$this->config["element_id"] = $element_id;
					$this->add_id();
				}
			}
			else
			{
				$this->add_id();
			}
		}
	}

	/**
	 * Удаляет элементы из поискового индекса
	 *
	 * @return void
	 */
	public function delete()
	{
		if(! $this->get_search_config())
			return;

		if(empty($this->config["lang_id"]))
		{
			foreach($this->diafan->languages as $lang)
			{
				$this->config["lang_id"] = $lang["id"];
				if(! empty($this->config["element_ids"]))
				{
					foreach($this->config["element_ids"] as $element_id)
					{
						$this->config["element_id"] = $element_id;
						$this->delete_id();
					}
				}
				else
				{
					$this->delete_id();
				}
			}
		}
		else
		{
			if(! empty($this->config["element_ids"]))
			{
				foreach($this->config["element_ids"] as $element_id)
				{
					$this->config["element_id"] = $element_id;
					$this->delete_id();
				}
			}
			else
			{
				$this->delete_id();
			}
		}
	}

	/**
	 * Добавляет один элемент в поисковый индекс
	 * 
	 * @return void
	 */
	private function add_id()
	{
		$this->get_url();
	
		if(! $this->check_edit())
			return;

		$this->delete_id();

		if(empty($this->config["is_save"]))
		{
			$row = DB::fetch_array(DB::query("SELECT * FROM {%s} WHERE id=%d LIMIT 1", $this->config["table_name"], $this->config["element_id"]));

			if(! empty($row["search_no_show"]))
			{
				return;
			}
		}
		$values_for_index = '';
		$snippet = '';
		if(! empty($this->config["is_save"]))
		{
			$name = $_POST[$this->search_config['name_field']];
			foreach($this->search_config['snippet_fields'] as $field)
			{
				if(! empty($_POST[$field]))
				{
					$snippet .= ' '.$_POST[$field];
				}
			}
			foreach($this->search_config['fields'] as $field)
			{
				if(! empty($_POST[$field]))
				{
					$values_for_index .= ' '.$_POST[$field];
				}
			}
		}
		else
		{
			$name = $row[$this->search_config['name_field'].$this->config["lang_id"]];
			foreach($this->search_config['snippet_fields'] as $field)
			{
				if(isset($row[$field.$this->config["lang_id"]]))
				{
					$val = $row[$field.$this->config["lang_id"]];
				}
				else
				{
					$val = $row[$field];
				}
				$snippet .= $val.' ';
			}
			foreach($this->search_config['fields'] as $field)
			{
				if(isset($row[$field.$this->config["lang_id"]]))
				{
					$val = $row[$field.$this->config["lang_id"]];
				}
				else
				{
					$val = $row[$field];
				}
				$values_for_index .= $val.' ';
			}
		}

		$index_words = $this->diafan->_search->prepare($values_for_index);
		if(empty($index_words))
		{
			return;
		}

		DB::query("INSERT INTO {search_results} (name, url, snippet, table_name, element_id, rating, lang_id)"
		          ." VALUES('%s', '%s', '%s', '%s', %d, %d, %d)",
		          $this->diafan->short_text($name),
		          $this->config["url"],
		          $this->diafan->short_text($snippet),
		          $this->config["table_name"],
		          $this->config["element_id"],
		          $this->search_config["rating"],
		          $this->config["lang_id"]);

		$result_id = DB::last_id('search_results');

		$keywords_already_exists = array();

		$keywords_result = DB::query("SELECT id, keyword FROM {search_keywords} WHERE keyword IN ('".implode("', '", $index_words)."')");
		while ($row = DB::fetch_array($keywords_result))
		{
			$keywords_already_exists[$row['id']] = $row['keyword'];
		}
		$new_words = array();
		foreach($index_words as $word)
		{
			if(! in_array($word, $keywords_already_exists))
			{
				$new_words[] = $word;
			}
		}
		if($new_words)
		{
			$query = "";
			$k = 0;
			foreach ($new_words as $word)
			{
					if(! $query)
					{
						$query = "INSERT INTO {search_keywords} (keyword) VALUES ('".$word."')";
					}
					else
					{
						$query .= ", ('".$word."')";
					}
					$k++;
					if($k == 100)
					{
						DB::query($query);
						$query = '';
						$k = 0;
					}
			}
			if($query)
			{
				DB::query($query);
			}
			$keywords_result = DB::query("SELECT id, keyword FROM {search_keywords} WHERE keyword IN ('"
										.implode("', '", $new_words)."')");

			while ($row = DB::fetch_array($keywords_result))
			{
				$keywords_already_exists[$row['id']] = $row['keyword'];
			}
		}
		$query = "";
		$k = 0;
		foreach ($keywords_already_exists as $keyword_id => $dummy)
		{
			if(! $query)
			{
				$query = "INSERT INTO {search_index} (keyword_id, result_id) VALUES (".$keyword_id.", ".$result_id.")";
			}
			else
			{
				$query .= ", (".$keyword_id.", ".$result_id.")";
			}
			$k++;
			if($k == 100)
			{
				DB::query($query);
				$query = '';
				$k = 0;
			}
		}
		if($query)
		{
			DB::query($query);
		}
	}

	/**
	 * Удаляет один элемент из поискового индекса
	 * 
	 * @return void
	 */
	private function delete_id()
	{
		$result_id = DB::query_result(
				"SELECT id FROM {search_results} WHERE element_id=%d AND table_name='%s'"
				.(! empty($this->config["lang_id"]) ? " AND lang_id=".$this->config["lang_id"] : '')
				." LIMIT 1",
				$this->config["element_id"], $this->config["table_name"]
			);

		if(empty($result_id))
			return false;

		$keys = array();

		$result = DB::query("SELECT DISTINCT i.keyword_id FROM {search_index} AS i"
				." INNER JOIN {search_index} AS i2 ON i.keyword_id=i2.keyword_id"
				." WHERE i.result_id=%d GROUP BY i.keyword_id HAVING count(i2.keyword_id)<2", $result_id);
		while($row = DB::fetch_array($result))
		{
			$keys[] = $row["keyword_id"];
		}

		DB::query("DELETE FROM {search_results} WHERE id=%d", $result_id);
		DB::query("DELETE FROM {search_index} WHERE result_id=%d", $result_id);
		if($keys)
		{
			$query = "";
			$k = 0;
			foreach ($keys as $key)
			{
					if(! $query)
					{
						$query = "DELETE FROM {search_keywords} WHERE id IN (".$key;
					}
					else
					{
						$query .= ", ".$key;
					}
					$k++;
					if($k == 100)
					{
						DB::query($query.")");
						$query = '';
						$k = 0;
					}
			}
			if($query)
			{
				DB::query($query.")");
			}
		}
	}

	/**
	 * Возвращает конфигурацию поиска для индексируемой таблицы модуля
	 * 
	 * @return boolean конфигурация найдена
	 */
	private function get_search_config()
	{
		if($this->search_config)
			return true;

		if (! file_exists(ABSOLUTE_PATH.'modules/'.$this->config["module_name"].'/'.$this->config["module_name"].'.search.php'))
			return false;

		Customization::inc('modules/'.$this->config["module_name"].'/'.$this->config["module_name"].'.search.php');
		$name_class_module_search_config = ucfirst($this->config["module_name"]).'_search_config';
		$module_search_config = new $name_class_module_search_config();
		if(! empty($module_search_config->config[$this->config["table_name"]]))
		{
			$this->search_config = $module_search_config->config[$this->config["table_name"]];
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Определяет URL элемента
	 * 
	 * @return void
	 */
	private function get_url()
	{
		if($this->config['module_name'] == 'site')
		{
			// для главной ссылки нет
			if ($this->config["element_id"] == 1)
			{
				$this->config['url'] = '';
				return;
			}
			$this->config['url'] = $this->diafan->_route->link($this->config["element_id"], '', 0, 0, 0, false);
			return;
		}

		if(! empty($this->config["is_save"]))
		{
			$site_id = $this->diafan->save_site_id;
		}
		else
		{
			$site_id = DB::query_result("SELECT site_id FROM {%s} WHERE id=%d LIMIT 1", $this->config["table_name"], $this->config["element_id"]);
		}
		if (strpos($this->config["table_name"], '_category') !== false)
		{
			$cat_id = $this->config["element_id"];
			$element_id = 0;
		}
		else
		{
			if(! empty($this->config["is_save"]))
			{
				$cat_id = $this->diafan->get_param($_POST, 'cat_id', 0, 2);
			}
			else
			{
				if($this->diafan->configmodules('cat', $this->config['module_name'], $site_id) && $this->config['module_name'] == $this->config['table_name'])
				{
					$cat_id = DB::query_result("SELECT cat_id FROM {%s} WHERE id=%d LIMIT 1", $this->config["table_name"], $this->config["element_id"]);
				}
				else
				{
					$cat_id = 0;
				}
			}
			$element_id = $this->config["element_id"];
		}
		$this->config['url'] = $this->diafan->_route->link($site_id, $this->config['module_name'], $cat_id, $element_id, 0, false);
	}

	/**
	 * При сохранении проверяет изменились ли данные
	 * 
	 * @return boolean данные изменились
	 */
	private function check_edit()
	{
		if(empty($this->config["is_save"]))
			return true;

		// если это блок на сайте или не активный элемент, то просто удаляем индекс
		if ($this->diafan->is_variable("block") &&  ! empty($_POST['block'])
		    || $this->diafan->is_variable("search_no_show") && ! empty($_POST["search_no_show"])
		    || $this->diafan->is_variable("act") && empty($_POST['act']))
		{
			$this->delete_id();
			return false;
		}

		// элемент новый
		if($this->diafan->savenew)
		{
			return true;
		}
		// изменились значения индексируемых полей
		else
		{
			$fields = $this->search_config['fields'];
			if($this->diafan->is_variable("act"))
			{
				$fields[] = 'act';
			}
			if($this->diafan->is_variable("block"))
			{
				$fields[] = 'block';
			}
			if($this->diafan->is_variable("search_no_show"))
			{
				$fields[] = 'search_no_show';
			}

			foreach($fields as $field)
			{
				if(empty($_POST[$field]))
				{
					$_POST[$field] = '';
				}
				$lang = $this->diafan->variable_multilang($field) ? _LANG : '';
				if($_POST[$field] != $this->diafan->oldrow[$field.$lang])
				{
					return true;
				}
			}
			if(empty($edit))
			{
				$old_url = DB::query_result("SELECT url FROM {search_results} WHERE table_name='%s' AND element_id=%d LIMIT 1", $this->config["table_name"], $this->config["element_id"]);
				if($old_url  != $this->config['url'])
				{
					return true;
				}
			}
		}
		if(! empty($edit))
		{
			return false;
		}
		return false;
	}
}