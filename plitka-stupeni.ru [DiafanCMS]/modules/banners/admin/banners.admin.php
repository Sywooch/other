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
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

/**
 * Banners_admin
 *
 * Редактирование баннеров
 */
class Banners_admin extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'banners';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Название',
			),
			'created' => array(
				'type' => 'date',
				'name' => 'Дата',
				'help' => 'Вводится в формате дд.мм.гггг чч:мм',
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'default' => true,
				'multilang' => true,
			),
			'count_view' => array(
				'type' => 'numtext',
				'name' => 'Всего показов',
				'help' => 'Статистика прошедших показов баннера',
				'disabled' => true,
			),
			'click' => array(
				'type' => 'numtext',
				'name' => 'Всего кликов',
				'help' => 'Статистика прошедших кликов по баннеру',
				'disabled' => true,
			),
			'hr1' => 'hr',
			'file' => array(
				'type' => 'function',
			),
			'link' => array(
				'type' => 'text',
				'name' => 'Ссылка',
				'help' => 'В полном формате http://www.site.ru/',
			),
			'target_blank' => array(
				'type' => 'checkbox',
				'name' => 'Открывать в новом окне',
			),
			'hr2' => 'hr',
			'date_start' => array(
				'type' => 'datetime',
				'name' => 'Период показа',
				'help' => 'Время, в течение которого будет показываться баннер',
			),
			'date_finish' => array(
				'type' => 'datetime',
			),
			'check_number' => array(
				'type' => 'checkbox',
				'name' => 'Ограничить количество показов',
			),
			'show_number' => array(
				'type' => 'numtext',
				'name' => 'Осталось показов',
				'help' => 'Укажите число, сколько раз должен показываться баннер. С каждым показом цифра в этом поле будет уменьшаться, пока не станет 0 (или пустое поле)',
			),
			'check_click' => array(
				'type' => 'checkbox',
				'name' => 'Ограничить количество показов по кликам',
			),
			'show_click' => array(
				'type' => 'numtext',
				'name' => 'Осталось кликов',
				'help' => 'Укажите число, обозначающее, через какое количество кликов скрыть отображение баннера. С каждым кликом цифра в этом поле будет уменьшаться, пока не станет 0 (или пустое поле)',
			),
			'check_user' => array(
				'type' => 'checkbox',
				'name' => 'Ограничить количество показов посетителю в сутки',
			),
			'show_user' => array(
				'type' => 'numtext',
				'name' => 'Количество показов посетителю в сутки',
				'help' => 'Сколько раз показывать баннер одному пользователю (счетчик сохраняется в сессии)',
			),
			'hr3' => 'hr',
			'site_ids' => array(
				'type' => 'function',
				'name' => 'Раздел сайта',
			),
			'number' => array(
				'type' => 'function',
				'name' => 'Номер',
				'help' => 'Номер элемента в БД. (для разработчиков)',
			),
			'cat_id' => array(
				'type' => 'function',
				'name' => 'Категория',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'act', // показать/скрыть
		'del', // удалить
		'element', // используются группы
		'search_name', // скать по названию
		'trash', // использовать корзину
		'category_flat', // категори не содержат вложенности
		'category_no_multilang', // название категории не переводиться
	);

	/**
	 * @var array зависимости между полями
	 */
	public $show_tr_click_checkbox = array(
		'check_user' => array(
			'show_user',
		),
		'check_number' => array(
			'show_number',
		),
		'check_click' => array(
			'show_click',
		),
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array (
		'count_view' => 'function', 
		'show_number' => 'function', 
		'click' => 'function',
		'show_click' => 'function', 
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		if(! $this->diafan->configmodules("cat", "banners", $this->diafan->site))
		{
			$this->diafan->config("element", false);
		}
	}

	/**
	 * Выводит список баннеров
	 * @return void
	 */
	public function show()
	{	
		if ($this->diafan->config('element') && ! $this->diafan->not_empty_categories)
		{
			echo '<div class="error">'.sprintf($this->diafan->_('В %sнастройках%s модуля подключены категории, чтобы начать добавлять баннеры создайте хотя бы одну %sкатегорию%s.'), '<a href="'.BASE_PATH_HREF.'banners/config/">', '</a>','<a href="'.BASE_PATH_HREF.'banners/category/'.($this->diafan->site ? 'site'.$this->diafan->site.'/' : '').'">', '</a>').'</div>';
		}
		else
		{
			$this->diafan->addnew_init('Добавить баннер');
		}

		$this->diafan->list_row();
	}

	/**
	 * Выводит количество просмотров баннера
	 *
	 * @return string
	 */
	public function other_row_count_view($row)
	{
		return '<td width="10%">'.$this->diafan->_('всего показов').': '.$row["count_view"].'</td>';
	}
	
	/**
	 * Выводит количество оставшихся просмотров баннера
	 *
	 * @return string
	 */
	public function other_row_show_number($row)
	{
		if(DB::query_result("SELECT check_number FROM {banners} WHERE id=%d", $row['id']))
		{
		    return '<td width="10%">'.$this->diafan->_('осталось показов').': '.$row["show_number"].'</td>';
		}
		else
		{
		    return '<td width="2%">&nbsp;</td>';
		}
		
	}	

	/**
	 * Выводит количество кликов баннера
	 *
	 * @return string
	 */
	public function other_row_click($row)
	{
		return '<td width="10%">'.$this->diafan->_('кликов').': '.$row["click"].'</td>';
	}
	
	/**
	 * Выводит количество оставшихся кликов баннера
	 *
	 * @return string
	 */
	public function other_row_show_click($row)
	{
		if(DB::query_result("SELECT check_click FROM {banners} WHERE id=%d", $row['id']))
		{
		    return '<td width="10%">'.$this->diafan->_('осталось кликов').': '.$row["show_click"].'</td>';
		}
		else
		{
		    return '<td width="2%">&nbsp;</td>';
		}
		
	}

	/**
	* Редактирование поля "Файл"
	* @return boolean true
	*/
	public function edit_variable_file()
	{
		if(empty($this->diafan->values["type"]))
		{
			$this->diafan->values["type"] = 1;
		}
		echo '
		<tr>
			<td align="right">'.$this->diafan->_('Вид баннера').'</td>
			<td>';
		echo '
		<input type="radio" name="type" value="1"'.($this->diafan->values["type"] == 1 ? ' checked' : '').'> '.$this->diafan->_('Изображение').'
		<input type="radio" name="type" value="2"'.($this->diafan->values["type"] == 2 ? ' checked' : '').'> '.$this->diafan->_('Флэш').'
		<input type="radio" name="type" value="3"'.($this->diafan->values["type"] == 3 ? ' checked' : '').'> HTML

		<div class="type1'.($this->diafan->values["type"] == 1 ? '' : ' hide').'">
			<input type="file" name="attachment_img">
			<br>
			'.($this->diafan->values["type"] == 1 && !empty($this->diafan->values["file"]) ? $this->diafan->values["file"] : '').'
			<div style="padding: 8px 0 0 0;">
				<input type="text" class="inptext" name="alt" size="10" value="'.(!empty($this->diafan->values["alt"._LANG]) ? $this->diafan->values["alt"._LANG] : '').'">
				alt
			</div>
			<div style="padding: 8px 0 0 0;">
				<input type="text" class="inptext" name="title" size="10" value="'.(!empty($this->diafan->values["title"._LANG]) ? $this->diafan->values["title"._LANG] : '').'">
				title
			</div>
		</div>

		<div class="type2'.($this->diafan->values["type"] == 2 ? '' : ' hide').'">
			<input type="file" name="attachment_swf">
			<br>
			'.( $this->diafan->values["type"] == 2 && !empty($this->diafan->values["file"]) ? $this->diafan->values["file"] : '').'
			<div style="padding: 8px 0 0 0;">
				<input type="text" class="inpnum" name="width" size="3" value="'.(! empty($this->diafan->values["width"]) ? $this->diafan->values["width"] : '').'">
				x <input type="text" class="inpnum" name="height" size="3" value="'.(! empty($this->diafan->values["height"]) ? $this->diafan->values["height"] : '').'">
				('.$this->diafan->_('Ширина').' x '.$this->diafan->_('Высота').')
			</div>
		</div>

		<div class="type3'.($this->diafan->values["type"] == 3 ? '' : ' hide').'"><textarea rows="5" cols="60" name="html">'.(! empty($this->diafan->values["html"]) ? $this->diafan->values["html"] : '').'</textarea></div>
                </td>
		</tr>';
	}

	/**
	 * Сохранение поля "Файл"
	 * @return void
	 */
	public function save_variable_file()
	{
		if($_POST['type'] == 1)
		{
			if (!empty($_FILES["attachment_img"]['name']))
			{
				$extension_array = array('jpg', 'jpeg', 'gif','png');

				$new_name = strtolower($this->diafan->translit($_FILES["attachment_img"]['name']));
				$extension = substr(strrchr($new_name, '.'), 1);
				if (!in_array($extension, $extension_array))
				{
					throw new Exception('Не удалось загрузить файл. Возможно, закрыт доступ к папке или файл превышает максимально допустимый размер');
				}

				$new_name = substr($new_name, 0, - (strlen($extension) + 1)).'_'.$this->diafan->save.'.'.$extension;

				$file_name = DB::query_result("SELECT file FROM {banners} WHERE id=%d LIMIT 1", $this->diafan->save);

				if (!empty($file_name))
				{
					if (file_exists(ABSOLUTE_PATH.USERFILES.'/'.$this->diafan->table.'/'.$file_name))
					{
						unlink(ABSOLUTE_PATH.USERFILES.'/'.$this->diafan->table.'/'.$file_name);
					}
				}

				if (! move_uploaded_file($_FILES["attachment_img"]['tmp_name'], ABSOLUTE_PATH.USERFILES."/banners/".$new_name))
				{
					throw new Exception('Не удалось загрузить файл '.ABSOLUTE_PATH.USERFILES."/".$this->diafan->table."/".$new_name.'. Возможно, закрыт доступ к папке или файл превышает максимально допустимый размер');
				}

				$this->diafan->set_query("file='%s'");
				$this->diafan->set_value($new_name);

				$this->diafan->set_query("html='%s'");
				$this->diafan->set_value('');

				$this->diafan->set_query("width='%d'");
				$this->diafan->set_value('');

				$this->diafan->set_query("height='%d'");
				$this->diafan->set_value('');
			}

			$this->diafan->set_query("type=%d");
			$this->diafan->set_value(1);

			$this->diafan->set_query("alt"._LANG."='%s'");
			$this->diafan->set_value($_POST['alt']);

			$this->diafan->set_query("title"._LANG."='%s'");
			$this->diafan->set_value($_POST['title']);
		}

		if($_POST['type'] == 2)
		{
			if( !empty($_FILES["attachment_swf"]['name']))
			{
				$extension_array = array('swf');
				$new_name = strtolower($this->diafan->translit($_FILES["attachment_swf"]['name']));
				$extension = substr(strrchr($new_name, '.'), 1);
				if (! in_array($extension, $extension_array))
				{
					echo '
					<script language="javascript" type="text/javascript">
						alert(\'' . $this->diafan->_('Не удалось загрузить файл. Возможно, закрыт доступ к папке или файл превышает максимально допустимый размер'). '\');
						window.location="' . BASE_PATH_HREF . $this->diafan->rewrite . '/' . ( $this->diafan->cat ? 'cat' . $this->diafan->cat . '/' : '' ) . ( $_POST["id"] ? 'edit' . $_POST["id"] . '/' : 'addnew1/' ) . '";
					</script>';
					exit;
				}

				$new_name = substr($new_name, 0, - (strlen($extension) + 1)).'_'.$this->diafan->save.'.'.$extension;

				$file_name = DB::query_result("SELECT file FROM {banners} WHERE id=%d LIMIT 1", $this->diafan->save);

				if (!empty($file_name))
				{
					if (file_exists(ABSOLUTE_PATH.USERFILES.'/'.$this->diafan->table.'/'.$file_name))
					{
						unlink(ABSOLUTE_PATH.USERFILES.'/'.$this->diafan->table.'/'.$file_name);
					}
				}

				if (! move_uploaded_file($_FILES["attachment_swf"]['tmp_name'], ABSOLUTE_PATH.USERFILES."/".$this->diafan->table."/".$new_name))
				{
					throw new Exception('Не удалось загрузить файл. Возможно, закрыт доступ к папке или файл превышает максимально допустимый размер');
				}

				$this->diafan->set_query("file='%s'");
				$this->diafan->set_value($new_name);

				$this->diafan->set_query("html='%s'");
				$this->diafan->set_value('');

				$this->diafan->set_query("alt"._LANG."='%s'");
				$this->diafan->set_value('');

				$this->diafan->set_query("title"._LANG."='%s'");
				$this->diafan->set_value('');
			}

			$this->diafan->set_query("type='%d'");
			$this->diafan->set_value(2);

			$this->diafan->set_query("width='%d'");
			$this->diafan->set_value($_POST['width']);

			$this->diafan->set_query("height='%d'");
			$this->diafan->set_value($_POST['height']);
		}

		if($_POST['type'] == 3)
		{
			if (!empty($_POST['html']))
			{
				$file_name = DB::query_result("SELECT file FROM {banners} WHERE id=%d LIMIT 1", $this->diafan->save);

				if (!empty($file_name))
				{
					if (file_exists(ABSOLUTE_PATH.USERFILES.'/'.$this->diafan->table.'/'.$file_name))
					{
						unlink(ABSOLUTE_PATH.USERFILES.'/'.$this->diafan->table.'/'.$file_name);
					}
				}

				$this->diafan->set_query("html='%s'");
				$this->diafan->set_value($_POST['html']);

				$this->diafan->set_query("file='%s'");
				$this->diafan->set_value('');

				$this->diafan->set_query("alt"._LANG."='%s'");
				$this->diafan->set_value('');

				$this->diafan->set_query("title"._LANG."='%s'");
				$this->diafan->set_value('');

				$this->diafan->set_query("width='%d'");
				$this->diafan->set_value('');

				$this->diafan->set_query("height='%d'");
				$this->diafan->set_value('');
			}

			$this->diafan->set_query("type='%d'");
			$this->diafan->set_value(3);
		}
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("banners_site_rel", "element_id=".$del_id, $trash_id);
	}
}