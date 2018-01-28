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
 * Tags_admin_ajax
 * 
 * Обработка Ajax-запросов при работе с тегами в административной части
 */
class Tags_admin_ajax extends Frame_admin
{
	/**
	 * @var array результаты, передаваемые Ajaxом
	 */
	private $result;

	/**
	 * Вызывает обработку Ajax-запросов
	 * 
	 * @return void
	 */
	public function ajax()
	{
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
				case 'upload':
					$this->upload();
					break;

				case 'delete':
					$this->delete();
					break;

				case 'search':
					$this->search();
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

		if (! $_POST["tag"])
		{
			$this->result["error"] = $this->diafan->_('Поле пустое');
			$this->send_json();
		}
		if (! $tags_name_id = DB::query_result("SELECT id FROM {tags_name} WHERE [name]='%h'", trim($_POST["tag"])))
		{
			DB::query("INSERT INTO {tags_name} ([name]) VALUES ('%h')", trim($_POST["tag"]));
			$tags_name_id = DB::last_id("tags_name");
			if(ROUTE_AUTO_MODULE)
			{
				Customization::inc('adm/includes/save_functions.php');
				$save_functions = new Save_functions_admin($this->diafan);
				$rewrite = $save_functions->generate_rewrite(trim($_POST["tag"]));
				if(empty($rewrite_parent))
				{
					$site_id = DB::query_result("SELECT id FROM {site} WHERE module_name='tags' AND [act]='1' AND trash='0'");
					$rewrite_parent = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND site_id=%d LIMIT 1", $site_id);
					if(! empty($rewrite_parent))
					{
						$rewrite = $rewrite_parent.'/'.$rewrite;
					}
				}
				DB::query("INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('%h', 'tags', %d, %d)", $rewrite, $tags_name_id, $site_id);
			}
			DB::query("UPDATE {tags_name} SET `sort`=`id` WHERE id=%d", $tags_name_id);
		}

		$this->result["id"] = $this->get_id_element();

		if (DB::query_result("SELECT id FROM {tags} WHERE module_name='%h' AND element_id=%d AND tags_name_id=%d AND trash='0' LIMIT 1",
		                    $this->diafan->rewrite,
		                    $this->result["id"],
		                    $tags_name_id
		))
		{
			$this->result["error"] = $this->diafan->_('Такой тег уже прикреплен к данному элементу');
			$this->send_json();
		}

		DB::query("INSERT INTO {tags} (module_name, element_id, tags_name_id) VALUES ('%h', %d, '%d')",
		          $this->diafan->rewrite,
		          $this->result["id"],
		          $tags_name_id
		);
		$tags_id = DB::last_id("tags");
		foreach ($this->diafan->languages as $language)
		{
			if (DB::query_result("SELECT `act".$language["id"]."` FROM {".$this->diafan->rewrite."} WHERE id=%d LIMIT 1", $this->result["id"]))
			{
				DB::query("UPDATE {tags} SET `act".$language["id"]."`='1' WHERE id=%d", $tags_id);
			}
		}

		$this->diafan->_cache->delete("", "tags");

		Customization::inc('modules/tags/admin/tags.admin.view.php');
		$tags_view = new Tags_admin_view($this->diafan);

		$this->result["data"]   = $tags_view->show($this->result["id"]);
		$this->result["target"] = ".tags_container";

		$this->send_json();
	}

	/**
	 * Удаляет тег
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

		$tag_id = intval($_POST['tag_id']);
		if (! empty($tag_id))
		{
			$row = DB::fetch_array(DB::query("SELECT element_id, tags_name_id FROM {tags} WHERE module_name='%h' AND id=%d LIMIT 1", $this->diafan->rewrite, $tag_id));
			if (! $row)
			{
				$this->result["error"] = 'ERROR';
				$this->send_json();
			}
		}

		DB::query("DELETE FROM {tags} WHERE module_name='%h' AND id='%d'", $this->diafan->rewrite, $tag_id);
		if (! DB::query_result("SELECT id FROM {tags} WHERE tags_name_id=%d LIMIT 1", $row["tags_name_id"]))
		{
			DB::query("DELETE FROM {tags_name} WHERE id='%d'", $row["tags_name_id"]);
			DB::query("DELETE FROM {rewrite} WHERE module_name='tags' AND element_id='%d'", $row["tags_name_id"]);
		}

		$this->diafan->_cache->delete("", "tags");

		Customization::inc('modules/tags/admin/tags.admin.view.php');
		$tags_view = new Tags_admin_view($this->diafan);

		$this->result["data"] = $tags_view->show($row["element_id"]);
		$this->send_json();
	}

	/**
	 * Редактирует изображение
	 * 
	 * @return void
	 */
	private function search()
	{
		$mes = '';

		//максимальный и минимальный размеры текста в em
		$max = 3;
		$min = 0.9;

		$maxr = 0;
		$minr = 10;
		$rows = array();

		$res = DB::query("SELECT id, [name] FROM {tags_name} WHERE trash='0'"
		                 .(empty($_POST["new"])
		                   ? " AND id NOT IN"
		                     ." (SELECT tags_name_id FROM {tags} WHERE module_name='%h' AND element_id='%d')"
		                   : "")
		                 ." ORDER BY sort ASC",
		                 $this->diafan->rewrite, $_POST["element_id"]);
		while ($row = DB::fetch_array($res))
		{
			$row["size"] = DB::query_result("SELECT COUNT(*) FROM {tags} WHERE tags_name_id='%d' and trash='0'", $row["id"]);
			$maxr = $maxr < $row["size"] ? $row["size"] : $maxr;
			$minr = $minr > $row["size"] ? $row["size"] : $minr;
			$rows[] = $row;
		}

		foreach ($rows as $row)
		{
			if (! $row["size"])
			{
				$size = $min;
			}
			else
			{
				$size = $maxr - $minr < 1
				        ? $min
				        : ($max - $min) * ($row["size"] - $minr) / ($maxr - $minr) + $min;
			}
			$mes .= '<nobr><a href="javascript:void(0)" class="tags_add" style="font-size: '.$size.'em;">'
			        .$row["name"].'</a></nobr> ';
		}
		if(! $mes)
		{
			$mes = $this->diafan->_('Добавленных ранее тегов нет');
		}

		$mes = '<div style="float:right;padding: 0px 0px 5px 5px"><a href="javascript:void(0)" onclick="$(\'.tags_search\').hide()">x</a></div>'.$mes;
		$this->result["data"] = $mes;
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
		if (! empty($_POST["id"]))
		{
			return intval($_POST["id"]);
		}
		else
		{
			$names  = array();
			$values = array();
			if ($this->diafan->config('parent'))
			{
				$names[]  = "parent_id";
				$values[] = "'".$this->diafan->parent."'";
			}
			if ($this->diafan->config('element'))
			{
				$names[]  = "cat_id";
				$values[] = "'".$this->diafan->cat."'";
			}
			if ($this->diafan->config('element_site'))
			{
				$names[]  = "site_id";
				$values[] = "'".$this->diafan->site."'";
			}

			DB::query("INSERT INTO {".$this->diafan->table."} (".implode(', ', $names).") VALUES (".implode(', ', $values).")");

			return DB::last_id($this->diafan->table);
		}
	}
}