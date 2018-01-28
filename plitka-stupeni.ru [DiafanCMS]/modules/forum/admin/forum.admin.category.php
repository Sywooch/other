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
 * Forum_admin_category
 *
 * Редактирование категорий форума
 */
class Forum_admin_category extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'forum_category';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Название',
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'default' => true,
			),
			'del' => array(
				'type' => 'checkbox',
				'name' => 'Удалено модератором',
			),
			'prior' => array(
				'type' => 'checkbox',
				'name' => 'Закрепить тему (всегда сверху)',
			),
			'close' => array(
				'type' => 'checkbox',
				'name' => 'Закрыть тему',
			),
			'author' => array(
				'type' => 'function',
				'name' => 'Автор',
				'no_save' => true,
			),
			'created' => array(
				'type' => 'datetime',
				'name' => 'Дата',
				'help' => 'Вводится в формате дд.мм.гггг чч:мм',
			),
			'user_update' => array(
				'type' => 'function',
				'no_save' => true,
			),
			'parent_id' => array(
				'type' => 'function',
				'name' => 'Вложенность: принадлежит',
			),
			'counter_view' => array(
				'type' => 'function',
				'name' => 'Количество просмотров',
				'no_save' => true,
			),
			'rewrite'       => array(
				'type' => 'function',
				'name' => 'Псевдоссылка',
				'help' => 'ЧПУ (человеко-понятные урл url), адрес страницы вида: site.ru/psewdossylka/. Смотрите настройки сайта'
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'act', // показать/скрыть
		'del', // удалить
		'category', // часть модуля - категории
		'link_to_element', // основная ссылка ведет к списку элементов, принадлежащих категории
		'trash', // использовать корзину
		'datetime', // показывать дату в списке, сортировать по дате
		'parent', // содержит вложенности
	);

	/**
	 * @var integer количество строк, выводимых на странице
	 */
	public $nastr = 100;

	/**
	 * @var integer уровень текущей категории
	 */
	private $level = 0;

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		if($this->diafan->edit)
		{
			if($this->diafan->addnew)
			{
				$this->level = count($this->diafan->get_parents($this->diafan->parent, 'forum_category')) + 1;
			}
			else
			{
				$this->level = count($this->diafan->get_parents($this->diafan->edit, 'forum_category'));
			}
			switch($this->level)
			{
				case 0:
					$this->diafan->variable_unset('counter_view');
					$this->diafan->variable_unset('rewrite');
					$this->diafan->variable_unset('del');
					$this->diafan->variable_unset('close');
					break;
				case 1:
					$this->diafan->variable_unset('close');
					break;
				case 2:
					break;
			}
		}
	}

	/**
	 * Выводит список категорий
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить категорию');

		$this->diafan->list_row();

		if (! $this->diafan->count)
		{
			echo '<div class="error">'.$this->diafan->_('Обязательно создайте главные категории форума!').'</div>';
		}
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
		$link = '<a href="';
		if ($level == 3)
		{
			$link .= $this->diafan->_route->current_admin_link(array ( "page", "parent" )) . 'cat' . $row["id"] . '/';
		}
		elseif ($this->diafan->_user->roles('init', $this->diafan->rewrite))
		{

			$link .= $this->diafan->_route->current_admin_link() . 'edit' . $row["id"] . '/'.$this->diafan->get_nav.'" title="' . $this->diafan->_('Редактировать') . ' (' . $row["id"] . ')';
		}
		else
		{
			$link .= '#';
		}
		$link .= '"';
		if (!  $row["act"])
		{
			$link .= ' class="noplus"';
		}
		$link .= '>'.$row["name"].'</a>';
		return $link;
	}

	/**
	 * Редактирование поля "Обновление"
	 * @return void
	 */
	public function edit_variable_user_update()
	{
		if (! $this->diafan->value)
			return;
		echo '
		<tr>
			<td align="right">'.$this->diafan->variable_name().'</td>
			<td>'
			.DB::query_result("SELECT fio FROM {users} WHERE id=%d LIMIT 1", $this->diafan->value).', '.date("d.m.Y H:i", $this->diafan->values["date_update"])
			.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Количетсво просмотров"
	 * @return boolean true
	 */
	public function edit_variable_counter_view()
	{
		if ($this->diafan->addnew)
			return;
	
		echo '<tr><td align="right">'.$this->diafan->variable_name().'</td><td>'.$this->diafan->value.'</td></tr>';
	}

	/**
	 * Редактирование поля "Принадлежит"
	 *
	 * @return void
	 */
	public function edit_variable_parent_id()
	{
		if ($this->diafan->addnew)
		{
			parent::__call('edit_variable_parent_id', array());
			return;
		}
		if($this->level == 0)
			return;

		$parents[0] = array();
		$result = DB::query(
				"SELECT c.id, c.name, COUNT(p.id) AS count FROM {forum_category} AS c"
				." LEFT JOIN {forum_category_parents} AS p ON p.element_id=c.id"
				." GROUP BY c.id HAVING count=%d ORDER BY name ASC", $this->level - 1
			);
		while($row = DB::fetch_array($result))
		{
			$parents[0][] = $row;
		}

		echo '
		<tr valign="top" id="parent_id">
			<td class="td_first">' . $this->diafan->variable_name() . '</td>
			<td>
			<select name="parent_id">';
			if (! empty( $parents[0] ))
			{
				echo $this->diafan->get_options($parents, $parents[0], array($this->diafan->value));
			}
			echo '</select>
			' . $this->diafan->help() . '
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Псевдоссылка"
	 *
	 * @return void
	 */
	public function edit_variable_rewrite()
	{
		$rewrite = '';
		$redirect = '';
		$redirect_code = 301;
		if (! $this->diafan->addnew)
		{
			if ($this->level == 1)
			{
				$rewrite = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='%s' AND cat_id=%d LIMIT 1", $this->diafan->module, $this->diafan->edit);
				$row_redirect = DB::fetch_array(DB::query("SELECT redirect, code FROM {redirect} WHERE module_name='%s' AND cat_id=%d AND element_id=0 LIMIT 1", $this->diafan->module, $this->diafan->edit));
				$redirect = $row_redirect["redirect"];
				$redirect_code = $row_redirect["code"];
			}
			else
			{
				$rewrite = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='%s' AND element_id=%d LIMIT 1", $this->diafan->module, $this->diafan->edit);
				$row_redirect = DB::fetch_array(DB::query("SELECT redirect, code FROM {redirect} WHERE module_name='%s' AND element_id=%d LIMIT 1", $this->diafan->module, $this->diafan->edit));
				$redirect = $row_redirect["redirect"];
				$redirect_code = $row_redirect["code"];
			}
		}
		if(! $redirect_code)
		{
			$redirect_code = 301;
		}
		$rewrite_site = '';
		if (!$rewrite)
		{
			if ($this->diafan->addnew)
			{
				$this->diafan->values["parent_id"] = $this->diafan->parent;
				$this->diafan->values["cat_id"] = $this->diafan->cat;
			}
			$this->diafan->values["site_id"] = DB::query_result("SELECT id FROM {site} WHERE module_name='%s' AND trash='0' AND [act]='1' LIMIT 1", $this->diafan->module);
			if (( !$this->diafan->values["parent_id"] || !$rewrite_site = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='%s' AND cat_id=%d LIMIT 1", $this->diafan->module, $this->diafan->values["parent_id"]) ) && !empty( $this->diafan->values["site_id"] ))
			{
				$rewrite_site = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND site_id=%d LIMIT 1", $this->diafan->values["site_id"]);
			}
		}
		echo '
		<tr id="rewrite">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				'.BASE_URL.'/'.( $rewrite_site ? $rewrite_site.'/' : '' ).'<input type="text" name="rewrite" size="40" value="'.$rewrite.'">'.ROUTE_END .'&nbsp;'. $this->diafan->help().'
			</td>
		</tr>
		<tr id="redirect">
			<td class="td_first">'.$this->diafan->_('Редирект на текущую страницу со страницы').':</td>
			<td>
				'.BASE_URL.'/<input type="text" name="rewrite_redirect" size="40" value="'.$redirect.'">
				<br>'.$this->diafan->_('Код ошибки').'
				<input type="text" name="rewrite_code" size="5" value="'.$redirect_code.'">
			</td>
		</tr>';
	}

	/**
	 * Сохранение псевдоссылки
	 *
	 * @return void
	 */
	public function get_rewrite()
	{
		$this->diafan->is_save_rewrite = true;

		if(empty($_POST["parent_id"]))
		{
			return;
		}

		$this->is_category = false;
		if(count($this->diafan->get_parents($_POST["parent_id"], "forum_category")) == 0)
		{
			$this->is_category = true;
		}

		if($this->diafan->addnew)
		{
			$old_rewrite = '';
		}
		else
		{
			$old_rewrite = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='%s' AND ".($this->is_category ? "cat" : "element")."_id=%d LIMIT 1", $this->diafan->module, $this->diafan->save);
		}

		// если нет изменений, выход
		if($old_rewrite && $_POST["rewrite"] == $old_rewrite)
		{
			return;
		}

		$this->diafan->_cache->delete("", "rewrite");

		DB::query("DEV DELETE FROM {rewrite} WHERE module_name='%s' AND (cat_id=%d OR element_id=%d)", $this->diafan->module, $this->diafan->save, $this->diafan->save);

		$rewrite = '';
		$site_id = DB::query_result("SELECT id FROM {site} WHERE module_name='forum' AND trash='0' AND [act]='1' LIMIT 1");

		if (!empty( $_POST["rewrite"] ))
		{
			$rewrite = $_POST["rewrite"];
		}
		else
		{
			if(! ROUTE_AUTO_MODULE)
			{
				return;
			}
			$rewrite = $this->diafan->generate_rewrite();

			if(! $this->is_category)
			{
				$parent_rewrite = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='%s' AND cat_id=%d LIMIT 1", $this->diafan->module, $_POST["parent_id"]);
			}
			if(empty($parent_rewrite))
			{
				$parent_rewrite = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND site_id=%d LIMIT 1", $site_id);
			}
			$rewrite = ($parent_rewrite ? $parent_rewrite.'/' : '').$rewrite;
		}
		//если такая псевдоссылка принадлежит другому элементу, добавляем номер id
		if (DB::query_result("SELECT id FROM {rewrite} WHERE rewrite='%s' LIMIT 1", $rewrite))
		{
			$rewrite .= $this->diafan->save;
		}
		DB::query("INSERT INTO {rewrite} (module_name, ".($this->is_category ? "cat" : "element")."_id, rewrite, site_id) VALUES ('%s', %d, '%h', %d)", $this->diafan->module, $this->diafan->save, $rewrite, $site_id);
		if($this->is_category)
		{
			$result = DB::query("SELECT r.id as rid, r.rewrite, s.id, s.name FROM {forum_category} AS s"
								." LEFT JOIN {rewrite} AS r ON r.element_id=s.id AND r.module_name='forum'"
								." WHERE s.parent_id=%d AND s.id<>%d", $this->diafan->save, $this->diafan->save);
			while ($row = DB::fetch_array($result))
			{
				if (empty( $row["rewrite"] ))
				{
					$rewrite1 = $rewrite.'/'.$this->diafan->generate_rewrite($row["name"]);
				}
				else
				{
					$rew = explode("/", $row["rewrite"]);
					if (empty( $rew[count($rew) - 1] ))
					{
						$rewrite1 = $rewrite.'/'.$this->diafan->generate_rewrite($row["name"]);
					}
					else
					{
						$rewrite1 = $rewrite.'/' . $rew[count($rew) - 1];
					}
				}
				if($row["rid"])
				{
					DB::query("UPDATE {rewrite} SET rewrite='%h' WHERE id=%d", $rewrite1, $row["rid"]);
				}
				else
				{
					DB::query("INSERT INTO {rewrite} (module_name, element_id, rewrite, site_id) VALUES ('%s', %d, '%h', %d)", $this->diafan->module, $row["id"], $rewrite1, $site_id);
				}
				$this->save_children_rewrite($row["id"], $rewrite1);
			}
		}
	}

	/**
	 * Валидация поля "Псевдоссылка"
	 *
	 * @return void
	 */
	public function validate_variable_rewrite()
	{
		$rewrite_id = 0;
		$redirect_id = 0;
		if(! $this->diafan->addnew)
		{
			if ($this->level == 1)
			{
				$rewrite_id = DB::query_result("SELECT id FROM {rewrite} WHERE module_name='%s' AND cat_id=%d LIMIT 1", $this->diafan->module, $this->diafan->edit);

				$redirect_id = DB::query_result("SELECT id FROM {redirect} WHERE module_name='%s' AND cat_id=%d AND element_id=0 LIMIT 1", $this->diafan->module, $this->diafan->edit);
			}
			else
			{
				$rewrite_id = DB::query_result("SELECT id FROM {rewrite} WHERE module_name='%s' AND element_id=%d LIMIT 1", $this->diafan->module, $this->diafan->edit);

				$redirect_id = DB::query_result("SELECT id FROM {redirect} WHERE module_name='%s' AND element_id=%d LIMIT 1", $this->diafan->module, $this->diafan->edit);
			}
		}
		if(! empty($_POST["rewrite"]))
		{
			if(DB::query_result("SELECT id FROM {rewrite} WHERE rewrite='%h' AND id<>%d AND trash='0' LIMIT 1", $_POST["rewrite"], $rewrite_id))
			{
				$this->diafan->set_error("rewrite", "Псевдоссылка уже есть в базе");
			}
		}
		if(! empty($_POST["rewrite_redirect"]))
		{
			if(DB::query_result("SELECT id FROM {redirect} WHERE redirect='%s' AND id<>%d LIMIT 1", $_POST["rewrite_redirect"], $redirect_id))
			{
				$this->diafan->set_error("redirect", "Редирект на этот URL уже есть в базе");
			}
		}
	}

	/**
	 * Удаляет категорию
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
			$dels = $this->diafan->get_children($id, "forum_category");
			$dels[] = $id;
			DB::query("DELETE FROM {forum_show} WHERE table_name='forum_category' AND element_id IN (".implode(",", $dels).")");
			DB::query("DELETE FROM {forum_show} WHERE table_name='forum' AND element_id IN (SELECT id FROM {forum} WHERE cat_id IN (".implode(",", $dels)."))");
		}

		parent::__call('del', array());
	}
}