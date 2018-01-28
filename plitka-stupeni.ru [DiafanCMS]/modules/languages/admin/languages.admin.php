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
 * Languages_admin
 *
 * Редактирование списка языковых версий сайта
 */
class Languages_admin extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'languages';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Язык',
			),
			'shortname' => array(
				'type' => 'text',
				'name' => 'Обозначение языка латиницей',
				'help' => 'Используется для формирования URL. Если указан ru или rus, то интерфейс считается русским и не переводится.',
			),
			'base_site' => array(
				'type' => 'checkbox',
				'name' => 'Основной язык для пользовательской части',
				'help' => 'Выберите этот параметр, если хотите изменить язык по умолчанию в пользовательской части',
			),
			'base_admin' => array(
				'type' => 'checkbox',
				'name' => 'Основной язык для административной части',
				'help' => 'Выберите этот параметр, если хотите изменить язык по умолчанию в административной части',
			),
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
		'base_site' => 'function',
		'base_admin' => 'none',
	);

	/**
	 * @var array список полей в таблицах базы данных, подлежащих переводу
	 */
	private $array_languages = array(
		'banners' => array('alt', 'title', 'act'),
		'site' => array('name', 'title', 'text', 'keywords', 'descr', 'title_meta', 'act'),
		'clauses' => array('name', 'act', 'keywords', 'descr', 'title_meta', 'anons', 'text'),
		'clauses_category' => array('name', 'act', 'keywords', 'descr', 'title_meta', 'anons', 'text'),
		'comments_param' => array('name', 'text'),
		'comments_param_select' => array('name'),
		'faq' => array('name', 'act', 'keywords', 'descr', 'title_meta', 'anons', 'text'),
		'faq_category' => array('name', 'act', 'keywords', 'descr', 'title_meta', 'anons', 'text'),
		'feedback_param' => array('name', 'text'),
		'feedback_param_select' => array('name'),
		'files' => array('name', 'act', 'keywords', 'descr', 'title_meta', 'anons', 'text'),
		'files_category' => array('name', 'act', 'keywords', 'descr', 'title_meta', 'anons', 'text'),
		'images' => array('alt', 'title'),
		'menu' => array('name', 'act'),
		'menu_category' => array('name', 'act'),
		'news' => array('name', 'act', 'keywords', 'descr', 'title_meta', 'anons', 'text'),
		'news_category' => array('name', 'act', 'keywords', 'descr', 'title_meta', 'anons', 'text'),
		'photo' => array('name', 'act', 'keywords', 'descr', 'title_meta', 'anons', 'text'),
		'photo_category' => array('name', 'act', 'keywords', 'descr', 'title_meta', 'anons', 'text'),
		'shop' => array('name', 'act', 'keywords', 'descr', 'title_meta', 'anons', 'text'),
		'shop_additional_cost' => array('name', 'act', 'text'),
		'shop_category' => array('name', 'act', 'keywords', 'descr', 'title_meta', 'anons', 'text'),
		'shop_delivery' => array('name', 'act', 'text'),
		'shop_order_param' => array('name', 'text'),
		'shop_order_param_select' => array('name'),
		'shop_param' => array('name', 'text', 'measure_unit'),
		'shop_param_element' => array('value'),
		'shop_param_select' => array('name'),
		'shop_payment' => array('name', 'act', 'text'),
		'subscribtion' => array('name', 'text'),
		'subscribtion_category' => array('name', 'text'),
		'tags' => array('act'),
		'tags_name' => array('name'),
		'users_param' => array('name', 'text'),
		'users_param_select' => array('name'),
		'users_role' => array('name'),
		'votes' => array('name', 'act'),
		'votes_category' => array('name', 'act')
	);

	/**
	 * Выводит контент модуля
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить язык сайта');
		$this->diafan->list_row();
	}

	/**
	 * Выводит пометку "Основной язык" в списке
	 * @return string
	 */
	public function other_row_base_site($row)
	{
		$text = '</td><td>';
		if($row["id"] == $this->diafan->language_base_site && $row["id"] == $this->diafan->language_base_admin)
		{
			$text .= $this->diafan->_('Основной язык');
		}
		elseif($row["id"] == $this->diafan->language_base_site)
		{
			$text .= $this->diafan->_('Основной язык пользовательской части');
		}
		elseif($row["id"] == $this->diafan->language_base_admin)
		{
			$text .= $this->diafan->_('Основной язык администативной части');
		}
		
		return $text;
	}

	/**
	 * Проверяет можно ли удалить текущий элемент строки
	 *
	 * @param array $row информация о текущем элменте списка
	 * @return boolean
	 */
	public function check_delete($row)
	{
		// нельзя удалить основной язык пользовательской  или административной части
		if($row["id"] == $this->diafan->language_base_site || $row["id"] == $this->diafan->language_base_admin)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	/**
	 * Редактирование поля "Основной язык пользовательской части"
	 * 
	 * @return void
	 */
	public function edit_variable_base_site()
	{
		if(! empty($this->diafan->values["base_site"]))
		{
			$this->diafan->variable_disabled("base_site", true);
		}
		$this->diafan->show_table_tr_checkbox('base_site', $this->diafan->variable_name(), $this->diafan->value, $this->diafan->help(), $this->diafan->variable_disabled());
	}

	/**
	 * Редактирование поля "Основной язык административной части"
	 * 
	 * @return void
	 */
	public function edit_variable_base_admin()
	{
		if(! empty($this->diafan->values["base_admin"]))
		{
			$this->diafan->variable_disabled("base_admin", true);
		}
		$this->diafan->show_table_tr_checkbox('base_admin', $this->diafan->variable_name(), $this->diafan->value, $this->diafan->help(), $this->diafan->variable_disabled());
	}

	/**
	 * Сохранение поля "Основной язык пользовательской части"
	 * 
	 * @return void
	 */
	public function save_variable_base_site()
	{
		if($this->diafan->language_base_site != $this->diafan->save && ! empty($this->diafan->oldrow["base_site"]))
		{
			$this->diafan->set_query("base_site='%d'");
			$this->diafan->set_value(0);
		}
		elseif(! empty($_POST["base_site"]))
		{
			DB::query("UPDATE {languages} SET base_site='0' WHERE id=%d", $this->diafan->language_base_site);
			$this->diafan->set_query("base_site='%d'");
			$this->diafan->set_value(1);
		}
	}

	/**
	 * Сохранение поля "Основной язык административной части"
	 * 
	 * @return void
	 */
	public function save_variable_base_admin()
	{
		if($this->diafan->language_base_admin != $this->diafan->save && ! empty($this->diafan->oldrow["base_admin"]))
		{
			$this->diafan->set_query("base_admin='%d'");
			$this->diafan->set_value(0);
		}
		elseif(! empty($_POST["base_admin"]))
		{
			DB::query("UPDATE {languages} SET base_admin='0' WHERE id=%d", $this->diafan->language_base_admin);
			$this->diafan->set_query("base_admin='%d'");
			$this->diafan->set_value(1);
		}
	}

	/**
	 * Сохранение поля "Сокращенное название языка на латинице"
	 * 
	 * @return void
	 */
	public function save_variable_shortname()
	{
		$shortname = (! empty($_POST["shortname"]) ? $_POST["shortname"] : $_POST["name"]);
		$shortname = substr($this->diafan->translit($shortname), 0, 3);

		$this->diafan->set_query("shortname='%s'");		
		$this->diafan->set_value($shortname);
	}

	/**
	 * Добавление языкового интерфейса (вместо основной функции)
	 * 
	 * @return void
	 */
	public function save_new()
	{
		// Прошел ли пользователь проверку идентификационного хэша
		if (! $this->diafan->_user->checked)
		{
			$this->diafan->redirect(URL);
			return;
		}

		DB::query("INSERT INTO {".$this->diafan->table."} () VALUES ()");
		$this->diafan->save = DB::last_id($this->diafan->table);

		if (! $this->diafan->save)
		{
			throw new Exception('Не удалось добавить новый элемент в базу данных. Возможно, таблица '.DB_PREFIX.$this->diafan->table.' имеет неправильную структуру.');
		}

		foreach ($this->array_languages as $tab => $fields)
		{
			$creattable = DB::fetch_array(DB::query("SHOW CREATE TABLE {".$tab."}"));

			if ($creattable)
			{
				foreach ($fields as $f)
				{
					if (preg_match("/".$f.$this->diafan->language_base_site."` ([^\n]+),\n/", $creattable['Create Table'], $ob))
					{
						DB::query("ALTER TABLE {".$tab."} ADD `".$f.$this->diafan->save."` ".$ob[1]." AFTER `".$f.$this->diafan->language_base_site."`");
					}
				}
			}
		}

		DB::query("UPDATE {site} set act".$this->diafan->save."='1' WHERE id=1");

		$this->diafan->save();
	}

	/**
	 * Удаление языкового интерфейса (вместо основной функции)
	 * 
	 * @return void
	 */
	public function del()
	{
		// Прошел ли пользователь проверку идентификационного хэша
		if (! $this->diafan->_user->checked)
		{
			$this->diafan->redirect(URL);
			return;
		}

		if (! $this->diafan->_user->roles('del', $this->diafan->rewrite))
		{
			$this->diafan->redirect(URL);
			return;
		}

		if (! empty($_POST["id"]))
		{
			$ids = array($_POST["id"]);
		}
		else
		{
			$ids = $_POST["ids"];
		}
		foreach ($ids as $id)
		{
			$id = intval($id);
			if (! $id || $id == $this->diafan->language_base_site || $id == $this->diafan->language_base_admin)
			{
				continue;
			}

			foreach ($this->array_languages as $tab => $fields)
			{
				$creattable = DB::fetch_array(DB::query("SHOW CREATE TABLE {".$tab."}"));
				if ($creattable)
				{
					foreach ($fields as $f)
					{
						if (preg_match('/'.$f.$id.'` ([^,]+),/', $creattable['Create Table'], $ob))
						{
							DB::query("ALTER TABLE {".$tab."} DROP `".$f.$id."`");
						}
					}
				}
			}
			DB::query("DELETE FROM {languages_translate} WHERE lang_id=%d", $id);
			DB::query("DELETE FROM {languages} WHERE id=%d", $id);
		}

		include_once ABSOLUTE_PATH.'plugins/json.php';
		$result["redirect"] = BASE_PATH.ADMIN_FOLDER.'/languages/';
		echo to_json($result);
	}
}