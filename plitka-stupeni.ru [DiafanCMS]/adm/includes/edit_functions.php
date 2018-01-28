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
 * Edit_functions_admin
 *
 * Функции редактирования полей
 */
class Edit_functions_admin extends Diafan
{
	/**
	 * @var array локальный кэш
	 */
	private $cache;
	
	/**
	 * Редактирование поля "Категория"
	 *
	 * @return void
	 */
	public function edit_variable_cat_id()
	{
		if (!$this->diafan->config("element"))
		{
			return;
		}
		if (!$this->diafan->value)
		{
			$this->diafan->value = $this->diafan->cat;
		}
		echo '
		<tr valign="top" id="cat_id">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				<select name="'.$this->diafan->key.'">';
		$marker = "&nbsp;&nbsp;";
		if ($this->diafan->config("category_flat"))
		{
			$result = DB::query("SELECT id, ".($this->diafan->config('category_no_multilang') ? "name" : "[name]")." FROM {%s_category} WHERE trash='0'", $this->diafan->table);
			while ($row = DB::fetch_array($result))
			{
				$cats[0][] = $row;
			}
		}
		else
		{
			$result = DB::query("SELECT id, ".($this->diafan->config('category_no_multilang') ? "name" : "[name]").", parent_id FROM {%s_category} WHERE trash='0'".( $this->diafan->config("element_multiple") ? " ORDER BY sort ASC" : "" ), $this->diafan->table);
			while ($row = DB::fetch_array($result))
			{
				$cats[$row["parent_id"]][] = $row;
			}
		}

		echo $this->diafan->get_options($cats, $cats[0], array ( $this->diafan->value )).'</select>'.$this->diafan->help();

		if ($this->diafan->config("element_multiple"))
		{
			$values = array ();
			if (!$this->diafan->addnew)
			{
				$result = DB::query("SELECT cat_id FROM {%s_category_rel} WHERE element_id='%d'", $this->diafan->table, $this->diafan->edit);
				while ($row = DB::fetch_array($result))
				{
					if ($row["cat_id"] != $this->diafan->value)
					{
						$values[] = $row["cat_id"];
					}
				}
			}
			echo '
			<br>
			<input type="checkbox" value="1" name="user_additional_cat_id" class="show_tr_click_checkbox" rel="#cat_ids"'.( $values ? ' checked' : '' ).'>
			'.$this->diafan->_('Дополнительные категории').'
			<div id="cat_ids">
			<select name="cat_ids[]" multiple="multiple">';
			if (!empty( $cats ))
			{
				echo $this->diafan->get_options($cats, $cats[0], $values);
			}
			echo '</select>
			</div>';
		}
		echo '
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Доступ"
	 *
	 * @return void
	 */
	public function edit_variable_access()
	{
		echo '
		<tr valign="top" id="access">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			    <td>';

		$checked = array ();
		if ($this->diafan->value == '1')
		{
			if ($this->diafan->config('category'))
			{
				$cat_id = $this->diafan->edit;
				$element_id = 0;
			}
			else
			{
				$cat_id = 0;
				$element_id = $this->diafan->edit;
			}

			$res = DB::query("SELECT role_id FROM {access} WHERE module_name='%s' AND element_id=%d AND cat_id=%d", $this->diafan->module, $element_id, $cat_id);
			while ($row = DB::fetch_array($res))
			{
				$checked[] = $row['role_id'];
			}
		}
		echo '<input type="checkbox" name="access" '.($this->diafan->value=='1'?' checked':'').'> '.$this->diafan->_('Доступ только').':<br><div style="margin-left:25px">';
		$result = DB::query("SELECT id, [name] FROM {users_role} WHERE trash='0'");
		while ($row = DB::fetch_array($result))
		{
			echo '<input type="checkbox" name="access_role[]" value="'.$row['id'].'"'.( !$this->diafan->value || in_array($row['id'], $checked) ? ' checked' : '' ).'> '.$row['name'].'<br>';
		}

		echo '</div>'.$this->diafan->help().'</td></tr>';
	}

	/**
	 * Редактирование поля "Принадлежит"
	 *
	 * @return void
	 */
	public function edit_variable_parent_id()
	{
		if ($this->diafan->addnew)
		{
			$this->diafan->value = $this->diafan->parent;
		}

		echo '
		<tr valign="top" id="parent_id">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
			<span class="change_parent_id">
			<a href="#" class="dashed_link">';
			if( !$this->diafan->value)
			{
				if($this->diafan->module == 'site')
				{
					echo $this->diafan->_('Главная');
				}
				else
				{
					echo $this->diafan->_('нет');
				}
			}
			else
			{
				if(!empty($this->diafan->text_for_base_link["variable"]))
				{
					$list_name = $this->diafan->text_for_base_link["variable"];
				}
				else
				{
					$list_name = 'name';
				}
				$list_name = ($this->diafan->variable_multilang($list_name) ? '['.$list_name.']' : $list_name);
				echo DB::query_result("SELECT ".$list_name." FROM {".$this->diafan->table."} WHERE id=%d LIMIT 1", $this->diafan->value) ;
			}
			echo '</a>
			<input name="parent_id" type="hidden" value="'.$this->diafan->value.'">
			</span>
			'.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Раздел сайта"
	 *
	 * @return void
	 */
	public function edit_variable_site_id()
	{
		if ($this->diafan->config("element"))
		{
			return;
		}
		if (!$this->diafan->value)
		{
			$this->diafan->value = $this->diafan->site;
		}

		echo '
		<tr valign="top" id="site_id">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				<select name="'.$this->diafan->key.'"'.($this->diafan->variable_disabled() ? ' disabled' : '').'>';
		$cats = array();
		$result = DB::query("SELECT id, [name] FROM {site} WHERE trash='0' AND module_name='%s' ORDER BY id ASC", $this->diafan->module);
		while ($row = DB::fetch_array($result))
		{
			$cats[0][] = $row;
		}
		echo $this->diafan->get_options($cats, $cats[0], array ( $this->diafan->value )).'
				</select>
				'.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Расположение"
	 *
	 * @return void
	 */
	public function edit_variable_site_ids()
	{
		$show_in_site_id = array();
		$result = DB::query("SELECT site_id FROM {".$this->diafan->table."_site_rel} WHERE element_id=%d", $this->diafan->edit);
		while ($row = DB::fetch_array($result))
		{
			$show_in_site_id[] = $row["site_id"];
		}
		echo '
		<tr valign="top" id="site_ids">
		<td align="right">'.$this->diafan->variable_name().'</td>
		<td>
		<select multiple name="'.$this->diafan->key.'[]" size="12">';

		$result = DB::query("SELECT id, [name], parent_id FROM {site} WHERE trash='0' AND [act]='1' AND block='0' ORDER BY id ASC");
		while ($row = DB::fetch_array($result))
		{
			$cats[$row["parent_id"]][] = $row;
		}
		echo $this->diafan->get_options($cats, $cats[0], $show_in_site_id).'
				</select>
				'.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Сортировка"
	 *
	 * @return void
	 */
	public function edit_variable_sort()
	{
		$lang_act = ($this->diafan->variable_multilang("act") ? _LANG : '');
		if ($this->diafan->addnew || $this->diafan->is_variable("act") && ! $this->diafan->values["act".$lang_act])
		{
			return;
		}

		if(!empty($this->diafan->text_for_base_link["variable"]))
		{
			$list_name = $this->diafan->text_for_base_link["variable"];
		}
		else
		{
			$list_name = 'name';
		}
		$list_name = ($this->diafan->variable_multilang($list_name) ? $list_name._LANG : $list_name);
		$name = ( $this->diafan->values[$list_name] ? $this->diafan->values[$list_name] : $this->diafan->edit );

		echo '
		<tr id="sort">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				<span class="change_sort">
				<a href="#" sname="'.$name.'" sort="'.$this->diafan->value.'"'
				. ( $this->diafan->config("element") ? ' cat_id="'.$this->diafan->values["cat_id"].'"' : '' )
				. ( $this->diafan->config("parent") ? ' parent_id="'.$this->diafan->values["parent_id"].'"' : '' )
				. ( $this->diafan->config("element_site") ? ' site_id="'.$this->diafan->values["site_id"].'"' : '' ).' class="dashed_link">'
				. $name.'</a>
				<input name="sort" type="hidden" value="'.$this->diafan->edit.'">
				</span>
				'.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Псевдоссылка"
	 *
	 * @return void
	 */
	public function edit_variable_rewrite()
	{
		$rewrite = '';
		$redirect = '';
		$redirect_code = 301;
		if (! $this->diafan->addnew)
		{
			if ($this->diafan->config("category"))
			{
				$rewrite = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='%s' AND cat_id=%d LIMIT 1", $this->diafan->module, $this->diafan->edit);
				$row_redirect = DB::fetch_array(DB::query("SELECT redirect, code FROM {redirect} WHERE module_name='%s' AND cat_id=%d AND element_id=0 LIMIT 1", $this->diafan->module, $this->diafan->edit));
				$redirect = $row_redirect["redirect"];
				$redirect_code = $row_redirect["code"];
			}
			elseif ($this->diafan->module == "site")
			{
				$rewrite = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND site_id=%d LIMIT 1", $this->diafan->edit);
				$row_redirect = DB::fetch_array(DB::query("SELECT redirect, code FROM {redirect} WHERE module_name='site' AND site_id=%d LIMIT 1", $this->diafan->edit));
				$redirect = $row_redirect["redirect"];
				$redirect_code = $row_redirect["code"];
			}
			else
			{
				$rewrite = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='%s' AND element_id=%d LIMIT 1", $this->diafan->module, $this->diafan->edit);
				$row_redirect = DB::fetch_array(DB::query("SELECT redirect, code FROM {redirect} WHERE module_name='%s' AND element_id=%d LIMIT 1", $this->diafan->module, $this->diafan->edit));
				$redirect = $row_redirect["redirect"];
				$redirect_code = $row_redirect["code"];
			}
		}
		if(! $redirect_code)
		{
			$redirect_code = 301;
		}
		$rewrite_site = '';
		if (!$rewrite && $this->diafan->module != "site")
		{
			if ($this->diafan->addnew)
			{
				$this->diafan->values["parent_id"] = $this->diafan->parent;
				$this->diafan->values["cat_id"] = $this->diafan->cat;
				if ($this->diafan->config("element") && $this->diafan->values["cat_id"])
				{
					$this->diafan->values["site_id"] = DB::query_result("SELECT site_id FROM {".$this->diafan->table."_category} WHERE id=%d LIMIT 1", $this->diafan->cat);
				}
				elseif ($this->diafan->site)
				{
					$this->diafan->values["site_id"] = $this->diafan->site;
				}
				elseif (DB::query_result("SELECT COUNT(*) FROM {site} WHERE module_name='%s' AND trash='0' AND [act]='1'", $this->diafan->module) == 1)
				{
					$this->diafan->values["site_id"] = DB::query_result("SELECT id FROM {site} WHERE module_name='%s' AND trash='0' AND [act]='1' LIMIT 1", $this->diafan->module);
				}
			}
			if ($this->diafan->config("element") && $this->diafan->values["cat_id"])
			{
				if (!$rewrite_site = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='%s' AND cat_id=%d LIMIT 1", $this->diafan->module, $this->diafan->values["cat_id"]))
				{
					$rewrite_site = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND site_id=%d LIMIT 1", $this->diafan->values["site_id"]);
				}
			}
			elseif ($this->diafan->config("category"))
			{
				if (( !$this->diafan->values["parent_id"] || !$rewrite_site = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='%s' AND cat_id=%d LIMIT 1", $this->diafan->module, $this->diafan->values["parent_id"]) ) && !empty( $this->diafan->values["site_id"] ))
				{
					$rewrite_site = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND site_id=%d LIMIT 1", $this->diafan->values["site_id"]);
				}
			}
			elseif (!empty( $this->diafan->values["site_id"] ))
			{
				$rewrite_site = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND site_id=%d LIMIT 1", $this->diafan->values["site_id"]);
			}
		}
		echo '
		<tr id="rewrite">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				'.BASE_URL.'/'.( $rewrite_site ? $rewrite_site.'/' : '' ).'<input type="text" name="rewrite" size="40" value="'.$rewrite.'">'.ROUTE_END .'&nbsp;'. $this->diafan->help().'
			</td>
		</tr>
		<tr id="redirect">
			<td class="td_first">'.$this->diafan->_('Редирект на текущую страницу со страницы').':</td>
			<td>
				'.BASE_URL.'/<input type="text" name="rewrite_redirect" size="40" value="'.$redirect.'">
				<br>'.$this->diafan->_('Код ошибки').'
				<input type="text" name="rewrite_code" size="5" value="'.$redirect_code.'">
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Время редактирования"
	 *
	 * @return void
	 */
	public function edit_variable_timeedit()
	{
		$timeedit = $this->diafan->value ? $this->diafan->value : time();

		echo '
		<tr id="timeedit">
			<td class="td_first">
				'.$this->diafan->variable_name().'
			</td>
			<td>
				'.date("D, d M Y H:i:s", $timeedit).$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Номер страницы"
	 * @return void
	 */
	public function edit_variable_number()
	{
		if ($this->diafan->addnew)
		{
			return;
		}
		echo '<tr id="number">
				<td class="td_first">
					'.$this->diafan->variable_name().'
				</td>
				<td style="color:#999999;font-weight:bold">
					id='.$this->diafan->edit.' '.$this->diafan->help().'
				</td>
			</tr>';
	}

	/**
	 * Редактирование поля "Шаблон страницы"
	 * @return void
	 */
	public function edit_variable_theme()
	{
		// значения для нового элемента передаются от родителя
		if($this->diafan->addnew && $this->diafan->config('parent') && $this->diafan->parent)
		{
			if(! isset($this->cache["parent_row"]))
			{
				$this->cache["parent_row"] = DB::fetch_array(DB::query("SELECT * FROM {".$this->diafan->table."} WHERE id=%d LIMIT 1", $this->diafan->parent));
			}
			if(! empty($this->cache["parent_row"]["theme"]))
			{
				$this->diafan->values["theme"] = $this->cache["parent_row"]["theme"];
			}
		}
		$themes = $this->diafan->get_themes();

		echo '<tr id="theme">
			<td class="td_first">
				'.$this->diafan->variable_name().'
			</td>
			<td>
				<select name="theme">
					<option value="">'.(! empty($themes['site.php']) ? $themes['site.php'] : 'site.php').'</option>';
		foreach ($themes as $key => $value)
		{
			if ($key == 'site.php')
				continue;
			echo '<option value="'.$key.'"'.(! empty($this->diafan->values["theme"]) &&  $this->diafan->values["theme"] == $key ? ' selected' : '').'>'.$value.'</option>';
		}
		echo '
				</select>';
		echo $this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Формирование списка шаблонов сайта
	 * @return array
	 */
	public function get_themes()
	{
		if(isset($this->cache["themes"]))
		{
			return $this->cache["themes"];
		}
		$this->cache["themes"] = array();
		if (! $dir = opendir(ABSOLUTE_PATH.'themes'))
		{
			throw new Exception('Папка '.ABSOLUTE_PATH.'themes не существует.');
		}
		while (($file = readdir($dir)) !== false)
		{
			if ($file != '.' && $file != '..' && is_file(ABSOLUTE_PATH.'themes/'.$file))
			{
				$key = $file;
				$name = $file;
				$handle = fopen(ABSOLUTE_PATH.'themes/'.$file, "r");
				$start = false;
				while (($data = fgets($handle)) !== false)
				{
					if(strpos($data, '<?php') !== false)
					{
						$start = true;
						continue;
					}
					if($start && preg_match('/\* (.*)$/', $data, $m))
					{
						$name = $m[1];
						break;
					}
					if(preg_match('/^\</', $data))
					{
						break;
					}
				}
				fclose($handle);
				$this->cache["themes"][$key] = $name;
			}
		}
		arsort($this->cache["themes"]);
		closedir($dir);
		return $this->cache["themes"];
	}

	/**
	 * Редактирование поля "Шаблон модуля"
	 * @return void
	 */
	public function edit_variable_view()
	{
		// значения для нового элемента передаются от родителя
		if($this->diafan->addnew && $this->diafan->config('parent') && $this->diafan->parent)
		{
			if(! isset($this->cache["parent_row"]))
			{
				$this->cache["parent_row"] = DB::fetch_array(DB::query("SELECT * FROM {".$this->diafan->table."} WHERE id=%d LIMIT 1", $this->diafan->parent));
			}
			if(! empty($this->cache["parent_row"]["view"]))
			{
				$this->diafan->values["view"] = $this->cache["parent_row"]["view"];
			}
		}
		$views = $this->diafan->get_views($this->diafan->module);

		echo '<tr id="view">
			<td class="td_first">
				'.$this->diafan->variable_name().'
			</td>
			<td>';
			$default = $this->diafan->config('category') ? 'list' : 'id';
			echo '
				<select name="view">
					<option value="">'.(! empty($views[$default]) ? $views[$default] : $this->diafan->module.'.view.'.$default.'.php').'</option>';
			foreach ($views as $key => $value)
			{
				if ($key == $default)
				{
					continue;
				}
				echo '<option value="'.$key.'"'.( ! empty($this->diafan->values["view"]) && $this->diafan->values["view"] == $key ? ' selected' : '' ).'>'.$value.'</option>';
			}
			echo '</select>';
			echo $this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Шаблон модуля для вложенных элементов"
	 * @return void
	 */
	public function edit_variable_view_element()
	{
		// значения для нового элемента передаются от родителя
		if($this->diafan->addnew && $this->diafan->config('parent') && $this->diafan->parent)
		{
			if(! isset($this->cache["parent_row"]))
			{
				$this->cache["parent_row"] = DB::fetch_array(DB::query("SELECT * FROM {".$this->diafan->table."} WHERE id=%d LIMIT 1", $this->diafan->parent));
			}
			if(! empty($this->cache["parent_row"]["view_element"]))
			{
				$this->diafan->values["view_element"] = $this->cache["parent_row"]["view_element"];
			}
		}
		$views = $this->diafan->get_views($this->diafan->module);

		echo '<tr id="view">
			<td class="td_first">
				'.$this->diafan->variable_name().'
			</td>
			<td>';
			echo '
				<select name="view_element">
					<option value="">'.(! empty($views['id']) ? $views['id'] : $this->diafan->module.'.view.id.php').'</option>';
			foreach ($views as $key => $value)
			{
				if ($key == 'id')
				{
					continue;
				}
				echo '<option value="'.$key.'"'.( ! empty($this->diafan->values["view_element"]) && $this->diafan->values["view_element"] == $key ? ' selected' : '' ).'>'.$value.'</option>';
			}
			echo '</select>';
			echo $this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Формирование списка шаблонов модуля
	 *
	 * @param string $module модуль
	 * @return array
	 */
	public function get_views($module)
	{
		if(isset($this->cache["views"][$module]))
		{
			return $this->cache["views"][$module];
		}
		$this->cache["views"][$module] = array();
		if (! $dir = opendir(ABSOLUTE_PATH."modules/".$module."/views"))
		{
			throw new Exception('Папка '.ABSOLUTE_PATH."modules/".$module.'/views не существует.');
		}
		while (($file = readdir($dir)) !== false)
		{
			if ($file != '.' && $file != '..'  && is_file(ABSOLUTE_PATH."modules/".$module."/views/".$file))
			{
				if (!preg_match('/'.$module.'\.view\.([^\.]+)\.php/', $file, $match))
				{
					continue;
				}
				$key = $match[1];
				$name = $file;
				$handle = fopen(ABSOLUTE_PATH."modules/".$module."/views/".$file, "r");
				$start = false;
				while (($data = fgets($handle)) !== false)
				{
					if(strpos($data, '/**') !== false)
					{
						$start = true;
						continue;
					}
					if($start && preg_match('/\* (.*)$/', $data, $m))
					{
						$name = $m[1];
						break;
					}
					if(preg_match('/\*\//', $data))
					{
						break;
					}
				}
				fclose($handle);
				$this->cache["views"][$module][$key] = $name;
			}
		}
		arsort($this->cache["views"][$module]);
		closedir($dir);
		return $this->cache["views"][$module];
	}

	/**
	 * Редактирование поля "Редактор"
	 * @return void
	 */
	public function edit_variable_admin_id()
	{
		if($this->diafan->addnew)
			return false;

		echo '
		<tr id="admin_id">
			<td align="right">'.$this->diafan->variable_name().'</td>
			<td>'
			.(! $this->diafan->value
			  ? $this->diafan->_('не задан')
			  : DB::query_result("SELECT CONCAT(fio, ' (', name, ')') FROM {users} WHERE id=%d LIMIT 1", $this->diafan->value)
			)
			.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Автор"
	 * @return void
	 */
	public function edit_variable_user_id()
	{
		if ($this->diafan->addnew)
		{
			return;
		}
		echo '
		<tr id="user_id">
			<td align="right">'.$this->diafan->variable_name().'</td>
			<td>'
			.(! $this->diafan->value
			  ? $this->diafan->_('Гость')
			  : '<a href="'.BASE_PATH_HREF.'users/edit'.$this->diafan->value.'/">'.DB::query_result("SELECT CONCAT(fio, ' (', name, ')') FROM {users} WHERE id=%d LIMIT 1", $this->diafan->value).'</a>'
			)
			.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Период действия"
	 * @return void
	 */
	public function edit_variable_date_start()
	{
		$time = "";
		if($this->diafan->variable() == 'datetime')
		{
			$time = " H:i";
		}
		echo '
		<tr id="date_start">
			<td class="td_first">
				'.$this->diafan->variable_name().'
			</td>
			<td>
				<input type="text" name="date_start" size="20" value="'
				.(! empty($this->diafan->values["date_start"]) ? date("d.m.Y".$time, $this->diafan->values["date_start"]) : '')
				.'" class="timecalendar" showTime="'.($this->diafan->variable() == 'date' ? 'false' : 'true').'">
				-
				<input type="text" name="date_finish" size="20" value="'
				.(! empty($this->diafan->values["date_finish"]) ? date("d.m.Y".$time, $this->diafan->values["date_finish"]) : '')
				.'" class="timecalendar" showTime="'.($this->diafan->variable("date_finish") == 'date' ? 'false' : 'true').'">
				'.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Период действия"
	 * @return void
	 */
	public function edit_variable_date_finish(){}

	/**
	 * Редактирование поля "Дополнительные параметры"
	 * 
	 * @return void
	 */
	public function edit_variable_param($where = '')
	{
		$values = array();
		$rvalues = array();
		$multilang = $this->diafan->variable_multilang("param");

		if (! $this->diafan->addnew)
		{
			$result_el = DB::query("SELECT value".($multilang ? $this->diafan->language_base_site." as rv, [value]" : "")
			.", param_id FROM {".$this->diafan->table."_param_element} WHERE element_id=%d", $this->diafan->edit);
			while ($row_el = DB::fetch_array($result_el))
			{
				$values[$row_el["param_id"]][]  = $row_el["value"];
				if($multilang)
				{
					$rvalues[$row_el["param_id"]][] = $row_el["rv"];
				}
			}
		}

		$result = DB::query("SELECT p.id, p.[name], p.type, p.[text], p.config FROM {".$this->diafan->table."_param} as p "
		                    ." WHERE p.trash='0'".$where." ORDER BY p.sort ASC");

		while ($row = DB::fetch_array($result))
		{
			$options = array();
			if (in_array($row["type"], array('select', 'multiple')))
			{
				if($row["type"] == "select")
				{
					$options[""] = "-";
				}
				$result_select = DB::query("SELECT [name], id FROM {".$this->diafan->table."_param_select} WHERE param_id=%d ORDER BY sort ASC", $row["id"]);
				while ($row_select = DB::fetch_array($result_select))
				{
					$options[] = $row_select;
				}
			}
			$help = $this->diafan->help($row["text"]);
			switch($row["type"])
			{
				case 'title':
					$this->diafan->show_table_tr_title("param".$row["id"], $row["name"], $help);
					break;

				case 'text':
					$value = (! empty($values[$row["id"]]) ? $values[$row["id"]][0] : '');
					$this->diafan->show_table_tr_text("param".$row["id"], $row["name"], $value, $help);
					break;

				case 'textarea':
					$value = (! empty($values[$row["id"]]) ? $values[$row["id"]][0] : '');
					$this->diafan->show_table_tr_textarea("param".$row["id"], $row["name"], $value, $help);
					break;

				case 'email':
					if($multilang)
					{
						$value = (! empty($rvalues[$row["id"]]) ? $rvalues[$row["id"]][0] : '');
					}
					else
					{
						$value = (! empty($values[$row["id"]]) ? $values[$row["id"]][0] : '');
					}
					$this->diafan->show_table_tr_email("param".$row["id"], $row["name"], $value, $help);
					break;

				case 'date':
					if($multilang)
					{
						$value = (! empty($rvalues[$row["id"]]) ? $this->diafan->unixdate($this->diafan->formate_from_date($rvalues[$row["id"]][0])) : '');
					}
					else
					{
						$value = (! empty($values[$row["id"]]) ? $this->diafan->unixdate($this->diafan->formate_from_date($values[$row["id"]][0])) : '');
					}
					$this->diafan->show_table_tr_date("param".$row["id"], $row["name"], $value, $help);
					break;

				case 'datetime':
					if($multilang)
					{
						$value = (! empty($rvalues[$row["id"]]) ? $this->diafan->unixdate($this->diafan->formate_from_datetime($rvalues[$row["id"]][0])) : '');
					}
					else
					{
						$value = (! empty($values[$row["id"]]) ? $this->diafan->unixdate($this->diafan->formate_from_datetime($values[$row["id"]][0])) : '');
					}
					$this->diafan->show_table_tr_datetime("param".$row["id"], $row["name"], $value, $help);
					break;

				case 'numtext':
					if($multilang)
					{
						$value = (! empty($rvalues[$row["id"]]) ? $rvalues[$row["id"]][0] : 0);
					}
					else
					{
						$value = (! empty($values[$row["id"]]) ? $values[$row["id"]][0] : 0);
					}
					$this->diafan->show_table_tr_numtext("param".$row["id"], $row["name"], $value, $help);
					break;

				case 'floattext':
					if($multilang)
					{
						$value = (! empty($rvalues[$row["id"]]) ? $rvalues[$row["id"]][0] : 0);
					}
					else
					{
						$value = (! empty($values[$row["id"]]) ? $values[$row["id"]][0] : 0);
					}
					$this->diafan->show_table_tr_floattext("param".$row["id"], $row["name"], $value, $help);
					break;

				case 'checkbox':
					if($multilang)
					{
						$value = (! empty($rvalues[$row["id"]]) ? $rvalues[$row["id"]][0] : 0);
					}
					else
					{
						$value = (! empty($values[$row["id"]]) ? $values[$row["id"]][0] : 0);
					}
					$this->diafan->show_table_tr_checkbox("param".$row["id"], $row["name"], $value, $help);
					break;

				case 'select':
					if($multilang)
					{
						$value = (! empty($rvalues[$row["id"]]) ? $rvalues[$row["id"]][0] : 0);
					}
					else
					{
						$value = (! empty($values[$row["id"]]) ? $values[$row["id"]][0] : 0);
					}
					$this->diafan->show_table_tr_select_arr("param".$row["id"], $row["name"], $value, $help, false, $options);
					break;

				case 'multiple':
					if($multilang)
					{
						$value = (! empty($rvalues[$row["id"]]) ? $rvalues[$row["id"]] : array());
					}
					else
					{
						$value = (! empty($values[$row["id"]]) ? $values[$row["id"]] : array());
					}
					$this->diafan->show_table_tr_multiple("param".$row["id"], $row["name"], $value, $help, false, $options);
					break;

				case 'attachments':
					Customization::inc('modules/attachments/admin/attachments.admin.inc.php');
					$attachments = new Attachments_admin_inc($this->diafan);
					$attachments->edit_param($row["id"], $row["name"], $row["text"], $row["config"]);
					break;

				case 'images':
					Customization::inc('modules/images/admin/images.admin.inc.php');
					$images = new Images_admin_inc($this->diafan);
					$images->edit_param($row["id"], $row["name"], $row["text"]);
					break;
			}
		}
	}

	/**
	 * Редактирование поля "Значения поля конструктора"
	 * @return void
	 */
	public function edit_variable_param_select()
	{
		$value = array();
		if (empty($this->diafan->values["type"]))
		{
			$this->diafan->values["type"] = '';
		}
		if (! $this->diafan->addnew && in_array($this->diafan->values["type"], array('select', 'multiple', 'checkbox')))
		{
			$result_select = DB::query("SELECT id, sort, value, "
			.($this->diafan->variable_multilang("name") ? "[name]" : "name")
			." FROM {".$this->diafan->table."_select}"
			." WHERE param_id=%d ORDER BY sort ASC", $this->diafan->edit);
			while ($row_select = DB::fetch_array($result_select))
			{
				if ($this->diafan->values["type"] == 'checkbox')
				{
					$value[$row_select["value"]] = $row_select["name"];
				}
				else
				{
					$value[] = $row_select;
				}
			}
		}

		echo '
		<script type="text/javascript" src="'.BASE_PATH.'js/admin/admin.param_select.js"></script>

		<tr id="param" valign="top">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
			<table>';

		$fileds = false;
		if (in_array($this->diafan->values["type"], array('select', 'multiple')))
		{
			foreach ($value as $row)
			{
				echo '
				<tr class="param">
					<td>
						<input type="hidden" name="param_id[]" value="'.$row["id"].'" class="param_id">
						<input type="hidden" name="param_sort[]" value="'.$row["sort"].'" class="param_sort">
						<input type="text" name="paramv[]" size="40" value="'.str_replace('"', '&quot;', $row["name"]).'">
						<span class="param_actions">
							<a href="javascript:void(0)" action="delete_param" confirm="'.$this->diafan->_('Вы действительно хотите удалить запись?').'"><img src="'.BASE_PATH.'adm/img/delete.png" width="13" height="13" alt="'.$this->diafan->_('Удалить').'"></a>
							<a href="javascript:void(0)" action="up_param"><img src="'.BASE_PATH.'adm/img/up.gif" width="14" height="16" alt="'.$this->diafan->_('Выше').'"></a>
							<a href="javascript:void(0)" action="down_param"><img src="'.BASE_PATH.'adm/img/down.gif" width="14" height="16" alt="'.$this->diafan->_('Ниже').'"></a>
						</span>
					</td>
				</tr>';
				$fileds = true;
			}
		}
		if (! $fileds)
		{
			echo '
			<tr class="param">
				<td>
					<input type="text" name="paramv[]" size="40" value="">
					<span class="param_actions">
						<a href="javascript:void(0)" action="delete_param" confirm="'.$this->diafan->_('Вы действительно хотите удалить запись?').'">
							<img src="'.BASE_PATH.'adm/img/delete.png" width="15" height="15" alt="'.$this->diafan->_('Удалить').'">
						</a>
					</span>
				</td>
			</tr>';
		}
		echo '</table>
				<a href="javascript:void(0)" class="param_plus" title="'.$this->diafan->_('Добавить').'"><img src="'.BASE_PATH.'adm/img/add.png" width="16" height="16" alt="'.$this->diafan->_('Добавить').'"></a>
			</td>
		</tr>
		<tr id="param_check">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				'.$this->diafan->_('да').' <input type="text" name="paramk_check1" size="20" value="'
				.(! empty($value[1]) && $this->diafan->values["type"] == 'checkbox' ? str_replace('"', '&quot;', $value[1]) : '')
				.'">
				&nbsp;&nbsp;
				'.$this->diafan->_('нет').' <input type="text" name="paramk_check0" size="20" value="'
				.(! empty($value[0]) && $this->diafan->values["type"] == 'checkbox' ? str_replace('"', '&quot;', $value[0]) : '').'">
			</td>
		</tr>';
		if($this->diafan->select_arr("type", "attachments"))
		{
			Customization::inc('modules/attachments/admin/attachments.admin.inc.php');
			$attachments = new Attachments_admin_inc($this->diafan);
			$attachments->edit_config_param(! empty($this->diafan->values["config"]) ? $this->diafan->values["config"] : '');
		}
		if($this->diafan->select_arr("type", "images"))
		{
			Customization::inc('modules/images/admin/images.admin.inc.php');
			$images = new Images_admin_inc($this->diafan);
			$images->edit_config_param(! empty($this->diafan->values["config"]) ? $this->diafan->values["config"] : '');
		}
	}

	/**
	 * Редактирование поля "Похожие элементы"
	 *
	 * @return void
	 */
	public function edit_variable_rel_elements()
	{
		$rel_two_sided = $this->diafan->configmodules("rel_two_sided", $this->diafan->module, (! empty($this->values["site_id"]) ? $this->values["site_id"] : $this->diafan->site));

		$name = ! empty($this->diafan->text_for_base_link["variable"]) ? $this->diafan->text_for_base_link["variable"] : 'name';

		echo '
		<script type="text/javascript" src="'.BASE_PATH.'js/admin/admin.rel_elements.js"></script>
		<tr id="rel_elements" valign="top" rel_two_sided="'.($rel_two_sided ? 'true' : 'false').'">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				<div class="rel_elements">';
		if ( ! $this->diafan->addnew)
		{
			$result = DB::query("SELECT s.id, s.[".$name."], s.cat_id, s.site_id FROM {".$this->diafan->table."} AS s"
					." INNER JOIN {".$this->diafan->table."_rel} AS r ON s.id=r.rel_element_id AND r.element_id=%d"
					.($rel_two_sided ? " OR s.id=r.element_id AND r.rel_element_id=".$this->diafan->edit : "")
					." WHERE s.trash='0' GROUP BY s.id",
					$this->diafan->edit
				);
			while ($row = DB::fetch_array($result))
			{
				$link = $this->diafan->_route->link($row["site_id"], $this->diafan->table, $row["cat_id"], $row["id"]);
				if($this->diafan->is_variable("images") || $this->diafan->is_variable("image"))
				{
					$img = DB::query_result("SELECT name FROM {images} WHERE element_id=%d AND module_name='%s' AND trash='0' ORDER BY sort ASC LIMIT 1", $row["id"], $this->diafan->table);
				}
				echo '
				<div class="rel_element" element_id="'.$this->diafan->edit.'" rel_id="'.$row["id"].'">
					<div class="rel_element_actions">
						<a href="javascript:void(0)" confirm="'.$this->diafan->_('Вы действительно хотите удалить запись?').'" action="delete_rel_element"><img src="'.BASE_PATH.'adm/img/delete.png" width="13" height="13" alt="'.$this->diafan->_('Удалить').'"></a>
						<a href="'.BASE_PATH.$link.'" target="_blank"><img src="'.BASE_PATH.'adm/img/view.png" width="21" height="13" alt="'.$this->diafan->_('Посмотреть на сайте').'"></a>
					</div>'
					.(! empty($img) ? '<img src="'.BASE_PATH.USERFILES.'/small/'.$img.'"><br>' : '').$this->diafan->short_text($row[$name], 50)
					.'
					<div class="clear"></div>
				</div>';
			}
		}
		echo '</div>
				<a href="javascript:void(0)" class="rel_module_plus" title="'.$this->diafan->_('Добавить').'"><img src="'.BASE_PATH.'adm/img/add_new.png" width="14" height="14" alt="'.$this->diafan->_('Добавить').'"></a>
				<div class="hide" id="rel_module_container"></div>
				'.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Счетчик просмотров"
	 * @return void
	 */
	public function edit_variable_counter_view()
	{
		if ($this->diafan->addnew || ! $this->diafan->configmodules("counter"))
		{
			return;
		}
		$counter_view = DB::query_result("SELECT count_view FROM {%s_counter} WHERE element_id=%d LIMIT 1", $this->diafan->table, $this->diafan->edit);
		if(! $counter_view)
		{
			$counter_view = 0;
		}

		echo '
		<tr id="counter_view">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>'.$counter_view.'</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Changefreq"
	 *
	 * @return void
	 */
	public function edit_variable_changefreq()
	{
		echo '
		<tr id="changefreq">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td><select name="changefreq">
			<option value="always">always</option>
			<option value="hourly"'.($this->diafan->value == 'hourly' ? ' selected' : '').'>hourly</option>
			<option value="daily"'.($this->diafan->value == 'daily' ? ' selected' : '').'>daily</option>
			<option value="weekly"'.($this->diafan->value == 'weekly' ? ' selected' : '').'>weekly</option>
			<option value="monthly"'.($this->diafan->value == 'monthly' ? ' selected' : '').'>monthly</option>
			<option value="yearly"'.($this->diafan->value == 'yearly' ? ' selected' : '').'>yearly</option>
			<option value="never"'.($this->diafan->value == 'never' ? ' selected' : '').'>never</option>
			</select></td>
		</tr>';
	}

	//----------------------------------------------------------------------//
	//функции редактирования конфигурации

	/**
	 * Редактирование поля "Электронный адрес" для конфигурации модуля
	 *
	 * @return void
	 */
	public function edit_config_variable_emailconf()
	{
		$select_arr = $this->diafan->select_arr;
		$select_arr["emailconf"] = array (
			0 => EMAIL_CONFIG,
			1 => $this->diafan->_('другой')
		);
		$this->diafan->select_arr = $select_arr;

		echo '
		<tr id="emailconf" valign="top">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				<select name="'.$this->diafan->key.'" class="show_select_div" rel="emailtext" id="text_em">'.$this->diafan->select_option($this->diafan->key, '', '', '', $this->diafan->value).'</select>
				<div id="emailtext">
					'.$this->diafan->variable_name("email").'<br>
					<input type="text" name="email" size="20" value="'.( !empty( $this->diafan->values["email"] ) ? $this->diafan->values["email"] : '' ).'">
				</div>'.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Электронный адрес администратора" для конфигурации модуля
	 *
	 * @return void
	 */
	public function edit_config_variable_emailconfadmin()
	{
		$select_arr = $this->diafan->select_arr;
		$select_arr["emailconfadmin"] = array (
			0 => EMAIL_CONFIG,
			1 => $this->diafan->_('другой')
		);
		$this->diafan->select_arr = $select_arr;

		$values = !empty( $this->diafan->values["email_admin"]) ? explode(',', $this->diafan->values["email_admin"]) : array();

		echo '
		<tr id="emailconfadmin" valign="top">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				<select name="'.$this->diafan->key.'" class="show_select_div" rel="emailadmintext">
					'.$this->diafan->select_option($this->diafan->key, '', '', '', $this->diafan->value).'
				</select>
				<div id="emailadmintext">
				'.$this->diafan->variable_name("email_admin").'<br>';
		if($values)
		{
			foreach($values as $v)
			{
				echo '<div><input type="text" name="email_admin[]" size="20" value="'.$v.'"></div>';
			}
		}
		else
		{
			echo '<div><input type="text" name="email_admin[]" size="20" value=""></div>';
		}
		echo '<a href="javascript:void(0)" class="email_admin_plus" title="'.$this->diafan->_('Добавить').'"><img src="'.BASE_PATH.'adm/img/add_new.png" width="14" height="14" alt="'.$this->diafan->_('Добавить').'"></a>
				</div>
				'.$this->diafan->help().'
			</td>
		</tr>
		<script>
			$(document).ready(function () {
				$(".email_admin_plus").click(function(){
				$("#emailadmintext div").last().after($("#emailadmintext div").last().clone());
				$("#emailadmintext div input").last().val("");
				});
			});
		</script>';
	}

	/**
	 * Редактирование поля "Использовать описание элемента"
	 *
	 * @return void
	 */
	public function edit_config_variable_text_element()
	{
		echo '
		<tr id="text_element">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				<select name="'.$this->diafan->key.'">
					'.$this->diafan->select_option($this->diafan->key, '', '', '', $this->diafan->value).'
				</select>
				<div'.( $this->diafan->value == 2 ? ' class="hide"' : '' ).'>
					<br>
					<input type="text" name="shorttext_element" size="10" value="'.$this->diafan->values["shorttext_element"].'" class="inpnum"> '.$this->diafan->variable_name("shorttext_element").'
				</div>';
		echo $this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Использовать описание группы"
	 *
	 * @return void
	 */
	public function edit_config_variable_text()
	{
		echo '
		<tr id="text">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				<select name="'.$this->diafan->key.'">'.$this->diafan->select_option($this->diafan->key, '', '', '', $this->diafan->value).'</select>
				<div'.( $this->diafan->value == 2 ? ' class="hide"' : '' ).'>
					<br>
					<input type="text" name="shorttext" size="10" value="'.$this->diafan->values["shorttext"].'" class="inpnum"> '.$this->diafan->variable_name("shorttext").'
				</div>';
					?>
				<script language="javascript" type="text/javascript">
					$('select[name=text], select[name=text_element]').change(function () {
						if ($(this).val() == 2) {
							$(this).next('div').show();
						}
						else {
							$(this).next('div').hide();
						}
					});
				</script>
				<?php
				echo $this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Шаблон страницы для разных ситуаций"
	 * @return void
	 */
	public function edit_config_variable_themes()
	{
		$themes = $this->diafan->get_themes();
		$views = $this->diafan->get_views($this->diafan->module);

		echo '<tr>
					<td colspan="2">
						<hr color="#ddd" size="1" noshade="">
					</td>
				</tr>
		<tr id="theme_list">
			<td class="td_first">
				'.$this->diafan->variable_name("theme_list").'
			</td>
			<td>
				<select name="theme_list">
					<option value="">'.(! empty($themes['site.php']) ? $themes['site.php'] : 'site.php').'</option>';
		foreach ($themes as $key => $value)
		{
			if ($key == 'site.php')
				continue;
			echo '<option value="'.$key.'"'.( $this->diafan->values["theme_list"] == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				<select name="view_list">
					<option value="">'.(! empty($views['list']) ? $views['list'] : $this->diafan->module.'.view.list.php').'</option>';
		foreach ($views as $key => $value)
		{
			if ($key == 'list')
				continue;

			echo '<option value="'.$key.'"'.( $this->diafan->values["view_list"] == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				'.$this->diafan->help("theme_list").'
			</td>
		</tr>

		<tr id="theme_first_page">
			<td class="td_first">
				'.$this->diafan->variable_name("theme_first_page").'
			</td>
			<td>
				<select name="theme_first_page">
					<option value="">'.(! empty($themes['site.php']) ? $themes['site.php'] : 'site.php').'</option>';
		foreach ($themes as $key => $value)
		{
			if ($key == 'site.php')
				continue;
			echo '<option value="'.$key.'"'.( $this->diafan->values["theme_first_page"] == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				<select name="view_first_page">
					<option value="">'.(! empty($views['first_page']) ? $views['first_page'] : $this->diafan->module.'.view.first_page.php').'</option>';
		foreach ($views as $key => $value)
		{
			if ($key == 'first_page')
			{
				continue;
			}
			echo '<option value="'.$key.'"'.( $this->diafan->values["view_first_page"] == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				'.$this->diafan->help("theme_first_page").'
			</td>
		</tr>

		<tr id="theme_id">
			<td class="td_first">
				'.$this->diafan->variable_name("theme_id").'
			</td>
			<td>
				<select name="theme_id">
					<option value="">'.(! empty($themes['site.php']) ? $themes['site.php'] : 'site.php').'</option>';
		foreach ($themes as $key => $value)
		{
			if ($key == 'site.php')
				continue;
			echo '<option value="'.$key.'"'.( $this->diafan->values["theme_id"] == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				<select name="view_id">
					<option value="">'.(! empty($views['id']) ? $views['id'] : $this->diafan->module.'.view.id.php').'</option>';
		foreach ($views as $key => $value)
		{
			if ($key == 'id')
			{
				continue;
			}
			echo '<option value="'.$key.'"'.( $this->diafan->values["view_id"] == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				'.$this->diafan->help("theme_id").'
			</td>
		</tr>';
	}
}
