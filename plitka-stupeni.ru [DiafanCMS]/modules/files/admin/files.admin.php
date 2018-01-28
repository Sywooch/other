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
	include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

/**
 * Files_admin
 *
 * Редактирование файлов в файловом архиве
 */
class Files_admin extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'files';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'files' => array(
				'type' => 'function',
				'name' => 'Файл',
				'help' => 'Доступны следующие расширения файлов: %attachment_extensions',
			),
			'hr' => 'hr',
			'name' => array(
				'type' => 'text',
				'name' => 'Название',
				'multilang' => true,
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'default' => true,
				'multilang' => true,
			),
			'hr1' => 'hr',
			'images' => array(
				'type' => 'module',
				'name' => 'Изображения',
			),
			'hr2' => 'hr',
			'rel_elements' => array(
				'type' => 'function',
				'name' => 'Похожие файлы',
			),
			'hr_cat' => 'hr',
			'cat_id' => array(
				'type' => 'function',
				'name' => 'Категория',
			),
			'anons' => array(
				'type' => 'editor',
				'name' => 'Анонс',
				'multilang' => true,
				'height' => 200,
			),
			'text' => array(
				'type' => 'editor',
				'name' => 'Описание',
				'multilang' => true,
			),
			'search' => array(
				'type' => 'module',
			),
		),
		'other_rows' => array (
			'hr3' => 'hr',
			'tags' => array(
				'type' => 'module',
			),
			'hr5' => 'hr',
			'menu' => array(
				'type' => 'module',
				'name' => 'Создать пункт в меню',
			),
			'number' => array(
				'type' => 'function',
				'name' => 'Номер',
				'help' => 'Номер элемента в БД. (для разработчиков)',
			),
			'title_meta' => array(
				'type' => 'text',
				'name' => 'Заголовок окна в браузере, тэг Title',
				'help' => 'Если не заполнен, тег title будет автоматически сформирован как "Название страницы - Название сайта"',
				'multilang' => true,
			),
			'keywords' => array(
				'type' => 'text',
				'name' => 'Ключевые слова, тэг Keywords',
				'multilang' => true,
			),
			'descr' => array(
				'type' => 'textarea',
				'name' => 'Описание, тэг Description',
				'multilang' => true,
			),
			'rewrite' => array(
				'type' => 'function',
				'name' => 'Псевдоссылка',
				'help' => 'ЧПУ (человеко-понятные урл url), адрес страницы вида: site.ru/psewdossylka/. Смотрите настройки сайта',
			),
			'changefreq'   => array(
				'type' => 'function',
				'name' => 'Changefreq',
				'help' => 'Атрибут для sitemap.xml',
			),
			'priority'   => array(
				'type' => 'floattext',
				'name' => 'Priority',
				'help' => 'Атрибут для sitemap.xml',
			),
			'hr_map2' => 'hr',
			'access' => array(
				'type' => 'function',
				'name' => 'Доступ',
			),
			'date_start' => array(
				'type' => 'date',
				'name' => 'Период показа',
			),
			'date_finish' => array(
				'type' => 'date',
			),
			'hr_period' => 'hr',
			'site_id' => array(
				'type' => 'function',
				'name' => 'Раздел сайта',
			),
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
			'map_no_show' => array(
				'type' => 'checkbox',
				'name' => 'Не показывать на карте сайта',
			),
			'hr4' => 'hr',
			'counter_view' => array(
				'type' => 'function',
				'name' => 'Счетчик просмотров',
				'no_save' => true,
			),
			'comments' => array(
				'type' => 'module',
			),
			'rating' => array(
				'type' => 'module',
			),
			'hr_view' => 'hr',
			'theme' => array(
				'type' => 'function',
				'name' => 'Шаблон страницы',
			),
			'view' => array(
				'type' => 'function',
				'name' => 'Шаблон модуля',
			),
			'hr_info' => 'hr',
			'admin_id' => array(
				'type' => 'function',
				'name' => 'Редактор',
			),
			'timeedit' => array(
				'type' => 'text',
				'name' => 'Время последнего изменения',
				'help' => 'Изменяется после сохранения элемента. Отдается в заголовке Last Modify',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'act', // показать/скрыть
		'del', // удалить
		'order', // сортируется
		'menu', // используется в меню
		'element_site', // делит элементы по разделам (страницы сайта, к которым прикреплен модуль)
		'element', // используются группы
		'element_multiple', // модуль может быть прикреплен к нескольким группам
		'search_name', // скать по названию
		'trash', // использовать корзину
		'image', // показать фотографию в списке
		'only_self', // показывать только материалы редактора, если это задано в правах пользователя
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		if(! $this->diafan->configmodules("cat", "files", $this->diafan->site))
		{
			$this->diafan->config("element", false);
			$this->diafan->config("element_multiple", false);
		}
	}

	/**
	 * Выводит список файлов
	 * @return void
	 */
	public function show()
	{
		if ($this->diafan->config('element') && !$this->diafan->not_empty_categories)
		{
			echo '<div class="error">' . sprintf($this->diafan->_('В %sнастройках%s модуля подключены категории, чтобы начать добавлять файл создайте хотя бы одну %sкатегорию%s.'),'<a href="'.BASE_PATH_HREF.'files/config/">', '</a>', '<a href="' . BASE_PATH_HREF . 'files/category/' . ( $this->diafan->site ? 'site' . $this->diafan->site . '/' : '' ) . '">', '</a>') . '</div>';
		}
		else
		{
			$this->diafan->addnew_init('Добавить файл');
		}

		$this->diafan->list_row();
	}

	/**
	 * Выводит подсказки к полю (заменяет основную функцию)
	 * @return string
	 */
	public function help($key = '')
	{
		$text = parent::__call('help', array());
		$text = str_replace('%attachment_extensions', $this->diafan->configmodules('attachment_extensions'), $text);
		return $text;
	}

	/**
	 * Редактирование поля "Файлы"
	 * @return void
	 */
	public function edit_variable_files()
	{
		$file_type = 1;
		$this->diafan->values["link"] = '';
		echo '
		<tr>
			<td align="right">' . $this->diafan->variable_name() . '</td>
			<td>';
		if (!empty( $this->diafan->values["link"] ))
		{
			$file_type = 2;
		}
		else if(!$this->diafan->addnew)
		{
			$this->diafan->values["link"] = '';
			$result = DB::query("SELECT id,name FROM {attachments} WHERE module_name='" . $this->diafan->table . "' AND element_id='%d'", $this->diafan->edit);
			while ($row = DB::fetch_array($result))
			{
				echo '<input type="checkbox" name="filedel[]" value="' . $row["id"] . '" />
					<a href="' . BASE_PATH . 'attachments/get/' . $row["id"] . "/" . $row["name"] . '">' . $row["name"] . '</a><br>
					';
			}
		}
		echo '
		<input type="radio" name="file_type" value="1"' . ( $file_type == 1 ? ' checked' : '' ) . '> ' . $this->diafan->_('Загрузить файл') . '
		<input type="radio" name="file_type" value="2"> ' . $this->diafan->_('Загрузить файл по ссылке') . '
		<input type="radio" name="file_type" value="3"' . ( $file_type == 2 ? ' checked' : '' ) . '> ' . $this->diafan->_('Указать ссылку на файл') . '

			<div class="file_type1' . ( $file_type == 2 ? ' hide' : '' ) . '"><input type="file" name="attachment" size="40">' . $this->diafan->help() . '</div>
			<div class="file_type2 hide"><input type="text" name="attachment_link_upload" size="40" value="">' . $this->diafan->help() . '</div>
			<div class="file_type3' . ( $file_type == 1 ? ' hide' : '' ) . '"><input type="text" name="attachment_link" size="40" value="' . $this->diafan->values["link"] . '"></div>
			</td>
		</tr>';
	}

	/**
	 * Сохранение поля "Файлы"
	 * @return void
	 */
	public function save_variable_files()
	{
		$altname = str_replace('/', '_', strtolower(substr($this->diafan->translit($_POST["name"]), 0, 40)));

		$result = DB::query("SELECT id FROM {attachments} WHERE module_name='" . $this->diafan->table . "' AND element_id='%d'", $this->diafan->save);
		while ($row = DB::fetch_array($result))
		{
			if (!empty( $_POST["filedel"] ) && in_array($row["id"], $_POST["filedel"]))
			{
				DB::query("DELETE FROM {attachments} WHERE id='%d'", $row["id"]);
				unlink(ABSOLUTE_PATH . USERFILES . '/' . $this->diafan->table . '/files/' . $row["id"]);
			}
		}

		if (empty( $_POST["file_type"] ))
		{
			return;
		}
		if ($_POST["file_type"] == 1 && isset( $_FILES["attachment"] ) && is_array($_FILES["attachment"]) && $_FILES["attachment"]['name'] != '')
		{
			$oldid = DB::query_result("SELECT id FROM {attachments} WHERE module_name='%s' AND element_id=%d LIMIT 1", $this->diafan->table, $this->diafan->save);
			if ($oldid)
			{
				unlink(ABSOLUTE_PATH . USERFILES . '/' . $this->diafan->table . '/files/' . $oldid);
				DB::query("DELETE FROM {attachments} WHERE module_name='%s' AND element_id='%d'", $this->diafan->table, $this->diafan->save);
			}

			Customization::inc("modules/attachments/attachments.inc.php");
			if (!$this->diafan->save_site_id)
			{
				$this->diafan->get_site_id();
			}
			$config = array(
				"attachment_extensions" => $this->diafan->configmodules("attachment_extensions", 'files', $this->diafan->save_site_id),
				"recognize_image" => $this->diafan->configmodules("recognize_image", 'files', $this->diafan->save_site_id),
				"attachments_access_admin" => $this->diafan->configmodules("attachments_access_admin", 'files', $this->diafan->save_site_id),
				"attach_big_width" => $this->diafan->configmodules("attach_big_width", 'files', $this->diafan->save_site_id),
				"attach_big_height" => $this->diafan->configmodules("attach_big_height", 'files', $this->diafan->save_site_id),
				"attach_big_quality" => $this->diafan->configmodules("attach_big_quality", 'files', $this->diafan->save_site_id),
				"attach_medium_width" => $this->diafan->configmodules("attach_medium_width", 'files', $this->diafan->save_site_id),
				"attach_medium_height" => $this->diafan->configmodules("attach_medium_height", 'files', $this->diafan->save_site_id),
				"attach_medium_quality" => $this->diafan->configmodules("attach_medium_quality", 'files', $this->diafan->save_site_id),
			);

			$err = $this->diafan->_attachments->upload($_FILES['attachment'], $this->diafan->table, $this->diafan->save, false, $config);

			if (!empty( $err ))
			{
				throw new Exception($err);
			}

			$this->diafan->set_query("link='%h'");
			$this->diafan->set_value("");
		}
		if ($_POST["file_type"] == 2 && !empty( $_POST['attachment_link_upload'] ))
		{
			$oldid = DB::query_result("SELECT id FROM {attachments} WHERE module_name='%s' AND element_id=%d LIMIT 1", $this->diafan->table, $this->diafan->save);
			if ($oldid)
			{
				unlink(ABSOLUTE_PATH . USERFILES . '/' . $this->diafan->table . '/files/' . $oldid);
				DB::query("DELETE FROM {attachments} WHERE module_name='%s' AND element_id='%d'", $this->diafan->table, $this->diafan->save);
			}

			$extension = strtolower(substr(strrchr($_POST['attachment_link_upload'], '.'), 1));
			$name = $altname . '.' . $extension;

			if ($this->diafan->configmodules('attachment_extensions', 'files', $_POST["site_id"]) && !in_array($extension, explode(',', str_replace(' ', '', strtolower($this->diafan->configmodules('attachment_extensions', 'files', $_POST["site_id"]))))))
			{
				throw new Exception('Вы не можете отправить файл '.$name.'. Доступны только следующие типы файлов: '.$this->diafan->configmodules('attachment_extensions', 'files', $_POST["site_id"]).'. Новые типы файлов добавляются в настройках модуля.');
			}

			DB::query("INSERT INTO {attachments} (name,module_name,element_id) VALUES ('%s','%s','%d')", $name, $this->diafan->table, $this->diafan->save);
			$newid = DB::last_id("attachments");

			if(! $src = fopen($_POST['attachment_link_upload'], 'r'))
			{
				DB::query("DELETE FROM {attachments} WHERE id=%d", $newid);
				throw new Exception('Невозможно скопировать файл');
			}
			if(! $dest = fopen(ABSOLUTE_PATH.USERFILES.'/'.$this->diafan->table.'/files/'.$newid, 'w'))
			{
				DB::query("DELETE FROM {attachments} WHERE id=%d", $newid);
				throw new Exception('Невозможно скопировать файл');
			}
			if (! stream_copy_to_stream($src, $dest))
			{
				DB::query("DELETE FROM {attachments} WHERE id=%d", $newid);
				throw new Exception('Невозможно скопировать файл');
			}

			$size = filesize(ABSOLUTE_PATH . USERFILES . '/' . $this->diafan->table . '/files/' . $newid);
			DB::query("UPDATE {attachments} SET size='%d' WHERE id=%d", $size, $newid);

			$this->diafan->set_query("link='%h'");
			$this->diafan->set_value("");
		}
		if ($_POST["file_type"] == 3)
		{
			$this->diafan->set_query("link='%h'");
			$this->diafan->set_value($_POST["attachment_link"]);
		}
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("files_rel", "element_id=".$del_id." OR rel_element_id=".$del_id, $trash_id);
		$this->diafan->del_or_trash_where("files_counter", "element_id=".$del_id, $trash_id);
	}
}