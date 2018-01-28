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
 * Photo_admin
 *
 * Редактирование фотографий
 */
class Photo_admin extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'photo';

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
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'help' => 'Если не отмечена, фотография не будет отображаться на сайте',
				'default' => true,
				'multilang' => true,
			),
			'images' => array(
				'type' => 'module',
				'name' => 'Фотография',
				'count' => 1,
			),
			'hr1' => 'hr',
			'rel_elements' => array(
				'type' => 'function',
				'name' => 'Похожие фотографии',
			),
			'cat_id' => array(
				'type' => 'function',
				'name' => 'Альбом',
				'help' => 'Перенос фотографии в другой альбом',
			),
			'search' => array(
				'type' => 'module',
			),
		),
		'other_rows' => array (
			'tags' => array(
				'type' => 'module',
			),
			'hr3' => 'hr',
			'menu' => array(
				'type' => 'module',
				'name' => 'Создать пункт в меню',
			),
			'hr2' => 'hr',
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
			'hr5' => 'hr',
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
			'hr6' => 'hr',
			'theme' => array(
				'type' => 'function',
				'name' => 'Шаблон страницы',
			),
			'view' => array(
				'type' => 'function',
				'name' => 'Шаблон модуля',
			),
			'hr_count' => 'hr',
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
		'menu', // используется в меню
		'del', // удалить
		'order', // сортируется
		'element_site', // делит элементы по разделам (страницы сайта, к которым прикреплен модуль)
		'element', // используются группы
		'element_multiple', // модуль может быть прикреплен к нескольким группам
		'search_name', // скать по названию
		'trash', // использовать корзину
		'image', // показать фотографию в списке
		'multiupload', // мультизагрузка изображений (подключение JS-библиотек)
		'only_self', // показывать только материалы редактора, если это задано в правах пользователя
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		if(! $this->diafan->configmodules("cat", "photo", $this->diafan->site))
		{
			$this->diafan->config("element", false);
			$this->diafan->config("element_multiple", false);
		}
		if($this->diafan->edit)
		{
			$this->diafan->config('multiupload', false);
		}
		if(! $this->diafan->configmodules("page_show", "photo", $this->diafan->site))
		{
			$this->diafan->variable_unset("view");
		}
	}

	/**
	 * Выводит список фотографий
	 * @return void
	 */
	public function show()
	{
		if (!extension_loaded('gd') && !extension_loaded('gd2'))
		{
			$this->diafan->error = 7;
		}
		if ($this->diafan->config('element') && !$this->diafan->not_empty_categories)
		{
			echo '<div class="error">'.sprintf($this->diafan->_('В %sнастройках%s включено использование альбомов. Чтобы загрузить фотографию, создайте хотя бы один %sальбом%s.'), '<a href="'.BASE_PATH_HREF.'photo/config/">', '</a>', '<a href="'.BASE_PATH_HREF.'photo/category/'.( $this->diafan->site ? 'site'.$this->diafan->site.'/' : '' ).'">', '</a>').'</div>';
		}
		else
		{
			echo '
			<div class="add_new">
				<a href="'.URL.'addnew1/">'.$this->diafan->_('Добавить фотографию').'</a>
				/ <a href="'.URL.'savenew1/" class="upload_files" cat_id="'.$this->diafan->cat.'">'.$this->diafan->_('несколько фотографий').'</a>
			</div>
	
			<div id="uploadAreaMulti">
				<div id="file-uploader">
					<noscript>
						<p>Please enable JavaScript to use file uploader.</p>
						<!-- or put a simple form for upload here -->
					</noscript>
				</div>
			</div>
			<script type="text/javascript" src="'.BASE_PATH.'modules/photo/admin/photo.admin.js"></script>';
		}

		$this->diafan->list_row();
	}

	/**
	 * Добавляет элемент в базу данных
	 *
	 * @return boolean
	 */
	public function save_new()
	{
		if (empty( $_GET["save_post"] ))
		{
			parent::__call('save_new', array());
			return;
		}

		if (!empty( $_GET["cat_id"] ))
		{
			$this->diafan->cat = $_GET["cat_id"];
		}

		header('Content-Type: text/html; charset=utf-8');
		$_POST["cat_id"] = $this->diafan->cat;

		// Проверяет права на добавление
		if (! $this->diafan->_user->roles('edit', 'photo'))
		{
			$this->diafan->redirect(URL);
			return false;
		}
		$names = array ();
		$values = array ();
		if ($this->diafan->config('element'))
		{
			if(! $this->diafan->cat)
			{
				$this->diafan->cat = DB::query_result("SELECT id FROM {photo_category} WHERE [act]='1' AND trash='0'".($this->diafan->site ? " AND site_id=".$this->diafan->site : '')." LIMIT 1");
			}
			$names[] = 'cat_id';
			$values[] = "'".$this->diafan->cat."'";
		}
		$names[] = 'site_id';
		if ($this->diafan->config('element') && $this->diafan->cat)
		{
			$this->diafan->site = DB::query_result("SELECT site_id FROM {photo_category} WHERE id=%d LIMIT 1", $this->diafan->cat);
		}
		elseif (! $this->diafan->site)
		{
			$this->diafan->site = DB::query_result("SELECT id FROM {site} WHERE module_name='photo' LIMIT 1");
		}
		$values[] = "'".$this->diafan->site."'";
		$name = str_replace("'", "", $_GET['qqfile']);
		foreach($this->diafan->languages as $lang)
		{
			$names[] = 'name'.$lang["id"];
			$values[] = "'".$name."'";
			if($this->diafan->configmodules("multiupload_act", 'photo', $this->diafan->site))
			{
				$names[] = 'act'.$lang["id"];
				$values[] = "'1'";
			}
		}
		DB::query("INSERT INTO {photo} (".implode(',', $names).") VALUES (".implode(',', $values).")");
		$this->diafan->save = DB::query_result("SELECT MAX(id) FROM {photo} WHERE [name]='%s'", $name);
		DB::query("UPDATE {photo} SET sort=id WHERE id=%d", $this->diafan->save);

		if ($this->diafan->config('element') && $this->diafan->cat)
		{
			DB::query("INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (%d, %d)", $this->diafan->save, $this->diafan->cat);
		}
		$this->save_upload_images();

		$result["success"] = true;
		$result["redirect"] = URL;

		include_once ABSOLUTE_PATH.'plugins/json.php';
		echo to_json($result);
		exit;
	}

	/**
	 * Сохранение поля "Фотография"
	 * @return void
	 */
	public function save_upload_images()
	{
		if (isset( $_GET['qqfile'] ))
		{
			$_FILES["images"]['name'] = $_GET['qqfile'];
			$_FILES["images"]['tmp_name'] = $this->qq_temp_name();
		}
		elseif (isset( $_FILES['qqfile'] ))
		{
			$_FILES["images"] = $_FILES['qqfile'];
		}

		if (isset( $_FILES["images"] ) && is_array($_FILES["images"]) && $_FILES["images"]['name'] != '')
		{
			$err = $this->upload_image();
			if ($err)
			{
				unlink($_FILES["images"]['tmp_name']);
				if (!empty( $_SERVER["HTTP_X_REQUESTED_WITH"] ) && $_SERVER["HTTP_X_REQUESTED_WITH"] == 'XMLHttpRequest')
				{
					echo '{error: "'.$err.' '.$_FILES["images"]['tmp_name'].'", hash : "'.$this->diafan->_user->get_hash().'"}';
					exit;
				}
				else
				{
					throw new Exception($err);
				}
			}
		}
		unlink($_FILES["images"]['tmp_name']);
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
	 * Загружает фотографию
	 * @return string|boolean false
	 */
	private function upload_image()
	{
		$this->diafan->_images->delete($this->diafan->save, 'photo');

		$new_name = strtolower($this->diafan->translit($_FILES["images"]['name']));
		$extension = substr(strrchr($new_name, '.'), 1);
		$new_name = substr($new_name, 0, -( strlen($extension) + 1 ));

		if (strlen($new_name) + strlen($extension) > 49)
		{
			$new_name = substr($new_name, 0, 49 - strlen($extension));
		}

		$error = $this->diafan->_images->upload($this->diafan->save, 'photo', $this->diafan->site, $_FILES["images"]['tmp_name'], $new_name);

		if ($error)
		{
			return $error;
		}
		return false;
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("photo_rel", "element_id=".$del_id." OR rel_element_id=".$del_id, $trash_id);
		$this->diafan->del_or_trash_where("photo_counter", "element_id=".$del_id, $trash_id);
	}
}