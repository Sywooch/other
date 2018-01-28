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
 * Users_admin
 *
 * Редактирование администраторов сайта
 */
class Users_admin extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'users';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'fio' => array(
				'type' => 'text',
				'name' => 'ФИО',
				'help' => 'Свободное информационное поле',
			),
			'created' => array(
				'type' => 'date',
				'name' => 'Дата регистрации',
				'help' => 'В формате дд.мм.гггг, при регистрации устанавливается текущая',
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Активен',
				'help' => 'Если не отмечена, пользователь не имеет доступа к администрированию сайта',
				'default' => true,
			),
			'hr1' => 'hr',
			'name' => array(
				'type' => 'text',
				'name' => 'Логин',
				'help' => 'Имя пользователя для входа в систему администрирования. Только цифры и латинские буквы',
			),
			'password' => array(
				'type' => 'password',
				'name' => 'Пароль',
				'help' => 'Пароль для входа в систему администрирования. Только цифры и латинские буквы',
			),
			'mail' => array(
				'type' => 'email',
				'name' => 'Email',
				'help' => 'Почтовый адрес пользователя в формате mail@site.ru',
			),
			'hr2' => 'hr',
			'identity' => array(
				'type' => 'text',
				'name' => 'URL на страницу в соц. сети',
			),
			'role_id' => array(
				'type' => 'select',
				'name' => 'Тип пользователя',
				'help' => 'Тип прав пользователя. Уровень доступа настраивается в модуле "Права доступа"',
			),
			'lang_id' => array(
				'type' => 'select',
				'name' => 'Язык интерфейса',
			),
			'avatar' => array(
				'type' => 'function',
				'name' => 'Аватар',
			),
			'param' => array(
				'type' => 'function',
			),
			'hr3' => 'hr',
			'htmleditor' => array(
				'type' => 'checkbox',
				'name' => 'Использовать визуальный редактор',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'act', // показать/скрыть
		'trash', // использовать корзину
	);

	/**
	 * @var array списки из таблицы
	 */
	public $select = array(
		'role_id' => array(
			'users_role',
			'id',
			'nameLANG',
			'',
			'',
			"trash='0'",
		),
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array(
		'name' => 'function',
		'role_id' => 'function',
	);

	/**
	 * @var array текст для ссылки на редактирование в списке
	 */
	public $text_for_base_link = array(
		'variable' => 'fio'
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		if(count($this->diafan->languages) > 1)
		{
			foreach ($this->diafan->languages as $language)
			{
				$this->diafan->select_arr("lang_id", $language["id"], $language["name"]);
			}
		}
		else
		{
			$this->diafan->variable_unset("lang_id");
		}
		if (! $this->diafan->addnew && $this->diafan->edit == $this->diafan->_user->id
			|| ! $this->diafan->savenew && $this->diafan->save == $this->diafan->_user->id)
		{
			$this->diafan->variable_unset('role_id');
			$this->diafan->variable_unset('act');
		}
	}

	/**
	 * Выводит список пользователей
	 * @return void
	 */
	public function show()
	{
        if($this->diafan->error == 2)
        {
            echo '<div class="error">'.$this->diafan->_('Извините, пользователь с таким логином уже существует.').'</div>';
        }

		$this->diafan->addnew_init('Добавить пользователя');
		
		$this->diafan->list_row();
	}

	/**
	 * Выводит статус пользователя (на сайте) в списке
	 * 
	 * @return string
	 */
	public function other_row_name($row)
	{
		return '<td class="nick">'.$row["name"]
		.($this->diafan->_user->id == $row["id"]
		  || DB::query_result("SELECT user_id FROM {sessions} WHERE timestamp>=%d AND user_id=%d LIMIT 1", (time() - 900), $row["id"])
		 ? ' <font style="color: #ffffff; background-color: red;">'.$this->diafan->_('на сайте').'</font>'
		 : ''
		 );
	}

	/**
	 * Выводит тип пользователя в списке
	 * 
	 * @return string
	 */
	public function other_row_role_id($row)
	{
		global $roles;
		if (! $roles)
		{
			$roles[0] = '';
			$result = DB::query("SELECT [name], id FROM {users_role}");
			while ($role = DB::fetch_array($result))
			{
				$roles[$role["id"]] = $role["name"];
			}
		}
		return '</td><td class="role_id">'.(! empty($roles[$row["role_id"]]) ? $roles[$row["role_id"]] : '');
	}

	/**
	 * Проверяет можно ли удалить текущий элемент строки
	 *
	 * @param array $row информация о текущем элменте списка
	 * @return boolean
	 */
	public function check_delete($row)
	{
		// пользователь не может удалить самого себя
		if($this->diafan->_user->id == $row["id"])
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	/**
	 * Определяет строку с GET переменными
	 *
	 * @return void
	 */
	public function set_get_nav()
	{
		$get_nav_params = $this->diafan->get_nav_params;
		$get_nav_params["search_fio"] = '';

		if (!empty( $_GET["search_fio"] ))
		{
			$get_nav_params["search_fio"] = $this->diafan->get_param($_GET, "search_fio", '', 1);
			$this->diafan->get_nav .= ( $this->diafan->get_nav ? '&amp;' : '?' ) . 'search_fio=' . $get_nav_params["search_fio"];
			$this->diafan->where .= " AND fio LIKE '%%" . str_replace(array("'", "%"), array("\\'", "%%"), $get_nav_params["search_fio"]) . "%%'";
		}
		$get_nav_params["role_id"] = '';

		if (!empty( $_GET["role_id"] ))
		{
			$get_nav_params["role_id"] = $this->diafan->get_param($_GET, "role_id", 0, 2);
			$this->diafan->get_nav .= ( $this->diafan->get_nav ? '&amp;' : '?' ) . 'role_id=' . $get_nav_params["role_id"];
			$this->diafan->where .= " AND role_id='".$get_nav_params["role_id"]."'";
		}
		$this->diafan->get_nav_params = $get_nav_params;
	}

	/**
	 * Поиск
	 *
	 * @return string
	 */
	public function show_search()
	{
		if($this->diafan->edit)
			return '';

		global $roles;
		if (! $roles)
		{
			$roles[0] = '';
			$result = DB::query("SELECT [name], id FROM {users_role}");
			while ($role = DB::fetch_array($result))
			{
				$roles[$role["id"]] = $role["name"];
			}
		}

		$html = '
		<form action="' . BASE_PATH_HREF . $this->diafan->rewrite . '/' . ( $this->diafan->cat ? 'cat' . $this->diafan->cat . '/' : '' ) . '" method="GET">
		' . $this->diafan->_('ФИО') . ': <input type="text" name="search_fio" value="' . $this->diafan->get_nav_params["search_fio"] . '" size="20">
		'.$this->diafan->_('Права доступа').': <select name="role_id">';
		foreach($roles as $id => $role)
		{
			$html .= '<option value="'.$id.'"'.($this->diafan->get_nav_params["role_id"] == $id ? ' selected' : '').'>'.($id ? $role : $this->diafan->_('все')).'</option>';
		}
		$html .= '</select>
		<input type="submit" class="button" value="' . $this->diafan->_('Поиск') . '">
		</form>';

		return $html;
	}
	
	/**
	 * Редактирование поля "Аватар"
	 * @return void
	 */
	public function edit_variable_avatar()
	{
		if (! $this->diafan->configmodules("avatar", "users"))
			return;

		echo '
		<tr valign="top">
			<td align="right">
				'.$this->diafan->variable_name().'
			</td>
			<td>';
		if (! empty($this->diafan->values["name"]) && file_exists(ABSOLUTE_PATH.USERFILES.'/avatar/'.$this->diafan->values["name"].'.png'))
		{
			echo '<img src="'.BASE_PATH.USERFILES.'/avatar/'.$this->diafan->values["name"].'.png?'.rand(0, 99).'" width="'
			.$this->diafan->configmodules("avatar_width", "users").'" height="'
			.$this->diafan->configmodules("avatar_height", "users").'" alt="'.$this->diafan->values["fio"].' ('.$this->diafan->values["name"].')">'
			.'<input type="checkbox" name="delete_avatar" value="1"> '.$this->diafan->_('Удалить')
			.'<br><br>';
		}
		echo '
		<input type="file" name="avatar" size="40" class="inptext">'
		.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Дополнительные параметры"
	 * 
	 * @return void
	 */
	public function edit_variable_param()
	{
		$param_role_rels = array();
		$params = array();
		$result = DB::query("SELECT role_id, element_id FROM {users_param_role_rel} WHERE trash='0' AND role_id>0");
		while ($row = DB::fetch_array($result))
		{
		    $param_role_rels[$row["role_id"]][] = $row["element_id"];
			$params[] = $row["element_id"];
		}
		array_unique($params);
		
		if (! $this->diafan->addnew && $this->diafan->edit == $this->diafan->_user->id)
		{
			?><script language="javascript">
			$(document).ready(function(){
				$("#param<?php echo implode(',#param', $params)?>").hide();
				<?php
				if(! empty($param_role_rels[$this->diafan->_user->role_id]))
				{
				echo '$("#param'.implode(',#param', $param_role_rels[$this->diafan->_user->role_id]).'").show();';
				}
				?>
			});
			</script><?php
		}
		else
		{
			?><script language="javascript">
			$(document).ready(function(){
				$("select[name=role_id]").live('change',function(){
					show_param_rele_rel(this);
				});
				show_param_rele_rel("select[name=role_id]");
			});
			function show_param_rele_rel(th)
			{
				$("#param<?php echo implode(',#param', $params)?>").hide();
				<?php
				foreach($param_role_rels as $role_id => $params)
				{
					echo '
					if($(th).val() == '.$role_id.'){
						$("#param'.implode(',#param', $params).'").show();
					}
					';
				} ?>
			}
			</script><?php
		}

		parent::__call('edit_variable_param', array());
	}
	
	/**
	 * Редактирование поля "Пароль"
	 * @return void
	 */
	public function edit_variable_password()
	{
		echo '
		<tr id="password">
			<td align="right">
				'.$this->diafan->variable_name().'
			</td>
			<td>
				<input type="password" name="password" size="40" value="">';
				echo $this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Валидация поля "Логин"
	 * 
	 * @return void
	 */
	public function validate_variable_name()
	{
		$this->diafan->set_error("name", Validate::login($_POST["name"], $_POST["id"]));
	}

	/**
	 * Валидация поля "E-mail"
	 * 
	 * @return void
	 */
	public function validate_variable_mail()
	{
		$mes = Validate::mail($_POST["mail"]);
		if($mes)
		{
			$this->diafan->set_error("mail", $mes);
		}
		else
		{
			$this->diafan->set_error("mail", Validate::mail_user($_POST["mail"], $_POST["id"]));
		}
	}

	/**
	 * Валидация поля "Пароля"
	 * 
	 * @return void
	 */
	public function validate_variable_password()
	{
		$access_admin = $_POST["id"] == $this->diafan->_user->id || DB::query_result("SELECT id FROM {users_role_perm} WHERE role_id=%d AND type='admin'", $_POST["role_id"]);
		if($_POST["password"] && $access_admin)
		{
			$this->diafan->set_error("password", Validate::password($_POST["password"], true));
		}
	}

	/**
	 * Сохранение поля "Аватар"
	 * 
	 * @return void
	 */
	public function save_variable_avatar()
	{
		if (! $this->diafan->configmodules("avatar", "users"))
		{
			return false;
		}
		if (! empty($_POST["delete_avatar"]))
		{
			unlink(ABSOLUTE_PATH.USERFILES.'/avatar/'.$this->diafan->oldrow["name"].'.png');
		}
		if (isset($_FILES["avatar"]) && is_array($_FILES["avatar"]) && $_FILES["avatar"]['name'] != '')
		{
			list($width, $height) = getimagesize($_FILES["avatar"]['tmp_name']);
			if (! $width || ! $height)
			{
				throw new Exception('Некорректный файл.');
			}
			if ($width < $this->diafan->configmodules("avatar_width", "users") || $height < $this->diafan->configmodules("avatar_height", "users"))
			{
				throw new Exception('Размер изображения должен быть не меньше '.$this->diafan->configmodules("avatar_width", "users").'px X '.$this->diafan->configmodules("avatar_height", "users").'px.');
			}
			Customization::inc('includes/image.php');
			if (! Image::resize($_FILES["avatar"]['tmp_name'], $this->diafan->configmodules("avatar_width", "users"), $this->diafan->configmodules("avatar_height", "users"), $this->diafan->configmodules("avatar_quality", "users"), true, true))
			{
				throw new Exception('Файл не загружен.');
			}
			$dst_img = imageCreateTrueColor($this->diafan->configmodules("avatar_width", "users"), $this->diafan->configmodules("avatar_height", "users"));
			$original  = @imageCreateFromString(file_get_contents($_FILES["avatar"]['tmp_name'])); 
			imageCopy($dst_img, $original, 0, 0, 0, 0, $this->diafan->configmodules("avatar_width", "users"), $this->diafan->configmodules("avatar_height", "users"));
			imagePNG($dst_img, ABSOLUTE_PATH.USERFILES.'/avatar/'.$this->diafan->oldrow["name"].'.png');
		}
	}
	
	/**
	 * Сохранение поля "Дополнительные параметры"
	 * 
	 * @return void
	 */
	public function save_variable_param()
	{
		parent::__call('save_variable_param', array($this->get_where_param_role_rel()));
	}

	/**
	 * Получает условие для SQL-запроса: выбор полей с учетом роли пользователя
	 *
	 * @return string
	 */
	private function get_where_param_role_rel()
	{
		$param_ids = array();
		$param_role_rels = array();
		$result_roles = array();
		$result = DB::query("SELECT element_id FROM {users_param_role_rel} WHERE role_id=%d OR role_id=0", $_POST["role_id"]);
		while ($row = DB::fetch_array($result))
		{
			$param_ids[] = $row["element_id"];
		}
		if($param_ids)
		{
			return " AND id IN (".implode(",", $param_ids).")";
		}
		return '';
	}
	
	/**
	 * Сохранение поля "Пароль"
	 * @return void
	 */
	public function save_variable_password()
	{
		if (!empty( $_POST["password"]))
		{
			$this->diafan->set_query("password='%s'");
			$this->diafan->set_value(encrypt($_POST["password"]));
		}
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("shop_order_param_user", "user_id=".$del_id.")", $trash_id);
		$this->diafan->del_or_trash_where("shop_cart", "user_id=".$del_id.")", $trash_id);
		$this->diafan->del_or_trash_where("shop_wishlist", "user_id=".$del_id.")", $trash_id);
		$this->diafan->del_or_trash_where("shop_waitlist", "user_id=".$del_id.")", $trash_id);
	}
}
