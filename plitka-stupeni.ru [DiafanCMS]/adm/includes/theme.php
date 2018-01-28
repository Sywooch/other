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
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Theme_admin
 *
 * Представление в административной части
 */
class Theme_admin extends Diafan
{
	/**
	 * @var array вложенные пункты меню
	 */
	private $submenu;

	/**
	 * @var string ссылка на конфигурацию модуля
	 */
	private $link_to_config;

	/**
	 * Подключает шаблон
	 *
	 * @return boolean true
	 */
	public function show_theme()
	{
		if ($this->diafan->_user->id)
		{
			$site_theme = file_get_contents(ABSOLUTE_PATH.'adm/themes/admin.php');
		}
		else
		{
			$site_theme = file_get_contents(ABSOLUTE_PATH.'adm/themes/adminauth.php');
		}
		$this->get_function_in_theme($site_theme);

		echo '<!-- версия '.VERSION_CMS.' '.date("d.m.Y", DATE_UPDATE).'-->';
		return true;
	}

	/**
	 * Парсит шаблон
	 *
	 * @return boolean true
	 */
	private function get_function_in_theme($text)
	{
		$text = str_replace('<?php if (!defined("DIAFAN")){include "../../includes/404.php";}?>', '', $text);
		$regexp = '/(<insert ([^>]*)>)/im';
		$tokens = preg_split($regexp, $text, -1, PREG_SPLIT_DELIM_CAPTURE);
		$cnt = count($tokens);
		echo $tokens[0];
		$i = 1;
		while ($i < $cnt)
		{
			$i++;
			$att_string = $tokens[$i++];
			$data = $tokens[$i++];
			$attributes = $this->parse_attributes($att_string);
			$this->start_element($attributes);
			echo $data;
		}
		return true;
	}

	/**
	 * Парсит атрибуты шаблонного тэга
	 *
	 * @return array
	 */
	private function parse_attributes($string)
	{
		$entities = array ( '&lt;'   => '<',
							'&gt;'   => '>',
							'&amp;'  => '&',
							'&quot;' => '"',
							'['      => '<',
							']'      => '>',
							'`'      => '"' );

		$attributes = array ();
		$match = array ();
		preg_match_all('/([a-zA-Z_0-9]+)="((?:\\\.|[^"\\\])*)"/U', $string, $match);
		for ($i = 0; $i < count($match[1]); $i++)
		{
			$attributes[strtolower($match[1][$i])] = strtr((string)$match[2][$i], $entities);
		}
		return $attributes;
	}

	/**
	 * Выполняет действие, заданное в шаблонном тэге: выводит информацию или подключает шаблонную функцию
	 *
	 * @param array атрибуты шаблонного тэга
	 * @return boolean true
	 */
	private function start_element($attributes)
	{
		if (empty( $attributes['name'] ))
		{
			if (!empty( $attributes['value'] ))
			{
				echo $this->diafan->_($attributes['value']);
			}
			return;
		}

		switch ($attributes['name'])
		{
			case "path":
				echo BASE_PATH.'adm/';
				break;

			case "path_url":
				echo BASE_PATH_HREF;
				break;

			case "base_url":
				echo BASE_URL;
				break;

			case "userid":
				echo $this->diafan->_user->id;
				break;

			case "userfio":
				echo $this->diafan->_user->fio;
				break;

			case "errauth":
				switch ($this->diafan->_user->errauth)
				{
					case 'wrong_login_or_pass':
						echo '<div class="auth_error">'.$this->diafan->_('Неверный логин или пароль.').'</div>';
						break;

					case 'blocked_30_min':
						echo '<div class="auth_error">'.$this->diafan->_('Вы превысили количество попыток, поэтому будете заблокированы на 30 минут').'</div>';
						break;

					case 'blocked':
						echo '<div class="auth_error">'.$this->diafan->_('Логин не активирован или заблокирован.').'</div>';
						break;
				}
				break;

			default:
				if (is_callable(array($this, $attributes['name'])))
				{
					call_user_func_array (array(&$this, $attributes['name']), array($attributes));
				}
		}
		return true;
	}

	/**
	 * Выводит заголовок. Используется между тегами <title></title> в шапке сайта
	 *
	 * @return boolean true
	 */
	private function show_title()
	{
		echo ( $this->diafan->name && $this->diafan->_user->id ? $this->diafan->name.' - ' : '' )."CMS ".BASE_URL;
		return true;
	}

	/**
	 * Выводит меню
	 *
	 * @return boolean true
	 */
	private function show_menu()
	{
		$groups = array ( 1 => $this->diafan->_('Контент'),
						  4 => $this->diafan->_('Интернет магазин'),
						  2 => $this->diafan->_('Интерактив'),
						  3 => $this->diafan->_('Сервис'),
						  5 => $this->diafan->_('Настройки')
		);
		$result = DB::query("SELECT id, name, rewrite, group_id FROM {adminsite} WHERE parent_id=0 AND act='1' ORDER BY sort ASC");
		while ($row = DB::fetch_array($result))
		{
			if (! $this->diafan->_user->roles('init', $row["rewrite"]))
			{
				continue;
			}
			$row["site_id"] = 0;
			if($this->diafan->configmodules("admin_page", $row["rewrite"]))
			{
				$result_sites = DB::query("SELECT id, name".$this->diafan->language_base_site." AS name FROM {site} WHERE trash='0' AND act".$this->diafan->language_base_site."='1' AND module_name='%s'", $row["rewrite"]);
				if(DB::num_rows($result_sites) > 1)
				{
					while ($row_site = DB::fetch_array($result_sites))
					{
						$row["name"] = $row_site["name"];
						$row["site_id"] = $row_site["id"];
						$group[$row["group_id"]][] = $row;
					}
				}
				else
				{
					$group[$row["group_id"]][] = $row;
				}
			}
			else
			{
				$group[$row["group_id"]][] = $row;
			}
		}
		$html = '';
		$cid_parent = DB::query_result("SELECT parent_id FROM {adminsite} WHERE id=%d LIMIT 1", $this->diafan->cid);

		foreach ($groups as $group_id => $name)
		{
			if(empty($group[$group_id])) continue;

			$html .= '<table width="100%">
			<tr><td class="menu_tr_first" colspan="3"><h1>'.$name.'</h1></td></tr>';

			$rows = $group[$group_id];
			foreach ($rows as $row)
			{
				$link = $row['name'];
				$prefix = '';


				if (($row["id"] == $this->diafan->cid || $row["id"] == $cid_parent) && (empty($row["site_id"]) || $row["site_id"] == $this->diafan->site))
				{
					$prefix = '_act';
					$act = true;
				}
				else
				{
					$link = '<a href="'.BASE_PATH_HREF.$row["rewrite"] .($row["site_id"] ? '/site'.$row["site_id"] : ''). '/">'.$link.'</a>';
					$act = false;
				}
				$count = '';
				if(strpos($row["rewrite"], '/') !== false)
				{
					list($module, $file) = explode('/', $row["rewrite"], 2);
				}
				else
				{
					$module = $row["rewrite"];
					$file = '';
				}
				if(file_exists(ABSOLUTE_PATH.'modules/'.$module.'/admin/'.$module.'.admin'.($file ? '.'.$file : '').'.count.php'))
				{
					$count_menu = 0;
					include_once ABSOLUTE_PATH.'modules/'.$module.'/admin/'.$module.'.admin'.($file ? '.'.$file : '').'.count.php';
					$class = ucfirst($module).'_admin'.($file ? '_'.$file : '').'_count';
					if (method_exists($class, 'count'))
					{
						eval('$class_count_menu = new '.$class.'($this->diafan);');
						$count_menu = $class_count_menu->count($row["site_id"]);
					}
					if($count_menu)
					{
						$count = '<span class="info"><span class="info_left"><span class="info_right">'.$count_menu.'</span></span></span>';
					}
				}

				$img_name = str_replace('/','.',$row['rewrite']);
				if (file_exists(ABSOLUTE_PATH.'adm/img/icons/'.$img_name.$prefix.'.gif'))
				{
					$img = '<img src="'.BASE_PATH.'adm/img/icons/'.$img_name.$prefix.'.gif" alt="">';
				}
				else
				{
					$img = '<img src="'.BASE_PATH.'adm/img/icons/menu.gif" alt="">';
				}

				if (!empty( $prefix ))
				{
					$html .= '<tr><td colspan="3" class="menu_act_before"></td></tr>';
				}

				$html .= '<tr'.( !empty( $prefix ) ? ' class="menu_act"' : '' ).'>
	<td class="menu_1">'.$img.'</td>
	<td class="menu_2">'.$link.$count.'</td>
	<td class="menu_3"></td>
	</tr>';

				if (!empty( $prefix ))
				{
					$html .= '<tr><td colspan="3" class="menu_act_after"></td></tr>';
				}
			}
			$html .= '</table>';
			if($group_id != 3 && ! $act)
			{
				$html .= '<div class="left_sep"></div>';
			}
		}
		echo $html;

		return true;
	}

	/**
	 * Выводит навигации по сайту «Хлебные крошки»
	 *
	 * @return boolean
	 */
	public function show_path()
	{
		echo '<div class="path">';
		if ($this->diafan->rewrite != "site" || $this->diafan->parent || $this->diafan->edit)
		{
			echo ' <a href="'.BASE_PATH_HREF.'">'.$this->diafan->_('Страницы сайта').'</a>';
		}
		if(! empty($_GET["action"]))
		{
			echo '<span class="path_separator"></span><a href="'.BASE_PATH_HREF.$this->diafan->rewrite.'/">'.$this->diafan->name.'</a>';
		}

		if ($this->diafan->rewrite && $this->diafan->rewrite != "site")
		{
			if ($this->diafan->parent_id)
			{
				$parent_adminsite = DB::fetch_array(DB::query("SELECT name, rewrite FROM {adminsite} WHERE id=%d LIMIT 1", $this->diafan->parent_id));
				echo '<span class="path_separator"></span><a href="'.BASE_PATH_HREF.$parent_adminsite["rewrite"].'/">'.$parent_adminsite["name"].'</a>';
			}
			if ($this->diafan->parent || $this->diafan->edit && strpos($this->diafan->rewrite, '/config') === false || $this->diafan->site || $this->diafan->cat)
			{
				echo '<span class="path_separator"></span><a href="'.BASE_PATH_HREF.$this->diafan->rewrite.'/">'.$this->diafan->name.'</a>';
			}
		}

		if ($this->diafan->config("element") && $this->diafan->cat)
		{
			if ($this->diafan->config("element_multiple") && $this->diafan->cat)
			{
				$categories = $this->diafan->get_parents($this->diafan->cat, $this->diafan->table.'_category');
			}

			$current_link = BASE_PATH_HREF.$this->diafan->rewrite.'/';

			$categories[] = $this->diafan->cat;
			$result = DB::query("SELECT ".($this->diafan->config('category_no_multilang') ? "name" : "[name]").", id FROM {".$this->diafan->table."_category} WHERE id IN (%h)", implode(",", $categories));
			while ($row = DB::fetch_array($result))
			{
				$categories_name[$row["id"]] = $row["name"];
			}
			if (!empty( $categories_name ))
			{
				foreach ($categories as $p)
				{
					echo '<span class="path_separator"></span> <a href="'.$current_link.'cat'.$p.'/">'.$categories_name[$p].'</a>';
				}
				$this->diafan->name = $categories_name[$p];
			}
		}

		if ($this->diafan->config("parent") && $this->diafan->parent && $this->diafan->is_variable("name"))
		{
			$parents = $this->diafan->get_parents($this->diafan->parent, $this->diafan->table);
			$parents[] = $this->diafan->parent;
			if ($parents)
			{
				$current_link = BASE_PATH_HREF.$this->diafan->rewrite.'/';
				$result = DB::query("SELECT ".($this->diafan->variable_multilang("name") ? "[name]" : "name").", id FROM {".$this->diafan->table."} WHERE id IN (%h)", implode(",", $parents));
				while ($row = DB::fetch_array($result))
				{
					$parents_name[$row["id"]] = $row["name"];
				}

				foreach ($parents as $p)
				{
					if(! empty($parents_name[$p]))
					{
						echo '<span class="path_separator"></span> <a href="'.$current_link.'parent'.$p.'/">'.$parents_name[$p].'</a>';
					}
				}
			}
		}
		echo '</div>';
		return true;
	}

	private function get_submenu($id)
	{
		if ($id == 0)
		{
			return false;
		}

		if($this->diafan->config('config')) return false;

		$result = DB::query("SELECT id, name, rewrite, act, parent_id FROM {adminsite} WHERE parent_id=%d ORDER BY sort ASC", $id);
		while ($row = DB::fetch_array($result))
		{
			if (! $this->diafan->_user->roles('init', $row["rewrite"]))
			{
				continue;
			}

			if (strpos($row["rewrite"], '/config') !== false)
			{
				$this->link_to_config = $row["rewrite"];
				continue;
			}
			if (!$row["act"])
			{
				continue;
			}
			$this->submenu[] = $row;
		}
	}

	/**
	 * Выводит ссылку на конфигурацию модуля
	 *
	 * @return boolean
	 */
	public function show_config()
	{
		if ($this->diafan->edit && strpos($this->diafan->rewrite, '/config') === false)
		{
			return false;
		}
		if ($this->diafan->parent_id)
		{
			$id = $this->diafan->get_parents($this->diafan->parent_id, 'adminsite'); // Возможна ошибка если родителей больше
			if (empty( $id ))
			{
				$id = $this->diafan->parent_id;
			}
		}
		else
		{
			$id = $this->diafan->cid;
		}

		$this->get_submenu($id);

		if (empty( $this->link_to_config) || $this->diafan->edit)
		{
			return false;
		}
		echo '<div class="config"><a href="'.BASE_PATH_HREF.$this->link_to_config.'/">'.$this->diafan->_('Настройки модуля').'</a></div>';
		return true;
	}

	/**
	 * Выводит ссылку на документацию модуля
	 *
	 * @return void
	 */
	public function show_docs()
	{
		if($this->diafan->docs)
		{
			echo '<br><a href="'.$this->diafan->docs.'">'.$this->diafan->_('Документация модуля').'</a>';
		}
	}

	/**
	 * Выводит подменю
	 *
	 * @return boolean
	 */
	private function show_submenu()
	{
		if (!$this->submenu)
		{
			return false;
		}
		if (!$this->diafan->configmodules('cat', $this->diafan->module, $this->diafan->site) && count($this->submenu) == 2 && $this->submenu[1]["rewrite"] == $this->diafan->module.'/category' && !$this->diafan->config("element") && !$this->diafan->config("category"))
		{
			return false;
		}

		echo '<ul class="tabs"><div class="tabs_line"></div>';
		$i = 0;
		foreach ($this->submenu as $row)
		{
			if (!$this->diafan->configmodules('cat', $this->diafan->module, $this->diafan->site) && $row["rewrite"] == $this->diafan->module.'/category' && !$this->diafan->config("element") && !$this->diafan->config("category"))
			{
				continue;
			}

			$name = '<a href="'.BASE_PATH_HREF.$row["rewrite"].'/'.( $this->diafan->site ? 'site'.$this->diafan->site.'/' : '' ).'">'.$row['name'].'</a>';
			$act = 0;

			if ($this->diafan->rewrite == $row["rewrite"])
			{
				$act = 1;
			}

			echo '<li class="tab'.( $act ? '_act' : '' ).'">'.$name.'<div class="left_tab'.( $act ? '_act' : '' ).( $i++ == 0 ? '_first' : '' ).'"></div>
<div class="right_tab'.( $act ? '_act' : '' ).'"></div></li>';
		}
		echo '<div class="clear"></div></ul>';
		return true;
	}

	/**
	 * Выводит ссылки на альтернативные языковые версии сайта
	 *
	 * @return boolean
	 */
	private function show_languages()
	{
		if (count($this->diafan->languages) < 2)
		{
			return;
		}

		echo '<td class="head_td head_3">';

		foreach ($this->diafan->languages as $language)
		{
			if ($language["id"] != _LANG)
			{

				echo '<a href="http://'.BASE_URL.'/'.ADMIN_FOLDER.'/'.( ! $language["base_admin"] ? $language["shortname"].'/' : '' ).( $_GET["rewrite"] ? $_GET["rewrite"].'/' : '' ).'" class="lang">'.$language["name"].'</a>';
			}
			else
			{
				echo '<span class="lang_act">'.$language["name"].'</span>';
			}
		}

		echo '</td>';

		return true;
	}

	/**
	 * Выводит основной контент страницы
	 *
	 * @return boolean true
	 */
	private function show_body()
	{
		$this->show_path();
		$this->show_h1();
		$this->show_config();

		$this->diafan->show_error_message();
		echo '<div class="hide check_hash_user">'.$this->diafan->_user->get_hash().'</div>';
		$this->show_submenu();
		$this->diafan->show_module_contents();
		echo $this->diafan->module_contents;

		return true;
	}

	/**
	 * Выводит заголовок страницы H1
	 *
	 * @return boolean true
	 */
	private function show_h1()
	{
		if (! $this->diafan->config("config") && $this->diafan->edit && $this->diafan->rewrite != "config")
		{
			echo '<h1></h1>';
			return false;
		}

		if ($this->diafan->config('element_multiple') && $this->diafan->cat || $this->diafan->config('element') && $this->diafan->module == 'menu')
		{
			$c = '<a href="'.BASE_PATH_HREF.$this->diafan->rewrite.'/category/'.( !$this->diafan->config('category_flat') ? 'parent'.$this->diafan->cat.'/' : '' ).'edit'.$this->diafan->cat.'/">'.$this->diafan->_('изменить').'</a>';
		}
		elseif ($this->diafan->config('element') && $this->diafan->cat)
		{
			$c = '<a href="'.BASE_PATH_HREF.$this->diafan->rewrite.'/edit'.$this->diafan->cat.'/">'.$this->diafan->_('изменить').'</a>';
		}
		elseif (!$this->diafan->config("config") && $this->diafan->config('element_site') && $this->diafan->site)
		{
			if ($this->diafan->site)
			{
				$this->diafan->name = DB::title("site", $this->diafan->site, "name"._LANG);
				$c = $this->diafan->site;
			}
			$c = '<a href="'.BASE_PATH_HREF.'site/edit'.$c.'/">'.$this->diafan->_('изменить').'</a>';
		}
		elseif (! in_array($this->diafan->rewrite, array("site", "adminsite")) && $row = DB::fetch_array(DB::query("SELECT id, [name] FROM {site} WHERE module_name='%h' AND trash='0' LIMIT 1", $this->diafan->rewrite)))
		{
			$this->diafan->name = $row["name"];
			$c = '<a href="'.BASE_PATH_HREF.'site/edit'.$row["id"].'/">'.$this->diafan->_('изменить').'</a>';
		}

		echo '<h1>'.( file_exists(ABSOLUTE_PATH.'adm/img/'.$this->diafan->module.'.gif') ? '<img src="'.BASE_PATH.'adm/img/'.$this->diafan->module.'.gif">' : '' ).' '.$this->diafan->name.( !empty( $c ) ? '<span>'.$c.'</span>' : '' ).'</h1>';
		return true;
	}

	/**
	 * Выводит системное сообщение
	 *
	 * @return void
	 */
	public function show_error_message()
	{
		$messages = array(
				1 => 'Изменения сохранены!',
				5 => 'Сообщение отправлено',
				6 => 'Сообщение не может быть отправлено, так как не заполнены обязательные поля (e-mail, вопрос, ответ).',
				7 => 'Внимание! Не установлена библиотека GD. Работа модуля невозможна. Обратитесь в техподдержку вашего хостинга!',
				8 => 'Нельзя добавить несколько параметров, влияющих на цену, для одного раздела!',
				9 => 'Рассылка не отправлена, так как не заполнено поле "Содержание"'
			);

		if ($this->diafan->error && ! empty($messages[$this->diafan->error]))
		{
			echo '<div class="error">'.$this->diafan->_($messages[$this->diafan->error]).'</div>';
		}

		if ($this->diafan->success && ! empty($messages[$this->diafan->success]))
		{
			echo '<div class="ok">'.$this->diafan->_($messages[$this->diafan->success]).'</div>';
		}
	}

	/**
	 * Выводит информацию о CMS
	 *
	 * @return void
	 */
	public function show_brand($a)
	{
		$number = (int)preg_replace('/[^0-9]+/', '', $a["id"]);
		global $brandtext;
		include_once ABSOLUTE_PATH.'adm/brand.php';
		echo $brandtext[$number];
	}

	/**
	 * Выводит фоны для оформленияы
	 *
	 * @return void
	 */
	public function show_themes()
	{
		$d = dir(ABSOLUTE_PATH.'adm/img/themes');
		while (false !== ($entry = $d->read()))
		{
			if(preg_match('/^(.*?)_min.png$/', $entry, $m))
			{
				echo '<a href="#" class="theme_'.$m[1].'" style="background: url('.BASE_PATH.'adm/img/themes/'.$m[1].'_min.png) no-repeat 100% 0;
				'.($m[1].'.jpg' == $this->diafan->_user->background ? 'width:30px' : '').'"></a>';
			}
		}
		$d->close();
	}

	/**
	 * Выводит текущий фон оформления
	 *
	 * @return void
	 */
	public function show_background()
	{
		$img = null;
		if(! $this->diafan->_user->background)
		{
			$img = BASE_PATH.'adm/img/themes/metall.jpg';
		}
		else if (file_exists(ABSOLUTE_PATH.'adm/img/themes/'.$this->diafan->_user->background))
		{
			$img = BASE_PATH.'adm/img/themes/'.$this->diafan->_user->background;
		}

		if($img)
		{
			echo '<style type="text/css">body {background: url('.$img.') repeat 50% 0; }</style>';
		}
	}

	/**
	 * Подключает необходимые JS-библиотеки
	 *
	 * @return void
	 */
	public function show_js()
	{
		echo '
		<script type="text/javascript" src="'.BASE_PATH.'adm/htmleditor/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript" src="'.BASE_PATH.'adm/htmleditor/tiny_mce/plugins/images/images_init.php"></script>
		<script type="text/javascript" src="'.BASE_PATH.'adm/htmleditor/tiny_mce/config.js"></script>';
		if ($this->diafan->edit)
		{
			echo '
			<script src="'.BASE_PATH.'js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
			<link rel="stylesheet" href="'.BASE_PATH.'css/prettyPhoto.css" type="text/css" media="screen"'.' title="prettyPhoto main stylesheet" charset="utf-8" />';
		}
		if ($this->diafan->config('multiupload'))
		{
			echo '
			<script type="text/javascript" src="'.BASE_PATH.'js/fileuploader.js"></script>
			<link href="'.BASE_PATH.'adm/css/fileuploader.css" rel="stylesheet" type="text/css">';
		}
		echo '<script type="text/javascript" src="'.BASE_PATH.'js/jquery.imgareaselect.min.js"></script>
		<link rel="stylesheet" type="text/css" href="'.BASE_PATH.'css/jquery.imgareaselect/imgareaselect-default.css">
		<link rel="stylesheet" type="text/css" href="'.BASE_PATH.'css/jquery.imgareaselect/imgareaselect-animated.css">
		<link rel="stylesheet" type="text/css" href="'.BASE_PATH.'css/jquery.imgareaselect/imgareaselect-deprecated.css">';
	}

	/**
	 * Фильтр вывода
	 *
	 * @return void
	 */
	public function show_module_contents()
	{
		if(! $this->diafan->config('config') && $this->diafan->edit)
		{
			return;
		}
		$html = $this->show_filter();
		$empty_get_nav_params = true;
		if($this->diafan->get_nav_params)
		{
			foreach($this->diafan->get_nav_params as $get)
			{
				if($get)
				{
					$empty_get_nav_params = false;
				}
			}
		}
		if($this->diafan->count || ! $empty_get_nav_params)
		{
			$html .= ($html ? '<br>' : '').$this->diafan->show_search();
		}
		if (!empty( $html ))
		{
			echo '<div class="block">'.$html.'</div>';

			if($this->diafan->config('config'))
			{
				echo '<div class="addnew">&nbsp;</div>';
			}
		}
	}

	/**
	 * Фильтр вывода
	 *
	 * @param boolean $hide_site скрыть фильтр по разделу сайта
	 * @return void
	 */
	public function show_filter($hide_site = false)
	{
		if (!$this->diafan->config('element_site') && !$this->diafan->config('element'))
		{
			return false;
		}
		$html = '';
		$items = array();

		if (! $hide_site && $this->diafan->config('element_site') && (! $this->diafan->edit || $this->diafan->config('config') ))
		{
			if($this->diafan->config('config'))
			{
				$sites = array();
				$result = DB::query("SELECT id, [name], parent_id FROM {site} WHERE trash='0' AND module_name='%s' ORDER BY sort ASC", $this->diafan->module);
				while ($row = DB::fetch_array($result))
				{
					$sites[] = $row;
				}
				$this->diafan->sites = $sites;
			}
			if (! empty($this->diafan->sites) && count($this->diafan->sites) > 1)
			{
				$item['name'] = $this->diafan->_('Раздел сайта');
				$item['html'] =
				'<select rel="'.$this->diafan->get_admin_url('page', 'site').'" class="redirect" name="site">'
				.'<option value="">'.$this->diafan->_('Все').'</option>'
				.$this->diafan->get_options(array("0" => $this->diafan->sites), $this->diafan->sites, array( $this->diafan->site))
				.'</select> ';
				$items[] = $item;
			}
		}
		if ($this->diafan->config('element_multiple') && !$this->diafan->edit)
		{
			$cats = array();
			$count = 0;
			foreach($this->diafan->categories as $row)
			{
				$cats[$row["parent_id"]][] = $row;
				$count++;
			}

			if ($count > 0)
			{
				if($this->diafan->rewrite != 'shop')
				{
					foreach($cats as &$elem)
					{		
						$tmp = array();
						foreach ($elem as $key => $row) 
						{
							$tmp[$key] = $row['name'];
						}
						array_multisort($tmp, SORT_ASC, $elem);
					}
					$item['name'] = $this->diafan->_('Категория');
					$item['html'] = '<select rel="'.$this->diafan->get_admin_url('page', 'cat').'" class="redirect" name="cat">';
					$item['html'] .= '<option value="">'.$this->diafan->_('Все').'</option>';
					$item['html'] .= $this->diafan->get_options($cats, $cats[0], array ( $this->diafan->cat )).'</select> ';
					$items[]=$item;
				}
				else
				{
					$isNowCat	= explode('/', $_GET['rewrite']);
					if(isset($isNowCat[2]))
					{
						$isNowCat	= str_replace('cat', '', $isNowCat[2]);
						$nowType	= $isNowCat[strlen($isNowCat) - 1];
						$nowID		= intval(substr($isNowCat, 0, strlen($isNowCat) - 1));
					} else {
						$nowType	= 'null';
						$nowID		= 0;
					}

					$newArr = array();
					foreach($cats as $key => $catss)
					{
						if($key != 0)
						{
							foreach($catss as $cat)
							{
								$newArr[] = $cat;
							}
						}
					}
					/*
					public function fsort_array($a, $b){
						return strcmp($a['name'], $b['name']);
					} 
					*/
					usort($newArr, function($a, $b){ return strcmp($a['name'], $b['name']); });

					# echo '<pre>';
					# print_r($newArr);
					# print_r($cats);
					# echo '</pre>';
					$item['name'] = $this->diafan->_('Категория');
					$item['html'] = '<select rel="'.$this->diafan->get_admin_url('page', 'cat').'" class="redirect" name="cat">';
					$item['html'] .= '<option value="">'.$this->diafan->_('Все').'</option>';

							foreach($newArr as $cat)
							{
								if(isset($cat['parent_id']) && $cat['parent_id'] != 0)
								{
									$item['html'] .= '<option value="'.$cat['id'].'c"'.($nowType == 'c' && $nowID == $cat['id'] ? 'selected="selected"' : '').'>'.$cat['name'].'</option>';

									$res = DB::query('SELECT id, name1 FROM {shop} WHERE cat_id = "'.$cat['id'].'" AND act1 = "1" AND trash = "0" ORDER BY name1 ASC');
									while($s = DB::fetch_array($res))
									{
										$item['html'] .= '<option value="'.$s['id'].'p"'.($nowType == 'p' && $nowID == $s['id'] ? 'selected="selected"' : '').'>&nbsp;&nbsp;'.$s['name1'].'</option>';
									}
								}
							}

					$item['html'] .= /* $this->diafan->get_options($cats, $cats[0], array ( $this->diafan->cat )). */ '</select> ';

					$items[]=$item;
				}
			}
		}
		elseif ($this->diafan->config('category_flat') && !$this->diafan->edit)
		{
			$cats = array ();
			$count = 0;
			$result = DB::query("SELECT id, ".($this->diafan->config('category_no_multilang') ? "name" : "[name]")." FROM {".$this->diafan->table."_category} WHERE trash='0'".( $this->diafan->site ? " AND site_id='".$this->diafan->site."'" : "" )." ORDER BY id ASC");
			while ($row = DB::fetch_array($result))
			{
				$cats[] = $row;
				$count++;
			}
			if ($count)
			{
				$this->diafan->not_empty_categories = true;
			}
			if ($count > 1)
			{
				$item['name'] = $this->diafan->_('Категория');
				$item['html'] = '<select rel="'.$this->diafan->get_admin_url('cat').'" class="redirect" name="cat">';
				if(! $this->diafan->config('category_no_empty'))
				{
					$item['html'] .= '<option value="">'.$this->diafan->_('Все').'</option>';
				}
				$item['html'] .= $this->diafan->get_options(array (), $cats, array ( $this->diafan->cat )).'</select> ';

				$items[] = $item;
			}
		}

		if(!empty($items))
		{
			$html = '<table class="filter">';
			foreach($items as $item)
			{
				$html .= '<tr><td>'.$item['name'].':</td><td>'.$item['html'].'</td></tr>';
			}
			$html .= '</table>';
		}

		return $html;
	}
	
	/**
	 * Поиск
	 *
	 * @return boolean
	 */
	public function show_search()
	{
		if (! $this->diafan->config('search_name'))
		{
			return false;
		}
		$html = '
		<form action="'.BASE_PATH_HREF.$this->diafan->rewrite.'/'.( $this->diafan->cat ? 'cat'.$this->diafan->cat.'/' : '' ).'" method="GET">
		'.$this->diafan->_('Название').': <input type="text" name="search_name" value="'.(! empty($this->diafan->get_nav_params["search_name"]) ? $this->diafan->get_nav_params["search_name"] : '' ).'" size="20">
		<input type="submit" class="button" value="'.$this->diafan->_('Найти').'">
		</form>';

		return $html;
	}

	/**
	 * Рандомное число
	 *
	 * @return boolean
	 */
	public function show_rand()
	{
		echo rand(0, 99999);
	}

	/**
	 * Формирует HTML-список
	 *
	 * @return string
	 */
	public function select_option($key, $table = '', $id = '', $name = '', $value = '', $where = "", $parent_id = "", $parent_value = 0, $marker = '', $order = 'id asc')
	{
		$list = '';
		if ($parent_id && !$marker)
		{
			$marker = "&nbsp;&nbsp;";
		}
		$name = str_replace('LANG', _LANG, $name);

		if (!empty( $this->diafan->select_arr[$key] ))
		{
			foreach ($this->diafan->select_arr[$key] as $k => $val)
			{
				$list .= '<option value="'.$k.'"'.( $value == $k ? ' selected' : '' ).'>'.( $val ? $val : $k ).'</option>';
			}
			return $list;
		}
		$result = DB::query("SELECT ".$id.','.$name. " FROM {".$table."} ".( !empty( $where ) ? "WHERE ".$where : '' ).( $parent_id ? ( $where ? " AND " : 'WHERE ' ).$parent_id."='".$parent_value."'" : "" )." ORDER BY ".$order);

		while ($row = DB::fetch_array($result))
		{
			$list .= '<option value="'.$row[$id].'"'.( $value == $row[$id] ? ' selected' : '' ).'>'.( $row[$name] ? $this->diafan->short_text($marker.$row[$name], 40) : $row[$id] ).'</option>'.( $parent_id ? $this->select_option($key, $table, $id, $name, $value, $where, $parent_id, $row[$id], $marker."&nbsp;&nbsp;") : '' );
		}
		return $list;
	}

	/**
	 * Формирует теги <option> при редактировании списка
	 *
	 * @param array $cats все возможные значения
	 * @param array $rows возможные значения для текущего уровня
	 * @param array $values значения
	 * @param string $marker отступ для текущего уровня
	 * @return boolean
	 */
	public function get_options($cats, $rows, $values, $marker = '')
	{
		$text = '';
		foreach ($rows as $row)
		{
			$text .= '<option value="'.$row["id"].'"'.( in_array($row["id"], $values) ? ' selected' : '' ).'>'.$marker.$this->diafan->short_text($row["name"], 40).'</option>';
			if (!empty( $cats[$row["id"]] ))
			{
				$text .= $this->diafan->get_options($cats, $cats[$row["id"]], $values, $marker.'&nbsp;&nbsp;');
			}
		}
		return $text;
	}
}