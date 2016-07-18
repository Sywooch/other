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
 * Edit_admin
 *
 * Редактирование элемента
 */
class Edit_admin extends Theme_admin
{
	/**
	 * @var Edit_functions_admin функции редактирования полей
	 */
	public $_functions;

	/**
	 * @var array зависимости между полями
	 */
	public $show_tr_click_checkbox;

	/**
	 * @var array варианты значений переменной с типом список, которые берутся из таблицы
	 */
	public $select = array ();

	/**
	 * @var array варианты значений переменной с типом список
	 */
	public $select_arr = array ();

	/**
	 * @var array значения полей
	 */
	public $values = array ();

	/**
	 * @var integer счетчик
	 */
	public $k = 0;

	/**
	 * @var string название текущего поля
	 */
	public $key;

	/**
	 * @var mixed значение текущего поля
	 */
	public $value;

	/**
	 * @var array названия табов
	 */
	public $tabs_name;

	/**
	 * Вызывает функции редактирования полей
	 *
	 * @return mixed
	 */
	public function __call($name, $arguments)
	{
		if(! $this->_functions)
		{
			Custom::inc("adm/includes/edit_functions.php");
			$this->_functions = new Edit_functions_admin($this->diafan);
		}
		if (is_callable(array(&$this->_functions, $name)))
		{
			return call_user_func_array(array(&$this->_functions, $name), $arguments);
		}
		else
		{
			return 'fail_function';
		}
	}

	/**
	 * Генерирует форму редактирования/добавления элемента
	 *
	 * @return void
	 */
	public function edit()
	{
		//проверка прав на просмотр
		if (! $this->diafan->_users->roles('init', $this->diafan->_admin->rewrite))
		{
			include_once ABSOLUTE_PATH.'includes/404.php';
		}
		if($this->diafan->_route->addnew)
		{
			$this->diafan->is_new = true;
			$this->diafan->id = 0;
		}
		else
		{
			$this->diafan->id = $this->diafan->_route->edit;
		}

		$this->prepare_values();

		// Если отмечена галочка "Видеть только свои материалы", то редактирование чужих материалов запрещено
		if($this->diafan->config("only_self")
		   && $this->diafan->values("admin_id")
		   && $this->diafan->values("admin_id") != $this->diafan->_users->id
		   && DB::query_result("SELECT only_self FROM {users_role} WHERE id=%d LIMIT 1", $this->diafan->_users->role_id))
		{
			include_once ABSOLUTE_PATH.'includes/404.php';
		}

		echo '<form METHOD="POST" action="'.URL.$this->diafan->get_nav.'" enctype="multipart/form-data" id="save">
		<input type="hidden" name="check_hash_user" value="'.$this->diafan->_users->get_hash().'">
		<input type="hidden" name="id" value="'.(! $this->diafan->is_new ? $this->diafan->id : '' ).'">';
		if($this->diafan->is_new)
		{
			echo '<input type="hidden" name="is_new" value="true">';
		}
		if($this->diafan->config('element_site'))
		{
			echo '<input type="hidden" name="site_id" value="'.$this->diafan->_route->site.'">';
		}
		echo '<input type="hidden" name="action" value="save">';

		if ($this->diafan->config('tab_card'))
		{
			echo '<div id="tabs" index="'.$this->diafan->_admin->rewrite.'"><ul>';
			$i = 1;
			foreach ($this->diafan->variables as $title => $variable_table)
			{
				echo '<li><a href="#tabs-'.( $i++ ).'">';
				if(! empty($this->diafan->tabs_name[$title]))
				{
					echo $this->diafan->_($this->diafan->tabs_name[$title]);
				}
				else
				{
					echo $title;
				}
				echo '</a></li>';
			}
			echo '</ul>';
			$i = 1;
			foreach ($this->diafan->variables as $title => $variable_table)
			{
				echo '<div id="tabs-'.( $i++ ).'">';
				$this->show_table($variable_table);
				echo '</div>';
			}

			echo '</div>';
		}
		else
		{
			foreach ($this->diafan->variables as $title => $variable_table)
			{
				$is_other = false;

				switch($title)
				{
					case 'other_rows':
						$title = '<a name="other" class="show_other_block" href="#other">'.$this->diafan->_('Дополнительные параметры').'</a><span class="other_img"></span>';
						$is_other = true;
						break;

					case 'main':
						if($this->diafan->is_new)
						{
							$title = $this->diafan->_('Добавить новый');
							break;
						}
						$title = $this->diafan->_('Редактировать');
						break;
					case 'config':
						$title = '';
						break;
					default:
						if(! empty($this->diafan->tabs_name[$title]))
						{
							$title = $this->diafan->_($this->diafan->tabs_name[$title]);
						}
						break;
				}

				if(!empty($variable_table))
				{
					echo '<div class="block_no_bg">'.( $title ? '<h2>'.$title.'</h2>' : '' );
					$this->diafan->show_table($variable_table, $is_other);
					echo '</div>';
				}
			}
		}

		echo '<div class="button_block">';

		if (! $this->diafan->is_new && $this->diafan->config("view"))
		{
			$link = $this->diafan->_route->link($this->diafan->values("site_id"), $this->diafan->id, $this->diafan->_admin->module, $this->diafan->element_type());

			echo '<p><a href="'.BASE_PATH._SHORTNAME.$link.'" target="_blank">'.$this->diafan->_('Посмотреть на сайте').'</a></p>';
		}
		if($this->diafan->_users->roles('edit', $this->diafan->_admin->rewrite))
		{
			if(! $this->diafan->config("only_edit"))
			{
				echo '
				<p><input name="redirect_edit" id="input_redirect_edit" type="checkbox" value="1"'.(! empty($_SESSION["redirect_edit"]) ? ' checked' : '').'> <label for="input_redirect_edit">'.$this->diafan->_('Продолжить редактирование').'</label></p>
				<p><input name="redirect_add" id="input_redirect_add" type="checkbox" value="1"'.(! empty($_SESSION["redirect_add"]) ? ' checked' : '').'>  <label for="input_redirect_add">'.$this->diafan->_('Добавить еще').'</label></p>';
			}
		}
		echo '<p>';
		if($this->diafan->_users->roles('edit', $this->diafan->_admin->rewrite))
		{
			echo '<input type="submit" value="'.$this->diafan->_('Сохранить').'">';
		}
		if(! $this->diafan->config("only_edit"))
		{
			echo '<input type="button" onClick="document.location=\''.URL.$this->diafan->get_nav.'\'" value="'.$this->diafan->_('Отмена').'">';
		}
		echo '</p>';

		echo '</div></form>';
	}

	/**
	 * Получает значения полей для формы (альтернативный метод)
	 *
	 * @return array
	 */
	public function get_values()
	{
		return array ();
	}

	/**
	 * Выводит таблицу с полями формы редактирвоания
	 *
	 * @param array $variable_table поля формы
	 * @param boolean $other это часть формы "Дополнительные параметры"
	 * @return void
	 */
	public function show_table($variable_table, $is_other = false)
	{
		echo '<table class="table_edit'.( $is_other ? ' other' : '' ).'">';

		foreach ($variable_table as $this->diafan->key => $row)
		{
			if(is_array($row))
			{
				$type = $row["type"];
			}
			else
			{
				$type = $row;
			}
			$this->k++;
			$key = $this->diafan->key.(! $this->diafan->config("config") && $this->diafan->variable_multilang($this->diafan->key) ? _LANG : '' );

			$this->diafan->value = $this->diafan->values($key);
			if($this->diafan->value === false)
			{
				$this->diafan->value = '';
			}

			$func = 'edit'.( $this->diafan->config("config") ? '_config' : '' ).'_variable_'.str_replace('-', '_', $this->diafan->key);
			if (call_user_func_array (array(&$this->diafan, $func), array()) === 'fail_function')
			{
				$this->diafan->show_table_tr(
						$type,
						$this->diafan->key,
						$this->diafan->value,
						$this->diafan->variable_name(),
						$this->diafan->help(),
						$this->diafan->variable_disabled(),
						$this->diafan->variable('', 'maxlength')
					);
			}
			else
			{
				$path = 'adm/js/edit/admin.edit.'.($this->diafan->config("config") ? 'config.' : '').str_replace('-', '_', $this->diafan->key).'.js';
				if(Custom::exists($path))
				{
					$this->diafan->_admin->js_view[] = Custom::path($path);
				}
			}
		}
		echo
		'</table>';
	}

	/**
	 * Выводит одну строку формы редактирования
	 *
	 * @param string $type тип поля
	 * @param string $key название поля
	 * @param string $value значение поля
	 * @param string $name описание поля
	 * @param string $help часть кода, вываодящая подсказку к полю
	 * @param boolean $disabled поле не редактируется
	 * @param string $maxlength максимальное количество символов
	 * @return void
	 */
	public function show_table_tr($type, $key, $value, $name, $help, $disabled, $maxlength)
	{
		switch($type)
		{
			case 'module':
				if (in_array($key, $this->diafan->installed_modules)
					&& Custom::exists('modules/'.$key.'/admin/'.$key.'.admin.inc.php'))
				{
					Custom::inc('modules/'.$key.'/admin/'.$key.'.admin.inc.php');
					$func = 'edit'.( $this->diafan->config("config") ? '_config' : '' );
					$class = ucfirst($key).'_admin_inc';
					if (method_exists($class, $func))
					{
						$module_class = new $class($this->diafan);
						call_user_func_array (array(&$module_class, $func), array());
					}
					$path = 'modules/'.$key.'/admin/js/'.$key.'.admin.inc'.($this->diafan->config("config") ? '.config' : '').'.js';
					if(Custom::exists($path))
					{
						$this->diafan->_admin->js_view[] = Custom::path($path);
					}
				}
				break;

			case 'title':
				$this->diafan->show_table_tr_title($key, $name, $help);
				break;

			case 'password':
				$this->diafan->show_table_tr_password($key, $name, $value, $help);
				break;

			case 'text':
				$this->diafan->show_table_tr_text($key, $name, $value, $help, $disabled, '', $maxlength);
				break;

			case 'email':
				$this->diafan->show_table_tr_email($key, $name, $value, $help, $disabled);
				break;

			case 'phone':
				$this->diafan->show_table_tr_phone($key, $name, $value, $help, $disabled);
				break;

			case 'date':
				$this->diafan->show_table_tr_date($key, $name, $value, $help, $disabled);
				break;

			case 'datetime':
				$this->diafan->show_table_tr_datetime($key, $name, $value, $help, $disabled);
				break;

			case 'numtext':
				$this->diafan->show_table_tr_numtext($key, $name, $value, $help, $disabled);
				break;

			case 'floattext':
				$this->diafan->show_table_tr_floattext($key, $name, $value, $help, $disabled);
				break;

			case 'textarea':
				$this->diafan->show_table_tr_textarea($key, $name, $value, $help, $disabled);
				break;

			case 'checkbox':
				$this->diafan->show_table_tr_checkbox($key, $name, $value, $help, $disabled);
				break;

			case 'select':
				if($this->diafan->select_arr($key))
				{
					$this->diafan->show_table_tr_select_arr($key, $name, $value, $help, $disabled, $this->diafan->select_arr($key));
				}
				else
				{
					$this->diafan->show_table_tr_select($key, $name, $value, $help, $disabled);
				}
				break;

			case 'editor':
				$this->diafan->show_table_tr_editor($key, $name, $value, $help);
				break;

			case 'hr':
				$this->diafan->show_table_tr_hr($key, $name);
				break;
		}
		echo "\n";
	}

	/**
	 * Выводит одну строку формы редактирования с типом "Заголовок"
	 *
	 * @param string $key название поля
	 * @param string $name описание поля
	 * @param string $help часть кода, вываодящая подсказку к полю
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	public function show_table_tr_title($key, $name, $help, $attr = '')
	{
		echo '
		<tr id="'.$key.'"'.$attr.'>
			<td class="td_first"><b>'.$name.'</b> '.$help.'</td>
			<td></td>
		</tr>';
	}

	/**
	 * Выводит одну строку формы редактирования с типом "Пароль"
	 *
	 * @param string $key название поля
	 * @param string $name описание поля
	 * @param string $value значение поля
	 * @param string $help часть кода, вываодящая подсказку к полю
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	public function show_table_tr_password($key, $name, $value, $help, $attr = '')
	{
		echo '
		<tr id="'.$key.'"'.$attr.'>
			<td class="td_first">'.$name.'</td>
			<td>
				<input type="password" name="'.$key.'" size="40" value="'.$value.'">
				'.$help.'
			</td>
		</tr>';
	}

	/**
	 * Выводит одну строку формы редактирования с типом "Текст"
	 *
	 * @param string $key название поля
	 * @param string $name описание поля
	 * @param string $value значение поля
	 * @param string $help часть кода, вываодящая подсказку к полю
	 * @param boolean $disabled поле не редактируется
	 * @param string $attr атрибуты строки
	 * @param string $maxlength максимальное количество символов
	 * @return void
	 */
	public function show_table_tr_text($key, $name, $value, $help, $disabled = false, $attr = '',  $maxlength = 0)
	{
		echo '
		<tr id="'.$key.'"'.$attr.'>
			<td class="td_first">'.$name.'</td>
			<td>
				<input type="text" name="'.$key.'" size="40" value="'.( $value ? str_replace('"', '&quot;', $value) : '' ).'"'.($disabled ? ' disabled' : '').($maxlength ? ' maxlength="'.$maxlength.'"' : '').'>
				'.$help.'
			</td>
		</tr>';
	}

	/**
	 * Выводит одну строку формы редактирования с типом "E-mail"
	 *
	 * @param string $key название поля
	 * @param string $name описание поля
	 * @param string $value значение поля
	 * @param string $help часть кода, вываодящая подсказку к полю
	 * @param boolean $disabled поле не редактируется
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	public function show_table_tr_email($key, $name, $value, $help, $disabled = false, $attr = '')
	{
		echo '
		<tr id="'.$key.'"'.$attr.'>
			<td class="td_first">'.$name.'</td>
			<td>
				<input type="email" name="'.$key.'" size="40" value="'.( $value ? str_replace('"', '&quot;', $value) : '' ).'"'.($disabled ? ' disabled' : '').'>
				'.$help.'
			</td>
		</tr>';
	}

	/**
	 * Выводит одну строку формы редактирования с типом "Телефон"
	 *
	 * @param string $key название поля
	 * @param string $name описание поля
	 * @param string $value значение поля
	 * @param string $help часть кода, вываодящая подсказку к полю
	 * @param boolean $disabled поле не редактируется
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	public function show_table_tr_phone($key, $name, $value, $help, $disabled = false, $attr = '')
	{
		echo '
		<tr id="'.$key.'"'.$attr.'>
			<td class="td_first">'.$name.'</td>
			<td>
				<input type="tel" name="'.$key.'" size="40" value="'.( $value ? str_replace('"', '&quot;', $value) : '' ).'"'.($disabled ? ' disabled' : '').'>
				'.$help.'
			</td>
		</tr>';
	}

	/**
	 * Выводит одну строку формы редактирования с типом "Дата"
	 *
	 * @param string $key название поля
	 * @param string $name описание поля
	 * @param string $value значение поля
	 * @param string $help часть кода, вываодящая подсказку к полю
	 * @param boolean $disabled поле не редактируется
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	public function show_table_tr_date($key, $name, $value, $help, $disabled = false, $attr = '')
	{
		echo '
		<tr id="'.$key.'"'.$attr.'>
			<td class="td_first">'.$name.'</td>
			<td>
				<input type="text" id="filed_'.$key.'" name="'.$key.'" size="40" value="'.( $value ? date("d.m.Y", $value) : date("d.m.Y") ).'" class="timecalendar" showTime="false"'.($disabled ? ' disabled' : '').'>
				'.$help.'
			</td>
		</tr>';
	}

	/**
	 * Выводит одну строку формы редактирования с типом "Дата и время"
	 *
	 * @param string $key название поля
	 * @param string $name описание поля
	 * @param string $value значение поля
	 * @param string $help часть кода, вываодящая подсказку к полю
	 * @param boolean $disabled поле не редактируется
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	public function show_table_tr_datetime($key, $name, $value, $help, $disabled = false, $attr = '')
	{
		echo '
		<tr id="'.$key.'"'.$attr.'>
			<td class="td_first">'.$name.'</td>
			<td>
				<input type="text" id="filed_'.$key.'" name="'.$key.'" size="40" value="'.( $value ? date("d.m.Y H:i", $value) : date("d.m.Y H:i") ).'" class="timecalendar" showTime="true"'.($disabled ? ' disabled' : '').'>
				'.$help.'
			</td>
		</tr>';
	}

	/**
	 * Выводит одну строку формы редактирования с типом "Число"
	 *
	 * @param string $key название поля
	 * @param string $name описание поля
	 * @param string $value значение поля
	 * @param string $help часть кода, вываодящая подсказку к полю
	 * @param boolean $disabled поле не редактируется
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	public function show_table_tr_numtext($key, $name, $value, $help, $disabled = false, $attr = '')
	{
		echo '
		<tr id="'.$key.'"'.$attr.'>
			<td class="td_first">'.$name.'</td>
			<td>
				<input type="number" name="'.$key.'" size="20" value="'.$value.'"'.($disabled ? ' disabled' : '').'>'.$help.'
			</td>
		</tr>';
	}

	/**
	 * Выводит одну строку формы редактирования с типом "Число с плавающей точкой"
	 *
	 * @param string $key название поля
	 * @param string $name описание поля
	 * @param string $value значение поля
	 * @param string $help часть кода, вываодящая подсказку к полю
	 * @param boolean $disabled поле не редактируется
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	public function show_table_tr_floattext($key, $name, $value, $help, $disabled = false, $attr = '')
	{
		if(($value * 10) % 10)
		{
			$num_decimal_places = 2;
		}
		else
		{
			$num_decimal_places = 0;
		}
		echo '
		<tr id="'.$key.'"'.$attr.'>
			<td class="td_first">'.$name.'</td>
			<td>
				<input type="text" name="'.$key.'" size="20" value="'.( $value ? number_format($value, $num_decimal_places, ',', '') : '' ).'" '.($disabled ? ' disabled' : '').' pattern="[0-9]+([\.|,][0-9]+)?">
				'.$help.'
			</td>
		</tr>';
	}

	/**
	 * Выводит одну строку формы редактирования с типом "Текстова область"
	 *
	 * @param string $key название поля
	 * @param string $name описание поля
	 * @param string $value значение поля
	 * @param string $help часть кода, вываодящая подсказку к полю
	 * @param boolean $disabled поле не редактируется
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	public function show_table_tr_textarea($key, $name, $value, $help, $disabled = false, $attr = '')
	{
		echo '
		<tr id="'.$key.'"'.$attr.'>
			<td class="td_first">'.$name.'</td>
			<td>
				<textarea name="'.$key.'" cols="49" rows="5"'.($disabled ? ' disabled' : '').'>'.( $value ? str_replace(array ('<', '>', '"'), array('&lt;', '&gt;', '&quot;'), $value) : '' ).'</textarea>'.$help.'
			</td>
		</tr>';
	}

	/**
	 * Выводит одну строку формы редактирования с типом "Галка"
	 *
	 * @param string $key название поля
	 * @param string $name описание поля
	 * @param string $value значение поля
	 * @param string $help часть кода, вываодящая подсказку к полю
	 * @param boolean $disabled поле не редактируется
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	public function show_table_tr_checkbox($key, $name, $value, $help, $disabled = false, $attr = '')
	{
		echo '
		<tr id="'.$key.'"'.$attr.'>
			<td class="td_first"><label for="input_'.$key.'">'.$name.'</label></td>
			<td>
				<input type="checkbox" id="input_'.$key.'" name="'.$key.'" value="1"'.( $value ? " checked" : '' ).$this->diafan->show_tr_click_checkbox($key).($disabled ? ' disabled' : '').'>
				'.$help.'
			</td>
		</tr>';
	}

	/**
	 * Выводит одну строку формы редактирования с типом "Список"
	 *
	 * @param string $key название поля
	 * @param string $name описание поля
	 * @param string $value значение поля
	 * @param string $help часть кода, вываодящая подсказку к полю
	 * @param boolean $disabled поле не редактируется
	 * @param array $options значения списка
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	public function show_table_tr_select($key, $name, $value, $help, $disabled = false, $attr = '')
	{
		if (! empty($this->diafan->select[$key]))
		{
			echo '
			<tr id="'.$key.'"'.$attr.'>
				<td class="td_first">'.$name.'</td>
				<td>
					<select name="'.$key.'"'.($disabled ? ' disabled' : '').'>';
			if(! empty( $this->diafan->select[$key][4]))
			{
				echo '<option value="">'.$this->diafan->_($this->diafan->select[$key][4]).'</option>';
			}
			echo $this->diafan->select_option(
				$key,
				(! empty($this->diafan->select[$key][0]) ? $this->diafan->select[$key][0] : ''),
				(! empty($this->diafan->select[$key][1]) ? $this->diafan->select[$key][1] : ''),
				(! empty($this->diafan->select[$key][2]) ? $this->diafan->select[$key][2] : ''),
				($value ? $value : (! empty($this->diafan->select[$key][3]) ? $this->diafan->select[$this->key][3] : '') ),
				(! empty($this->diafan->select[$key][5]) ? $this->diafan->select[$key][5] : ''),
				(! empty($this->diafan->select[$key][6]) ? $this->diafan->select[$key][6] : ''),
				0,
				'',
				(! empty($this->diafan->select[$key][7]) ? $this->diafan->select[$key][7] : 'id ASC')
				);
			echo '</select>
					'.$help.'
				</td>
			</tr>';
		}
	}

	/**
	 * Выводит одну строку формы редактирования с типом "Список из массива"
	 *
	 * @param string $key название поля
	 * @param string $name описание поля
	 * @param string $value значение поля
	 * @param string $help часть кода, вываодящая подсказку к полю
	 * @param boolean $disabled поле не редактируется
	 * @param array $options значения списка
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	public function show_table_tr_select_arr($key, $name, $value, $help, $disabled = false, $options = array(), $attr = '')
	{
		if ($options)
		{
			echo '
			<tr id="'.$key.'"'.$attr.'>
				<td class="td_first">'.$name.'</td>
				<td>
					<select name="'.$key.'"'.($disabled ? ' disabled' : '').'>';
					foreach ($options as $k => $select)
					{
						if(is_array($select))
						{
							$k = $select["id"];
							$select = $select["name"];
						}
						echo '<option value="'.$k.'"'.($value == $k ? ' selected' : '').'>'.$this->diafan->_($select).'</option>';
					}
					echo '</select>
					'.$help.'
				</td>
			</tr>';
		}
	}

	/**
	 * Выводит одну строку формы редактирования с типом "Список с выбором нескольких значений"
	 *
	 * @param string $key название поля
	 * @param string $name описание поля
	 * @param string $value значение поля
	 * @param string $help часть кода, вываодящая подсказку к полю
	 * @param boolean $disabled поле не редактируется
	 * @param array $options значения списка
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	public function show_table_tr_multiple($key, $name, $values, $help, $disabled = false, $options = array(), $attr = '')
	{
		foreach ($values as &$val)
		{
			if(! $val)
			{
				unset($val);
			}
		}
		echo '
		<tr id="'.$key.'"'.$attr.'>
			<td class="td_first">'.$name.'</td>
			<td>
				<select name="'.$key.'[]" size="11" multiple="multiple"'.($disabled ? ' disabled' : '').'>
				<option value="all"'.(empty($values) ? ' selected' : '').'>'.$this->diafan->_('Нет').'</option>';
				foreach ($options as $k => $select)
				{
					if(is_array($select))
					{
						$k = $select["id"];
						$select = $select["name"];
					}
					echo '<option value="'.$k.'"'.(in_array($k, $values) ? ' selected' : '').'>'.$this->diafan->_($select).'</option>';
				}
				echo '</select>
				'.$help.'
			</td>
		</tr>';
	}

	/**
	 * Выводит одну строку формы редактирования с типом "Редактор"
	 *
	 * @param string $key название поля
	 * @param string $name описание поля
	 * @param string $value значение поля
	 * @param string $help часть кода, вываодящая подсказку к полю
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	public function show_table_tr_editor($key, $name, $value, $help, $attr = '')
	{
		$value = $this->diafan->_route->replace_id_to_link($value);
		$height = $this->diafan->variable($key, 'height');
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
			$hide_htmleditor = in_array($key, explode(",", $this->diafan->configmodules("hide_".$this->diafan->table."_".$this->diafan->id, "htmleditor")));
		}
		echo '
		<tr id="'.$key.'"'.$attr.'>
			<td colspan="2">
			<div style="position:relative;height:2em;">';
			if($this->diafan->_users->htmleditor)
			{
				echo '<div style="position:absolute;top:0;right: 50%;"><input type="checkbox" class="htmleditor_check" name="'.$key.'_htmleditor" id="input_'.$key.'_htmleditor" value="1"'.($hide_htmleditor ? ' checked' : '').' rel="htmleditor_'.$key.'"> <label for="input_'.$key.'_htmleditor">'.$this->diafan->_('HTML-код').'</label></div>';
			}
			if($name)
			{
				echo '<div style="position:absolute;top:5px;left:0">'.$name.$help.'</div>';
			}
			echo '<div style="position:absolute;top:0;right:0"><input type="checkbox" name="'.$key.'_typograf" id="input_'.$key.'_typograf" value="1"> <label for="input_'.$key.'_typograf">'.$this->diafan->_('Применить <a href="http://www.artlebedev.ru/tools/typograf/about/" target="_blank">типограф</a>')
			.'</label></div>';
			echo '</div>';
			echo '<textarea name="'.$key.'" id="htmleditor_'.$key.'" style="width:100%; height:'.$height.'px"';
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
			echo '>'.( $value ? str_replace(array ( '<', '>', '"' ), array ( '&lt;', '&gt;', '&quot;' ), str_replace('&', '&amp;', $value)) : '' ).'</textarea>
			</td>
		</tr>';
	}

	/**
	 * Выводит одну строку формы редактирования с типом "Горизонтальная линия"
	 *
	 * @param string $key название поля
	 * @param string $name описание поля
	 * @param string $attr атрибуты строки
	 * @return void
	 */
	public function show_table_tr_hr($key, $name, $attr = '')
	{
		echo '
		<tr id="'.$key.'"'.$attr.'>
			<td colspan="2">
				<hr>
			</td>
		</tr>';
	}

	/**
	 * Определяет подсказки для полей
	 *
	 * @param string $key название текущего поля или текст подсказки
	 * @return string
	 */
	public function help($key = '')
	{
		if (! $key)
		{
			$key = $this->diafan->key;
		}
		if(! $this->diafan->is_variable($key))
		{
			$help = $key;
			$key = rand(0, 3333);
		}
		elseif (! $help = $this->diafan->variable($key, 'help'))
		{
			return '';
		}

		return '<span class="help_img"><img src="'.BASE_PATH.'adm/img/quest.gif" title="'.str_replace('"', '&quot;', $this->diafan->_($help)).'"></span>';
	}

	/**
	 * Возвращает или назначает связанные поля
	 *
	 * @param string $key название текущего поля
	 * @param string|array $value связанные поля, назначает если задано
	 * @return mixed
	 */
	public function show_tr_click_checkbox($key = '', $value = '')
	{
		$show_tr_click_checkbox = $this->diafan->show_tr_click_checkbox;
		if (! $key)
		{
			$key = $this->diafan->key;
		}
		if($value)
		{
			if(is_array($value))
			{
				foreach ($value as $v)
				{
					if(empty($show_tr_click_checkbox[$key]) || ! in_array($v, $show_tr_click_checkbox[$key]))
					{
						$show_tr_click_checkbox[$key][] = $v;
					}
				}
			}
			else
			{
				if(empty($show_tr_click_checkbox[$key]) || ! in_array($value, $show_tr_click_checkbox[$key]))
				{
					$show_tr_click_checkbox[$key][] = $value;
				}
			}
			$this->diafan->show_tr_click_checkbox = $show_tr_click_checkbox;
		}
		else
		{
			return ( ! empty( $show_tr_click_checkbox[$key] )
					? ' class="show_tr_click_checkbox" rel="#'
					. ( is_array($show_tr_click_checkbox[$key]) ? implode(",#", $show_tr_click_checkbox[$key]) : $show_tr_click_checkbox[$key] )
					. '"' : '' );
		}
	}

	/**
	 * Получает значение поля
	 * @param string $field название поля
	 * @param mixed $default значение по умолчанию
	 * @param boolean $save записать значение по умолчанию
	 * @return mixed
	 */
	public function values($field, $default = false, $save = false)
	{
		if(! isset($this->cache["oldrow"]))
		{
			$values = $this->diafan->get_values();
	
			if ($this->diafan->config("config"))
			{
				foreach ($this->diafan->variables as $title => $variable_table)
				{
					foreach ($variable_table as $k => $v)
					{
						if ( empty($values[$k]))
						{
							$values[$k] = $this->diafan->configmodules($k);
						}
					}
				}
			}
			elseif($this->diafan->is_new)
			{
				foreach ($this->diafan->variables as $title => $variable_table)
				{
					foreach ($variable_table as $k => $v)
					{
						if ( ! empty($this->diafan->get_nav_params[$k]))
						{
							$values[$k] = $this->diafan->get_nav_params[$k.(! empty($v["multilang"]) ? _LANG : '')];
						}
						elseif(! empty($v["default"]))
						{
							$values[$k._LANG] = $v["default"];
						}
					}
				}
			}
			elseif (! $values)
			{
				$values = DB::query_fetch_array("SELECT * FROM {".$this->diafan->table."} WHERE id=%d"
					.($this->diafan->config("trash") ? " AND trash='0'" : '' )." LIMIT 1",
					$this->diafan->id
				);
				if (empty($values))
				{
					ob_end_clean();
					include_once ABSOLUTE_PATH.'includes/404.php';
				}
			}
			$this->cache["oldrow"] = $values;
		}

		$field .= ($this->diafan->variable_multilang($field) && ! $this->diafan->config("config") ? _LANG : '');

		if(! isset($this->cache["oldrow"][$field]))
		{
			switch($field)
			{
				case 'parent_id':
					if ($this->diafan->is_new)
					{
						$this->cache["oldrow"]["parent_id"] = $this->diafan->_route->parent;
					}
					break;
	
				case 'cat_id':
					if ($this->diafan->is_new)
					{
						$this->cache["oldrow"]["cat_id"] = $this->diafan->_route->cat;
					}
					break;
	
				case 'site_id':
					if($this->diafan->table == 'site')
					{
						$this->cache["oldrow"]["site_id"] = $this->diafan->id;
					}
					else
					{
						if(empty($this->cache["oldrow"]["site_id"]))
						{
							$this->cache["oldrow"]["site_id"] = $this->diafan->_route->site;
						}
						if(empty($this->cache["oldrow"]["site_id"]))
						{
							$this->cache["oldrow"]["site_id"] = DB::query_result("SELECT id FROM {site} WHERE module_name='%s' AND trash='0'", $this->diafan->_admin->module);
						}
					}
					break;
			}
		}
		if(! isset($this->cache["oldrow"][$field]))
		{
			if(! $default)
			{
				$default = $this->diafan->variable($field, 'default');
			}
			if($default)
			{
				if($save)
				{
					$this->cache["oldrow"][$field] = $default;
				}
				else
				{
					return $default;
				}
			}
			elseif ($this->diafan->config("config"))
			{
				$this->cache["oldrow"][$field] = $this->diafan->configmodules($field);
			}
		}
		if(isset($this->cache["oldrow"][$field]))
		{
			return $this->cache["oldrow"][$field];
		}
		else
		{
			return false;
		}
		return $this->cache["site_id"];
	}
}