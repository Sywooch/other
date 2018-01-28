<?php
/**
 * Файловый менеджер
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

class Filemanager_admin extends Frame_admin
{
	/**
	 *  @var array расширения файлов, доступных для редактирования
	 */
	private $allow_extension = array('php', 'txt', 'htaccess', 'html', 'css', 'js');

	/**
	 * @var array массив результатов валидации
	 */
	public $result;

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'multiupload', // мультизагрузка изображений (подключение JS-библиотек)
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		Customization::inc('includes/files.php');
		$this->check_path();
	}

	/**
	 * Выводит список файлов
	 * @return void
	 */
	public function show()
	{
		if($this->diafan->_user->id<>1)
		{ 	
			echo '<div class="error">'.$this->diafan->_('Нет доступа. Файловый менеджер доступен только администратору, устанавливавшему diafan.CMS').'</div>';
			return;
		}
		
		$tree = $this->get_tree();
		echo '<p>'.$this->diafan->_('Внимание! Все изменения необратимы. Для корректной работы diafan.CMS не рекомендуем вручную работать с файлами из папок userfiles и cache.').'</p>';
		
		if($this->diafan->_user->roles('edit', $this->diafan->rewrite))
		{
			echo '<script type="text/javascript" src="' . BASE_PATH . 'modules/filemanager/admin/filemanager.admin.js"></script>';
			echo '<div class="add_new">
			<a title="'.$this->diafan->_('Создать папку').'" href="'.URL.'edit1/?action_filemanager=add_dir">'.$this->diafan->_('Создать папку').'</a>
			</div>
			<div id="file-uploader">
				<noscript>
					<p>Please enable JavaScript to use file uploader.</p>
					<!-- or put a simple form for upload here -->
				</noscript>
			</div>
			<input type="hidden" name="action_url" value="'.URL.'save1/">
			<br>';
		}
		$this->template_tree($tree);
		
		if ($this->diafan->_user->roles('del'))
		{
			echo '<div class="group_action no_move">
			<form method="post" class="ajax">
			<input type="hidden" name="ajax" value="0">
			<input type="hidden" name="group_action" value="true">
	
			<table><tr>
			<td><input type="checkbox" id="select_all"></td>
			<td><span class="select_all">'.$this->diafan->_('Отметить все').'</span></td>
			<td><select name="action">';

			echo '<option value="delete" confirm="'.$this->diafan->_('Вы действительно хотите удалить выделенные файлы и папки? ВНИМАНИЕ! Удаленные файлы и папки восстановлению не подлежат!')
			.'">'.$this->diafan->_('Удалить').'</option>';

			echo  '</select></td>
			<td><input type="submit" id="group_actions" value="'.$this->diafan->_('Применить').'" class="button"></td>
			</tr></table>
			</form></div>';
		}
	}

	/**
	 * Выводит список файлов
	 * @return void
	 */
	public function edit()
	{
		if(! empty($_GET["action_filemanager"]))
		{
			switch($_GET["action_filemanager"])
			{
				case 'edit_file':
					return $this->edit_file();

				case 'download_file':
					return $this->download_file();

				case 'add_dir':
					if(! $this->diafan->_user->roles('edit', $this->diafan->rewrite))
					{
						include(ABSOLUTE_PATH.'includes/404.php');
					}
					return $this->add_dir();

				case 'edit_dir':
					return $this->edit_dir();
			}
		}
		include(ABSOLUTE_PATH.'includes/404.php');
	}

	/**
	 * Выводит список файлов
	 * @return void
	 */
	public function save()
	{
		if (! $this->diafan->_user->roles('edit', $this->diafan->rewrite))
		{
			include(ABSOLUTE_PATH.'includes/404.php');
		}

		if(! empty($_POST["action_filemanager"]))
		{
			// Прошел ли пользователь проверку идентификационного хэша
			if (! $this->diafan->_user->checked)
			{
				$this->diafan->redirect(URL);
				return false;
			}

			switch($_POST["action_filemanager"])
			{

				case 'save_file':
					return $this->save_file();

				case 'save_dir':
					return $this->save_dir();

				case 'create_dir':
					return $this->create_dir();
			}
		}
		if(! empty($_GET["action_filemanager"]) && $_GET["action_filemanager"]  == 'upload_file')
		{
			return $this->upload_file();
		}
		include(ABSOLUTE_PATH.'includes/404.php');
	}

	/**
	 * Проверяет данные
	 *
	 * @return void
	 */
	public function validate()
	{
		// Проверка прав на сохранение
		if (! $this->diafan->_user->roles('edit', $this->diafan->rewrite))
		{
			echo 'ERROR_ROLES';
			return;
		}
		if (!$this->diafan->_user->checked)
		{
			echo 'ERROR_HASH';
			return;
		}
		$this->result["hash"] = $this->diafan->_user->get_hash();

		if(! empty($_POST["action_filemanager"]))
		{
			switch($_POST["action_filemanager"])
			{
				case 'upload_file':
					break;

				case 'save_file':
					$this->validate_save_file();
					break;

				case 'create_dir':
					$this->validate_create_dir();
					break;

				case 'save_dir':
					$this->validate_save_dir();
					break;
			}
		}

		if(empty($this->result["errors"]))
		{
			$this->result["success"] = true;
		}

		include_once ABSOLUTE_PATH . 'plugins/json.php';
		echo to_json($this->result);
		exit;
	}

	/**
	 * Удаляет файлы или папки
	 * 
	 * @return void
	 */
	public function del()
	{
		// Проверка прав на удаление
		if (! $this->diafan->_user->roles('del', $this->diafan->rewrite))
		{
			echo 'ERROR_ROLES';
			return;
		}
		// Прошел ли пользователь проверку идентификационного хэша
		if (!$this->diafan->_user->checked)
		{
			echo 'ERROR_HASH';
			return;
		}
		if(empty($_POST["id"]) && empty($_POST["ids"]))
		{
			return;
		}
		$path = '';
		if(! empty($_POST["ids"]) && is_array($_POST["ids"]))
		{
			arsort($_POST["ids"]);
			foreach($_POST["ids"] as $p)
			{
				if(is_dir(ABSOLUTE_PATH.$p))
				{
					Files::check_dir($p);
					Files::delete_dir($p);
				}
				else
				{
					Files::check_file($p);
					Files::delete_file($p);
				}
				$path = preg_replace('/(\/)*([^\/]+)$/', '', $p);
			}
		}
		elseif(! empty($_POST["id"]) && ! is_array($_POST["id"]))
		{
			if(is_dir(ABSOLUTE_PATH.$_POST["id"]))
			{
				Files::check_dir($_POST["id"]);
				Files::delete_dir($_POST["id"]);
			}
			else
			{
				Files::check_file($_POST["id"]);
				Files::delete_file($_POST["id"]);
			}
			$path = preg_replace('/(\/)*([^\/]+)$/', '', $_POST["id"]);
		}

		$this->result["redirect"] = URL.($path ? '?path='.$path : '');

		include_once ABSOLUTE_PATH . 'plugins/json.php';
		echo to_json($this->result);
		exit;
	}
	
	/**
	 * Проверяет валидность путей к папкам и файлам
	 *
	 * @return void
	 */
	private function check_path()
	{
		if(! empty($_POST["action"]) && $_POST["action"] == "delete")
		{
			return;
		}
		if($this->diafan->save && (empty($_GET["action_filemanager"]) || $_GET["action_filemanager"] != "upload_file"))
		{
			$request = &$_POST;
		}
		else
		{
			$request = &$_GET;
		}
		if(! empty($request["path_file"]))
		{
			if(is_array($request["path_file"]))
			{
				if(empty($request["action_filemanager"]) || ! in_array($request["action_filemanager"], array('delete')))
				{
					throw new Exception('Ошибочный путь.');
				}
				foreach($request["path_file"] as $p)
				{
					Files::check_file($p);
				}
			}
			else
			{
				Files::check_file($request["path_file"]);
			}
		}
		else
		{
			
			if(! empty($request["action_filemanager"]) && in_array($request["action_filemanager"], array('edit_file', 'save_file')))
			{
				throw new Exception('Ошибочный путь.');
			}
		}
		if(! empty($request["path"]))
		{
			if(is_array($request["path"]))
			{
				if(! empty($request["action_filemanager"]) && ! in_array($request["action_filemanager"], array('delete')))
				{
					throw new Exception('Ошибочный путь.');
				}
				foreach($request["path"] as $p)
				{
					Files::check_dir($p);
				}
			}
			else
			{
				Files::check_dir($request["path"]);
			}
		}
		else
		{
			if(! empty($request["action_filemanager"]) && in_array($request["action_filemanager"], array('edit_dir')))
			{
				throw new Exception('Ошибочный путь.');
			}
			$request["path"] = '';
		}
	}
	
	/**
	 * Формирует дерево папок и файлов
	 *
	 * @param string $parent папка-родитель
	 * @param integer $level текущий уровень
	 * @return array
	 */
	private function get_tree($parent = '', $level = 1)
	{
		$tree = array();
		$dir = opendir(ABSOLUTE_PATH.$parent);
		while (($file = readdir($dir)) !== false)
		{
			if($file == '.' || $file == '..')
				continue;

			$row = array(
				"name" => $file,
				"parent" => $parent,
				"path" => ($parent ? $parent.'/' : '').$file,
				"level" => $level
			);
			$name = $file;
			if (is_dir(ABSOLUTE_PATH.$row["path"]))
			{
				$row["type"] = "dir";
				$open = false;
				if(is_array($_GET["path"]))
				{
					foreach($_GET["path"] as $p)
					{
						if($p == $row["path"] || preg_match('/^'.str_replace('/', '\/', $row["path"]).'/', $p))
						{
							$open = true;
						}
					}
				}
				elseif($_GET["path"] == $row["path"] || preg_match('/^'.str_replace('/', '\/', $row["path"]).'/', $_GET["path"]))
				{
					$open = true;
				}
				if($open)
				{
					$row["children"] = $this->get_tree($row["path"], $level + 1);
				}
				else
				{
					$row["children"] = false;
					$dir_child = opendir(ABSOLUTE_PATH.$row["path"]);
					while (($file_child = readdir($dir_child)) !== false)
					{
						if($file_child == '.' || $file_child == '..')
							continue;

						$row["children"] = true;
						break;
					}
					
				}
				$name = 'a'.$name;
			}
			else
			{
				$row["type"] = "file";
				$name = 'b'.$name;
			}
			$tree[$name] = $row;
		}
		closedir($dir);
		ksort($tree);
		return $tree;
	}
	
	/**
	 * Шаблон вывода дерева папок и файлов
	 *
	 * @param array $rows папки и файлы текущего уровня
	 * @return void
	 */
	private function template_tree($rows)
	{
		echo '<ul class="list">';
		foreach($rows as $row)
		{
			echo '<li class="level_'.$row["level"].'" row_id="'.$row["path"].'">';
			echo '<div class="table_wrap"><table width="100%"><tbody><tr>';
			if ($this->diafan->_user->roles('del'))
			{
				echo '<td class="checkbox"><input type="checkbox" name="ids[]" value="'.$row["path"].'"></td>';
			}
			echo '<td class="item_plus_minus">';
			if(! empty($row["children"]))
			{
				if(is_array($row["children"]))
				{
					echo '<a href="'.URL.($row["parent"] ? '?path='.$row["parent"] : '').'" title="'.$this->diafan->_('Свернуть').'"><img src="'.BASE_PATH.'adm/img/item_minus.png" alt="'.$this->diafan->_('Свернуть').'"></a>';
				}
				else
				{
					echo '<a href="'.URL.'?path='.$row["path"].'" title="'.$this->diafan->_('Развернуть').'"><img src="'.BASE_PATH.'adm/img/item_plus.png" alt="'.$this->diafan->_('Развернуть').'"></a>';
				}
			}
			echo '</td>
			<td class="folder">';
			if($row["type"] == "dir")
			{
				if(! empty($row["children"]) &&  is_array($row["children"]))
				{
					echo '<img src="'.BASE_PATH.'adm/img/folder_open.png" alt="'.$this->diafan->_('Папка').'" width="16" height="16"></a>';
				}
				else
				{
					echo '<img src="'.BASE_PATH.'adm/img/folder.png" alt="'.$this->diafan->_('Папка').'" width="16" height="16"></a>';
				}
			}
			echo '</td>
			<td class="name" style="padding-left:8px"><a title="'.$this->diafan->_('Редактировать').'" href="'.URL.'edit1/?action_filemanager=edit';
			if($row["type"] == "dir")
			{
				echo '_dir&path=';
			}
			else
			{
				echo '_file&path_file=';
			}
			echo $row["path"].'">'.$row["name"].'</a></td>
			<td class="action_separator"></td>';
			if($row["type"] == "dir")
			{
				if($this->diafan->_user->roles('edit', $this->diafan->rewrite))
				{
					echo '<td class="action_icon"><a href="'.URL.'edit1/?path='.$row["path"].'&action_filemanager=add_dir" title="'.$this->diafan->_('Создать папку').'"><img src="'.BASE_PATH . 'adm/img/add.png" alt="'.$this->diafan->_('Создать папку').'"></a></td>';
				}
				if($this->diafan->_user->roles('del', $this->diafan->rewrite))
				{
					echo '<td class="action_icon"><a href="#" action="delete" title="'.$this->diafan->_('Удалить папку').'"'
					.' confirm="'.$this->diafan->_('Вы действительно хотите удалить папку и все вложенные в нее файлы?').'">'
					. '<img src="'.BASE_PATH.'adm/img/delete.png" alt="'.$this->diafan->_('Удалить папку').'"></a></td>';
				}
			}
			else
			{
				if($this->diafan->_user->roles('edit', $this->diafan->rewrite))
				{
					echo '<td class="action_icon"></td>';
				}
				if($this->diafan->_user->roles('del', $this->diafan->rewrite))
				{
					echo '<td class="action_icon"><a href="#" action="delete" title="'.$this->diafan->_('Удалить файл').'"'
					.' confirm="'.$this->diafan->_('Вы действительно хотите удалить файл?').'">'
				.'<img src="'.BASE_PATH.'adm/img/delete.png" alt="'.$this->diafan->_('Удалить файл').'"></a></td>';
				}
			}
			echo '
			</tr></tbody></table></div>';
			if(! empty($row["children"]) && is_array($row["children"]))
			{
				$this->template_tree($row["children"]);
			}
			echo '</li>';
		}
		echo '</ul>';
	}

	/**
	 * Форма редактирования файла
	 * 
	 * @return void
	 */
	private function edit_file()
	{
		$name = substr(strrchr($_GET["path_file"], '/'), 1);
		if(! $name)
		{
			$name = $_GET["path_file"];
		}
		$extension = substr(strrchr($name, '.'), 1);
		$path = preg_replace('/(\/)*'.$name.'$/', '', $_GET["path_file"]);
		$name =  str_replace('"', '&quot;', $name);
		$content = str_replace(array ( '<', '>', '"'), array ( '&lt;', '&gt;', '&quot;'), file_get_contents(ABSOLUTE_PATH.$_GET["path_file"]));
		echo '<form METHOD="POST" action="'.URL.'save1/" enctype="multipart/form-data" id="save">
		<input type="hidden" name="check_hash_user" value="'.$this->diafan->_user->get_hash().'">
		<input type="hidden" name="path_file" value="'.$_GET["path_file"].'">
		<input type="hidden" name="action" value="">
		<input type="hidden" name="action_filemanager" value="save_file">
		<div class="block_no_bg">
		<h2>'.$this->diafan->_('Редактировать').'</h2>
		<table class="table_edit">
		<tr id="name">
			<td class="td_first">Название</td>
			<td>
				<input type="text" name="name" size="40" value="'.$name.'">
			</td>
		</tr>
		<tr>
			<td class="td_first">Скачать</td>
			<td>
				<a href="'.URL.'edit1/?path_file='.$_GET["path_file"].'&action_filemanager=download_file">'.URL.'edit1/?path_file='.$_GET["path_file"].'&action_filemanager=download_file</a>
			</td>
		</tr>';
		if(in_array($extension, $this->allow_extension))
		{
			echo '
			<tr id="content">
				<td colspan="2">
				<textarea name="content" style="width:100%;height: 500px">'.$content.'</textarea>
				</td>
			</tr>';
		}
		echo '
		</table>
		</div>
		<div class="button_block">';
		if(! Files::is_writable($_GET["path_file"], true))
		{
			echo '<div class="error">'.$this->diafan->_('Файл не доступен для записи. роверьте данные для подключения по FTP или установите права на запись (777).').'</div>';
		}
		elseif($this->diafan->_user->roles('edit', $this->diafan->rewrite))
		{
			echo '<input type="submit" value="'.$this->diafan->_('Сохранить').'" class="button" >';
		}
		echo '<input type="button" onClick="document.location=\''.URL.($path ? '?path='.$path : '').'\'" class="button red" value="'.$this->diafan->_('Выйти без сохранения').'">
		</div>
		</form>';
	}

	/**
	 * Отдает содержание файла
	 * 
	 * @return void
	 */
	private function download_file()
	{
		$name = substr(strrchr($_GET["path_file"], '/'), 1);
		if(! $name)
		{
			$name = $_GET["path_file"];
		}
		header("Cache-Control: public, must-revalidate");
		header('Cache-Control: pre-check=0, post-check=0, max-age=0');
		header("Pragma: no-cache");
		header("Expires: 0");
		header("Content-Description: File Transfer");
		header("Expires: Sat, 30 Dec 1990 07:07:07 GMT");
		header("Accept-Ranges: bytes");
		header("Content-Length: ".filesize(ABSOLUTE_PATH.$_GET["path_file"]));
		header('Content-Disposition: attachment; filename="'.$name.'"');
		header("Content-Transfer-Encoding: binary\n");

		@set_time_limit(0);
		$fp = @fopen($_GET["path_file"], 'rb');
		if ($fp !== false)
		{
			while (!feof($fp))
			{
				echo fread($fp, 8192);
			}
			fclose($fp);
		}
		else
		{
			@readfile($_GET["path_file"]);
		}
		flush();
		exit;
	}

	/**
	 * Форма добавления папки
	 * 
	 * @return void
	 */	
	private function add_dir()
	{
		echo '
		<form method="POST" action="'.URL.'save1/" enctype="multipart/form-data" id="save">
		<input type="hidden" name="check_hash_user" value="'.$this->diafan->_user->get_hash().'">
		<input type="hidden" name="path" value="'.$_GET["path"].'">
		<input type="hidden" name="action" value="">
		<input type="hidden" name="action_filemanager" value="create_dir">
		<div class="block_no_bg">
		<h2>'.$this->diafan->_('Редактировать').'</h2>
		<table class="table_edit">
		<tr id="name">
			<td class="td_first">Название</td>
			<td>
				<input type="text" name="name" size="40" value="">
			</td>
		</tr>
		</table>
		</div>
		<div class="button_block">';
		if(! Files::is_writable($_GET["path"], true))
		{
			echo '<div class="error">'.$this->diafan->_('Папка не доступна для записи. Проверьте данные для подключения по FTP или установите права на запись (777).').'</div>';
		}
		echo '<input type="submit" value="'.$this->diafan->_('Сохранить').'" class="button">
		<input type="button" onClick="document.location=\''.URL.'?path='.$_GET["path"].'\'" class="button red" value="'.$this->diafan->_('Выйти без сохранения').'">
		</div>
		</form>';
	}

	/**
	 * Форма редактирования папки
	 * 
	 * @return void
	 */
	private function edit_dir()
	{
		$name = substr(strrchr($_GET["path"], '/'), 1);
		if(! $name)
		{
			$name = $_GET["path"];
		}
		$name =  str_replace('"', '&quot;', $name);
		
		if($this->diafan->_user->roles('edit', $this->diafan->rewrite))
		{
			echo '<script type="text/javascript" src="'.BASE_PATH.'modules/filemanager/admin/filemanager.admin.js"></script>';
			echo '<div class="add_new">
			<a title="'.$this->diafan->_('Создать папку').'" href="'.URL.'edit1/?action_filemanager=add_dir&path='.$_GET["path"].'">'.$this->diafan->_('Создать папку').'</a>
			</div>
			<div id="file-uploader">
				<noscript>
					<p>Please enable JavaScript to use file uploader.</p>
					<!-- or put a simple form for upload here -->
				</noscript>
			</div>
			<input type="hidden" name="action_url" value="'.URL.'save1/">';
		}
		echo '
		<form method="POST" action="'.URL.'save1/" enctype="multipart/form-data" id="save">
		<input type="hidden" name="check_hash_user" value="'.$this->diafan->_user->get_hash().'">
		<input type="hidden" name="path" value="'.$_GET["path"].'">
		<input type="hidden" name="action" value="">
		<input type="hidden" name="action_filemanager" value="save_dir">
		<div class="block_no_bg">
		<h2>'.$this->diafan->_('Редактировать').'</h2>
		<table class="table_edit">
		<tr id="name">
			<td class="td_first">Название</td>
			<td>
				<input type="text" name="name" size="40" value="'.$name.'">
			</td>
		</tr>
		</table>
		</div>
		<div class="button_block">';
		if(! Files::is_writable($_GET["path"], true))
		{
			echo '<div class="error">'.$this->diafan->_('Папка не доступна для записи. Проверьте данные для подключения по FTP или установите права на запись (777).').'</div>';
		}
		elseif($this->diafan->_user->roles('edit', $this->diafan->rewrite))
		{
			echo '<input type="submit" value="'.$this->diafan->_('Сохранить').'" class="button" >';
		}
		echo '<input type="button" onClick="document.location=\''.URL.'?path='.$_GET["path"].'\'" class="button red" value="'.$this->diafan->_('Выйти без сохранения').'">
		</div>
		</form>';
	}

	/**
	 * Загружает файл
	 * 
	 * @return void
	 */
	private function upload_file()
	{
		$path = !empty($_GET["path"]) ? $_GET["path"] : '';
		$this->result["redirect"] = URL.($path ? '?path='.$path : '');
		$this->result["success"] = true;

		if (isset($_GET['qqfile']))
		{
			$_FILES["image"]['name'] = $_GET['qqfile'];
			$_FILES["image"]['tmp_name'] = $this->qq_temp_name();
		}
		elseif (isset( $_FILES['qqfile'] ))
		{
			$_FILES["image"] = $_FILES['qqfile'];
		}

		if (isset($_FILES["image"]) && is_array($_FILES["image"]) && $_FILES["image"]['name'] != '')
		{
			$name = preg_replace('/[^a-z0-9-_\.]+/', '', strtolower($this->diafan->translit($_FILES["image"]['name'])));
			Files::upload_file($_FILES["image"]['tmp_name'], $name, $path);
		}

		include_once ABSOLUTE_PATH . 'plugins/json.php';
		echo to_json($this->result);
		exit;
	}

	private function qq_temp_name()
	{
		$input = fopen("php://input", "r");
		$tmpfname = tempnam(ABSOLUTE_PATH.'cache', "diafan");

		$temp = fopen($tmpfname, "w");

		$realSize = stream_copy_to_stream($input, $temp);
		fclose($input);
		fclose($temp);

		if (!isset( $_SERVER["CONTENT_LENGTH"] ) || $realSize != (int)$_SERVER["CONTENT_LENGTH"])
		{
			return false;
		}

		return $tmpfname;
	}

	/**
	 * Валидация данных при сохранения файла
	 * 
	 * @return void
	 */
	private function validate_save_file()
	{
		$name = str_replace('&quot;', '"', $_POST["name"]);
		$path = str_replace('&quot;', '"', $_POST["path_file"]);
		$old_name = substr(strrchr($path, '/'), 1);
		if(! $old_name)
		{
			$old_name = $path;
		}
		$path = preg_replace('/(\/)*([^\/]+)$/', "", $path);
		if($name != $old_name)
		{
			if(preg_match('/[^0-9a-z_\-\.]+/', $name))
			{
				$this->result["errors"]["name"] = $this->diafan->_('Недопустимые символы в названии файла. Используйте строчные буквы латинского алфавита, цифры, точку, тире и нижнее подчеркивание.');
			}
			if(file_exists(ABSOLUTE_PATH.$path.'/'.$name))
			{
				$this->result["errors"]["name"] = $this->diafan->_('Файл с таким именем уже существует.');
			}
		}
	}

	/**
	 * Сохраняет отредактированный файл
	 * 
	 * @return void
	 */
	private function save_file()
	{
		$path = str_replace('&quot;', '"', $_POST["path_file"]);
		$name = str_replace('&quot;', '"', $_POST["name"]);

		$name_file = substr(strrchr($_POST["path_file"], '/'), 1);
		if(! $name_file)
		{
			$name_file = $_POST["path_file"];
		}
		$extension = substr(strrchr($name_file, '.'), 1);
		if(in_array($extension, $this->allow_extension))
		{
			Files::save_file($_POST["content"], $path);
		}

		$old_name = substr(strrchr($_POST["path_file"], '/'), 1);
		if(! $old_name)
		{
			$old_name = $path;
		}
		$path = preg_replace('/(\/)*([^\/]+)$/', "", $path);
		if($name != $old_name)
		{
			if(preg_match('/[^0-9a-z_\-\.]+/', $name))
			{
				throw new Exception('Недопустимые символы в названии файла. Используйте строчные буквы латинского алфавита, цифры, точку, тире и нижнее подчеркивание.');
			}
			if(file_exists(ABSOLUTE_PATH.$path.'/'.$name))
			{
				throw new Exception('Файл с таким именем уже существует.');
			}
			Files::rename_file($name, $old_name, $path);
		}
		$this->diafan->redirect(URL.($path ? '?path='.$path.'/' : ''));
	}

	/**
	 * Валидация данных при создании папки
	 * 
	 * @return void
	 */
	private function validate_create_dir()
	{
		$name = str_replace('&quot;', '"', $_POST["name"]);
		$path = str_replace('&quot;', '"', $_POST["path"]);
		if(preg_match('/[^0-9a-z_\-\.]+/', $name))
		{
			$this->result["errors"]["name"] = $this->diafan->_('Недопустимые символы в названии папки. Используйте строчные буквы латинского алфавита, цифры, точку, тире и нижнее подчеркивание.');
		}
		if(is_dir(ABSOLUTE_PATH.$path.'/'.$name))
		{
			$this->result["errors"]["name"] = $this->diafan->_('Папка с таким именем уже существует.');
		}
	}

	/**
	 * Создает новую папку
	 * 
	 * @return void
	 */
	private function create_dir()
	{
		$name = str_replace('&quot;', '"', $_POST["name"]);
		$path = str_replace('&quot;', '"', $_POST["path"]);
		if(preg_match('/[^0-9a-z_\-\.]+/', $name))
		{
			throw new Exception('Недопустимые символы в названии папки. Используйте строчные буквы латинского алфавита, цифры, точку, тире и нижнее подчеркивание.');
		}
		if(is_dir(ABSOLUTE_PATH.$path.'/'.$name))
		{
			throw new Exception('Папка с таким именем уже существует.');
		}
		Files::create_dir($name, $path);
		$this->diafan->redirect(URL.'?path='.($path ? $path.'/' : '').$name);
	}

	/**
	 * Валидация данных при сохранения названия папки
	 * 
	 * @return void
	 */
	private function validate_save_dir()
	{
		$name = str_replace('&quot;', '"', $_POST["name"]);
		$path = str_replace('&quot;', '"', $_POST["path"]);
		$old_name = substr(strrchr($path, '/'), 1);
		if(! $old_name)
		{
			$old_name = $path;
		}
		$path = preg_replace('/(\/)*([^\/]+)$/', "", $path);
		if($name != $old_name)
		{
			if(preg_match('/[^0-9a-z_\-\.]+/', $name))
			{
				$this->result["errors"]["name"] = $this->diafan->_('Недопустимые символы в названии папки. Используйте строчные буквы латинского алфавита, цифры, точку, тире и нижнее подчеркивание.');
			}
			if(is_dir(ABSOLUTE_PATH.$path.'/'.$name))
			{
				$this->result["errors"]["name"] = $this->diafan->_('Папка с таким именем уже существует.');
			}
		}
	}

	/**
	 * Сохраняет название папки
	 * 
	 * @return void
	 */
	private function save_dir()
	{
		$name = str_replace('&quot;', '"', $_POST["name"]);
		$path = str_replace('&quot;', '"', $_POST["path"]);
		$old_name = substr(strrchr($path, '/'), 1);
		if(! $old_name)
		{
			$old_name = $path;
		}
		$path = preg_replace('/(\/)*([^\/]+)$/', "", $path);
		if($name != $old_name)
		{
			if(preg_match('/[^0-9a-z_\-\.]+/', $name))
			{
				throw new Exception('Недопустимые символы в названии папки. Используйте строчные буквы латинского алфавита, цифры, точку, тире и нижнее подчеркивание.');
			}
			if(is_dir(ABSOLUTE_PATH.$path.'/'.$name))
			{
				$this->result["errors"]["name"] = $this->diafan->_('Папка с таким именем уже существует.');
			}
			Files::rename_dir($name, $old_name, $path);
		}
		$this->diafan->redirect(URL.'?path='.($path ? $path.'/' : '').$name);
	}
}