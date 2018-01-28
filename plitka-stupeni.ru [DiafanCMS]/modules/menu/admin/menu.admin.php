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
 * Menu_admin
 *
 * Редактирование пунктов меню
 */
class Menu_admin extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'menu';

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
				'default' => true,
				'multilang' => true,
			),
			'colors'=> array(
				'type' => 'function',
				'name' => 'Цвет текста',
			),
			'background'=> array(
				'type' => 'function',
				'name' => 'Цвет подложки',
			),
			'module_name' => array(
				'type' => 'function',
				'name' => 'Ссылка',
			),
			'parent_id' => array(
				'type' => 'function',
				'name' => 'Вложенность: принадлежит',
			),
			'cat_id' => array(
				'type' => 'function',
				'name' => 'Категория',
			),
			'access' => array(
				'type' => 'none',
				'name' => 'Доступ',
			),
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
			'images' => array(
				'type' => 'module',
				'name' => 'Изображение',
				'count' => 1,
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'act', // показать/скрыть
		'parent', // содержит вложенности
		'trash', // использовать корзину
		'order', // сортируется
		'element', // используются группы
		'category_flat', // категори не содержат вложенности
		'category_no_empty', // категория всегда выбрана
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		if ($this->diafan->edit)
		{
			$this->diafan->variable_unset('access');
		}
	}

	/**
	 * Выводит списко ответов
	 * @return void
	 */
	public function show()
	{
		if (! $this->diafan->cat)
		{
			$this->diafan->cat = 1;
		}

		$this->diafan->addnew_init('Добавить пункт меню');

		$this->diafan->list_row();
	}

	

	public function edit_variable_colors(){
		$may_new=unserialize(@file_get_contents($_SERVER['DOCUMENT_ROOT'].'/modules/menu/admin/colors.t'));
		$this->diafan->values['id'];
		$link="";
		if(is_array($may_new) && isset($may_new[$this->diafan->values['id']])){$link=$may_new[$this->diafan->values['id']];}
		echo '<tr id="colors">
		<td class="td_first">'.$this->diafan->variable_name().'</td>  
		<td><input type="text" size="40" name="'.$this->diafan->key.'" value="'.$link.'"></td>
		</tr>';
	}
	public function edit_variable_background(){
		$may_new=unserialize(@file_get_contents($_SERVER['DOCUMENT_ROOT'].'/modules/menu/admin/background.t'));
		$this->diafan->values['id'];
		$link="";
		if(is_array($may_new) && isset($may_new[$this->diafan->values['id']])){$link=$may_new[$this->diafan->values['id']];}
		echo '<tr id="background">
		<td class="td_first">'.$this->diafan->variable_name().'</td>  
		<td><input type="text" size="40" name="'.$this->diafan->key.'" value="'.$link.'"></td>
		</tr>';
	}
	
	public function save_variable_colors(){
	//print_r($_POST);
		$may_new=unserialize(@file_get_contents($_SERVER['DOCUMENT_ROOT'].'/modules/menu/admin/colors.t'));
		if(!is_array($may_new)){$may_new=array();}
		if ($_POST["id"]){
			$may_new[$_POST["id"]]=$_POST["colors"];
			file_put_contents($_SERVER['DOCUMENT_ROOT'].'/modules/menu/admin/colors.t',serialize($may_new));
		}
	}
	
	public function save_variable_background(){
		$may_new=unserialize(@file_get_contents($_SERVER['DOCUMENT_ROOT'].'/modules/menu/admin/background.t'));
		if(!is_array($may_new)){$may_new=array();}
		if ($_POST["id"]){
			$may_new[$_POST["id"]]=$_POST["background"];
			file_put_contents($_SERVER['DOCUMENT_ROOT'].'/modules/menu/admin/background.t',serialize($may_new));
		}
	}	
	
	
	
	
	
	/**
	 * Редактирование поля "Ссылка"
	 * @return void
	 */
	public function edit_variable_module_name()
	{
		if (! $this->diafan->addnew)
		{
			if($this->diafan->values['othurl'])
			{
				$link = $this->diafan->values['othurl'];
			}
			else
			{
				if($this->diafan->values['module_name'] == 'site')
				{
					$link = BASE_PATH.$this->diafan->_route->link($this->diafan->values['site_id']);
				}
				else
				{
					$link = BASE_PATH.$this->diafan->_route->link($this->diafan->values['site_id'], $this->diafan->values['module_name'], $this->diafan->values['module_cat_id'], $this->diafan->values['element_id']);
				}
			}
			
			
		}
		echo '<tr id="module_name">
		<td class="td_first">'.$this->diafan->variable_name().'</td>  
		<td><input type="text" size="40" name="'.$this->diafan->key.'" value="'.(! empty($link) ? $link : '').'"></td>
		</tr>';
	}

	/**
	 * Сохранение поля "Элемент модуля"
	 * @return void
	 */
	public function save_variable_module_name()
	{
		if(empty($_POST['module_name']))
		{
			return TRUE;
		}	    
		
		$link = preg_replace('/'.str_replace('/', '\\/', BASE_PATH).'/', '', $_POST['module_name']);
		$link = preg_replace('/^\//', '', $link);
		if(ROUTE_END == '/')
		{
			$link = preg_replace('/\/$/', '', $link);
		}
		if($row = $this->diafan->_route->search($link))	
		{
			$this->diafan->set_query("module_name='%s'");
			$this->diafan->set_value($row['module_name']);
			
			$this->diafan->set_query("module_cat_id=%d");
			$this->diafan->set_value($row['cat_id']);
			   
			$this->diafan->set_query("element_id=%d");
			$this->diafan->set_value($row['element_id']);
			
			$this->diafan->set_query("site_id=%d");
			$this->diafan->set_value($row['site_id']);
			
			$this->diafan->set_query("othurl='%s'");
			$this->diafan->set_value('');
		}
		else
		{
			$this->diafan->set_query("othurl='%s'");
			$this->diafan->set_value($_POST['module_name']);
		}   
	}

	/**
	 * Сохранение поля "Доступ, период показа"
	 * @return void
	 */
	public function save_variable_access()
	{
		if ($_POST["element_id"])
		{
			$element = DB::fetch_array(DB::query("SELECT access, date_start, date_finish FROM {%h} WHERE id=%d LIMIT 1", $_POST["module_name"], $_POST["element_id"]));
		}
		elseif ($_POST["module_cat_id"])
		{
			$element = DB::fetch_array(DB::query("SELECT access FROM {%h_category} WHERE id=%d LIMIT 1", $_POST["module_name"], $_POST["module_cat_id"]));
		}
		else
		{
			$element = DB::fetch_array(DB::query("SELECT access, date_start, date_finish FROM {site} WHERE id=%d LIMIT 1", $_POST["site_id"]));
		}

		$this->diafan->set_query("access='%d'");
		$this->diafan->set_value($element["access"]);
		if(! empty($element["date_start"]))
		{
			$this->diafan->set_query("date_start=%d");
			$this->diafan->set_value($element["date_start"]);
		}
		if(! empty($element["date_finish"]))
		{
			$this->diafan->set_query("date_finish=%d");
			$this->diafan->set_value($element["date_finish"]);
		}
	}

	/**
	 * Сохранение поля "Родитель"
	 * 
	 * @return void
	 */
	public function save_variable_parent_id()
	{
		if (!$this->diafan->savenew && $_POST["cat_id"] != $this->diafan->oldrow["cat_id"])
		{
			if ($_POST["parent_id"] && DB::query_result("SELECT cat_id FROM {menu} WHERE id=%d LIMIT 1", $_POST["parent_id"]) != $_POST["cat_id"])
			{
				$_POST["parent_id"] = 0;
			}
		}
		parent::__call('save_variable_parent_id', array());
	}
}