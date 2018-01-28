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
 * Subscribtion_admin_emails
 *
 * База электронных ящиков для рассылок
 */
class Subscribtion_admin_emails extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'subscribtion_emails';
	
	/**
	 * @var string категории рассылок
	 */
	public $subscribtion = '';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'mail' => array(
				'type' => 'email',
				'name' => 'Почтовый ящик',
			),
			'created' => array(
				'type' => 'date',
				'name' => 'Дата добавления',
				'help' => 'Вводится в формате дд.мм.гггг чч:мм',
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Получает рассылку',
			),
			'category' => array(
				'type' => 'function',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'trash', // использовать корзину
		'act', // показать/скрыть
	);
	
	/**
	 * @var array текст для ссылки на редактирование в списке
	 */
	public $text_for_base_link = array(
		'variable' => 'mail'
	);

	/**
	 * Выводит список рассылок
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить подписчика');
		$this->diafan->list_row();
	}
	
	/**
	 * Выводит список категорий рассылок
	 * @return void
	 */
	public function edit_variable_category()
	{
	    if(!$this->diafan->configmodules("cat", "subscribtion"))
	    {
		return TRUE;
	    }
	    else if($this->diafan->addnew)			
	    {
		$cat_unrel = array();
		$this->parent_id_subscribtion(0, '', array(), $cat_unrel);
		echo '<tr id="category"><td class="td_first">'.$this->diafan->_('Категории рассылок').'</td><td>'.$this->subscribtion.'</td></tr>';		
	    }
	    else
	    {		
		$row = DB::fetch_array(DB::query("SELECT * FROM {subscribtion_emails} WHERE id=%d AND trash='0' LIMIT 1", $this->diafan->edit));
		$cat_unrel = array();
		$cat_unrel_result = DB::query("SELECT cat_id FROM {subscribtion_emails_cat_unrel} WHERE element_id=%d AND trash='0'", $row['id']);
		while($cat_id = DB::fetch_array($cat_unrel_result))
		{
		    $cat_unrel[] = $cat_id['cat_id'];
		}	    
		$this->parent_id_subscribtion(0, '', array(), $cat_unrel);
		echo '<tr id="category"><td class="td_first">'.$this->diafan->_('Категории рассылок').'</td><td>'.$this->subscribtion.'</td></tr>';
	    }
	}
	
	/**
	 * Сохраняет список категорий рассылок
	 * @return void
	 */
	public function save_variable_category()
	{
	    DB::query("DELETE FROM {subscribtion_emails_cat_unrel} WHERE element_id=%d", $this->diafan->save);
	    
	    $result = DB::query("SELECT id FROM {subscribtion_category} WHERE trash='0'");
	    while ($row = DB::fetch_array($result))
	    {
		    if(empty($_POST['subscribtion_category']) || !in_array($row['id'], $_POST['subscribtion_category']))
		    {
			DB::query("INSERT INTO {subscribtion_emails_cat_unrel} (element_id, cat_id) VALUES (%d, %d)", $this->diafan->save, $row['id']);
		    }
	    }
	}
	
	/**
	 * Формирует список рассылок
	 * @return array
	 */
	private function parent_id_subscribtion($parent_id, $rew, $array, $cat_unrel)
	{
		$result = DB::query("SELECT [name], id FROM {subscribtion_category} WHERE parent_id=%d AND trash='0'", $parent_id);		
		while ($row  = DB::fetch_array($result))
		{
			$this->subscribtion .=$rew . '<input type="checkbox" name="subscribtion_category[]" value="' . $row["id"] . '"'
					. (!in_array($row['id'], $cat_unrel) ? ' checked' : '')
					. '> ' . $row["name"] . '<br>';
			if (in_array($row["id"], $array))
			{
				return $array;
			}
			$array[] = $row["id"];
			$array   = $this->parent_id_subscribtion($row["id"], '&nbsp;&nbsp;&nbsp;' . $rew, $array, $cat_unrel);
		}
		return $array;
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("subscribtion_emails_cat_unrel", "element_id=".$del_id, $trash_id);
	}
}