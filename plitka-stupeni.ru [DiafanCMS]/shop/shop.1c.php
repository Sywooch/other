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
 * Shop_1c
 *
 * Интеграция с 1C
 */
class Shop_1c extends Diafan
{
	/**
	 * @var array локальный кэш модуля
	 */
	private $cache;

	/**
	 * Стартует интеграцию
	 *
	 * @return void
	 */
	public function start()
	{
		if(! is_dir(EXPORT_DIR))
		{
			mkdir(EXPORT_DIR, 0777);
			$text = 'Options -Indexes
			<files *>
			deny from all
			</files>';

			$fp = fopen(EXPORT_DIR.'/.htaccess', "w");
			fwrite($fp, $text);
			fclose($fp);
		}
		if(empty($_GET["type"]) || ! in_array($_GET["type"], array('sale', 'catalog')))
		{
			include(ABSOLUTE_PATH.'includes/404.php');
		}
		if($_GET["type"] == 'sale')
		{
			switch($_GET["mode"])
			{
				case 'checkauth':
					$this->checkauth();
					break;

				case 'init':
					$this->init();
					break;

				case 'file':
					$this->sale_file();
					break;

				case 'query':
					$this->sale_query();
					break;

				case 'success':
					$this->sale_success();
					break;

				default:
					include(ABSOLUTE_PATH.'includes/404.php');
			}
		}
		if($_GET["type"] == 'catalog')
		{
			switch($_GET["mode"])
			{
				case 'checkauth':
					$this->checkauth();
					break;

				case 'init':
					$this->init();
					break;

				case 'file':
					$this->catalog_file();
					break;

				case 'import':
					$this->catalog_import();
					break;

				default:
					include(ABSOLUTE_PATH.'includes/404.php');
			}
		}
    }

	/**
	 * Начало сеанса
	 *
	 * @return void
	 */
	private function checkauth()
	{
		echo "success\n";
		echo session_name()."\n";
		echo session_id();
	}

	/**
	 * Запрос параметров от сайта
	 *
	 * @return void
	 */
	private function init()
	{
		echo "zip=no\n";
		echo "file_limit=1000000\n";
	}
	
	/**
	 * Обмен информацией о заказах: получение файла обмена с сайта
	 *
	 * @return void
	 */
	private function sale_query()
	{
		$no_spaces = '<?xml version="1.0" encoding="utf-8"?>
		<КоммерческаяИнформация ВерсияСхемы="2.04" ДатаФормирования="'.date('Y-m-d').'"></КоммерческаяИнформация>';
		$xml = new SimpleXMLElement($no_spaces);

		$result = DB::query("SELECT * FROM {shop_order} WHERE created>%d AND trash='0'", $this->diafan->unixdate(LAST_1C_EXPORT));
		while($row = DB::fetch_array($result))
		{
			$doc = $xml->addChild("Документ");
			$doc->addChild("Ид", $row["id"]);
			$doc->addChild("Номер", $row["id"]);
			$doc->addChild("Дата", date('Y-m-d', $row["created"]));
			$doc->addChild("ХозОперация", "Заказ товара" );
			$doc->addChild("Роль", "Продавец" );
			$doc->addChild("Курс", "1" );
			$doc->addChild("Сумма", number_format($row["summ"],2 , ".", ""));
			$doc->addChild("Время",  date('H:i:s', $row["created"]));
			
			$name = '';
			$comment = '';
			$address = '';
			$phone = '';
			$email = '';
			$result_p = DB::query(
					"SELECT p.id, p.[name], v.value, p.type FROM {shop_order_param} AS p"
					." INNER JOIN {shop_order_param_element} AS v ON v.param_id=p.id AND v.element_id=%d",
					$row["id"]
				);
			while($row_p = DB::fetch_array($result_p))
			{
				switch($row_p["type"])
				{
					case 'email':
						$email = $row_p["value"];
						break;

					case 'select':
					case 'multiple':
						$this->order_select_values($select_values, $row_p["id"]);
						$row_p["value"] = $select_values[$row_p["id"]][$row_p["value"]];
						break;

					case 'checkbox':
						$row_p["value"] = $row_p["value"] ? "да" : "нет";
						break;
				}
				switch($row_p["name"])
				{
					case 'Адрес':
						$address = $row_p["value"];
						break;

					case 'ФИО':
					case 'ФИО или название компании':
					case 'Название':
					case 'Ваше имя':
						$name = $row_p["value"];
						break;

					case 'Телефон':
					case 'Контактный телефон':
						$phone = $row_p["value"];
						break;

					default:
						$comment .= $row_p["name"].': '.$row_p["value"]."\n";
				}
				
			}

			$doc->addChild("Комментарий", $comment);

			// Контрагенты
			$k1 = $doc->addChild('Контрагенты');
			$k1_1 = $k1->addChild('Контрагент');
			$k1_2 = $k1_1->addChild("Ид", $name);
			$k1_2 = $k1_1->addChild("Наименование", $name);
			$k1_2 = $k1_1->addChild("Роль", "Покупатель");
			$k1_2 = $k1_1->addChild("ПолноеНаименование", $name);
			
			// Доп параметры
			if($address)
			{
				$addr = $k1_1->addChild('АдресРегистрации');
				$addr->addChild('Представление', $address);
				$addrField = $addr->addChild('АдресноеПоле');
				$addrField->addChild('Тип', 'Страна');
				$addrField->addChild('Значение', 'RU');
				$addrField = $addr->addChild('АдресноеПоле');
				$addrField->addChild('Тип', 'Регион');
				$addrField->addChild('Значение', $address);
			}

			if($phone || $email)
			{
				$contacts = $k1_1->addChild('Контакты');
				if($phone)
				{
					$cont = $contacts->addChild('Контакт');
					$cont->addChild('Тип', 'Телефон');
					$cont->addChild('Значение', $phone);
				}
				if($email)
				{
					$cont = $contacts->addChild('Контакт');
					$cont->addChild('Тип', 'Почта');
					$cont->addChild('Значение', $email);
				}
			}

			$t1 = $doc->addChild('Товары');
			$result_good = DB::query(
					"SELECT g.id, g.good_id,g.price, g.count_goods, g.discount_id, s.[name], s.article, s.import_id FROM {shop_order_goods} AS g"
					." INNER JOIN {shop} AS s ON s.id=g.good_id"
					." WHERE g.order_id=%d",
					$row["id"]
				);
			while($row_good = DB::fetch_array($result_good))
			{
				$depend = '';
				$params = array();
				$result_p = DB::query("SELECT * FROM {shop_order_goods_param} WHERE order_good_id=%d", $row_good["id"]); 
				while ($row_p = DB::fetch_array($result_p))
				{
					$param_name  = DB::query_result("SELECT [name] FROM {shop_param} WHERE id=%d LIMIT 1", $row_p["param_id"]);
					$param_value = DB::query_result("SELECT s.[name] FROM {shop_param_select} AS s WHERE s.id=%d AND s.param_id=%d LIMIT 1", $row_p["value"], $row_p["param_id"]);
					$depend .= ', '.$param_name.': '.$param_value;
					$params[$row_p["param_id"]] = $row_p["value"];
				}
				$discount = 0;
				if($row_good["discount_id"])
				{
					if(empty($discounts[$row_good["discount_id"]]))
					{
						$d = DB::fetch_array(DB::query("SELECT discount, deduction FROM {shop_discount} WHERE id=%d LIMIT 1", $row_good["discount_id"]));
						$discounts[$row_good["discount_id"]] = $d;
					}
					if($discounts[$row_good["discount_id"]]["discount"])
					{
						$discount = $row_good["price"] * $row_good["count_goods"] * $discounts[$row_good["discount_id"]]["discount"] / (100 - $discounts[$row_good["discount_id"]]["discount"]);
					}
					else
					{
						$discount = $discounts[$row_good["discount_id"]]["deduction"];
					}
				}
				$t1_1 = $t1->addChild('Товар' );

				if (empty($row_good['import_id']))
				{
					$t1_2 = $t1_1->addChild("Ид", $row_good["good_id"].'#'.$row_good["id"]);
				}
				else
				{
					$t1_2 = $t1_1->addChild("Ид", $row_good["import_id"]);
				}

				$t1_2 = $t1_1->addChild("Артикул", $row_good["article"]);

				$t1_2 = $t1_1->addChild("Наименование", $row_good["name"].$depend);
				$t1_2 = $t1_1->addChild("ЦенаЗаЕдиницу", number_format($row_good["price"],2 , ".", ""));
				$t1_2 = $t1_1->addChild("Количество", $row_good["count_goods"]);
				$t1_2 = $t1_1->addChild("Сумма", number_format($row_good["price"] * $row_good["count_goods"],2 , ".", ""));

				$t1_2 = $t1_1->addChild("Скидки");
				$t1_3 = $t1_2->addChild("Скидка");
				$t1_4 = $t1_3->addChild("Сумма", $discount);
				$t1_4 = $t1_3->addChild("УчтеноВСумме", "true");

				$t1_2 = $t1_1->addChild("ЗначенияРеквизитов");
				$t1_3 = $t1_2->addChild("ЗначениеРеквизита");
				$t1_4 = $t1_3->addChild("Наименование", "ВидНоменклатуры");
				$t1_4 = $t1_3->addChild("Значение", "Товар");

				$t1_2 = $t1_1->addChild("ЗначенияРеквизитов");
				$t1_3 = $t1_2->addChild("ЗначениеРеквизита");
				$t1_4 = $t1_3->addChild("Наименование", "ТипНоменклатуры");
				$t1_4 = $t1_3->addChild("Значение", "Товар");
			}

			// Дополнительные затраты
			$result_a = DB::query(
					"SELECT a.id, a.[name], s.summ FROM {shop_additional_cost} AS a"
					." INNER JOIN {shop_order_additional_cost} AS s ON s.additional_cost_id=a.id AND s.order_id=%d"
					." WHERE a.trash='0'", $row["id"]
				);
			while ($row_a = DB::fetch_array($result_a))
			{
				$t1 = $t1->addChild('Товар');
				$t1->addChild("Ид", 'ORDER_ADDITIONAL_'.$row_a["id"]);
				$t1->addChild("Наименование", $row_a["name"]);
				$t1->addChild("ЦенаЗаЕдиницу", $row_a['summ']);
				$t1->addChild("Количество", 1 );
				$t1->addChild("Сумма", $row_a['summ']);
				$t1_2 = $t1->addChild("ЗначенияРеквизитов" );
				$t1_3 = $t1_2->addChild("ЗначениеРеквизита" );
				$t1_4 = $t1_3->addChild("Наименование", "ВидНоменклатуры" );
				$t1_4 = $t1_3->addChild("Значение", "Услуга" );

				$t1_2 = $t1->addChild("ЗначенияРеквизитов" );
				$t1_3 = $t1_2->addChild("ЗначениеРеквизита" );
				$t1_4 = $t1_3->addChild("Наименование", "ТипНоменклатуры" );
				$t1_4 = $t1_3->addChild("Значение", "Услуга" );
			}

			// Доставка
			if ($row["delivery_id"])
			{
				$delivery_name = DB::query_result("SELECT [name] FROM {shop_delivery} WHERE id=%d LIMIT 1", $this->diafan->values["delivery_id"]);
				$t1 = $t1->addChild('Товар');
				$t1->addChild("Ид", 'ORDER_DELIVERY');
				$t1->addChild("Наименование", 'Доставка: '.$delivery_name);
				$t1->addChild("ЦенаЗаЕдиницу", $row["delivery_summ"]);
				$t1->addChild("Количество", 1 );
				$t1->addChild("Сумма", $row["delivery_summ"]);
				$t1_2 = $t1->addChild("ЗначенияРеквизитов" );
				$t1_3 = $t1_2->addChild("ЗначениеРеквизита" );
				$t1_4 = $t1_3->addChild("Наименование", "ВидНоменклатуры" );
				$t1_4 = $t1_3->addChild("Значение", "Услуга" );

				$t1_2 = $t1->addChild("ЗначенияРеквизитов" );
				$t1_3 = $t1_2->addChild("ЗначениеРеквизита" );
				$t1_4 = $t1_3->addChild("Наименование", "ТипНоменклатуры" );
				$t1_4 = $t1_3->addChild("Значение", "Услуга" );
			}

			// Статус			
			if($row["status"] < 2)
			{
				$s1_2 = $doc->addChild("ЗначенияРеквизитов" );
				$s1_3 = $s1_2->addChild("ЗначениеРеквизита" );
				$s1_3->addChild("Наименование", "Статус заказа" );
				$s1_3->addChild("Значение", "[N] Принят" );
			}
			if($row["status"] == 2)
			{
				$s1_2 = $doc->addChild("ЗначенияРеквизитов" );
				$s1_3 = $s1_2->addChild("ЗначениеРеквизита" );
				$s1_3->addChild("Наименование", "Статус заказа" );
				$s1_3->addChild("Значение", "[F] Доставлен" );
			}
			if($row["status"] == 3)
			{
				$s1_2 = $doc->addChild("ЗначенияРеквизитов" );
				$s1_3 = $s1_2->addChild("ЗначениеРеквизита" );
				$s1_3->addChild("Наименование", "Отменен" );
				$s1_3->addChild("Значение", "true" );
			}
		}

		header ( "Content-type: text/xml; charset=utf-8" );
		echo "\xEF\xBB\xBF";
		echo $xml->asXML ();

		$this->set_last_1c_import();
	}
	
	private function order_select_values(&$select_values, $id)
	{
		if(! isset($select_values[$id]))
		{
			$result = DB::query("SELECT id, [name] FROM {shop_order_param_select} WHERE param_id=%d", $id);
			while($row = DB::fetch_array($result))
			{
				$select_values[$id][$row["id"]] = $row["name"];
			}
		}
	}

	/**
	 * Обмен информацией о заказах: отправка файла обмена на сайт
	 *
	 * @return void
	 */
	private function sale_file()
	{
		$filename = basename($_GET['filename']);

		$f = fopen(EXPORT_DIR.'/'.$filename, 'w');
		fwrite($f, file_get_contents('php://input'));
		fclose($f);
	
		$xml = simplexml_load_file(EXPORT_DIR.'/'.$filename);	
		unlink(EXPORT_DIR.'/'.$filename);
	
		foreach($xml->Документ as $xml_order)
		{
			$id = $xml_order->Номер;
			list($y, $m, $d) = explode('-', $xml_order->Дата);
			list($h, $i, $s) = explode(':', $xml_order->Время);
			$created = mktime($h, $i, $s, $m, $d, $y);

			if(isset($xml_order->ЗначенияРеквизитов->ЗначениеРеквизита))
			{
				foreach($xml_order->ЗначенияРеквизитов->ЗначениеРеквизита as $r)
				{
					switch ($r->Наименование)
					{
						case 'Проведен':
							$proveden = ($r->Значение == 'true');
							break;

						case 'ПометкаУдаления':
							$udalen = ($r->Значение == 'true');
							break;
					}
				}
			}

			if(! empty($udalen))
			{
				$status = 3;
			}
			elseif(! empty($proveden))
			{
				$status = 2;
			}
			else
			{
				$status = 0;
			}
			$status_id = DB::query_result("SELECT id FROM {shop_order_status} WHERE status=%d AND trash='0' LIMIT 1", $status);

			if(DB::query_result("SELECT id FROM {shop_order} WHERE id=%d", $id))
			{
				DB::query("UPDATE {shop_order} SET status='%d', status_id=%d, created=%d WHERE id=%d", $status, $status_id, $created, $id);
			}
			else
			{
				DB::query("INSERT INTO {shop_order} (status, status_id, created".($id ? ", id" : '').") VALUES ('%d', %d, %d".($id ? ", %d" : '').")", $status, $status_id, $created, $id);
				$id = DB::last_id("shop_order");
			}
			
			$order_goods = array();
			// Товары
			foreach($xml_order->Товары->Товар as $xml_product)
			{
				$good_id = 0;
				$order_good_id = 0;
				if(strstr($xml_product->Ид, '#'))
				{
					list($good_id, $order_good_id) = explode('#', $xml_product->Ид, 2);
				}
				else
				{
					$good_id = $xml_product->Ид;
				}

				$article = $xml_product->Артикул;
				$name = $xml_product->Наименование;
				$count_goods = $xml_product->Количество;
				$price = $xml_product->ЦенаЗаЕдиницу;
				$discount_id = 0;

				if(isset($xml_product->Скидки->Скидка))
				{
					$discount_id = DB::query_result("SELECT id FROM {shop_discount} WHERE discount=%d", $xml_product->Скидки->Скидка->Процент);
				}
				if($order_good_id && ! preg_match('/[^0-9]+/', $order_good_id))
				{
					$order_good_id = DB::query_result("SELECT id FROM {shop_order_goods} WHERE order_id=%d AND id=%d AND trash='0'", $order_good_id);
				}
				if($order_good_id)
				{
					DB::query("UPDATE {shop_order_goods} SET count_goods=%d, price=%d, discount_id=%d WHERE id=%d", $count_goods, $price, $discount_id, $order_good_id);
				}
				else
				{
					if($good_id)
					{
						$good_id = DB::query_result("DEV SELECT id FROM {shop} WHERE import_id='%h'".(! preg_match('/[^0-9]+/', $good_id) ? " OR id='%s'" : ''), $good_id, $good_id);
					}
					if(! $good_id && $article)
					{
						if(! $good_id = DB::query_result("SELECT id FROM {shop} WHERE article='%h'", $article))
							continue;
					}
					if(! $good_id && $name)
					{
						if(! $good_id = DB::query_result("SELECT id FROM {shop} WHERE [name]='%h'", $name))
							continue;
					}
					DB::query("INSERT INTO {shop_order_goods} (order_id, good_id, count_goods, price, discount_id) VALUES (%d, %d, %d, %f, %d)", $id, $good_id, $count_goods, $price, $discount_id);
					$order_good_id = DB::last_id("shop_order_goods");
				}
				$order_goods[] = $order_good_id;
			}
			// удаляет покупки, которых нет в файле
			if($order_goods)
			{
				$del_goods = array();
				$result = DB::query("SELECT id FROM {shop_order_goods} WHERE id NOT IN (%s) AND order_id=%d", implode(",", $order_goods), $id);
				while($row = DB::fetch_array($result))
				{
					$del_goods[] = $row["id"];
				}
				if($del_goods)
				{
					DB::query("DELETE FROM {shop_order_goods_param} WHERE order_good_id IN (%s)", implode(",", $del_goods));
					DB::query("DELETE FROM {shop_order_goods} WHERE id IN (%s)", implode(",", $del_goods));
				}
			}
			DB::query("UPDATE {shop_order} SET summ=%d WHERE id=%d", $xml_order->Сумма, $id);
		}

		echo "success";
		$this->set_last_1c_import();
	}

	/**
	 * Обмен информацией о заказах: успешное получение и запись заказов системой "1С:Предприятие"
	 *
	 * @return void
	 */
	private function sale_success()
	{
		$this->set_last_1c_import();
	}

	/**
	 * Обмен информацией о заказах: успешное получение и запись заказов системой "1С:Предприятие"
	 *
	 * @return void
	 */
	private function set_last_1c_import()
	{
		Customization::inc('includes/config.php');
		$config = new Config();
		$config->save(array('LAST_1C_EXPORT' => date('d.m.Y H:i')), $this->diafan->languages);
	}

	/**
	 * Выгрузка каталогов продукции: выгрузка на сайт файлов обмена
	 *
	 * @return void
	 */
	private function catalog_file()
	{
		$filename = basename($_GET['filename']);
		$f = fopen(EXPORT_DIR.'/'.$filename, 'ab');
		fwrite($f, file_get_contents('php://input'));
		fclose($f);
		echo "success\n";
	}

	/**
	 * Выгрузка каталогов продукции: пошаговая загрузка каталога 
	 *
	 * @return void
	 */
	private function catalog_import()
	{
		$filename = basename($_GET['filename']);
		$xml = simplexml_load_file(EXPORT_DIR.'/'.$filename);	
		unlink(EXPORT_DIR.'/'.$filename);
		$this->diafan->_cache->delete("", "shop");

		$site_id = DB::query_result("SELECT id FROM {site} WHERE module_name='shop' AND trash='0' AND [act]='1' LIMIT 1");
		if(isset($xml->Классификатор))
		{
			// Категории
			$this->import_categories($xml->Классификатор, $site_id);
			$this->import_params($xml->Классификатор);
		}
			
		if(isset($xml->Каталог))
		{
			$this->import_goods($xml->Каталог, $site_id);
		}
		
		if(isset($xml->ПакетПредложений))
		{
			$this->import_prices($xml->ПакетПредложений);
		}

		echo "success";
	}

	/**
	 * Импорт категорий
	 *
	 * @return void
	 */
	private function import_categories($xml, $site_id, $parent_id = 0, $parents = array())
	{
		if(! isset($xml->Группы->Группа))
			return;
		
		if($parent_id)
		{
			$parents[] = $parent_id;
		}

		foreach ($xml->Группы->Группа as $xml_group)
		{
			$row = DB::fetch_array(DB::query("SELECT id, parent_id FROM {shop_category} WHERE import_id='%h' LIMIT 1", $xml_group->Ид));
			$id = ! empty($row["id"]) ? $row["id"] : 0;

			if(! $id)
			{
				DB::query("INSERT INTO {shop_category} (import_id, [name], parent_id, site_id) VALUES ('%h', '%h', %d, %d)", $xml_group->Ид, $xml_group->Наименование, $parent_id, $site_id);
				$id = DB::last_id("shop_category");

				if($parents)
				{
					DB::query("INSERT INTO {shop_category_parents} (parent_id, element_id) VALUES (".implode(",".$id."), (", $parents).",".$id.")");
				}
			}
			else
			{
				DB::query("UPDATE {shop_category} SET parent_id=%d, [name]='%h' WHERE id=%d", $parent_id, $xml_group->Наименование, $xml_group->Ид);
				if($parent_id != $row["parent_id"])
				{
					DB::query("DELETE FROM {shop_category_parents} WHERE element_id=%d", $id);
					if($parents)
					{
						DB::query("INSERT INTO {shop_category_parents} (parent_id, element_id) VALUES (".implode(",".$id."), (", $parents).",".$id.")");
					}
				}
			}
			$_SESSION["1c_cats"][strval($xml_group->Ид)] = $id;
			$this->import_categories($xml_group, $site_id, $id, $parents);
		}
		if(! $parent_id)
		{
			// пересчитываем количество детей у всех категорий
			$result = DB::query("SELECT id FROM {shop_category}");
			while ($row = DB::fetch_array($result))
			{
				$count = DB::query_result("SELECT COUNT(*) FROM  {shop_category_parents} WHERE parent_id=%d", $row["id"]);
				DB::query("UPDATE {shop_category} SET count_children=%d WHERE id=%d", $count, $row["id"]);
			}
		}
	}

	/**
	 * Импорт дополнительных характеристик
	 *
	 * @return void
	 */
	function import_params($xml)
	{
		$property = array();
		if(isset($xml->Свойства->СвойствоНоменклатуры))
		{
			$property = $xml->Свойства->СвойствоНоменклатуры;
		}
			
		if(isset($xml->Свойства->Свойство))
		{
			$property = $xml->Свойства->Свойство;
		}

		foreach ($property as $xml_feature)
		{
			switch($xml_feature->ТипЗначений)
			{
				case 'Число':
					$type = 'numtext';
					break;
				case 'Справочник':
					$type = 'select';
					break;
				default:
					$type = 'text';
					break;
			}
			$row = DB::fetch_array(DB::query("SELECT id, type FROM {shop_param} WHERE [name]='%h' LIMIT 1", $xml_feature->Наименование));
			$values = array();
			if(! $row)
			{
				DB::query("INSERT INTO {shop_param} ([name], type) VALUES ('%h', '%s')", $xml_feature->Наименование, $type);
				$row["id"] = DB::last_id("shop_param");
				$row["type"] = $type;
				if($type == 'select' && ! empty($xml_feature->ВариантыЗначений->Справочник))
				{
					$i = 1;
					foreach($xml_feature->ВариантыЗначений->Справочник as $xml_s)
					{
						DB::query("INSERT INTO {shop_param_select} ([name], param_id, sort) VALUES ('%h', %d, %d)", $xml_s->Значение, $row["id"], $i++);
						$values[strval($xml_feature->Ид)] = DB::last_id("shop_param_select");
					}
				}
			}
			else
			{
				if($row["type"] == "multiple" && $type == 'select')
				{
					$type = 'multiple';
				}
				if($row["type"] != $type)
				{
					DB::query("UPDATE {shop_param} SET type='%s' WHERE id=%d", $type, $row["id"]);
				}
				if(($type == 'select' || $type == 'multiple') && ! empty($xml_feature->ВариантыЗначений->Справочник))
				{
					$i = 1;
					foreach($xml_feature->ВариантыЗначений->Справочник as $xml_s)
					{
						if(! $sel_id = DB::query_result("SELECT id FROM {shop_param_select} WHERE [name]='%h' AND param_id=%d", $xml_s->Значение, $row["id"]))
						{
							DB::query("INSERT INTO {shop_param_select} ([name], param_id, sort) VALUES ('%h', %d, %d)", $xml_s->Значение, $row["id"], $i++);
							$sel_id = DB::last_id("shop_param_select");
						}
						$values[strval($xml_s->ИдЗначения)] = $sel_id;
					}
				}
				DB::query("DELETE FROM {shop_param_category_rel} WHERE element_id=%d", $row["id"]);
			}
			$row["values"] = $values;
			$this->cache["params"][strval($xml_feature->Ид)] = $row;
		}
	}

	/**
	 * Импорт товаров
	 *
	 * @return void
	 */
	function import_goods($xml, $site_id)
	{
		if(! isset($xml->Товары->Товар))
			return;

		foreach ($xml->Товары->Товар as $xml_product)
		{
			if(strpos(strval($xml_product->Ид), '#') !== false)
			{
				list($good_id_1c, $variant_id_1c) = explode('#', strval($xml_product->Ид), 2);
			}
			else
			{
				$good_id_1c = strval($xml_product->Ид);
				$variant_id_1c = strval($xml_product->Ид);
			}

			// если товар уже выгружали, то это вариация
			if(empty($this->cache["goods"][$good_id_1c]))
			{
				$row = DB::fetch_array(DB::query("SELECT id, cat_id, article, [name], [text], [anons], cat_id FROM {shop} WHERE import_id='%h' AND trash='0' LIMIT 1", $good_id_1c));
	
				$id = ! empty($row["id"]) ? $row["id"] : 0;
	
				// удаление товара
				if($xml_product->Статус == 'Удален')
				{
					if($id)
					{
						$this->delete_good($id);
					}
					continue;
				}
	
				// категория
				if(isset($xml_product->Группы->Ид))
				{
					$cat_id = $_SESSION["1c_cats"][strval($xml_product->Группы->Ид)];
				}
				else
				{
					$cat_id = 0;
				}
	
				// описание
				$description = '';
				if(!empty($xml_product->Описание))
				{
					$description = strval($xml_product->Описание);
				}
	
				if(! $id)
				{
					DB::query("INSERT INTO {shop} ([name], [text], [anons], article, import_id, cat_id, site_id, timeedit) VALUES ('%h', '%s', '%s', '%h', '%h', %d, %d, %d)", $xml_product->Наименование, $description, $description, $xml_product->Артикул, $good_id_1c, $cat_id, $site_id, time());
					$id = DB::last_id("shop");
					if($cat_id)
					{
						DB::query("INSERT INTO {shop_category_rel} (cat_id, element_id) VALUES (%d, %d)", $cat_id, $id);
					}
					$this->import_img($xml_product, $id, $site_id);
				}
				else
				{
					$edit = false;
					if($cat_id != $row["cat_id"])
					{
						DB::query("DELETE FROM {shop_category_rel} WHERE element_id=%d", $id);
						if($cat_id)
						{
							DB::query("INSERT INTO {shop_category_rel} (cat_id, element_id) VALUES (%d, %d)", $cat_id, $id);
						}
						$edit = true;
					}
					if($this->import_img($xml_product, $id, $site_id))
					{
						$edit = true;
					}

					if($edit
					   || $row["name"] != strval($xml_product->Наименование)
					   || $row["anons"] != $description
					   || $row["text"] != $description
					   || $row["article"] != strval($xml_product->Артикул))
					{
						DB::query("UPDATE {shop} SET [name]='%h', [text]='%s', [anons]='%s', article='%h', cat_id=%d, timeedit=%d WHERE id=%d", $xml_product->Наименование, $description, $description, $xml_product->Артикул, $cat_id, time(), $id);
					}
				}
				$this->cache["goods"][$good_id_1c] = $id;

				// дополнительные характеристики
				if(isset($xml_product->ЗначенияСвойств->ЗначенияСвойства))
				foreach ($xml_product->ЗначенияСвойств->ЗначенияСвойства as $xml_option)
				{
					if(! empty($this->cache["params"][strval($xml_option->Ид)]))
					{
						$param_id = $this->cache["params"][strval($xml_option->Ид)]["id"];
						if($cat_id)
						{
							if(empty($this->cache["params_cats"][$param_id][$cat_id]))
							{
								DB::query("INSERT INTO {shop_param_category_rel} (element_id, cat_id) VALUES (%d, %d)", $param_id, $cat_id);
								$this->cache["params_cats"][$param_id][$cat_id] = true;
							}
						}
						DB::query("DELETE FROM {shop_param_element} WHERE param_id=%d AND element_id=%d", $param_id, $id);
						$i = 0;
						foreach($xml_option->Значение as $xml_value)
						{
							if($xml_value)
							{
								if($this->cache["params"][strval($xml_option->Ид)]["type"] == 'select' || $this->cache["params"][strval($xml_option->Ид)]["type"] == 'multiple')
								{
									$val = $this->cache["params"][strval($xml_option->Ид)]["values"][strval($xml_value)];
								}
								else
								{
									$val = strval($xml_value);
								}
								DB::query("INSERT INTO {shop_param_element} (param_id, element_id, [value]) VALUES (%d, %d, '%s')", $param_id, $id, $val);
							}
							$i++;
						}
						if($i > 1 && $this->cache["params"][strval($xml_option->Ид)]["type"] == 'select')
						{
							$this->cache["params"][strval($xml_option->Ид)]["type"] = 'multiple';
							DB::query("UPDATE {shop_param} SET type='multiple' WHERE id=%d", $param_id);
						}
					}
				}

				// дополнительные характеристики
				if(isset($xml_product->ЗначенияРеквизитов->ЗначениеРеквизита))
				foreach ($xml_product->ЗначенияРеквизитов->ЗначениеРеквизита as $xml_option)
				{
					if(empty($this->cache["params_name"][strval($xml_option->Наименование)]))
					{
						$this->cache["params_name"][strval($xml_option->Наименование)] = DB::query_result("SELECT id FROM {shop_param} WHERE [name]='%h' AND trash='0'", strval($xml_option->Наименование));
						if(! $this->cache["params_name"][strval($xml_option->Наименование)])
						{
							DB::query("INSERT INTO {shop_param} ([name], type) VALUES ('%h', 'text')", strval($xml_option->Наименование));
							$this->cache["params_name"][strval($xml_option->Наименование)] = DB::last_id("shop_param");
						}
					}
					$param_id = $this->cache["params_name"][strval($xml_option->Наименование)];
					if($cat_id)
					{
						if(empty($this->cache["params_cats"][$param_id][$cat_id]))
						{
							DB::query("INSERT INTO {shop_param_category_rel} (element_id, cat_id) VALUES (%d, %d)", $param_id, $cat_id);
							$this->cache["params_cats"][$param_id][$cat_id] = true;
						}
					}
					DB::query("DELETE FROM {shop_param_element} WHERE param_id=%d AND element_id=%d", $param_id, $id);
					foreach($xml_option->Значение as $xml_value)
					{
						DB::query("INSERT INTO {shop_param_element} (param_id, element_id, [value]) VALUES (%d, %d, '%s')", $param_id, $id, strval($xml_value));
					}
				}
			}
			$params = $this->price_param($xml_product, $row["cat_id"]);
			if($variant_id_1c && $params)
			{
				$this->get_empty_param($params, $row["cat_id"]);
				if($price = $this->diafan->_shop->price_get($row["id"], $params, 0))
				{
					DB::query("DELETE FROM {shop_price} WHERE price_id=%d", $price["id"]);
					DB::query("DELETE FROM {shop_price_param} WHERE price_id=%d", $price["id"]);
				}

				$this->diafan->_shop->price_insert($row["id"], 0, 0, $params, 0, $variant_id_1c);
			}
		}
	}
	
	/**
	 * Импорт изображений
	 * 
	 * @param object $xml_product данные о товаре из 1C
	 * @param integer $id идентификатор товара
	 * @param integer $site_id раздел сайта, к которому прикреплен товар
	 * @return boolean
	 */
	private function import_img($xml_product, $id, $site_id)
	{
		$edit = false;
		if(isset($xml_product->Картинка))
		{
			$this->diafan->_images->delete($id, 'shop');
			if(is_object($xml_product->Картинка))
			{
				foreach($xml_product->Картинка as $img)
				{
					$image_address = EXPORT_DIR.'/'.$img;
					if(is_file($image_address))
					{
						$image_name = $xml_product->Наименование ? preg_replace('/[^A-Za-z0-9-_]+/', '', strtolower($this->diafan->translit(substr($xml_product->Наименование, 0, 50)))) : $id;
						$this->diafan->_images->upload($id, 'shop', $site_id, $image_address, $image_name, false);
						$edit = true;
					}
				}
			}
			else
			{
				$image = basename($xml_product->Картинка);
				$image_address = EXPORT_DIR.'/'.$image;
				if(!empty($image) && is_file($image_address))
				{
					$image_name = $xml_product->Наименование ? preg_replace('/[^A-Za-z0-9-_]+/', '', strtolower($this->diafan->translit(substr($xml_product->Наименование, 0, 50)))) : $id;
					$this->diafan->_images->upload($id, 'shop', $site_id, $image_address, $image_name, false);
					$edit = true;
				}
			}
		}
		return $edit;
	}

	/**
	 * Импорт цен и количества
	 *
	 * @return void
	 */
	function import_prices($xml)
	{
		if(! isset($xml->Предложения->Предложение))
			return;

		foreach ($xml->Предложения->Предложение as $xml_variant)
		{
			if(empty($xml_variant->Цены))
				continue;

			if(strpos($xml_variant->Ид, '#') !== false)
			{
				list($good_id_1c, $variant_id_1c) = explode('#', $xml_variant->Ид, 2);
			}
			else
			{
				$good_id_1c = $xml_variant->Ид;
				$variant_id_1c = $xml_variant->Ид;
			}

			$row = DB::fetch_array(DB::query("SELECT id, cat_id FROM {shop} WHERE import_id='%s' AND trash='0' LIMIT 1", $good_id_1c));
			if(! $row)
				continue;

			$currency_id = 0;
			if(! empty($xml_variant->Цены->Цена->Валюта))
			{
				$currency_id = DB::query_result("SELECT id FROM {shop_currency} WHERE  name='%h' AND trash='0' LIMIT 1", $xml_variant->Цены->Цена->Валюта);
			}
			$params = $this->price_param($xml_variant, $row["cat_id"]);
			$this->get_empty_param($params, $row["cat_id"]);

			$this->diafan->_shop->price_insert($row["id"], str_replace(',', '.', $xml_variant->Цены->Цена->ЦенаЗаЕдиницу), (! empty($xml_variant->Количество) ? $xml_variant->Количество :  0), $params, $currency_id, $variant_id_1c);
			$this->diafan->_shop->price_calc($row["id"]);
		}
	}
	
	function price_param($xml_product, $cat_id)
	{
		if(! isset($this->cache["multiple_params"]))
		{
			$this->cache["multiple_params"] = array();
			$result = DB::query("SELECT id FROM {shop_param} WHERE type='multiple' AND required='1' AND trash='0'");
			while($row = DB::fetch_array($result))
			{
				$row["cats"] = array();
				$result2 = DB::query("SELECT cat_id FROM {shop_param_category_rel} WHERE element_id=%d", $row["id"]);
				while ($row2 = DB::fetch_array($result2))
				{
					$row["cats"][] = $row2["cat_id"];
				}
				if(! $row["cats"])
				{
					$row["cats"][] = 0;
				}
				$this->cache["multiple_params"][$row["id"]] = $row;
			}
		}

		$params = array();
		if(isset($xml_product->ХарактеристикиТовара->ХарактеристикаТовара))
		{
			foreach($xml_product->ХарактеристикиТовара->ХарактеристикаТовара as $xml_property)
			{
				$name = strval($xml_property->Наименование);
				if(! isset($this->cache["1_params"][$name]))
				{
					$r = DB::fetch_array(DB::query("SELECT id, reqiured FROM {shop_param} WHERE [name]='%h' AND type='multiple' AND trash='0' LIMIT 1", $name));
					if(! $r)
					{
						DB::query("INSERT INTO {shop_param} ([name], type, required) VALUES ('%h', 'multiple', '1')", $xml_property->Наименование);
						$r["id"] = DB::last_id("shop_param");
						$this->cache["multiple_params"][$r["id"]] = array("id" => $r["id"], "cats" => array($cat_id));
						DB::query("INSERT INTO {shop_param_category_rel} (element_id, cat_id) VALUES (%d, %d)", $r["id"], $cat_id);
					}
					elseif(! $r["reqiured"])
					{
						DB::query("UPDATE {shop_param} SET required='1' WHERE id=%d", $r["id"]);
					}
					$this->cache["1_params"][$name] = $r["id"];
				}
				if($param_id = $this->cache["1_params"][$name])
				{
					$param_value = strval($xml_property->Значение);
					if(! isset($this->cache["params_select"][$param_id][$param_value]))
					{
						$r_v = DB::query_result("SELECT id FROM {shop_param_select} WHERE param_id=%d AND [name]='%h' LIMIT 1", $param_id, $param_value);
						if(! $r_v)
						{
							DB::query("INSERT INTO {shop_param_select} ([name], param_id) VALUES ('%h', %d)", $param_value, $param_id);
							$r_v = DB::last_id("shop_param_select");
						}
						$this->cache["params_select"][$param_id][$param_value] = $r_v;
					}
					$value = $this->cache["params_select"][$param_id][$param_value];
					if($value)
					{
						$params[$param_id] = $value;
					}
					if(empty($this->cache["multiple_params"][$param_id]))
					{
						$this->cache["multiple_params"][$param_id] = array("id" => $param_id, "cats" => array($cat_id));
					}
					if(! in_array($cat_id, $this->cache["multiple_params"][$param_id]["cats"]))
					{
						$this->cache["multiple_params"][$param_id]["cats"][] = $cat_id;
						DB::query("INSERT INTO {shop_param_category_rel} (element_id, cat_id) VALUES (%d, %d)", $param_id, $cat_id);
					}
				}
			}
		}
		return $params;
	}

	function get_empty_param(&$params, $cat_id)
	{
		$current_params = array();
		foreach($this->cache["multiple_params"] as $p)
		{
			if(in_array(0, $p["cats"]) || in_array($cat_id, $p["cats"]))
			{
				if(!in_array($p["id"], array_keys($params)))
				{
					$params[$p["id"]] = 0;
				}
				$current_params[] = $p["id"];
			}
		}
		foreach($params as $p => $v)
		{
			if(! in_array($p, $current_params))
			{
				if(in_array($p, array_keys($this->cache["multiple_params"])))
				{
					DB::query("INSERT INTO {shop_param_category_rel} (element_id, cat_id) VALUES (%d, %d)", $p, $cat_id);
					$this->cache["multiple_params"][$p]["cats"][] = $cat_id;
				}
				else
				{
					DB::query("INSERT INTO {shop_param_category_rel} (element_id, cat_id) VALUES (%d, %d)", $p, $cat_id);
					DB::query("UPDATE {shop_param} SET type='multiple', required='1' WHERE id=%d", $p);
					$this->cache["multiple_params"][$p] = array("id" => $p, "cats" => array($cat_id));
				}
			}
		}
	}

	/**
	 * Удаление товара
	 *
	 * @param integer идентификатор товара
	 * @return void
	 */
	function delete_good($id)
	{
		DB::query("DELETE FROM {shop_category_rel} WHERE element_id=%d", $id);
		DB::query("DELETE FROM {shop_rel} WHERE element_id=%d OR rel_element_id=%d", $id, $id);
		DB::query("DELETE FROM {shop_cart} WHERE good_id=%d", $id);
		DB::query("DELETE FROM {shop_wishlist} WHERE good_id=%d", $id);
		DB::query("DELETE FROM {shop_waitlist} WHERE good_id=%d", $id);
		DB::query("DELETE FROM {shop_price_param} WHERE price_id IN (SELECT price_id FROM {shop_price} WHERE good_id=%d)", $id);
		DB::query("DELETE FROM {shop_price} WHERE good_id=%d", $id);
		DB::query("DELETE FROM {shop_param_element} WHERE element_id=%d", $id);
		DB::query("DELETE FROM {shop_discount_object} WHERE good_id=%d", $id);
		DB::query("DELETE FROM {access} WHERE module_name='shop' AND element_id=%d", $id);
		DB::query("DELETE FROM {menu} WHERE module_name='shop' AND element_id=%d", $id);
		DB::query("DELETE FROM {rewrite} WHERE module_name='shop' AND element_id=%d", $id);
		if(DB::query_result("SELECT id FROM {modules} WHERE module_name='comments' LIMIT 1"))
		{
			DB::query("DELETE FROM {comments} WHERE module_name='shop' AND element_id=%d", $id);
		}
		if(DB::query_result("SELECT id FROM {modules} WHERE module_name='tags' LIMIT 1"))
		{
			DB::query("DELETE FROM {tags} WHERE module_name='tags' AND element_id=%d", $id);
		}
		if(DB::query_result("SELECT id FROM {modules} WHERE module_name='rating' LIMIT 1"))
		{
			DB::query("DELETE FROM {rating} WHERE module_name='shop' AND element_id=%d", $id);
		}
		$this->diafan->_images->delete($id, 'shop');

		$this->diafan->_attachments->delete($id, 'shop');

		DB::query("DELETE FROM {shop} WHERE id=%d", $id);
	}
}

define('EXPORT_DIR', ABSOLUTE_PATH.'cache/1c');
$shop_1c = new Shop_1c($this->diafan);
$shop_1c->start();

exit;