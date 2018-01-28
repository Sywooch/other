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
 * Shop_export
 *
 * Экспорт
 */
class Shop_export extends Diafan
{
	/**
	 * @var array конфигурация текущего экспорта
	 */
	private $config;

	/**
	 * @var array название полей списка
	 */
	private $select_values;

	/**
	 * @var array поля, заданные для текущего экспорта
	 */
	private $fields;

	/**
	 * Инициирует экспорт
	 *
	 * @return void
	 */
	public function init()
	{
		if(! $this->diafan->_user->roles("init", "shop/importexport", array(), 'admin'))
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}
		$this->config = DB::fetch_array(DB::query("SELECT * FROM {shop_import_category} WHERE id=%d AND trash='0' LIMIT 1", $_GET["rewrite"]));
		if(! $this->config)
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}
		$this->init_config();
		$name = preg_replace('/[^a-z_ ]+/', '', str_replace(array(' ', '-'), '_', substr(strtolower($this->diafan->translit(TIT1)), 0, 50)));
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Cache-Control: max-age=86400');
		header("Content-type: text/plain");
		header("Content-Disposition: attachment; filename=shop_export_".$name.".csv");
		header('Content-transfer-encoding: binary');
		header("Connection: close");

		if($this->config['encoding'] == 'cp1251')
		{
			echo utf::to_windows1251($this->start());
		}
		else
		{
			echo $this->start();
		}
		exit;
	}

	/**
	 * Устанавливает настройки экспорта
	 *
	 * @return void
	 */
	private function init_config()
	{
		$this->config["table"] = 'shop'.($this->config["type"] == 'category' ? "_category" : "");
		$this->config["end_string"] = htmlspecialchars_decode($this->config["end_string"]);
		if(! $this->config["count_part"])
		{
			$this->config["count_part"] = 200;
		}
		if(! $this->config['delimiter'])
		{
			$this->config["delimiter"] = ";";
		}
		if(! $this->config['sub_delimiter'])
		{
			$this->config["sub_delimiter"] = "|";
		}

		$k = 0;
		$this->fields = array();

		//получаем типы полей учавствующих в импорте
		$result = DB::query("SELECT type, name, required, params FROM {shop_import} WHERE trash='0' AND cat_id=%d ORDER BY sort ASC", $this->config["id"]);
		while ($row = DB::fetch_array($result))
		{
			$row["params"] = unserialize($row["params"]);
			if ($row["type"] == "param")
			{
				$row["values"] = array();
				$row["param_type"] = DB::query_result("SELECT type FROM {shop_param} WHERE id=%d LIMIT 1", $row["params"]["id"]);
			}
			$this->fields[] = $row;
		}

		//получаем значения полей списков
		$values = array();
		$result = DB::query("SELECT id, [name] FROM {shop_param} WHERE trash='0' AND (type='select' OR type='multiple')");
		while ($row = DB::fetch_array($result))
		{
			$result2 = DB::query("SELECT id, [name] FROM {shop_param_select} WHERE param_id=%d", $row["id"]);
			while ($row2 = DB::fetch_array($result2))
			{
				$values[$row2["id"]] = $row2["name"];
			}
			$this->select_values[$row["id"]] = array(
					"name" => $row["name"],
					"values" => $values,
				);
		}

		//получаем значения валют
		$result = DB::query("SELECT id, name FROM {shop_currency} WHERE trash='0'");
		while ($row = DB::fetch_array($result))
		{
			$this->currency_values[$row["id"]] = $row["name"];
		}
	}

	/**
	 * Старт вывода
	 *
	 * @return string
	 */
	private function start()
	{
		$text = '';
		$result = DB::query("SELECT * FROM {".$this->config["table"]."} WHERE site_id=%d"
			.($this->config["type"] != 'category' && $this->config["cat_id"] ? " AND cat_id=".$this->config["cat_id"] : '')
			." AND trash='0'", $this->config["site_id"]);
		while($row = DB::fetch_array($result))
		{
			$list = array();
			if(isset($prices))
			{
				unset($prices);
			}
			foreach($this->fields as $k => $field)
			{
				switch($field["type"])
				{
					case 'id':
						switch($field["params"]["type"])
						{
							case 'article':
								$list[] = $row["article"];
								break;

							case 'site':
								$list[] = $row["id"];
								break;

							default:
								$list[] = $row["import_id"];
								break;
						}
						break;
					case 'parent':
						switch($field["params"]["type"])
						{
							case 'site':
								$list[] = $row["parent_id"];
								break;

							default:
								if($row["parent_id"])
								{
									$list[] = DB::query_result("SELECT import_id FROM {shop_category} WHERE id=%d LIMIT 1", $row["parent_id"]);
								}
								break;
						}
						break;
					case 'article':
					case 'no_buy':
					case 'hit':
					case 'new':
					case 'action':
					case 'is_file':
					case 'show_yandex':
					case 'map_no_show':
					case 'sort':
					case 'admin_id':
					case 'theme':
					case 'view':
						$list[] = $row[$field["type"]];
						break;
					case 'name':
					case 'text':
					case 'anons':
					case 'keywords':
					case 'descr':
					case 'title_meta':
					case 'act':
						$list[] = $row[$field["type"]._LANG];
						break;
					case 'price':
						$values = array();
						if(! isset($prices))
						{
							$prices = $this->diafan->_shop->price_get_base($row["id"]);
						}
						foreach($prices as $price)
						{
							$value = number_format($price["price"], 2 , ".", "");
							if($field["params"]["count"])
							{
								$value .= $field["params"]["delimitor"].$price["count_goods"];
							}
							if($field["params"]["currency"])
							{
								if($price["currency_id"] && $field["params"]["select_currency"] == 'value')
								{
									$price["currency_id"] = $this->currency_values[$price["currency_id"]];
								}
								$value .= $field["params"]["delimitor"].$price["currency_id"];
							}
							foreach($price["param"] as $k => $v)
							{
								if(empty($v) || empty($k))
									continue;
								if($field["params"]["select_type"] == 'value')
								{
									$v = $this->select_values[$k]["values"][$v];
									$k = $this->select_values[$k]["name"];
								}
								$value .= $field["params"]["delimitor"].$k.'='.$v;
							}
							$values[] = $value;
						}
						$list[] = implode($this->config["sub_delimiter"], $values);
						break;
					case 'count':
						$values = array();
						if(! isset($prices))
						{
							$prices = $this->diafan->_shop->price_get_base($row["id"]);
						}
						foreach($prices as $price)
						{
							$value = $price["count_goods"];
							foreach($price["param"] as $k => $v)
							{
								if(empty($v) || empty($k))
									continue;
								if($field["params"]["select_type"] == 'value')
								{
									$v = $this->select_values[$k]["values"][$v];
									$k = $this->select_values[$k]["name"];
								}
								$value .= $field["params"]["delimitor"].$k.'='.$v;
							}
							$values[] = $value;
						}
						$list[] = implode($this->config["sub_delimiter"], $values);
						break;
					case 'cats':
						$cats = array();
						switch($field["params"]["type"])
						{
							case 'site':
								$result2 = DB::query("SELECT cat_id as cat FROM {shop_category_rel} WHERE element_id=%d AND trash='0'", $row["id"]);
								break;

							case 'name':
								$result2 = DB::query("SELECT s.name"._LANG." as cat FROM {shop_category_rel} AS r INNER JOIN {shop_category} AS s ON s.id=r.cat_id WHERE r.element_id=%d AND r.trash='0'", $row["id"]);
								break;

							default:
								$result2 = DB::query("SELECT s.import_id as cat FROM {shop_category_rel} AS r INNER JOIN {shop_category} AS s ON s.id=r.cat_id WHERE r.element_id=%d AND r.trash='0'", $row["id"]);
								break;
						}
						while($row2 = DB::fetch_array($result2))
						{
							$cats[] = $row2["cat"];
						}
						$list[] = implode($this->config["sub_delimiter"], $cats);
						break;
					case 'param':
						if($field["param_type"] == 'select' || $field["param_type"] == 'multiple')
						{
							$params = array();
							$result2 = DB::query("SELECT value".$this->diafan->language_base_site." AS value FROM {shop_param_element} WHERE  param_id=%d AND element_id=%d AND trash='0'", $field["params"]["id"], $row["id"]);
							while($row2 = DB::fetch_array($result2))
							{
								if($field["params"]["select_type"] == 'value')
								{
									$row2["value"] = $this->select_values[$field["params"]["id"]]["values"][$row2["value"]];
								}
								$params[] = $row2["value"];
							}
							$list[] = implode($this->config["sub_delimiter"], $params);
						}
						else
						{
							$value_name = (in_array($field["param_type"], array('text', 'textarea', 'editor')) ? '[value]' : 'value'.$this->diafan->language_base_site);
							$list[] = DB::query_result("SELECT ".$value_name." FROM {shop_param_element} WHERE  param_id=%d AND element_id=%d AND trash='0' LIMIT 1", $field["params"]["id"], $row["id"]);
						}
						break;
					case 'images':
						$images = array();
						$result2 = DB::query("SELECT name FROM {images} WHERE module_name='shop".($this->config["type"] != 'good' ? 'cat' : '')."' AND trash='0' AND element_id=%d", $row["id"]);
						while($row2 = DB::fetch_array($result2))
						{
							$images[] = $row2["name"];
						}
						$list[] = implode($this->config["sub_delimiter"], $images);
						break;
					case 'rel_goods':
						$rels = array();
						switch($field["params"]["type"])
						{
							case 'article':
								$result2 = DB::query("SELECT s.article as rel FROM {shop_rel} AS r INNER JOIN {shop} AS s ON s.id=r.rel_element_id WHERE r.element_id=%d AND r.trash='0'", $row["id"]);
								break;

							case 'site':
								$result2 = DB::query("SELECT rel_element_id as rel FROM {shop_rel} WHERE element_id=%d AND trash='0'", $row["id"]);
								break;

							default:
								$result2 = DB::query("SELECT s.import_id as rel FROM {shop_rel} AS r INNER JOIN {shop} AS s ON s.id=r.rel_elemnt_id WHERE r.element_id=%d AND r.trash='0'", $row["id"]);
								break;
						}
						while($row2 = DB::fetch_array($result2))
						{
							$rels[] = $row2["rel"];
						}
						$list[] = implode($this->config["sub_delimiter"], $rels);
						break;
					case 'rewrite':
						$list[] = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='shop' AND ".($this->config["type"] == 'good' ? 'element' : 'cat')."_id=%d AND trash='0' LIMIT 1", $row["id"]);
						break;
					case 'menu':
						if($field["params"]["id"])
						{
							$in_menu = DB::query_result("SELECT id FROM {menu} WHERE cat_id=%d AND module_name='shop' AND ".($this->config["type"] == 'good' ? 'element' : 'module_cat')."_id=%d AND trash='0' AND [act]='1' LIMIT 1", $field["params"]["id"], $row["id"]);
							$list[] = $in_menu ? '1' : '0';
						}
						break;
					case 'yandex':
						$list[] = str_replace("\n", $this->config["sub_delimiter"], $row["yandex"]);
						break;
					case 'access':
						if($row["access"])
						{
							$access = array();
							$result2 = DB::query("SELECT role_id FROM {access} WHERE module_name='shop' AND trash='0' AND ".($this->config["type"] == 'good' ? 'element' : 'cat')."_id=%d", $row["id"]);
							while($row2 = DB::fetch_array($result2))
							{
								$access[] = $row2["role_id"];
							}
							$list[] = implode($this->config["sub_delimiter"], $access);
						}
						break;
					case 'date_start':
					case 'date_finish':
						$list[] = date('d.m.Y H:i', $row[$field["type"]]);
						break;
					case 'empty':
						$list[] = '';
						break;
				}
			}
			$text .= $this->putcsv($list);
		}
		return $text;
	}

	/**
	 * Форматирует строку в виде CSV
	 * 
	 * @param  array $list исходные данные
	 * @param strign $q символ ограничителя поля
	 **/
	private function putcsv($list, $q = '"')
	{
		$line = "";
		foreach ($list as $i => $field)
		{
			// remove any windows new lines,
			// as they interfere with the parsing at the other end
			$field = str_replace("\r\n", "\n", $field);
			// if a deliminator char, a double quote char or a newline
			// are in the field, add quotes
			if(preg_match("/[".$this->config["delimiter"]."$q\n\r]/", $field))
			{
				$field = $q.str_replace($q, $q.$q, $field).$q;
			}
			$line .= $field;
			if($i != count($list) - 1)
			{
				$line .= $this->config["delimiter"];
			}
		}
		$line .= $this->config["end_string"]."\n";
		return $line;
	}
}

$shop_export = new Shop_export($this->diafan);
$shop_export->init();