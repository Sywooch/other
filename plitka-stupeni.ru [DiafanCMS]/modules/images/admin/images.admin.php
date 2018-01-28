<?php

/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN')) {
    include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

/**
 * Images_admin
 *
 * Варианты изображений
 */
class Images_admin extends Frame_admin
{
    /**
     * @var string таблица в базе данных
     */
    public $table = 'images_variations';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Название',
			),
			'folder' => array(
				'type' => 'text',
				'name' => 'Папка',
				'help' => 'Название каталога, куда будут загружаться обработанные изображения (латинскими буквами)',
			),
			'quality' => array(
				'type' => 'numtext',
				'name' => 'Качество',
				'default' => 80,
			),
			'actions' => array(
				'type' => 'function',
				'name' => 'Метод генерации',
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
	 * var array локальный кэш подключения
	 */
	private $cache;

	/**
	 * Выводит список вариантов
	 * @return void
	 */
	public function show()
	{
		if (! extension_loaded('gd'))
		{
			echo '<div class="error">'.$this->diafan->_('Внимание! Не установлена библиотека GD. Работа модуля ограничена. Обратитесь в техподдержку вашего хостинга!').'</div>';
		}
		$this->diafan->addnew_init('Добавить вариант');
		$this->diafan->list_row();
	}

	/**
	 * Проверяет можно ли удалить текущий элемент строки
	 *
	 * @param array $row информация о текущем элменте списка
	 * @return boolean
	 */
	public function check_delete($row)
	{
		if(! isset($this->cache['images_variation_cache_config']))
		{
			$this->cache['images_variation_cache_config'] = array();
			$result = DB::query("SELECT value FROM {config} WHERE name='images_variations' OR name='images_variations_cat'");
			while($r = DB::fetch_array($result))
			{
				$vs = unserialize($r["value"]);
				foreach($vs as $v)
				{
					if(! in_array($v["id"], $this->cache['images_variation_cache_config']))
					{
						$this->cache['images_variation_cache_config'][] = $v["id"];
					}
				}
			}
		}
		// нельзя удалить размер, который используется в настройках модуля
		if(in_array($row["id"], $this->cache['images_variation_cache_config']))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	/**
	 * Редактирование поля "Действия"
	 * 
	 * @return void
	 */
	public function edit_variable_actions()
	{
		$params = array();
		if(! $this->diafan->addnew)
		{
			$params = unserialize($this->diafan->values["param"]);
		}
		echo '
		<script type="text/javascript" src="'.BASE_PATH.'modules/images/admin/images.admin.js"></script>

		<tr valign="top">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>';
				foreach($params as $i => $param)
				{
					$this->get_action($param, $i);
				}
				if(empty($params))
				{
					$this->get_action();
				}
				echo '<a href="javascript:void(0)" class="images_action_plus" title="'.$this->diafan->_('Добавить').'"><img src="'.BASE_PATH.'adm/img/add.png" width="16" height="16" alt="'.$this->diafan->_('Добавить').'"></a>
			</td>
		</tr>';
	}

	private function get_action($value = '', $i = 0)
	{
		echo '
		<div class="images_action">
			<a href="javascript:void(0)" confirm="'.$this->diafan->_('Вы действительно хотите удалить действие?').'" class="images_action_delete"><img src="'.BASE_PATH.'adm/img/delete.png" width="13" height="13" alt="'.$this->diafan->_('Удалить').'"></a>
			<input name="i[]" value="'.$i.'" type="hidden">
			<div id="images_action_'.$i.'" class="images_action_container">
			<select name="actions[]">
			<option value="resize"'.(! empty($value["name"]) && $value["name"] == 'resize' ? ' selected' : '').'>изменить пропорционально</option>
			<option value="selectarea"'.(! empty($value["name"]) && $value["name"] == 'selectarea' ? ' selected' : '').'>выделить область</option>
			<option value="crop"'.(! empty($value["name"]) && $value["name"] == 'crop' ? ' selected' : '').'>обрезать</option>
			<option value="wb"'.(! empty($value["name"]) && $value["name"] == 'wb' ? ' selected' : '').'>обесцветить</option>
			<option value="watermark"'.(! empty($value["name"]) && $value["name"] == 'watermark' ? ' selected' : '').'>наложить водяной знак</option>
			</select>';

			$width   = (! empty($value["name"]) && $value["name"] == 'resize' ? $value["width"]   : '');
			$height  = (! empty($value["name"]) && $value["name"] == 'resize' ? $value["height"]  : '');
			$max     = (! empty($value["name"]) && $value["name"] == 'resize' ? $value["max"]     : false);

			echo '<div class="images_param images_param_resize">
				<p>'.$this->diafan->_('Размер').'
				<input type="text" name="resize_width[]" size="3" value="'.$width.'" class="inpnum"> x
				<input type="text" name="resize_height[]" size="3" value="'.$height.'" class="inpnum">
				'.$this->diafan->help("Размер, до которого изоражение будет автоматически изменяться после загрузки").'</p>
				<p><input type="checkbox" name="resize_max[]" value="1"'.($max ? ' checked' : '').'>
				'.$this->diafan->_('Уменьшение по меньшей стороне').'</p>
			</div>';

			$width   = (! empty($value["name"]) && $value["name"] == 'selectarea' ? $value["width"]   : '');
			$height  = (! empty($value["name"]) && $value["name"] == 'selectarea' ? $value["height"]  : '');

			echo '<div class="images_param images_param_selectarea">
				<p>'.$this->diafan->_('Пропорционально размеру').'
				<input type="text" name="selectarea_width[]" size="3" value="'.$width.'" class="inpnum"> x
				<input type="text" name="selectarea_height[]" size="3" value="'.$height.'" class="inpnum"></p>
			</div>';

			$width   = (! empty($value["name"]) && $value["name"] == 'crop' ? $value["width"]   : '');
			$height  = (! empty($value["name"]) && $value["name"] == 'crop' ? $value["height"]  : '');
			$vertical      = (! empty($value["name"]) && $value["name"] == 'crop' ? $value["vertical"]       : '');
			$vertical_px   = (! empty($value["name"]) && $value["name"] == 'crop' ? $value["vertical_px"]    : '');
			$horizontal    = (! empty($value["name"]) && $value["name"] == 'crop' ? $value["horizontal"]     : '');
			$horizontal_px = (! empty($value["name"]) && $value["name"] == 'crop' ? $value["horizontal_px"]  : '');

			echo '<div class="images_param images_param_crop">
				<p>'.$this->diafan->_('Размер').'
				<input type="text" name="crop_width[]" size="3" value="'.$width.'" class="inpnum"> x
				<input type="text" name="crop_height[]" size="3" value="'.$height.'" class="inpnum"></p>

				<p><select name="crop_vertical[]">
					<option value="top"'.($vertical == 'top' ? ' selected' : '').'>'.$this->diafan->_('сверху').'</option>
					<option value="middle"'.($vertical == 'middle' ? ' selected' : '').'>'.$this->diafan->_('от центра').'</option>
					<option value="bottom"'.($vertical == 'bottom' ? ' selected' : '').'>'.$this->diafan->_('снизу').'</option>
				</select>
				<input type="text" name="crop_vertical_px[]" size="3" value="'.$vertical_px.'" class="inpnum"> px
				<select name="crop_horizontal[]">
					<option value="left"'.($horizontal == 'left' ? ' selected' : '').'>'.$this->diafan->_('слева').'</option>
					<option value="center"'.($horizontal == 'cetner' ? ' selected' : '').'>'.$this->diafan->_('от центра').'</option>
					<option value="right"'.($horizontal == 'right' ? ' selected' : '').'>'.$this->diafan->_('справа').'</option>
				</select>
				<input type="text" name="crop_horizontal_px[]" size="3" value="'.$horizontal_px.'" class="inpnum"> px
				</p>
			</div>';

			$vertical      = (! empty($value["name"]) && $value["name"] == 'watermark' ? $value["vertical"]       : '');
			$vertical_px   = (! empty($value["name"]) && $value["name"] == 'watermark' ? $value["vertical_px"]    : '');
			$horizontal    = (! empty($value["name"]) && $value["name"] == 'watermark' ? $value["horizontal"]     : '');
			$horizontal_px = (! empty($value["name"]) && $value["name"] == 'watermark' ? $value["horizontal_px"]  : '');
			$file          = (! empty($value["name"]) && $value["name"] == 'watermark' ? $value["file"]  : '');

			echo '<div class="images_param images_param_watermark">
				<p>'.($file ? '<img src="'.BASE_PATH.USERFILES.'/watermark/'.$file.'"><br>' : '').'
				<input type="file" name="watermark_file_'.$i.'" size="40"></p>
				<p>
				<select name="watermark_vertical[]">
					<option value="top"'.($vertical == 'top' ? ' selected' : '').'>'.$this->diafan->_('сверху').'</option>
					<option value="middle"'.($vertical == 'middle' ? ' selected' : '').'>'.$this->diafan->_('от центра').'</option>
					<option value="bottom"'.($vertical == 'bottom' ? ' selected' : '').'>'.$this->diafan->_('снизу').'</option>
				</select>
				<input type="text" name="watermark_vertical_px[]" size="3" value="'.$vertical_px.'" class="inpnum"> px
				<select name="watermark_horizontal[]">
					<option value="left"'.($horizontal == 'left' ? ' selected' : '').'>'.$this->diafan->_('слева').'</option>
					<option value="center"'.($horizontal == 'cetner' ? ' selected' : '').'>'.$this->diafan->_('от центра').'</option>
					<option value="right"'.($horizontal == 'right' ? ' selected' : '').'>'.$this->diafan->_('справа').'</option>
				</select>
				<input type="text" name="watermark_horizontal_px[]" size="3" value="'.$horizontal_px.'" class="inpnum"> px</p>
			</div>
			</div>
			<hr>
		</div>';
	}

	/**
	 * Валидация поля "Действия"
	 * 
	 * @return void
	 */
	public function validate_variable_actions()
	{
		if(! empty($_POST["i"]))
		{
			foreach($_POST["i"] as $i => $k)
			{
				$mes = '';
				switch($_POST["actions"][$i])
				{
					case 'resize':
						$mes = Validate::numtext($_POST["resize_width"][$i]);
						if(! $mes)
						{
							$mes = Validate::numtext($_POST["resize_height"][$i]);
						}
						break;

					case 'selectarea':
						$mes = Validate::numtext($_POST["selectarea_width"][$i]);
						if(! $mes)
						{
							$mes = Validate::numtext($_POST["selectarea_height"][$i]);
						}
						break;

					case 'crop':
						if(! $_POST["crop_width"][$i] || ! $_POST["crop_height"][$i])
						{
							$mes = 'Задайте размер обрезаемой области';
						}
						if(! $mes)
						{
							$mes = Validate::numtext($_POST["crop_width"][$i]);
						}
						if(! $mes)
						{
							$mes = Validate::numtext($_POST["crop_height"][$i]);
						}
						if(! $mes)
						{
							$mes = Validate::numtext($_POST["crop_vertical_px"][$i]);
						}
						if(! $mes)
						{
							$mes = Validate::numtext($_POST["crop_horizontal_px"][$i]);
						}
						break;

					case 'wb':
						break;

					case 'watermark':
						$mes = Validate::numtext($_POST["watermark_vertical_px"][$i]);
						if(! $mes)
						{
							$mes = Validate::numtext($_POST["watermark_horizontal_px"][$i]);
						}
						if(! $mes)
						{
							if(! $this->diafan->addnew)
							{
								$oldparam = unserialize(DB::query_result("SELECT param FROM {images_variations} WHERE id=%d LIMIT 1", $this->diafan->edit));
							}
							$oldfile = ! empty($oldparam[$k]["file"]) ? $oldparam[$k]["file"] : '';
							$mes = $this->validate_watermark($i, $k, $oldfile);
						}
						break;
				}
				if($mes)
				{
					$this->diafan->set_error("images_action_".$i, $mes);
				}
			}
		}
	}

	/**
	 * Валидация файла водяного знака
	 * 
	 * @return void
	 */
	private function validate_watermark($i, $k, $oldfile)
	{
		$mes = '';
		if(empty($_FILES["watermark_file_".$k]['tmp_name']) || empty($_FILES["watermark_file_".$k]['name']))
		{
			if(! $oldfile)
			{
				$mes = 'Вы забыли добавить файл для загрузки';
			}
		}
		else
		{
			$info = @getimagesize($_FILES["watermark_file_".$k]['tmp_name']);
			$mimes = array(
				'image/gif',
				'image/jpeg',
				'image/png',
				'image/pjpeg',
				'image/x-png'
			);
			if(empty($info['mime']) || ! in_array($info['mime'], $mimes))
			{
				$mes = 'Доступны только следующие типы файлов: gif, jpeg, jpg, jpe, png';
			}
		}
		return $mes;
	}

	/**
	 * Сохранение поля "Действия"
	 * 
	 * @return void
	 */
	public function save_variable_actions()
	{
		if(! $this->diafan->savenew)
		{
			$oldparam = unserialize($this->diafan->oldrow["param"]);
		}
		$param_actions = array();
		if(! empty($_POST["i"]))
		{
			foreach($_POST["i"] as $i => $k)
			{
				switch($_POST["actions"][$i])
				{
					case 'resize':
						$param = array(
							"name" => $_POST["actions"][$i],
							"width" => $_POST["resize_width"][$i],
							"height" => $_POST["resize_height"][$i],
							"max" => ! empty($_POST["resize_max"][$i]) ? 1 : 0,
						);
						break;

					case 'selectarea':
						$param = array(
							"name" => $_POST["actions"][$i],
							"width" => $_POST["selectarea_width"][$i],
							"height" => $_POST["selectarea_height"][$i],
						);
						break;

					case 'crop':
						$param = array(
							"name" => $_POST["actions"][$i],
							"width" => $_POST["crop_width"][$i],
							"height" => $_POST["crop_height"][$i],
							"vertical" => $_POST["crop_vertical"][$i],
							"vertical_px" => $_POST["crop_vertical_px"][$i],
							"horizontal" => $_POST["crop_horizontal"][$i],
							"horizontal_px" => $_POST["crop_horizontal_px"][$i],
						);
						break;

					case 'wb':
						$param = array(
							"name" => $_POST["actions"][$i],
						);
						break;

					case 'watermark':
						$oldfile = ! empty($oldparam[$k]["file"]) ? $oldparam[$k]["file"] : '';
						$file = $this->upload_watermark($this->diafan->save, $i, $k, $oldfile);
						$param = array(
							"name" => $_POST["actions"][$i],
							"vertical" => $_POST["watermark_vertical"][$i],
							"vertical_px" => $_POST["watermark_vertical_px"][$i],
							"horizontal" => $_POST["watermark_horizontal"][$i],
							"horizontal_px" => $_POST["watermark_horizontal_px"][$i],
							"file" => $file,
						);
						$watermark_i[] = $k;
						break;

					default:
						$param = array();
				}
				if($_POST["actions"][$i] != 'watermark' && ! empty($oldparam[$k]["file"]))
				{
					unlink(ABSOLUTE_PATH.USERFILES.'/watermark/'.$oldparam[$k]["file"]);
				}
				$param_actions[] = $param;
			}
		}
		foreach($oldparam as $i => $param)
		{
			if($param["name"] == 'watermark' && (empty($watermark_i) || ! in_array($i, $watermark_i)))
			{
				unlink(ABSOLUTE_PATH.USERFILES.'/watermark/'.$param["file"]);
			}
		}
		$this->diafan->set_query("param='%s'");
		$this->diafan->set_value(serialize($param_actions));
	}

	/**
	 * Загружает водяной знак
	 * 
	 * @return void
	 */
	private function upload_watermark($id, $i, $k, $oldfile)
	{
		if(empty($_FILES["watermark_file_".$k]['tmp_name']) || empty($_FILES["watermark_file_".$k]['name']))
		{
			return $oldfile;
		}
		if($oldfile)
		{
			unlink(ABSOLUTE_PATH.USERFILES.'/watermark/'.$oldfile);
		}
		Customization::inc("includes/image.php");

		if (! is_dir(ABSOLUTE_PATH.USERFILES.'/watermark'))
		{
			mkdir(ABSOLUTE_PATH.USERFILES.'/watermark', 0777);
		}
		$info = @getimagesize($_FILES["watermark_file_".$k]['tmp_name']);
		$mimes = array(
			'image/gif' => 'gif',
			'image/jpeg' => 'jpeg',
			'image/png' => 'png',
			'image/pjpeg' => 'jpeg',
			'image/x-png'=> 'png'
		);
		$extension = $mimes[$info['mime']];

		$new_name = $id.'_'.$i.'.'.$extension;

		move_uploaded_file($_FILES["watermark_file_".$k]['tmp_name'], ABSOLUTE_PATH.USERFILES."/watermark/".$new_name);

		chmod(ABSOLUTE_PATH.USERFILES."/watermark/".$new_name, 0755);

		return $new_name;
	}
}