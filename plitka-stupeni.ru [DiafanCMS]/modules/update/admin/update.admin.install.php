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
 * Update_admin_install
 *
 * Установка/удаление модулей
 */
class Update_admin_install extends Frame_admin
{
	/**
	 * Выводит контент модуля
	 * @return void
	 */
	public function show()
	{
		$rows = $this->get_rows();
		$module_rows = array('news', 'clauses', 'feedback', 'faq', 'shop', 'ads', 'files', 'comments', 'rating',
				     'tags', 'photo', 'votes', 'subscribtion', 'users', 'forum', 'search', 'map',
				     'keywords', 'filemanager', 'mistakes');

		foreach ($rows as $k => $v)
		{
			if (! in_array($k, $module_rows))
			{
				$module_rows[] = $k;
			}
		}
		foreach ($module_rows as $k => $val)
		{
			if (!in_array($val, array_keys($rows)))
			{
				unset($module_rows[$k]);
			}
		}

		if ($this->diafan->page == 2)
		{
			echo '<font color="red">'.$this->diafan->_('Все модули установлены!').'</font>';
		}
		echo '<form action="'.$this->diafan->get_admin_url().'save1/" method="POST">
		<p>'.$this->diafan->_('Снимите галку с модулей, которые хотите удалить и поставьте напротив тех, что хотите устновить.').'</p>
		<p><input type="checkbox" name="example_yes" value="1"> '.$this->diafan->_('Заполнить сайт примерами (может занять время). Только для устанавливаемых модулей.').'</p>';
		echo '<p>'.$this->diafan->_('Доступны следующие модули для установки/удаления').':</p>
		<input type="hidden" name="check_hash_user" value="'.$this->diafan->_user->get_hash().'">';
		foreach ($module_rows as $row)
		{
			$name  = $rows[$row];
			echo '<p><input type="checkbox" name="'.$row.'" '.(DB::where("modules", "module_name='".$row."'", "id") ? 'checked' : '').'> <b>'.$name.'</b></p>';
			$k = 1;
		}
		echo '<input type="submit" value="'.$this->diafan->_('Установить').'" class="button" onmouseover="this.style.cursor=\'hand\';">';
		echo '
		</form>';
	}

	/**
	 * Установка/удаление модулей
	 * @return void
	 */
	public function save()
	{
		if(! defined('DEMO_PATH'))
		{
			define('DEMO_PATH', 'http://cms.diafan.ru/files4.2/');
		}
		// Прошел ли пользователь проверку идентификационного хэша
		if (! $this->diafan->_user->checked)
		{
			$this->diafan->redirect(URL);
			return;
		}

		$rows = $this->get_rows(false);
		if (! $rows)
		{
			$this->diafan->redirect($this->diafan->get_admin_url('page').'page2/');
		}
		$inst = new Install($this->diafan->languages);
		
		define('IS_INSTALL', 1);
		foreach ($rows as $module)
		{
			$ins = DB::where("modules", "module_name='".$module."'", "id");

			if (empty($_POST[$module]) && ! $ins || ! empty($_POST[$module]) && $ins)
				continue;

			// удаление модуля
			if (empty($_POST[$module]) && $ins)
			{
				$inst->uninstall($module);
			}
			else
			{
				$inst->install($module, (!empty($_POST["example_yes"])));
				//установка прав на административную часть установленного модуля текущему пользователю
				if(! $this->diafan->_user->roles('all', 'all'))
				{
					$result = DB::query("SELECT rewrite FROM {adminsite} WHERE rewrite='%s' OR rewrite LIKE '%s%%'", $module, $module);
					while ($row = DB::fetch_array($result))
					{
						DB::query("INSERT INTO {users_role_perm} (role_id, perm, rewrite, type) VALUES (%d, 'all', '%s', 'admin')", $this->diafan->_user->role_id, $row["rewrite"]);
					}
				}
			}
		}

		$this->diafan->redirect($this->diafan->get_admin_url('page').'page2/');
	}

	/**
	 * Получает список всех модулей которые можно установить
	 *
	 * @param boolean $add_title добавить в массив информацию о названии модуля
	 * @return array
	 */
	private function get_rows($add_title = true)
	{
		Customization::inc("includes/install.php");
		$rows = array();
		$dirr = opendir(ABSOLUTE_PATH."modules");
		while (($row = readdir($dirr)) !== false)
		{	  
			if (file_exists(ABSOLUTE_PATH.'modules/'.$row.'/'.$row.'.install.php'))
			{
				if($add_title)
				{
					include(ABSOLUTE_PATH.'modules/'.$row.'/'.$row.'.install.php');
					$rows[$row] = ! empty($title) ? $title : $row;
				}
				else
				{
					$rows[] = $row;
				}
			}
		}
		closedir($dirr);
		return $rows;
	}
}