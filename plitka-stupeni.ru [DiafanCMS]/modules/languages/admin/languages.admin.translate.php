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
 * Languages_admin_translate
 *
 * Редактирование перевода интерфейса
 */
class Languages_admin_translate extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'languages_translate';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'text' => array(
				'type' => 'textarea',
				'name' => 'Исходное слово (фраза)',
			),
			'text_translate' => array(
				'type' => 'textarea',
				'name' => 'Перевод (переименование)',
			),
			'lang_id' => array(
				'type' => 'select',
				'name' => 'Для языка',
				'help' => 'Если добавить перевод для русского языка, исходное слово переименуется. Например, можно изменить в русском интерфейсе исходное "Корзина" на новое "Заказ"',
			),
			'module_name' => array(
				'type' => 'select',
				'name' => 'Для модуля',
				'help' => 'Если не выбрать модуль, то перевод применится ко всем модулям сайта, где встретится исходное слово',
			),
			'type' => array(
				'type' => 'select',
				'name' => 'Часть сайта',
			),
		),
	);

	/**
	 * @var array списки из таблицы
	 */
	public $select_arr = array(
		'type' => array(
			'site' => 'пользовательская',
			'admin' => 'административная',
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array (
		'text_translate' => 'text',
		'lang_id' => array('type' => 'select', 'class' => 'other_row'),
		'module_name' => array('type' => 'select', 'class' => 'module_name'),
		'type' => array('type' => 'select', 'class' => 'other_row'),
	);

	/**
	 * @var array текст для ссылки на редактирование в списке
	 */
	public $text_for_base_link = array(
		'variable' => 'text'
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		foreach ($this->diafan->languages as $language)
		{
			$this->diafan->select_arr("lang_id", $language["id"], $language["name"]);
		}
		$this->diafan->select_arr("module_name", "-", $this->diafan->_("Все"));
		$result = DB::query("SELECT name, title FROM {modules} ORDER BY id ASC");
		while($row = DB::fetch_array($result))
		{
			$this->diafan->select_arr("module_name", $row["name"], $row["title"] ? $this->diafan->_($row["title"]) : $row["name"]);
		}
		$this->upload();
	}

	/**
	 * Выводит контент модуля
	 * @return void
	 */
	public function show()
	{
		echo '<script type="text/javascript" src="'.BASE_PATH
		.'modules/languages/admin/languages.admin.js"></script>';

		$this->form_upload();

		$this->diafan->addnew_init('Добавить перевод или переименование');

		$this->diafan->list_row();
	}

	/**
	 * Определяет строку с GET переменными
	 *
	 * @return void
	 */
	public function set_get_nav()
	{
		$get_nav_params = $this->diafan->get_nav_params;
		$get_nav_params["lang_id"] = 0;
		$get_nav_params["type"] = '';
		$get_nav_params["module_name"] = '';
		$get_nav_params["empty_translate"] = 0;
		$get_nav_params["search_text"] = '';
		$get_nav_params["search_text_translate"] = '';

		if (!empty( $_GET["lang_id"] ))
		{
			$get_nav_params["lang_id"] = $this->diafan->get_param($_GET, "lang_id", 0, 2);
			$this->diafan->get_nav .= ( $this->diafan->get_nav ? '&amp;' : '?' ) . 'lang_id=' . $get_nav_params["lang_id"];
			$this->diafan->where .= " AND lang_id=".$get_nav_params["lang_id"];
		}
		if (!empty( $_GET["type"] ))
		{
			$get_nav_params["type"] = $_GET["type"] == 'admin' ? 'admin' : 'site';
			$this->diafan->get_nav .= ( $this->diafan->get_nav ? '&amp;' : '?' ) . 'type=' . $get_nav_params["type"];
			$this->diafan->where .= " AND type='".$get_nav_params["type"]."'";
		}
		if (!empty( $_GET["module_name"] ))
		{
			$get_nav_params["module_name"] = $this->diafan->get_param($_GET, "module_name", '', 1);
			$this->diafan->get_nav .= ( $this->diafan->get_nav ? '&amp;' : '?' ) . 'module_name=' . $get_nav_params["module_name"];
			$this->diafan->where .= " AND module_name='" . ($get_nav_params["module_name"] != 'all' ? str_replace(array("'", "%"), array("\\'", "%%"), $get_nav_params["module_name"]) : ''). "'";
		}
		if(! empty($_GET["empty_translate"]))
		{
			$get_nav_params["empty_translate"] = 1;
			$this->diafan->get_nav .= ( $this->diafan->get_nav ? '&amp;' : '?' ) . 'empty_translate=1';
			$this->diafan->where .= " AND text_translate=''";
		}
		elseif (!empty( $_GET["search_text_translate"] ))
		{
			$get_nav_params["search_text"] = htmlentities($_GET["search_text_translate"]);
			$this->diafan->get_nav .= ( $this->diafan->get_nav ? '&amp;' : '?' ) . 'search_text_translate='.$get_nav_params["search_text_translate"];
			$this->diafan->where .= " AND text_translate LIKE '%%" . str_replace("%", "%%", DB::escape_string($_GET["search_text_translate"])) . "%%'";
		}
		if (!empty( $_GET["search_text"] ))
		{
			$get_nav_params["search_text"] = htmlentities($_GET["search_text"]);
			$this->diafan->get_nav .= ( $this->diafan->get_nav ? '&amp;' : '?' ) . 'search_text='.$get_nav_params["search_text"];
			$this->diafan->where .= " AND text LIKE '%%" . str_replace("%", "%%", DB::escape_string($_GET["search_text"])) . "%%'";
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

		if($this->diafan->edit)
			return '';

		$this->upload();

		$html = '
		<form action="' . BASE_PATH_HREF . $this->diafan->rewrite . '/" method="GET">
		' . $this->diafan->_('Исходное слово (фраза)') . ': <input type="text" name="search_text" value="' . $this->diafan->get_nav_params["search_text"] . '" size="40"><br><br>

		' . $this->diafan->_('Перевод (переименование)') . ': <input type="text" name="search_text_translate" value="' . $this->diafan->get_nav_params["search_text_translate"] . '" size="40">
		' . $this->diafan->_('не переведенное') . ': 
		<input type="checkbox" name="empty_translate" value="1"'.($this->diafan->get_nav_params["empty_translate"] ? ' checked' : '').'>
		<br><br>

		' . $this->diafan->_('Для языка') . ': <select name="lang_id"><option value="">все</option>';
		foreach($this->diafan->select_arr("lang_id") as $k => $v)
		{
			$html .= '<option value="'.$k.'"'.($this->diafan->get_nav_params["lang_id"] == $k ? ' selected' : '').'>'.$v.'</option>';
		}
		$html .= '</select>

		' . $this->diafan->_('Часть сайта') . ': <select name="type"><option value="">' . $this->diafan->_('все') . '</option>';
		foreach($this->diafan->select_arr("type") as $k => $v)
		{
			$html .= '<option value="'.$k.'"'.($this->diafan->get_nav_params["type"] == $k ? ' selected' : '').'>'.$v.'</option>';
		}
		$html .= '</select><br><br>

		' . $this->diafan->_('Модуль') . ': <select name="module_name">';
		foreach($this->diafan->select_arr("module_name") as $k => $v)
		{
			if(! $k)
			{
				$k = 'all';
			}
			$html .= '<option value="'.$k.'"'.($this->diafan->get_nav_params["module_name"] == $k ? ' selected' : '').'>'.$v.'</option>';
		}
		$html .= '</select><br>
		<input type="submit" class="button" value="' . $this->diafan->_('Поиск') . '">

		</form>';
		return $html;
	}

	/**
	 * Выводит форму импорт/экспорт перевода
	 * 
	 * @return void
	 */
	private function form_upload()
	{
		if (!empty( $_GET["lang_id"] ))
		{
			$lang_id = $this->diafan->get_param($_GET, "lang_id", 0, 2);
		}

		echo '<div class="block"><a href="#" class="languages_import_export dashed_link">'.$this->diafan->_('Импорт / экспорт перевода').'</a>
		<div class="languages_import_export_block hide">';
		echo '<p>'.$this->diafan->_('Экспорт').': ';
		foreach($this->diafan->languages as $row)
		{
			echo '<a href="'.BASE_PATH.'languages/export/'.$row["shortname"].'"><b>'.$row["name"].'</b></a> ';
		}
		echo ' ('.$this->diafan->_('сохранить как файл').')</p>
		<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="upload" value="1">
		'.$this->diafan->_('Импорт').': 
		' . $this->diafan->_('Язык сайта') . ' <select name="lang_id">';
		foreach($this->diafan->select_arr("lang_id") as $k => $v)
		{
			echo '<option value="'.$k.'"'.(! empty($lang_id) && $lang_id == $k ? ' selected' : '').'>'.$v.'</option>';
		}
		echo '</select>
		<input type="file" name="file">
		<input type="submit" class="button" value="' . $this->diafan->_('Загрузить') . '">
		</form></div></div>';
	}

	/**
	 * Загружает файл перевода
	 * 
	 * @return void
	 */
	private function upload()
	{
		if (! isset($_FILES["file"]) || ! is_array($_FILES["file"]) || $_FILES["file"]['name'] == '')
		{
		    return;
		}
		$oldtranslates  = array();
		$result = DB::query("SELECT * FROM {languages_translate} WHERE lang_id=%d", $_POST["lang_id"]);
		while($row = DB::fetch_array($result))
		{
			$oldtranslates[$row["type"]][$row["module_name"]][$row["text"]] = $row["id"];
		}

		$file = file_get_contents($_FILES["file"]['tmp_name']);

		$translates = explode("\n", $file);
		$module_name = '';
		$type = 'site';
		$original = '';
		foreach($translates as $s)
		{
			if(strpos($s, 'module_name=') !== false)
			{
				$module_name = trim(str_replace('module_name=', '', $s));
				continue;
			}
			if(strpos($s, 'type=') !== false)
			{
				$type = trim($s) == 'type=admin' ? 'admin' : 'site';
				continue;
			}
			if(! $original)
			{
				$original = $s;
			}
			else
			{
				if(! empty($oldtranslates[$type][$module_name][$original]))
				{
					DB::query("UPDATE {languages_translate} SET text_translate='%s' WHERE id=%d", $s, $oldtranslates[$type][$module_name][$original]);
				}
				else
				{
					DB::query("INSERT INTO {languages_translate} (lang_id, module_name, text, text_translate, type) VALUES (%d, '%h', '%s', '%s', '%s')", $_POST["lang_id"], $module_name, $original, $s, $type);
				}
				$original = '';
			}
		}
		unlink($_FILES["file"]['tmp_name']);

		$this->diafan->redirect(URL);
	}

	/**
	 * Пользовательская функция, выполняемая перед редиректом при сохранении скидки
	 *
	 * @return void
	 */
	public function save_redirect()
	{
		if(DB::query_result("SELECT id FROM {languages_translate} WHERE text='%s' AND module_name='%s' AND lang_id=%d AND type='%s' AND id<>%d LIMIT 1", $_POST["text"], $_POST["module_name"], $_POST["lang_id"], $_POST["type"], $this->diafan->save))
		{
			DB::query("DELETE FROM {languages_translate} WHERE text='%s' AND module_name='%s' AND lang_id=%d AND type='%s' AND id<>%d", $_POST["text"], $_POST["module_name"], $_POST["lang_id"], $_POST["type"], $this->diafan->save);
		}
		parent::__call('save_redirect', array());
	}
}