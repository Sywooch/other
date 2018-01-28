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

// 0 - выключить восстановление
// 1 - включить восстановление, лог восстановления
// 2 - включить восстановление, полный лог
define('REPAIR', 1);

/**
 * Update_admin_repair
 *
 * Восстановление базы данных
 */
class Update_admin_repair extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'repair';

	/**
	 * Выводит контент модуля
	 * @return void
	 */
	public function show()
	{
		if (! empty($_GET["repair"]) && REPAIR)
		{
			$this->repair();
		}
		else
		{
			echo '<p><a href="'.URL.'?repair=1">'.$this->diafan->_('Начать восстановление базы данных').'</a></p>';
		}
	}

	/**
	 * Восстановление базы данных
	 * @return void
	 */
	public function repair()
	{
		Customization::inc("includes/install.php");
		define('IS_INSTALL', 1);

		$url = parse_url(DB_URL);
		$result = DB::query("SHOW TABLES FROM ".substr($url['path'], 1));
		while ($row = DB::fetch_array($result))
		{
			foreach($row as $k => $v)
			{
				$tables[] = preg_replace('/^'.DB_PREFIX.'/', '', $v);
				break;
			}
		}
		if (file_exists(ABSOLUTE_PATH.'installation/core.php'))
		{
			include_once ABSOLUTE_PATH.'installation/core.php';
			$this->check_file($db, $tables);
			$error = false;
		}
		else
		{
			throw new Exception('Файл installation/core.php не существует');
		}

		$result = DB::query("SELECT DISTINCT(module_name) FROM {modules}");
		while ($row = DB::fetch_array($result))
		{
			if (file_exists(ABSOLUTE_PATH."modules/".$row["module_name"]."/".$row["module_name"].".install.php"))
			{
				include_once ABSOLUTE_PATH."modules/".$row["module_name"]."/".$row["module_name"].".install.php";
				$this->check_file($db, $tables);
			}
		}
		echo '<div class="ok">'.$this->diafan->_('Базы данных успешно обновлена.').'</div>';
	}

	/**
	 * Восстановление базы данных из файла
	 * @return void
	 */
	private function check_file($db, $tables)
	{
		if(! empty($db["tables"]))
		{
			foreach($db["tables"] as $row)
			{
				if (REPAIR == 2)
				{
					echo '<p>Таблица: <b>'.DB_PREFIX.$row["name"].'</b>';
				}
				if (in_array($row["name"], $tables))
				{
					$table_fileds = array();
					$result = DB::query("DESCRIBE {".$row["name"]."}");
					while ($r = DB::fetch_array($result))
					{
						$table_fileds[] = $r["Field"];
					}
					$fields = array();
					foreach ($row["fields"] as $f)
					{
						if(! empty($f["multilang"]))
						{
							foreach($this->diafan->languages as $l)
							{
								$fields[] = array(
									"name" => $f["name"].$l["id"],
									"type" => $f["type"]
								);
							}
						}
						else
						{
							$fields[] = $f;
						}
					}
					foreach ($fields as $f)
					{
						if (! in_array($f["name"], $table_fileds))
						{
							$query = 'ALTER TABLE {'.$row["name"]."} ADD `".$f["name"]."` ".$f["type"];
							echo '<br>добавлено поле <b>'.$f["type"].'</b>:<pre>'.$query.'</pre>';
							DB::query($query);
						}
						else
						{
							if (REPAIR == 2)
							{
								echo '<br>поле <b>'.$f["name"].'</b> существует';
							}
						}
					}
					$this->update_table_parents($row["name"]);
				}
				else
				{
					$query = "CREATE TABLE {".$row["name"]."} (";
					foreach($row["fields"] as $field)
					{
						if(empty($field["multilang"]))
						{
							$query .= "\n".'`'.$field["name"].'` '.$field["type"].',';
						}
						else
						{
							foreach($this->lang_ids as $lang_id)
							{
								$query .= "\n".'`'.$field["name"].$lang_id.'` '.$field["type"].',';
							}
						}
					}
					if(! empty($row["keys"]))
					{
						$query .= "\n".implode(',', $row["keys"]);
					}
					$query .= "\n) CHARSET=utf8";
					echo '<p>Таблица: <b>'.DB_PREFIX.$row["name"].'</b> добавлена:<br><pre>'.$query.'</pre></p><hr>';
					DB::query($query);
				}
			}
		}
		if(! empty($db["sql"]))
		{
			foreach ($db["sql"] as $query)
			{
				if (preg_match('/CREATE TABLE \{(.*)\} \(([\w\W]*)PRIMARY KEY/', $query, $m))
				{
					$table = $m[1];
					if (REPAIR == 2)
					{
						echo '<p>Таблица: <b>'.DB_PREFIX.$table.'</b>';
					}
					if (in_array($table, $tables))
					{
						if (REPAIR == 2)
						{
							echo ' существует';
						}
						$fields = explode('
		', $m[2]);
						$table_fileds = array();
						$result = DB::query("DESCRIBE {".$table."}");
						while ($row = DB::fetch_array($result))
						{
							$table_fileds[] = $row["Field"];
						}
						foreach ($fields as $f)
						{
							$f = trim($f);
							if (preg_match('/([^ ]*) (.*),/', $f, $fm))
							{
								$fm[1] = str_replace('`', '', $fm[1]);
								if (! in_array($fm[1], $table_fileds))
								{
									if (REPAIR == 2)
									{
										echo '<br>добавлено поле <b>'.$fm[1].'</b>:<pre>ALTER TABLE {'.$table."} ADD `".$fm[1]."` ".$fm[2].'</pre>';
										DB::query("ALTER TABLE {".$table."} ADD `".$fm[1]."` ".$fm[2]);
									}
									else
									{
										echo '<p>Добавлено поле <b>'.$fm[1].'</b> в таблицу <b>'.DB_PREFIX.$table.'</b>:
										<pre>ALTER TABLE {'.$table."} ADD `".$fm[1]."` ".$fm[2].'</pre></p><hr>';
										DB::query("ALTER TABLE {".$table."} ADD `".$fm[1]."` ".$fm[2]);
									}
								}
								else
								{
									if (REPAIR == 2)
									{
										echo '<br>поле <b>'.$fm[1].'</b> существует';
									}
								}
							}
							elseif ($f && REPAIR == 2)
							{
								echo '<br>не обработано поле <b>'.$fm[1].'</b>';
							}
						}
						$this->update_table_parents($table);
					}
					else
					{
						if (REPAIR == 2)
						{
							echo ' добавлена:<br><pre>'.$query.'</pre>';
						}
						else
						{
							echo '<p>Таблица: <b>'.DB_PREFIX.$table.'</b> добавлена:<br><pre>'.$query.'</pre></p><hr>';
						}
						DB::query($query);
					}
					if (REPAIR == 2)
					{
						echo '</p><hr>';
					}
				}
			}
		}
	}

	/**
	 * Обновление таблицы родительских связей
	 * @return void
	 */
	private function update_table_parents($table)
	{
		if (strpos($table, '_parents') !== false)
		{
			DB::query("TRUNCATE TABLE {".$table."}");
			$table_parent = str_replace('_parents', '', $table);
			
			$result = DB::query("SELECT parent_id, id FROM {".$table_parent."}");
			while ($row = DB::fetch_array($result))
			{
				if ($row["parent_id"])
				{
					$parents = array();
					while ($row["parent_id"] > 0 && ! in_array($row["parent_id"], $parents))
					{
						$parents[] = $row["parent_id"];
						DB::query("INSERT INTO {".$table."} (`element_id`, `parent_id`) VALUES (%d, %d)", $row["id"], $row["parent_id"]);
						$row["parent_id"] = DB::query_result("SELECT parent_id FROM {".$table_parent."} WHERE id=%d LIMIT 1", $row["parent_id"]);
					}
				}
			}
			$result = DB::query("SELECT id FROM {".$table_parent."}"); 
			while ($row = DB::fetch_array($result))
			{
				$count = DB::query_result("SELECT COUNT(*) FROM  {".$table."} WHERE parent_id=%d", $row["id"]);
				DB::query("UPDATE {".$table_parent."} SET count_children=%d WHERE id=%d", $count, $row["id"]);
			}
		}
	}
}