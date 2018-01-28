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
 * Faq_admin
 *
 * Редактирование вопросов
 */
class Faq_admin extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'faq';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'anons' => array(
				'type' => 'textarea',
				'name' => 'Вопрос',
				'help' => 'Заданный пользователем на сайте',
				'multilang' => true,
				'height' => 200,
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'help' => 'Если отмечена, вопрос и ответ виден на сайте',
				'default' => true,
				'multilang' => true,
			),
			'often' => array(
				'type' => 'checkbox',
				'name' => 'Часто задаваемый вопрос',
				'help' => 'Если отмечена, вопрос и ответ отображаются функцией вывода часто задаваемых вопросов (см.руководство)',
			),
			'name' => array(
				'type' => 'text',
				'name' => 'Имя',
				'help' => 'Имя отправителя вопроса',
				'multilang' => true,
			),
			'created' => array(
				'type' => 'datetime',
				'name' => 'Дата',
				'help' => 'В формате дд.мм.гггг, приходит с сайта',
			),
			'mail' => array(
				'type' => 'text',
				'name' => 'Email',
			),
			'sendmail' => array(
				'type' => 'function',
				'name' => 'Отправить ответ',
				'help' => 'Если отмечена, после сохранения сообщения, ответ будет послан на e-mail отправителя',
			),
			'attachments' => array(
				'type' => 'module',
				'name' => 'Прикрепленные файлы',
			),
			'hr1' => 'hr',
			'rel_elements' => array(
				'type' => 'function',
				'name' => 'Похожие вопросы',
			),
			'hr2' => 'hr',
			'text' => array(
				'type' => 'editor',
				'name' => 'Ответ',
				'multilang' => true,
			),
			'search' => array(
				'type' => 'module',
			),
		),
		'other_rows' => array (
			'tags' => array(
				'type' => 'module',
			),
			'hr2' => 'hr',
			'menu' => array(
				'type' => 'module',
				'name' => 'Создать пункт в меню',
			),
			'number' => array(
				'type' => 'function',
				'name' => 'Номер',
				'help' => 'Номер элемента в БД. (для разработчиков)',
			),
			'user_id' => array(
				'type' => 'function',
				'name' => 'Автор',
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
			'date_start' => array(
				'type' => 'date',
				'name' => 'Период показа',
			),
			'date_finish' => array(
				'type' => 'date',
			),
			'access' => array(
				'type' => 'function',
				'name' => 'Доступ',
			),
			'hr3' => 'hr',
			'site_id' => array(
				'type' => 'function',
				'name' => 'Раздел сайта',
			),
			'cat_id' => array(
				'type' => 'function',
				'name' => 'Категория',
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
			'hr6' => 'hr',
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
		'menu', // используется в меню
		'del', // удалить
		'date', // показывать дату в списке, сортировать по дате
		'element_site', // делит элементы по разделам (страницы сайта, к которым прикреплен модуль)
		'element', // используются группы
		'element_multiple', // модуль может быть прикреплен к нескольким группам
		'trash', // использовать корзину
		'only_self', // показывать только материалы редактора, если это задано в правах пользователя
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array (
		'text' => 'function',
	);

	/**
	 * @var array текст для ссылки на редактирование в списке
	 */
	public $text_for_base_link = array(
		'variable' => 'anons',
		'text' => ''
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		if(! $this->diafan->configmodules("cat", "faq", $this->diafan->site))
		{
			$this->diafan->config("element", false);
			$this->diafan->config("element_multiple", false);
		}
	}

	/**
	 * Выводит список вопросов
	 * @return void
	 */
	public function show()
	{
		if ($this->diafan->config('element') && !$this->diafan->not_empty_categories)
		{
			echo '<div class="error">'.sprintf($this->diafan->_('В %sнастройках%s модуля подключены категории, чтобы начать добавлять вопрос создайте хотя бы одну %sкатегорию%s..'),'<a href="'.BASE_PATH_HREF.'faq/config/">', '</a>', '<a href="'.BASE_PATH_HREF.'faq/category/'.($this->diafan->site ? 'site'.$this->diafan->site.'/' : '').'">', '</a>').'</div>';
		}
		else
		{
			$this->diafan->addnew_init('Добавить вопрос-ответ');
		}

		$this->diafan->list_row();
	}

	/**
	 * Выводит статус вопроса (отвеченный/неотвеченный), в списке
	 * 
	 * @return string
	 */
	public function other_row_text($row)
	{
		return '
		<td class="comment">
		<div>
			<span></span>
			<table><tbody><tr><td>'.(!$row["text"] ? '<a href="'.$this->diafan->get_admin_url().'edit'.$row["id"].'/">('.$this->diafan->_('без ответа').')</a>' : $this->diafan->short_text($row["text"])).'
			</td></tr></tbody></table>
		</div></td>';
	}

	/**
	 * Редактирование поля "Отправить ответ"
	 * @return void
	 */
	public function edit_variable_sendmail()
	{
		echo '
		<tr>
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				<input name="sendmail" value="1" type="checkbox">'.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Сохранение поля "Отправить ответ"
	 * @return void
	 */
	public function save_variable_sendmail()
	{
		if (!empty($_POST["sendmail"]) && !empty($_POST["mail"]) && !empty($_POST["text"]) && !empty($_POST["anons"]))
		{
			$subject = str_replace(
				array('%title', '%url'), array(TITLE, BASE_URL), $this->diafan->configmodules('subject', 'faq', $_POST["site_id"])
			);
	
			$message = str_replace(
				array(
					', %name',
					'%name',
					'%title',
					'%url',
					'%question',
					'%answer'
				), array(
					strip_tags($_POST["name"]) ? ', '.strip_tags($_POST["name"]) : '',
					strip_tags($_POST["name"]),
					TITLE,
					BASE_URL,
					nl2br(htmlspecialchars($_POST["anons"])),
					$_POST["text"]
				), $this->diafan->configmodules('message', 'faq', $_POST["site_id"])
			);
	
			include_once ABSOLUTE_PATH.'includes/mail.php';
			send_mail(
				trim(strip_tags($_POST["mail"])), $subject, $message, $this->diafan->configmodules("emailconf", 'faq', $_POST["site_id"]) && $this->diafan->configmodules("email", 'faq', $_POST["site_id"]) ? $this->diafan->configmodules("email", 'faq', $_POST["site_id"]) : ''
			);
			$this->diafan->err = 5;
		}
		elseif (!empty($_POST["sendmail"]))
		{
			$this->diafan->err = 6;
		}
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("faq_rel", "element_id=".$del_id." OR rel_element_id=".$del_id, $trash_id);
		$this->diafan->del_or_trash_where("faq_counter", "element_id=".$del_id, $trash_id);
	}
}