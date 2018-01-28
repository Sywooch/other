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
 * Users_admin_role
 *
 * Редактирование права пользователей
 */
class Users_admin_role extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'users_role';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Название',
				'multilang' => true,
			),
			'registration' => array(
				'type' => 'checkbox',
				'name' => 'Задавать при регистрации',
			),
			'only_self' => array(
				'type' => 'checkbox',
				'name' => 'Видеть только свои материалы',
			),
			'perm' => array(
				'type' => 'function',
				'name' => 'Привелегии',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'trash', // использовать корзину
	);

	/**
	 * @var array типы действий
	 */
	private $admin_variable_roles = array(
		'просмотр' => 'init',
		'правка' => 'edit',
		'удаление' => 'del'
	);

	/**
	 * @var array права пользователя для пользовательской части
	 */
	private $user_variable_roles;

	/**
	 * @var array названия прав пользователя для пользовательской части
	 */
	private $user_variable_names;

	/**
	 * Выводит список типов пользователей
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить тип пользователя');

		$this->diafan->list_row();
	}

	/**
	 * Редактирование поля "Права доступа"
	 * @return void
	 */
	public function edit_variable_perm()
	{
		echo '<tr><td colspan="2">
			<script src="'.BASE_PATH.'modules/users/admin/users.admin.role.js"></script>
		<div id="tabs">
		<ul>
			<li><a href="#tabs-admin">'.$this->diafan->_('Права для административной части').'</a></li>
			<li><a href="#tabs-site">'.$this->diafan->_('Права для пользовательской части').'</a></li>	
		</ul>
		<div id="tabs-admin">';
			$this->table_admin_roles();
		echo '</div>
		<div id="tabs-site">';
			$this->table_site_roles();
		echo '</div>
		</div>
		<input type="hidden" name="type" id="type" value="admin">
		</td></tr>';
	}

	/**
	 * Формирует таблицы с правами пользователя
	 * @return void
	 */
	private function table_admin_roles()
	{
		$variable_roles = $this->admin_variable_roles;
		$current_roles = array();
		$admin_roles = false;
		$result = DB::query("SELECT perm, rewrite FROM {users_role_perm} WHERE role_id=%d AND type='admin'",$this->diafan->edit);
		while ($row = DB::fetch_array($result))
		{
			if($row["perm"] == 'all' && $row["rewrite"] == 'all')
			{
				$admin_roles = true;
				break;
			}
			if($row["perm"] == "all")
			{
				$current_roles[$row["rewrite"]] = 'all';
			}
			else
			{
				$current_roles[$row["rewrite"]] = explode(',', $row["perm"]);
			}
		}
		$rewrites = array();
		$modules = array();
		$result = DB::query("SELECT id, name, rewrite, parent_id FROM {adminsite} ORDER BY parent_id, sort ASC");
		while ($row = DB::fetch_array($result))
		{
			if (in_array($row["rewrite"], $rewrites))
				continue;

			$rewrites[$row["id"]] = $row["rewrite"];
			foreach ($variable_roles as $v)
			{
				$row["role"][$v] = ! $this->diafan->addnew
				&&  ($admin_roles || ! empty($current_roles[$row["rewrite"]]) && ($current_roles[$row["rewrite"]] == 'all' || in_array($v, $current_roles[$row["rewrite"]])));
			}
			$modules[$row["parent_id"]][] = $row;
		}

		echo '<table class="border"><tr id="tr_first"><td>&nbsp;';
		foreach ($variable_roles as $key => $v)
		{
			echo '</td><td>'.$this->diafan->_($key).'<br><input type="checkbox" name="check_all_role" value="'.$v.'">';
		}
		echo '</td></tr>';

		foreach($modules[0] as $row)
		{
			$this->table_tr_admin_roles($row, $variable_roles);
			if($row["id"] && ! empty($modules[$row["id"]]))
			{
				foreach($modules[$row["id"]] as $row2)
				{
					$this->table_tr_admin_roles($row2, $variable_roles, false);
				}
			}
		}
		echo '</table>';
	}

	/**
	 * Формирует таблицу с правами пользователя для административной части
	 * @return void
	 */
	private function table_tr_admin_roles($row, $variable_roles, $parent = true)
	{
		echo '<tr><td align="right">';
		if($parent)
		{
			echo '<b>'.$row["name"].'</b>';
		}
		else
		{
			echo $row["name"];
		}
		foreach ($variable_roles as $v)
		{
			echo '</td><td>';
			echo '<input type="checkbox" name="'.$v.'[]" value="'.$row["rewrite"].'" class="checkbox checkbox_'.$v.'"';
			if ($row["role"][$v])
			{
				echo " checked";
			}
			echo '>';
		}
		echo '</td></tr>';
	}

	/**
	 * Формирует массив с правами пользователя для пользовательской части
	 * @return void
	 */
	private function get_user_roles()
	{
		$this->user_variable_names = array();
		$dir = opendir(ABSOLUTE_PATH."modules");
		while (($file = readdir($dir)) !== false)
		{
			if (!$file != '.' && $file != '..' && $file != 'users' && (file_exists(ABSOLUTE_PATH.'modules/'.$file.'/admin/'.$file.'.admin.role.php')))
			{
				if(! $name = DB::query_result("SELECT title FROM {modules} WHERE name='%s' LIMIT 1", $file))
				{
					$name = $file;
				}
				$this->user_variable_names[$file] = $this->diafan->_($name);

				Customization::inc('modules/'.$file.'/admin/'.$file.'.admin.role.php');
				$class_name = ucfirst($file).'_admin_role';
				$module = new $class_name($this);
				$this->user_variable_roles[$file] = $module->get_rules();
				unset($module);
			}
		}
		closedir($dir);
	}

	/**
	 * Формирует таблицу с правами пользователя для пользовательской части
	 * @return void
	 */
	private function table_site_roles()
	{
		$this->get_user_roles();

		$values = array();
		$res = DB::query('SELECT rewrite, perm FROM {users_role_perm} WHERE role_id=%d AND type="site"', $this->diafan->edit);
		while ($row = DB::fetch_array($res))
		{
			$values[$row['rewrite']] = explode(',', $row['perm']);
		}

		echo '<table class="border">';
		foreach ($this->user_variable_roles as $module => $roles)
		{
			echo '<tr><td><b>'.$this->user_variable_names[$module].'</b></td><td>';

			foreach ($roles as $name => $title)
			{
				echo '<input type="checkbox" name="'.$module.'[]" value="'.$name.'"'.(!empty($values[$module]) && in_array($name, $values[$module]) ? 'checked' : '').'> '.$title.'<br/>';
			}

			echo '</td></tr>';
		}
		echo '</table>';
	}

	/**
	 * Сохранение поля "Права доступа"
	 * @return void
	 */
	public function save_variable_perm()
	{
		DB::query("DELETE FROM {users_role_perm} WHERE role_id=%d AND type='%h'", $this->diafan->save, $_POST['type']);
		if ($_POST['type'] == 'admin')
		{
			$admin_pages = array();
			$result = DB::query("DEV SELECT DISTINCT(rewrite) FROM {adminsite}");
			while ($row = DB::fetch_array($result))
			{
				$admin_pages[] = $row["rewrite"];
			}
			$all_roles = true;
			foreach($admin_pages as $admin_page)
			{
				foreach ($this->admin_variable_roles as $v)
				{
					if (empty($_POST[$v]) || ! in_array($admin_page, $_POST[$v]))
					{
						$all_roles = false;
						break 2;
					}
				}
			}
			if($all_roles)
			{
				DB::query("INSERT INTO {users_role_perm} (rewrite, perm, role_id, type) VALUES ('all', 'all', %d, '%s')", $this->diafan->save, $_POST['type']);
				return;
			}
			$count = count($this->admin_variable_roles);
			foreach($admin_pages as $admin_page)
			{
				$current_perm = array();
				foreach ($this->admin_variable_roles as $v)
				{
					if (!empty($_POST[$v]) && in_array($admin_page, $_POST[$v]))
					{
						$current_perm[] = $v;
					}
				}
				if (count($current_perm) > 0)
				{
					if (count($current_perm) == $count)
					{
						$count_rewrite++;
						$perm = 'all';
					}
					else
					{
						$perm = implode(',', $current_perm);
					}

					DB::query("INSERT INTO {users_role_perm} (rewrite, perm, role_id, type) VALUES ('%s', '%s', %d, '%s')", $admin_page, $perm, $this->diafan->save, $_POST['type']);
				}
			}
		}

		if ($_POST['type'] == 'site')
		{
			$this->get_user_roles();
			foreach ($this->user_variable_roles as $module => $roles)
			{
				if (!empty($_POST[$module]))
				{
					$perm = implode(',', $_POST[$module]);
					DB::query("INSERT INTO {users_role_perm} (rewrite,perm,role_id,type) VALUES ('%s','%s',%d,'%s')", $module, $perm, $this->diafan->save, $_POST['type']);
				}
			}
		}
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("users_param_role_rel", "rel_id=".$del_id, $trash_id);
	}
}