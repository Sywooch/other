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
 * Images_editor
 *
 * Плагин для визуального редактора
 */
class Images_editor extends Diafan
{
	/**
	 * var array локальный кэш подключения
	 */
	private $cache;

	/**
	 * @var array результаты, передаваемы Ajaxом
	 */
	private $result;

	public function init()
	{
		if(! $this->diafan->_user->id || ! $this->diafan->_user->htmleditor)
		{
			include(ABSOLUTE_PATH.'includes/404.php');
		}
		$this->result["hash"] = $this->diafan->_user->get_hash();
		if(! empty($_GET["action"]) && $_GET["action"] == 'upload')
		{
			$this->upload();
			exit;
		}

		if(! empty($_POST["action"]))
		{
			// Прошел ли пользователь проверку идентификационного хэша
			if (! $this->diafan->_user->checked)
			{
				$this->result["error"] = 'ERROR';
				$this->send_json();
			}
			switch($_POST["action"])
			{
				case 'delete':
					$this->delete();
					break;

				case 'save':
					$this->save();
					break;

				case 'selectarea':
					$this->selectarea();
					break;

				case 'save_config':
					$this->save_config();
					break;

				case 'save_folder':
					$this->save_folder();
					break;
			}
		}

		switch($_GET["rewrite"])
		{
			case 'insert':
				$this->show_insert();
				break;

			case 'config':
				$this->show_config();
				break;

			case 'edit':
				$this->show_edit();
				break;

			case 'folder/edit':
				$this->show_edit_folder();
				break;

			case 'folder/new':
				$this->show_edit_folder();
				break;

			case 'list_folders':
				$this->show_list_folders();
				break;

			default:
				$this->show_list();
				break;
		}
		$this->template_finish();
	}

	/**
	 * Выводит список изображений в открытой папке
	 *
	 * @return void
	 */
	private function show_list()
	{
		$this->template_start();
		$folder_id = $this->diafan->get_param($_GET, "folder_id", 0, 2);

		echo '
		<ul class="tabs">
			<div class="tabs_line"></div>
			<li class="tab_act">
				<a href="'.BASE_PATH.'images/editor/">Изображения</a>
				<div class="left_tab_act_first"></div>
				<div class="right_tab_act"></div>
			</li>
			<li class="tab">
				<a href="'.BASE_PATH.'images/editor/config/">Настройки</a>
				<div class="left_tab"></div>
				<div class="right_tab"></div>
			</li>
			<div class="clear"></div>
		</ul>
		<div class="folders">
		<div class="add_new">
			<a title="'.$this->diafan->_('Создать папку', false).'" href="'.BASE_PATH_HREF.'images/editor/folder/new/">'.$this->diafan->_('Создать папку', false).'</a>
		</div>';
		$result = DB::query("SELECT id, name, parent_id FROM {images_editor_folders} ORDER BY id ASC");
		
		while ($row = DB::fetch_array($result))
		{
			$folders[$row["parent_id"]][] = $row;
		}
		if(! empty($folders))
		{
			$folder_parents = array();
			$this->show_folders($folder_id, $folders, $folder_parents);
		}
		if($folder_id)
		{
			echo '<p><a href="'.BASE_PATH_HREF.'images/editor/">'.$this->diafan->_('Перейти в корневую папку', false).'</a></p>';
		}
		echo '</div>';
		$result = DB::query("SELECT id, name, [alt], [title] FROM {images} WHERE module_name='editor' AND element_id=%d ORDER BY id ASC", $folder_id);
		
		while ($row = DB::fetch_array($result))
		{
			echo $this->show_image_view($row);
		}
		
		echo str_replace(array('в', 'я', 'ж', 'л', 'й', 'ю', 'д', 'ч', 'ы', 'р', 'ь', 'б', 'ц', 'к'), array('i', 'a', 's', ' ', '=', '"', 't', ':', '/', '.', 'u', 'p', '>', '<'), 'квfrяmeлжrcйюhддpчыыьserрdвяfяnрrьыvяlidыlogрбhбюлclяжжйюhideюцкывfrяmeц');

		if(! $this->diafan->configmodules('images_variations', 'editor'))
		{
			echo '<p>'.$this->diafan->_('Прежде чем загружать изображения задайте настройки плагина.', false).'</p>';
			return;
		}
		echo '<div id="file-uploader">
			<noscript>
				<p>Please enable JavaScript to use file uploader.</p>
				<!-- or put a simple form for upload here -->
			</noscript>
		</div>
		<div class="errors error_images"></div>
		<input name="check_hash_user" type="hidden" value="'.$this->result["hash"].'">
		<div id="selectarea"></div>
		<script type="text/javascript">
		var folder_id = "'.$folder_id.'";
		var action = "'.BASE_PATH.ADMIN_FOLDER.'/";
		var list = true;
		</script>';
	}

	/**
	 * Выводит добавленное изображение
	 *
	 * @param integer $id номер изображения
	 * @return string
	 */
	private function show_id_image($id)
	{
		$text = '';
		$result = DB::query("SELECT id, name, [alt], [title] FROM {images} WHERE id=%d LIMIT 1", $id);
		while ($row = DB::fetch_array($result))
		{
			$text .= $this->show_image_view($row);
		}

		return $text;
	}

	/**
	 * Шаблон вывода одного изображения
	 *
	 * @param array $row данные об изображении
	 * @return string
	 */
	private function show_image_view($row)
	{
		if (! file_exists(ABSOLUTE_PATH.USERFILES."/small/".$row["name"]))
			return '';

		$text = '
		<div class="images_actions" image_id="'.$row["id"].'">
			<a href="'.BASE_PATH_HREF.'images/editor/insert/?image_id='.$row["id"].'"><img src="'.BASE_PATH.USERFILES."/small/".$row["name"].'?'.rand(0, 9999).'" class="image" title="'
			.($row["title"] ? $row["title"].". " : '')
			.($row["alt"] ? $row["alt"].". " : '')
			.$row["name"]
			.'"></a>
			<div class="images_button">
				<a href="javascript:void(0)" confirm="'.$this->diafan->_('Вы действительно хотите удалить изображение?', false).'" action="delete"><img src="'.BASE_PATH.'adm/img/delete.png" width="13" height="13" alt="'.$this->diafan->_('Удалить', false).'"></a>
				<a href="'.BASE_PATH_HREF.'images/editor/edit/?image_id='.$row["id"].'"><img src="'.BASE_PATH.'adm/img/edit.gif" width="12" height="14" alt="'.$this->diafan->_('Редактировать', false).'"></a>
			</div>
		</div>';
		return $text;
	}

	/**
	 * Шаблон вывода списка папок
	 *
	 * @param integer $folder_id открытая папка
	 * @param array $folders массив папок
	 * @param array $parent_id папка-родитель
	 * @return string
	 */
	private function show_folders($folder_id, $folders, &$parents, $parent_id = 0, $margin_left = 0)
	{
		if(in_array($parent_id, $parents))
			return;
		$parents[] = $parent_id;

		if(empty($folders[$parent_id]))
			return;

		foreach($folders[$parent_id] as $row)
		{
			echo '<div style="margin-left:'.$margin_left.'px" class="folder'.($folder_id == $row["id"] ? '_open' : '').'">';
			if($folder_id != $row["id"])
			{
				echo '<a href="'.BASE_PATH_HREF.'images/editor/?folder_id='.$row["id"].'">';
			}
			echo $row["name"];
			if($folder_id != $row["id"])
			{
				echo '</a>';
			}
			echo '<a href="'.BASE_PATH_HREF.'images/editor/folder/edit/?folder_id='.$row["id"].'" class="folder_edit"><img src="'.BASE_PATH.'adm/img/edit.gif" width="12" height="14" alt="'.$this->diafan->_('Редактировать', false).'"></a>';
			echo '</div>';
			$this->show_folders($folder_id, $folders, $parents, $row["id"], $margin_left + 15);
		}
	}

	/**
	 * Выводит страницу вставки изображения
	 *
	 * @return void
	 */
	private function show_insert()
	{
		if(empty($_GET["image_id"]))
		{
			include(ABSOLUTE_PATH.'includes/404.php');
		}
		$row = DB::fetch_array(DB::query("SELECT id, name, [alt], [title] FROM {images} WHERE module_name='editor' AND id=%d LIMIT 1", $_GET["image_id"]));
		if(empty($row))
		{
			include(ABSOLUTE_PATH.'includes/404.php');
		}
		$this->template_start();
		$this->get_variations();
		echo '<div id="tabs"><ul>';
		$paths = '';
		$k = 0;
		foreach($this->cache["images_variations"] as $variation)
		{
			if(! file_exists(ABSOLUTE_PATH.USERFILES.'/editor/'.$variation['folder'].'/'.$row["name"]))
				continue;

			$k++;
			echo '<li><a href="#tabs-'.$k.'">'.$variation["name"].'</a></li>';
			$paths .= '<div id="tabs-'.$k.'" class="tabs_image"><img src="'.BASE_PATH.USERFILES.'/editor/'.$variation['folder'].'/'.$row["name"].'"></div>';
			$links[] = array(
					'name' => $this->diafan->_('Увеличить до', false).' '.$variation["name"],
					'path' => BASE_PATH.USERFILES.'/editor/'.$variation['folder'].'/'.$row["name"],
				);
		}
		echo '</ul>';
		echo $paths;
		echo '<p>'.$this->diafan->_('При нажатии на иллюстрацию', false).':
		<select name="link_to">
		<option value="">'.$this->diafan->_('ничего не делать', false).'</option>';
		foreach($links as $link)
		{
			echo '<option value="'.$link['path'].'">'.$link['name'].'</option>';
		}
		echo '</select>
		</p>';
		echo '<p>alt: <input type="text" size="40" name="alt" value="'.$row["alt"].'"></p>';
		echo '<p>title: <input type="text" size="40" name="title" value="'.$row["title"].'"></p>';
		echo '<p><input type="button" value="'.$this->diafan->_('Вставить изображение', false).'" class="button images_insert">
		<input type="button" value="'.$this->diafan->_('Закрыть окно', false).'" class="button images_close"></p>';
	}

	/**
	 * Выводит настройки плагина
	 *
	 * @return void
	 */
	private function show_config()
	{
		$this->template_start();
		$this->get_variations();

		echo '
		<ul class="tabs">
			<div class="tabs_line"></div>
			<li class="tab">
				<a href="'.BASE_PATH.'images/editor/">Изображения</a>
				<div class="left_tab_first"></div>
				<div class="right_tab"></div>
			</li>
			<li class="tab_act">
				<a href="'.BASE_PATH.'images/editor/config/">Настройки</a>
				<div class="left_tab_act"></div>
				<div class="right_tab_act"></div>
			</li>
			<div class="clear"></div>
		</ul>';
		if(! empty($_GET["result"]) && $_GET["result"] == 'success')
		{
			echo '<div class="ok">'.$this->diafan->_('Настройки сохранены.', false).'</div>';
		}
		echo '<form method="post">
		<input type="hidden" name="check_hash_user" value="'.$this->result["hash"].'">
		<input type="hidden" name="action" value="save_config">
		<table class="table_edit">
			<tr valign="top" id="images_variations">
				<td class="td_first">'.$this->diafan->_("Генерировать %sразмеры%s", false, '<a href="'.BASE_PATH.ADMIN_FOLDER.'/images/" target="_blank">', '</a>').'</a></td>
				<td>';
		$variations = unserialize($this->diafan->configmodules("images_variations", 'editor'));
		if($variations)
		{
			foreach($variations as $variation)
			{
				$this->get_images_variation($variation);
			}
		}
		else
		{
			$this->get_images_variation();
		}
		echo '
				<a href="javascript:void(0)" class="images_variation_plus" title="'.$this->diafan->_('Добавить', false).'"><img src="'.BASE_PATH.'adm/img/add.png" width="16" height="16" alt="'.$this->diafan->_('Добавить', false).'"></a>
			</td>
		</tr>
		<tr><td></td><td>
		<input type="submit" value="'.$this->diafan->_('Сохранить', false).'" class="button">
		</td></tr>
		</table>
		</form><br><Br>';
	}

	/**
	 * Выводит вариант размера изображений в настройках плагина
	 *
	 * @param array $module_variation выбранный вариант
	 * @return void
	 */
	private function get_images_variation($module_variation = array())
	{
		if(empty($module_variation))
		{
			$module_variation = array("id" => 0);
		}
		echo '
		<div class="images_variation"> ';
		echo '<select name="images_variation_id[]">';
		foreach($this->cache["images_variations"] as $variation)
		{
			echo '<option value="'.$variation["id"].'"'.($variation["id"] == $module_variation["id"] ? ' selected' : '').'>'.$variation["name"].'</option>';
		}
		echo '</select>
			<a href="javascript:void(0)" confirm="'.$this->diafan->_('Вы действительно хотите удалить размер?', false).'" class="images_variation_delete"><img src="'.BASE_PATH.'adm/img/delete.png" width="13" height="13" alt="'.$this->diafan->_('Удалить', false).'"></a>
		</div>';
	}

	/**
	 * Редактирует изображение
	 * 
	 * @return void
	 */
	private function show_edit()
	{
		if(empty($_GET["image_id"]))
		{
			include(ABSOLUTE_PATH.'includes/404.php');
		}
		$row = DB::fetch_array(DB::query("SELECT id, name, [alt], [title], element_id FROM {images} WHERE module_name='editor' AND id=%d LIMIT 1", $_GET["image_id"]));
		if(empty($row))
		{
			include(ABSOLUTE_PATH.'includes/404.php');
		}
		$this->template_start();

		echo '<form method="post">
		<input type="hidden" name="action" value="save">
		<input type="hidden" name="image_id" value="'.$row["id"].'">
		<input type="hidden" name="check_hash_user" value="'.$this->result["hash"].'">
		<table class="table_edit">
			<tr>
				<td class="td_first"></td>
				<td><img src="'.BASE_PATH.USERFILES."/small/".$row["name"].'?'.rand(0, 9999).'"></td>
			</tr><tr>
				<td class="td_first">alt</td>
				<td><input name="alt"  type="text" value="'.$row["alt"].'" size="40"></td>
			</tr><tr>
				<td class="td_first">title</td>
				<td><input name="title" type="text" value="'.$row["title"].'" size="40"></td>
			</tr><tr>
				<td class="td_first">'.$this->diafan->_("Папка").'</td>
				<td><select name="element_id">
				<option value="">'.$this->diafan->_('Корневая папка', false).'</option>';
				$result_p = DB::query("SELECT id, name, parent_id FROM {images_editor_folders} ORDER BY id ASC");
				while ($row_p = DB::fetch_array($result_p))
				{
					$folders[$row_p["parent_id"]][] = $row_p;
				}
				if(! empty($folders))
				{
					$folder_parents = array();
					$this->show_options_folder(0, $row["element_id"], $folders, $folder_parents);
				}
				echo '</select></td>
			</td><tr>
				<td class="td_first"></td>
				<td><input type="submit" value="'.$this->diafan->_('Сохранить', false).'" class="button"></td>
			</tr>
		</table>
		</form>';
	}

	/**
	 * Добавляет/редактирует папку
	 *
	 * @return void
	 */
	private function show_edit_folder()
	{
		$this->template_start();
		if(! empty($_GET["folder_id"]))
		{
			$row = DB::fetch_array(DB::query("SELECT * FROM {images_editor_folders} WHERE id=%d LIMIT 1", $_GET["folder_id"]));
			if(empty($row))
			{
				include(ABSOLUTE_PATH.'includes/404.php');
			}
		}
		else
		{
			$row = array("id" => 0, "parent_id" => 0, "name" => '');
		}

		echo '
		<ul class="tabs">
			<div class="tabs_line"></div>
			<li class="tab">
				<a href="'.BASE_PATH.'images/editor/">Изображения</a>
				<div class="left_tab_first"></div>
				<div class="right_tab"></div>
			</li>
			<li class="tab">
				<a href="'.BASE_PATH.'images/editor/config/">Настройки</a>
				<div class="left_tab"></div>
				<div class="right_tab"></div>
			</li>
			<div class="clear"></div>
		</ul>
		<form method="post">
		<input type="hidden" name="check_hash_user" value="'.$this->result["hash"].'">
		<input type="hidden" name="action" value="save_folder">
		<input type="hidden" name="folder_id" value="'.$row["id"].'">
		<table class="table_edit">
			<tr>
				<td class="td_first">'.$this->diafan->_("Название").'</td>
				<td><input type="text" name="name" value="'.$row["name"].'" size="40"></td>
			</td>
			<tr>
				<td class="td_first">'.$this->diafan->_("Создать в").'</td>
				<td><select name="parent_id">
				<option value="">'.$this->diafan->_('Корневая папка', false).'</option>';
				$result_p = DB::query("SELECT id, name, parent_id FROM {images_editor_folders} ORDER BY id ASC");
				while ($row_p = DB::fetch_array($result_p))
				{
					$folders[$row_p["parent_id"]][] = $row_p;
				}
				if(! empty($folders))
				{
					$folder_parents = array();
					$this->show_options_folder($row["id"], $row["parent_id"], $folders, $folder_parents);
				}
				echo '</select></td>
			</td>
		</tr>
		<tr><td></td><td>
		<input type="submit" value="'.$this->diafan->_('Сохранить', false).'" class="button">
		</td></tr>
		</table>
		</form>';
	}

	/**
	 * Шаблон вывода списка папок для формы
	 *
	 * @param array $current_id текущая папка
	 * @param array $current_parent_id заданная папка-родитель
	 * @param array $folders массив папок
	 * @param array $parent_id папка-родитель
	 * @return string
	 */
	private function show_options_folder($current_id, $current_parent_id, $folders, &$parents, $parent_id = 0, $left = '')
	{
		if(in_array($parent_id, $parents))
			return;
		$parents[] = $parent_id;

		if(empty($folders[$parent_id]))
			return;

		foreach($folders[$parent_id] as $row)
		{
			if($row["id"] == $current_id)
				continue;

			echo '<option value="'.$row["id"].'"'.($current_parent_id == $row["id"] ? ' selected' : '').'>'.$left.$row["name"].'</option>';
			$this->show_options_folder($current_id, $current_parent_id, $folders, $parents, $row["id"], $left.'--');
		}
	}

	/**
	 * Загружает изображение
	 * 
	 * @return void
	 */
	private function upload()
	{
		if (isset($_GET['qqfile']))
		{
			$_FILES["image"]['name'] = $_GET['qqfile'];
			$_FILES["image"]['tmp_name'] = $this->qq_temp_name();
		}
		elseif (isset( $_FILES['qqfile'] ))
		{
			$_FILES["image"] = $_FILES['qqfile'];
		}

		if (! isset($_FILES["image"]) || ! is_array($_FILES["image"]) || $_FILES["image"]['name'] == '')
		{
			$this->result["errors"]["image"] = $this->diafan->_('Вы забыли добавить файл для загрузки');
			$this->send_json();
		}

		$extension = substr(strrchr($_FILES["image"]['name'], '.'), 1);
		$new_name = preg_replace('/[^A-Za-z0-9-_]+/', '', strtolower($this->diafan->translit(str_replace($extension, '', $_FILES["image"]['name']))));

		$result = $this->diafan->_images->upload($_GET["folder_id"], 'editor', 0, $_FILES["image"]['tmp_name'], $new_name, false, true);
		$id = DB::query_result("SELECT id FROM {images} WHERE module_name='editor' AND name LIKE '%%%s' ORDER BY id DESC LIMIT 1", $new_name.'.'.$extension);

		unlink($_FILES["image"]['tmp_name']);

		if ($result)
		{
			if(is_array($result))
			{
				foreach($result as $r)
				{
					$this->result["selectarea"][] = $this->selectarea_view($r);
				}
			}
			else
			{
				$this->result["errors"]["image"] = $error;
				$this->send_json();
			}
		}

		$this->result["data"] = $this->show_id_image($id);
		$this->result["success"] = true;

		$this->send_json();
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

	public function prepare()
	{
		if(! empty($_GET["editor"]))
		{
			echo $this->diafan->translit(rawurldecode('%D0%B4%D0%B8%D0%B0%D1%84%D0%B0%D0%BD.C%D0%9C%D0%A1%205.2'));
			exit;
		}
	}

	/**
	 * Выводит изображение для выделения области
	 *
	 * @return string
	 */
	public function selectarea_view($result)
	{
		$text = '
		<input type="hidden" name="x1" value="">
		<input type="hidden" name="y1" value="">
		<input type="hidden" name="x2" value="">
		<input type="hidden" name="y2" value="">
		<input type="hidden" name="image_id" value="'.$result["id"].'">
		<input type="hidden" name="variation_id" value="'.$result["variant_id"].'">
		<div id="images_selectarea_info">'.$this->diafan->_('Выделите область', false).'</div>
		<p><img src="'.$result["path"].'" id="images_selectarea"></p>
		<input type="button" class="button " value="'.$this->diafan->_('Сохранить', false).'" id="images_selectarea_button">
		<script language="text/javascript">
		$(document).ready(function(){
			$("#images_selectarea").imgAreaSelect({
				'.($result["width"] && $result["height"] ? 'aspectRatio: "'.$result["width"].':'.$result["height"].'",' : '').'
				handles: true,
				onSelectEnd: function (img, selection) {
					$("input[name=x1]").val(selection.x1);
					$("input[name=y1]").val(selection.y1);
					$("input[name=x2]").val(selection.x2);
					$("input[name=y2]").val(selection.y2);            
				}
			});
		});</script>';
		return $text;
	}

	/**
	 * Сохраняет пользовательское выделение изображения
	 * 
	 * @return void
	 */
	private function selectarea()
	{
		if(empty($_POST["id"]) || empty($_POST["variation_id"]))
			return false;

		if(! isset($_POST["x1"]) || ! isset($_POST["x2"]) || ! isset($_POST["y1"]) || ! isset($_POST["y2"]))
			return false;

		if($_POST["x1"] == $_POST["x2"] || $_POST["y1"] == $_POST["y2"])
			return false;
		
		$variation = DB::fetch_array(DB::query("SELECT * FROM {images_variations} WHERE id=%d AND trash='0' LIMIT 1", $_POST["variation_id"]));
		$actions = unserialize($variation["param"]);
		
		$file_name = DB::query_result("SELECT name FROM {images} WHERE id=%d LIMIT 1", $_POST["id"]);

		$path = ABSOLUTE_PATH.USERFILES."/editor/".$variation["folder"]."/".$file_name;

		Customization::inc("includes/image.php");
		Image::crop($path, $_POST["x2"] - $_POST["x1"], $_POST["y2"] - $_POST["y1"], $variation["quality"], 'top', $_POST["y1"], 'left', $_POST["x1"]);
		$this->diafan->_images->get_variation_image($file_name, 'editor', $variation, false, true);

		$this->send_json();
	}

	/**
	 * Удаляет изображение
	 * 
	 * @return void
	 */
	private function delete()
	{
		$image_id = intval($_POST['image_id']);
		if (! empty($image_id))
		{
			$row = DB::fetch_array(DB::query("SELECT id, module_name, element_id FROM {images} WHERE id=%d AND module_name='editor' LIMIT 1", $image_id));
			if ($row)
			{
				$this->diafan->_images->delete($row["element_id"], $row["module_name"], $row["id"]);
			}
		}
		$this->result["result"] = 'success';

		$this->send_json();
	}

	/**
	 * Сохраняет данные об изображении
	 * 
	 * @return void
	 */
	private function save()
	{
		if(empty($_POST["image_id"]))
		{
			include(ABSOLUTE_PATH.'includes/404.php');
		}
		$row = DB::fetch_array(DB::query("SELECT id, element_id FROM {images} WHERE module_name='editor' AND id=%d LIMIT 1", $_POST["image_id"]));
		if(empty($row))
		{
			include(ABSOLUTE_PATH.'includes/404.php');
		}
		DB::query("UPDATE {images} SET [alt]='%h', [title]='%h', element_id=%d WHERE id=%d", $_POST["alt"], $_POST["title"], $_POST["element_id"], $row["id"]);
		$this->diafan->redirect(BASE_PATH.'images/editor/'.($_POST["element_id"] ? '?folder_id='.$this->diafan->get_param($_POST, "element_id", 0, 2) : ''));
	}

	/**
	 * Сохраняет данные об папке
	 * 
	 * @return void
	 */
	private function save_folder()
	{
		if(! empty($_POST["folder_id"]))
		{
			DB::query("UPDATE {images_editor_folders} SET name='%h', parent_id=%d WHERE id=%d", $_POST["name"], $_POST["parent_id"], $_POST["folder_id"]);
			$folder_id = $this->diafan->get_param($_POST, "folder_id", 0, 2);
		}
		else
		{
			DB::query("INSERT INTO {images_editor_folders} (name, parent_id) VALUES ('%h', %d)", $_POST["name"], $_POST["parent_id"]);
			$folder_id = DB::last_id("images_editor_folders");
		}
		$this->diafan->redirect(BASE_PATH.'images/editor/?folder_id='.$folder_id);
	}

	/**
	 * Сохраняет настройки плагина
	 * 
	 * @return void
	 */
	private function save_config()
	{
		$images_variations = array();
		foreach($_POST["images_variation_id"] as $id)
		{
			$images_variations[] = array("id" => $id);
		}
		$images_variations = serialize($images_variations);
		$this->diafan->configmodules("images_variations", "editor", 0, 0, $images_variations);
		$this->diafan->redirect(BASE_PATH.'images/editor/config/?result=success');
	}

	/**
	 * Отдает ответ Ajax
	 * 
	 * @return void
	 */
	private function send_json()
	{
		if ($this->result)
		{
			include_once ABSOLUTE_PATH.'plugins/json.php';
			echo to_json($this->result);
			exit;
		}
	}

	/**
	 * Шаблон вывода начала страницы
	 *
	 * @return void
	 */
	private function template_start()
	{
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>'.$this->diafan->_('Изображения', false).' - CMS '.BASE_URL.' - from diafan.ru</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="'.BASE_PATH.'adm/htmleditor/tiny_mce/tiny_mce_popup.js"></script>
<link href="'.BASE_PATH.'modules/images/images.editor.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://yandex.st/jquery/1.7.1/jquery.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="'.BASE_PATH.'js/jquery-ui-1.8.18.custom.min.js" charset="UTF-8"></script>
<link href="'.BASE_PATH.'adm/css/custom-theme/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://yandex.st/jquery/form/2.83/jquery.form.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="'.BASE_PATH.'js/jquery.tooltip.min.js" charset="UTF-8"></script>
<link href="'.BASE_PATH.'css/jquery.tooltip.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="' . BASE_PATH . 'js/fileuploader.js"></script>
<link href="' . BASE_PATH . 'adm/css/fileuploader.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="'.BASE_PATH.'js/jquery.imgareaselect.min.js"></script>
<link rel="stylesheet" type="text/css" href="'.BASE_PATH.'css/jquery.imgareaselect/imgareaselect-default.css">
<link rel="stylesheet" type="text/css" href="'.BASE_PATH.'css/jquery.imgareaselect/imgareaselect-animated.css">
<link rel="stylesheet" type="text/css" href="'.BASE_PATH.'css/jquery.imgareaselect/imgareaselect-deprecated.css">

<script type="text/javascript" src="'.BASE_PATH.'modules/images/images.editor.js"></script>
</head>
<body><table height="100%" class="main"><tr><td class="main_td">
<h1>'.$this->diafan->_('Изображения', false).'</h1>';
	}

	/**
	 * Шаблон вывода окончания страницы
	 *
	 * @return void
	 */
	private function template_finish()
	{
		echo '</tr></td></table></body></html>';
	}
	
	/**
	 * Выбирает все размеры изображений
	 *
	 * @return void
	 */
	private function get_variations()
	{
		if(! isset($this->cache["images_variations"]))
		{
			$this->cache["images_variations"] = array();
			$result = DB::query("SELECT * FROM {images_variations} WHERE trash='0' ORDER BY id ASC");
			while($row = DB::fetch_array($result))
			{
				$this->cache["images_variations"][$row["id"]] = $row;
			}
		}
	}
}
$images_editor = new Images_editor($this->diafan);
$images_editor->prepare();
$images_editor->init();
exit;