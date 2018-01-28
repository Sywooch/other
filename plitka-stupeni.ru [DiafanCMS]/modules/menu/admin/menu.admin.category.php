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
 * Menu_admin_category
 *
 * Редактирование меню
 */
class Menu_admin_category extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'menu_category';

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
			'number' => array(
				'type' => 'function',
				'name' => 'Номер',
				'help' => 'Номер элемента в БД (для разработчиков).',
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'default' => true,
				'multilang' => true,
			),
			'show_title' => array(
				'type' => 'checkbox',
				'name' => 'Показывать заголовок',
				'help' => 'Если отмечен, перед пунктами меню выведется название меню',
			),
			'show_all_level' => array(
				'type' => 'checkbox',
				'name' => 'Раскрывать все пункты меню',
				'help' => 'Если отмечено, в меню будут выводиться все пункты меню, включая вложенные. Иначе вложенные пункты будут появляться только при выборе родительского пункта.',
			),
			'hide_parent_link' => array(
				'type' => 'checkbox',
				'name' => 'Не отображать ссылку на элемент, если он имеет дочерние пункты',
			),
			'current_link' => array(
				'type' => 'checkbox',
				'name' => 'Текущий пункт меню как ссылка',
				'help' => 'Если отмечено, активный пункт меню останется ссылкой.',
			),
			'only_image' => array(
				'type' => 'checkbox',
				'name' => 'Не отображать имя пункта меню, если используется изображние',
				'help' => 'Если к пункту меню прикреплено изображение, то имя пункта отображаться не будет.',
			),
			'menu_template' => array(
				'type' => 'function',
				'name' => 'Шаблон вывода меню',
				'help' => 'Шаблон будет использован, если в шаблонном тэге вывода меню указан атрибут template="select".',
			),
			'site_ids'         => array(
				'type' => 'function',
				'name' => 'Отображать на страницах',
			),
			'access' => array(
				'type' => 'function',
				'name' => 'Доступ',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'act', // показать/скрыть
		'category', // часть модуля - категории
		'trash', // использовать корзину
	);

	/**
	 * Выводит список вопросов
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить меню');
		
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
		// нельзя удалить первую категорию меню
		if($row["id"] == 1)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	

	
	
	
	
	
	
	/**
	* Редактирование поля "Шаблон меню"
	* @return void
	*/
       public function edit_variable_menu_template()
       {
	    if (! $dir = opendir(ABSOLUTE_PATH.'modules/menu/views/'))
	    {		    
		    return FALSE;
	    }
	    $template = array();
	    while (($file = readdir($dir)) !== false)
	    {
		    if ($file != '.' && $file != '..' && is_file(ABSOLUTE_PATH.'modules/menu/views/'.$file))
		    {
			    if(preg_match('/(show_block.*?)\.php/', $file, $mathes))
			    {
				$key = $mathes[1];
				$name = $mathes[1];			   
				$template[$key] = $name;
			    }
			    
		    }
	    }
	    closedir($dir);
	    
	    $current_template = DB::query_result("SELECT menu_template FROM {menu_category} WHERE id=%d", $this->diafan->edit);
	    
	    echo '
	    <tr id="theme_list">
		    <td class="td_first">
			    '.$this->diafan->variable_name("menu_template").'
		    </td>
		    <td>
			    <select name="menu_template_list">
				    <option value="">-</option>';
	    foreach ($template as $key => $value)
	    {
		    echo '<option value="'.$key.'"'.( $current_template == $key ? ' selected' : '' ).'>'.$value.'</option>';
	    }
	    echo '</select>
	    '.$this->diafan->help().'
	    </td></tr>';
       }
       
       /**
	 * Редактирование поля "Расположение"
	 *
	 * @return void
	 */
	public function edit_variable_site_ids()
	{
		$show_in_site_id = array();
		$result = DB::query("SELECT site_id FROM {menu_category_site_rel} WHERE element_id=%d", $this->diafan->edit);
		while ($row = DB::fetch_array($result))
		{
			$show_in_site_id[] = $row["site_id"];
		}
		echo '
		<tr valign="top" id="site_ids">
		<td align="right">'.$this->diafan->variable_name().'</td>
		<td>
		<select multiple name="'.$this->diafan->key.'[]">';

		$result = DB::query("SELECT id, [name], parent_id FROM {site} WHERE trash='0' AND [act]='1' AND block='0' AND id<>%d ORDER BY id ASC", ! $this->diafan->addnew ? $this->diafan->edit : 0);
		while ($row = DB::fetch_array($result))
		{
			$cats[$row["parent_id"]][] = $row;
		}
		echo $this->diafan->get_options($cats, $cats[0], $show_in_site_id).'
				</select>
				'.$this->diafan->help().'
			</td>
		</tr>';
	}
       
       /**
	* Сохранение поля "Шаблон меню"
	* @return void
	*/
       public function save_variable_menu_template()
       {
	   if(! empty($_POST['menu_template_list']))
	   {
	       $this->diafan->set_query("menu_template='%s'");
	       $this->diafan->set_value($_POST['menu_template_list']);
	   }
	   else
	   {
	       $this->diafan->set_query("menu_template='%s'");
	       $this->diafan->set_value('');
	   }
	   
	   return TRUE;
       }
       
       /**
	 * Сохранение поля "Расположение"
	 * @return void
	 */
	public function save_variable_site_ids()
	{
		
	    $this->diafan->update_table_rel("menu_category_site_rel", "element_id", "site_id", ! empty($_POST['site_ids']) ? $_POST['site_ids'] : array(), $this->diafan->save, $this->diafan->savenew);
	    
	    if(empty($_POST['site_ids']))
	    {
		DB::query("DELETE FROM {menu_category_site_rel} WHERE element_id=%d", $this->diafan->save);
	    }
	}
}