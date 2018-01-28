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
 * Site_admin
 *
 * Редактирование страниц сайта
 */
class Site_admin extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'site';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main'       => array (
			'name'     => array(
				'type' => 'text',
				'name' => 'Название',
				'help' => 'Название страницы, отображается в ссылках на страницу, используется для автоматической генерации заголовка страниц и ЧПУ',
				'multilang' => true
			),
			'act'     => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'help' => 'Отображение страницы на сайте. Если не отмечена, страница на сайте не будет показываться и выдаст 404 ошибку (Не найдено)',
				'multilang' => true
			),
			'menu'     => array(
				'type' => 'module',
				'name' => 'Создать пункт в меню',
				'help' => 'Если отметить, ссылка на страницу появится в соответствующем меню'
			),
			'tags'     => array(
				'type' => 'module',
				'name' => 'Теги',
			),
			'comments'     => array(
				'type' => 'module',
				'name' => 'Комментарии',
			),
			'hr4'      => 'hr',
			'text'     => array(
				'type' => 'editor',
				'name' => 'Контент страницы (верх)',
				'multilang' => true
			),
			'text_niz'     => array(
				'type' => 'editor',
				'name' => 'Контент страницы (низ)',
				'multilang' => true
			),
			'search'   => 'module'
		),
		'other_rows' => array (
			'hr1'           => 'hr',
			'images'     => array(
				'type' => 'module',
				'name' => 'Изображения',
			),
			'number'        => array(
				'type' => 'function',
				'name' => 'Номер',
				'help' => 'Номер элемента в БД. (для разработчиков)'
			),
			'block'         => array(
				'type' => 'checkbox',
				'name' => 'Блок на сайте',
				'help' => 'Если отметить, страница не будет отображаться на сайте в виде страницы, и ее можно будет использовать как блок, т.е. участок шаблона. Например, для организации часторедактируемых контактов в шапке или подвале сайта. Выводится тегом show_block (читайте документацию). (Для разработчиков)'
			),
			'site_ids'         => array(
				'type' => 'function',
				'name' => 'Отображать на страницах',
			),
			'hr_block'           => 'hr',
			'title_meta'    => array(
				'type' => 'text',
				'name' => 'Заголовок окна в браузере, тэг Title',
				'help' => 'Если не заполнен, тег title будет автоматически сформирован как "Название страницы - Название сайта"',
				'multilang' => true
			),
			'keywords'      => array(
				'type' => 'text',
				'name' => 'Ключевые слова, тэг Keywords',
				'multilang' => true
			),
			'descr'         => array(
				'type' => 'textarea',
				'name' => 'Описание, тэг Description',
				'multilang' => true
			),
			'js'            => array(
				'type' => 'textarea',
				'name' => 'JavaScript',
				'help' => 'Поле для ввода JavaScript на текущей странице. Например, для кода Яндекс.Карт (для разработчиков)'
			),
			'rewrite'       => array(
				'type' => 'function',
				'name' => 'Псевдоссылка',
				'help' => 'ЧПУ (человеко-понятные урл url), адрес страницы вида: site.ru/psewdossylka/. Смотрите настройки сайта'
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
			'access'        => array(
				'type' => 'function',
				'name' => 'Доступ',
				'help' => 'Ограничение доступа различного вида пользователей сайта к текущей странице'
			),
			'date_start' => array(
				'type' => 'date',
				'name' => 'Период показа',
			),
			'date_finish' => array(
				'type' => 'date',
			),
			'hr_period' => 'hr',
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
			'title_no_show' => array(
				'type' => 'checkbox',
				'name' => 'Не копировать название в заголовок Н1',
				'help' => 'Если отмечено, заголовок Н1 перед текстом страницы автоматически выводиться не будет'
			),
			'map_no_show'   => array(
				'type' => 'checkbox',
				'name' => 'Не показывать на карте сайта'
			),
			'noindex'   => array(
				'type' => 'checkbox',
				'name' => 'Не индексировать'
			),
			'search_no_show'   => array(
				'type' => 'checkbox',
				'name' => 'Не показывать в результатах поиска по сайту'
			),
			'hr2'           => 'hr',
			'module_name'     => array(
				'type' => 'select',
				'name' => 'Прикрепить модуль',
				'help' => 'Прикрепление модуля к странице. Содержимое модуля выведется после текста страницы'
			),
			'parent_id'     => array(
				'type' => 'select',
				'name' => 'Вложенность: принадлежит',
				'help' => 'Перемещение страницы и всех её подстраниц в другой раздел'
			),
			'hr3'           => 'hr',
			'theme'         => array(
				'type' => 'text',
				'name' => 'Дизайн страницы',
				'help' => 'Дизайн страницы на сайте. Выбор из доступным тем в папке /themes/'
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
		)
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'parent', //содержит вложенности
		'order',  //сортируется
		'act',    //показать/скрыть
		'view',   //просмотр на сайте
		'del',    //удалить
		'menu',   //используется в меню
		'nopage', //не разбивать на страницы
		'trash',   //использовать корзину
		'only_self', // показывать только материалы редактора, если это задано в правах пользователя
	);

	/**
	 * @var integer количество строк, выводимых на странице
	 */
	public $nastr = 100;

	/**
	 * Выводит список страниц сайта
	 * @return void
	 */
	public function show()
	{
		echo '<ul class="list">
		<li class="level_0">';


		//Главная страница
		if ($row = DB::fetch_array(DB::query("SELECT [name] FROM {" . $this->diafan->table . "} WHERE id=1 LIMIT 1")))
		{
			echo '<div class="table_wrap"><table width="100%"><tbody><tr>
			
			<td class="name" style="padding-left:8px"><a title="' . $this->diafan->_('Редактировать') . '" href="' . URL . 'edit1/">' . ( $row["name"] ? $row["name"] : 1 ) . '</a>';

			if (DB::query_result("SELECT id FROM {menu} WHERE module_name='site' AND site_id=1 AND trash='0' AND [act]='1' LIMIT 1"))
			{
				echo ' <span title="' . $this->diafan->_('Отображается в меню') . '">(' . $this->diafan->_('м').')</span>';
			}

			echo '</td><td class="action_separator"></td><td class="action_icon"><a href="' . URL . 'parent0/addnew1/" title="' . $this->diafan->_('Создать страницу сайта') . '"><img src="' . BASE_PATH . 'adm/img/add.png" alt="' . $this->diafan->_('Создать страницу сайта') . '"></a></td>
		     </tr></tbody></table></div>';
		}
		echo '</li></ul>';

		//весь список
		$this->diafan->where = " AND e.id<>1 AND e.block='0'";
		$this->diafan->list_row();

		//блоки на сайте
		$this->diafan->where = " AND e.id<>1 AND e.block='1'";
		$this->diafan->list_row(0, -1);
	}

	/**
	 * Формирует SQL-запрос для списка элементов
	 *
	 * @param integer $id родитель
	 * @return resource
	 */
	public function sql_query($id)
	{
		$result = parent::__call('sql_query', array($id));
		if($this->diafan->where == " AND e.id<>1 AND e.block='1'" && DB::num_rows($result))
		{
			echo '<h1>' . $this->diafan->_('Блоки на сайте') . ' <a class="help_img"><img src="' . BASE_PATH . 'adm/img/quest.gif" alt="' . $this->diafan->_('Помощь') . '"><div id="helpsiteblock" class="help_row">' . $this->diafan->_('Для создания блока создайте обычную страницу сайта и поставьте галку "Блок на сайте"') . '</div></a></h1>';
		}
		return $result;
	}

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		//нельзя редактировать поля Принадлежит, Псевдоссылка, Сторонняя ссылка, Активность для Главной страницы
		if ($this->diafan->edit == 1 && ! $this->diafan->addnew || $this->diafan->save == 1 && !$this->diafan->savenew)
		{
			$this->diafan->variable_unset("act");
			$this->diafan->variable_unset("parent_id");
			$this->diafan->variable_unset("rewrite");
			$this->diafan->variable_unset("hr3");
			$this->diafan->variable_unset("block");
			$this->diafan->variable_unset("site_ids");
			$this->diafan->variable_unset("map_no_show");
			$this->diafan->variable_unset("date_start");
			$this->diafan->variable_unset("date_finish");
		}
	}

	/**
	 * Редактирование поля "Прикрепленный модуль"
	 * @return void
	 */
	public function edit_variable_module_name()
	{
		echo '<tr>
			<td class="td_first">
				' . $this->diafan->variable_name() . '
			</td>
			<td>
				<select name="' . $this->diafan->key . '">
					<option value="">' . $this->diafan->_('нет') . '</option>';
					$result = DB::query("SELECT DISTINCT(name), title FROM {modules} WHERE site_page='1' ORDER BY id ASC");
					while ($row = DB::fetch_array($result))
					{
						echo '<option value="' . $row["name"] . '"' . ( $this->diafan->value == $row["name"] ? ' selected' : '' ) . '>' . $this->diafan->_($row["title"]) . '</option>';
					}

		echo '
				</select>
				' . $this->diafan->help() . '
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Расположение"
	 *
	 * @return void
	 */
	public function edit_variable_site_ids()
	{
		$show_in_site_id = array();
		$result = DB::query("SELECT site_id FROM {site_block_rel} WHERE element_id=%d", $this->diafan->edit);
		while ($row = DB::fetch_array($result))
		{
			$show_in_site_id[] = $row["site_id"];
		}
		echo '
		<script type="text/javascript" src="'.BASE_PATH.'modules/site/admin/site.admin.js"></script>
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
	 * Сохранение псевдоссылки
	 *
	 * @return void
	 */
	public function get_rewrite()
	{
		$this->diafan->is_save_rewrite = true;

		if($this->diafan->save == 1)
		{
			return;
		}
		// сохранение редиректа
		if (! $this->diafan->savenew)
		{
			$row = DB::fetch_array(DB::query("SELECT * FROM {redirect} WHERE module_name='site' AND site_id=%d LIMIT 1", $this->diafan->save));
		}
		if (! empty($row["id"]))
		{
			if (! $_POST["rewrite_redirect"])
			{
				DB::query("DELETE FROM {redirect} WHERE id=%d", $row["id"]);
			}
			elseif($_POST["rewrite_redirect"] != $row["redirect"] || $_POST["rewrite_code"] != $row["code"])
			{
				DB::query("UPDATE {redirect} SET redirect='%s', code=%d WHERE id=%d", $_POST["rewrite_redirect"], $_POST["rewrite_code"], $row["id"]);
			}
		}
		elseif($_POST["rewrite_redirect"])
		{
			DB::query("INSERT INTO {redirect} (redirect, code, site_id, module_name) VALUES ('%s', %d, %d, 'site')",
				$_POST["rewrite_redirect"], $_POST["rewrite_code"], $this->diafan->save);
		}
		//----------

		DB::query("DELETE FROM {rewrite} WHERE module_name='%s' AND site_id=%d", $this->diafan->module, $this->diafan->save);
		if (!empty( $_POST["rewrite"] ))
		{
			$rewrite = $_POST["rewrite"];
			//если такая псевдоссылка принадлежит другому элементу, добавляем номер id
			if (DB::query_result("SELECT id FROM {rewrite} WHERE rewrite='%s' LIMIT 1", $rewrite))
			{
				$rewrite .= $this->diafan->save;
			}
			DB::query("INSERT INTO {rewrite} (module_name, site_id, rewrite) VALUES ('site', %d, '%h')", $this->diafan->save, $rewrite);

			return;
		}
		if (!empty( $rewrite ))
		{
			// в готовой псевдоссылке берется только последняя часть
			if (strpos($rewrite, '/') !== false)
			{
				$rewrite_array = explode("/", $rewrite);
				$rewrite = $rewrite_array[count($rewrite_array) - 1];
			}
		}
		else
		{
			$rewrite = $this->diafan->generate_rewrite();
		}

		//если сохраняемый элемент имеет родителя, то в начало псевдоссылки подставляется псевдоссылка родителя
		$rewrite = ( $_POST["parent_id"] ? DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='%s' AND site_id=%d LIMIT 1", $this->diafan->table, $_POST["parent_id"]) . '/' : '' ) . $rewrite;

		//если такая псевдоссылка принадлежит другому элементу, добавляем номер id
		if (DB::query_result("SELECT id FROM {rewrite} WHERE rewrite='%s' LIMIT 1", $rewrite))
		{
			$rewrite .= $this->diafan->save;
		}

		//изменяем псевдоссылку у дочерних страниц
		$this->save_children_rewrite($this->diafan->save, $rewrite);

		DB::query("INSERT INTO {rewrite} (module_name, site_id, rewrite) VALUES ('site', %d, '%h')", $this->diafan->save, $rewrite);
	}

	/**
	 * Изменяет псевдоссылки вложенных страниц
	 * @return void
	 */
	private function save_children_rewrite($parent_id, $rewrite)
	{
		$result = DB::query("SELECT r.rewrite, s.id FROM {site} AS s"
		                    ." INNER JOIN {rewrite} AS r ON r.site_id=s.id AND r.module_name='site'"
		                    ." WHERE s.parent_id=%d AND s.id<>%d", $parent_id, $parent_id);
		while ($row = DB::fetch_array($result))
		{
			if (empty( $row["rewrite"] ))
			{
				$rewrite1 = $rewrite . '/' . $row["id"];
			}
			else
			{
				$rew = explode("/", $row["rewrite"]);
				if (empty( $rew[count($rew) - 1] ))
				{
					$rewrite1 = $rewrite . '/' . $row["id"];
				}
				else
				{
					$rewrite1 = $rewrite . '/' . $rew[count($rew) - 1];
				}
			}
			DB::query("UPDATE {rewrite} SET rewrite='%h' WHERE module_name='%s', site_id=%d", $rewrite1, $row["id"]);
			$this->save_children_rewrite($row["id"], $rewrite1);
		}
	}

	/**
	 * Сохранение поля "JavaScript"
	 * @return void
	 */
	public function save_variable_js()
	{
		$this->diafan->set_query("js='%s'");
		$this->diafan->set_value($_POST["js"]);
	}

	/**
	 * Сохранение поля "Расположение"
	 * @return void
	 */
	public function save_variable_site_ids()
	{
		if(! empty($_POST["block"]))
		{
			$this->diafan->update_table_rel("site_block_rel", "element_id", "site_id", ! empty($_POST['site_ids']) ? $_POST['site_ids'] : array(), $this->diafan->save, $this->diafan->savenew);
		}
		elseif(! $this->diafan->savenew)
		{
			DB::query("DELETE FROM {site_block_rel} WHERE element_id=%d", $this->diafan->save);
		}
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("site_block_rel", "element_id=".$del_id." OR site_id=".$del_id, $trash_id);
	}
}