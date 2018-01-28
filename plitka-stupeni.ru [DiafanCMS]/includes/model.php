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
 * Model
 * 
 * Каркас для модели модуля
 */
abstract class Model
{
	/**
	 * @var array сгенерированные в моделе данные, передаваемые в шаблон
	 */
	protected $result;

	/**
	 * @var Init основной объект системы
	 */
	protected $diafan;

	/**
	 * @var string текущий модуль, для котого вызвана шаблонная функция
	 */
	private $current_module;

	/**
	 * Конструктор класса
	 *
	 * @param Init $diafan
	 * @return \Model
	 */
	public function __construct(&$diafan, $current_module = '')
	{
		$this->diafan = &$diafan;
		$this->current_module = $current_module;
	}

	/**
	 * Проверяет есть ли доступ к элементу/категории модуля
	 *
	 * @param integer $element_id номер элемента
	 * @param integer $cat_id номер категории
	 * @param string $module_name модуль
	 * @return boolean
	 */
	protected function access($element_id, $cat_id = 0, $module = '')
	{
		if (!$module)
		{
			$module = $this->diafan->module;
		}

		if (! $this->diafan->_user->id)
		{
			return false;
		}

		return (bool)DB::query_result("SELECT role_id FROM {access} WHERE element_id=%d AND cat_id=%d AND module_name='%s' AND role_id=%d LIMIT 1", $element_id, $cat_id, $module, $this->diafan->_user->role_id);
	}

	/**
	 * Форматирует дату в соответствии с конфигурацией модуля
	 * 
	 * @param integer $date дата в формате UNIX
	 * @param string $module_name название модуля, по умолчанию модуль, прикрепленный к текущей странице
	 * @param integer $site_id номер страницы сайта
	 * @return string
	 */
	protected function format_date($date, $module_name = '', $site_id = 0)
	{
		$months_array = array(
			'01' => $this->diafan->_('января'),
			'02' => $this->diafan->_('февраля'),
			'03' => $this->diafan->_('марта'),
			'04' => $this->diafan->_('апреля'),
			'05' => $this->diafan->_('мая'),
			'06' => $this->diafan->_('июня'),
			'07' => $this->diafan->_('июля'),
			'08' => $this->diafan->_('августа'),
			'09' => $this->diafan->_('сентября'),
			'10' => $this->diafan->_('октября'),
			'11' => $this->diafan->_('ноября'),
			'12' => $this->diafan->_('декабря')
		);
		$week_array = array(
			'1' => $this->diafan->_('понедельник'),
			'2' => $this->diafan->_('вторник'),
			'3' => $this->diafan->_('среда'),
			'4' => $this->diafan->_('четверг'),
			'5' => $this->diafan->_('пятница'),
			'6' => $this->diafan->_('суббота'),
			'0' => $this->diafan->_('воскресенье')
		);
		if (!$module_name)
		{
			$module_name = $this->diafan->module;
		}
		if (!$site_id)
		{
			$site_id = $this->diafan->cid;
		}

		$config_format = $this->diafan->configmodules("format_date", $module_name, $site_id);

		switch ($config_format)
		{
			case 1:
			return date("d ", $date).$months_array[date("m", $date)].date(" Y ", $date).' '.$this->diafan->_('г.');
		
			case 2:
			return date("d ", $date).$months_array[date("m", $date)];
		
			case 3:
			return date("d ", $date).$months_array[date("m", $date)].date(" Y, ", $date).$week_array[date("w", $date)];
		
			case 4:
			return '';
		
			case 5:
			return $this->format_date_5($date);
		
			default:
			return date("d.m.Y", $date);
		}
	}

	/**
	 * Получает имя, никнейм и аватар пользователя сайта
	 * 
	 * @param integer $author номер пользователя сайта
	 * @return array
	 */
	protected function get_author($author)
	{
		if (!$author)
			return $this->diafan->_('Гость');

		global $authors;
		if (empty($authors[$author]))
		{
			if ($this->diafan->_user->id != $author)
			{
				$authors[$author] = DB::fetch_array(DB::query("SELECT fio, name, identity FROM {users} WHERE act='1' AND trash='0' AND id=%d LIMIT 1", $author));
				if ($this->diafan->configmodules("avatar", "users"))
				{
					$authors[$author]["avatar"] = file_exists(ABSOLUTE_PATH.USERFILES.'/avatar/'.$authors[$author]["name"].'.png') ? BASE_PATH.USERFILES.'/avatar/'.$authors[$author]["name"].'.png' : '';
					$authors[$author]["avatar_width"] = $this->diafan->configmodules("avatar_width", "users");
					$authors[$author]["avatar_height"] = $this->diafan->configmodules("avatar_height", "users");
				}
			}
			else
			{
				$avatar = file_exists(ABSOLUTE_PATH.USERFILES.'/avatar/'.$this->diafan->_user->name.'.png') ? BASE_PATH.USERFILES.'/avatar/'.$this->diafan->_user->name.'.png?'.date('H') : '';
				$authors[$author] = array(
					"fio" => $this->diafan->_user->fio,
					"name" => $this->diafan->_user->name,
					"identity" =>  $this->diafan->_user->identity
				);
				if ($this->diafan->configmodules("avatar", "users"))
				{
					$authors[$author]["avatar"] = $avatar;
					$authors[$author]["avatar_width"] = $this->diafan->configmodules("avatar_width", "users");
					$authors[$author]["avatar_height"] = $this->diafan->configmodules("avatar_height", "users");
				}
			}

			$user_page = $this->diafan->_route->module("userpage", true);
			
			if($authors[$author]["identity"])
			{
				$authors[$author]["user_page"] = $authors[$author]["identity"];
			}
			elseif(! empty($user_page) && array_key_exists('name', $authors[$author]))
			{
				$authors[$author]["user_page"] = BASE_PATH_HREF.$user_page.'?'.$authors[$author]['name'];
			}
			if($this->diafan->configmodules("mail_as_login", "users"))
			{
				$authors[$author]["name"] = '';
			}

		}
		return $authors[$author];
	}

	/**
	 * Осуществляет "Умное" форматирование даты
	 * 
	 * @param integer $date дата в формет UNIX
	 * @return string
	 */
	private function format_date_5($date)
	{
		if (!$date)
			return '';

		$months_array = array(
			'01' => $this->diafan->_('января'),
			'02' => $this->diafan->_('февраля'),
			'03' => $this->diafan->_('марта'),
			'04' => $this->diafan->_('апреля'),
			'05' => $this->diafan->_('мая'),
			'06' => $this->diafan->_('июня'),
			'07' => $this->diafan->_('июля'),
			'08' => $this->diafan->_('августа'),
			'09' => $this->diafan->_('сентября'),
			'10' => $this->diafan->_('октября'),
			'11' => $this->diafan->_('ноября'),
			'12' => $this->diafan->_('декабря')
		);
		$week_array = array(
			'1' => $this->diafan->_('понедельник'),
			'2' => $this->diafan->_('вторник'),
			'3' => $this->diafan->_('среда'),
			'4' => $this->diafan->_('четверг'),
			'5' => $this->diafan->_('пятница'),
			'6' => $this->diafan->_('суббота'),
			'0' => $this->diafan->_('воскресенье')
		);
		if (time() - $date < 3600)
		{
			$min = round((time() - $date) / 60);
			if ($min < 2)
			{
			return $this->diafan->_('1 минуту назад');
			}
			if ($min % 10 == 1 && $min > 20)
			{
			return $this->diafan->_('%s минуту назад', false, $min);
			}
			if ($min % 10 < 4 && ($min > 20 || $min < 10))
			{
			return $this->diafan->_('%s минуты назад', false, $min);
			}
			return $this->diafan->_('%s минут назад', false, $min);
		}

		if ($date >= mktime(0, 0, 0, date("m"), date("d"), date("Y")))
		{
			return  $this->diafan->_('Сегодня').', '.date("H:i", $date);
		}

		if ($date >= mktime(0, 0, 0, date("m"), date("d"), date("Y")) - 86400)
		{
			return $this->diafan->_('Вчера').', '.date("H:i", $date);
		}

		if ($date >= time() - 86400 * 30)
		{
			return date("d ", $date).$months_array[date("m", $date)].', '.$week_array[date("w", $date)];
		}

		if (date("Y", $date) == date("Y"))
		{
			return date("d ", $date).$months_array[date("m", $date)];
		}
		return date("d ", $date).$months_array[date("m", $date)].date(" Y ", $date).' '.$this->diafan->_('г.');
	}

	/**
	 * Выдает ошибку о неправильном заполнении формы
	 * 
	 * @param string $module название модуля
	 * @param string $field название поля
	 * @return string
	 */
	protected function get_error($module = '', $field = '')
	{
		if (empty($_SERVER["HTTP_REFERER"]))
			return '';

		$ref = parse_url($_SERVER["HTTP_REFERER"]);

		if ($ref["host"] != $_SERVER["HTTP_HOST"])
			return '';

		$field = 'mess'.($field ? '-'.$field : '');
		if (empty($_GET["error"]) || $_GET["error"] != $module || empty($_GET[$field]))
			return '';

		return $this->diafan->get_param($_GET, $field, '', 1);
	}

	/**
	 * Получает массив полей формы
	 * 
	 * @param array $config настройки функции: module модуль, table таблица, where условие для SQL-запроса
	 * @return array
	 */
	public function get_params($config)
	{
		if (! empty($config["module"]))
		{
			$module = $config["module"];
		}
		else
		{
			$module = $this->diafan->module;
		}
		if (! empty($config["table"]))
		{
			$table =  $config["table"];
		}
		else
		{
			$table =  $module;
		}

		$where = "";
		if (! empty($config["where"]))
		{
			$where = " AND ".$config["where"];
		}

		$cache_meta = array(
			"name" => $module."_param",
			"lang_id" => _LANG,
			"where" => $where
		);
		if (! $rows_param = $this->diafan->_cache->get($cache_meta, $module))
		{
			$rows_param = array();
			$result = DB::query("SELECT id, [name], type, required, [text], config FROM {".$table."_param} WHERE trash='0'"
			                    .$where." ORDER BY sort ASC");
	
			while ($row = DB::fetch_array($result))
			{
				if ($row["type"] == 'select' || $row["type"] == 'multiple' || $row["type"] == 'checkbox')
				{
					$result_select = DB::query("SELECT [name], id, value FROM {".$table."_param_select} WHERE param_id=%d"
					                           ." ORDER BY sort ASC", $row["id"]);
					while ($row_select = DB::fetch_array($result_select))
					{
						$row["select_array"][] = $row_select;
						$row["select_values"][$row["type"] == 'checkbox' ? $row_select["value"] : $row_select["id"]] = $row_select["name"];
					}
				}
				if($row["type"] == 'attachments')
				{
					$config = unserialize($row["config"]);
					$row["max_count_attachments"] = ! empty($config["max_count_attachments"]) ? $config["max_count_attachments"] : 0;
					$row["attachments_access_admin"] = ! empty($config["attachments_access_admin"]) ? $config["attachments_access_admin"] : 0;
					$row["attachment_extensions"] = ! empty($config["attachment_extensions"]) ? $config["attachment_extensions"] : '';
					$row["use_animation"] = ! empty($config["use_animation"]) ? true : false;
				}
				$rows_param[] = $row;
			}
			//сохранение кеша
			$this->diafan->_cache->save($rows_param, $cache_meta, $module);
		}
		return $rows_param;
	}

	/**
	 * Генерирует данные для навигации "Хлебные крошки"
	 *
	 * @param string $module модуль
	 * @return array
	 */
	protected function get_path($module)
	{
		$path = '';
		if ($this->diafan->cat || $this->diafan->param || $this->diafan->show || ! empty($_GET["action"])
			|| $this->diafan->year)
		{
			$path[] = array("link" => $this->diafan->_route->link($this->diafan->cid), "name" => $this->diafan->name);
		}

		if ($this->diafan->cat)
		{
			$parents = $this->diafan->get_parents($this->diafan->cat, $module.'_category');
			$parents[] = $this->diafan->cat;

			if (!$this->diafan->show && !isset($_GET["catid"]))
			{
				unset($parents[count($parents) - 1]);
			}
			if (!empty($parents))
			{
				$rparents = array();
				$result = DB::query("SELECT id, [name], site_id, parent_id FROM {".$module."_category} WHERE id IN (%s)", implode(',', $parents));
				while ($row = DB::fetch_array($result))
				{
					$rparents[$row["parent_id"]] = $row;
				}
				$i = 0;
				while(! empty($rparents[$i]))
				{
					$row = $rparents[$i];
					unset($rparents[$i]);
					$i = $row["id"];
					$path[] = array("id" => $row["id"], "link" => $this->diafan->_route->link($row["site_id"], $module, $row["id"]), "name" => $row["name"]);
				}
			}
		}
		return $path;
	}
	
	/**
	 * Валидация атрибутов cat_id и site_id для шаблонных тегов
	 *
	 * @param string $module_name название модуля
	 * @param array $site_id страница сайта
	 * @param array $cat_id категория
	 * @return boolean
	 */
	protected function validate_attribute_site_cat($module_name, &$site_ids, &$cat_ids)
	{
		if (! empty($cat_ids) && count($cat_ids) == 1 && empty($cat_ids[0]))
		{
			$cat_ids = array();
		}
		if (! empty($site_ids) && count($site_ids) == 1 && empty($site_ids[0]))
		{
			$site_ids = array();
		}
		if (! empty($cat_ids))
		{
			$new_site_ids = array();
			$new_cat_ids = array();
			foreach($cat_ids as $cat_id)
			{
				$cat_id = trim($cat_id);
				if(preg_replace('/[^0-9]+/', '', $cat_id) != $cat_id)
				{
					$this->error_insert_tag('Атрибут cat_id="%s" задан неверно. Номер категории %s должен быть числом.', $module_name, implode(',', $cat_ids), $cat_id);
					return false;
				}
				elseif(in_array($cat_id, $new_cat_ids))
				{
					$this->error_insert_tag('Атрибут cat_id="%s" задан неверно. Повторяется категория %s.', $module_name, implode(',', $cat_ids), $cat_id);
					return false;
				}
				else
				{
					$new_cat_ids[] = $cat_id;
				}
			}
			$cat_ids = $new_cat_ids;
			$new_cat_ids = array();
			$isset_cat_ids = array();
			$result = DB::query("SELECT id, access, site_id, [act], trash FROM {%h_category} WHERE id IN (%h)", $module_name, implode(",", $cat_ids));
			while($row = DB::fetch_array($result))
			{
				if(! $this->diafan->configmodules("cat", $module_name, $row["site_id"]))
				{
					$this->error_insert_tag('Атрибут cat_id="%s" задан неверно. Категории не подключены в настроках модуля.', $module_name, implode(',', $cat_ids), $row["id"]);
					return false;
				}
				if(! $row["act"])
				{
					$this->error_insert_tag('Атрибут cat_id="%s" задан неверно. Категория %d скрыта на сайте.', $module_name, implode(',', $cat_ids), $row["id"]);
					return false;
				}
				if($row["trash"])
				{
					$this->error_insert_tag('Атрибут cat_id="%s" задан неверно. Категория %d удалена.', $module_name, implode(',', $cat_ids), $row["id"]);
					return false;
				}
				$isset_cat_ids[] = $row["id"];

				if($row["access"] && ! $this->access(0, $row["id"], $module_name))
					continue;

				if(! in_array($row["id"], $new_cat_ids))
				{
					$new_cat_ids[] = $row["id"];
				}
				if ($this->diafan->configmodules("children_elements", $module_name, $row["site_id"]))
				{
					$cats = $this->diafan->get_children($row["id"], $module_name."_category");
					$new_cat_ids = array_merge($new_cat_ids, $cats);
				}
				if(! in_array($row["site_id"], $new_site_ids))
				{
					$new_site_ids[] = $row["site_id"];
				}
			}
			// нет доступа к категориям для текущего пользователя
			if(! $new_cat_ids)
			{
				return false;
			}
			foreach($cat_ids as $cat_id)
			{
				if(! in_array($cat_id, $isset_cat_ids))
				{
					$this->error_insert_tag('Атрибут cat_id="%s" задан неверно. Категория %s не существует.', $module_name, implode(',', $cat_ids), $cat_id);
					return false;
				}
			}
			$cat_ids = $new_cat_ids;
			$site_ids = $new_site_ids;
			return true;
		}
		if(! $new_site_ids = $this->diafan->_route->id_module($module_name, $site_ids))
		{
			if($site_ids)
			{
				$this->error_insert_tag('Атрибут site_id="%s" задан неверно. Страницы с подключенным модулем с таким номером не существует.', $module_name, implode(',', $site_ids));
			}
			else
			{
				$this->error_insert_tag('Страницы с подключенным модулем не существует.', $module_name);
			}
			return false;
		}
		else
		{
			$site_ids = $new_site_ids;
		}
		return true;
	}
	
	/**
	 * Выводит ошибку на сайте
	 *
	 * @param string $error описание ошибки
	 * @param string $module_name название модуля
	 * @return void
	 */
	private function error_insert_tag($error, $module_name)
	{
		if(! MOD_DEVELOPER)
			return;

		$args = func_get_args();
		unset($args[0]);
		unset($args[1]);
		$error = $this->diafan->_languages->get($error, $module_name, false, $args);
		Dev::$errors[] = array('insert tag', $error, htmlentities($this->diafan->current_insert_tag));

		$c = count(Dev::$errors);
		echo '<a href="#error'.$c.'" style="color:red">[ERROR#'.$c.']</a>';
	}
	
	/**
	 * Определяет шаблоны страницы и модуля для элемента
	 *
	 * @return void
	 */
	protected function theme_view()
	{
		if($this->diafan->configmodules("theme_list"))
		{
			$this->result["theme"] = $this->diafan->configmodules("theme_list");
		}
		if($this->diafan->configmodules("view_list"))
		{
			$this->result["view"] = $this->diafan->configmodules("view_list");
		}
		else
		{
			$this->result["view"] = 'list';
		}
	}
	
	/**
	 * Определяет шаблоны страницы и модуля для первой страницы модуля, если используются категории
	 *
	 * @return void
	 */
	protected function theme_view_first_page()
	{
		if($this->diafan->configmodules("theme_first_page"))
		{
			$this->result["theme"] = $this->diafan->configmodules("theme_first_page");
		}
		if($this->diafan->configmodules("view_first_page"))
		{
			$this->result["view"] = $this->diafan->configmodules("view_first_page");
		}
		else
		{
			$this->result["view"] = 'first_page';
		}
	}
	
	/**
	 * Определяет шаблоны страницы и модуля для категории
	 *
	 * @param array $row данные о текущей категории
	 * @return void
	 */
	protected function theme_view_cat($row)
	{
		if($row["theme"])
		{
			$this->result["theme"] = $row["theme"];
		}
		elseif($this->diafan->configmodules("theme_list"))
		{
			$this->result["theme"] = $this->diafan->configmodules("theme_list");
		}

		if($row["view"])
		{
			$this->result["view"] = $row["view"];
		}
		elseif($this->diafan->configmodules("view_list"))
		{
			$this->result["view"] = $this->diafan->configmodules("view_list");
		}
		else
		{
			$this->result["view"] = 'list';
		}
	}
	
	/**
	 * Определяет шаблоны страницы и модуля для элемента
	 *
	 * @param array $row данные о текущем элементе
	 * @return void
	 */
	protected function theme_view_element($row)
	{
		if($this->diafan->configmodules("cat"))
		{
			$cat = DB::fetch_array(DB::query("SELECT theme, view_element FROM {%s_category} WHERE id=%d LIMIT 1", $this->diafan->module, $row["cat_id"]));
		}

		if($row["theme"])
		{
			$this->result["theme"] = $row["theme"];
		}
		elseif($this->diafan->configmodules("theme_id"))
		{
			$this->result["theme"] = $this->diafan->configmodules("theme_id");
		}
		elseif(! empty($cat["theme"]))
		{
			$this->result["theme"] = $cat["theme"];
		}

		if(! $row["view"])
		{
			if(! empty($cat["view_element"]))
			{
				$this->result["view"] = $cat["view_element"];
			}
			elseif($this->diafan->configmodules("view_id"))
			{
				$this->result["view"] = $this->diafan->configmodules("view_id");
			}
			else
			{
				$this->result["view"] = 'id';
			}
		}
	}
	
	/**
	 * Определяет значения META-тегов элемента
	 *
	 * @param array $row данные о текущем элементе
	 * @return void
	 */
	protected function meta($row)
	{
		$this->result["timeedit"] = $row["timeedit"];
		if(strpos($this->diafan->configmodules("title_tpl"), '%category')
		   || strpos($this->diafan->configmodules("keywords_tpl"), '%category')
		   || strpos($this->diafan->configmodules("descr_tpl"), '%category')
		   || strpos($this->diafan->configmodules("title_tpl"), '%parent_category')
		   || strpos($this->diafan->configmodules("keywords_tpl"), '%parent_category')
		   || strpos($this->diafan->configmodules("descr_tpl"), '%parent_category'))
		{
			$cat = DB::fetch_array(DB::query("SELECT parent_id, [name] FROM {%h_category} WHERE id=%d LIMIT 1", $this->diafan->module, $row["cat_id"]));
			$category_name = $cat["name"];
		}
		else
		{
			$category_name = '';
		}
		if(strpos($this->diafan->configmodules("title_tpl"), '%parent_category')
		   || strpos($this->diafan->configmodules("keywords_tpl"), '%parent_category')
		   || strpos($this->diafan->configmodules("descr_tpl"), '%parent_category'))
		{
			$parent_category_name = DB::query_result("SELECT [name] FROM {%h_category} WHERE id=%d LIMIT 1", $this->diafan->module, $cat["parent_id"]);
		}
		else
		{
			$parent_category_name = '';
		}
		if ($this->diafan->configmodules("title_tpl"))
		{
			$this->result["title_meta"] = str_replace(
				array('%title', '%name', '%category', '%parent_category'),
				array($row["title_meta"], $row["name"], $category_name, $parent_category_name),
				$this->diafan->configmodules("title_tpl")
			);
		}
		if ($this->diafan->configmodules("keywords_tpl"))
		{
			$this->result["keywords"] = str_replace(
				array('%keywords', '%name', '%category', '%parent_category'),
				array($row["keywords"], $row["name"], $category_name, $parent_category_name),
				$this->diafan->configmodules("keywords_tpl")
			);
		}
		if ($this->diafan->configmodules("descr_tpl"))
		{
			$this->result["descr"] = str_replace(
				array('%descr', '%name', '%category', '%parent_category'),
				array($row["descr"], $row["name"], $category_name, $parent_category_name),
				$this->diafan->configmodules("descr_tpl")
			);
		}
		$this->result["titlemodule"] = $row["name"];
		$this->result["edit_meta"]   = array("id" => $row["id"], "table" => $this->diafan->module);
	}
	
	/**
	 * Определяет значения META-тегов категории
	 *
	 * @param array $row данные о текущей категории
	 * @return void
	 */
	protected function meta_cat($row)
	{
		$this->result["timeedit"] = $row["timeedit"];
		if(strpos($this->diafan->configmodules("title_tpl_cat"), '%parent')
		   || strpos($this->diafan->configmodules("keywords_tpl_cat"), '%parent')
		   || strpos($this->diafan->configmodules("descr_tpl_cat"), '%parent'))
		{
			$parent_name = DB::query_result("SELECT [name] FROM {%h_category} WHERE id=%d LIMIT 1", $this->diafan->module, $row["parent_id"]);
		}
		else
		{
			$parent_name = '';
		}
		if ($this->diafan->configmodules("title_tpl_cat"))
		{
			$this->result["title_meta"] = str_replace(
				array('%title', '%name', '%parent'),
				array($row["title_meta"], $row["name"], $parent_name),
				$this->diafan->configmodules("title_tpl_cat")
			);
		}
		else
		{
			$this->result["title_meta"] = $row["title_meta"];
		}
		if ($this->diafan->configmodules("keywords_tpl_cat"))
		{
			$this->result["keywords"] = str_replace(
				array('%keywords', '%name', '%parent'),
				array($row["keywords"], $row["name"], $parent_name),
				$this->diafan->configmodules("keywords_tpl_cat")
			);
		}
		else
		{
			$this->result["keywords"] = $row["keywords"];
		}
		if ($this->diafan->configmodules("descr_tpl_cat"))
		{
			$this->result["descr"] = str_replace(
				array('%descr', '%name', '%parent'),
				array($row["descr"], $row["name"], $parent_name),
				$this->diafan->configmodules("descr_tpl_cat")
			);
		}
		else
		{
			$this->result["descr"] = $row["descr"];
		}
		$this->result["titlemodule"] = $row["name"];
		$this->result["edit_meta"]   = array("id" => $row["id"], "table" => $this->diafan->module."_category");
	}
	
	/**
	 * Счетчик просмотров элемента
	 *
	 * @return void
	 */
	protected function counter_view()
	{
		if($this->diafan->configmodules('counter'))
		{
			$counter = DB::fetch_array(DB::query("SELECT id, count_view FROM {%s_counter} WHERE element_id=%d LIMIT 1", $this->diafan->module, $this->diafan->show));
			if($counter)
			{
				if(empty($_SESSION[$this->diafan->module."_view"][$this->diafan->show]))
				{
					$_SESSION[$this->diafan->module."_view"][$this->diafan->show] = 1;
					DB::query("UPDATE {%s_counter} SET count_view=%d WHERE id=%d LIMIT 1", $this->diafan->module, ++$counter["count_view"], $counter["id"]);
				}
			}
			else
			{
				DB::query("INSERT INTO {%s_counter} (count_view, element_id) VALUES (1, %d)", $this->diafan->module, $this->diafan->show);
				$counter["count_view"] = 1;
				$_SESSION[$this->diafan->module."_view"][$this->diafan->show] = 1;
			}
			if($this->diafan->configmodules('counter_site'))
			{
				$this->result["counter"] = $counter["count_view"];
			}
		}
	}
}