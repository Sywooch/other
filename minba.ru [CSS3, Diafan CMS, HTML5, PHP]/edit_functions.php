<?php
/**
 * @package    DIAFAN.CMS
 *
 * @author     diafan.ru
 * @version    5.4
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2015 OOO «Диафан» (http://www.diafan.ru/)
 */

if (! defined('DIAFAN'))
{
	$path = __FILE__; $i = 0;
	while(! file_exists($path.'/includes/404.php'))
	{
		if($i == 10) exit; $i++;
		$path = dirname($path);
	}
	include $path.'/includes/404.php';
}

/**
 * Edit_functions_admin
 *
 * Функции редактирования полей
 */
class Edit_functions_admin extends Diafan
{	
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
			$this->diafan->value = $this->diafan->_route->cat;
		}
		echo '
		<tr valign="top" id="cat_id">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				<select name="'.$this->diafan->key.'">';
		$marker = "&nbsp;&nbsp;";
		if ($this->diafan->config("category_flat"))
		{
			$cats[0] = DB::query_fetch_all("SELECT id, ".($this->diafan->config('category_no_multilang') ? "name" : "[name]")." FROM {%s_category} WHERE trash='0' ORDER BY sort ASC", $this->diafan->table);
		}
		else
		{
			$cats = DB::query_fetch_key_array("SELECT id, ".($this->diafan->config('category_no_multilang') ? "name" : "[name]").", parent_id FROM {%s_category} WHERE trash='0'".( $this->diafan->config("element_multiple") ? " ORDER BY sort ASC" : "" ), $this->diafan->table, "parent_id");
		}

		echo $this->diafan->get_options($cats, $cats[0], array ( $this->diafan->value )).'</select>'.$this->diafan->help();

		if ($this->diafan->config("element_multiple"))
		{
			$values = array ();
			if (!$this->diafan->is_new)
			{
				$rows = DB::query_fetch_all("SELECT cat_id FROM {%s_category_rel} WHERE element_id=%d AND cat_id>0", $this->diafan->table, $this->diafan->id);
				foreach ($rows as $row)
				{
					if ($row["cat_id"] != $this->diafan->value)
					{
						$values[] = $row["cat_id"];
					}
				}
			}
			echo '
			<br>
			<input type="checkbox" value="1" name="user_additional_cat_id" id="input_user_additional_cat_id" class="show_tr_click_checkbox" rel="#cat_ids"'.( $values ? ' checked' : '' ).'>
			<label for="input_user_additional_cat_id">'.$this->diafan->_('Дополнительные категории').'</label>
			<div id="cat_ids">
			<select name="cat_ids[]" multiple="multiple" size="11">
			<option value="all"'.(empty($values) ? ' selected' : '').'>'.$this->diafan->_('Нет').'</option>';
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
			    <td><div style="float:left;">';

		$checked = array ();
		if ($this->diafan->value == '1')
		{
			$checked = DB::query_fetch_value("SELECT role_id FROM {access} WHERE element_id=%d AND module_name='%s' AND element_type='%s'", $this->diafan->id, $this->diafan->_admin->module, $this->diafan->element_type(), "role_id");
		}
		echo '<input type="checkbox" name="access" id="input_access" '.($this->diafan->value=='1'?' checked':'').'> <label for="input_access">'.$this->diafan->_('Доступ только').'</label>:<br><div style="margin-left:25px">';
		echo '<input type="checkbox" name="access_role[]" id="input_access_role_0" value="0"'.(! $this->diafan->value || in_array(0, $checked) ? ' checked' : '' ).'> <label for="input_access_role_0">'.$this->diafan->_('Гость').'</label><br>';
		$rows = DB::query_fetch_all("SELECT id, [name] FROM {users_role} WHERE trash='0'");
		foreach ($rows as $row)
		{
			echo '<input type="checkbox" name="access_role[]" id="input_access_role_'.$row['id'].'" value="'.$row['id'].'"'.( !$this->diafan->value || in_array($row['id'], $checked) ? ' checked' : '' ).'> <label for="input_access_role_'.$row['id'].'">'.$row['name'].'</label><br>';
		}

		echo '</div></div>'.$this->diafan->help().'</td></tr>';
	}

	/**
	 * Редактирование поля "Принадлежит"
	 *
	 * @return void
	 */
	public function edit_variable_parent_id()
	{
		if ($this->diafan->is_new)
		{
			$this->diafan->value = $this->diafan->_route->parent;
		}

		echo '
		<tr valign="top" id="parent_id">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
			<span class="change_parent_id">
			<a href="javascript:void(0)" class="dashed_link">';
			if( !$this->diafan->value)
			{
				if($this->diafan->_admin->module == 'site')
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
			$this->diafan->value = $this->diafan->_route->site;
		}

		echo '
		<tr valign="top" id="site_id">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				<select name="'.$this->diafan->key.'"'.($this->diafan->variable_disabled() ? ' disabled' : '').'>';
		$cats[0] = DB::query_fetch_all("SELECT id, [name] FROM {site} WHERE trash='0' AND module_name='%s' ORDER BY sort ASC, id DESC", $this->diafan->_admin->module);
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
		if(! $this->diafan->is_new)
		{
			$show_in_site_id = DB::query_fetch_value("SELECT site_id FROM {".$this->diafan->table."_site_rel} WHERE element_id=%d AND site_id>0", $this->diafan->id, "site_id");
		}
		echo '
		<tr valign="top" id="site_ids">
		<td align="right">'.$this->diafan->variable_name().'</td>
		<td>
		<select multiple name="'.$this->diafan->key.'[]" size="12" size="11">
		<option value="all"'.(empty($show_in_site_id) ? ' selected' : '').'>'.$this->diafan->_('Все').'</option>';

		$cats = DB::query_fetch_key_array("SELECT id, [name], parent_id FROM {site} WHERE trash='0' AND [act]='1' ORDER BY sort ASC, id DESC", "parent_id");
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
		if ($this->diafan->is_new || $this->diafan->is_variable("act") && ! $this->diafan->values("act"))
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
		$name = $this->diafan->values($list_name, $this->diafan->id);

		echo '
		<tr id="sort">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				<span class="change_sort">
				<a href="javascript:void(0)" sname="'.$name.'" sort="'.$this->diafan->value.'"'
				. ( $this->diafan->config("element") ? ' cat_id="'.$this->diafan->values("cat_id").'"' : '' )
				. ( $this->diafan->config("parent") ? ' parent_id="'.$this->diafan->values("parent_id").'"' : '' )
				. ( $this->diafan->config("element_site") ? ' site_id="'.$this->diafan->values("site_id").'"' : '' ).' class="dashed_link">'
				. $name.'</a>
				<input name="sort" type="hidden" value="'.$this->diafan->id.'">
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
		if (! $this->diafan->is_new)
		{
			$rewrite = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='%s' AND element_id=%d AND element_type='%s' LIMIT 1", $this->diafan->_admin->module, $this->diafan->id, $this->diafan->element_type());
			$row_redirect = DB::query_fetch_array("SELECT redirect, code FROM {redirect} WHERE module_name='%s' AND element_id=%d AND element_type='%s' LIMIT 1", $this->diafan->_admin->module, $this->diafan->id, $this->diafan->element_type());
			$redirect = $row_redirect["redirect"];
			$redirect_code = $row_redirect["code"];
		}
		if(! $redirect_code)
		{
			$redirect_code = 301;
		}
		$rewrite_site = '';
		if (!$rewrite && $this->diafan->_admin->module != "site")
		{
			if ($this->diafan->config("element") && $this->diafan->values("cat_id"))
			{
				if (! $rewrite_site = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='%s' AND element_id=%d AND element_type='cat' LIMIT 1", $this->diafan->_admin->module, $this->diafan->values("cat_id")))
				{
					$rewrite_site = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND element_id=%d AND element_type='element' LIMIT 1", $this->diafan->values("site_id"));
				}
			}
			elseif ($this->diafan->config("category"))
			{
				if ((! $this->diafan->values("parent_id")
					|| ! $rewrite_site = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='%s' AND element_id=%d AND element_type='cat' LIMIT 1", $this->diafan->_admin->module, $this->diafan->values("parent_id")))
					&& $this->diafan->values("site_id"))
				{
					$rewrite_site = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND element_id=%d AND element_type='element' LIMIT 1", $this->diafan->values("site_id"));
				}
			}
			elseif ($this->diafan->values("site_id"))
			{
				$rewrite_site = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND element_id=%d AND element_type='element' LIMIT 1", $this->diafan->values("site_id"));
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
	 * Редактирование поля "Анонс"
	 *
	 * @return void
	 */
	public function edit_variable_anons()
	{
		$value = $this->diafan->_route->replace_id_to_link($this->diafan->value);
		$height = $this->diafan->variable('anons', 'height');
		$name = $this->diafan->variable_name('anons');
		if(! $height)
		{
			$height = 400;
		}
		if($this->diafan->is_new)
		{
			$hide_htmleditor = false;
		}
		else
		{
			$hide_htmleditor = in_array('anons', explode(",", $this->diafan->configmodules("hide_".$this->diafan->table."_".$this->diafan->id, "htmleditor")));
		}
		echo $this->diafan->values("anons_plus");
		echo '
		<tr id="anons">
			<td colspan="2">
			<div style="position:relative;height:2em;">';
			if($this->diafan->_users->htmleditor)
			{
				echo '<div style="position:absolute;top:0;right: 50%;"><input type="checkbox" class="htmleditor_check" name="anons_htmleditor" id="input_anons_htmleditor" value="1"'.($hide_htmleditor ? ' checked' : '').' rel="htmleditor_anons"> <label for="input_anons_htmleditor">'.$this->diafan->_('HTML-код').'</label></div>';
			}
			echo '<div style="position:absolute;top:5px;left:0">'.$name.' '.$this->diafan->help().'
			<input type="checkbox" name="anons_plus" id="input_anons_plus" value="1"'.($this->diafan->values("anons_plus"._LANG) ? ' checked' : '').' title="'.$this->diafan->_('Прибавлять анонс к тексту описания на странице отдельной элемента.').'"> <label for="input_anons_plus">'.$this->diafan->_('Добавлять к описанию').'</label>
			</div>';
			echo '<div style="position:absolute;top:0;right:0"><input type="checkbox" name="anons_typograf" id="input_anons_typograf" value="1"> <label for="input_anons_typograf">'.$this->diafan->_('Применить <a href="http://www.artlebedev.ru/tools/typograf/webservice/">типограф</a>')
			.'</label></div>';
			echo '</div>';
			echo '<textarea name="anons" id="htmleditor_anons" style="width:100%; height:'.$height.'px"';
			if($this->diafan->_users->htmleditor)
			{
				if($hide_htmleditor)
				{
					echo ' class="htmleditor_off"';
				}
				else
				{
					echo ' class="htmleditor"';
				}
			}
			echo '>'.($value ? str_replace(array ( '<', '>', '"' ), array ( '&lt;', '&gt;', '&quot;' ), str_replace('&', '&amp;', $value)) : '' ).'</textarea>
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
		if($this->diafan->is_new)
		{
			return;
		}
		$timeedit = $this->diafan->value ? $this->diafan->value : time();

		echo '
		<tr id="timeedit">
			<td class="td_first">
				'.$this->diafan->variable_name().'
			</td>
			<td>
				<input name="timeedit" type="hidden" value="'.$this->diafan->value.'">
				'.date("D, d M Y H:i:s", $timeedit).$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Динамические блоки"
	 *
	 * @return void
	 */
	public function edit_variable_dynamic()
	{
		$element_type = $this->diafan->element_type();

		$dynamic = DB::query_fetch_all("SELECT b.id, b.[name], b.text, b.type FROM {site_dynamic} AS b"
			." INNER JOIN {site_dynamic_module} AS m ON m.dynamic_id=b.id"
			." WHERE b.trash='0'"
			." AND (m.module_name='%h' OR m.module_name='') AND (m.element_type='%h' OR m.element_type='')"
			." GROUP BY b.id ORDER BY b.sort ASC",
			$this->diafan->_admin->module, $element_type
		);

		if(! $this->diafan->is_new)
		{
			$values = DB::query_fetch_key("SELECT dynamic_id, [value], parent, category, value".$this->diafan->_languages->site." as rv FROM {site_dynamic_element} WHERE element_id=%d AND element_type='%s' AND module_name='%s'", $this->diafan->id, $element_type, $this->diafan->_admin->module, "dynamic_id");
		}
		foreach($dynamic as $row)
		{
			$help = $this->diafan->help($row["text"]);
			$value = (! empty($values[$row["id"]]) ? $values[$row["id"]]["value"] : '');
			$rvalue = (! empty($values[$row["id"]]) ? $values[$row["id"]]["rv"] : '');
			$parent = (! empty($values[$row["id"]]) ? $values[$row["id"]]["parent"] : '');
			$category = (! empty($values[$row["id"]]) ? $values[$row["id"]]["category"] : '');

			if($this->diafan->config('parent'))
			{
				$help .= '<br><input type="checkbox" name="dynamic_parent'.$row["id"].'" id="input_dynamic_parent'.$row["id"].'" value="1"'.($parent ? ' checked' : '').'> <label for="input_dynamic_parent'.$row["id"].'">'.$this->diafan->_('Применить к вложенным элементам').'</label>';
			}
			if($this->diafan->config('category'))
			{
				$help .= '<br><input type="checkbox" name="dynamic_category'.$row["id"].'" id="input_dynamic_category'.$row["id"].'" value="1"'.($category ? ' checked' : '').'> <label for="input_dynamic_category'.$row["id"].'">'.$this->diafan->_('Применить к элементам категории').'</label>';
			}
			$row["name"] .= ' (<a href="'.BASE_PATH_HREF.'site/dynamic/">'.$this->diafan->_('динамический блок').'</a>)';

			switch($row["type"])
			{
				case 'text':
					$this->diafan->show_table_tr_text("dynamic".$row["id"], $row["name"], $value, $help);
					break;

				case 'textarea':
					$this->diafan->show_table_tr_textarea("dynamic".$row["id"], $row["name"], $value, $help);
					break;

				case 'editor':
					$value = $this->diafan->_route->replace_id_to_link($value);
					$key = "dynamic".$row["id"];
					$height = 3;
					if($this->diafan->config('parent'))
					{
						$height += 1;
					}
					if($this->diafan->config('category'))
					{
						$height += 1;
					}

					echo '
					<tr id="'.$key.'">
						<td colspan="2"><div style="position:relative;height:'.$height.'em;">'
						.'<div style="position:absolute;top:5px;left:0">'.$row["name"].$help.'</div>'
						.'<div style="position:absolute;top:0;right:0"><input type="checkbox" name="'.$key.'_typograf" id="input_'.$key.'_typograf" value="1"> <label for="input_'.$key.'_typograf">'.$this->diafan->_('Применить <a href="http://www.artlebedev.ru/tools/typograf/about/" target="_blank">типограф</a>')
						.'</label></div></div><textarea name="'.$key.'" id="htmleditor_'.$key.'" style="width:100%; height:400px"'.( $this->diafan->_users->htmleditor ? ' class="htmleditor"' : '' ).'>'.( $value ? str_replace(array ( '<', '>', '"' ), array ( '&lt;', '&gt;', '&quot;' ), str_replace('&', '&amp;', $value)) : '' ).'</textarea>
						</td>
					</tr>';
					break;

				case 'email':
					$this->diafan->show_table_tr_email("dynamic".$row["id"], $row["name"], $rvalue, $help);
					break;

				case 'date':
					$this->diafan->show_table_tr_date("dynamic".$row["id"], $row["name"], $rvalue, $help);
					break;

				case 'datetime':
					$this->diafan->show_table_tr_datetime("dynamic".$row["id"], $row["name"], $rvalue, $help);
					break;

				case 'numtext':
					$this->diafan->show_table_tr_numtext("dynamic".$row["id"], $row["name"], $rvalue, $help);
					break;

				case 'floattext':
					$this->diafan->show_table_tr_floattext("dynamic".$row["id"], $row["name"], $rvalue, $help);
					break;
			}
		}
	}

	/**
	 * Редактирование поля "Номер страницы"
	 * @return void
	 */
	public function edit_variable_number()
	{
		if ($this->diafan->is_new)
		{
			return;
		}
		echo '<tr id="number">
				<td class="td_first">
					'.$this->diafan->variable_name().'
				</td>
				<td style="color:#999999;font-weight:bold">
					id='.$this->diafan->id.' '.$this->diafan->help().'
				</td>
			</tr>';
	}

	/**
	 * Редактирование поля "Шаблон страницы"
	 * @return void
	 */
	public function edit_variable_theme()
	{
		$theme = $this->diafan->values("theme");
		// значения для нового элемента передаются от родителя
		if($this->diafan->is_new && $this->diafan->config('parent') && $this->diafan->_route->parent)
		{
			if(! isset($this->cache["parent_row"]))
			{
				$this->cache["parent_row"] = DB::query_fetch_array("SELECT * FROM {".$this->diafan->table."} WHERE id=%d LIMIT 1", $this->diafan->_route->parent);
			}
			if(! empty($this->cache["parent_row"]["theme"]))
			{
				$theme = $this->cache["parent_row"]["theme"];
			}
		}
		$themes = $this->diafan->get_themes();

		echo '<tr id="theme">
			<td class="td_first">
				'.$this->diafan->variable_name().'
			</td>
			<td>
				<select name="theme" style="width:250px">
					<option value="">'.(! empty($themes['site.php']) ? $themes['site.php'] : 'site.php').'</option>';
		foreach ($themes as $key => $value)
		{
			if ($key == 'site.php')
				continue;
			echo '<option value="'.$key.'"'.($theme == $key ? ' selected' : '').'>'.$value.'</option>';
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
		$rows = Custom::read_dir('themes');
		foreach($rows as $file)
		{
			if (preg_match('!\.(php|inc)$!', $file) && is_file(ABSOLUTE_PATH.Custom::path('themes/'.$file)))
			{
				$key = $file;
				$name = $file;
				$handle = fopen(ABSOLUTE_PATH.Custom::path('themes/'.$file), "r");
				$start = false;
				$ln = 1; 
				while (($data = fgets($handle)) !== false)
				{
					if($ln == 1 && (strpos($data, '<?php') === 0 || (strpos($data, '<?') === 0)))
					{
						$start = true;
						continue;
					}
					if($start && preg_match('/\*\s(.+)$/', $data, $m))
					{
						$name = $this->diafan->_($m[1])." [$file]";
						break;
					}
					if(preg_match('/^\</', $data))
					{
						break;
					}
					$ln++;
				}
				fclose($handle);
				$this->cache["themes"][$key] = $name;
			}
		}
		arsort($this->cache["themes"]);
		return $this->cache["themes"];
	}

	/**
	 * Редактирование поля "Шаблон модуля"
	 * @return void
	 */
	public function edit_variable_view()
	{
		$view = $this->diafan->values("view");
		// значения для нового элемента передаются от родителя
		if($this->diafan->is_new && $this->diafan->config('parent') && $this->diafan->_route->parent)
		{
			if(! isset($this->cache["parent_row"]))
			{
				$this->cache["parent_row"] = DB::query_fetch_array("SELECT * FROM {".$this->diafan->table."} WHERE id=%d LIMIT 1", $this->diafan->_route->parent);
			}
			if(! empty($this->cache["parent_row"]["view"]))
			{
				$view = $this->cache["parent_row"]["view"];
			}
		}
		$views = $this->diafan->get_views($this->diafan->_admin->module);

		echo '<tr id="view">
			<td class="td_first">
				'.$this->diafan->variable_name().'
			</td>
			<td>';
			$default = $this->diafan->config('category') ? 'list' : 'id';
			echo '
				<select name="view" style="width:250px">
					<option value="">'.(! empty($views[$default]) ? $views[$default] : $this->diafan->_admin->module.'.view.'.$default.'.php').'</option>';
			foreach ($views as $key => $value)
			{
				if ($key == $default)
				{
					continue;
				}
				echo '<option value="'.$key.'"'.($view == $key ? ' selected' : '' ).'>'.$value.'</option>';
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
		$view_element = $this->diafan->values("view_element");
		// значения для нового элемента передаются от родителя
		if($this->diafan->is_new && $this->diafan->config('parent') && $this->diafan->_route->parent)
		{
			if(! isset($this->cache["parent_row"]))
			{
				$this->cache["parent_row"] = DB::query_fetch_array("SELECT * FROM {".$this->diafan->table."} WHERE id=%d LIMIT 1", $this->diafan->_route->parent);
			}
			if(! empty($this->cache["parent_row"]["view_element"]))
			{
				$view_element = $this->cache["parent_row"]["view_element"];
			}
		}
		$views = $this->diafan->get_views($this->diafan->_admin->module);

		echo '<tr id="view">
			<td class="td_first">
				'.$this->diafan->variable_name().'
			</td>
			<td>';
			echo '
				<select name="view_element" style="width:250px">
					<option value="">'.(! empty($views['id']) ? $views['id'] : $this->diafan->_admin->module.'.view.id.php').'</option>';
			foreach ($views as $key => $value)
			{
				if ($key == 'id')
				{
					continue;
				}
				echo '<option value="'.$key.'"'.($view_element == $key ? ' selected' : '' ).'>'.$value.'</option>';
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
		$rows = Custom::read_dir("modules/".$module."/views");
		foreach($rows as $file)
		{
			if (preg_match('!\.php$!', $file)
				&& is_file(ABSOLUTE_PATH.Custom::path("modules/".$module."/views/".$file)))
			{
				if (! preg_match('/'.$module.'\.view\.([^\.]+)\.php/', $file, $match))
				{
					continue;
				}
				$key = $match[1];
				$name = $file;
				$handle = fopen(ABSOLUTE_PATH.Custom::path("modules/".$module."/views/".$file), "r");
				$start = false;
				while (($data = fgets($handle)) !== false)
				{
					if(strpos($data, '/**') !== false)
					{
						$start = true;
						continue;
					}
					if($start && preg_match('/\*\s(.+)$/', $data, $m))
					{
						$name = $this->diafan->_($m[1])." [$file]";
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
		return $this->cache["views"][$module];
	}

	/**
	 * Редактирование поля "Редактор"
	 * @return void
	 */
	public function edit_variable_admin_id()
	{
		if($this->diafan->is_new)
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
		echo '
		<tr id="user_id" valign="top">
			<td align="right">'.$this->diafan->variable_name().'</td>
			<td>'
			.(! $this->diafan->value
			  ? $this->diafan->_('Гость')
			  : '<a href="'.BASE_PATH_HREF.'users/edit'.$this->diafan->value.'/">'.DB::query_result("SELECT CONCAT(fio, ' (', name, ')') FROM {users} WHERE id=%d LIMIT 1", $this->diafan->value).'</a>'
			);
		if(! $this->diafan->variable('user_id', 'disabled'))
		{
			echo ' <a href="javascript:void(0)" class="user_id_edit"><img src="'.BASE_PATH.'adm/img/edit.gif" width="12" height="14" alt="'.$this->diafan->_('Редактировать').'"></a>
			<div style="display:none">';
			echo '<br>'.$this->diafan->_('Изменить пользователя').': <input type="text" name="user_search" value="" size="30">
			<input type="hidden" name="user_id" value="'.$this->diafan->value.'"></div>';
		}
			echo $this->diafan->help().'
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
				.($this->diafan->values("date_start") ? date("d.m.Y".$time, $this->diafan->values("date_start")) : '')
				.'" class="timecalendar" showTime="'.($this->diafan->variable() == 'date' ? 'false' : 'true').'">
				-
				<input type="text" name="date_finish" size="20" value="'
				.($this->diafan->values("date_finish") ? date("d.m.Y".$time, $this->diafan->values("date_finish")) : '')
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

		if (! $this->diafan->is_new)
		{
			$rows_el = DB::query_fetch_all("SELECT value".($multilang ? $this->diafan->_languages->site." as rv, [value]" : "")
			.", param_id FROM {".$this->diafan->table."_param_element} WHERE element_id=%d", $this->diafan->id);
			foreach ($rows_el as $row_el)
			{
				$values[$row_el["param_id"]][]  = $row_el["value"];
				if($multilang)
				{
					$rvalues[$row_el["param_id"]][] = $row_el["rv"];
				}
			}
		}

		// значения списков
		$options = DB::query_fetch_key_array("SELECT [name], id, param_id FROM {".$this->diafan->table."_param_select} ORDER BY sort ASC", "param_id");

		$rows = DB::query_fetch_all("SELECT p.id, p.[name], p.type, p.[text], p.config FROM {".$this->diafan->table."_param} as p "
		    ." WHERE p.trash='0'".$where." ORDER BY p.sort ASC");
		foreach ($rows as $row)
		{
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

				case 'phone':
					if($multilang)
					{
						$value = (! empty($rvalues[$row["id"]]) ? $rvalues[$row["id"]][0] : '');
					}
					else
					{
						$value = (! empty($values[$row["id"]]) ? $values[$row["id"]][0] : '');
					}
					$this->diafan->show_table_tr_phone("param".$row["id"], $row["name"], $value, $help);
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
					$opts = array(array('name' => $this->diafan->_('Нет'), 'id' => ''));
					if(! empty($options[$row["id"]]))
					{
						$opts = array_merge($opts, $options[$row["id"]]);
					}
					if($multilang)
					{
						$value = (! empty($rvalues[$row["id"]]) ? $rvalues[$row["id"]][0] : 0);
					}
					else
					{
						$value = (! empty($values[$row["id"]]) ? $values[$row["id"]][0] : 0);
					}
					$this->diafan->show_table_tr_select_arr("param".$row["id"], $row["name"], $value, $help, false, $opts);
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
					$this->diafan->show_table_tr_multiple("param".$row["id"], $row["name"], $value, $help, false, (! empty($options[$row["id"]]) ? $options[$row["id"]] : array()));
					break;

				case 'attachments':
					Custom::inc('modules/attachments/admin/attachments.admin.inc.php');
					$attachments = new Attachments_admin_inc($this->diafan);
					$attachments->edit_param($row["id"], $row["name"], $row["text"], $row["config"]);
					break;

				case 'images':
					Custom::inc('modules/images/admin/images.admin.inc.php');
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
		if (! $this->diafan->is_new && in_array($this->diafan->values("type"), array('select', 'multiple', 'checkbox')))
		{
			$rows_select = DB::query_fetch_all("SELECT id, sort, value, "
			.($this->diafan->variable_multilang("name") ? "[name]" : "name")
			." FROM {".$this->diafan->table."_select}"
			." WHERE param_id=%d ORDER BY sort ASC", $this->diafan->id);
			foreach ($rows_select as $row_select)
			{
				if ($this->diafan->values("type") == 'checkbox')
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
		<tr id="param" valign="top">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
			<div class="param_table">
			<a href="javascript:void(0)" class="param_sort_name">'.$this->diafan->_('Сортировать по алфавиту').'</a>
			<table>';

		$fields = false;
		$param_textarea = '';
		if (in_array($this->diafan->values("type"), array('select', 'multiple')))
		{
			foreach ($value as $row)
			{
				echo '
				<tr class="param">
					<td>
						<input type="hidden" name="param_id[]" value="'.$row["id"].'">
						<input type="text" name="paramv[]" size="40" value="'.str_replace('"', '&quot;', $row["name"]).'">
						<span class="param_actions">
							<a href="javascript:void(0)" action="delete_param" confirm="'.$this->diafan->_('Вы действительно хотите удалить запись?').'"><img src="'.BASE_PATH.'adm/img/delete.png" width="13" height="13" alt="'.$this->diafan->_('Удалить').'"></a>
							<a href="javascript:void(0)" action="up_param"><img src="'.BASE_PATH.'adm/img/up.gif" width="14" height="16" alt="'.$this->diafan->_('Выше').'"></a>
							<a href="javascript:void(0)" action="down_param"><img src="'.BASE_PATH.'adm/img/down.gif" width="14" height="16" alt="'.$this->diafan->_('Ниже').'"></a>
						</span>
					</td>
				</tr>';
				$fields = true;
				$param_textarea .= str_replace(array('<', '>'), array('&lt;', '&gt;'), $row["name"])."\n" ;
			}
		}
		if (! $fields)
		{
			echo '
			<tr class="param">
				<td>
					<input type="hidden" name="param_id[]" value="">
					<input type="text" name="paramv[]" size="40" value="">
					<span class="param_actions">
						<a href="javascript:void(0)" action="delete_param" confirm="'.$this->diafan->_('Вы действительно хотите удалить запись?').'">
							<img src="'.BASE_PATH.'adm/img/delete.png" width="15" height="15" alt="'.$this->diafan->_('Удалить').'">
						</a>
						<a href="javascript:void(0)" action="up_param"><img src="'.BASE_PATH.'adm/img/up.gif" width="14" height="16" alt="'.$this->diafan->_('Выше').'"></a>
						<a href="javascript:void(0)" action="down_param"><img src="'.BASE_PATH.'adm/img/down.gif" width="14" height="16" alt="'.$this->diafan->_('Ниже').'"></a>
					</span>
				</td>
			</tr>';
		}
		echo '</table>
				<a href="javascript:void(0)" class="param_plus" title="'.$this->diafan->_('Добавить').'"><img src="'.BASE_PATH.'adm/img/add.png" width="16" height="16" alt="'.$this->diafan->_('Добавить').'"></a>
			</div>	
				<input type="checkbox" value="1" name="param_textarea_check" id="input_param_textarea_check"> <label for="input_param_textarea_check">'.$this->diafan->_('Быстрое редактирование').'</label>
				<div class="param_textarea">
				<textarea name="param_textarea" cols="49" rows="10">'.$param_textarea.'</textarea>
				</div>
			</td>
		</tr>
		<tr id="param_check">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				'.$this->diafan->_('да').' <input type="text" name="paramk_check1" size="20" value="'
				.(! empty($value[1]) && $this->diafan->values("type") == 'checkbox' ? str_replace('"', '&quot;', $value[1]) : '')
				.'">
				&nbsp;&nbsp;
				'.$this->diafan->_('нет').' <input type="text" name="paramk_check0" size="20" value="'
				.(! empty($value[0]) && $this->diafan->values("type") == 'checkbox' ? str_replace('"', '&quot;', $value[0]) : '').'">
			</td>
		</tr>';
		if($this->diafan->select_arr("type", "attachments"))
		{
			Custom::inc('modules/attachments/admin/attachments.admin.inc.php');
			$attachments = new Attachments_admin_inc($this->diafan);
			$attachments->edit_config_param($this->diafan->values("config"));
		}
		if($this->diafan->select_arr("type", "images"))
		{
			Custom::inc('modules/images/admin/images.admin.inc.php');
			$images = new Images_admin_inc($this->diafan);
			$images->edit_config_param($this->diafan->values("config"));
		}
	}

	/**
	 * Редактирование поля "Похожие элементы"
	 *
	 * @return void
	 */
	public function edit_variable_rel_elements()
	{
		$rel_two_sided = $this->diafan->configmodules("rel_two_sided", $this->diafan->_admin->module, (! empty($this->values["site_id"]) ? $this->values["site_id"] : $this->diafan->_route->site));

		$name = ! empty($this->diafan->text_for_base_link["variable"]) ? $this->diafan->text_for_base_link["variable"] : 'name';

		echo '
		<tr id="rel_elements" valign="top" rel_two_sided="'.($rel_two_sided ? 'true' : '').'">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				<div class="rel_elements">';
		if ( ! $this->diafan->is_new)
		{
			$rows = DB::query_fetch_all("SELECT s.id, s.[".$name."], s.site_id FROM {".$this->diafan->table."} AS s"
					." INNER JOIN {".$this->diafan->table."_rel} AS r ON s.id=r.rel_element_id AND r.element_id=%d"
					.($rel_two_sided ? " OR s.id=r.element_id AND r.rel_element_id=".$this->diafan->id : "")
					." WHERE s.trash='0' GROUP BY s.id",
					$this->diafan->id
				);
			foreach ($rows as $row)
			{
				$link = $this->diafan->_route->link($row["site_id"], $row["id"], $this->diafan->table);
				if($this->diafan->is_variable("images") || $this->diafan->is_variable("image"))
				{
					$row_img = DB::query_fetch_array("SELECT name, folder_num FROM {images} WHERE element_id=%d AND module_name='%s' AND element_type='element' AND trash='0' ORDER BY sort ASC LIMIT 1", $row["id"], $this->diafan->table);
				}
				echo '
				<div class="rel_element" element_id="'.$this->diafan->id.'" rel_id="'.$row["id"].'">
					<div class="rel_element_actions">
						<a href="javascript:void(0)" confirm="'.$this->diafan->_('Вы действительно хотите удалить запись?').'" action="delete_rel_element"><img src="'.BASE_PATH.'adm/img/delete.png" width="13" height="13" alt="'.$this->diafan->_('Удалить').'"></a>
						<a href="'.BASE_PATH.$link.'" target="_blank"><img src="'.BASE_PATH.'adm/img/view.png" width="21" height="13" alt="'.$this->diafan->_('Посмотреть на сайте').'"></a>
					</div>'
					.(! empty($row_img) ? '<img src="'.BASE_PATH.USERFILES.'/small/'.($row_img["folder_num"] ? $row_img["folder_num"].'/' : '').$row_img["name"].'"><br>' : '').$this->diafan->short_text($row[$name], 50)
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
		if ($this->diafan->is_new || ! $this->diafan->configmodules("counter"))
		{
			return;
		}
		$counter_view = DB::query_result("SELECT count_view FROM {%s_counter} WHERE element_id=%d LIMIT 1", $this->diafan->table, $this->diafan->id);
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
			<option value="monthly">monthly</option>
			<option value="always"'.($this->diafan->value == 'always' ? ' selected' : '').'>always</option>
			<option value="hourly"'.($this->diafan->value == 'hourly' ? ' selected' : '').'>hourly</option>
			<option value="daily"'.($this->diafan->value == 'daily' ? ' selected' : '').'>daily</option>
			<option value="weekly"'.($this->diafan->value == 'weekly' ? ' selected' : '').'>weekly</option>
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
					<input type="text" name="email" size="20" value="'.$this->diafan->values("email").'">
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

		$values = explode(',', $this->diafan->values("email_admin"));

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
			foreach ($values as $v)
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
		</tr>';
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
					<input type="number" name="shorttext_element" size="10" value="'.$this->diafan->values("shorttext_element").'"> '.$this->diafan->variable_name("shorttext_element").'
				</div>';
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
		$views = $this->diafan->get_views($this->diafan->_admin->module);

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
				<select name="theme_list" style="width:250px">
					<option value="">'.(! empty($themes['site.php']) ? $themes['site.php'] : 'site.php').'</option>';
		foreach ($themes as $key => $value)
		{
			if ($key == 'site.php')
				continue;
			echo '<option value="'.$key.'"'.( $this->diafan->values("theme_list") == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				<select name="view_list" style="width:250px">
					<option value="">'.(! empty($views['list']) ? $views['list'] : $this->diafan->_admin->module.'.view.list.php').'</option>';
		foreach ($views as $key => $value)
		{
			if ($key == 'list')
				continue;

			echo '<option value="'.$key.'"'.( $this->diafan->values("view_list") == $key ? ' selected' : '' ).'>'.$value.'</option>';
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
				<select name="theme_first_page" style="width:250px">
					<option value="">'.(! empty($themes['site.php']) ? $themes['site.php'] : 'site.php').'</option>';
		foreach ($themes as $key => $value)
		{
			if ($key == 'site.php')
				continue;
			echo '<option value="'.$key.'"'.( $this->diafan->values("theme_first_page") == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				<select name="view_first_page" style="width:250px">
					<option value="">'.(! empty($views['first_page']) ? $views['first_page'] : $this->diafan->_admin->module.'.view.first_page.php').'</option>';
		foreach ($views as $key => $value)
		{
			if ($key == 'first_page')
			{
				continue;
			}
			echo '<option value="'.$key.'"'.( $this->diafan->values("view_first_page") == $key ? ' selected' : '' ).'>'.$value.'</option>';
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
				<select name="theme_id" style="width:250px">
					<option value="">'.(! empty($themes['site.php']) ? $themes['site.php'] : 'site.php').'</option>';
		foreach ($themes as $key => $value)
		{
			if ($key == 'site.php')
				continue;
			echo '<option value="'.$key.'"'.( $this->diafan->values("theme_id") == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				<select name="view_id" style="width:250px">
					<option value="">'.(! empty($views['id']) ? $views['id'] : $this->diafan->_admin->module.'.view.id.php').'</option>';
		foreach ($views as $key => $value)
		{
			if ($key == 'id')
			{
				continue;
			}
			echo '<option value="'.$key.'"'.( $this->diafan->values("view_id") == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				'.$this->diafan->help("theme_id").'
			</td>
		</tr>';
	}
}
