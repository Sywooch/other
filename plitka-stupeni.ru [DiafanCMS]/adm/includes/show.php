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
 * Show_admin
 *
 * Список элементов
 */
class Show_admin extends Diafan
{
	/**
	 * @var integer количество строк, выводимых на странице
	 */
	public $nastr = 30;

	/**
	 * @var array поля для быстрого редактирования в списке
	 */
	public $fast_edit_rows;

	/**
	 * @var array дополнительные групповые операции
	 */
	public $group_action;

	/**
	 * @var array список дополнительных полей, выводимых в списке
	 */
	public $config_other_row;

	/**
	 * @var integer|string язык поля, обозначающего активность
	 */
	private $lang_act;

	/**
	 * @var integer порядковый номер элемента, с которого начинается вывод элементов
	 */
	private $polog = 0;

	/**
	 * @var array родители текущего раскрытого элемента
	 */
	private $parent_parents = array ();

	/**
	 * @var string ссылка на текущую страницу, используемая в постраничной навигации
	 */
	private $navlink;

	/**
	 * @var string ссылка на текущую страницу, используемая при раскрытии/закрытии дерева
	 */
	private $enterlink;

	/**
	 * @var array локальный кэш файла
	 */
	private $cache;

	/**
	 * @var boolean есть сложенности
	 */
	private $is_plus;

	/**
	 * Подгружает дерево
	 *
	 * @return void
	 */
	public function ajax_expand()
	{
		// Прошел ли пользователь проверку идентификационного хэша
		if (!$this->diafan->_user->checked)
		{
			echo "{error:'HASH'}";
			exit;
		}

		$_POST['parent_id'] = $this->diafan->get_param($_POST, 'parent_id', 0, 2);
		$_POST['level'] = $this->diafan->get_param($_POST, 'level', 0, 2);

		ob_start();
		$this->list_row($_POST['parent_id'], $_POST['level']);
		$res['html'] = ob_get_contents();
		ob_end_clean();

		$res['hash'] = $this->diafan->_user->get_hash();

		include_once ABSOLUTE_PATH.'plugins/json.php';
		echo to_json($res);
		exit;
	}

	/**
	 * Выводит ссылку на добавление элемента
	 *
	 * @param string $text текст ссылки "Добавить элемент"
	 * @return void
	 */
	public function addnew_init($text)
	{
		echo '
		<div class="add_new">
			<a href="'.URL;
		if ($this->diafan->config('element_site') && strpos(URL, 'site') === false && !empty( $this->diafan->site ))
		{
			echo 'site'.$this->diafan->site.'/';
		}
		$text = $this->diafan->_($text);
		echo 'addnew1/'.$this->diafan->get_nav.'" title="'.$text.'">'.$text.'</a>
		</div>';
	}

	/**
	 * Сортирует элементы массива
	 *
	 * @param array $array массив, который сортируется
	 * @param string $sort_field поле по которому идет сортировка
	 * @param const $sort_type тип сортировки(SORT_ASC,SORT_DESC)
	 * @return array
	 */
	public function sort_by_field($array,$sort_field,$sort_type)
	{
		foreach ($array as $key => $row) {
			$tmp[$key] = $row[$sort_field];
		}
		array_multisort($tmp, $sort_type, $array);
		return $array;
	}
	/**
	 * Формирует список элементов
	 *
	 * @param integer $id родитель
	 * @param integer $level уровень вложенности
	 * @return void
	 */
	public function list_row($id = 0, $level = 1)
	{
		$this->lang_act = $this->diafan->variable_multilang("act") ? _LANG : '';
		$links = $this->prepare_paginator($id);
		$result = $this->diafan->sql_query($id);
		if($level < 2)
		{
			$this->diafan->count = DB::num_rows($result);
		}
		$array_result = array(); 
		
		echo '<ul class="list'.( $this->diafan->config('order') ? ' move' : '' ).'">';

		while ($row = DB::fetch_array($result))
		{
			array_push($array_result,$row);

		}
		
		//print_r($array_result);
		if(isset($array_result[0]['sort']))
			$array_result = $this->sort_by_field($array_result,'sort',SORT_ASC);
			
			
		foreach($array_result as $row)
		{
		//print_r($row);
			echo '<li class="level_'.$level.'" row_id="'.$row['id'].'"'
			. ( $this->diafan->config('parent') ? ' parent_id="'.$row['parent_id'].'"' : '' )
			. ( $this->diafan->config('order') ? ' sort_id="'.$row['sort'].'"' : '' )
			. '>
			<a name="'.$row['id'].'">
		    <div class="table_wrap'.(  $this->diafan->config('act') && !$row['act'] ? ' no_act' : '' ).'">
		    <table width="100%" class="rows">
		    <tr>'
			. $this->get_move()
			. $this->group_actions_input($row, $level)
			. $this->get_plus($row)
			. $this->get_parent_name($row)
			. $this->get_date($row)
			. $this->get_image($row["id"])
			. '<td class="name">'
			. $this->diafan->get_base_link($row, $level)
			. $this->get_menu($row['id']);

			if ($this->diafan->table == "site" && $row["module_name"] && file_exists(ABSOLUTE_PATH.'adm/img/icons/'.$row["module_name"].'.gif'))
			{
				echo '<img src="'.BASE_PATH.'adm/img/icons/'.$row["module_name"].'.gif" align="absmiddle" title="'.$this->diafan->_('Подключен модуль').'" alt="'.$this->diafan->_('Подключен модуль').'" class="module_icons">';
			}
			echo $this->get_date_period($row);
			echo '</td>';

			$this->get_fast_rows($row);
			$this->get_other_rows($row);

			echo $this->get_actions($row).'</tr>
			</table></div></a>';
			//выводит вложенные элементы
			if ($this->diafan->config("parent") && in_array($row["id"], $this->parent_parents))
			{
				$this->list_row($row["id"], $level + 1);
			}
			echo  '</li>';
		}
		
		echo '</ul>';
		if (!empty( $links ))
		{
			echo  $this->diafan->_tpl->get('get_admin', 'paginator', $links);
		}
		//if (! $this->diafan->config('parent') && $this->diafan->count > 3)
		if($level < 2 && $this->diafan->count)
		{
			$this->group_action_panel();
		}
	}

	/**
	 * Определяет свойства класса
	 *
	 * @return void
	 */
	public function prepare_variables()
	{
		if ($this->diafan->config("parent") && $this->diafan->parent && empty($this->parent_parents))
		{
			$this->parent_parents = $this->diafan->get_parents($this->diafan->parent, $this->diafan->table);
			$this->parent_parents[] = $this->diafan->parent;
		}
		if($this->diafan->config('element'))
		{
			$cats = array();
			$result = DB::query(
					"SELECT id, "
					.($this->diafan->config('category_no_multilang') ? "name" : "[name]")
					.(! $this->diafan->config('category_flat') ? ", parent_id" : "")
					.($this->diafan->config("element_site") ? ", site_id" : "")
					." FROM {".$this->diafan->table."_category} WHERE trash='0'"
					.($this->diafan->config("element_site") && $this->diafan->site ? " AND site_id='".$this->diafan->site."'" : "")
					." ORDER BY id ASC"
				);
			while ($row = DB::fetch_array($result))
			{
				$cats[] = $row;
			}
			if(count($cats))
			{
				$this->diafan->not_empty_categories = true;
			}
			$this->diafan->categories = $cats;
		}
		if($this->diafan->config('element_site'))
		{
			$sites = array();
			$result = DB::query("SELECT id, [name], parent_id FROM {site} WHERE trash='0' AND module_name='%s' ORDER BY sort ASC", $this->diafan->module);
			while ($row = DB::fetch_array($result))
			{
				$sites[] = $row;
			}
			if(count($sites))
			{
				$this->diafan->not_empty_site = true;
			}
			if (count($sites) == 1)
			{
				$this->diafan->site = $sites[0]["id"];
			}
			$this->diafan->sites = $sites;
		}
	}

	/**
	 * Формирует SQL-запрос для списка элементов
	 *
	 * @param integer $id родитель
	 * @return resource
	 */
	public function sql_query($id)
	{
		$this->diafan->where .= $this->diafan->config("only_self") && DB::query_result("SELECT only_self FROM {users_role} WHERE id=%d LIMIT 1", $this->diafan->_user->role_id) ? " AND (e.admin_id=0 OR e.admin_id=".$this->diafan->_user->id.")" : '';
		$base_link = '';
		if(!empty($this->diafan->text_for_base_link["variable"])
		   // не добавляем в список полей переменные, выбираемые всегда
		   && ! in_array($this->diafan->text_for_base_link["variable"], array('id'))
		   // не добавляем в список полей переменные, добавленные в список как дополнительные поля
		   && (! $this->diafan->config_other_row || ! in_array($this->diafan->text_for_base_link["variable"], array_keys($this->diafan->config_other_row))))
		{
			$base_link = ', e.'.($this->diafan->variable_multilang($this->diafan->text_for_base_link["variable"]) ? '['.$this->diafan->text_for_base_link["variable"].']' : $this->diafan->text_for_base_link["variable"]);
		}
		$config_other_row = '';
		if($this->diafan->config_other_row)
		{
			foreach($this->diafan->config_other_row as $r => $type)
			{
				// не добавляем в список полей переменные, выбираемые всегда
				if(in_array($r, array('id')))
					continue;
				$config_other_row .= ', e.'.($this->diafan->variable_multilang($r) ? '['.$r.']' : $r);
			}
		}
		if($this->diafan->fast_edit_rows)
		{
			foreach($this->diafan->fast_edit_rows as $r => $type)
			{
				if($type != 'function')
				{
					$config_other_row .= ', e.'.($this->diafan->variable_multilang($r) ? '['.$r.']' : $r);
				}
			}
		}

		return DB::query("SELECT e.id"
		.$base_link
		.$config_other_row
		.($this->diafan->config("act") ? ', e.act'.$this->lang_act.' AS act' : '' )
		.($this->diafan->config("parent") ? ', e.parent_id, e.count_children' : '' )
		.($this->diafan->is_variable("date_start") ? ', e.date_start' : '' )
		.($this->diafan->is_variable("date_finish") ? ', e.date_finish' : '' )
		.($this->diafan->config("date") || $this->diafan->config("datetime") ? ', e.created' : '' )
		.($this->diafan->config("view") ? ', e.module_name, e.block' : '' )
		.($this->diafan->config("element_site") ? ', e.site_id' : '' )
		.($this->diafan->config("element_multiple") ? ', e.cat_id' : '' )
		.($this->diafan->config("order") ? ', e.sort' : '' )." FROM {".$this->diafan->table."} as e"
		.($this->diafan->config("element_multiple") && $this->diafan->cat ?
			" INNER JOIN {".$this->diafan->table."_category_rel} AS c ON e.id=c.element_id" .
			" AND e.id=c.element_id AND c.cat_id='".$this->diafan->cat."'" : '' )
		. " WHERE 1=1"
		.($this->diafan->config("parent") ? " AND e.parent_id='".$id."'" : '' )
		.($this->diafan->config("element") && !$this->diafan->config("element_multiple") && $this->diafan->cat ?
		" AND e.cat_id='".$this->diafan->cat."'" : '' )
		.($this->diafan->config("element_site") && $this->diafan->site ?
		" AND e.site_id='".$this->diafan->site."'" : '' ).( $this->diafan->where ? " ".$this->diafan->where : '' )
		.($this->diafan->config("trash") ? " AND e.trash='0'" : '' )
		.($this->diafan->config("element_multiple") && $this->diafan->cat ? " GROUP BY e.id" : '' )
		." ORDER BY "
		.($this->diafan->config("prior") ? 'e.prior DESC, ' : '' )
		.($this->diafan->config("date") || $this->diafan->config("datetime") ? 'e.created DESC, ' : '' )
		.($this->diafan->config("act") ? 'e.act'.$this->lang_act.' DESC, ' : '' )
		.($this->diafan->table == 'site' ? " e.is_menu DESC, e.block ASC, " : '' )
		.($this->diafan->config("order") ? 'e.sort ASC, e.id ASC' : 'e.id DESC' )
		.' LIMIT '.$this->polog.', '.$this->diafan->nastr);
	}

	/**
	 * Формирует постраничную навигацию
	 *
	 * @return array
	 */
	private function prepare_paginator($id)
	{
		if ($this->diafan->_user->admin_nastr)
		{
			$this->diafan->_paginator->nastr = $this->diafan->_user->admin_nastr;
		}
		else
		{
			$this->diafan->_paginator->nastr = $this->diafan->nastr;
		}
		if (!$id || !$this->diafan->config("parent"))
		{
			$this->diafan->_paginator->page = $this->diafan->page;
			$this->diafan->_paginator->navlink = ( $this->diafan->rewrite ? $this->diafan->rewrite.'/' : '' ).( $this->diafan->site ? 'site'.$this->diafan->site.'/' : '' ).( $this->diafan->cat ? 'cat'.$this->diafan->cat.'/' : '' );
			$this->enterlink = $this->diafan->_paginator->navlink.'parent%d/'.( $this->diafan->_paginator->page ? 'page'.$this->diafan->_paginator->page.'/' : '' ).'?';
			$this->diafan->_paginator->get_nav = $this->diafan->get_nav;
			$this->navlink .= $this->diafan->_paginator->navlink.'parent%d/'.( $this->diafan->_paginator->page ? 'page'.$this->diafan->_paginator->page.'/' : '' ).( $this->diafan->get_nav ? $this->diafan->get_nav.'&' : '?' );
		}
		elseif ($this->diafan->config("parent"))
		{
			$this->diafan->_paginator->page = !empty( $_GET["page".$id] ) ? intval($_GET["page".$id]) : 0;
			$this->diafan->_paginator->urlpage = '?page'.$id.'=%d';
			$this->navlink = ( $this->diafan->rewrite ? $this->diafan->rewrite.'/' : '' ).( $this->diafan->site ? 'site'.$this->diafan->site.'/' : '' ).( $this->diafan->cat ? 'cat'.$this->diafan->cat.'/' : '' ). 'parent%d/';
			$this->diafan->_paginator->navlink = sprintf($this->navlink, $id);
			$this->diafan->_paginator->get_nav = '';
		}

		$this->nen = DB::query_result("SELECT COUNT(DISTINCT e.id) FROM {".$this->diafan->table."} as e"
			. ( $this->diafan->config("element_multiple") && $this->diafan->cat ? " INNER JOIN {".$this->diafan->table."_category_rel} AS c ON e.id=c.element_id"
			. " AND e.id=c.element_id AND c.cat_id='".$this->diafan->cat."'" : '' )
			. " WHERE 1=1".( $this->diafan->config("parent") ? " AND e.parent_id='".$id."'" : '' )
			. ( $this->diafan->config("element") && !$this->diafan->config("element_multiple") && $this->diafan->cat ? " AND e.cat_id='".$this->diafan->cat."'" : '' )
			. ( $this->diafan->config("element_site") && $this->diafan->site ? " and e.site_id='".$this->diafan->site."'" : '' )
			. ( $this->diafan->where ? " ".$this->diafan->where : '' )
			. ( $this->diafan->table == 'site' ? " AND e.id<>1" : '' )
			. ( $this->diafan->config("trash") ? " AND e.trash='0'" : '' )
			);
		$this->diafan->_paginator->nen = $this->nen;

		$links = $this->diafan->_paginator->get();
		$this->polog = $this->diafan->_paginator->polog;
		$this->diafan->nastr = $this->diafan->_paginator->nastr;

		return $links;
	}

	/**
	 * Выводит кнопку "Перетащить"
	 *
	 * @return string
	 */
	public function get_move()
	{
		$img = '';
		if ($this->diafan->config('order'))
		{
			$img = '<td class="move"><img src="'.BASE_PATH.'adm/img/drag.png" alt="'.$this->diafan->_('Перетащить').'"></td>';
		}
		return $img;
	}

	/**
	 * Формирует дату в списке
	 *
	 * @param array $row информация о текущем элементе списка
	 * @return string
	 */
	private function get_date($row)
	{
		$html = ($this->diafan->config("date") ? '<td class="date">'.date("d.m.Y", $row["created"]).'</td>' : '')
		. ($this->diafan->config("datetime") ? '<td class="datetime">'.date("d.m.Y H:i", $row["created"]).'</td>' : '');

		return $html;
	}

	/**
	 * Формирует изображение в списке
	 *
	 * @param integer $id номер элемета текущей строки
	 * @return string
	 */
	public function get_image($id)
	{
		$html = '';
		if ($this->diafan->config("image"))
		{
			$row = DB::fetch_array(DB::query("SELECT id, name FROM {images} WHERE element_id=%d AND module_name='%s' AND trash='0' ORDER BY param_id ASC, sort ASC LIMIT 1", $id, $this->diafan->table));
			if ($row && file_exists(ABSOLUTE_PATH.USERFILES."/small/".$row["name"]))
			{
				$html = '<td class="img"><img src="http://'.BASE_URL.'/'.USERFILES.'/small/'.$row["name"].'" border="0" alt=""></td>';
			}
		}

		return $html;
	}

	/**
	 * Выводит название раздела/категории в списке
	 *
	 * @param array $row информация о текущем элементе списка
	 * @return string
	 */
	protected function get_parent_name($row)
	{
		$text = '';
		if ($this->diafan->config("element_site") && ! $this->diafan->site && $this->diafan->not_empty_site)
		{
			if (!isset( $this->cache["site"][$row["site_id"]]["name"] ))
			{
				$this->cache["site"][$row["site_id"]]["name"] = DB::query_result("SELECT [name] FROM {site} WHERE id=%d AND trash='0' LIMIT 1", $row["site_id"]);
			}
			$text = '<td class="parent_name">'.$this->cache["site"][$row["site_id"]]["name"].'</td>';
		}
		if ($this->diafan->config("element_multiple"))
		{
			$cats = array ();
			$result = DB::query(
					"SELECT s.[name] FROM {".$this->diafan->module."_category_rel} as c"
					." INNER JOIN {".$this->diafan->module."_category} as s ON s.id=c.cat_id"
					." WHERE element_id='%d'",
					$row["id"]
				);
			while ($row_cat = DB::fetch_array($result))
			{
				$cats[] = $row_cat["name"];
			}
			$text .= '<td class="cat_name">'.implode(', ', $cats).'</td>';
		}
		return $text;
	}

	/**
	 * Выводит форму быстрого редактирования полей для элемента в списке
	 *
	 * @param array $row информация о текущем элменте списка
	 * @return void
	 */
	private function get_fast_rows($row)
	{
		if ($this->diafan->fast_edit_rows)
		{
			$rows = array ();
			foreach ($this->diafan->fast_edit_rows as $value=> $type)
			{
				if($type == 'function')
				{
					$func = 'fast_row_'.preg_replace('/[^a-z_]+/', '', $value);
					if (call_user_func_array (array(&$this->diafan, $func), array($row)) !== 'fail_function')
					{
						continue;
					}
				}

				echo '</td><td class="fast_edit">';
				switch ($type)
				{
					case 'text':
						echo '<input type="text" row_id="'.$row['id'].'" name="'.$value.'" value="'.$row[$value].'">';
						break;

					case 'numtext':
						echo '<input type="text" row_id="'.$row['id'].'" name="'.$value.'" value="'.$row[$value].'" class="inpnum">';
						break;

					case 'floattext':
						echo '<input type="text" row_id="'.$row['id'].'" name="'.$value.'" value="'.number_format($row[$value], 2, ',', '').'" class="inpnum">';
						break;

					case 'editor':
					case 'textarea':
						echo ' <textarea name="'.$value.'" row_id="'.$row['id'].'" cols="40" rows="3">'.str_replace(array ( '<',
							'>', '"' ), array ( '&lt;', '&gt;', '&quot;' ), $row[$value]).'</textarea>';
						break;
				}
				echo '</td>';
			}
		}
	}

	/**
	 * Выводит дополнительную информацию для элемента в списке
	 *
	 * @param array $row информация о текущем элменте списка
	 * @return void
	 */
	private function get_other_rows($row)
	{
		if ($this->diafan->config_other_row)
		{
			foreach ($this->diafan->config_other_row as $value => $type)
			{
				$class = '';
				if(is_array($type))
				{
					$class = $type["class"];
					$type = $type["type"];
				}
				$func = 'other_row_'.preg_replace('/[^a-z_]+/', '', $value);
				$result = call_user_func_array (array(&$this->diafan, $func), array($row));
				if ($result === 'fail_function')
				{
					switch($type)
					{
						case 'text':
							echo '<td class="'.($class ? $class : 'comment').'">
							<div>
								<span></span>
								<table><tbody><tr><td>
									'.( !empty( $row[$value] ) ? $this->diafan->short_text($row[$value]) : '' ).'
								</td></tr></tbody></table>
							</div></td>';
							break;

						case 'string':
							echo '<td'.($class ? ' class="'.$class.'"' : '').'>'.( !empty( $row[$value] ) ? $row[$value] : '' ).'</td>';
							break;

						case 'select':
							echo '<td'.($class ? ' class="'.$class.'"' : '').'>'.$this->diafan->select_arr($value, $row[$value]).'</td>';
							break;

						case 'none':
							break;
					}
				}
				else
				{
					echo $result;
				}
			}
		}
	}

	/**
	 * Выводит пометку "Отображается в меню"
	 *
	 * @param integer $id номер текущего элемента
	 * @return string
	 */
	private function get_menu($id)
	{
		$text = '';
		if ($this->diafan->config("menu"))
		{
			if ($this->diafan->module == 'site')
			{
				$name_menu = 'site_id';
			}
			elseif ($this->diafan->config("category"))
			{
				$name_menu = 'module_cat_id';
			}
			else
			{
				$name_menu = 'element_id';
			}
			$is_menu = 0;
			if (DB::query_result("SELECT COUNT(*) FROM {menu} WHERE module_name='%h' AND ".$name_menu."=%d AND trash='0' AND [act]='1'", $this->diafan->module, $id))
			{
				$text = ' <span title="'.$this->diafan->_('Отображается в меню').'">('.$this->diafan->_('м').')</span>';
				if ($this->diafan->module == 'site')
				{
					$is_menu = 1;
				}
			}
			if ($this->diafan->module == 'site')
			{
				DB::query("UPDATE {site} SET is_menu='%d' WHERE id=%d", $is_menu, $id);
			}
		}
		return $text;
	}

	/**
	 * Выводит период показа
	 *
	 * @param array данные о текущем элементе
	 * @return string
	 */
	private function get_date_period($row)
	{
		$text = '';
		if(! empty($row["date_start"]) || ! empty($row["date_finish"]))
		{
			if($this->diafan->variable("date_start") == 'date')
			{
				$time = mktime(0,0,0);
			}
			else
			{
				$time = time();
			}
			$text .= '<div class="date_period';
			if($row["date_start"] > $time || ! empty($row["date_finish"]) && $row["date_finish"] < $time)
			{
				$text .= '_red';
			}
			$text .= '">';
			if(! empty($row["date_start"]))
			{
				if(empty($row["date_finish"]))
				{
					$text .= '> ';
				}
				$text .= date('d.m.Y', $row["date_start"]);
			}
			if(! empty($row["date_finish"]))
			{
				if(empty($row["date_start"]))
				{
					$text .= '< ';
				}
				else
				{
					$text .= ' - ';
				}
				$text .= date('d.m.Y', $row["date_finish"]);
			}
			$text .= '</div>';
		}
		return $text;
	}

	/**
	 * Выводит чекбокс для групповых операций
	 *
	 * @param integer $id номер текущего элемента
	 * @param integer $level текущий уровень вложенности
	 * @return string
	 */
	private function group_actions_input($row, $level)
	{
		$input = '';

		if ($this->diafan->check_delete($row) &&
			($this->diafan->config("del") && $this->diafan->_user->roles('del', $this->diafan->rewrite)
			|| $this->diafan->config("act") && $this->diafan->_user->roles('edit', $this->diafan->rewrite)
			|| $this->diafan->config("menu") && !$this->diafan->_user->roles('edit')
			|| $this->diafan->not_empty_categories
			|| $this->diafan->group_action)
		)
		{
			$input = '<input type="checkbox" name="ids[]" value="'.$row["id"].'">';
		}


		return '<td class="checkbox">'.$input.'</td>';
	}

	/**
	 * Выводит кнопки действий над элементом
	 *
	 * @param array $row информация о текущем элменте списка
	 * @return string
	 */
	public function get_actions($row)
	{
		static $num_actions;

		if ($this->diafan->config("menu") && $row["act"])
		{
			if ($this->diafan->module == "site")
			{
				$row["view_link"] = $this->diafan->_route->link($row["id"]);
			}
			elseif ($this->diafan->config("category"))
			{
				$row["view_link"] = $this->diafan->_route->link($row["site_id"], $this->diafan->module, $row["id"]);
			}
			else
			{
				if (!$this->diafan->config("element"))
				{
					$row["cat_id"] = 0;
				}
				$row["view_link"] = $this->diafan->_route->link($row["site_id"], $this->diafan->module, $row["cat_id"], $row["id"]);
			}
		}

		$actions = array ();

		//add
		if ($this->diafan->config("parent") && $this->diafan->_user->roles('edit', $this->diafan->rewrite) && $this->diafan->table != "trash" && ( !$this->diafan->config("view") || !$row["block"] ) && ( $this->diafan->config("act") && $row["act"] ))
		{
			$actions[] = '<td class="action_icon"><a href="'.$this->diafan->get_admin_url('parent').'parent'.$row["id"].'/'.'addnew'.$row["id"].'/" title="'.$this->diafan->_('Создать подстраницу').'"><img src="'.BASE_PATH.'adm/img/add.png" alt="'.$this->diafan->_('Создать подстраницу').'"></a></td>';
		}

		//act
		if ($this->diafan->config("act") && $this->diafan->_user->roles('edit', $this->diafan->rewrite) && ( $this->diafan->table != "users" || $row["id"] != $this->diafan->_user->id ))
		{
			$actions[] = '<td class="action_icon"><a href="javascript:void(0);" title="'.( $row["act"] ? $this->diafan->_('Сделать неактивным') : $this->diafan->_('Сделать активным') ).'" action="'.( $row["act"] ? 'un' : '' ).'block">'.'<img src="'.BASE_PATH.'adm/img/on.png" alt="'.( $row["act"] ? $this->diafan->_('Сделать неактивным') : $this->diafan->_('Сделать активным') ).'"></a></td>';
		}

		//del|trash
		if ($this->diafan->config("del")
			&& $this->diafan->_user->roles('del', $this->diafan->rewrite)
			&& $this->diafan->check_delete($row))
		{
			$actions[] = '<td class="action_icon"><a href="#" title="'.$this->diafan->_('Удалить').'"'.' confirm="'
			.(!empty( $row["count_children"] ) ? $this->diafan->_('ВНИМАНИЕ! Пункт содержит вложенность! ') : '')
			.($this->diafan->config("category") ? $this->diafan->_('При удалении категории удаляются все принадлежащие ей элементы. ') : '')
			.($this->diafan->config("trash") ? $this->diafan->_('Вы действительно хотите удалить запись в корзину?') : $this->diafan->_('Вы действительно хотите удалить запись?'))
			. '" action="'.( $this->diafan->config("trash") ? 'trash' : 'delete' ).'">'
			. '<img src="'.BASE_PATH.'adm/img/delete.png" alt="'.$this->diafan->_('Удалить').'"></a></td>';
		}

		if ($this->diafan->config("menu") && ( !$this->diafan->config("view") || !$row["block"] ))
		{
			$actions [] = '<td class="action_icon">'.($row["act"] ? '<a href="'.BASE_PATH._SHORTNAME.$row["view_link"].'" title="'.$this->diafan->_('Посмотреть на сайте').'" target="_blank">'.'<img src="'.BASE_PATH.'adm/img/view.png" alt="'.$this->diafan->_('Посмотреть на сайте').'"></a>' : '').'</td>';
		}

		$count = count($actions);

		$new = '';
		if($count >= $num_actions) { $num_actions=$count; }
		else
		{
			//$new=array_fill(0,$num_actions-$count,'<td class="action_icon"></td>');
			//$new=implode('<td style="width: 2px;"><span></span></td>', $new);
			$new=str_repeat('<td style="width: 2px;"></td><td class="action_icon"></td>',$num_actions-$count);
		}

		return $new.($count?'<td class="action_separator"><span></span></td>'.implode('<td class="action_separator"><span></span></td>', $actions):'');
	}

	/**
	 * Проверяет можно ли удалить текущий элемент строки
	 *
	 * @param array $row информация о текущем элменте списка
	 * @return boolean
	 */
	public function check_delete($row)
	{
		return true;
	}

	/**
	 * Формирует основную ссылку для элемента в списке
	 *
	 * @param array $row информация о текущем элменте списка
	 * @param integer $level уровень вложенности
	 * @return string
	 */
	public function get_base_link($row, $level)
	{
		if(! $this->diafan->text_for_base_link)
		{
			return '';
		}
		$name  = '';
		if(! empty($this->diafan->text_for_base_link["variable"]))
		{
			$name = $this->diafan->short_text($row[$this->diafan->text_for_base_link["variable"]], 20);
		}
		if(! empty($this->diafan->text_for_base_link["text"]))
		{
			$name = sprintf($this->diafan->_($this->diafan->text_for_base_link["text"]), $name);
		}
		if (! $name)
		{
			$name = $row['id'];
		}

		$link = '<a href="';
		if ($this->diafan->config("view") && $row["module_name"] && file_exists(ABSOLUTE_PATH.'modules/'.$row["module_name"].'/admin/'.$row["module_name"].'.admin.php'))
		{
			$link .= BASE_PATH_HREF.$row["module_name"].'/site'.$row["id"].'/';
		}
		elseif ($this->diafan->config("link_to_element"))
		{
			$link .= $this->diafan->_route->current_admin_link(array ( "page", "parent" )).'cat'.$row["id"].'/';
		}
		elseif ($this->diafan->config("element_site") && $this->diafan->_user->roles('init', $this->diafan->rewrite))
		{
			$link .= $this->diafan->_route->current_admin_link('site').'site'.$row['site_id'].'/edit'.$row["id"].'/'.$this->diafan->get_nav.'" title="'.$this->diafan->_('Редактировать').' ('.$row["id"].')';
		}
		elseif ($this->diafan->_user->roles('init', $this->diafan->rewrite))
		{

			$link .= $this->diafan->_route->current_admin_link().'edit'.$row["id"].'/'.$this->diafan->get_nav.'" title="'.$this->diafan->_('Редактировать').' ('.$row["id"].')';
		}
		else
		{
			$link .= '#';
		}
		$link .= '"';
		if ($this->diafan->config("act") && !$row["act"])
		{
			$link .= ' class="noplus"';
		}
		$link .= '>'.$name.'</a>';
		return $link;
	}

	/**
	 * Формирует ссылку на раскрытие дерева
	 *
	 * @param array $row информация о текущем элменте списка
	 * @return string
	 */
	private function get_plus($row)
	{
		if (!$this->diafan->config('parent'))
		{
			return null;
		}

		$act = '';
		if ($this->diafan->config('act') && !$row['act'])
		{
			$act = '_no_act';
		}

		$html = '';

		if ($row["count_children"])
		{
			if (in_array($row["id"], $this->parent_parents))
			{
				$html = '<a href="#" rel="'.$row['id'].'" class="plus turn" title="'.$this->diafan->_('Свернуть').'"><img src="'.BASE_PATH.'adm/img/item_minus'.$act.'.png" alt="'.$this->diafan->_('Свернуть').'"></a>';
			}
			else
			{
				$html = '<a href="#parent'.$row['id'].'" rel="'.$row['id'].'" class="plus expand" title="'.$this->diafan->_('Развернуть').'"><img src="'.BASE_PATH.'adm/img/item_plus'.$act.'.png" alt="'.$this->diafan->_('Развернуть').'"></a>';
			}
			$this->is_plus = true;
		}

		return '<td class="item_plus_minus">'.$html.'</td>';
	}

	/**
	 * Выводит панель групповых операций
	 *
	 * @return string
	 */
	private function group_action_panel()
	{
		$value = ! empty($_SESSION["group_action"][$this->diafan->rewrite]) ? $_SESSION["group_action"][$this->diafan->rewrite] : "";

		$html = '<div class="group_action'.(!$this->diafan->config('order') ? ' no_move':'').'">
		<form method="post" class="ajax">
		<input type="hidden" name="ajax" value="0">
		<input type="hidden" name="group_action" value="true">

		<table><tr>
		<td><input type="checkbox" id="select_all"></td>';
		if ($this->is_plus)
		{
			$html .= '<td><a href="#parents" class="plus_all expand" title="'.$this->diafan->_('Развернуть всё').'"><img src="'.BASE_PATH.'adm/img/item_plus.png" alt="'.$this->diafan->_('Развернуть всё').'"></a></td>';
		}
		
		$html .= '
		<td><span class="select_all">'.$this->diafan->_('Отметить все').'</span></td>
		<td><select name="action">';

		if ($this->diafan->config("act") && $this->diafan->_user->roles('edit'))
		{
			$html .= '<option value="block"'.($value == 'block' ? ' selected' : '').'>'.$this->diafan->_('Сделать активным').'</option><option value="unblock"'.($value == 'unblock' ? ' selected' : '').'>'.$this->diafan->_('Сделать неактивным')."</option>";
		}

		if ($this->diafan->config("del") && $this->diafan->_user->roles('del'))
		{
			$html .= '<option value="'.( $this->diafan->config("trash") ? 'trash' : 'delete' )
			. '" confirm="'.( $this->diafan->config("trash") ? $this->diafan->_('Вы действительно хотите удалить запись в корзину?') : $this->diafan->_('Вы действительно хотите удалить запись?') )
			.'"'.($value == 'trash' || $value == 'delete' ? ' selected' : '').'>'
			. $this->diafan->_('Удалить').'</option>';
		}

		if ($this->diafan->config("menu") && $this->diafan->_user->roles('edit'))
		{
			$html .= '<option value="group_menu" module="menu"'.($value == 'group_menu' ? ' selected' : '').'>'.$this->diafan->_('Отображается в меню').'</option>';
		}

		if ($this->diafan->not_empty_categories)
		{
			$html .= '<option value="element"'.($value == 'element' ? ' selected' : '').'>'.$this->diafan->_('Переместить в категорию').'</option>';
		}
		elseif ($this->diafan->not_empty_site && count($this->diafan->sites) > 1)
		{
			$html .= '<option value="element"'.($value == 'element' ? ' selected' : '').'>'.$this->diafan->_('Переместить в раздел').'</option>';
		}
		
		if($this->diafan->group_action)
		{
			foreach($this->diafan->group_action as $action => $row)
			{
				$html .= '<option value="'.$action.'"'.(! empty($row["module"]) ? ' module="'.$row["module"].'"' : '').'>'.$row["name"].'</option>';
			}
		}

		$html .= '</select></td><td><input type="submit" id="group_actions" value="'.$this->diafan->_('Применить').'" class="button"></td>';
		if(! isset($this->cache["show_change_nastr"]))
		{
			$html .= '<td>'.$this->diafan->_('На странице:').' <input name="nastr" value="'.$this->diafan->_paginator->nastr.'" size="2" type="text"></td>
			<td><input type="button" id="change_nastr" value="'.$this->diafan->_('Изменить').'" class="button"></td></tr>';
			$this->cache["show_change_nastr"] = true;
		}
		$html .= '<tr class="dop_rows"><td colspan="3">'.$this->diafan->group_action_panel_filter($value).'</td><td></td></tr>
</table>
		</form></div>';

		echo $html;
	}

	/**
	 * Выводит фильтры для панели групповых  операций
	 *
	 * @param string $value последнее выбранное значение в списке групповых операций
	 * @return string
	 */
	public function group_action_panel_filter($value)
	{
		$dop = '';

		if ($this->diafan->config("menu") && $this->diafan->_user->roles('edit'))
		{
			$result = DB::query("SELECT id, [name] FROM {menu_category} WHERE trash='0' ORDER BY id ASC");
			$dop .= '<div class="dop_group_menu'.($value != 'group_menu' ? ' hide' : '').'">';
			$dop .= '<input type="hidden" name="table" value="'.$this->diafan->table.'">';
			while ($row = DB::fetch_array($result))
			{
				$dop .= '<input type="checkbox" name="menu_cat_ids[]" value="'.$row["id"].'"> '.$row["name"].'<br>';
			}
			$dop .= "</div>";
		}

		if ($this->diafan->not_empty_categories)
		{
			$cat = $this->diafan->show_filter(true);
			$dop .= '<div class="dop_element'.($value != 'element' ? ' hide' : '').'">'.str_replace(array(' class="redirect" ','name="cat"'), array('','name="cat_id"'), $cat).'</div>';
		}
		elseif ($this->diafan->not_empty_site && count($this->diafan->sites) > 1)
		{
			$cat = $this->diafan->show_filter();
			$dop .= '<div class="dop_element'.($value != 'element' ? ' hide' : '').'">'.str_replace(array(' class="redirect" ','name="site"'), array('','name="site_id"'), $cat).'</div>';
		}

		return $dop;
	}
}